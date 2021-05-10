
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">New Stock Moves</h2>
          <h2 class="navbar-brand" style="font-size: 35px;">Transfer</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                  </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit" onclick="" >Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card my-2">
        <div class="card-header bg-light">
          <div class="float-right">
            <div class="dropdown">
            <a class="dropdown-toggle btn btn-outline-light text-muted shadow-sm " href="#"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Get Items From
            </a>
            <div class="dropdown-menu col-2">
            <a class="dropdown-item" href="#">Materials Ordered</a>
          </div>
          </div>
          </div>
        </div>
        <div class="card-body filter">
            <div class="row">
              <div class="col">
                <label for="">Tracking ID</label>
                <input type="text" class="form-control" placeholder="Tracking ID" value="">
              </div>
              <div class="col">
                <label for="">Move Date</label>
                <input type="text" class="form-control" placeholder="Move Date" value="">
              </div>
              </div>
              <div class="row">
                  <div class="col-6">
                    <label for="">Stock Moves Type</label>
                    <input type="text" class="form-control" placeholder="" value="Transfer" readonly>
                  </div>
              </div>
              <div class="row">
                  <div class="col-6">
                    <label for="">Materials Ordered ID</label>
                    <input type="text" class="form-control" placeholder="Materials Ordered ID" value="">
                  </div>
                </div>
                <div class="row">
                    <div class="col-6">
                      <label for="">Employee ID</label>
                      <input type="text" class="form-control" placeholder="Employee ID" value="">
                    </div>
                  </div>
            </div>
        <hr>
        <div class="card-body filter">
          <h5>Items</h5>
          <table class="table table-bom border-bottom">
              <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                      <td>
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input">
                          </div>
                      </td>
                      <td>Item Code</td>
                      <td>Quantity Transfered</td>
                      <td>Consumable</td>
                      <td>Source Station</td>
                      <td>Target Station</td>
                      <td >Item Condition</td>
                  </tr>
                </thead>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>Item code example</td>
                        <td>Quantity Transfered</td>
                        <td>
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                          </div>
                        </td>
                        <td>Sourcle Station ex</td>
                        <td>Target Station ex</td>
                        <td>Item Condition ex</td>
                    </tr>
                </table>
                <div class="container">
                  <div class="row-12">
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-left">
                      Add Multiple
                  </button>
                  <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-none">
                      Add Row
                  </button>
                <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-right">
                    Delete selected rows
                </button>
                  </div>
                </div>
        </div>

    </div>
    </div>

    </div>
