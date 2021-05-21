$(document).ready(function(){
    let cf = $('#uom_id :selected').data('cf');
    let qty = $('#create_total_amount').val();
    $('#stock_quantity').val(qty * cf);
    $('#conversion_factor').val(cf);
    $('#uom_id').selectpicker();
    $('#edit_uom_id').selectpicker();
    $('#uom_id').change(function(){
        let cf = $('#uom_id :selected').data('cf');
        let qty = $('#create_total_amount').val();
        $('#conversion_factor').val(cf);
        $('#stock_quantity').val(qty * cf);
    });
    $('#create_total_amount').on('focusout', function(){
        let cf = $('#uom_id :selected').data('cf');
        let qty = $('#create_total_amount').val();
        $('#conversion_factor').val(cf);
        $('#stock_quantity').val(qty * cf);
    });
    $('#edit_uom_id').change(function(){
        let cf = $('#edit_uom_id :selected').data('cf');
        let qty = $('#total_amount').val();
        $('#edit_conversion_factor').val(cf);
        $('#edit_stock_quantity').val(qty * cf);
    });
    $('#total_amount').on('focusout', function(){
        let cf = $('#edit_uom_id :selected').data('cf');
        let qty = $('#total_amount').val();
        $('#edit_conversion_factor').val(cf);
        $('#edit_stock_quantity').val(qty * cf);
    });
});