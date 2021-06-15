
$('.selectpicker').each(function(){
    $(this).selectpicker();
});

$('#js-form').off('submit').on('submit', function(){
    var fd = new FormData(this);
    var planned_starts = fd.getAll('planned_start[]');
    var planned_ends = fd.getAll('planned_end[]');
    var real_starts = fd.getAll('real_start[]');
    var real_ends = fd.getAll('real_end[]');
    // Operations variable is initialized and changed in jobschedulinginfo.blade.php
    // Keys are being added here & turned into a JSON
    for(var i=0; i<operations.length; i++){
        if (planned_starts[i].trim() == "" || planned_ends[i].trim() == ""){
            swal({
                title: "Warning",
                text: "Please fill up all of the fields!",
                icon: "info",
            });
            return false;
        }
        operations[i].planned_start = planned_starts[i];
        operations[i].planned_end = planned_ends[i];
        operations[i].real_start = real_starts[i];
        operations[i].real_end = real_ends[i];
    }
    fd.append('operations', JSON.stringify(operations));
    let element = this;
    $.ajax({
        type: 'POST',
        url: this.action,
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: function(data){
            swal({
                title: "Success",
                text: `Successfully ${data.action}d ${data.jobsched.jobs_sched_id}!`,
                icon: "success",
            });
            console.log(data);
            loadIntoPage(element, data.redirect);
        },
        error: function(data){
            var errorString = "";
            let obj = data.responseJSON.errors;
            // The response JSON from the controller sends back a message bag whose properties are
            // iterable through JS. The error messages list inherits other properties from base objects
            // and the if statement checks if the properties being iterated through are unique to the object.
            for (var prop in obj) {
                if (Object.prototype.hasOwnProperty.call(obj, prop)) {
                    errorString += obj[prop] + " "; 
                }
            }
            swal({
                title: "Error",
                text: `An error has occurred. ${errorString}`,
                icon: "error",
            });
            console.log(data.responseJSON);
        }
    });
    return false;
});

function operationController(btnAttributes){
    link = ["/startOperation", "/pauseOperation" , "/finishOperation"]; //Choose betweeen the three
    indexer = btnAttributes.getAttribute('link'); //Get the link from attribute of btn

    data = {};
    data["id"] = id; //JobSched id here from attribute of btn
    data["sequence_name"] = sequence_name; //Sequence Name here attribute of btn

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: link[link.indexOf(indexer)],
        data: data,
        success: function (response) {
            console.log(response);
        },
        error: function (response, error) {
            // alert("Request: " + JSON.stringify(request));
        },
    });
}

// Only do the gantt chart functions if a gantt chart container exists
if(!!$('#gantt_here')[0]){
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
}