/* Top Floating Button */
var scroll_offset = 0;
var searchbar_offset = $('#main_search_bar').offset();
$('#top_arrow').hide();
$(document).scroll(function() {
	scroll_offset = $(this).scrollTop();
	if (scroll_offset > searchbar_offset.top) {
		$('#top_arrow').show();
	}
	else if (scroll_offset <= searchbar_offset.top) {
		$('#top_arrow').hide();
	}
});
/* Smooth In-Page Transitions */
$('a[href*=#]:not([href=#])').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {
			$('html,body').animate({
				scrollTop: target.offset().top
			}, 1000);
			return false;
		}
	}
});

var whyus_list_options = [
	{selector: '#whyus_list', offset: 0, callback: 'Materialize.showStaggeredList("#whyus_list");' }
];
Materialize.scrollFire(whyus_list_options);

$('.slider').slider({
	indicators: false,
	height: 100,
	transition: 500,
	interval: 8000
});

var options = {
		$AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
		$AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
		$AutoPlayInterval: 0,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
		$PauseOnHover: 4,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1
		$ArrowKeyNavigation: true,                    //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
		$SlideEasing: $JssorEasing$.$EaseLinear,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
		$SlideDuration: 2000,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
		$MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
		$SlideWidth: 120,                                   //[Optional] Width of every slide in pixels, default value is width of 'slides' container
		//$SlideHeight: 100,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
		$SlideSpacing: 12,                           //[Optional] Space between each slide in pixels, default value is 0
		$DisplayPieces: 10,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
		$ParkingPosition: 0,                              //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
		$UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
		$PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
		$DragOrientation: 1                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
};
var jssor_slider1 = new $JssorSlider$("slider1_container", options);
//responsive code begin

$(function() {
	$(document).on('click','#welcome a.submit', function(event) {
		event.preventDefault();
		var details = helpers.inputsNameValObject('#welcome',['input','textarea']);
		emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
		if (details["email"] == '' && !emailRegex.test(details["email"])) {
			$('#welcome .modal-footer p').html('Email ID is compulsory');
			return false;
		} else {
			$('#welcome .modal-footer p').html('');
			$('#welcome a.submit').html('Submitting').attr('disabled','disabled');
		}
		$.ajax({
			url		: HOST+'home/doubt',
			type	: 'POST',
			data 	: {
				content		:	JSON.stringify(details)
			},
			success: function(msg){
				console.log(JSON.parse(msg));
				$('#welcome a.submit').html('Submit').removeAttr('disabled');
				//$('#welcome').closeModal();
			},
			error: function(msg){
				console.log(JSON.parse(msg));
				$('#welcome a.submit').html('Submit').removeAttr('disabled');
			}
		})
	});
});