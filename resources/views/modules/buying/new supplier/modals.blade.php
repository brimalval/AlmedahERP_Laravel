<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-lg"">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
				<div class="col-sm-4">
					<div class="float-left">
						<h4 class="modal-title">Editing Row</h4>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="float-right">
						<button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
						<button class="btn btn-secondary btn-sm">Insert Below</button>
						<button class="btn btn-secondary btn-sm">Insert Above</button>
						<button class="btn btn-secondary btn-sm">Duplicate</button>
						<button class="btn btn-secondary btn-sm">Move</button>
						<button class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fas fa-caret-up"></span></button>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<label>Item Code</label>
						<input type="text" class="form-control" placeholder="">
					</div>
					<div class="col-sm-6">
						<label>Lead Time in days</label>
						<input type="text" class="form-control" placeholder="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label>Item Name</label>
						<input type="text" class="form-control" placeholder="">
					</div>
				</div><br>
				<div class="card">
				<div class="card-header" id="headingTwo">
				  <h5 class="mb-0">
					<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Desc" aria-expanded="false" aria-controls="Desc">
					  Description
					</button>
				  </h5>
				</div>
				<div id="Desc" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
					<div class="card-body">
						<form>
							<div class="form-row">
								<div class="col-12">
									<textarea id="summernoteTermsAndCondition" name="editordata"></textarea>
								</div>
							</div>
						</form>
					</div>	
				</div>
			</div>
			</div>
		  </div>
		</div>
	</div>