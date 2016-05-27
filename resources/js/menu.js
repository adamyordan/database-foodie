$(document).ready (function () {
	$('.pageNum').click(function (){
		$num = $(this).html();
		$('.page-active').removeClass('page-active');
		$('.active').removeClass('active');
		$('.page'+$num).addClass('page-active');
		$(this).parent().addClass('active');
	});

	$('.datePicker').datepicker({ dateFormat: 'dd/mm/yy'});
});