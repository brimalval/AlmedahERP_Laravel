<?php
$today = date('Y-m-d');
$i = 1; ?>
<script src="{{ asset('js/purchaseinvoice.js') }}"></script>
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
        <div class="collapse show" id="">
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
                    data-target="#piSupplier" aria-expanded="false">
                    ADDRESS AND CONTACTS
                </button>
            </h2>
        </div>
        <div id="piSupplier" class="collapse">
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
                    data-target="#piItems" aria-expanded="false">
                    ITEMS
                </button>
            </h2>
        </div>
        <div id="piItems" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label class=" text-nowrap align-middle">Item Pricing</label>
                        <table class="table border-bottom table-hover table-bordered" id="itemsFromReceipt">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td>Item Code</td>
                                    <td>Item Name</td>
                                    <td>Quantity Ordered</td>
                                    <td>Rate</td>
                                    <td>Amount</td>
                                </tr>
                            </thead>
                            <tbody class="" id="itemsReceived">
                                @foreach ($received_items as $item)
                                    <tr id="row-<?= $i ?>">
                                        <td class="text-black-50">
                                            <span id="item_code<?= $i ?>">{{ $item['item']->item_code }}</span>
                                        </td>
                                        <td class="text-black-50">
                                            <span id="item_name<?= $i ?>">{{ $item['item']->item_name }}</span>
                                        </td>
                                        <td class="text-black-50">
                                            <span id="qtyAcc<?= $i ?>">{{ $item['qty'] }}</span>
                                        </td> 
                                        <td class="text-black-50">
                                            <span id="rateAcc<?= $i ?>">{{ $item['rate'] }}</span>
                                        </td> 
                                        <td class="text-black-50">
                                            <span id="amtAcc<?= $i ?>">{{ $item['subtotal'] }}</span>
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <td colspan="5" rowspan="2"> 
                                </td>
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
                        data-target="#piPayment" aria-expanded="false">
                        PAYMENT
                    </button>
                </h2>
            </div>
            <div id="piPayment" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 form-group">
                            <label class=" text-nowrap align-middle">
                                Mode of Payment
                            </label>
                            <select id="paymentMode" class="form-control" 
                                @if($invoice->pi_status !== 'Draft')
                                    disabled
                                @else
                                    onchange="onChangePIFunction();"
                                @endif
                            >
                                <option value="{{ $invoice->payment_mode }}" selected hidden readonly>{{ $invoice->payment_mode }}</option>
                                <option value="Cash">Full Payment (Cash)</option>
                                <option value="Installment">Installment</option>
                            </select>
                            <br>
                            <div id="installmentGrp">
                                <label class=" text-nowrap align-middle">
                                    Installment Duration
                                </label>
                                <select readonly 
                                id="installmentType"
                                @if($invoice->pi_status === 'Draft')
                                onchange="onChangePIFunction();"
                                @endif 
                                class="form-control">
                                    @if($invoice->pi_status !== 'Draft')
                                    <option hidden 
                                        @if ($invoice->installment_type === '3 Months')
                                            value="3"
                                        @else
                                            value="6"
                                        @endif 
                                        selected
                                    >{{ $invoice->installment_type }}</option>
                                    @else
                                    <option value="{{ $invoice->installment_type }}" selected hidden>{{ $invoice->installment_type }}</option>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                    @endif
                                </select>
                            </div>
                            <br>
                            @if ($invoice->pi_status !== 'Draft' && $invoice->pi_status !== 'Paid')
                            <label class=" text-nowrap align-middle">
                                Method of Payment
                            </label>
                            <select id="paymentMethod" class="form-control">
                                <option value="non" selected hidden readonly>Select Method of Payment...</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                            @endif
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
                                <br>
                                <label class="text-nowrap align-middle">
                                    Bank Name
                                </label>
                                <input type="text" required class="form-input form-control" placeholder="Enter Bank Name..." id="bankName">
                                <br>
                                <label class="text-nowrap align-middle">
                                    Bank Location
                                </label>
                                <input type="text" required class="form-input form-control" placeholder="Indicate Branch of Bank..." id="bankBranch">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class=" text-nowrap align-middle">
                                    Total (PHP)
                                </label>
                                <input type="number" readonly required class="form-input form-control" value={{ $invoice->grand_total }} id="priceToPay">
                                <br>
                                @if ($invoice->pi_status !== 'Draft' && $invoice->pi_status !== 'Paid')
                                    <label class=" text-nowrap align-middle">
                                        Amount to Pay
                                    </label>
                                    <input type="number" min="0" required class="form-input form-control" 
                                        @if ($invoice->payment_mode === 'Cash')
                                            readonly
                                            value = {{ $invoice->grand_total }}
                                        @else
                                            placeholder="Enter Amount to Pay..." 
                                        @endif 
                                    id="payAmount">
                                    <br>
                                @endif
                                <label class=" text-nowrap align-middle">
                                    Date of Transaction
                                </label>
                                <input type="date" readonly required class="form-input form-control" value="{{ $invoice->date_created }}" id="transDate">
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
                        data-target="#paymentLogs" aria-expanded="false">
                        PAYMENT LOGS
                    </button>
                </h2>
            </div>
            <div id="paymentLogs" class="collapse">
                <div class="card-body">
                  <table id="paymentLogsTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Logs ID</th>
                            <th>Date of Payment</th>
                            <th>Payment Method</th>
                            <th>Payment Description</th>
                            <th>Amount Paid</th>
                            <th>View Cheque Details</th>
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
                            <td>
                                @if ($log->payment_method === 'Cheque')
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                data-target="#npi_chequeInfo" onclick="viewChequeDetails({{ $log->id }})">View</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td id="emptyPILog" colspan="6">
                                <center>NO PAYMENT LOGS AVAILABLE</center>
                            </td>
                        @endforelse
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
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                        data-target="#piInfo" aria-expanded="false">
                        MORE INFORMATION
                    </button>
                </h2>
            </div>
            <div id="piInfo" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class=" text-nowrap align-middle">
                                    Status
                                </label>
                                <select disabled id="" class="form-control">
                                    <option selected>{{ $invoice->pi_status }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal chequeInfo-->
<div class="modal fade" id="npi_chequeInfo" tabindex="-1" role="dialog" aria-labelledby="npi_chequeInfo"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="chqTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Account No.</th>
                            <th>Cheque No.</th>
                            <th>Bank</th>
                            <th>Bank Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="chq-accNo" class="text-bold"></td>
                            <td id="chq-num"></td>
                            <td id="chq-bank"></td>
                            <td id="chq-branch"></td>
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
    $("#prTable").DataTable();
    $('#itemsFromReceipt').DataTable({
        "searching" : false,
        "paging" : false,
        "ordering" : false,
        "info" : false,
    });
    $('#paymentLogs').DataTable({
        "searching" : false,
        "paging" : false,
        "ordering" : false,
        "info" : false,
    });
</script>