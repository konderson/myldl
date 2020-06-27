(function($) {
    $.fn.simplePopup = function() {
        // выравнивание по центру
        $.fn.center = function() {
            var popupMarginLeft = -this.width()/2;
            return this.css('margin-left', popupMarginLeft);
        }
        // общая функция скрытия
        function hide() {
			//----
			$('.comments-del-btn-yes').attr({'href':'#'});  //удалем URL из кнопки удаления коммента
			$('.popup-body, .popup').fadeOut(300, function () {
				$('.comments-del-title').text('#');  //обнуляем загаловок
				$('.comments-del-btn-yes').text('#');  //обнуляем название кнопки 
			});
			//----
//            $('.popup-body, .popup').fadeOut(300, 0);
        }
        // закрытие по клавише Esc
        $('body').keyup(function(e) {
            if (e.keyCode == 27) {
                hide();
            }
        });
        // закрытие по фону и по крестику
        $('.popup-body, .popup-close').click(function() {
            hide();
            return false;
        });
        return this.each(function() {
            $(this).click(function() {
                $(".popup-body").fadeTo(300, 0.7);
                $(".popup").center().fadeTo(300, 1);
                return false;
            });
        });
    }
})(jQuery);