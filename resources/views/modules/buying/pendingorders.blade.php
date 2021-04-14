<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Pending Orders</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadPendingOrders();">Refresh</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
$i = 0;
?>

<table id="pendingOrdersTable" class="table table-striped table-bordered hover" style="width:100%">
    <thead>
        <tr>
            <th>Pending Order ID</th>
            <th>Receipt ID</th>
            <th>Item List Received</th>
            <th>Total %</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mat_ordered as $mo)
            <tr>
                <td class="text-bold">{{ $mo->mat_ordered_id }}</td>
                <td>{{ $mo->p_receipt_id }}</td>
                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary" data-toggle="modal"
                        data-target="#po_itemListView" onclick="showProgress({{ $mo->id }})">View</button></td>
                <td class="text-bold">{{ $totals[$i] }}%</td>
                <td>{{ $mo->mo_status }}</td>
            </tr>
            <?php ++$i; ?>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="po_itemListView" tabindex="-1" role="dialog" aria-labelledby="po_itemListView"
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
                <table id="itemListViewTablePO" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Quantity Ordered</th>
                            <th>Quantity Received</th>
                            <th>Percentage</th>
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
    $(document).ready(function() {
        x = $('#pendingOrdersTable').DataTable();
        z = $('#itemListViewTablePO').DataTable();
    });

    function showProgress(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: "GET",
            url: `/view-progress/${id}`,
            data: id,
            contentType: false,
            processData: false,
            success: function(response) {
                var item_list = response.items_list;
                //console.log(item_list);
                $("#itemListViewTablePO tbody tr").remove();
                var tbl = $("#itemListViewTablePO tbody");
                for (var i = 0; i < item_list.length; i++) {
                    var material = item_list[i].material;
                    tbl.append(
                        `
                        <tr>
                            <td class="text-bold">${material.item_code}</td>
                            <td class="text-bold">${material.item_name}</td>
                            <td>${item_list[i].qty_ordered}</td>
                            <td>${item_list[i].qty_received}</td>
                            <td>${item_list[i].curr_progress}%</td>
                        </tr>
                        `
                    );
                }
            }
        });
    }

</script>
