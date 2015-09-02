var helpers = {
	setStorage : function(key,value){
		localStorage.setItem(key,JSON.stringify(value));
	},
	getStorage : function(key){
		return JSON.parse(localStorage.getItem(key));
	},
	isElementInViewport : function(elem){
		var $elem = $(elem);

		// Get the scroll position of the page.
		var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
		var viewportTop = $(scrollElem).scrollTop();
		var viewportBottom = viewportTop + $(window).height();

		// Get the position of the element on the page.
		var elemTop = Math.round( $elem.offset().top );
		var elemBottom = elemTop + $elem.height();

		return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
	}
}

var landingPageTab = {
	icon     : $('#landingPageTab .closeIcon i'),
	demo     : { state : true, done  : false },
	fontSize : function(){
		var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
		if (width < 767)
			return '2rem';
		return '3rem';
	},
	//state = current state of Landing Page Tab {true:open,false:close}
	toggleState : function(e){
		$(this).next('.content').toggle(100);
		if(helpers.getStorage('demo').state){
			//closing
			$(this).find('i').animate({'font-size': '2rem'}, 100);
			$(this).find('i').css({'transform': 'rotate(45deg)'});
		}else{
			//opening
			$(this).find('i').animate({'font-size': landingPageTab.fontSize()}, 100);
			$(this).find('i').css({'transform': 'rotate(90deg)'});
		}
		landingPageTab.demo.state = !landingPageTab.demo.state;
		helpers.setStorage('demo',landingPageTab.demo);
	},
	siteWide : function(){
		landingPageTab.icon.parent().next('.content').hide();
		landingPageTab.icon.css({'transform': 'rotate(45deg)','font-size': '2rem'});
		landingPageTab.demo.state = false;
		helpers.setStorage('demo',landingPageTab.demo);
	},
	profileTabContent : function(){
		// This function is called @ main.js::287, in the function booktopic
		landingPageTab.icon.parent().next('.content').find('span').html('Step 3&nbsp;:&nbsp;Select a time slot for your free class of 1 Hour');
	}
}

var homePage = {
	animationDone : false,
	checkAnimation : function(){
		var $elem = $('#numbers');
		if ($elem.length !== 0) {
			if (helpers.isElementInViewport($elem.find('ul'))) {
				// Start the animation
				$elem.find('.count').each(function () {
					$(this).prop('Counter',0).animate({
						Counter: $(this).data('count')
					}, {
						duration: 2000,
						easing: 'swing',
						step: function (now) {
							var numbers = Math.ceil(now).toString().split('');
							var html = '';
							for (var i = 0; i < numbers.length; i++) {
								html += '<li>'+numbers[i]+'</li>';
							}
							$(this).html(html);
						},
						done: function (){
							homePage.animationDone = true;
						}
					});
				});
			}
		}

	}
}

var adminPage = {
	approve : function(event,obj){
		event.preventDefault();
		$(obj).addClass('disabled');
		$.ajax({
			url		: 'http://localhost/teaching/approve_review',
			type	: 'POST',
			data 	: {
						tid			: 	obj.getAttribute('tid'),
						starttime 	: 	obj.getAttribute('starttime'),
			},
			success: function(msg){
				$(obj).removeClass('disabled').addClass('btn-success').html('Approved');
				$(obj).parent().next().find('i').html('done');
				console.log(msg);
			} 
		})
	}
}

$(function() {

	$(document).on({
		// Handles the mouseover
		mouseenter: function() {
			$(this).prevAll().andSelf().removeClass('glyphicon-star-empty');
			$(this).prevAll().andSelf().addClass('glyphicon-star');
		},
		// Handles the mouseout
		mouseleave: function() {
			$(this).nextAll().andSelf().removeClass('glyphicon-star'); 
			$(this).nextAll().andSelf().addClass('glyphicon-star-empty');
		}
	},'.rating-system span');

	$(document).on('click','.rating-system span', function() {
		var rating_system 		= 	$(this).parent();	//specific
		var rating_value_div	= 	rating_system.next('.rating-value');	//specific
		var user_id				= 	rating_system.data('uid');
		var teacher_id 			= 	rating_system.parent().data('tid');	//specific
		var previous_rating		= 	rating_system.attr('previousRating');
		var rating_id			= 	rating_system.attr('ratingId');
		var rating_count		= 	rating_value_div.attr('count');
		var rating_avg			= 	rating_value_div.attr('value');

		$.ajax({
			url		: set_url(),
			type	: 'POST',
			data 	: {
						previous_rating	: 	previous_rating,// changed
						rating 			: 	$(this).data('number'),
						rating_count	: 	rating_count,// changed
						rating_avg		: 	rating_avg,
						tid 			: 	teacher_id,
						uid 			: 	user_id,
						rating_id 		: 	rating_id
			},
			success: function(msg){
				update_card_reveal(msg);
			} 
		})
	});

	function set_url() {
		var url 		 	 = window.location.href.replace("search","rating");
		if (url.indexOf('?q=') != -1)
			url = url.slice(0,url.indexOf('?q='));
		return url;
	};

	function toType(obj) {
		return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
	};

	function update_card_reveal(msg){
		var info = JSON.parse(msg);
		var father = $('.rating[data-tid="'+info.tid+'"]');
		father.find('.rating-system').attr('previousRating',info.previous_rating);
		father.find('.rating-system').attr('ratingId',info.rating_id);
		father.find('.rating-value').attr('count',info.rating_count);
		father.find('.rating-value').attr('value',info.rating_avg);
		var plural = (info.rating_count == 1) ? 'rating' : 'ratings';
		father.find('.rating-value').html('<p>'+info.rating_avg+'<span>('+info.rating_count+plural+')</span>'+'</p>');
		update_card_content(msg);
	};

	function update_card_content(msg){
		var info = JSON.parse(msg);
		var father = $('.rating[data-tid="'+info.tid+'"]').parent().prev().find('.contentrating');

		var updateHTML = 'Rating: ';
		for (var i = 1; i < 6; i++) {
			if(i <= info.previous_rating)
				updateHTML += '<span class="glyphicon glyphicon-star rated-star" aria-hidden="true"></span>';
			else
				updateHTML += '<span class="glyphicon glyphicon-star-empty rating-star" aria-hidden="true"></span>';
		};
		father.html(updateHTML);
	};

	$(document).on({mouseleave:function() {
		var current_rating = parseInt($(this).attr('previousRating'),10);
		$(this).find('span').each(function(index){
			$(this).removeClass();
			if (index < current_rating) {
				$(this).addClass('glyphicon glyphicon-star rated-star');
			}else{
				$(this).addClass('glyphicon glyphicon-star-empty rating-star');
			}
		});
	}},'.rating-system');

	$(document).on({mouseenter: function() {
		$(this).find('span').each(function(index){
			$(this).removeClass();
			$(this).addClass('glyphicon glyphicon-star-empty rating-star');
		});
	}},'.rating-system');

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

	/* Teacher Rating detail box on search page */
	$('#ratingBigBox').hide();
	$(document).on({
		// Handles the mouseover
		mouseenter: function() {
			//console.log('hovered bitch!');
			var ratingLeft   = $(this).position().left + $(this).outerWidth()+11;
			var ratingTop    = $(this).position().top + Math.floor($(this).outerHeight()/2);
			var ratingBigBox = $(this).closest('.teacherlistelm').next('#ratingBigBox');
			var netHeight 	 = ratingTop-Math.floor(ratingBigBox.outerHeight()/2)

			if ($(document).outerWidth() < ($(this).offset().left+$(this).outerWidth()+400))
			{
				ratingLeft = -(ratingBigBox.outerWidth()-4);
				ratingBigBox.find('.arrow').addClass('arrowRight');
			}
			else
			{
				ratingBigBox.find('.arrow').addClass('arrowLeft');
			}
			ratingBigBox.css({top: netHeight, left: ratingLeft});
			ratingBigBox.show(200);
		},
		// Handles the mouseout
		mouseleave: function() {
			var ratingBigBox = $(this).closest('.teacherlistelm').next('#ratingBigBox');
			ratingBigBox.find('.arrow').removeClass().addClass('row arrow');
			ratingBigBox.hide(100);
		}
	},'.contentrating');


	var demo = helpers.getStorage('demo');
	// if(first time user)
	if (demo === null) {
		helpers.setStorage('demo',landingPageTab.demo);
		$(document).on('click','#landingPageTab .closeIcon', landingPageTab.toggleState);
		$('#landingPageTab').show();
	}
	// else if (repeat user)
	else {
		// if(Not taken demo class)
		if (!demo.done) {
			$(document).on('click','#landingPageTab .closeIcon', landingPageTab.toggleState);
			// If (user has hidden the demo popup)
			if (!demo.state) {
				landingPageTab.siteWide();
			}
			$('#landingPageTab').show();
		};
	};

	$(window).scroll(function(){
		if (!homePage.animationDone)
			homePage.checkAnimation();
	});

});