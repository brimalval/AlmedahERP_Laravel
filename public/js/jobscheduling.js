
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
