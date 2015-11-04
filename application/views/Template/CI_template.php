	<script src="<?php echo site_url('ckeditor/ckeditor.js'); ?>"></script>
	<script src="<?php echo site_url('ckeditor/js/sample.js'); ?>"></script>
<?php 
	load_view("Template/top.php");
	load_view("Template/navbarnew.php");
?>
<style type="text/css">
	.pagination{
		margin:0;
	}
	.pagination li {
	padding:0;
	}
	.modal{
		background-color:; 
	}
.table>tbody>tr>td,
.table>tbody>tr>th, 
.table>tfoot>tr>td, 
.table>tfoot>tr>th,
.table>thead>tr>td, 
.table>thead>tr>th{
padding: 2px 0 0 8px;
}
.table>thead>tr>th{
	text-align: center;
	vertical-align: center;
}
.subhead>td{
	font-weight: bold;
}
label{
	margin-bottom: 0px;
}
</style>
<style type="text/css">

input[type=text], input[type=password], 
input[type=email], input[type=url], input[type=time], 
input[type=date], input[type=datetime-local], input[type=tel], 
input[type=number], input[type=search], textarea.materialize-textarea{
  margin: 0px 0 15px 0;
}

h4,h5{
  margin-top: 5px;
  text-align: left;
  font-weight: bold;
}
hr{
  margin: 5px;
  
}
textarea{
    border-left: none;
    border-top: none;
    border-right: none;
}

.btn,.well,input[type="checkbox"].filled-in + label:after {
   border-radius: 0px; 
  }
.pagination>li>a{
  	border:0;
  	color:#0E907A
  }
.pagination>li{
	font-size: 1.0rem;
}  
.pagination{
	padding-bottom: 2px;
}
.pagination>.active>a{
	background-color: rgb(38, 166, 154);
}  
.pagination>.active>a:hover{
	background-color: rgb(14, 134, 122);
}
.diff{
	background-color:rgba(109, 146, 103, 0.07);
}
</style>


<?php
	$this->load->view($view_name, $view_data);
	load_view("Template/footer.php"); 
	load_view("Template/bottom.php");
?>
<script>
	initSample();
</script>
