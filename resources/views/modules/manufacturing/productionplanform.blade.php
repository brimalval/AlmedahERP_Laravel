<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadManufacturingProductionPlan();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Production Plan Form</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Dropdown link</a>
                        <a class="dropdown-item" href="#">Dropdown link</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" href="#">Save</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row mt-2 mb-3">
        <div class="col">
            <div class="card">
                <!-- <div class="card-header">
                    <div class="float-right">
                        <button class="btn btn-secondary btn-sm" onclick="loadReportsBuilderShowReport();">Show Report</button>
                        <button class="btn btn-secondary btn-sm">Disable Report</button>
                    </div>
                </div> -->
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Naming Series</label>
                                <select class="form-control">
                                    <option value="RB">Report Builder</option>
                                    <option value="QR">Query Report</option>
                                    <option value="SR">Script Report</option>
                                    <option value="CS">Custom Report</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Posting Date</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Company</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Get Items From</label>
                                <select class="form-control">
                                    <option value="1">Dropdown Link 1</option>
                                    <option value="2">Dropdown Link 2</option>
                                    <option value="3">Dropdown Link 3</option>
                                    <option value="4">Dropdown Link 4</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr>
                    <h6 class="mt-5"><strong>SELECT ITEMS TO MANUFACTURE</strong></h6>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">Include Exploded It...</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">BOM No</th>
                                <th scope="col">Planned Qty</th>
                                <th scope="col">For Warehouse</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 1; $i++) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7 p-5">
                                    <button class="btn btn-secondary btn-sm">Add Row</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-body">
                    <hr>
                    <h6 class="mt-5"><strong>MATERIAL REQUEST PLANNING</strong></h6>
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Include Non Stock Items
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck2">
                                    <label class="form-check-label" for="gridCheck2">
                                        Include Subcontracted Items
                                    </label>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck3">
                                    <label class="form-check-label" for="gridCheck3">
                                        Ignore Existing Project Quantity
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail4">For Warehouse</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-secondary btn-sm">Download Materials Required</button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-secondary btn-sm">Get Raw Materials For Production</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr>
                    <h6 class="mt-5"><strong>MATERIALS REQUEST PLAN ITEM</strong></h6>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Warehouse</th>
                                <th scope="col">Required Qty</th>
                                <th scope="col">Projectg Qty</th>
                                <th scope="col">Actual Qty</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 1; $i++) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7 p-5">
                                    <button class="btn btn-secondary btn-sm">Add Row</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-body">
                    <hr class="mt-5">
                    <div class="jumbotron">
                        <h3 class="display-5"><strong>Projected Quantity Formula</strong></h3>
                        <p class="lead"><strong>(Actual Qty + Planned Qty + Requested Qty + Ordered Qty) - (Reserved Qty + Reserved For Production + Reserved For Subcontract)</strong></p>

                        <ul>
                            <li>Actual Qty: Quantity available in the warehouse.</li>
                            <li>Planned Qty: Quantity, for which, Work Order has been raised, but is pending to be manufactured.</li>
                            <li>Requested Qty: Quantity requested for purchase, but not ordered.</li>
                            <li>Ordered Qty: Quantity ordered for purchase, but not received.</li>
                            <li>Reserved Qty: Quantity ordered for sale, but not delivered.</li>
                            <li>Reserved Qty For Production: Raw materials quantity to make manufacturing items.</li>
                            <li>Reserved Qty For Subcontract: Raw materials quantity to make subcontracted items.</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <hr class="mt-5">
                    <h6 class="mt-5"><strong>OTHER DETAILS</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail4">Total Planned Qty</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">Total Produced Qty</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail4">Status</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <!-- <div class="btn-group" role="group">
                        <button type="button" class="btn btn-dark" href="#">20</button>
                        <button type="button" class="btn btn-secondary" href="#">100</button>
                        <button type="button" class="btn btn-secondary" href="#">500</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>