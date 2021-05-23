
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
                  <a class="link" href="ForgetPass.html">Forgot password?</a>
                  <a class="link" href="SignUp.html">Sign up</a>
                </div>
                
                <br><br>
                <a href="#"><button type="submit" id="LogInButton" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" name="LOGIN" value="Login" 
                style="position: absolute;right: 25px; bottom: 3px;">Log in</button></a>
            <?php app\core\form\Form::end() ?>
            </div>
        </div>
    </div>
    <!--Footer-->
    <footer class="text-white" style="background-color: black;" id="LogInFooter">
        <div class="container p-4">
            <div class="row">
                <div class="col-md-7">
                    <section class="">
                        <form action="">
                          <div class="row d-flex">
                            <div class="col-auto">
                              <p class="pt-2 text-Inter">
                                <strong>SUBSCRIBE TO OUR NEWSLETTER</strong> 
                              </p>
                            </div>
                            
                            <div class="col-md-5 col-12" style="width: 450px;">
                              <div class="input-group mb-3"  style=" width: 300px;">
                                <input type="email" class="form-control" placeholder="Enter your e-mail adress here" aria-label="Email" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                    <i class="fas fa-angle-right"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="col-md-2" style="margin-left: 95px;">
                    <div class="col-auto">
                        <p class="pt-2 text-Inter">
                          <strong>JOIN US ON</strong> 
                        </p>
                    </div>
                </div>
                <div class="col-md-2 float-left" style="margin-left: -100px;">
                    <section class="mb-2">
                        <!-- Facebook -->
                        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                          ><i class="fab fa-facebook-f"></i
                        ></a>
                  
                        <!-- Twitter -->
                        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                          ><i class="fab fa-twitter"></i
                        ></a>
                  
                        <!-- Instagram -->
                        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                          ><i class="fab fa-instagram"></i
                        ></a>
                  
                      </section>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-Inter terms-cond">
                    <a href="files/terms and conditions.pdf" download rel="noopener noreferrer" target="_blank" style="color: white;">
                        TERMS & CONDITIONS POLICY
                   </a>
                </div>
                <div class="col-md-6 text-Inter terms-cond">            
                    <p> © 2021 Swap  All Rights  Reserved </p>
                 </div>
            </div>             
        </div>
    </footer>
    
    <script>
        var buttons = document.querySelectorAll('.btn')
        buttons.forEach(function (button) {
        var button = new bootstrap.Button(button)
        button.toggle()})
    </script>
