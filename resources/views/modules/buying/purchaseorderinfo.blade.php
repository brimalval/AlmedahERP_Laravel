<?php
$i = 1; ?>
<script src="{{ asset('js/purchaseorder.js') }}"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadPurchaseOrder();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;" id="p_id">{{ $purchase_order->purchase_id }}</h2>
            <p id="mp_status">{{ $purchase_order->mp_status }}</p>
        </h2>
        @if ($purchase_order->mp_status === 'Draft')
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
                            <!--<li><a class="dropdown-item" href="#">Product Bundle</a></li>-->
                            <li><a class="dropdown-item" data-toggle="modal" data-target="#sq_modal">Supplier
                                    Quotation</a></li>
                            <!--<li><a class="dropdown-item" href="#">Supplier Quotation</a></li>-->
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
                        <button class="btn btn-primary" id="submitOrder" type="button">Submit</button>
                    </li>
                </ul>
            </div>
        @elseif($purchase_order->mp_status === 'To Receive and Bill')
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-danger" id="cancelOrder" type="button">Cancel</button>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>

<!-- Modal Purchase Order-->
<div class="modal fade" id="sq_modal" tabindex="-1" role="dialog" aria-labelledby="sq_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supplier Quotations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="suppQuotationTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Supplier Quotation ID</th>
                            <th>Supplier ID</th>
                            <th>Item List</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplier_quotations as $quotation)
                            <tr>
                                <td class="text-bold">{{ $quotation->supp_quotation_id }}</td>
                                <td>{{ $quotation->supplier_id }}</td>
                                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                    data-toggle="modal" data-target="#npo_itemListView" onclick="viewQuotationItems({{$quotation->id}})">View</button></td>
                                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                        data-dismiss="modal"
                                        onclick="loadQuotation({{ $quotation->id }})">Select</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="accordion" id="accordion">
    <div class="card">
        <div class="collapse show">
            <div class="card-body">
                <form action="" id="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class=" text-nowrap align-middle">Series</label>
                            <div class="d-flex">
                                <select class="form-input form-control" id="purch_id" type="text" name="series"
                                    style="width:512px;height:38px;" readonly>
                                    <option value="{{ $purchase_order->purchase_id }}" selected>
                                        {{ $purchase_order->purchase_id }}</option>
                                </select>
                            </div>
                            <br>
                            <input type="text" id="sqID" hidden value="{{ $purchase_order->supp_quotation_id }}">
                            <label class=" text-nowrap align-middle" for="supplier">Supplier</label>
                            <input class="form-input form-control" readonly type="text" id="supplierField"
                                name="supplier" value="{{ $supplier['company_name'] }}">
                        </div>
                        <div class="col-6">
                            <label for="date">Date</label>
                            <input type="date" readonly id="transDate" name="date"
                                value="{{ $purchase_order->purchase_date }}" class="form-input form-control">
                            <br>
                            <label for="reqdbydate">Reqd by Date</label>
                            <input readonly type="date" name="reqdbydate" id="reqDate" class="form-input form-control"
                                value="{{ $req_date }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card" id="poAddressContacts">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#poAddCon" aria-expanded="false">
                    ADDRESS AND CONTACTS
                </button>
            </h2>
        </div>
        <div id="poAddCon" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="selectsuppadd">Select Supplier Address</label>
                            <input type="text" value="{{ $supplier['supplier_address'] }}" id="suppAddress"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="contactperson">Contact Person</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="selectshipadd">Select Shipping Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="poPriceList">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#poPrices" aria-expanded="false">
                    MATERIALS AND PRICE LIST
                </button>
            </h2>
        </div>
        <div id="poPrices" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="settargetWh">Set Target Warehouse</label>
                            <input type="text" class="form-input form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table border-bottom table-hover table-bordered" id="itemTable" style="width: 100%;">
                        <thead class="border-top border-bottom bg-light">
                            <tr class="text-muted">
                                <th>
                                    <input type="checkbox" id="masterChk" @if ($purchase_order->mp_status !== 'Draft') disabled @else onchange="onChangeFunction();" @endif>
                                </th>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Reqd By Date</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody class="" id="itemTable-content">
                            @foreach ($items_purchased as $item)
                                <tr id="item-<?= $i ?>">
                                    <td>
                                        <input type="checkbox" name="item-chk" id="chk<?= $i ?>" @if ($purchase_order->mp_status !== 'Draft') disabled @else onchange="onChangeFunction();" @endif>
                                    </td>
                                    <td class="text-black-50">
                                        <span type="text" name="item<?= $i ?>" id="item<?= $i ?>">{{ $item['item']->item_code }}</span>
                                    </td>
                                    <td class="text-black-50">
                                        <span name="itemName<?= $i ?>" id="itemName<?= $i ?>">{{ $item['item']->item_name }}</span>
                                    </td>
                                    <td class="text-black-50">
                                        <input type="date" name="date<?= $i ?>" id="date<?= $i ?>" value="{{ $item['req_date'] }}" @if ($purchase_order->mp_status !== 'Draft') readonly @else onchange="onChangeFunction();" @endif>
                                    </td>
                                    <td class="text-black-50">
                                        <span name="qty<?= $i ?>" id="qty<?= $i ?>">{{ $item['qty'] }}</span>
                                    </td>
                                    <td class="text-black-50">
                                        <span name="rate<?= $i ?>" id="rate<?= $i ?>">{{ $item['rate'] }}</span>
                                    </td>
                                    <td class="text-black-50">
                                        <span name="price<?= $i ?>" id="price<?= $i ?>">₱ {{ $item['subtotal'] }}</span>
                                    </td>
                                </tr>
                        <?php ++$i; ?>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <td colspan="7" rowspan="5">
                                @if ($purchase_order->mp_status === 'Draft')
                                <button type="button" id="multBtn" style="background-color: #007bff;">Add
                                    Multiple</button>
                                <button type="button" id="rowBtn" style="background-color: #007bff;">Add
                                    Row</button>
                                <button type="button" id="deleteRow"
                                    style="background-color: red; display:none;">Delete</button>
                            </td>
                        </tfoot>
                        @endif
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
                        <br>
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
        </div>
    </div>
    <div class="card" id="poMoreInfo">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#poInfo" aria-expanded="false">
                    MORE INFORMATION
                </button>
            </h2>
        </div>
        <div id="poInfo" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" readonly value="{{ $purchase_order->mp_status }}" class="form-control form-input">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#suppQuotationTable").DataTable();
        $("#itemTable").DataTable({
            "searching" : false,
            "paging" : false,
            "ordering" : false,
            "info" : false,
        });
    });
</script>

<div class="modal fade" id="npo_itemListView" tabindex="-1" role="dialog" aria-labelledby="npo_itemListView"
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
                <table id="order_itemList" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Quantity Ordered</th>
                            <th>Rate</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--
                        <tr>
                            <td class="text-bold">4</td>
                            <td class="text-bold">Sample Item</td>
                            <td>300</td>
                            <td>100</td>
                            <td>33%</td>
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