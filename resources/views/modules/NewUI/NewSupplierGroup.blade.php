
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadSupplierGroup();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">New Supplier Group</h2>
        </h2>
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
<div class="card">
<br>
<div class="container">
    <form id="newsuppliergroupForm" name="newsuppliergroupForm" role="form">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="suppliergrpName">Supplier Group Name</label>
                    <input type="text" name="suppliergrpName" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <!---Empty Column-->
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="parentSuppGrp">Supplier Name</label>
                    <input type="text" name="parentSuppGrp" class="form-control">
                </div>
            </div>

            <div class="col-12">
                <br><hr><br>
            </div>
            <br>
        </div>

        <!---Credit Limit-->
        <label>Select Raw Mats</label>
					<!-- <div class="table table-striped table-bordered hover"> -->
						<table class="table table-bordered hover">
						  <thead class="thead-light">
							<tr>
							  <th scope="col"><input type="checkbox" name=""></th>
							  <th scope="col" class="w-30">Item Code</th>
							  <th scope="col">Item Name</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <th scope="row"><input type="checkbox"> 1</th>
							  <td><a href="#" style="color: black"></a></td>
							  <td></td>
							</tr>
						  </tbody>
						</table>
						<div class="float-left">
							<button class="btn btn-secondary btn-sm">Add Row</button>
						</div>
					<!-- </div>	 -->
        <!----End of Credit Limit-->
        <br>
    </form>
</div>
</div>
<script src="{{ asset('js/suppliergroup.js') }}"></script>