<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Work Order</h2>
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
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadWorkOrder();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit" onclick="openNewWorkorder();">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card my-2" style="padding: 40px 50px;">

        <table id="workorderTable" class="table table-striped table-bordered hover my-4" style="width:100%">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td style="padding-left: 40px;">Work Order No</td>
                    <td>Item to Manufacture</td>
                    <td>For Product?</td>
                    <td>Status</td>
                    <td>Sales ID</td>
                    <td>Date Created</td>
                </tr>
            </thead>
            <tbody class="">
            @foreach($work_orders as $index => $work_order)
                <tr>
                    <td class="text-black-50" style="padding-left: 40px;">{{ $work_order->work_order_no }}</td>
                    
                    <td><a href="#" onclick='@if($work_order->sales_id) loadWorkOrderInfo({{ $work_order }}, `{{ $work_order->transferred_qty }}`,  `{{ $work_order->item["component_code"] ?? $work_order->item["product_code"] }}`, `{{ $work_order->sales_id ?? null }}`, `{{ $items[$index] ?? null }}`, `{{ json_encode($quantity[$index] ?? null) }}`) @else loadWorkOrderInfoWithoutSales({{ $work_order }}) @endif'> {{ $work_order->item['component_code'] ?? $work_order->item['product_code'] }} </a></td>
                    <td class="text-black-50">{{ $items[$index] }}</td>
                    <td>{{ $work_order->work_order_status }}</td>
                    <td>{{ $work_order->sales_id ?? null }}</td>
                    <td><small>{{ Carbon\Carbon::parse($work_order->created_at)->diffForHumans(null, false, true) }}</small></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
   
</div>

<script>
    $(document).ready(function() {
        $('#workorderTable').dataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc']
            ]
        });
    });
</script>
