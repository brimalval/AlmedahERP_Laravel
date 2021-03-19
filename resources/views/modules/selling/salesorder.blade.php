<!-- Datatable links -->
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
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadSalesOrder();">Refresh</button>
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

<!--Front-end's version of table. Just change it back if necessary.-->
<!--
<div class="container">
    <div class="card my-2">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Item">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body filter">
            <div class="row">
                <div class="float-left">
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        Add Filter
                    </button>
                </div>
                <div class=" ml-auto float-right">
                    <span class="text-muted ">Last Modified On</span>
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                </div>
            </div>
        </div>
        <table class="table table-bom border-bottom">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Product Code</td>
                    <td>Payment Status</td>
                    <td>Installment Status</td>
                    <td>Payment Balance</td>
                    <td>Date</td>
                    <td><td>
                </tr>
            </thead>
            <tbody class="custom-input">
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a name="BOM-PR-EM-ADJ CAP-002" href='javascript:onclick=openSaleInfo();'>Emulsifier</a></td>
                    <td class="text-danger">Pending</td>
                    <td>4th/6</td>
                    <td class="text-bold">10,000.00</td>
                    <td class="text-bold">2021-01-01</td>
                    <td><button type="button" class="btn btn-primary btn-sm" disabled>Release</button></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a name="BOM-PR-EM-ADJ CAP-002" href='javascript:onclick=openSaleInfo();'>Emulsifier</a></td>
                    <td class="text-success">Complete</td>
                    <td>6th/6</td>
                    <td class="text-bold">0.00</td>
                    <td class="text-bold">2021-01-01</td>
                    <td><button type="button" class="btn btn-primary btn-sm">Release</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-1 text-center">
            <button type="submit" class="custom-input"> <span class="fas fa-chevron-left"></span></button>
        </div>
        <div class="col-1 text-center">
            <p>4 of 4</p>
        </div>
        <div class="col-1 text-center">
            <button type="submit" class="custom-input"> <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>
-->

<!--Back-end's version of table. Used to test if data is being sent to the tables.-->
<table id="salestable" class="table table-striped table-bordered hover" style="width:100%">
        <thead>
            <tr>
                <th>Sales ID</th>
                <th>Product Code</th>
                <th>Payment Status</th>
                <th>Payment Track</th>
                <th>Payment Balance</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $row)
            <tr>
                <td class= "text-bold"> {{$row->id}}</td>
                <td> <a href='javascript:onclick=openSaleInfo({{$row->id}});'>{{$row->product_code}}</a>    </td>
                <td class="text-danger">{{$row->payment_status}}</td>
                <td>{{$row->payment_track}}</td>
                <td class="text-bold">{{$row->payment_balance}}</td>
                <td class="text-bold">{{$row->date}}</td>
                <td><button type="button" class="btn btn-primary btn-sm" disabled>Release</button></td>
            </tr>
            @endforeach
        </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="newSalePrompt" tabindex="-1" role="dialog" aria-labelledby="newSalePromptTitle" aria-hidden="true">
    <!--Sales Order Form-->
    <form method="POST" enctype="multipart/form-data" action="#" id="sales_order_form">
                @csrf
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Order</h5>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary m-1" id="saveSaleOrder1" value="Submit">
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
                                        <!--
                                            Old input for searching customer id: change back when needed
                                            <div class="d-flex">
                                                <input type="number" class="form-input form-control" max="6" value="0000001" id="custId" required>
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            <br>
                                        -->
                                        <input list="customers" class="form-input form-control" name="customer_id" onchange="customeridselector(value);">
                                        <datalist id="customers">
                                        @foreach ($customers as $row)
                                          <option value="{{$row->id}}"> {{$row->customer_lname}} {{$row->customer_fname}} </option>
                                        @endforeach
                                          <option value=" + Add new"> 
                                        </datalist> 
                                        <br>
                                        <label class=" text-nowrap align-middle">
                                            First Name
                                        </label>
                                        <input type="text" required class="form-input form-control" id="fName" required name ="fName">
                                        <br>
                                        <label class=" text-nowrap align-middle">
                                            Last Name
                                        </label>
                                        <input type="text" required class="form-input form-control" id="lName" name="lName">
                                        <br>
                                        <label class=" text-nowrap align-middle">
                                            Contact Number
                                        </label>
                                        <input type="text" required class="form-input form-control" id="contactNum" name="contactNum">
                                    </div>
                                    <div class="col">
                                        <br>
                                        <label class=" text-nowrap align-middle">
                                            Email Address
                                        </label>
                                        <input type="text" required class="form-input form-control" id="custEmail" name="custEmail">
                                        <br>
                                        <label class=" text-nowrap align-middle">
                                            Branch Name
                                        </label>
                                        <input type="text" required class="form-input form-control" id="branchName" name="branchName">
                                        <br>
                                        <label class=" text-nowrap align-middle">
                                            Company Name
                                        </label>
                                        <input type="text" required class="form-input form-control" id="companyName" name="companyName">
                                        <br>
                                        <label>Address</label>
                                        <input class="form-control" id="custAddress" name="custAddress"> </input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0">
                                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#salesOrderCard2" aria-expanded="false">
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
                                            <input type="text" class="form-input form-control" max="20" id="salesId">
                                            <br>
                                            <label class="text-nowrap align-middle">
                                                Sales Unit
                                            </label>
                                            <input type="text" class="form-input form-control" max="20" id="salesUnit" name="salesUnit" placeholder="Unit of Measurement">
                                            <br>
                                            <label class="text-nowrap align-middle">
                                                Cost Price
                                            </label>
                                            <input type="number" class="form-input form-control sellable" id="costPrice" name="costPrice" disabled>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Product Pulled Off Market
                                            </label>
                                            <input class="form-control" type="date" value="2021-01-01" id="productPulledMarket" name="productPulledMarket">
                                            <br>
                                            <label class="text-nowrap align-middle">
                                                Date
                                            </label>
                                            <input class="form-control" type="date" value="2021-01-01" id="saleDate" name="saleDate">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Product Code
                                            </label>
                                            <select class="form-control" id="saleProductCode" name="saleProductCode">
                                                <option value="none" selected disabled hidden> 
                                                    Select an Option 
                                                </option>
                                                @foreach ($products as $row)
                                                    <option value="{{$row->product_code}}">{{$row->product_code}}</option>
                                                @endforeach
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
                                        <select class="form-control sellable" id="salePaymentMethod" name="salePaymentMethod" onchange="selectPaymentMethod();" disabled>
                                            <option selected disabled>Please Select</option>
                                            <option value="Cash">Full Payment(Cash)</option>
                                            <option value="Installment">Installment</option>
                                        </select>
                                        <br>
                                    </div>
                                    <div class="col">
                                        <label class="text-nowrap align-middle">
                                            Sale Currency
                                        </label>
                                        <input type="text" class="form-input form-control sellable" max="20" id="saleCurrency" name="saleCurrency">
                                        <br>
                                        <label class=" text-nowrap align-middle">
                                            Sales Supply Method
                                        </label>
                                        <select class="form-control sellable" id="saleSupplyMethod" name="saleSupplyMethod" onchange="selectSalesMethod();" disabled>
                                            <option selected disabled>Please Select</option>
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
                                <div class="row" id="paymentInstallment" style="display:none;">
                                    <div class="col">
                                        <label class="text-nowrap align-middle">
                                            Initial Payment(Downpayment)
                                        </label>
                                        <input type="number" class="form-input form-control sellable" id="saleDownpaymentCost" name="saleDownpaymentCost" placeholder="0.00">
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="text-nowrap align-middle">
                                                Installment Type
                                            </label>
                                            <select class="form-control" id="installmentType" name="installmentType">
                                                <option selected value = "Installment 1">Installment 1</option>
                                                <option value = "Installment 2">Installment 2</option>
                                                <option value = "Installment 3">Installment 3</option>
                                                <option value = "Installment 4">Installment 4</option>
                                                <option value = "Installment 5">Installment 5</option>
                                            </select>
                                        </div>
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
                                                    <!--Sample data for now; will populate data if functionality fully works now-->
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
                                                <label class="form-check-label text-muted">Add Selected to Work
                                                    Order</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                                <label class="form-check-label text-muted">Re-Order Selected Raw
                                                    Materials</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary m-1 float-right menu" data-dismiss="modal" id="saveWorkOrder" data-target="#newSalePrompt" data-name="Work Order" data-parent="manufacturing">
                                                <a class="" href="#" style="text-decoration: none;color:white">
                                                    Save and Proceed to Work Order
                                                </a>
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
                            <button type="button" class="btn btn-primary m-1" data-dismiss="modal" data-target="#newSalePrompt" data-name="Work Order" data-parent="manufacturing">
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
                        <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#salesOrderCard5" aria-expanded="false">
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
                <!--
                    'salesorderform.php' contents end here
                -->
            </div>
            <script src="{{ asset('js/salesorder.js') }}"></script>
            <div class="modal-footer d-flex">
                <span id="notif" class="mr-auto text-danger">There are Missing inputs!</span>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <div class="modal-footer">
                    <a class="nav-link menu" href="javascript:onclick=closeSaleTab;" data-parent="selling"
                        data-name="New Sale Order" data-dismiss="modal">
                        Edit in full page
                    </a>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!--End Form-->
</div>



<script type="text/javascript">

var x;

// From back-end: to show that data can be shown in table
$(document).ready(function() {
    x = $('#salestable').DataTable();
});

// For the search suggestion of customer
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
            "customer_lname": "{{ $rows->customer_lname}}",
            "customer_fname": "{{ $rows->customer_fname }}",
            "contact_number": "{{ $rows->contact_number }}",
            "email_address": "{{ $rows->email_address }}",
            "branch_name": "{{ $rows->branch_name}}",
            "company_name": "{{ $rows->company_name }}",
            "address": "{{ $rows->address}}"};

        if ({{$rows->id}} == value){
            return test1;
        }
    @endforeach
}

// For creation of sales order
$("#sales_order_form").submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    var formData = new FormData(this);
    
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

            x.row.add( [
            data['id'],
            data['product_code'],
            data['payment_status'],
            data['payment_track'],
            data['payment_balance'],
            data['date'],
            "Release"
            ] ).draw();
            $('closeSaleOrderModal').click();
        },
        error: function(data) {
            console.log("error");
            console.log(data);
        }
    });
});

function refresh(){
    x.draw();
}
</script>
