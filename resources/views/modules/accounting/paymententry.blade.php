<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2>Payment Entry</h2>
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
                        <li><a class="dropdown-item" href="#">User Permissions</a></li>
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
                    <input type="submit" style="background-color: #007bff;" class="btn btn-info btn menu" data-name="Add Payment Entry" style="float: left;" value="New" />
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
                    <td>Title</td>
                    <td>Status</td>
                    <td>Payment Type</td>
                    <td>Posting Date</td>
                    <td>Mode of Payment</td>
                    <td>Station ID</td>

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
                    <td>BOM-PR-EM-ADJ CAP-002</td>
                    <td>Active</td>
                    <td class="text-black-50">Insert Type</td>
                    <td class="text-black-50">Insert Date</td>
                    <td>Insert MOP</td>
                    <td class="text-black-50">Insert ID</td>

                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>BOM-PR-EM-ADJ CAP-001</td>
                    <td>Default</td>
                    <td class="text-black-50">Insert Type</td>
                    <td class="text-black-50">Insert Date</td>
                    <td>Insert MOP</td>
                    <td class="text-black-50">Insert ID</td>

                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>BOM-FG - Emulsifier-2 HP-4 POLE-001</td>
                    <td>Default</td>
                    <td class="text-black-50">Insert Type</td>
                    <td class="text-black-50">Insert Date</td>
                    <td>Insert MOP</td>
                    <td class="text-black-50">Insert ID</td>

                    <td><span class="fas fa-comments"></span>0</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>BOM-PR-EM-BLADE HOUSING-001</td>
                    <td>Active</td>
                    <td class="text-black-50">Insert Type</td>
                    <td class="text-black-50">Insert Date</td>
                    <td>Insert MOP</td>
                    <td class="text-black-50">Insert ID</td>

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