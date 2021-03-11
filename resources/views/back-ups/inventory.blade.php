<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Inventory</h2>
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
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card my-2">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Item">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <select name="category" class="form-control">
                            <option class="form-control" selected disabled value="">Category</option>
                            <option class="form-control" value="cat1">Category 1</option>
                            <option class="form-control" value="cat2">Category 2</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body filter">
            <div class="row">
                <div class="float-left">
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        Add Filter
                    </button>
                </div>
                <div class=" ml-auto float-right">
                    <span class="text-muted ">Last Modified On</span>
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                </div>
            </div>
        </div>
        <table class="table table-bom border-bottom">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Item Code</td>
                    <td>Item Name</td>
                    <td>View Image</td>
                    <td>Category</td>
                    <td>Unit Price (PHP)</td>
                    <td>Total Amount</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody class="">
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a href='javascript:onclick=openInventoryInfo();'>BOM-PR-EM-ADJ CAP-002</a></td>
                    <td>Emulsifier Adjusting Cap</td>
                    <td class="text-black-50"><a href='#' data-toggle="modal" data-target="#exampleImage">View</a></td>
                    <td class="text-black-50">Component</td>
                    <td class="text-black-50">100</td>
                    <td class="text-black-50">2</td>
                    <td class="text-black-50">Enabled</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a href='javascript:onclick=openInventoryInfo();'>BOM-PR-EM-ADJ CAP-001</a></td>
                    <td>Emulsifier Adjusting Cap</td>
                    <td class="text-black-50"><a href='#'>View</a></td>
                    <td class="text-black-50">Component</td>
                    <td class="text-black-50">75</td>
                    <td class="text-black-50">5</td>
                    <td class="text-black-50">Enabled</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a href='javascript:onclick=openInventoryInfo();'>BS 3/4</a></td>
                    <td>Bar Shaft</td>
                    <td class="text-black-50"><a href='#'>View</a></td>
                    <td class="text-black-50">Raw Material</td>
                    <td class="text-black-50">100</td>
                    <td class="text-black-50">23</td>
                    <td class="text-black-50">Enabled</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td><a href='javascript:onclick=openInventoryInfo();'>Emulsifier</a></td>
                    <td>Emulsifier</td>
                    <td class="text-black-50"><a href='#'>View</a></td>
                    <td class="text-black-50">Product</td>
                    <td class="text-black-50">10,000</td>
                    <td class="text-black-50">2</td>
                    <td class="text-black-50">Enabled</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-left"></span></button>
        </div>
        <div class="col-1 text-center">
            <p>2 of 2</p>
        </div>
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>

<!-- IMAGE PART MODAL -->
<div class="modal fade" id="exampleImage" tabindex="-1" role="dialog" aria-labelledby="exampleImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-0 p-0">
                <img src="images/sample.png" style="width:100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>