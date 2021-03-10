<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
  <h2 class="navbar-brand tab-list-title">
    <a href='javascript:onclick=loadStockEntry();' class="fas fa-arrow-left back-button"><span></span></a>
    <h2 class="navbar-brand" style="font-size: 35px;">New Stock Entry</h2>
  </h2>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown li-bom">
      </li>
      <li class="nav-item li-bom">
        <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="">Cancel</button>
      </li>
      <li class="nav-item li-bom">
        <button class="btn btn-primary" type="submit" onclick="">Save</button>
      </li>
    </ul>
  </div>
  </div>
</nav>
<div class="container">
  <div class="card my-2">
    <div class="card-header bg-light">
      <div class="float-right">
        <a class="dropdown-toggle btn btn-outline-light btn-sm text-muted shadow-sm " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Get Items From
        </a>
      </div>
      <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-right">
        Create Material Request
      </button>
    </div>
    <div class="card-body filter">
      <div class="row">
        <div class="col">
          <label for="">Series</label>
          <select class="form-control">
            <option>MAT-STE-.YYYY.-</option>
          </select>
        </div>
        <div class="col">
          <label for="">Posting Date</label>
          <input type="text" class="form-control" placeholder="Posting Date" value="(Current Date)" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="">Stock Entry Type</label>
          <input type="text" class="form-control" placeholder="">
        </div>
        <div class="col">
          <label for="">Posting Time</label>
          <input type="text" class="form-control" placeholder="Posting Time" value="(Current Time)" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6">
          <div class="form-check">
            <div class="row"><input class="form-check-input" type="checkbox" value="" id="">
              <label class="form-check-label" for="">Edit Posting Date and Time</label>
            </div>
            <div class="row"><input class="form-check-input" type="checkbox" value="" id="">
              <label class="form-check-label" for="">Inspection Required</label>
            </div>
            <div class="row"><input class="form-check-input" type="checkbox" value="" id="">
              <label class="form-check-label" for="">From BOM</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="card-body filter">
      <div class="row">
        <div class="col-6">
          <label for="">Default Source Warehouse</label>
          <input type="text" class="form-control" placeholder="">
        </div>
      </div>
    </div>
    <hr>
    <div class="card-body filter">
      <label>Items</label>
      <table class="table table-bom border-bottom">
        <thead class="border-top border-bottom bg-light">
          <tr class="text-muted">
            <td>
              <div class="form-check">
                <input type="checkbox" class="form-check-input">
              </div>
            </td>
            <td>Source Warehouse</td>
            <td>Target Warehouse</td>
            <td>Item Code</td>
            <td>Item Group</td>
            <td>QTY</td>
            <td></td>
          </tr>
        </thead>
        <tbody class="">
          <tr>
            <td>
              <div class="form-check">
                <input type="checkbox" class="form-check-input">1
              </div>
            </td>
            <td> Source Warehouse Example</td>
            <td>Target Warehouse Example</td>
            <td>Item Code Example</td>
            <td>Item Group Example</td>
            <td>QTY Example</td>
            <td><a class="dropdown-toggle btn btn-outline-light btn-sm text-muted shadow-sm " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <div class="container">
        <div class="row-12">
          <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-left">
            Add Multiple
          </button>
          <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-none">
            Add Row
          </button>
          <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-right">
            Upload
          </button>
          <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-right">
            Download
          </button>
        </div>
        <div class="row">
          <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-right">
            Update Rate and Availability</button>
        </div>
      </div>
    </div>
    <hr>
    <div class="card-header bg-light">
      <h4>ACCOUNTING DIMENSIONS</h4>
    </div>
    <div class="card-body filter">
      <div class="row">
        <div class="col-6">
          <label for="">Project</label>
          <input type="text" class="form-control" placeholder="">
        </div>
      </div>
    </div>

    <hr>
    <div class="card-header bg-light">
      <h4>PRINTING SETTINGS</h4>
    </div>
    <div class="card-body filter">
      <div class="row">
        <div class="col-6">
          <label for="">Print Heading</label>
          <input type="text" class="form-control" placeholder="">
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <label for="">Letter Head</label>
          <input type="text" class="form-control" placeholder="">
        </div>
      </div>
    </div>

    <hr>
    <div class="card-header bg-light">
      <h4>More Information</h4>
    </div>
    <div class="card-body filter">
      <div class="row">
        <div class="col-6">
          <label for="">Is Opening</label>
          <select class="form-control">
            <option>No</option>
            <option>Yes</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <label for="">Remarks</label>
          <textarea class="form-control" rows="6"></textarea>
        </div>
      </div>
    </div>

  </div>
</div>

</div>