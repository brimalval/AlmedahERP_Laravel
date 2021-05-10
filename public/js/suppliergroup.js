// Function that is called whenever the user presses "add row" in the materialrequest form
function addNewSuppGrpTableRow(){
    if($('#contentNewSupplierGrpTable').find('#no-data')[0]){
        $('#contentNewSupplierGrpTable').find('#no-data').parents('tr').remove();
    }
    let lastRow = $('#newsuppliergrptable tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#newsuppliergrptable').append(
    `<tr data-id="${nextID}">
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="Shipping_Amount" class="form-control"></td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="Shipping_Amount" class="form-control"></td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="Shipping_Amount" class="form-control"></td>
        <td>
        <i class="fa fa-edit" aria-hidden="true" data-toggle="modal" data-target="#editAccountModal"></i>
        <i class="fa fa-minus" aria-hidden="true" onclick="$(this).parents('tr').remove()"></i>
        </td>
    </tr>`);

}
