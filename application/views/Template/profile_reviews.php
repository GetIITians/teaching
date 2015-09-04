
<br><br>
<div class="row">
  <div class="col-xs-12 col-md-10 col-md-offset-1">
    <h5 class="teal-text text-darken-1">Student reviews</h5>
  </div>
</div>


<?php
  load_view("Template/reviewlist.php", $inp);
?>


  <!-- Upvote Modal Structure -->
  <div id="upvote_modal" class="modal">
    <div class="modal-content">
      <h5 class="green-text"><i class="material-icons left">thumb_up</i>Upvotes</h5>
      <div class="smg-preloader"></div>
      <div class="smg">
        <p><a href="#"><i class="material-icons left">tag_faces</i>Babloo</a></p>
        <p><a href="#"><i class="material-icons left">tag_faces</i>Pickachu</a></p>
        <p><a href="#"><i class="material-icons left">tag_faces</i>Partap</a></p>
      </div>
    </div>
  </div>
  <!-- Downvote Modal Structure -->
  <div id="downvote_modal" class="modal">
    <div class="modal-content">
      <h5 class="green-text"><i class="material-icons left">thumb_down</i>Downvotes</h5>
      <div class="smg-preloader"></div>
      <div class="smg">
        <p><a href="#"><i class="material-icons left">tag_faces</i>Babloo</a></p>
        <p><a href="#"><i class="material-icons left">tag_faces</i>Pickachu</a></p>
        <p><a href="#"><i class="material-icons left">tag_faces</i>Partap</a></p>
      </div>
    </div>
  </div>
