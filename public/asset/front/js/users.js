var wall_posts = {
    prev_text_post: '',
    prev_id_post: 0,
    add_post: function (elem) {
        var parent = $(elem).parentsUntil('.user-wall-posts')[1];

        if ($(parent).find('.user-wall-message textarea').val() == '') {
            alert('Нельзя добавить пустую запись');

            return false;
        }

        $.ajax({
            url: myldl.base_url + 'users/add_wall_post',
            type: 'post',
            data: {text: $(parent).find('.user-wall-message textarea').val(), hash: myldl.hash},
            dataType: 'json',
            success: function(json) {
                if (json.status != -1) {

                    $('.user-wall-posts')
                        .prepend(json.content);

                    $(parent)
                        .find('.user-wall-message textarea')
                        .val('');

                    $(parent)
                        .find('.user-wall-count-words span')
                        .text(0);

                    $('.user-wall-header span')
                        .text($('.user-wall-posts').find('.user-wall-post').length);

                    wall_posts.show_msg($('.user-wall-posts').find('.user-wall-post:first-child'), 2);
                } else {
                    alert('Ошибка добавления записи');
                }
            },
            error: function () {
                alert('Ошибка соединения с сервером');
            }
        });
    },
    edit_post: function(elem, id) {
        event.preventDefault();

        var parent = $(elem).parentsUntil('.user-wall-posts')[4];

        $(parent)
            .find('.wall-post-content')
            .html('<textarea class="form-control">' + $(parent).find('.wall-post-content').text() + '</textarea>');

        $(parent)
            .find('.wall-post-control')
            .append('<button class="btn btn-sm btn-success wall-post-save pull-right" ' +
                'onclick="wall_posts.save_post(this, ' + id + ')">' +
                '<span class="glyphicon glyphicon-floppy-disk"></span> Сохранить</button>')
            .parent()
            .find('.wall-post-like')
            .hide();

        $(parent)
            .find('.wall-post-header .btn-group')
            .hide();

        wall_posts.prev_text_post = $(parent).find('.wall-post-content').text();
        wall_posts.prev_id_post = id;
    },
    del_post: function (elem, id) {
        event.preventDefault();

        var parent = $(elem).parentsUntil('.user-wall-posts')[4];

        if (confirm('Вы уверены что хотите удалить запись со стены?')) {
            $.ajax({
                url: myldl.base_url + 'users/del_wall_post',
                type: 'post',
                data: {id: id, hash: myldl.hash},
                dataType: 'json',
                success: function(json) {
                    if (json.status != -1) {
                        $(parent)
                            .animate({'height': '60px'}, 300)
                            .children()
                            .animate({'opacity': 0}, 300, '', function () {
                                $(parent)
                                    .children()
                                    .remove();

                                $(parent)
                                    .css({'overflow': 'hidden'})
                                    .append('<div class="label-del-success">Запись успешно удалена</div>')
                                    .find('.label-del-success')
                                    .animate({'opacity': 0.6}, 300, '', function () {
                                        setTimeout(function () {
                                            $(parent)
                                                .animate({'height': 0, 'padding': 0, 'margin-bottom': '-21px'}, 300)
                                                .find('.label-del-success')
                                                .animate({'height': 0}, 300, function () {
                                                    $(parent).remove();

                                                    $('.user-wall-header span')
                                                        .text($('.user-wall-posts').find('.user-wall-post').length);
                                                });
                                        }, 800);
                                    });
                            });
                    } else {
                        wall_posts.show_msg(parent, 3);
                    }
                },
                error: function () {
                    wall_posts.show_msg(parent, 3);
                }
            });
        }
    },
    save_post: function (elem, id) {
        var parent  = $(elem).parentsUntil('.user-wall-posts')[1];

        if (wall_posts.prev_id_post != id) return false;

        $.ajax({
            url: myldl.base_url + 'users/edit_wall_post',
            type: 'post',
            data: {id: id, text: $(parent).find('.wall-post-content textarea').val(), hash: myldl.hash},
            dataType: 'json',
            success: function(json) {
                if (json.status != -1) {
                    $(parent)
                        .find('.wall-post-content')
                        .text($(parent).find('.wall-post-content textarea').val());

                    $(parent)
                        .find('.wall-post-control .wall-post-like')
                        .show()
                        .parent()
                        .find('.wall-post-save')
                        .remove();

                    $(parent)
                        .find('.wall-post-header .btn-group')
                        .show();

                    wall_posts.show_msg(parent, 1);
                } else {
                    reset_post();
                }
            },
            error: reset_post
        });

        function reset_post() {
            $(parent)
                .find('.wall-post-content')
                .text(wall_posts.prev_text_post);

            $(parent)
                .find('.wall-post-control .wall-post-like')
                .show()
                .parent()
                .find('.wall-post-save')
                .remove();

            $(parent)
                .find('.wall-post-header .btn-group')
                .show();

            wall_posts.show_msg(parent, 0);
        }
    },
    show_msg: function (parent, act) {
        var msg_text = 'Изменения сохранены';
        var msg_class = 'success';

        if (!act) {
            msg_text = 'Ошибка сохранения';
            msg_class = 'danger';
        } else if (act == 2) {
            msg_text = 'Запись добавлена';
        } else if (act == 3) {
            msg_text = 'Ошибка удаления';
            msg_class = 'danger';
        }

        $(parent)
            .find('.wall-post-header .wall-post-name')
            .append('<div class="label label-sm label-' + msg_class + '" style="opacity:0">' + msg_text + '</div>')
            .find('.label-' + msg_class)
            .animate({'opacity': 0.8}, 400, '', function () {
                setTimeout(function () {
                    $(parent)
                        .find('.wall-post-header .wall-post-name .label-' + msg_class)
                        .animate({'opacity': 0}, 400, '', function () {
                            $(parent)
                                .find('.wall-post-header .wall-post-name .label-' + msg_class)
                                .remove();
                        });
                }, 1000);
            });
    },
    like_up: function (elem, id) {
        var total_count = $(elem).find('.count_num b').text();

        $.ajax({
            url: myldl.base_url + 'users/like_wall_post',
            type: 'post',
            data: {id: id, total: (total_count ? total_count : 0), hash: myldl.hash},
            dataType: 'json',
            success: function(json) {
                if (json.status != -1) {
                    $(elem).find('.count_num b').text(json.content);
                } else {
                    alert('Ошибка добавления лайка');
                }
            },
            error: function () {
                alert('Ошибка соединения с сервером');
            }
        });
    }
};

$(function () {
    $('.user-menu li').on('click', function () {
        $(this)
            .parent()
            .find('li.active')
            .removeClass('active');

        $(this)
            .addClass('active');

        $('.user-panels')
            .find('.user-panel.active')
            .removeClass('active')
            .parent()
            .find('div.user-panel:eq(' + $(this).parent().find('li').index($(this))  + ')')
            .addClass('active');

        var panel = $('div.user-panel.active').attr('data-panel');

        if (panel != 'anketa' && panel != 'wall') {
            $('div.user-panel.active')
                .find('.user-panel-message')
                .remove();

            //$('div.user-panel.active')
            //    .append('<div class="user-panel-message">Пожалуйста подождите, панель загружается...</div>');

            $('.user-panels-progress')
                .css({opacity: 1})
                .find('.progress-line')
                .width(50);

            $.ajax({
                url: myldl.base_url + 'users/get_' + panel,
                type: 'post',
                data: {uid: $('.user-box').attr('data-id'), hash: myldl.hash},
                dataType: 'json',
                xhr: function() {
                    var xhr = $.ajaxSettings.xhr();

                    xhr.upload.addEventListener('progress', function (evt) {
                        if (evt.lengthComputable) {
                            $('.user-panels-progress .progress-line')
                                .width(Math.ceil(evt.loaded / evt.total * 100) + '%');
                        }
                    }, false);

                    return xhr;
                },
                success: function(json){
                    if (json.status != -1) {
                        $('div.user-panel.active')
                            .html(json.content);
                    }

                    $('.user-panels-progress')
                        .animate({opacity: 0}, 1500);
                },
                error: function () {
                    $('div.user-panel.active')
                        .find('.user-panel-message')
                        .text('Ошибка загрузки панели, пожалуйста обновите страницу');

                    $('.user-panels-progress')
                        .animate({opacity: 0}, 1500);
                }
            });
        }
    });

    $('.user-wall-message textarea').focusin(function () {
        $(this).on('input', function () {
            $(this)
                .parent()
                .next()
                .find('.user-wall-count-words')
                .children('span')
                .text($(this).val().length);
        });

        $(this)
            .parent().parent()
            .find('.user-wall-control')
            .find('.label-type-send')
            .animate({'opacity': 0.8}, 500);

        var isCtrl = false;

        $(this).on('keydown', function (e) {
            if (e.which == 17) isCtrl = true;
        }).on('keyup', function (e) {
            if (e.which == 17) isCtrl = false;

            if (e.which == 13 && isCtrl) {
                wall_posts.add_post($('.user-wall-control .btn'));

                isCtrl = false;
            }
        });
    }).focusout(function () {
        $(this)
            .parent().parent()
            .find('.label-type-send')
            .animate({'opacity': 0}, 500);
    });

    $('.user-wall-post .btn-group').mouseenter(function () {
        if ($(this).find('.dropdown-menu').hasClass('opened')) return;

        $(this)
           .find('.dropdown-menu')
           .css({'opacity': 0, 'margin-top': '20px'})
           .show()
           .addClass('opened')
           .animate({'opacity': 1, 'margin-top': '0'}, 200);
    }).mouseout(function () {
        var elem = $(this);

        setTimeout(function () {
            if ($(elem).is(':hover')) return;

            $(elem)
                .find('.dropdown-menu')
                .animate({'opacity': 0, 'margin-top': '20px'}, 100, '', function () {
                    $(elem)
                        .find('.dropdown-menu')
                        .removeClass('opened')
                        .removeAttr('style');
                });
        }, 300);
    });

    /**
     *  Button Anketa Edit & Save
     */
    $('.user-anketa .btn-edit, .user-anketa .btn-save').on('click', function () {
        if ($(this).hasClass('btn-edit')) {
            $('.user-info-row span[data-type]').each(function () {
                var type = $(this).attr('data-type');

                if (type == 'select') {
                    /* Ajax */
                    var options = '<option value="0">Выберите город</option><option value="1" selected>' + $(this).text() + '</option>';

                    $(this)
                        .parent()
                        .append('<select class="form-control">' + options + '</select>')
                        .find('span[data-type]')
                        .remove();
                } else {
                    $(this)
                        .parent()
                        .append('<input class="form-control" type="' + type + '" value="' + $(this).text() + '" />')
                        .find('span[data-type]')
                        .remove();
                }
            });

            $(this)
                .removeClass('btn-edit')
                .addClass('btn-save')
                .removeClass('btn-info')
                .addClass('btn-success')
                .find('span')
                .removeClass('glyphicon-pencil')
                .addClass('glyphicon-floppy-disk');
        } else if ($(this).hasClass('btn-save')) {
            $('.user-info-row input').each(function () {

                /* Ajax Save */

                $(this)
                    .parent()
                    .append('<span data-type="' + $(this).attr('type') + '">' + $(this).val() + '</span>')
                    .find('input')
                    .remove();
            });

            $('.user-info-row select').each(function () {

                /* Ajax Save */

                $(this)
                    .parent()
                    .append('<span data-type="select">' + $(this).find('option:selected').text() + '</span>')
                    .find('select')
                    .remove();
            });

            $(this)
                .removeClass('btn-save')
                .addClass('btn-edit')
                .removeClass('btn-success')
                .addClass('btn-info')
                .find('span')
                .removeClass('glyphicon-floppy-disk')
                .addClass('glyphicon-pencil');
        }
    });
});