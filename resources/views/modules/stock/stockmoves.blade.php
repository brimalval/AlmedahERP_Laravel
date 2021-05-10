
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Stock Moves</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary menu" type="submit" onclick="" data-parent="stock" data-name="New Stock Moves">New</button>
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
                        <input type="text" class="form-control" placeholder="Tracking ID">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body filter">
            <div class="row">
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
                    <td>Tracking ID</td>
                    <td>Stock Moves Type</td>
                    <td>Status</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                    <td>Tracking ID ex</td>
                    <td>Stock Moves Type ex(Transfer / Return)</td>
                    <td>(Successfully Transfered then return items becomes available/Pending/approved)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-primary menu" type="submit" onclick="" data-parent="stock" data-name="Stock Moves Return">Return Items</button></td>
                    <td><button class="btn btn-danger"  type="submit" onclick="">Remove</button></td>
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
