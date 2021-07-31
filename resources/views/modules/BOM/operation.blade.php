<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<script src="{{ asset('js/operations.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Operations</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="operationtable();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" onclick="newoperation();"
                        style="float: left;">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="container">

    <hr>
    <br>
    <table id="table_operations" class="display">
        <thead>
            <tr>
                <th>Operation ID</th>
                <th>Name</th>
                <th>Work Center</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operations as $operation)
            <tr id="op{{ $operation->id }}">
                <td>{{ $operation->operation_id }}</td>
                <td>{{ $operation->operation_name }}</td>
                <td>{{ $operation->wc_label }}</td>
                <td>
                    <a id="" class="btn" href="javascript:onclick=editoperation({{ $operation->id }});" role="button">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </a>
                    <form action="{{ route('operations.destroy', ['id' => $operation->id]) }}" name="deleteOperation" id="deleteOp{{ $operation->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn delete-btn mr-delete-form" id="deleteOp" onclick="$('#deleteOp{{ $operation->id }}').submit(); $('#op{{ $operation->id }}').remove();" type="button" role="button">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>

<style>
    .conContent {
        padding: 200px;
    }

</style>
