var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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

function deleteOperation(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    }); 
    $.ajax({
        type: "DELETE",
        url: $(`${id}`).find('form').attr('action'),
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log("success");
            $(`#op${id}`).remove();
        }
    });
    return false;
}