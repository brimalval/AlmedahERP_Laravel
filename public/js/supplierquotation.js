function loadIntoPage(element, route){
    let parentPane = $(element).parents('.tab-pane');
    parentPane.load(route);
}

$(document).ready(function(){
    $('.selectpicker').each(function(){
        $(this).selectpicker();
    });

    // Subtract the "old" value from the grand total and store it in the session
    $('.item-rate').on('focus', function(){
        let row = $(this).parents('tr');
        let qty = Number(row.find('#qty-req').val());
        sessionStorage.setItem('currval', Number($('#grand_total').val()) - (qty * Number($(this).val())));
        console.log(sessionStorage.getItem('currval'));
    });
    // Upon clicking out of the item rate, get the difference between the new and old value
    // and add it to the grand total
    $('.item-rate').on('focusout', function(){
        let row = $(this).parents('tr');
        let qty = Number(row.find('#qty-req').val());
        let subtotal = row.find('.subtotal');
        $('#grand_total').val(Number(sessionStorage.getItem('currval')) + (qty * Number($(this).val())));
        let subtotalCommaNum = String(qty * Number($(this).val())).split(/(?=(?:...)*$)/).join(',');
        subtotal.val(subtotalCommaNum);
        let commaNum = $('#grand_total').val().split(/(?=(?:...)*$)/).join(',');
        $('#grand_total_display').val(commaNum);
        sessionStorage.removeItem('currval');
    });
    // Prevent non-numerics from being entered
    $('.item-rate').on('keypress', function(e){
        if(e.which < 48 || e.which > 57)
            e.preventDefault();
    });
});