<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadSupplierGroup();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">New Supplier Group</h2>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                     
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="card">
<br>
<div class="container">
    <form id="newsuppliergroupForm" name="newsuppliergroupForm" role="form">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="suppliergrpName">Supplier Group Name</label>
                    <input type="text" name="suppliergrpName" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <!---Empty Column-->
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="parentSuppGrp">Parent Supplier Group</label>
                    <input type="text" name="parentSuppGrp" class="form-control">
                </div>
                <input type="checkbox"> Is Group
            </div>

            <div class="col-12">
                <br><hr><br>
            </div>
            <br>
        </div>

        <!---Credit Limit-->
        <a href="#submenuCreditLimit" data-toggle="collapse" aria-expanded="false" class="bg-white list-group-item list-group-item-action">

            <span class="menu-collapsed align-middle smaller menu"> CREDIT LIMIT</span>
            <i class="fa fa-caret-down" aria-hidden="true"></i>

        </a>

        <div id='submenuCreditLimit' class="collapse sidebar-submenu">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="defPayTemp">Default Payment Terms Template</label>
                        <input type="text" id="defPayTemp" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <!----End of Credit Limit-->
        <br>
    </form>
</div>
</div>
<script src="{{ asset('js/suppliergroup.js') }}"></script>