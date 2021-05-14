var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$("#save_wc").click(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN, //protection :>
        }
    });

    var formData = new FormData();
    formData.append('wc_label', $("#Work_Center_label").val());
    formData.append('wc_type', $("#wc_select").val());
    formData.append('employee_id', $("#Employee_name").val());

    $.ajax({ //jqajax & jqattrget
        type: "post",
        url: $("#newworkcenter").attr("action"),
        data: formData,
        contentType: false, //to successfully store data in laravel
        processData: false,
        success: function (response) {
            console.log("success");
        }
    });
});
