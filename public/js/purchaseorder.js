// Array for storing item codes
var item_codes = [];

// For editing purchase order
if ($("#mp_status").length) {
    for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
        item_codes[i - 1] = $("#item" + i).val();
        calcPrice(i);
    }
    getQtyAndPrice();
}

function onChangeFunction() {
    $("#mp_status").html('Not Yet Saved');
    $("#submitOrder").html('Save');
    $("#submitOrder").off('click', submitOrder);
    //Re-bind event handler as submitOrder changes id
    //Yes, there may be a better way to do this, I just don't have the time lol
    $("#submitOrder").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
            }
        });
        let transDate = new Date($("#transDate").val());
        let reqDate = new Date($("#reqDate").val());
        if (transDate > reqDate) {
            alert('Transaction date is later than required date of materials!');
            return;
        }
        var form_data = new FormData();
        var purchased_mats = {};
        for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
            reqDate = new Date($("#date" + i).val());
            if (transDate > reqDate) {
                alert(`Transaction date is later than required date of ${$("#item" + i).val()}.`);
                return;
            }
            if (parseInt($("#qty" + i).val()) == 0) {
                alert('No quantity for material ' + $("#item" + i).val() + ' specified.');
                return;
            }
            if (parseFloat($("#rate" + i).val()) == 0) {
                alert('No rate for material ' + $("#item" + i).val() + ' specified.');
                return;
            }
            let price_string = $("#price" + i).val().replace("₱ ", '');
            purchased_mats[i] = {
                "item_code": $("#item" + i).val(),
                "supplier_id": $("#supplierField").val(),
                "req_date": $("#date" + i).val(),
                "qty": parseInt($("#qty" + i).val()),
                "rate": parseFloat($("#rate" + i).val()),
                "subtotal": parseFloat(price_string.replaceAll(',', ''))
            }
            //
        }
        //console.log(JSON.stringify(purchased_mats));
        if ($("#purch_id").val()) {
            form_data.append('purchase_id', $("#purch_id").val());
        }

        form_data.append('purchase_date', $("#transDate").val());
        form_data.append('total_price', $(`#totalPrice`).val().replace("₱ ", '').replaceAll(',', ''));
        form_data.set('materials_purchased', JSON.stringify(purchased_mats));

        let url = !$("#mp_status").length ? '/create-order' : '/update-order';

        $.ajax({
            url: url,
            type: 'POST',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log("Success");
                loadPurchaseOrder();
            }
        });
    });
    $("#submitOrder").attr('id', 'saveOrder');
}

// Function for adding rows in the currency and price list
$("#rowBtn").on('click', function () {
    let tbl = $("#itemTable-content");
    let nextRow = $("#itemTable tbody tr").length + 1;
    let chk_status = $("#masterChk").is(":checked") ? "checked" : "";
    tbl.append(`
    <tr id="item-${nextRow}">
        <td>
            <div class="form-check">
                <input type="checkbox" name="item-chk" id="chk${nextRow}" class="form-check-input" ${chk_status}>
            </div>
        </td>
        <td class="text-black-50">
            <input class="form-control" type="text" name="item${nextRow}" id="item${nextRow}" onkeyup="fieldFunction(${nextRow});">
        </td>
        <td class="text-black-50">
            <input class="form-control" type="date" name="date${nextRow}" id="date${nextRow}" value=${$("#reqDate").val()}>
        </td>
        <td class="text-black-50">
            <input class="form-control" type="number" name="qty${nextRow}" id="qty${nextRow}" value="0" onchange="calcPrice(${nextRow});">
        </td>
        <td class="text-black-50">
            <input class="form-control" type="number" name="rate${nextRow}" id="rate${nextRow}" value="0" onchange="calcPrice(${nextRow});">
        </td>
        <td class="text-black-50">
            <input class="form-control" type="text" name="price${nextRow}" id="price${nextRow}" value="₱ 0.00" readonly>
        </td>
        <td class="text-black-50">
            <select class="input--style-4" type="text" name="sampleOne" style="width:50px;height:30px;">
                <option></option>
                <option></option>
                <option></option>
            </select>
        </td>
    </tr> 
    `);

    chkBoxFunction();
});

// Function for deleting rows in currency and price list
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

// When the master checkbox is clicked, every checkbox below it is checked
$("#masterChk").change(function () {
    if ($(this).is(":checked")) {
        for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
            $("#chk" + i).prop("checked", true);
        }
        $("#deleteRow").css('display', 'block');
    } else {
        for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
            $("#chk" + i).prop("checked", false);
        }
        $("#deleteRow").css('display', 'none');
    }
});

// When the "required date" field is changed, the value is
// reflected in the items in the "Currency and Price List" table
$("#reqDate").change(function () {
    for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
        $("#date" + i).val($(this).val());
    }
});

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function submitOrder() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    let purchase_id = $("#purch_id").val();
    if (confirm(`Permanently submit ${purchase_id}?`)) {
        $.ajax({
            url: `/update-status/${purchase_id}`,
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                loadPurchaseOrder();
            }
        });
    } else {
        return;
    }
}

//For permanently changing purchase orders
//Only works on existing purchase orders
$("#submitOrder").on('click', submitOrder);



$("#saveOrder").click(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    let transDate = new Date($("#transDate").val());
    let reqDate = new Date($("#reqDate").val());
    if (transDate > reqDate) {
        alert('Transaction date is later than required date of materials!');
        return;
    }

    var form_data = new FormData();
    var purchased_mats = {};
    for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
        reqDate = new Date($("#date" + i).val());
        if (transDate > reqDate) {
            alert(`Transaction date is later than required date of ${$("#item" + i).val()}.`);
            return;
        }
        if (parseInt($("#qty" + i).val()) == 0) {
            alert('No quantity for material ' + $("#item" + i).val() + ' specified.');
            return;
        }
        if (parseFloat($("#rate" + i).val()) == 0) {
            alert('No rate for material ' + $("#item" + i).val() + ' specified.');
            return;
        }
        let price_string = $("#price" + i).val().replace("₱ ", '');
        purchased_mats[i] = {
            "item_code": $("#item" + i).val(),
            "supplier_id": $("#supplierField").val(),
            "req_date": $("#date" + i).val(),
            "qty": parseInt($("#qty" + i).val()),
            "rate": parseFloat($("#rate" + i).val()),
            "subtotal": parseFloat(price_string.replaceAll(',', ''))
        }
        //
    }
    //console.log(JSON.stringify(purchased_mats));
    if ($("#purch_id").val()) {
        form_data.append('purchase_id', $("#purch_id").val());
    }

    form_data.append('purchase_date', $("#transDate").val());
    form_data.append('total_price', $(`#totalPrice`).val().replace("₱ ", '').replaceAll(',', ''));
    form_data.set('materials_purchased', JSON.stringify(purchased_mats));

    let url = !$("#mp_status").length ? '/create-order' : '/update-order';

    $.ajax({
        url: url,
        type: 'POST',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log("Success");
            loadPurchaseOrder();
        }
    });
});

$(document).ready(function () {
    chkBoxFunction();

    $('#supplierField').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '/search-supplier',
                type: "POST",
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                    search: request.term
                },
                success: function (data) {
                    //console.log(data);
                    response(data);
                    //alert(data[0]['product_code']);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#supplierField').val(ui.item.company_name); // save selected name to input
            $('#suppAddress').val(ui.item.address);
            $('#companyField').val(ui.item.company_name);
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li></li>").data("item.autocomplete", item)
            .append(
                "<a class='form-control'>" +
                "<strong>" + item.company_name + "</strong> - " + item.supplier_id +
                "<br>" +
                "</a>"
            )
            .appendTo(ul);
    }
});

function getQtyAndPrice() {
    let price = 0, qty = 0;
    for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
        qty += !$("#qty" + i).val() ? 0 : parseInt($("#qty" + i).val());
        price_string = isNaN($("#price" + i).val()) ? $("#price" + i).val().replace("₱ ", '') : $("#price" + i).val();
        //console.log(price_string);
        let priceWOComma = price_string.replaceAll(',', '');
        price_num = parseFloat(priceWOComma);
        price += price_num;
    }
    //$("#totalQty").val(qty);
    $("#totalPrice").val("₱ " + numberWithCommas(price.toFixed(2)));
}

function chkBoxFunction() {
    $('input[name="item-chk"]').each(function () {
        $(this).change(function () {
            if ($(this).is(":checked"))
                $("#deleteRow").css('display', 'block');
            else {
                let size = $("#itemTable tbody tr").length;
                for (let i = 1; i <= size; i++) {
                    if ($("#chk" + i).is(":checked")) {
                        return;
                    }
                }
                $("#deleteRow").css('display', 'none');
            }
        });
    });
}

/**From internet function */
function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}

function calcPrice(id) {
    let qty = !$("#qty" + id).val() ? 0 : parseInt($("#qty" + id).val());
    let rate = !$("#rate" + id).val() ? 0 : parseFloat($("#rate" + id).val());
    let price = isNaN(qty * rate) ? 0 : qty * rate;
    $("#price" + id).val("₱ " + numberWithCommas(price.toFixed(2)));

    getQtyAndPrice();
}

function fieldFunction(id, token = CSRF_TOKEN) {
    let itemId = "#item" + id;
    $(document).ready(function () {
        $(itemId).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '/search-item',
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function (data) {
                        //console.log(data);
                        response(data);
                        //alert(data[0]['product_code']);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                let item_code = ui.item.item_code;
                if (item_codes.includes(item_code) && item_codes.indexOf(item_code) !== id - 1) {
                    alert('Raw Material already selected.');
                    $(itemId).val(null);
                } else {
                    item_codes[id - 1] = item_code;
                    $(itemId).val(ui.item.item_code); // save selected name to input
                }
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>").data("item.autocomplete", item)
                .append(
                    "<a class='form-control'>" +
                    "<strong>" + item.item_name + "</strong> - " + item.item_code +
                    "<br>" +
                    "</a>"
                )
                .appendTo(ul);
        }
    });
}
