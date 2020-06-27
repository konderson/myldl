var count = 20;
var filter = "all";
$(document).ready(function() {
    $(document).on('click', '#more', function (e) {
        e.preventDefault();

        $('#more').hide();        
        $.ajax({
            type: "POST",
            url: baseurl+"profile/ajax_lenta",
            data: {
                'count': count,
                'filter': filter
            },
            dataType: "json",
            success: function (msg) {
                $('.layer').append(msg.str);
                $(".layer").addClass("layer-visible");
                count = msg.count;
                if (msg.end_count)
                    $('#more').hide();
                else
                    $('#more').show();
                if (msg.not_show > 0) {
                    $("#current_count").html("(" + msg.not_show + ")");
                    $("#current_count_small").html("(" + msg.not_show + ")");
                } else {
                    $("#current_count").html("");
                    $("#current_count_small").html("");
                }
            }

        });
    });
    $(document).on('click', '.filter-list span', function(e){
        e.preventDefault();
        $(this).parent().addClass('checked');
        filter = $(this).parent().attr('data-filter');
        $(this).parent().siblings('.checked').removeClass('checked');
        $('.layer').html("");
        $('#more').hide();
        $.ajax({
            type: "POST",
            url: baseurl+"profile/ajax_lenta",
            data: {
                'count': 0,
                'filter': filter
            },
            dataType: "json",
            success: function (msg) {
                $('.layer').append(msg.str);
                count = msg.count;
                if (msg.end_count)
                    $('#more').hide();
                else
                    $('#more').show();
                if (msg.not_show > 0) {
                    $("#current_count").html("(" + msg.not_show + ")");
                    $("#current_count_small").html("(" + msg.not_show + ")");
                } else {
                    $("#current_count").html("");
                    $("#current_count_small").html("");
                }
            }

        });
    });
});