<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" >
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Material Request</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadMaterialRequest();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" onclick="openNewMaterialRequest();" style="float: left;">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="container">
        <hr>
        <table id="mat-req-table" class="w-100 table table-bom border-bottom">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Request ID</td>
                    <td>Status</td>
                    <td>Required Date</td>
                    <td>Purpose</td>
                    <td>Action</td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="">
            @foreach($mat_requests as $mat_request)
                <tr id="mr-row-{{ $mat_request->id }}">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td class="mr-request-id"><a name="{{ $mat_request->request_id }}" href='#' onclick="loadIntoPage(this, '{{ route('materialrequest.edit', ['materialrequest' => $mat_request['id'], 'full_page' => true]) }}')">{{ $mat_request->request_id }}</a></td>
                    <?php
                        if($mat_request->mr_status == "Draft"){
                            $color = "orange";
                        }
                        elseif ($mat_request->mr_status == "Submitted") {
                            $color = "blue";
                        }
                    ?>
                    <td class="mr-rq-status">
                        <i class="fa fa-circle" aria-hidden="true" style="color:{{ $color }}"></i>
                        {{ $mat_request->mr_status }}
                    </td>
                    <td class="text-black-50 mr-req-date">{{ $mat_request->required_date->format("Y-m-d") }}</td>
                    <td class="text-black-50 mr-purpose">{{ $mat_request->purpose }}</td>
                    <td>
                    @if ($mat_request->mr_status == 'Draft')
                        <button id="edit-mr-button" class="btn btn-outline-warning" onclick="$('#editModal').modal('show'); loadEdit('{{ route('materialrequest.edit', ['materialrequest' => $mat_request['id']]) }}')"><i class="fa fa-edit"></i></button>
                        <form action="{{ route('materialrequest.destroy', ['materialrequest' => $mat_request->id]) }}" method="POST" class="mr-delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mr-delete-btn btn btn-outline-danger" onclick="return confirm('Are you sure? you want to delete this request?')"><i class="fa fa-trash"></i></button>
                        </form>
                    @endif
                    
                    
                    </td>
                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
            @endforeach
                <!--
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>MTL-BAR-SHAFT-CRS-5"</td>
                    <td>782</td>
                    <td class="text-black-50">03-11-2021</td>
                    <td class="text-black-50">Insert Purpose</td>
                    <td>10924</td>
                    <td class="text-black-50">Insert ID</td>

                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>MTL-BAR-SHAFT-CRS-5/8"</td>
                    <td>1600</td>
                    <td class="text-black-50">03-11-2021</td>
                    <td class="text-black-50">Insert Purpose</td>
                    <td>10925</td>
                    <td class="text-black-50">Insert ID</td>

                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Bar Shaft</td>
                    <td>20</td>
                    <td class="text-black-50">03-11-2021</td>
                    <td class="text-black-50">Insert Purpose</td>
                    <td>10926</td>
                    <td class="text-black-50">Insert ID</td>

                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                -->
            </tbody>
        </table>
    </div>

</div>


@include('modules.buying.materialReqmodules.edit_matreq')
<style>
    .conContent {
        padding: 200px;
    }
</style>

<script>
$(document).ready(function() {
    $('#mat-req-table').DataTable();
} );
</script>