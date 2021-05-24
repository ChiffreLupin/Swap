   <!--Webpage content-->
   <?php
    use app\core\Application;
   ?>
   <div id="LogInContent">
        <div id="LogInBox"> 
            <form id="form1" action="" method="POST">
              <div>
                <i class="far fa-user-circle"style="margin-left: 110px;color: white; font-size: 3rem; margin-bottom: 15px;"></i>
              </div>
              <p style=" color:white; margin-left: 35px; margin-top: 15px; font-size: 18px; margin-bottom: -5px;">Reset Password</p>
                <input type="email" name="email" placeholder="Enter your email" class="txt form-control"><br><br>
                <?php if(Application::$app->session->getFlash("error")) { ?>
                <div class="alert alert-danger">
                    <?php echo Application::$app->session->getFlash("error") ?>
                </div>
                <?php } ?>
                <?php if(Application::$app->session->getFlash("recovery")) { ?>
                <div class="alert alert-success">
                    <?php echo Application::$app->session->getFlash("recovery") ?>
                </div>
                <?php } ?>
              <br><br>
              <button type="submit" id="ContinueButton" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" 
              style="position: relative;left: 150px;">Continue</button>
            </form>
        </div>
    </div>
   