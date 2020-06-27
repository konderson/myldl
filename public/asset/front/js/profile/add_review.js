$(document).ready(function() {
	$("button.save").click(function() {
		error = 0;
		$('#tema, #subyect, #otziv').css("border-color", "#ddd");
		if(($('#tema').val() == '')||$('#tema').val().length<3) {
			$('#tema').css("border-color", "#D93600");
			error=1;
		}
		if($('#subyect').val() == '') {
			$('#subyect').css("border-color", "#D93600");
			error=1;
		}
		if($('#otziv').val() == '') {
			$('#otziv').css("border-color", "#D93600");
			error=1;
		}
		if(error == 0) {
			$('#form_edit_review').trigger('submit');
		}
	});
    
	$('#subyect').autocomplete({
	    lookup: users,
	    onSelect: function (suggestion) {
	        //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
	        $('input[name=is_user]').val(suggestion.data);
	    }
	});
});
