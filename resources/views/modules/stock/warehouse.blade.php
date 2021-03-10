<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Warehouse</h2>
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
                        <li><a class="dropdown-item" href="#">Print</a></li>
                        <li><a class="dropdown-item" href="#">Email</a></li>
                        <li><a class="dropdown-item" href="#">Jump to Field</a></li>
                        <li><a class="dropdown-item" href="#">Links</a></li>
                        <li><a class="dropdown-item" href="#">Duplicate</a></li>
                        <li><a class="dropdown-item" href="#">Rename</a></li>
                        <li><a class="dropdown-item" href="#">Reload</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                        <li><a class="dropdown-item" href="#">Customize</a></li>
                        <li><a class="dropdown-item" href="javascript:onclick=openWarehouseNew()">New Warehouse</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadWarehouse();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit" onclick="openWarehouseNew();" data-target="#myModal">New</button>
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
                    <td class="text-nowrap">Warehouse Name</td>
                    <td class="text-nowrap">Status</td>
                    <td class="text-nowrap">Is Group</td>
                    <td class="text-nowrap">Company</td>
                    <td class="text-nowrap">Disabled</td>
                    <td class="text-nowrap">City</td>
                    <td class="text-nowrap"></td>
                    <td class="text-nowrap"></td>
                    <td class="text-nowrap">4 of 4</td>
                    <td class="text-nowrap"></td>
                </tr>
            </thead>
            <tbody class="">
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a name="Millimeter" href='javascript:onclick=openWarehouseEdit()'>All Warehouses</a></td>
                    <td>Enabled</td>
                    <td class="text-black-bold-50"><i class="fas fa-check"></i></td>
                    <td>Almedah Foods</td>
                    <td></td>
                    <td></td>
                    <td>All Warehouses - ALM</td>
                    <td>10 M</td>
                    <td><span class="fas fa-comments"></span>0</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a name="Millimeter" href='javascript:onclick=openWarehouseEdit()'>Finished Goods</a></td>
                    <td>Enabled</td>
                    <td class="text-black-bold-50">
                        <i class="fas fa-check"></i>
                    </td>
                    <td>Almedah Foods</td>
                    <td></td>
                    <td></td>
                    <td>Finished Goods - ALM</td>
                    <td>10 M</td>
                    <td><span class="fas fa-comments"></span>0</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a name="Millimeter" href='javascript:onclick=openWarehouseEdit()'>Work in Progress</a></td>
                    <td>Enabled</td>
                    <td class="text-black-bold-50">
                        <i class="fas fa-check"></i>
                    </td>
                    <td>Almedah Foods</td>
                    <td></td>
                    <td></td>
                    <td>Work in Progress - ALM</td>
                    <td>10 M</td>
                    <td><span class="fas fa-comments"></span>0</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a name="Millimeter" href='javascript:onclick=openWarehouseEdit()'>Stores</a></td>
                    <td>Enabled</td>
                    <td class="text-black-bold-50">
                        <i class="fas fa-check"></i>
                    </td>
                    <td>Almedah Foods</td>
                    <td></td>
                    <td></td>
                    <td>Stores - ALM</td>
                    <td>10 M</td>
                    <td><span class="fas fa-comments"></span>0</td>
                    <td></td>
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