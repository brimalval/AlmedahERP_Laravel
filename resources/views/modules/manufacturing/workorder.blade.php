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
                    <td>Work Order No</td>
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
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td class="text-black-50">{{ $work_order->work_order_no }}</td>
                    
                    <td><a href="#" onclick='workOrderInfo({{ $work_order }}, `{{ $work_order->item["component_code"] ?? $work_order->item["product_code"] }}`, `{{ $work_order->sales_id }}`, `{{ $items[$index] }}`, `{{ json_encode($quantity[$index] ?? null) }}`)'> {{ $work_order->item['component_code'] ?? $work_order->item['product_code'] }} </a></td>
                    <td class="text-black-50">{{ $items[$index] }}</td>
                    <td>{{ $work_order->work_order_status }}</td>
                    {{-- @else
                        <td> {{ $components[$index] }} </a></td>
                        <td>{{ $work_order->work_order_status }}</td>
                        <td class="text-black-50"> </td>
                    @endif --}}
                    <td><!--<input type="checkbox">-->{{ $work_order->sales_id }}</td>
                    <td><small><!--<input type="checkbox">-->{{ Carbon\Carbon::parse($work_order->created_at)->diffForHumans(null, false, true) }}</small></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-left"></span></button>
        </div>
        <div class="col-1 text-center">
            <p>4 of 4</p>
        </div>
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>

<script>
    function workOrderInfo(workOrderDetails, itemName, salesOrderId, productCode, quantity){
        loadWorkOrderInfo(workOrderDetails, itemName, salesOrderId, productCode, quantity);
    }

</script>