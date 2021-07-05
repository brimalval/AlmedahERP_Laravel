var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
    $("#supplierTbl").DataTable({
        "searching": false,
        "info": false,
    });
});

$("#supplierForm").submit(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    });

    var formData = new FormData(this);
    var flag = true;

    if(
        !$("#supplier_name").val() || !$("#supplier_contact").val() || !$("#supplier_phone").val() ||
        $("#supplier_group").val() === 'n/o' || !$("#supplier_email").val() || !$("#supplier_address").val()
    ) {
        slideAlert("Please make sure that all the appropriate information has been provided.", false);
        flag = false;
    }

    if($("#supplier_phone").val().length != 11) {
        slideAlert("Contact number is not of appropriate length.", false);
        flag = false;
    }    

    if(flag) {
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                loadSupplier();
            }
        });
    }

    return false;

});

function slideAlert(message, flag) {
    if (flag) {
        $("#s_success_message").fadeTo(3500, 500).slideUp(500, function(){
            $("#s_success_message").slideUp(500);
        });
        $("#s_success_message").html(message);
    }
    else {
        $("#s_alert_message").fadeTo(3500, 500).slideUp(500, function(){
            $("#s_alert_message").slideUp(500);
        });
        $("#s_alert_message").html(message);
    }
}

$("#saveBtn").click(function() {
    $("#supplierForm").submit();
});
