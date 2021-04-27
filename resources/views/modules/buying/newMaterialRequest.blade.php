<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">New Material Request</h2>
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadIntoPage(this, '{{ route('materialrequest.index') }}')">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;" onclick="$('#mat-req').submit();">Save</button>
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

<form action="{{ route('materialrequest.store') }}" method="post" id="mat-req" class="create">
@csrf
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          Dashboard
        </button>
      </h5>
    </div>
    <div id="Dashboard" class="collapse show" aria-labelledby="headingOne">
      <div class="card-body">
        <!--dashboard contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form">
            @csrf --}}
            <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="request_id">Request ID</label>

                    <input type="text" value="MAT-MR-.YYYY.-" readonly id="request_id" class="form-control">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="required_date">Required Date</label>

                    <input type="date" required="true" name="required_date" id="required_date" class="form-control">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="purpose">Purpose</label>

                    <input type="text" name="purpose" id="purpose" class="form-control">
                  </div>
                </div>
              </div>
      

              <div class="col-12">
                <hr>
              </div>
              <br>
              <label>Item</label>
              <table class="table border-bottom table-hover table-bordered items-tbl" id="items-tbl">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td class="text-center">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td class="text-center">Item Code</td>
                    <td class="text-center">Quantity</td>
                    <td class="text-center">Unit</td>
                    <td class="text-center">Target Station</td>
                    <td class="text-center"> Procurement Method</td>
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
                <button type="button" onclick="addRow()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              </td>
          {{-- </form> --}}

        </div>
        <!--end contents-->
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
    <div id="Item" class="collapse" aria-labelledby="headingTwo">
      <div class="card-body">
        <!--moreinfo contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
            <div class="row">
              
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="">Type</label>
                  <select class="form-control" required="true" name="mr_status" readonly id="procurement_method">
                    <option value="Draft">Draft</option>
                  </select>
                </div>
              </div>
          {{-- </form> --}}
        </div>
        <!--end contents-->
      </div>
    </div>
  </div>
<!-- UNNECESSARY FIELDS
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
        <!--printingdetails content
        <div class="container">
          <form id="contactForm" name="contact" role="form">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="compnay">Letter Head</label>

                  <input type="text" name="letter head" class="form-control">
                </div>
              </div>

              <div class="col-6">

              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="compnay">Print Heading</label>

                  <input type="text" name="Status" class="form-control">
                </div>
              </div>
              <br>
          </form>
        </div>
        <!--end contents
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
        <!--terms content
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="compnay">Terms</label>

                  <input type="text" name="letter head" class="form-control">
                </div>
              </div>
              <div class="col-6">
              </div>
              <div class="col-12">
                <div class="row">
                  <div class="col">
                    <label for="summernote">Terms and Conditions Content</label>
                    <textarea id="summernote" name="editordata"></textarea>
                  </div>
                </div>
              </div>
              <br>
              <script src="{{ asset('js/inventory.js') }}"></script>
          {{-- </form> --}}
        </div>
        <!--end content-->
      </div>
    </div>
  </div>

</div>
</form>
</div>
@include('modules.buying.materialReqmodules.selectpickers')
@include('modules.buying.materialReqmodules.edit_item_modal')