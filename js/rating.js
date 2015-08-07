$(function() {

	$('.rating-system span').hover(
		// Handles the mouseover
		function() {
			$(this).prevAll().andSelf().removeClass('glyphicon-star-empty');
			$(this).prevAll().andSelf().addClass('glyphicon-star');
		},
		// Handles the mouseout
		function() {
			$(this).nextAll().andSelf().removeClass('glyphicon-star'); 
			$(this).nextAll().andSelf().addClass('glyphicon-star-empty');
		}
	);

	$('body').on('click','.rating-system span', function() {
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
				update_data(msg);
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

	function update_data(msg){
		var info = JSON.parse(msg);
		var father = $('.rating[data-tid="'+info.tid+'"]');
		father.find('.rating-system').attr('previousRating',info.previous_rating);
		father.find('.rating-system').attr('ratingId',info.rating_id);
		father.find('.rating-value').attr('count',info.rating_count);
		father.find('.rating-value').attr('value',info.rating_avg);
		if (father.find('.rating-value').find('p').length !== 0) {
			father.find('.rating-value').html('<p>'+info.rating_avg+'</p>');
		}else if (info.previous_rating != 0) {
			father.find('.rating-value').html('<p>'+info.rating_avg+'</p>');
		};
	};

	$( ".rating-system" ).mouseout(function() {
		var current_rating = parseInt($(this).attr('previousRating'),10);
		$(this).find('span').each(function(index){
			$(this).removeClass();
			if (index < current_rating) {
				$(this).addClass('glyphicon glyphicon-star rated-star');
			}else{
				$(this).addClass('glyphicon glyphicon-star-empty rating-star');
			}
		});
	});

	$( ".rating-system" ).mouseenter(function() {
		$(this).find('span').each(function(index){
			$(this).removeClass();
			$(this).addClass('glyphicon glyphicon-star-empty rating-star');
		});
	});
});