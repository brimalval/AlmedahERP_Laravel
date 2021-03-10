<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <a href="javascript:onclick=loadWarehouse()" class="text-black mr-2 p-2" style="font-size: 2rem;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="navbar-brand" style="font-size: 35px;">All Warehouses</h2>
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
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadInv();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit">Save</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php include 'warehouseForm.php' ?>
<br>
<div class="card">
    <div class="card-header row">
        <h5 class="mt-2 col-10 text-muted h-100">
            Add Comment
        </h5>
        <div class="mb-0 col-2">
            <button class="btn btn-secondary btn-sm">Add Comment</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" style="border:0;"></textarea>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-left">
    <div class="col-md-12">
        <div id="content">
            <ul class="timeline">
                <li class="event">
                    <p>New Email</p>
                    <p></p>
                </li>
                <li class="event">
                    <p><span style="color: green;">+5</span> gained by You Via On Rule Item Creation - 9 months ago</p>
                    <p></p>
                </li>
                <li class="event">
                    <p>You Created - 9 Months ago</p>
                    <p></p>
                </li>
            </ul>
        </div>
    </div>
</div>