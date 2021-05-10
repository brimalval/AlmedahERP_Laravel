<script src="{{ asset('js/address.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">Address Info</h2>
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadAddress();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;" onclick="loadAddress();">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="card">
  <div class="card-body ml-auto">


    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Links
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <a class="dropdown-item" href="#">Link1</a>
      <a class="dropdown-item" href="#">Link2</a>
      <a class="dropdown-item" href="#">Link3</a>
    </div>

  </div>
</div>

<form action="#" method="post" id="address" class="create">
@csrf
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          Address Information
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
                    <label for="address_title">Address Title</label>

                    <input type="text" name="address_title" id="address_title" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                <div class="form-group">
                  <label for="address_type">Address Type</label>
                  <select class="form-control" name="address_type" >
                    <option value="Type1">Type1</option>
                    <option value="Type2">Type2</option>
                    <option value="Type3">Type3</option>
                  </select>
                </div>
              </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="address_line_1">Address Line 1</label>
                    <input type="text" name="address_line_1" id="address_line_1" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="fax">Fax</label>
                    <input type="text" name="fax" id="fax" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="address_line_2">Address Line 2</label>
                    <input type="text" name="address_line_2" id="address_line_2" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="tax_category">Tax Category</label>
                    <input type="text" name="tax_category" id="tax_category" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="city">City/Town</label>
                    <input type="text" name="city" id="city" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        Preferred Billing Address
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                        Preferred Shipping Address
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                        Disabled
                        </label>
                    </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="county">County</label>
                    <input type="text" name="county" id="county" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <!--EMPTY ROW -->
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <!--EMPTY ROW -->
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" value="Philippines" readonly name="country" id="country" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <!--EMPTY ROW -->
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" name="postal_code" id="postal_code" class="form-control">
                  </div>
                </div>

            </div>
      

              
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
            
          <div class="col-12">
          <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        is your Company Address
                        </label>
                    </div>
              </div>
              <br>
              <label>Links</label>
              <table class="table border-bottom table-hover table-bordered" id="items-tbl">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td class="text-center">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td class="text-center">Link Document Type</td>
                    <td class="text-center">Link Name</td>
                    <td class="text-center">Link Title</td>
                    
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="address-input-rows">
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

      </div>
    </div>
  </div>

</div>
</form>
</div>


<!-- Modal -->
<div class="modal fade" id="editLinkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Links</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
        <div class="col-12">
                  <div class="form-group">
                    <label for="doc_type">Link Document Type</label>
                    <input type="text" name="doc_type" id="doc_type" class="form-control">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="name">Link Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="title">Link Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                  </div>
                </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>