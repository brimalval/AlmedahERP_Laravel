<div class="px-3 mt-3 rounded">
    <div class="row d-flex justify-content-center">
        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">Customer List</h4>
            <div class="alert alert-success alert-dismissible" id="customer-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
            <div class="alert alert-danger alert-dismissible" id="customer-danger" style="display:none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button type="button" class="btn btn-outline-primary btn-sm" onclick='$("#create-customer-modal").modal("toggle");'><i class="fas fa-plus" aria-hidden="true"></i> Add New</button></p>
                </div>
            </div>
            <div class="customerdata">
                <table id="customerTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <td>Customer ID</td>
                            <td>Last Name</td>
                            <td>First Name</td>
                            <td>Branch</td>
                            <td>Contact Number</td>
                            <td>Address</td>
                            <td>Image</td>
                            <td>Email</td>
                            <td>Company Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $row)
                            <tr id="<?=$row["id"]?>">
                                <td class="text-black-50"><?=$row["id"]?></td>
                                <td class="text-black-50"><?=$row["customer_fname"]?></td>
                                <td class="text-black-50"><?=$row["customer_lname"]?></td>
                                <td class="text-black-50"><?=$row["branch_name"]?></td>
                                <td class="text-black-50"><?=$row["contact_number"]?></td>
                                <td class="text-black-50"><?=$row["address"]?></td>
                                <td><img src="<?=$row['profile_picture']?>" class="customer-modal-image" height="30" onError="this.onerror=null;this.src='images/defaultuser.png';"></td>
                                <td class="text-black-50"><?=$row["email_address"]?></td>
                                <td class="text-black-50"><?=$row["company_name"]?></td>
                                <td class="">
                                    <a href="#" class="btn btn-success btn-sm rounded-0 editBtn" type="button"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- IMAGE PART MODAL -->
<div class="modal fade" id="customer-image-modal" tabindex="-1" role="dialog" aria-labelledby="exampleImageLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body m-0 p-0">
                <img id="customer-image-view" style="width:100%;">
            </div>
        </div>
    </div>
</div>

<!-- Update Customer Modal -->
<div class="modal fade" id="update-customer-modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update Customer</h5>
                <button type="button" class="close" onclick="$('#update-customer-modal').modal('toggle');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-customer-form">
                    @csrf
                    @method('PUT')
                    <input hidden id="id">
                    <div class="mb-3">
                        <label for="customer_lname_up" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name='customer_lname' id="customer_lname_up" placeholder="Last Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_fname_up" class="form-label">First Name</label>
                        <input type="text" class="form-control" name='customer_fname' id="customer_fname_up" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="branch_name_up" class="form-label">Branch Name</label>
                        <input type="text" class="form-control" id="branch_name_up" name='branch_name' required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number_up" class="form-label">Contact number</label>
                        <input type="tel" class="form-control" minlength="11" maxlength="15" id="contact_number_up" name='contact_number' placeholder="#### - ### - ####" required>
                    </div>
                    <div class="mb-3">
                        <label for="address_up" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address_up" name='address' required>
                    </div>
                    <div class="mb-3">
                        <label for="company_name_up" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name_up" name='company_name' required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="update-customer-form-btn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ADD CUSTOMER MODAL --}}
<div class="modal fade" id="create-customer-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close" onclick="$('#create-customer-modal').modal('toggle');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-customer-form" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name='customer_lname' id="customer_lname" placeholder="Last Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" name='customer_fname' id="customer_fname" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="branch_name" class="form-label">Branch Name</label>
                        <input type="text" class="form-control" id="branch_name" name='branch_name' required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact number</label>
                        <input type="tel" class="form-control" minlength="11" maxlength="15" id="contact_number" name='contact_number' placeholder="#### - ### - ####" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name='address' required>
                    </div>
                    <input type="hidden" name='profile_picture' id="profile_picture" value="default">
                    <div class="mb-3">
                        <label for="email_address" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email_address" name='email_address' required>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name='company_name' required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="create-customer-form-btn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#create-customer-modal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#update-customer-modal').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>
<script>
    $(document).ready(function() {
        $('#customerTable').dataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc']
            ]
        });
    });
    var url = "js/man-customer.js";
    $.getScript(url);
</script>