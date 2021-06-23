
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
      <div class="container-fluid">
            <h2 class="navbar-brand" style="font-size: 35px;">Stock Moves Transfer</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown li-bom">
                    </li>
                  <li class="nav-item li-bom">
                      <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadStockMoves()">Cancel</button>
                  </li>

              </ul>
          </div>
      </div>
  </nav>
  <div class="d-flex">
    <div class="col-1">
      <button class="btn btn-primary" id="confirmStockTransfer" type="submit" onclick="" >Submit</button>
    </div>
    <div class="col-1">
      <button class="btn btn-primary" type="submit" form="addStockMovesForm" onclick="" >Save</button>
    </div>
  </div>

  <div class="alert alert-success alert-dismissible" id="new-stock-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  </div>
  <div class="alert alert-danger alert-dismissible" id="new-stock-danger" style="display:none;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  </div>
  <div class="container">
      <div class="card my-2">
          <div class="card-header bg-light">
            <div class="float-right">
              <div class="dropdown">
              <a class="dropdown-toggle btn btn-outline-light text-muted shadow-sm " href="#"  
                 role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdownMenuLinkNew">
                Get Items From
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkNew">
                <!--<li><a class="dropdown-item" href="#">Product Bundle</a></li>-->
                <li><a class="dropdown-item" data-toggle="modal" data-target="#mo_modal">Materials Ordered</a>
                </li>
                <!--<li><a class="dropdown-item" href="#">Supplier Quotation</a></li>-->
              </ul>
            </div>
            </div>
          </div>
          <div class="card-body filter">
            <form action="" id="addStockMovesForm">
              @csrf
                <div class="row">
                  <div class="col">
                    <label for="">Tracking ID</label>
                    <input type="text" name='tracking_id' id="tracking_id" class="form-control" placeholder="Tracking ID" value="">
                  </div>
                  <div class="col">
                    <label for="">Move Date</label>
                    <input type="date" name='move_date' id="move_date" class="form-control" placeholder="Move Date" value="" required>
                  </div>
                </div>
                <div class="row">
                    <div class="col-6">
                      <label for="">Stock Moves Type</label>
                      <input type="text" name='stock_moves_type' id="stock_moves_type" class="form-control" placeholder="" value="Transfer" readonly>
                    </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="">Materials Ordered ID</label>
                    <input list="materials_ordered" id="mat_ordered_id" name='mat_ordered_id' class="form-control" placeholder="Materials Ordered ID" value="" onchange="showItemsNew(this.value)" required>
                      <datalist id="materials_ordered">
                          @foreach ($materials_ordered as $row)
                              <option value="{{ $row->mat_ordered_id }}"> {{ $row->mat_ordered_id}}
                                </option>
                          @endforeach
                          <option value=" + Add new">
                      </datalist>
                  </div>
                </div>
                <div class="row">
                    <div class="col-6">
                      <label for="">Employee ID</label>
                      <input list="employees" id="employee_id" name='employee_id' class="form-control" placeholder="Employee ID" value="" required>
                      <datalist id="employees">
                          @foreach ($employees as $row)
                              <option value="{{ $row->employee_id }}"> {{ $row->last_name }}
                                  {{ $row->first_name }} </option>
                          @endforeach
                          <option value=" + Add new">
                      </datalist>
                    </div>
                </div>
              </form>
            </div>
          <hr>
          <div class="card-body filter">
            <h5>Items</h5>
            <table class="table table-bom border-bottom" >
                <thead class="border-top border-bottom bg-light">
                    <tr class="text-muted">
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>Item Code</td>
                        <td>Quantity to Transfer</td>
                        <td>Consumable</td>
                        <td>Source Station</td>
                        <td>Target Station</td>
                        <td >Item Condition</td>
                    </tr>
                  </thead>
                  <tbody id="items">

                  </tbody>
     
                  </table>
                  <center id="emptyMat">
                    No items selected for Transfer
                  </center>
                  <div class="container" id="addDeleteButtons">
                    <div class="row-12">
                      <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-none" id="newStockAddRow">
                          Add Row
                      </button>
                      <button class="btn btn-outline-light btn-sm text-muted shadow-sm float-right" id="deleteSel">
                          Delete selected rows
                      </button>
                    </div>
                  </div>
          </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="mo_modal" tabindex="-1" role="dialog" aria-labelledby="mo_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Materials Ordered</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="suppQuotationTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Materials Ordered ID</th>
                            <th>Supplier</th>
                            <th>Item List</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials_ordered as $mat)
                            <tr>
                                <td class="text-bold">{{ $mat->mat_ordered_id }}</td>
                                <td>{{ $mat->p_receipt_id }}</td>
                                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                        data-toggle="modal" data-target="#mto_itemListView" onclick="viewMatOrderedItems({{$mat->id}})">View</button></td>
                                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                        data-dismiss="modal"
                                        onclick="showItemsNew(`{{ $mat->mat_ordered_id }}`)">Select</button></td>
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

<div class="modal fade" id="mto_itemListView" tabindex="-1" role="dialog" aria-labelledby="mto_itemListView"
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
                <table id="matOrder_itemList" class="table table-striped table-bordered hover" style="width:100%">
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

<script>
  let items = []; 
  let itemsDel = [];
  let sameSourceTargetStationBool = false;
  $("#mat_ordered_id").change(function(){
    if($("#mat_ordered_id").val().trim() === ''){
      $("#addDeleteButtons").show();
      $("#emptyMat").show();
    }else{
      $("#addDeleteButtons").hide();
      $("#emptyMat").hide();
    }
  });

  function checkTableRowExists(){
    let itemsLength = $("#items tr").length;
    if(itemsLength == 0){
      $("#emptyMat").show();
    }else{
      $("#emptyMat").hide();
    }
  }

  $("#confirmStockTransfer").on('click', function(e){
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    let tracking_id = $("#tracking_id").val();
    var formData = new FormData($("#addStockMovesForm")[0]);
    console.log("items");
    console.log(items);
    let item_code = JSON.stringify(items);
    if(sameSourceTargetStationBool){
      $('#new-stock-danger').show()
      $('#new-stock-danger').html('Raw Material has the same Source and Target Station');
      $('#new-stock-danger').delay(4000).hide(1);
    }else{
      $.ajax({
            type:'POST',
            url:"/confirmStockTransfer/"+tracking_id,
            data: {item_code: item_code},
            success: function(data) {
                console.log(data);
                $('#new-stock-success').show()
                $('#new-stock-success').html('Successfully Transferred Stocks');
                $('#new-stock-success').delay(4000).hide(1);
            }
        });
    }
  });

  $('#addStockMovesForm').on('submit', function(e){
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    // if(sameSourceTargetStationBool){
    //   $('#new-stock-danger').show()
    //   $('#new-stock-danger').html('Raw Material has the same Source and Target Station');
    //   $('#new-stock-danger').delay(4000).hide(1);
    // }else{
      var formData = new FormData(this);
      console.log('items');
      console.log(items);
      formData.append("item_code", JSON.stringify(items));
      $.ajax({
            type:'POST',
            url:"/create-newstockmoves",
            data: formData, 
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                $('#new-stock-success').show()
                $('#new-stock-success').html('Successfully created a new Stock Move');
                $('#new-stock-success').delay(4000).hide(1);
            },
            error: function(data) {

                $('#new-stock-danger').show()
                $('#new-stock-danger').html('Material ordered already has a Stock Move');
                $('#new-stock-danger').delay(4000).hide(1);
                console.log("error");
                console.log(data);
            }
        });
    // }
  });

  function onChangeRawMaterial(itemCode, el){
    let item_exists = false;
    let obj = { 'item_code': itemCode, 
                'qty_received': 'test', 
                'source_station': 'test', 
                'target_station': 'test',
                'consumable' : 'true',
                'item_condition' : 'good',
                'transfer_status' : 'pending',
              }
    items.forEach(item=>{
      if(item.item_code === itemCode){
        item_exists = true;
        $('#new-stock-danger').show()
        $('#new-stock-danger').html('Material already exists!');
        $('#new-stock-danger').delay(4000).hide(1);
        $(el).val('');
      }
    });
    if(!item_exists){
      items.push(obj);
      $(el).attr('readonly', true);
      $("#mat_ordered_id").attr('readonly', true);
    }
    console.log(items);
  }

  function onChangeItemCondition(itemCondition, el){
    let currentRow = $(el).closest('tr');
    let itemCodeFound = currentRow.find('td:nth-child(2)').html();
    items.forEach(item=>{
      if(itemCodeFound === item.item_code){
        item.item_condition = itemCondition;
      }
    });
    console.log(items);
  }

  function onChangeSourceStation(sourceStation, el){
    let currentRow = $(el).closest('tr');
    let itemCodeFound = currentRow.find('td:nth-child(2)').html();
    items.forEach(item=>{
      if(itemCodeFound === item.item_code){
        item.source_station = sourceStation;
      }
    });
    sameSourceTargetStation();
    console.log(items);
  }

  function sameSourceTargetStation(){
    sameSourceTargetStationBool = false;
    items.forEach(item=>{
      if(item.source_station == item.target_station){
        sameSourceTargetStationBool = true;
        return sameSourceTargetStationBool;
      }
    });
    return sameSourceTargetStationBool;
  }

  $("#newStockAddRow").on("click", function(){
    let itemsTable = $("#items");
    itemsTable.append(
        `<tr><td>
              <div class="form-check">
                  <input type="checkbox" class="form-check-input">
              </div>
          </td>
          <td><input list="new_raw_materials" onchange="onChangeRawMaterial(this.value, this)"  class="form-control" required>
            <datalist id="new_raw_materials">
                @foreach ($raw_materials as $row)
                      <option value="{{ $row->item_code }}"> {{ $row->item_code}}</option>
                @endforeach
                <option value=" + Add new">
            </datalist></td>
        <td>Qty Received</td>
        <td>Consumable</td>
        <td>Source_Station</td>
        <td>Target Station</td>
        <td>Item_Condition</td></tr>`
    );
    // items.add
    $("#emptyMat").hide();
  });


  function showItemsNew(matOrderedId){
    $("#items").empty();
    let itemsTable = $("#items");
    items = [];
    $.ajax({
            type:'GET',
            url:"/showItemsNew/"+matOrderedId,
            success: function(data) {
                $('#mat_ordered_id').val(matOrderedId);
                console.log(data['mat_ordered']);

               
                JSON.parse(data['mat_ordered'].items_list_received).forEach((item,index) => {
                  itemsTable.append(
                    `<tr><td>
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input">
                          </div>
                      </td>
                      <td>` +item.item_code +`</td>
                    <td>` +item.qty_received +`</td>
                    <td>`+(data['consumable_data'][index] == 1 ? 'Yes' : 'No' )+`</td>
                    <td><label for="source_station"></label>
                      <select id="source_station" onchange="onChangeSourceStation(this.value, this)">
                        @foreach ($stations as $station)
                          <option value="{{ $station->station_name }}">{{ $station->station_name }}</option>
                        @endforeach
                      </select></td>
                    <td>`+data['station_name']+`</td>
                    <td><label for="item_condition"></label>
                      <select id="item_condition" onchange="onChangeItemCondition(this.value, this)">
                        <option value="new">New</option>
                        <option value="good">Good</option>
                        <option value="damaged">Damaged</option>
                      </select></td></tr>`
                  );
                  let obj = { 'item_code': item.item_code, 
                              'qty_received': item.qty_received, 
                              'source_station': $('#source_station').val(), 
                              'target_station': data['station_name'],
                              'consumable' : (data['consumable_data'][index] == 1 ? 'Yes' : 'No' ),
                              'item_condition' : 'New',
                              'transfer_status' : 'pending',
                            }
                  items.push(obj);
                  sameSourceTargetStation();
                });
            },
            error: function(data) {
                console.log("error");
                console.log(data);
            }
        });
        $("#emptyMat").hide();
  }

  function viewMatOrderedItems(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        type: "GET",
        url: `/view-mo-items/${id}`,
        data: id,
        processData: false,
        contentType: false,
        success: function (response) {
            let table = $("#matOrder_itemList tbody");
            $("#matOrder_itemList tbody tr").remove();
            let items = JSON.parse(response);
            items.forEach((item)=>{
                  table.append(
                    `
                    <tr>
                        <td>${item.item_code}</td>
                        <td>${item.qty_received}</td>
                    </tr>
                    `
                );
            })
        }
    });

  }

  function viewStockTransferItems(id) {
        alert('tite');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: "GET",
            url: `/view-st-items/${id}`,
            data: id,
            processData: false,
            contentType: false,
            success: function (response) {
                let table = $("#stockTransfer_itemList tbody");
                $("#stockTransfer_itemList tbody tr").remove();
                let items = JSON.parse(response);
                items.forEach((item)=>{
                      table.append(
                        `
                        <tr>
                            <td>${item.item_code}</td>
                            <td>${item.qty_received}</td>
                        </tr>
                        `
                    );
                })
            }
        });
      }

  $('#deleteSel').on('click', function(e) {
        let tableControl= document.getElementById('items');
        e.preventDefault();
          $('input:checkbox:checked', tableControl).each(function(index) {
              let obj; 
              let currentRow = $(this).closest('tr');
              let itemCode = currentRow.find('td:nth-child(2) input').val();
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
              itemsDel.push(obj);
              $(this).closest("tr").remove();
          }).get();

          itemsDel.forEach((ArrItem)=>{
            items.forEach((item, index)=>{ 
              if(ArrItem.item_code === item.item_code){
                items.splice(index, 1)
              }
            });
          }); 

          console.log(items);
    });
</script>