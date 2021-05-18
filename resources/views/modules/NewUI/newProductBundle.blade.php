<script src="{{ asset('js/productBundle.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">New Product Bundle</h2>
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
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadProductBundle();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;" onclick="loadProductBundle();">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<br>
<form action="#" method="post" id="address" class="create">
@csrf
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          Product Bundle Info
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
                    <label for="parent_item">Parent Item</label>

                    <input type="text" name="parent_item" id="parent_item" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <!-- EMPTY COLUMN-->
                </div>

                <div class="form-group col-md-12">
                                <label for="coupon_desc">Description</label>
                                <textarea id="coupon_desc" class="summernote" name="coupon_desc"></textarea>
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
          Items
        </button>
      </h5>
    </div>
    <div id="Item" class="collapse" aria-labelledby="headingTwo">
      <div class="card-body">
        <!--moreinfo contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
            
          
              <br>

              <table class="table border-bottom table-hover table-bordered" id="items-tbl">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td class="text-center">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td class="text-center">Item</td>
                    <td class="text-center">Quantity</td>
                    <td class="text-center">Description</td>
                    <td class="text-center">UOM</td>
                    
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="product-bundle-input-rows">
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
<div class="modal fade" id="editItemsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
        <div class="col-12">
                  <div class="form-group">
                    <label for="item">Item</label>
                    <input type="text" name="item" id="item" class="form-control">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="number" min="0" name="qty" id="qty" class="form-control">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="title">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label for="qty">UOM</label>
                    <select name="qty" id="qty" class="form-control">
                    <option value="UOM1">UOM 1</option>
                    <option value="UOM2">UOM 2</option>
                    <option value="UOM3">UOM 3</option>
                    </select>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200
        });
        $('#myTimeline').verticalTimeline({
            startLeft: false,
            alternate: false,
            arrows: false
        });
    });

</script>