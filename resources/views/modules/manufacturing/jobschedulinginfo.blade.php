<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
	<div class="container-fluid">
		<h2 class="navbar-brand tab-list-title">
			<h2 class="navbar-brand" style="font-size: 35px;">Emulsifier Component</h2>
			{{-- JS_STATUS --}}
			<h4>Draft</h4>
		</h2>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item li-bom">
					<button class="btn" style="background-color: #d9dbdb;" onclick="loadJobschedhome();">Cancel</button>
				</li>
				<li class="nav-item li-bom">
					<button class="btn btn-primary" type="submit">Save</button>
				</li>
			</ul>
		</div>
	</div>
</nav>

{{-- TEMPORARILY DISABLED FORM SUBMISSION --}}
<form id="contactForm" name="contact" role="form" action="#" onsubmit="return false;">
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-9">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="fname">Tracking ID</label>
								<input type="text" name="JobSc" class="form-control" value="jobsched001">
							</div>

						</div>

						<div class="col-6">
							<!--empty-->
						</div>
						<div class="col-12">
							<hr><br>
						</div>
						<div class="col-4">
							<label for="workOrderJobSched">Work Order</label>
							<div class="input-group">
								<select name="work_order_no" id="js-work-order-select" class="selectpicker" data-route=""{{ route('jobscheduling.getoperations', ['work_order'=>1]) }}>
									<option value="none" selected disabled>
										Select a work order
									</option>
									@foreach ($work_orders as $work_order)
										<option value="{{ $work_order->work_order_no }}" data-subtext="Sales: {{ $work_order->sales_id }} For: {{ $work_order->product_code ?? $work_order->component_code }}">
											{{ $work_order->work_order_no }}
										</option>	
									@endforeach
								</select>
								{{-- <div class="input-group-btn">
									<button class="btn btn-primary"><i class="fa fa-search"></i></button>
								</div> --}}
							</div>

							{{-- <div class="input-group">
								<input type="text" class="form-control" placeholder="Search" name="search">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i
											class="glyphicon glyphicon-search"></i></button>
								</div>
							</div> --}}
						</div>
						<div class="col-3 offset-2">
							<div class="form-group">
								<label for="jobStartDate">Start Date</label>
								<input type="text" name="jobStartDate" class="form-control" value="04/04/21">
							</div>
						</div>


						<div class="col-4">
							<label for="productCode">Product/Component</label>
							<div class="input-group">
								<input type="text" name="productCode" class="form-control" value="product001">
								<div class="input-group-btn">
									<button class="btn btn-primary"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<label for="productQuantity">Quantity</label>
								<input type="text" name="productQuantity" class="form-control" value="3">
							</div>
						</div>

						<div class="col-3">
							<div class="form-group">
								<label for="StartT">Start Time</label>
								<input type="text" name="StartT" class="form-control" value="23:11">
							</div>
						</div>

						<div class="col-12">
							<!--empty-->
						</div>

						<div class="col-4">
							<label for="employeeID">Employee ID</label>
							<div class="input-group">
								<input type="text" name="employeeID" class="form-control" value="emp001">
								<div class="input-group-btn">
									<button class="btn btn-primary"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>

						<div class="col-12">
							<hr><br>
						</div>

						{{-- <div class="col-12">
							<div class="col-3">
								<button class="btn btn-primary text-nowrap btn-md" id="preFillBtn">
									Pre-fill Operation
								</button>
							</div>
						</div> --}}

						<div class="col-12">
							<br>
						</div>
					</div>

				</div>
				<div class="col-3">
					<div class="row">
						<div class="col-12">
							<h3>Actions</h3>
						</div>
						<div class="col-12">
							<button class="btn btn-sm btn-primary form-control my-1" onclick="planJobSched()"
								id="planBtn">Plan</button>
						</div>
						<div class="col-12">
							<button class="btn btn-sm btn-primary form-control my-1" id="startBtn">Start</button>
						</div>
						<div class="col-12">
							<button class="btn btn-sm btn-primary form-control my-1" id="SPBtn">Pause/Resume</button>
						</div>
						<div class="col-12">
							<button class="btn btn-sm btn-primary form-control my-1" id="finBtn">Finish</button>
						</div>
					</div>
				</div>


			</div>
			<div class="row">
				<div class="col-12">
					<div class="table-responsive">
						<table class="table table-sm table-condensed" id="operationsTable">
							<thead>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">SEQUENCE NAME</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">OPERATION NAME</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">OPERATION TIME</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">PREDECESSOR</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">MACHINE CODE</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">WC TYPE</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">OUTSOURCED</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">PLANNED START</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">PLANNED END</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">REAL START</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">REAL END</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">STATUS</td>
								<td style="font-size:90%;font-weight:bold" class="text-nowrap">QTY FINISHED</td>
								<td>
									<!--empty-->
								</td>
								<td>
									<!--empty-->
								</td>
								<td>
									<!--empty-->
								</td>
							</thead>
							<tbody>
								<tr>
									<td>
										{{-- Sequence Name Value --}}
										Sequence 1
									</td>
									<td>
										{{-- Operation Name Value --}}
										Pick produce
									</td>
									<td>
										{{-- Operation Time Value --}}
										56 Hours
									</td>
									<td>
										{{-- Predecessor Value --}}

									</td>
									<td>
										{{-- Machine Code Value --}}

									</td>
									<td>
										{{-- WC_Type value --}}

									</td>
									<td class="d-flex align-items-center justify-content-center">
										{{-- Outsourced Value --}}

										<div class="form-check ">
											<input type="checkbox" class="form-check-input">
										</div>


									</td>
									<td class="p-3">
										{{-- Planned Start Value --}}
										<input class="form-control form-control-sm" type="text">
									</td>
									<td class="p-3">
										{{-- Planned End Value --}}
										<input class="form-control form-control-sm" type="text">
									</td>
									<td class="p-3">
										{{-- Real Start Value --}}
										<input class="form-control form-control-sm" type="text">
									</td>
									<td class="p-3">
										{{-- Real End Value --}}
										<input class="form-control form-control-sm" type="text">
									</td>
									<td>
										{{-- Status Value --}}

									</td>
									<td>
										{{-- Quantity Finished --}}

									</td>
									{{-- Action Buttons --}}
									<td>
										<a href="javascript:void(0)">
											<i class="fas fa-play"></i>
										</a>
									</td>
									<td>
										<a href="javascript:void(0)">
											<i class="fas fa-pause"></i>
										</a>
									</td>
									<td>
										<a href="javascript:void(0)">
											<i class="fas fa-power-off"></i>
										</a>
									</td>
								</tr>

								<tr>
									<td>
										{{-- Sequence Name Value --}}
										Sequence 2
									</td>
									<td>
										{{-- Operation Name Value --}}
										Pick produce
									</td>
									<td>
										{{-- Operation Time Value --}}
										34 Hours
									</td>
									<td>
										{{-- Predecessor Value --}}

									</td>
									<td>
										{{-- Machine Code Value --}}

									</td>
									<td>
										{{-- WC_Type value --}}

									</td>
									<td class="d-flex align-items-center justify-content-center">
										{{-- Outsourced Value --}}

										<div class="form-check ">
											<input type="checkbox" class="form-check-input">
										</div>


									</td>
									<td class="p-3">
										{{-- Planned Start Value --}}
										<input class="form-control form-control-sm" type="text">
									</td>
									<td class="p-3">
										{{-- Planned End Value --}}
										<input class="form-control form-control-sm" type="text">
									</td>
									<td class="p-3">
										{{-- Real Start Value --}}
										<input class="form-control form-control-sm" type="text">
									</td>
									<td class="p-3">
										{{-- Real End Value --}}
										<input class="form-control form-control-sm" type="text">
									</td>
									<td>
										{{-- Status Value --}}

									</td>
									<td>
										{{-- Quantity Finished --}}

									</td>
									{{-- Action Buttons --}}
									<td>
										<a href="javascript:void(0)">
											<i class="fas fa-play"></i>
										</a>
									</td>
									<td>
										<a href="javascript:void(0)">
											<i class="fas fa-pause"></i>
										</a>
									</td>
									<td>
										<a href="javascript:void(0)">
											<i class="fas fa-power-off"></i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$( document ).ready(function() {
		$("#SPBtn").css("display","none");
		$("#startBtn").css("display","none");
		$("#SPBtn").css("display","none");
		$("#finBtn").css("display","none");
	});
	$('#operationsTable').DataTable( {
		responsive: true,
		deferRender:    true,
        scrollX:        true,
        scrollY:        200,
        scrollCollapse: true,
        scroller:       true,
        searching:      false,
        paging:         false,
        info:           false,
		columnDefs: [{ 
			orderable: false, targets: [6,13,14,15] 
		}]
	});
	function planJobSched(){
		// Temporary condition to check if the current job has been planned, to hide or display the start and pause buttons
		if(!$("#SPBtn").is(':visible')){
			$("#SPBtn").css("display","inline");
			$("#startBtn").css("display","inline");
			$("#SPBtn").css("display","inline");
			$("#finBtn").css("display","inline");
			$("#planBtn").css("display","none");
		}
		else{
			$("#SPBtn").css("display","none");
			$("#startBtn").css("display","none");
			$("#SPBtn").css("display","none");
			$("#finBtn").css("display","none");
		}
	}
	// $("#preFillBtn").click(function(){
	// 	console.log("Pre fill inputs");	
	// });

	// When the value for the work order selectpicker changes,
	// get the operations associated with the workorder's products' BOM
	// and add them as rows
	$('#js-work-order-select').off('change').change(function(){
		let route = "{{ route('jobscheduling.getoperations', ['work_order'=>0]) }}".replace("/0/", "/" + $(this).val() + "/");
		let tableBody = $('#operationsTable').children('tbody');
		tableBody.html('<i class="fa fa-spinner fa-5x text-center p-5" aria-hidden="true"></i>');
		console.log(route);
		$.ajax({
			type: 'GET',
			url: route,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				tableBody.html('');
				data.operations.forEach((operation, index) => {
					tableBody.append(`
						<tr>
							<td>
								{{-- Sequence Name Value --}}
								Sequence ${data.routingOperations[index].sequence_id}
							</td>
							<td>
								{{-- Operation Name Value --}}
								${operation.operation_name}
							</td>
							<td>
								{{-- Operation Time Value --}}
								${data.routingOperations[index].operation_time}
							</td>
							<td>
								{{-- Predecessor Value --}}
								${(index > 0) ? data.operations[index - 1].operation_name : "N/A"}
							</td>
							<td>
								{{-- Machine Code Value --}}
								
							</td>
							<td>
								{{-- WC_Type value --}}
								${operation.wc_code}
							</td>
							<td class="d-flex align-items-center justify-content-center">
								{{-- Outsourced Value --}}

								<div class="form-check ">
									<input type="checkbox" class="form-check-input">
								</div>


							</td>
							<td class="p-3">
								{{-- Planned Start Value --}}
								<input class="form-control form-control-sm" type="text">
							</td>
							<td class="p-3">
								{{-- Planned End Value --}}
								<input class="form-control form-control-sm" type="text">
							</td>
							<td class="p-3">
								{{-- Real Start Value --}}
								<input class="form-control form-control-sm" type="text">
							</td>
							<td class="p-3">
								{{-- Real End Value --}}
								<input class="form-control form-control-sm" type="text">
							</td>
							<td>
								{{-- Status Value --}}

							</td>
							<td>
								{{-- Quantity Finished --}}

							</td>
							{{-- Action Buttons --}}
							<td>
								<a href="javascript:void(0)">
									<i class="fas fa-play"></i>
								</a>
							</td>
							<td>
								<a href="javascript:void(0)">
									<i class="fas fa-pause"></i>
								</a>
							</td>
							<td>
								<a href="javascript:void(0)">
									<i class="fas fa-power-off"></i>
								</a>
							</td>
						</tr>
					`);
				});
			},
			error: function(data){
				console.log("error");
			}
		});
	});
</script>

<script src="{{ asset('js/jobscheduling.js') }}"></script>