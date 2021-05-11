var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


$("#saveMMBtn").click(function () { 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
    var formData = new FormData();
    //formData.append($("#Machine_Image").val());
    formData.append('machine_name', $("#Machine_name").val());
    formData.append('machine_process', $("#Machine_Process").val());
    formData.append('setup_time', $("#Setup_time").val());
    formData.append('running_time', $("#Running_time").val());
    formData.append('machine_desc', $("#Machine_Description").val());

    for (var key of formData.entries()) {
        console.log(key[0] + ', ' + key[1]);
    }

    $.ajax({
        type: 'POST',
        url: '/create-machine',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            loadmachine();
        }
    });
});