<?php
$today = date('Y-m-d');
$i = 1; ?>
<script src="{{ asset('js/new-purchase-invoice.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <h2 class="navbar-brand" style="font-size: 35px;">Purchase Invoice {{ $invoice->p_invoice_id }}</h2>
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
                @if ($invoice->pi_status === 'Draft')
                    <li class="nav-item li-bom">
                        <button type="button" class="btn btn-primary" onclick="updateInvoiceStatus()"
                            data-target="#saveSale" id="submitInvoice">
                            Submit
                        </button>
                    </li>
                @else
                    <button type="button" class="btn btn-primary" data-target="#saveSale" id="payInvoice">
                        Save Record
                    </button>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="accordion" id="accordion">
    <div class="card">
        @if ($invoice->pi_status == 'Draft')
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
        @endif
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
                                <input type="text" class="form-input form-control" max="6"
                                    value="{{ $invoice->p_invoice_id }}" id="invoiceId" readonly>
                            </div>
                            <br>
                            <label class=" text-nowrap align-middle">
                                Supplier
                            </label>
                            <input type="text" required class="form-input form-control"
                                value="{{ $supplier->company_name }}" id="">
                            <br>
                            <input type="text" name="" hidden id="receiptId">
                        </div>
                        <div class="col">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Date
                            </label>
                            <input type="date" required class="form-input form-control" id="npi_date" readonly
                                value={{ $invoice->date_created }}>
                            <br>
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
                            <input type="text" required class="form-input form-control"
                                value="{{ $supplier->supplier_address }}" id="">
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
                        <label class=" text-nowrap align-middle">Item Pricing</label>
                        <table class="table border-bottom table-hover table-bordered" id="itemsFromReceipt">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td>Item Code</td>
                                    <td>Quantity Ordered</td>
                                    <td>Rate</td>
                                    <td>Amount</td>
                                </tr>
                            </thead>
                            <tbody class="" id="itemsReceived">
                                @foreach ($received_items as $item)
                                    <tr id="row-<?= $i ?>">
                                        <td class="text-black-50">
                                            <input class="form-control" readonly type="text" id="item_code<?= $i ?>" value={{ $item['item_code'] }}>
                                        </td>
                                        <td class="text-black-50">
                                            <input class="form-control" readonly id="qtyAcc<?= $i ?>" type="number" min="0" value={{ $item['qty'] }}>
                                        </td> 
                                        <td class="text-black-50">
                                            <input class="form-control" readonly id="rateAcc<?= $i ?>" type="text" min="0" value={{ $item['rate'] }}>
                                        </td> 
                                        <td class="text-black-50">
                                            <input class="form-control" readonly id="amtAcc<?= $i ?>" type="text" min="0" value={{ $item['subtotal'] }}>
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                            
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
                            <select id="paymentMode" class="form-control">
                                <option value="" selected hidden readonly>{{ $invoice->payment_mode }}</option>
                                <option value="Cash">Cash</option>
                                <option value="Installment">Installment</option>
                            </select>
                            <br>
                            @if ($invoice->payment_mode === 'Installment') 
                            <div id="installmentGrp">
                                <label class=" text-nowrap align-middle">
                                    Installment Duration
                                </label>
                                <select id="installmentType" class="form-control">
                                    <option value="" selected>{{ $invoice->installment_type }}</option>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                </select>
                            </div>
                            <br>
                            @endif
                            <label class=" text-nowrap align-middle">
                                Method of Payment
                            </label>
                            <select id="paymentMethod" class="form-control">
                                <option value="" selected hidden readonly>Select Method of Payment...</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                            <br>
                            <div id="chq" hidden>
                                <label class="text-nowrap align-middle">
                                    Account Number
                                </label>
                                <input type="number" min="0" required class="form-input form-control" placeholder="Enter Account Number of Cheque" id="acctNo">
                                <br>
                                <label class="text-nowrap align-middle">
                                    Cheque Number
                                </label>
                                <input type="number" min="0" required class="form-input form-control" placeholder="Enter Cheque Number..." id="chqNo">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class=" text-nowrap align-middle">
                                    Total (PHP)
                                </label>
                                <input type="number" readonly required class="form-input form-control" value={{ $invoice->grand_total }} id="priceToPay">
                                <br>
                                @if ($invoice->pi_status !== 'Draft')
                                    <label class=" text-nowrap align-middle">
                                        Amount to Pay
                                    </label>
                                    <input type="number" min="0" required class="form-input form-control" placeholder="Enter Amount to Pay..." id="payAmount">
                                @endif
                                <br>
                                <label class=" text-nowrap align-middle">
                                    Date of Transaction
                                </label>
                                <input type="date" readonly required class="form-input form-control" value=<?=$today?> id="transDate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($invoice->pi_status !== 'Draft')
        <div class="card" id="cardPaymentLogs">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                        data-target="#salesOrderCard7" aria-expanded="false">
                        PAYMENT LOGS
                    </button>
                </h2>
            </div>
            <div id="salesOrderCard7" class="collapse">
                <div class="card-body">
                  <table id="paymentLogsTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Logs ID</th>
                            <th>Date of Payment</th>
                            <th>Payment Method</th>
                            <th>Payment Description</th>
                            <th>Amount Paid</th>
                            <td></td>
                            <!--<th>Handler</th>employee ID-->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                        <tr>
                            <td class= "text-bold">{{ $log->pi_logs_id }}</td>
                            <td>{{ $log->date_of_payment }}</td>
                            <td class="text-bold">{{ $log->payment_method }}</td>
                            <td class="text-bold">{{ $log->payment_description }}</td>
                            <td>{{ $log->amount_paid }}</td>
                            <td></td>
                        </tr>
                        @empty
                            
                        @endforelse
                        <!--
                        <tr>
                            <td class= "text-bold">PI-LOG-002</td>
                            <td>April/28/2021</td>
                            <td class="text-danger">Installment</td>
                            <td class="text-bold">Cash</td>
                            <td class="text-bold">1st Installment</td>
                            <td>1000</td>
                            <td>emp002</td>
                        </tr>
                        <tr>
                            <td class= "text-bold">PI-LOG-003</td>
                            <td>May/28/2021</td>
                            <td class="text-danger">Installment</td>
                            <td class="text-bold"><a href="#" data-toggle="modal" data-target="#npi_chequeInfo">Cheque</a></td>
                            <td class="text-bold">2nd Installment</td>
                            <td>1000</td>
                            <td>emp001</td>
                        </tr>
                    -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <label class=" text-nowrap align-middle">
                                    Total Amount Paid
                                </label>
                                <input type="number" required class="form-input form-control" readonly id="amountPaid" value="{{ $invoice->total_amount_paid }}">
                            </td>
                            <td colspan="3">
                                <label class=" text-nowrap align-middle">
                                    Balance Unpaid
                                </label>
                                <input type="number" required class="form-input form-control" readonly id="unpaidAmt" value="{{ $invoice->payment_balance }}">
                            </td>
                        </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
        </div>
        @endif
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

<!-- Modal chequeInfo-->
<div class="modal fade" id="npi_chequeInfo" tabindex="-1" role="dialog" aria-labelledby="npi_chequeInfo"
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
                            <th>Account No.</th>
                            <th>Cheque No.</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="text-bold">1001001234</td>
                            <td>0123</td>
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

