<script src="{{ asset('js/address.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2 class="navbar-brand" style="font-size: 35px;">New Operations</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="responsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown li-bom">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Option 1</a></li>
            <li><a class="dropdown-item" href="#">Option 2</a></li>
          </ul>
        </li>
        </li>
        <li class="nav-item li-bom">
          <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="operationtable();">Cancel</button>
        </li>
        <li class="nav-item li-bom">
          <button style="background-color: #007bff;" class="btn btn-info btn" style="float: left;" onclick="">Save</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<form action="#" method="post" id="BOM" class="create">
<br>
<div class="container">
          {{-- <form id="contactForm" name="contact" role="form">
            @csrf --}}
            <div class="row">
            
        

             
                
                <div class="col-6">
                  <div class="form-group">
                    <label for="operation_name">Operation Name</label>
                    <input type="text" name="operation_name" id="operation_name" class="form-control">
                  </div>
                </div> 
                <div class="col-6">
                  <div class="form-group">
                    <label for="Default_workcenter">Default WorkCenter</label>
                    <input type="text" name="Default_workcenter" id="Default_workcenter" class="form-control">
                  </div>
                </div> 
                <div class="col-6">

                </div> 
                <div class="form-group col-md-12">
                                <label for="operation_Description">Description</label>
                                <textarea id="operation_Description" class="summernote" name="operation_Description"></textarea>
                </div>
  

            </div>
      

              
          {{-- </form> --}}

        </div>
        <br>
@csrf



<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200
        });
        $('#myTimeline').verticalTimeline({
            startLeft: false,
            alternate: false,
            arrows: false
        });
    });

</script>