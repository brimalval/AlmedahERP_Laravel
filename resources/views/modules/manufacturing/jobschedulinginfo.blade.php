<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
	<div class="container-fluid">
		<h2 class="navbar-brand tab-list-title">
			<h2 class="navbar-brand" style="font-size: 35px;" id="js-title">{{ $jobsched->work_order->item->product_name ?? $jobsched->work_order->item->component_name ?? "" }}</h2>
			{{-- JS_STATUS --}}
			<h4 id="js-status">{{ $jobsched->js_status ?? "" }}</h4>
		</h2>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item li-bom">
					<button class="btn" style="background-color: #d9dbdb;" onclick="loadIntoPage(this, '{{ route('jobscheduling.index') }}')">Cancel</button>
				</li>
				<!-- If a jobsched variable was not given or is a draft, that means we're trying to create/update something -->
				@if (!isset($jobsched) || $jobsched->js_status == "Draft")
					<li class="nav-item li-bom">
						<button class="btn btn-primary" type="button" onclick="$('#js-form').submit();">Save</button>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>

<form id="js-form" role="form" action="{{ $form_route }}"> 
	{{-- If we're not trying to create something, then we're trying to update something --}}
	@if ($form_route != route('jobscheduling.store'))
		@method('PATCH')	
	@endif
	@csrf
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-9">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="fname">Tracking ID</label>
								<input type="text" class="form-control" placeholder="JOB-SCH-.YYYY.-" value="{{ isset($jobsched) ? $jobsched->jobs_sched_id : "" }}" readonly>
							</div>

						</div>

						<div class="col-6">
							<!--empty-->
						</div>
						<div class="col-12">
							<hr><br>
						</div>
						<div class="col-6">
							<label for="workOrderJobSched">Work Order</label>
							<div class="input-group">
								<select name="work_order_no" id="js-work-order-select" class="selectpicker" data-route=""{{ route('jobscheduling.getoperations', ['work_order'=>1]) }} required>
									<option value="none" selected disabled>
										Select a work order
									</option>
									@foreach ($work_orders as $work_order)
									{{-- Select the work order if it's the one currently assigned to the given jobsched --}}
										<option value="{{ $work_order->work_order_no }}" data-subtext="Sales: {{ $work_order->sales_id }} For: {{ $work_order->product_code ?? $work_order->component_code }}"
											@if(isset($jobsched) && $work_order->work_order_no == $jobsched->work_order->work_order_no) selected @endif>
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
								<input type="date" name="job_start_date" class="form-control" value="{{ isset($jobsched) ? $jobsched->start_date : null }}">
							</div>
						</div>


						<div class="col-6">
							<label for="productCode">Product/Component</label>
							<div class="input-group">
								<input type="text" id="js-product-code" class="form-control" value="{{ $item_name ?? "" }}" readonly placeholder="Product/Component Code & Name">
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<label for="productQuantity">Quantity</label>
								<input type="text" name="quantity_purchased" id="productQuantity" class="form-control" value="{{ $quantity_purchased ?? 0 }}" required>
							</div>
						</div>

						<div class="col-3">
							<div class="form-group">
								<label for="job_start_time">Start Time</label>
								<input type="time" name="job_start_time" id="job_start_time" class="form-control" value="{{ $jobsched->start_time ?? "00:00" }}" required>
							</div>
						</div>

						<div class="col-12">
							<!--empty-->
						</div>

						<div class="col-4">
							<label for="employeeID">Employee ID</label>
							<div class="input-group">
								<select name="employee_id" id="js-emp-id-select" class="selectpicker">
									@foreach ($employees as $employee)
										<option value="{{ $employee->employee_id }}" data-subtext="{{ $employee->employee_id }}: {{ $employee->position }}"
										@if(isset($jobsched) && $jobsched->employee_id == $employee->employee_id) selected @endif>
											{{ $employee->last_name }}, {{ $employee->first_name }}
										</option>
									@endforeach
								</select>
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
						{{-- Give the user the ability to press plan if the jobsched is a draft --}}
						@if(isset($jobsched) && $jobsched->js_status == "Draft")
							<div class="col-12">
								<h3>Actions</h3>
							</div>
							<div class="col-12">
									<button class="btn btn-sm btn-primary form-control my-1" onclick="planJobSched()"
										id="planBtn">Plan</button>
							</div>
						@endif
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
								{{-- index is used to identify sequence number --}}
								@if (isset($operations))
									@foreach (json_decode($operations) as $operation)
										@include('modules.manufacturing.jobschedSubmodules.jobsched_operation_row', [
											'operation' => $operation,
											'index' => $loop->index + 1,
											'jobsched' => $jobsched,
											'predecessor' => json_decode($operations)[$loop->index - 1] ?? "N/A", 
										])	
									@endforeach
								@endif
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
				operations = data.operations;
				tableBody.html('');
				$('#js-title').text(data.item_name);
				$('#js-status').text('{{ $jobsched->js_status ?? 'Unsaved' }}');
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
								<input type="hidden" name="operation_id[]" value="${operation.operation_id}"> 
							</td>
							<td>
								{{-- Operation Time Value --}}
								${data.routingOperations[index].operation_time}
								<input type="hidden" name="operation_time[]" value="${data.routingOperations[index].operation_time}">
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
								<input class="form-control form-control-sm" type="text" name="planned_start[]">
							</td>
							<td class="p-3">
								{{-- Planned End Value --}}
								<input class="form-control form-control-sm" type="text" name="planned_end[]">
							</td>
							<td class="p-3">
								{{-- Real Start Value --}}
								<input class="form-control form-control-sm" type="text" name="real_start[]">
							</td>
							<td class="p-3">
								{{-- Real End Value --}}
								<input class="form-control form-control-sm" type="text" name="real_end[]">
							</td>
							<td>
								{{-- Status Value --}}

							</td>
							<td>
								{{-- Quantity Finished --}}

							</td>
							{{-- Action Buttons --}}
							<td>
								<a href="#" onclick="return false;" class="operation-play-btn">
									<i class="fas fa-play"></i>
								</a>
							</td>
							<td>
								<a href="#" onclick="return false;" class="operation-pause-btn">
									<i class="fas fa-pause"></i>
								</a>
							</td>
							<td>
								<a href="#" onclick="return false;" class="operation-stop-btn">
									<i class="fas fa-power-off"></i>
								</a>
							</td>
						</tr>
					`);
				});
				$('#js-product-code').val(data.item_name + " (" + data.item_code + ")");
				$('#productQuantity').val(data.ordered_quantity);
			},
			error: function(data){
				console.log("error");
			}
		});
	});

	// If an encoded operations string was given, parse it and assign it to operations
	// otherwise, make operations an empty array
	var operations_string = {!! $operations_encoded ?? "[]" !!};
	// Operations string will be read as type "object" if "[]" is given as its value
	// (even though "[]" is a string, wtf javascript/laravel)
	var operations = (typeof operations_string == "string") ? JSON.parse(operations_string) : [];
</script>

<script src="{{ asset('js/jobscheduling.js') }}"></script>