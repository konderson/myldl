/**
 * ------------------------------------------------------------
 * LDL_Likes - живой лайковый функционал для сайта ЛДЛ (myldl.ru)
 * ------------------------------------------------------------
 * @version 1.1.04
 * @author  A.Almaz <me@devdiamond.com>
 * @copyright Almaz Allaberenov. All right reserved <me@devdiamond.com>
 */
var likes_baseUrl = window.location.protocol+'//'+window.location.host+'/';
//var likes_likeUrl = likes_baseUrl+'ajax/ajax_likes';
var likes_likeUrl = baseurl+'ajax/ajax_likes';

$(document).ready(function()
{
	// Лайк/Дизлайк
	$('.like, .dislike').on('click', function()
    {
        var obj_like = $(this);
		$.ajax({
			type: "POST",
			url: likes_likeUrl,
			data:
            {
                hash_token_id : $.cookie('hash_cookie_id'),
                section_id : obj_like.attr('section_id'),
                post_id : obj_like.attr('post_id'),
                like_type : (obj_like.hasClass('like') ? '1' : '0')
            },
			async: false,
			dataType: "html",
			success: function(msg)
            {
                if (msg === "y")
                    obj_like.text(parseInt(obj_like.text()) + 1);
                else if (msg === "n")
                    alert('Вы уже проголосовали ранее');
                else if (msg === "error")
                    alert('Ошибка');
			}
		});
	});

});
