<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Job Scheduling</h2>
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
        <li class="nav-item li-bom">
            <button style="background-color: #007bff;" class="btn btn-info btn" onclick="loadIntoPage(this, '{{ route('jobscheduling.create') }}');" style="float: left;">New</button>
        </li>
    </div>
</nav>
<div class="container">
    <div class="card my-2">
        {{-- <div class="card-header bg-light">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Component Code">
                    </div>
                </div>
            </div>
        </div> --}}
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
        <table class="table table-bom border-bottom" id="jobScheduleTable">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Job Schedule Code</td>
                    <td>Product/Component Code</td>
                    <td>Quantity</td>
                    <td>Start Date & Time</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody class="">
                <!-- Iterating through list of job schedules --> 
                @foreach ($jobscheds as $jobsched)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td><a href='#' onclick="loadIntoPage(this, '{{ route('jobscheduling.edit', ['jobscheduling'=>$jobsched->id]) }}');">{{ $jobsched->jobs_sched_id }}</a></td>
                        <td class="text-black-50">
                            {{ $jobsched->work_order->item->product_name ?? $jobsched->work_order->component_name }} ({{ $jobsched->work_order->item->product_code ?? $jobsched->work_order->item->component_code }})
                        </td>
                        <td class="text-black-50">{{ $jobsched->work_order->sales_order->orderedProducts($jobsched->work_order->product_code)->quantity_purchased ?? "N/A"}}</td>
                        <td class="text-black-50">{{ $jobsched->start_date }} {{ $jobsched->start_time }}</td>
                        <td class="text-black-50">{{ $jobsched->js_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-left"></span></button>
        </div>
        <div class="col-1 text-center">
            <p>1 of 2</p>
        </div>
        <div class="col-1 text-center">
            <button type="submit" class=""> <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>

<script>
    $('#jobScheduleTable').DataTable( {
    responsive: true
} );
</script>