var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var SUPP_SUCCESS = "#s_success_message";
var SUPP_FAIL = "#s_alert_message";

$(document).ready(function() {
    $("#supplierTbl").DataTable({
        "searching": false,
        "info": false,
    });
});

$("#supplierForm, #updateSupplierForm").submit(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    });

    var formData = new FormData(this);
    if(!$("#supplier_contact").val()) {
        formData.delete('supplier_contact');
    }

    if(
        !$("#supplier_name").val() || !$("#supplier_phone").val() ||
        $("#supplier_group").val() === 'n/o' || !$("#supplier_email").val() || !$("#supplier_address").val()
    ) {
        slideAlert("Please make sure that all the appropriate information has been provided.", SUPP_FAIL);
        return;
    }

    if($("#supplier_phone").val().length != 11) {
        slideAlert("Contact number is not of appropriate length.", SUPP_FAIL);
        return;
    }    

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            loadSupplier();
        }
    });

    return false;

});

$("#deleteSuppForm").submit(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    });
    $.ajax({
        type: "DELETE",
        url: $(this).attr('action'),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            loadSupplier();
        }
    });
    return false;
});

$("#deleteSupplier").click(function () { 
    $("#deleteSuppForm").submit();
});

$("#saveBtn, #updateSupplierBtn").click(function() {
    $("#supplierForm, #updateSupplierForm").submit();
});
