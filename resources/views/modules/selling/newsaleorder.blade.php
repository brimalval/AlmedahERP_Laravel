<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">New Sale</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto d-flex align-items-center">
                <li>
                    <span id="notif" class="mr-auto text-danger">There are Missing inputs!</span>
                </li>
                <li class="nav-item li-bom">
                    <button type="button" class="btn btn-primary m-1" data-target="#newSalePrompt" id="saveSaleOrder">
                        <a class="" href="#" style="text-decoration: none;color:white">
                            Save
                        </a>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php include 'saleorderForm.php' ?>