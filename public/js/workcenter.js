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

    if($("#wc_select").val() == "Human"){ //to check if wc_type is human
        formData.append('employee_id', $("#Employee_name").val());
    }
    else if($("#wc_select").val() == "Machine"){ //to check if wc_type is machine
        formData.append('machine_code', $("#Available_Machine").val());
    }
    else if($("#wc_select").val() == "Human and Machine"){ //to check if wc_type is human and machine
        formData.append('employee_id', $("#Employee_name").val());
        formData.append('machine_code', $("#Available_Machine").val());
    }

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

$("#Available_Machine").change(function () {
    var machine_code = $(this).val(); //jqvalget

    if(machine_code == "n/a"){ //to remove values if there's no option
        $("#machine_process").val(null);
        $("#setup_time").val(null);
        $("#Running_time").val(null);
    }

    $.ajax({ //jqajax
        type: "get",
        url: `/find-machine/${machine_code}`, //interpolation
        data: machine_code,
        success: function (response) {
            var machine = response.machine;
            $("#machine_process").val(machine.machine_process); //to get specific column
            $("#setup_time").val(machine.setup_time);
            $("#Running_time").val(machine.running_time);
        }
    });
});
