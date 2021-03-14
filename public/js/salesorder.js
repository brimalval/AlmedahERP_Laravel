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
});
$("#saveSaleOrder1").click(function () {
  continueToWorkOrder("#saveSaleOrder1");
});
function continueToWorkOrder(x) {
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
function saveSaleOrder(form1, form2) {
  let valid = true; let isWithEmpty1 = true; let isWithEmpty2 = true;
  let inputs1 = form1.getElementsByTagName('input');
  let inputs2 = form2.getElementsByTagName('input');
  for (let x = 0; x < inputs1.length; x++) {
    if (inputs1[x].value == "") {
      inputs1[x].classList.remove("border-danger");
      inputs1[x].classList.add("border-danger");
      isWithEmpty1 = (isWithEmpty1) ? true : false;
    }
  }
  for (let x = 0; x < inputs2.length; x++) {
    if (inputs2[x].value == "") {
      if (!inputs2[x].hasAttribute("disabled")) {
        inputs2[x].classList.remove("border-danger");
        inputs2[x].classList.add("border-danger");
      }
      isWithEmpty2 = (isWithEmpty2) ? true : false;
    }
  }
  valid = (!isWithEmpty1 && !isWithEmpty2) ? true : false;
  if (!valid) {
    $("#notif").fadeIn();
    let myVar = setTimeout(function () {
      $("#notif").fadeOut();
    },
      3000);
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
  } else {
    document.querySelectorAll('.sellable').forEach(function (input) {
      input.setAttribute("disabled", "");
    });
  }
}

function selectSalesMethod() {
  var selected = document.getElementById("saleSupplyMethod").value;
  if (selected == "Produce") {
    document.getElementById("cardComponent").style.display = "block";
  }
  else if (selected == "Purchase") {
    document.getElementById("cardComponent").style.display = "none";
  }
  else {
    console.log(selected);
    document.getElementById("cardComponent").style.display = "none";
  }
}

function selectPaymentMethod() {
  var selectedPayment = document.getElementById("salePaymentMethod").value;
  if (selectedPayment == "Installment") {
    document.getElementById("paymentInstallment").style.display = "flex";
  }
  else {
    document.getElementById("paymentInstallment").style.display = "none";
  }
}