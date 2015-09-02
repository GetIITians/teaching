var sticker = $("#sticker_panel");
var pos_stk = sticker.position();
ms.refinecallafter();

/*
$(function() {
	$(document).on('click','#home1', function() {
		console.log(this);
	)};
		if ($('#home1').is(':checked')) {
			console.log($('#home1'));
			$('#homeTutionPinCode').show();
		};
});
*/
$(function() {
	$('#home1').click(function() {
		var $this = $(this);
		if ($this.is(':checked')) {
			// the checkbox was checked
			$('#homeTutionPinCode').show(500,'swing');
		} else {
			// the checkbox was unchecked
			$('#homeTutionPinCode').hide(200,'swing');
		}
	})
});