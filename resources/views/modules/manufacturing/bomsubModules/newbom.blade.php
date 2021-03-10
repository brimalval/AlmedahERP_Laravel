<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
  <div class="container-fluid">
  <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadBOM();' class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">New BOM "Number"</h2>
    </h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown li-bom">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Edit</a></li>
            <li><a class="dropdown-item" href="#">Delete</a></li>
          </ul>
        </li>
        <li class="nav-item li-bom">
              <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadBOM();">Cancel</button>
          </li>
        <li class="nav-item li-bom">
            <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <br><br>
  <div class="container">
    <br><br>
    <form method="POST">
      <div class="row row-space">
        <div class="col-6">
        </div>
        <div class="col-6">
          <!--EMPTY COLUMN -->
        </div>
        <div class="col-6">
          <div class="input-group">
            <label class="label">Item</label>
            <input class="input--style-4" type="text" name="item">
          </div>
        </div>
        <div class="col-6">
          <div class="input-group">
            <label class="label">Item Name</label>
            <input class="input--style-4" type="text" name="item_name">
          </div>
        </div>
        <div class="col-6">
          <div class="input-group">
            <label class="label">Item UOM</label>
            <input class="input--style-4" type="text" name="item_uom">
          </div>
        </div>
        <div class="col-3">
          <div class="input-group">
            <label class="label">Quantity</label>
            <input class="input--style-4" type="number" min="1" name="Quantity">
          </div>
        </div>
        <div class="col-3">
          <div class="input-group">
            <label class="label">Project</label>
            <input class="input--style-4" type="text" name="project">
          </div>
        </div>
        <div class="col-3">
          <div class="input-group">
            <label class="label">Currency</label>
            <input class="input--style-4" type="text" name="currency">
          </div>
        </div>
        <div class="col-3">
          <div class="input-group">
            <label class="label">Rate of Materials based on</label>
            <select class="input--style-4" type="text" name="project" style="width:500px;height:50px;">
              <option>Option 1</option>
              <option>Option 2</option>
              <option>Option 3</option>
            </select>
          </div>
        </div>
        <div class="col-4">
          <table>
            <tr>
              <td><input type="checkbox" id="active" name="active" value="active"></td>
              <td>
                <p>Active</p>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" id="default" name="default" value="default"></td>
              <td>
                <p>Default</p>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" id="alt_item" name="alt_item" value="alt_item"></td>
              <td>
                <p>Allow Alternative Item</p>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" id="sub_item" name="sub_item" value="sub_item"></td>
              <td>
                <p>Sub-Assembly Item</p>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <hr><br>
      <?php include 'newbomtable.php';?>
      <br>
      <hr><br>
      <h4>OPERATIONS</h4>
      <div class="col-6">
        <div class="input-group">
          <table>
            <tr>
              <td><input type="checkbox" name="check2" id="operations2" onclick="operations();" /></td>
              <td>
                <p>With Operations</p>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-6">
        <div class="input-group" id="operations" style="display:none">
          <label class="label">Transfer Material Against</label>
          <select class="input--style-4" type="text" name="project" style="width:570px;height:50px;">
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
          </select>
          <br>
          <br>
          <label class="label">Routing</label>
          <input class="input--style-4" type="text" name="Unit">
        </div>
      </div>
      <hr><br>
      <h4>MATERIALS</h4>
      <div class="col-6">
        <div class="input-group">
          <table>
            <tr>
              <td><input type="checkbox" name="check2" id="qualInspect" onclick="qual();" /></td>
              <td>
                <p>Quality Inspection Required</p>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-6">
        <div class="input-group" id="qual2" style="display:none">
          <label class="label">Quality Inspection Template</label>
          <input class="input--style-4" type="text" name="Unit">
        </div>
      </div>
      <h5>ITEMS</h5><br>
      <style>
        /* Component's Table */
        table {
          border-collapse: collapse;
          width: 100%;
        }
        #itemtable,
        #itemtr {
          border: 1px solid black;
        }
        th,
        td {
          text-align: left;
          padding: 8px;
        }
      </style>
      <table id="itemtable">
        <tr id="itemtr">
          <th><input type="checkbox" name="check2" /></th>
          <th>Item Code</th>
          <th>Quantity</th>
          <th>UOM</th>
          <th>Rate</th>
          <th>Amount</th>
          <th></th>
        </tr>
        <tr id="itemtr">
          <td><input type="checkbox" name="check2" /></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><select type="text" name="project">
              <option></option>
              <option></option>
              <option></option>
            </select></td>
        </tr>
      </table>
      <br>
      <button class="btn" style="background-color:#d3d3d3">Add Multiple</button>
      <button class="btn" style="background-color:#d3d3d3">Add Row</button>
      <hr>
      <br>
      <h5>SCRAP</h5>
      <br>
      <table id="itemtable">
        <tr id="itemtr">
          <th><input type="checkbox" name="check2" /></th>
          <th>Item Code</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Rate</th>
          <th></th>
        </tr>
        <tr id="itemtr">
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
      <br>
      <button class="btn" style="background-color:#d3d3d3">Add Row</button>
      <hr><br>
      <h5>WEBSITES</h5>
      <br>
      <div class="col-6">
        <div class="input-group">
          <table>
            <tr>
              <td><input type="checkbox" name="check2" id="website" onclick="showWeb();" /></td>
              <td>
                <p>Show in Website</p>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-6">
        <div class="input-group" id="attach" style="display:none">
          <label class="label">Image</label>
          <input class="input--style-4" type="file">
        </div>
      </div>
      <br>
      <label>Route</label><br>
      <input class="input--style-4" type="text" id="route" style="width:570px;height:150px;">
      <input class=""
    </form>
    <br><br>
  </div>
</div>

<!-- Main JS-->
<script src="js/global.js"></script>
<script src="js/bomtab.js"></script>
<script src="vendor/select2/select2.min.js"></script>

<style>
  /* Component's Table */
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th,
  td {
    text-align: left;
    padding: 8px;
  }
</style>
<script type="text/javascript">
  function qual() {
    // Get the checkbox
    var checkBox = document.getElementById("qualInspect");
    // Get the output text
    var text = document.getElementById("qual2");
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }
  function operations() {
    // Get the checkbox
    var checkBox = document.getElementById("operations2");
    // Get the output text
    var text = document.getElementById("operations");
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }
  function showWeb() {
    // Get the checkbox
    var checkBox = document.getElementById("website");
    // Get the output text
    var text = document.getElementById("attach");
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }
</script>

<!-- end document-->