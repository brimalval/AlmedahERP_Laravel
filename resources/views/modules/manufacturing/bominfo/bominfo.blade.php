<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand tab-list-title">
      <a href='javascript:onclick=loadBOM();' class="fas fa-arrow-left back-button"><span></span></a>
      <h2 class="navbar-brand" style="font-size: 35px;">BOM-{{ $bom['product_code'] }}</h2>
    </h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="responsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item mt-2">
          <a href="" class="nav-link bg-light">
            <span class="fas fa-print"></span>
          </a>
        </li>
        <li class="nav-item mt-2">
          @forelse($prev_bom as $p_bom)
          <a href="javascript:onclick=loadNextBOM({{ $p_bom->id }});" id="prevBOM" class="nav-link bg-light">
            @empty
            <a href="#" id="prevBOM" class="nav-link bg-light">
              @endforelse
              <span class="fas fa-angle-left"></span>
            </a>
        </li>
        <li class="nav-item mt-2">
          @forelse($next_bom as $n_bom)
          <a href="javascript:onclick=loadNextBOM({{ $n_bom->id }});" id="nextBOM" class="nav-link bg-light">
            @empty
            <a href="#" id="nextBOM" class="nav-link bg-light">
              @endforelse
              <span class="fas fa-angle-right"></span>
            </a>
        </li>
        <li class="nav-item dropdown li-bom">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @if($bom['bom_status'] == 'Draft')
            <li><a class="dropdown-item" id="deleteBom" href="javascript:onclick=deleteBOM('{{ $bom['product_code'] }}', {{ $bom['id'] }});">Delete BOM</a></li>
            @endif
            <li><a class="dropdown-item" href="#">...</a></li>
          </ul>
        </li>
        </li>
        @if ($bom['bom_status'] !== 'Cancelled')
        <li class="nav-item li-bom">
          @switch($bom['bom_status'])
          @case('Draft')
          <button onclick="updateBOMStatus('{{ $bom['product_code'] }}', {{ $bom['id'] }});" style="background-color: #007bff;" id="btnUpdateStatus" class="btn btn-info btn" style="float: left;">
            Submit
          </button>
          @break
          @default
          <button onclick="updateBOMStatus('{{ $bom['product_code'] }}', {{ $bom['id'] }});" style="background-color: lightGrey;" id="btnUpdateStatus" class="btn btn-light" style="float: left;">
            Cancel
          </button>
          @endswitch
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

<div class="card">
  <div class="card-body ml-auto">
    <a href="#" class="btn btn-light" role="button">Update Cost</a>
    <a href=browsebom.php class="btn btn-light" role="button">Browse BOM</a>
    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Create
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <a class="dropdown-item" href="#">...</a>
      <a class="dropdown-item" href="#">...</a>
      <a class="dropdown-item" href="#">...</a>
    </div>
  </div>
</div>

<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          DASHBOARD
        </button>
      </h5>
    </div>
    <div id="Dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h5>Stock</h5>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item text-secondary" style="border: none;"><label>items<label><a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                    <li class="list-group-item text-secondary" style="border: none;"><label>Stock Entry</label><a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                    <li class="list-group-item text-secondary" style="border: none;"><label>Quality inspection</label><a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                  </ul>
                  <h5 class="mt-4">Subcontract</h5>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item text-secondary" style="border: none;"><label>Purchase Order</label> <a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                    <li class="list-group-item text-secondary" style="border: none;"><label>Purchase Receipt</label><a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                    <li class="list-group-item text-secondary" style="border: none;"><label>Purchase Invoice</label><a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <h5>Manufacture</h5>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item text-secondary" style="border: none;"><label>BOM</label><a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                    <li class="list-group-item text-secondary" style="border: none;"><label>Work Order</label> <a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                    <li class="list-group-item text-secondary" style="border: none;"><label>Job Card</label> <a href="#"><span class="fas fa-plus-circle ml-2"></span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Item" aria-expanded="false" aria-controls="Item">
            ITEM
          </button>
        </h5>
      </div>
      <div id="Item" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <div class="container-fluid">
            <div class="Card">
              <div class="card-body">
                <div class="row">
                  <div class="container col-lg-6">
                    <form>
                      <div class="form-group">
                        <label for="itemprod" class="text-muted">Item</label>
                        <input type="text" class="form-control" id="itemprod" style="font-weight: 800" value="{{ $bom['product_code'] }}" readonly>
                        <small class="form-text text-muted">Item to be Manufactured or Repacked</small>
                      </div>

                      <div class="form-group">
                        <label for="itemquantity" class="text-muted">Quantity</label>
                        <input type="text" class="form-control" id="itemquantity" style="font-weight: 800" value="{{ $bom['bom_quantity'] }}" readonly>
                        <small class="form-text text-muted">Quantity of item obtained after manufacturing/repacking from given quantities of raw materials</small>
                      </div>

                      <div class="form-check">
                        @if($bom['set_rate_assembly_item']==1)
                        <input type="checkbox" class="form-check-input" id="check1" checked="checked" disabled="disabled">
                        @else
                        <input type="checkbox" class="form-check-input" id="check1" disabled="disabled">
                        @endif
                        <label class="form-check-label" for="check1">Set rate of sub-assembly item based on BOM</label>
                      </div>
                  </div>
                  <div class="col-lg-6">
                    <form>
                      <div class="form-check mb-3">
                        @if($bom['is_active']==1)
                        <input type="checkbox" class="form-check-input" id="check1" checked="checked" disabled="disabled">
                        @else
                        <input type="checkbox" class="form-check-input" id="check1" disabled="disabled">
                        @endif
                        <label class="form-check-label" for="check1">Is Active</label>
                      </div>
                      <div class="form-check mb-3">
                        @if($bom['is_default']==1)
                        <input type="checkbox" class="form-check-input" id="check1" checked="checked" disabled="disabled">
                        @else
                        <input type="checkbox" class="form-check-input" id="check1" disabled="disabled">
                        @endif
                        <label class="form-check-label" for="check1">Is Default</label>
                      </div>
                      <div class="form-check mb-3">
                        @if($bom['allow_alternative_item']==1)
                        <input type="checkbox" class="form-check-input" id="check1" checked="checked" disabled="disabled">
                        @else
                        <input type="checkbox" class="form-check-input" id="check1" disabled="disabled">
                        @endif
                        <label class="form-check-label" for="check1">Is Active</label>
                      </div>

                      <div class="form-group">
                        <label for="itemname" class="text-muted">Item Name</label>
                        <input type="text" class="form-control" id="itemname" value="{{ $product_data['product_name'] }}" style="font-weight: 800" readonly>
                        <small class="form-text text-muted">Item to be Manufactured or Repacked</small>
                      </div>

                      <div class="form-group">
                        <label for="itemUOM" class="text-muted">Item UOM</label>
                        <input type="text" class="form-control" id="itemUOM" value="{{ $product_data['unit'] }}" style="font-weight: 800" readonly>
                        <small class="form-text text-muted">Item to be Manufactured or Repacked</small>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="headingthree">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Currency" aria-expanded="false" aria-controls="Currency">
            CURRENCY
          </button>
        </h5>
      </div>
      <div id="Currency" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
        <div class="card-body">
          <div class="container-fluid">
            <div class="Card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="curr" value="{{ $bom['currency'] }}" style="font-weight: 800">
                    </div>
                    <div class="form-group">
                      <label for="inputState">Rate of Materials Based On</label>
                      <select id="inputState" class="form-control">
                        <option>Rate of Materials Based On</option>
                        <option>...</option>
                        <option>...</option>
                        <option>...</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="headingthree">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Operation" aria-expanded="false" aria-controls="Operation">
            OPERATION
          </button>
        </h5>
      </div>
      <div id="Operation" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
        <div class="card-body">
          <div class="container-fluid">
            <div class="Card">
              <div class="card-body">
                <form>
                  <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="oper">
                    <label class="form-check-label" for="oper">With Operations</label>
                    <small class="form-text text-muted">Manage cost of Operations</small>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Materials" aria-expanded="false" aria-controls="Materials">
          MATERIALS
        </button>
      </h5>
    </div>
    <div id="Materials" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <div class="container-fluid">
          <div class="Card">
            <div class="card-body">
              <form>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="oper">
                  <label class="form-check-label" for="oper">Quality Inspection Required</label>
                </div>
              </form>
              <label class="text-muted">Items</label>
              <div class="table-responsive">
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col"><input type="checkbox" name=""></th>
                      <th scope="col" class="w-30">Item Code</th>
                      <th scope="col">Qty</th>
                      <th scope="col">UOM</th>
                      <th scope="col">Rate</th>
                      <th scope="col">Amount</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <script type="text/javascript">
                      $(document).ready(function() {
                        $.ajax({
                          method: "GET",
                          url: '/getBomMaterials/' + "{{ $bom->id }}",
                          data: {
                            'id': "{{ $bom->id }}"
                          },
                          success: function(data) {
                            var tbl = $("#mat-table tbody");
                            for (i = 0; i < data.product_mats.length; i++) {
                              console.log(data.product_mats.length);
                              tbl.append(
                                `
                                <tr>
                                    <th scope="row"><input type="checkbox">` + (i + 1) + `</th>
                                    <td><a href="#modmaterials" data-toggle="modal" role="button" style="color: black">` + data.product_mats[i].material.item_code + `</a></td>
                                    <td>` + data.product_mats[i].qty + `</td>
                                    <td>Millimiter</td>
                                    <td><span class="fas fa-ruble-sign"> ` + data.product_mats[i].material.unit_price + `.00</span></td>
                                    <td><span class="fas fa-ruble-sign text-muted">` + (data.product_mats[i].qty * data.product_mats[i].material.unit_price) + `.00</span></td>
                                    <td><span class="fas fa-caret-down"></span></td>
                                </tr>
                                `
                              );
                            }
                          }
                        });
                      });
                    </script>
                    <!--<tr>
                      <th scope="row"><input type="checkbox"> 1</th>
                      <td><a href="#modmaterials" data-toggle="modal" role="button" style="color: black">Mtl-Bar-12377sadh123g</a></td>
                      <td>1</td>
                      <td>Millimiter</td>
                      <td><span class="fas fa-ruble-sign">. 0.00</span></td>
                      <td><span class="fas fa-ruble-sign text-muted">. 0.00</span></td>
                      <td><span class="fas fa-caret-down"></span></td>
                    </tr>
                    <tr>
                      <th scope="row"><input type="checkbox"> 2</th>
                      <td><a href="#modmaterials" data-toggle="modal" role="button" style="color: black">Mtl-Bar-12397sahdohouqw</a></td>
                      <td>69</td>
                      <td>Millimiter</td>
                      <td><span class="fas fa-ruble-sign">. 0.00</span></td>
                      <td><span class="fas fa-ruble-sign text-muted">. 0.00</span></td>
                      <td><span class="fas fa-caret-down" style="color: black"></span></td>
                    </tr>
                    <tr>
                      <th scope="row"><input type="checkbox"> 3</th>
                      <td><a href="#modmaterials" data-toggle="modal" role="button" style="color: black">Mtl-Bar-123869asdgh</a></td>
                      <td>160</td>
                      <td>Millimiter</td>
                      <td><span class="fas fa-ruble-sign">. 0.00</span></td>
                      <td><span class="fas fa-ruble-sign text-muted">. 0.00</span></td>
                      <td><span class="fas fa-caret-down"></span></td>
                    </tr>-->
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modmaterials" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editing Row #1</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                <div class="row">
                  <div class="container col-lg-6">
                    <form>
                      <div class="form-group">
                        <label for="itemCode" class="text-muted">Item Code</label>
                        <input type="text" class="form-control" id="itemCode" style="font-weight: 800">
                      </div>
                      <div class="form-group">
                        <label for="itemName" class="text-muted">Item Name</label>
                        <input type="text" class="form-control" id="itemName" style="font-weight: 800">
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-6">
                    <form>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check1">
                        <label class="form-check-label text-muted" for="check1">Allow Alternative Item</label>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="border-top my-3"></div>
              <div class="card-body">
                <label class="text-muted">Quantity and Rate</label>
                <div class="row">
                  <div class="container col-lg-6">
                    <form>
                      <div class="form-group">
                        <label for="Qtymodal" class="text-muted">QTY</label>
                        <input type="text" class="form-control" id="Qtymodal" style="font-weight: 800">
                      </div>
                      <div class="form-group">
                        <label for="UOMmodal" class="text-muted">UOM</label>
                        <input type="text" class="form-control" id="UOMmodal" style="font-weight: 800">
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-6">
                    <form>
                      <div class="form-group">
                        <label for="stckQtymodal" class="text-muted">Stock QTY</label>
                        <input type="text" class="form-control" id="stckQtymodal" style="font-weight: 800">
                      </div>
                      <div class="form-group">
                        <label for="stckUOMmodal" class="text-muted">Stock UOM</label>
                        <input type="text" class="form-control" id="stckUOMmodal" style="font-weight: 800">
                      </div>
                      <div class="form-group">
                        <label for="convfact" class="text-muted">Conversion Factor</label>
                        <input type="text" class="form-control" id="convfact" style="font-weight: 800">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="border-top my-3"></div>
              <div class="card-body">
                <label class="text-muted">Rate & Amount</label>
                <div class="row">
                  <div class="container col-lg-6">
                    <form>
                      <div class="form-group">
                        <label for="rte" class="text-muted">Rate (PHP)</label>
                        <input type="text" class="form-control" id="rte" style="font-weight: 800">
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-6">
                    <form>
                      <div class="form-group">
                        <label for="amnt" class="text-muted">Amount (PHP)</label>
                        <input type="text" class="form-control" id="amnt" style="font-weight: 800">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="border-top my-3"></div>
              <div class="card-body">
                <label class="text-muted">Scrap %</label>
                <div class="row">
                  <div class="container col-lg-6">
                    <form>
                      <div class="form-group">
                        <input type="text" class="form-control" id="scrp" style="font-weight: 800">
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-6">
                  </div>
                </div>
              </div>
              <div class="border-top my-3"></div>
              <div class="card-body">
                <div class="row">
                  <div class="container col-lg-6">
                    <form>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="modchck">
                        <label class="form-check-label" for="modchck">Include item in Manufacturing</label>
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-6">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light">Insert Below</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header" id="headingthree">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Costing" aria-expanded="false" aria-controls="Costing">
        COSTING
      </button>
    </h5>
  </div>
  <div id="Costing" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
    <div class="card-body">
      <div class="container-fluid">
        <div class="Card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8">
                <form>
                  <div class="form-group" style="width: 50%">
                    <label for="opcost" class="text-muted">Operational Cost(PHP)</label>
                    <input type="text" class="form-control" id="opcost" style="font-weight: 800">
                  </div>
                  <div class="form-group" style="width: 50%">
                    <label for="rawcost" class="text-muted">Raw Cost(PHP)</label>
                    <input type="text" class="form-control" id="rawcost" style="font-weight: 800" value='{{ $bom['total_cost'] }}' readonly>
                  </div>
                  <div class="form-group" style="width: 50%">
                    <label for="scrapmat" class="text-muted">Scrap Material Cost(PHP)</label>
                    <input type="text" class="form-control" id="scrapmat" style="font-weight: 800">
                  </div>
                </form>
              </div>
              <div class="col-lg-4">
                <form>
                  <div class="form-group">
                    <label for="totcost" class="text-muted">Total Cost(PHP)</label>
                    <input type="text" class="form-control" id="totcost" style="font-weight: 800" value='{{ $bom['total_cost'] }}' readonly>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="Card">
          <div class="card-body">

            <div class="row">
              <div class="col-lg-8">
                <form>
                  <div class="form-group" style="width: 100%">
                    <label for="itdesc" class="text-muted">Item Description</label>
                    <input type="text" class="form-control" id="itdesc" value="{{ $product_data['internal_description'] }}" readonly>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header" id="headingthree">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#matreq" aria-expanded="false" aria-controls="matreq">
        MATERIALS REQUIRED
      </button>
    </h5>
  </div>
  <div id="matreq" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
    <div class="card-body">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <label class="text-muted">Exploded items</label>
            <label class="text-muted">Items</label>
            <div class="table-responsive">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col"><input type="checkbox" name=""></th>
                    <th scope="col" class="w-30">Item Code</th>
                    <th scope="col" style="width: 300px;">Item Name</th>
                    <th scope="col" style="width: 300px;">Description</th>
                    <th scope="col">Stock Qty</th>
                    <th scope="col" style="width: 150px;">Rate</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><input type="checkbox"> 1</th>
                    <td>Mtl-Bar-12377sadh123g</td>
                    <td>Shafting or round bar</td>
                    <td>Shafting or round bar</td>
                    <td><span class="fas fa-ruble-sign">. 0.00</span></td>
                    <td><span class="fas fa-ruble-sign text-muted">. 0.00 <span class="fas fa-caret-down"></span></span></td>
                  </tr>
                  <tr>
                    <th scope="row"><input type="checkbox"> 2</th>
                    <td>Mtl-Bar-12397sahdohouqw</td>
                    <td>Shafting or round bar</td>
                    <td>Shafting or round bar</td>
                    <td><span class="fas fa-ruble-sign">. 0.00</span></td>
                    <td><span class="fas fa-ruble-sign text-muted">. 0.00 <span class="fas fa-caret-down"></span></span></td>
                  </tr>
                  <tr>
                    <th scope="row"><input type="checkbox"> 3</th>
                    <td>Mtl-Bar-123869asdgh</td>
                    <td>Shafting or round bar</td>
                    <td>Shafting or round bar</td>
                    <td><span class="fas fa-ruble-sign">. 0.00</span></td>
                    <td><span class="fas fa-ruble-sign text-muted">.0.00<span class="fas fa-caret-down ml-3"></span></span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header" id="headingthree">
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#comm" aria-expanded="false" aria-controls="comm">
        COMMENT
      </button>
    </h5>
  </div>
  <div id="comm" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
    <div class="card-body">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <form>
              <div class="form-group">
                <textarea class="form-control" rows="5" id="comment" style="resize: none;"></textarea>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</div>