<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $current ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/c355012b63.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if($current === "Product Details") { ?>
    <link rel="stylesheet" type="text/css" href="/css/Product_Page.css" media="screen" />

    <?php } ?>
    <?php if($current === "Notifications") { ?>
        <link rel="stylesheet" href="/css/notifications.css">
    <?php } ?>
    <?php if($current === "Home") { ?>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="/css/logged_user.css">       
     
    <?php } ?>
    <?php if($current === "My Profile") { ?>
        <link rel="stylesheet" href="/css/myProfile.css">
         <link rel="stylesheet" href="/css/Product_Page.css">

    <?php } ?>
</head>

    <body>
        <!--Navbar About    -->
        <nav class="navbar navbar-dark justify-center height-55" style="background-color: black;" role="navigation">
            <div class="container-fluid justify-center align-items-center">
                <div class="row width-100 align-items-center">
                    <div class="col align-items-center">
                        <form class="form-inline align-items-center" action="">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark dropdown-toggle nav-drop" type="button" data-toggle="dropdown"
                                        aria-expanded="false"></button>
                                    <div id="list" class="dropdown-menu">
                                        <input type="radio"  name="option" class="dropdown-menu radio-nav" id="productSelected"
                                            value="product" checked></input>
                                        <label class="label" for="productSelected">Product</label>

                                        <input type="radio" name="option" class="dropdown-item radio-nav" id="categorySelected"
                                            value="category"></input>
                                        <label class="label" for="categorySelected">Category</label>

                                        <input type="radio"  name="option" class="dropdown-item radio-nav" id="userSelected"
                                            value="user"></input>
                                        <label class="label" for="userSelected">User</label>
                                    </div>
                                </div>
                                <input type="text" class="form-control searchbar" aria-label="Search input with dropdown button"
                                    href="#" placeholder="Search product">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="button" onclick="performSearch()"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        </form>
                    </div>

                    <div class="col">
                        <div class="logo-wrapper text-center">
                            <a href="/home"><img src="/images/logo.png" alt="" class="img-fluid"></a>
                        </div>
                    </div>

                    <div class="col">
                        <section class="d-flex justify-content-end">
                            <!--Chat icon-->
                            <a class="btn btn-outline-light btn-floating m-1 border-none" href="Chat_Page.html"
                                role="button" data-toggle="tooltip" data-placement="bottom" title="Chat">
                                <i class="fas fa-location-arrow"></i>
                            </a>
                            <!--Notification icon-->
                            <a class="btn btn-outline-light btn-floating m-1 border-none" href="/notifications"
                                role="button" data-toggle="tooltip" data-placement="bottom" title="Notifications">
                                <i class="fas fa-bell"></i>
                            </a>
                            <!--User profile-->
                            <a class="btn btn-outline-light btn-floating m-1 border-none" href="/myProfile"
                                role="button" data-toggle="tooltip" data-placement="bottom" title="My Profile">
                                <i class="fas fa-user"></i>
                            </a>
                            <!--Log out-->
                            <a class="btn btn-outline-light btn-floating m-1 border-none" href="/logout" role="button"
                                data-toggle="tooltip" data-placement="bottom" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </section>
                    </div>

                </div>
            </div>
        </nav>


        {{content}}

        <!--Footer-->
        <footer class="text-white height-footer" style="background-color: black;">
            <div class="container p-4">
                <div class="row">
                    <div class="col-md-7 d-flex align-items-center">
                        <section class="">
                            <form action="">
                                <div class="row ">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="mb-0  text-Inter">
                                    <strong>SUBSCRIBE TO OUR NEWSLETTER</strong> 
                                    </p>
                                </div>
                                
                                <div class="col-md-5 col-12 " style="width: 450px;">
                                    <div class="input-group ">
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
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- 
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

        <script src="/js/myProfile.js"></script>
        <?php if($current === "Home") { ?>
        <script src="/js/logged_user.js"></script>
        <?php } ?>
        <script src="/js/productDetails.js"></script>
        <script src="/js/notifications.js"></script>
        <script src="/js/products.js"></script>                

    </body>



</html>