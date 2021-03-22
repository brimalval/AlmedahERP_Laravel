// Functions here will not work on the full page tab of a new sale as there are duplicates

// on the modal in salesorder.php
$(document).ready(function () {
    $("#notif").hide();
});
$("#idBtn").on('click', function () {
    var id = $("#custId").val();
    $.ajax({
        url: '/search-customer/' + id,
        type: "GET",
        data: { 'id': id },
        success: function (data) {
            $("#fName").val(data.customer_data[0].customer_fname);
            $("#lName").val(data.customer_data[0].customer_lname);
            $("#contactNum").val(data.customer_data[0].contact_number);
            $("#branchName").val(data.customer_data[0].branch_name);
            $("#companyName").val(data.customer_data[0].company_name);
            $("#custEmail").val(data.customer_data[0].email_address);
            $("#custAddress").val(data.customer_data[0].address);
        }
    });
});

$("#closeSaleOrderModal").on('click', function () {
    $('#custId').val("0000001");
    $('#fName').val(null);
    $('#lName').val(null);
    $('#contactNum').val(null);
    $('#custEmail').val(null);
    $('#branchName').val(null);
    $('#companyName').val(null);
    $('#custAddress').val(null);
});

// Creating a custom reset method since the native reset
// function also resets the values of the materials in case
// they've been changed in the inventory tab
//function resetForm() {
//  $('#product_name').val(null);
//  $('#internal_description').val(null);
//  // Making the image field required again in case it was set as not required
//  // for whatever reason (such as making the create form an update form)
//  $('#picture').attr('required', 'required');
//  $('#product_type').val(null);
//  $('#product_type').selectpicker('refresh');
//  $('#unit').val(null);
//  $('#product-form').attr('action', 'create-product');
//  $('#img_tmp').attr('src', 'images/thumbnail.png');
//  $('#unit').selectpicker('refresh');
//  $('#attribute').val(null);
//  $('#attribute').selectpicker('refresh');
//  $('#materials').val(null);
//  $('#materials').selectpicker('refresh');
//  $('[name="product_category"]').val("none");
//  $('[name="procurement_method"]').val("none");
//  // Changing the input type to reset the file list
//  // $('input[name="picture"]')[0].type='';
//  // $('input[name="picture"]')[0].type='file';
//  $('#bar_code').val(null);
//  $('#sales_price_wt').val(null);
//  materialList = [];
//  attributeList = [];
//  $('#attributes_div').html('');
//  // Removing each of the selected material badges
//  $('.material-badge').each(function () {
//    this.remove();
//  });
//}
$("#saveSaleOrder").click(function () {
    continueToWorkOrder("#saveSaleOrder");
    $("#notif").hide();
});


//from old version of front-end js file
$("#saveSaleOrder1").click(function () {
    continueToWorkOrder("#saveSaleOrder1");
});
$(".form-check > .append-check").click(function () {
    $rowElement = $(this).parent().parent().parent();
    if ($(this).prop("checked") == true) {
        $rowElement.next().show();
    }
    else {
        $rowElement.nextAll().find("input").prop('checked', false);
        $rowElement.nextUntil("#rowTotal").hide();
    }
});

/**
 * function continueToWorkOrder(x) {
  if (saveSaleOrder(document.getElementById("saleCustomerForm"), document.getElementById("saleFormInfo"))) {
    $(`${x} > a`).attr("data-name", "Work Order");
    $(`${x} > a`).attr("data-parent", "manufacturing");
    $(`${x} > a`).attr("data-dismiss", "modal");
    $(`${x} > a`).addClass("nav-link menu");
    let myVar = setTimeout(function () {
      $(`${x} > a`).removeClass("nav-link menu");
    },
      100);
  }
}
 */
//end

function sellable() {
    let checked = document.getElementById("isSellable").checked;
    if (checked) {
        let x = 0;
        document.querySelectorAll('.sellable').forEach(function (input) {
            input.removeAttribute("disabled");
        });
        document.getElementById("isSellable").value = 1;

    } else {
        document.querySelectorAll('.sellable').forEach(function (input) {
            input.setAttribute("disabled", "");
        });
        document.getElementById("isSellable").value = 0;
    }
}

function selectSalesMethod() {
    var selected = document.getElementById("saleSupplyMethod").value;
    if (selected == "Produce") {
        document.getElementById("cardComponent").style.display = "block";
    } else {
        console.log(selected);
        document.getElementById("cardComponent").style.display = "none";
    }
}

function selectPaymentMethod() {
    var selectedPayment = document.getElementById("salePaymentMethod").value;
    if (selectedPayment == "Installment") {
        document.getElementById("paymentInstallment").style.display = "flex";
    } else {
        document.getElementById("paymentInstallment").style.display = "none";
    }
}

var totalValue = 0;
var ultimateComponentTable = {};

function componentAdder(name, val){
    if (name in ultimateComponentTable){
        ultimateComponentTable[name]["qty"] +=  val;
    }else{
        ultimateComponentTable[name] = {"qty": val}
    }
}


//For getting details of product
$("#saleProductCode").change(function () {
    $(".components").html("");
    document.getElementById("btnAddProduct").disabled= false;
    selected = $("#saleProductCode option:selected").text();
    $.ajax({
        url: "/getComponents/" + selected,
        type: "GET",
        success: function (components) {
            for (component of components) {
                // set status of each component
                if (
                    component[0] == 0 &&
                    component[0] < component[0] * $("#saleQuantity").val()
                ) {
                    status = "Out of stock";
                } else if (
                    component[0] != 0 &&
                    component[0] < component[0] * $("#saleQuantity").val()
                ) {
                    status = "Insufficient";
                } else if (component[0] >= $("#saleQuantity").val()) {
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
                    component[2] +
                    `
              </td>
              <td class="text-center">
                  ` +
                    component[1] +
                    `
              </td>
              <td class="mt-available" style="text-align: center;">` +
                    component[0] +
                    `</td>
              <td class="mt-needed text-center">
                  ` +
                    $("#saleQuantity").val() * component[0] +
                    `
              </td>
              <td class="text-danger text-center">
                  ` +
                    status +
                    `
              </td>
          </tr>`
                );
            }
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        },
    });
});

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


function addToTable(){
    $('#ProductsTable').append('<tr><td><div class="form-check"><input type="checkbox" class="form-check-input">  </div></td><td class="text-center">  EM181204</td><td class="text-center d-flex justify-content-center">  <input type="number" class="form-control w-25 text-center " value="10"></td><td class="text-center">  <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Remove</button></td></tr>' );
}

function deleteRow(r) {
    // Index of row
    console.log(r.parentNode.parentNode.rowIndex);

    $(r).parent().parent().remove();
}