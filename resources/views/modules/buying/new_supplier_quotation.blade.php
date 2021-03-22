
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
				<?php include 'new supplier/series_nsq.php' ?>
			</div>
			<!--ADDRESS AND CONTACT-->
			<div class="card">
				<?php include 'new supplier/address_contact_nsq.php' ?>
			</div>
			<!--CURRENCY AND PRICELIST-->
			<div class="card">
				<?php include 'new supplier/currency_and_pricelist_nsq.php' ?>
			</div>
			<!--ITEMS TABLE-->
			<div class="card">
				<div class="card-body">
					<?php include 'new supplier/items_table_nsq.php' ?>
				</div>
			</div>
			<!-- -->
			<div class="card">
				<div class="card-body">
					<?php include 'new supplier/total_quantity_nsq.php' ?>
				</div>
			</div>
			<!-- -->
			<div class="card">
				<div class="card-body">
					<?php include 'new supplier/tax_charges_nsq.php' ?>
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
				<?php include 'new supplier/taxes_charges.php' ?>
			</div>	
			<!--Additional Discount-->
			<div class="card">
				<?php include 'new supplier/add_disc_nsq.php' ?>
			</div>
			<!-- -->
			<div class="card-body">
				<?php include 'new supplier/grand_total.php' ?>
			</div>	
			<!--TERMS AND CONDITIONS-->
			<div class="card">
				<?php include 'new supplier/terms_cond_nsq.php' ?>
			</div>
			<!--Printing Settings-->
			<div class="card">
				<?php include 'new supplier/printing_settings_nsq.php' ?>
			</div>
			<!--More Information-->
			<div class="card">
				<?php include 'new supplier/more_info_nsq.php' ?>
			</div>
		</div>
		</div>
	</div>

	<!--Modals-->
	<?php include 'new supplier/modals.php' ?>
	
</div>
