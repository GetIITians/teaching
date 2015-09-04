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

/* Scroll to top Button on search page */
if (window.location.href.indexOf("/search") > -1) {
	$('#top_arrow').hide();
	var scroll_offset = 0;
	var sideBar = $('#sideBar').offset().top+$('#sideBar').outerHeight();
	$(document).scroll(function () {
		if ($(this).scrollTop() > sideBar) {
			$('#top_arrow').fadeIn();
		} else {
			$('#top_arrow').fadeOut();
		}
	});

	$('#top_arrow').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
}

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

$(function () {
	$(document).ready(function() {
		$(document).on({
			// Handles the mouseover
			mouseenter: function() {
				if ($(this).find('.card-reveal').length) {
					$(this).find('.card-reveal').css({ display: 'block'}).velocity("stop", false).velocity({translateY: '-100%'}, {duration: 500, queue: false, easing: 'easeInOutQuad'});
				};
			},
			// Handles the mouseout
			mouseleave: function() {
				$(this).find('.card-reveal').velocity(
					{translateY: 0}, {
						duration: 325,
						queue: false,
						easing: 'easeInOutQuad',
						complete: function() { $(this).css({ display: 'none'}); }
					}
				);
			}
		},'.card.teacherlistelm');
	});
});
