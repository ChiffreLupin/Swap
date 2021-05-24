
    <!--Webpage content-->
    <div id="LogInContent">
        <div id="LogInBox">
            <div id="Form1">
            <?php $form = app\core\form\Form::begin('', 'post') ?>
              <div>
                <i class="far fa-user-circle"style="margin-left: 130px;color: black; font-size: 3rem; margin-bottom: 15px;"></i>
              </div>
                <h4 style="font-size: 22px; color:black; margin-left: 35px; margin-top: 5px; margin-bottom: -6px;">Log in</h4>
                <div class="form-group">
                  <?php echo $form->field($model, 'email', 'margin-top: 15px')->email() ?>
                </div>
                <div class="form-group">
                  <?php echo $form->field($model, 'password','margin-top: 20px')->password() ?>
                </div>
                <div class="links">
                  <a class="link" href="/forgotPassword">Forgot Password?</a>
                  <a class="link" href="/register">Sign up</a>
                </div>                
                <br><br>
                <a href="#"><button type="submit" id="LogInButton" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" name="LOGIN" value="Login" 
                style="position: absolute;right: 25px; bottom: 3px;">Log in</button></a>
            <?php app\core\form\Form::end() ?>
            </div>
        </div>
    </div>
    