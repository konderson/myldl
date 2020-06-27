jQuery( document ).ready(function($) {
    var job_type = {
        'individual' : 1,
        'collective' : 2
    }
    var vhod_v_delo = {
        'otkrit_vsem': 1,
        'po_zaprosu' : 2
    }

/*
    $('#invite_to_job').click(function(){

        var $data_objs = {};
        $data_objs[hashName] = $.cookie(hashCookieName);
        $data_objs.invited_user_id = forUserID;
        $data_objs.types = [job_type.collective];
        $data_objs.vhod_v_delo = [vhod_v_delo.otkrit_vsem];
        $.ajax({
            type: "POST",
            url: base_url + "ajax/user_jobs",
            data: $data_objs,
            //dataType: json,
            success: function(response){
                var dela = JSON.parse(response);
                //console.log(dela);
                html = '';
                $.each( dela.user_open_jobs, function( key, job ) {
                    var used='';
                    var used_tex = '';

                    //console.log(dela.invited_user_jobs[job.id]);
                    if(dela.invited_user_jobs[job.id]==3){
                        used = 'disabled';
                        used_tex='<span class="pull-right text-warning">Пользователь уже является участников этого дела </span>';

                    }
                    html += '<tr>' +
                            '<td><input '+used+' type="checkbox" name="job_'+ job.id +'" job_id="'+ job.id +'" /> '+job.nazva+used_tex+' </td>'+

                            '</tr>';
                });
                $("#collective_work_table_body").html(html);
            }
        });
    });

*/
    $("#ivite_to_job_inmodal").click(function(){

        var checked_jobs = $('#collective_work_table_body input:checked');
        var selected_job_ids = [];
        console.log(checked_jobs.length);

        if(checked_jobs.length > 0) {
            $.each(checked_jobs, function (key, job) {
                selected_job_ids.push($(job).attr('job_id'))
            });

            var $data_objs = {};
            $data_objs[hashName] = $.cookie(hashCookieName);
            $data_objs.invited_user_id = forUserID;
            $data_objs.selected_job_ids = selected_job_ids;

            $.ajax({
                type: "POST",
                url: base_url + "ajax/invite_to_job",
                data: $data_objs,
                //dataType: json,
                success: function (response) {
                    var dela = JSON.parse(response);
                    console.log(dela);
                    $('#invite_success').removeClass("hidden").addClass("show");
                    setTimeout(function(){
                        $('#invite_to_job_modal').modal('hide');
                        $('#invite_success').removeClass("show").addClass("hidden");
                    }, 1500);

                }
            });
        }
    });
/*
    $("#invite_to_job").click(function(){
        $('#ivite_to_job_inmodal').addClass("disabled");
        $('#invite_to_job_modal').modal();
    });
*/
    $(document).on('change','#collective_work_table_body input',function(){

        var checked_jobs = $("#collective_work_table_body input:checked");
        //var my_input = $("#collective_work_table_body input");
        //console.log(checked_jobs);
        if(checked_jobs.length == 0){
            $('#ivite_to_job_inmodal').addClass("disabled");
        }
        else {
            $('#ivite_to_job_inmodal').removeClass('disabled');
        }
    });

    $('.invited_work').click(function(){
        var job_reaction = $(this).attr("id");
        var job_id = $(this).attr("job_id");
        var action_id = $(this).attr("action_id");
//delo_id
//        console.log(job_reaction);


        //$("#example > tbody").empty();
        //$("#example > tbody").append('<tr><td colspan="5" style="text-align:center;"><img src="http://lyudi.esterox.am/application/views/front/images/ajax-loader.gif" /></td></tr>');
        var $data_objs = {};
        $data_objs['hash_token_id'] = $.cookie('hash_cookie_id');
        $data_objs.job_reaction = job_reaction;
        $data_objs.job_id = job_id;
        $data_objs.action_id = action_id;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + "ajax/job_reaction",
            data: $data_objs,
            //dataType: json,
            success: function(response){
                //console.log(response);
                location.reload();

            }
        });
    });

});