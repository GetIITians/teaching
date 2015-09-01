$('#dob_datepicker').pickadate({
	selectMonths: true,
	selectYears: 65,
	min: [1950,01,01],
	max: true
});

$("#specify_sub_other").hide();
$("#specify_deg_other").hide();
$("#specify_survey_other").hide();

$("#otp_section").hide();

function specifySubOther() {
	$("#specify_sub_other").slideToggle(500);
}

function specifySurveyOther() {
	$("#specify_survey_other").slideToggle(500);
}

function specifyDegOther() {
	var selected_degree = $("#degree option:selected").val();
	if (selected_degree == "other") {
		$("#specify_deg_other").slideToggle(500);
	}
	else {
		$("#specify_deg_other").slideUp(500);
	}
}

function ageToTime(obj) {
	var d = new Date();
	var n1 = d.getFullYear(); 
	var d = new Date(obj.value);
	var n2 = d.getFullYear(); 
	$("#times").html(String(n1 - n2) + " yrs");
}

function openOtpSection() {
	$("#otp_section").slideDown();
	$("#main_form_section").slideUp();
}
