
<?php use app\models\RequestNotification ?>
<section id="notifications-section" class="fill-page">
    <div class="container">
        <!-- <div class="row ">
            <div class="notification-item ">
                <div class="col-md-2">
                    <div class="user-image-wrapper">
                        <img src="/images/avat-01-512.png" alt="" class="img-fluid">
                        <span class="user-dot-active"></span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="notification-wrapper">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="notification-item ">
                <div class="col-md-2">
                    <div class="user-image-wrapper">
                        <img src="/images/avat-01-512.png" alt="" class="img-fluid">
                        <span class="user-dot-active"></span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="notification-wrapper">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="notification-item ">
                <div class="col-md-2">
                    <div class="user-image-wrapper">
                        <img src="/images/avat-01-512.png" alt="" class="img-fluid">
                        <span class="user-dot-active"></span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="notification-wrapper">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="notification-item ">
                <div class="col-md-2">
                    <div class="user-image-wrapper">
                        <img src="/images/avat-01-512.png" alt="" class="img-fluid">
                        <span class="user-dot-active"></span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="notification-wrapper">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="notification-item ">
                <div class="col-md-2">
                    <div class="user-image-wrapper">
                        <img src="/images/avat-01-512.png" alt="" class="img-fluid">
                        <span class="user-dot-active"></span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="notification-wrapper">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                </div>
            </div>
        </div> -->
        <?php foreach($notifications as $key=> $notif) { ?>
        <div class="row row-<?php echo $notif->id ?>">
            <div class="notification-item ">
                <div class="col-md-2">
                    <div class="user-image-wrapper">
                        <img src="/images/avat-01-512.png" alt="" class="img-fluid">
                        <span class="user-dot-active"></span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="notification-wrapper">
                        <p>
                            <?php echo $notif->message ?>
                        </p>
                        <?php if($notif->swap->isApprovedByReceiver === 0) { ?>
                            <div class="notification-action actions-<?php echo $notif->id?>">
                                <button class="btn btn-accept" onclick="acceptSwap(<?php echo $notif->swap_id ?>, <?php echo $notif->id ?>)">
                                    Accept
                                </button>
                                <button class="btn btn-decline" onclick="deleteNotification(<?php echo $notif->id?>)">
                                    Decline
                                </button>
                            </div>
                        <?php } ?>
                    </div> 
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>
