<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;"> <a href='javascript:onclick=loadBOM();' class="fas fa-arrow-left back-button"><span></span></a> BOM Blueprint</h2>
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
            <li><a class="dropdown-item" href="javascript:onclick=loadBOM();">Go Back</a></li>
          </ul>
        </li>
        <li class="nav-item li-bom">
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit">Refresh</button>
        </li>
        <li class="nav-item li-bom">
          <button class="btn btn-primary" type="submit" onclick="subloadNewBOM()">New</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="row">
  <div class="mx-auto">
    <img src="images/blueprint.jpg" class="img-fluid my-3" alt="...">
  </div>
</div>
<div class="row mb-3">
  <label for="PART" class="col-sm-1 col-form-label">PART</label>
  <div class="col">
    <input type="text" class="form-control border border-dark" id="PART" value='BOM-PR-EM-ADJ CAP-002' readonly>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="Assigned">Assigned To:</label>
    <input type="text" class="form-control border border-dark" id="Assigned" value="JUAN DELA CRUZ" placeholder="" readonly>
  </div>
  <div class="form-group col-md-6">
    <label for="Customer">Customer:</label>
    <input type="text" class="form-control border border-dark" id="Customer" value="JUAN Resto" placeholder="" readonly>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="ETC">ETC</label>
    <input type="text" class="form-control border border-dark" id="ETC">
  </div>
  <div class="form-group col-md-3">
    <label for="START">START</label>
    <input type="date" class="form-control border border-dark" id="Start">
    </select>
  </div>
  <div class="form-group col-md-3">
    <label for="END">END</label>
    <input type="date" class="form-control border border-dark" id="END">
  </div>
</div>
<div class="row mb-3">
  <label for="USED" class="col-sm-1 col-form-label">USED IN:</label>
  <div class="col">
    <input type="text" class="form-control border border-dark" id="USED" value="THIS MACHINE" readonly>
  </div>
</div>