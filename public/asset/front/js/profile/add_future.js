$(document).ready(function () {
        $('button.save').click(function () {
            msg = '';
            if ($("input[name=theme]").val() == '') {
                $("input[name=theme]").css("border-color", "#D93600");
                msg += 'Заполните поле "Название"\n';
            } else {
                if ($("input[name=theme]").val().length < 3) {
                    $("input[name=theme]").css("border-color", "#D93600");
                    msg += 'Поле "Название" должно быть не короче 3 символов\n';
                }
            }
            if ($("textarea[name=about]").val() == '') {
                $("textarea[name=about]").css("border-color", "#D93600");
                msg += 'Заполните поле "Описание"\n';
            }

            if (msg.length == 0) {
                
                $('#add_f_business_true').trigger('submit');
            }
        });
    });