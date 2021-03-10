<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadPriceList();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">New Price List</h2>
    </h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        
        <li class="nav-item li-bom">
          <button class="btn btn-primary" type="submit">Save</button>
          <button class="btn btn-primary" type="submit">Add/Edit Prices</button>
        </li>
          
          <li></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
 <div class="row">
        <div class="col-12"><br></div>
                <div class="col-6">                
                    <div class="row">               
                    <div class="form-check">
                    <input id="include" type="checkbox" class="form-check-input">
                    </div>
                    <label for="">Enabled</label>
                    </div>
                </div>
        <div class="col-12"><br></div>
        <div class="col-12"><hr></div>
        <div class="col-12"><br></div>
                    <div class="col-6">    
					   <div class="form-group">
						<label for="fname">Price List Name</label>
						<input type="text" name="priceList" class="form-control">
					   </div>
                    </div>
                    
                    <div class="col-6">    
					   <div class="form-group">
						<label for="fname">Currency</label>
						<input type="text" name="currency" class="form-control">
					   </div>
                    </div>
                <div class="col-6">                
                    <div class="row">               
                    <div class="form-check">
                    <input id="include" type="checkbox" class="form-check-input">
                    </div>
                    <label for="">Buying</label>
                    </div>
                    <div class="row">               
                    <div class="form-check">
                    <input id="include" type="checkbox" class="form-check-input">
                    </div>
                    <label for="">Selling</label>
                    </div>
                    <div class="row">               
                    <div class="form-check">
                    <input id="include" type="checkbox" class="form-check-input">
                    </div>
                    <label for="">Price Not UOM Dependent</label>
                    </div>
                </div>  
<div class="col-6">
 <table class="table border-bottom table-hover table-bordered">
  <thead class="border-top border-bottom bg-light">
       <label for="">Applicable for Countries</label>
    <tr class="text-muted">
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input">
        </div>
      </td>
      <td colspan="3">Country</td>   
      <td></td>
    </tr>
  </thead>
  <tbody class="">
    <tr>
<td colspan="5"><center>No Data</center></td>
    </tr>
    <tr>
      <td colspan="6" rowspan="5">
           <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
      </td>
      </tr> 
  </tbody>
</table> 
</div> 
<div class="col-12"><hr></div>
</div>
</div>
