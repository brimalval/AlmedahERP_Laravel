<?php
$today = date('Y-m-d');
?>
<script src="{{ asset('js/new-purchase-invoice.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <h2 class="navbar-brand" style="font-size: 35px;">New Purchase Invoice #</h2>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadPurchaseInvoice();">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-primary" data-target="#saveSale" id="saveInvoice">
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
                    <a class="dropdown-item" href="#" data-toggle="modal"
                        data-target="#npi_purchaseReceiptModal">Purchase Receipt</a>
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
                                <input type="text" class="form-input form-control" max="6" value="PI-00X" disabled>
                            </div>
                            <br>
                            <label class=" text-nowrap align-middle">
                                Supplier
                            </label>
                            <input type="text" required class="form-input form-control" id="suppName">
                            <br>
                            <input type="text" name="" hidden id="receiptId">
                        </div>
                        <div class="col">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Date
                            </label>
                            <input type="date" required class="form-input form-control" id="npi_date" readonly value=<?=$today?>>
                            <br>
                            <label id="" class=" text-nowrap align-middle">
                                Due Date
                            </label>
                            <input type="date" required class="form-input form-control" id="npi_due_date" value=<?=$today?>>
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
                            <input type="text" required class="form-input form-control" id="suppAdd">
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
    <div class="card" id="cardUpdateStock">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard5" aria-expanded="false">
                    ITEMS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard5" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label class=" text-nowrap align-middle">Item</label>
                        <table class="table border-bottom table-hover table-bordered" id="itemsFromReceipt">
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
                            <tbody class="" id="itemsReceived">
                                <tr>
                                    <td id="emptyRow" colspan="7" style="text-align: center;">
                                        NO DATA
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" rowspan="5">
                                        <button class="btn btn-sm btn-sm btn-secondary mx-2">Add Multiple</button>
                                        <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="cardPayment">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                        data-target="#salesOrderCard6" aria-expanded="false">
                        PAYMENT
                    </button>
                </h2>
            </div>
            <div id="salesOrderCard6" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 form-group">
                            <label class=" text-nowrap align-middle">
                                Mode of Payment
                            </label>
                            <select id="paymentMethod" class="form-control">
                                <option value="" selected hidden disabled>Select Mode of Payment...</option>
                                <option value="Cash">Cash</option>
                                <option value="Installment">Installment</option>
                            </select>
                            <br>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class=" text-nowrap align-middle">
                                    Total (PHP)
                                </label>
                                <input type="number" required class="form-input form-control" id="priceToPay">
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
    </div>
</div>

<!-- Modal Purchase Receipt-->
<div class="modal fade" id="npi_purchaseReceiptModal" tabindex="-1" role="dialog"
    aria-labelledby="npi_purchaseReceiptModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Purchase Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="purchaseReceiptTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Purchase Receipt ID</th>
                            <th>Date Created</th>
                            <th>Purchase ID</th>
                            <th>Item List Received</th>
                            <th>Grand Total(PHP)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $receipt)
                        <tr>
                            <td class="text-bold">{{ $receipt->p_receipt_id }}</td>
                            <td>{{ $receipt->date_created }}</td>
                            <td>{{ $receipt->purchase_id }}</td>
                            <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                    data-toggle="modal">View</button></td>
                            <td class="price">{{ $receipt->grand_total }}</td>
                            <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                    data-dismiss="modal" onclick="loadMaterials({{ $receipt->id }})">Select</button></td>
                        </tr>
                        @endforeach
                        <!--
                        <tr>
                            <td class="text-bold">PR-001</td>
                            <td>3/31/2021</td>
                            <td>PID-001</td>
                            <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                    data-toggle="modal">View</button></td>
                            <td>P10,000</td>
                            <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                    data-dismiss="modal">Select</button></td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal itemlist-->
<div class="modal fade" id="npi_itemListView" tabindex="-1" role="dialog" aria-labelledby="npi_itemListView"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="purchaseReceiptTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Quantity Received</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="text-bold">4</td>
                            <td>100</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //$('#itemsFromReceipt').DataTable();
</script>