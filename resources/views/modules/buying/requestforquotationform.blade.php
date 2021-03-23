<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadBuyingRequestForQuotation();'
            class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Request for Quotation Form</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Send SMS</a>
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">Email</a>
                        <a class="dropdown-item" href="#">Jump to field <span
                                class="float-right small">Ctrl+J</span></a>
                        <a class="dropdown-item" href="#">Links</a>
                        <a class="dropdown-item" href="#">Duplicate</a>
                        <a class="dropdown-item" href="#">Rename</a>
                        <a class="dropdown-item" href="#">Reload</a>
                        <a class="dropdown-item" href="#">Customize</a>
                        <a class="dropdown-item" href="#">New Request for Quotation <span
                                class="float-right small">Ctrl+B</span></a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" href="#">Save</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row mt-2 mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Supplier Quotation
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#">Create</a>
                                    <a class="dropdown-item" href="#">View</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm ml-1">Send Supplier Emails</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6><strong>DASHBOARD</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <!-- display when NEW button is clicked-->
                                <label for="inputEmail4">Series</label>
                                <select class="form-control"></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Date</label>
                                <input type="date" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>Supplier Detail</strong></h6><br>
                    <table class="table table-hover table-bordered" id="suppTbl">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email Id</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </td>
                                <td><input class="form-control" type="text" name="supp1" id="supp1"
                                        onkeyup="searchSupplier(1);"></td>
                                <td><input class="form-control" type="text" name="suppCont1" id="suppCont1" disabled>
                                </td>
                                <td><input class="form-control" type="text" name="suppEmail1" id="suppEmail1" disabled>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="7 p-5">
                                    <button class="btn btn-secondary btn-sm" id="addSupp">Add Row</button>
                                </td>
                            </tr>
                        </tfoot>

                        <script type="text/javascript">
                            var suppNo = 2;

                            $("#addSupp").click(function() {
                                var suppTblBody = $("#suppTbl tbody");
                                suppTblBody.append(
                                    `
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck` +
                                    suppNo + `">
                                                <label class="custom-control-label" for="customCheck` + suppNo + `">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><input class="form-control" type="text" name="supp` + suppNo +
                                    `" id="supp` + suppNo + `" onkeyup="searchSupplier(` + suppNo + `)"></td>
                                        <td><input class="form-control" type="text" name="suppCont` + suppNo +
                                    `" id="suppCont` + suppNo + `" disabled></td>
                                        <td><input class="form-control" type="text" name="suppEmail` + suppNo +
                                    `" id="suppEmail` + suppNo + `" disabled></td>
                                        <td>&nbsp;</td>    
                                    </tr>
                                    `
                                );
                                suppNo++;
                            });

                            function searchSupplier(id) {
                                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                                var input_id = "#supp" + id;
                                console.log(input_id);
                                $(document).ready(function() {
                                    $(input_id).autocomplete({
                                        source: function(request, response) {
                                            $.ajax({
                                                url: '/search-supplier',
                                                type: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    _token: CSRF_TOKEN,
                                                    search: request.term
                                                },
                                                success: function(data) {
                                                    response(data);
                                                }
                                            });
                                        },
                                        select: function(event, ui) {
                                            //Set selection
                                            $(input_id).val(ui.item.supplier_id);
                                            showSupplierDetails(id, ui.item.supplier_id);
                                            return false;
                                        }
                                    }).data("ui-autocomplete")._renderItem = function(ul, item) {
                                        return $("<li></li>").data("item.autocomplete", item)
                                            .append(
                                                `
                                                <a class='form-control'>
                                                    <strong> ` + item.company_name + `</strong> - ` + item
                                                .supplier_id + `
                                                </a>
                                                `
                                            ).appendTo(ul);
                                    }
                                });
                            }

                            function showSupplierDetails(index, supp_id) {
                                var suppCont = "#suppCont" + index;
                                var suppEmail = "#suppEmail" + index;
                                $.ajax({
                                    method: "GET",
                                    url: '/search/' + supp_id,
                                    data: {
                                        'supp_id': supp_id
                                    },
                                    success: function(data) {
                                        $(suppCont).val(data.supplier[0].phone_number);
                                        $(suppEmail).val(data.supplier[0].supplier_email);
                                    }
                                });
                            }

                        </script>

                    </table>

                    <button class="btn btn-secondary btn-sm">Get Suppliers</button>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>Items</strong></h6>
                    <table class="table table-hover table-bordered" id="itemTbl">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Required Date</th>
                                <th scope="col">Warehouse</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </td>
                                <td><input class="form-control" type="text" name="item1" id="item1"
                                        onkeyup="searchMaterial(1);"></td>
                                <td><input class="form-control" type="number" min="1" name="itemQty1" id="itemQty1">
                                </td>
                                <td><input class="form-control" type="date" name="itemDate1" id="itemDate1"></td>
                                <td><input class="form-control" type="text" name="itemWH1" id="itemWH1"></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="7 p-5">
                                    <button class="btn btn-secondary btn-sm">Add Multiple Row</button>
                                    <button class="btn btn-secondary btn-sm" id="itemBtn">Add Row</button>
                                </td>
                            </tr>
                        </tfoot>

                        <script type="text/javascript">
                            var itemNo = 2;

                            $("#itemBtn").click(function() {
                                var itemTblBody = $("#itemTbl tbody");
                                itemTblBody.append(
                                    `
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck` +
                                    itemNo + `">
                                                <label class="custom-control-label" for="customCheck` + itemNo + `">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><input class="form-control" type="text" name="item` + itemNo +
                                    `" id="item` + itemNo + `" onkeyup="searchMaterial(` + itemNo + `);"></td>
                                        <td><input class="form-control" type="number" min="1" name="itemQty` + itemNo +
                                    `" id="itemQty` + itemNo + `"></td>
                                        <td><input class="form-control" type="date" name="itemDate` + itemNo +
                                    `" id="itemDate` + itemNo + `"></td>
                                        <td><input class="form-control" type="text" name="itemWH` + itemNo +
                                    `" id="itemWH` + itemNo + `"></td>    
                                    </tr>
                                    `
                                );
                                itemNo++;
                            });

                            function searchMaterial(id) {
                                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                                var input_id = "#item" + id;
                                console.log(input_id);
                                $(document).ready(function() {
                                    $(input_id).autocomplete({
                                        source: function(request, response) {
                                            $.ajax({
                                                url: '/search-item',
                                                type: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    _token: CSRF_TOKEN,
                                                    search: request.term
                                                },
                                                success: function(data) {
                                                    response(data);
                                                }
                                            });
                                        },
                                        select: function(event, ui) {
                                            //Set selection
                                            $(input_id).val(ui.item.item_code);
                                            return false;
                                        }
                                    }).data("ui-autocomplete")._renderItem = function(ul, item) {
                                        return $("<li></li>").data("item.autocomplete", item)
                                            .append(
                                                `
                                                <a class='form-control'>
                                                    <strong> ` + item.item_name + `</strong> - ` + item
                                                .item_code + `
                                                </a>
                                                `
                                            ).appendTo(ul);
                                    }
                                });
                            }

                        </script>

                    </table>


                    <button class="btn btn-secondary btn-sm">Link to Material Requests</button>

                </div>
                <div class="card-body">
                    <!-- <hr class="mt-2 mb-5">
                    <h6><strong>Message for Supplier</strong></h6> -->

                    <form>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email Template</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Message for Supplier</label>
                                <textarea id="notes" class="summernote" name="notes"></textarea>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>Terms and Conditions</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Terms</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Terms and Conditions</label>
                                <textarea id="notes" class="summernote" name="notes"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>PRINTING SETTINGS</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Print Heading</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Letter Head</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>MORE INFORMATION</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Status</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Fiscal Year</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <!-- <div class="btn-group" role="group">
                        <button type="button" class="btn btn-dark" href="#">20</button>
                        <button type="button" class="btn btn-secondary" href="#">100</button>
                        <button type="button" class="btn btn-secondary" href="#">500</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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

</script>
