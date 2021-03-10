<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadManufacturingItemPrice();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Item Price Form</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 300px !important;" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">Email</a>
                        <a class="dropdown-item" href="#">Jump to field <span class="float-right small">Ctrl+J</span></a>
                        <a class="dropdown-item" href="#">Links</a>
                        <a class="dropdown-item" href="#">Duplicate</a>
                        <a class="dropdown-item" href="#">Rename</a>
                        <a class="dropdown-item" href="#">Reload</a>
                        <a class="dropdown-item" href="#">Delete <span class="float-right small">Shift+Ctrl+D</span></a>
                        <a class="dropdown-item" href="#">Customize</a>
                        <a class="dropdown-item" href="#">New Item Price <span class="float-right small">Ctrl+B</span></a>
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
            <form>
                <div class="card">
                    <!-- <div class="card-header">
                    <div class="float-right">
                        <button class="btn btn-secondary btn-sm" onclick="loadReportsBuilderShowReport();">Show Report</button>
                        <button class="btn btn-secondary btn-sm">Disable Report</button>
                    </div>
                </div> -->
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Item Code</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Item Name</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">UOM</label>
                                <select class="form-control"></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Brand</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Packing Unit</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                                <p class="small">Quantity that must be bought or sold per UOM</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Item Description</label>
                                <textarea class="form-control" rows="2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum saepe blanditiis inventore similique enim, explicabo debitis vel mollitia nisi itaque repellendus eveniet cumque porro culpa quibusdam, autem quam sunt! Nulla.</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <h6><strong>PRICE LIST</strong></h6>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Price List</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                                    <label class="custom-control-label" for="defaultUnchecked">Buying</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                                    <label class="custom-control-label" for="defaultUnchecked">Selling</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Supplier</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <!-- <h6><strong>CURRENCY</strong></h6> -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Currency</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Rate</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <!-- <h6><strong>CURRENCY</strong></h6> -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Valid From</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Valid Upto</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Lead Time in Days</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <!-- <h6><strong>CURRENCY</strong></h6> -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Note</label>
                                <textarea class="summernote" rows="20"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Reference</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr class="mt-5">

                        <form>
                            <div class="card">
                                <div class="card-header">
                                    <span class="float-left">Add a comment</span>
                                    <button class="btn btn-secondary btn-sm float-right">Comment</button>
                                </div>
                                <div class="card-body p-0">
                                    <textarea id="notes" class="summernote" name="notes"></textarea>
                                </div>
                            </div>
                        </form>

                        <div id="myTimeline">
                            <div data-vtdate="February 2020">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque reprehenderit magnam fuga iure. Rerum repudiandae blanditiis harum eius fuga voluptatibus illum qui, natus aliquam et. Porro sequi veritatis aspernatur culpa!
                            </div>
                            <div data-vtdate="March 2020">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia eius veniam nulla quia ipsam a itaque dolorum optio perferendis dolore corporis magnam eligendi facere repellat fugit, harum voluptatum voluptatibus autem?
                            </div>
                            <div data-vtdate="April 2020">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt, quis voluptatibus nulla odit voluptate omnis a ducimus impedit quasi modi sed esse! Eius repudiandae cumque pariatur saepe, nemo voluptatibus modi!
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- <div class="btn-group" role="group">
                        <button type="button" class="btn btn-dark" href="#">20</button>
                        <button type="button" class="btn btn-secondary" href="#">100</button>
                        <button type="button" class="btn btn-secondary" href="#">500</button>
                    </div> -->
                    </div>
                </div>
            </form>
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