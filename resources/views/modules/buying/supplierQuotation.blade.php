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
                        <a class="dropdown-item" href="#">Menu4 <span
                                class="float-right small">Ctrl+J</span></a>
                        
                        <a class="dropdown-item" href="#">Menu5<span
                                class="float-right small">Ctrl+B</span></a>
                    </div>
                </div>
                <button type="button" onclick="loadIntoPage(this, '{{ route('supplierquotation.index') }}')" class="btn btn-refresh" style="background-color: #d9dbdb;">Refresh</button>
                <button type="button" onclick="loadIntoPage(this, '{{ route('supplierquotation.create') }}')" class="btn btn-primary ml-1" href="#">New</button>
            </div>
        </div>
    </div>
    <br>
    
</nav>

<br>
<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Title</th>
            <th>Date Created</th>
            <th>Status</th>
            <th>Grand Total</th>
            <!--<th>Action</th>-->
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($squotations as $sq)
        <tr>
            <td>
                <a href="#" onclick="loadIntoPage(this, '{{ route('supplierquotation.show', ['supplierquotation' => $sq->id]) }}')">
                    {{ $sq->supplier->company_name }}
                </a>
            </td>
            <td>{{ $sq->date_created->format('m/d/Y') }}</td>
            <td>
                <?php
                    if($sq->sq_status == "Draft"){
                        $color = "orange";
                    }
                    elseif ($sq->sq_status == "Submitted") {
                        $color = "blue";
                    }
                ?>
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
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
