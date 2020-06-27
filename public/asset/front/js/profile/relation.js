$(document).ready(function() {
	
	$('.people-outside').on('click', '.del-relation', function(){
		if (confirm("Вы действительно хотите удалить пользователя «"+$(this).parent().parent().find('a').text()+"» из связей?")) {
			$(this).parent().parent().remove();
			$.get(baseurl+"profile/ajax_del_relation/"+$(this).attr("r_id"));
			relation_count = parseInt($('#relation_count').text());
			$('#relation_count').text(relation_count-1);
		}
		return false;
	});
	
	$("#search").bind('keyup', function(){
		$(".people-frame").empty();
		$(".people-frame").append('<p style="text-align:center;"><br><br><img src="/application/views/front/images/ajax-loader.gif" /></p>');
		$.ajax({
			type: "POST",
			url: baseurl+"profile/ajax_search_relation",
			data: {
				'status': $('input[name=status]:checked').val(),
				'search_word': $("#search").val(),
				//'<?= $this->security->get_csrf_token_name() ?>' : $.cookie('<?= config_item('csrf_cookie_name') ?>')
			},
			dataType: "html",
			success: function(msg){
				$(".people-frame").empty();
				$(".people-frame").append(msg);
			}
		});
	});
	
	
	$('input[name=status]').click(function(){
		if($('input[name=status]:checked').val() == "online") {
			status = "online";
		} else {
			status = "";		
		}
			$(".people-frame").empty();
			$(".people-frame").append('<p style="text-align:center;"><br><br><img src="/application/views/front/images/ajax-loader.gif" /></p>');
			$.ajax({
				type: "POST",
				url: baseurl+"profile/ajax_search_relation",
				data: {
					'status': status,
					'search_word': $("#search").val(),
					//'<?= $this->security->get_csrf_token_name() ?>' : $.cookie('<?= config_item('csrf_cookie_name') ?>')
				},
				dataType: "html",
				success: function(msg){
					$(".people-frame").empty();
					$(".people-frame").append(msg);
				}
			});	  

	});
	

});