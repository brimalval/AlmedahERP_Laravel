<head>
  @include('layouts.imports')
</head>
<script src="{{ asset('js/supplierquotation.js') }}"></script>
@foreach($errors->all() as $error)
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      <span class="sr-only">Close</span>
    </button>
    <strong>{{ $error }}</strong> You should check in on some of those fields below.
  </div>
@endforeach
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <h2 class="navbar-brand" style="font-size: 35px;">New Supplier Quotation</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary" onClick="#">Cancel</button>
                    
                </div>
                <button type="button" class="btn btn-primary ml-1" href="#" onclick="$('#squotation-form').submit()">Save</button>
            </div>
        </div>
    </div>
    <br>
    
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">

<form  id="squotation-form" method="POST" action="{{ route('supplierquotation.store') }}">
@csrf
<input type="hidden" name="req_quotation_id" value="{{ $req_quotation_id }}">
<input type="hidden" name="supplier_id" value="{{ $supplier->supplier_id }}">
<div id="accordion">
<br>
  <div class="card">
  <div class="float-right" id="headingOne">
      <div class="float-right">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <div class="btn-group btn-group-sm" role="group">
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <a class="dropdown-item" href="#">1</a>
                      <a class="dropdown-item" href="#">2</a>
                  </div>
              </div>
              
          </div>
      </div>
    </div>
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link" data-toggle="collapse" data-target="#supplier" aria-expanded="true" aria-controls="supplier">
          Supplier
        </a>
      </h5>
    </div>
    <div id="supplier" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <!--dashboard contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form">
            @csrf --}}

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="series">SQ ID</label>
                  <select id="series" class="selectpicker form-control">
                    <option value="">PUR-SQTN-.YYYY.-</option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="supplier_group">Supplier</label>
                  <input readonly value="{{ $supplier->company_name }}" type="text" id="supplier_group" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
              <div class="form-group">
                  <label for="date_created">Date</label>
                  <input readonly value="{{ now()->format("Y-m-d") }}" type="date" name="date_created" id="date_created" class="form-control">
                </div>
               </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="remarks">Supplier Remarks</label>
                  <textarea class="form-control" name="remarks" id="remarks" rows="5"></textarea>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="sq_status">Status</label>
                  <select class="form-control selectpicker" name="sq_status" id="sq_status">
                    <option value="Draft">Draft</option>
                  </select>
                </div>
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
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#contact" aria-expanded="false" aria-controls="contact">
          Address and Contact
        </a>
      </h5>
    </div>
    <div id="contact" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <!--supplier detail contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
            
          <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="contact_name">Contact Name</label>
                  <input readonly value="{{ $supplier->contact_name ?? 'N/A' }}" type="text" name="contact_name" id="contact_name" class="form-control">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="supplier_email">Email Address</label>
                  <input readonly value="{{ $supplier->supplier_email }}" type="text" name="supplier_email" id="supplier_email" class="form-control">
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
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#cnpl" aria-expanded="false" aria-controls="cnpl">
          Currency and Price List
        </a>
      </h5>
    </div>
    <div id="cnpl" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <!--supplier detail contents-->
        <div class="container">
          {{-- <form id="contactForm" name="contact" role="form"> --}}
            
         
              <table class="table border-bottom table-hover table-bordered" id="items-tbl">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <th>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </th>

                    <th>Item Code</th>
                    <th>Quantity</th>
                    <th>Stock UOM</th>
                    <th>Rate</th>
                    <th>Sub-total</th>
                    
                  </tr>
                </thead>
                <tbody class="" id="items-input-rows">
                  @foreach ($items as $item)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input readonly value="{{ $item->item_code }}" type="text"
                            class="form-control" name="item_code[]" placeholder="">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input readonly value="{{ $item->quantity_requested }}" type="text"
                            class="form-control" id="qty-req" name="qty_requested[]" placeholder="">
                        </div>
                      </td>
                      <td>
                        <select required="true" data-id="uom_id" data-live-search="true" name="uom_id[]" class="form-control selectpicker">
                          @foreach ($units as $unit)
                              <option value="{{ $unit->uom_id }}" @if($unit->uom_id == $item->item->uom_id) selected @endif data-subtext="{{ $unit->conversion_factor }} nos. ea.">{{ $unit->item_uom }}</option>
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="number" min="0" required
                            class="form-control item-rate" name="rate[]" placeholder="₱" value="0">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input readonly type="text" class="subtotal form-control" placeholder="">
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="row">
              <div class="col-6">
                
              </div>

              <div class="col-6">
              <div class="form-group">
                  <label for="grand_total">Grand Total (PhP)</label>
                  <div class="row">
                    <div class="col-1 p-0">
                      <div class="currency-symbol-container p-0" style="height: 100%; display: grid; align-content: center; font-size:18px; text-align: right;">
                        ₱
                      </div>
                    </div>
                    <div class="col">
                      <input type="hidden" name="grand_total" id="grand_total">
                      <input readonly type="text" id="grand_total_display" class="form-control">
                    </div>
                  </div>
                  
                </div>
               </div>
            </div>
              
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
<div class="modal fade" id="submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        
      </div>
      <div class="modal-body">
        <p>Permanently submit *INSERT SQ ID* ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>