<div class="container">
	<div class="row">
		<div class="col-6">
			<label for="supplier_name">Company Name</label>
			<input type="text" id="supplier_name" name="supplier_name" class="form-control" value="">
			<br>
			<label for="supplier_contact">Contact Person</label>
            <input type="text" name="supplier_contact" id="supplier_contact" class="form-control" value="">
			<br>
			<label for="supplier_phone">Contact No.</label>
			<input min="1" type="number" id="supplier_phone" name="supplier_phone" class="form-control" placeholder="+63">
			{{--
				Baka textarea mas appropriate sa physical address? Just in case na mahaba yung address
				ng mismong supplier. Though di ko alam kung paano siya iintegrate nang maayos
			--}}
			{{--
			
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
			--}}
		</div>
		<div class="col-6">
			<label for="supplier_group">Supplier Group</label>
			<select name="supplier_group" id="supplier_group" class="form-control">
				<option value="n/o" selected hidden>-Select One-</option>
				<option value="Raw Materials">Raw Materials</option>
				<option value="Electrical">Electrical</option>
				<option value="Hardware">Hardware</option>
			</select>
			<br>
			<label for="supplier_email">E-mail Address</label>
            <input type="email" id="supplier_email" name="supplier_email" class="form-control" value="">
			<br>
			<label for="supplier_address">Physical Address</label>
			<input type="text" id="supplier_address" name="supplier_address" class="form-control" value="">
			{{--
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
			--}}
		</div>
	</div>
</div>