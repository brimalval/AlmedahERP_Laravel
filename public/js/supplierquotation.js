$('.selectpicker').each(function(){
    try{
        $(this).selectpicker();
    }catch(e){
        console.log("Todo: find what is causing selectpicker error");
    }
});

// Subtract the "old" value from the grand total and store it in the session
$(document).off('focus', '.item-rate').on('focus', '.item-rate', function(e){
    let row = $(this).parents('tr');
    let qty = Number(row.find('#qty-req').val());
    if(qty == "" || qty == 0){
        e.preventDefault();
        return false;
    }
    sessionStorage.setItem('currval', Number($('#grand_total').val()) - (qty * Number($(this).val())));
});
// Upon clicking out of the item rate, get the difference between the new and old value
// and add it to the grand total
$(document).off('focusout', '.item-rate').on('focusout', '.item-rate', function(e){
    let row = $(this).parents('tr');
    let qty = Number(row.find('#qty-req').val());
    if(qty == "" || qty == 0){
        e.preventDefault();       
        return false;
    }
    let subtotal = row.find('.subtotal');
    $('#grand_total').val(Number(sessionStorage.getItem('currval')) + (qty * Number($(this).val())));
    let subtotalCommaNum = String(qty * Number($(this).val())).split(/(?=(?:...)*$)/).join(',');
    subtotal.val(subtotalCommaNum);
    let commaNum = $('#grand_total').val().split(/(?=(?:...)*$)/).join(',');
    $('#grand_total_display').val(commaNum);
    sessionStorage.removeItem('currval');
});
// Prevent non-numerics from being entered
$(document).off('keypress', '.item-rate').on('keypress', '.item-rate', function(e){
    if(e.which < 48 || e.which > 57)
        e.preventDefault();
});

$(document).off('click', '.sq-add-row-btn').on('click', '.sq-add-row-btn', function(){
    let sampleRow = $('.row-sample').find('tr');
    let itemsTblBody = $('#items-tbl').find('tbody');
    let newRow = sampleRow.clone();
    // This block of code removes the cloned selectpicker and replaces it with a new one
    // because for some reason cloning breaks the selectpicker
    let selectpickers = newRow.find('select');
    selectpickers.each(function(){
        $(this).parents('td').html(this);
        $(this).selectpicker();
    });
    newRow.appendTo(itemsTblBody);
});

$(document).off('click', '.delete-btn').on('click', '.delete-btn', function(e){
    let row = $(this).parents('tr');
    let qty = Number(row.find('#qty-req').val());
    if(qty == "" || qty == 0)
        return false;
    let rate = Number(row.find('.item-rate').val());
    $('#grand_total').val(Number($('#grand_total').val()) - (qty * rate));
    let commaNum = $('#grand_total').val().split(/(?=(?:...)*$)/).join(',');
    $('#grand_total_display').val(commaNum);
    row.remove();
    return false;
});

$(document).off('change', '#supplier_id').on('change', '#supplier_id', function(){
    console.log('change');
    $('#contact_name').val($(this).find(':selected').data('contact'));
    $('#supplier_email').val($(this).find(':selected').data('email'));
});

$(document).off('change', '.sq-check-all-box').on('change', '.sq-check-all-box', function(){
    let tableParent = $(this).parents('table');
    let childBoxes = tableParent.find('.row-checkbox');
    if(this.checked){
        childBoxes.each(function(){
            $(this).attr('checked', true);
        });
        $('.sq-delete-rows-btn').removeClass('d-none');
    } else{
        childBoxes.each(function(){
            $(this).attr('checked', false);
        });
        $('.sq-delete-rows-btn').addClass('d-none');
    }
});

$(document).off('change', '.row-checkbox').on('change', '.row-checkbox', function(){
    let tableParent = $(this).parents('table');
    if(this.checked){
        $('.sq-delete-rows-btn').removeClass('d-none');
    } else{
        if(!$(tableParent).find('.row-checkbox:checked').length){
            $('.sq-delete-rows-btn').addClass('d-none');
        }
    }
});

$(document).off('click', '.sq-delete-rows-btn').on('click', '.sq-delete-rows-btn', function(){
    let tableParent = $(this).parents('table');
    // Rows to be deleted
    let rows = $(tableParent).find('.row-checkbox:checked');
    // Trigger click function on each of the checked rows' delete buttons
    rows.each(function(){
        var parentRow = $(this).parents('tr');       
        var deleteBtn = parentRow.find('.delete-btn');
        deleteBtn.click();
    });
    $(this).addClass('d-none');
    tableParent.find('.sq-check-all-box').attr('checked', false);
});

$('#squotation-form').off('submit').submit(function(){
    if(!confirm('Please confirm the information you have entered. Would you like to proceed?')){
        return false;
    }
    let formElement = this;
    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            if(!loadIntoPage(formElement, data.redirect)){
                swal({
                    title: "Thank you for working with Almedah Food Machineries!",
                    icon: "success",
                });
                $('#sqSaveBtn').remove();
            }
        }, 
        error: function(data){

        },
    });
    return false;
});