<?php
$today = date('Y-m-d');
$i = 1;
?>

<script src="{{ asset('js/purchasereceipt.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        let total_price = 0;
        let total_qty = 0;
        for (let i = 1; i <= $('#itemsToReceive tr').length; i++) {
            total_qty += parseInt($(`#qtyAcc${i}`).val());
            total_price += parseFloat($(`#amtAcc${i}`).val());
        }
        $('#receiveQty').val(total_qty);
        $('#receivePrice').val(total_price);
    });

</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadPurchaseReceipt();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">Receipt <span
                    id="pr_id">{{ $receipt->p_receipt_id }}</span></h2>
            <br>
            <p id="">{{ $receipt->pr_status }}</p>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                @if ($receipt->pr_status === 'Draft')

                    <li class="nav-item li-bom">
                        <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                            onclick="loadPurchaseReceipt();">Cancel</button>
                    </li>
                    <li class="nav-item li-bom">
                        <button type="button" id="submitReceipt" class="btn btn-primary" data-target="#saveSale">
                            Submit
                        </button>
                    </li>

                @else
                    <li class="nav-item li-bom">
                        <button type="button" id="receiveMaterials" class="btn btn-primary" data-target="#saveSale">
                            Save Record
                        </button>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="accordion" id="accordion">
    <div class="card">
        @if ($receipt->pr_status === 'Draft')
            <div class="card-header" id="heading1">
                <h2 class="mb-0">
                    <button class="btn-sm btn-primary dropdown-toggle float-right" href="#" role="button"
                        id="dropdownMenunpr" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Get Items from
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenunpr">
                        <a class="dropdown-item" href="#" data-toggle="modal"
                            data-target="#npr_purchaseOrderModal">Purchase
                            Order</a>
                    </div>
                </h2>
            </div>
        @endif
        <div class="collapse show" id="salesOrderCard1">
            <div class="card-body">
                <form action="" id="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Series
                            </label>
                            <div class="d-flex">
                                <input type="text" class="form-input form-control" id="receiptId" max="6"
                                    value={{ $receipt->p_receipt_id }} readonly>
                            </div>
                            <br>
                            <label class=" text-nowrap align-middle">
                                Supplier
                            </label>
                            <input type="text" required class="form-input form-control"
                                value="{{ $supplier->company_name }}" readonly id="">
                            <br>
                            <input type="text" required class="form-input form-control" hidden id="orderId"
                                value="{{ $receipt->purchase_id }}">
                        </div>
                        <div class="col">
                            <br>
                            <label class="text-nowrap align-middle">
                                Date
                            </label>
                            <input type="date" required class="form-input form-control" id="npr_date" readonly
                                value={{ $receipt->date_created }}>
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
                            <input type="text" required class="form-input form-control" readonly
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
                    RECEIVE MATERIALS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard5" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label class=" text-nowrap align-middle">Items to Receive</label>
                        <table class="table border-bottom table-hover table-bordered" id="itemsFromOrder">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <!--
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" id="mainChk" @if ($receipt->pr_status === 'Draft') onchange="onChangeFunction();" @else disabled @endif class="form-check-input">
                                        </div>
                                    </td>-->
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    @if ($receipt->pr_status !== 'Draft')
                                        <th>Accepted Quantity</th>
                                    @endif
                                    <th>Quantity Ordered</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody class="" id="itemsToReceive">
                                @foreach ($materials as $material)
                                <tr id="row-<?= $i ?>">
                                    <td class="text-black-50">
                                        <span id="item_code<?= $i ?>">
                                            {{ $material['item_code'] }}
                                        </span>
                                    </td>
                                    <td class="text-black-50">
                                        <span id="prItemName<?= $i ?>">
                                            {{ $material['item_name'] }}
                                        </span>
                                    </td>
                                    @if ($receipt->pr_status !== 'Draft')
                                        <td class="text-black-50">
                                            <input type="number" id="qtyRec<?= $i ?>" @if ($material['qty'] == 0) readonly value = "0" @else placeholder="Enter quantity..." @endif>
                                        </td>
                                    @endif
                                    <td class="text-black-50">
                                        <span id="qtyAcc<?= $i ?>">
                                            {{ $material['qty'] }}
                                        </span>
                                    </td> 
                                    <td class="text-black-50">
                                        <span id="rateAcc<?= $i ?>">
                                            {{ $material['rate'] }}
                                        </span>
                                    </td> 
                                    <td class="text-black-50">
                                        <span id="amtAcc<?= $i ?>">
                                            {{ $material['amount'] }}
                                        </span>
                                    </td> 
                                </tr>
                                <?php ++$i; ?>
                                @endforeach
                            </tbody>
                            
                            <tfoot>
                                <td colspan="7" rowspan="5">
                                    
                                </td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardQuantityPHP">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard6" aria-expanded="false">
                    PRICE
                </button>
            </h2>
        </div>
        <div id="salesOrderCard6" class="collapse">
            <div class="card-body">
                <div class="row my-4">
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Total Quantity
                            </label>
                            <input type="number" required class="form-input form-control" id="receiveQty">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Total (PHP)
                            </label>
                            <input type="number" required class="form-input form-control" id="receivePrice">
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
                            <select id="recStatus" readonly class="form-control">
                                <option selected>{{ $receipt->pr_status }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Purchase Order-->
<div class="modal fade" id="npr_purchaseOrderModal" tabindex="-1" role="dialog" aria-labelledby="npr_purchaseOrderModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Purchase Orders</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="purchaseReceiptTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Purchase ID</th>
                            <th>Date</th>
                            <th>Item List</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="text-bold">{{ $order->purchase_id }}</td>
                                <td>{{ $order->purchase_date }}</td>
                                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                        data-toggle="modal" data-target="#npr_itemListView" onclick="viewOrderItems({{ $order->id }})">View</button></td>
                                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                        data-dismiss="modal" onclick="loadMaterials({{ $order->id }})">Select</button></td>   
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
<div class="modal fade" id="npr_itemListView" tabindex="-1" role="dialog" aria-labelledby="npr_itemListView"
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
                <table id="npr_itemList" class="table table-striped table-bordered hover" style="width:100%">
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
<script type="text/javascript">
    $("#purchaseReceiptTable").DataTable();
    $("#itemsFromOrder").DataTable();
</script>
