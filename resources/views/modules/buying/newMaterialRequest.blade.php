
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
  <h2 class="navbar-brand" style="font-size: 35px;">New Material Request</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse"  id="responsive">
      <ul class="navbar-nav ml-auto">
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
              <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;">Save</button>
          </li>
      </ul>
    </div>
  </div>
</nav>

<div class="card">
    <div class="card-body ml-auto">
     
     
     <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Get Items from
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <a class="dropdown-item" href="#">Bill of Materials</a>
    <a class="dropdown-item" href="#">Sales Order</a>
    <a class="dropdown-item" href="#">Product Bundle</a>
  </div>
        
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
        <?php include 'materialReqmodules/dashboard.php' ?> 
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
        <?php include 'materialReqmodules/moreinfo.php' ?>
      </div>
    </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Currency" aria-expanded="false" aria-controls="Currency">
          Priting Details
        </button>
      </h5>
    </div>
    <div id="Currency" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'materialReqmodules/printingdetails.php' ?>
      </div>
    </div>
    </div>

    

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#comm" aria-expanded="false" aria-controls="comm">
          Terms and Conditions
        </button>
      </h5>
    </div>
    <div id="comm" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'materialReqmodules/terms.php' ?>
      </div>
    </div>
    </div>

</div>
</div>
