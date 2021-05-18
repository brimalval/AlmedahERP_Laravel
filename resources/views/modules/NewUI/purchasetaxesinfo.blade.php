<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand tab-list-title">
      <h2 class="navbar-brand" style="font-size: 35px;">New Purchase Taxes</h2>
    </h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="responsive">
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadPurchaseTaxes();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" " style=" float: left;">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

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
        <!--dashboard-->
        <div class="container">
          <form id="purchasetaxes" name="purchasetaxes" role="form">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" name="Title" class="form-control">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="Tax_Category">Tax Category</label>

                  <input type="text" name="Tax_Category" class="form-control">
                </div>
              </div>
              <div class="col-6">
                     <div class="form-check">
                         <input id="include" type="checkbox" class="form-check-input">
                         <label for="">Default</label>
                    </div>
                    <div class="form-check">               
                         <input id="include" type="checkbox" class="form-check-input">
                         <label for="">Disabled</label>
                    </div>
              </div>
              <div class="col-12">
                <hr>
              </div>
              <br>
              <label>Purchase Taxes and Charges</label>
              <table class="table border-bottom table-hover table-bordered" id="purchasetaxes-table">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">

                    <td>Type</td>
                    <td>Account Head</td>
                    <td>Rate</td>
                    <td>Amount</td>
                    <td>Total</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="material-request-input-rows">
                  <tr>
                    <td id="no-data" colspan="7" style="text-align: center;">
                      NO DATA
                    </td>
                  </tr>
                </tbody>
              </table>
              <td colspan="7" rowspan="5">
                <button type="button" onclick="addnewRow()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              </td>
          </form>
        </div>
        <!--end-->
      </div>
    </div>
  </div>
 
<script src="{{ asset('js/purchasetaxestable.js') }}"></script>