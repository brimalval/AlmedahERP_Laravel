<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Stock Moves</h2>
          <h2 class="navbar-brand" style="font-size: 35px;">Return</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#saveCancelButtons" aria-controls="saveCancelButtons" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="saveCancelButtons">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                  </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadStockMoves()">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit" form="addStockMovesReturnForm" id="saveRet">Save</button>
                </li>
            </ul>
        </div>
        <button class="btn btn-refresh ml-auto" id="backButton" style="background-color: #d9dbdb; display:none" type="submit" onclick="loadStockMoves()">Back</button>
    </div>
</nav>
<div class="alert alert-success alert-dismissible" id="ret-stock-success" style="display:none;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
</div>
<div class="alert alert-danger alert-dismissible" id="ret-stock-danger" style="display:none;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
</div>
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
          <form action="" id="addStockMovesReturnForm">
            @csrf
            <div class="row">
              <div class="col">
                <label for="">Tracking ID</label>
                <input type="text" class="form-control" id="tracking_id_ret" name="tracking_id" readonly>
              </div>
              <div class="col">
                <label for="">Move Date</label>
                <input type="text" class="form-control" id="move_date_ret" readonly>
              </div>
              </div>
              <div class="row">
                  <div class="col-6">
                    <label for="">Stock Moves Type</label>
                    <input type="text" class="form-control" id="stock_moves_type_ret" readonly>
                  </div>
                  <div class="col-6">
                    <label for="">Return Date</label>
                    <input type="date" class="form-control" name="return_date" id="return_date_ret" required>
                  </div>
              </div>
              <div class="row">
                  <div class="col-6">
                    <label for="">Materials Ordered ID</label>
                    <input type="text" class="form-control" id="mat_ordered_id_ret" readonly>
                  </div>
                </div>
                <div class="row">
                    <div class="col-6">
                      <label for="">Employee ID</label>
                      <input type="text" class="form-control" id="employee_id_ret" placeholder="Employee ID" value="" readonly>
                    </div>
                </div>
              </form>
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
                <tbody id="itemsTrans">

                </tbody>
   
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

        <hr>
        <div class="card-body filter">
          <h5>Items to be Returned</h5>
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
                <tbody id="itemsRet">

                </tbody>

                </table>
                <center id="emptyMatRet">
                  There are no items to be returned 
                </center>
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

    <script>
      $(document).ready(function() {
      var tableControl= document.getElementById('itemsTrans');
      // var arrayOfValues = [];
      let itemsTable = $("#itemsToBeRet");
      let changed = false;
      
      function showMessage(){
        if(itemsRet === null && arrayOfValues.length == 0){
          $("#emptyMatRet").show();
        }else{
          $("#emptyMatRet").hide();
        } 
      }

      showMessage();
      $('#addStockMovesReturnForm').on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData(this);
          $('input:checkbox:checked', tableControl).each(function(index) {
              let obj; 
              let currentRow = $(this).closest('tr');
              let itemCode = currentRow.find('td:nth-child(2)').html();
              let qtyTransferred = currentRow.find('td:nth-child(3)').html();
              let consumable = currentRow.find('td:nth-child(4)').html();
              let sourceStation = currentRow.find('td:nth-child(5)').html();
              let targetStation = currentRow.find('td:nth-child(6)').html();
              let itemCondition = currentRow.find('td:nth-child(7)').html();
              obj = {
                      'item_code':itemCode, 
                      'qty_transferred': qtyTransferred, 
                      'consumable': consumable, 
                      'source_station': sourceStation, 
                      'target_station': targetStation, 
                      'item_condition': itemCondition
                    }
              itemsRet.push(obj);
              changed = true;
          }).get();

          showMessage();


          itemsRet.forEach((ArrItem)=>{
            itemsTrans.forEach((item, index)=>{ 
              if(ArrItem.item_code === item.item_code){
                itemsTrans.splice(index, 1)
              }
            });
          });  
          
          console.log(itemsRet);
          console.log(itemsTrans);

          if(changed){
            formData.append("item_code", JSON.stringify(itemsRet));
            formData.append("stockTransferItemsUpdated", JSON.stringify(itemsTrans));
            $.ajax({
              type:'POST',
              url:"/create-newstockmovesreturn",
              data: formData, 
              cache: false,
              contentType: false,
              processData: false,
              success: function(data) {
                  console.log(data);
                  $('#ret-stock-success').show()
                  $('#ret-stock-success').html('Successfully created a new Stock Return');
                  $('#ret-stock-success').delay(4000).hide(1);
              },
              error: function(data) {
                  console.log("error");
                  $('#ret-stock-danger').show()
                  $('#ret-stock-danger').html('No item selected to return');
                  $('#ret-stock-danger').delay(4000).hide(1);
                  console.log(data);
              }
            });

            itemsRet.forEach((item) => {
              itemsTable.append(
                `<tr><td>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input">
                      </div>
                  </td>
                  <td>` +item.item_code +`</td>
                <td>` +item.qty_transferred +`</td>
                <td>Consumable</td>
                <td>Source_Station</td>
                <td>`+item.target_station+`</td>
                <td>Item_Condition</td></tr>`
              );
            });
          }else{
            $('#ret-stock-danger').show()
            $('#ret-stock-danger').html('No item selected to return');
            $('#ret-stock-danger').delay(4000).hide(1);
          }
      });

    });
    </script>
