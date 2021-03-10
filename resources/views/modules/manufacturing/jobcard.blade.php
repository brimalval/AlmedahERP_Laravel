<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
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
                        <li><a class="dropdown-item" href="#">Import</a></li>
                        <li><a class="dropdown-item" href="#">User Permission</a></li>
                        <li><a class="dropdown-item" href="#">Role Permissions Manager</a></li>
                        <li><a class="dropdown-item" href="#">Customize</a></li>
                        <li><a class="dropdown-item" href="#">Toggle Sidebar</a></li>
                        <li><a class="dropdown-item" href="#">Share URL</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onClick="loadNewEmployee()">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#newEmployee-Modal" style="background-color: #007bff;">New</button>
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
                        <input type="text" class="form-control" placeholder="Operation">
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
                    <td>Operation</td>
                    <td>Status</td>
                    <td>Work Order</td>
                    <td>Work Station</td>
                    <td>For Quantity</td>
                    <td>Refreshing ...</td>
   
                </tr>
            </thead>
            <tbody class="">
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td >Sample Operation</td>
                    <td>Default</td>
                    <td class="text-black-50">Sample Work Order</td>
                    <td class="text-black-50">Sample Work Station</td>
                    <td>Quantity</td>
                    <td></td>

                </tr>
             </tbody>
        </table>




            <div id="newEmployee-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-header">

                            <h3>New Job Card</h3>

                            <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <button type="button" class="btn btn-info btn" data-dismiss="modal" style="background-color: #DEDEDE; color: black;">Close</button>
                                </div>
                            </div>
                            <div class="col-1">

                            </div>
                             <div class="col-3">
                                <div class="form-group">
                                    <button type="button" class="btn btn-info btn" data-dismiss="modal" style="background-color: #007bff;">Save</button>
                                </div>
                            </div>
                            </div>

                        </div>

                        <form id="addJobCard" name="addJobCard" role="form" action="AddJobCard.php">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="workstation">Workstation</label>
                                            <input type="text" name="workstation" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="operation">Operation</label>
                                            <input type="text" name="operation" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="company">Company</label>
                                            <input name="company" class="form-control" value="Almedah Food Equipments">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="forQty">For Quantity</label>
                                            <input type="text" name="forQty" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="wipWh">WIP Warehouse</label>
                                            <input type="text" name="wipWh" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" style="background-color: #007bff;" class="btn btn-info btn menu" data-name="Add Job Card" data-dismiss="modal" style="float: left;" value="Edit in Full Page" />

                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>


<style>
    .conContent {
        padding: 200px;
    }
</style>