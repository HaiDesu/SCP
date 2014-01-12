<br><br><br><br>
<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Register
				</div>
                <div class="panel-body">
					<?php echo $this->getContent(); ?>
                    <?php echo $this->tag->form(array('session/create', 'id' => 'registerForm', 'class' => 'form-horizontal', 'onbeforesubmit' => 'return false')); ?>
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">
                            Username</label>
                        <div class="col-sm-9">
                            <?php echo $this->tag->textField(array('username', 'class' => 'form-control', 'pattern' => '.{3,16}', 'maxlength' => '16', 'placeholder' => 'Username (3-16 characters)')); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="email" class="col-sm-3 control-label">
                            Email</label>
                        <div class="col-sm-9">
                            <?php echo $this->tag->textField(array('email', 'class' => 'form-control', 'placeholder' => 'Email')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">
                            Password</label>
                        <div class="col-sm-9">
                            <?php echo $this->tag->passwordField(array('password', 'class' => 'form-control', 'pattern' => '.{8,60}', 'maxlength' => '60', 'placeholder' => 'Password (min. 8 characters)')); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="password" class="col-sm-3 control-label">
                            Verify Password</label>
                        <div class="col-sm-9">
                            <?php echo $this->tag->passwordField(array('repeatPassword', 'class' => 'form-control', 'pattern' => '.{8,60}', 'maxlength' => '60', 'placeholder' => 'Verify Password')); ?>
                        </div>
                    </div>
                    <div class="form-group last">
                        <div class="col-sm-offset-3 col-sm-9">
                            <?php echo $this->tag->submitButton(array('Register', 'class' => 'btn btn-primary', 'onclick' => 'return SignUp.validate();')); ?>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="panel-footer">
                    By signing up, you accept our terms of use and our privacy policy.
				</div>
            </div>
        </div>
    </div>
