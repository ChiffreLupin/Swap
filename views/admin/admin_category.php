
  <div class="col-md-10">
    <!--CONTENT-->
    <div class="content container">
      <div class="info my-4 font-size">
        <div class="row">
          <div class="col">
            <span class="font-size-30">CATEGORY</span>
            <p class="font-size-20 my-3">Add/Edit/Delete</p>
          </div>
          <div class="col d-flex flex-row-reverse height-fit-content">
            <button class="btn btn-success add-cat">ADD CATEGORY</button>
          </div>
        </div>

        <div class="input-group ">
          <input type="search" class="form-control rounded" placeholder="Search category" aria-label="Search"
            aria-describedby="search-addon" />
          <button type="button" class="btn btn-outline-primary">search</button>
        </div>

        <div class="list-unstyled mt-5">
          <ul class="list-group list-group-horizontal py-1">
            <li class="list-group-item col-md-8">Category name</li>
            <li class="list-group-item col-md-2">Edit</li>
            <li class="list-group-item col-md-2">Delete</li>
          </ul>
          <!--User data-->
          <ul class="list-group list-group-horizontal">
            <li class="list-group-item col-md-8">
              <span>Category one</span>
            </li>
            <li class="list-group-item col-md-2">
              <button class="btn btn-primary edit" type="submit">
                Edit
              </button>
            </li>
            <li class="list-group-item col-md-2">
              <button class="btn btn-danger delete" type="submit">
                Delete
              </button>
            </li>
          </ul>
        </div>
        <div class='d-flex justify-content-center my-3'>
          <button type="button" class="btn btn-outline-primary justify-content-center">Load more</button>
        </div>
      </div>
    </div>
  </div>


  <!--MODAL FOR EDIT CATEGORY-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Category name:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!--MODAL FOR DELETE CATEGORY-->
  <div class="modal fade" id="exampleModal-danger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Are you sure you want to delete it?</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!--MODAL TO ADD A PRODUCT-->
  <div class="modal fade" id="exampleModal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Category name:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <!--
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Category na</label>
                  <textarea class="form-control" id="message-text"></textarea>
                </div>
                -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success">Create new</button>
        </div>
      </div>
    </div>
  </div>

