<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Purchase Order</h2>
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
                        <li><a class="dropdown-item" href="#">Close</a></li>
                        <li><a class="dropdown-item" href="#">Re-open</a></li>
                        <li><a class="dropdown-item" href="#">Import</a></li>
                        <li><a class="dropdown-item" href="#">User Permissions</a></li>
                        <li><a class="dropdown-item" href="#">Role Permissions Manager</a></li>
                        <li><a class="dropdown-item" href="#">Customize</a></li>
                        <li><a class="dropdown-item" href="#">Toggle Sidebar</a></li>
                        <li><a class="dropdown-item" href="#">Share URL</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="button"
                        onClick="loadPurchaseOrder();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-info btn" style="background-color: #007bff;"
                        onclick="openNewPurchaseOrder();">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card my-2">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Title">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <input type="text" id="buying-purchaseorder-filter-input" class="form-control"
                            placeholder="Supplier Name">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Raw Material Name">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Grand Total">
                    </div>
                </div>
                <!--
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Almedah Food Equipment">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="">
                    </div>
                </div>
            -->
            </div>
        </div>
        <div class="card-body filter">
            <div class="row">
                <div class="float-left">
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        Add Filter
                    </button>
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        Clear Filters
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
        <hr>
        <div>
            <div class="col-12">
                <table id='tbl-buying-purchaseorder' class="table table-sm table-hover w-100">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Grand Total</th>
                            <!--
                            <th scope="col">% Received</th>
                            <th scope="col">% Billed</th>
                            -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials_purchased as $material)
                            <tr>
                                <td scope="col">
                                    <a
                                        href="javascript:onclick=viewPurchaseOrder({{ $material->id }})">{{ $material->purchase_id }}</a>
                                </td>
                                <td scope="col">{{ $material->mp_status }}</td>
                                <td scope="col">{{ $material->purchase_date }}</td>
                                <td scope="col" id="totalPrice{{ $loop->index + 1 }}">{{ $material->total_cost }}</td>
                                <!--
                                <td scope="col">0</td>
                                <td scope="col">0</td>
                                -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            for(let i=1; i<=$("#tbl-buying-purchaseorder tbody tr").length; i++) {
                let price = parseFloat($(`#totalPrice${i}`).html());
                //console.log($(`#totalPrice${i}`).html());
                $(`#totalPrice${i}`).html("₱ " + numberWithCommas(price.toFixed(2)));
            }
            
        });
    
        /**From internet function */
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var oTable = $('#tbl-buying-purchaseorder').dataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 0
                }],
                order: [
                    [1, 'asc']
                ],
                drawCallback: function() {
                    $('#products-table_wrapper').addClass('col-12');
                },
            });
            $(document).on('click', '#btn-buying-purchaseorder-add', function(e) {
                e.preventDefault();
                modalCrmLeadsForm.modal('show');
            });

            $(document).on('click', '.close-modal-buying-purchaseorder-form', function() {
                modalCrmLeadsForm.modal('hide');
            });

            // custom datatables commands
            $(document).on('keyup', '#buying-purchaseorder-filter-input', function() {
                oTable.search($(this).val()).draw();
            });
            $(document).on('click', '#btn-buying-purchaseorder-pagination-previous', function() {
                oTable.page('previous').draw('page');
            });
            $(document).on('click', '#btn-buying-purchaseorder-pagination-next', function() {
                oTable.page('next').draw('page');
            });
        });
    </script>
