$(document).ready(function () {
    $('#table_operations').DataTable();
    $('#table_materials').DataTable();
    $('#table_costing').DataTable();
});

$("#routingSelect").change(function () {
    if($(this).val() === 'newRouting') {
        showRoutingsForm();
        $(this).val(null);
    }
});

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

function showForm1() {
    var table1 = document.getElementById("manprod").value;
    if (table1 == 1) {
        document.getElementById("item_content").style.display = 'block';
    }
    else if (table1 == 0) {
        document.getElementById("item_content").style.display = 'none';
    }
}

$(`#manprod`).change(function () {
    let showForm = $(this).val();
    if (showForm == 1) {
        $("#item_content").css("display", "block");
    }
    else if (showForm == 0) {
        $("#item_content").css("display", "none");
    }
    let prod_code = $(this).text().trim();
    $.ajax({
        type: "GET",
        url: `/get-product/${prod_code}`,
        data: prod_code,
        success: function (response) {
            console.log(response);
            let product = response.product;
            $(`#Item_name`).val(product.product_name);
            $(`#Item_UOM`).val(product.product_uom);
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

