$(function() {

	$(".slider").owlCarousel({
		items : 1,
		autoplay : true,
		loop: true,
		nav: true,
		dots: true,
		navText : "",
		autoplayHoverPause : true,
		fluidSpeed : 600,
		autoplaySpeed : 600,
		navSpeed : 600,
		dotsSpeed : 600,
		dragEndSpeed : 600
	});


	$(".showtext").click(function() {
	if ( jQuery(".about .text-container").css( "height" ) == "200px" ) {
		$(".about .text-container").css("-webkit-mask-image", "none");
		$(".about .text-container").css("height", "100%")
		$(".showtext").text('Скрыть текст');
	} else {
		$(".about .text-container").css("height", "200px");
		$(".about .text-container").css("-webkit-mask-image", "-webkit-linear-gradient(top,#fff 0,rgba(255,255,255,0) 100%)");
		$(".showtext").text('Подробнее о нас');
	}
	});

	$(".show-more a").click(function() {
	if ( jQuery(".news-hidden").css( "display" ) == "none" ) {
		$(".news-hidden").css("display", "block");
		$(".show-more a").text('Скрыть новости');
	} else {
		$(".news-hidden").css("display", "none");
		$(".show-more a").text('Показать ещё новости');
	}
	});
        
        $('#datetimepicker12').datetimepicker({
                inline: true,
                sideBySide: true,
                format: "L",
                locale: "ru"
         });
         
         $('.selectpicker').selectpicker('show');
		 $('.selectpicker').selectpicker({
		 	dropupAuto: false
		 });
		 

});