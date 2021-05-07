<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Sales Order</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Edit</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">

                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" id="refreshBtn"
                        onclick="loadRefresh()">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newSalePrompt">
                        New
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<table id="salestable" class="table table-striped table-bordered hover" style="width:100%">
    <thead>
        <tr>
            <th>Sales ID</th>
            <th> Customer Name </th>
            <th>Payment Mode </th>
            <th>Sales Status</th>
            <th>Payment Balance</th>
            <th>Creation Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id='salesorder_table'>
        @foreach ($sales as $row)
            <tr>
                <td class="text-bold"> {{ $row->id }} </td>
                <td class="text-bold"> {{ $row->customer_lname }} {{ $row->customer_fname }} </td>
                <td class="text-bold"> {{ $row->payment_mode }}</td>
                @if ($row->sales_status == 'Fully Paid')
                    <td class="text-success"> {{ $row->sales_status }} </td>
                @else
                    <td class="text-danger"> {{ $row->sales_status }} </td>
                @endif
                <td class="text-bold">{{ $row->payment_balance }}</td>
                <td class="text-bold">{{ $row->transaction_date }}</td>
                <td><button type="button" class="btn btn-primary btn-sm"
                        onclick="viewOrderedProducts({{ $row->id }})" data-toggle="modal"
                        data-target="#viewOrder">View Orders</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="viewPayments({{ $row->id }})"
                        data-toggle="modal" data-target="#viewPayment">Payments</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="newSalePrompt" tabindex="-1" role="dialog" aria-labelledby="newSalePromptTitle"
    aria-hidden="true">
    <!--Sales Order Form-->
    <form method="POST" enctype="multipart/form-data" action="#" id="sales_order_form">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Order</h5>
                    <div class="d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary m-1" id="saveSaleOrder" value="Submit">
                            Save
                        </button>
                        <button type="button" class="btn btn-secondary m-1" data-dismiss="modal"
                            data-target="#newSalePrompt" id="closeSaleOrderModal">
                            Close
                        </button>
                    </div>
                </div>
                <div class="modal-body p-5">
                    <!--
                    Back-end note: The contents of 'salesorderform.php' were transferred here instead of using 
                    'include' syntax for easier utilization of Blade template features.
                -->
                    <div class="accordion" id="accordion">
                        <div class="card">
                            <div class="card-header" id="heading1">
                                <h2 class="mb-0">
                                    <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse"
                                        data-target="#salesOrderCard1" aria-expanded="true">
                                        CUSTOMER INFORMATION
                                    </button>
                                </h2>
                            </div>
                            <div class="collapse show" id="salesOrderCard1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Customer ID
                                            </label>

                                            <input list="customers" class="form-input form-control" name="customer_id"
                                                onchange="customeridselector(value);" autocomplete="off">
                                            <datalist id="customers">
                                                @foreach ($customers as $row)
                                                    <option value="{{ $row->id }}"> {{ $row->customer_lname }}
                                                        {{ $row->customer_fname }} </option>
                                                @endforeach
                                                <option value=" + Add new">
                                            </datalist>
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                First Name
                                            </label>
                                            <input type="text" required class="form-input form-control" id="fName"
                                                name="fName">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Last Name
                                            </label>
                                            <input type="text" required class="form-input form-control" id="lName"
                                                name="lName">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Contact Number
                                            </label>
                                            <input type="text" required class="form-input form-control" id="contactNum"
                                                name="contactNum">
                                        </div>
                                        <div class="col">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Email Address
                                            </label>
                                            <input type="text" required class="form-input form-control" id="custEmail"
                                                name="custEmail">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Branch Name
                                            </label>
                                            <input type="text" required class="form-input form-control" id="branchName"
                                                name="branchName">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Company Name
                                            </label>
                                            <input type="text" required class="form-input form-control" id="companyName"
                                                name="companyName">
                                            <br>
                                            <label>Address</label>
                                            <input class="form-control" required id="custAddress" name="custAddress">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2 class="mb-0">
                                    <button class="btn btn-link d-flex w-100 collapsed" type="button"
                                        data-toggle="collapse" data-target="#salesOrderCard2" aria-expanded="false">
                                        SALES
                                    </button>
                                </h2>
                            </div>
                            <div id="salesOrderCard2" class="collapse">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Sales ID
                                                </label>
                                                <input type="text" class="form-input form-control" max="20" id="salesId"
                                                    disabled placeholder="Automatically Generated">
                                                <br>
                                                <label class=" text-nowrap align-middle">
                                                    Product Code
                                                </label>
                                                <select class="form-control" id="saleProductCode" required
                                                    name="saleProductCode" onchange="enableAddtoProduct()">
                                                    <option value="none" selected disabled hidden>
                                                        Select an Option
                                                    </option>
                                                    @foreach ($products as $row)
                                                        <option value="{{ $row->product_code }}" data-price = "{{ $row->sales_price_wt }}" data-stock = "{{ $row->stock_unit }}">
                                                            {{ $row->product_code }}</option>
                                                    @endforeach
                                                </select>
                                                <br>

                                            </div>
                                        </div>
                                        <?php $today = date('Y-m-d'); ?>
                                        <div class="col">
                                            <div class="form-group">
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Transaction Date
                                                </label>
                                                <input class="form-control" type="date" value=<?= $today ?> id="saleDate" name="saleDate" required>
                                            <br>
                                            <label class="text-nowrap align-middle">
                                                Add to list
                                            </label>
                                            <button type="button" class="btn btn-primary btn-sm btn-block" onclick="addToTable()" id="btnAddProduct" disabled>Add Product</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <table class="table border-bottom table-hover table-bordered table-sm">
                                          <thead class="border-top border-bottom bg-light">
                                            <tr class="text-muted">
                                              <td></td>
                                              <td class="font-weight-bold text-center">Product Code</td>
                                              <td class="font-weight-bold text-center">Quantity to Purchase</td>
                                              <td class="font-weight-bold text-center">Stock </td>
                                              <td class="font-weight-bold text-center">Price </td>
                                              <td class="font-weight-bold text-center">Actions</td>
                                            </tr>
                                          </thead>
                                          <tbody id= "ProductsTable">

                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6">
                                                <label class="text-nowrap align-middle">
                                                    Cost Price
                                                </label>
                                                <input type="number" class="form-input form-control sellable" id="costPrice" name="costPrice" placeholder=0 ></td>
                                              </td>
                                            </tr>
                                          </tfoot>
                                        </table>
                                        <div class="row">
                                          <div class="col-12 d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary m-1" id='btnSalesCalculate' style="display:none;">
                                              <a class="" href="#" style="text-decoration: none;color:white" >
                                                Calculate
                                              </a>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label class=" text-nowrap align-middle">
                                            Sales Supply Method
                                        </label>
                                        <select class="form-control sellable" id="saleSupplyMethod" required name="saleSupplyMethod"  onchange="selectSalesMethod();">
                                            <option selected disabled>Please Select</option>
                                            <option value="Produce">Instock</option>
                                            <option value="Purchase">Purchase</option>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="cardComponent" style="display:none;">
                            <div class="card-header">
                                <h2 class="mb-0">
                                    <button class="btn btn-link d-flex w-100 collapsed" type="button"
                                        data-toggle="collapse" data-target="#salesOrderCard3" aria-expanded="false">
                                        COMPONENTS
                                    </button>
                                </h2>
                            </div>
                            <div id="salesOrderCard3" class="collapse">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <table class="table border-bottom table-hover table-bordered">
                                                <thead class="border-top border-bottom bg-light">
                                                    <tr class="text-muted">
                                                        <td></td>
                                                        <td>Component Name</td>
                                                        <td>Category</td>
                                                        <td>Qty. Available</td>
                                                        <td>Qty. Needed</td>
                                                        <td>Status</td>
                                                    </tr>
                                                </thead>
                                                <tbody class="components">
                                                    <!--Components Body -->
                                                    
                                                </tbody>
                                                
                                            </table>
                                            <div id="create-material-req-btn">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="cardPayments">
                    <div class="card-header">
                      <h2 class="mb-0">
                        <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#salesOrderCard4" aria-expanded="false">
                          PAYMENTS
                        </button>
                      </h2>
                    </div>
                    <div id="salesOrderCard4" class="collapse">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label class="text-nowrap align-middle">
                                        Payment Method
                                    </label>
                                    <select class="form-control sellable" required id="salePaymentMethod" name="salePaymentMethod" onchange="selectPaymentMethod();">
                                        <option selected disabled>Please Select</option>
                                        <option value="Cash">Full Payment(Cash)</option>
                                        <option value="Installment">Installment</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col">
                                    <label class="text-nowrap align-middle">
                                        Payment Type
                                    </label>
                                    <select class="form-control sellable" required onchange="creationSelectPaymentType()" id="paymentType"  name="paymentType" >
                                        <option selected disabled>Payment Type</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>
                                <br>
                            </div>
                            <br>
                            <div class="col" id="account_cheque_no" name="account_cheque_no" style="display:none">
                                <label  >
                                    Cheque No.
                                </label>
                                <br>
                                <input type="text" class="form-input form-control" id="cheque_no" name="cheque_no" placeholder="Cheque No">
                            </div>
                            <br>
                            <div class="col" id="account_no_div" name="account_no_div" style="display:none">
                                <label >
                                    Account No.
                                </label>
                                <input type="text" class="form-input form-control" id="account_no" name="account_no" placeholder="Account No">
                            </div>
                            <br>
                            <div class="col " id="account_name_div" name="account_name_div" style="display:none">
                                <label >
                                    Account Name.
                                </label>
                                <input type="text" class="form-input form-control" id="account_name" name="account_name" placeholder="Account Name">
                            </div>
                            <br>
                            <div class="col" id="bank_name_div" name="bank_name_div" style="display:none">
                                <label>
                                    Bank Name
                                </label>
                                <input type="text" class="form-input form-control" id="bank_name" name="bank_name" placeholder="Bank Name">
                            </div>
                            <br>
                            <div class="col" id="branch_location_div" name="branch_location_div" style="display:none">
                                <label>
                                    Bank Name
                                </label>
                                <input type="text" class="form-input form-control" id="branch_location" name="branch_location" placeholder="Bank Name">
                            </div>
                            <br>
                            <div class="row" id="paymentInstallment" style="display:none;" onchange="installmentType()" >
                                <div class="col">
                                    <label class="text-nowrap align-middle">
                                        Initial Payment(Downpayment)
                                    </label>
                                    <input type="text" class="form-input form-control sellable" id="saleDownpaymentCost" name="saleDownpaymentCost" placeholder="0.00">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="text-nowrap align-middle">
                                            Installment Type
                                        </label>
                                        <select class="form-control" id="installmentType" name="installmentType">
                                            <option selected disabled>Please Select</option>
                                            <option value = "3 months">Installment 3 months</option>
                                            <option value = "6 months">Installment 6 months</option>
                                            <option value = "12 months">Installment 12 months</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <table class="table border-bottom table-hover table-bordered">
                              <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                  <td></td>
                                  <td class="text-center">Description</td>
                                  <td class="text-center">Amount Due</td>
                                </tr>
                              </thead>
                              <tbody id="payments_table_body">
                                
                              </tbody>
                              <tfoot>
                                <tr id="rowTotal">
                                  <td></td>
                                  <td class="font-weight-bold text-center">TOTAL AMOUNT:</td>
                                  <td class="text-center">
                                    <input class="form-control" type="text" id="payment_total_amount" placeholder="0.00" disabled>
                                  </td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                        
                        {{-- Uneccessaru
                         <div class="row">
                          <div class="col-12 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary m-1" data-dismiss="modal" data-target="#newSalePrompt" data-name="Work Order" data-parent="manufacturing">
                              <a class="" href="#" style="text-decoration: none;color:white">
                                Save Payment
                              </a>
                          </div>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                <!--
                    'salesorderform.php' contents end here
                -->
            </div>
            <script src="{{ asset('js/salesorder.js') }}"></script>
            <div class="modal-footer d-flex">
                <div class="col">
                    <button class="btn btn-primary m-1 float-right menu" data-dismiss="modal" hidden> </button>
                    <button type="submit" class="btn btn-primary m-1" value="Submit" class="btn btn-primary m-1 float-right menu" id="toWorkOrder">
                        Save
                    </button>
                </div>
                <span id="notif" class="mr-auto text-danger">
                    
                </span>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
    </form>
    <!--End Form-->
</div>


{{-- Modal for view orders --}}
<div class="modal fade" id="viewOrder" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Ordered Products</h5>
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-secondary m-1" data-dismiss="modal"
                        data-target="#viewOrder">
                        Close
                    </button>
                </div>
            </div>
            <div class="modal-body p-5">
        <div class="accordion" id="accordion">
            <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <table class="table border-bottom table-hover table-bordered table-sm">
                                    <thead class="border-top border-bottom bg-light">
                                        <tr class="text-muted">
                                        <td class="font-weight-bold text-center">Product Code</td>
                                        <td class="font-weight-bold text-center">Quantity</td>
                                        </tr>
                                    </thead>
                                    <tbody id= "viewProductsTable">
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div
    class="modal fade"
    id="viewPayment"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payments</h5>
                <div class="d-flex flex-row-reverse">
                    <button
                        type="button"
                        class="btn btn-secondary m-1"
                        data-dismiss="modal"
                        data-target="#viewPayment"
                        id = "closeModal"
                    >
                        Close
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="accordion">
                    <div class="card" id="cardPaymentLogs">
                        <div class="card-header">
                            <h2 class="mb-0">
                                <button
                                    class="btn btn-link d-flex w-100 collapsed"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#salesOrderCard5"
                                    aria-expanded="false"
                                >
                                    PAYMENT LOGS
                                </button>
                            </h2>
                        </div>
                        <div id="salesOrderCard5" class="collapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <table
                                            class="table border-bottom table-hover"
                                        >
                                            <thead
                                                class="border-top border-bottom bg-light"
                                            >
                                                <tr class="text-muted">
                                                    <td
                                                        class="text-center font-weight-bold"
                                                    >
                                                        Payment ID
                                                    </td>
                                                    <td
                                                        class="text-center font-weight-bold"
                                                    >
                                                        Date Paid
                                                    </td>
                                                    <td
                                                        class="text-center font-weight-bold"
                                                    >
                                                        Amount Paid
                                                    </td>
                                                    <td
                                                        class="text-center font-weight-bold"
                                                    >
                                                        Description
                                                    </td>
                                                    <td
                                                        class="text-center font-weight-bold"
                                                    >
                                                        Payment Method
                                                    </td>
                                                    <td
                                                        class="text-center font-weight-bold"
                                                    >
                                                        Status
                                                    </td>
                                                    <td
                                                        class="text-center font-weight-bold"
                                                    >
                                                        Transaction Handler
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody id = "view_payment_logs">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="accordion" aria-expanded="true">
                    <div class="card" id="cardPayments">
                    <div class="card-header">
                      <h2 class="mb-0">
                        <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#salesOrderCard4" aria-expanded="false">
                          PAYMENTS
                        </button>
                      </h2>
                    </div>
                    <div id="salesOrderCard4" class="collapse">
                    <form id="makePaymentForm" method="POST" enctype="multipart/form-data" action="#">
                      @csrf
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label class="text-nowrap align-middle">
                                        Payment
                                    </label>
                                    <select class="form-control sellable" id="view_salePaymentMethod" name= "view_salePaymentMethod">
                                        <option selected disabled required>Please Select</option>
                                        
                                    </select>
                                </div>
                                <br>
                                <div class="col">
                                    <label class="text-nowrap align-middle">
                                        Payment Type
                                    </label>
                                      <select class="form-control sellable" id="view_paymentType" name="view_paymentType" onchange="selectPaymentType();" required>
                                          <option selected disabled>Payment Type...</option>
                                          <option value="Cash">Cash</option>
                                          <option value="Cheque">Cheque</option>
                                      </select>
                                </div>
                                <br>
                            </div>
                            <br>
                            <div class="col" id="view_cheque_no_div" name="view_cheque_no_div" style="display:none">
                                <label  >
                                    Cheque No.
                                </label>
                                <br>
                                <input type="text" class="form-input form-control" id="view_cheque_no" name="view_cheque_no" placeholder="Cheque No">
                            </div>
                            <br>
                            <div class="col" id="view_account_no_div" name="view_account_no_div" style="display:none">
                                <label >
                                    Account No.
                                </label>
                                <input type="text" class="form-input form-control" id="view_account_no" name="view_account_no" placeholder="Account No">
                            </div>
                            <br>
                            <div class="col " id="view_account_name_div" name="view_account_name_div" style="display:none">
                                <label >
                                    Account Name.
                                </label>
                                <input type="text" class="form-input form-control" id="view_account_name" name="view_account_name" placeholder="Account Name">
                            </div>
                            <br>
                            <div class="col" id="view_bank_name_div" name="view_bank_name_div" style="display:none">
                                <label >
                                    Bank Name
                                </label>
                                <input type="text" class="form-input form-control" id="view_bank_name" name="view_bank_name" placeholder="Bank Name">
                            </div>
                            <br>
                            <div class="col" id="view_branch_location_div" name="view_branch_location_div" style="display:none">
                                <label >
                                    Branch Location
                                </label>
                                <input type="text" class="form-input form-control" id="view_branch_location" name="view_branch_location" placeholder="Bank Name">
                            </div>
                            <br>
                            <div class="col" id="viewaccount_no_div">
                                <label >
                                    Customer Representative
                                </label>
                                <input type="text" class="form-input form-control" placeholder="Customer Rep" id="view_customer_rep" name="view_customer_rep" required>
                            </div>
                            <br>

                            <table class="table border-bottom table-hover table-bordered">
                              <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                  <td></td>
                                  <td class="text-center">Description</td>
                                  <td class="text-center">Amount Due</td>
                                </tr>
                              </thead>
                              <tbody id="payments_table_body">
                                
                              </tbody>
                              <tfoot>
                                <tr id="rowTotal">
                                  <td></td>
                                  <td class="font-weight-bold text-center">TOTAL AMOUNT:</td>
                                  <td class="text-center">
                                    <input class="form-control" type="text" placeholder="0.00" id="view_totalamount" name="view_totalamount" readonly>
                                  </td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                            <div class="row">
                              <div class="col-12 d-flex justify-content-center">
                                <span id="view_notif" class="mr-auto text-danger">

                                </span>
                                <button type="submit" class="btn btn-primary m-1" id="view_savepayment">
                                  <a style="text-decoration: none;color:white" >
                                    Save Payment
                                  </a>
                            </div>
                        </div>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    var x;
    // From back-end: to show that data can be shown in table
    $(document).ready(function() {
        x = $('#salestable').DataTable();
        // Gets Current date today
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); 
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        document.getElementById('currentDate').value = today;
        var componentsOrder;
        var materialsInComponents;
    });

    $("#gotoworkorder").click(function(){
        console.log("Clicked");
        $("#hiddenworkorder").click();
    })
    function customeridselector(value){
        if(value == " + Add new" || value==""){
            document.getElementById('fName').value = "";
            document.getElementById('lName').value = "";
            document.getElementById('contactNum').value = "";
            document.getElementById('custEmail').value = "";
            document.getElementById('branchName').value = "";
            document.getElementById('companyName').value = "";
            document.getElementById('custAddress').value = "";
        }else{
            customerDict = findRow(value);
            document.getElementById('fName').value = customerDict['customer_fname'];
            document.getElementById('lName').value = customerDict['customer_lname'];
            document.getElementById('contactNum').value = customerDict['contact_number'];
            document.getElementById('custEmail').value = customerDict['email_address'];
            document.getElementById('branchName').value = customerDict['branch_name'];
            document.getElementById('companyName').value = customerDict['company_name'];
            document.getElementById('custAddress').value = customerDict['address'];
        }
    }
    // Finds the row of the given id
    function findRow(value){
        @foreach ($customers as $rows)
            test1={
            "customer_lname": "{{ $rows->customer_lname }}",
            "customer_fname": "{{ $rows->customer_fname }}",
            "contact_number": "{{ $rows->contact_number }}",
            "email_address": "{{ $rows->email_address }}",
            "branch_name": "{{ $rows->branch_name }}",
            "company_name": "{{ $rows->company_name }}",
            "address": "{{ $rows->address }}"};
            if ({{ $rows->id }} == value){
            return test1;
            }
        @endforeach
    }
    $('#makePaymentForm').submit(function(e){
        e.preventDefault();
        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
             }
        });
        var formData = new FormData(this);
        theId = document.getElementById('view_savepayment').value;
        formData.append("id", theId);
        
        $.ajax({
            type:'POST',
            url:"/addPayment",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log("Payment Sucess")
                document.getElementById('closeModal').click();
                loadRefresh();
            },
            error: function(data) {
                console.log("error");
                console.log(data);

                $('#view_notif').text('');
                $('#view_notif').html(
                    '<li>' + data.responseJSON["message"] + '</li>'
                );
            }
        });
    })
    // For creation of sales order
    $("#sales_order_form").submit(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData(this);
        console.log(currentCart);
        formData.append("cart", currentCart);
        formData.append("component", JSON.stringify(componentsOnly));
        $.ajax({
            type: 'POST',
            url: "/createsalesorder",
            data: formData, 
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#saveSaleOrder1').click(function() {
                    $('#newSalePrompt').modal('hide');
                });
                //@TODO
                document.getElementById('closeSaleOrderModal').click();
                if (mat_insufficient) {
                        // CREATE MATERIAL REQUEST
                        console.log("DATA FOR REFERENCE");
                        console.log(createMatRequestItems);
                    var fd = new FormData();
                    createMatRequestItems.forEach(element => {
                        fd.append('item_code[]', element.item_code);
                        fd.append('quantity_requested[]', element.quantity_needed_for_request);
                        fd.append('procurement_method[]', 'buy');
                    });
                    var requiredDate = new Date();
                    requiredDate.setDate(requiredDate.getDate() + 7);
                    var requiredYear = requiredDate.getFullYear();
                    var requiredDay = (requiredDate.getDate() < 10) ? "0" + requiredDate.getDate() : requiredDate.getDate();
                    var requiredMonth = (requiredDate.getMonth()+1 < 10) ? "0" + (requiredDate.getMonth() + 1) : requiredDate.getMonth() + 1;
                    var formattedDate = requiredYear + "-" + requiredMonth + "-" + requiredDay;
                    fd.append('required_date', formattedDate);
                    var currProd = $('#saleProductCode').val();
                    fd.append('purpose', 'Replenishing required materials for ' + currProd);
                    fd.append('mr_status', 'Draft');
                    fd.append('work_order_no', data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "/materialrequest",
                        data: fd, 
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            console.log(data);
                        },
                        error: function(data){

                        }
                    });
                }
                //Minus stocks in env_raw materials. Zeroes stock if qty is insufficient since it will be saved in material request
                minusStocks(componentsOrder, materialsInComponents);
                loadRefresh(); 
            },
            error: function(data) {
                console.log("error");
                console.log(data);

                $('#notif').text('');
                $('#notif').html(
                    '<li>' + data.responseJSON["message"] + '</li>'
                );
            }
        });
    });
    function getCalculatedPrice($name){
        @foreach ($products as $row)
            if ("{{ $row->product_code }}" == $name)
            return {{ $row->sales_price_wt }}
        @endforeach
    }
    function loadRefresh(){
        var stats = "";
        $.ajax({
            url: '/refresh',
            type: 'get',
            success: function(response){
                x.clear();
                response.forEach(row => {
                    if(row['sales_status'] == "Fully Paid"){
                        stats = "<td class='text-success'>" + row['sales_status']+ " </td>";
                    }else{
                        stats = "<td class='text-danger'>" + row['sales_status']+ " </td>";
                    }
                   x.row.add([
                    `<tr>
                        <td class= "text-bold">  ` + row['id'] + ` </td> `,`
                        <td class= "text-bold"> ` + row['customer_lname'] + `  ` + row['customer_fname'] + `</td> `,`
                        <td class= "text-bold"> ` + row['payment_mode'] + `</td> `,`
                        ` + stats + ` `,`
                        <td class="text-bold"> ` + row['payment_balance'] + `</td> `,`
                        <td class="text-bold"> ` + row['transaction_date'] + `</td> `,`
                        <td><button type="button" class="btn btn-primary btn-sm" onclick="viewOrderedProducts( ` + row['id'] + `)" data-toggle="modal" data-target="#viewOrder">View Orders</button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="viewPayments( ` + row['id'] + ` )" data-toggle="modal" data-target="#viewPayment">Payments</button>
                        </td>
                    </tr>`
                   ]).draw(false);
                });
                formReset();
            }
        });
    }
    function formReset(){
        document.getElementById('sales_order_form').reset();
        totalValue = 0;
        currentCart = [];
        createMatRequestItems = [];
        minusStocks = [];
        materialsInComponents= [];
        componentsOnly = [];
        console.log(currentCart);
        $('#ProductsTable tr').remove();
        $(".components tr").remove();
        $('#notif').text('');
        $('#view_notif').text('');
    }
</script>
