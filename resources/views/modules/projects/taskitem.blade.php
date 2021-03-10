<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadTask();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">New Task</h2>
    </h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        
        <li class="nav-item li-bom">
          <button class="btn btn-primary" type="submit" onclick="loadNewBOM()">Save</button>
        </li>
          <li></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
 <div class="row">
                    <div class="col-6">
					   <div class="form-group">
						<label for="fname">Subject</label>
						<input type="text" name="fname" class="form-control">
					   </div>
                    </div>
                        
                    <div class="col-6">    
                        <div class="input-group">
                        <label class="label">Status</label>
                        <select class="input--style-4" type="text" name="status" style="width:512px;height:38px;">
                            <option>Open</option>
                            <option>Option 1</option>
                            <option>Option 2</option>
                        </select>
                        </div>
                    </div>
                    
                    <div class="col-6">    
					   <div class="form-group">
						<label for="fname">Project</label>
						<input type="text" name="Project" class="form-control">
					   </div>
                    </div>
                        
                    <div class="col-6">
                        <div class="input-group">
                        <label class="label">Priority</label>
                        <select class="input--style-4" type="text" name="status" style="width:512px;height:38px;">
                            <option>Low</option>
                            <option>High</option>
                            
                        </select>
                        </div>
                    </div>
     
                    <div class="col-6">   
                        <div class="form-group">
						<label for="fname">Issue</label>
						<input type="text" name="Issue" class="form-control">
					   </div>
                    </div>
                                       
                    <div class="col-6">   
                        <div class="form-group">
						<label for="fname">Weight</label>
						<input type="text" name="weight" class="form-control">
					   </div>
                    </div>
                        
                    <div class="col-6">   
                        <div class="form-group">
						<label for="fname">Type</label>
						<input type="text" name="type" class="form-control">
					   </div>
                    </div>
                    <div class="col-6">   
                        <div class="form-group">
						<label for="fname">Completed By</label>
						<input type="text" name="type" class="form-control">
					   </div>
                    </div> 
                <div class="col-6">                
                    <div class="row">               
                    <div class="form-check">
                    <input id="include" type="checkbox" class="form-check-input">
                    </div>
                    <label for="">Is Group</label>
                    </div>
                </div>
                    <div class="col-6">   
                        <div class="form-group">
						<label for="fname">Color</label>
						<input type="text" name="color" class="form-control">
					   </div>
                    </div> 
                     <div class="col-6">   

                    </div>
                    <div class="col-6">   
                        <div class="form-group">
						<label for="fname">Parent Task</label>
						<input type="text" name="parenttask" class="form-control">
					   </div>
                    </div> 
</div>
</div>

<div class="accordion" id="accordion">
  <div class="card">
    <div class="card-header" id="heading1">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#timeline" aria-expanded="false">
      TIMELINE
      </button>
      </h2>
    </div>
    <div id="timeline" class="collapse">
      <div class="card-body">
        <?php include 'taskSubModules/timeline.php'?>
                   <div class="col-12"><hr></div>
      </div>
    </div>
     <div class="container">

<div class="col-12">                                     
<div class="row">
</div>

<div class="row">
	<div class="col">
        <div class="row">
        <label for="summernote">DETAILS</label>
       
        </div>

		<label for="summernote">Task Description</label>
		<textarea id="summernote" name="editordata"></textarea>
	</div>
</div>

<script src="js/inventory.js"></script>
    
</div>      
<div class="col-12"><br></div> 
        
</div>
 <div class="col-12"><hr></div>
      
<div class="container">
	<div class="col">
        <div class="row">
        <label for="summernote">DEPENDENCIES</label>
       
        </div>

		<label for="summernote">Dependent Task</label>
	</div>
 <table class="table border-bottom table-hover table-bordered">
  <thead class="border-top border-bottom bg-light">
    <tr class="text-muted">
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input">
        </div>
      </td>
      <td>Task</td>
        <td>Subject</td>
      <td></td>

    </tr>
  </thead>
  <tbody class="">
    <tr>
      <td>
           <div class="form-check">
          <input type="checkbox" class="form-check-input">
        </div>
      </td>
<td>Sample Task</td>
<td>Sample Subject</td>
<td></td>
    </tr>
    <tr>
      <td colspan="6" rowspan="5">
           <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
      </td>
    </tr>
      
  </tbody>
</table> 
</div>   
  </div>
  <div class="card">
    <div class="card-header" id="heading2">
      <h2 class="mb-0">
      <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse" data-target="#moreinfo" aria-expanded="false">
      MORE INFO
      </button>
      </h2>
    </div>
    <div id="moreinfo" class="collapse" aria-labelledby="heading2">
      <div class="card-body">
        <?php include 'taskSubModules/moreinfo.php'?>
      </div>
    </div>
  </div>
  
     
  </div>
