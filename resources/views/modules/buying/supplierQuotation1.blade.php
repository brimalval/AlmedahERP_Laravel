
	<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	  <div class="container-fluid">
	  <h2 class="navbar-brand tab-list-title">
			<a href='javascript:onclick=loadSupplierQuotation();' class="fas fa-arrow-left back-button"><span></span></a>
			<h2 class="navbar-brand" style="font-size: 35px;">Hi-top</h2>
		</h2>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse"  id="responsive">
		  <ul class="navbar-nav ml-auto">
			<li class="nav-item mt-2">
				<a href="" class="nav-link bg-light">
						<span class="fas fa-print"></span>
				</a>
			</li>
			<li class="nav-item mt-2">
				<a href="" class="nav-link bg-light">
						<span class="fas fa-angle-left"></span>
				</a>
			</li>
			 <li class="nav-item mt-2">
				<a href="" class="nav-link bg-light">
						<span class="fas fa-angle-right"></span>
				</a>
			</li>
			<li class="nav-item dropdown li-bom">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  Menu
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					  <li class><a class="dropdown-item" href="#">Send SMS</a></li>
					  <li><a class="dropdown-item" href="#">Print</a></li>
					  <li><a class="dropdown-item" href="#">Email</a></li>
					  <li><a class="dropdown-item" href="#">Jump to field</a></li>
					  <li><a class="dropdown-item" href="#">Links</a></li>
					  <li><a class="dropdown-item" href="#">Duplicate</a></li>
					  <li><a class="dropdown-item" href="#">Rename</a></li>
					  <li><a class="dropdown-item" href="#">Reload</a></li>
					  <li><a class="dropdown-item" href="#">Delete</a></li>
					  <li><a class="dropdown-item" href="#">Customize</a></li>
					  <li><a class="dropdown-item" href="#">New Activity Type</a></li>
				  </ul>
			  </li>
			</li>
			<li class="nav-item li-bom">
				<button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;" href="#" data-toggle="modal" data-target="#myModal">Cancel</button>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
	<div class="container-fluid" style="margin: 0; padding: 0;">
		<div class="row mt-2 mb-3">
			<div class="col-12">
				<div class="Card">
					<div class="card-body ml-auto">
					 <a href="#" class="btn btn-primary" role="button">Create</a>
					</div>
				</div>
		<div id="accordion">
		<!--DASHBOARD -->
			<?php include 'supplier quotation/dashboard.php' ?>
			<!-- -->
			<div class="card">
				<div class="card-body">
					<form>
						<div class="form-row">
							<div class="col-4">
								<label><b>Supplier</b></label>
								<input type="text" class="form-control" placeholder="Hi-top" disabled>
							</div>&nbsp;&nbsp;&nbsp;
							<div class="col-4">
								<label><b>Date</b></label>
								<input type="text" class="form-control" placeholder="12-12-2020" disabled>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!--CURRENCY AND PRICELIST -->
			<div class="card">
				<?php include 'supplier quotation/currenc_pricelist.php' ?>
			</div>
			<!--ITEMS TABLE-->
			<div class="card">
				<?php include 'supplier quotation/items_table.php' ?>
			</div>
			<!-- -->
			<div class="card">
				<div class="card-body">
					<form>
						<div class="form-row">
							<div class="col-4">
								<label><b>Total Quantity</b></label>
								<input type="number" class="form-control" placeholder="1,352,000.00" disabled>
							</div>&nbsp;&nbsp;&nbsp;
							<div class="col-4">
								<label><b>Total(PHP)</b></label>
								<input type="number" class="form-control" placeholder="0.00" disabled>
							</div>
							<div class="col-4">
								
							</div>&nbsp;&nbsp;&nbsp;
							<div class="col-4">
								<label><b>Total Net Weight</b></label>
								<input type="number" class="form-control" placeholder="0" disabled>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- -->
			<div class="card">
				<div class="card-body">
					<label>Purchase Taxes and Charges</label>
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
							  <td><a href="#" style="color: black">On Net Total</a></td>
							  <td>VAT - ALM</td>
							  <td>12</td>
							  <td><span class="fas fa-ruble-sign">0.00</span></td>
							  <td><span class="fas fa-ruble-sign">0.00</span></td>
							  <td><span class="fas fa-caret-down"></span></td>
							</tr>
							<tr>
							  <th scope="row"><input type="checkbox"> 2</th>
							  <td><a href="#" style="color: black">Actual</a></td>
							  <td>Freight and Forward</td>
							  <td>0</td>
							  <td><span class="fas fa-ruble-sign">0.00</span></td>
							  <td><span class="fas fa-ruble-sign">0.00</span></td>
							  <td><span class="fas fa-caret-down" style="color: black"></span></td>
							</tr>
						  </tbody>
						</table>
					</div>	
				</div>
			</div>
			<!--TAX BREAKUP -->
			<div class="card">
				<?php include 'supplier quotation/tax_breakup.php' ?>
			</div>	
			<!-- -->
			<div class="card-body">
				<form>
					<div class="form-row">
						<div class="col-6"></div>
						<div class="col-6">
							<label>Taxes and Charges Added(PHP)</label>
							<input type="number" class="form-control" placeholder="P 0.00" style="font-weight: bold;" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="col-6"></div>
						<div class="col-6">
							<label>Taxes and Charges Deducted(PHP)</label>
							<input type="number" class="form-control" placeholder="P 0.00" style="font-weight: bold;" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="col-6"></div>
						<div class="col-6">
							<label>Total Taxes and Charges</label>
							<input type="number" class="form-control" placeholder="P 0.00" style="font-weight: bold;"disabled> 
						</div>
					</div>
				</form>
			</div>	
			<!--Additional Discount-->
			<div class="card">
				<?php include 'supplier quotation/additional_discount.php' ?>
			</div>
			<!-- -->
			<div class="card-body">
				<form>
					<div class="form-row">
						<div class="col-6"></div>
						<div class="col-6">
							<label>Grand Total (PHP)</label>
							<input type="number" class="form-control" placeholder="P 0.00" style="font-weight: bold;" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="col-6"></div>
						<div class="col-6">
							<label>Rounding Adjustment(PHP)</label>
							<input type="number" class="form-control" placeholder="P 0.00" style="font-weight: bold;" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="col-6"></div>
						<div class="col-6">
							<label>Rounded Total(PHP)</label>
							<input type="number" class="form-control" placeholder="P 0.00" style="font-weight: bold;"disabled> 
						</div>
					</div>
					<div class="form-row">
						<div class="col-6"></div>
						<div class="col-6">
							<label>In Words(PHP)</label>
							<input type="number" class="form-control" placeholder="PHP Zero Only" style="font-weight: bold;"disabled> 
						</div>
					</div>
					<div class="form-row">
						<div class="col-6"></div>
						<div class="col-6" style="padding-top: 40px;">
							<input type="checkbox">
							<label>Disable Rounded Total</label>
						</div>
					</div>
				</form>
			</div>	
			<!--Printing Settings-->
			<div class="card">
				<?php include 'supplier quotation/printing_settings.php' ?>
			</div>
			<!--More Information-->
			<div class="card">
				<?php include 'supplier quotation/more_info.php' ?>
			</div>
			<!--Comment -->
			<div class="card">
				<?php include 'supplier quotation/comment.php' ?>
			</div>
		</div>
		</div>
	</div>	
</div>
	
	<!--Modals-->
	<?php include 'supplier quotation/modals.php' ?>