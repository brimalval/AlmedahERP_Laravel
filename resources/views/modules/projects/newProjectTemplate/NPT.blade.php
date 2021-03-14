<div class="container">
  <form id="contactForm" name="contact" role="form">
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label for="name">Name</label>

          <input type="text" name="name" class="form-control">
        </div>
      </div>

      <div class="col-6">

      </div>



      <div class="col-6">
        <div class="form-group">
          <label for="projectType">Project Type</label>

          <input type="text" name="projectType" class="form-control">
        </div>
      </div>
      <div class="col-6">

      </div>

      <br>

      <div class="col-12">
        <label>Tasks</label>
        <table class="table border-bottom table-hover table-bordered">
          <thead class="border-top border-bottom bg-light">
            <tr class="text-muted">
              <td>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input">
                </div>
              </td>
              <td>Subject</td>
              <td>Begin On (Days)</td>
              <td>Duration (Days)</td>
              <td>Description</td>
              <td></td>
            </tr>
          </thead>
          <tbody class="">
            <tr>
              <td>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input"> 1
                </div>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><a href="" data-bs-toggle="modal" data-bs-target="#addProduct">Edit</a></td>
            </tr>
            <tr>
              <td colspan="7" rowspan="5">
                <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>

              </td>

            </tr>
          </tbody>
        </table>
      </div>
  </form>
</div>

<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editing Row</h5>
        <button class="btn btn-outline-light btn-sm text-muted shadow-sm" style="position: absolute; right: 378;">Delete</button>
        <button class="btn btn-outline-light btn-sm text-muted shadow-sm" style="position: absolute; right: 270;">Insert Below</button>
        <button class="btn btn-outline-light btn-sm text-muted shadow-sm" style="position: absolute; right: 160;">Insert Above</button>
        <button class="btn btn-outline-light btn-sm text-muted shadow-sm" style="position: absolute; right: 70;">Duplicate</button>
        <button class="btn btn-outline-light btn-sm text-muted shadow-sm" style="position: absolute; right: 10;">Move</button>
      </div>
      <form action="">
        <div class="modal-body" style="height:480px" style="overflow-y:scroll" ;>


          <div class="col-6">
            <label for="salesrate">Subject</label>
            <input class="form-control" type="text" name="" id="salesrate">
          </div>
          <div class="col-6">

          </div><br>
          <div class="col-6">
            <label for="salesrate">Begin On (Days)</label>
            <input class="form-control" type="text" name="" id="salesrate">
          </div>
          <div class="col-6">

          </div><br>
          <div class="col-6">
            <label for="salesrate">Duration (Days)</label>
            <input class="form-control" type="text" name="" id="salesrate">
          </div>
          <div class="col-6">

          </div><br>
          <div class="col-6">
            <label for="salesrate">Task Weight</label>
            <input class="form-control" type="text" name="" id="salesrate">
          </div>
          <br>
          <div class="col-12">
            <label for="summernote">Description</label>
            <textarea id="summernote" name="editordata"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        <script src="{{  asset('js/inventory.js') }}"></script>
      </form>
    </div>
  </div>
</div>