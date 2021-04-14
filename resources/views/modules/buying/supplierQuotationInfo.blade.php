<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <script src="js/supplierquotation.js"></script>
    <h2 class="navbar-brand tab-list-title">
        <a href="#" onclick="loadIntoPage(this, '{{ route('supplierquotation.index') }}')"
            class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">{{ $sq->supp_quotation_id }}</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Send SMS</a>
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">Email</a>
                        <a class="dropdown-item" href="#">Jump to field <span
                                class="float-right small">Ctrl+J</span></a>
                        <a class="dropdown-item" href="#">Links</a>
                        <a class="dropdown-item" href="#">Duplicate</a>
                        <a class="dropdown-item" href="#">Rename</a>
                        <a class="dropdown-item" href="#">Reload</a>
                        <a class="dropdown-item" href="#">Customize</a>
                        <a class="dropdown-item" href="#">New Request for Quotation <span
                                class="float-right small">Ctrl+B</span></a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" data-toggle="modal" data-target="#submit">Submit</button>
            </div>
        </div>
    </div>
    <br>
    
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">


<form  id="req-forquotation" class="update" method="POST" 
action="{{ route('supplierquotation.update', ['supplierquotation'=>$sq->supp_quotation_id]) }}">
@csrf
@method('PATCH')
<div id="accordion">
<br>
  <div class="card">
  <div class="float-right" id="headingOne">
      <div class="float-right">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Get Items From
                                </button>
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
                  <label for="supplier_group">Supplier</label>
                  <select name="supplier_id" id="supplier_id" class="form-control selectpicker"
                  data-live-search="true">
                    @forelse ($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_id }}"
                          @if($supplier->supplier_id == $sq->supplier->supplier_id) selected @endif>
                          {{ $supplier->company_name }}
                        </option>
                    @empty
                        <option value="{{ $sq->supplier->supplier_id }}">
                          {{ $sq->supplier->company_name }}
                        </option>
                    @endforelse
                  </select>
                </div>
              </div>

              <div class="col-6">
              <div class="form-group">
                  <label for="date_created">Date</label>
                  <input value="{{ $sq->date_created->format("Y-m-d") }}" type="date" name="date_created" id="date_created" class="form-control">
                </div>
               </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="remarks">Supplier Remarks</label>
                  <textarea class="form-control" id="remarks" rows="5">{{ $sq->remarks }}</textarea>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="sq_status">Status</label>
                  <select class="form-control" name="sq_status" id="sq_status">
                    <option value="{{ $sq->sq_status }}">{{ $sq->sq_status }}</option>
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
                  <input readonly value="{{ $sq->supplier->contact_name }}" type="text" name="contact_name" id="contact_name" class="form-control">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="supplier_email">Email Address</label>
                  <input readonly value="{{ $sq->supplier->supplier_email }}" type="text" name="supplier_email" id="supplier_email" class="form-control">
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
                  @foreach ($sq->items() as $item)
                    @include('modules.buying.supplierquotation.item_row', [
                      'item' => $item,
                      'units' => $units,
                    ])
                  @endforeach
                </tbody>
                @if ($sq->sq_status == "Draft")
                  <tfoot>
                    <tr>
                      <td colspan="2">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="">
                          Add Row
                        </button>
                      </td>
                    </tr>
                  </tfoot>

                @endif
              </table>
              <table class="d-none">
                <tbody class="row-sample">
                  @include('modules.buying.supplierquotation.item_row',[
                    'item' => null,
                    'units' => $units,
                  ])
                </tbody>
              </table>
              <!--<td colspan="7" rowspan="5">
                <button type="button" onclick="addRow3()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              </td>-->
              <div class="row">
              <div class="col-6">
                
              </div>

              <div class="col-6">
              <div class="form-group">
                  <label for="grand_total">Grand Total</label>
                  <div class="row">
                    <div class="col-1 p-0">
                      <div class="currency-symbol-container p-0" style="height: 100%; display: grid; align-content: center; font-size:18px; text-align: right;">
                        ₱
                      </div>
                    </div>
                    <div class="col">
                      <input type="hidden" name="grand_total" id="grand_total" value="{{ $sq->grand_total ?? 0 }}">
                      <input value="{{ $sq->grand_total }}" readonly type="text" id="grand_total_display" class="form-control">
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
@if (!isset($editable))
  <script>
    // Preventing the information from being editable
    $('input, textarea').each(function(){
      $(this).attr('readonly', 'true');
    });
    $('select').each(function(){
      $(this).attr('disabled', 'true');
    });
    // Unbinding functions attached to item-rate
    $('.item-rate').off();
  </script>
@endif