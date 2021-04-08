var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$("#saveInvoice").click(function () { 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    let formData = new FormData();

    formData.append('receipt_id', $("#receiptId").val());
    formData.append('date_created', $("#npi_date").val());
    formData.append('due_date', $("#npi_due_date").val());
    formData.append('payment_mode', $("#paymentMode").val());
    formData.append('amount', $("#priceToPay").val());

    $.ajax({
        type: "POST",
        url: "/create-invoice",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            loadPurchaseInvoice();
        }
    });
    
});

function payInvoice() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
    if(confirm(`Permanently submit ${$("#invoiceId").val()}?`)) {
        $.ajax({
            type: "POST",
            url: `/pay-invoice/${$("#invoiceId").val()}`,
            data: $("#invoiceId").val(),
            contentType: false,
            processData: false,
            success: function (response) {
                loadPurchaseInvoice();
            }
        });
    }
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
        url: `/get-received-mats/${id}`,
        data: id,
        contentType: false,
        processData: false,
        success: function (data) {
            //$('#orderId').val(data.purchase_id);
            //console.log($('#orderId').val());
            $("#receiptId").val(data.p_receipt_id);
            console.log($("#receiptId").val());
            let table = $('#itemsReceived');
            $('#itemsReceived tr').remove();
            for (let i = 1; i <= data.received_mats.length; i++) {
                table.append(
                    `
                    <tr id="row-${i}">
                        <td>
                            <div class="form-check">
                                <input type="checkbox" name="item-chk" id="chk${i}" class="form-check-input">
                            </div>
                        </td>
                        <td class="text-black-50">
                            <input class="form-control" type="text" id="item_code${i}" value=${data.received_mats[i - 1]['item_code']}>
                        </td>
                        <td class="text-black-50">
                            <input class="form-control" id="qtyAcc${i}" type="number" min="0" value=${data.received_mats[i - 1]['qty']} onchange="calcPrice(${i})">
                        </td> 
                        <td class="text-black-50">
                            <input class="form-control" id="rateAcc${i}" type="text" min="0" value=${data.received_mats[i - 1]['rate']} onchange="calcPrice(${i})">
                        </td> 
                        <td class="text-black-50">
                            <input class="form-control" id="amtAcc${i}" type="text" min="0" value=${data.received_mats[i - 1]['amount']}>
                        </td> 
                    </tr>
                    `
                );
                //total_qty += parseInt(data.received_mats[i - 1]['qty']);
                total_price += parseFloat(data.received_mats[i - 1]['amount']);
            }
            //$('#receiveQty').val(total_qty);
            $('#priceToPay').val(total_price);
        }
    });
}