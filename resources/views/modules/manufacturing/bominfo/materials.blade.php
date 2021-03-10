<div class="container-fluid">
    <div class="Card">
            <div class="card-body">
                
                <form>
                <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="oper">
                            <label class="form-check-label" for="oper">Quality Inspection Required</label>
                </div>
                </form>

<label class="text-muted">Items</label>
<div class="table-responsive">
    <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col"><input type="checkbox" name=""></th>
              <th scope="col" class="w-30">Item Code</th>
              <th scope="col">Qty</th>
              <th scope="col">UOM</th>
               <th scope="col">Rate</th>
              <th scope="col">Amount</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><input type="checkbox"> 1</th>
              <td><a href="#modmaterials" data-toggle="modal" role="button"  style="color: black">Mtl-Bar-12377sadh123g</a></td>
              <td>1</td>
              <td>Millimiter</td>
              <td><span class="fas fa-ruble-sign">. 0.00</span></td>
              <td><span class="fas fa-ruble-sign text-muted">. 0.00</span></td>
              <td><span class="fas fa-caret-down"></span></td>
            </tr>
            <tr>
              <th scope="row"><input type="checkbox"> 2</th>
              <td><a href="#modmaterials" data-toggle="modal" role="button" style="color: black">Mtl-Bar-12397sahdohouqw</a></td>
              <td>69</td>
              <td>Millimiter</td>
              <td><span class="fas fa-ruble-sign">. 0.00</span></td>
              <td><span class="fas fa-ruble-sign text-muted">. 0.00</span></td>
              <td><span class="fas fa-caret-down" style="color: black"></span></td>
            </tr>
            <tr>
              <th scope="row"><input type="checkbox"> 3</th>
              <td><a href="#modmaterials" data-toggle="modal" role="button" style="color: black">Mtl-Bar-123869asdgh</a></td>
              <td>160</td>
              <td>Millimiter</td>
              <td><span class="fas fa-ruble-sign">. 0.00</span></td>
              <td><span class="fas fa-ruble-sign text-muted">. 0.00</span></td>
              <td><span class="fas fa-caret-down"></span></td>
            </tr>
          </tbody>
    </table>

            </div>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="modmaterials" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editing Row #1</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="card-body">
        <div class="row">
          <div class="container col-lg-6">
              <form>
                  <div class="form-group">
                    <label for="itemCode" class="text-muted">Item Code</label>
                    <input type="text" class="form-control" id="itemCode" style="font-weight: 800">
                  </div>
                  <div class="form-group">
                    <label for="itemName" class="text-muted">Item Name</label>
                    <input type="text" class="form-control" id="itemName" style="font-weight: 800">
                  </div>
              </form>
          </div> 
          <div class="col-lg-6">
               <form>
                    <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="check1">
                     <label class="form-check-label text-muted" for="check1">Allow Alternative Item</label>
                    </div>
               </form>
          </div>
          </div>
        </div>

        <div class="border-top my-3"></div>

        <div class="card-body">
            <label class="text-muted">Quantity and Rate</label>
        <div class="row">
          <div class="container col-lg-6">
              <form>
                  <div class="form-group">
                    <label for="Qtymodal" class="text-muted">QTY</label>
                    <input type="text" class="form-control" id="Qtymodal" style="font-weight: 800">
                  </div>
                  <div class="form-group">
                    <label for="UOMmodal" class="text-muted">UOM</label>
                    <input type="text" class="form-control" id="UOMmodal" style="font-weight: 800">
                  </div>
              </form>
          </div> 
          <div class="col-lg-6">
               <form>
                    <div class="form-group">
                    <label for="stckQtymodal" class="text-muted">Stock QTY</label>
                    <input type="text" class="form-control" id="stckQtymodal" style="font-weight: 800">
                  </div>
                  <div class="form-group">
                    <label for="stckUOMmodal" class="text-muted">Stock UOM</label>
                    <input type="text" class="form-control" id="stckUOMmodal" style="font-weight: 800">
                  </div>
                  <div class="form-group">
                    <label for="convfact" class="text-muted">Conversion Factor</label>
                    <input type="text" class="form-control" id="convfact" style="font-weight: 800">
                  </div>
               </form>
          </div>
          </div>
        </div> 

        <div class="border-top my-3"></div>

        <div class="card-body">
            <label class="text-muted">Rate & Amount</label>
            <div class="row">
                <div class="container col-lg-6">
                    <form>
                        <div class="form-group">
                            <label for="rte" class="text-muted">Rate (PHP)</label>
                            <input type="text" class="form-control" id="rte" style="font-weight: 800">
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form>
                        <div class="form-group">
                            <label for="amnt" class="text-muted">Amount (PHP)</label>
                            <input type="text" class="form-control" id="amnt" style="font-weight: 800">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="border-top my-3"></div>

        <div class="card-body">
            <label class="text-muted">Scrap %</label>
            <div class="row">
                <div class="container col-lg-6">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="scrp" style="font-weight: 800">
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    
                </div>
            </div>
        </div>


        <div class="border-top my-3"></div>

         <div class="card-body">
            <div class="row">
                <div class="container col-lg-6">
                    <form>
                        <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="modchck">
                                    <label class="form-check-label" for="modchck">Include item in Manufacturing</label>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    
                </div>
            </div>
        </div>

       </div>
        
      
      <div class="modal-footer">
        <button type="button" class="btn btn-light">Insert Below</button>
      </div>
    </div>
  </div>
</div>


