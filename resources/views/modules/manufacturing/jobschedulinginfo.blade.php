<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
	<div class="container-fluid">
		<h2 class="navbar-brand tab-list-title">
			<h2 class="navbar-brand" style="font-size: 35px;">Emulsifier Component</h2>
		</h2>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
<form id="contactForm" name="contact" role="form" action="AddEmployee.php">
	<div class="modal-body">
		<div class="row">
			<div class="col-6">

				<div class="form-group">
					<label for="fname">Job Schedule ID</label>
					<input type="text" name="JobSc" class="form-control" value="jobsched001">
				</div>

			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="fname">WBS Code</label>
					<input type="text" name="code" class="form-control" value="EM_1.1">
				</div>

			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="compnay">Predecessor</label>
					<input type="text" name="Predecessor" class="form-control" value="">
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label for="fname">Successor</label>
					<input type="text" name="Successor" class="form-control">
				</div><br>
			</div>
			<div class="col-6">
				<!--empty-->
			</div>
			<div class="col-12">
				<hr><br>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="PartC">Part Code</label>
					<input type="text" name="PartC" class="form-control">
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="ComponentC">Component Code</label>
					<input type="text" name="ComponentC" class="form-control" value="Hooper">
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label for="TaskId">Task ID</label>
					<input type="text" name="TaskId" class="form-control" value="T010">
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label for="MachineC">Machine Code</label>
					<input type="text" name="MachineC" class="form-control" value="LM">
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="setupN">Setup Name</label>
					<input type="text" name="setupN" class="form-control">
				</div><br>
			</div>
			<div class="col-12">
				<hr><br>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label for="RunningT">Running Time</label>
					<input type="text" name="RunningT" class="form-control">
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label for="totalH">Total Hours</label>
					<input type="text" name="totalH" class="form-control">
				</div>
			</div>

			<div class="col-3">
				<div class="form-group">
					<label for="days">Days</label>
					<input type="text" name="days" class="form-control">
				</div>
			</div>

			<div class="col-3">
				<div class="form-group">
					<label for="hours">Hours</label>
					<input type="text" name="hours" class="form-control">
				</div>
			</div>

			<div class="col-3">
				<div class="form-group">
					<label for="startT">Start Time</label>
					<input type="text" name="startT" class="form-control">
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label for="EndT">End Time</label>
					<input type="text" name="EndT" class="form-control">
				</div><br>
			</div>
			<div class="col-12">
				<hr><br>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label for="JSstatus">JS Status</label>
					<input type="text" name="JSstatus" class="form-control">
				</div>
			</div>
			<div class="col-3">
				<div class="form-group">
					<label for="employeeID">Employee ID</label>
					<input type="text" name="employeeID" class="form-control" value="emp001">
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="Manufacturing">Manufacturing Order No.</label>
					<input type="text" name="Manufacturing" class="form-control" value="MFG0001">
				</div>
			</div>

		</div>
		<div class="row">
		</div>
	</div>
</form>