<div class="container">
	<div class="row">
		<div class="col-6">
			<label for="snewname">Supplier Name</label>
			<input type="text" id="sname" class="form-control font-weight-bold" value="">
			<label for="snewcountry">Country</label>
			<input type="text" id="scountry" class="form-control font-weight-bold" value="">
			<label for="snewbank">Default Bank Account</label>
			<input type="text" id="sbank" class="form-control font-weight-bold" value="">
			<label for="snewbank">Tax ID</label>
			<input type="text" id="sbank" class="form-control font-weight-bold" value="">
			<label for="snewaddress">Address</label>
			<input type="text" id="snewaddress" class="form-control font-weight-bold" value="">
			<div class="d-flex">
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="istransporter">
				</div>
				<label for="istransporter">Is Transporter</label>
			</div>
			<div class="d-flex">
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="isinternalsupploer">
				</div>
				<label for="isinternalsupploer">Is Internal Supplier</label>
			</div>
		</div>
		<div class="col-6">
			<label for="snewgroup">Supplier Group</label>
			<input type="text" id="sgroup" class="form-control font-weight-bold" value="">
			<label for="snewtype">Supplier Type</label>
			<select type="text" id="stype" class="form-control font-weight-bold">
				<option value="Company" selected>Company</option>
				<option value="Individual">Individual</option>
			</select>
			<label for="snewemail">Email</label>
			<input type="email" id="snewemail" class="form-control font-weight-bold" value="">
			<label for="snewcontact">Contact No.</label>
			<input type="text" id="snewcontact" class="form-control font-weight-bold" value=""><br>
			<div class="d-flex">
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="sdisabled">
				</div>
				<label for="sdisabled">Disabled</label>
			</div>
		</div>
	</div>
</div>