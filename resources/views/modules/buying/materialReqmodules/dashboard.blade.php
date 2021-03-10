<div class="container">
  <form id="contactForm" name="contact" role="form">
    <div class="row">
      <div class="col-6">
        <div class="input-group">
          <label class="label">Series</label>
          <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
          </select>
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="compnay">Required Date</label>

          <input type="text" name="company" class="form-control">
        </div>
      </div>

      <div class="col-6">
        <div class="input-group">
          <label class="label">Type</label>
          <select class="input--style-4" type="text" name="project" style="width:512px;height:38px;">
            <option>Purchase</option>
            <option>Option 2</option>
            <option>Option 3</option>
          </select>
        </div>
      </div>

      <div class="col-12">
        <hr>
      </div>
      <br>
      <label>Item</label>
      <table class="table border-bottom table-hover table-bordered">
        <thead class="border-top border-bottom bg-light">
          <tr class="text-muted">
            <td>
              <div class="form-check">
                <input type="checkbox" class="form-check-input">
              </div>
            </td>

            <td>Item Code</td>
            <td>Quantity</td>
            <td>UOM ID</td>
            <td>Purpose</td>

          </tr>
        </thead>
        <tbody class="">
          <tr>
            <td colspan="7" style="text-align: center;">
              NO DATA
            </td>
          </tr>
          <tr>
            <td colspan="7" rowspan="5">
              <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
              <button class="btn btn-sm btn-sm btn-secondary">Add Multiple</button>
            </td>

          </tr>
        </tbody>
      </table>
  </form>

</div>