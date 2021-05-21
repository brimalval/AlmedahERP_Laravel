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
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
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
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <label for="snewname">Supplier Name</label>
                            <input type="text" id="sname" class="form-control font-weight-bold" value="{{ $supplier->company_name }}">
                            <label for="snewcountry">Country</label>
                            <input type="text" id="scountry" class="form-control font-weight-bold" value="">
                            <label for="snewbank">Default Bank Account</label>
                            <input type="text" id="sbank" class="form-control font-weight-bold" value="">
                            <label for="snewbank">Tax ID</label>
                            <input type="text" id="sbank" class="form-control font-weight-bold" value="">
                            <label for="snewaddress">Address</label>
                            <input type="text" id="snewaddress" class="form-control font-weight-bold" value="{{ $supplier->supplier_address }}">
                            <div class="d-flex">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="istransporter">
                                </div>
                                <label for="istransporter">Is Transporter</label>
                            </div>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="isinternalsupploer">
                                </div>
                                <label for="isinternalsupploer">Is Internal Supplier</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="snewgroup">Supplier Group</label>
                            <input type="text" id="sgroup" class="form-control font-weight-bold" value="{{ $supplier->supplier_group }}">
                            <label for="snewtype">Supplier Type</label>
                            <select type="text" id="stype" class="form-control font-weight-bold">
                                <option value="Company" selected>Company</option>
                                <option value="Individual">Individual</option>
                            </select>
                            <label for="snewemail">Email</label>
                            <input type="email" id="snewemail" class="form-control font-weight-bold" value="{{ $supplier->supplier_email }}">
                            <label for="snewcontact">Contact No.</label>
                            <input type="text" id="snewcontact" class="form-control font-weight-bold" value="{{ $supplier->phone_number }}"><br>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="sdisabled">
                                </div>
                                <label for="sdisabled">Disabled</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
    <div class="card">
        <div class="card-header" id="heading3">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#inventory" aria-expanded="false">
                    CURRENCY AND PRICE LIST
                </button>
            </h2>
        </div>
        <div id="inventory" class="collapse">
            <div class="card-body">
                @include('modules.buying.suppSubModules.currency_and_pricelist')
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading4">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#auto-re" aria-expanded="false">
                    CREDIT LIMIT
                </button>
            </h2>
        </div>
        <div id="auto-re" class="collapse">
            <div class="card-body">
                @include('modules.buying.suppSubModules.credit_limit')
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="mb-0 d-flex w-100">ADDRESS AND CONTACTS</h5><br>
            <div class="row">
                <div class="col-6">
                    <p>No address added yet</p>
                    <button class="btn btn-sm btn-sm btn-secondary">New Address</button>
                </div>
                <div class="col-6">
                    <p>No contacts added yet</p>
                    <button class="btn btn-sm btn-sm btn-secondary">New Contact</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading5">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#units-measure" aria-expanded="false">
                    DEFAULT PAYABLE ACCOUNTS
                </button>
            </h2>
        </div>
        <div id="units-measure" class="collapse">
            <div class="card-body">
                @include('modules.buying.suppSubModules.default-payable-accounts')
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading6">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#serial-nos" aria-expanded="false">
                    MORE INFORMATION
                </button>
            </h2>
        </div>
        <div id="serial-nos" class="collapse">
            <div class="card-body">
                @include('modules.buying.suppSubModules.more-information')
            </div>
        </div>
    </div>
    --}}
</div>
{{--
<br>
<div class="card">
    <div class="card-header row">
        <h5 class="mt-2 col-10 text-muted h-100">
            Add Comment
        </h5>
        <div class="mb-0 col-2">
            <button class="btn btn-secondary btn-sm">Add Comment</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" style="border:0;"></textarea>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-left">
    <div class="col-md-12">
        <div id="content">
            <ul class="timeline">
                <li class="event">
                    <p>New Email</p>
                    <p></p>
                </li>
                <li class="event">
                    <p><span style="color: green;">+5</span> gained by You Via On Rule Item Creation - 9 months ago</p>
                    <p></p>
                </li>
                <li class="event">
                    <p>You Created - 9 Months ago</p>
                    <p></p>
                </li>
            </ul>
        </div>
    </div>
</div>
--}}