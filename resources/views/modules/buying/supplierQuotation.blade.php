
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand" style="font-size: 35px;">Supplier Quotation</h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Import</a>
                        <a class="dropdown-item" href="#">User Permissions</a>
						<a class="dropdown-item" href="#">Role Permissions Manager</a>
                        <a class="dropdown-item" href="#">Customize</a>
						<a class="dropdown-item" href="#">Toggle Sidebar</a>
						<a class="dropdown-item" href="#">Share URL</a>
                        <a class="dropdown-item" href="#">Settings</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" href="#">Refresh</button>
                <button type="button" class="btn btn-info ml-1" onclick="openNewSupplierQuotation();">New</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row mt-2 mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <form>
                        <div class="form-row">
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
							<div class="col-2">
                                <input type="text" class="form-control" placeholder="Title">
                            </div>
							<div class="col-2">
                                <input type="text" class="form-control" placeholder="Supplier">
                            </div>
							<div class="col-2">
                                <input type="text" class="form-control" placeholder="Title">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body filter align-middle">
                    <div class="float-left">
                        <button class="btn btn-secondary btn-sm">Add Filter</button>
                    </div>
                    <div class="float-right">
                        <span class="text-muted">Last Modified</span>
                        <button class="btn btn-secondary btn-sm">
                            <span class="fa fa-arrow-down fa-fw"></span>
                        </button>
                    </div>
                </div>
				<div class="card-body table-display">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col" class="text-center" style="width: 0%;">
                                </th>
                                <th scope="col" style="width: 15%;">Name</th>
                                <th scope="col" style="width: 10%;">Status</th>
                                <th scope="col" style="width: 30%;">Grand Total</th>
                                <th scope="col" style="width: 20%;">&nbsp;</th>
                                <th scope="col" style="width: 5%;">&nbsp;</th>
                                <th scope="col" style="width: 0%;">&nbsp;</th>
                                <th scope="col" style="width: 5%;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 1; $i++) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                       
                                    </td>
                                    <td>
                                        <span onclick='loadSupplierQuotationInfo();' style="cursor: pointer;">
                                            <?= 'Hi Top ' . $i ?>
                                        </span>
                                    </td>
                                    <td>
                                       
										Submitted
                                    </td>
                                   <td class="text-right">
                                       
                                    </td>
                                    <td class="text-right">
                                       R-SQTN-2021-00001
                                    </td>
                                    <td class="text-center">
                                        <span>10 M</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fa fa-square-o fa-2x"></span>
                                    </td>
                                    <td>
                                        <span>
                                            <span class="fa fa-comments fa-fw"></span>
                                            <span>0</span>
                                        </span>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-dark" href="#">20</button>
                        <button type="button" class="btn btn-secondary" href="#">100</button>
                        <button type="button" class="btn btn-secondary" href="#">500</button>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>