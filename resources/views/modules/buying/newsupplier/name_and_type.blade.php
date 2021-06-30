<div class="container">
	<div class="row">
		<div class="col-6">
			<label for="supplier_name">Company Name</label>
			<input type="text" id="supplier_name" name="supplier_name" class="form-control" value="{{ $supplier['company_name'] ?? '' }}">
			<br>
			<label for="supplier_contact">Contact Person</label>
            <input type="text" name="supplier_contact" id="supplier_contact" class="form-control" value="{{ $supplier['contact_name'] ?? '' }}">
			<br>
			<label for="supplier_phone">Contact No.</label>
			<input min="1" type="number" id="supplier_phone" name="supplier_phone" value="{{ $supplier['phone_number'] ?? ''}}" class="form-control" placeholder="+63">
		</div>
		<div class="col-6">
			<label for="supplier_group">Supplier Group</label>
			<select name="supplier_group" id="supplier_group" class="form-control">
				<option value="{{ $supplier['supplier_group'] ?? 'n/o' }}" selected hidden>{{ $supplier['supplier_group'] ?? '-Select One-'}}</option>
				<option value="Raw Materials">Raw Materials</option>
				<option value="Electrical">Electrical</option>
				<option value="Hardware">Hardware</option>
			</select>
			<br>
			<label for="supplier_email">E-mail Address</label>
            <input type="email" id="supplier_email" name="supplier_email" class="form-control" value="{{ $supplier['supplier_email'] ?? '' }}">
			<br>
			<label for="supplier_address">Physical Address</label>
			<input type="text" id="supplier_address" name="supplier_address" class="form-control" value="{{ $supplier['supplier_address'] ?? '' }}">
		</div>
	</div>
</div>