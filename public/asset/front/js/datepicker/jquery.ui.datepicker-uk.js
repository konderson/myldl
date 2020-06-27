/* Ukrainian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Maxim Drogobitskiy (maxdao@gmail.com). */
/* Corrected by Igor Milla (igor.fsp.milla@gmail.com). */
jQuery(function($){
	$.datepicker.regional['uk'] = {
		closeText: '�������',
		prevText: '&#x3c;',
		nextText: '&#x3e;',
		currentText: '�������',
		monthNames: ['ѳ����','�����','��������','������','�������','�������',
		'������','�������','��������','�������','��������','�������'],
		monthNamesShort: ['ѳ�','���','���','��','���','���',
		'���','���','���','���','���','���'],
		dayNames: ['�����','��������','�������','������','������','�������','������'],
		dayNamesShort: ['���','���','��','���','���','���','���'],
		dayNamesMin: ['��','��','��','��','��','��','��'],
		weekHeader: '���',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['uk']);
});