<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadReportsBuilder();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Reports Form</h2>
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
                <div class="card-header">
                    <div class="float-right">
                        <button class="btn btn-secondary btn-sm" onclick="loadReportsBuilderShowReport();">Show Report</button>
                        <button class="btn btn-secondary btn-sm">Disable Report</button>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Report Name</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Report Type</label>
                                <select class="form-control">
                                    <option value="RB">Report Builder</option>
                                    <option value="QR">Query Report</option>
                                    <option value="SR">Script Report</option>
                                    <option value="CS">Custom Report</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Ref DocType</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Letter Head</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Reference Report</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Add Total Row
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck2">
                                    <label class="form-check-label" for="gridCheck2">
                                        Disabled
                                    </label>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck3">
                                    <label class="form-check-label" for="gridCheck3">
                                        Disable Prepared Report
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">IS Standard</label>
                                <select class="form-control">
                                    <option value="NO">No</option>
                                    <option value="YES">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Module</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr>
                    <h4 class="mt-5"><strong>Roles</strong></h4>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col" style="width: 100%;">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($arr_roles = ['Administrator', 'User', 'Guest'], $i = 0; $i < count($arr_roles); $i++) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><?= $arr_roles[$i] ?></td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <button class="btn btn-secondary btn-sm">Add Row</button>
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