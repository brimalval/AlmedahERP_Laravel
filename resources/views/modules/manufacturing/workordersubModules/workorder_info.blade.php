<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
	<div class="container-fluid">
		<h2 class="navbar-brand tab-list-title">
			<a href='javascript:onclick=loadWorkOrder();' class="fas fa-arrow-left back-button"><span></span></a>
			{{-- dynamically changed through JS --}}
			<h2 class="navbar-brand" id="componentName" style="font-size: 35px;"></h2>

		</h2>
		{{-- dynamically changed through JS --}}
		<span id="componentStatus"></span>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown li-bom mr-2">
				<li class="nav-item dropdown li-bom mr-2 d-flex align-items-center">
					{{-- dynamically changed through JS --}}
					<p id="componentPurchaseId" class="text-muted align-items-center"></p>

				</li>
				<li class="nav-item dropdown li-bom mr-2 d-flex align-items-center">
					<a href="#" class="text-muted">
						<i class="fas fa-print"></i>
					</a>
				</li>
				<li class="nav-item dropdown li-bom mr-2 d-flex align-items-center">
					<a href="#" class="text-muted">
						<i class="fas fa-arrow-left"></i>
					</a>
				</li>
				<li class="nav-item dropdown li-bom mr-2 d-flex align-items-center">
					<a href="#" class="text-muted">
						<i class="fas fa-arrow-right"></i>
					</a>
				</li>
				<li class="nav-item dropdown li-bom">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Menu
					</a>
					<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<li>
							<a class="dropdown-item p-3 d-flex" href="#">
								Print
								<span class="text-muted ml-auto">Ctrl + P</span>
							</a>
						</li>
						<li><a class="dropdown-item p-3" href="#">Email</a></li>
						<li><a class="dropdown-item p-3" href="#">Jump To Field</a></li>
						<li><a class="dropdown-item p-3" href="#">Links</a></li>
						<li><a class="dropdown-item p-3" href="#">Duplicate</a></li>
						<li><a class="dropdown-item p-3" href="#">Reload</a></li>
						<li><a class="dropdown-item p-3" href="#">Customize</a></li>
						<li>
							<a class="dropdown-item p-3 d-flex s-2" href="#">
								New Work Order
								<span class="text-muted ml-3">
									Ctrl + B
								</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item li-bom">
					<button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadWorkOrder();">Cancel
					</button>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div class="accordion" id="accordion">
	<div class="card" style="overflow: visible;">
		<div id="main-header" class="collapse show">
			<div class="card-body d-flex justify-content-end">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Status
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Not Started</a>
						<a class="dropdown-item" href="#">Started</a>
					</div>
				</div>
				<button class="btn btn-secondary btn-sm ml-2" type="button">
					Cancel
				</button>
				<button id="startWorkOrder" class="btn btn-primary btn-sm ml-2">
					Start
				</button>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header" id="heading1">
			<h2 class="mb-0">
				<button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#work-dashboard" aria-expanded="true">
					DASHBOARD
				</button>
			</h2>
		</div>
		<div id="work-dashboard" class="collapse show">
			<div class="card-body">
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width:1%">
						<span class="sr-only"></span>
					</div>
				</div>
				<p class="text-muted">0 Items Produced</p>
				<br>
				{{-- <div class="group-link">
					<a class="link" href="#">Pick List<span class="badge text-muted"> </span><span class="badge bg-danger badge-pill text-light"></span><i class="fas fa-plus ml-1 mt-2"> </i></a><br>
					<a class="link" href="#">Stock Entry<span class="badge text-muted"> </span><span class="badge bg-danger badge-pill text-light"></span><i class="fas fa-plus ml-1 mt-2"> </i></a><br>
					<a class="link" href="#">Job Card<span class="badge text-muted"> </span><span class="badge bg-danger badge-pill text-light"></span><i class="fas fa-plus ml-1 mt-2"> </i></a><br>
				</div> --}}
			</div>
		</div>
	</div>
	{{-- <div id="work-dashboard" class="card collapse show p-3">
		<div class="row" style="padding: 1%;">
			<div class="col-6">
				<label for="" class="text-muted">Status</label>
				<input type="text" class="form-control" disabled="true">
				<label for="" class="text-muted">Item to Manufacture</label>
				<input type="text" class="form-control" disabled="true">
				<label for="" class="text-muted">Item Name</label>
				<input type="text" class="form-control" disabled="true">
				<label for="" class="text-muted">BOM No</label>
				<input type="text" class="form-control" disabled="true">
			</div>
			<div class="col-6">
				<label for="" class="text-muted">Company</label>
				<input type="text" class="form-control" disabled="true">
				<label for="" class="text-muted">Qty To Manufacture</label>
				<input type="text" class="form-control" disabled="true">
				<label for="" class="text-muted">Material transffered for Manufacturing</label>
				<input type="text" class="form-control" disabled="true">
				<label for="" class="text-muted">Manufactured Qty</label>
				<input type="text" class="form-control" disabled="true">
				<label for="" class="text-muted">Sales Order</label>
				<input type="text" class="form-control">
			</div>
		</div>
	</div>
	<div id="work-dashboard" class="card collapse show p-3">
		<h5 class="text-muted">SETTINGS</h5>
		<div class="row m-1">
			<div class="col-6">
				<div class="row">
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="">
					</div>
					<label for="" class="form-check-label">Allow alternative Item</label>
				</div>
				<div class="row">
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="">
					</div>
					<label for="" class="form-check-label">Use Multi-level BOM</label>

				</div>
				<p class="text-muted">Plan Material for sub-assemblies</p>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="">
					</div>
					<label for="" class="form-check-label">Skip Material Transfer to WIP Warehouse</label>
				</div>
				<p class="text-muted">
					Check if material transfer entry is not required
				</p>
				<div class="row">
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="">
					</div>
					<label for="" class="form-check-label">Update Consumed Material Cost In Project</label>
				</div>
			</div>
		</div>
	</div>
	<div id="work-dashboard" class="card collapse show p-3">
		<h5 class="text-muted">WORKHOUSES</h5>
		<div class="row m-1">
			<div class="col-6">
				<label for="" class="text-muted">Work-in-Progress Warehouse</label>
				<input type="text" class="form-control" disabled="true">
				<label for="" class="text-muted">Target Warehouse</label>
				<input type="text" class="form-control" disabled="true">
			</div>
		</div>
	</div> --}}
	<div id="work-dashboard" class="card collapse show p-3">
		<h5 class="text-muted">REQUIRED ITEMS</h5>
		<br>
		<div class="row">
			<div class="col-12">
				<table class="table border-bottom table-hover table-bordered">
					<thead class="border-top border-bottom bg-light">
						<tr class="text-muted">
							<td>
								<div class="row m-1">
									<div class="d-flex justify-content-start">
										<div class="form-check">
											<input type="checkbox" class="form-check-input">
										</div>
										<label for="" class="ml-5"></label>
									</div>
								</div>
							</td>
							<td>Item Code</td>
							<td>Source Warehouse</td>
							<td>Required Qty</td>
							<td>Transferred Qty</td>
							<td style="padding: 1%;" class="h-100">
								<div class="input-group mb-3">
									<select class="custom-select border-0" id="inputGroupSelect02">
										<option selected> </option>
										<option value="1"> </option>
										<option value="2"> </option>
										<option value="3"> </option>
									</select>
								</div>
							</td>
						</tr>
					</thead>
					{{-- dynamically changed through JS --}}
					<tbody class="" id="requiredItems">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div id="work-dashboard" class="card collapse show p-3">
		<div class="row">
			<div class="col-6">
				<label for="" class="text-muted">For Product?</label>
				<input type="text" class="form-control" disabled="true" id="forProduct">
			</div>
			<div class="col-6">
				<label for="" class="text-muted">Quantity Purchased</label>
				<input type="text" class="form-control" disabled="true" id="quantityPurchased">
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<label for="" class="text-muted">BOM number</label>
				<input type="text" class="form-control" disabled="true" id="bomNumber">
			</div>
		</div>
	</div>
	<div id="work-dashboard" class="card collapse show p-3">
		<h5 class="text-muted">TIME</h5>
		<div class="row">
			<div class="col-6">
				<label for="" class="text-muted">Planned Start Date</label>
				<input type="date" class="form-control" id="plannedStartDate">
			</div>
			<div class="col-6">
				<label for="" class="text-muted">Actual Start Date</label>
				<input type="text" class="form-control" disabled="true" id="actualStartDate">
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<label for="" class="text-muted">Planned End Date</label>
				<input type="date" class="form-control" id="plannedEndDate">
			</div>
			<div class="col-6">
				<label for="" class="text-muted">Actual End Date</label>
				<input type="text" class="form-control" disabled="true">
			</div>
		</div>
	</div>
	<!-- 		<div class="card">
			<div class="card-header" id="heading2">
				<h2 class="mb-0">
				<button class="btn btn-link d-flex w-100" type="button" data-toggle="collapse" data-target="#dashboard" aria-expanded="true">
				MORE INFORMATION
				</button>
				</h2>
			</div>
			<div id="dashboard" class="collapse show">
				
			</div>
		</div> -->
</div>
<br>
<div class="card">
	<div class="card-header">
		<div class="row">
			<h5 class="mt-2 col-10 text-muted h-100">
				Add Comment
			</h5>
			<div class="mb-0 col-2">
				<button class="btn btn-secondary btn-sm">Add Comment</button>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-12 form-group">
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="6" style="border:0;"></textarea>
		</div>
	</div>
</div>
<div class="row d-flex justify-content-left">
	<div class="col-md-12">
		<div id="content">
			<ul class="timeline">
				<li class="event">
					<p>New Email</p>
				</li>
				<li class="event">
					<p><span style="color: green;">+5</span> gained by You Via On Rule Item Creation - 9 months ago</p>
				</li>
				<li class="event">
					<p>New Email</p>
				</li>
				<li class="event">
					<p><span style="color: green;">+5</span> gained by You Via On Rule Item Creation - 9 months ago</p>
				</li>
				<li class="event">
					<p>You Created - 9 Months ago</p>
				</li>
			</ul>
		</div>
	</div>
</div>

<script>
	function startWorkOrder(workOrderId){
		$.ajax({
            url: "/startWorkOrder/"+workOrderId,
            type: "get",
            success: function (data) {
				$("#actualStartDate").attr('value', data['real_start_date']);
            },
            error: function (request, error) {},
        });
	}

	function onDateChange(workOrderId, plannedDate, date){
		$.ajax({
            url: "/onDateChange/"+workOrderId+"/"+plannedDate+"/"+date,
            type: "get",
            success: function (data) {
                console.log(data);
            },
            error: function (request, error) {},
        });
	}
	// $('#startWorkOrder').on('click', function(){
	// 	$.ajax({
    //         url: "/startWorkOrder",
    //         type: "get",
    //         success: function (data) {
    //             console.log(data);
    //         },
    //         error: function (request, error) {},
    //     });
	// });
</script>