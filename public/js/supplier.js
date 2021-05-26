var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
    $("#supplierTbl").DataTable({
        "searching": false,
        "paging": false,
        "ordering": false,
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
        alert("Please make sure that all the appropriate information has been provided.");
        flag = false;
    }

    if($("#supplier_phone").val().length != 11) {
        alert("Contact number is not of appropriate length.");
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

$("#saveBtn").click(function() {
    $("#supplierForm").submit();
});
