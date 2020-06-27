$(document).ready(function () {
        $("#cenarub").hide();
        $("#cena").change(function () {
            if ($("#cena").val() == 0) {
                $("#cenarub").hide();
                $("#cenarub_input").val("0");
                
            } else {
                $("#cenarub").show();
            }
        });
        $("#cenarub_input").bind('change keyup mouseleave', function () {
            var name = $("#cenarub_input").val();
            $("#cenarub_input").val(name.replace(/[^\1-9]/ig, ""));
            name = $("#cenarub_input").val();

        });
        //$("input[name=tel]").mask("+9 (999) 999-99-99");
        $("#country").empty();
        $.ajax({
            type: "GET",
            url: baseurl+"profile/ajax_get_country",
            dataType: "html",
            success: function (msg) {
                $("#country").append('<option value="">Страна</option>'+msg);
            }
        });

        $('select[name=country]').change(function () {
            $("#region").empty();
            $.ajax({
                type: "GET",
                url: baseurl+"profile/ajax_get_region/" + $(this).val(),
                dataType: "html",
                success: function (msg) {
                    $("#region").append('<option value="">Регион</option>' + msg);
                }
            });
        });

        $('select[name=region]').change(function () {
            $("#city").empty();
            $.ajax({
                type: "GET",
                url: baseurl+"profile/ajax_get_city/" + $(this).val(),
                dataType: "html",
                success: function (msg) {
                    $("#city").append('<option value="">Город</option>' + msg);
                }
            });
        });


        $('button.save').click(function () {
            msg = "";
            city = 0;
            razdel_id = 0;
            tema = 0;
            opisanie = 0;
            if ($('select[name=city]').val() == 0) {
                $('select[name=country]').css("border-color", "#D93600");
                msg += 'Выберите страну \n';
                city = 1;
            }
            if ($('select[name=region]').val() == 0) {
                $('select[name=region]').css("border-color", "#D93600");
                msg += 'Выберите регион \n';
                city = 1;
            }
            if ($('select[name=city]').val() == 0) {
                $('select[name=city]').css("border-color", "#D93600");
                msg += 'Выберите город \n';
                city = 1;
            }
            if ($('select[name=razdel_id]').val() == 0) {
                $('select[name=razdel_id]').css("border-color", "#D93600");
                msg += 'Выберите раздел \n';
                razdel_id = 1;
            }
            if ($("textarea[name=tema]").val() == '') {
                $("textarea[name=tema]").css("border-color", "#D93600");
                msg += 'Заполните поле "Тема" \n';
                tema = 1;
            } else {
                if ($("textarea[name=tema]").val().length < 3) {
                    $("textarea[name=tema]").css("border-color", "#D93600");
                    msg += 'Поле "Тема" должно быть не короче 3 символов\n';
                    tema = 1;
                }
            }
            if ($("#opisanie").val() == '') {
                $("#opisanie").css("border-color", "#D93600");
                msg += 'Заполните поле "Описание" \n';
                opisanie = 1;
            }
            if (city == 0 | tema == 0 | opisanie == 0 | razdel_id == 0) {
                $('#add_uslugi_true').trigger('submit');	
            }
        });

});
 var my_mas1 = new Array();
$(function () {
img = 1;
var btnUpload = $('#upload');
var status = $('#status');
new AjaxUpload(btnUpload, {
    action: '/profile/ajax_upload_usluga',
    name: 'userfile',
    data: {
        //'<?= $this->security->get_csrf_token_name() ?>': $.cookie('<?= config_item('csrf_cookie_name') ?>')
    },
    onSubmit: function (file, ext) {
        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
            // extension is not allowed 
            status.text('Поддерживаемые форматы JPG, PNG или GIF');
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
            $("#files").append('<li id="img_' + img + '"><figure><img class="thumb" src="/images/uslugi/' + response + '" alt="' + file + '" title="' + file + '" /><figcaption>' + (file.length > 10 ? file.substr(0, 8) + '..' : file) + '</figcaption></figure><a class="close" onclick="remove_img(' + img + ', \'' + orig_name + '\')"><img src="/application/views/front/images/close-2.png" alt="" /></a></li>');
            my_mas1.push(orig_name);
            document.getElementById('str_images').value = my_mas1;
            img++;
        }
    }
});





    });