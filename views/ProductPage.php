<?php 
use app\core\Application; 
?>
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
      <h1  class="col-md-8 offset-md-2 offers-title">Choose one of your products to offer</h1>
    </div>
    <div class="row offers">
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm SWAP?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to send this Swap request?
      </div>
      <div class="modal-footer">
      <form action="/createSwap" method="POST">
        <input type="hidden" name="product_received_id" value="<?php echo $model->id?>" >
        <input type="hidden" class="sentInputHidden" name="product_sent_id" value="">
        <input type="hidden" name="sender_id" value="<?php echo Application::$app->user->id ?>" >
        <input type="hidden" name="receiver_id" value="<?php echo $model->user_id ?>" >

        <button type="submit" class="btn btn-success">Confirm</button>
      </form>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>