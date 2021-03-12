$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function (e) {
    $(".customer-modal-image").on("click", function () {
        $("#customer-image-modal").modal("toggle");
        $("#customer-image-view").attr("src", this.src);
    });
    loadFunctions();
});

function loadFunctions() {
    customerUpdateModal();
    customerUpdate();
    customerCreate();
}
function dangerNotification(text) {
    $("#customer-danger").show();
    $("#customer-danger").html(text);
    $("#customer-danger").delay(4000).hide(1);
}

function successNotification(text) {
    $("#customer-success").show();
    $("#customer-success").html(text);
    $("#customer-success").delay(4000).hide(1);
    customerUpdateModal();
    customerCreate();
}

// Fetches data and places it into update-customer-modal form
function customerUpdateModal() {
    $(".editBtn").on("click", function (e) {
        $("#update-customer-modal").modal("show");

        $tr = $(this).closest("tr");
        var data = $tr
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();

        $("#id").val(data[0]);
        $("#customer_lname_up").val(data[1]);
        $("#customer_fname_up").val(data[2]);
        $("#branch_name_up").val(data[3]);
        $("#contact_number_up").val(data[4]);
        $("#address_up").val(data[5]);
        $("#company_name_up").val(data[8]);
    });
}

//Update customer Upon Submitting Modal Form
function customerUpdate() {
    $("#update-customer-form").on("submit", function (e) {
        e.preventDefault();
        var id = $("#id").val();
        $.ajax({
            type: "PUT",
            url: "/update-customer/" + id,
            data: $("#update-customer-form").serialize(),
            success: function (r) {
                const dataTable = $("#customerTable").DataTable();
                dataTable
                    .row($("#" + id))
                    .remove()
                    .draw();
                dataTable.row
                    .add([
                        "<span class='text-black-50'>" + r["id"] + "</span>",
                        "<span class='text-black-50'>" +
                            r["customer_lname"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["customer_fname"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["branch_name"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["contact_number"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["address"] +
                            "</span>",
                        "<img src='storage/" +
                            r["profile_picture"] +
                            "' class='modal-image' height='30' style='border-radius: 50%;' onError=this.onerror=null;this.src='images/defaultuser.png'>",
                        "<span class='text-black-50'>" +
                            r["email_address"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["company_name"] +
                            "</span>",
                        '<a href="#" class="btn btn-success btn-sm rounded-0 editBtn" type="button"><i class="fa fa-edit"></i></a>',
                    ])
                    .node().id = id;
                dataTable.draw();
                successNotification("Customer SuccessFully Updated!");
                $("#update-customer-modal").modal("hide");
                $("#update-customer-form")[0].reset();
            },
            error: () =>
                dangerNotification("There was an error upon updating!"),
        });
    });
}

function customerCreate() {
    $("#create-customer-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/create-customer",
            data: $("#create-customer-form").serialize(),
            success: function (r) {
                var id = r["id"];
                const dataTable = $("#customerTable").DataTable();
                dataTable.row
                    .add([
                        "<span class='text-black-50'>" + r["id"] + "</span>",
                        "<span class='text-black-50'>" +
                            r["customer_lname"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["customer_fname"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["branch_name"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["contact_number"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["address"] +
                            "</span>",
                        "<img src='storage/" +
                            r["profile_picture"] +
                            "' class='modal-image' height='30' style='border-radius: 50%;' onError=this.onerror=null;this.src='images/defaultuser.png'>",
                        "<span class='text-black-50'>" +
                            r["email_address"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["company_name"] +
                            "</span>",
                        '<a href="#" class="btn btn-success btn-sm rounded-0 editBtn" type="button"><i class="fa fa-edit"></i></a>',
                    ])
                    .node().id = id;
                dataTable.draw();
                successNotification("Customer SuccessFully Added!");
                $("#create-customer-modal").modal("toggle");
                $("#create-customer-form")[0].reset();
            },
            error: function () {
                dangerNotification(
                    "There was a problem upon creating a customer!"
                );
            },
        });
    });
}
