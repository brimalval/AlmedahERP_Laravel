$(document).ready(function () {
    $(".mm").keyup(onChangeFunction);
});

function onChangeFunction() {
    $("#saveMMBtn").css('display', 'inline-block');
}

$("#mmDelete").click(function () { 
    $("#deleteMM").submit();
});

$("#deleteMM").submit(function () {
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
            loadmachine();
        }
    });
    return false;
});

$("#saveMMBtn").click(function () { 
    $("#mmForm").submit();
});

$("#mmForm").submit(function () { 
    var formData = new FormData(this);
    //formData.append($("#Machine_Image").val());
    for (var key of formData.entries()) {
        console.log(key[0] + ', ' + key[1]);
    }

    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            loadmachine();
        }
    });

    return false;
});



