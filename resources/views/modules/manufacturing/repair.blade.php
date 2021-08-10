<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" >
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Repair</h2>
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
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="repairtable();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" onclick="newrepairrequest();" style="float: left;">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="container">
        <hr>
        <table id="repair_table" class="w-100 table table-bom border-bottom">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Customer Name</td>
                    <td>Repair ID</td>
                    <td>Status</td>
                    <td>Product Code</td>
                    <td>Action</td>

                </tr>
            </thead>
            <tbody class="">

                <tr id="">
                <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td ><a href='javascript:onclick=repairinfo();'>Sample Data</a></td>
                    <td>REP00001</td>
                    <td>Sample Data</td>
                    <td>PROD0001</td>
                    <td><button><i class="fa fa-trash"></i></button></td>
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
    $('#repair_table').DataTable();
} );
</script>