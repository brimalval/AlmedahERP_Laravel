var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var WC_SUCCESS = "#wc_success_msg";
var WC_FAIL = "#wc_alert_msg";

function checkWC() {
    msg = 'Work Center created!';
    alert = WC_SUCCESS;
    if(!$("#Work_Center_label").val()) {
        msg = "No label indicated for work center.";
        alert = WC_FAIL;
    } 
    if($("#wc_select").val() === 'N/A') {
        msg = "No type indicated for work center."; 
        alert = WC_FAIL;
    } 
    if(!$("#Production_Capacity").val()) {
        msg = "No indicated production capacity."; 
        alert = WC_FAIL;
    } 
    $(".hour_rate_compu").each(function () {
        // element == this
        if($(this).val() === '0') {
            msg = "Computation of hour rate is incomplete."
            alert = WC_FAIL;
            return false;
        }
    });
    slideAlert(msg, alert);
    return (alert === WC_SUCCESS) ? true : false;

}

$("#save_wc").click(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN, //protection :>
        }
    });

    var flag = checkWC();
    if(!flag) {return;}

    var formData = new FormData();
    formData.append('wc_label', $("#Work_Center_label").val());
    formData.append('wc_type', $("#wc_select").val());
    formData.append('prod_cost', $("#Production_Capacity").val());
    formData.append('elec_cost', $("#Electricity_Cost").val());
    formData.append('con_cost', $("#Consumable_Cost").val());
    formData.append('rent_cost', $("#Rent_Cost").val());
    formData.append('wages', $("#Wages").val());
    formData.append('hour_rate', $("#Hour_rate").val());

    var hrs = document.getElementById("Employee_hours").value;
    var mins = document.getElementById("Employee_minutes").value;
    var sec = document.getElementById("Employee_seconds").value;

    var time = hrs + ":" + mins + ":" + sec;

    formData.append('duration', time);

    if($("#wc_select").val() == "Human"){ //to check if wc_type is human
        var employee_id_set = {};
        for(let i=1; i <= $("#newemployee-input-rows tr").length; i++) {
            let employee_data = $(`#employee-${i}`);
            let emp_id = employee_data.find("#Employee_name").val();
            employee_id_set[i] = {
                'employee_id' : emp_id
            }
        }
        formData.append('employee_id_set', JSON.stringify(employee_id_set));
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
            loadnewRouting();
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

$(".hour_rate_compu").change(function (e) { 
    var sum = parseFloat($("#Electricity_Cost").val())+parseFloat($("#Consumable_Cost").val())+parseFloat($("#Rent_Cost").val())+parseFloat($("#Wages").val());
    $("#Hour_rate").val(sum);
    e.preventDefault();
    
});

function addRownewEmployee(){
    if($('#no-data')[0]){
        deleteItemRow($('#no-data').parents('tr'));
    }
    //let lastRow = $('#newemployee-input-rows tr:last');
    let nextID = $("#newemployee-input-rows tr").length + 1;
    $('#newemployee-input-rows').append(
    `
    <tr id="employee-${nextID}">
        <td id="mr-code-input" class="mr-code-input"><input type="text" value=""
                name="Employee_name" list="employees" id="Employee_name" class="form-control">
        </td>
        <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                name="Employee_hours" id="Employee_hours" class="form-control"></td>
        <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                name="Employee_minutes" id="Employee_minutes" class="form-control"></td>
        <td style="width: 15%;" class="mr-qty-input"><input type="number" min="0" value=""
                name="Employee_seconds" id="Employee_seconds" class="form-control"></td>
        <td>
            <a id="" class="btn delete-btn" href="#" role="button">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
    `);
}

