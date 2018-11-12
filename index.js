$(function () {

    $( ".arrow" ).click(function() {
        $(this).next("ul").toggle();
        $(this).toggleClass("expanded");
    });

});
