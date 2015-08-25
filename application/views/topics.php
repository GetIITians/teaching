<script>
var topics=<?php echo json_encode($cst_tree); ?>;
</script>
<main>
  <div class="container">
    <div class="row">
        <?php
        if(User::loginId()==$tid){
        ?>
      <div class="col-xs-12 col-md-3">
        <div class="card-panel">
          <span class="grey-text text-darken-2">Please add your topics</span>
          <br>
          <div class="row">
            <form method="post" class="col-xs-12" onsubmit='return submitForm(this);' action="<?php echo BASE."profile/".$tid."/5"; ?>"  >
              <div class="row">
                <div class="input-field col-xs-12">
                  <select name='class' class="browser-default" onchange='topicssubtopic(this);' id="selectclass" data-condition='simple' style='' >
                    <?php
                       disp_olist($class_olist,array('selectalltext'=>"Select Class"));
                    ?>
                  </select>
                </div>
                <div class="input-field col-xs-12">
                  <select name='subject'  class="browser-default" id='selectsubject' onchange='topicssubtopic(this);' data-condition='simple' >
                    <option value="" >Select Subject</option>
                  </select>
                </div>
                <div class="input-field col-xs-12">
                  <select name='topic' class="browser-default" id='selecttopic' data-condition='simple' >
                    <option value="" >Select Topic</option>
                  </select>
                </div>
                <div class="input-field col-xs-12">
                  <input id="duration" type="text" class="validate" name="timer" data-condition='simple' >
                  <label for="duration">Class duration (in hrs)</label>
                </div>
                <div class="input-field col-xs-12">
                  <input id="fees" type="text" class="validate" name="price" data-condition='simple' value='<?php echo $minfees; ?>' >
                  <label for="fees">Fees per hour ( Rs.)</label>
                </div>
                <div class="input-field col-xs-12">
                  <button class="btn waves-effect waves-light red darken-1">Submit</button>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
      }
      ?>
      <div class="col-xs-12 col-md-9">
        <div class="card-panel">
          <table class="hoverable responsive-table">
            <thead>
              <tr>
                <th data-field="class">Class</th>
                <th data-field="subject">Subject</th>
                <th data-field="topic">Topic</th>
                <th data-field="duration">Duration (hrs)</th>
                <th data-field="fees">Fees</th>
                <th data-field=""></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($mysubj as $i=>$row){
              ?>
              <tr>
                <td><?php echo $row["classname"]; ?></td>
                <td><?php echo $row["subjectname"]; ?></td>
                <td><?php echo $row["topicname"]; ?></td>
                <td><?php echo $row["timer"]."h"; ?></td>
                <td>&#8377;<?php echo $row["price"]; ?></td>
              <?php
              if($tid==User::loginId()){
              ?>
                <td><a href='<?php echo BASE."profile/".$tid."/5?deleteid=".$row["id"]; ?>' class="btn waves-effect waves-light red darken-1">Delete</a></td>
              <?php
              }
              ?>

              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

