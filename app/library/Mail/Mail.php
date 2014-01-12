<?php

namespace Abstaff\Mail;

use Phalcon\Mvc\User\Component,
	Phalcon\Mvc\View,
	Swift_Message as Message,
	Swift_SmtpTransport as Smtp;

/**
 * Abstaff\Mail\Mail
 * Sends e-mails based on pre-defined templates
 */
class Mail extends Component
{

	protected $transport;

    protected $sendgrid;

    protected $directSmtp = false;

}