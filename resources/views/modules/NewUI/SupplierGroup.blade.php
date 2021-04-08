<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" >
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Supplier Group</h2>
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
                        <li><a class="dropdown-item" href="#">Import</a></li>
                        <li><a class="dropdown-item" href="#">User Permissions</a></li>
                        <li><a class="dropdown-item" href="#">Role Permissions Manager</a></li>
                        <li><a class="dropdown-item" href="#">Customize</a></li>
                        <li><a class="dropdown-item" href="#">Toggle Sidebar</a></li>
                        <li><a class="dropdown-item" href="#">Share URL</a></li>
                        <li><a class="dropdown-item" href="#">User Permissions</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadSupplierGroup();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" onclick="openSupplierGroup();" style="float: left;">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="card">
<br>
<div class="container">
<table id="SupplierGroupTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>Name</th>
                <th>Parent Supplier Group</th>
                <th>Is group</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><a href="javascript:onclick=openSupplierGrouptable()">Sample 1</a></td>
                <td>All Supplier Groups</td>
                <td><input type="checkbox"></td>
                <td>Distributor</td>
            </tr>
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
    $('#SupplierGroupTable').DataTable();
} );
</script>
