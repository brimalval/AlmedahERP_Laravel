<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadSalesTaxes();' class="fas fa-arrow-left back-button"><span></span></a>
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
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="taxCategory">Tax Category</label>
                    <input type="text" name="taxCategory" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input type="checkbox"> Default
                </div>
                    <input type="checkbox"> Disabled
            </div>

            <div class="col-12">
                <br><hr><br>
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
                    <table id="salestaxesandcharges" class="table table-striped table-bordered" style="width:100%">
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
                        <tbody class="" id="material-request-input-rows">
                  <tr>
                    <td id="no-data" colspan="7" style="text-align: center;">
                      NO DATA
                    </td>
                  </tr>
                </tbody>
                    </table>
                    <td colspan="7" rowspan="5">
                            <button type="button" onclick="addSalesTaxRow()" class="btn btn-sm btn-sm btn-secondary">Add Row</button>
                    </td>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<script src="{{ asset('js/saletaxes.js') }}"></script>

<!-- Modal -->
<div class="modal fade" id="editSalesTaxesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editing Row #1</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
            <form id="newsalestaxesForm" name="newsalestaxesForm" role="form">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control">
                        <option></option>
                        <option>Option 1</option>
                        <option>Option 2</option>
                    </select>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="accountHead">Account Head</label>
                    <input type="text" name="accountHead" class="form-control">
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" style="width:410px;height:200px;">
                  </div>
                  <input type="checkbox"> Is this Tax included in Basic Rate?
                  <p>If checked, the tax amount will be considered as already included in the Print Rate / Print Amount</p>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <br><hr><br>
                  </div>
                </div>

                <div class="col-6">
                    <label>ACCOUNTING DIMENSIONS</label>
                </div>

                <div class="col-6">
                  <br>
                </div>
                
                <div class="col-6">
                  <div class="form-group">
                    <label for="costCenter">Cost Center</label>
                    <input type="text" name="costCenter" class="form-control">
                  </div>
                </div>

                <div class="col-12">
                  <br><hr><br>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="rate">Rate</label>
                    <input type="text" name="rate" class="form-control">
                  </div>
                </div>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>