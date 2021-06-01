<!DOCTYPE>
<html>

<head>
  <title>$current</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/images/logo-icon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <link rel="stylesheet" href="/css/admin.css">
  <script src="https://kit.fontawesome.com/c355012b63.js" crossorigin="anonymous"></script>
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 p-0">
        <!--SIDEBAR-->
        <div class="sidebar bg-dark">
          <div class="d-flex flex-column align-items-center align-items-sm-start pt-2 text-white min-vh-100">
            <a href="/"
              class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none p-3 m-1">
              <span class="fs-5 d-none d-sm-inline">
                <img src="/images/logo xl.png" width="70%" alt="" class="img-fluid">
              </span>
            </a>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mx-4"
              id="menu">

              <?php if($current="Users") { ?>
                <li class="font-bold">

                <?php } else { ?>
                    <li >

                <?php  } ?>
                <span class="nav-link align-middle px-0 mt-2 text-white">
                  <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline menu-bg">User</span>
                </span>
                <ul class="collapse show nav flex-column ms-1 list-unstyled px-4" id="user-menu" data-bs-parent="#menu">
                  <li class="w-100">
                    <a href="/admin/users" class="nav-link px-0 text-white"> <span
                        class="d-none d-sm-inline">Block/Delete</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li >
                <span data-bs-toggle="collapse" class="nav-link px-0 align-middle"></span>
                <i class="fs-4 bi-bootstrap"></i>
                <span class="ms-1 d-none d-sm-inline text-white menu-bg">Category</span></a>
                <ul class="collapse show nav flex-column ms-1 list-unstyled px-4" id="category-menu"
                  data-bs-parent="#menu">
                  <li class="w-100">
                    <a href="admin_category.html" class="nav-link px-0 text-white"> <span
                        class="d-none d-sm-inline">Add/Edit/Delete</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                <span data-bs-toggle="collapse" class="nav-link px-0 align-middle"></span>
                <i class="fs-4 bi-grid"></i> <span
                  class="ms-1 d-none d-sm-inline text-white menu-bg">Notification</span>
                </a>
                <ul class="collapse show nav flex-column ms-1 list-unstyled px-4" id="notif-menu"
                  data-bs-parent="#menu">
                  <li class="w-100">
                    <a href="admin_notif.html" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Create
                        new</span>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li>
                <span data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                  <i class="fs-4 bi-grid"></i> </span>
                <span class="ms-1 d-none d-sm-inline text-white menu-bg">Administrator</span>
                </a>
                <ul class="collapse show nav flex-column ms-1 list-unstyled px-4" id="admin-menu"
                  data-bs-parent="#menu">
                  <li class="w-100">
                    <a href="admin.html" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Add new</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <hr>
            <div class="pb-4 mx-4" id="logout">
              <a href="/logout" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline text-white">Logout</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      {{content}}
    </div>
  </div>

<!-- 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <script src="/js/admin.js"></script>
</body>

</html>