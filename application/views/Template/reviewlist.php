<!-- Review Cards  -->
<?php
  foreach($rlist as $i => $row) {
?>
<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1">
    <div class="card white">
      <div class="card-content grey-text">
        <h6>
          <a <?php pit("href='".BASE."profile/".$row["tid"]."'", $reviewname == "teachername" ); ?> >

            <i class="mdi-action-face-unlock small left"></i>

<!--             <img src=""  >
 -->
            <?php echo convchars($row[$reviewname]); ?>
          </a>
        </h6><br>
        <p><?php echo convchars($row["feedback"]); ?>.</p>
      </div>
      <div class="card-action" style="display:none;" >
        <a href="#">Upvote</a>
        <a href="#">Downvote</a>
        <a class="modal-trigger" href="#upvote_modal" onclick="smgPreloader();">15&nbsp;<i class="mdi-action-thumb-up"></i></a>
        <a class="modal-trigger" href="#downvote_modal" onclick="smgPreloader();">2&nbsp;<i class="mdi-action-thumb-down"></i></a>
      </div>
    </div>
  </div>
</div>
<?php
  }
?>

<!-- 
<div class="row">
  <div class="col s12 l10 offset-l1">
    <div class="card white">
      <div class="card-content grey-text">
        <h6>
          <a href="#"><i class="mdi-action-face-unlock small left"></i>Dr. Shivam Mamgain</a>
        </h6><br>
        <p>A terrible and arrogant teacher. He has no respect for the students and thinks students and donkeys are alike.</p>
      </div>
      <div class="card-action">
        <a href="#">Upvote</a>
        <a href="#">Downvote</a>
        <a class="modal-trigger" href="#upvote_modal" onclick="smgPreloader();">39&nbsp;<i class="mdi-action-thumb-up"></i></a>
        <a class="modal-trigger" href="#downvote_modal" onclick="smgPreloader();">11&nbsp;<i class="mdi-action-thumb-down"></i></a>
      </div>
    </div>
  </div>
</div>

 -->