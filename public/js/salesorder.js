// Functions here will not work on the full page tab of a new sale as there are duplicates

// on the modal in salesorder.php
$(document).ready(function () {
    $("#notif").hide();
});
$("#saveSaleOrder").click(function () {
    continueToWorkOrder("#saveSaleOrder");
});
$("#saveSaleOrder1").click(function () {
    continueToWorkOrder("#saveSaleOrder1");
});
function continueToWorkOrder(x) {
    if (
        saveSaleOrder(
            document.getElementById("saleCustomerForm"),
            document.getElementById("saleFormInfo")
        )
    ) {
        $(`${x} > a`).attr("data-name", "Work Order");
        $(`${x} > a`).attr("data-parent", "manufacturing");
        $(`${x} > a`).attr("data-dismiss", "modal");
        $(`${x} > a`).addClass("nav-link menu");
        let myVar = setTimeout(function () {
            $(`${x} > a`).removeClass("nav-link menu");
        }, 100);
    }
}
function saveSaleOrder(form1, form2) {
    let valid = true;
    let isWithEmpty1 = true;
    let isWithEmpty2 = true;
    let inputs1 = form1.getElementsByTagName("input");
    let inputs2 = form2.getElementsByTagName("input");
    for (let x = 0; x < inputs1.length; x++) {
        if (inputs1[x].value == "") {
            inputs1[x].classList.remove("border-danger");
            inputs1[x].classList.add("border-danger");
            isWithEmpty1 = isWithEmpty1 ? true : false;
        }
    }
    for (let x = 0; x < inputs2.length; x++) {
        if (inputs2[x].value == "") {
            if (!inputs2[x].hasAttribute("disabled")) {
                inputs2[x].classList.remove("border-danger");
                inputs2[x].classList.add("border-danger");
            }
            isWithEmpty2 = isWithEmpty2 ? true : false;
        }
    }
    valid = !isWithEmpty1 && !isWithEmpty2 ? true : false;
    if (!valid) {
        $("#notif").fadeIn();
        let myVar = setTimeout(function () {
            $("#notif").fadeOut();
        }, 3000);
    }
    return valid;
}
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
    } else if (selected == "Purchase") {
        document.getElementById("cardComponent").style.display = "none";
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
$("#saleProductCode").change(function () {
    $(".components").html("");
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
