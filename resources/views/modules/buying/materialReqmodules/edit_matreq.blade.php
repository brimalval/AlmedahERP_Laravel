
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Record</h5>
        
        
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <!-- This is where the form gets loaded-->
        <div id="modal-form">

        </div>
        <button type="button" class="btn btn-secondary" onclick="$('#editModal').modal('hide')">Close</button>
        <button type="button" onclick="$('#mat-req').submit()" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>