<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
  <div class="container-fluid">
    <h2 class="navbar-brand tab-list-title">
      <a href='javascript:onclick=loadSalesOrder();' class="fas fa-arrow-left back-button"><span></span></a>
      <h2 class="navbar-brand" style="font-size: 35px;">Emulsifier</h2>
    </h2>
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="">Refresh</button>
        </li>
        <li>
          <button type="button" class="btn btn-primary" data-target="#saveSale">
            Save
          </button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-6">
      <div class="input-group">
        <label class="label">Series</label>
        <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
          <option>Option 1</option>
          <option>Option 2</option>
          <option>Option 3</option>
        </select>
      </div>
    </div>

    <div class="col-6">
      <div class="form-group">
        <label for="compnay">Company</label>

        <input type="text" name="company" class="form-control" value="Almedah Food Equipments">
      </div>
    </div>

    <div class="col-6">
      <div class="form-group">
        <label for="fname">Customer</label>
        <input type="text" name="fname" class="form-control">
      </div>
    </div>

    <div class="col-6">
      <div class="form-group">
        <label for="fname">Date</label>
        <input type="date" name="fname" class="form-control">
      </div>
      <div class="row">
        <div class="form-check">
          <input type="checkbox" class="form-check-input">
        </div>
        <label for="">Edit Posting Date and Time</label>

      </div>
    </div>
    <script type="text/javascript">
      function openField() {
        var check = document.getElementById('include');
        if (check.checked) {
          document.getElementById('cont').style.display = 'block';
        } else
          document.getElementById('cont').style.display = 'none';
      }
    </script>
    <div class="col-6">

      <div class="row">


        <div class="form-check">
          <input id="include" type="checkbox" class="form-check-input" onchange="javascript:openField()">
        </div>
        <label for="">Include Payment (POS)</label>

      </div>
      <div id="cont" style="display:none;">
        <label for="">POS Profile</label>
        <input type="text" name="" class="form-control">
      </div>


      <div class="row">
        <div class="form-check">
          <input type="checkbox" class="form-check-input">
        </div>
        <label for="">Is Return (Credit None)</label>

      </div>
    </div>

    <div class="col-6">
      <div class="form-group">
        <label for="joiningdate">Payment Due Date</label>
        <input type="date" name="" class="form-control">
      </div>
    </div>

    <div class="col-6">

    </div>
  </div>
</div>

<div class="accordion" id="accordion">
  <div class="card">
    <div class="card-header" id="heading1">
      <h2 class="mb-0">
        <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#accountingD" aria-expanded="false">
          ACCOUNTING AND DIMENSIONS
        </button>
      </h2>
    </div>
    <div id="accountingD" class="collapse">
      <div class="card-body">
        @include('modules.selling.salesinvoiceSubModules.accountingdimensions')
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading2">
      <h2 class="mb-0">
        <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#customerPO" aria-expanded="false">
          CUSTOMER PO DETAILS
        </button>
      </h2>
    </div>
    <div id="customerPO" class="collapse" aria-labelledby="heading2">
      <div class="card-body">
        @include('modules.selling.salesinvoiceSubModules.customerPo')
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading3">
      <h2 class="mb-0">
        <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#addresscontact" aria-xpanded="false">
          ADDRESS AND CONTACT
        </button>
      </h2>
    </div>
    <div id="addresscontact" class="collapse">
      <div class="card-body">
        @include('modules.selling.salesinvoiceSubModules.addresscontact')
        <div class="col-12"><br></div>
        <div class="col-12">
          <hr>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="col-12"><br></div>
      <div class="col-6">
        <div class="row">
          <div class="form-check">
            <input type="checkbox" class="form-check-input">
          </div>
          <label for="">Update Stock</label>
        </div>
      </div>

      <table class="table border-bottom table-hover table-bordered">
        <thead class="border-top border-bottom bg-light">
          <tr class="text-muted">
            <td>
              <div class="form-check">
                <input type="checkbox" class="form-check-input">
              </div>
            </td>
            <td>Item</td>
            <td>Quantity</td>
            <td>Rate</td>
            <td>Amount</td>
            <td></td>

          </tr>
        </thead>
        <tbody class="">
          <tr>
            <td>
              <div class="form-check">
                <input type="checkbox" class="form-check-input">
              </div>
            </td>
            <td></td>
            <td> 0 </td>
            <td>P 0.00</td>
            <td>P 0.00</td>
            <td>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">

              </a>
            </td>
          </tr>
          <tr>
            <td colspan="6" rowspan="5">
              <button class="btn btn-sm btn-sm btn-secondary">Add Multiple</button>
              <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              <button class="btn btn-sm btn-sm btn-secondary">Download</button>
              <button class="btn btn-sm btn-sm btn-secondary">Upload</button>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>


  <div class="card">
    <div class="card-header" id="heading4">
      <h2 class="mb-0">
        <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#timesheet" aria-expanded="false">
          TIME SHEET LIST
        </button>
      </h2>
    </div>
    <div id="timesheet" class="collapse">
      <div class="card-body">
        @include('modules.selling.salesinvoiceSubModules.timesheet')
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12"><br></div>
        <div class="col-6">
          <div class="form-group">
            <label for="compnay">Total Quantity</label>
            <input type="text" name="" class="form-control" value="0">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="compnay">Total (PHP)</label>
            <input type="text" name="" class="form-control" value="P 0.00">
          </div>
        </div>
        <div class="col-6">

        </div>

        <div class="col-6">
          <div class="form-group">
            <label for="compnay">Total Net Weight</label>
            <input type="text" name="" class="form-control" value="0">
          </div>
        </div>
      </div>
      <div class="col-12">
        <hr>
      </div>
      <div class="col-12"><br></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="compnay">Sales Taxes and Charges Template</label>
            <input type="text" name="" class="form-control" value="">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="compnay">Shipping Rule</label>
            <input type="text" name="" class="form-control" value="">
          </div>
        </div>
        <div class="col-6">

        </div>

        <div class="col-6">
          <div class="form-group">
            <label for="compnay">Tax Category</label>
            <input type="text" name="" class="form-control" value="">
          </div>
        </div>
      </div>

    </div>

    <div class="container">
      <label>Sales Taxes and Charges</label>
      <table class="table border-bottom table-hover table-bordered">
        <thead class="border-top border-bottom bg-light">
          <tr class="text-muted">
            <td>
              <div class="form-check">
                <input type="checkbox" class="form-check-input">
              </div>
            </td>
            <td>Type</td>
            <td>Account Head</td>
            <td>Rate</td>
            <td>Amount</td>
            <td>Total</td>
            <td></td>
          </tr>
        </thead>
        <tbody class="">
          <tr>
            <td colspan="7" style="text-align: center;">NO DATA</td>
          </tr>
          <tr>
            <td colspan="7" rowspan="5">
              <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
            </td>
          </tr>

        </tbody>
      </table>
      <div class="col-12">
        <hr>
      </div>
      <div class="col-12"> <br></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-6">

        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="compnay">Total Taxes and Charges (PHP)</label>
            <input type="text" name="" class="form-control" value="P 0.00">
          </div>
        </div>
      </div>

    </div>
    <div class="card">
      <div class="card-header" id="heading5">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#loyaltypoints" aria-expanded="false">
            LOYALTY POINTS REDEMPTION
          </button>
        </h2>
      </div>
      <div id="loyaltypoints" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.loyaltypoints')
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="heading6">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#additionaldisc" aria-expanded="false">
            ADDITIONAL DISCOUNTS
          </button>
        </h2>
      </div>
      <div id="additionaldisc" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.adddiscounts')
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-12">
            <hr>
          </div>
          <div class="col-12"><br></div>

          <div class="col-6">

          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="compnay">Grand Total (PHP)</label>
              <input type="text" name="" class="form-control" value="P 0.00">
            </div>
          </div>
          <div class="col-6">

          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="compnay">Rounding Adjustment (PHP)</label>
              <input type="text" name="" class="form-control" value="P 0.00">
            </div>
          </div>
          <div class="col-6">

          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="compnay">Rounded Total (PHP)</label>
              <input type="text" name="" class="form-control" value="P 0.00">
            </div>
          </div>
          <div class="col-6">

          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="compnay">Total Advance (PHP)</label>
              <input type="text" name="" class="form-control" value="P 0.00">
            </div>
          </div>
          <div class="col-6">

          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="compnay">Outstanding Amount (PHP)</label>
              <input type="text" name="" class="form-control" value="P 0.00">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="heading7">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#advancepayments" aria-expanded="false">
            ADVANCE PAYMENTS
          </button>
        </h2>
      </div>
      <div id="advancepayments" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.advancepayments')
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="heading8">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#paymentterms" aria-expanded="false">
            PAYMENT TERMS
          </button>
        </h2>
      </div>
      <div id="paymentterms" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.paymentterms')
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="heading9">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#termsconditions" aria-expanded="false">
            TERMS AND CONDITIONS
          </button>
        </h2>
      </div>
      <div id="termsconditions" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.termsconditions')
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="heading10">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#printingsettings" aria-expanded="false">
            PRINTING SETTINGS
          </button>
        </h2>
      </div>
      <div id="printingsettings" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.printingsettings')
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="heading11">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#accountingdetails" aria-expanded="false">
            ACCOUNTING DETAILS
          </button>
        </h2>
      </div>
      <div id="accountingdetails" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.accountingdetails')
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="heading12">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#commission" aria-expanded="false">
            COMMISSION
          </button>
        </h2>
      </div>
      <div id="commission" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.commission')
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="heading13">
        <h2 class="mb-0">
          <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#salesteam" aria-expanded="false">
            SALES TEAM
          </button>
        </h2>
      </div>
      <div id="salesteam" class="collapse">
        <div class="card-body">
          @include('modules.selling.salesinvoiceSubModules.salesteam')
          <div class="col-12">
            <hr>
          </div>
        </div>
      </div>
      <div class="container">

        <div class="col-12"><br></div>
        <label for="">SUBSCRIPTION SECTION</label>
        <div class="col-6">
          <div class="form-group">
            <label for="">From Date</label>
            <input type="date" name="" class="form-control" value="">
          </div>
        </div>
        <div class="col-6">

        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="">To Date</label>
            <input type="date" name="" class="form-control" value="">
          </div>
        </div>
      </div>

    </div>