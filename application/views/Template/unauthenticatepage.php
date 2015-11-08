<style type="text/css">
	.mybody { background-color: rgba(0, 105, 92, 0.55);
		border-radius: 10px
	 }
.myani {
  padding: 40px;
  font-size: 20px;
  text-align: center;
  color: red;

    -webkit-animation-name: example; /* Chrome, Safari, Opera */
    -webkit-animation-duration: 100s; /* Chrome, Safari, Opera */
    -webkit-animation-iteration-count: infinite; /* Chrome, Safari, Opera */
    animation-name: example;
    animation-duration: 100s;
    animation-iteration-count: infinite;
}

/* Chrome, Safari, Opera */
@-webkit-keyframes example {
    0%   {color:red; left:0px; top:0px;}
    25%  {color:yellow; left:200px; top:0px;}
    50%  {color:blue; left:200px; top:200px;}
    75%  {color:green; left:0px; top:200px;}
    100% {color:red; left:0px; top:0px;}
}

/* Standard syntax */
@keyframes example {
    0%   {color:red; left:0px; top:0px;}
    25%  {color:yellow; left:200px; top:0px;}
    50%  {color:blue; left:200px; top:200px;}
    75%  {color:green; left:0px; top:200px;}
    100% {color:red; left:0px; top:0px;}
}
</style>

</style>
<div class="container mybody mt20">
<div class="myani">
  <p id="code">Please<span> Login </span><span> As Admin</span></p>
</div>

</div>