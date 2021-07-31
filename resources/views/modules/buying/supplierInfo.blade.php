<script src="{{ asset('js/supplier.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadSupplier();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">{{ $supplier->company_name }}</h2>
        </h2>
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
                        <li><a class="dropdown-item" href="#">Print</a></li>
                        <li><a class="dropdown-item" href="#">Email</a></li>
                        <li><a class="dropdown-item" href="#">Jump to field</a></li>
                        <li><a class="dropdown-item" href="#">Links</a></li>
                        <li><a class="dropdown-item" href="#">Duplicate</a></li>
                        <li><a class="dropdown-item" href="#">Rename</a></li>
                        <li><a class="dropdown-item" href="#">Reload</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                        <li><a class="dropdown-item" href="#">Customize</a></li>
                        <li><a class="dropdown-item" href="#">New Supplier</a></li>

                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#preDeleteSupp">Delete</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="button" id="updateSupplierBtn">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="s_success_message" class="alert alert-success" style="display: none;">
</div>
<div id="s_alert_message" class="alert alert-danger" style="display: none;">
</div>
<div class="card">
    <div class="card-body">
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownview"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    View
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownview">
                    <li><a class="dropdown-item" href="#">Accounting Ledger</a></li>
                    <li><a class="dropdown-item" href="#">Accounts Payable</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdowncreate"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Create
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdowncreate">
                    <li><a class="dropdown-item" href="#">Bank Account</a></li>
                    <li><a class="dropdown-item" href="#">Pricing Rule</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="accordion" id="accordion">
    <div class="card">
        <div class="card-header" id="heading1">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#dashboard"
                    aria-expanded="true">
                    DASHBOARD
                </button>
            </h2>
        </div>
        <div id="dashboard" class="collapse show">
            <div class="card-body">
                @include('modules.buying.suppSubModules.dashboard')
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading2">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#description" aria-expanded="false">
                    NAME AND TYPE
                </button>
            </h2>
        </div>
        <div id="description" class="collapse" aria-labelledby="heading2">
            <div class="card-body">
                <form action="{{ route('supplier.update', ['supplier' => $supplier->id]) }}" method="POST"
                    id="updateSupplierForm">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-6">
                            <label for="supplier_name">Company Name</label>
                            <input type="text" id="supplier_name" name="supplier_name" class="form-control"
                                value="{{ $supplier['company_name'] }}">
                            <br>
                            <label for="supplier_contact">Contact Person</label>
                            <input type="text" name="supplier_contact" id="supplier_contact" class="form-control"
                                value="{{ $supplier['contact_name'] }}">
                            <br>
                            <label for="supplier_phone">Contact No.</label>
                            <input min="1" type="number" id="supplier_phone" name="supplier_phone"
                                value="{{ $supplier['phone_number'] }}" class="form-control" placeholder="+63">
                        </div>
                        <div class="col-6">
                            <label for="supplier_group">Supplier Group</label>
                            <select name="supplier_group" id="supplier_group" class="form-control">
                                <option value="{{ $supplier['supplier_group'] }}" selected hidden>
                                    {{ $supplier['supplier_group'] }}</option>
                                <option value="Raw Materials">Raw Materials</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Hardware">Hardware</option>
                            </select>
                            <br>
                            <label for="supplier_email">E-mail Address</label>
                            <input type="email" id="supplier_email" name="supplier_email" class="form-control"
                                value="{{ $supplier['supplier_email'] }}">
                            <br>
                            <label for="supplier_address">Physical Address</label>
                            <input type="text" id="supplier_address" name="supplier_address" class="form-control"
                                value="{{ $supplier['supplier_address'] }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="preDeleteSupp" aria-labelledby="preDeleteSupp" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this supplier?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('supplier.destroy', ['supplier' => $supplier->id]) }}" id="deleteSuppForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="button" data-dismiss="modal" id="deleteSupplier">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
