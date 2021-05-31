
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
                text: "Successfully updated {jobsched ID here}",
                icon: "success",
            });
        },
        error: function(data){
            swal({
                title: "Error",
                text: "An error has occurred.",
                icon: "error",
            })
        }
    });
    return false;
});