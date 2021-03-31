// Function that is called whenever the user presses "add row" in the materialrequest form
function addSaleTaxRow(){
    if($('#contentSalesTaxes').find('#no-data')[0]){
        $('#contentSalesTaxes').find('#no-data').parents('tr').remove();
    }
    let lastRow = $('#salestaxes tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#salestaxes').append(
    `<tr data-id="${nextID}">
        
        <td id="mr-code-input-${nextID}" class="mr-code-input">
        <div class="row">
        <div class="col-11">
        <input type="text" name="Shipping_Amount" class="form-control">
        </div>
        <div class="col-1">
        <i class="fa fa-minus" aria-hidden="true" onclick="$(this).parents('tr').remove()"></i>
        </a>
        </div>
        </div>
        </td>
    </tr>`);

}
