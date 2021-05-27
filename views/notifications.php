
    <section id="notifications-section">
    
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
                                <?php echo $notif->message ?>
                            </p>
                            <div class="notification-action">
                                <button class="btn btn-accept">
                                    Accept
                                </button>
                                <button class="btn btn-decline">
                                    Decline
                                </button>
                            </div>
                        </div> 
                      
                         
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        
    </section>
