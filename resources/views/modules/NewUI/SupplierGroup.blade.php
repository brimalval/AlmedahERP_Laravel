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
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadShippingInfo();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" onclick='openNewShippingRule();' style="float: left;">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="container">
<table id="ShippingRuleTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Calculate Based On</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>
<style>
    .conContent {
        padding: 200px;
    }
</style>

<script>
$(document).ready(function() {
    $('#ShippingRuleTable').DataTable();
} );
</script>
