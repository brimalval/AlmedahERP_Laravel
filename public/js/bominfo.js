function addRowoperations(){
    if($('#no-data')[0]){
        deleteItemRow($('#no-data').parents('tr'));
    }
    let lastRow = $('#operations-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#operations-input-rows').append(
    `<tr data-id="${nextID}">
        <td class="text-center">
        
        <div class="form-check" >
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly name="Operation_name" id="Operation_name" class="form-control"></td>
        <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly name="D_workcenter" id="D_workcenter" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Desc" id="Desc" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Operation_Time" id="Operation_Time" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Operation_cost" id="Operation_cost" class="form-control"></td>

        <td>
            <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#" role="button">
                <i class="fa fa-edit" aria-hidden="true"></i>
            </a>
            <a id="" class="btn delete-btn" href="#" role="button">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
    </tr>`);
    $('#selects select[data-id="item_code"]').clone().appendTo(`#items-tbl tr:last .mr-code-input`).selectpicker();
    $('#selects select[data-id="station_id"]').clone().appendTo(`#items-tbl tr:last .mr-target-input`).selectpicker();
    $('#selects select[data-id="uom_id"]').clone().appendTo(`#items-tbl tr:last .mr-unit-input`).selectpicker();
    $('#items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
}
function addRowmaterials(){
    if($('#no-data')[0]){
        deleteItemRow($('#no-data').parents('tr'));
    }
    let lastRow = $('#materials-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#materials-input-rows').append(
    `                <tr data-id="${nextID}">
    <td class="text-center">
    
    <div class="form-check" >
        <input type="checkbox" class="form-check-input">
    </div>
    </td>
    <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly name="No" id="No" class="form-control"></td>
    <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly name="ItemCode" id="ItemCode" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Quantity" id="Quantity" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="UOM" id="UOM" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Rate" id="Rate" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Amount" id="Amount" class="form-control"></td>   
    <td>
        <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#" role="button">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
        <a id="" class="btn delete-btn" href="#" role="button">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>`);
    $('#selects select[data-id="item_code"]').clone().appendTo(`#items-tbl tr:last .mr-code-input`).selectpicker();
    $('#selects select[data-id="station_id"]').clone().appendTo(`#items-tbl tr:last .mr-target-input`).selectpicker();
    $('#selects select[data-id="uom_id"]').clone().appendTo(`#items-tbl tr:last .mr-unit-input`).selectpicker();
    $('#items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
}
$(document).ready(function() {
    $('#table_operations').DataTable();
} );
$(document).ready(function() {
    $('#table_materials').DataTable();
} );
$(document).ready(function() {
    $('#table_costing').DataTable();
} );