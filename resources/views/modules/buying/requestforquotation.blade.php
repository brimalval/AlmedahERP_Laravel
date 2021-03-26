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
                <button type="button" class="btn btn-primary ml-1" onclick="loadBuyingRequestForQuotation()">Refresh</button>
                <button type="button" class="btn btn-info ml-1" onclick="openBuyingRequestForQuotationForm()">New</button>
            </div>
        </div>
    </div>
</nav>
<br>
<div class="container-fluid" style="margin: 0; padding: 0;">
    
<table id="table_id" class="display">
    <thead>
        <tr>
            
            <th>Request Quotation ID</th>
            <th>Date Created</th>
            <th>Items List</th>
            <th>Status</th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
           
            <td><a href="#" onclick="javascript:viewBuyingRequestForQuotationForm();"><?= 'Hi-top' ?></a></td>
            <td>Insert Date</td>
            <td>Insert list</td>
            <td>Insert Status</td>
            
        </tr>
        <tr>
            
            <td><a href="#" onclick="javascript:viewBuyingRequestForQuotationForm();"><?= 'Low-top' ?></a></td>
            <td>Insert Date</td>
            <td>Insert list</td>
            <td>Insert Status</td>
            
        </tr>
    </tbody>
</table>
    </div>
    <script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
</div>
