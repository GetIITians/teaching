
function hideshow(h,s){
	$("#"+h).hide();
	$("#"+s).show();
}
function hideshowdown(h,s,timetaken){
	$("#"+h).slideUp(timetaken);
	$("#"+s).slideDown(timetaken);
}



function uploadfile(obj,name){
	var formjobj=$(obj).parent();
	if(!(formjobj.find("input[name="+name+"]").length>0)){
		var elm=document.createElement("input");
		elm.setAttribute("type","file");
		elm.setAttribute("name",name);
		elm.setAttribute("style","display:none;");
		elm.onchange=function (){
			formjobj.submit();
		}
		formjobj[0].appendChild(elm);
	}
	else{
		var elm=formjobj.find("input[name="+name+"]")[0];
	}
	elm.click();
}

function topicssubtopic_t2(obj){
	temp=obj; 
	var ids=["selectclass","selectsubject","selecttopic"];
	var cstval=[];
	for(var i=0;i<ids.length;i++){
		cstval[i]=$("#"+ids[i]).val();
	} 
	function getslist(inp,stext){ 
		outp=[];
		if(stext!=null)
			outp.push(['', stext]);
		for(var i in inp){
			outp.push([i,inp[i].name]);
		} 
		return outp;
	} 
	if(obj.id=="selectclass" && typeof(topics[obj.value])!='undefined'){
		var selectedHTML=selects.arr2opt(getslist(topics[obj.value]['children'],"Select Subject"));
		$("#selectsubject").html(selectedHTML);
	}
	if(obj.id=="selectsubject" && typeof(topics[cstval[0]])!='undefined' && typeof(topics[cstval[0]]['children'][cstval[1]])!='undefined' ){
		var selectedHTML=selects.arr2mselect(getslist( topics[cstval[0]]['children'][cstval[1]]['children'] ),'topic');
			
		$("#selecttopic").html(selectedHTML);
	}
	$(".selectall").click(function(){
		var jobj=$(this);
		if(jobj.val()==0){
			selectallmatched(jobj[0], $("[id^="+jobj.attr("id")+"]") );
		}
	});
	$('select').material_select();
}

function topicssubtopic(obj){//assuming a variable topics is already defined
	temp=obj; 
	var ids=["selectclass","selectsubject","selecttopic"];
	var cstval=[];
	for(var i=0;i<ids.length;i++){
		cstval[i]=$("#"+ids[i]).val();
	}
	function getslist(inp,stext){
		outp=[['',stext]];
		for(var i in inp){
			outp.push([i,inp[i].name]);
		}
		return outp;
	}
	if(obj.id=="selectclass" && typeof(topics[obj.value])!='undefined'){
		var selectedHTML=selects.arr2opt(getslist(topics[obj.value]['children'],"Select Subject"));
		$("#selectsubject").html(selectedHTML);
	}
	if(obj.id=="selectsubject" && typeof(topics[cstval[0]])!='undefined' && typeof(topics[cstval[0]]['children'][cstval[1]])!='undefined' ){
		var selectedHTML=selects.arr2opt(getslist( topics[cstval[0]]['children'][cstval[1]]['children'] ,"Select Topics"));
		$("#selecttopic").html(selectedHTML);
	}
	$('select').material_select();
}


var hitu={
	f1:function(obj){
		hitu.f2(obj);
	},
	changemonth:function (obj){
		$(obj).attr("data-month",$(obj).val());
	},
	f2:function(obj){
		button.sendreq_v2_t4(obj,null, function(d){
			$('#divforcalender').html(d);
			$('select').material_select();
		});
	},
	changeyear:function (obj){
		$(obj).attr("data-year",$(obj).val());
	},

	change:function(obj){
		$(obj).attr("data-year",$(obj).val());
	}
};


var himanshu={
  f1:function(){
    var mystart = document.getElementById('startdate').value;
    var myend = document.getElementById('enddate').value;

    if($("[name='time[]']:checked").length==0 || $("[name='days[]']:checked").length==0){
      window.alert("Please select some slot or days to add");
      $("input[name=addHidden]").val('');
    }
    else if(mystart=='' || myend==''){
      window.alert("Please add a start and end date");
    }
    else
      $("input[name=addHidden]").val('addSet');
  },
  f2:function(){
    if($("[name='time[]']:checked").length==0){
      window.alert("Please select some slot to delete");
      $("input[name=deleteHidden]").val('');
    }
    else
      $("input[name=deleteHidden]").val('deleteSet');
  },
  f12:function(obj){

      if(obj.checked==true){
        $("input[type=checkbox][class=myCheckbox]").each(function () {
                $(this).prop("checked", true);        });
      }
      else{
        $("input[type=checkbox][class=myCheckbox]").each(function () {
                $(this).prop("checked", false);        });        
      }
  }, 
  f22:function(obj){
      if(obj.checked==true){
        $("input[type=checkbox][class=myCheckbox1]").each(function () {
                $(this).prop("checked", true);        });
      }
      else{
        $("input[type=checkbox][class=myCheckbox1]").each(function () {
                $(this).prop("checked", false);        });        
      }
  }
}



function opencalpopup(obj){
	mohit.popup("timeslot",{"body":"<img src='photo/icons/loading.gif' />"});
	button.sendreq_v2_t4(obj,null,function(d){
		$("#"+"timeslotPopup"+"body").html(d);
	});	
}

var ms={
	getselected:function(id){//1 indexed listing
		if(id==null)
			id="disppopupslots";
		var alls=$("#"+id).find("input[type=checkbox]");
		var outp=[];
		for(var i=0;i<alls.length;i++){
			if(alls[i].checked)
				outp.push(i+1);
		}
		return outp;
	},
	f1:function(){
		ms.cbautofill("divtimeslotcheckbox");
	},
	f2:function(){
		ms.cbautofill("disppopupslots");
	},
	cbautofill:function(id){
		setinputselects($("#"+id).find("input[type=hidden]")[0],$("#"+id).find("input[type=checkbox]"));
	},
	calreq:function(obj){
		if($("#divforcalender").attr("data-lockcal")!="true"){//If calender is loading, don't do anything while previous request returns.
			$("#divforcalender").attr("data-lockcal","true");
			$(".canloadcal").each(function(){this.disabled=true;});
			$("#calenderloadingimg").css("visibility","visible");
			$('select').material_select();
			button.sendreq_v2_t4(obj,null, function(d){
				$('#divforcalender').html(d);
				$(".canloadcal").each(function(){this.disabled=false;});
				$("#divforcalender").attr("data-lockcal","false");
				$("#calenderloadingimg").css("visibility","hidden");
				$('select').material_select();
			});
			return true;
		}
		else
			return false;
	},
	signupform:function(obj,needotp,emailexist){ 
		if(needotp){ 
			if($("#signupwindow").is(":visible")){ 
				if(form.valid.action1(  $("#signupwindow")[0]  )){
					form.sendreq1(obj, $("#signupwindow").find("button[type=submit]")[0] );
				}
				return false;
			} else
				return form.valid.action1(obj);
		} else {
			return form.valid.action1( $("#signupwindow")[0] ) ;
		}
	},
	joinusform:function(obj, needotp){ 
		var mainwindow = $("#main_form_section");
		var otpwindow = $("#otp_section");
		if(needotp){
			if(mainwindow.is(":visible")){
				if(submitForm_t2(mainwindow[0])) {
					form.sendreq1(obj, mainwindow.find("button[type=submit]")[0] );
				}
				return false;
			} else
				return submitForm_t2(obj);
		} else {
			return submitForm_t2(mainwindow[0]);
		}
	},
	refinecallafter: function() {
		var sresult = $(".teacherlistelm").length;
		if(sresult == 0) {
			$("#loadmorebutton").hide();
			$("#dispnoresult").show();
		} else {
			$("#dispnoresult").hide();
		}
	},
	refinesearch: function(){ 
		var searchdiv = $('#searchresultdiv');
		var maxl = parseInt($("#searchresultdiv").attr("data-maxl")); 
		div.reload_autoscroll(searchdiv[0], null, function(d){ 
			$("#loadmorebutton").hide();
			if(!(d.qresultlen < maxl)) {
				$("#loadmorebutton").fadeIn();
			}
		}, function() {
				ms.refinecallafter();
		}, "#searchloadingimg");
	}, // function by yogy 
	orderrefine: function(obj) {
		($(obj).attr("data-action")=="refinesearch" ? $("input[name=search][type=hidden]").attr("value","") : false);
		this.refinesearch();
	}, //function by yogy
	searchloadmore: function(obj){
		var sdiv = $("#searchresultdiv");
		var maxl = parseInt(sdiv.attr("data-maxl"));
		div.load(sdiv[0], 0, 0, function(d){
			if(d.qresultlen < maxl){
				$(obj).fadeOut();
			}
		}, null, "#loadmoreloadingimg");
	},
	studentbookslot: function(obj) { 
		if(selectedtopic != "") {
			ms.cbautofill("disppopupslots");
			$(obj).attr("data-cst", selectedtopic);
			button.sendreq_v2(obj);
		} else {
			Materialize.toast('Please select the topic first', 4000);
		} 
	},
	booktopic: function(obj, cst) {
		selectedtopic=cst;
		$("#profiletabs2").click();
		Materialize.toast($(obj).attr("data-topictext")+' is selected, now select the time.', 10000);
		Materialize.toast('You can book your class from tomorrow.',12000);
	},
	openreviewform: function(obj, tid, starttime) {
		mohit.popup('writereview');
		setform( $("#writereviewPopup"), {"tid":tid, "starttime":starttime});
	}
};


function selectallmatched(obj,sel){
	for(var i=0;i<sel.length;i++){
		if(!sel[i].disabled)
			sel[i].checked=obj.checked;
	}
}

function setinputselects(hidinp,cbselector){
	var outp=[];
	for(var i=0;i<cbselector.length;i++){
		if(cbselector[i].checked && cbselector[i].value!='' )
			outp.push(cbselector[i].value);
	}
	hidinp.value=outp.join("-");
}

function searchform(){ 
	var leftform=readform($("#searchform")); 
	mergeifunset(leftform, {'orderby':$("select[name=orderby]").val()}); 
	return leftform;
}
$(document).ready(function(){
	mylib();
});

