<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Item Variant Settings</h2>
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
                        <li><a class="dropdown-item" href="#">Email</a></li>
                        <li><a class="dropdown-item" href="#">Jump to field</a></li>
                        <li><a class="dropdown-item" href="#">Reload</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit" onclick="loadNewBOM()">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <input type="checkbox" name="" id="updatevar"> <label for="updatevar">Do not update variants on save</label>
    <p class="text-muted">Fields will be copied over only at time of creation</p>
    <input type="checkbox" name="" id="allowrename"> <label for="allowrename">Allow Rename Attribute Value </label>
    <p class="text-muted">Rename Attribute Value in Item Attribute</p>
    <hr>
    <table class="table table-bom border-bottom">
        <p class="text-muted">COPY FIELDS TO VARIANT</p>
        <p class="text-muted">Fields</p>
        <thead class="border-top border-bottom bg-light">
            <tr class="text-muted">
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                    </div>
                </td>
                <td>Field Name</td>
                <td></td>
            </tr>
        </thead>
        <tbody class="">
            <tr>
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"> <span>1</span>
                    </div>
                </td>
                <td>item_group</td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"> <span>2</span>
                    </div>
                </td>
                <td>is_item_from_hub</td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"> <span>3</span>
                    </div>
                </td>
                <td>stock_uom</td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                </td>
            </tr>
            <tr>
                <td colspan="3"><button type="submit" class="btn btn-light btn-sm">Add Row</button></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editing row #</h5>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-danger"><span class="far fa-trash-alt"></span></button>
                    <button type="button" class="btn btn-secondary btn-sm">Insert Below</button>
                    <button type="button" class="btn btn-secondary btn-sm">Insert Above</button>
                    <button type="button" class="btn btn-secondary btn-sm">Duplicate</button>
                    <button type="button" class="btn btn-secondary btn-sm">Move</button>
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><span class="fas fa-times"></span></button>
                </div>
            </div>
            <div class="modal-body">
                <p class="text-muted">Field Name</p>
                <select class="form-control" name="" id="">
                    <!-- note: the default selected must be where the button is selected example row 1 edit button is clicked item_group field name is default selected -->
                    <option value="" selected>item_group</option>
                    <option value="">is_item_from_hub</option>
                    <option value="">stock_uom</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Insert Below</button>
            </div>
        </div>
    </div>
</div>