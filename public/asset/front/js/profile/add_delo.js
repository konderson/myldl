$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "/profile/ajax_get_country",
        dataType: "html",
        success: function (msg) {
            var optionsText;
            optionsText += '<option value="">Страна</option>';
            $("#country").empty().append(optionsText + msg).data("selectBox-selectBoxIt").refresh();
        }
    });
    /*
    $.ajax({
        type: "GET",
        url: "/profile/ajax_get_region/",
        dataType: "html",
        success: function (msg) {
            var optionsText;
            optionsText += '<option value="">Регион</option>';
            $("#region").empty().append(optionsText + msg);
        }
    });

    $.ajax({
        type: "GET",
        url: "/profile/ajax_get_city",
        dataType: "html",
        success: function (msg) {
            var optionsText;
            optionsText += '<option value="">Город</option>';
            $("#city").empty().append(optionsText + msg);
        }
    });
    */
    $('select[name=country]').change(function () {
        $("#region, #city").empty();
        $("#city").append('<option value="">Город</option>');
        $.ajax({
            type: "GET",
            url: "/profile/ajax_get_region/" + $(this).val(),
            dataType: "html",
            success: function (msg) {
                var optionsText;
                optionsText += '<option value="">Регион</option>';
                $("#region").append(optionsText + msg).data("selectBox-selectBoxIt").refresh();
            }
        });
    });

    $('select[name=region]').change(function () {
        $("#city").empty();
        $.ajax({
            type: "GET",
            url: "/profile/ajax_get_city/" + $(this).val(),
            dataType: "html",
            success: function (msg) {
                var optionsText;
                optionsText += '<option value="">Город</option>';
                $("#city").append(optionsText + msg).data("selectBox-selectBoxIt").refresh();
            }
        });
    });

    $('input[name=tip]').click(function () {
        if ($('input[name=tip]:checked').val() == 1) {
            $('#hid_uslovia').hide('slow');
            $('#vhod_v_delo').hide('slow');
        }
        if ($('input[name=tip]:checked').val() == 2) {
            $('#hid_uslovia').show('slow');
            $('#vhod_v_delo').show('show');
        }
    });

    $('#dialog').dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        buttons: {
            "Сохранить": function () {
                str_video = '';
                count_video = 0;
                var vide_list = '';
                $('input[name=kod]').each(function () {

                    if ($(this).val())
                    {
                        var kodStr = $(this).val();
                        str_video += kodStr + ',';
                        count_video++;
                        vide_list += '<span>' + count_video + '. </span><span>http://www.youtube.com/watch?v=' + kodStr + '</span>&nbsp;&nbsp;&nbsp;<a href="#" class="upload_video">[редактировать]</a><br>';
                    }
                });
                $('.video_list').html(vide_list);
                $('#str_video').val(str_video);
                $('#count_video').text("Прикреплено: " + count_video + " видео");
                $(this).dialog("close");
                return false;
            },
            "Закрыть": function () {
                $(this).dialog("close");
            }
        }
    });

    $('div.video_list').on('click', 'a.upload_video', function () {
        $('#dialog').dialog('open');
        return false;
    });
    $('.upload_video').click(function () {
        $('#dialog').dialog('open');
        return false;
    });


    $('.load_img').click(function () {
        var kod = $(this).prev().val();
        if (kod) {
            $(this).after('<img src="http://img.youtube.com/vi/' + kod + '/1.jpg" style="padding-left:150px; padding-top:10px; padding-bottom:10px;" />');
            $(this).hide();
            $(this).prev().addClass("kod");
        }
    });

    $("input[name=kod]").keypress(function (event) {
        if (event.which == 13) {
            kod = $(this).val();
            $(this).next().next().remove();
            $(this).next().after('<img src="http://img.youtube.com/vi/' + kod + '/1.jpg" style="padding-left:150px; padding-top:10px; padding-bottom:10px;" />');
        }
    });

    $('button.save').click(function () {
        msg = '';
        if ($("input[name=nazva]").val() == '') {
            $("input[name=nazva]").css("border-color", "#D93600");
            msg +='Заполните поле "Название"\n';
        } else {
            if ($("input[name=nazva]").val().length < 3) {
                $("input[name=nazva]").css("border-color", "#D93600");
                msg += 'Поле "Название" должно быть не короче 3 символов\n';
            }
        }
        if ($("#opisanie").val() == '') {
            $("#opisanie").css("border-color", "#D93600");
            msg +='Заполните поле "Описание"\n';
        }
        
        if(msg.length>0){
            alert(msg);
        }else{
            $('#add_delo_true').trigger('submit');	// підтвердження форми
        }
    });

});

var my_mas1 = new Array();

// Удаления картинок
function remove_img(id, nazva) {
    var el = document.getElementById('img_' + id);
    el.parentNode.removeChild(el);
    // шукаємо вибране значення в масиві, видаляємо його
    for (var i = 0; i < my_mas1.length; i++) {
        if (my_mas1[i] == nazva) {
            my_mas1.splice(i, 1)
        }
        //alert(my_mas1[i]);
    }
    document.getElementById('str_images').value = my_mas1;
    $.get("/profile/ajax_del_img_delo/" + nazva);
}

// Загрузка картинок
$(function () {
    img = 1 + my_mas1.length;
    var btnUpload = $('#upload');
    var status = $('#status');
    new AjaxUpload(btnUpload, {
        action: 'profile/ajax_upload',
        name: 'userfile',
        data: {
            //'<?= $this->security->get_csrf_token_name() ?>': $.cookie('<?= config_item('csrf_cookie_name') ?>')
        },
        onSubmit: function (file, ext) {
            if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                // extension is not allowed 
                status.text('Поддерживаемые форматы JPG, JPEG, PNG или GIF');
                return false;
            }
            status.text('Загружается...');
        },
        onComplete: function (file, response) {
            //On completion clear the status
            status.text('');
            //Add uploaded file to list
            if (response === "error") {
                $('<li></li>').appendTo('#files').text('Файл не загружен ' + file).addClass('error');
            } else {
                // response - назва зменшеного файлу
                orig_name = response.replace("_thumb", "");
                $("#files").append('<li id="img_' + img + '"><figure><img class="thumb" src="/images/uploads/' + response + '" alt="' + file + '" title="' + file + '" /><figcaption>' + (file.length > 10 ? file.substr(0, 8) + '..' : file) + '</figcaption></figure><a class="close" onclick="remove_img(' + img + ', \'' + orig_name + '\')"><img src="/application/views/front/images/close-2.png" alt="" /></a></li>');
                my_mas1.push(orig_name);
                document.getElementById('str_images').value = my_mas1;
                img++;
            }
        }
    });

});