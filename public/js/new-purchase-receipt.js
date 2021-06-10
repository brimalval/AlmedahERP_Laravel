var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

$(document).ready(function () {
    if ($("#receiptId").length) {
    }
});

$("#saveReceipt").click(saveReceipt);

function saveReceipt() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
        },
    });

    let formData = new FormData();
    let received_mats = {};

    for (let i = 1; i <= $("#itemsToReceive tr").length; i++) {
        received_mats[i] = {
            item_code: $(`#item_code${i}`).html(),
            qty_received: $(`#qtyAcc${i}`).html(),
            rate: $(`#rateAcc${i}`).html(),
            amount: $(`#amtAcc${i}`).html(),
            item_condition: "New"
        };
    }

    if ($("#receiptId").val()) {
        formData.append("receipt_id", $("#receiptId").val());
    }
    formData.append("date_created", $("#npr_date").val());
    formData.append("purchase_id", $("#orderId").val());
    formData.append("items_received", JSON.stringify(received_mats));
    formData.append("grand_total", $("#receivePrice").val());

    let url = !$("#recStatus").length ? "/create-receipt" : "/update-receipt";

    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            loadPurchaseReceipt();
            if($("#contentPurchaseInvoice").length) {
                loadPurchaseInvoice();
            }
        },
    });
}

function viewOrderItems(id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
        },
    });
    $.ajax({
        type: "GET",
        url: `/view-po-items/${id}`,
        data: id,
        processData: false,
        contentType: false,
        success: function (response) {
            let table = $("#npr_itemList tbody");
            $("#npr_itemList tbody tr").remove();
            let po_items = response.items;
            for(let i=0; i<po_items.length; i++) {
                table.append(
                    `
                        <tr>
                            <td class="text-bold">${po_items[i].item.item_code}</td>
                            <td class="text-bold">${po_items[i].item.item_name}</td>
                            <td>${po_items[i].qty}</td>
                            <td>${po_items[i].rate}</td>
                            <td>${po_items[i].subtotal}</td>
                        </tr>
                    `
                );
            }
        }
    });
}

$("#submitReceipt").click(submitReceipt);

function submitReceipt() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
        },
    });

    let receipt_id = $("#receiptId").val();
    if (confirm(`Permanently submit ${receipt_id}?`)) {
        $.ajax({
            url: `/submit-receipt/${receipt_id}`,
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                loadPurchaseReceipt();
            },
        });
    } else {
        return;
    }
}

function onChangeFunction() {
    $("#recStatus").html("Not Yet Saved");
    $("#submitReceipt").html("Save");
    $("#submitReceipt").off("click", submitReceipt);
    $("#submitReceipt").click(saveReceipt);
    $("#submitReceipt").attr("id", "saveReceipt");
}

$("#receiveMaterials").click(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
        },
    });

    var receipt_id = $("#receiptId").val();
    var received_mats = {};
    for (let i = 1; i <= $("#itemsToReceive tr").length; i++) {
        if (
            parseInt($(`#qtyRec${i}`).val()) >
                parseInt($(`#qtyAcc${i}`).html()) ||
            parseInt($(`#qtyRec${i}`).val()) < 0
        ) {
            alert(`Quantity for ${$(`#item_code${i}`).html()} is invalid.`);
            return;
        }
        received_mats[i] = {
            item_code: $(`#item_code${i}`).html(),
            qty_received: $(`#qtyRec${i}`).val(),
        };
    }

    var formData = new FormData();
    formData.append("receipt_id", receipt_id);
    formData.append("mat_received", JSON.stringify(received_mats));

    $.ajax({
        type: "POST",
        url: "/receive-materials",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            loadPurchaseReceipt();
            if($("#contentPurchaseOrder").length) {
                loadPurchaseOrder();
            }
            if($("#contentPendingOrders").length) {
                loadPendingOrders();
            }
        },
    });
});

function chkBoxFunction() {
    $('input[name="item-chk"]').each(function () {
        $(this).change(function () {
            if ($(this).is(":checked"))
                $("#deleteBtn").css("display", "inline-block");
            else {
                let size = $("#itemsToReceive tr").length;
                for (let i = 1; i <= size; i++) {
                    if ($("#chk" + i).is(":checked")) {
                        return;
                    }
                }
                $("#deleteBtn").css("display", "none");
            }
        });
    });
}

function loadMaterials(id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
        },
    });

    let total_price = 0;
    let total_qty = 0;

    $.ajax({
        type: "GET",
        url: `/get-ordered-mats/${id}`,
        data: id,
        contentType: false,
        processData: false,
        success: function (data) {
            $("#orderId").val(data.purchase_id);
            //console.log($('#orderId').val());
            let table = $("#itemsToReceive");
            $("#itemsToReceive tr").remove();
            $("#suppField").val(data.supplier.company_name);
            $("#addressField").val(data.supplier.supplier_address);
            for (let i = 1; i <= data.ordered_mats.length; i++) {
                table.append(
                    `
                    <tr id="row-${i}">
                        <td class="text-black-50">
                            <span id="item_code${i}">${data.ordered_mats[i - 1]["item"].item_code}</span>
                        </td>
                        <td class="text-black-50">
                            <span id="prItemName${i}">${data.ordered_mats[i - 1]["item"].item_name}</span>
                        </td> 
                        <td class="text-black-50">
                            <span id="qtyAcc${i}">${data.ordered_mats[i - 1]["qty"]}</span>
                        </td> 
                        <td class="text-black-50">
                            <span id="rateAcc${i}">${data.ordered_mats[i - 1]["rate"]}</span>
                        </td> 
                        <td class="text-black-50">
                            <span id="amtAcc${i}">${data.ordered_mats[i - 1]["subtotal"]}</span>
                        </td> 
                    </tr>
                    `
                );
                total_qty += parseInt(data.ordered_mats[i - 1]["qty"]);
                total_price += parseFloat(data.ordered_mats[i - 1]["subtotal"]);
            }
            chkBoxFunction();
            $("#receiveQty").val(total_qty);
            $("#receivePrice").val(total_price);
        },
    });
}

function calcPrice(id) {
    let qty = !$("#qtyAcc" + id).val() ? 0 : parseInt($("#qtyAcc" + id).val());
    let rate = !$("#rateAcc" + id).val()
        ? 0
        : parseFloat($("#rateAcc" + id).val());
    let price = isNaN(qty * rate) ? 0 : qty * rate;
    $("#amtAcc" + id).val(price);
    recompute();
    //getQtyAndPrice();
}

$("#mainChk").change(function () {
    if ($(this).is(":checked")) {
        for (let i = 1; i <= $("#itemsToReceive tr").length; i++) {
            $("#chk" + i).prop("checked", true);
        }
        $("#deleteBtn").css("display", "inline-block");
    } else {
        for (let i = 1; i <= $("#itemsToReceive tr").length; i++) {
            $("#chk" + i).prop("checked", false);
        }
        $("#deleteBtn").css("display", "none");
    }
});

function recompute() {
    let total_price = 0;
    let total_qty = 0;
    for (let i = 1; i <= $("#itemsToReceive tr").length; i++) {
        total_qty += parseInt($(`#qtyAcc${i}`).val());
        total_price += parseFloat($(`#amtAcc${i}`).val());
    }
    $("#receiveQty").val(total_qty);
    $("#receivePrice").val(total_price);
}

$("#rowBtn").click(function () {
    let table = $("#itemsToReceive");
    let nextRow = $("#nullRow").length ? 1 : $("#itemsToReceive tr").length + 1;
    if ($("#nullRow").length) $("#itemsToReceive tr").remove();
    if ($("#mainChk").prop("disabled")) $("#mainChk").prop("disabled", false);
    table.append(
        `
        <tr id="row-${nextRow}">
            <td class="text-black-50">
                <input class="form-control" type="text" id="item_code${nextRow}">
            </td>
            <td class="text-black-50">
                <input class="form-control" id="qtyAcc${nextRow}" type="number" min="0">
            </td> 
            <td class="text-black-50">
                <input class="form-control" id="rateAcc${nextRow}" type="text" min="0">
            </td> 
            <td class="text-black-50">
                <input class="form-control" id="amtAcc${nextRow}" type="text" min="0">
            </td> 
        </tr>
        `
    );
    chkBoxFunction();
});

$("#deleteBtn").click(function () {
    let table = $("#itemsToReceive");
    if (
        $("#mainChk").is(":checked") ||
        $('input[name="item-chk"]:checked').length ==
            $("#itemsToReceive tr").length
    ) {
        $("#itemsToReceive tr").remove();
        if ($("#itemsToReceive tr").length == 0) {
            $("#mainChk").prop("checked", false);
            $("#mainChk").prop("disabled", true);
        }
        table.append(
            `
            <tr id='nullRow'>
                <td colspan="7" style="text-align: center;">
                    NO DATA
                </td>
            </tr>
            `
        );
    } else {
        let new_id = 1;
        for (let i = 1; i <= $("#itemsToReceive tr").length; i++) {
            if ($("#chk" + i).is(":checked")) {
                // "mark" every row to be deleted
                $("#row-" + i).attr("class", "item-0");
            } else {
                // assign new ids and attributes to unchecked elements
                // reassign attributes first before id's
                // otherwise, the attributes of wrong id will be reassigned

                $("#item_code" + i).attr("id", "item_code" + new_id);

                $("#qtyAcc" + i).attr("id", "qtyAcc" + new_id);

                $("#rateAcc" + i).attr("id", "rateAcc" + new_id);

                $("#amtAcc" + i).attr("id", "amtAcc" + new_id);

                $("#row-" + i).attr("id", "row-" + new_id);
                ++new_id;
            }
        }
        //remove every element with class item-0
        //or: thanos snap item-0 out of existence
        $(".item-0").remove();
        chkBoxFunction();
    }
    recompute();
    $("#deleteBtn").css("display", "none");
});

/**From internet function */
function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}
