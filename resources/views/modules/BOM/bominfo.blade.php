<?php
$op_index = 0;
$mat_index = 0;
?>
<script src="{{ asset('js/bominfo.js') }}"></script>
<script src="{{ asset('js/address.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">{{ $bom->bom_name }}</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="responsive">
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
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadBOMtable();">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <form action="/delete-bom/{{ $bom->bom_id }}" id="deleteBOM" method="post">
                        @csrf
                        @method('DELETE')
                        <button style="background-color: #ff0000d7;" class="btn btn-danger btn" style="float: left;"
                            onclick="" id="bomDelete">Delete</button>
                    </form>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;"
                        id="saveBom">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="card">
    <div class="card-body ml-auto">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Links
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <a class="dropdown-item" href="#">Link1</a>
            <a class="dropdown-item" href="#">Link2</a>
            <a class="dropdown-item" href="#">Link3</a>
        </div>
    </div>
</div>

<form action="/update-bom/{{ $bom->bom_id }}" method="post" id="saveBomForm" class="create">
    <br>
    @csrf
    @method('PATCH')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="form-group" id="product-select" @if ($bom->product_code == null) hidden @endif>
                    <label for="manprod">Item</label>
                    <select class="form-control selectpicker" id="manprod">
                        @if ($bom->product_code == null)
                            <option value="0">-No Product Selected-</option>
                            @foreach ($man_prods as $mp)
                                <option data-subtext="{{ $mp->product_name }}" value="{{ $mp->product_code }}">{{ $mp->product_code }}</option>
                            @endforeach
                        @else
                            <option selected data-subtext="{{ $item->product_name }}" value="{{ $item->product_code }}">{{ $item->product_code }}
                            </option>
                            @foreach ($man_prods as $mp)
                                @if ($mp->product_code != $item->product_code)
                                    <option data-subtext="{{ $mp->product_name }}" value="{{ $mp->product_code }}">{{ $mp->product_code }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group" id="component-select" @if($bom->component_code == null) hidden @endif>
                    <label for="components">Component</label>
                    <select class="form-control selectpicker" id="components">
                        @if ($bom->component_code == null)
                            <option value="0">-No Component Selected-</option>
                            @foreach ($components as $cp)
                                <option data-subtext="{{ $cp->component_name }}" value="{{ $cp->component_code }}">{{ $cp->component_code }}</option>
                            @endforeach
                        @else
                            <option selected data-subtext="{{ $item->component_name }}" value="{{ $item->component_code }}">{{ $item->component_code }}
                            </option>
                            @foreach ($components as $cp)
                                @if ($item->component_code != $cp->component_code)
                                    <option data-subtext="{{ $cp->component_name }}" value="{{ $cp->component_code }}">{{ $cp->component_code }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-6">
                <div id="item_content">
                    <div class="form-group">
                        <label for="Item_name">Item Name</label>
                        <input type="text" readonly name="Item_name" id="Item_name"
                            value="@if ($bom->product_code != null) {{ $item->product_name }} @else {{ $item->component_name }} @endif" class="form-control">
                    </div>
                    <div class="form-group" id="selected-uom">
                        <label for="Item_UOM">Item UOM</label>
                        <input type="text" readonly name="Item_UOM" id="Item_UOM" value="@if ($bom->product_code != null) {{ $item->unit }} @endif" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="is_component" 
                    @if ($bom->component_code != null)
                        checked
                    @endif>
                    <label class="form-check-label" for="is_component">
                        Is Component
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="Is_active" @if ($bom->is_active == 1) checked @endif>
                    <label class="form-check-label" for="Is_active">
                        Is Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="default" @if ($bom->is_default == 1) checked @endif>
                    <label class="form-check-label" for="default">
                        Default
                    </label>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#item"
                        aria-expanded="false" aria-controls="Item">
                        OPERATIONS
                    </a>
                </h5>
            </div>
            <div id="item" class="collapse" aria-labelledby="headingOne">
                <div class="card-body">
                    <!--operation contents-->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="routing">Routing</label>
                            <select class="form-control" name="routing" id="routingSelect">
                                <option value="{{ $routing->routing_id }}" selected hidden>
                                    {{ $routing->routing_name }}</option>
                                @foreach ($routings as $ro)
                                    <option value="{{ $ro->routing_id }}">{{ $ro->routing_name }}</option>
                                @endforeach
                                <option value="newRouting">Create New Routing</option>
                            </select>
                        </div>
                    </div>
                    <label>Operations</label>
                    <table class="table border-bottom table-hover table-bordered" id="bom-operations">
                        <thead class="border-top border-bottom bg-light">
                            <tr class="text-muted">
                                <td class="text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>

                                <td class="text-center">Operation Name</td>
                                <td class="text-center">Work Center</td>
                                <td class="text-center">Description</td>
                                <td class="text-center">Operation Time</td>
                                <td class="text-center">Operation Cost</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="" id="operations-input-rows">
                            @foreach ($routing_ops as $operation)
                            <tr id="bomOperation-<?= $op_index ?>">
                                <td class="text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td id="mr-code-input" class="mr-code-input">
                                    <input type="text" value="{{ $operation['operation']->operation_name }}" readonly name="Operation_name" id="Operation_name" class="form-control">
                                </td>
                                <td style="width: 10%;" class="mr-qty-input">
                                    <input type="text" value="{{ $operation['operation']->wc_code }}" readonly name="D_workcenter" id="D_workcenter" class="form-control">
                                </td>
                                <td class="mr-unit-input">
                                    <input type="text" value="{{ $operation['operation']->description }}" readonly name="Desc" id="Desc" class="form-control">
                                </td>
                                <td class="mr-unit-input">
                                    <input type="text" value="{{ $operation['operation_time'] }}" readonly name="Operation_Time" id="Operation_Time" class="form-control">
                                </td>
                                <td class="mr-unit-input">
                                    <input type="text" value="{{ $operation['operating_cost'] }}" readonly name="Operation_cost" id="Operation_cost" class="form-control">
                                </td>
                                <td>
                                    <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#"
                                        role="button">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a id="" class="btn delete-btn" href="#" role="button">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                                @php
                                ++$op_index;
                                @endphp
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <td colspan="7" rowspan="5">
                        <button type="button" onclick="addRowoperations()" class="btn btn-sm btn-sm btn-secondary">Add
                            Row</button>
                    </td>
                    <!--end contents-->
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#materials"
                        aria-expanded="false" aria-controls="Item">
                        MATERIALS
                    </a>
                </h5>
            </div>
            <div id="materials" class="collapse" aria-labelledby="headingOne">
                <div class="card-body">
                    <!--Materials contents-->
                    <table class="table border-bottom table-hover table-bordered" id="bom-materials">
                        <thead class="border-top border-bottom bg-light">
                            <tr class="text-muted">
                                <td class="text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td class="text-center">No.</td>
                                <td class="text-center">Item Code</td>
                                <td class="text-center">Quantity</td>
                                <td class="text-center">UOM</td>
                                <td class="text-center">Rate</td>
                                <td class="text-center">Amount</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="" id="materials-input-rows">
                            @foreach ($rateList as $mat_data)
                            <tr id="bomMaterial-<?= $mat_index ?>">
                                <td class="text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td id="mr-code-input" class="mr-code-input">
                                    <input type="text" value="<?= $mat_index+1 ?>" readonly name="No" id="No" class="form-control">
                                </td>
                                <td style="width: 10%;" class="mr-qty-input">
                                    <input type="text" value="{{ $mat_data->item_code }}" readonly name="ItemCode" id="ItemCode" class="form-control">
                                </td>
                                <td class="mr-unit-input">
                                    <input type="text" value="{{ $mat_data->qty }}" readonly name="Quantity" id="Quantity" class="form-control">
                                </td>
                                <td class="mr-unit-input">
                                    <input type="text" value="{{ $mat_data->item->uom->item_uom }}" readonly name="UOM" id="UOM" class="form-control">
                                </td>
                                <td class="mr-unit-input">
                                    <input type="number" value="{{ $mat_data->rate }}" @if($mat_data->rate != 1) readonly @endif name="Rate" id="Rate" class="form-control">
                                </td>
                                <td class="mr-unit-input"><input type="number" value="<?= $mat_data->qty * $mat_data->rate ?>" readonly name="Amount" id="Amount"
                                        class="form-control"></td>
                                <td>
                                    <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#"
                                        role="button">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a id="" class="btn delete-btn" href="#" role="button">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                                ++$mat_index;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <td colspan="7" rowspan="5">
                        <button type="button" onclick="addRowmaterials()" class="btn btn-sm btn-sm btn-secondary">Add
                            Row</button>
                    </td>
                    <!--end contents-->
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#costing"
                        aria-expanded="false" aria-controls="Item">
                        COSTING
                    </a>
                </h5>
            </div>
            <div id="costing" class="collapse" aria-labelledby="headingOne">
                <div class="card-body">
                    <!--costing contents-->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="totalOpCost">Operation Cost</label>
                                <input type="text" value="0" readonly name="totalOpCost" id="totalOpCost"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="totalMatCost">Raw Material Cost</label>
                                <input type="text" value="0" readonly name="totalMatCost" id="totalMatCost"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="totalBOMCost">Total Cost</label>
                                <input type="text" value="0" readonly name="totalBOMCost" id="totalBOMCost"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <!--end contents-->
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        if($("#is_component").prop('checked') == true)  $("#selected-uom").css('display', 'none');
        computeCosts();
    });
</script>
