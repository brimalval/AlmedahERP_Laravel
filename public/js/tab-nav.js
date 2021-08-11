//--> start of Dashboard js <--//
if ($("#divMain").children().length == 0) {
    $(document).ready(function () {
        $("#divMain").load("/dashboard");
    });
}

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

//if (sessionStorage.getItem("route")) {
//    $("#divMain").load(sessionStorage.getItem("route"));
//} else {
//    $("#divMain").load("/dashboard");
//}
//--> End of Dashboard js <--//

function slideAlert(message, alert_appear) {
    $(alert_appear)
        .fadeTo(3500, 500)
        .slideUp(500, function () {
            $(alert_appear).slideUp(500);
        });
    $(alert_appear).html(message);
}

$(document).ready(function () {
    $("body").on("click", ".menu", function () {
        if (!$("#tabs").length) {
            $("#divMain").html(
                `<ul class="nav nav-tabs" id="tabs"></ul>
        <div class="tab-content border-secondary" id="contents"></div>`
            );
        }
        var name = $(this).attr("data-name");
        var moduleWithSpace;
        if (name == undefined) {
            moduleWithSpace = $(this).text().trim();
        } else {
            moduleWithSpace = name;
        }

        var moduleWOSpace = moduleWithSpace.replace(/\s+/g, "");
        var menu = moduleWOSpace;
        //checks if the clicked item has its tab is shown
        if (!$(`#tab${menu}`).length) {
            loadTab(menu, moduleWithSpace);
        }
        // if it's active, show it
        else {
            $(`#tab${menu}`).tab("show");
        }
    });
    // function for the close button of the tabs
    $("body").on("click", ".closeTab", function () {
        var $item = $(this).parent().text().trim();
        // if there are no shown tabs, remove all elements
        if (!$("#tabs li").length) {
            $("#divMain").html("");
        } else {
            $(".menu-item").each(function (index) {
                if ($(this).text().trim() == $item) {
                    // checks for the previous sibling if it has one
                    var goTo = $(this).prev().text().trim().length
                        ? $(this).prev().children().attr("id")
                        : $(this).next().children().attr("id");
                    $(`#${goTo}`).tab("show");
                }
            });
        }
        $(this).parent().parent().remove();
        $($(this).parent().attr("href")).remove();

        //--> Additional Dashboard js (close tabs) <--//
        if ($("#tabs").children().length == 0) {
            $(document).ready(function () {
                $("#divMain").load("/dashboard");
            });
        }
        //--> End of Dashboard js (close tabs) <--//
    });
});

function loadTab(menu, moduleWithSpace) {
    $("#tabs").append(
        `<li class="nav-item menu-item">
    <a class="nav-link" data-toggle="tab" href="#content${menu}" id="tab${menu}">
          ${moduleWithSpace} <b class="closeTab text close ml-4">x</b>
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
    var linkString = "/" + $link.toLowerCase();
    $(`#content${menu}`).load(
        linkString,
        function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "error") {
                console.log(
                    "Error: " + xhr.status + ": " + xhr.statusText
                );
                console.log($parent);
                $(`#content${menu}`).load(
                    linkString,
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
            //console.log(linkString);
            sessionStorage.setItem("route", linkString);
            sessionStorage.setItem("menuString", menu);
            sessionStorage.setItem("moWSpace", moduleWithSpace);
        }
    );
    $(`#tab${menu}`).tab("show");
}

function loadNewBOM() {
    $(document).ready(function () {
        $("#contentBOM").load("/newBOM");
    });
}

function subloadNewBOM() {
    $(document).ready(function () {
        $("#contentBOM").load("/subNewBOM");
    });
}

function loadBOM() {
    $(document).ready(function () {
        $("#contentBOM").load("/bom");
    });
}

function openNewWorkorder() {
    $(document).ready(function () {
        $("#contentWorkOrder").load("/openNewWorkorder");
    });
}

function openBlueprint() {
    $(document).ready(function () {
        $("#contentBOM").load("/openBlueprint");
    });
}
function openInventoryInfo() {
    $(document).ready(function () {
        $("#contentInventory").load("/openInventoryInfo");
    });
}

function loadInv() {
    $(document).ready(function () {
        $("#contentInventory").load("/inventory");
    });
}

function loadComponent() {
    $(document).ready(function () {
        $("#contentComponent").load("/component");
    });
}

function loadWorkOrder() {
    $(document).ready(function () {
        $("#contentWorkOrder").load("/workorder");
    });
}

// transferred qty array and materials ordered array
function getQtyFromMatOrdered(tqCode, moArray) {
    if (moArray) {
        let objFound = moArray.find((moObj) => moObj.item_code == tqCode);
        if (objFound) return parseInt(objFound.qty_received);
        else return 0;
    }
    return 0;
}

function getQuantityFromMatOrdered(work_order_no) {
    let dataToReturn;
    $.ajax({
        url: "/getQtyFromMatOrdered/" + work_order_no,
        type: "get",
        async: false,
        success: function (data) {
            dataToReturn = JSON.parse(data);
        },
        error: function (request, error) { },
    });
    return dataToReturn;
}
function loadWorkOrderInfoWithoutSales(workOrderDetails) {
    let percentage_array = [];
    let materials_complete = [];
    let item_complete = [];
    let transferred_qty = JSON.parse(workOrderDetails.transferred_qty);
    let productCode = Object.keys(
        JSON.parse(workOrderDetails.transferred_qty)
    )[0];
    console.log(productCode);
    let materials_qty = getQuantityFromMatOrdered(
        workOrderDetails.work_order_no
    );
    console.log(materials_qty);
    $(document).ready(function () {
        $("#contentWorkOrder").load("/loadWorkOrderInfo", function () {
            $("#startWorkOrder").on("click", function () {
                startWorkOrder(workOrderDetails["work_order_no"]);
            });
            $("#plannedStartDate").change(function (event) {
                event.preventDefault();
                onDateChange(
                    workOrderDetails["work_order_no"],
                    "planned_start_date",
                    this.value
                );
            });
            $("#plannedEndDate").on("change", function () {
                onDateChange(
                    workOrderDetails["work_order_no"],
                    "planned_end_date",
                    this.value
                );
            });
            $("#componentName").text(
                workOrderDetails.product_code ?? workOrderDetails.component_code
            );
            $("#componentStatus").text(workOrderDetails.work_order_status);
            $("#forProduct").attr(
                "value",
                Object.keys(JSON.parse(workOrderDetails.transferred_qty))[0]
            );
            $("#quantityPurchased").attr(
                "value",
                Object.values(
                    JSON.parse(workOrderDetails.transferred_qty)
                )[0][0].quantity_purchased
            );
            if (workOrderDetails.product_code) {
                $.ajax({
                    url:
                        "/getBomId/" +
                        workOrderDetails.product_code +
                        "/" +
                        "Product",
                    type: "get",
                    success: function (data) {
                        $("#bomNumber").val(data);
                    },
                    error: function (request, error) { },
                });
            } else {
                $.ajax({
                    url:
                        "/getBomId/" +
                        workOrderDetails.product_code +
                        "/" +
                        "Component",
                    type: "get",
                    success: function (data) {
                        $("#bomNumber").val(data);
                    },
                    error: function (request, error) { },
                });
            }

            if (workOrderDetails.work_order_status == "Pending") {
                $("#startWorkOrder").prop("disabled", true);
            }
            if (workOrderDetails.real_start_date) {
                $("#actualStartDate").attr(
                    "value",
                    workOrderDetails.real_start_date
                );
            }
            if (workOrderDetails.planned_start_date) {
                $("#plannedStartDate").attr(
                    "value",
                    workOrderDetails.planned_start_date
                );
            }
            if (workOrderDetails.planned_end_date) {
                $("#plannedEndDate").attr(
                    "value",
                    workOrderDetails.planned_end_date
                );
            }

            Object.values(
                JSON.parse(workOrderDetails.transferred_qty)
            )[0].forEach((el, index) => {
                let sequence = index + 1;
                let required_qty = el.required_qty;
                let tq;
                if (transferred_qty[productCode].length > index) {
                    tq =
                        transferred_qty[productCode][index].transferred_qty +
                        getQtyFromMatOrdered(
                            transferred_qty[productCode][index].item_code,
                            materials_qty
                        );

                    if (
                        transferred_qty[productCode][index].transferred_qty >=
                        required_qty
                    ) {
                        materials_complete.push(true);
                        percentage_array.push(100);
                        item_complete.push("");
                    } else if (
                        transferred_qty[productCode][index].transferred_qty <
                        required_qty
                    ) {
                        materials_complete.push(false);
                        percentage_array.push(
                            required_qty /
                            transferred_qty[productCode][index]
                                .transferred_qty
                        );
                    }
                } else {
                    tq = "n/a";
                }

                $("#requiredItems").append(
                    `
                <tr>
                  <td>
                    <div class="row m-1">
                      <div class="d-flex justify-content-start">
                        <label for="" class="ml-5">` +
                    sequence +
                    `</label>
                      </div>
                    </div>
                  </td>
                  <td>` +
                    el["item_code"] +
                    `</td>
                  <td>Test` +
                    index +
                    `</td>
                  <td>` +
                    required_qty +
                    `</td>
                  <td>` +
                    tq +
                    `</td>
                  
               </tr>`
                );
            });
            let percentage = 0;
            percentage_array.forEach((el) => {
                percentage += el;
            });
            percentage /= 2;
            $("#progressWorkOrder").css("width", percentage + "%");
            let item_complete_count = item_complete.length;
            $("#itemReadyWorkOrder").text(item_complete_count + " Items Ready");

            console.log("mat_complete" + materials_complete);

            if (workOrderDetails.product_code) {
                if (materials_complete.includes(false)) {
                    $("#startWorkOrder").prop("disabled", true);
                } else if (workOrderDetails.work_order_status == "Pending") {
                    $.ajax({
                        url:
                            "/checkUpdateStatus/" +
                            workOrderDetails.work_order_no +
                            "/" +
                            productCode,
                        type: "get",
                        success: function (data) {
                            console.log(data);
                            if (data.work_order_status == "Completed") {
                                $("#startWorkOrder").prop("disabled", false);
                                $("#componentStatus").text(
                                    data.work_order_status
                                );
                            }
                        },
                        error: function (request, error) { },
                    });
                }
            } else {
                if (materials_complete.includes(false)) {
                    $("#startWorkOrder").prop("disabled", true);
                } else if (workOrderDetails.work_order_status == "Pending") {
                    $.ajax({
                        url: "/updateStatus/" + workOrderDetails.work_order_no,
                        type: "get",
                        success: function (data) {
                            console.log(data);
                            $("#startWorkOrder").prop("disabled", false);
                            $("#componentStatus").text(data.work_order_status);
                        },
                        error: function (request, error) { },
                    });
                }
            }
        });
    });
}

function loadWorkOrderInfo(
    workOrderDetails,
    transferredQty,
    itemName,
    salesOrderId,
    productCode,
    quantity
) {
    let percentage_array = [];
    let item_complete = [];
    // let planned_dates = JSON.parse(dates);
    console.log(workOrderDetails);
    $("#requiredItems").html("");
    transferred_qty = JSON.parse(transferredQty);
    console.log("TQ");
    console.log(transferred_qty[productCode]);
    materials_qty = JSON.parse(quantity);
    console.log("mat_qty");
    console.log(materials_qty);
    materials_complete = [];
    // $("#startWorkOrder").click(startWorkOrder());
    $(document).ready(function () {
        $("#contentWorkOrder").load("/loadWorkOrderInfo", function () {
            $("#startWorkOrder").on("click", function () {
                startWorkOrder(workOrderDetails["work_order_no"]);
            });
            $("#plannedStartDate").change(function (event) {
                event.preventDefault();
                onDateChange(
                    workOrderDetails["work_order_no"],
                    "planned_start_date",
                    this.value
                );
            });
            $("#plannedEndDate").on("change", function () {
                onDateChange(
                    workOrderDetails["work_order_no"],
                    "planned_end_date",
                    this.value
                );
            });
            $("#componentName").text(itemName);
            $("#componentStatus").text(workOrderDetails.work_order_status);
            $("#forProduct").attr("value", productCode);

            if (workOrderDetails.work_order_status == "Pending") {
                $("#startWorkOrder").prop("disabled", true);
            }
            if (workOrderDetails.real_start_date) {
                $("#actualStartDate").attr(
                    "value",
                    workOrderDetails.real_start_date
                );
            }
            if (workOrderDetails.planned_start_date) {
                $("#plannedStartDate").attr(
                    "value",
                    workOrderDetails.planned_start_date
                );
            }
            if (workOrderDetails.planned_end_date) {
                $("#plannedEndDate").attr(
                    "value",
                    workOrderDetails.planned_end_date
                );
            }

            if (workOrderDetails.product_code) {
                $.ajax({
                    url:
                        "/getBomId/" +
                        workOrderDetails.product_code +
                        "/" +
                        "Product",
                    type: "get",
                    success: function (data) {
                        $("#bomNumber").val(data);
                    },
                    error: function (request, error) { },
                });
            } else {
                $.ajax({
                    url:
                        "/getBomId/" +
                        workOrderDetails.product_code +
                        "/" +
                        "Component",
                    type: "get",
                    success: function (data) {
                        $("#bomNumber").val(data);
                    },
                    error: function (request, error) { },
                });
            }
            $.ajax({
                url:
                    "/getRawMaterialsWork/" +
                    itemName +
                    "/" +
                    salesOrderId +
                    "/" +
                    productCode,
                type: "GET",
                success: function (datas) {
                    $("#quantityPurchased").attr(
                        "value",
                        datas["quantity_purchased"]
                    );
                    console.log("below are the datas");
                    console.log(datas);
                    for (let [index, rawMat] of JSON.parse(
                        datas["item_code"]
                    ).entries()) {
                        let sequence = index + 1;
                        let required_qty =
                            parseInt(datas["component_qty"]) *
                            datas["quantity_purchased"] *
                            parseInt(rawMat["item_qty"]);
                        let tq;

                        if (transferred_qty[productCode].length > index) {
                            tq =
                                transferred_qty[productCode][index]
                                    .quantity_avail +
                                getQtyFromMatOrdered(
                                    transferred_qty[productCode][index]
                                        .item_code,
                                    materials_qty
                                );

                            if (
                                transferred_qty[productCode][index]
                                    .quantity_avail >= required_qty
                            ) {
                                materials_complete.push(true);
                                percentage_array.push(100);
                                item_complete.push("");
                            } else if (
                                transferred_qty[productCode][index]
                                    .quantity_avail < required_qty
                            ) {
                                materials_complete.push(false);
                                percentage_array.push(
                                    required_qty /
                                    transferred_qty[productCode][index]
                                        .quantity_avail
                                );
                            }
                        } else {
                            tq = "n/a";
                        }

                        $("#requiredItems").append(
                            `
                        <tr>
                          <td>
                            <div class="row m-1">
                              <div class="d-flex justify-content-start">
                                <label for="" class="ml-5">` +
                            sequence +
                            `</label>
                              </div>
                            </div>
                          </td>
                          <td>` +
                            rawMat["item_code"] +
                            `</td>
                          <td>Test` +
                            index +
                            `</td>
                          <td>` +
                            required_qty +
                            `</td>
                          <td>` +
                            tq +
                            `</td>
                       </tr>`
                        );
                    }

                    let percentage = 0;
                    percentage_array.forEach((el) => {
                        percentage += el;
                    });
                    percentage /= 2;
                    $("#progressWorkOrder").css("width", percentage + "%");
                    let item_complete_count = item_complete.length;
                    $("#itemReadyWorkOrder").text(
                        item_complete_count + " Items Produced"
                    );
                    console.log("mat_complete" + materials_complete);

                    if (workOrderDetails.product_code) {
                        if (materials_complete.includes(false)) {
                            $("#startWorkOrder").prop("disabled", true);
                        } else if (
                            workOrderDetails.work_order_status == "Pending"
                        ) {
                            $.ajax({
                                url:
                                    "/checkUpdateStatus/" +
                                    workOrderDetails.work_order_no +
                                    "/" +
                                    productCode,
                                type: "get",
                                success: function (data) {
                                    console.log(data);
                                    $("#startWorkOrder").prop(
                                        "disabled",
                                        false
                                    );
                                    $("#componentStatus").text(
                                        data.work_order_status
                                    );
                                },
                                error: function (request, error) { },
                            });
                        }
                    } else {
                        if (materials_complete.includes(false)) {
                            $("#startWorkOrder").prop("disabled", true);
                        } else if (
                            workOrderDetails.work_order_status == "Pending"
                        ) {
                            $.ajax({
                                url:
                                    "/updateStatus/" +
                                    workOrderDetails.work_order_no,
                                type: "get",
                                success: function (data) {
                                    console.log(data);
                                    $("#startWorkOrder").prop(
                                        "disabled",
                                        false
                                    );
                                    $("#componentStatus").text(
                                        data.work_order_status
                                    );
                                },
                                error: function (request, error) { },
                            });
                        }
                    }
                },
                error: function (request, error) {
                    alert("Request: " + error);
                },
            });
            console.log(materials_complete);
        });
    });
}

function loadReportsBuilder() {
    $(document).ready(function () {
        $("#contentReportsBuilder").load("/reportsbuilder");
    });
}
function loadReportsBuilderShowReport() {
    $(document).ready(function () {
        $("#contentReportsBuilder").load("/loadReportsBuilderShowReport");
    });
}

function openReportsBuilderForm() {
    $(document).ready(function () {
        $("#contentReportsBuilder").load("/openReportsBuilderForm");
    });
}

function loadManufacturingProductionPlan() {
    $(document).ready(function () {
        $("#contentProductionPlan").load("/productionplan");
    });
}

function openManufacturingProductionPlanForm() {
    $(document).ready(function () {
        $("#contentProductionPlan").load(
            "/openManufacturingProductionPlanForm"
        );
    });
}

function loadManufacturingWorkstation() {
    $(document).ready(function () {
        $("#contentWorkstation").load("/workstation");
    });
}
function openManufacturingWorkstationForm() {
    $(document).ready(function () {
        $("#contentWorkstation").load("/openManufacturingWorkstationForm");
    });
}

function loadManufacturingRouting() {
    $(document).ready(function () {
        $("#contentRouting").load("/routing/create");
    });
}
function openManufacturingRoutingForm() {
    $(document).ready(function () {
        $("#contentRouting").load("/routing/create");
        $("#contentNewRouting").load("/routing/create");
    });
}

function loadProjectsTimesheet() {
    $(document).ready(function () {
        $("#contentTimesheet").load("/loadProjectsTimesheet");
    });
}
function openManufacturingTimesheetForm() {
    $(document).ready(function () {
        $("#contentTimesheet").load("/openManufacturingTimesheetForm");
    });
}

function loadManufacturingItemAttribute() {
    $(document).ready(function () {
        $("#contentItemAttribute").load("/itemattribute");
    });
}
function openManufacturingItemAttributeForm() {
    $(document).ready(function () {
        $("#contentItemAttribute").load("/openManufacturingItemAttributeForm");
    });
}

function loadManufacturingItemPrice() {
    $(document).ready(function () {
        $("#contentItemPrice").load("/itemprice");
    });
}
function openManufacturingItemPriceForm() {
    $(document).ready(function () {
        $("#contentItemPrice").load("/openManufacturingItemPriceForm");
    });
}

function loadBuyingRequestForQuotation() {
    $(document).ready(function () {
        $("#contentRequestforQuotation").load("/requestforquotation");
    });
}
function openBuyingRequestForQuotationForm() {
    $(document).ready(function () {
        $("#contentRequestforQuotation").load("/new-quotation");
    });
}
function viewBuyingRequestForQuotationForm() {
    $(document).ready(function () {
        $("#contentRequestforQuotation").load("/view-quotation");
    });
}

function loadSupplier() {
    $(document).ready(function () {
        $("#contentSupplier").load("/supplier");
    });
}

function openSupplierInfo(id) {
    $(document).ready(function () {
        $("#contentSupplier").load(`/supplier/${id}`);
    });
}

function openSupplierForm() {
    $(document).ready(function () {
        $("#contentSupplier").load(`/supplier/create`);
    });
}

function openSaleInfo(id) {
    $(document).ready(function () {
        $("#contentSalesOrder").load(`/view-sales-order/${id}`);
    });
}

function loadSalesOrder() {
    $(document).ready(function () {
        $("#contentSalesOrder").load("/salesorder");
    });
}
function openNewSaleOrder(x) {
    $(document).ready(function () {
        $("#contentSalesOrder").load("/openNewSaleOrder");
    });
}

function loadPurchaseOrder() {
    $(document).ready(function () {
        $("#contentPurchaseOrder").load("/purchaseorder");
    });
}

function viewPurchaseOrder(id) {
    $(document).ready(function () {
        $("#contentPurchaseOrder").load(`/purchaseorder/${id}`);
    });
}

function openNewPurchaseOrder() {
    $(document).ready(function () {
        $("#contentPurchaseOrder").load("/purchaseorder/create");
    });
}

function loadMaterialRequest() {
    $(document).ready(function () {
        $("#contentMaterialRequest").load("/materialrequest");
    });
}

function openNewMaterialRequest() {
    $(document).ready(function () {
        $("#contentMaterialRequest").load("/materialrequest/create");
    });
}

function openMaterialRequestInfo() {
    $(document).ready(function () {
        $("#contentMaterialRequest").load("/openMaterialRequestInfo");
    });
}

function loadJobsched() {
    $(document).ready(function () {
        $("#contentJobScheduling").load("/loadJobsched");
    });
}

function loadJobschedhome() {
    $(document).ready(function () {
        $("#contentJobScheduling").load("/jobscheduling");
    });
}

function loadUOM() {
    $(document).ready(function () {
        $("#contentUOM").load("/uom");
    });
}

function openUOMNew() {
    $(document).ready(function () {
        $("#contentUOM").load("/openUOMNew");
    });
}

function openUOMEdit() {
    $(document).ready(function () {
        $("#contentUOM").load("/openUOMEdit");
    });
}

function openNewStockEntry() {
    $(document).ready(function () {
        $("#contentStockEntry").load("/openNewStockEntry");
    });
}

function loadStockEntry() {
    $(document).ready(function () {
        $("#contentStockEntry").load("/loadStockEntry");
    });
}

function loadNewStockMoves(transferId = null) {
    if (transferId == null) {
        $("#contentStockMoves").load("/newstockmoves", function () {
            $("#saveStockTransferCreate").show();
            // $("#saveStockTransfer").show();
            // $("#confirmStockTransfer").show();
        });
    } else {
        $.ajax({
            type: "GET",
            url: `/getStockTransfer/${transferId}`,
            data: transferId,
            processData: false,
            contentType: false,
            success: function (data) {
                $("#contentStockMoves").load("/newstockmoves", function () {
                    console.log(data);
                    $("#tracking_id").attr("disabled", true);
                    $("#tracking_id").val(data["stock_transfer"].tracking_id);
                    $("#move_date").val(data["stock_transfer"].move_date);
                    $("#mat_ordered_id").val(
                        data["stock_moves"].mat_ordered_id
                    );
                    $("#employee_id").val(data["stock_moves"].employee_id);
                    showItemCodeNew(
                        data["stock_moves"].mat_ordered_id,
                        data["stock_transfer"].tracking_id
                    );
                });
            },
        });
    }
}

function loadStockMoves() {
    $(document).ready(function () {
        $("#contentStockMoves").load("/stockmoves");
    });
}

let items;
let itemsDel;
let materialsInComponentsItem = [];
let rawMaterialsOnlyItem = [];

function loadStockReturn() {
    // $(document).ready(function () {
    //     $("#contentStock").load("/stockmovesreturn");
    // });
    $(document).ready(function () {
        $("#contentStockMoves").load("/returnitems");
    });
}

function loadStockReturnInfo(
    trackingId,
    stockMovesType,
    matOrdered,
    employeeId,
    moveDate,
    status
) {
    $("#contentStockMoves").load("/returnitems", function () {
        $("#tracking_id_ret").val(trackingId);
        $("#stock_moves_type_ret").val(stockMovesType);
        $("#mat_ordered_id_ret").val(matOrdered);
        $("#employee_id_ret").val(employeeId);
        $("#move_date_ret").val(moveDate);
        if (status == "Successfully Returned") {
            $("#saveRet").css("display", "none");
        }
        if (stockMovesType === "Return") {
            // $("#saveCancelButtons").hide().css("visibility", "hidden");
            $("#backButton").css("display", "block");
        }
        showItemsRet(trackingId);
    });
}

function onChangeItemTransQty(itemTransQty, el) {
    let currentRow = $(el).closest("tr");
    let itemCodeFound = currentRow.find("td:nth-child(2)").html();
    // console.log("before pass_val");
    // console.log(itemsTransPassValue);
    // console.log("before real_val");
    // console.log(itemsTrans);
    passValueArray.forEach((itemPV) => {
        if (itemCodeFound === itemPV.item_code) {
            itemPV.qty_received = itemTransQty;
        }
    });

    console.log("pass_val");
    console.log(passValueArray);
    console.log("real_val");
    console.log(itemsTrans);
}

function viewStockTransferItems(id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "GET",
        url: `/view-st-items/${id}`,
        data: id,
        processData: false,
        contentType: false,
        success: function (response) {
            let table = $("#stockTransfer_itemList tbody");
            $("#stockTransfer_itemList tbody tr").remove();
            let itemsR = JSON.parse(response);
            itemsR.forEach((item) => {
                table.append(
                    `
                    <tr>
                        <td>${item.item_code}</td>
                        <td>${item.qty_received}</td>
                    </tr>
                    `
                );
            });
        },
    });
}

function markAsReturn(e) {
    let currentRow = $(e).closest("tr");
    let attr = currentRow
        .find("td:nth-child(1) .form-check .checkbox")
        .is(":checked");
    currentRow
        .find("td:nth-child(9) .btn")
        .attr("disabled", attr ? false : true);
}

function writeRemark(el) {
    $("#remarks").modal("toggle");
    let currentRow = $(el).closest("tr");
    let itemCodeFound = currentRow.find("td:nth-child(2)").html();
    console.log(itemsRet);
    itemsRet.forEach((itemRet) => {
        if (itemCodeFound == itemRet.item_code) {
            console.log(itemRet.remarks);
            $("#remarkText").val(function (text) {
                return itemRet.remarks;
            });
        }
    });
    $("#itemCodeRemark").text(itemCodeFound);
}

function submitRemark() {
    $("#remarks").modal("toggle");
    let text = $("#remarkText").val();
    let itemCode = $("#itemCodeRemark").text();
    passValueArray.forEach((passValueObj) => {
        if (passValueObj.item_code == itemCode) {
            passValueObj["remarks"] = text;
        }
    });
    console.log("new");
    console.log(passValueArray);
}

function showItemsRet(trackingId) {
    $("#itemsRet").empty();
    let itemsTransTable = $("#itemsTrans");
    let itemsRetTable = $("#itemsRet");
    itemsTrans = [];
    passValueArray = [];
    itemsRet = [];
    itemsTransCurrent = [];
    $.ajax({
        type: "GET",
        url: "/showItemsRet/" + trackingId,
        success: function (data) {
            let qty_checker = [];
            JSON.parse(data["items_list_received"]).forEach((item) => {
                qty_checker.push(item.qty_received);
            });
            console.log(qty_checker);
            if (data["return_date"]) {
                $("#return_date_ret").val(data["return_date"]);
            }
            let items_list_received = JSON.parse(data["transfer"]);
            items_list_received.forEach((item, index) => {
                let obj = {
                    item_code: item.item_code,
                    qty_received: item.qty_received,
                    qty_checker: qty_checker[index],
                    source_station: item.source_station,
                    target_station: item.target_station,
                    consumable: item.consumable,
                    item_condition: item.item_condition,
                    transfer_status: item.transfer_status,
                };
                itemsTrans.push(obj);
            });
            itemsTrans.forEach((item) => {
                let obj = {
                    item_code: item.item_code,
                    qty_received: item.qty_received,
                    qty_checker: item.qty_received,
                    source_station: item.source_station,
                    target_station: item.target_station,
                    consumable: item.consumable,
                    item_condition: item.item_condition,
                    transfer_status: item.transfer_status,
                };
                passValueArray.push(obj);
            });
            console.log(passValueArray);
            console.log(itemsTrans);
            JSON.parse(data["transfer"]).forEach((item) => {
                itemsTransTable.append(
                    `<tr><td>
                          <div class="form-check">
                              <input type="checkbox" class="checkbox form-check-input" onchange="markAsReturn(this)">
                          </div>
                      </td>
                      <td>` +
                    item.item_code +
                    `</td>
                    <td>` +
                    item.qty_received +
                    `</td>
                    <td><input type="number" onchange="onChangeItemTransQty(this.value, this)" class="form-control w-75" max=` +
                    item.qty_received +
                    ` value=` +
                    item.qty_received +
                    `></td>
                    <td>` +
                    item.consumable +
                    `</td>
                    <td>` +
                    item.source_station +
                    `</td>
                    <td>` +
                    item.target_station +
                    `</td>
                    <td>` +
                    item.item_condition +
                    `</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="writeRemark(this)" disabled>Write</button>
                    </td></tr>
                    `
                );
            });

            // -------------
            if (data["return"]) {
                let items_to_be_returned = JSON.parse(data["return"]);
                items_to_be_returned.forEach((item) => {
                    let obj = {
                        item_code: item.item_code,
                        qty_transferred: item.qty_transferred,
                        source_station: item.source_station,
                        target_station: item.target_station,
                        consumable: item.consumable,
                        item_condition: item.item_condition,
                        transfer_status: item.transfer_status,
                        remarks: item.remarks,
                    };
                    itemsRet.push(obj);
                });
                JSON.parse(data["return"]).forEach((item) => {
                    itemsRetTable.append(
                        `<tr><td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>` +
                        item.item_code +
                        `</td>
                        <td>` +
                        item.qty_transferred +
                        `</td>
                        <td>` +
                        item.consumable +
                        `</td>
                        <td>` +
                        item.source_station +
                        `</td>
                        <td>` +
                        item.target_station +
                        `</td>
                        <td>` +
                        item.item_condition +
                        `</td></tr>`
                    );
                });
            }
        },
        error: function (data) {
            console.log("error");
            console.log(data);
        },
    });
}

function openNewTask() {
    $("#contentTask").load("/openNewTask");
}

function loadTask() {
    $("#contentTask").load("/task");
}

function openNewPriceList() {
    $("#contentPriceList").load("/openNewPriceList");
}

function openSalesInvoiceItem() {
    $(document).ready(function () {
        $("#contentSalesInvoice").load("/sales-invoice-item");
    });
}

function loadSalesInvoice() {
    $(document).ready(function () {
        $("#contentSalesInvoice").load("/salesinvoice");
    });
}

function loadPriceList() {
    $("#contentPriceList").load("/loadPriceList");
}

function openNewProjectTemplate() {
    $("#contentProjectTemplate").load("/openNewProjectTemplate");
}

function loadProjectTemplate() {
    $("#contentProjectTemplate").load("/loadProjectTemplate");
}

function loadWarehouse() {
    $(document).ready(function () {
        $("#contentWarehouse").load("/loadWarehouse");
    });
}

function openWarehouseNew() {
    $(document).ready(function () {
        $("#contentWarehouse").load("/openWarehouseNew");
    });
}

function openWarehouseEdit() {
    $(document).ready(function () {
        $("#contentWarehouse").load("/openWarehouseEdit");
    });
}

function openItemVariantSettings() {
    $(document).ready(function () {
        $("#contentItemVariantSetting").load("/openItemVariantSettings");
    });
}

function loadPendingOrders() {
    $(document).ready(function () {
        $("#contentPendingOrders").load("/pendingorders");
    });
}

function openPendingOrdersInfo() {
    $(document).ready(function () {
        $("#contentPendingOrders").load("/view-pending-order");
    });
}

function openDeliveryInfo() {
    $(document).ready(function () {
        $("#contentDelivery").load("/view-delivery-info");
    });
}

function loadDelivery() {
    $(document).ready(function () {
        $("#contentDelivery").load("/delivery");
    });
}

function loadSupplierQuotationInfo() {
    $(document).ready(function () {
        $("#contentSupplierQuotation").load("/load-supplier");
    });
}

function loadSupplierQuotation() {
    $(document).ready(function () {
        $("#contentSupplierQuotation").load("/supplierquotation");
    });
}

function openNewSupplierQuotation() {
    $(document).ready(function () {
        $("#contentSupplierQuotation").load("/new-supplier");
    });
}

function openNewPurchaseInvoice() {
    $(document).ready(function () {
        $("#contentPurchaseInvoice").load("/new-invoice");
    });
}

function loadPurchaseInvoice() {
    $(document).ready(function () {
        $("#contentPurchaseInvoice").load("/purchaseinvoice");
    });
}

function openPurchaseInvoiceInfo(id) {
    $(document).ready(function () {
        $("#contentPurchaseInvoice").load(`/view-invoice/${id}`);
    });
}

function openNewPurchaseReceipt() {
    $(document).ready(function () {
        $("#contentPurchaseReceipt").load("/new-receipt");
    });
}

function openPurchaseReceiptInfo(id) {
    $(document).ready(function () {
        $("#contentPurchaseReceipt").load(`/view-receipt/${id}`);
    });
}

function loadPurchaseReceipt() {
    $(document).ready(function () {
        $("#contentPurchaseReceipt").load("/purchasereceipt");
    });
}
function openNewShippingRule() {
    $(document).ready(function () {
        $("#contentShippingRule").load("/shippingruleinfo");
    });
}
function loadShippingInfo() {
    $(document).ready(function () {
        $("#contentShippingRule").load("/shippingrule");
    });
}
function loadPurchaseTaxes() {
    $(document).ready(function () {
        $("#contentPurchaseTaxes").load("/purchasetaxes");
    });
}
function openNewPurchaseTaxes() {
    $(document).ready(function () {
        $("#contentPurchaseTaxes").load("/purchasetaxesinfo");
    });
}
function openNewSalesTaxes() {
    $(document).ready(function () {
        $("#contentSalesTaxes").load("/newsalestaxes");
    });
}
function loadSalesTaxes() {
    $(document).ready(function () {
        $("#contentSalesTaxes").load("/salestaxes");
    });
}
function newPricingRule() {
    $(document).ready(function () {
        $("#contentPricingRule").load("/PricingRuleInfo");
    });
}
function loadPricingRule() {
    $(document).ready(function () {
        $("#contentPricingRule").load("/pricingrule");
    });
}
function openSupplierGroup() {
    $(document).ready(function () {
        $("#contentSupplierGroup").load("/newsuppliergroup");
    });
}

function loadSupplierGroup() {
    $(document).ready(function () {
        $("#contentSupplierGroup").load("/suppliergroup");
    });
}

function openSupplierGrouptable() {
    $(document).ready(function () {
        $("#contentSupplierGroup").load("/newsuppliergrouptable");
    });
}

function openNewCoupon() {
    $(document).ready(function () {
        $("#contentCouponCode").load("/newCouponCode");
    });
}

function loadCouponCode() {
    $(document).ready(function () {
        $("#contentCouponCode").load("/couponcode");
    });
}

function openCouponInfo() {
    $(document).ready(function () {
        $("#contentCouponCode").load("/openCouponInfo");
    });
}

function openNewProductBundle() {
    $(document).ready(function () {
        $("#contentProductBundle").load("/newproductbundle");
    });
}

function loadProductBundle() {
    $(document).ready(function () {
        $("#contentProductBundle").load("/productbundle");
    });
}

function openProductBundleInfo() {
    $(document).ready(function () {
        $("#contentProductBundle").load("/openProductBundleInfo");
    });
}

function openAddressInfo() {
    $(document).ready(function () {
        $("#contentAddress").load("/openAddressInfo");
    });
}

function openNewAddress() {
    $(document).ready(function () {
        $("#contentAddress").load("/newAddress");
    });
}

function loadAddress() {
    $(document).ready(function () {
        $("#contentAddress").load("/address");
    });
}

function loadBOMForm() {
    $(document).ready(function () {
        $("#contentBom").load("/newbom");
    });
}

function loadBOM(id) {
    $(document).ready(function () {
        $("#contentBom").load(`/view-bom/${id}`);
    });
}

function loadBOMtable() {
    $(document).ready(function () {
        $("#contentBom").load("/bom");
    });
}

function loadmachineinfo(id) {
    $(document).ready(function () {
        $("#contentMachineManual").load(`/machinemanualinfo/${id}`);
    });
}

function loadNewMachineManual() {
    $(document).ready(function () {
        $("#contentMachineManual").load("/create-new-mm");
    });
}

function loadmachine() {
    $(document).ready(function () {
        $("#contentMachineManual").load("/machinemanual");
    });
}

function loadnewworkcenter() {
    $(document).ready(function () {
        $("#contentNewRouting").load("/workcenter");
        $("#contentRouting").load("/workcenter");
    });
}
function loadnewRouting() {
    $(document).ready(function () {
        $("#contentRouting").load("/routing/create");
    });
}

function EditRouting(id) {
    $(document).ready(function () {
        $("#contentRouting").load(`/editrouting/${id}`);
    });
}

function RoutingTable() {
    $(document).ready(function () {
        $("#contentRouting").load("/routing");
    });
}

function newoperation() {
    $(document).ready(function () {
        $("#contentOperations").load("/operations/create");
    });
}

function operationtable() {
    $(document).ready(function () {
        $("#contentOperations").load("/operations");
    });
}

function editoperation(id) {
    $(document).ready(function () {
        $("#contentOperations").load(`/operations/${id}/edit`);
    });
}

function repairtable() {
    $(document).ready(function () {
        $("#contentRepair").load("/repair");
    });
}
function newrepairrequest() {
    $(document).ready(function () {
        $("#contentRepair").load("/newrepairrequest");
    });
}
function repairinfo() {
    $(document).ready(function () {
        $("#contentRepair").load("/repairinfo");
    });
}