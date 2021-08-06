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
					<button class="btn" style="background-color: #d9dbdb;" onclick="sessionStorage.removeItem('unsaved'); loadIntoPage(this, '{{ route('jobscheduling.index') }}')">Cancel</button>
				</li>
				<!-- If a jobsched variable was not given or is a draft, that means we're trying to create/update something -->
				@if (!isset($jobsched) || $jobsched->js_status == "Draft")
					<li class="nav-item li-bom">
						<button class="btn btn-primary" type="button" id="js-save-btn" onclick="$('#js-form').submit();">Save</button>
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
				<div class="col-lg-9 col-md-12">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="fname">Tracking ID</label>
								<input type="text" class="form-control" placeholder="JOB-SCH-.YYYY.-" value="{{ isset($jobsched) ? $jobsched->jobs_sched_id : "" }}" readonly>
							</div>

						</div>
						<div class="col-12">
							<hr><br>
						</div>
						<div class="col-lg-6 col-md-12">
							<label for="workOrderJobSched">Work Order</label>
							<div class="input-group">
								<select name="work_order_no" id="js-work-order-select" class="selectpicker" data-route="{{ route('jobscheduling.getoperations', ['work_order'=>1]) }}" required @if (isset($jobsched) && $jobsched->js_status != "Draft") readonly @endif>
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
						<div class="col-lg-3 col-md-12 offset-lg-2">
							<div class="form-group">
								<label for="jobStartDate">Start Date</label>
								<input type="date" name="job_start_date" class="form-control" value="{{ isset($jobsched) ? $jobsched->start_date : null }}" onchange="sessionStorage.setItem('unsaved', true)" @if(isset($jobsched) && $jobsched->js_status != "Draft") readonly @endif>
							</div>
						</div>


						<div class="col-lg-6 col-md-12">
							<label for="productCode">Product/Component</label>
							<div class="input-group">
								<input type="text" id="js-product-code" class="form-control" value="{{ $item_name ?? "" }}" readonly placeholder="Product/Component Code & Name">
							</div>
						</div>
						<div class="col-lg-2 col-md-6">
							<div class="form-group">
								<label for="productQuantity">Quantity</label>
								<input type="text" name="quantity_purchased" id="productQuantity" class="form-control" value="{{ $quantity_purchased ?? 0 }}" required readonly>
							</div>
						</div>

						<div class="col-lg-3 col-md-6">
							<div class="form-group">
								<label for="job_start_time">Start Time</label>
								<input type="time" name="job_start_time" id="job_start_time" class="form-control" value="{{ $jobsched->start_time ?? "00:00" }}" required onchange="sesionStorage.setItem('unsaved', true)" @if(isset($jobsched) && $jobsched->js_status != "Draft") readonly @endif>
							</div>
						</div>

						<div class="col-lg-4">
							<label for="employeeID">Employee ID</label>
							<div class="input-group">
								<select name="employee_id" id="js-emp-id-select" class="selectpicker" onchange="sessionStorage.setItem('unsaved', true)" @if(isset($jobsched) && $jobsched->js_status != "Draft") disabled @endif>
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
								<button class="btn btn-sm btn-primary form-control my-1" onclick="planJobSched(); return false;"
									id="planBtn">Plan</button>
							</div>
						@endif
						@if (isset($jobsched))
							<div class="col-12">
								<button class="btn btn-sm btn-primary form-control my-1" onclick="startJobSched(); return false;" id="startBtn">Start</button>
							</div>
							<div class="col-12">
								<button class="btn btn-sm btn-primary form-control my-1" id="SPBtn">Pause/Resume</button>
							</div>
							<div class="col-12">
								<button class="btn btn-sm btn-primary form-control my-1" id="finBtn">Finish</button>
							</div>
							{{-- Hide the buttons if the jobsched does not have "planned" status yet --}}
							@if($jobsched->js_status != "Planned")
								<script>
									$("#SPBtn").css("display","none");
									$("#startBtn").css("display","none");
									$("#SPBtn").css("display","none");
									$("#finBtn").css("display","none");
								</script>
							@endif
						@endif
					</div>
				</div>


			</div>
			<div class="row">
				<div class="col-12">
					<div class="table-responsive">
						<table class="table table-sm table-condensed" id="operationsTable">
							<thead>
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">SEQUENCE NAME</th>
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">OPERATION NAME</th>
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">RUNNING TIME</th>
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">PREDECESSOR</th>
								{{-- <td style="font-size:70%;font-weight:bold" class="text-nowrap">MACHINE CODE</td>
								<td style="font-size:70%;font-weight:bold" class="text-nowrap">WC TYPE</td>
								<td style="font-size:70%;font-weight:bold" class="text-nowrap">OUTSOURCED</td> --}}
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">PLANNED START</th>
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">PLANNED END</th>
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">REAL START</th>
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">REAL END</th>
								<th style="font-size:70%;font-weight:bold" class="text-nowrap">STATUS</th>
                                {{-- STATUS MUST BE MOVED TO THE modal within the jobsched_operation_row --}}
								{{-- <td style="font-size:70%;font-weight:bold" class="text-nowrap">QTY FINISHED</td> --}}
								<th>
									<!--empty-->
								</th>
								<th>
									<!--empty-->
								</th>
								<th>
									<!--empty-->
								</th>
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
						{{-- Show the gantt chart only if one exists (currently updating one) & status is planned --}}
						@if(isset($jobsched))
							<div id="gantt_here" style='width:1000px; height:680px;'></div>
							@if ($jobsched->js_status != "Finished" && $jobsched->js_status != "Planned")
								<script>
									$('#gantt_here').css('display', 'none');
								</script>
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<div class="modal fade h-75" id="operationsDetails" tabindex="-1" role="dialog" aria-labelledby="operationsDetails"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OperationTitle">
                    Operation Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row m-1">
                        <div class="col-lg-6 p-1">
                            <div class="form-group">
                                {{-- Operation Time value --}}
                                <label for="operation_time">Operation Time</label>
                                <input type="text" class="form-control" readonly name="operation_time">
                            </div>
                            
                        </div>
                        <div class="col-lg-5 p-1">
                            <div class="form-group">
                                {{-- Machine Code Value --}}
                                <label for="machine_code">Machine Code</label>
                                <input type="text" class="form-control" name="machine_code">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row m-1">
                        <div class="col-lg-6 p-1">
                            <div class="form-group">
                                {{-- Part Code Value --}}
                                <label for="part_code">Part Code</label>
                                <input type="text" class="form-control" name="part_code">
                            </div>
                        </div>
                        <div class="col-lg-6 p-1">
                            <div class="form-group">
                                {{-- WC Type value --}}
                                <label for="wc_type">WC Type</label>
                                <input type="text" class="form-control" name="wc_type" value="{{-- {{ $operation->wc_code }} --}}">
                            </div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col-lg-12 p-1">
                            <div class="row ml-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="outsourced[]">
                                </div>
                                <label for="outsourced">Outsourced</label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col-lg-12 p-1">
                            <div class="form-group">
                                {{-- Where the status should be --}}
                                <label for="operation_status">Status</label>
                                <input type="text" class="form-control" id="operation_status" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#operationsDetails').modal('hide');">
                    Close
                </button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

{{-- Forms for updating a jobsched --}}
@if(isset($jobsched))
	<form action="{{ route('jobscheduling.setStatus', ['jobsched'=>$jobsched->id, 'status'=>'plan']) }}" id="js-plan-form">
		@csrf
		@method('PUT')
	</form>

	<form action="{{ route('jobscheduling.setStatus', ['jobsched'=>$jobsched->id, 'status'=>'start']) }}" id="js-start-form">
		@csrf
		@method('PUT')
	</form>
	<form action="{{ route('jobscheduling.setStatus', ['jobsched'=>$jobsched->id, 'status'=>'pause']) }}" id="js-pause-form">
		@csrf
		@method('PUT')
	</form>
	<form action="{{ route('jobscheduling.op.start', ['jobsched'=>$jobsched->id]) }}" id="op-start-form">
		@csrf
		@method('PUT')
	</form>
	<form action="{{ route('jobscheduling.op.pause', ['jobsched'=>$jobsched->id]) }}" id="op-pause-form">
		@csrf
		@method('PUT')
	</form>
	<form action="{{ route('jobscheduling.op.finish', ['jobsched'=>$jobsched->id]) }}" id="op-finish-form">
		@csrf
		@method('PUT')
	</form>
@endif

@if (isset($jobsched) && (($jobsched->js_status == "Finished") || $jobsched->js_status == "In Progress"))
	<script>
		gantt.clearAll();
		gantt.load('{{ route('jobscheduling.gantt_ops', ['jobsched' => $jobsched->id]) }}');
	</script>
@endif

<script>
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
			orderable: false,
		}],
		bSort: false,
	});
	function planJobSched(){
		if(sessionStorage.getItem('unsaved')) {
			swal({
				title: "Unsaved Information",
				text: "You have unsaved information!",
				icon: "warning",
			});
			return false;
		}
		var fd = new FormData($('#js-plan-form')[0]);
		$.ajax({
			type: 'POST',
			url: $('#js-plan-form').attr('action'),
			data: fd,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				swal({
					title: "Updated info",
					text: `Set ${data.jobsched.jobs_sched_id} status to "planned".`,
					icon: "info",
				});
				$("#SPBtn").css("display","inline");
				$("#startBtn").css("display","inline");
				$("#SPBtn").css("display","inline");
				$("#finBtn").css("display","inline");
				$("#planBtn").css("display","none");
				$('#js-status').text('Planned');
				// Remove the save button
				$('#js-save-btn').remove();
				// Disable changes on planned start & end
				$("input[name='planned_start[]']").each(function() {
					$(this).attr('readonly', true);
				});
				$("input[name='planned_end[]']").each(function() {
					$(this).attr('readonly', true);
				});
			console.log(data);
			// loadIntoPage(element, data.redirect);
			},
			error: function(data){
			var errorString = "";
			let obj = data.responseJSON.errors;
			// The response JSON from the controller sends back a message bag whose properties are
			// iterable through JS. The error messages list inherits other properties from base objects
			// and the if statement checks if the properties being iterated through are unique to the object.
			for (var prop in obj) {
				if (Object.prototype.hasOwnProperty.call(obj, prop)) {
				errorString += obj[prop] + " "; 
				}
			}
			swal({
				title: "Error",
				text: `An error has occurred. ${errorString}`,
				icon: "error",
			});
			console.log(data.responseJSON);
			}
		});
		// Temporary condition to check if the current job has been planned, to hide or display the start and pause buttons
		// if(!$("#SPBtn").is(':visible')){
		// 	$("#SPBtn").css("display","inline");
		// 	$("#startBtn").css("display","inline");
		// 	$("#SPBtn").css("display","inline");
		// 	$("#finBtn").css("display","inline");
		// 	$("#planBtn").css("display","none");
		// }
		// else{
		// 	$("#SPBtn").css("display","none");
		// 	$("#startBtn").css("display","none");
		// 	$("#SPBtn").css("display","none");
		// 	$("#finBtn").css("display","none");
		// }
	}

	function pauseJobSched() {
		if(sessionStorage.getItem('unsaved')) {
			swal({
				title: "Unsaved Information",
				text: "You have unsaved information!",
				icon: "warning",
			});
			return false;
		}
		var fd = new FormData($('#js-pause-form')[0]);
		$.ajax({
			type: 'POST',
			url: $('#js-pause-form').attr('action'),
			data: fd,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				swal({
					title: "Updated info",
					text: `Set ${data.jobsched.jobs_sched_id} status to "paused".`,
					icon: "info",
				});
				$("#startBtn").attr("disabled", true);
				$('#js-status').text('In Progress');
				$('.operation-play-btn').each(function(){
					$(this).attr('onclick', 'startOperation(this); return false;');
				});
				$('.operation-stop-btn').each(function(){
					$(this).attr('onclick', 'finishOperation(this); return false;');
				});
				$('.operation-pause-btn').each(function(){
					$(this).attr('onclick', 'pauseOperation(this); return false;');
				});
			console.log(data);
			// loadIntoPage(element, data.redirect);
			},
			error: function(data){
			var errorString = "";
			let obj = data.responseJSON.errors;
			// The response JSON from the controller sends back a message bag whose properties are
			// iterable through JS. The error messages list inherits other properties from base objects
			// and the if statement checks if the properties being iterated through are unique to the object.
			for (var prop in obj) {
				if (Object.prototype.hasOwnProperty.call(obj, prop)) {
				errorString += obj[prop] + " ";
				}
			}
			swal({
				title: "Error",
				text: `An error has occurred. ${errorString}`,
				icon: "error",
			});
			console.log(data.responseJSON);
			}
		});
	}
	function startJobSched() {
		if(sessionStorage.getItem('unsaved')) {
			swal({
				title: "Unsaved Information",
				text: "You have unsaved information!",
				icon: "warning",
			});
			return false;
		}
		var fd = new FormData($('#js-start-form')[0]);
		$.ajax({
			type: 'POST',
			url: $('#js-start-form').attr('action'),
			data: fd,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				swal({
					title: "Updated info",
					text: `Set ${data.jobsched.jobs_sched_id} status to "in progress".`,
					icon: "info",
				});
				$("#startBtn").attr("disabled", true);
				$('#js-status').text('In Progress');
				$('.operation-play-btn').each(function(){
					$(this).attr('onclick', 'startOperation(this); return false;');
				});
				$('.operation-stop-btn').each(function(){
					$(this).attr('onclick', 'finishOperation(this); return false;');
				});
				$('.operation-pause-btn').each(function(){
					$(this).attr('onclick', 'pauseOperation(this); return false;');
				});
			console.log(data);
			// loadIntoPage(element, data.redirect);
			},
			error: function(data){
			var errorString = "";
			let obj = data.responseJSON.errors;
			// The response JSON from the controller sends back a message bag whose properties are
			// iterable through JS. The error messages list inherits other properties from base objects
			// and the if statement checks if the properties being iterated through are unique to the object.
			for (var prop in obj) {
				if (Object.prototype.hasOwnProperty.call(obj, prop)) {
				errorString += obj[prop] + " ";
				}
			}
			swal({
				title: "Error",
				text: `An error has occurred. ${errorString}`,
				icon: "error",
			});
			console.log(data.responseJSON);
			}
		});
	}

	function startOperation(element) {
		let row = $(element).parents('tr');
		var operation_id = $(row).find('input[name="operation_id[]"]');
		console.log(operation_id.val());
		var real_start = $(row).find('input[name="real_start[]"]');
		var status = $(row).find('.js-status-td');
		var fd = new FormData($('#op-start-form')[0]);
		fd.append('operation_id', operation_id.val());
		$.ajax({
			type: 'POST',
			url: $('#op-start-form').attr('action'),
			data: fd,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				real_start.val(data.currDate);
				$(status).text('In Progress');
				console.log(data);
				// loadIntoPage(element, data.redirect);
			},
			error: function(data){
			var errorString = "";
			let obj = data.responseJSON.errors;
			// The response JSON from the controller sends back a message bag whose properties are
			// iterable through JS. The error messages list inherits other properties from base objects
			// and the if statement checks if the properties being iterated through are unique to the object.
			for (var prop in obj) {
				if (Object.prototype.hasOwnProperty.call(obj, prop)) {
				errorString += obj[prop] + " "; 
				}
			}
			swal({
				title: "Error",
				text: `An error has occurred. ${errorString}`,
				icon: "error",
			});
			console.log(data.responseJSON);
			}
		});
	}

	function finishOperation(element) {
		let row = $(element).parents('tr');
		var operation_id = $(row).find('input[name="operation_id[]"]');
		var status = $(row).find('.js-status-td');
		var real_end = $(row).find('input[name="real_end[]"]');
		var fd = new FormData($('#op-finish-form')[0]);
		fd.append('operation_id', operation_id.val());
		$.ajax({
			type: 'POST',
			url: $('#op-finish-form').attr('action'),
			data: fd,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				real_end.val(data.currDate);
				$(status).text("Finished");
				console.log(data.currDate);
				if(data.allFinished) {
					$('#js-status').text("Finished");
				}
				// loadIntoPage(element, data.redirect);
			},
			error: function(data){
			var errorString = "";
			let obj = data.responseJSON.errors;
			// The response JSON from the controller sends back a message bag whose properties are
			// iterable through JS. The error messages list inherits other properties from base objects
			// and the if statement checks if the properties being iterated through are unique to the object.
			for (var prop in obj) {
				if (Object.prototype.hasOwnProperty.call(obj, prop)) {
				errorString += obj[prop] + " "; 
				}
			}
			swal({
				title: "Error",
				text: `An error has occurred. ${errorString}`,
				icon: "error",
			});
			console.log(data.responseJSON);
			}
		});
	}

	function pauseOperation(element) {
		let row = $(element).parents('tr');
		var operation_id = $(row).find('input[name="operation_id[]"]');
		var status = $(row).find('.js-status-td');
		var fd = new FormData($('#op-pause-form')[0]);
		fd.append('operation_id', operation_id.val());
		$.ajax({
			type: 'POST',
			url: $('#op-pause-form').attr('action'),
			data: fd,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				console.log(data);
				$(status).text('Paused');
				// loadIntoPage(element, data.redirect);
			},
			error: function(data){
			var errorString = "";
			let obj = data.responseJSON.errors;
			// The response JSON from the controller sends back a message bag whose properties are
			// iterable through JS. The error messages list inherits other properties from base objects
			// and the if statement checks if the properties being iterated through are unique to the object.
			for (var prop in obj) {
				if (Object.prototype.hasOwnProperty.call(obj, prop)) {
				errorString += obj[prop] + " "; 
				}
			}
			swal({
				title: "Error",
				text: `An error has occurred. ${errorString}`,
				icon: "error",
			});
			console.log(data.responseJSON);
			}
		});
	}
	function notStartedWarning() {
		swal({
			title: "Warning",
			icon: "warning",
			text: "Job not in progress!",
		});
	}
	// $("#preFillBtn").click(function(){
	// 	console.log("Pre fill inputs");	
	// });

	// When the value for the work order selectpicker changes,
	// get the operations associated with the workorder's products' BOM
	// and add them as rows
	$('#js-work-order-select').off('change').change(function(){
		let route = "{{ route('jobscheduling.getoperations', ['work_order'=>0]) }}".replace("/0/", "/" + $(this).val() + "/");
		let tableBody = $('#operationsTable').DataTable();
		console.log(route);
		$.ajax({
			type: 'GET',
			url: route,
			contentType: false,
			processData: false,
			cache: false,
			success: function(data){
				function pad2(number) {
					return number < 10 ? `0${number}` : number;
				}
				operations = data.operations;
				routingOperations = data.routingOperations;
				tableBody.clear();
				$('#js-title').text(data.item_name);
				$('#js-status').text('{{ $jobsched->js_status ?? 'Unsaved' }}');
				data.operations.forEach((operation, index) => {
					var operation_time = routingOperations[index].operation_time;
					var ot_obj = new Date("1970-01-01T" + operation_time + "Z");
					ot_obj = new Date(ot_obj.getTime() * data.ordered_quantity);
					var hourStr = pad2(ot_obj.getUTCHours());
					var minStr = pad2(ot_obj.getMinutes());
					var secStr = pad2(ot_obj.getSeconds());
					var operation_time = `${hourStr}:${minStr}:${secStr}`;
					tableBody.row.add([`
						{{-- Sequence Name Value --}}
						<a href="#" class="operationName" data-id="${operation.operation_id}">
							Sequence ${data.routingOperations[index].sequence_id}
						</a>
					`,`
						{{-- Operation Name Value --}}
						${operation.operation_name}
						<input type="hidden" name="operation_id[]" value="${operation.operation_id}">
					`,`
						{{-- RUNNING TIME Value --}}
						<input type="hidden" name="running_time[]" value="${operation_time}">
						${operation_time}
					`,`
						{{-- Predecessor Value --}}
						${(index > 0) ? data.operations[index - 1].operation_name : "N/A"}
					`,`
						{{-- Planned Start Value --}}
						<div class="d-flex justify-content-center">
							<input type="datetime-local" name="planned_start[]" class="datePickers" style="width: 130px">
						</div>
					`,`
						{{-- Planned End value --}}
						<div class="d-flex justify-content-center">
							<input type="datetime-local" name="planned_end[]" class="datePickers" style="width: 130px">
						</div>
					`,`
						{{-- Real Start Value --}}
						<div class="d-flex justify-content-center">
							<input type="datetime-local" name="real_start[]" readonly class="datePickers" style="width: 130px">
						</div>
					`,`
						{{-- Real End --}}
						<div class="d-flex justify-content-center">
							<input type="datetime-local" name="real_end[]" readonly class="datePickers" style="width: 130px">
						</div>
					`,`
						{{-- Status Value --}}
						Not started
					`,``,``,``
				]).draw();
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