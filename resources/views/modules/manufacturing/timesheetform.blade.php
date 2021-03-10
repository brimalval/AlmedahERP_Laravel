<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadProjectsTimesheet();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Timesheet Form</h2>
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
                        <button class="btn btn-primary btn-sm">Start Timer</button>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Series</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Status</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="" readonly="" value="DRAFT"></select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Company</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>

                    </form>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>EMPLOYEE DETAIL</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Employee</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Time Sheets</label>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center" style="width: 0%;">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th scope="col">Activity Type</th>
                                            <th scope="col">From Time</th>
                                            <th scope="col">Hrs</th>
                                            <th scope="col">Project</th>
                                            <th scope="col" class="text-center">Bill</th>
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
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                                    </div>
                                                </td>
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
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Total Working Hours</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <hr>
                        <h6><strong>BILLING DETAILS</strong></h6>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Total Billable Hours</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Total Billable Amount</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Total Costing Amount</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Note</label>
                                <textarea id="notes" class="summernote" name="notes"></textarea>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200
        });
    });
</script>