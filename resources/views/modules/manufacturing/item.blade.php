<style>
    .imagePreview {
        width: 180px;
        height: 180px;
        background-position: center center;
        background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
        background-color: #fff;
        background-size: cover;
        background-repeat: no-repeat;
        display: inline-block;
        box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Item</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" style="left:-50px;" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Manage Categories</a></li>
                        <li><a class="dropdown-item" href="#">Run Report</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-7">
                            <p>Name</p>
                            <textarea class="form-control" name="" id="prdname" cols="50" rows="4"></textarea>
                            <label for="skuinput">SKU</label>
                            <input class="form-control" type="text" name="" id="skuinput">
                        </div>
                        <div class="col-4">
                            <label class="btn">
                                <img class="imagePreview" src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg" alt="">
                                <input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                            </label>
                        </div>
                    </div>
                    <label for="inputcat">Category</label>
                    <select class="form-control" name="" id="inputcat">
                        <option disabled selected>Choose a category</option>
                        <option value=""><button>+ Add new</button></option>
                    </select>
                    <label for="proddescription">Description</label>
                    <input class="form-control" type="text" name="" id="proddescription" placeholder="Description on sales forms">
                    <div class="row">
                        <div class="col-6">
                            <label for="salesrate">Sales price/rate</label>
                            <input class="form-control" type="text" name="" id="salesrate">
                        </div>
                        <div class="col-6">
                            <label for="salesinput">Income Account</label>
                            <select class="form-control" name="" id="salesinput">
                                <option value="">Sales</option>
                                <option value="">Sales - retail</option>
                                <option value="">Sales - wholesale</option>
                                <option value="">Sales of Product Income</option>
                                <option value="">Uncategorized Income</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="card my-2">
        <div class="card-header bg-light">
            <div class="card-body filter">
                <div class="row">
                    <div class="float-left">
                        <div class="row">
                            <div class="col-10">
                                <input class="form-control" type="text" name="" id="" placeholder="Find products">
                            </div>
                            <div class="col-2">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle fas fa-filter" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    </button>
                                    <ul class="dropdown-menu" style="width:300px;" aria-labelledby="dropdownMenuButton">
                                        <form>
                                            <li class="m-3">
                                                <label for="statusFilter">Status</label>
                                                <select class="form-control" id="statusFilter">
                                                    <option value="">Active</option>
                                                    <option value="">Inactive</option>
                                                    <option value="">All</option>
                                                </select>
                                            </li>
                                            <li class="m-3">
                                                <label for="categoryFilter">Category</label>
                                                <select class="form-control" id="categoryFilter">
                                                    <option value="">Category 1</option>
                                                    <option value="">Category 2</option>
                                                    <option value="">Category 3</option>
                                                </select>
                                            </li>
                                            <li class="m-3">
                                                <button class="btn btn-success">Apply</button>
                                                <button class="btn btn-secondary float-right">Reset</button>
                                            </li>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" ml-auto float-right dropdown">
                        <button class="fas fa-print"></button>
                        <button class="fas fa-download mx-3"></button>
                        <button class="fas fa-cog dropdown-toggle" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu mx-auto dropdown-menu-dark" style="width:300px;" aria-labelledby="dropdownMenuButton4">
                            <form>
                                <div class="mx-3 mt-2 mb-1 font-weight-bold">
                                    Columns
                                </div>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="incomeSet">
                                    <label class="form-check-label" for="incomeSet">
                                        Income Account
                                    </label>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="ExpenseSet">
                                    <label class="form-check-label" for="ExpenseSet">
                                        Expense Account
                                    </label>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="PurchaseSet">
                                    <label class="form-check-label" for="PurchaseSet">
                                        Purchase Description
                                    </label>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="SKUSet">
                                    <label class="form-check-label" for="SKUSet">
                                        SKU
                                    </label>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="TypeSet">
                                    <label class="form-check-label" for="TypeSet">
                                        Type
                                    </label>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="SalesSet">
                                    <label class="form-check-label" for="SalesSet">
                                        Sales Description
                                    </label>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="PriceSet">
                                    <label class="form-check-label" for="PriceSet">
                                        Sales Price
                                    </label>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="CostSet">
                                    <label class="form-check-label" for="CostSet">
                                        Cost
                                    </label>
                                </li>
                                <li class="m-3 ">
                                    <label for="settingRows" class="font-weight-bold">Rows</label>
                                    <select class="form-control" id="settingRows">
                                        <option value="">50</option>
                                        <option value="">100</option>
                                        <option value="">150</option>
                                        <option value="">200</option>
                                        <option value="">250</option>
                                    </select>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="CompactSet">
                                    <label class="form-check-label" for="CompactSet">
                                        Compact
                                    </label>
                                </li>
                                <li class="mx-3 form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="GroupSet">
                                    <label class="form-check-label" for="GroupSet">
                                        Group by Category
                                    </label>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="m-3">
                                    <button class="btn btn-success">Apply</button>
                                    <button class="btn btn-secondary float-right">Reset</button>
                                </li>
                            </form>
                        </ul>
                    </div>
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
                    <td>Name</td>
                    <td>SKU</td>
                    <td>Sales Description</td>
                    <td>Sales Price</td>
                    <td>Cost</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody class="">
                <tr>
                    <td class="align-middle">
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><img src="./images/imgsample.png" alt="" style="width: 100px; height: 100px;">Name of
                        Products</td>
                    <td class="test_black-50"></td>
                    <td class="text-black-50"></td>
                    <td class="text-black-50"></td>
                    <td class="text-black-50"></td>
                    <td class="align-middle">
                        <div class="dropdown">
                            <a href="" data-bs-toggle="modal" data-bs-target="#addProduct">Edit</a>
                            <button class=" dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"> </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item active" href="#">Make inactive</a></li>
                                <li><a class="dropdown-item" href="#">Run Report</a></li>
                                <li><a class="dropdown-item" href="#">Duplicate</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-left"></span></button>
        </div>
        <div class="col-1 text-center">
            <p>1 of 1</p>
        </div>
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>