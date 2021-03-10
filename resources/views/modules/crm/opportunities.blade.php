<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row mt-2">
        <div class="col-12 mb-3">
            <div class="btn-toolbar w-100" role="toolbar" aria-label="Toolbar with button groups">
                <div class="w-50">
                    <div class="btn-group btn-group-sm mr-2 float-left" role="group" aria-label="Left Group">
                        <button type="button" id="btn-crm-opportunities-add" class="btn btn-outline-primary">
                            <span class="fa fa-plus"></span>
                        </button>
                        <button type="button" id="btn-crm-opportunities-refresh" class="btn btn-outline-success">
                            <span class="fa fa-sync"></span>
                        </button>
                    </div>

                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="crm-opportunities-filter-input" aria-label="Search table">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="btn-crm-opportunities-filter">
                                <span class="fa fa-search fa-fw"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-50">
                    <div class="btn-group float-right" role="group" aria-label="Right Group">
                        <button type="button" id="btn-crm-opportunities-display-list" class="btn btn-outline-secondary" title="Display Table List">
                            <span class="fa fa-th-list fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-opportunities-display-thumbs" class="btn btn-outline-secondary" title="Display Thumbs List">
                            <span class="fa fa-th fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-opportunities-export-file" class="btn btn-outline-secondary">
                            <span class="fa fa-file-alt fa-fw"></span>
                        </button>
                        <button type="button" id="btn-crm-opportunities-settings" class="btn btn-outline-secondary">
                            <span class="fa fa-wrench fa-fw"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal-crm-opportunities-form">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">opportunities Form</h5>
                <button type="button" class="close-modal-crm-opportunities-form" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="crmopportunitiesFirstName" class="col-sm-3 col-form-label">Field 1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="crmopportunitiesFirstName" placeholder="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary close-modal-crm-opportunities-form">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var modalCrmopportunitiesForm = $("#modal-crm-opportunities-form");

        $(document).on('click', '#btn-crm-opportunities-add', function(e) {
            e.preventDefault();
            modalCrmopportunitiesForm.modal('show');
        });

        $(document).on('click', '.close-modal-crm-opportunities-form', function() {
            modalCrmopportunitiesForm.modal('hide');
        });

        // custom datatables commands
        $(document).on('keyup', '#crm-opportunities-filter-input', function() {
            oTable.search($(this).val()).draw();
        });
        $(document).on('click', '#btn-crm-opportunities-pagination-previous', function() {
            oTable.page('previous').draw('page');
        });
        $(document).on('click', '#btn-crm-opportunities-pagination-next', function() {
            oTable.page('next').draw('page');
        });

        $(document).on('click', "#btn-crm-opportunities-display-list", function(e) {
            e.preventDefault();
        });
        $(document).on('click', "#btn-crm-opportunities-display-thumbs", function(e) {
            e.preventDefault();
        });
    });
</script>