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
          <td><input class="form-control" type="text" name="uom_id" id="mr-uom-input-row-${lastRow}"></td>
          <td><input class="form-control" type="text" name="purpose" id="mr-purp-input-row-${lastRow}"></td>
        </tr>`);
    }
</script>
<form  id="mat-req" action="{{ route('materialrequest.update', ['materialrequest' => $materialRequest->id]) }}">
@csrf
@method('PATCH')
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
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
              
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="required_date">Required Date</label>

                  <input type="date" name="required_date" id="required_date_up" class="form-control" value="{{ $materialRequest->required_date ?? '' }}">
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
                    <td>Procurement Method</td>
                    <td></td>

                  </tr>
                </thead>
                <tbody class="" id="material-request-input-rows">
                  <tr>
                    <td id="no-data" colspan="7" style="text-align: center;">
                        @if ($materialRequest->item_code)
                          @foreach ($materialRequests as $materialRequest)
                          <tr>
                              <td>
                                  <div class="form-check">
                                  <input type="checkbox" class="form-check-input">
                                  </div>
                              </td>
                              <td>
                                <select name="item_code[]" id="" value="{{ $materialRequest->item_code }}">
                                  @foreach ($items as $item)
                                      <option value="{{ $item->item_code }}">{{ $item->item_name }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td><input value="{{ $materialRequest->quantity_requested }}" class="form-control" min="0" type="number" name="quantity_requested[]" id="mr-qty-input-row-${lastRow}"></td>
                              <td>
                                <select name="station_id[]" id="" value="{{ $materialRequest->station_id }}">
                                  @foreach ($stations as $station)
                                      <option value="{{ $station->station_id }}">{{ $station->station_name }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td>
                                <select name="procurement_method" id="mr-pm">
                                  <option value="buy">Buy</option>
                                  <option value="produce">Produce</option>
                                  <option value="buyproduce">Buy & Produce</option>
                                </select>
                              </td>
                              <td>
                                <a name="" id="" class="btn delete-btn" href="#" role="button">
                                  <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                              </td>
                          </tr>
                        @endforeach
                        @else
                            NO DATA
                        @endif
                    </td>
                  </tr>
                </tbody>
              </table>
              <td colspan="7" rowspan="5">
                <button type="button" onclick="addRow()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                <button type="button" class="btn btn-sm btn-sm btn-secondary">Add Multiple</button>
              </td>
          

        </div>
        <!--end contents-->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#Item" aria-expanded="false" aria-controls="Item">
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
                  <label for="station_id">Station ID</label>

                  <input type="text" name="station_id" id="station_id_up" class="form-control">
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
          
        </div>
        <!--end contents-->
      </div>
    </div>
    
  </div>
  
<!--
  <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button type="button"lass="btn btn-link collapsed" data-toggle="collapse" data-target="#Currency" aria-expanded="false" aria-controls="Currency">
          Priting Details
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
        <button type="button"lass="btn btn-link collapsed" data-toggle="collapse" data-target="#comm" aria-expanded="false" aria-controls="comm">
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
          
        </div>
        <!--end content-->
        <div class="modal-footer">
            <button type="submit" id="update-customer-form-btn" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>

</form>