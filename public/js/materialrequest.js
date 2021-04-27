// Function that is called whenever the user presses "add row" in the materialrequest form
function addRow(){
    if($('#contentMaterialRequest').find('#no-data')[0]){
        $('#contentMaterialRequest').find('#no-data').parents('tr').remove();
    }
    let lastRow = $('#material-request-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#material-request-input-rows').append(
    `<tr data-id="${nextID}">
        <td>
        <div class="form-check">
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input-${nextID}" class="mr-code-input"></td>
        <td style="width: 10%;" class="mr-qty-input"><input required class="form-control" min="0" type="number" name="quantity_requested[]" id="mr-qty-input-row-${lastRow}"></td>
        <td class="mr-unit-input"></td>
        <td id="mr-target-input-${nextID}" class="mr-target-input"></td>
        <td style="width: 20%" class="mr-procurement-input">
        <select name="procurement_method[]" required class="form-control">
            <option value="buy">Buy</option>
            <option value="produce">Produce</option>
            <option value="buyproduce">Buy & Produce</option>
        </select>
        </td>
        <td>
            <button type="button" id="" class="btn item-edit-btn" role="button" onclick="openItemEditModal($(this).parents('tr'))">
                <i class="fa fa-caret-up" aria-hidden="true"></i>
            </button>
            <button type="button" id="" class="btn delete-btn" href="#" role="button" onclick="$(this).parents('tr').remove()">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </button>
        </td>
    </tr>`);
    $('#selects select[data-id="item_code"]').eq(0).clone().appendTo(`#items-tbl tr:last .mr-code-input`).selectpicker();
    $('#selects select[data-id="station_id"]').eq(0).clone().appendTo(`#items-tbl tr:last .mr-target-input`).selectpicker();
    $('#selects select[data-id="uom_id"]').eq(0).clone().appendTo(`#items-tbl tr:last .mr-unit-input`).selectpicker();
    $('#items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
}
// Opens the modal for editing an item
function openItemEditModal(row){
    // To ensure that we're selecting the correct elements, use the row
    // as a reference to find its parent tab and then use that parent tab
    // as a reference to find the element being referred to
    $(row).parents('.tab-pane').find('.editItemForm').data('target', row.data('id'));
    $(row).parents('.tab-pane').find('#itemEditModal').modal('show');
    let item_code = $(row).find('.selectpicker').val();
    $.get(`/inventory/${item_code}`, function(response, status){
        let uom_cf = response.material.uom.conversion_factor;
        let final_cf = ($(row).parents('.tab-pane').find('.edit-uom :selected').data('cf') / uom_cf).toFixed(2);
        $(row).parents('.tab-pane').find('.edit-stock-uom').val(response.material.uom.item_uom);
        $(row).parents('.tab-pane').find('.edit-stock-uom').data('cf', uom_cf);
        $(row).parents('.tab-pane').find('.edit-uom-cf').val(final_cf);
        $(row).parents('.tab-pane').find('.edit-stock-quantity').val(0);
        // Setting the edit fields into the values inputted in the main screen
        $(row).parents('.tab-pane').find('.edit-item-code').val(item_code).selectpicker('refresh');
        $(row).parents('.tab-pane').find('.edit-item-name').val(item_code).selectpicker('refresh');
        $(row).parents('.tab-pane').find('.edit-quantity').val($(row).find('.mr-qty-input input').val());
        $(row).parents('.tab-pane').find('.edit-uom').val($(row).find('.mr-unit-input .selectpicker').val()).trigger('change');
        $(row).parents('.tab-pane').find('.edit-station').val($(row).find('.mr-target-input .selectpicker').val()).selectpicker('refresh');
    });
}
// Delete form submission
$(document).on('submit', 'form.mr-delete-form', function(){
    let row = $(this).parents('tr');
    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            row.remove();
        },
        error: function(data){
            console.log("error");
        }
    });
    return false;
});
$('.selectpicker').each(function(index){
    $(this).selectpicker();
});
// Item row delete button functionality
$('body').off().on('click', '.delete-btn', function(e){
    e.preventDefault();
    $(this).parents('tr').remove();
});
// If the item code field changes in the item edit form
$('select.edit-item-code').on('change', function(){
    let newVal = $(this).val();
    let parentPane = $(this).parents('.tab-pane');
    console.log(newVal);
    parentPane.find('select.edit-item-name').val(newVal);
    parentPane.find('select.edit-item-name').selectpicker('refresh');
    $.get(`/inventory/${newVal}`, function(response, status){
        let uom_cf = response.material.uom.conversion_factor;
        let selected_cf = parentPane.find('select.edit-uom :selected').data('cf');
        let final_cf = (selected_cf / uom_cf).toFixed(2);
        let quantity = (parentPane.find('.edit-quantity').val() * final_cf).toFixed(2);
        parentPane.find('.edit-stock-uom').val(response.material.uom.item_uom);
        parentPane.find('.edit-stock-uom').data('cf', uom_cf);
        parentPane.find('.edit-uom-cf').val(final_cf);
        parentPane.find('.edit-stock-quantity').val(quantity);
    });
});
// If the item name field changes in the item edit form
$('select.edit-item-name').change(function(){
    let newVal = $(this).val();
    let parentPane = $(this).parents('.tab-pane');
    parentPane.find('select.edit-item-code').val(newVal);
    parentPane.find('select.edit-item-code').selectpicker('refresh');
    $.get(`/inventory/${newVal}`, function(response, status){
        let uom_cf = response.material.uom.conversion_factor;
        let selected_cf = parentPane.find('.edit-uom :selected').data('cf');
        let final_cf = (selected_cf / uom_cf).toFixed(2);
        let quantity = (parentPane.find('.edit-quantity').val() * final_cf).toFixed(2);
        parentPane.find('select.edit-stock-uom').val(response.material.uom.item_uom);
        parentPane.find('select.edit-stock-uom').data('cf', uom_cf);
        parentPane.find('.edit-uom-cf').val(final_cf);
        parentPane.find('.edit-stock-quantity').val(quantity);
    });
});
// Making sure that none of the buttons inside the form submit it,
// only the button outside of the form ("save" button) can submit
$('#mat-req button').each(function(index){
    $(this).attr('type', 'button');
});
$('.edit-uom').change(function(){
    let parentPane = $(this).parents('.tab-pane');
    let quantity = parentPane.find('.edit-quantity').val();
    let uom_cf = parentPane.find('.edit-stock-uom').data('cf');
    let selected_cf = parentPane.find('.edit-uom :selected').data('cf');
    
    let final_cf = (selected_cf / uom_cf).toFixed(2);
    parentPane.find('.edit-stock-quantity').val(quantity * final_cf);
    parentPane.find('.edit-uom-cf').val(selected_cf / uom_cf);
});
$('.edit-quantity').focusout(function(){
    let parentPane = $(this).parents('.tab-pane');
    let uom_cf = parentPane.find('.edit-stock-uom').data('cf');
    let selected_cf = parentPane.find('.edit-uom :selected').data('cf');
    let final_cf = (selected_cf / uom_cf).toFixed(2);
    parentPane.find('.edit-stock-quantity').val($(this).val() * final_cf);
});
$('#mat-req').submit(function(){
    let parentPane = $(this).parents('.tab-pane');
    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            if(data.status == 'success'){ 
                // If the form's objective is to update, update the row
                if(data.update){
                    let row = parentPane.find(`#mr-row-${data.materialrequest.id}`);
                    row.children('td.mr-req-date').text(data.required_date);
                    row.children('td.mr-purpose').text(data.materialrequest.purpose);
                    parentPane.find('.editModal').modal('hide');
                    parentPane.find('#mat-req').remove();
                }
                // Otherwise, go back
                else{
                    loadMaterialRequest();
                }
            } else{
                alert('Error! Please ensure that all fields are filled in and valid!');
            }
        },
        error: function(data){
            // REMEMBER TO REPLACE THIS WITH BETTER ERROR INDICATION
            alert(`Error! Make sure all fields are filled in and have valid data!`);
        }
    });
    return false;
});
$(document).on('submit','#mr-submit',function(){
    let parentPane = $(this).parents('.tab-pane');
    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            let row = parentPane.find(`#mr-row-${data.materialrequest.id}`);
            row.children('td.mr-rq-status').text(data.materialrequest.mr_status);
            row.children('td.mr-rq-status').prepend(
                `<i class="fa fa-circle" aria-hidden="true" style="color:blue"></i> `
            );
            row.find('#edit-mr-button').remove();
            parentPane.find('#editModal').modal('hide');
            parentPane.find('#mat-req').remove();
        },
        error: function(data){
            // REMEMBER TO REPLACE THIS WITH BETTER ERROR INDICATION
            alert(`Error! Make sure all fields are filled in and have valid data!`);
        }
    });
    return false;
});

$('.editItemForm').submit(function(){
    let id = $(this).data('target');
    let parentPane = $(this).parents('.tab-pane');
    let row = parentPane.find(`.items-tbl tr[data-id="${id}"]`);
    $(row).find('.mr-code-input .selectpicker').val(parentPane.find('select.edit-item-code').val()).selectpicker('refresh');
    $(row).find('.mr-qty-input input').val(parentPane.find('.edit-quantity').val());
    $(row).find('.mr-unit-input .selectpicker').val(parentPane.find('select.edit-uom').val()).selectpicker('refresh');
    $(row).find('.mr-target-input .selectpicker').val(parentPane.find('select.edit-station').val()).selectpicker('refresh');
    parentPane.find('#itemEditModal').modal('hide');
    return false;
});
// Clicking the edit button for each of the material request rows invokes this function
function loadEdit(url){
    $('#modal-form').html('<i class="fa fa-spinner fa-5x text-center p-5" aria-hidden="true"></i>');
    $('#modal-form').load(url);
}

function loadIntoPage(element, url){
    let parentPane = $(element).parents('.tab-pane');
    parentPane.html('<i class="fa fa-spinner fa-5x text-center p-5" aria-hidden="true"></i>');
    parentPane.load(url);
    return parentPane.length;
}

// These two listeners will fix stacking modals
$(document).on('show.bs.modal', '.modal', function () {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});

$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});