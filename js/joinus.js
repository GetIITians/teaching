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

$(".display_other").hide();

function extraSpecifyOther(obj){
	other = ($(obj).val() == 'other') ? true : false ;
	if (other) {
		$(obj).next('.display_other').slideToggle(500);
	} else{
		$(obj).next('.display_other').slideUp(500);
	};
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


$(function() {
	var insertData = "<div id='hidden' style='display:none;'><div class='row'><div class='col-xs-12 col-md-4'><span class='grey-text text-darken-1'>College<span class='red-text'>*</span></span></div><div class='col-xs-12 col-md-8'><select name='ex_college[]' class='browser-default' data-condition='simple' onchange='extraSpecifyOther(this)'><option value='' disabled='disabled' selected='selected'>Select your IIT</option><option value='Bhubaneswar'>IIT Bhubaneswar</option><option value='Bombay'>IIT Bombay</option><option value='Delhi'>IIT Delhi</option><option value='Gandhinagar'>IIT Gandhinagar</option><option value='Guwahati'>IIT Guwahati</option><option value='Hyderabad'>IIT Hyderabad</option><option value='Indore'>IIT Indore</option><option value='Jodhpur'>IIT Jodhpur</option><option value='Kanpur'>IIT Kanpur</option><option value='Kharagpur'>IIT Kharagpur</option><option value='Madras'>IIT Madras</option><option value='Mandi'>IIT Mandi</option><option value='Patna'>IIT Patna</option><option value='Roorkee'>IIT Roorkee</option><option value='Ropar'>IIT Ropar</option><option value='Varanasi'>IIT (BHU) Varanasi</option><option value='other'>Other</option></select><div class='display_other' style='display:none;'><input placeholder='Please specify if other' type='text' class='validate' name='ex_collegeother[]' /></div></div></div><div class='row'><div class='col-xs-12 col-md-4'><span class='grey-text text-darken-1'>Degree<span class='red-text'>*</span></span></div><div class='col-xs-12 col-md-8'><select name='ex_degree[]' id='degree' class='browser-default' onchange='extraSpecifyOther()' data-condition='simple'><option value='' disabled='disabled' selected='selected'>Select Degree</option><option value='btech'  >B.Tech.</option><option value='mtech'>M.Tech.</option><option value='phd'>Ph.D.</option><option value='msc'>M.Sc.</option><option value='mba'>M.B.A.</option><option value='dual'>Dual (B.Tech. + M.Tech.)</option><option value='other'>Other</option></select><div class='display_other' style='display:none;'><input placeholder='Please specify if other' type='text' class='validate' name='ex_degreeother[]' /></div></div></div><div class='row'><div class='col-xs-12 col-md-4'><span class='grey-text text-darken-1'>Branch<span class='red-text'>*</span></span><br /><span class='grey-text text-lighten-1' style='font-size: 13px;'>You specialize in</span></div><div class='col-xs-12 col-md-8'><input placeholder='e.g. Electrical Engineering' type='text' class='validate' name='ex_branch[]' data-condition='simple' length='30' /></div></div><div class='row'><div class='col-xs-12 col-md-4'><span class='grey-text text-darken-1'>College Verification<span class='red-text'>*</span></span><br /><span class='grey-text text-lighten-1' style='font-size: 13px;'>Upload a snapshot of your College Degree or Student ID<br>Max. file size: 2MB</span></div><div class='col-xs-12 col-md-8'><div class='file-field input-field'><input class='file-path validate' type='text' placeholder='Click to upload file'/><div><input type='file' name='ex_uploadfile_clgvarification[]' /></div></div></div></div></div>";
	$(document).on('click','#addAnotherCollege span', function(event) {  
		$(insertData).insertBefore('#addAnotherCollege');
		$('#hidden').slideDown(600, 'swing', function() {
			$(this).find('.row').unwrap();
		})
	});
});