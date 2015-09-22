$(function () {
	$(document).on('click','#editProfileLink', function(event) {
		event.preventDefault();

		var ids = {
			'editSubject' : 'input:checkbox:checked',
			'editGrade' : 'input:checkbox:checked',
			'editLanguage' : 'input:checkbox:checked',
			'editName' : 'input',
			'editDob'  : 'input'
		};
		for(id in ids) {
			ids[id] = helpers.inputsValueArray('#'+id,ids[id]);
		}

		console.log(ids);
		/*
		$.ajax({
			url		: HOST+'profile/edit',
			type	: 'POST',
			data 	: {
						sub 	:	subject
			},
			success: function(msg){
				console.log(msg);
			} 
		})
		*/
	});
});