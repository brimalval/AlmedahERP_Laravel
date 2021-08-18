<div class="accordion" id="accordion">
  <div class="card">
    <div class="card-header" id="heading1">
      <h2 class="mb-0">
        <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse"
          data-target="#InfomationStockTrace" aria-expanded="true">
          INFORMATION
        </button>
      </h2>
    </div>
    <div class="collapse show" id="InfomationStockTrace">
      <div class="card-body">
        <form action="" id="saleCustomerForm">
          <div class="row">
            <div class="col">
              <br>
              <label class=" text-nowrap align-middle">
                Stock Trace ID
              </label>
              <div class="d-flex">
                <input type="text" class="form-input form-control" max="6" value="STK-TRACE-000003" id="traceID"
                  disabled>
              </div>
              <br>
              <label class=" text-nowrap align-middle">
                Tracking ID
              </label>
              <div class="d-flex">
                <input type="text" required class="form-input form-control" id="TrackingID" required>
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
            <div class="col">
              <br>
              <label class=" text-nowrap align-middle">
                Employee ID
              </label>
              <input type="text" required class="form-input form-control" id="EmpID" value="EMP003" disabled>
              <br>
              <label class=" text-nowrap align-middle">
                Date Borrowed
              </label>
              <input type="datetime-local" class="form-input form-control" id="borrowTime">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="card-header" id="heading1">
      <h2 class="mb-0">
        <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#ProductStockTrace"
          aria-expanded="true">
          TOOLS TO BORROW
        </button>
      </h2>
    </div>
    <div class="collapse show" id="ProductStockTrace">
      <div class="card-body">
        <form action="" id="saleCustomerForm">
          <table id="borrowedProductsTable" class="display" style="width:100%">
            <thead>
              <tr>
                <th>Item Code</th>
                <th>Quantity</th>
              </tr>
            </thead>

          </table>
          <button type="button" class="btn btn-primary" id="addRow">
            Add Row
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    var t = $('#borrowedProductsTable').DataTable();
    $('#addRow').on('click', function () {
      t.row.add($('<tr><td><select class="form-control"><option selected disabled>Choose a tool</option><option>Tool1</option><option>Tool2</option><option>Tool3</option></select></td><td><input type="number" class="form-input form-control" min="0" id="borrowQuantity"></td></tr>')[0]).draw();
    });

    // Automatically add a first row of data
    $('#addRow').click();
  });
</script>