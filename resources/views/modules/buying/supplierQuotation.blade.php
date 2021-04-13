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
                <input type="text" id="supp-search" class="form-control" placeholder="Supplier Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <input type="text" class="form-control" id="material-search" placeholder="Raw Material">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <input type="number" min="1" class="form-control" id="price-search" placeholder="Grand Total">
            </div>
        </div>
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
            <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                Clear Filters
            </button>
        </div>
    </div>
</div>
<br>
<table id="quotation_tbl" class="display">
    <thead>
        <tr>
            <th>Supplier</th>
            <th>Date Created</th>
            <th>Status</th>
            <th>Grand Total</th>
            <!--<th>Action</th>-->
            <th>Quotation ID</th>
            <th>Time Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($squotations as $sq)
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
        @endforeach
    </tbody>
</table>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        var tbl = $('#quotation_tbl').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc']
            ]
        });
        $(document).on('keyup', '#supp-search', function () {
            if(tbl.search() !== $("#supp-search").val())
                tbl.search($(this).val()).draw();
        });
        $(document).on('keyup', '#material-search', function () {
            //tbl.search($(this).val()).draw();
        });
        $(document).on('keyup', '#price-search', function () {
            //tbl.search($(this).val()).draw();
        });
    });

</script>
