// Function that is called whenever the user presses "add row" in the materialrequest form
function addSalesTaxRow(){
    if($('#contentSalesTaxes').find('#no-data')[0]){
        $('#contentSalesTaxes').find('#no-data').parents('tr').remove();
    }
    let lastRow = $('#salestaxes tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#salestaxes').append(
    `<tr data-id="${nextID}">
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="" class="form-control"></td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="" class="form-control"></td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="" class="form-control"></td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="" class="form-control"></td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="" class="form-control"></td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"><input type="text" name="" class="form-control"></td>
        <td>
        <i class="fa fa-edit" aria-hidden="true" data-toggle="modal" data-target="#editSalesTaxesModal"></i>
        <i class="fa fa-minus" aria-hidden="true" onclick="$(this).parents('tr').remove()"></i>
        </td>
    </tr>`);

}
