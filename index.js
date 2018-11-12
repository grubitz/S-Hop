$(function () {

    $( ".arrow" ).click(function() {
        $(this).parent().find(">ul").toggle();
        $(this).toggleClass("expanded");
    });

});
