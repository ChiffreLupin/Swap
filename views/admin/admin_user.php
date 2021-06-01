
    <div class="col-md-10">
        <!--CONTENT-->
        <div class="content container">
            <div class="message alert"></div>
            <div class="info my-4 font-size">
                <span class="font-size-30">USER</span>
                <p class="font-size-20 my-1">Block/Delete user</p>
                <form method="GET" action="" style="width:100%;">
                <div class="input-group ">
                    <input type="search" name="searchValue" class="form-control rounded" placeholder="Search user" aria-label="Search"
                        aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-outline-primary">search</button>
                </div>
                </form>

               
                <div class='list-unstyled mt-5 users-container'>
                <ul class='list-group list-group-horizontal py-1'>
                    <li class='list-group-item col-md-2'>Profile photo</li>
                    <li class='list-group-item col-md-6'>Username</li>
                    <li class='list-group-item col-md-2'>Block</li>
                    <li class='list-group-item col-md-2'>Delete</li>
                </ul>
                <?php 

                    foreach($users as $user) {
                        $id = $user->id;
                        $blocked = $user->blocked ? "Unblock" : "Block";
                        echo "
                <!--User data-->
                <ul class='list-group list-group-horizontal user-$id'>
                    <li class='list-group-item col-md-2'>
                        <img src='/images/avat-01-512.png' class='img-fluid' width='50%'>
                    </li>
                    <li class='list-group-item col-md-6'>
                        <a href='#'>$user->username</a>
                    </li>
                    <li class='list-group-item col-md-2'>
                        <button onclick='toggleBlockedUser($user->id)' class='btn btn-warning block-buton block-buton-$id' type='submit'>
                           $blocked
                        </button>
                    </li>
                    <li class='list-group-item col-md-2'>
                        <button  value='$user->id' class='btn btn-danger delete-user del-$id' type='submit'>
                            Delete
                        </button>
                    </li>
                </ul>
                        ";
                    }
                ?>
                </div>

                <div class='d-flex justify-content-center my-3'>
                    <button  value="<?php echo $noOfUsers?>" type="button" class="btn btn-outline-primary justify-content-center load-users">Load
                        more</button>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL FOR DELETE USER-->
    <div class="modal fade" id="exampleModal-delete-user" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Are you sure you want to delete
                                it?</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger modal-delete" onclick="deleteUser()">Delete</button>
                </div>
            </div>
        </div>
    </div>

   