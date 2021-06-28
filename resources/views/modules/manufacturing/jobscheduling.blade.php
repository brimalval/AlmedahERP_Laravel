<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Job Scheduling</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom m-auto">
                    <a href="javascript:void(0)" onclick="loadJobschedhome()" class="btn btn-primary text-white m-1"
                        type="button">Refresh</a>
                </li>
                <li class="nav-item li-bom m-auto">
                    <button style="background-color: #007bff;" class="btn btn-info btn m-1"
                        onclick="loadIntoPage(this, '{{ route('jobscheduling.create') }}');"
                        style="float: left;">New</button>
                </li>
                <!-- <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Edit</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
        <table class="table table-bom border-bottom w-100" id="jobScheduleTable">
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
                    <td></td>
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
                        <td class="text-black-50">
                            @if ($jobsched->js_status == "Draft")
                                <form class="delete-js-form" action="{{ route('jobscheduling.destroy', ['jobscheduling'=>$jobsched->id]) }}" data-js="{{ $jobsched->jobs_sched_id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (!empty($finished_jobscheds))
            <div id="gantt_here" style='width:1000px; height:680px;'></div>
            @foreach ($finished_jobscheds as $finished_jobsched)
                <script>
                    gantt.load('{{ route('jobscheduling.gantt_ops', ['jobsched' => $finished_jobsched->id]) }}');
                </script>
            @endforeach
        @endif
    <!-- <div id="gantt" style="height: 40em"></div> -->
<script type="text/javascript">
    $('#jobScheduleTable').DataTable( {
        responsive: true
    });
    function planJobSched() {
        // Temporary condition to check if the current job has been planned, to hide or display the start and pause buttons
        if (!$("#SPBtn").is(':visible')) {
            $("#SPBtn").css("display", "inline");
            $("#startBtn").css("display", "inline");
            $("#SPBtn").css("display", "inline");
            $("#finBtn").css("display", "inline");
            $("#planBtn").css("display", "none");
        } else {
            $("#SPBtn").css("display", "none");
            $("#startBtn").css("display", "none");
            $("#SPBtn").css("display", "none");
            $("#finBtn").css("display", "none");
        }
    }
    $(document).ready(function() {
        $("#SPBtn").css("display", "none");
        $("#startBtn").css("display", "none");
        $("#SPBtn").css("display", "none");
        $("#finBtn").css("display", "none");
        $('#operationsTable').DataTable({
            responsive: true,
            deferRender: true,
            scrollX: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true,
            searching: false,
            paging: false,
            info: false,
            columnDefs: [{
                orderable: false,
                targets: [6, 13, 14, 15]
            }]
        });
    });
    function newTask() {
        gantt.createTask(); // It's buggy since it does not parse any data.
        // switch(gantt.getTask(gantt.getSelectedId()).parent){
        //     case 0:{
        //         gantt.createTask();
        //         // gantt.refreshData(); Refreshes the gantt chart
        //         break;
        //     }
        //     default:{
        //         break;
        //     }
        // }
    }
</script>


<script src="{{ asset('js/jobscheduling.js') }}"></script>