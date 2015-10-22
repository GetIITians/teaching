<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="container">
	<div class="row">
		<div class="col-xs-8">
			<form action="forum/submitQue" method="post" id="emailCheck" onsubmit="return checkemail()">
				<h4>Ask A Question</h4>
				<div class="col-xs-12">
					<ul>
						<li>
						<label >Question</label>
						<input type="text" id="title" name="title" value="<?php if(isset($que_title)) echo $que_title; ?>">
						</li>
						<li>
						<label>Description</label>
						<textarea name="des"></textarea>
						</li>
					</ul>
				</div>
				<h4>Enter Your Email Id</h4>
				<div class="col-xs-12">
					<ul>
						<li>
						<label >Email-id</label>
						<input type="text" id="email" name="email" value="">
						</li>
						<li>
						<input type="submit" id="submit" name="askque" value="Ask" >
						</li>
					</ul>
				</div>
			</form>
		</div>
		<div class="col-xs-4">

		</div>
	</div>
<div class="row">
	<div class="col-xs-4" id="emailmsg">
sdfsdfsdf
	</div>
</div>

</div>	
<script type="text/javascript">
function checkemail(){
	var form_data = { 
		email: $('#email').val(),
		ajax: '1'		
	};
	
	$.ajax({
		url: "<?php echo site_url('forum/check_user'); ?>",
		type: 'POST',
		data: form_data,
		success: function(msg) { 
			if(msg) {
				$('#emailmsg').html(msg);
				
			}
			
		}
	});
	
	return false;
};
	
	
</script>
