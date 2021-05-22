<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Supplier</h2>
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
                        <li><a class="dropdown-item" href="#">Edit</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadBOM()">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">New</button>
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
                        <input type="text" class="form-control" placeholder="Supplier Name">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Supplier Group">
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
                    <td>Supplier ID</td>
                    <td>Supplier Name</td>
                    <td>Contact Name</td>
                    <td>Phone Number</td>
                    <td>Supploer Address</td>
                    <td>Supplier Group</td>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td><a href='javascript:onclick=openSupplierInfo({{ $supplier->id }});'>{{ $supplier->company_name }}</a></td>
                        <td>
                            <ul>
                                <li>Enabled</li>
                            </ul>
                        </td>
                        <td class="text-black-50">{{ $supplier->supplier_group }}</td>
                        <td class="text-black-50">2 M</td>
                    </tr>
                @endforeach
                <!--
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a href='javascript:onclick=openSupplierInfo();'>Hi-top</a></td>
                    <td>
                        <ul>
                            <li>Enabled</li>
                        </ul>
                    </td>
                    <td class="text-black-50">Raw Material</td>
                    <td class="text-black-50">2 M</td>
                </tr>
            -->
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


<!-- Modal to generate new supplier -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Supplier</h5>
                <button type="button" class="btn-close fas fa-times" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="snewid">Supplier ID</label>
                <input type="text" id="snewid" class="form-control font-weight-bold" value="Auto Generated" disabled>
                <label for="snewcompanyname">Company Name</label>
                <input type="text" id="snewcompanyname" class="form-control" value="">
                <label for="snewcontactname">Contact Name</label>
                <input type="text" id="snewcontactname" class="form-control" value="">
                <label for="snewphonenumber">Phone Number</label>
                <input type="number" id="snewphonenumber" class="form-control" value="">
                <label for="snewemail">Suppier E-mail</label>
                <input type="email" id="snewemail" class="form-control" value="">
                <label for="snewaddress">Suppier Address</label>
                <!-- <input type="textarea" id="snewaddress" class="form-control font-weight-bold" value=""> -->
                <textarea id="snewaddress" id="" cols="30" rows="5" class="form-control"></textarea>
                <label for="snewtpye">Supplier Group</label>
                <select name="" id="snewtype" class="form-control font-weight-bold">
                    <option value="Raw Material" selected>Raw Material</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Hardware">Hard ware</option>
                </select>
                <div class="d-flex">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="snewdisabled">
                    </div>
                    <label for="snewdisabled">Disabled</label>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-info menu" data-name="Create New Supplier" data-parent="buying"
                    data-bs-dismiss="modal" value="Edit in full page">
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
