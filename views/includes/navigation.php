<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $current ?></title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script defer async src="https://kit.fontawesome.com/c355012b63.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/style.css">
    <?php if($current === "Product Details") { ?>
    <link rel="stylesheet" type="text/css" href="/css/Product_Page.css" media="screen" />
    <?php } ?>
</head>
<body>
     <!--Header-->
    <header id="header-1">
        <div id="search-bar" class="col-md-5 col-12">
        <div class="input-group mb-3" style=" width: 300px;">
            <a href="#" role="search" class="btn btn-floating m-1 btn-outline-secondary" style="border: none;">
            <i class="fas fa-search" style="color: white; font-size:smaller; size: 25px;"></i></a>
            <input type="search" class="form-control" placeholder="Search..." style="height: 25px; margin-top: 9px;">
        </div>
        </div>
        <div id="logo">
        <a href="#"><i></i><img src="/images/logo.png" alt="SWAP"
            width="80px" height="20px"></a>
        </div>
        <div class="col-md-2 float-left">
        <section class="mb-2">
            <!--Chat icon-->
            <a class="btn btn-outline-light btn-floating m-1" href="Chat_Page.html" role="button" style="border: none;"><i
                class="fas fa-location-arrow"></i>
            </a>
            <!--Notification icon-->
            <a class="btn btn-outline-light btn-floating m-1" href="Notif_Page.html" role="button" style="border: none;"><i
                class="fas fa-bell"></i>
            </a>
            <!--User profile-->
            <a class="btn btn-outline-light btn-floating m-1" href="Profile_Page.html" role="button" style="border: none"><i
                class="fas fa-user"></i>
            </a>
            <!--Log out-->
            <a class="btn btn-outline-light btn-floating m-1" href="logout.php" role="button"
            style="border: none;"><i class="fas fa-sign-out-alt"></i>
            </a>
        </section>
        </div>
    </header>

    {{content}}
    <!--Footer-->
    <footer class="text-white" style="background-color: black;">
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
                                <div class="input-group mb-3">
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
                <div class="col-md-2">
                    <div class="col-auto">
                        <p class="pt-2 text-Inter">
                            <strong>JOIN US ON</strong> 
                        </p>
                    </div>
                    
                </div>
                <div class="col-md-2" style = "padding-left: 10px ;">
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
                    <a href="/views/files/terms and conditions.pdf" download rel="noopener noreferrer" target="_blank" style="color: white;">
                        TERMS & CONDITIONS POLICY
                    </a>
                </div>
                <div class="col-md-6 text-Inter terms-cond">            
                    <p> © 2021 Swap  All Rights  Reserved </p>
                    </div>
            </div>             
        </div>
    </footer>
</body>

 

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="/js/logged_user.js"></script>
</html>