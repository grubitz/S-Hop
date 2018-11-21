$(function () {
    function toggleExpanded() {
        $(this).parents('li').first().toggleClass("expanded");
    };

    $(".arrow").click(toggleExpanded);
});
