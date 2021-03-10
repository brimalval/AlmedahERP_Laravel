<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <a href="javascript:onclick=loadWarehouse()" class="text-black mr-2 p-2" style="font-size: 2rem;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="navbar-brand" style="font-size: 35px;">New Warehouse 1</h2><span class="text-black-12">Not Saved</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="accordion p-1">
    <div class="card">
        <div class="card-header" id="1">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#warehouseDetail" aria-expanded="true">
                    WAREHOUSE DETAIL
                </button>
            </h2>
        </div>
        <div id="warehouseDetail" class="collapse show">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="warehouseName">Warehouse Name</label>
                        <input type="text" class="form-control" id="warehouseName">
                        <small class="text-muted">
                            If blank, parent Warehouse
                            Account or company default will be considered
                        </small>
                    </div>
                    <div class="col">
                        <label for="warehouseAccount">Account</label>
                        <input type="text" class="form-control" id="warehouseAccount">
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="d-flex align-items-center mt-2">
                            <input type="checkbox" id="isWarehouseGroup">
                            <label class="ml-1" for="isWarehouseGroup">
                                Is Group
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <label for="warehouseType">Warehouse Type</label>
                        <input type="text" class="form-control" id="warehouseType">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <small class="text-muted">Company</small><br>
                        <p class="font-weight-bolder">Almedah Food Equipments</p>
                        <br>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="isWarehouseDisabled">
                            <label class="ml-1">Disabled</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card disabled">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed disabled" type="button" data-toggle="collapse" data-target="#warehouseAddressContract" aria-expanded="false">
                    ADDRESS AND CONTACT
                </button>
            </h2>
        </div>
        <div id="warehouseAddressContract" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <small>No address added yet.</small> <br>
                        <button class="btn btn-sm" style="background-color: #e6e6e6;">New Address</button>
                    </div>
                    <div class="col">
                        <small>No address added yet.</small> <br>
                        <button class="btn btn-sm " style="background-color: #e6e6e6;">New Address</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#warehouseContactInfo" aria-expanded="false">
                    WAREHOUSE CONTACT INFO
                </button>
            </h2>
        </div>
        <div id="warehouseContactInfo" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="warehousePhoneNo">Phone No</label>
                        <input type="text" class="form-control" id="warehousePhoneNo">
                    </div>
                    <div class="col">
                        <label for="warehouseAddressLine1">Address Line 1</label>
                        <input type="text" class="form-control" id="warehouseAddressLine1">
                        <label for="warehouseAddressLine2">Address Line 2</label>
                        <input type="text" class="form-control" id="warehouseAddressLine2">
                    </div>
                </div>
                <br>
                <div class="row" style="flex-direction: row-reverse;">
                    <div class="col-6">
                        <label>City</label>
                        <input type="text" class="form-control" id="warehouseCity">
                        <label>State</label>
                        <input type="text" class="form-control" id="warehouseState">
                        <label>PIN</label>
                        <input type="text" class="form-control" id="warehousePIN">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#description" aria-expanded="false">
                    TREE DETAILS
                </button>
            </h2>
        </div>
        <div id="description" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label for="warehouseParent">Parent Warehouse</label>
                        <input type="text" class="form-control" style="background-color: #fffddb;" id="warehouseParent">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
    </div>
</div>