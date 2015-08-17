<!doctype html>
<html lang="en_US">
<head>

  <?php
  opent("base",array("href"=>HOST));
  /*      Narayan Waraich       */
  ocloset("title",$title['index']);
  if (strpos(uri_string(),'search') !== false || strpos(uri_string(),'profile') !== false)
  {
    array_push($css, "css/bootstrap.min.css");
  }
  if (strpos($_SERVER['PHP_SELF'], 'index.php') !== false) {
    array_push($css, "css/bootstrap.min.css");
  }
  array_push($css, "css/glyphicon.css");
  array_push($css, "css/google-icons.css");
  /*----------------------------*/
  addall_css($css);
  addmycss();
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <meta charset="utf-8"/>
  <script type="text/javascript">
    var HOST="<?php echo HOST; ?>";
  </script>
  <!-- Google Analytics -->
  <!--
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-64966801-1', 'auto');
    ga('send', 'pageview');
  </script>
  -->
<!--Start of Zopim Live Chat Script-->
<!--
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3DJHX0YbzQH1euI32VFt0wiq2flN32Jk";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
-->
<!--End of Zopim Live Chat Script-->
</head>
