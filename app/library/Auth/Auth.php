<?php
namespace Abstaff\Auth;

use Phalcon\Mvc\User\Component,
	Phalcon\Db\RawValue as RawValue;
use Abstaff\Models\Users,
	Abstaff\Models\RememberTokens,
	Abstaff\Models\SuccessLogins,
	Abstaff\Models\FailedLogins;

/**
 * Abstaff\Auth\Auth
 * Manages Authentication/Identity Management in Vokuro
 */
class Auth extends Component
{	
	/**
	 * Stores a successful login in the db
	 *
	 * @param Abstaff\Models\Users $user
	 */
	private function _saveSuccessLogin($user)
	{
		$successLogin = new SuccessLogins();
		$successLogin->userId = $user->id;
		$successLogin->ipAddress = $this->request->getClientAddress();
		$successLogin->userAgent = $this->request->getUserAgent();
		$successLogin->date = new RawValue('now()');
		if (!$successLogin->save()) {
			$messages = $successLogin->getMessages();
			throw new Exception($messages[0]);
		}
	}
	
	/**
     * Implements login throttling
     * Reduces the efectiveness of brute force attacks
     *
     * @param int $userId
     */
    private function _saveFailedLogin($user)
	{
		$failedLogin = new FailedLogins();
		$failedLogin->userId = $user->id;
		$failedLogin->ipAddress = $this->request->getClientAddress();
		$failedLogin->userAgent = $this->request->getUserAgent();
		$failedLogin->date = new RawValue('now()');
		$failedLogin->attempted = time();
		$failedLogin->module = 'backend';
		$failedLogin->save();
		$attempts = FailedLogins::count(array(
			'ipAddress = ?0 AND attempted >= ?1',
			'bind' => array(
				$this->request->getClientAddress(),
				time() - 3600 * 6
			)
		));
		switch ($attempts) {
			case 1:
			case 2:
				// no delay
				break;
			case 3:
			case 4:
				sleep(2);
				break;
			default:
				sleep(4);
				break;
		}
	}
	
	/**
     * Creates the remember me environment setting the related cookies and generating tokens
     *
     * @param Abstaff\Models\Users $user
     */
    private function _createRememberEnviroment(Users $user)
    {
        $userAgent = $this->request->getUserAgent();
        $token = md5($user->email . $user->password . $userAgent);

        $remember = new RememberTokens();
        $remember->userId = $user->id;
        $remember->token = $token;
        $remember->userAgent = $userAgent;

        if ($remember->save() != false) {
            $expire = time() + 86400 * 8;
            $this->cookies->set('RMU', $user->id, $expire);
            $this->cookies->set('RMT', $token, $expire);
        }
    }
	
	/**
     * Checks if the user is banned/inactive/suspended
     *
     * @param Abstaff\Models\Users $user
     */
    private function _checkUserFlags(Users $user)
    {
        if ($user->validated != 'Y') {
            throw new Exception('The user is unvalidated');
        }

        if ($user->banned != 'N') {
            throw new Exception('The user is banned');
        }
    }
	
	/**
     * Checks the user credentials
     *
     * @param array $credentials
     * @return boolan
     */
    public function check($credentials)
    {

        // Check if the user exist
        $user = Users::findFirstByEmail($credentials['email']);
        if ($user == false) {
            $this->_saveFailedLogin(0);
            throw new Exception('Wrong email/password combination');
        }

        // Check the password
        if (!password_verify($credentials['password'], $user->password)) {
            $this->registerUserThrottling($user->id);
            throw new Exception('Wrong email/password combination');
        }

        // Check if the user was flagged
        $this->_checkUserFlags($user);

        // Register the successful login
        $this->_saveSuccessLogin($user);

        // Check if the remember me was selected
		if (isset($credentials['remember'])) {
            $this->_createRememberEnviroment($user);
        }
		
        $this->session->set('auth-identity', array(
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'group' => $user->group
        ));
    }
	
	/**
     * Check if the session has a remember me cookie
     *
     * @return boolean
     */
    public function hasRememberMe()
    {
        return $this->cookies->has('RMU');
    }
	
	/**
     * Logs on using the information in the coookies
     *
     * @return Phalcon\Http\Response
     */
    public function loginWithRememberMe()
    {
        $userId = $this->cookies->get('RMU')->getValue();
        $cookieToken = $this->cookies->get('RMT')->getValue();

        $user = Users::findFirstById($userId);
        if ($user) {

            $userAgent = $this->request->getUserAgent();
            $token = md5($user->email . $user->password . $userAgent);

            if ($cookieToken == $token) {

                $remember = RememberTokens::findFirst(array(
                    'userId = ?0 AND token = ?1',
                    'bind' => array(
                        $user->id,
                        $token
                    )
                ));
                if ($remember) {

                    // Check if the cookie has not expired
                    if ((time() - (86400 * 8)) < $remember->createdAt) {

                        // Check if the user was flagged
                        $this->checkUserFlags($user);

                        // Register identity
                        $this->session->set('auth-identity', array(
							'id' => $user->id,
							'username' => $user->username,
							'email' => $user->email,
							'group' => $user->group
						));

                        // Register the successful login
                        $this->_saveSuccessLogin($user);

						return $this->response->redirect('index');	//Make a full HTTP redirection
                    }
                }
            }
        }

        $this->cookies->get('RMU')->delete();
        $this->cookies->get('RMT')->delete();

        return $this->response->redirect('session/login');
    }
	
	/**
     * Returns the current identity
     *
     * @return array
     */
    public function getIdentity()
    {
        return $this->session->get('auth-identity');
    }

    /**
     * Returns the current identity
     *
     * @return string
     */
    public function getName()
    {
        $identity = $this->session->get('auth-identity');
        return $identity['username'];
    }

    /**
     * Removes the user identity information from session
     */
    public function remove()
    {
        if ($this->cookies->has('RMU')) {
            $this->cookies->get('RMU')->delete();
        }
        if ($this->cookies->has('RMT')) {
            $this->cookies->get('RMT')->delete();
        }

        $this->session->remove('auth-identity');
    }
	
	/**
     * Auths the user by his/her id
     *
     * @param int $id
     */
    public function authUserById($id)
    {
        $user = Users::findFirstById($id);
        if ($user == false) {
            throw new Exception('The user does not exist');
        }

        $this->checkUserFlags($user);

        $this->session->set('auth-identity', array(
            'id' => $user->id,
            'username' => $user->username,
			'email' => $user->email,
			'group' => $user->group
        ));
    }
	
	/**
     * Get the entity related to user in the active identity
     *
     * @return \Abstaff\Models\Users
     */
    public function getUser()
    {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['id'])) {

            $user = Users::findFirstById($identity['id']);
            if ($user == false) {
                throw new Exception('The user does not exist');
            }

            return $user;
        }

        return false;
    }

}