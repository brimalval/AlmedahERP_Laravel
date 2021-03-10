<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>

<div class="container">
    <form id="addJobForm" name="addJobForm" role="form">
        <div class="row">
            <div class="col-10">
                <!--Empty Column-->
            </div>

            <div class="col-2">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" style="background-color: #DEDEDE; color: black;">Start Job</button>
                </div>
            </div>

            <div class="col-12">
                <hr>
            </div>

            <br>

            <div class="col-6">
                <div class="form-group">
                    <label for="workOrder">Work Order</label>
                    <input type="text" name="workOrder" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="postDate">Posting Date</label>
                    <input type="date" name="postDate" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="workstation">Workstation</label>
                    <input type="text" name="workstation" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" name="company" class="form-control" value="Almedah Food Equipments">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="operation">Operation</label>
                    <input type="text" name="operation" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="forQty">For Quantity</label>
                    <input type="text" name="forQty" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <!--Empty Column-->
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="wipWh">WIP Warehouse</label>
                    <input type="text" name="wipWh" class="form-control">
                </div>
            </div>

            <div class="col-12">
                <hr>
            </div>
            <br>
            <div class="col-12">
                <p>Timing Detail</p><br>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="employee">Employee</label>
                    <input type="text" name="employee" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <!--Empty Column-->
            </div>

            <table class="table border-bottom table-hover table-bordered">
                <thead class="border-top border-bottom bg-light">
                    <tr class="text-muted">
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>From Time</td>
                        <td>To Time</td>
                        <td>Time in Mins</td>
                        <td>Completed Qty</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody class="">
                    <tr>
                        <td colspan="7" style="text-align: center;">NO DATA</td>
                    </tr>
                    <tr>
                        <td colspan="7" rowspan="5">
                            <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!---More Information-->
        <a href="#submenuMoreInformation" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> MORE INFORMATION</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>
        <br>
        <div id='submenuMoreInformation' class="collapse sidebar-submenu">
            <div class="row">
                <br>
                <div class="col-6">
                    <div class="form-group">
                        <label for="transQty">Transferred Qty</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="ReqQty">Requested Qty</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-6">
                    <!--Empty Column-->
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="proj">Project</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-6">
                    <!--Empty Column-->
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <input type="text" class="form-control" style="width:540px;height:200px;">
                    </div>
                </div>
            </div>
            <!----End of Emergency Contacts-->
        </div>
    </form>

</div>