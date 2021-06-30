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
                @include('modules.buying.newsupplier.name_and_type')
            </div>
        </div>
    </div>
</div>