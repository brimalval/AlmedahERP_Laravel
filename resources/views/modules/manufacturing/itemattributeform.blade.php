<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadManufacturingItemAttribute();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Item Attribute Form</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 300px !important;" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Jump to field <span class="float-right small">Ctrl+J</span></a>
                        <a class="dropdown-item" href="#">Links</a>
                        <a class="dropdown-item" href="#">Duplicate</a>
                        <a class="dropdown-item" href="#">Rename</a>
                        <a class="dropdown-item" href="#">Reload</a>
                        <a class="dropdown-item" href="#">Delete <span class="float-right small">Shift+Ctrl+D</span></a>
                        <a class="dropdown-item" href="#">Customize</a>
                        <a class="dropdown-item" href="#">New Item Attribute <span class="float-right small">Ctrl+B</span></a>
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
                <!-- <div class="card-header">
                    <div class="float-right">
                        <button class="btn btn-secondary btn-sm" onclick="loadReportsBuilderShowReport();">Show Report</button>
                        <button class="btn btn-secondary btn-sm">Disable Report</button>
                    </div>
                </div> -->
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Attribute Name</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                                    <label class="custom-control-label" for="defaultUnchecked">Numeric Values</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr>
                    <h6><strong>Item Attribute Values</strong></h6>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">Attribute Name</th>
                                <th scope="col">Attribute Value</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 1; $i++) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <select class="form-control">
                                        </select>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7 p-5">
                                    <button class="btn btn-secondary btn-sm">Add Row</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
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