<!-- This HTML file is used to store all of the rows needed for the datatable in
    supplierQuotation.blade.php that require formatting; each section is loaded 
    individually in SupplierQuotationController
-->
@section('company_name')
    @if ($row->sq_status == "Submitted")
        <a href='#' onclick="loadIntoPage(this, '{{ route('supplierquotation.show', ['supplierquotation'=>$row->supp_quotation_id]) }}')">
            {{ $row->supplier->company_name }}
        </a>
    @else
        <a href='#' onclick="loadIntoPage(this, '{{ route('supplierquotation.edit', ['supplierquotation'=>$row->supp_quotation_id]) }}')">
            {{ $row->supplier->company_name }}
        </a>
    @endif
@endsection

@section('date_created')
    <p class="text-center">
        {{ $row->date_created->format("m/d/Y") }}
    </p>
@endsection

@section('sq_status')
    <?php
        $sq_status = $row->sq_status;
        $color = ($sq_status == "Draft") ? "orange" : ($sq_status == "Archived") ? "gray" : "blue";
    ?>
    <i class="fa fa-circle" aria-hidden="true" style="color:{{ $color }}"></i>
    {{ $row->sq_status }}
@endsection

@section('grand_total')
    <p class="text-center">₱ {{ $row->grand_total }}</p>
@endsection

@section('time_diff')
    <p class="text-center text-muted">{{ $row->date_created->shortRelativeDiffForHumans() }}</p>
@endsection