<?php 
    $today = date("Y-m-d");
?>

<script src="{{ asset('js/purchaseorder.js') }}"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadPurchaseOrder();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">New Purchase Order "Number"</h2>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Get items from
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Product Bundle</a></li>
                        <li><a class="dropdown-item" data-toggle="modal" data-target="#materialrequest-modal">Material Request</a></li>
                        <li><a class="dropdown-item" href="#">Supplier Quotation</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tools
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Update rate as per last purchase</a></li>
                        <li><a class="dropdown-item" href="#">Link to Material</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" id="saveOrder" type="button">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="materialrequest-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="width:780px;">
            <div class="modal-header">
                <h3>Select Material Request</h3>
                <h3></h3>
                <div class="col-6">
                    <div class="form-group">
                        <table>
                            <tr>
                                <td><button type="button" class="btn btn-info btn" data-dismiss="modal" onclick="">Make Material Request</button> </td>
                                <td><button type="button" class="btn btn-info btn" data-dismiss="modal" style="background-color: #007bff;">Get Items</button> </td>
                                <td><a class="close" data-dismiss="modal"><i class="fa fa-times"></i></a></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div><br>
            <form id="materialrequestform" name="matreqform" role="form" method="POST">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>Search Term</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Date Range</label>
                            <input type="text" class="form-control">
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
                            <td>Name</td>
                            <td>Company</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($material_requests as $request)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td class="text-black-50">{{ $request->request_id }}</td>
                            <td class="text-black-50">Almedah Food Equipment</td>
                            <td class="text-black-50">{{ $request->request_date }}</td>
                        </tr>
                        @endforeach
                        <!--
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td class="text-black-50">Material 2</td>
                            <td class="text-black-50">Almedah Food Equipment</td>
                            <td class="text-black-50">12-MAR-2021</td>

                        </tr>
                        -->
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>


<div class="container">
    <form id="newpurchaseorderForm" name="newpurchaseForm" role="form" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="input-group">
                    <label class="label">Series</label>
                    <select class="input--style-4" type="text" name="series" style="width:512px;height:38px;" disabled>
                        <option>PUR-ORD-.YYYY.-</option>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="date">Date</label>

                    <input type="date" id="transDate" name="date" value="<?php echo $today; ?>" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <input type="text" id="supplierField" name="supplier" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="reqdbydate">Reqd by Date</label>
                    <input type="date" name="reqdbydate" id="reqDate" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" name="company" id="companyField" class="form-control">
                </div>
            </div>
        </div>



        <!---Address and Contacts-->
        <a href="#submenuAddressandContacts" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> ADDRESS AND CONTACTS</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>

        <div id='submenuAddressandContacts' class="collapse sidebar-submenu">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="selectsuppadd">Select Supplier Address</label>
                        <input type="text" id="suppAddress" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="selectshipadd">Select Shipping Address</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="contactperson">Contact Person</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <!----End of Address and Contacts-->
        <!---Currency and Price List-->
        <a href="#submenuCurrencyandPriceList" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> CURRENCY AND PRICE LIST</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>
        <div id='submenuCurrencyandPriceList' class="collapse sidebar-submenu">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="currency">Currency</label>
                        <input type="text" class="form-control" placeholder="PHP" disabled>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="priceList">Price List</label>
                        <input type="text" class="form-control">
                    </div>
                    <input type="checkbox"> Ignore Pricing Rule
                </div>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <br>
                <div class="col-6">
                    <div class="form-group">
                        <label for="settargetWh">Set Target Warehouse</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group">
                        <label class="label">Supply Raw Materials</label>
                        <select class="input--style-4" type="text" name="supprawmat" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                    </div>
                </div>
                <hr>
                <br>

                <table class="table table-bom border-bottom" id="itemTable">
                    <thead class="border-top border-bottom bg-light">
                        <tr class="text-muted">
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" id="masterChk" class="form-check-input">
                                </div>
                            </td>
                            <td>Item Code</td>
                            <td>Reqd By Date</td>
                            <td>Quantity</td>
                            <td>Rate</td>
                            <td>Amount</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="" id="itemTable-content">
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" id="chk1" class="form-check-input">
                                </div>
                            </td>
                            <td class="text-black-50">
                                <input type="text" name="item1" id="item1" onkeyup="fieldFunction(1);">
                            </td>
                            <td class="text-black-50">
                                <input type="date" name="date1" id="date1">
                            </td>
                            <td class="text-black-50">
                                <input type="number" name="qty1" id="qty1" value="0" min="1" onkeyup="calcPrice(1);">
                            </td>
                            <td class="text-black-50">
                                <input type="number" name="rate1" id="rate1" value="0" min="1" onkeyup="calcPrice(1);">
                            </td>
                            <td class="text-black-50">
                                <input type="text" name="price1" id="price1" value="₱ 0.00" disabled>
                            </td>
                            <td class="text-black-50">
                                <select class="input--style-4" type="text" name="sampleOne" style="width:50px;height:30px;">
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </td>
                        </tr> 
                        <!--
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td class="text-black-50">Sample 1</td>
                            <td class="text-black-50"></td>
                            <td class="text-black-50">0</td>
                            <td class="text-black-50">Php 0.00</td>
                            <td class="text-black-50">Php 0.00</td>
                            <td class="text-black-50">
                                <select class="input--style-4" type="text" name="sampleOne" style="width:50px;height:30px;">
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </td>
                        </tr>
                    -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><button type="button" id="multBtn" style="padding: 5px; background-color: #007bff; color: white;">Add Multiple</button></td>
                            <td><button type="button" id="rowBtn" style="padding: 5px; background-color: #007bff; color: white;">Add Row</button></td>
                            <td></td>
                            <td></td>
                            <td><button id="button1">Download</button></td>
                            <td><button id="button1">Upload</button></td>
                        </tr>
                    </tfoot>
                </table>
                <hr>
                <br>
                <div class="col-6">
                    <div class="form-group">
                        <label for="totalQuantity">Total Quantity</label>
                        <input type="number" class="form-control" id="totalQty" value="0" disabled>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="totalphp">Total (PHP)</label>
                        <input type="text" class="form-control" id="totalPrice" value="₱ 0.00" disabled>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="totalnetWeight">Total Net Weight</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>
                <br>

                <div class="col-6">
                    <div class="form-group">
                        <label for="taxCategory">Tax Category</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="shippingRule">Shipping Rule</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>
                <br>

                <div class="col-6">
                    <div class="form-group">
                        <label for="purchaseTemplate">Purchase Taxes and Charges Template</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-12">
                    <table class="table table-bom border-bottom">
                        <thead class="border-top border-bottom bg-light">
                            <label for="purchasetaxesandCharges">Purchase Taxes and Charges</label>
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>NO DATA</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tbody>
                        <tr>
                            <td><button id="button1">Add Row</button></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <hr>
                <br>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="taxandchargeAdd">Taxes and Charges Added (PHP)</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="taxandchargeDeduct">Taxes and Charges Deducted (PHP)</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="totaltaxandCharges">Total Taxes and Charges (PHP)</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <!----End of Currency and Price List-->
        </div>
        <!---Additional Discount-->
        <a href="#submenuAdditionalDiscount" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> ADDITIONAL DISCOUNT</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>

        <div id='submenuAdditionalDiscount' class="collapse sidebar-submenu">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <label class="label">Apply Additional Discount On</label>
                        <select class="input--style-4" type="text" name="applyaddDisc" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Additional Discount Percentage</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <!--Empty Column-->
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Additional Discount Amount (PHP)</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <hr>
                <br>
                <div class="col-12">
                    <div class="form-group">
                        <hr>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Grand Total (PHP)</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Rounding Adjustment (PHP)</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Rounded Total (PHP)</label>
                        <input type="text" class="form-control">
                    </div>
                    <input type="checkbox"> Disable Rounded Total
                </div>
                <br>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Advance Paid</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <hr>
            <br>
            <div class="col-6">
                <div class="form-group">
                    <label>Payment Terms Template</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-12">
                <table class="table table-bom border-bottom">
                    <thead class="border-top border-bottom bg-light">
                        <label>Payment Schedule</label>
                        <tr class="text-muted">
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td>Payment Term</td>
                            <td>Description</td>
                            <td>Due Date</td>
                            <td>Invoice Portion</td>
                            <td>Payment Amount</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>NO DATA</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tbody>
                    <tr>
                        <td><button id="button1">Add Row</button></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <!----End of Additional Discount-->
        <!---Terms and Conditions-->
        <a href="#submenuTermsandConditions" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> TERMS AND CONDITIONS</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>

        <div id='submenuTermsandConditions' class="collapse sidebar-submenu">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Terms</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-12">
                    <label for="termsandConditions">Terms and Conditions</label>
                    <textarea id="summernote" name="termsandconditions"></textarea>
                    <script src="js/inventory.js">
                    </script>
                </div>
            </div>

        </div>
        <!----End of Terms and Conditions-->
        <!---More Information-->
        <a href="#submenuMoreInfo" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> MORE INFORMATION</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>

        <div id='submenuMoreInfo' class="collapse sidebar-submenu">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Inter Company Order Reference</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>


        </div>
        <!----End of More Information-->

        <!---Printing Settings-->
        <a href="#submenuPrinting" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> PRINTING SETTINGS</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>

        <div id='submenuPrinting' class="collapse sidebar-submenu">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Letter Heads</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="checkbox"> Group same items
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Print Heading</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Print Language</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <!----End of Salary Details-->
    </form>
    <br>
    <div class="col-6">
        <div class="form-group">
            <label>SUBSCRIPTION SECTION</label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>From Date</label>
            <input type="text" class="form-control">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>To Date</label>
            <input type="text" class="form-control">
        </div>
    </div>
</div>