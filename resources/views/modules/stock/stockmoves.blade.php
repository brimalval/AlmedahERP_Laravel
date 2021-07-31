
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Stock Moves</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadStockMoves()">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit" onclick="loadNewStockMoves(null)">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card my-2 p-4"> 
        <div class="card-body filter">
            <div class="row">
                <div class=" ml-auto float-right">
                    <span class="text-muted ">Last Modified On</span>
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <table id="stockMovesTable" class="table table-striped table-bordered hover" style="width:100%">
            <thead>
                <tr>
                    <td>Tracking ID</td>
                    <td>Stock Moves Type</td>
                    <td>Materials Ordered ID</td>
                    <td>Employee ID</td>
                    <td>Move Date</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockmoves as $row)
                    <tr id="<?=$row["id"]?>">
                        <td class="text-black-50"><a href="javascript:loadNewStockMoves(`<?=$row["tracking_id"]?>`)"><?=$row["tracking_id"]?></a></td>
                        <td class="text-black-50"><?=$row["stock_moves_type"]?></td>
                        <td class="text-black-50"><?=$row["mat_ordered_id"]?></td>
                        <td class="text-black-50"><?=$row["employee_id"]?></td>
                        <td class="text-black-50"><?=$row["move_date"]?></td>
                        <td class="text-black-50"><?=$row["status"]?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions
                                </button>
                                <ul class="align-content-center dropdown-menu p-0" style="background: 0; min-width:125px;" role="menu">
                                    @if($row["status"] == 'Successfully Transferred' || $row["status"] == 'Pending (Return)' || $row["status"] == 'Successfully Returned')
                                        <li id="returnItemsList">
                                            <button class="btn-sm btn-primary" type="submit" onclick="getStockData(this)">Return Items</button>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </div>
    <div class="row">
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-left"></span></button>
        </div>
        <div class="col-1 text-center">
            <p>1 of 1</p>
        </div>
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#stockMovesTable').DataTable();
    });

    function getStockData(button){
        let currentRow = $(button).closest("tr");
        let trackingId = currentRow.find('td:eq(0)').text();
        let stockMovesType = currentRow.find('td:eq(1)').text();
        let matOrderedId = currentRow.find('td:eq(2)').text();
        let employeeId = currentRow.find('td:eq(3)').text();
        let moveDate = currentRow.find('td:eq(4)').text();
        let status = currentRow.find('td:eq(5)').text();
        loadStockReturnInfo(trackingId, stockMovesType, matOrderedId, employeeId, moveDate, status);
    }

    function showItems(matOrderedId){
        $("#itemsRet").empty();
        let itemsTable = $("#itemsRet");
        items = [];
        $.ajax({
                type:'GET',
                url:"/showItems/"+matOrderedId,
                success: function(data) {
                    console.log(data['mat_ordered']);
                    let items_list_received = JSON.parse(data['mat_ordered'].items_list_received);
                    items_list_received.forEach((item) => {
                    let obj = { 'item_code': item.item_code, 
                                'qty_received': item.qty_received, 
                                'source_station': 'ex', 
                                'target_station': data['station_name'],
                                'consumable' : 'true',
                                'item_condition' : 'good',
                                'transfer_status' : 'pending',
                                }
                    items.push(obj);
                    });
                    JSON.parse(data['mat_ordered'].items_list_received).forEach((item) => {
                    itemsTable.append(
                        `<tr><td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>` +item.item_code +`</td>
                        <td>` +item.qty_received +`</td>
                        <td>Consumable</td>
                        <td>Source_Station</td>
                        <td>`+data['station_name']+`</td>
                        <td>Item_Condition</td></tr>`
                    );
                    });
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
  }

    function stockMovesInfo(){

    }
</script>
