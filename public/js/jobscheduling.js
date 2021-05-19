
$('.selectpicker').each(function(){
    $(this).selectpicker();
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