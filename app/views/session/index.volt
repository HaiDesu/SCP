<br><br><br><br>
<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Login
				</div>
                <div class="panel-body">
					{{ content() }}
                    {{ form('session/start', 'id': 'loginForm', 'class': 'form-horizontal') }}
					<div class="form-group">
                        <label for="Email" class="col-sm-3 control-label">
                            Email</label>
                        <div class="col-sm-9">
                            {{ text_field('identity', 'class': 'form-control', 'placeholder': 'Email') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">
                            Password</label>
                        <div class="col-sm-9">
                            {{ password_field('password', 'class': 'form-control', 'placeholder': 'Password') }}
                        </div>
                    </div>
                    <div class="form-group last">
                        <div class="col-sm-offset-3 col-sm-9">
                            {{ submit_button('Sign in', 'class': 'btn btn-primary') }}
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
