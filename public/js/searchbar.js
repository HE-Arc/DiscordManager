$(document).ready(function () {
    $(".advancedGroupList").each(function(index, value) {
        let groupList = $( this );
        $( value ).find(".searchbar").on("keyup", function () {
            groupList.find('.selectAll').prop('checked', false);
            var value = $(this).val().toLowerCase();
            groupList.find(".list-group label").each(function () {
                if ($(this).text().toLowerCase().indexOf(value) > -1) {
                    $(this).show();
                } else {
                    $(this).attr('style', 'display: none !important');
                }
            });
        });
    });

});
