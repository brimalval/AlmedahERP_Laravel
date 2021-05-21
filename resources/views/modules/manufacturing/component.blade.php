<div class="container rounded">
    <div class="row d-flex justify-content-center">
        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">Components</h4>
            <div class="alert alert-success alert-dismissible" id="component-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
            <div class="alert alert-danger alert-dismissible" id="component-danger" style="display:none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button type="button" class="btn btn-outline-primary btn-sm" onclick="$('#newComponentModal').modal('toggle')"><i class="fas fa-plus" aria-hidden="true"></i> Add
                            New</button></p>
                </div>
            </div>
            <table id="componentTable" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Component Code</th>
                        <th>Component Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Raw Materials</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($components as $row)
                        <tr id="<?=$row["id"]?>">
                            <td class="text-black-50"><?=$row["component_code"]?></td>
                            <td class="text-black-50"><?=$row["component_name"]?></td>
                            <td class="text-black-50"><button class="btn btn-primary btn-sm" onclick="$('#component-image-modal').modal('toggle')">View</button></td>
                            <td class="text-black-50"><?=$row["component_description"]?></td>
                            <td class="text-black-50"><button class="btn btn-primary btn-sm" onclick='showRawMaterials(<?=$row["item_code"]?>)'>View</button></td>
                            <td class="">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="align-content-center dropdown-menu p-0" style="background: 0; min-width:125px;" role="menu">
                                        <li><button data-id="{{ $row->id }}" class="edit-btn btn btn-warning btn-sm rounded-0" type="button">
                                            <i class="fa fa-edit"></i> Edit</button>
                                        </li>
                                        <li>
                                            <button data-id="{{ $row->id }}" class="delete-btn btn btn-danger btn-sm rounded-0" type="button">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- IMAGE MODAL --}}
<div class="modal fade" id="component-image-modal" tabindex="-1" role="dialog" aria-labelledby="exampleImageLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content m-0 p-0">
            <div class="modal-body">
                <center><img id="component-image-view" src="images/toupdate.jpg" style="height:100%; width:100%;"></center>
            </div>
        </div>
    </div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="newComponentModal">
    <form action="" id="addComponentForm">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new component</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Component Code
                            </label>
                            <input type="text" class="form-input form-control sellable" id="componentCode"
                                name="component_code">
                        </div>
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Component Name
                            </label>
                            <input type="text" class="form-input form-control sellable" id="componentName"
                                name="component_name">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Item Code
                            </label>
                            <input list="raw_materials" class="form-input form-control" name="item_code" id="componentItemCode" autocomplete="off">
                            <datalist id="raw_materials">
                            @foreach ($raw_materials as $row)
                                <option value="{{$row->item_code}}">{{$row->item_name}} </option>
                            @endforeach
                            </datalist> 
                            <div class="alert alert-danger alert-dismissible mt-2" id="add-danger" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            {{-- <input type="text" class="form-input form-control sellable" id="componentItemCode"
                                name="item_code"> --}}
                            <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="addRowNewComponent('rawMats')">Add Item</button>
                        </div>
                        <div class="col">
                            <label for="" class="text-nowrap align-middle">Image</label><br>
                            <input type="file" name="component_image[]" id="componentImg[]">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="" class="text-nowrap align-middle">Component Description</label><br>
                            <textarea class="form-input form-control sellable" name="component_description"
                                id="componentDescription" cols="" rows="4" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2 m-1 d-flex justify-content-center">
                        <table id="newComponentTable" class="table table-striped table-bordered hover">
                            <thead>
                                <th class="center"><input type="checkbox" name="" id=""></th>
                                <th>Raw Material Name</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="rawMats">

                            </tbody>
                        </table>
                        <div id="noItems">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#newComponentModal').modal('toggle')">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- UPDATE MODAL --}}
<div class="modal fade" id="updateComponentModal">
    <form action="" id="updateComponentForm">
        @csrf
        @method('PATCH')
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Component</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Component Code
                            </label>
                            <input type="text" class="form-input form-control sellable" id="componentCodeUpdate"
                                name="component_code" disabled>
                        </div>
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Component Name
                            </label>
                            <input type="text" class="form-input form-control sellable" id="componentNameUpdate"
                                name="component_name">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label class="text-nowrap align-middle">
                                Item Code
                            </label>
                            <input list="raw_materials" class="form-input form-control" name="item_code" id="componentItemCodeUpdate" autocomplete="off">
                            <datalist id="raw_materials">
                            @foreach ($raw_materials as $row)
                                <option value="{{$row->item_code}}">{{$row->item_name}} </option>
                            @endforeach
                            </datalist> 
                            <div class="alert alert-danger alert-dismissible mt-2" id="update-danger" style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="addRowNewComponent('rawMatsUpdate', 'true')">Add Item</button>
                        </div>
                        <div class="col">
                            <label for="" class="text-nowrap align-middle">Image</label><br>
                            <input type="file" name="component_image[]" id="componentImg[]">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="" class="text-nowrap align-middle">Component Description</label><br>
                            <textarea class="form-input form-control sellable" name="component_description"
                                id="componentDescriptionUpdate" cols="" rows="4" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2 m-1 d-flex justify-content-center">
                        <table id="updateComponentTable" class="table table-striped table-bordered hover">
                            <thead>
                                <th class="center"><input type="checkbox" name="" id=""></th>
                                <th>Raw Material Name</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="rawMatsUpdate">

                            </tbody>
                        </table>
                        <div id="noItemsUpdate">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#updateComponentModal').modal('toggle')">Close</button>
                    <button type="submit" id="update-component-form-modal-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="rawMaterials">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Raw Materials</h5>
                </div>
                <div class="modal-body">
                    <div class="row mt-2 m-1 d-flex justify-content-center">
                        <table id="newComponentTable" class="table table-striped table-bordered hover">
                            <thead>
                                <th>Raw Material Name</th>
                                <th>Item Code</th>
                                <th>Qty</th>
                            </thead>
                            <tbody id="rawMatsShow">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#rawMaterials').modal('toggle')">Close</button>
                </div>
            </div>
        </div>
</div>
<!-- End of Modal -->
<script>
    let i = 1;
    let id;
    let raw_materials = [];
    ifEmpty();
    function addRowNewComponent(tableName, componentItemCode) {
        let include = false;
        let item_code = (componentItemCode!=null) ? $('#componentItemCodeUpdate').val() : $('#componentItemCode').val();
        var tableBody = $("#"+tableName);
        console.log(item_code);
        if(raw_materials){
            raw_materials.forEach(rawMat=>{
                console.log(rawMat['item_code']);
                if(rawMat['item_code']==item_code){
                    include = true;
                }
            });
        }
        if(include){
            let attr_name = (componentItemCode===null) ? "add-danger" : "update-danger";
            $('#'+attr_name).show();
            $("#"+attr_name).html('Raw Material already included in Component!');
            $("#"+attr_name).delay(4000).hide(1);
            // alert('Item already included in Component')
        }else{ 
            $.ajax({
                url: '/get-item/' + item_code,
                type: "GET",
                data: { 'item_code': item_code },
                success: function (data) {
                    let item_name = data.item_name;
                    tableBody.append(
                    `
                        <tr class="center">
                            <td><input type="checkbox" id="check${data.id}"></td>
                            <td><p name="rawMat${i}">`+item_name+`</p></td>
                            <td><input type="number" id="${item_name}" name="qty${i}" min="1"></td>
                            <td><input type="button" value="Delete" class="btn btn-danger" onclick="removeRow('${item_name}')"/></td>
                        </tr>
                    `
                    );
                    raw_materials.push({"item_name":item_name, "item_qty": "", "item_code": item_code});
                    ifEmpty();
                    $("#"+item_name).change(function(){
                        let material = raw_materials.find(material=>material.item_name==item_name);
                        console.log(material);
                        material.item_qty = $("#"+item_name).val();
                        console.log("rawmats"+JSON.stringify(material));
                    });
                    // console.log(raw_materials);
                    console.log(raw_materials);
                }, error: () =>
                    console.log('No item Found')
            });
            i++;
        }
    }

    function ifEmpty(){
        if(raw_materials.length == 0){
            $("#noItems").html('<p>There are no items yet</p>')
        }else{
            $("#noItems").html('')
        }
    }

    function showRawMaterials(item_code){
        $("#rawMaterials").modal('toggle');
        console.log(item_code);
        var tableBody = $("#rawMatsShow");
        tableBody.empty();
        item_code.forEach(el => {
            tableBody.append(
            `
                <tr class="center">
                    <td><p>`+el.item_name+`</p></td>
                    <td><p>`+el.item_code+`</p></td>
                    <td><p>`+el.item_qty+`</p></td>
                   
                </tr>
            `
            );
        });
    }

    function removeRow(itemName){
        console.log(itemName);
        var td = event.target.parentNode; 
        var tr = td.parentNode; // the row to be removed
        tr.parentNode.removeChild(tr);
        console.log('before');
        console.log(raw_materials);
        raw_materials = raw_materials.filter(rawMat=>
            rawMat.item_name !== itemName
        );
        ifEmpty();
        console.log('after');
        console.log(raw_materials);
    }
    


    $('#addComponentForm').on('submit', function(e){
        e.preventDefault();
        let empty_qty = raw_materials.find(raw_mat=>raw_mat.item_qty === "" || undefined);
        if(raw_materials.length == 0){
            $('#add-danger').show();
            $("#add-danger").html('Cannot create a component without raw materials');
            $("#add-danger").delay(4000).hide(1);
            // alert('Cannot create a component without raw materials');
        }else if(empty_qty !== undefined){
            $('#add-danger').show();
            $("#add-danger").html('Cannot proceed with a Raw material with a quantity of 0');
            $("#add-danger").delay(4000).hide(1);
        }else{
            component_raw_materials = JSON.stringify(raw_materials);
            $('#componentItemCode').val(component_raw_materials);
            // var formData = new FormData(addComponentForm);
            // formData.set("item_code", component_raw_materials);
            $.ajax({
            type: "POST",
            url: "/create-component",
            data: $("#addComponentForm").serialize(),
            success: function (r) {
                var tableBody = $("#rawMats");
                if(r.status != 'error'){
                    $('#newComponentModal').modal('toggle');
                    $('#componentItemCode').val("hidden");
                    var id = r.component.id;
                    const dataTable = $("#componentTable").DataTable();
                    dataTable.row
                        .add([
                            // "<span class='text-black-50'>" + r.component.id + "</span>",
                            "<span class='text-black-50'>" +
                                r.component.component_code +
                                "</span>",
                            "<span class='text-black-50'>" +
                                r.component.component_name +
                                "</span>",
                            "<span class='text-black-50'><td class='text-black-50'><a class='btn btn-primary btn-sm' href=''>View</a></td></span>",
                            "<span class='text-black-50'>" +
                                (r.component.description ?? '') +
                                "</span>",
                            "<span class='text-black-50'><td class='text-black-50'><button class='btn btn-primary btn-sm' onclick='showRawMaterials("+r.component.item_code+")'>View</button></td></span>" ,
                            `<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions
                                </button>
                                <ul class="align-content-center dropdown-menu p-0" style="background: 0; min-width:125px;" role="menu">
                                    <li><button data-id="`+r.component.id+`" class="edit-btn btn btn-warning btn-sm rounded-0" type="button">
                                        <i class="fa fa-edit"></i> Edit</button>
                                    </li>
                                    <li>
                                        <button data-id="`+r.component.id+`" class="delete-btn btn btn-danger btn-sm rounded-0" type="button">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </li>
                                </ul>
                            </div>`
                        ])
                        .node().id = id;
                    dataTable.draw();
                    $('#component-success').show();
                    $("#component-success").html(r.message);
                    $("#component-success").delay(4000).hide(1);
                    $("#addComponentForm")[0].reset();
                    tableBody.empty();
                    raw_materials = [];
                }else{
                    $('#newComponentModal').modal('toggle');
                    $('#componentItemCode').val("hidden");
                    $('#component-danger').show();
                    $("#component-danger").html(r.message);
                    $("#component-danger").delay(4000).hide(1);
                    $("#addComponentForm")[0].reset();
                    tableBody.empty();
                    raw_materials = [];
                }
                
                // $('#componentItemCode').val('');
                raw_materials = [];
            },
            error: function () {
                console.log('error');
            },
        });
        }
    });

    $('#updateComponentForm').on('submit', function(e){
        e.preventDefault();
        if(raw_materials.length == 0){
            $('#update-danger').show();
            $("#update-danger").html('Cannot update a component without raw materials');
            $("#update-danger").delay(4000).hide(1);
            // alert('Cannot update a component without raw materials');
        }else{
            component_raw_materials = JSON.stringify(raw_materials);
            $('#componentItemCodeUpdate').val(component_raw_materials);
            // var formData = new FormData(addComponentForm);
            // formData.set("item_code", component_raw_materials);
            $.ajax({
                type: "POST",
                url: "/update-component/"+id,
                data: $("#updateComponentForm").serialize(),
                success: function (r) {
                    var tableBody = $("#rawMatsShow");
                    console.log(r.component);
                    if(r.status != 'error'){
                        $('#newComponentModal').modal('toggle');
                        $('#componentItemCode').val("hidden");
                        var id = r.component.id;
                        const dataTable = $("#componentTable").DataTable();
                        // dataTable.row
                        //     .add([
                        //         // "<span class='text-black-50'>" + r.component.id + "</span>",
                        //         "<span class='text-black-50'>" +
                        //             r.component.component_code +
                        //             "</span>",
                        //         "<span class='text-black-50'>" +
                        //             r.component.component_name +
                        //             "</span>",
                        //         "<span class='text-black-50'><td class='text-black-50'><a class='btn btn-primary btn-sm' href=''>View</a></td></span>",
                        //         "<span class='text-black-50'>" +
                        //             (r.component.description ?? '') +
                        //             "</span>",
                        //         "<span class='text-black-50'><td class='text-black-50'><button class='btn btn-primary btn-sm' onclick='showRawMaterials("+r.component.item_code+")'>View</button></td></span>",
                        //         '<a href="#" class="btn btn-success btn-sm rounded-0 editBtn" type="button"><i class="fa fa-edit"></i></a>',
                        //     ])
                        //     .node().id = id;
                        // dataTable.draw();
                        $('#component-success').show();
                        $("#component-success").html(r.message);
                        $("#component-success").delay(4000).hide(1);
                        $("#addComponentForm")[0].reset();
                        tableBody.empty();
                        raw_materials = [];
                    }else{
                        console.log(r.component);
                        $('#updateComponentModal').modal('toggle');
                        $('#componentItemCode').val("hidden");
                        $('#component-danger').show();
                        $("#component-danger").html(r.message);
                        $("#component-danger").delay(4000).hide(1);
                        $("#updateComponentForm")[0].reset();
                        tableBody.empty();
                        raw_materials = [];
                    }
                    
                    // $('#componentItemCode').val('');
                    raw_materials = [];
                },
                error: function (data) {
                    console.log('error');
                    console.log(data.errors);
                },
            });
        }
    });

    $(document).ready(function() {
        $('#componentTable').DataTable();
    });

    $('body').on('click', '.edit-btn', function(e) {
            e.preventDefault();
            let element = this;
            id = element.dataset.id;
            raw_materials = [];
            $.ajax({
                    type: 'GET',
                    url: 'get-component/' + id,
                    data: null,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        $('#componentItemCodeUpdate').val(data.item_code);
                        $('#componentCodeUpdate').val(data.component_code);
                        $('#componentNameUpdate').val(data.component_name);
                        $('#componentDescriptionUpdate').val(data.component_description);
                        let tableBody = $("#rawMatsUpdate");
                        let rawMatsInComponent = JSON.parse(data.item_code);
                        console.log(rawMatsInComponent);
                        rawMatsInComponent.forEach((rawMat)=>{
                            tableBody.append( `
                                <tr class="center">
                                    <td><input type="checkbox" id="check${rawMat.id}"></td>
                                    <td><p>`+rawMat.item_name+`</p></td>
                                    <td><input type="number" min="1" value="${rawMat.item_qty}"></td>
                                    <td><input type="button" value="Delete" class="btn btn-danger" onclick="removeRow('${rawMat.item_name}')"/></td>
                                </tr>
                            `);
                            raw_materials.push({"item_name":rawMat.item_name, "item_qty": rawMat.item_qty, "item_code": rawMat.item_code});
                        });
                        console.log('this is the raw mats');
                        console.log(raw_materials);
                        // if (data.status == "success") {
                        //     $(document).ready(function() {
                        //         sessionStorage.setItem("status", "success");
                        //         // Removing a row from the data table
                        //         var table = $('#componentTable');
                        //         table.DataTable()
                        //             .row(row)
                        //             .remove()
                        //             .draw();
                        //     });
                        // } else {
                        //     alert(data.message);
                        // }

                    },
                    error: function(data) {
                        console.log("error");
                        console.log(data);
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "error");
                            $('#divMain').load('/component');
                        });
                    }
                });
            $('#updateComponentModal').modal('toggle');
            // var element = this;
            // var id = element.dataset.id;
            // // Adding the ID to a variable accessible to the ajax call
            // sessionStorage.setItem('material-edit-id', id);
            // var form = $('#update-material-form');
            // var modal = $('#update-material-form-modal');
            // form.attr('action', '/update-material/' + id);

            // // Finding the element being edited and returning the details
            // $.get('/inventory/' + sessionStorage.getItem('material-edit-id'), function(data, status) {
            //     let images = JSON.parse(data.item_image);
            //     $('#material_name').val(data.item_name);
            //     $('#material_code').val(data.item_code);
            //     $('#material_category').val(data.category_id);
            //     $('#img_tmp_edit').attr('src', 'storage/' + images[0]);
            //     sessionStorage.setItem('old_image', 'storage/' + images[0]);
            //     $('#rm_status').val(data.rm_status);
            //     $('#unit_price').val(data.unit_price);
            //     $('#total_amount').val(data.total_amount);
            // });

            // modal.modal('show');
        });

    $('body').on('click', '.delete-btn', function(e) {
            var id = this.dataset.id;
            var row = $(this).parents('tr');
            if (confirm("Are you sure?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'delete-component/' + id,
                    data: null,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.status == "success") {
                            $(document).ready(function() {
                                sessionStorage.setItem("status", "success");
                                // Removing a row from the data table
                                var table = $('#componentTable');
                                table.DataTable()
                                    .row(row)
                                    .remove()
                                    .draw();
                            });
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(data) {
                        console.log("error");
                        console.log(data);
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "error");
                            $('#divMain').load('/component');
                        });
                    }
                });
            }
            return false;
        });


</script>
