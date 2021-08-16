<script src="{{ asset('js/suppliergroup.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadSupplierGroup();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">New Supplier Group</h2>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" id="sgSubmit" type="button">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="card">
    <br>
    <div class="container">
        <form id="newSGForm" action="{{ route('suppliergroup.store') }}" method="POST" name="newSGForm" role="form">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="sgSuppField">Supplier ID</label>
                        <select name="sgSuppField" id="sgSuppField" class="form-control sg-select" data-live-search="true">
                            <option value="non">Select a Supplier...</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->supplier_id }}" data-subtext="{{ $supplier->company_name }}">
                                    {{ $supplier->supplier_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sgNameField">Supplier Name</label>
                        <input type="text" name="sgNameField" id="sgNameField" class="form-control" readonly>
                    </div>
                </div>
                
                <div class="col-12">
                    <br>
                    <hr><br>
                </div>
                <br>
            </div>

            <!---Credit Limit-->
            <label>Raw Materials</label>
            <!-- <div class="table table-striped table-bordered hover"> -->
            <table class="table table-bordered hover" id="sgRawMatTbl">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"><input type="checkbox" id="sgMasterChk" name=""></th>
                        <th scope="col" class="w-30">Item Code</th>
                        <th scope="col">Item Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="sgItem1" class="">
                        <th scope="row"><input class="sg-check" type="checkbox"> 1</th>
                        <td class="sg_item_select">
                            <select name="sgRawMat1" id="sgRawMat1" class="form-control sg-select sg-rm-select" onchange="sgItemSearch(1)" data-live-search="true">
                                <option value="non">Select Raw Material...</option>
                            @foreach ($materials as $mat)
                                <option value="{{ $mat->item_code }}" data-subtext="{{ $mat->item_name }}">{{ $mat->item_code }}</option>
                            @endforeach
                            </select>
                        </td>
                        <td id="sgName1"></td>
                    </tr>
                </tbody>
            </table>
            <!-- </div>	 -->
            <!----End of Credit Limit-->
        </form>
        <div class="float-left" style="display: inline-block;">
            <button class="btn btn-secondary btn-sm" id="sgAddRow">Add Row</button>
            <button class="btn btn-danger btn-sm" style="display: none;" type="button" id="sgDeleteRow">Delete Row</button>
        </div>
        <br>
    </div>
</div>
