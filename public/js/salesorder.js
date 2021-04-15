let mat_insufficient = false;

$("#saveSaleOrder").click(function () {
    //continueToWorkOrder("#saveSaleOrder");
    $("#notif").hide();
});

//Might be unnecessary will check @TODO
//from old version of front-end js file
$("#saveSaleOrder1").click(function () {
    continueToWorkOrder("#saveSaleOrder1");
});

function selectSalesMethod() {
    var selected = document.getElementById("saleSupplyMethod").value;
    if (selected == "Purchase") {
        document.getElementById("cardComponent").style.display = "block";
    } else {
        document.getElementById("cardComponent").style.display = "none";
    }
}

function selectPaymentMethod() {
    var selectedPayment = document.getElementById("salePaymentMethod").value;
    if (selectedPayment == "Installment") {
        document.getElementById("paymentInstallment").style.display = "flex";
        cost = document.getElementById("costPrice").value;
        document.getElementById("saleDownpaymentCost").value = cost * 0.25;
    } else {
        document.getElementById("paymentInstallment").style.display = "none";
        installmentType();
    }
}

function creationSelectPaymentType() {
    var paymentType = document.getElementById("paymentType").value;
    if (paymentType == "Cash") {
        document.getElementById("account_no_div").style.display = "none";
        document.getElementById("account_cheque_no").style.display = "none";
        document.getElementById("account_cheque_date").style.display = "none";
    } else {
        document.getElementById("account_no_div").style.display = "flex";
        document.getElementById("account_cheque_no").style.display = "flex";
        document.getElementById("account_cheque_date").style.display = "flex";
    }
}

//For payment modal
function selectPaymentType() {
    var paymentType = document.getElementById("view_paymentType").value;
    if (paymentType == "Cash") {
        document.getElementById("viewaccount_no_div").style.display = "none";
    } else {
        document.getElementById("viewaccount_no_div").style.display = "flex";
    }
}

//Function for payment type
function installmentType() {
    $("#payments_table_body tr").remove();
    cost = document.getElementById("costPrice").value;
    payment_method = document.getElementById("salePaymentMethod").value;
    divider = 0;
    if (payment_method == "Cash") {
        $("#payments_table_body").append(
            '<tr><td><div class="form-check"><input type="checkbox" class="form-check-input append-check"></div></td><td class="text-center">Cash</td><td class="text-center">' +
                cost +
                "</td></tr>"
        );
    } else {
        installment_type = document.getElementById("installmentType").value;
        saleDownpaymentCost = document.getElementById("saleDownpaymentCost")
            .value;
        $("#payments_table_body").append(
            '<tr><td><div class="form-check"><input type="checkbox" class="form-check-input append-check"></div></td><td class="text-center">Downpayment </td><td class="text-center">' +
                saleDownpaymentCost +
                "</td></tr>"
        );
        cost -= saleDownpaymentCost;
        switch (installment_type) {
            case "3 months":
                divider = Math.round((cost * 100.0) / 3) / 100;
                for (let index = 0; index < 3; index++) {
                    $("#payments_table_body").append(
                        '<tr><td><div class="form-check"><input type="checkbox" class="form-check-input append-check"></div></td><td class="text-center">Installment ' +
                            (index + 1) +
                            '</td><td class="text-center">' +
                            divider +
                            "</td></tr>"
                    );
                }
                break;
            case "6 months":
                divider = Math.round((cost * 100.0) / 6) / 100;
                for (let index = 0; index < 6; index++) {
                    $("#payments_table_body").append(
                        '<tr><td><div class="form-check"><input type="checkbox" class="form-check-input append-check"></div></td><td class="text-center">Installment ' +
                            (index + 1) +
                            '</td><td class="text-center">' +
                            divider +
                            "</td></tr>"
                    );
                }
                break;
            case "12 months":
                divider = Math.round((cost * 100.0) / 12) / 100;
                for (let index = 0; index < 12; index++) {
                    $("#payments_table_body").append(
                        '<tr><td><div class="form-check"><input type="checkbox" class="form-check-input append-check"></div></td><td class="text-center">Installment ' +
                            (index + 1) +
                            '</td><td class="text-center">' +
                            divider +
                            "</td></tr>"
                    );
                }
                break;
        }
    }
}

var totalValue = 0;

// 2d Array [ProductCode, Quantity]
var currentCart = [];
// Array for storing Insufficient Quantity Items to be used for Material Request
var createMatRequestItems = [];
// Adds component into a 2d array. If it is already init adds value instead

function contains(names, arr) {
    namelist = [];
    for (let index = 0; index < arr.length; index++) {
        namelist.push(arr[index][0]);
    }

    for (let index = 0; index < arr.length; index++) {
        if (namelist[index] == names) {
            return true;
        }
    }
    return false;
}

//Adds product to array
function addToTable() {
    currentProduct = document.getElementById("saleProductCode").value;
    if (!contains(currentProduct, currentCart)) {
        currentCart.push([currentProduct, 0]);
        $("#ProductsTable").append(
            '<tr><td><div class="form-check"><input type="checkbox" class="form-check-input">  </div></td><td class="text-center">  ' +
                currentProduct +
                '</td><td class="text-center d-flex justify-content-center">  <input type="number" class="form-control w-25 text-center " value="0" onchange="changeQuantity(this)"></td><td class="text-center">  <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Remove</button></td></tr>'
        );
    }
}

//Quantity inside the products table
function changeQuantity(r) {
    index = r.parentNode.parentNode.rowIndex - 1;
    productName = currentCart[index][0];
    currentCart[index] = [productName, r.value];
    $("#btnSalesCalculate").click();
}

//Deletes product from array
function deleteRow(r) {
    // Index of row
    index = r.parentNode.parentNode.rowIndex - 1;
    // -1 because index is not 0-indexed
    currentCart.splice(index, 1);

    $(r).parent().parent().remove();
    $("#btnSalesCalculate").click();
}

$("#btnSalesCalculate").click(function () {
    cost = 0;
    for (let index = 0; index < currentCart.length; index++) {
        cost +=
            currentCart[index][1] * getCalculatedPrice(currentCart[index][0]);
    }
    document.getElementById("costPrice").value = cost;
    document.getElementById("payment_total_amount").value = cost;
    rawMaterials();
});

function rawMaterials() {
    var data = {};
    var products = [];
    var qty = [];
    for (let index = 0; index < currentCart.length; index++) {
        products[index] = currentCart[index][0];
        qty[index] = currentCart[index][1];
    }
    data["products"] = products;
    data["qty"] = qty;

    $.ajax({
        url: "/getCompo",
        type: "GET",
        data: data,
        success: function (response) {
            finalizer(response);
        },
        error: function (response, error) {
            // alert("Request: " + JSON.stringify(request));
        },
    });
    //Function here
}

function finalizer(arr_components) {
    $("#create-material-req-btn").html("");
    $(".components tr").remove();

    // Raw materials that are insufficient are stored in this array
    createMatRequestItems = [];
    // Raw Materials inside Components
    materialsInComponents = [];
    // Raw Materials only
    rawMaterialsOnly = [];
    mat_insufficient = false;
    for (let index = 0; index < arr_components.length; index++) {
        component = [
            arr_components[index][2],
            arr_components[index][1],
            arr_components[index][0],
            arr_components[index][3],
            arr_components[index]["item_code"],
        ];
        /* 
            Checks if it is a component, if it is, it gets its JSON data and adds it to the
            materialsInComponents array.
        */
        if (arr_components[index][4] != null) {
            let materials_needed = JSON.parse(arr_components[index][4]);
            materials_needed.forEach((el) =>
                materialsInComponents.push({
                    component_name: el["item_name"],
                    category: "Component",
                    quantity_needed_for_request: el["item_qty"] * component[2],
                    item_code: el["item_code"],
                })
            );
        } else {
            rawMaterialsOnly.push({
                component_name: component[0],
                category: component[1],
                quantity_needed: component[2],
                quantity_avail: component[3],
                item_code: component[4],
            });
        }

        // set status of each component
        if (component[3] <= 0) {
            status = "Out of stock";
        } else if (component[3] > 0 && component[3] < component[2]) {
            status = "Insufficient";
            mat_insufficient = true;
            // showCreateMaterialRequestBtn();
            // Add this insufficient material to array for material request processing
            createMatRequestItems.push({
                component_name: component[0],
                category: component[1],
                quantity_needed_for_request: component[2] - component[3],
                item_code: component[4],
            });
        } else if (component[2] >= component[2]) {
            status = "Available";
        }

        // append each component to the components table
        $(".components").append(
            `<tr>
        <td>
        <div class="form-check">
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td class="text-center">
        ` +
                component[0] +
                `
        </td>
        <td class="text-center">
        ` +
                component[1] +
                `
        </td>
        <td class="mt-available" style="text-align: center;">` +
                component[3] +
                `</td>
        <td class="mt-needed text-center">
        ` +
                component[2] +
                `
        </td>
        <td class="mt-needed text-center">
        ` +
                status +
                `
        </td>
        </tr>`
        );
    }

    /* 
       Checks each raw material in Components if it already has the raw material in the table.
       If it does, then it adjusts the quantity that is needed per material. And if it doesn't 
       It gets the quantity available data of the raw material inside the component and it 
       checks if its raw material quantity is insufficient. 
    */
    materialsInComponents.forEach((matComponent) => {
        let find = rawMaterialsOnly.find(
            (rawMat) =>
                rawMat["component_name"] == matComponent["component_name"]
        );
        if (find) {
            let rawMaterialsNeeded =
                parseInt(find["quantity_needed"]) +
                parseInt(matComponent["quantity_needed_for_request"]) -
                parseInt(find["quantity_avail"]);

            if (rawMaterialsNeeded > 0) {
                // showCreateMaterialRequestBtn();
                // Add this insufficient material to array for material request processing

                let matItemExists = createMatRequestItems.find(
                    (matItem) =>
                        matItem["component_name"] == find["component_name"]
                );
                if (!matItemExists) {
                    createMatRequestItems.push({
                        component_name: find["component_name"],
                        category: find["category"],
                        quantity_needed_for_request: rawMaterialsNeeded,
                        item_code: find["item_code"],
                    });
                }
            }
        } else {
            let quantity_avail = getRawMaterialQuantity(
                matComponent["component_name"]
            );
            if (matComponent["quantity_needed_for_request"] > quantity_avail) {
                createMatRequestItems.push({
                    component_name: matComponent["component_name"],
                    category: "Component",
                    quantity_needed_for_request:
                        matComponent["quantity_needed_for_request"] -
                        quantity_avail,
                    item_code: matComponent["item_code"],
                });
            }
        }
    });
    console.log("Below is the data you need for Material Request");
    console.log(createMatRequestItems);
}

function getRawMaterialQuantity(rawMaterial) {
    let data = "";
    $.ajax({
        url: "getRawMaterialQuantity/" + rawMaterial,
        type: "get",
        async: false,
        success: function (response) {
            data = response;
        },
    });
    return data;
}

// Dynamically placing a create material request button if a raw material is insufficient
// function showCreateMaterialRequestBtn() {
//     $("#create-material-req-btn").html(
//         '<button class="btn btn-primary btn-sm float-right">Create Material Request</button>'
//     );
// }

$("#saleQuantity").keyup(function () {
    new_values = [];
    document.querySelectorAll(".mt-available").forEach(
        (e) => new_values.push(e.textContent)
        // $("") = $("#saleQuantity").val() * e.value;
    );
    document
        .querySelectorAll(".mt-needed")
        .forEach(
            (e, i) => (e.textContent = $("#saleQuantity").val() * new_values[i])
        );
});

function viewOrderedProducts(id) {
    $.ajax({
        url: "view/" + id,
        type: "get",
        success: function (response) {
            $("#viewProductsTable tr").remove();
            response.forEach((row) => {
                $("#viewProductsTable").append(
                    '<tr> <td class="text-center">  ' +
                        row["product_code"] +
                        '</td><td class="text-center d-flex justify-content-center">  <input type="number" class="form-control w-25 text-center " value=' +
                        row["quantity_purchased"] +
                        " disabled></td></tr>"
                );
            });
        },
    });
}

//Get paymentlogs
function viewPayments(id) {
    $.ajax({
        url: "getPaymentLogs/" + id,
        type: "get",
        success: function (response) {
            $("#view_payment_logs tr").remove();
            document.getElementById("view_totalamount").value = 0.0;
            response.forEach((row) => {
                $("#view_payment_logs").append(
                    `<tr>
                    <td class="text-center">
                        ` +
                        row["id"] +
                        `
                    </td>
                    <td class="text-center">
                        ` +
                        row["date_of_payment"].slice(0, 10) +
                        `
                    </td>
                    <td class="text-center">
                        ` +
                        row["amount_paid"] +
                        `
                    </td>
                    <td class="text-center">
                        ` +
                        row["payment_description"] +
                        `
                    </td>
                    <td class="text-center">
                        ` +
                        row["payment_method"] +
                        `
                    </td>
                    <td class="text-center">
                        <select class="form-select" onchange="updatePayment( ` +
                        row["id"] +
                        `, value);">
                                        <option value="" selected disabled> ` +
                        row["payment_status"] +
                        ` </option>
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                        </select>
                    </td>
                    <td class="text-center">
                        ` +
                        row["customer_rep"] +
                        `
                    </td>
                </tr>`
                );
            });
        },
    });

    $.ajax({
        url: "getPaymentType/" + id,
        type: "get",
        success: function (response) {
            //Remove options
            var i,
                L =
                    document.getElementById("view_salePaymentMethod").options
                        .length - 1;
            for (i = L; i >= 0; i--) {
                document.getElementById("view_salePaymentMethod").remove(i);
            }
            if (response === "Cash") {
                "#view_salePaymentMethod".value = "Already Fully Paid";
                var o = new Option("Already Fully Paid", "");
                $(o).html(" Already Fully Paid");
                $("#view_salePaymentMethod").append(o);
                document.getElementById("view_savepayment").disabled = true;
                document.getElementById("view_paymentType").disabled = true;
            } else if (response === "Payment still pending") {
                "#view_salePaymentMethod".value = "Payment still pending";
                var o = new Option("Payment still pending", "");
                $(o).html("Payment still pending");
                $("#view_salePaymentMethod").append(o);
                document.getElementById("view_savepayment").disabled = true;
                document.getElementById("view_paymentType").disabled = true;
            } else {
                document.getElementById("view_savepayment").disabled = false;
                document.getElementById("view_paymentType").disabled = false;
                document.getElementById("view_savepayment").value = id;
                var repeater = 0;
                switch (response) {
                    case "3 months":
                        repeater = 3;
                        break;
                    case "6 months":
                        repeater = 6;
                        break;
                    case "12 months":
                        repeater = 12;
                        break;
                }
                for (let index = 0; index < repeater; index++) {
                    var o = new Option(
                        index + 1 + " Installment",
                        index + 1 + " Installment"
                    );
                    $(o).html(index + 1 + " Installment");
                    $("#view_salePaymentMethod").append(o);
                }
                //Gets amount to be paid
                $.ajax({
                    url: "getAmountToBePaid/" + id,
                    type: "get",
                    success: function (response) {
                        document.getElementById(
                            "view_totalamount"
                        ).value = response;
                    },
                });
            }
        },
    });
}

//Updates payment in payment_status
function updatePayment(id, value) {
    //@TODO
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
        },
    });
    var data = {};
    data["status"] = value;
    $.ajax({
        url: "updateStatus/" + id,
        type: "patch",
        data: data,
        success: function (response) {
            console.log(response);
            loadRefresh();
        },
        error: function (response) {
            console.log(response);
        },
    });
}

function enableAddtoProduct() {
    document.getElementById("btnAddProduct").disabled = false;
}
