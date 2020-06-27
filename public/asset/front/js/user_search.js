/* user_search.js
 * @author K. Vyacheslav <jinex.gsx@gmail.com>
 */
$(document).ready(function() {
    var host        = window.location.origin;
    var query       = window.location.search;
    var path        = host + window.location.pathname;
    var s_country   = $('select.ufilter[name=country]');
    var s_city      = $('select.ufilter[name=city]');
    var s_type      = $('select.ufilter[name=type]');
    var s_status    = $('#online');
    var i_name      = $('input.ufilter');
    var s_help      = $('select.ufilter[name=status_help]');

    if (path.indexOf('users') + 1 || path.indexOf('dela') + 1) {
        $('select.ufilter, #online').change(function() {
            var filters = "?";

            if (query.indexOf('sd=1') != -1 && query.indexOf('su=1') != -1)     filters += query.substr(1, 9) + "&";
            else
                if (query.indexOf('sd=1') != -1 || query.indexOf('su=1') != -1) filters += query.substr(1, 4) + "&";

            if (s_country.val())    filters += "ctid="  + s_country.val()   + "&";
            if (s_city.val())       filters += "cid="   + s_city.val()      + "&";
            if (s_type.val())       filters += "tid="   + s_type.val()      + "&";
            if (s_status.prop("checked"))   filters += "s=1"        + "&";
            if (i_name.val())       filters += "n="     + i_name.val()      + "&";
            if (s_help.val())       filters += "sh="     + s_help.val()      + "&";

            window.location.href = path + filters.substr(0, filters.length - 1);
        });

        $('.search-people').on('submit', function (e) {
            e.preventDefault();

            if (query.length == 0)  window.location.href = path + "?n=" + i_name.val();
            else {
                if (query.indexOf('&n=') != -1)
                    window.location.href = path + query.substr(0, query.indexOf('&n=')) + "&n=" + encodeURIComponent(i_name.val());
                else if (query.indexOf('?n=') != -1)
                    window.location.href = path + query.substr(0, query.indexOf('?n=')) + "?n=" + encodeURIComponent(i_name.val());
                else
                    window.location.href = path + query + "&n=" + encodeURIComponent(i_name.val());
            }
        });

        if (s_country.val() > 0 ) {
            $.ajax({
                type: "GET",
                url: host + "/main/ajax_get_city/" + s_country.val(),
                dataType: "html",
                success: function (response) {
                    $(s_city).empty().append('<option value="">Город</option>' + response);

                    if (s_city.attr('data-id') > 0) {
                        $(s_city).val(s_city.attr('data-id'));
                    }

                    $(s_city).data("selectBox-selectBoxIt").refresh();
                }
            });
        }

        // Сортировка по делам и услугам
        $('.user-heading .sort_btn').click(function() {
            var sort_flag1 = '?' + ($(this).hasClass('uh2') ? 'sd' : 'su') + '=1';
            var sort_flag2 = '&' + ($(this).hasClass('uh2') ? 'sd' : 'su') + '=1';
            var sf_index1 = query.indexOf(sort_flag1);
            var sf_index2 = query.indexOf(sort_flag2);

            if (query.length > 1) {
                if (sf_index1 == -1 && sf_index2 == -1)
                    query = sort_flag1 + '&' + query.substr(1, query.length);
                else {
                    if (sf_index1 != -1) {
                        query = query.substr(sort_flag1.length, query.length);

                        if (query.length > 1) query = '?' + query.substr(1, query.length);
                    }

                    if (sf_index2 != -1)
                        query = query.substr(0, sf_index2) + query.substr(sf_index2 + sort_flag1.length, query.length);
                }
            } else
                query = sort_flag1;

            window.location.href = path + query;
        });
    }
});