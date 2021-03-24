<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">New Supplier 1</h2><span>• Not Saved</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="button" id="saveBtn">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="accordion" id="accordion">
    <form action="" method="POST">
        <div class="card">
            <div class="card-header" id="heading2">
                <h2 class="mb-0">
                    <button class="btn btn-link d-flex w-100 " type="button" data-toggle="collapse"
                        data-target="#description" aria-expanded="true">
                        NAME AND TYPE
                    </button>
                </h2>
            </div>
            <div id="description" class="collapse show" aria-labelledby="heading2">
                <div class="card-body">
                    @include('modules.buying.newsupplier.name_and_type')
                </div>
            </div>
        </div>
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
                    @include('modules.buying.newsupplier.currency_and_pricelist')
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
                    @include('modules.buying.newsupplier.credit_limit')
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
                    @include('modules.buying.newsupplier.default-payable-accounts')
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
                    @include('modules.buying.newsupplier.more-information')
                </div>
            </div>
        </div>
    </form>
</div>
<br>

<script type="text/javascript">
    $("#saveBtn").click(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData = new FormData();
        formData.append('company_name', $('#sname').val());
        formData.append('supplier_group', $('#sgroup').val());
        formData.append('phone_number', $('#snewcontact').val());
        formData.append('supplier_email', $('#snewemail').val());
        formData.append('supplier_address', $('#snewaddress').val());

        $.ajax({
            url: '/create-supplier',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                loadSupplier();
            }
        });
    });

</script>
