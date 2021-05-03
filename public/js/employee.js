$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function (e) {
    loadAll();
});

function loadAll() {
    employeeUpdateModal();
    employeeUpdate();
    employeeCreate();
}
function dangerNotification(text) {
    $("#employee-danger").show();
    $("#employee-danger").html(text);
    $("#employee-danger").delay(4000).hide(1);
}

function successNotification(text) {
    $("#employee-success").show();
    $("#employee-success").html(text);
    $("#employee-success").delay(4000).hide(1);
    loadAll();
}

// Fetches data and places it into update-employee-modal form
function employeeUpdateModal() {
    $(".editBtn").on("click", function (e) {
        $("#update-employee-modal").modal("show");
        $tr = $(this).closest("tr");
        var data = $tr
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();
        $("#id").val(data[0]);
        $("#last_name_up").val(data[1]);
        $("#first_name_up").val(data[2]);
        $("#position_up").val(data[3]);
        $("#contact_number_up").val(data[6]);
        $("#active_status_up").val(data[9]);
        const status = data[9];
        if (status == 0) {
            $(".employeeStatus").html(
                '<div class="form-check form-switch"><input class="form-check-input toggle" id="active_status_up" name="active_status" type="checkbox" value="1"><label for="active_status_up" class="pl-3">Activate Account</label></div>'
            );
        } else {
            $(".employeeStatus").html(
                '<div class="form-check form-switch"><input class="form-check-input toggle" id="active_status_up" name="active_status" type="checkbox" value="0"><label for="active_status_up" class="pl-3">Deactivate Account</label></div>'
            );
        }
    });
}

//Update Employee Upon Submitting Modal Form
function employeeUpdate() {
    $("#update-employee-form").on("submit", function (e) {
        e.preventDefault();
        var id = $("#id").val();
        $.ajax({
            type: "PUT",
            url: "/update-employee/" + id,
            data: $("#update-employee-form").serialize(),
            success: function (response) {
                successNotification("Employee SuccessFully Updated!");
                $("#update-employee-modal").modal("hide");
                $("#update-employee-form")[0].reset();
            },
            error: () =>
                dangerNotification("There was an error upon updating!"),
        });
    });
}

$("#Click").on("click", function () {
    alert("clicked");
});

function employeeCreate() {
    $("#create-employee-form").on("submit", function (e) {
        console.log("burat");
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/create-employee",
            data: $("#create-employee-form").serialize(),
            success: function (response) {
                successNotification("Employee SuccessFully Added!");
                $("#create-employee-form")[0].reset();
                $("#create-employee-modal").modal("toggle");
            },
            error: function () {
                dangerNotification(
                    "An existing account with the same Email exists!"
                );
            },
        });
    });
}
