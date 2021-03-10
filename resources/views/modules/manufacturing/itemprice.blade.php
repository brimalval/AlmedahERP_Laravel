<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand" style="font-size: 35px;">Item Price</h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Show Totals</a>
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">Toggle Chart</a>
                        <a class="dropdown-item" href="#">Toggle Sidebar</a>
                        <a class="dropdown-item" href="#">Pick Columns</a>
                        <a class="dropdown-item" href="#">Export</a>
                        <a class="dropdown-item" href="#">Setup Auto Email</a>
                        <a class="dropdown-item" href="#">Save</a>
                        <a class="dropdown-item" href="#">Save As</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" href="#">Refresh</button>
                <!-- <button type="button" class="btn btn-info ml-1" href="#" onclick="openManufacturingItemAttributeForm()">New</button> -->
                <button type="button" class="btn btn-info ml-1" href="#" data-toggle="modal" data-target="#itemPriceFormModal">New</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row mt-2 mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <form>
                        <div class="form-row">
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body filter align-middle">
                    <div class="float-left d-flex justify-content-start">
                        <button class="btn btn-secondary btn-sm ml-1">Add Filter</button>
                    </div>

                    <div class="float-right">
                        <span class="text-muted">Last Modified</span>
                        <button class="btn btn-secondary btn-sm">
                            <span class="fa fa-arrow-down fa-fw"></span>
                        </button>
                    </div>
                    <div class="float-right d-flex justify-content-start mr-2">
                        <button class="btn btn-secondary btn-sm ml-1">Add Group</button>
                    </div>
                </div>
                <div class="card-body table-display">
                    <table class="table table-hover h-100">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <span class="fa fa-heart fa-fw"></span>
                                </th>
                                <th scope="col">ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Price List</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Reference</th>
                                <th scope="col">Currency</th>
                            </tr>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col"><input type="text" class="form-control"></th>
                                <th scope="col"><input type="text" class="form-control"></th>
                                <th scope="col"><input type="text" class="form-control"></th>
                                <th scope="col"><input type="text" class="form-control"></th>
                                <th scope="col"><input type="text" class="form-control"></th>
                                <th scope="col"><input type="text" class="form-control"></th>
                                <th scope="col"><input type="text" class="form-control"></th>
                                <th scope="col"><input type="text" class="form-control"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <?php for ($i = 1; $i <= 10; $i++) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="fa fa-heart fa-fw" style="vertical-align: middle;">
                                    </td>
                                    <td>
                                        <span><?= 'Name ' . $i ?></span>
                                    </td>
                                    <td>
                                        <span><?= 'Attribute ' . $i ?></span>
                                    </td>
                                    <td class="text-center" style="width: 40%;">
                                        <span><?= 'Description ' . $i ?></span>
                                    </td>
                                    <td class="text-right" style="width: 5%;">
                                        <span><?= "$i M" ?></span>
                                    </td>
                                    <td class="text-center" style="width: 0%;">
                                        <span class="fa fa-square-o fa-2x"></span>
                                    </td>
                                    <td class="text-center" style="width: 5%;">
                                        <span>
                                            <span class="fa fa-comments fa-fw"></span>
                                            <span>0</span>
                                        </span>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endfor; ?> -->
                            <tr>
                                <td colspan="10">
                                    <div class="text-center" style="padding-top: 100px; padding-bottom: 100px;">
                                        <h4>No Item Price Found</h4><br>
                                        <button class="btn btn-primary" onclick="openManufacturingItemPriceForm()">Create a new Item Price</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-dark" href="#">20</button>
                        <button type="button" class="btn btn-secondary" href="#">100</button>
                        <button type="button" class="btn btn-secondary" href="#">500</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="itemPriceFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Item Price</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary btn-sm mr-1" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Save</button>
                </div>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Item Code</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Price List</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Rate</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="openManufacturingItemPriceForm()">Edit in full page</button>
            </div>
        </div>
    </div>
</div>