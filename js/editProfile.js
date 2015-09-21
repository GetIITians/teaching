var profileEdit = {
	checkboxValue : function(id) {
		temp = $(id).find('input:checkbox:checked').map(function() {
			return this.name;
		}).get();
		return temp;
	},
	inputValue : function(id) {
		temp = $(id).find('input').map(function() {
			return this.value;
		}).get();
		return temp;
	}
}

$(function () {
	$(document).on('click','#editProfileLink', function(event) {
		event.preventDefault();
		var subject 	=	profileEdit.checkboxValue('#editSubject');
		var grade 		=	profileEdit.checkboxValue('#editGrade');
		var lang 		=	profileEdit.checkboxValue('#editLanguage');
		var name 		=	profileEdit.inputValue('#editName');


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