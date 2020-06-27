$(function() {
    var owidth_document = $(document).outerWidth();
    $('#menu a[href="'+window.location.href+'"]').parent().addClass('active');
    $('.filter-btn').click(function () {
        var filter_btn 	= this;
        var page_search = $(filter_btn).parent().find('.page-search');
        var name_filter = $(page_search).children('.name-filter');
        if (!$(page_search).hasClass('close-filters')) {
            $(page_search).find('div[class$="item"]:not([class~="name-filter"])').hide(200, function () {
                $(page_search).addClass('close-filters');
                $(name_filter).animate({width: "100%"}, 200);
                $(filter_btn).text('Открыть фильтр');
                $('.ufilter[name="uname"]').css('padding', '9px 11px 8px').css('border','1px solid #D0DE87')
                $('.ufilter[name="serch_by_name"]').css('padding', '9px 11px 8px').css('border','1px solid #D0DE87')
            });
        } else {
            if ($(document).width() >= 768) {
                $(name_filter).animate({
                    width: $(name_filter).hasClass('col-sm-3') ? "25%"
                        : ($(name_filter).hasClass('col-sm-6') ? "50%" : "0%")
                }, 200, callback_animate);
            } else {
                callback_animate();
            }
            function callback_animate() {
                $(page_search).removeClass('close-filters');
                $(page_search).find('div[class$="item"]:not([class~="name-filter"])').show(200);
                $(filter_btn).text('Закрыть фильтр');
                $('.ufilter[name="uname"], .ufilter[name="serch_by_name"]').css('padding', 0).css('border','none')
            }
        }
    });
    $('.filter-btn-3').click(function () {
        var filter_btn 	= this;
        var page_search = $(filter_btn).parent().find('.page-search');
        var name_filter = $(page_search).children('.name-filter');
        if (!$(page_search).hasClass('close-filters')) {
            $(page_search).find('div[class$="item"]:not([class~="name-filter"])').hide(200, function () {
                $(page_search).addClass('close-filters');
                $(name_filter).animate({width: "100%"}, 200);
                $(filter_btn).text('Открыть фильтр');
                $('.ufilter[name="serch_by_name"]').css('padding', '9px 11px 8px').css('border','1px solid #D0DE87')
            });
        } else {
            if ($(document).width() >= 768) {
                $(name_filter).animate({
                    width: $(name_filter).hasClass('col-sm-3') ? "33%"
                        : ($(name_filter).hasClass('col-sm-6') ? "50%" : "0%")
                }, 200, callback_animate);
            } else {
                callback_animate();
            }

            function callback_animate() {
                $(page_search).removeClass('close-filters');
                $(page_search).find('div[class$="item"]:not([class~="name-filter"])').show(200);
                $(filter_btn).text('Закрыть фильтр');
                $('.ufilter[name="serch_by_name"]').css('padding', 0).css('border','none')
            }
        }
    });
    $(".slider").owlCarousel({
        items: 1,
        autoplay: true,
        loop: true,
        nav: true,
        dots: true,
        navText: "",
        autoplayHoverPause: true,
        fluidSpeed: 600,
        autoplaySpeed: 600,
        navSpeed: 600,
        dotsSpeed: 600,
        dragEndSpeed: 600
    })
    if (owidth_document > 768) {
        $(".main-menu > li").hover(
            function() {
                $('.dropdown-menu', this).fadeIn("fast");
            },
            function() {
                $('.dropdown-menu', this).fadeOut("fast");
            }
        );
    };
    $(".show-more a").click(function() {
        if ( jQuery(".news-hidden").css( "display" ) == "none" ) {
            $(".layer").addClass("layer-visible");
            $(".news-hidden").css("display", "block");
            $(".show-more a").text('Скрыть новости');
        } else {
            $(".layer").removeClass("layer-visible");
            $(".news-hidden").css("display", "none");
            $(".show-more a").text('показать ещё');
        }
    });
    $(".showtext").click(function() {
        if ( jQuery(".about .text-container").css( "height" ) == "200px" ) {
            $(".about .text-container").css("-webkit-mask-image", "none");
            $(".about .text-container").css("height", "100%")
            $(".showtext").text('Скрыть текст');
        } else {
            $(".about .text-container").css("height", "200px");
            $(".about .text-container").css("-webkit-mask-image", "-webkit-linear-gradient(top,#fff 0,rgba(255,255,255,0) 100%)");
            $(".showtext").text('Показать текст');
        }
    });
    $('#datepick').datetimepicker({useCurrent: true,format: "L",locale: "ru"});
    $('#birthdatepick').datetimepicker({format: "L",locale: "ru"});
    $('.selectpicker').selectpicker('show');
    $('.selectpicker').selectpicker({dropupAuto: false});
    $('#revModal').modal();
    $tabHeight = $('.tab-content .content-block').outerHeight();
    $('#column-left, #column-left.active').css('height', $tabHeight+'px');
});