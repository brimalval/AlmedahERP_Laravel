<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadSalesOrder();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">{{ $product->product_name }}</h2>
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
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Edit</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="">Refresh</button>
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
                <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard1" aria-expanded="true">
                    CUSTOMER INFORMATION
                </button>
            </h2>
        </div>
        <div class="collapse show" id="salesOrderCard1">
            <div class="card-body">
                <form action="" id="saleCustomerForm">
                    <div class="row">
                        <div class="col">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Customer ID
                            </label>
                            <div class="d-flex">
                                <input type="number" class="form-input form-control" max="6" value="{{ $customer->customer_id }}" disabled
                                    id="custId" required>
                                <button class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <br>
                            <label class=" text-nowrap align-middle">
                                First Name
                            </label>
                            <input type="text" required class="form-input form-control" id="fName" value="{{ $customer->customer_fname }}"required>
                            <br>
                            <label class=" text-nowrap align-middle">
                                Last Name
                            </label>
                            <input type="text" required class="form-input form-control" id="lName" value="{{ $customer->customer_lname }}">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Contact Number
                            </label>
                            <input type="number" required class="form-input form-control" value="{{ $customer->contact_number }}" id="contactNum">
                        </div>
                        <div class="col">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Email Address
                            </label>
                            <input type="text" required class="form-input form-control" id="custEmail" value="{{ $customer->email_address }}">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Branch Name
                            </label>
                            <input type="text" required class="form-input form-control" id="branchName" value="{{ $customer->branch_name }}">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Company Name
                            </label>
                            <input type="text" required class="form-input form-control" id="companyName" value="{{ $customer->company_name }}">
                            <br>
                            <label>Address</label>
                            <input class="form-control" id="custAddress" value="{{ $customer->address }}"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard2" aria-expanded="false">
                    SALES
                </button>
            </h2>
        </div>
        <div id="salesOrderCard2" class="collapse">
            <div class="card-body">
                <form action="" id="saleFormInfo">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <br>
                                <label class="text-nowrap align-middle">
                                    Sales ID
                                </label>
                                <input type="number" class="form-input form-control"
                                    value="{{ $sales_order->id }} max=" 20" id="salesId">
                                <br>
                                <label class="text-nowrap align-middle">
                                    Sales Unit
                                </label>
                                <input type="text" class="form-input form-control" value="{{ $product->unit }}"
                                    max="20" id="salesUnit">
                                <br>
                                <label class="text-nowrap align-middle">
                                    Cost Price
                                </label>
                                <input type="number" class="form-input form-control sellable"
                                    value="{{ $sales_order->cost_price }}" max="6" id="costPrice">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <br>
                                <label class=" text-nowrap align-middle">
                                    Product Pulled Off Market
                                </label>
                                <input class="form-control" type="date"
                                    value="{{ $sales_order->product_pulled_off_market }}" id="productPulledMarket">
                                <br>
                                <label class="text-nowrap align-middle">
                                    Date
                                </label>
                                <input class="form-control" type="date" value="{{ $sales_order->date }}"
                                    id="saleDate">
                                <br>
                                <label class=" text-nowrap align-middle">
                                    Product Code
                                </label>
                                <select class="form-control" id="saleProductCode" disabled>
                                    <option>{{ $product->product_code }}</option>
                                    <option>PRODUCT-CODE-SAMPLE-2</option>
                                    <option>PRODUCT-CODE-SAMPLE-3</option>
                                    <option>PRODUCT-CODE-SAMPLE-4</option>
                                </select>
                                <br>
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
                                        <td class="font-weight-bold text-center">Quantity Purchased</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            EM181204
                                        </td>
                                        <td class="text-center d-flex justify-content-center">
                                            <input type="text" class="form-control w-25 text-center " value="10">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            GR102346
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <input type="text" class="form-control w-25 text-center " value="10">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            RB678023
                                        </td>
                                        <td class="text-center d-flex justify-content-center">
                                            <input type="text" class="form-control w-25 text-center " value="10">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Unrenewed
                            </label>
                            <input type="text" class="form-input form-control sellable" max="20" id="saleUnrenewed">
                            <br>
                            <label class="text-nowrap align-middle">
                                Payment Method
                            </label>
                            <select class="form-control sellable" id="salePaymentMethod"
                                onchange="selectPaymentMethod();">
                                <option selected>{{ $sales_order->payment_mode }}</option>
                                <option value="Cash">Full Payment(Cash)</option>
                                <option value="Installment">Installment</option>
                            </select>
                            <br>
                        </div>
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Sale Currency
                            </label>
                            <input type="text" class="form-input form-control sellable" value="{{ $sales_order->sale_currency }}"max="20" id="saleCurrency">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Sales Supply Method
                            </label>
                            <select class="form-control sellable" id="saleSupplyMethod" onchange="selectSalesMethod();">
                                <option selected hidden>{{ $sales_order->sale_supply_method }}</option>
                                <option value="Produce">Produce</option>
                                <option value="Purchase">Purchase</option>
                                <option value="Stock">From Stock</option>
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>
                                Description
                            </label>
                            <input type="text" class="form-input form-control" max="300" id="saleDescription">
                        </div>
                    </div>
                    <br>
                    <div class="row" id="paymentInstallment" style="display:none;">
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Initial Payment(Downpayment)
                            </label>
                            <input type="number" class="form-input form-control sellable" id="saleDownpaymentCost"
                            value="{{ $sales_order->initial_payment }}" placeholder="0.00">
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="text-nowrap align-middle">
                                    Installment Type
                                </label>
                                <select class="form-control" max="20" id="saleInstallmentNo">
                                    <option selected hidden>{{ $sales_order->installment_type }}</option>
                                    <option>Installment 1</option>
                                    <option>Installment 3</option>
                                    <option>Installment 4</option>
                                    <option>Installment 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card" id="cardComponent" style="display:none;">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                        data-target="#salesOrderCard3" aria-expanded="false">
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
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            Emulsifier Component 1
                                        </td>
                                        <td class="text-center">
                                            Component
                                        </td>
                                        <td class="text-center">
                                            2
                                        </td>
                                        <td class="text-center">
                                            2
                                        </td>
                                        <td class="text-primary text-center">
                                            Available
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            Emulsifier Component 2
                                        </td>
                                        <td class="text-center">
                                            Component
                                        </td>
                                        <td class="" style="text-align: center;">
                                            0
                                        </td>
                                        <td class="text-center">
                                            3
                                        </td>
                                        <td class="text-danger text-center">
                                            Out of stock
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            Bar Shaft
                                        </td>
                                        <td class="text-center">
                                            Raw Materials
                                        </td>
                                        <td class="" style="text-align: center;">
                                            3
                                        </td>
                                        <td class="text-center">
                                            10
                                        </td>
                                        <td class="text-danger text-center">
                                            Insufficient
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label text-muted">Add Selected to Work Order</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label text-muted">Re-Order Selected Raw Materials</label>
                            </div>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary m-1 float-right menu" data-dismiss="modal"
                                data-target="#newSalePrompt" data-name="Work Order" data-parent="manufacturing">
                                <a class="" href="#" style="text-decoration: none;color:white">
                                    Save and Proceed to Work Order
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardPayments">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard4" aria-expanded="false">
                    PAYMENTS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard4" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table border-bottom table-hover table-bordered">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td></td>
                                    <td class="text-center">Description</td>
                                    <td class="text-center">Amount Due</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input append-check">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        First Installment
                                    </td>
                                    <td class="text-center">
                                        5000.00
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input append-check">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        Second Installment
                                    </td>
                                    <td class="text-center">
                                        5000.00
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input append-check">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        Third Installment
                                    </td>
                                    <td class="text-center">
                                        5000.00
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input append-check">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        Fourth Installment
                                    </td>
                                    <td class="text-center">
                                        5000.00
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input append-check">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        Fifth Installment
                                    </td>
                                    <td class="text-center">
                                        5000.00
                                    </td>
                                </tr>
                                <tr id="rowTotal">
                                    <td></td>
                                    <td class="font-weight-bold text-center">TOTAL AMOUNT:</td>
                                    <td class="text-center">
                                        <input class="form-control" type="text" id="" placeholder="0.00">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-primary m-1" data-dismiss="modal"
                            data-target="#newSalePrompt" data-name="Work Order" data-parent="manufacturing">
                            <a class="" href="#" style="text-decoration: none;color:white">
                                Save Payment
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardPaymentLogs">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard5" aria-expanded="false">
                    PAYMENT LOGS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard5" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table border-bottom table-hover">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td class="text-center font-weight-bold">Payment ID</td>
                                    <td class="text-center font-weight-bold">Date Paid</td>
                                    <td class="text-center font-weight-bold">Amount Paid</td>
                                    <td class="text-center font-weight-bold">Description</td>
                                    <td class="text-center font-weight-bold">Payment Method</td>
                                    <td class="text-center font-weight-bold">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">PID-000000001</td>
                                    <td class="text-center">February 20, 2021</td>
                                    <td class="text-center">5000.00</td>
                                    <td class="text-center">Downpayment</td>
                                    <td class="text-center">Cash</td>
                                    <td class="text-center">Paid</td>
                                </tr>
                                <tr>
                                    <td class="text-center">PID-000000001</td>
                                    <td class="text-center">March 1, 2021</td>
                                    <td class="text-center">5000.00</td>
                                    <td class="text-center">Downpayment</td>
                                    <td class="text-center">Check</td>
                                    <td class="text-center">Pending</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/salesorder.js') }}"></script>
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
