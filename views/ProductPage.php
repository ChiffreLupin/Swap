<?php use app\core\Application; ?>
  <!--Body-->
  <div id="Content">
    <div id="upper" class="row">
      <div id="Block1" class="col">
        <div style="margin-top: 40px; margin-left: 40px;">
          <h2 class= "h"> <?php echo $model->name ?></h2>
          <a href="#">
            <h5 class="h"><?php echo $model->user->username ?></h5>
          </a>
        </div>
        <div class="media-object">
          <img src="<?php echo $model->imagePath ?>" id="image" >
        </div>
      </div>
      <div id="Block2" class="col">
        <div class="media-right">
          <div>
            <p class="h"><?php echo $model->description ?></p>
            <div class="row d-flex justify-content-center mt-100" style="visibility:unset; margin-left: -30px;">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-body text-center">
                    <label class="check"> <input name="size" type="radio" checked> <span>XS</span> </label>
                    <label class="check"> <input name="size" type="radio"> <span>S</span> </label>
                    <label class="check"> <input name="size" type="radio"> <span>M</span> </label>
                    <label class="check"> <input name="size" type="radio"> <span>L</span> </label>
                    <label class="check"> <input name="size" type="radio"> <span>XL</span> </label>
                    <label class="check"> <input name="size" type="radio"> <span>XXL</span> </label>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <button type="button" id="OfferButton" class="btn btn-primary" data-bs-toggle="button" 
              onclick="loadOffers(<?php echo Application::$app->user->id ?>)"
                  autocomplete="off" name="Offer" value="offer" style="position: relative;">Send an offer</button>
            </div>
          </div>
        </div>
      </div>     
    </div>
  </div>
  <div id="lower" class="container hidden" style="margin-top: 40px;">
    <div class="row">
      <h1  class="col-md-12 offset-md-2 offers-title">Choose one of your products to offer</h1>
    </div>
    <div class="row offers">
    </div>
  </div>