<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Machine Manual</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
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
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadmachine();">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button style="background-color: #007bff;" class="btn btn-info btn" onclick="loadNewMachineManual();"
                        style="float: left;">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="container">

    <hr>
    <br>
    <table id="table_machine" class="display">
        <thead>
            <tr>
                <th>Machine Code</th>
                <th>Machine Name</th> 
                <th>Setup Time</th>
                <th>Running Time</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($machines_manuals as $machines_manual) 
            <tr>
                <td><a href="javascript:onclick=loadmachineinfo({{ $machines_manual->id }});">{{ $machines_manual->machine_code }}</a></td>
                <td>{{ $machines_manual->machine_name }}</td>
                <td>{{ $machines_manual->setup_time }}</td>
                <td>{{ $machines_manual->running_time }}</td>
            </tr>
            @endforeach
            <!--
            <tr>
                <td><a href="javascript:onclick=loadmachineinfo();">Row 1 Data 1</a></td>
                <td>INSERT NAME</td>
                <td></td>
                <td></td>
            </tr>
            --->
        </tbody>
    </table>
</div>

</div>

<style>
    .conContent {
        padding: 200px;
    }

</style>

<script>
    $(document).ready(function() {
        $('#table_machine').DataTable();
    });

</script>
