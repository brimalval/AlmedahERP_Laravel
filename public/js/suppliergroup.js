$(document).ready(function () {
    $(".sg-select").selectpicker();
    sgChkFunction();
});

$("#sgSuppField").change(function () { 
    var suppID = $("#sgSuppField").val();
    $.ajax({
        type: 'GET',
        url: `/get-supplier/${suppID}`,
        data: suppID,
        success: function(data) {
            var supplier = data.supplier;
            console.log(supplier);
            $(`#sgNameField`).val(supplier.company_name);
        }
    });
});

$("#sgAddRow").click(function () { 
    var nextID = $("#sgRawMatTbl tbody tr").length + 1;
    var checked = $("#sgMasterChk").prop('checked') ? 'checked' : '';

    $("#sgRawMatTbl tbody").append(
        `
        <tr id='sgItem${nextID}' class="">
            <th scope="row"><input class="sg-check" type="checkbox" ${checked}> ${nextID}</th>
            <td class="sg_item_select">
            </td>
            <td id="sgName${nextID}"></td>
        </tr>
        `
    );

    sgChkFunction();

    $(`select[name="sgRawMat1"]`)
        .eq(0)
        .clone()
        .attr('id', `sgRawMat${nextID}`)
        .attr('onchange', `sgItemSearch(${nextID})`)
        .appendTo(`#sgRawMatTbl tbody tr:last .sg_item_select`)
        .selectpicker();
});

function sgItemSearch(id) {
    var value = $(`#sgRawMat${id}`).val();
    $.ajax({
        type: 'GET',
        url: `/sg-get-item/${value}`,
        data: value,
        success: function(data) {
            var material_data = data.material;
            console.log(material_data);
            $(`#sgName${id}`).html(material_data.item_name);
        }
    });
}

$("#sgMasterChk").change(function () { 
    var checked = $(this).prop('checked');
    var chk = $(".sg-check");
    chk.prop('checked', checked);
    var tr = chk.parent('th').parent('tr');
    if(checked) {
        tr.addClass('.sg-x-item');
        $("#sgDeleteRow").show();
    }
    else {
        tr.removeClass('.sg-x-item');
        $("#sgDeleteRow").hide()
    };
});

$("#sgDeleteRow").click(function () { 
    $(".sg-x-item").remove();
});

function sgChkFunction(){
    $(".sg-check").change(function(){
        var tr = $(this).parent('th').parent('tr');
        if(tr.hasClass('.sg-x-item')){
            tr.removeClass('.sg-x-item');
        } else {
            tr.addClass('.sg-x-item');
        }
    });
}

$("#sgSubmit").click(function () { 
    $("#newSGForm").submit();
});

function getRawMatsSG() {
    var raw_mats = {};
    for(let i=0; i<$("#sgRawMatTbl tbody tr").length; i++) {
        let tr = $(`#sgItem${i+1}`);
        raw_mats[i] = tr.find('select').val();
    }
    return raw_mats;
}

$("#newSGForm").submit(function (e) { 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });

    var formData = new FormData(this);
    var raw_mats = getRawMatsSG();
    formData.append('raw_materials', JSON.stringify(raw_mats));
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(data) {
            loadSupplierGroup();
        }
    });
    e.preventDefault();
    return false;
});