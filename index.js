$(function () {

    function toggleExpanded() {
        $(this).parent().find(">ul").toggle();
        $(this).toggleClass("expanded");
    };

    $(".arrow").click(toggleExpanded);

    var categoryId = $('meta[name=category-id]').attr("content");
    if (categoryId) {
        var selectedCategoryIcon = $('li[data-category-id=' + categoryId + ']>.category-toggle');
        selectedCategoryIcon.parents('li').each(function() {
            var arrow = $(this).find('>.category-toggle');
            toggleExpanded.bind(arrow)();
        });
    }
});
