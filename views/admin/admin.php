
        <!--CONTENT-->
        <div class="content container">
          <div class="info my-4 font-size">
            <div class="row">
              <div class="col">
                <span class="font-size-30">Administrator</span>
                <p class="font-size-20 my-3">Add</p>
              </div>
              <div class="col d-flex flex-row-reverse height-fit-content">
                <button class="btn btn-success add-cat">ADD ADMIN</button>
              </div>
            </div>

            <!--THIS IS A ADMIN FORM-->
            <form class="col-sm-4" hidden>
                <div class="mb-3">
                  <label for="exampleEmail" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleEmail" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleUsername">
                  </div>
                <div class="mb-3">
                  <label for="examplePassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="examplePassword">
                </div>
                <div class="mb-3">
                    <label for="examplePasswordConfirm" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="examplePasswordConfirm">
                  </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-secondary">Cancel</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
              </form>
            <!--THIS IS THE END OF AN ADMIN FORM-->

            <div class="input-group ">
              <input type="search" class="form-control rounded" placeholder="Search administrator" aria-label="Search"
                aria-describedby="search-addon" />
              <button type="button" class="btn btn-outline-primary">search</button>
            </div>

            <div class="list-unstyled mt-5">
              <ul class="list-group list-group-horizontal py-1">
                <li class="list-group-item col-md-12">Admin username</li>
              </ul>
              <!--User data-->
              <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-md-12">
                  <span>username</span>
                </li>
              </ul>
            </div>
            <div class='d-flex justify-content-center my-3'>
              <button type="button" class="btn btn-outline-primary justify-content-center">Load more</button>
            </div>
          </div>
        </div>
