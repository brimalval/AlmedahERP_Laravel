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
<div class="p-3">
    <div class="card my-2">
        <div class="card-header bg-light">
          <div class="float-right">
            <div class="dropdown">
            <a class="dropdown-toggle btn btn-outline-light text-muted shadow-sm " href="#"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Get Items From
            </a>
            <div class="dropdown-menu col-2">
            <a class="dropdown-item" data-toggle="modal" data-target="#st_modal">Stock Transfer</a>
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
          <h5 class="pb-3">Items</h5>
          <table class="table table-bom border-bottom">
              <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                      <td>
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input">
                          </div>
                      </td>
                      <td>Item Code</td>
                      <td>Quantity Transferred</td>
                      <td>Quantity To Return</td>
                      <td>Consumable</td>
                      <td>Source Station</td>
                      <td>Target Station</td>
                      <td>Item Condition</td>
                      <td>Remarks</td>
                  </tr>
                </thead>
                <tbody id="itemsTrans">

                </tbody>
   
                </table>
                {{-- <div class="container">
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
                </div> --}}
        </div>

        <hr>
        <div class="card-body filter">
          <h5 class="pb-3">Items to be Returned</h5>
          <table class="table table-bom border-bottom">
              <thead class="border-top border-bottom bg-light">
                  <tr class="text-muted">
                      <td>
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input">
                          </div>
                      </td>
                      <td>Item Code</td>
                      <td>Quantity to Return</td>
                      {{-- <td>Quantity To Return</td> --}}
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
                {{-- <div class="container">
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
                </div> --}}
        </div>

    </div>
    </div>
    <div class="modal fade" id="remarks" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title pr-1">Write Remarks for </h5>
            <h5 class="modal-title" id="itemCodeRemark"> </h5>
            <button type="button" class="close" onclick="$('#remarks').modal('toggle')">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <textarea class="form-control" name="" id="remarkText" rows="6"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="submitRemark()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="st_modal" tabindex="-1" role="dialog" aria-labelledby="st_modal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Stock Transfer</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <table id="suppQuotationTable" class="table table-striped table-bordered hover" style="width:100%">
                      <thead>
                          <tr>
                              <th>Tracking ID</th>
                              <th>Materials Ordered ID</th>
                              <th>Employee ID</th>
                              <th>Move Date</th>
                              <th>Transfer Status</th>
                              <th>Items</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($stock_transfer as $index=>$st)
                              <tr>
                                  <td class="text-bold">{{ $st->tracking_id }}</td>
                                  <td>{{ $stock_moves[$index]->mat_ordered_id }}</td>
                                  <td>{{ $stock_moves[$index]->employee_id }}</td>
                                  <td>{{ $st->move_date }}</td>
                                  <td>{{ $st->transfer_status }}</td>   
                                  <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                          data-toggle="modal" data-target="#sto_itemListView" onclick="viewStockTransferItems({{$st->id}});">View</button></td>
                                  <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                          data-dismiss="modal"
                                          onclick="showItemsNew(`{{ $st->mat_ordered_id }}`)">Select</button></td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="sto_itemListView" tabindex="-1" role="dialog" aria-labelledby="sto_itemListView"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="stockTransfer_itemList" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Quantity Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--
                        <tr>
                            <td class="text-bold">4</td>
                            <td class="text-bold">Sample Item</td>
                            <td>300</td>
                            <td>100</td>
                            <td>33%</td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

      // $(".checkbox").change(function() {
      //     if(this.checked) {
      //         alert('woohoo');
      //     }
      // });

    

      showMessage();
      $('#addStockMovesReturnForm').on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        let qtyToReturn;
        var formData = new FormData(this);
          $('input:checkbox:checked', tableControl).each(function(index) {
              let obj; 
              let itemTransPassValue;
              let currentRow = $(this).closest('tr');
              let itemCode = currentRow.find('td:nth-child(2)').html();
              // let qtyTransferred = currentRow.find('td:nth-child(3)').html();
              // let consumable = currentRow.find('td:nth-child(4)').html();
              // let sourceStation = currentRow.find('td:nth-child(5)').html();
              // let targetStation = currentRow.find('td:nth-child(6)').html();
              // let itemCondition = currentRow.find('td:nth-child(7)').html();
              passValueArray.forEach((itemTrans, index)=>{
                if(itemTrans.item_code === itemCode){
                  // if(itemTrans.consumable == 'Yes' && itemTrans.qty_received < itemTrans.qty_checker){
                    
                    let newQtyTransferred = itemTrans.qty_checker - itemTrans.qty_received; 
                    qtyToReturn = itemTrans.qty_received;
                    itemsTrans[index].qty_received = newQtyTransferred; 
                    // itemTrans.qty_received = newQtyTransferred;
                  // }else{
                  //   qtyToReturn = itemTrans.qty_received;
                  //   itemsTrans[index].qty_received = qtyToReturn; 
                  // }

                  obj = {
                      'item_code':itemCode, 
                      'qty_transferred': qtyToReturn, 
                      'consumable': itemTrans.consumable, 
                      'source_station': itemTrans.source_station, 
                      'target_station': itemTrans.target_station, 
                      'item_condition': itemTrans.item_condition,
                      'remarks': itemTrans.remarks
                    }
                }
              });
              
              let findSameItemInReturn = itemsRet.find(itemRet=>{
                return itemRet.item_code === obj.item_code;
              });
              console.log(findSameItemInReturn);
              console.log(obj);
              if(findSameItemInReturn){
                let value = parseInt(findSameItemInReturn.qty_transferred) + parseInt(obj.qty_transferred);
                findSameItemInReturn.qty_transferred = value;
              }else{
                itemsRet.push(obj);
              }
              changed = true;
          }).get();

          showMessage();

          console.log('before');
          console.log(itemsRet);
          console.log(itemsTrans);

          itemsRet.forEach((ArrItem)=>{
            itemsTrans.forEach((item, index)=>{ 
              if(ArrItem.item_code === item.item_code){
                if(item.qty_checker == ArrItem.qty_transferred){
                  itemsTrans.splice(index, 1)
                }
              }
            });
          });  
          
          console.log('after');
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
