// Array for storing item codes
var item_codes = [];

var PO_SUCCESS = "#po_success_message";
var PO_FAIL = "#po_alert_message";

// For editing purchase order
if ($("#mp_status").length) {
    for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
        item_codes[i - 1] = $("#item" + i).html();
        calcPrice(i);
    }
    getQtyAndPrice();
}

function onChangeFunction() {
    $("#preSubmit").hide();
    $("#saveOrder").show();
}

// Function for adding rows in the currency and price list
$("#rowBtn").on('click', function () {
    let tbl = $("#itemTable-content");
    let nextRow = ($("#emptyRow").html()) ? 1 :("#itemTable tbody tr").length + 1;
    let chk_status = $("#masterChk").is(":checked") ? "checked" : "";
    if($("#emptyRow").html()) {
        $("#emptyRow").remove();
    }
    tbl.append(`
    <tr id="item-${nextRow}">
        <td>
            <div class="form-check">
               <input type="checkbox" name="item-chk" id="chk${nextRow}" class="form-check-input" ${chk_status}>
            </div>
        </td>
        <td class="text-black-50">
            <input type="text" name="item${nextRow}" id="item${nextRow}" onkeyup="fieldFunction(${nextRow});">
        </td>
        <td class="text-black-50">
            <span name="itemName${nextRow}" id="itemName${nextRow}"></span>
        </td>
        <td class="text-black-50">
            <input type="date" name="date${nextRow}"
                id="date${nextRow}" value=${$("#reqDate").val()}>
        </td>
        <td class="text-black-50">
            <input type="number" name="qty${nextRow}" id="qty${nextRow}" value="0" onchange="calcPrice(${nextRow});">
        </td>
        <td class="text-black-50">
        <input type="number" name="rate${nextRow}" id="rate${nextRow}" value="0" onchange="calcPrice(${nextRow});">
        </td>
        <td class="text-black-50">
        <input type="text" name="price${nextRow}" id="price${nextRow}" value="₱ 0.00" readonly>
        </td>
    </tr>
    `);
    onChangeFunction();
    chkBoxFunction();
});

// Function for deleting rows in currency and price list
$("#deleteRow").click(function () {
    if ($("#masterChk").is(":checked") || $('input[name="item-chk"]:checked').length == $("#itemTable tbody tr").length) {
        //When all table rows are removed, leave one new field 
        $("#itemTable tbody tr").remove();
        $("#itemTable tbody").append(
            `
            <tr id="item-1">
                <td id="emptyRow" valign="top" colspan="7" class="dataTables_empty">No data available in table</td>
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

                $("#item" + i).attr('name', 'itemName' + new_id);
                $("#item" + i).attr('onkeyup', 'fieldFunction(' + new_id + ');');
                $("#item" + i).attr('id', 'itemName' + new_id);

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
    onChangeFunction();
    $("#deleteRow").css('display', 'none');
    getQtyAndPrice();
});

// When the master checkbox is clicked, every checkbox below it is checked
$("#masterChk").change(function () {
    if ($(this).is(":checked")) {
        for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
            $("#chk" + i).prop("checked", true);
        }
        $("#deleteRow").css('display', 'inline-block');
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

//var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function submitOrder() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    let purchase_id = $("#purch_id").val();
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
}

function viewQuotationItems(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
    $.ajax({
        type: "GET",
        url: `/view-sq-items/${id}`,
        data: id,
        processData: false,
        contentType: false,
        success: function (response) {
            let table = $("#order_itemList tbody");
            $("#order_itemList tbody tr").remove();
            let items = response.items;
            for(let i=0; i<items.length; i++) {
                let subtotal = parseFloat(items[i].rate) * parseFloat(items[i].quantity_requested);
                let price_string = numberWithCommas(subtotal.toFixed(2));
                table.append(
                    `
                    <tr>
                        <td>${items[i].item_code}</td>
                        <td>${items[i].item.item_name}</td>
                        <td>${items[i].quantity_requested}</td>
                        <td>${items[i].rate}</td>
                        <td>₱ ${price_string}</td>
                    </tr>
                    `
                );
            }    
        }
    });

}

$("#cancelOrder").click(function () { 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
    let cancel = confirm("Are you sure that you want to cancel this purchase order?");

    if(cancel) {
        $.ajax({
            type: "POST",
            url: `/delete-order/${$("#p_id").html()}`,
            success: function (response) {
                if(response.error) {
                    alert(response.error);
                    return;
                }
                loadPurchaseOrder();
                if($("#contentPurchaseReceipt").length) {
                    loadPurchaseReceipt();
                }
                if($("#contentPurchaseInvoice").length) {
                    loadPurchaseInvoice();
                }
                if($("#contentPendingOrders").length) {
                    loadPendingOrders();
                }
            }
        });
    }
    
});

//For permanently changing purchase orders
//Only works on existing purchase orders
$("#submitOrder").on('click', submitOrder);

function loadQuotation(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
    $.ajax({
        type: "GET",
        url: `/get-quotation/${id}`,
        data: id,
        contentType: false,
        processData: false,
        success: function (data) {
            let supplier = data.supplier;
            let sq_id = data.quotation.supp_quotation_id;
            $("#itemTable-content tr").remove();
            let tbl = $("#itemTable-content");
            $("#sqID").val(sq_id);
            $("#reqDate").val(data.req_date);
            let chk_status = $("#masterChk").is(":checked") ? "checked" : "";
            $("#hiddenSupplierField").val(supplier.supplier_id);
            $("#supplierField").val(supplier.company_name);
            $("#suppAddress").val(supplier.supplier_address);
            if(supplier.contact_name) {
                $("#supplierContact").val(supplier.contact_name);
            }
            for (let i = 1; i <= data.items.length; i++) {
                let item = data.items[i - 1];
                let subtotal = parseFloat(item.quantity_requested) * parseFloat(item.rate);
                let price_string = numberWithCommas(subtotal.toFixed(2));
                tbl.append(
                    `
                    <tr id="item-${i}">
                        <td>
                            <input type="checkbox" name="item-chk" id="chk${i}" ${chk_status}>
                        </td>
                        <td class="text-black-50">
                            <span name="item${i}" id="item${i}">${item.item_code}</span>
                        </td>
                        <td class="text-black-50">
                            <span name="itemName${i}" id="itemName${i}">${item.item.item_name}</span>
                        </td>
                        <td class="text-black-50">
                            <input type="date" name="date${i}" id="date${i}" value=${$("#reqDate").val()}>
                        </td>
                        <td class="text-black-50">
                            <span name="qty${i}" id="qty${i}"> ${item.quantity_requested} </span>
                        </td>
                        <td class="text-black-50">
                            <span name="rate${i}" id="rate${i}">${item.rate} </span>
                        </td>
                        <td class="text-black-50">
                            ₱ <span name="price${i}" id="price${i}">${price_string}</span>
                        </td>
                    </tr> 
                    `
                );
            }
            let new_array = [];
            for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
                new_array[i - 1] = $("#item" + i).val();
            }
            item_codes = new_array;
            slideAlert(`${sq_id} loaded in Purchase Order.`, PO_SUCCESS);
            getQtyAndPrice();
            chkBoxFunction();
        }
    });
}

$("#saveOrder").click(saveOrder);

function saveOrder() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    let transDate = new Date($("#transDate").val());
    let reqDate = new Date($("#reqDate").val());
    if (transDate > reqDate) {
        slideAlert('Order date is later than required date of materials!', PO_FAIL);
        return;
    }

    var form_data = new FormData();
    var purchased_mats = {};
    var materialCount = 0;
    for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
        reqDate = new Date($("#date" + i).val());
        if (transDate > reqDate) {
            slideAlert(`Transaction date is later than required date of ${$("#item" + i).html()}.`, PO_FAIL);
            return;
        }
        if (parseInt($("#qty" + i).val()) == 0) {
            slideAlert('No quantity for material ' + $("#item" + i).html() + ' specified.', PO_FAIL);
            return;
        }
        if (parseFloat($("#rate" + i).val()) == 0) {
            slideAlert('No rate for material ' + $("#item" + i).html() + ' specified.', PO_FAIL);
            return;
        }
        let price_string = $("#price" + i).html().replace("₱ ", '');
        purchased_mats[i] = {
            "item_code": $("#item" + i).html(),
            "supplier_id": $("#hiddenSupplierField").val(),
            "req_date": $("#date" + i).val(),
            "qty": parseInt($("#qty" + i).html()),
            "rate": parseFloat($("#rate" + i).html()),
            "subtotal": parseFloat(price_string.replaceAll(',', ''))
        }
        ++materialCount;
    }
   
    let materials_list = JSON.stringify(purchased_mats);

    if ($("#purch_id").val()) {
        form_data.append('purchase_id', $("#purch_id").val());
    }

    form_data.append('sq_id', $("#sqID").val());
    form_data.append('purchase_date', $("#transDate").val());
    form_data.append('total_price', $(`#totalPrice`).val().replace("₱ ", '').replaceAll(',', ''));
    form_data.set('materials_purchased', materials_list);

    let url = !$("#mp_status").length ? '/create-order' : '/update-order';
    let purchase_id = '';

    $.ajax({
        url: url,
        type: 'POST',
        data: form_data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            slideAlert("Purchase Order successfully created!", PO_SUCCESS);
            purchase_id = data.purchase_id;
        }
    });


    //Only store these materials when creating purchase order
    if (!$("#purch_id").val()) {
        let materialData = new FormData();
        materialData.append('materials_list', materials_list);

        $.ajax({
            type: "POST",
            url: `/store-mp-materials/${purchase_id}`,
            data: materialData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                loadPurchaseOrder();
            }
        });
    }

}

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
    let price_string = '';
    for (let i = 1; i <= $("#itemTable tbody tr").length; i++) {
        qty += !$("#qty" + i).html() ? 0 : parseInt($("#qty" + i).html());
        price_string = $(`#price${i}`).html();
        console.log(price_string);
        let priceWOComma = price_string.replaceAll(',', '');
        price_num = parseFloat(priceWOComma);
        price += price_num;
    }
    console.log(price);
    //$("#totalQty").val(qty);
    $("#totalPrice").val("₱ " + numberWithCommas(price.toFixed(2)));
}

function chkBoxFunction() {
    $('input[name="item-chk"]').each(function () {
        $(this).change(function () {
            if ($(this).is(":checked"))
                $("#deleteRow").css('display', 'inline-block');
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
    let qty = !$("#qty" + id).html() ? 0 : parseInt($("#qty" + id).html());
    let rate = !$("#rate" + id).html() ? 0 : parseFloat($("#rate" + id).html());
    let price = isNaN(qty * rate) ? 0 : qty * rate;
    $("#price" + id).html(numberWithCommas(price.toFixed(2)));

    getQtyAndPrice();
}

function fieldFunction(id, token = CSRF_TOKEN) {
    let itemId = `#item${id}`;
    let nameId = `#itemName${id}`;
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
                        response(data);
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
                    $(nameId).html(ui.item.item_name);
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
