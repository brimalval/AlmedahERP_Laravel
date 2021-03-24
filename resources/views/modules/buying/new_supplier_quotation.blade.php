
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<h2 class="navbar-brand" style="font-size: 35px;">New Supplier Quotation 1</h2>
			<div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
				<div class="navbar-nav ml-auto">
					<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
						<div class="btn-group" role="group">
						<button type="button" class="btn btn-info" href="#">Save</button>
					</div>
				</div>
			</div>
		</nav>

	<div class="container-fluid" style="margin: 0; padding: 0;">
		<div class="row mt-2 mb-3">
			<div class="col-12">
				<div class="Card">
				<div class="card-header">
                    <div class="">
						<button class="btn btn-secondary btn-sm" style="float:right;">Get Items From</button>
					</div>
                </div>
				</div>
		<div id="accordion">
			<!-- -->
			<div class="card">
				@include( 'modules.buying.new supplier.series_nsq' )
			</div>
			<!--ADDRESS AND CONTACT-->
			<div class="card">
				@include( 'modules.buying.new supplier.address_contact_nsq' )
			</div>
			<!--CURRENCY AND PRICELIST-->
			<div class="card">
				@include( 'modules.buying.new supplier.currency_and_pricelist_nsq' )
			</div>
			<!--ITEMS TABLE-->
			<div class="card">
				<div class="card-body">
					@include( 'modules.buying.new supplier.items_table_nsq' )
				</div>
			</div>
			<!-- -->
			<div class="card">
				<div class="card-body">
					@include( 'modules.buying.new supplier.total_quantity_nsq' )
				</div>
			</div>
			<!-- -->
			<div class="card">
				<div class="card-body">
					@include( 'modules.buying.new supplier.tax_charges_nsq' )
				</div>
			</div>
			<!-- -->
			<div class="card">
				<div class="card-body">
					<form>
						<div class="form-row">
							<div class="col-6">
								<label>Purchase Taxes and Charges Template</label>
								<input type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="form-row">
							<div class="col-12">
								<div class="table-responsive table-hover table-bordered">
						<table class="table">
						  <thead class="thead-dark">
							<tr>
							  <th scope="col"><input type="checkbox" name=""></th>
							  <th scope="col" class="w-30">Type</th>
							  <th scope="col">Account Head</th>
							  <th scope="col">Rate</th>
							  <th scope="col">Amount</th>
							  <th scope="col">Total</th>
							  <th scope="col"></th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <th scope="row"><input type="checkbox"> 1</th>
							  <td><a href="#" style="color: black"></a></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td></td>
							</tr>
						  </tbody>
						</table>
						<div class="float-left">
							<button class="btn btn-secondary">Add Row</button>
						</div>
					</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			
			<!-- -->
			<div class="card-body">
				@include( 'modules.buying.new supplier.taxes_charges' )
			</div>	
			<!--Additional Discount-->
			<div class="card">
				@include( 'modules.buying.new supplier.add_disc_nsq' )
			</div>
			<!-- -->
			<div class="card-body">
				@include( 'modules.buying.new supplier.grand_total' )
			</div>	
			<!--TERMS AND CONDITIONS-->
			<div class="card">
				@include( 'modules.buying.new supplier.terms_cond_nsq' )
			</div>
			<!--Printing Settings-->
			<div class="card">
				@include( 'modules.buying.new supplier.printing_settings_nsq' )
			</div>
			<!--More Information-->
			<div class="card">
				@include( 'modules.buying.new supplier.more_info_nsq' )
			</div>
		</div>
		</div>
	</div>

	<!--Modals-->
	@include( 'modules.buying.new supplier.modals' )
	
</div>
