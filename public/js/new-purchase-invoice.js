var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$("#saveInvoice").on('click', createInvoice);

$(document).ready(function () {
    if ($("#paymentMode").val() === 'Installment') {
        $("#installmentGrp").attr('hidden', false);
    } else {
        $("#installmentGrp").attr('hidden', true);
    }
    var amount = 0;
    if($("#emptyPILog").length) {
        amount = parseFloat($("#priceToPay").val()) / 4;        
    } else {
        amount = parseFloat($("#priceToPay").val()) / parseFloat($("#installmentType").val());     
    }
    $("#payAmount").val(amount.toFixed(2));
});

function viewChequeDetails(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
    $.ajax({
        type: "GET",
        url: `/view-chq/${id}`,
        data: id,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#chq-accNo').html(response.acct_no);
            $('#chq-num').html(response.chq_no);
            $('#chq-bank').html(response.bank_name);
            $('#chq-branch').html(response.branch);
        }
    });
}

function onChangePIFunction() {
    $("#submitInvoice").html("Save");
    $("#submitInvoice").attr('onclick', 'createInvoice()');
    $("#submitInvoice").prop('id', 'saveInvoice');
}

$("#payInvoice").click(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    let formData = new FormData();

    if (!$("#payAmount").val()) {
        alert('Please enter an amount before creating a record.');
        return;
    }

    if($("#paymentMethod").val() === 'non') {
        alert('Cannot create payment record without payment method!');
        return;
    }

    if (!$("#chq").prop('hidden')) {
        var msg = '';
        if (!$('#acctNo').val() || !$('#chqNo').val() || !$("#bankName").val() || !$("#bankBranch").val()) {
            if (!$('#acctNo').val())
                msg = 'account number';
            else if (!$('#chqNo').val())
                msg = 'cheque number';
            else if (!$('#bankName').val())
                msg = 'bank';
            else if (!$('#bankBranch').val())
                msg = 'bank location';
            alert(`Please provide the check's ${msg}.`);
            return;
        } else {
            formData.append('account_no', $('#acctNo').val());
            formData.append('cheque_no', $('#chqNo').val());
            formData.append('bank_name', $("#bankName").val());
            formData.append('bank_location', $("#bankBranch").val());
        }
    }

    id = $("#invoiceId").val();

    formData.append('invoice_id', id);
    formData.append('amount_to_pay', $("#payAmount").val());
    formData.append('payment_method', $("#paymentMethod").val());
    formData.append('amount_paid', $("#payAmount").val());
    formData.append('payment_date', $("#transDate").val());

    $.ajax({
        type: "POST",
        url: `/pay-invoice/${id}`,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            loadPurchaseInvoice();
            if($("#contentPurchaseOrder").length) {
                loadPurchaseOrder();
            }
            if($("#contentPurchaseReceipt").length) {
                loadPurchaseReceipt();
            }
        }
    });
});

function createInvoice() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    let formData = new FormData();

    if ($("#emptyRow").length) {
        alert("Load a purchase receipt first.");
        return;
    }
    
    if($("#paymentMode").val() === 'non') {
        alert('Cannot create payment invoice without specifying payment mode!');
        return;
    }

    let url = "/create-invoice";

    if($("#invoiceId").length) {
        formData.append("invoice_id", $("#invoiceId").val());
        url = `/update-invoice-record/${$("#invoiceId").val()}`
    }

    formData.append('receipt_id', $("#receiptId").val());
    formData.append('date_created', $("#npi_date").val());
    formData.append('payment_mode', $("#paymentMode").val());
    formData.append('amount', $("#priceToPay").val());

    if ($("#installmentType").prop('hidden') === true) {
        formData.append('installment_type', $("#installmentType").val());
    }

    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            loadPurchaseInvoice();
        }
    });

}

$("#paymentMode").change(function () {
    if ($(this).val() === 'Installment') {
        $("#installmentGrp").attr('hidden', false);
    } else {
        $("#installmentGrp").attr('hidden', true);
    }
});


$("#paymentMethod").change(function () {
    if ($(this).val() === 'Cheque') {
        $("#chq").prop('hidden', false);
    } else {
        $("#chq").prop('hidden', true);
    }
});

function updateInvoiceStatus() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
    if (confirm(`Permanently submit ${$("#invoiceId").val()}?`)) {
        $.ajax({
            type: "POST",
            url: `/update-invoice-status/${$("#invoiceId").val()}`,
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

    $.ajax({
        type: "GET",
        url: `/get-materials-from-mp/${id}`,
        data: id,
        contentType: false,
        processData: false,
        success: function (data) {
            //$('#orderId').val(data.purchase_id);
            //console.log($('#orderId').val());
            $("#receiptId").val(data.p_receipt_id);
            $("#suppName").val(data.supplier.company_name);
            $("#suppAdd").val(data.supplier.supplier_address);
            let table = $('#itemsReceived');
            $('#itemsReceived tr').remove();
            var items = data.ordered_mats;
            for (let i = 1; i <= items.length; i++) {
                table.append(
                    `
                    <tr id="row-${i}">
                        <td class="text-black-50">
                            <span id="item_code${i}">${items[i - 1].item.item_code}</span>
                        </td>
                        <td class="text-black-50">
                            <span id="item_name${i}">${items[i-1].item.item_name}</span>
                        </td>
                        <td class="text-black-50">
                            <span id="qtyAcc${i}">${items[i - 1]['qty']}</span>
                        </td> 
                        <td class="text-black-50">
                            <span id="rateAcc${i}">${items[i - 1]['rate']}</span>
                        </td> 
                        <td class="text-black-50">
                            <span id="amtAcc${i}">${items[i - 1]['subtotal']}</span>
                        </td> 
                    </tr>
                    `
                );
                //total_qty += parseInt(items[i-1]['qty']);
                total_price += parseFloat(items[i - 1]['subtotal']);
            }
            //$('#receiveQty').val(total_qty);
            $('#priceToPay').val(total_price);
        }
    });
}