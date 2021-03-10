<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">Emulsifier Adjusting Cap</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown li-bom">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Edit</a></li>
            <li><a class="dropdown-item" href="#">Delete</a></li>
          </ul>
        </li>
        <li class="nav-item li-bom">
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadInv();">Refresh</button>
        </li>
        <li class="nav-item li-bom">
          <button class="btn btn-primary" type="submit" onclick="loadNewBOM()">New</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="accordion" id="accordion">
  <div class="card">
    <div class="card-header" id="heading1">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#dashboard" aria-expanded="true">
      DASHBOARD
      </button>
      </h2>
    </div>
    <div id="dashboard" class="collapse show">
      <div class="card-body">
        <?php include 'invSubModules/dashboard.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div id="dashboard" class="collapse show">
      <div class="card-body">
        <?php include 'invSubModules/dashboard2.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading2">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#description" aria-expanded="false">
      DESCRIPTION
      </button>
      </h2>
    </div>
    <div id="description" class="collapse" aria-labelledby="heading2">
      <div class="card-body">
        <?php include 'invSubModules/description.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading3">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#inventory" aria-expanded="false">
      INVENTORY
      </button>
      </h2>
    </div>
    <div id="inventory" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/inventory.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading4">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#auto-re" aria-expanded="false">
      AUTO RE-ORDER
      </button>
      </h2>
    </div>
    <div id="auto-re" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/auto-reorder.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading5">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#units-measure" aria-expanded="false">
      UNITS OF MEASURE
      </button>
      </h2>
    </div>
    <div id="units-measure" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/unit-measure.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading6">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#serial-nos" aria-expanded="false">
      SERIAL NOS AND BATCHES
      </button>
      </h2>
    </div>
    <div id="serial-nos" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/serials.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading7">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#variants" aria-expanded="false">
      VARIANTS
      </button>
      </h2>
    </div>
    <div id="variants" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/variants.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading8">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#sales" aria-expanded="false">
      SALES, PURCHASE, ACCOUNTING DEFAULTS
      </button>
      </h2>
    </div>
    <div id="sales" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/sal-pur-acc.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading9">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#replenish" aria-expanded="false">
      PURCHASE REPLENISHMENT DETAILS
      </button>
      </h2>
    </div>
    <div id="replenish" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/purchase-replenish.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading10">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#supplier-details" aria-expanded="false">
      SUPPLIER DETAILS
      </button>
      </h2>
    </div>
    <div id="supplier-details" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/supplier-details.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading11">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#foreign-trade" aria-expanded="false">
      FORIEGN TRADE DETAILS
      </button>
      </h2>
    </div>
    <div id="foreign-trade" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/foreign-trade.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading12">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#sales-details" aria-expanded="false">
      SALES DETAILS
      </button>
      </h2>
    </div>
    <div id="sales-details" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/sales-details.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading13">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#deffered-expense" aria-expanded="false">
      DEFFERED REVENUE
      </button>
      </h2>
    </div>
    <div id="deffered-expense" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/deffered-rev.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading14">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#cust-details" aria-expanded="false">
      CUSTOMER DETAILS
      </button>
      </h2>
    </div>
    <div id="cust-details" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/customer-details.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading15">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#item-tax" aria-expanded="false">
      ITEM TAX
      </button>
      </h2>
    </div>
    <div id="item-tax" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/item-tax.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading16">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#inspec-criteria" aria-expanded="false">
      INSPECTION CRITERIA
      </button>
      </h2>
    </div>
    <div id="inspec-criteria" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/inspection-criteria.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading17">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#manufacturing" aria-expanded="false">
      MANUFACTURING
      </button>
      </h2>
    </div>
    <div id="manufacturing" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/manufacturing.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading18">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#web" aria-expanded="false">
      WEBSITE
      </button>
      </h2>
    </div>
    <div id="web" class="collapse">
      <div class="card-body">
        <?php include 'invSubModules/website.php'?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading18">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-target="#web" aria-expanded="true">
      HUB PUBLISHING DETAILS
      </button>
      </h2>
    </div>
    <div id="hub-publishing">
      <div class="card-body">
        <?php include 'invSubModules/hub-publishing.php'?>
      </div>
    </div>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header row">
    <h5 class="mt-2 col-10 text-muted h-100">
    Add Comment
    </h5>
    <div class="mb-0 col-2">
      <button class="btn btn-secondary btn-sm">Add Comment</button>
    </div>
  </div>
  <div class="row">
    <div class="col-12 form-group">
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" style="border:0;"></textarea>
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