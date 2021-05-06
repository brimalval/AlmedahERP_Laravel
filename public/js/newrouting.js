function addRowbomOperation(){
    if($('#no-data')[0]){
        deleteItemRow($('#no-data').parents('tr'));
    }
    let lastRow = $('#newrouting-input-rows tr:last');
    let nextID = (lastRow.length != 0) ? lastRow.data('id') + 1 : 0;
    $('#newrouting-input-rows').append(
    `                <tr data-id="${nextID}">
    <td class="text-center">
    
    <div class="form-check" >
        <input type="checkbox" class="form-check-input">
    </div>
    </td>
    <td id="mr-code-input" class="mr-code-input"><input type="text" value=""  name="seq_id" id="seq_id" class="form-control"></td>
    <td style="width: 10%;" class="mr-qty-input"><input type="text" value=""  name="operation" id="operation" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value=""  name="workcenter" id="workcenter" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value=""  name="description" id="description" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value=""  name="operation_time" id="operation_time" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value=""  name="operating_cost" id="operating_cost" class="form-control"></td>   
    <td>
        <a id="" class="btn" data-toggle="modal" data-target="#edit_routing" href="#" role="button">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
        <a id="" class="btn delete-btn" href="#" role="button">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>`);
}


$(document).ready(function() {
    $('.summernote').summernote({
        height: 200
    });
    $('#myTimeline').verticalTimeline({
        startLeft: false,
        alternate: false,
        arrows: false
    });
});
