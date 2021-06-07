<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Job Scheduling</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li-bom">
                    <a href="javascript:void(0)" onclick="loadJobschedhome()" class="btn btn-primary text-white" type="button">Refresh</a>
                </li>
                <li class="nav-item li-bom">
                    <a href="javascript:void(0)" onclick="newTask()" class="btn btn-default" type="button">New</a>
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
        <li class="nav-item li-bom">
            <button style="background-color: #007bff;" class="btn btn-info btn" onclick="loadIntoPage(this, '{{ route('jobscheduling.create') }}');" style="float: left;">New</button>
        </li>
    </div>
</nav>
<div class="container-fluid">
    <!-- Modal -->
    <div class="modal fade" id="jobSchedInfo" tabindex="-1" role="dialog" aria-labelledby="jobSchedInfoTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="fname">Tracking ID</label>
                                        <input type="text" name="JobSc" id="JobSc" class="form-control">
                                    </div>

                                </div>

                                <div class="col-6">
                                    <!--empty-->
                                </div>
                                <div class="col-12">
                                    <hr><br>
                                </div>
                                <div class="col-6">
                                    <label for="workOrderJobSched">Work Order</label>
                                    <div class="input-group">
                                        <input type="text" name="workOrderJobSched" class="form-control" value="workorder001">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>

                                    <!-- <div class="input-group">
								<input type="text" class="form-control" placeholder="Search" name="search">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i
											class="glyphicon glyphicon-search"></i></button>
								</div>
							</div> -->
                                </div>
                                <div class="col-3 offset-2">
                                    <div class="form-group">
                                        <label for="jobStartDate">Start Date</label>
                                        <input type="text" name="jobStartDate" id="jobStartDate" class="form-control">
                                    </div>
                                </div>


                                <div class="col-6">
                                    <label for="productCode">Product/Component</label>
                                    <div class="input-group">
                                        <input type="text" name="productCode" class="form-control" value="product001">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="productQuantity">Quantity</label>
                                        <input type="text" name="productQuantity" class="form-control" value="3">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="StartT">Start Time</label>
                                        <input type="text" name="StartT" id="StartT" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <!--empty-->
                                </div>

                                <div class="col-6">
                                    <label for="employeeID">Employee ID</label>
                                    <div class="input-group">
                                        <input type="text" name="employeeID" class="form-control" value="emp001">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr><br>
                                </div>
                                <!-- Pre fill operations button -->
                                <!-- <div class="col-12">
                                    <div class="col-3">
                                        <button class="btn btn-primary text-nowrap btn-md" id="preFillBtn">
                                            Pre-fill Operation
                                        </button>
                                    </div>
                                </div> -->
                                <br>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Actions</h3>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-sm btn-primary form-control my-1" onclick="planJobSched()" id="planBtn">Plan</button>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-sm btn-primary form-control my-1" id="startBtn">Start</button>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-sm btn-primary form-control my-1" id="SPBtn">Pause/Resume</button>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-sm btn-primary form-control my-1" id="finBtn">Finish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-condensed" id="operationsTable">
                                    <thead>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">SEQUENCE NAME</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">OPERATION NAME</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">OPERATION TIME</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">PREDECESSOR</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">MACHINE CODE</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">WC TYPE</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">OUTSOURCED</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">PLANNED START</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">PLANNED END</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">REAL START</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">REAL END</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">STATUS</td>
                                        <td style="font-size:90%;font-weight:bold" class="text-nowrap">QTY FINISHED</td>
                                        <td>
                                            <!--empty-->
                                        </td>
                                        <td>
                                            <!--empty-->
                                        </td>
                                        <td>
                                            <!--empty-->
                                        </td>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Sequence Name Value -->
                                                Sequence 1
                                            </td>
                                            <td>
                                                <!-- Operation Name Value -->
                                                Pick produce
                                            </td>
                                            <td>
                                                <!-- Operation Time Value -->
                                                56 Hours
                                            </td>
                                            <td>
                                                <!-- Predecessor Value -->
                                            </td>
                                            <td>
                                                <!-- Machine Code Value -->
                                            </td>
                                            <td>
                                                <!-- WC_Type value -->
                                            </td>
                                            <td class="d-flex align-items-center justify-content-center">
                                                <!-- Outsourced Value -->
                                                <div class="form-check ">
                                                    <input type="checkbox" class="form-check-input">
                                                </div>
                                            </td>
                                            <td class="p-3">
                                                <!-- Planned Start Value -->
                                                <input class="form-control form-control-sm" type="text">
                                            </td>
                                            <td class="p-3">
                                                <!-- Planned End Value -->
                                                <input class="form-control form-control-sm" type="text">
                                            </td>
                                            <td class="p-3">
                                                <!-- Real Start Value -->
                                                <input class="form-control form-control-sm" type="text">
                                            </td>
                                            <td class="p-3">
                                                <!-- Real End Value -->
                                                <input class="form-control form-control-sm" type="text">
                                            </td>
                                            <td>
                                                <!-- Status Value -->
                                            </td>
                                            <td>
                                                <!-- Quantity Finished -->
                                            </td>
                                            <!-- Action Buttons -->
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-pause"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-power-off"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="lightBoxClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <div id="gantt" style="height: 40em"></div> -->
    <div id="gantt_here" style='width:1000px; height:680px;'></div>
</div>
<script type="text/javascript">
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
        // << GANTT CHART RELATED FUNCTIONS >>
        // Zoom Configuration
        var hourToStr = gantt.date.date_to_str("%H:%i");
        var dayToStr = gantt.date.date_to_str("%d/%m/%y");
        var hourRangeFormat = function(step) {
            return function(date) {
                var intervalEnd = new Date(gantt.date.add(date, step, "hour") - 1)
                return hourToStr(date) + " - " + hourToStr(intervalEnd);
            };
        };

        var zoomConfig = {
            levels: [
                [{
                        unit: "month",
                        format: "%M %Y",
                        step: 1
                    },
                    {
                        unit: "week",
                        step: 1,
                        format: function(date) {
                            var dateToStr = gantt.date.date_to_str("%d %M");
                            var endDate = gantt.date.add(date, -6, "day");
                            var weekNum = gantt.date.date_to_str("%W")(date);
                            return "Week #" + weekNum + ", " + dateToStr(date) + " - " + dateToStr(endDate);
                        }
                    }
                ],
                [{
                        unit: "month",
                        format: "%M %Y",
                        step: 1
                    },
                    {
                        unit: "day",
                        format: "%d %M",
                        step: 1
                    }
                ],
                [{
                        unit: "day",
                        format: "%d %M",
                        step: 1
                    },
                    {
                        unit: "hour",
                        format: hourRangeFormat(12),
                        step: 12
                    }
                ],
                [{
                        unit: "day",
                        format: "%d %M",
                        step: 1
                    },
                    {
                        unit: "hour",
                        format: hourRangeFormat(6),
                        step: 6
                    }
                ],
                [{
                        unit: "day",
                        format: "%d %M",
                        step: 1
                    },
                    {
                        unit: "hour",
                        format: "%H:%i",
                        step: 1
                    }
                ]
            ],
            useKey: "ctrlKey",
            trigger: "wheel",
            element: function() {
                return gantt.$root.querySelector(".gantt_task");
            }
        }

        // A notification on how to zoom in and out
        gantt.message({
            text: "Use <b>CTRL + Mousewheel</b> in order to zoom",
            expire: 3000
        });

        // Closes the modal
        $("#lightBoxClose").click(function() {
            $("#jobSchedInfo").modal('toggle');
        });

        //When the lightBox is displayed
        gantt.showLightbox = function(id) {
            // If a job is clicked, return the values present from the gantt chart, assuming that the data has been already parsed.
            if (!gantt.getParent(id)) {
                var start_time = hourToStr(gantt.getTask(id).start_date);
                var start_date = dayToStr(gantt.getTask(id).start_date);
                $("#jobSchedInfo").modal('toggle');
                $("#JobSc").val(id);
                $("#jobStartDate").val(start_date);
                $("#StartT").val(start_time);
            }
            // but if a operation is clicked, tell the user that the job is supposed to be clicked
            else {
                gantt.message({
                    id: "dbl-info",
                    text: "<b>Double click</b> on the main Job to edit the operation.",
                    position: "left",
                    expire: 3000
                });
            }
        }
        gantt.ext.zoom.init(zoomConfig);

        // DATA CONFIG
        gantt.config.date_format = "%Y-%m-%d %H:%i"; // Specifies how should the date be accepted
        // Specifices which columns are displayed in the gantt table.
        gantt.config.columns = [{
                name: "text",
                label: "Job",
                tree: true,
                width: 150,
                resize: true
            },
            {
                name: "work_order",
                label: "Work Order",
                align: "center",
                resize: true
            },
            {
                name: "status",
                label: "Status",
                align: "center",
                width: 100,
                resize: true
            },
        ];
        gantt.init("gantt_here");
        gantt.parse({
            // Data can be an Object(Ajax), JSON, or an XML
            // See www.docs.dhtmlx.com/gantt/desktop__loading.html for the data loading documentation
            data: [{
                    // Job Data / Task resource
                    id: "jobsched001", // We can use the tracking id here
                    text: "jobsched001", // What should the data display. We can use a TEMPLATE if we want to customize the text.
                    start_date: null, //We can specify It's start date and End date, but it can also be left as null as it follows all the operations or it's sub tasks
                    duration: null,
                    parent: 0, // Such data has no parent as it is the Job itself.
                    progress: 0,
                    open: true, // specifies whether the operations in the gantt chart are displayed
                    status: "In Progress", // Where the JS_status column can be used
                    work_order: "workorder001" // An extra column to show the work order of the job
                },
                // jobsched001's Children
                {
                    id: "jobsched001+op1212", // IT IS TO BE NOTED THAT A SEQUENCE MUST HAVE A UNIQUE VALUE REGARDLESS OF IT'S JOB 
                    text: "op1212", // Operation Name
                    start_date: "2019-08-01 00:00",
                    duration: 5,
                    parent: "jobsched001", //Use this to specify the job id
                    progress: 1, // it can be left to 0 if there are no calculations for the progress
                    status: "Done" // The Status of the OPERATION
                },
                {
                    id: "jobsched001+op1818",
                    text: "op1818",
                    start_date: "2019-08-06 00:00",
                    duration: 2,
                    parent: "jobsched001",
                    progress: 0.5,
                    status: "In Progress"
                },
                {
                    id: "jobsched001+op1919",
                    text: "op1919",
                    start_date: "2019-08-07 00:00",
                    duration: 2,
                    parent: "jobsched001",
                    progress: 0.5,
                    status: "In Progress"
                },
                // New Job Scheduling Job
                {
                    id: "jobsched002",
                    text: "Job #2",
                    start_date: null,
                    duration: null,
                    parent: 0,
                    progress: 0,
                    open: true,
                    status: "In Progress",
                    work_order: "workorder002"
                },
                // jobsched002's Children
                {
                    id: "jobsched002+op1212",
                    text: "op1212",
                    start_date: "2019-08-01 00:00",
                    duration: 5,
                    parent: "jobsched002",
                    progress: 1,
                    status: "Done"
                },
                {
                    id: "jobsched002+op1818",
                    text: "op1818",
                    start_date: "2019-08-06 00:00",
                    duration: 2,
                    parent: "jobsched002",
                    progress: 0.5,
                    status: "In Progress"
                },
                // Unplanned Job
                {
                    id: "jobsched003",
                    text: "Job #3",
                    start_date: null,
                    end_date: null,
                    duration: null,
                    parent: 0,
                    progress: 0,
                    open: true,
                    status: "In Draft",
                    unscheduled: true // We can specify if the job is not started yet by using unscheduled.
                },
            ],
            // Links states how should the steps of the operation or job be.
            links: [{
                    id: "jobsched001step1_to_step2",
                    source: "jobsched001+op1212", // From Operation 1 
                    target: "jobsched001+op1818", // to Operation 2 
                    type: "0" // Specifies how should the arrows are displayed. 0 Means from end to start
                },
                {
                    id: "jobsched001step2_to_step3",
                    source: "jobsched001+op1818",
                    target: "jobsched001+op1919",
                    type: "0"
                },
                {
                    id: "jobsched002step1_to_step2",
                    source: "jobsched002+op1212",
                    target: "jobsched002+op1818",
                    type: "0"
                }
            ]
            // See www.docs.dhtmlx.com/gantt/api__gantt_links_config.html for more details
        });

        // Gantt config to disable the dragging features from the gantt
        gantt.config.drag_move = false;
        gantt.config.drag_progress = false;
        gantt.config.drag_links = false;
        gantt.config.drag_resize = false;

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