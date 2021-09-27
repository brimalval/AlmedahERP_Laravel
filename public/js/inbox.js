function makeImportant(item) {
    // far is inimportant, fas isn't
    if (item.classList.contains('far')) {
        item.classList.remove('far');
        item.classList.add('fas');

        // make this message important

    } else {
        item.classList.add('far');
        item.classList.remove('fas');
        item.style.color = "black";

        // remove this message from important
    }
}

// function to archive the message
function archiveMsg() {
    confirm("Are you sure to ARCHIVE this message?");
}

// function to delete the message
function deleteMsg() {
    confirm("Are you sure to DELETE this message?");
}
$(".main-item").click(function() {
    // if (!$(this).hasClass("msg-active")) {
    //     $(this).addClass("msg-active");
    //     $(this).siblings().removeClass("msg-active");
    //     $(this).siblings().find(".inbox-selector").children().prop("checked", false);
    //     $(this).find(".inbox-selector").children().prop("checked", true);

    // } else {
    //     $(this).removeClass("msg-active");
    //     $(this).find(".inbox-selector").children().prop("checked", false);
    // }


});

//     I use the following piece of CSS and JavaScript. It uses an extra class dropdown-submenu. I tested it with Bootstrap 4 beta.

// It supports multi level sub menus.
$("#empty-val").click(function() {
    $("#msg-group").html($(this).html());
    $("#msg-group").attr("val", "0");
    if ($("#msg-group").attr("val") == "0") {
        $("#row-to").slideUp();
    }
});
$(".dropdown-submenu > ul > li > a").click(function() {
    $("#msg-group").html($(this).html());
    $("#msg-group").attr("val", "1");

    if ($("#msg-group").attr("val") !== "0") {
        $("#row-to").slideDown();
    }
});
$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
    if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
    }
    var $subMenu = $(this).next('.dropdown-menu');
    $subMenu.toggleClass('show');

    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass('show');
        alert($(this));
    });

    return false;
});
$("#inbox-nav").css("height", document.getElementById('divMain').offsetHeight);
$(document).ready(function() {
    $('.limit-text').each(function(i, obj) {
        if (obj.innerHTML.length >= 25) {
            obj.innerHTML = obj.innerHTML.substr(0, 20).concat("…");
        }
    });
});
$(document).ready(function() {
    $("#row-to").css("display", "none");
    $('#msg-body').summernote({
        height: 290,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', ]],
        ],
    });
});