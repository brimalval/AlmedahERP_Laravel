<!-- Datatable links -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Purchase Receipt</h2>
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
                        onclick="loadPurchaseReceipt()">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-primary" onclick="openNewPurchaseReceipt();">
                        New
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<table id="purchaseReceiptTable" class="table table-striped table-bordered hover" style="width:100%">
    <thead>
        <tr>
            <th>Purchase Receipt ID</th>
            <th>Date Created</th>
            <th>Purchase ID</th>
            <th>Item List Received</th>
            <th>Grand Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($receipts as $receipt)
            <tr>
                <td class="text-bold">
                    <a href="javascript:onclick=openPurchaseReceiptInfo({{ $receipt->id }})">
                        {{ $receipt->p_receipt_id }}
                    </a>
                </td>
                <td>{{ $receipt->date_created }}</td>
                <td>{{ $receipt->purchase_id }}</td>
                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                        data-toggle="modal" data-target="#pr_itemListView"
                        onclick="viewMaterials({{ $receipt->id }})">View</button></td>
                <td class="text-bold price">{{ $receipt->grand_total }}</td>
                <td>{{ $receipt->pr_status }}</td>
            </tr>
        @endforeach
        <!--
        <tr>
            <td class="text-bold">PR-123</td>
            <td>March/28/2021</td>
            <td>text-center</td>
            <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary" data-toggle="modal"
                    data-target="#pr_itemListView">View</button></td>
            <td class="text-bold">100</td>
            <td>Draft</td>
        </tr>
    -->
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="pr_itemListView" tabindex="-1" role="dialog" aria-labelledby="pr_itemListView"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="purchaseReceiptTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity To Receive</th>
                        </tr>
                    </thead>
                    <tbody id="receivedMats">

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
        x = $('#purchaseReceiptTable').DataTable();
        z = $('#itemListViewTable').DataTable();

        $(".price").each(function () {
            // element == this
            let price = parseFloat($(this).html());
            let price_string = "₱ " + numberWithCommas(price.toFixed(2));
            $(this).html(price_string);
        });
    });

    /**From internet function */
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }

    function viewMaterials(id) {
        $.ajax({
            type: "GET",
            url: `/get-received-mats/${id}`,
            data: id,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#receivedMats tr").remove();
                for (i = 0; i < data.received_mats.length; i++) {
                    $("#receivedMats").append(
                        `
                        <tr>
                            <td class="text-bold">${data.received_mats[i]['item_name']}</td>
                            <td>${data.received_mats[i]['qty']}</td>
                        </tr>
                        `
                    );
                }
            }
        });
    }

</script>
