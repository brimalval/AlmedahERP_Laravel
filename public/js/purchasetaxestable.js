
function addnewRow(){
    if($('#contentPurchaseTaxes').find('#no-data')[0]){
        $('#contentPurchaseTaxes').find('#no-data').parents('tr').remove();
    }
    let lastRow = $('#purchasetaxes-table tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#purchasetaxes-table').append(
    `<tr data-id="${nextID}">
    <td id="mr-code-input-${nextID}" class="mr-code-input"> <input type="text" name="Tax_type" class="form-control"></td>
    <td id="mr-code-input-${nextID}" class="mr-code-input"> <input type="text" name="account_head" class="form-control"></td>
    <td id="mr-code-input-${nextID}" class="mr-code-input"> <input placeholder="12" type="number" name="Rate" class="form-control"></td>
    <td id="mr-code-input-${nextID}" class="mr-code-input"> <input placeholder="P 0.00" type="number" name="Tax_Amount" class="form-control"></td>
    <td id="mr-code-input-${nextID}" class="mr-code-input"> <input placeholder="P 0.00" type="number" name="Tax_Total" class="form-control"></td>    
    <td>
        
        <i class="fa fa-minus" aria-hidden="true" onclick="$(this).parents('tr').remove()"></i>
       
    </td>
    </tr>`);
}