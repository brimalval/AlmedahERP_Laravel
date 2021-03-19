<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <h2 class="navbar-brand" style="font-size: 35px;">Delivery of Sales ID#</h2>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <button class="btn" style="background-color: #d9dbdb;" onclick="loadDelivery();">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<form id="contactForm" name="contact" role="form" action="AddEmployee.php">
    <div class="modal-body">
        <div class="row">
            <div class="col-6">

                <div class="form-group">
                    <label for="fname">Sales ID</label>
                    <input type="text" class="form-control" placeholder="Sales ID#">
                </div>

            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="fname">Delivery ID</label>
                    <input type="text" class="form-control" value="DLV1111">
                </div>

            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="compnay">Assign To</label>
                    <input type="text" class="form-control" value="Employee ID">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="fname">Status</label>
                    <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect04">
                            <option selected disabled>Choose...</option>
                            <option value="1">To Ship</option>
                            <option value="2">Shipped</option>
                            <option value="3">Delivered</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Proceed</button>
                        </div>
                    </div>
                </div><br>
            </div>
            <div class="col-6">
                <!--empty-->
            </div>
            <div class="col-12">
                <hr><br>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class=" text-nowrap align-middle">
                        Customer ID
                    </label>
                    <div class="d-flex">
                        <input type="number" class="form-input form-control" max="6" value="0000001" disabled
                            id="custId" required>
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="ComponentC">Delivery Address</label>
                    <input type="Text" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="TaskId">Contact No</label>
                    <input type="number" name="TaskId" class="form-control" value="09123456789">
                </div>
            </div>
            <div class="col-12">
                <hr><br>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="PartC">Date Delivered</label>
                    <input type="date" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="ComponentC">Date Received</label>
                    <input type="date" class="form-control">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="setupN">Sales Agreement File</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02">
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="startT">Vehicle Plate No.</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-12">
                <hr><br>
            </div>
</form>
