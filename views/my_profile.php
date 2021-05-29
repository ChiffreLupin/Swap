<?php use app\core\Application ?>
    <!--My profile section-->
    <section id="user-data-section">
        <div class="container">
            <div class="row row-fix">
                <div class="col-md-5 justify-center width-30 form">
                    <div class="myprofile">
                        <span class="">My Profile</span>
                    </div>

                    <div class="user-image">
                        <img class="img-fluid" src="\images\avat-01-512.png" alt="">
                    </div>

                    <div class="username">
                        <span class="input-group-text" id="basic-addon1">@<?php echo Application::$app->user->username ?></span>
                    </div>
                    <div class="username">
                        <p><?php echo Application::$app->user->displayName() ?></p>
                    </div>
                    <div class="edit-profile-btn">
                        <button data-bs-toggle="modal" data-bs-target="#editProfileModal" class="btn btn-edit">Edit Profile</button>
                    </div>
                    <div>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa minus voluptatem fugit labore, hic, natus 
                            sint atque iusto, libero eius est sed sapiente odio perspiciatis suscipit nisi iure necessitatibus unde.</p>
                    </div>
                </div>
                
                <div class="col-8">
                     <div>
                        <h5 class="sw-item-flex-end">Latest Post</h5>
                    </div>
                    <?php  
                    foreach($myProducts as $key => $product) {
                        $imagePath = $product->imagePath;
                        $description = $product->description;
                       echo "<div class='col-9 inner-div'>
                        
                        <!--Siper fotos nje buton dropdown me opsionet edit dhe delete-->
                        <div id='product-options'>
                            <div class='input-group-prepend'>
                                <button class='btn dropdown-toggle' type='button' data-toggle='dropdown'
                                    aria-haspopup='true' aria-expanded='false'><i class='fas fa-ellipsis-h'></i></button>
                                <div id='list' class='dropdown-menu'>
                                    <input type='radio' name='option' class='dropdown-item' id='productSelected'
                                        value='product' checked></input>
                                    <label class='label' for='productSelected'>Edit</label>

                                    <input type='radio' name='option' class='dropdown-item' id='categorySelected'
                                        value='category'></input>
                                    <label class='label' for='categorySelected'>Delete</label>
                                </div>
                            </div>
                        </div>

                        <!--Imazhi i produktit te postuar-->
                        <div class='media-object1'> 
                            <img src='$imagePath' >
                        </div>
                        <div>
                            <p class='description margin-left'>$description</p>
                        </div>
                    </div>";
                    }

                    ?>
                    
                    <!--Shto Produkt-->
                    <div class="center">
                       <button  data-bs-toggle="modal" data-bs-target="#addProductModal"  class="btn border-rad">ADD</button> 
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="SignUpBox">
            <?php $form = \app\core\form\Form::begin('', 'post') ?>
                    <div class="form-row">
                        <!--Column 1-->
                        <div id="Block1"> 
                            <div class="form-group col-md-8 offset-md-2">
                            <?php echo $form->field( $userModel, "firstname", "width: 100%; background-color: whitesmoke; border: none;","col-md-12") ?>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2">
                                <?php echo $form->field( $userModel, "lastname", "width: 100%; background-color: whitesmoke; border: none;","col-md-12") ?>
                            </div>
                            <br>
                            <div  class="form-group col-md-8 offset-md-2">
                                <?php echo $form->field( $userModel, "username", "width: 100%; background-color: whitesmoke; border: none;","col-md-12") ?>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2">
                                <?php echo $form->field( $userModel, "email", "width: 100%; background-color: whitesmoke; border: none;","col-md-12")->email() ?>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2">
                                <?php echo $form->field( $userModel, "password", "width: 100%; background-color: whitesmoke; border: none;","col-md-12")->password() ?>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2">
                                <?php echo $form->field( $userModel, "confirmPassword", "width: 100%; background-color: whitesmoke; border: none;","col-md-12")->password() ?>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2">
                            <?php echo $form->field($userModel, "street", "width: 100%; background-color: whitesmoke; border: none;","col-md-12") ?>

                            </div>
                        <br>
                        </div>
                    </div>
                    <!--Column 2-->
                    <div id="Block2">
                        <div class="form-row">
                            <div class="form-group col-md-8 offset-md-2">
                            <?php echo $form->field($userModel, "city", "width: 100%; background-color: whitesmoke; border: none;","col-md-12") ?>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2 mb-3">
                                <select name="state" class="custom-select" id="inputGroupSelect01" style="width: 100%; background-color: whitesmoke; height: 37px; border-radius: 4px; border-color: #DEDEDE; border: none;">
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
                            <div class="form-group col-md-8 offset-md-2">
                            <?php echo $form->field($userModel, "zip", "width: 100%; background-color: whitesmoke; border: none;","col-md-12") ?>
                            </div>   
                        </div>
                        <br>                        
                    </div>
                    <!--Column 3-->
                    <div id="Block3">
                        <img src="images/undraw_secure_login_pdn4.svg" style="width: 320px; height: 250px;">
                    </div>
            <?php \app\core\form\Form::end() ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Edit Profile</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="SignUpBox">
            <?php $form = \app\core\form\Form::begin('', 'post') ?>
                    <div class="form-row">
                        <!--Column 1-->
                        <div id="Block1"> 
                            <div class="form-group col-md-8 offset-md-2">
                            <?php echo $form->field( $productModel, "name", "width: 100%; background-color: whitesmoke; border: none;","col-md-12") ?>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2">
                            <div class="col-md-12 %s">
                            <select name="category" class="custom-select" placeholder="--Select a category" id="inputGroupSelect01" style="width: 100%; background-color: whitesmoke; height: 37px; border-radius: 4px; border-color: #DEDEDE; border: none;">
                                  <option value="" disabled selected>Select your option</option>
                                  <?php 
                                    foreach($categories as $key => $category) {
                                        $id = $category->id;
                                        $category_name = $category->category_name;
                                        echo "<option value='$id'>$category_name</option>";
                                    }
                                  ?>
                                 

                                </select>
                            </div>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2">
                                <?php echo $form->field( $productModel, "amount", "width: 100%; background-color: whitesmoke; border: none;","col-md-12")->number() ?>
                            </div>
                            <br>
                            <div  class="form-group col-md-8 offset-md-2">
                                <?php echo $form->field( $productModel, "imagePath", "width: 100%; background-color: whitesmoke; border: none;","col-md-12")->file() ?>
                            </div>
                            <br>
                            <div class="form-group col-md-8 offset-md-2">
                                <div class="form-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                                </div>
                             </div>
                            <br>
                        <br>
                        </div>
                    </div>
                    <!--Column 2-->
            <?php \app\core\form\Form::end() ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Edit Profile</button>
      </div>
    </div>
  </div>
</div>