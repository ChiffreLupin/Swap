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
              <a href="#"><button type="button" id="OfferButton" class="btn btn-primary" data-bs-toggle="button"
                  autocomplete="off" name="Offer" value="offer" style="position: relative;">Send an offer</button></a>
            </div>
          </div>
        </div>
      </div>
      <div id="lower" class="row" style="margin-top: 40px;">
        <hr style="visibility: hidden;">
      </div>
    </div>
