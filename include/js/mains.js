$(document).ready(function() {
	$('.btnvote').click(function() { 
		var id = $(this).data("cid");
		var fullname = $(this).data("fullname");

		$('#fullname').text(fullname);
		$('#candidate-id').val(id);
		$('#myModals').removeClass('close');
		$('#myModals').removeClass('d-none');
		$('#myModals').addClass('open');

	})


	

	$('#close').click(function() { 
		$('#myModals').removeClass('open');
		$('#myModals').addClass('close');
		
	})


});