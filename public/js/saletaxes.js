// Function that is called whenever the user presses "add row" in the materialrequest form
function addRow(){
    if($('#no-data')[0]){
        deleteItemRow($('#no-data').parents('tr'));
    }
    let lastRow = $('#material-request-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#material-request-input-rows').append(
    `<tr data-id="${nextID}">
        
        <td id="mr-code-input-${nextID}" class="mr-code-input">
        <div class="row">
        <div class="col-11">
        <input type="text" name="Shipping_Amount" class="form-control">
        </div>
        <div class="col-1">
        <a id="" class="btn delete-btn" href="#" role="button">
        <i class="fa fa-minus" aria-hidden="true"></i>
        </a>
        </div>
        </div>
        </td>
    </tr>`);
    $('#selects select[data-id="item_code"]').clone().appendTo(`#items-tbl tr:last .mr-code-input`).selectpicker();
    $('#selects select[data-id="station_id"]').clone().appendTo(`#items-tbl tr:last .mr-target-input`).selectpicker();
    $('#selects select[data-id="uom_id"]').clone().appendTo(`#items-tbl tr:last .mr-unit-input`).selectpicker();
    $('#items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
}
// Opens the modal for editing an item
function openItemEditModal(row){
    $('#editItemForm').data('target', row.data('id'));
    $('#itemEditModal').modal('show');
    let item_code = $(row).find('.selectpicker').val();
    $.get(`/inventory/${item_code}`, function(response, status){
        let uom_cf = response.material.uom.conversion_factor;
        let final_cf = ($('#edit-uom :selected').data('cf') / uom_cf).toFixed(2);
        $('#edit-stock-uom').val(response.material.uom.item_uom);
        $('#edit-stock-uom').data('cf', uom_cf);
        $('#edit-uom-cf').val(final_cf);
        $('#edit-stock-quantity').val(0);
        // Setting the edit fields into the values inputted in the main screen
        $('#edit-item-code').val(item_code).trigger('change');
        $('#edit-quantity').val($(row).find('.mr-qty-input input').val());
        $('#edit-uom').val($(row).find('.mr-unit-input .selectpicker').val()).trigger('change');
        $('#edit-station').val($(row).find('.mr-target-input .selectpicker').val()).selectpicker('refresh');
    });
}

function deleteItemRow(element){
    element.remove();
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
            console.log(data);
            row.remove();
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });
    return false;
});
$(document).ready(function(){
    $('.selectpicker').each(function(index){
        $(this).selectpicker();
    });
    // Item row delete button functionality
    $('body').on('click', '.delete-btn', function(e){
        e.preventDefault();
        deleteItemRow($(this).parents('tr'));
    });
    $('body').on('click', '.item-edit-btn', function(e){
        e.preventDefault();
        openItemEditModal($(this).parents('tr'));
    });
    $('#edit-item-code, #edit-item-name').change(function(){
        console.log($(this).val());
        let newVal = $(this).val();
        $('#edit-item-code, #edit-item-name').each(function(){
            if($(this).val() != newVal){
                $(this).val(newVal);
                $(this).selectpicker('refresh');
            }
        }); 
        $.get(`/inventory/${newVal}`, function(response, status){
            let uom_cf = response.material.uom.conversion_factor;
            let selected_cf = $('#edit-uom :selected').data('cf');
            let final_cf = (selected_cf / uom_cf).toFixed(2);
            let quantity = ($('#edit-quantity').val() * final_cf).toFixed(2);
            $('#edit-stock-uom').val(response.material.uom.item_uom);
            $('#edit-stock-uom').data('cf', uom_cf);
            $('#edit-uom-cf').val(final_cf);
            $('#edit-stock-quantity').val(quantity);
        });
    });
    // Making sure that none of the buttons inside the form submit it,
    // only the button outside of the form ("save" button) can submit
    $('#mat-req button').each(function(index){
        $(this).attr('type', 'button');
    });
    $('#edit-uom').change(function(){
        let quantity = $('#edit-quantity').val();
        let uom_cf = $('#edit-stock-uom').data('cf');
        let selected_cf = $('#edit-uom :selected').data('cf');
        console.log(uom_cf);
        console.log(selected_cf);
        let final_cf = (selected_cf / uom_cf).toFixed(2);
        $('#edit-stock-quantity').val(quantity * final_cf);
        $('#edit-uom-cf').val(selected_cf / uom_cf);
    });
    $('#edit-quantity').focusout(function(){
        let uom_cf = $('#edit-stock-uom').data('cf');
        let selected_cf = $('#edit-uom :selected').data('cf');
        let final_cf = (selected_cf / uom_cf).toFixed(2);
        $('#edit-stock-quantity').val($(this).val() * final_cf);
    });
    $('#mat-req').submit(function(){
    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            console.log(data);
            if(data.status == 'success'){ 
                // If the form's objective is to update, update the row
                if(data.update){
                    let row = $(`#mr-row-${data.materialrequest.id}`);
                    row.children('td.mr-req-date').text(data.materialrequest.required_date);
                    row.children('td.mr-purpose').text(data.materialrequest.purpose);
                    $('#editModal').modal('hide');
                    $('#mat-req').remove();
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
            console.log("error");
            console.log(data);
        }
    });
    return false;
    });
    $('#mr-submit').submit(function(){
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            success: function(data){
                console.log(data);
                if(data.status == 'success'){ 
                    let row = $(`#mr-row-${data.materialrequest.id}`);
                    row.children('td.mr-rq-status').text(data.materialrequest.mr_status);
                    row.find('#edit-mr-button').remove();
                    $('#editModal').modal('hide');
                    $('#mat-req').remove();
                } else{
                    alert('Error! Please ensure that all fields are filled in and valid!');
                }
            },
            error: function(data){
                // REMEMBER TO REPLACE THIS WITH BETTER ERROR INDICATION
                alert(`Error! Make sure all fields are filled in and have valid data!`);
                console.log("error");
                console.log(data);
            }
        });
        return false;
    });
});

$('#editItemForm').submit(function(){
    let id = $(this).data('target');
    console.log("SUBMITTING TO " + id);
    let row = $(`#items-tbl tr[data-id="${id}"]`);
    $(row).find('.mr-code-input .selectpicker').val($('#edit-item-code').val()).selectpicker('refresh');
    $(row).find('.mr-qty-input input').val($('#edit-quantity').val());
    $(row).find('.mr-unit-input .selectpicker').val($('#edit-uom').val()).selectpicker('refresh');
    $(row).find('.mr-target-input .selectpicker').val($('#edit-station').val()).selectpicker('refresh');
    $('#itemEditModal').modal('hide');
    return false;
});
// Clicking the edit button for each of the rows invokes this function
function loadEdit(url){
    $('#modal-form').html('<i class="fa fa-spinner fa-5x text-center p-5" aria-hidden="true"></i>');
    $('#modal-form').load(url);
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
$(document).ready(function() {
    $('#ShippingRuleTable').DataTable();
} );

      function openField() {
        var check = document.getElementById('include');
        if (check.checked) {
          document.getElementById('cont').style.display = 'block';
        } else
          document.getElementById('cont').style.display = 'none';
      }
