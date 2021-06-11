<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Bill of Materials</h2>
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
                        onclick="loadBOMtable();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" onclick="loadBOMForm();"
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
    <table id="table_bom" class="display">
        <thead>
            <tr>
                <th>BOM ID</th>
                <th>BOM Name</th>
                <th>Product/Component Code</th>
                <th>Is Active</th>
                <th>Is Default</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($boms as $bom)
                <tr>
                    <td>{{ $bom->bom_id }}</td>
                    <td>
                        <a href="javascript:onclick=loadBOM({{ $bom->bom_id }});">
                            {{ $bom->bom_name }}
                        </a>
                    </td>
                    <td>
                        @if (isset($bom->product_code))
                            {{ $bom->product_code }}
                        @else
                            {{ $bom->component_code }}
                        @endif
                    </td>
                    <td>
                        @if ($bom->is_active == true)
                            <span>✓</span>
                        @endif
                    </td>
                    <td>
                        @if ($bom->is_default == true)
                            <span>✓</span>
                        @endif
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

<script>
    $(document).ready(function() {
        $('#table_bom').DataTable();
    });

</script>
