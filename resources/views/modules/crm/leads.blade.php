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
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" id="btn-crm-leads-add" class="btn btn-info btn" style="float: left;">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row mt-2">
        <div class="col-12 mb-3">
            <div class="btn-toolbar w-100" role="toolbar" aria-label="Toolbar with button groups">
                <div class="w-50">
                    <div class="btn-group btn-group-sm float-left mr-1" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-copy fa-fw"></span> Reports
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                        </ul>
                    </div>

                    <div class="btn-group btn-group-sm float-left mr-1" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-wrench fa-fw"></span> Tools
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                        </ul>
                    </div>

                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="crm-leads-filter-input" aria-label="Search table">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="btn-crm-leads-filter">
                                <span class="fa fa-search fa-fw"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-50">
                    <div class="btn-group float-right" role="group" aria-label="Right Group">
                        <button type="button" id="btn-crm-leads-pagination-previous" class="btn btn-outline-secondary">
                            <span class="fa fa-chevron-left fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-leads-pagination-next" class="btn btn-outline-secondary">
                            <span class="fa fa-chevron-right fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-leads-display-list" class="btn btn-outline-secondary">
                            <span class="fa fa-th-list fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-leads-export-file" class="btn btn-outline-secondary">
                            <span class="fa fa-file-alt fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-leads-settings" class="btn btn-outline-secondary">
                            <span class="fa fa-wrench fa-fw"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <table id='tbl-crm-leads' class="table table-sm table-hover w-100">
                <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Enterprise</th>
                        <th scope="col">Fixed Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Date</th>
                        <th scope="col">Assigned to</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal-crm-leads-form">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Leads Form</h5>
                <button type="button" class="close-modal-crm-leads-form" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="crmLeadsFirstName" class="col-sm-3 col-form-label">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmLeadsFirstName" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmLeadsLastName" class="col-sm-3 col-form-label">Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmLeadsLastName" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmLeadsEnterprise" class="col-sm-3 col-form-label">Enterprise</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmLeadsEnterprise" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmLeadsFixedPhone" class="col-sm-3 col-form-label">Fixed Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmLeadsFixedPhone" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmLeadsAddress" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmLeadsFixedPhone" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmLeadsContactDate" class="col-sm-3 col-form-label">Contact Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmLeadsContactDate" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmLeadsAssignedTo" class="col-sm-3 col-form-label">Assigned To</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmLeadsAssignedTo" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmLeadsStatus" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="Status" placeholder="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary close-modal-crm-leads-form">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var modalCrmLeadsForm = $("#modal-crm-leads-form");

        var oTable = $('#tbl-crm-leads').DataTable({
            sDom: 'rt',
            ajax: "data/crm-leads.json", // test data only
            columns: [{
                    data: 'first_name'
                },
                {
                    data: 'last_name'
                },
                {
                    data: 'enterprise'
                },
                {
                    data: 'fixed_phone'
                },
                {
                    data: 'address'
                },
                {
                    data: 'contact_date'
                },
                {
                    data: 'assigned_to'
                },
                {
                    data: 'status'
                }
            ]
        });

        $(document).on('click', '#btn-crm-leads-add', function(e) {
            e.preventDefault();
            modalCrmLeadsForm.modal('show');
        });

        $(document).on('click', '.close-modal-crm-leads-form', function() {
            modalCrmLeadsForm.modal('hide');
        });

        // custom datatables commands
        $(document).on('keyup', '#crm-leads-filter-input', function() {
            oTable.search($(this).val()).draw();
        });
        $(document).on('click', '#btn-crm-leads-pagination-previous', function() {
            oTable.page('previous').draw('page');
        });
        $(document).on('click', '#btn-crm-leads-pagination-next', function() {
            oTable.page('next').draw('page');
        });
    });
</script>