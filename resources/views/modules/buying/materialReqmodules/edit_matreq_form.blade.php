<script src="{{ asset('js/materialrequest.js') }}"></script>
<form  id="mat-req" class="update" action="{{ route('materialrequest.update', ['materialrequest' => $materialRequest->id]) }}">
@csrf
@method('PATCH')
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
                  <div class="form-group">
                    <label for="request_id">Request ID</label>

                    <input type="text" value="{{ $materialRequest->request_id }}" readonly id="request_id" class="form-control">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="required_date">Required Date</label>

                    <input value="{{ $materialRequest->required_date }}" type="date" required="true" name="required_date" id="required_date" class="form-control">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="purpose">Purpose</label>

                    <input value="{{ $materialRequest->purpose }}" type="text" name="purpose" id="purpose" class="form-control">
                  </div>
                </div>
              </div>
      

              <div class="col-12">
                <hr>
              </div>
              <br>
              <label>Item</label>
              <div id="items-border-div" class="mb-3">
              <table class="table border-bottom table-hover table-bordered" id="items-tbl">
                <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                    <td>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>
                    </td>

                    <td>Item Code</td>
                    <td>Quantity</td>
                    <td>Target Station</td>
                    <td>Procurement Method</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody class="" id="material-request-input-rows">
                    @foreach ($materialRequest->raw_mats as $rq_mat)
                      <tr>
                          <td>
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input">
                          </div>
                          </td>
                          <td id="mr-code-input-{{ $loop->index }}" class="mr-code-input">
                            <select required="true" name="item_code[]" class="form-control">
                              @foreach ($materials as $material)
                                    <option value="{{ $material->item_code }}" @if ($material->item_code == $rq_mat->item_code) selected="selected" @endif>{{ $material->item_name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td style="width: 10%;"><input required value="{{ $rq_mat->quantity_requested }}" class="form-control" min="0" type="number" name="quantity_requested[]" id="mr-qty-input-row-{{ $loop->index }}"></td>
                          <td id="mr-target-input-{{ $loop->index }}" class="mr-target-input">
                            <select required="true" selected="{{ $material->station_id }}" name="station_id[]" class="form-control">
                              @foreach ($stations as $station)
                                  <option value="{{ $station->station_id }}" @if ($station->station_id == $rq_mat->station_id) selected="selected" @endif>{{ $station->station_name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td style="width: 20%">
                          <select name="procurement_method[]" required class="form-control" selected="{{ $rq_mat->procurement_method }}">
                              <option value="buy" @if($rq_mat->procurement_method == "buy") selected="selected" @endif>Buy</option>
                              <option value="produce" @if($rq_mat->procurement_method == "produce") selected="selected" @endif>Produce</option>
                              <option value="buyproduce" @if($rq_mat->procurement_method == "buyproduce") selected="selected" @endif>Buy & Produce</option>
                          </select>
                          </td>
                          <td>
                          <a id="" class="btn btn-primary delete-btn" href="#" role="button">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                          </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              </div>
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
              
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="">Type</label>
                  <select class="form-control" required="true" name="mr_status" readonly id="procurement_method">
                    <option value="draft">Draft</option>
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
<div class="d-none" id="selects">
  <select required="true" name="item_code[]" class="form-control">
    @foreach ($materials as $material)
        <option value="{{ $material->item_code }}">{{ $material->item_name }}</option>
    @endforeach
  </select>

  <select required="true" name="station_id[]" class="form-control">
    @foreach ($stations as $station)
        <option value="{{ $station->station_id }}">{{ $station->station_name }}</option>
    @endforeach
  </select>
</div>