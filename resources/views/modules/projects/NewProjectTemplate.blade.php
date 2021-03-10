<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadProjectTemplate();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">New Project Template</h2>
    </h2>
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse"  id="responsive">
      <ul class="navbar-nav ml-auto">
      <input type="submit" class="btn btn-primary dropdown-toggle" style="outline: none; border: none;" value="Save">
                    
               </input>  
        
        
      </ul>
    </div>
  </div>
</nav>
<br>
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="ProjectTemplate">
          
        </button>
      </h5>
    </div>
    <div id="projectTemplate" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <?php include 'newProjectTemplate/NPT.php' ?> 
      </div>
    </div>
    </div>
   

</div>
</div>
