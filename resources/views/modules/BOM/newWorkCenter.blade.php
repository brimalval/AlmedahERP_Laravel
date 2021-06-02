<script src="{{ asset('js/address.js') }}"></script>
<script src="{{ asset('js/workcenter.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">New Work Center</h2>
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
                        onclick="openManufacturingRoutingForm();">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" id="save_wc"
                        style="float: left;" onclick="">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form action="{{ route('workcenter.store') }}" method="post" id="newworkcenter" class="create">
    <br>
    <div class="container">
        {{-- <form id="newworkcenter" name="newworkcenter" role="form">
            @csrf --}}
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="Work_Center_Code">Work Center Code</label>

                    <input type="text" name="Work_Center_Code" id="Work_Center_Code" value="MOUNT-XXXX"
                        class="form-control" disabled>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="Work_Center_label">Work Center Label</label>
                    <input type="text" name="Work_Center_label" id="Work_Center_label" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="Type">Type</label>
                    <select class="form-control" id="wc_select" onchange="showForm()">
                        <option value="N/A"></option>
                        <option value="Human">Human</option>
                        <option value="Machine">Machine</option>
                        <option value="Human and Machine">Human & Machine</option>
                    </select>
                </div>
            </div>
            <div class="col-8">
                <div id="f1" style="display:none">
                    <label>Human</label>
                    <table class="table border-bottom table-hover table-bordered" id="operations">
                        <thead class="border-top border-bottom bg-light">
                            <tr class="text-muted">
                                <td class="text-center">Employee Name</td>
                                <td class="text-center">Hours</td>
                                <td class="text-center">Minutes</td>
                                <td class="text-center">Seconds</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="" id="newemployee-input-rows">
                            <tr data-id="${nextID}">
                                <td id="mr-code-input" class="mr-code-input"><input type="text" value=""
                                        name="Employee_name" list="employees" id="Employee_name" class="form-control">
                                </td>
                                <datalist id="employees">
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->employee_id }}">
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </option>
                                    @endforeach
                                </datalist>
                                <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                                        name="Employee_hours" id="Employee_hours" class="form-control"></td>
                                <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                                        name="Employee_minutes" id="Employee_minutes" class="form-control"></td>
                                <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                                        name="Employee_seconds" id="Employee_seconds" class="form-control"></td>
                                <td>
                                    <a id="" class="btn delete-btn" href="#" role="button">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <td colspan="7" rowspan="5">
                        <button type="button" onclick="addRownewEmployee()" class="btn btn-sm btn-sm btn-secondary">Add
                            Row</button>
                    </td>
                    <br>
                </div>
                <div class="col-8">
                    <div id="f1" style="display:block">
                         {{-- Paalala lang po, huwag na po ito i-balik 
                        <label>Human</label>
                       
                        <table class="table border-bottom table-hover table-bordered" id="operations">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td class="text-center">Employee Name</td>
                                    <td class="text-center">Duration</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="" id="newemployee-input-rows">
                                <tr data-id="${nextID}">
                                    <td id="mr-code-input" class="mr-code-input"><input type="text" value=""
                                            name="Employee_name" list="employees" id="Employee_name"
                                            class="form-control">
                                    </td>
                                    <td style="width: 10%;" class="mr-qty-input"><input type="text" value=""
                                            name="duration" id="duration" class="form-control">
                                    <td>
                                        <a id="" class="btn delete-btn" href="#" role="button">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <td colspan="7" rowspan="5">
                            <button type="button" onclick="addRownewEmployee()"
                                class="btn btn-sm btn-sm btn-secondary">Add
                                Row</button>
                        </td>
                    --}}
                        <br>
                    </div>

                    <div id="f2" style="display:none">
                        <br>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="Available_Machine">Available Machine</label>
                                <select class="form-control" id="Available_Machine">
                                    <option value="n/a">
                                        <li>No Option</li>
                                    </option>
                                    @foreach ($machines_manuals as $machine)
                                        <option value="{{ $machine->machine_code }}">
                                            {{ $machine->machine_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label>Machine</label>
                        <table class="table border-bottom table-hover table-bordered" id="operations">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td class="text-center">Machine Process</td>
                                    <td class="text-center">Setup Time</td>
                                    <td class="text-center">Running Time</td>
                                </tr>
                            </thead>
                            <tbody class="" id="newmachine-input-rows">
                                <tr data-id="${nextID}">
                                    <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly
                                            name="machine_process" id="machine_process" class="form-control"></td>
                                    <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly
                                            name="setup_time" id="setup_time" class="form-control">
                                    <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly
                                            name="Running_time" id="Running_time" class="form-control">

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
            </div>
        </div>
        {{-- </form> --}}
    </div>
    <br>
    @csrf
    <script src="{{ asset('js/newWorkcenter.js') }}"></script>
