<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Sales Order</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Edit</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="">Refresh</button>
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
                    <td>
                    <td>
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
<!-- Modal -->
<div class="modal fade" id="newSalePrompt" tabindex="-1" role="dialog" aria-labelledby="newSalePromptTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Order</h5>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary m-1" data-target="#newSalePrompt" id="saveSaleOrder1">
                        <a class="" href="#" style="text-decoration: none;color:white">
                            Save
                        </a>
                    </button>
                    <button type="button" class="btn btn-secondary m-1" data-dismiss="modal" data-target="#newSalePrompt" id="closeSaleOrderModal">
                        Close
                    </button>
                </div>
            </div>
            <div class="modal-body p-5">
                <!--Sales Order Form-->
                <div class="accordion" id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading1">
                            <h2 class="mb-0">
                                <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#salesOrderCard1" aria-expanded="true">
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
                                                <input type="number" class="form-input form-control" max="6" value="0000001" disabled id="custId" required>
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                First Name
                                            </label>
                                            <input type="text" required class="form-input form-control" id="fName" required>
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Last Name
                                            </label>
                                            <input type="text" required class="form-input form-control" id="lName">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Contact Number
                                            </label>
                                            <input type="number" required class="form-input form-control" max="11" id="contactNum">
                                        </div>
                                        <div class="col">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Email Address
                                            </label>
                                            <input type="text" required class="form-input form-control" id="custEmail">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Branch Name
                                            </label>
                                            <input type="text" required class="form-input form-control" id="branchName">
                                            <br>
                                            <label class=" text-nowrap align-middle">
                                                Company Name
                                            </label>
                                            <input type="text" required class="form-input form-control" id="companyName">
                                            <br>
                                            <label>Address</label>
                                            <input class="form-control" id="custAddress"></input>
                                        </div>
                                    </div>
                                </form>
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
                                <form action="" id="saleFormInfo">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Sales ID
                                                </label>
                                                <input type="number" class="form-input form-control" max="20" id="salesId">
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Sales Unit
                                                </label>
                                                <input type="text" class="form-input form-control" max="20" id="salesUnit">
                                                <div class="row ml-1">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="isSellable" onclick="sellable();">
                                                    </div>
                                                    <label for="isSellable" class="form-check-label" style="font-size: 14px;">Is Sellable</label>
                                                </div>
                                                <label class="text-nowrap align-middle">
                                                    Cost Price
                                                </label>
                                                <input type="number" class="form-input form-control sellable" max="6" id="costPrice" disabled>
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Sale Currency
                                                </label>
                                                <input type="text" class="form-input form-control sellable" max="20" id="saleCurrency" disabled>
                                                <br>
                                                <label class=" text-nowrap align-middle">
                                                    Sales Supply Method
                                                </label>
                                                <select class="form-control sellable" id="saleSupplyMethod" onchange="selectSalesMethod();" disabled>
                                                    <option selected disabled>Please Select</option>
                                                    <option value="Produce">Produce</option>
                                                    <option value="Purchase">Purchase</option>
                                                    <option value="Stock">From Stock</option>
                                                </select>
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Payment Method
                                                </label>
                                                <select class="form-control sellable" id="salePaymentMethod" onchange="selectPaymentMethod();" disabled>
                                                    <option selected disabled>Please Select</option>
                                                    <option value="Cash">Full Payment(Cash)</option>
                                                    <option value="Installment">Installment</option>
                                                </select>
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Unrenewed
                                                </label>
                                                <input type="text" class="form-input form-control sellable" max="20" id="saleUnrenewed" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <br>
                                                <label class=" text-nowrap align-middle">
                                                    Product Pulled Off Market
                                                </label>
                                                <input class="form-control" type="date" value="2021-01-01" id="productPulledMarket">
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Date
                                                </label>
                                                <input class="form-control" type="date" value="2021-01-01" id="saleDate">
                                                <br>
                                                <label class=" text-nowrap align-middle">
                                                    Product Launch Date
                                                </label>
                                                <input class="form-control" type="date" value="2021-01-01" id="productLaunchDate">
                                                <br>
                                                <label class=" text-nowrap align-middle">
                                                    Product Code
                                                </label>
                                                <select class="form-control" id="saleProductCode">
                                                    <option>PRODUCT-CODE-SAMPLE-1</option>
                                                    <option>PRODUCT-CODE-SAMPLE-2</option>
                                                    <option>PRODUCT-CODE-SAMPLE-3</option>
                                                    <option>PRODUCT-CODE-SAMPLE-4</option>
                                                </select>
                                                <br>
                                                <label class=" text-nowrap align-middle">
                                                    Version
                                                </label>
                                                <input type="text" class="form-input form-control" max="20" id="saleVersion">
                                                <br>
                                                <label class="text-nowrap align-middle">
                                                    Quantity
                                                </label>
                                                <input type="text" class="form-input form-control" max="20" id="saleQuantity">
                                                <br>
                                                <label class=" text-nowrap align-middle">
                                                    Stock Unit
                                                </label>
                                                <input type="text" class="form-input form-control" max="20" id="saleStockUnit">
                                            </div>
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
                                            <input type="number" class="form-input form-control sellable" id="saleDownpaymentCost" placeholder="0.00">
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="text-nowrap align-middle">
                                                    Installment Type
                                                </label>
                                                <select class="form-control" max="20" id="saleInstallmentNo">
                                                    <option>Installment 1</option>
                                                    <option selected>Installment 2</option>
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
                                    <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#salesOrderCard3" aria-expanded="false">
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
                                            <button type="button" class="btn btn-primary m-1 float-right menu" data-dismiss="modal" data-target="#newSalePrompt" data-name="Work Order" data-parent="manufacturing">
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

                <script src="{{ asset('js/salesorder.js') }}"></script>
                <!--End Form-->
            </div>
            <div class="modal-footer d-flex">
                <span id="notif" class="mr-auto text-danger">There are Missing inputs!</span>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <div class="modal-footer">
                    <a class="nav-link menu" href="javascript:onclick=closeSaleTab;" data-parent="selling" data-name="New Sale Order" data-dismiss="modal">
                        Edit in full page
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>