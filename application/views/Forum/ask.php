<div class="container">
	<div class="row">
		<div class="col-xs-8">
			<form action="forum/submitQue" method="post">
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
						<input type="submit" name="askque" value="Ask">
						</li>
					</ul>
				</div>
			</form>
		</div>
		<div class="col-xs-4">
		</div>
	</div>


</div>		