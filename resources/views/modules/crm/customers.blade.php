<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Customers</h2>
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
                    <button style="background-color: #007bff;" id="btn-crm-customers-add" class="btn btn-info btn" style="float: left;">New</button>
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
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="crm-customers-filter-input" aria-label="Search table">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="btn-crm-customers-filter">
                                <span class="fa fa-search fa-fw"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-50">
                    <div class="btn-group float-right" role="group" aria-label="Right Group">
                        <button type="button" id="btn-crm-customers-pagination-previous" class="btn btn-outline-secondary">
                            <span class="fa fa-chevron-left fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-customers-pagination-next" class="btn btn-outline-secondary">
                            <span class="fa fa-chevron-right fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-customers-display-list" class="btn btn-outline-secondary" title="Display Table List">
                            <span class="fa fa-th-list fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-customers-display-thumbs" class="btn btn-outline-secondary" title="Display Thumbs List">
                            <span class="fa fa-th fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-customers-export-file" class="btn btn-outline-secondary">
                            <span class="fa fa-file-alt fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-customers-settings" class="btn btn-outline-secondary">
                            <span class="fa fa-wrench fa-fw"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <table id='tbl-crm-customers' class="table table-sm table-hover w-100">
                <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Company</th>
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

<div class="modal" tabindex="-1" role="dialog" id="modal-crm-customers-form">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customers Form</h5>
                <button type="button" class="close-modal-crm-customers-form" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="crmcustomersFirstName" class="col-sm-3 col-form-label">Field 1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmcustomersFirstName" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmcustomersLastName" class="col-sm-3 col-form-label">Field 2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmcustomersLastName" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmcustomersEnterprise" class="col-sm-3 col-form-label">Field 3</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmcustomersEnterprise" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmcustomersFixedPhone" class="col-sm-3 col-form-label">Field 4</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmcustomersFixedPhone" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmcustomersAddress" class="col-sm-3 col-form-label">Field 5</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmcustomersFixedPhone" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmcustomersContactDate" class="col-sm-3 col-form-label">Field 6</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmcustomersContactDate" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmcustomersAssignedTo" class="col-sm-3 col-form-label">Field 7</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmcustomersAssignedTo" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="crmcustomersStatus" class="col-sm-3 col-form-label">Field 8</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="Status" placeholder="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary close-modal-crm-customers-form">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var modalCrmcustomersForm = $("#modal-crm-customers-form");

        var oTable = $('#tbl-crm-customers').DataTable({
            sDom: 'rt',
            ajax: "data/crm-customers.json", // test data only
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

        $(document).on('click', '#btn-crm-customers-add', function(e) {
            e.preventDefault();
            modalCrmcustomersForm.modal('show');
        });

        $(document).on('click', '.close-modal-crm-customers-form', function() {
            modalCrmcustomersForm.modal('hide');
        });

        // custom datatables commands
        $(document).on('keyup', '#crm-customers-filter-input', function() {
            oTable.search($(this).val()).draw();
        });
        $(document).on('click', '#btn-crm-customers-pagination-previous', function() {
            oTable.page('previous').draw('page');
        });
        $(document).on('click', '#btn-crm-customers-pagination-next', function() {
            oTable.page('next').draw('page');
        });

        $(document).on('click', "#btn-crm-customers-display-list", function(e) {
            e.preventDefault();
        });
        $(document).on('click', "#btn-crm-customers-display-thumbs", function(e) {
            e.preventDefault();
        });
    });
</script>