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

	/* Top Floating Button */
	var scroll_offset = 0;
	var sideBar = $('#sideBar').offset().top+$('#sideBar').outerHeight();
	$('#top_arrow').hide();
	$(document).scroll(function() {
		scroll_offset = $(this).scrollTop();
		//console.log('you scrolled ' + scroll_offset + 'px & the sidebar is at ' + sideBar + 'px');
		if (scroll_offset > sideBar) {
			$('#top_arrow').show();
		}
		else if (scroll_offset <= sideBar) {
			$('#top_arrow').hide();
		}
	});

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
			console.log($(this).offset().left);
		},
		// Handles the mouseout
		mouseleave: function() {
			var ratingBigBox = $(this).closest('.teacherlistelm').next('#ratingBigBox');
			ratingBigBox.find('.arrow').removeClass().addClass('row arrow');
			ratingBigBox.hide(100);
		}
	},'.contentrating');

});