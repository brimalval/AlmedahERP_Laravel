<div class="container rounded">
    <div class="row d-flex justify-content-center">
        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">Components</h4>
            <div id="alert-message">
            </div>
            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                            data-target="#newComponentModal"><i class="fas fa-plus" aria-hidden="true"></i> Add
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
                        <th>Item Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($components as $row)
                        <tr id="<?=$row["id"]?>">
                            <td class="text-black-50"><?=$row["component_code"]?></td>
                            <td class="text-black-50"><?=$row["component_name"]?></td>
                            <td class="text-black-50"><a href="">View</a></td>
                            <td class="text-black-50"><?=$row["component_description"]?></td>
                            <td class="text-black-50"><?=$row["item_code"]?></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newComponentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form action="" id="addComponentForm">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new component</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                            <input type="text" class="form-input form-control sellable" id="componentItemCode"
                                name="item_code">
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
                                <th>Raw Materials Name</th>
                                <th>Qty</th>
                            </thead>
                            <tbody id="rawMats">

                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm ml-1" onclick="addRowNewComponent()">Add
                        Row</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End of Modal -->
<script>
    var i = 1;

    function addRowNewComponent() {
        var tableBody = $("#rawMats");
        tableBody.append(
            `
                <tr class="center">
                    <td><input type="checkbox" id="check${i}"></td>
                    <td><input class="form-control" type="text" name="rawMat${i}" id="rawMat${i}"></td>
                    <td><input class="form-control" type="number" name="qty${i}" id="qty${i}" min="1"></td>
                </tr>
            `
        );
        i++;

    }

    $('#addComponentForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/create-component",
            data: $("#addComponentForm").serialize(),
            success: function (r) {
                console.log('success');
            },
            error: function () {
                console.log('error');
            },
        });
    });

    $(document).ready(function() {
        $('#componentTable').DataTable();
    });

</script>
