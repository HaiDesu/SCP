<br><br><br><br>
<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Login
				</div>
                <div class="panel-body">
					{{ content() }}
                    {{ form('session/forgotPassword', 'id': 'forgot-password', 'class': 'form-horizontal') }}
					<div class="form-group">
                        <label for="email" class="col-sm-3 control-label">
                            Email</label>
                        <div class="col-sm-9">
                            {{ text_field('email', 'class': 'form-control', 'placeholder': 'Email') }}
                        </div>
                    </div>
                    <div class="form-group last">
                        <div class="col-sm-offset-3 col-sm-9">
                            {{ submit_button('Next', 'class': 'btn btn-primary') }}
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
