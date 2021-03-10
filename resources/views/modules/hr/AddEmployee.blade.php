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
                        <div class="input-group">
                        <label class="label">Series</label>
                        <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
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
                        <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
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
                        <div class="form-group">
                        <label class="label">Gender</label><br>
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

        
                        
        <!---Emergency Contacts-->
        <a href="#submenuEmergency" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
            <span class="menu-collapsed align-middle smaller menu" > EMERGENCY CONTACTS</span>
            <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>
                <div class="row">
            <div id='submenuEmergency' class="collapse sidebar-submenu">
                <br>
                    <div class="col-12">    
					   <div class="form-group">
						<label for="Ephone">Emergency Phone</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                     <div class="col-12">    
					   <div class="form-group">
						<label for="EContactName">Emergency Contact Name</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                                     <div class="col-12">    
					   <div class="form-group">
						<label for="Relation">Relation</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
            </div>
           <!----End of Emergency Contacts--> 
                </div>
        <!---ERP NEXT USER-->
        <a href="#submenuERPUSER" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > ERP NEXT USER</span>
            <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>
                <div class="row">
            <div id='submenuERPUSER' class="collapse sidebar-submenu">
                <br>
                    <div class="col-12">    
					   <div class="form-group">
						<label for="Ephone">User ID</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-12">    
					   <div class="form-group">
						<label>System User (login) ID. if set, it will become default for all HR forms.</label>
					   </div>
                    </div>
                    <div class="col-12">    
					   <div class="form-group">
						<button>Create User</button>
					   </div>
                    </div>                

            </div>
           <!----End of ERP NEXT USER-->
                </div>        
         <!---Joining Details-->
        <a href="#submenujDetails" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > JOINING DETAILS</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenujDetails' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                     <div class="col-6">    
					   <div class="form-group">
						<label >Job Applicant</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Contract End Date</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>                    
                    <div class="col-6">    
					   <div class="form-group">
						<label>Offer Date</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Notice (Days)</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Confirmation Date</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Date of Retirement</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>                     
                </div>
                
       
            </div>           
        <!----End of Joining Details--> 
          <!---Department and Grade-->
        <a href="#submenuDG" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > DEPARTMENT AND GRADE</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuDG' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                     <div class="col-6">    
					   <div class="form-group">
						<label >Department</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Grade</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>                    
                    <div class="col-6">    
					   <div class="form-group">
						<label>Designation</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Branch</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Reports to</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>                   
                </div>
                
       
            </div>           
        <!----End of Department and Grade-->   
          <!---Attendance and leave Details-->
        <a href="#submenuAttendance" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > ATTENDANCE AND LEAVE DETAILS</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuAttendance' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                     <div class="col-6">    
					   <div class="form-group">
						<label >Leave Policy</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Holiday List</label>
						<input type="text"  class="form-control">
                        <label>Applicable Holiday List</label>
					   </div>
                    </div>                    
                    <div class="col-6">    
					   <div class="form-group">
						<label>Attendance Device ID (Biometric/RF tag ID)</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label>Default Shift</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    

                    </div>  
                    <div class="col-6">    
					   <div class="form-group">
						<label>Leave Approver</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>                     
                </div>
                
       
            </div>           
        <!----End of Attendance and leave Details-->  
                
           <!---Salary Details-->
        <a href="#submenuSalaryD" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > SALARY DETAILS</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuSalaryD' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                    <div class="col-6">
                        <label>Salary Mode</label>
                        <div class="form-group">
                        
                        <select type="text" class="form-control" style="width:300px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                        </div>
                    </div>             
                </div>
                
       
            </div>           
        <!----End of Salary Details-->                  
           <!---Health Insurance-->
        <a href="#submenuhealth" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > HEALTH INSURANCE</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuhealth' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                    <div class="col-6">
                        <label>Health Insurance Provider</label>
                        <input type="text"  class="form-control">
                    </div>             
                </div>
                
       <br>
            </div>           
        <!----End of Health Insurance-->                 

           <!---Contact Details-->
        <a href="#submenuCdetails" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > CONTACT DETAILS</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuCdetails' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                    
                    <div class="col-6">
                        <label>Mobile</label>
                        <input type="text"  class="form-control">
                    </div>  
                    
                    <div class="col-6">
                        <label>Permanent Address Is</label>
                        <div class="form-group">
                        
                        <select type="text" class="form-control" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                        </div>
                    </div> 
                    <div class="col-6">
                        <label>Prefered Contact Email</label>
                        <div class="form-group">
                        
                        <select type="text" class="form-control" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Permanent Address</label>
                        <textarea name="message" class="form-control" ></textarea>
                    </div>
                    
                    <div class="col-6">
                        <label>Company Email</label>
                        <input type="text"  class="form-control">
                        <label>Provide Email Address registered in company</label>
                    </div> 
                    <div class="col-6">
                        <label>Current Address Is</label>
                        <select type="text" class="form-control" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
        
                    </div>
                    <div class="col-6">
                        <label>Personal Email</label>
                        <input type="text"  class="form-control">
                    </div>                     
                </div>
                
        <br>
            </div>
               
        <!----End of Contact Details--> 
            <!---Personal BIO-->
        <a href="#submenuBio" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > PERSONAL BIO</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuBio' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                    <div class="col-12">
                        <label>Bio / Cover Letter</label>
                        <textarea name="content"></textarea>
                        <script src="ckeditor/ckeditor.js"></script>
                        <script>
                        CKEDITOR.replace('content');
                        </script>
                    </div>              
                </div>
                
       <br>
            </div>           
        <!----End of Personal BIO-->                 
             <!---Personal Details-->
        <a href="#submenuPdetails" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > PERSONAL DETAILS</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuPdetails' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                    <div class="col-6">    
					   <div class="form-group">
						<label >Passport Number</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">
                        <label>Marital Status</label>
                        <select type="text" class="form-control" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label >Date of Issue</label>
						<input type="text"  class="form-control">
					   </div>
                    </div> 
                    <div class="col-6">
                        <label>Blood Group</label>
                        <select type="text" class="form-control" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
						<label >Valid Upto</label>
						<input type="text"  class="form-control">
					   </div>
                    </div> 
                    <div class="col-6">
                        <label>Family Background</label>
                        <textarea name="message" class="form-control" ></textarea>
                        <label>Here you can maintain family details like name and occupation of parent, spouse and children</label>
                    </div> 
                     <div class="col-6">    
					   <div class="form-group">
						<label >Place of Issue</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                     <div class="col-6">
                        <label>Health Details</label>
                        <textarea name="message" class="form-control" ></textarea>
                        <label>Here you can maintain height, weight, allergies, medical concerns etc.</label>
                    </div>                    
                </div>
                
       <br>
            </div>           
        <!----End of Personal Details-->                
            <!---Educational Qualification-->
        <a href="#submenuEquali" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > EDUCATIONAL QUALIFICATION</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuEquali' class="collapse sidebar-submenu">
                <br>
                <div class="row">
    <div class="col-12">
        <label>Education</label>
      <table id="itemtable">
        <tr id="itemtr">
          <th><input type="checkbox" name="check2" /></th>
          <th>School / University</th>
          <th>Qualification</th>
          <th>Level</th>
          <th>Year of Passing</th>
          <th></th>
       
        </tr>
        <tr id="itemtr">
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
          <tr>
          <td><button id="button1">Add Row</button></td>
          <td></td>
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
                </div>
                
       <br>
            </div>           
        <!----End of Educational Qualification-->
                
<!---Previous Work Experience-->
        <a href="#submenuWorkExp" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > PREVIOUS WORK EXPERIENCE</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuWorkExp' class="collapse sidebar-submenu">
                <br>
                <div class="row">
    <div class="col-12">
        <label>External Work History</label>
      <table id="itemtable">
        <tr id="itemtr">
          <th><input type="checkbox" name="check2" /></th>
          <th>Company</th>
          <th>Designation</th>
          <th>Salary</th>
          <th>Address</th>
          <th></th>
       
        </tr>
        <tr id="itemtr">
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
          <tr>
          <td><button id="button1">Add Row</button></td>
          <td></td>
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
                </div>
                
       <br>
            </div>           
        <!----End of Previous Work Experience-->   
                
<!---Previous History In Company-->
        <a href="#submenuHistory" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" >HISTORY IN COMPANY</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuHistory' class="collapse sidebar-submenu">
                <br>
                <div class="row">
    <div class="col-12">
        <label>Internal Work History</label>
      <table id="itemtable">
        <tr id="itemtr">
          <th><input type="checkbox" name="check2" /></th>
          <th>Branch</th>
          <th>Department</th>
          <th>Designation</th>
          <th>From Date</th>
          <th>To Date</th>
          <th></th>    
       
        </tr>
        <tr id="itemtr">
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>    
        </tr>
          <tr>
          <td><button id="button1">Add Row</button></td>
          <td></td>
          <td></td>
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
                </div>
                
       <br>
            </div>           
        <!----End of History In Company--> 
                
            <!---EXIT-->
        <a href="#submenuExit" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">
                   
                    <span class="menu-collapsed align-middle smaller menu" > EXIT</span>
                    <i class="fa fa-caret-down" aria-hidden="true" ></i>
        
            </a>

            <div id='submenuExit' class="collapse sidebar-submenu">
                <br>
                <div class="row">
                    <div class="col-6">    
					   <div class="form-group">
						<label >Resignation Letter Date</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>
                    <div class="col-6">    
					   <div class="form-group">
                        <label >Exit Interview Details</label><br>   
						<label >Held On</label>
						<input type="text"  class="form-control">
					   </div>
                    </div> 
                    <div class="col-6">    
					   <div class="form-group">
                        <label >Relieving Date</label>
						<input type="text"  class="form-control">
					   </div>
                    </div> 
                    <div class="col-6">
                        <label>Reson for Resignation</label>
                        <select type="text" class="form-control" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                    </div> 
                    <div class="col-6">    
					   <div class="form-group">
                        <label >Reason for Leaving</label>
						<input type="text"  class="form-control">
					   </div>
                    </div> 
                    <div class="col-6">    
					   <div class="form-group">
                        <label >New Workplace</label>
						<input type="text"  class="form-control">
					   </div>
                    </div> 
                     <div class="col-6">
                        <label>Leave Encashed?</label>
                        <select type="text" class="form-control" style="width:512px;height:38px;">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                    </div> 
                    <div class="col-6">
                        <label>Feedback</label>
                        <textarea name="message" class="form-control" ></textarea>
                    </div>                     
                     <div class="col-6">    
					   <div class="form-group">
                        <label >Encashment Date</label>
						<input type="text"  class="form-control">
					   </div>
                    </div>                    
                </div>
                
       <br>
            </div>           
        <!----End of EXIT-->                 
    </form>

</div>