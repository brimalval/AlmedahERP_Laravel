<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <h2 class="navbar-brand" style="font-size: 35px;">New Purchase Receipt #</h2>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadPurchaseReceipt();">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-primary" data-target="#saveSale">
                        Save
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="accordion" id="accordion">
    <div class="card">
        <div class="card-header" id="heading1">
            <h2 class="mb-0">
                <button class="btn-sm btn-primary dropdown-toggle float-right" href="#" role="button"
                    id="dropdownMenunpi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Get Items from
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenunpi">
                    <a class="dropdown-item" href="#">Purchase Order</a>
                    <a class="dropdown-item" href="#">Purchase Receipt</a>
                </div>
            </h2>
        </div>
        <div class="collapse show" id="salesOrderCard1">
            <div class="card-body">
                <form action="" id="">
                    <div class="row">
                        <div class="col">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Series
                            </label>
                            <div class="d-flex">
                                <input type="text" class="form-input form-control" max="6" value="0000001" id="custId">
                            </div>
                            <br>
                            <label class=" text-nowrap align-middle">
                                Supplier
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Supplier Delivery Note
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                            <br>
                        </div>
                        <div class="col">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Date
                            </label>
                            <input type="date" required class="form-input form-control" id="npi_date" disabled>
                            <br>
                            <label class=" text-nowrap align-middle">
                                Posting Time
                            </label>
                            <input type="text" required class="form-input form-control" id="npi_postingT" disabled>
                            <br>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="npi_editpdt"
                                    onclick="enableDisable(this.checked, 'npi_date','npi_postingT');">
                                <script>
                                    function enableDisable(bEnable, textBoxID1, textBoxID2) {
                                        document.getElementById(textBoxID1).disabled = !bEnable;
                                        document.getElementById(textBoxID2).disabled = !bEnable;
                                    }

                                </script>
                            </div>
                            <label for="" class="form-check-label ml-4">Edit Posting Date and Time</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card" id="cardAddressContacts">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard4" aria-expanded="false">
                    ADDRESS AND CONTACTS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard4" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Select Supplier Address
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                        </div>
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Contact Person
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Select Shipping Address
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardRawMaterialSupply">
        <div id="salesOrderCard5">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" id="npi_setAwarehouse">
                            <label class=" text-nowrap align-middle">
                                Set Accepted Warehouse
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                        </div>
                        <div class="form-group" id="npi_rejectedWarehouse">
                            <label class=" text-nowrap align-middle">
                                Rejected Warehouse
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                            <label class=" text-nowrap align-middle text-muted">
                                Warehouse where you are maintaining stock of rejected Items
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Raw Materials Supplied
                            </label>
                            <select id="" class="form-control">
                                <option>Yes</option>
                                <option selected>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardUpdateStock">
        <div id="salesOrderCard5">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label class=" text-nowrap align-middle">Items</label>
                        <table class="table border-bottom table-hover table-bordered">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                        </div>
                                    </td>
                                    <td>Item</td>
                                    <td>Accepted Quantity</td>
                                    <td>Rate</td>
                                    <td>Amount</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr>
                                    <td colspan="7" style="text-align: center;">
                                        NO DATA
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" rowspan="5">
                                        <button class="btn btn-sm btn-sm btn-secondary mx-2">Add Multiple</button>
                                        <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardQuantityPHP">
        <div id="salesOrderCard5">
            <div class="card-body">
                <div class="row my-4">
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Total Quantity
                            </label>
                            <input type="number" required class="form-input form-control" id="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Total (PHP)
                            </label>
                            <input type="number" required class="form-input form-control" id="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardUpdateStock">
        <div id="salesOrderCard5">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="col-6 form-group">
                            <label class=" text-nowrap align-middle">
                                Purchase Taxes and Charges Template
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                            <br>
                        </div>
                        <label class=" text-nowrap align-middle">Purchase Taxes and Charges</label>
                        <table class="table border-bottom table-hover table-bordered">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                        </div>
                                    </td>
                                    <td>Type</td>
                                    <td>Account Head</td>
                                    <td>Rate</td>
                                    <td>Amount</td>
                                    <td>Total</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr>
                                    <td colspan="7" style="text-align: center;">
                                        NO DATA
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" rowspan="5">
                                        <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardTermsAndCondition">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard7" aria-expanded="false">
                    TERMS AND CONDITIONS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard7" class="collapse">
            <div id="salesOrderCard5">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="col-6 form-group">
                                <label class=" text-nowrap align-middle">
                                    Terms
                                </label>
                                <input type="text" required class="form-input form-control" id="">
                                <br>
                            </div>
                            <label class=" text-nowrap align-middle">Terms and Conditions</label>
                            <textarea name="editor1" class="form-control" style="resize: none;"></textarea>
                            <script>
                                CKEDITOR.replace('editor1');

                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardMoreInfo">
        <div id="salesOrderCard9">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Status
                            </label>
                            <select id="" class="form-control">
                                <option selected>Draft</option>
                                <option>Paid</option>
                                <option>Unpaid</option>
                                <option>Overdue</option>
                                <option>Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardTransporterInfo">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard10" aria-expanded="false">
                    TRANSPORTER DETAILS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard10" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Transporter Name
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                            <br>
                        </div>
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Vehicle Number
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                            <br>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Vehicle Date
                            </label>
                            <input type="date" required class="form-input form-control" id="">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/salesorder.js') }}"></script>
