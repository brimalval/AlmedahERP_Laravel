<script src="{{ asset('js/address.js') }}"></script>
<script src="{{ asset('js/machinemanual.js') }}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">{{ $manual->machine_code }} - {{ $manual->machine_name }}
        </h2>
        <input type="text" value={{ $manual->id }} id="hiddenMMID" style="display: none;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="responsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                    </ul>
                </li>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadmachine();">Cancel</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-info btn" style="display: none;" onclick="" id="saveMMBtn">Save</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #ff0000d7;" class="btn btn-danger btn" style="float: left;"
                        onclick="" id="mmDelete">Delete</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form action="" id="mmForm" method="POST">
    @csrf
    @method('PATCH')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="Machine_Image">Machine Image</label>
                    <input type="file" name="Machine_Image" id="Machine_Image">
                </div>
            </div>
            <div class="col-6">
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="Machine_Code">Machine Code</label>
                    <input type="text" name="Machine_Code" id="Machine_Code" class="form-control mm"
                        value="{{ $manual->machine_code }}" readonly>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="Machine_name">Machine Name</label>
                    <input type="text" name="Machine_name" id="Machine_name" value="{{ $manual->machine_name }}"
                        class="form-control mm">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="Machine_Process">Machine Process</label>
                    <input type="text" name="Machine_Process" id="Machine_Process"
                        value="{{ $manual->machine_process }}" class="form-control mm">
                </div>
            </div>
            <div class="col-6">
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="Setup_time">Setup Time</label>
                    <input type="text" name="Setup_time" id="Setup_time" value="{{ $manual->setup_time }}"
                        class="form-control mm">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="Running_time">Running Time</label>
                    <input type="text" name="Running_time" id="Running_time" value="{{ $manual->running_time }}"
                        class="form-control mm">
                </div>
            </div>
            <div class="col-6">
            </div>
            <div class="form-group col-md-12">
                <label for="Machine_Description">Machine Description</label>
                <textarea id="Machine_Description" class="summernote mm"
                    name="Machine_Description">{{ $manual->machine_description }}</textarea>
            </div>
        </div>
    </div>
</form>

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
