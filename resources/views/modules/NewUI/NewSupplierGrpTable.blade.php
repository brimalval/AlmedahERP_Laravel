<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadSupplierGroup();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">New Supplier Group</h2>
        </h2>
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
                        <li><a class="dropdown-item" href="#">Print</a></li>
                        <li><a class="dropdown-item" href="#">Email</a></li>
                        <li><a class="dropdown-item" href="#">Jump to field</a></li>
                        <li><a class="dropdown-item" href="#">Links</a></li>
                        <li><a class="dropdown-item" href="#">Duplicate</a></li>
                        <li><a class="dropdown-item" href="#">Rename</a></li>
                        <li><a class="dropdown-item" href="#">Reload</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                        <li><a class="dropdown-item" href="#">Customize</a></li>
                        <li><a class="dropdown-item" href="#">New Supplier Group</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="card">
<br>
<div class="container">
    <form id="newsuppliergrptableForm" name="newsuppliergrptableForm" role="form">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="suppliergrpName">Supplier Group Name</label>
                    <input type="text" name="suppliergrpName" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <!---Empty Column-->
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="parentSuppGrp">Parent Supplier Group</label>
                    <input type="text" name="parentSuppGrp" class="form-control">
                </div>
                <input type="checkbox"> Is Group
            </div>

            <div class="col-12">
                <br><hr><br>
            </div>
            <br>
        </div>

        <!---Credit Limit-->
        <a href="#submenuCreditLimit" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> CREDIT LIMIT</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>

        <div id='submenuCreditLimit' class="collapse sidebar-submenu">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="defPayTemp">Default Payment Terms Template</label>
                        <input type="text" id="defPayTemp" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <!----End of Credit Limit-->
        <br>
<div class="container">
    <form id="newsupptableForm" name="newsupptableForm" role="form">
        <div class="row">
            <div class="col-6">
                <label>DEFAULT PAYABLE AMOUNT</label>
            </div>

            <div class="col-6">
                <!---Empty Column-->
            </div>

            <div class="col-6">
                <p>Mention if non-standard receivable account applicable</p>
                <br>
            </div>

            <div class="col-12">
                <table id="newsuppliergrptable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Company</th>
                            <th>Account</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <td colspan="7" rowspan="5">
                            <button type="button" onclick="addNewSuppGrpTableRow();" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                    </td>
            </div>
            <div class="col-12">
                <br>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="addComment">Add a Comment</label>
                    <input type="text" id="addComment" class="form-control" style="height:100px;">
                </div>
            </div>
        </div>
        <br>
    </form>
</div>   
</div>
<script src="{{ asset('js/suppliergroup.js') }}"></script>

<div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editing Row #1</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
            <form id="newsalestaxesForm" name="newsalestaxesForm" role="form">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="account">Account</label>
                    <input type="text" name="account" class="form-control">
                  </div>
                </div>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>