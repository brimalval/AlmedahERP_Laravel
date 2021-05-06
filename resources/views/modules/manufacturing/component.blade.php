<div class="container rounded">
    <div class="row d-flex justify-content-center">
        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">Components</h4>
            <div id="alert-message">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($components as $row)
                        <tr id="<?=$row["id"]?>">
                            <td class="text-black-50"><?=$row["component_code"]?></td>
                            <td class="text-black-50"><?=$row["component_name"]?></td>
                            <td class="text-black-50"><a class="btn btn-primary btn-sm" href="">View</a></td>
                            <td class="text-black-50"><?=$row["component_description"]?></td>
                            <td class="text-black-50"><button class="btn btn-primary btn-sm" onclick='showRawMaterials(<?=$row["item_code"]?>)'>View</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
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
                            {{-- <input type="text" class="form-input form-control sellable" id="componentItemCode"
                                name="item_code"> --}}
                            <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="addRowNewComponent()">Add Item</button>
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
    let raw_materials = [];
    ifEmpty();
    function addRowNewComponent() {
        let include = false;
        let item_code = $('#componentItemCode').val();
        var tableBody = $("#rawMats");
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
            alert('Item already included in Component')
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
                            <td><input type="number" name="qty${i}" id="${item_name}" min="1"></td>
                            <td><input type="button" value="Delete" class="btn btn-danger" onclick="removeRow(`+item_name+`)"/></td>
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
                    console.log(tableBody);
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

    function removeRow(item_name){
        var td = event.target.parentNode; 
        var tr = td.parentNode; // the row to be removed
        tr.parentNode.removeChild(tr);
        raw_materials = raw_materials.filter(rawMat=>
            rawMat['item_name'] == item_name
        );
        ifEmpty();
        console.log(raw_materials);
    }
    


    $('#addComponentForm').on('submit', function(e){
        e.preventDefault();
        if(raw_materials.length == 0){
            alert('Cannot create a component without raw materials');
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
                console.log(r.status);
                $('#newComponentModal').modal('toggle');
                $('#componentItemCode').val("hidden");
                // $('#componentItemCode').val('');
                raw_materials = [];
            },
            error: function () {
                console.log('error');
            },
        });
        }
    });

    $(document).ready(function() {
        $('#componentTable').DataTable();
    });


</script>
