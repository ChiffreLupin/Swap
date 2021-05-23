
    <!--Webpage content-->
    <div id="Content">
        <!--Log in Box-->
        <div id="SignUpBox">
            <?php $form = \app\core\form\Form::begin('', 'post') ?>
                    <div class="form-row">
                        <h4 style="font-size: 33px; color:black">Sign Up</h4>
                        <!--Column 1-->
                        <div id="Block1"> 
                            <div class="form-group">
                            <?php echo $form->field( $model, "firstname", "width: 240px; background-color: whitesmoke; border: none;") ?>
                            </div>
                            <br>
                            <div class="form-group col">
                                <?php echo $form->field( $model, "lastname", "width: 240px; background-color: whitesmoke; border: none;") ?>
                            </div>
                            <br>
                            <div  class="form-group">
                                <?php echo $form->field( $model, "username", "width: 240px; background-color: whitesmoke; border: none;") ?>
                            </div>
                            <br>
                            <div class="form-group col-md-6">
                                <?php echo $form->field( $model, "email", "width: 240px; background-color: whitesmoke; border: none;")->email() ?>
                            </div>
                            <br>
                            <div class="form-group col-md-6">
                                <?php echo $form->field( $model, "password", "width: 240px; background-color: whitesmoke; border: none;")->password() ?>
                            </div>
                            <br>
                            <div class="form-group col-md-6">
                                <?php echo $form->field( $model, "confirmPassword", "width: 240px; background-color: whitesmoke; border: none;")->password() ?>
                            </div>
                            <br>
                            <div class="form-group">
                            <?php echo $form->field( $model, "street", "width: 240px; background-color: whitesmoke; border: none;") ?>

                            </div>
                        <br>
                        </div>
                    </div>
                    <!--Column 2-->
                    <div id="Block2">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <?php echo $form->field( $model, "city", "width: 240px; background-color: whitesmoke; border: none;") ?>
                            </div>
                            <br>
                            <div class="input-group mb-3">
                                <select name="state" class="custom-select" id="inputGroupSelect01" style="width: 240px; background-color: whitesmoke; height: 37px; border-radius: 4px; border-color: #DEDEDE; border: none;">
                                  <option selected>Albania</option>
                                  <option value="1">England</option>
                                  <option value="2">Danmark</option>
                                  <option value="3">Germany</option>
                                  <option value="4">Greece</option>
                                  <option value="5">France</option>
                                  <option value="6">Kosovo</option>
                                  <option value="7">Norway</option>
                                  <option value="8">New Zeland</option>
                                  <option value="9">Montenegro</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                            <?php echo $form->field( $model, "zip", "width: 240px; background-color: whitesmoke; border: none;") ?>

                            </div>   
                        </div>
                        <br>
                        <!-- <div id="input-group mb-3">
                            <select class="custom-select" id="inputGroupSelect01" style="width: 240px; background-color: whitesmoke; height: 37px; border-radius: 4px; border-color: #DEDEDE; border: none;">
                                <option>Subscription Type</option>
                                <option value="3">Monthly Subscription</option>
                                <option value="1">6 Month Subscription</option>
                                <option value="2">Yearly Subscription</option>
                            </select>
                        </div>
                        <div id="payment">
                            <input class="form-control" type="text" placeholder="Card number" style="width: 190px; background-color: whitesmoke; height: 35px; margin-top: 20px; border-radius: 4px; border-color: #DEDEDE; border: none; display: inline;">
                            <input class="form-control" type="text" placeholder="PIN" style="width: 50px; border: none; background-color: whitesmoke; height: 35px; border-radius: 4px; text-align: center; margin-right: -20px; display: inline;">
                            <div class="container" style="display: inline; margin-left: 7px;margin-bottom: -10px;">
                                <i class="fab fa-cc-paypal" style="color:#9e898b; font-size: 30px;"></i>
                            </div>
                        </div> -->
                        <div class="input-group-text" style="background-color: white; border: none; padding-left: 0px; padding-top: 0px; margin-top: 10px;">
                            <input type="checkbox" style="padding-top: 30px; color: #EBDEDF;">
                            <label style="padding-left: 5px;">I agree to all the Terms and Conditions</label>
                        </div> 
                        <br>
                         <a href="#"><button id="SignUpButton" type="submit" name="Register" value="Register">Register</button></a>
                         <br>
                         <br>
                        <div class="input-group-text" style="background-color: white; border: none;">
                            <a href="LogIn.html" style="margin-right: 120px; margin-top: 5px; padding-right: 10px;text-decoration: none;">Already have an account?</a>
                        </div> 
                    </div>
                    <!--Column 3-->
                    <div id="Block3">
                        <img src="images/undraw_secure_login_pdn4.svg" style="width: 320px; height: 250px;">
                    </div>
            <?php \app\core\form\Form::end() ?>
        </div>
    </div>
    <!--Footer-->
    <footer class="text-white" id="Footer" style="background-color: black;">
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
                              <div class="input-group mb-3" style=" width: 300px;">
                                <input type="text" class="form-control" placeholder="Enter your e-mail adress here" aria-label="Email" aria-describedby="button-addon2">
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
                    <a href="Files/terms and conditions.pdf" download rel="noopener noreferrer" target="_blank" style="color: white;">
                        TERMS & CONDITIONS POLICY
                   </a>
                </div>
                <div class="col-md-6 text-Inter terms-cond">            
                    <p> © 2021 Swap  All Rights  Reserved </p>
                 </div>
            </div>             
        </div>
    </div>
