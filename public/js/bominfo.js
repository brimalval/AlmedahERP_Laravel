var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
/**
 * $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
 */

$(document).ready(function () {
    $('#table_operations').DataTable();
    $('#table_materials').DataTable();
    $('#table_costing').DataTable();
});

$("#routingSelect").change(function () {
    if ($(this).val() === 'newRouting') {
        showRoutingsForm();
        $(this).val(0);
    } else {
        var routing_code = $(this).val();
        $("#bom-operations tbody tr").remove();
        var table = $('#bom-operations tbody');
        $.ajax({
            type: "GET",
            url: `/get-routing-ops/${routing_code}`,
            data: routing_code,
            success: function (response) {
                let operations = response.operations;
                for (let i = 0; i < operations.length; i++) {
                    table.append(
                        `
                        <tr id="bomOperation-${i}">
                                <td class="text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td id="mr-code-input" class="mr-code-input"><input type="text" value="${operations[i].operation.operation_name}" readonly
                                        name="Operation_name" id="Operation_name" class="form-control"></td>
                                <td style="width: 10%;" class="mr-qty-input"><input type="text" value="${operations[i].operation.wc_code}" readonly
                                        name="D_workcenter" id="D_workcenter" class="form-control"></td>
                                <td class="mr-unit-input"><input type="text" value="${operations[i].operation.description}" readonly name="Desc" id="Desc"
                                        class="form-control"></td>
                                <td class="mr-unit-input"><input type="text" value="${operations[i].operation_time}" readonly name="Operation_Time"
                                        id="Operation_Time" class="form-control"></td>
                                <td class="mr-unit-input"><input type="text" value="${operations[i].operating_cost}" readonly name="Operation_cost"
                                        id="Operation_cost" class="form-control"></td>

                                <td>
                                    <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#"
                                        role="button">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a id="" class="btn delete-btn" href="#" role="button">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        `
                    );
                }
                computeCosts();
            }
        });
    }
});

function computeCosts() {
    var materialCost = 0;
    var opCost = 0;
    var operations = $("#bom-operations tbody tr");
    for (let i = 0; i < operations.length; i++) {
        let operation = $(`#bomOperation-${i}`);
        let op_indiv_cost = operation.find("#Operation_cost").val();
        opCost += parseFloat(op_indiv_cost);
    }
    var materials = $("#bom-materials tbody tr");
    for(let i = 0; i < materials.length; i++) {
        let material = $(`#bomMaterial-${i}`);
        let mat_indiv_cost = material.find("#Amount").val();
        materialCost += parseFloat(mat_indiv_cost);
    }
    var totalCost = parseFloat(opCost) + parseFloat(materialCost);
    $("#totalOpCost").val(parseFloat(opCost));
    $("#totalMatCost").val(parseFloat(materialCost));
    $("#totalBOMCost").val(parseFloat(totalCost));
}

/**Experimental function from back-end*/
function showRoutingsForm() {
    let menu = 'NewRouting';
    if (!$(`#tab${menu}`).length) {
        $("#tabs").append(
            `<li class="nav-item menu-item">
        <a class="nav-link" data-toggle="tab" href="#content${menu}" id="tab${menu}">
              New Routing <b class="closeTab text close ml-4">x</b>
        </a>
    </li>`
        );
        // append the content of the tab
        $("#contents").append(
            `<div class="tab-pane active p-0" id="content${menu}">
    </div>`
        );
        //goes to a specific module
        var $link = `${menu}`;
        var $parent = $(this).attr("data-parent");
        // set custom module route defined in data-module attribute
        if (typeof $(this).attr("data-module-url") !== "undefined") {
            $link = $(this).attr("data-module-url");
        }
        $(`#content${menu}`).load(
            "/" + $link.toLowerCase(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "error") {
                    console.log(
                        "Error: " + xhr.status + ": " + xhr.statusText
                    );
                    console.log($parent);
                    $(`#content${menu}`).load(
                        "/" + $link.toLowerCase(),
                        function (responseTxt, statusTxt, xhr) {
                            if (statusTxt == "error")
                                alert(
                                    "Error: " +
                                    xhr.status +
                                    ": " +
                                    xhr.statusText
                                );
                        }
                    );
                }
                //console.log("/" + $link.toLowerCase());
            }
        );
    }
    $(`#tab${menu}`).tab("show");
}

$(`#manprod`).change(function () {
    let showForm = $(this).val();
    if (showForm == 0) {
        $("#item_content").css("display", "none");
        $(`#Item_name`).val(null);
        $(`#Item_UOM`).val(null);
    }
    else {
        $("#item_content").css("display", "block");
    }
    let prod_code = $(this).val().trim();
    $.ajax({
        type: "GET",
        url: `/get-product/${prod_code}`,
        data: prod_code,
        success: function (response) {
            let product = response.product;
            $(`#Item_name`).val(product.product_name);
            $(`#Item_UOM`).val(product.unit);
            var table = $("#bom-materials tbody");
            $("#bom-materials tbody tr").remove();
            let materials = response.materials_info;
            for(let i = 0; i < materials.length; i++) {
                let subtotal = parseFloat(materials[i].product_rates.rate) * parseFloat(materials[i].qty);
                table.append(
                    `
                    <tr id="bomMaterial-${i}">
                        <td class="text-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td id="mr-code-input" class="mr-code-input"><input type="text" value="${i+1}" readonly
                                name="No" id="No" class="form-control"></td>
                        <td style="width: 10%;" class="mr-qty-input"><input type="text" value="${materials[i].product_rates.item.item_code}" readonly
                                name="ItemCode" id="ItemCode" class="form-control"></td>
                        <td class="mr-unit-input"><input type="text" value="${materials[i].qty}" readonly name="Quantity"
                                id="Quantity" class="form-control"></td>
                        <td class="mr-unit-input"><input type="text" value="${materials[i].product_rates.item.uom_id}" readonly name="UOM" id="UOM"
                                class="form-control"></td>
                        <td class="mr-unit-input"><input type="text" value="${materials[i].product_rates.rate}" readonly name="Rate" id="Rate"
                                class="form-control"></td>
                        <td class="mr-unit-input"><input type="number" value="${subtotal}" readonly name="Amount" id="Amount"
                                class="form-control"></td>
                        <td>
                            <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#"
                                role="button">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a id="" class="btn delete-btn" href="#" role="button">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    `
                )
            }
            computeCosts();
        }, error: function (response) {
            console.log(response);
        }
    });
});

function addRowoperations() {
    if ($('#no-data')[0]) {
        deleteItemRow($('#no-data').parents('tr'));
    }
    let lastRow = $('#operations-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#operations-input-rows').append(
        `<tr data-id="${nextID}">
        <td class="text-center">

        <div class="form-check" >
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly name="Operation_name" id="Operation_name" class="form-control"></td>
        <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly name="D_workcenter" id="D_workcenter" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Desc" id="Desc" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Operation_Time" id="Operation_Time" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Operation_cost" id="Operation_cost" class="form-control"></td>

        <td>
            <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#" role="button">
                <i class="fa fa-edit" aria-hidden="true"></i>
            </a>
            <a id="" class="btn delete-btn" href="#" role="button">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
    </tr>`);
    $('#selects select[data-id="item_code"]').clone().appendTo(`#items-tbl tr:last .mr-code-input`).selectpicker();
    $('#selects select[data-id="station_id"]').clone().appendTo(`#items-tbl tr:last .mr-target-input`).selectpicker();
    $('#selects select[data-id="uom_id"]').clone().appendTo(`#items-tbl tr:last .mr-unit-input`).selectpicker();
    $('#items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
}

function addRowmaterials() {
    if ($('#no-data')[0]) {
        deleteItemRow($('#no-data').parents('tr'));
    }
    let lastRow = $('#materials-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#materials-input-rows').append(
        `                <tr data-id="${nextID}">
    <td class="text-center">

    <div class="form-check" >
        <input type="checkbox" class="form-check-input">
    </div>
    </td>
    <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly name="No" id="No" class="form-control"></td>
    <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly name="ItemCode" id="ItemCode" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Quantity" id="Quantity" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="UOM" id="UOM" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Rate" id="Rate" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Amount" id="Amount" class="form-control"></td>
    <td>
        <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#" role="button">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
        <a id="" class="btn delete-btn" href="#" role="button">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>`);
    $('#selects select[data-id="item_code"]').clone().appendTo(`#items-tbl tr:last .mr-code-input`).selectpicker();
    $('#selects select[data-id="station_id"]').clone().appendTo(`#items-tbl tr:last .mr-target-input`).selectpicker();
    $('#selects select[data-id="uom_id"]').clone().appendTo(`#items-tbl tr:last .mr-unit-input`).selectpicker();
    $('#items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
}

$("#saveBom").click(function () {
    $("#saveBomForm").submit();
});

$("#saveBomForm").submit(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    if($("#manprod").val() == 0) {
        alert('No product/component to make a BOM on.')
        return;
    }
    if($("#routingSelect").val() == 0) {
        alert('No routing has been provided.')
        return;
    }

    let bomData = new FormData(this);
    let isActive = $("#Is_active").prop('checked') ? 1 : 0;
    let isDefault = $("#default").prop('checked') ? 1 : 0;
    let productsAndRates = {};

    for(let i=0; i<$("#bom-materials tbody tr").length; i++) {
        let material = $(`#bomMaterial-${i}`);
        productsAndRates[i] = {
            'item_code' : material.find("#ItemCode").val(),
            'qty' : parseInt(material.find("#Quantity").val()),
            'rate' : parseFloat(material.find("#Rate").val()),
        }
    }

    bomData.append('product_code', $("#manprod").val());
    bomData.append('routing_id', $("#routingSelect").val());
    bomData.append('is_active', isActive);
    bomData.append('is_default', isDefault);
    bomData.append('rm_cost', parseFloat($("#totalMatCost").val()));
    bomData.append('total_cost', parseFloat($("#totalBOMCost").val()));
    bomData.append('rm_rates', JSON.stringify(productsAndRates));

    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: bomData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log('bom sent');
            loadBOMtable();
        }
    });
    return false;
});
