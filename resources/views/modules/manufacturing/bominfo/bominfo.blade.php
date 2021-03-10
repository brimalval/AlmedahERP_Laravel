
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
  <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadBOM();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">BOM-PR-EM-ADJ CAP-002</h2>
    </h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse"  id="responsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item mt-2">
            <a href="" class="nav-link bg-light">
                    <span class="fas fa-print"></span>
            </a>
        </li>
        <li class="nav-item mt-2">
            <a href="" class="nav-link bg-light">
                    <span class="fas fa-angle-left"></span>
            </a>
        </li>
         <li class="nav-item mt-2">
            <a href="" class="nav-link bg-light">
                    <span class="fas fa-angle-right"></span>
            </a>
        </li>
        <li class="nav-item dropdown li-bom">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Menu
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#">Option 1</a></li>
                  <li><a class="dropdown-item" href="#">Option 2</a></li>
              </ul>
          </li>
        </li>
        <li class="nav-item li-bom">
            <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="card">
    <div class="card-body ml-auto">
     <a href="#" class="btn btn-light" role="button">Update Cost</a>
     <a href=browsebom.php class="btn btn-light" role="button">Browse BOM</a>
     <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Create
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <a class="dropdown-item" href="#">...</a>
    <a class="dropdown-item" href="#">...</a>
    <a class="dropdown-item" href="#">...</a>
  </div>
    </div>
</div>

<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          DASHBOARD
        </button>
      </h5>
    </div>
    <div id="Dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <?php include 'dashboard.php' ?> 
      </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Item" aria-expanded="false" aria-controls="Item">
          ITEM
        </button>
      </h5>
    </div>
    <div id="Item" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <?php include 'item.php' ?>
      </div>
    </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Currency" aria-expanded="false" aria-controls="Currency">
          CURRENCY
        </button>
      </h5>
    </div>
    <div id="Currency" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'currency.php' ?>
      </div>
    </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Operation" aria-expanded="false" aria-controls="Operation">
          OPERATION
        </button>
      </h5>
    </div>
    <div id="Operation" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'operations.php' ?>
      </div>
    </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Materials" aria-expanded="false" aria-controls="Materials">
          MATERIALS
        </button>
      </h5>
    </div>
    <div id="Materials" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'materials.php' ?>
      </div>
    </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Costing" aria-expanded="false" aria-controls="Costing">
          COSTING
        </button>
      </h5>
    </div>
    <div id="Costing" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'costing.php' ?>
      </div>
    </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#matreq" aria-expanded="false" aria-controls="matreq">
          MATERIALS REQUIRED
        </button>
      </h5>
    </div>
    <div id="matreq" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'materialsreq.php' ?>
      </div>
    </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#comm" aria-expanded="false" aria-controls="comm">
          COMMENT
        </button>
      </h5>
    </div>
    <div id="comm" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'comment.php' ?>
      </div>
    </div>
    </div>

</div>
</div>
