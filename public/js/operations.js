/**
 * $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
 */


$(document).ready(function () {
    $("#table_operations").DataTable();
    $('.summernote').summernote({
        height: 200
    });
    $('#myTimeline').verticalTimeline({
        startLeft: false,
        alternate: false,
        arrows: false
    });
});

$("#operationModuleSave").click(function () {
    $("#operationModuleForm").submit();
});

$("form[name='deleteOperation']").submit(function () { 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    }); 
    $.ajax({
        type: "DELETE",
        url: $(this).attr('action'),
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log("success");
        }
    });
    return false;
});

$(".mr-delete-form").each(function () {
    // element == this
   $(this).click(function () { 
        var form = $(this).parent().find("form[name='deleteOperation']");
        form.submit();
   });
});

$("#operationModuleForm").submit(function () {
    var formData = new FormData(this);
    var url = $(this).attr('action');
    if($("#hiddenOpId").val()) {
        formData.append('id', $("#hiddenOpId").val());
        url = `operations/${$("#hiddenOpId").val()}`;
    }
    $.ajax({
        type: $(this).attr('method'),
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            operationtable();
        }
    });
    return false;
});