<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand tab-list-title">
      <h2 class="navbar-brand" style="font-size: 35px;">BOM-PR-EM-ADJ CAP-002</h2>
    </h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="responsive">
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadMaterialRequest();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" " style=" float: left;">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="card">
  <div class="card-body ml-auto">


    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Create
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <a class="dropdown-item" href="#">Purchase Order</a>
      <a class="dropdown-item" href="#">Request for Quotation</a>
      <a class="dropdown-item" href="#">Supplier Quotation</a>
    </div>
    <a href="#" class="btn btn-light" role="button">Stop</a>
  </div>
</div>

<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          Dashboard
        </button>
      </h5>
    </div>
    <div id="Dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <?php include 'materialReqInfo/dashboard.php' ?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Item" aria-expanded="false" aria-controls="Item">
          More Information
        </button>
      </h5>
    </div>
    <div id="Item" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <?php include 'materialReqInfo/moreinfo.php' ?>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Currency" aria-expanded="false" aria-controls="Currency">
          Printing Details
        </button>
      </h5>
    </div>
    <div id="Currency" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'materialReqInfo/printingdetails.php' ?>
      </div>
    </div>
  </div>



  <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#comm" aria-expanded="false" aria-controls="comm">
          Comment
        </button>
      </h5>
    </div>
    <div id="comm" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'materialReqInfo/comment.php' ?>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row d-flex justify-content-left">
  <div class="col-md-12">
    <div id="content">
      <ul class="timeline">
        <li class="event">
          <p>New Email</p>
          <p></p>
        </li>
        <li class="event">
          <p><span style="color: green;">+5</span> gained by You Via On Rule Item Creation - 9 months ago</p>
          <p></p>
        </li>
        <li class="event">
          <p>You Created - 9 Months ago</p>
          <p></p>
        </li>
      </ul>
    </div>
  </div>
</div>