<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit"  >Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
			<form id="contactForm" name="contact" role="form">
                    <div class="row">
                    <div class="col-6">    
					   <div class="form-group">
						<label for="fname">Project Name</label>
						<input type="text" name="projname" class="form-control">
					   </div>
                    </div>
                        
                    <div class="col-6">    
					   <div class="form-group">
						<label for="fname">For Template</label>
						<input type="text" name="fname" class="form-control">
					   </div>
                    </div>
                        
                    <div class="col-6">
                        <div class="input-group">
                        <label class="label">Status</label>
                        <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                        </div>
                    </div>
                    
                    <div class="col-6">    
					   <div class="form-group">
						<label for="fname">Expected Start Date</label>
						<input type="date" name="fname" class="form-control">
					   </div>
                    </div>
                        
                    <div class="col-6">    
					   <div class="form-group">
						<label for="fname">Project Type</label>
						<input type="text" name="fname" class="form-control">
					   </div>
                    </div>
                        
                    <div class="col-6">    
					   <div class="form-group">
						<label for="fname">Expected End Date</label>
						<input type="date" name="fname" class="form-control">
					   </div>
                    </div>
                        
                    <div class="col-6">
                        <div class="input-group">
                        <label class="label">Is Active</label>
                        <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                        </div>
                    </div>
                        
                    <div class="col-6">
                        <div class="input-group">
                        <label class="label">Priority</label>
                        <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                        </div>
                    </div>    
                        
                    <div class="col-6">
                        <div class="input-group">
                        <label class="label">% Complete Method</label>
                        <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                        </div>
                    </div>  
                      
                    <div class="col-6">    
					   <div class="form-group">
						<label for="lname">Department</label>
						<input type="text" name="lname" class="form-control">
					   </div>
                    </div>  			
				    </div>
                        
        <!---Customer Details-->
        <a href="#submenuEmergency" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
            <span class="menu-collapsed align-middle smaller menu" > CUSTOMER DETAILS</span>
            <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>
                
            <div id='submenuEmergency' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                    <div class="col-6">    
					   <div class="form-group">
						<label for="Ephone">Customer</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    
                    <div class="col-6">    
					   <div class="form-group">
						<label for="Ephone">Sales Order</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
            </div> 
                </div>
        <!----End of Customer Details-->
        <!---Users-->
        <a href="#submenuERPUSER" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">           
            <span class="menu-collapsed align-middle smaller menu" > USERS</span>
            <i class="fa fa-caret-down" aria-hidden="true" ></i>
        </a> 
            <div id='submenuERPUSER' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                        <div class="col-6">    
					       <div class="form-group">
						      <p>Project will be accessible on the website to these users</p>
					       </div>
                        </div>
                    
                        <div class="col-12">
                            <label>Users</label>
                            <table id="itemtable">
                                <tr id="itemtr">
                                    <th><input type="checkbox" name="check2" /></th>
                                    <th>User</th>
                                    <th>Full Name</th>
                                    <th>View Attachments</th>
                                    <th></th>
                                </tr>
                                <tr id="itemtr">
                                    <td></td>
                                    <td></td>
                                    <td>No Data</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><button id="button1">Add Row</button></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
        
 <style>
     #button1{
         background-color: #e7e7e7; color: black;
     }
        /* Component's Table */
        table {
          border-collapse: collapse;
          width: 100%;
        }
        #itemtable,
        #itemtr {
          border: 1px solid gray;
        }
        th,
        td {
          text-align: left;
          padding: 8px;
          font-size: 12px;  
        }
      </style>
                       </div>
                       <br>       
              </div>
                </div>
        <!----End of Users-->
        <!---Note-->
        <a href="#submenujDetails" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > NOTES</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenujDetails' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                    <div class="col">
                        <label for="summernote">Notes</label>
                        <textarea id="summernote" name="editordata"></textarea>
                    </div>
                </div>
                <script src="js/inventory.js"></script>
            </div>           
        <!----End of Notes--> 
          <!---Costing and Billing-->
        <a href="#submenuDG" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > COSTING AND BILLING</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuDG' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                     <div class="col-6">    
					   <div class="form-group">
						<label>Estimated Cost</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Default Cost Center</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>                    
                    <div class="col-6">    
					   <div class="form-group">
						<label>Company</label>
						<input type="text"  class="form-control" value="Almedah Food Equipments">
					   </div>
                    </div>                  
                </div>
            </div>           
        <!----End of Costing and Billing-->   
          <!---Monitor Progress-->
        <a href="#submenuAttendance" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > MONITOR PROGRESS</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuAttendance' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                     <div class="col-6">
                        <div class="form-check">
                            <input id="include" type="checkbox" class="form-check-input">
                            <label for="">Collect Progress</label>
                        </div>
                    </div>
                </div>
            </div>
        <!----End of Monitor Progress-->          
    </form>
</div>