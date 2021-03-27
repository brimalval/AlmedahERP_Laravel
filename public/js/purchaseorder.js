$("#rowBtn").on('click', function(){
    let tbl = $("#itemTable-content");
    let nextRow = $("#itemTable tbody tr").length + 1;
    tbl.append(`
    <tr>
        <td>
            <div class="form-check">
                <input type="checkbox" id="chk${nextRow}" class="form-check-input">
            </div>
        </td>
        <td class="text-black-50">
            <input type="text" name="item${nextRow}" id="item${nextRow}" onkeyup="fieldFunction(${nextRow});">
        </td>
        <td class="text-black-50">
            <input type="date" name="date${nextRow}" id="date${nextRow}">
        </td>
        <td class="text-black-50">
            <input type="number" name="qty${nextRow}" id="qty${nextRow}" value="0" min="${nextRow}" onkeyup="calcPrice(${nextRow});">
        </td>
        <td class="text-black-50">
            <input type="number" name="rate${nextRow}" id="rate${nextRow}" value="0" min="${nextRow}" onkeyup="calcPrice(${nextRow});">
        </td>
        <td class="text-black-50">
            <input type="text" name="price${nextRow}" id="price${nextRow}" disabled>
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
});

$("#masterChk").change(function() {
    if($(this).is(":checked")) {
        for(let i=1; i<=$("#itemTable tbody tr").length; i++) {
            $("#chk"+i).prop("checked", true);
        }
    } else {
        for(let i=1; i<=$("#itemTable tbody tr").length; i++) {
            $("#chk"+i).prop("checked", false);
        }
    }
});

$("#reqDate").change(function() {
    for(let i=1; i<=$("#itemTable tbody tr").length; i++) {
        $("#date"+i).val($(this).val());
    }
});

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$("#saveOrder").click(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':CSRF_TOKEN,
        }
    });
    var form_data = new FormData();
    var purchased_mats = {};
    //variable x is to be used for checkboxes
    let x = 0;
    for(let i=1; i<=$("#itemTable tbody tr").length; i++) {
        purchased_mats[i] = {
            "item_code" : $("#item"+i).val(),
            "req_date" : $("#date"+i).val(),
            "qty" : parseInt($("#qty"+i).val()),
            "rate" : parseFloat($("#rate"+i).val()),
            "subtotal" : parseFloat($("#price"+i).val())
        }
        //
    }
    console.log(JSON.stringify(purchased_mats));
    form_data.append('purchase_date', $("#transDate").val());
    form_data.set('materials_purchased', JSON.stringify(purchased_mats));
    $.ajax({
        url: '/create-order',
        type: 'POST',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log("Success");
            loadPurchaseOrder();
        }
    });
});

$(document).ready(function () {
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
    for(let i=1; i<=$("#itemTable tbody tr").length; i++) {
        qty += !$("#qty"+i).val() ? 0 : parseInt($("#qty"+i).val());
        price_string = isNaN($("#price"+i).val()) ? $("#price"+i).val().substring(2, 6) : $("#price"+i).val();
        price_num = parseFloat(price_string);
        price += price_num;
    }
    $("#totalQty").val(qty);
    $("#totalPrice").val("₱ " + price.toFixed(2));
}

function calcPrice(id) {
    let qty = !$("#qty"+id).val() ? 0 : parseInt($("#qty"+id).val());
    let rate = !$("#rate"+id).val() ? 0 : parseFloat($("#rate"+id).val());
    let price = isNaN(qty*rate) ? 0 : qty*rate;
    $("#price"+id).val("₱ " + price.toFixed(2));

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
                $(itemId).val(ui.item.item_code); // save selected name to input
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
