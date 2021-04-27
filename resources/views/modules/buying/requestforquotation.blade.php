<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" >
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand" style="font-size: 35px;">Request for Quotation</h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Import</a>
                        <a class="dropdown-item" href="#">User Permissions</a>
                        <a class="dropdown-item" href="#">Role Permissions Manager</a>
                        <a class="dropdown-item" href="#">Customize</a>
                        <a class="dropdown-item" href="#">Toggle Sidebar</a>
                        <a class="dropdown-item" href="#">Share URL</a>
                        <a class="dropdown-item" href="#">Settings</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" onclick="loadIntoPage(this, '{{ route('rfquotation.index') }}')">Refresh</button>
                <button type="button" class="btn btn-info ml-1" onclick="loadIntoPage(this, '{{ route('rfquotation.create') }}')">New</button>
            </div>
        </div>
    </div>
</nav>
<br>
<div class="container-fluid" style="margin: 0; padding: 0;">

<style>
    #contentRequestforQuotation tbody tr:hover{
        transition: 250ms;
        background-color: #cccccc;
    }
</style>
<table id="table_id" class="w-100 display table table-bordered">
    <thead>
        <tr>
            <td>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input">
                </div>
            </td>
            <th>Name</th>
            <th>Status</th>
            <th>Company</th>
            <th>Date</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rfquotations as $rfquotation)
            <tr>
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                    </div>
                </td>
                <td>
                    <button type="button" class="text-primary" onclick="loadIntoPage(this, '{{ route('rfquotation.edit', ['rfquotation'=>$rfquotation->id]) }}')">{{ $rfquotation->req_quotation_id }}</button>
                </td>
                <td>
                    <?php
                        if($rfquotation->req_status == "Draft"){
                            $color = "orange";
                        }
                        elseif ($rfquotation->req_status == "Submitted") {
                            $color = "blue";
                        }
                    ?>
                    <i class="fa fa-circle" aria-hidden="true" style="color:{{ $color }}"></i>
                    {{ $rfquotation->req_status }}
                </td>
                <td class="text-muted">
                    {{ $rfquotation->suppliers[0]->company_name }}
                </td>
                <td class="text-muted">
                    {{ $rfquotation->date_created->format('m-d-Y') }}
                </td>
                <td class="text-muted">
                    {{ $rfquotation->date_created->shortRelativeDiffForHumans() }}
                </td>
                <td>
                    @if ($rfquotation->req_status == "Draft")
                        <form action="{{ route('rfquotation.destroy', ['rfquotation' => $rfquotation->id]) }}" method="POST" class="mr-delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete-btn" onclick="return confirm('Are you sure? you want to delete this request?')">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>   
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr colspan="5">
                <div class="text-muted">
                    No Data
                </div>
            </tr>
        @endforelse
    </tbody>
</table>
    </div>
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
</div>
