   <?php use app\core\Application ?>
   <!--Webpage content-->
    <div id="LogInContent">
        <div id="LogInBox"> 
            <form id="form1" action="" method="post">
              <div>
                <i class="far fa-user-circle"style="margin-left: 110px;color: white; font-size: 3rem; margin-bottom: 15px;"></i>
              </div>
              <p style=" color:white; margin-left: 35px; margin-top: 7px; font-size: 18px; margin-bottom: -5px;">Reset Password</p>
                <input type="hidden" value="<?php echo $selector ?>" name="selector">
                <input type="hidden" value="<?php echo $validator ?>" name="validator">
                <input type="password" name="newPassword" placeholder="New Password" class="txt form-control"><br><br>
                <input type="password" name="confirmNewPassword" placeholder="Confirm  New Password" class="txt form-control" style="margin-top: -20px; margin-bottom: 10px;"><br>
              <br><br>
              <div class="rules">
                <?php 
                  if(Application::$app->session->getFlash('error-new')) {
                    echo Application::$app->session->getFlash('error-new');
                  }
                ?>
             </div>
              <button type="submit" id="ContinueButton" class="btn btn-primary" data-bs-toggle="button" name="reset-password"
              style="position: relative;left: 150px;">Reset Password</button>

            </form>
            
        </div>
    </div>
   