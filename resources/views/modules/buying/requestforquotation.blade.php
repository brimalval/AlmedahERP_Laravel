<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand" style="font-size: 35px;">Request for Quotation</h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Import</a>
                        <a class="dropdown-item" href="#">User Permissions</a>
                        <a class="dropdown-item" href="#">Role Permissions Manager</a>
                        <a class="dropdown-item" href="#">Customize</a>
                        <a class="dropdown-item" href="#">Toggle Sidebar</a>
                        <a class="dropdown-item" href="#">Share URL</a>
                        <a class="dropdown-item" href="#">Settings</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1">Refresh</button>
                <button type="button" class="btn btn-info ml-1"
                    onclick="openBuyingRequestForQuotationForm()">New</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row mt-2 mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <form>
                        <div class="form-row">
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Ref DocType">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body filter align-middle">
                    <div class="float-left d-flex justify-content-start">
                        <button class="btn btn-secondary btn-sm ml-1">Add Filter</button>
                    </div>

                    <div class="float-right">
                        <span class="text-muted">Last Modified</span>
                        <button class="btn btn-secondary btn-sm">
                            <span class="fa fa-arrow-down fa-fw"></span>
                        </button>
                    </div>
                </div>
                <div class="card-body table-display">
                    <table class="table table-hover h-100">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <span class="fa fa-heart fa-fw"></span>
                                </th>
                                <th scope="col" style="width: 30%;">Title</th>
                                <th scope="col" style="width: 20%;">Status</th>
                                <th scope="col" style="width: 50%;" colspan="4">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotations as $quotation)
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="fa fa-heart fa-fw" style="vertical-align: middle;">
                                    </td>
                                    <td>
                                        <a href="#" onclick="javascript:viewBuyingRequestForQuotationForm();">{{ $quotation->request_id }}</a>
                                    </td>
                                    <td>
                                        <span>
                                            <span class="fa fa-circle"></span>
                                            {{ $quotation->req_status }}
                                        </span>
                                    </td>
                                    <td class="text-center" style="width: 40%;">
                                        <span>{{ $quotation->request_id }}</span>
                                    </td>
                                    <td class="text-right" style="width: 5%;">
                                        <span>1 M</span>
                                    </td>
                                    <td class="text-center" style="width: 0%;">
                                        <span class="fa fa-square-o fa-2x"></span>
                                    </td>
                                    <td class="text-center" style="width: 5%;">
                                        <span>
                                            <span class="fa fa-comments fa-fw"></span>
                                            <span>0</span>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            
                            <!---
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="fa fa-heart fa-fw" style="vertical-align: middle;">
                                    </td>
                                    <td>
                                        <a href="#" onclick="javascript:viewBuyingRequestForQuotationForm();"><?= 'Hi-top' ?></a>
                                    </td>
                                    <td>
                                        <span>
                                            <span class="fa fa-circle"></span>
                                            Submitted
                                        </span>
                                    </td>
                                    <td class="text-center" style="width: 40%;">
                                        <span></span>
                                    </td>
                                    <td class="text-right" style="width: 5%;">
                                        <span></span>
                                    </td>
                                    <td class="text-center" style="width: 0%;">
                                        <span class="fa fa-square-o fa-2x"></span>
                                    </td>
                                    <td class="text-center" style="width: 5%;">
                                        <span>
                                            <span class="fa fa-comments fa-fw"></span>
                                            <span>0</span>
                                        </span>
                                    </td>
                                </tr>
                            --->
                            <!-- <tr>
                                <td colspan="8">
                                    <div class="text-center" style="padding-top: 100px; padding-bottom: 100px;">
                                        <h4>No Request for Quotation Found</h4><br>
                                        <button class="btn btn-primary" onclick="openBuyingRequestForQuotationForm()">Create a new Request for Quotation</button>
                                    </div>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-dark" href="#">20</button>
                        <button type="button" class="btn btn-secondary" href="#">100</button>
                        <button type="button" class="btn btn-secondary" href="#">500</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
