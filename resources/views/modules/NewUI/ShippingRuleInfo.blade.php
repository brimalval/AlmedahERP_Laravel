<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" >
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">New Shipping Rule</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">


                <li class="nav-item li-bom">
                <button class="btn btn-refresh" style="background-color: #d9dbdb;" onclick="loadShippingInfo();" style="float: left;">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn"  style="float: left;">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="card">
<br>
<div class="container">
    <div class="row">
        <div class="col-6">
        <div class="form-group">
                  <label for="Shipping_label">Shipping Rule Label</label>
                  <input type="text" name="Shipping_label" class="form-control">
        </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                  <label for="Shipping_label">Shipping Rule Type</label>
                  <select class="form-control" required="true" name="Shipping_type" id="Shipping_type">
                    <option value="">Option 1</option>
                  </select>
            </div>
        </div>

    </div>
    <div class="row">
    <div class="col-6">
        <div class="form-check">
          <input id="include" type="checkbox" class="form-check-input" onchange="javascript:openField()">
          <label for="">Disabled</label>
        </div>
    </div>
    </div>
      <div class="container" id="cont" style="display:none;">
      <div class="row">
        <div class="col-12">
            <hr>
            <br>
            <h4>ACCOUNTING</h4>
            <br>
        </div>

        <div class="col-6">
        <div class="form-group">
                  <label for="Shipping_amount">Shipping Amount</label>
                  <input type="text" name="Shipping_amount" class="form-control">
        </div>
        </div>

    </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
            <br>
            <h4>ACCOUNTING DIMENSIONS</h4>
            <br>
        </div>
        <div class="col-6">
        <div class="form-group">
                  <label for="Cost_Center">Cost Center</label>
                  <input type="text" name="Cost_Center" class="form-control">
        </div>
        </div>
        <div class="col-6">
      
        </div>
        <div class="col-6">
        <div class="form-group">
                  <label for="Calculate_Based">Calculate Based On</label>
                  <select class="form-control" required="true" name="Shipping_type" id="Shipping_type">
                    <option value="">Option 1</option>
                  </select>
            </div>
        </div>
        <div class="col-6">
        <div class="form-group">
                  <label for="Shipping_Amount">Shipping Amount</label>
                  <input type="text" name="Shipping_Amount" class="form-control">
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
            <br>
            <h4>RESTRICT TO COUNTRIES</h4>
            <br>
        </div>
        <div class="col-8">
        <label>Valid for Countries</label>
              <table class="table border-bottom table-hover table-bordered" id="country-table">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">

                    <td class="text-center">Country</td>
             
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
        </div>
        <br>
    </div>
 </div>
</div>

<style>
    .conContent {
        padding: 200px;
    }
</style>

<script src="{{ asset('js/shippingrule.js') }}"></script>