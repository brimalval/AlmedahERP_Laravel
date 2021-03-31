<?php
$today = date('Y-m-d');
$i = 1;
?>

<script src="{{ asset('js/purchaseorder.js') }}"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadPurchaseOrder();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">New Purchase Order "Number"</h2>
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
                        Get items from
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Product Bundle</a></li>
                        <li><a class="dropdown-item" data-toggle="modal" data-target="#materialrequest-modal">Material
                                Request</a></li>
                        <li><a class="dropdown-item" href="#">Supplier Quotation</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
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

<div class="modal fade" id="materialrequest-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="margin:auto;">
            <div class="modal-header">
                <h3>Select Material Request</h3>
                <h3></h3>
                <div class="col-6">
                    <div class="form-group">
                        <table>
                            <tr>
                                <td><button type="button" class="btn btn-info btn" data-dismiss="modal" onclick="">Make
                                        Material Request</button> </td>
                                <td><button type="button" class="btn btn-info btn" data-dismiss="modal"
                                        style="background-color: #007bff;" id="getReqItem">Get Items</button> </td>
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

                <table class="table table-bom border-bottom" id="reqTable">
                    <thead class="border-top border-bottom bg-light">
                        <tr class="text-muted">
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" id="masterReqChk" class="form-check-input">
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
                                        <input type="checkbox" id="reqChk<?= $i ?>"class="form-check-input">
                                    </div>
                                </td>
                                <td class="text-black-50" id="req<?= $i ?>">{{ $request->request_id }}</td>
                                <td class="text-black-50">Almedah Food Equipment</td>
                                <td class="text-black-50">{{ $request->request_date }}</td>
                            </tr>
                            <?php ++$i; ?>
                        @endforeach
                       
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
                    <select class="form-control" type="text" name="series" style="width:512px;height:38px;" disabled>
                        <option>PUR-ORD-.YYYY.-</option>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="date">Date</label>

                    <input type="date" id="transDate" name="date"
                        value="<?php echo $today; ?>" class="form-control">
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
        <a href="#submenuAddressandContacts" data-toggle="collapse" aria-expanded="false"
            class="bg-white list-group-item list-group-item-action">

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
        <a href="#submenuCurrencyandPriceList" data-toggle="collapse" aria-expanded="false"
            class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> PRICE LIST</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>
        <div id='submenuCurrencyandPriceList' class="collapse sidebar-submenu">
            <br>
            <div class="row">
              
                <div class="col-6">
                    <div class="form-group">
                        <label for="settargetWh">Set Target Warehouse</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

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
                        <tr id="item-1">
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" name="item-chk" id="chk1" class="form-check-input">
                                </div>
                            </td>
                            <td class="text-black-50">
                                <input class="form-control" type="text" name="item1" id="item1" onkeyup="fieldFunction(1);">
                            </td>
                            <td class="text-black-50">
                                <input class="form-control" type="date" name="date1" id="date1">
                            </td>
                            <td class="text-black-50">
                                <input class="form-control" type="number" name="qty1" id="qty1" value="0" min="1" onchange="calcPrice(1);">
                            </td>
                            <td class="text-black-50">
                                <input class="form-control" type="number" name="rate1" id="rate1" value="0" min="1" onchange="calcPrice(1);">
                            </td>
                            <td class="text-black-50">
                                <input class="form-control" type="text" name="price1" id="price1" value="₱ 0.00" readonly>
                            </td>
                            <td class="text-black-50">
                                <select class="input--style-4" type="text" name="sampleOne"
                                    style="width:50px;height:30px;">
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                   
                    <tfoot>
                        <tr>
                            <td><button type="button" id="multBtn" style="background-color: #007bff;">Add
                                    Multiple</button></td>
                            <td><button type="button" id="rowBtn" style="background-color: #007bff;">Add Row</button>
                            </td>
                            <td><button type="button" id="deleteRow"
                                    style="background-color: red; display:none;">Delete</button></td>
                            <td></td>
                            <td><button id="button1">Download</button></td>
                            <td><button id="button1">Upload</button></td>
                        </tr>
                    </tfoot>

                    <style>
                        #multBtn,
                        #rowBtn,
                        #deleteRow {
                            border-radius: 4px;
                            padding: 5px;
                            color: white;
                        }
                    </style>
                </table>
                <hr>
                <br>

                <div class="col-6">
                    <div class="form-group">
                        <label for="totalphp">Total (PHP)</label>
                        <input type="text" class="form-control" id="totalPrice" value="₱ 0.00" readonly>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                    </div>
                </div>

            </div>

        </div>
        <a href="#submenuMoreInfo" data-toggle="collapse" aria-expanded="false"
            class="bg-white list-group-item list-group-item-action">

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
            
            </div>

        </div>

    </form>
    <br>
    
</div>
