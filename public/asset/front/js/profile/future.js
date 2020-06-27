$(document).ready(function(){

	// удалить находку
	$('.del-fbusiness').click(function(){
		var count_f_business;
		if (confirm("Вы действительно хотите удалить будущее дело \""+$(this).parent().parent().parent().find('.f-name').text()+"\"?")) {
			$(this).parent().parent().parent().remove();
			$.get("/profile/del_future_business/"+$(this).attr("fbusiness_id"));
			count_f_business = parseInt($('#count_f_business').text());
			// a cruel workaround
			if (isNaN(count_f_business-1)) {
				count_f_business = 1;
			}
			$('#count_f_business').text('(' + count_f_business-1 + ')');
		}
		return false;
	});

});