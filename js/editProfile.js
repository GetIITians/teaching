$(function () {
	$(document).on('click','#editProfileLink', function(event) {
		event.preventDefault();
		var subject 	=	helpers.checkboxValue('#editSubject');
		var grade 		=	helpers.checkboxValue('#editGrade');
		var lang 		=	helpers.checkboxValue('#editLanguage');
		var name 		=	helpers.inputValue('#editName');


		console.log(subject);
		console.log(grade);
		console.log(lang);
		console.log(name);
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