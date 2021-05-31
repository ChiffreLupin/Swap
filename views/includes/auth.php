<?php 
    $root = app\core\Application::$ROOT_DIR."\\";
?>
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="/images/logo-icon.png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/c355012b63.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
        <?php if($current==='Register') { ?>
        <link href="css/SignUp.css" rel="stylesheet">
        <?php } ?>
        <?php if($current==='Login') { ?>
            <link rel="stylesheet" type="text/css" href="css/LogIn.css" media="screen"/>
        <?php } ?>
        <?php if($current === 'Reset Password' || $current === "Forgot Password") { ?>
        <link rel="stylesheet" type="text/css" href="/css/ForgetPass.css" media="screen"/>
        <?php } ?>

        <title> <?php echo $current ?> </title>
    </head>
    <body>
        <!--Header-->
        <nav class="navbar navbar-dark justify-center height-55" style="background-color: black;">
            <div class="container justify-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo-wrapper">
                            <a href="/">
                            <img src="images/logo.png" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        {{content}}
         <!--Footer-->
        <footer class="text-white height-footer" style="background-color: black;" id="LogInFooter">
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
                        <a href="Files/terms and conditions.pdf" download rel="noopener noreferrer" target="_blank" style="color: white;">
                            TERMS & CONDITIONS POLICY
                    </a>
                    </div>
                    <div class="col-md-6 text-Inter terms-cond">            
                        <p> © 2021 Swap  All Rights  Reserved </p>
                    </div>
                </div>             
            </div>
        </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/sign-up.js"></script>
</body>
</html>