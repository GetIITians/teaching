var admin = {
	order:['asc','desc']
}

$(function () {
	$('#asc, #desc').change(function() {
		if ($(this).is(':checked')) {
			for(ids in admin.order){
				if (admin.order[ids] != ($(this)[0].id)) {
					$('#'+admin.order[ids]).prop('checked', false);
				};
			}
		};
	});

	$('#per_page, #orderby, #asc, #desc').change(function() {
		$('#adminForm').submit();
	});


	// change orderbyoption label value on change
});