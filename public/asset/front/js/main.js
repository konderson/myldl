/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2006, 2014 Klaus Hartl
 * Released under the MIT license
 */
!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?module.exports=e(require("jquery")):e(jQuery)}(function(m){var i=/\+/g;function x(e){return v.raw?e:encodeURIComponent(e)}function g(e,n){var o=v.raw?e:function(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(i," ")),v.json?JSON.parse(e):e}catch(e){}}(e);return m.isFunction(n)?n(o):o}var v=m.cookie=function(e,n,o){if(1<arguments.length&&!m.isFunction(n)){if("number"==typeof(o=m.extend({},v.defaults,o)).expires){var i=o.expires,r=o.expires=new Date;r.setMilliseconds(r.getMilliseconds()+864e5*i)}return document.cookie=[x(e),"=",(t=n,x(v.json?JSON.stringify(t):String(t))),o.expires?"; expires="+o.expires.toUTCString():"",o.path?"; path="+o.path:"",o.domain?"; domain="+o.domain:"",o.secure?"; secure":""].join("")}for(var t,c,u=e?void 0:{},s=document.cookie?document.cookie.split("; "):[],a=0,d=s.length;a<d;a++){var p=s[a].split("="),f=(c=p.shift(),v.raw?c:decodeURIComponent(c)),l=p.join("=");if(e===f){u=g(l,n);break}e||void 0===(l=g(l))||(u[f]=l)}return u};v.defaults={},m.removeCookie=function(e,n){return m.cookie(e,"",m.extend({},n,{expires:-1})),!m.cookie(e)}});


$(document).ready(function(){
    $(".selectb").selectBoxIt({
        autoWidth: false
    });
    $(document).on('change', 'select', function () {
        $(this).data("selectBox-selectBoxIt").refresh();
    });
    $('#menu a[href="'+window.location.href+'"]').parent().addClass('selected-li');

	$('.burger').on('click', function(){
		$('#mobile-nav').toggleClass("display");
	});

	var owl_dela = $('#owl-dela').owlCarousel({
	    margin:15,
	    nav:false,
	    items:2,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        }
	    }
	});
	$('#owl-dela-left').click(function(event) {
		owl_dela.trigger('next.owl.carousel');
	});
	$('#owl-dela-right').click(function(event) {
		owl_dela.trigger('prev.owl.carousel');
	});


	var search_person = $('#owl-search-person').owlCarousel({
	    margin:12,
	    nav:false,
	    items: 3,
	    responsive:{
	        0:{
	            items:1
	        },
	        1020:{
	            items:3
	        }
	    }
	});
	$('#owl-search-person-left').click(function(event) {
		search_person.trigger('next.owl.carousel');
	});
	$('#owl-search-person-right').click(function(event) {
		search_person.trigger('prev.owl.carousel');
	});


    window.owl_person = $('#owl-person').owlCarousel({
        margin:12,
        nav:false,
        items: 6,
        responsive:{
            0:{
                items:3
            },
            530:{
                items:4
            },
            730:{
                items:5
            },
            1020:{
                items:7
            },
            1600:{
                items:9
            }
        }
    });
    $(document).on('click', '#owl-person-left', function(event) {
        window.owl_person.trigger('prev.owl.carousel');
    });
    $(document).on('click', '#owl-person-right', function(event) {
        window.owl_person.trigger('next.owl.carousel');
    });
	
	window.owl_person_need_help = $('#owl-person-need_help').owlCarousel({
        margin:12,
        nav:false,
        items: 6,
        responsive:{
            0:{
                items:3
            },
            530:{
                items:4
            },
            730:{
                items:5
            },
            1020:{
                items:7
            },
            1600:{
                items:9
            }
        }
    });

    $(document).on('click', '#owl-person-left-need_help', function(event) {
        window.owl_person_need_help.trigger('prev.owl.carousel');
    });
    $(document).on('click', '#owl-person-right-need_help', function(event) {
        window.owl_person_need_help.trigger('next.owl.carousel');
    });

    window.owl_person_want_help = $('#owl-person-want_help').owlCarousel({
        margin:12,
        nav:false,
        items: 6,
        responsive:{
            0:{
                items:3
            },
            530:{
                items:4
            },
            730:{
                items:5
            },
            1020:{
                items:7
            },
            1600:{
                items:9
            }
        }
    });

    $(document).on('click', '#owl-person-left-want_help', function(event) {
        window.owl_person_want_help.trigger('prev.owl.carousel');
    });
    $(document).on('click', '#owl-person-right', function(event) {
        window.owl_person_want_help.trigger('next.owl.carousel-want_help');
    });


    var owl_similar_adv = $('#owl-similar-adv').owlCarousel({
        margin:12,
        nav:false,
        items: 4,
        responsive:{
            0:{
                items:1
            },
            800:{
                items:2
            },
            980:{
                items:3
            },
			1180: {
            	items: 4
            }
        }

    });
    $('#owl-similar-adv-left').click(function() {
        owl_similar_adv.trigger('next.owl.carousel');
    });
    $('#owl-similar-adv-right').click(function() {
        owl_similar_adv.trigger('prev.owl.carousel');
    });


    var owl_uchasniki = $('#owl-uchasniki').owlCarousel({
        margin:12,
        nav:false,
        items: 9,
        responsive:{
            0:{
                items: 2
            },
            570:{
                items: 3
            },
            727:{
                items: 4
            },
            1024: {
                items: 6
            },
            1366:{
                items: 9
            }
        }
    });
    $('#owl-uchasniki-left').click(function(event) {
        owl_uchasniki.trigger('next.owl.carousel');
    });
    $('#owl-uchasniki-right').click(function(event) {
        owl_uchasniki.trigger('prev.owl.carousel');
    });

	// Лайк/Дизлайк
	$('.like, .dislike').on('click', function() {
        var obj_like = $(this);
		$.ajax({
			type: "POST",
			url: baseurl+'ajax/ajax_likes',
			data: {
                hash_token_id : $.cookie('hash_cookie_id'),
                section_id : obj_like.attr('section_id'),
                post_id : obj_like.attr('post_id'),
                like_type : (obj_like.hasClass('like') ? '1' : '0')
            },
			async: false,
			dataType: "html",
			success: function(msg) {
                if (msg === "y")
                    obj_like.next().text(parseInt(obj_like.next().text()) + 1);
                else if (msg === "n")
                    alert('Вы уже проголосовали ранее');
                else if (msg === "error")
                    alert('Ошибка');
			}
		});
	});

    //Login popup
    $('#login-btn').click(function (e) {
        e.preventDefault();
        $('#login-popup').addClass('show');
    });
    //Login popup
    $('#login-btn2').click(function (e) {
        e.preventDefault();
        $(this).addClass('show');
        $('#login-popup2').addClass('show');
    });
    $('#login-btn3').click(function (e) {
        e.preventDefault();
        $(this).addClass('show');
        $('#login-popup3').addClass('show');
    });
    
    $(document)
        .click(function (e) {
            if (!($(e.target).hasClass('login-popup') || $(e.target).parents('.login-popup').length)) {
                var id = $(e.target).attr('id');
                if (id === 'login-btn2' || id === 'login-btn') {
                    return;
                }
                $('.login-popup').removeClass('show');
            }
        })
        .click(function (e) {
            if (!($(e.target).hasClass('login-popup2') || $(e.target).parents('.login-popup2').length)) {
                var id = $(e.target).attr('id');
                if (id === 'login-btn2' || id === 'login-btn') {
                    return;
                }
                $('.login-popup2, #login-btn2').removeClass('show');
            }
        })
        .click(function (e) {
            if (!($(e.target).hasClass('login-popup3') || $(e.target).parents('.login-popup3').length)) {
                var id = $(e.target).attr('id');
                if (id === 'login-btn3' || id === 'login-btn2') {
                    return;
                }
                $('.login-popup3, #login-btn3').removeClass('show');
            }
        });

    
    
    $('section .advert .left .advert-body .advert-search-row .filter').click(function () {
        $('.advert-search-row').addClass('open-filters');
    });
    $('section .advert .left .advert-body .advert-search-row .close').click(function () {
        $('.advert-search-row').removeClass('open-filters');
    });

    $('#show_more2').click(function () {
        var t = $(this);
        if (t.parent().hasClass('show')) {
            var text = 'Показать текст';
        } else {
            var text = 'Скрыть текст';
        }

        t.parent().toggleClass('show');
        t.text(text);
    });
});