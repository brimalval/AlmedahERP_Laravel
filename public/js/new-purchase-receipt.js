var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function () {
    
});

$('#saveReceipt').click(function () { 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    let formData = new FormData();
    let received_mats = {};

    for(let i=1; i<=$('#itemsToReceive tr').length; i++) {
        received_mats[i] = {
            "item_code" : $(`#item_code${i}`).val(),
            "qty_received" : $(`#qtyAcc${i}`).val(),
            "rate": $(`#rateAcc${i}`).val(),
            "amount": $(`#amtAcc${i}`).val(),
        }
    }

    formData.append('date_created', $('#npr_date').val());
    formData.append('purchase_id', $('#orderId').val());
    formData.append('items_received', JSON.stringify(received_mats));
    formData.append('grand_total', $('#receivePrice').val());

    $.ajax({
        type: "POST",
        url: '/create-receipt',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            loadPurchaseReceipt();
        }
    });
    
});

function chkBoxFunction() {
    $('input[name="item-chk"]').each(function () {
        $(this).change(function () {
            if ($(this).is(":checked"))
                $("#deleteBtn").css('display', 'inline-block');
            else {
                let size = $('#itemsToReceive tr').length;
                for (let i = 1; i <= size; i++) {
                    if ($("#chk" + i).is(":checked")) {
                        return;
                    }
                }
                $("#deleteBtn").css('display', 'none');
            }
        });
    });
}

function loadMaterials(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
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
            $('#orderId').val(data.purchase_id);
            console.log($('#orderId').val());
            let table = $('#itemsToReceive');
            $('#itemsToReceive tr').remove();
            for(let i=1; i<=data.ordered_mats.length; i++) {
                table.append(
                    `
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" name="item-chk" id="chk${i}" class="form-check-input">
                            </div>
                        </td>
                        <td class="text-black-50">
                            <input class="form-control" type="text" id="item_code${i}" value=${data.ordered_mats[i-1]['item_code']}>
                        </td>
                        <td class="text-black-50">
                            <input class="form-control" id="qtyAcc${i}" type="number" min="0" value=${data.ordered_mats[i-1]['qty']}>
                        </td> 
                        <td class="text-black-50">
                            <input class="form-control" id="rateAcc${i}" type="text" min="0" value=${data.ordered_mats[i-1]['rate']}>
                        </td> 
                        <td class="text-black-50">
                            <input class="form-control" id="amtAcc${i}" type="text" min="0" value=${data.ordered_mats[i-1]['subtotal']}>
                        </td> 
                    </tr>
                    `
                );
                total_qty += parseInt(data.ordered_mats[i-1]['qty']);
                total_price += parseFloat(data.ordered_mats[i-1]['subtotal']);
            }
            $('#receiveQty').val(total_qty);
            $('#receivePrice').val(total_price);
        }
    });
}

$("#mainChk").change(function () {
    if ($(this).is(":checked")) {
        for (let i = 1; i <= $('#itemsToReceive tr').length; i++) {
            $("#chk" + i).prop("checked", true);
        }
        $("#deleteBtn").css('display', 'inline-block');
    } else {
        for (let i = 1; i <= $('#itemsToReceive tr').length; i++) {
            $("#chk" + i).prop("checked", false);
        }
        $("#deleteBtn").css('display', 'none');
    }
});

$("#rowBtn").click(function () { 
    let table = $('#itemsToReceive');
    let nextRow = $('#itemsToReceive tr').length + 1;
    if($('#nullRow').length) $('#itemsToReceive tr').remove();
    table.append(
        `
        <tr>
            <td>
                <div class="form-check">
                    <input type="checkbox" name="item-chk" id="chk${nextRow}" class="form-check-input">
                </div>
            </td>
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
    let table = $('#itemsToReceive');
    if ($("#mainChk").is(":checked") || $('input[name="item-chk"]:checked').length == $("#itemTable tbody tr").length) {
        table.append(
            `
            <tr id='nullRow'>
                <td colspan="7" style="text-align: center;">
                    NO DATA
                </td>
            </tr>
            `
        );
    }
});

/**From internet function */
function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}

/**
 * // Function for deleting rows in currency and price list
$("#deleteRow").click(function () {
    let tbl = $("#itemTable-content");
    let nextRow = $("#itemTable tbody tr").length + 1;
    //if (size == 1) {
    //    $("#chk1").prop('checked', false);
    //    $("#item1").val(null);
    //    $("#qty1").val("0");
    //    $("#rate1").val("0");
    //    $("#price1").val("₱ 0.00");
    //}
    if ($("#masterChk").is(":checked") || $('input[name="item-chk"]:checked').length == $("#itemTable tbody tr").length) {
        //When all table rows are removed, leave one new field 
        $("#itemTable tbody tr").remove();
        $("#itemTable tbody").append(
            `
            <tr id="item-1">
                <td>
                    <div class="form-check">
                        <input type="checkbox" name="item-chk" id="chk1" class="form-check-input">
                    </div>
                </td>
                <td class="text-black-50">
                    <input class="form-control" type="text" name="item1" id="item1" onkeyup="fieldFunction(1);">
                </td>
                <td class="text-black-50">
                    <input class="form-control" type="date" name="date1" id="date1" value=${$("#reqDate").val()}>
                </td>
                <td class="text-black-50">
                    <input class="form-control" type="number" name="qty1" id="qty1" value="0" min="1" onchange="calcPrice(1);">
                </td>
                <td class="text-black-50">
                    <input class="form-control" type="number" name="rate1" id="rate1" value="0" min="1" onchange="calcPrice(1);">
                </td>
                <td class="text-black-50">
                    <input class="form-control" type="text" name="price1" id="price1" value="₱ 0.00" readonly>
                </td>
                <td class="text-black-50">
                    <select class="input--style-4" type="text" name="sampleOne" style="width:50px;height:30px;">
                        <option></option>
                        <option></option>
                        <option></option>
                    </select>
                </td>
            </tr> 
            `
        );
        $("#masterChk").prop('checked', false);
        item_codes = [];
    } else {
        let new_id = 1;
        for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
            if ($("#chk" + i).is(":checked")) {
                // "mark" every row to be deleted
                $("#item-" + i).attr('class', 'item-0');
            } else {
                // assign new ids and attributes to unchecked elements
                // reassign attributes first before id's
                // otherwise, the attributes of wrong id will be reassigned
                $("#chk" + i).attr('id', 'chk' + new_id);

                $("#item-" + i).attr('id', 'item-' + new_id);

                $("#item" + i).attr('name', 'item' + new_id);
                $("#item" + i).attr('onkeyup', 'fieldFunction(' + new_id + ');');
                $("#item" + i).attr('id', 'item' + new_id);

                $("#date" + i).attr('name', 'date' + new_id);
                $("#date" + i).attr('id', 'date' + new_id);

                $("#qty" + i).attr('name', 'qty' + new_id);
                $("#qty" + i).attr('onchange', 'calcPrice(' + new_id + ');');
                $("#qty" + i).attr('id', 'qty' + new_id);

                $("#rate" + i).attr('name', 'rate' + new_id);
                $("#rate" + i).attr('onchange', 'calcPrice(' + new_id + ');');
                $("#rate" + i).attr('id', 'rate' + new_id);

                $("#price" + i).attr('name', 'price' + new_id);
                $("#price" + i).attr('id', 'price' + new_id);
                ++new_id;
            }
        }
        //remove every element with class item-0
        //or: thanos snap item-0 out of existence
        $(".item-0").remove();
        let new_array = [];
        for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
            new_array[i - 1] = $("#item" + i).val();
        }
        item_codes = new_array;
    }
    chkBoxFunction();
    $("#deleteRow").css('display', 'none');
    getQtyAndPrice();
});
 */