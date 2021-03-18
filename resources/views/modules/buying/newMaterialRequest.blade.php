<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <script>
    function addRow(){

      if($('#no-data')[0]){
        $('#no-data').remove();
      }
      let table = $('#material-request-input-rows');
      let lastRow = table[0].rows.length;
      table.append(
      `<tr>
          <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input">
            </div>
          </td>
          <td><input class="form-control" type="text" name="item_code" id="mr-code-input-row-${lastRow}"></td>
          <td><input class="form-control" min="0" type="number" name="quantity_requested" id="mr-qty-input-row-${lastRow}"></td>
          <td><input class="form-control" type="number" name="uom_id" id="mr-uom-input-row-${lastRow}"></td>
          <td><input class="form-control" type="text" name="purpose" id="mr-purp-input-row-${lastRow}"></td>
        </tr>`);
    }
    $(document).ready(function(){
      // Making sure that none of the buttons inside the form submit it,
      // only the button outside of the form ("save" button) can submit
      $('#mat-req button').each(function(index){
        $(this).attr('type', 'button');
      });
      $('#mat-req').submit(function(){
        $.ajax({
           type: 'POST',
           url: this.action,
           data: new FormData(this),
           contentType: false,
           processData: false,
           cache: false,
           success: function(data){
             console.log(data);
           },
           error: function(data){
             console.log("error");
             console.log(data);
           }
        });
        return false;
      });
    });
  </script>
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadMaterialRequest();">Cancel</button>
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

<form action="/materialrequest" method="post" id="mat-req">
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
    <div id="Dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <!--dashboard contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form">
            @csrf --}}
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
                  <label for="required_date">Required Date</label>

                  <input type="date" name="required_date" id="required_date" class="form-control">
                </div>
              </div>

              <div class="col-6">
                <div class="input-group">
                  <label class="label">Type</label>
                  <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
                    <option>Purchase</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                  </select>
                </div>
              </div>

              <div class="col-12">
                <hr>
              </div>
              <br>
              <label>Item</label>
              <table class="table border-bottom table-hover table-bordered">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td>Item Code</td>
                    <td>Quantity</td>
                    <td>UOM ID</td>
                    <td>Purpose</td>

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
                <button class="btn btn-sm btn-sm btn-secondary">Add Multiple</button>
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
    <div id="Item" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <!--moreinfo contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="compnay">Requested For</label>

                  <input type="text" name="company" class="form-control">
                </div>
              </div>

              <div class="col-6">
                <div class="input-group">
                  <label class="label">Status</label>
                  <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
                    <option>Draft</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                  </select>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="transaction_date">Transaction Date</label>

                  <input type="date" name="transaction_date" id="transaction_date" class="form-control">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="station_id">Station ID</label>

                  <input type="text" name="station_id" id="station_id" class="form-control">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="">Procurement Method</label>
                  <select class="form-control" name="procurement_method" id="procurement_method">
                    <option value="buy">Buy</option>
                    <option value="produce">Produce</option>
                    <option value="buyproduce">Buy & Produce</option>
                  </select>
                </div>
              </div>
          {{-- </form> --}}
        </div>
        <!--end contents-->
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
        <!--printingdetails content-->
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
        <!--end contents-->
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
        <!--terms content-->
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