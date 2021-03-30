<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadBuyingRequestForQuotation();'
            class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">{{ $rfquotation->req_quotation_id ?? _('New Request
            Quotation') }}</h2>
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
                @if ((isset($rfquotation) && $rfquotation->req_status == 'Draft') || !isset($rfquotation))
                  <button type="button" class="btn btn-primary ml-1" onclick="addRFQ()" id="rfq-save-btn"
                      href="#">Save</button>
                @endif
                @if (isset($rfquotation) && $rfquotation->req_status == 'Draft')
                  <form action="{{ route('rfquotation.submit', ['rfquotation'=>$rfquotation->id]) }}" method="post" onsubmit="submitRFQ(this)">
                    @csrf
                    @method('PATCH')
                    <button type="button" onclick="submitRFQ($(this).parents('form')[0])" class="btn btn-primary ml-1" id="rfq-save-btn">Submit</button>
                  </form>
                @endif
            </div>
        </div>
    </div>
    <br>

</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="float-right" id="headingOne">
        <div class="float-right">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group btn-group-sm" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Supplier Quotation
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Create</a>
                        <a class="dropdown-item" href="#">View</a>
                    </div>
                </div>
                <!-- Shows the send email button only if the quotation has already been
                   submitted -->
                @if (isset($rfquotation) && $rfquotation->req_status == "Submitted")
                <form action="{{ route('rfquotation.email', ['rfquotation'=>$rfquotation->id]) }}" method="post">
                    @csrf
                    <button type="button" onclick="submitRFQ($(this).parents('form')[0])" class="btn btn-secondary btn-sm ml-1">Send Supplier Emails</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    <form id="req-forquotation-form" class="update" action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($rfquotation))
          @method('PATCH')
        @endif
        <input type="hidden" name="request_id" id="rfq-request-id" value="{{ (isset($rfquotation)) ? $rfquotation->request_id : '' }}">
        <div id="accordion">
            <br>
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a href="#" class="btn btn-link" data-toggle="collapse" data-target="#Dashboard"
                            aria-expanded="true" aria-controls="Dashboard">
                            Dashboard
                        </a>
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
                                            <label for="series">Quotation ID</label>
                                            <select class="form-control" id="series">
                                                <option value="" selected>PUR-RFQ-.YYYY.-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="date_created">Date</label>
                                            <input type="date" readonly
                                                value="{{ isset($rfquotation) ? $rfquotation->date_created->format("
                                                Y-m-d") : now()->format("Y-m-d") }}" id="date_created"
                                            class="form-control">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        {{--
    </form> --}}

</div>
<!--end contents-->
</div>
</div>
</div>
<div class="card">
    <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
            <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#suppDetail"
                aria-expanded="false" aria-controls="suppDetail">
                Supplier Detail
            </a>
        </h5>
    </div>
    <div id="suppDetail" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
            <!--supplier detail contents-->
            <div class="container">
                {{-- <form id="contactForm" name="contact" role="form"> --}}
                    <table class="table border-bottom table-hover table-bordered" id="rfq-suppliers-tbl">
                        <thead class="border-top border-bottom bg-light">
                            <tr class="text-muted">
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td>Supplier</td>
                                <td>Contact</td>
                                <td>Email ID</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="" id="suppliers-input-rows">
                        @if (isset($rfquotation))
                            @forelse ($rfquotation->suppliers as $supplier)
                            <tr data-id="{{ $loop->index }}">
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td class="rfq-supplier">
                                    <select onchange="fillSupplierRow($(this))" required="true" data-id="supplier_id"
                                        data-live-search="true" name="supplier_id[]" class="form-control selectpicker">
                                        @foreach ($suppliers as $supplier_option)
                                        <option value="{{ $supplier_option->supplier_id }}"
                                            data-subtext="{{ $supplier_option->supplier_id }}"
                                            data-email="{{ $supplier_option->supplier_email }}" @if($supplier_option->
                                            supplier_id == $supplier->supplier_id) selected @endif>
                                            {{ $supplier_option->company_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="rfq-contact">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="" aria-describedby="helpId"
                                            placeholder="ex. John Doe">
                                    </div>
                                </td>
                                <td class="rfq-email">
                                    <div class="form-group">
                                        <input required type="text" class="form-control" readonly id=""
                                            aria-describedby="helpId" placeholder="example@gmail.com"
                                            value="{{ $supplier->supplier_email }}">
                                    </div>
                                </td>
                                <td>
                                    <button type="button" id="" class="btn delete-btn" role="button"
                                        onclick="$(this).parents('tr').remove()">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr  class="text-center" id="no-suppliers">
                                <td colspan="5">
                                    No Data
                                </td>
                            </tr>
                            @endforelse
                            @else
                            <tr  class="text-center" id="no-suppliers">
                                <td colspan="5">
                                    No Data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <td colspan="7" rowspan="5">
                        <button type="button" onclick="addSupplier()" class="btn btn-sm btn-sm btn-secondary">Add
                            Row</button>
                    </td>
                    {{--
                </form> --}}
            </div>
            <!--end contents-->
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
            <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#item" aria-expanded="false"
                aria-controls="item">
                Items
            </a>
        </h5>
    </div>
    <div id="item" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
            <!--supplier detail contents-->
            <div class="container">
                {{-- <form id="contactForm" name="contact" role="form"> --}}
                    <table class="table border-bottom table-hover table-bordered items-tbl" id="rfq-items-tbl">
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
                        <tbody class="mr-link-input-rows">
                        </tbody>
                        <tbody class="" id="rfq-input-rows">
                            @if (isset($rfquotation))
                            @forelse ($rfquotation->item_list() as $rq_mat)
                            <tr data-id="{{ $loop->index }}">
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td id="mr-code-input-{{ $loop->index }}" class="mr-code-input">
                                    <select required="true" data-id="item_code" data-live-search="true"
                                        name="item_code[]" class="form-control selectpicker">
                                        @foreach ($materials as $material)
                                        <option @if($material->item_code == $rq_mat->item_code) selected @endif
                                            value="{{ $material->item_code }}">{{ $material->item_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width: 10%;" class="mr-qty-input"><input required class="form-control"
                                        min="0" type="number" name="quantity_requested[]"
                                        id="mr-qty-input-row-{{ $loop->index }}"
                                        value="{{ $rq_mat->quantity_requested }}"></td>
                                <td class="mr-unit-input">
                                    <select required="true" data-id="uom_id" data-live-search="true" name="uom_id[]"
                                        class="form-control selectpicker">
                                        @foreach ($units as $unit)
                                        <option @if($unit->uom_id == $rq_mat->uom_id) selected @endif value="{{
                                            $unit->uom_id }}" data-subtext="{{ $unit->conversion_factor }} nos. ea.">{{
                                            $unit->item_uom }}</small></option>
                                        @endforeach
                                    </select>
                                </td>
                                <td id="mr-target-input-{{ $loop->index }}" class="mr-target-input">
                                    <select required="true" data-id="station_id" data-live-search="true"
                                        name="station_id[]" class="form-control selectpicker">
                                        @foreach ($stations as $station)
                                        <option @if($station->station_id == $rq_mat->station_id) selected @endif
                                            value="{{ $station->station_id }}">{{ $station->station_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width: 20%" class="mr-procurement-input">
                                    <select name="procurement_method[]" required class="form-control selectpicker">
                                        <option value="buy">Buy</option>
                                        <option value="produce">Produce</option>
                                        <option value="buyproduce">Buy & Produce</option>
                                    </select>
                                </td>
                                <td>
                                    <a id="" class="btn item-edit-btn" href="#" role="button"
                                        onclick="openItemEditModal($(this).parents('tr'), '#contentMaterialRequest')">
                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                    </a>
                                    <button type="button" id="" class="btn delete-btn" role="button"
                                        onclick="$(this).parents('tr').remove()">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr  class="text-center" id="no-data">
                                <td colspan="7">
                                    No Data
                                </td>
                            </tr>
                            @endforelse
                            @else
                            <tr  class="text-center" id="no-data">
                                <td colspan="7">
                                    No Data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <td colspan="7" rowspan="5">
                        <button type="button" onclick="rfqAddItem()" class="btn btn-sm btn-secondary">Add Row</button>
                    </td>
                    <td colspan="7" rowspan="5">
                        <button type="button" onclick="$('#material-requests-modal').modal('show')"
                            class="btn btn-sm btn-primary">Link a Material Request</button>
                    </td>

                    {{--
                </form> --}}
            </div>
            <!--end contents-->
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
            <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#msg" aria-expanded="false"
                aria-controls="msg">
                Message for Supplier
            </a>
        </h5>
    </div>
    <div id="msg" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
            <!--supplier detail contents-->
            <div class="container">
                <small class="text-muted">* A link to the corresponding supplier quotation form will be attached to the
                    end of the message.</small>
                {{-- <form id="contactForm" name="contact" role="form"> --}}
                    <textarea class="form-control" name="supplier_message" id="summernote"
                        rows="3">{!! $rfquotation->supplier_message ?? '' !!}</textarea>
                    {{--
                </form> --}}
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

@include('modules.buying.materialReqmodules.selectpickers')
@include('modules.buying.materialReqmodules.edit_item_modal')
<script type="text/javascript">
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 200
        });
        $('#myTimeline').verticalTimeline({
            startLeft: false,
            alternate: false,
            arrows: false
        });
        $('.selectpicker').each(function () {
            $(this).selectpicker();
        });
    });
</script>

<!-- Material Request Modal -->
<div class="modal fade" id="material-requests-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Link a Material Request</h5>
                <button type="button" class="close" onclick="$(this).parents('.modal').modal('hide')"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="form-control selectpicker" name="request_id" id="request-id-link-select"
                        data-live-search="true">
                        <option value="none" class="text-muted">None</option>
                        @foreach ($material_requests as $material_request)
                        <option value="{{ $material_request->request_id }}"
                            data-items="{{ json_encode($material_request->raw_mats) }}"
                            data-subtext="{{ $material_request->purpose }}">{{ $material_request->request_id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeRequestLink($(this))">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveRequestLink($(this))">Save</button>
            </div>
        </div>
    </div>
</div>