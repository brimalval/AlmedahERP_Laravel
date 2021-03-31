<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadPurchaseOrder();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">New Sales Taxes</h2>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="card">
<br>
<div class="container">
    <form id="newsalestaxesForm" name="newsalestaxesForm" role="form">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <input type="text" name="supplier" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="supplier">Company</label>
                    <input type="text" name="supplier" class="form-control" value="Almedah Food Equipments">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="checkbox"> Default
                </div>
                    <input type="checkbox"> Disabled
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="supplier">Tax Category</label>
                    <input type="text" name="supplier" class="form-control">
                </div>
            </div>

            <div class="col-12">
                <hr>
            </div>
            
            <br>

            <div class="col-6">
                <div class="form-group">
                    <p>*Will be calculated in the transaction.</p>
                </div>
            </div>

            <div class="col-6">
                <!---Empty Column-->
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="salestaxesandcharges">Sales Taxes and Charges</label>
                    <table id="ShippingRuleTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Type</th>
                                <th>Account Head</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <td colspan="7" rowspan="5">
                            <button type="button" onclick="addRow()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                    </td>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<script src="{{ asset('js/salestaxes.js') }}"></script>