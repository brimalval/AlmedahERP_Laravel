var SUPP_SUCCESS = "#s_success_message";
var SUPP_FAIL = "#s_alert_message";

$(document).ready(function() {
    $("#supplierTbl").DataTable({
        "searching": false,
        "info": false,
    });
    $(".supplier-search").selectpicker();
});

$(".supplier-search").change(function (e) { 
    var tbl = $("#supplierTbl").DataTable();
    let url = ''
    if($(this).val() === 'None')
        url = '/supplier-all'
    else {
        let id = $(this).attr('id');
        switch(id) {
            case 'supplierName':
                url = /supp-filter-name/
                break;
            case 'sgroupSelect':
                url = '/supp-filter-sg/'
                break;
        }
        url = url + $(this).val();
        if (url === '') return;
        $.ajax({
            type: 'GET',
            url: url,
            data: $(this).val(),
            contentType: false,
            processData: false,
            success: function(data) {
                tbl.rows('tr').remove();
                var suppliers = data.suppliers;
                if (suppliers.length > 0) {
                    for(let i=0; i<suppliers.length; i++) {
                        var supplier = suppliers[i];
                        tbl.row.add([
                            `
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                            `,
                            `
                            <a href='javascript:onclick=openSupplierInfo(${supplier.id});'>${supplier.company_name}</a>
                            `,
                            supplier.contact_name,
                            supplier.phone_number,
                            supplier.supplier_address,
                            supplier.supplier_group
                        ]);
                    }
                }
                tbl.draw();
            }
        });
    }
    e.preventDefault();
    
});

$("#supplierForm, #updateSupplierForm").submit(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    });

    var formData = new FormData(this);
    if(!$("#supplier_contact").val()) {
        formData.delete('supplier_contact');
    }

    if(
        !$("#supplier_name").val() || !$("#supplier_phone").val() ||
        $("#supplier_group").val() === 'n/o' || !$("#supplier_email").val() || !$("#supplier_address").val()
    ) {
        slideAlert("Please make sure that all the appropriate information has been provided.", SUPP_FAIL);
        return;
    }

    if($("#supplier_phone").val().length != 11) {
        slideAlert("Contact number is not of appropriate length.", SUPP_FAIL);
        return;
    }    

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            loadSupplier();
        }
    });

    return false;

});

$("#deleteSuppForm").submit(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    });
    $.ajax({
        type: "DELETE",
        url: $(this).attr('action'),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            loadSupplier();
        }
    });
    return false;
});

$("#deleteSupplier").click(function () { 
    $("#deleteSuppForm").submit();
});

$("#saveBtn, #updateSupplierBtn").click(function() {
    $("#supplierForm, #updateSupplierForm").submit();
});
