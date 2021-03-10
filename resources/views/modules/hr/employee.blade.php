<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">Employees</h2>
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
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onClick="loadNewEmployee()">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#newEmployee-Modal" style="background-color: #007bff;">New</button>
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
                        <input type="text" class="form-control" placeholder="Full Name">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Department">
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
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        Clear Filters
                    </button>
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        Status = Active
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
        <div class="conContent">

            <center>
                <p>No Employee found</p>
            </center><br>


            <div id="contact">
                <center><button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#newEmployee-Modal" style="background-color: #007bff;">Add New Employee</button></center>
            </div>
            <div id="newEmployee-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <a class="close" data-dismiss="modal"><i class="fa fa-times"></i></a>

                        </div>
                        <div class="modal-header">

                            <h3>New Employee</h3>

                            <button type="button" class="btn btn-info btn" data-dismiss="modal" style="background-color: #007bff;">Save</button>


                            <!--<input type="submit" class="btn btn-success" id="submit">-->

                        </div>

                        <form id="contactForm" name="contact" role="form" action="AddEmployee.php">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label class="label">Series</label>
                                            <select class="input--style-4" type="text" name="project" style="width:500px;height:38px;">
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="compnay">Company</label>

                                            <input type="text" name="company" class="form-control" value="Almedah Food Equipments">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fname">First Name</label>
                                            <input type="text" name="fname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group">
                                            <label class="label">Status</label>
                                            <select class="input--style-4" type="text" name="project" style="width:500px;height:38px;">
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="mname">Middle Name</label>
                                            <input type="text" name="mname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group">
                                            <label class="label">Gender</label>
                                            <div class="p-t-10">
                                                <label class="radio-container m-r-45">Male
                                                    <input type="radio" checked="checked" name="gender">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="radio-container">Female
                                                    <input type="radio" name="gender">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="lname">Last Name</label>
                                            <input type="text" name="lname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="bday">Birthday</label>
                                            <input type="text" name="bday" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- empty column-->
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="joiningdate">Date of Joining</label>
                                            <input type="text" name="joiningdate" class="form-control">
                                        </div>
                                    </div>

                                    <!--<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea name="message" class="form-control"></textarea>
					</div>	-->
                                </div>
                                <div class="row">
                                    <!-- Menu Item Stock -->
                                    <a href="#submenuEmergency" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

                                        <span class="menu-collapsed align-middle smaller menu"> Emergency Contacts</span>
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>

                                    </a>
                                    <!-- End of Menu Item Stock -->
                                    <!-- Submenu Item Stock -->
                                    <div id='submenuEmergency' class="collapse sidebar-submenu">
                                        <br>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="Ephone">Emergency Phone</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="EContactName">Emergency Contact Name</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Submenu Item Stock -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" style="background-color: #007bff;" class="btn btn-info btn menu" data-parent="hr" data-name="Add Employee" data-dismiss="modal" style="float: left;" value="Edit in Full Page" />

                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

<style>
    .conContent {
        padding: 200px;
    }
</style>