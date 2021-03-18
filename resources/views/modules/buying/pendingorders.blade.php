<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">Pending Orders</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadPendingOrders();">Refresh</button>
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
                        <input type="text" class="form-control" placeholder="Title">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Requested For">
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
        <table class="table table-bom border-bottom">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Item Code</td>
                    <td>Quantity Received</td>
                    <td>Sales ID</td>
                    <td>Destination</td>
                    
                    <td></td>
                </tr>
            </thead>
            <tbody class="">
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td ><a name="BOM-PR-EM-ADJ CAP-002" href='javascript:onclick=openPendingOrdersInfo();'>MTL-BAR-SHAFT-CRS-3/4"</a></td>
                    <td><input type="number" value="200" class="form-control"></td>
                    <td class="text-black-50">Emulsifier</td>
                    <td class="text-black-50">Warehouse 1</td>
                    
                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>MTL-BAR-SHAFT-CRS-5"</td>
                    <td><input type="number" value="200" class="form-control"></td>
                    <td class="text-black-50">Emulsifier</td>
                    <td class="text-black-50">Warehouse 1</td>
                    
                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>MTL-BAR-SHAFT-CRS-5/8"</td>
                    <td><input type="number" value="200" class="form-control"></td>
                    <td class="text-black-50">Emulsifier</td>
                    <td class="text-black-50">Warehouse 2</td>
                    
                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Bar Shaft</td>
                    <td><input type="number" value="200" class="form-control"></td>
                    <td class="text-black-50">Emulsifier</td>
                    <td class="text-black-50">Warehouse 2</td>
                    
                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<style>
    .conContent {
        padding: 200px;
    }
</style>