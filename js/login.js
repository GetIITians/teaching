function forgotPass() {
	var prefix = $("#forgot_prefix_arrow");
	var keyboard_up = '<i class="material-icons tiny">keyboard_arrow_up</i>';
	var keyboard_down = '<i class="material-icons tiny">keyboard_arrow_down</i>';

	if (prefix.html() == keyboard_up) {
		prefix.html(keyboard_down);
	}
	else {
		prefix.html(keyboard_up);
	}

	$("#login_section").slideToggle(1000);
	$("#forgot_pass_section").slideToggle(1000);
}
