<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadManufacturingWorkstation();'
            class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Workstation Form</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Dropdown link</a>
                        <a class="dropdown-item" href="#">Dropdown link</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" id="saveBtn">Save</button>
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
                    <h6><strong>DESCRIPTION</strong></h6>

                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Workstation Name</label>
                                <input type="text" class="form-control" id="station_name" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Description</label>
                                <textarea class="form-control" rows="10" id="station_desc"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>OPERATING COSTS</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Electricity Cost</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                                <p>per hour</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Rent Cost</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                                <p>per hour</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Consumable Cost</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                                <p>per hour</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Wages</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                                <p>Wages per hour</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>WORKING HOURS</strong></h6>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Enabled</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 1; $i++): ?> <tr>
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

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Holiday List</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                        </div>
                        <div class="form-group col-md-6">
                            &nbsp;
                        </div>
                    </div>
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
    $("#saveBtn").on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData();
        formData.append('station_id', "sample-id1");
        formData.append('station_name', $("#station_name").val());
        formData.append('description', $("#station_desc").val());
        $.ajax({
            type: "POST",
            url: "/create-station",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $("#divMain").load('/workstation');
            }
        });
    });

</script>
