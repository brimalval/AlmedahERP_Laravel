<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <script src="js/supplierquotation.js"></script>
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadBuyingRequestForQuotation();'
            class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Supplier Quotation</h2>
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
                        <a class="dropdown-item" href="#">Menu1</a>
                        <a class="dropdown-item" href="#">Menu2</a>
                        <a class="dropdown-item" href="#">Menu3</a>
                        <a class="dropdown-item" href="#">Menu4 <span class="float-right small">Ctrl+J</span></a>

                        <a class="dropdown-item" href="#">Menu5<span class="float-right small">Ctrl+B</span></a>
                    </div>
                </div>
                <button type="button" onclick="loadIntoPage(this, '{{ route('supplierquotation.index') }}')"
                    class="btn btn-refresh" style="background-color: #d9dbdb;">Refresh</button>
                <button type="button" onclick="loadIntoPage(this, '{{ route('supplierquotation.create') }}')"
                    class="btn btn-primary ml-1" href="#">New</button>
            </div>
        </div>
    </div>
    <br>

</nav>

<div class="card-header bg-light">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <input type="text" id="supp-search" class="form-control datatable-search" placeholder="Supplier Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                {{-- <input type="text" class="form-control datatable-search" id="material-search" placeholder="Raw Material"> --}}
                <select id="material-search" class="form-control selectpicker datatable-search" data-live-search="true">
                    <option value="" data-subtext="None" selected>Raw Material</option>
                    @foreach ($materials as $material)
                        <option value="{{ $material->item_code }}" data-subtext="{{ $material->item_code }}">
                            {{ $material->item_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- Search based on grand total, not yet known how to handle this --}}
        {{-- <div class="col-4">
            <div class="form-group">
                <input type="number" min="1" class="form-control datatable-search" id="price-search" placeholder="Grand Total">
            </div>
        </div> --}}
        <!--
            <div class="col-4">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Almedah Food Equipment">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="">
            </div>
        </div>
    -->
        <div class="float-left">
            <button class="btn btn-outline-secondary btn-sm shadow-sm" id="clear-filters">
                Clear Filters
            </button>
        </div>
    </div>
</div>
<br>
<table id="quotation_tbl" class="display w-100">
    <thead>
        <tr>
            <th class="quotation_tbl_supp">Supplier</th>
            <th>Date Created</th>
            <th>Status</th>
            <th>Grand Total</th>
            <!--<th>Action</th>-->
            <th>Quotation ID</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($squotations as $sq)
            <tr>
                <td>
                    <a href="#"
                        onclick="loadIntoPage(this, '{{ route('supplierquotation.show', ['supplierquotation' => $sq->id]) }}')">
                        {{ $sq->supplier->company_name }}
                    </a>
                </td>
                <td>{{ $sq->date_created->format('m/d/Y') }}</td>
                <td>
                    <?php if ($sq->sq_status == 'Draft') {
                    $color = 'orange';
                    } elseif ($sq->sq_status == 'Submitted') {
                    $color = 'blue';
                    } ?>
                    <i class="fa fa-circle" aria-hidden="true" style="color:{{ $color }}"></i>
                    {{ $sq->sq_status }}
                </td>
                <td>₱{{ $sq->grand_total }}</td>
                <td>{{ $sq->supp_quotation_id }}</td>
                <td>{{ $sq->date_created->shortRelativeDiffForHumans() }}</td>
            </tr>
        @endforeach --}}
    </tbody>
</table>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    // Ajax data table to accommodate more complex search conditions
    // and large database sizes
    var tbl = $('#quotation_tbl').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('supplierquotation.list', [], false) }}',
            // Including the item code filter to the request
            data: function(data){
                data.item_code = $('#material-search').val();
            },
        },
        // Defining the columns; time diff is not searchable or orderable so as
        // to prevent it from being included in queries
        columns: [
            {data: 'supplier.company_name', name: 'supplier.company_name'},
            {data: 'date_created', name: 'date_created'},
            {data: 'sq_status', name: 'sq_status'},
            {data: 'grand_total', name: 'grand_total'},
            {data: 'req_quotation_id', name: 'req_quotation_id'},
            {data: 'time_diff', name:'time_diff', searchable: false, orderable:false},
        ],
    });
    // Unbinding the search filters then binding functions to them to prevent
    // binding too many times when reloading the page
    $('#supp-search').off().on('change', function () {
        tbl.column('.quotation_tbl_supp').search($(this).val()).draw();
    });
    $('#material-search').off().on('change', function () {
        tbl.draw();
    });
    $('#price-search').off().on('change', function () {
        tbl.draw();
    });
    $('#clear-filters').off().on('click', function(){
        $('.datatable-search').each(function(){
            $(this).val('');
        });
        // Triggering supplier search's change function since it has the special search
        // arguments attached to it; resetting anything else does nothing to the params
        $('#supp-search').change();
        $('#material-search').selectpicker('refresh');
    });
    $('th').each(function(item, index){
        $(this).addClass('text-center');
    });
    $('.dataTables_filter').addClass('d-none');
</script>
