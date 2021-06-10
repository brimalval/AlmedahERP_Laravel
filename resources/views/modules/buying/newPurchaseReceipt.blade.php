<?php
$today = date('Y-m-d');
?>

<script src="{{ asset('js/purchasereceipt.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <h2 class="navbar-brand" style="font-size: 35px;">New Purchase Receipt #</h2>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadPurchaseReceipt();">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" id="saveReceipt" class="btn btn-primary" data-target="#saveSale">
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
                <button class="btn-sm btn-primary dropdown-toggle float-right" href="#" role="button"
                    id="dropdownMenunpr" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Get Items from
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenunpr">
                    <a class="dropdown-item" href="#" data-toggle="modal"
                        data-target="#npr_purchaseOrderModal">Purchase Order</a>
                </div>
            </h2>
        </div>
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
                                <input type="text" class="form-input form-control" max="6" value="PR-00X" disabled>
                            </div>
                            <br>
                            <label class=" text-nowrap align-middle">
                                Supplier
                            </label>
                            <input type="text" required class="form-input form-control" id="suppField">
                            <br>
                            <input type="text" required class="form-input form-control" hidden id="orderId">
                        </div>
                        <div class="col">
                            <br>
                            <label class="text-nowrap align-middle">
                                Date
                            </label>
                            <input type="date" required class="form-input form-control" id="npr_date" readonly value=<?php echo $today;?>>
                            <br>
                            <!--
                            <label class=" text-nowrap align-middle">
                                Posting Time
                            </label>
                            <input type="text" required class="form-input form-control" id="npr_postingT" disabled>
                            <br>
                        
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="npr_editpdt">
                                #More concise form of enableDisable function from front-end
                                <script type="text/javascript">
                                    $("#npr_editpdt").change(function () { 
                                        let bEnable = $(this).prop('checked');
                                        $('#npr_date').prop('disabled', !bEnable);
                                        $('#npr_postingT').prop('disabled', !bEnable);
                                    });
                                </script>
                            </div>
                        
                            <label for="" class="form-check-label ml-4">Edit Posting Date and Time</label>-->
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
                            <input type="text" required class="form-input form-control" id="addressField">
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
                    MATERIALS TO RECEIVE
                </button>
            </h2>
        </div>
        <div id="salesOrderCard5" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label class="text-nowrap align-middle">Items to Receive</label>
                        <table class="table border-bottom table-hover table-bordered" id="itemsFromOrder">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Quantity Ordered</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody class="" id="itemsToReceive">
                                <tr id='nullRow'>
                                    <td colspan="7" style="text-align: center;">
                                        NO DATA
                                    </td>
                                </tr>
                            </tbody>
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

