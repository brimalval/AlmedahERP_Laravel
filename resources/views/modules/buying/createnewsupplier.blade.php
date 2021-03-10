<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">New Supplier 1</h2><span>• Not Saved</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="accordion" id="accordion">
    <div class="card">
        <div class="card-header" id="heading2">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 " type="button" data-toggle="collapse" data-target="#description" aria-expanded="true">
                    NAME AND TYPE
                </button>
            </h2>
        </div>
        <div id="description" class="collapse show" aria-labelledby="heading2">
            <div class="card-body">
                <?php include 'newsupplier/name_and_type.php' ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading3">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#inventory" aria-expanded="false">
                    CURRENCY AND PRICE LIST
                </button>
            </h2>
        </div>
        <div id="inventory" class="collapse">
            <div class="card-body">
                <?php include 'newsupplier/currency_and_pricelist.php' ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading4">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#auto-re" aria-expanded="false">
                    CREDIT LIMIT
                </button>
            </h2>
        </div>
        <div id="auto-re" class="collapse">
            <div class="card-body">
                <?php include 'newsupplier/credit_limit.php' ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading5">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#units-measure" aria-expanded="false">
                    DEFAULT PAYABLE ACCOUNTS
                </button>
            </h2>
        </div>
        <div id="units-measure" class="collapse">
            <div class="card-body">
                <?php include 'newsupplier/default-payable-accounts.php' ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading6">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#serial-nos" aria-expanded="false">
                    MORE INFORMATION
                </button>
            </h2>
        </div>
        <div id="serial-nos" class="collapse">
            <div class="card-body">
                <?php include 'newsupplier/more-information.php' ?>
            </div>
        </div>
    </div>
</div>
<br>