function isNum(n){
	return (isFinite(n) && n!="");
}

var checkValidInput={
	'idel':function (obj){
		return true;
	},
	'simple':function (obj){
		return obj.value!="";
	},
	'email':function (obj){
		return (obj.value.match("^[a-zA-Z0-9\._%+-]+@[a-zA-Z0-9\.-]+[\.][a-zA-Z]{2,4}$")!=null);
	},
	'password':function (obj){
		return (obj.value!="" && obj.value == $("#password").val()  );
	},
	'phone':function (obj){
		var pn=obj.value;
		return (isFinite(pn) && pn.length==10 && pn[0]!='+' && pn[0]!='-');
	},
	'otp':function (obj){
		var pn=obj.value;
		return (isFinite(pn) && pn.length==7 && pn[0]!='+' && pn[0]!='-');
	},
	'pnumber':function (obj){
		return isNum(obj.value) ;
	},
	'int':function(obj){
		return isNum(obj.value);
	},
	'pint':function(obj){
		return (checkValidInput.int(obj) && obj.value[0]!='-');//remember obj.value.length is >=1 in second term.
	},
	'checkbox':function(obj){
		var gname=$(obj).attr("data-group");
		var needs=$("[name^="+gname+"]");
		var onechecked=false;
		for(var i=0;i<needs.length;i++){
			if(needs[i].checked){
				onechecked=true;
				break;
			}
		}
		return onechecked;
	},
	'isChecked':function (obj){ 
		return (obj.getAttribute('data-condition')==null || this[ obj.getAttribute('data-condition') ](obj)) ;
	}
};



function checkValid(obj,e){
	if(e.keyCode!=9){
		signObj=$(obj).parent().children("span");
		var classes=["glyphicon-remove","glyphicon-ok","glyphicon-warning-sign"];
		function removeSign(){
			for(i=0;i<classes.length;i++){
				$(signObj).removeClass(classes[i]);
			}
		}
		removeSign();
		if( obj.getAttribute('data-condition')!=null &&  checkValidInput[ obj.getAttribute('data-condition') ](obj) ){
			signObj.addClass(classes[1]);
			signObj.parent().removeClass("has-error");
		}
		else
			signObj.addClass(classes[0]);
	}
}


function submitForm(obj){
	$(obj).find(".text-danger").html("");
	$(obj).find(".text-success").html("");
	var inputs=['INPUT','TEXTAREA','SELECT'];
	var problem=false;

	for(i=0;i<inputs.length;i++){
		var ilist=$(obj).find(inputs[i]);
		for(j=0;j<ilist.length;j++){
			if(checkValidInput.isChecked( ilist[j]  ) ){
				$(ilist[j]).parent().removeClass("has-error");
			}
			else{
				$(ilist[j]).parent().addClass("has-error");
				if(!problem)
					$(ilist[j]).focus();
				problem=true;
			}
		}
	}
	return !(problem);
}



function submitForm_t2(obj){
	var list="";
	var listMatch = {resumefile:"Resume",fname:"First Name", lname: "Last Name", sub1:"Subject", sub2:"Subject", sub3:"Subject", sub4:"Subject", sub5:"Subject", sub6:"Subject", grade1:"Grade", grade2:"Grade", grade3:"Grade", grade4:"Grade", lang1:"Language", lang2:"Language", lang3:"Language", lang4:"Language", lang5:"Language", lang6:"Language", lang8:"Language", lang9:"Language", lang10:"Language", lang11:"Language", lang12:"Language", lang13:"Language", lang14:"Language", branch:"Branch", email:"Email", password:"Password", cpassword:"Confirm Password", phone:"Phone", dob:"Date Of Birth", city:"City", zipcode:"Zipcode", state:"State", knowaboutus1:"How Did You Came To Know About Us", knowaboutus2:"How Did You Came To Know About Us", knowaboutus3:"How Did You Came To Know About Us", knowaboutus4:"How Did You Came To Know About Us", college:"College", degree:"Degree", gender:"Gender", country:"Country",otpvarified:"Correct OTP",college_addClg:"Additional College",degree_addClg:"Additional College Degree",branch_addClg:"Additional College Branch"};

	$(obj).find(".text-danger").html("");
	$(obj).find(".text-success").html("");
	var inputs=['INPUT','TEXTAREA','SELECT'];
	var problem=false;
	for(i=0;i<inputs.length;i++){
		var ilist=$(obj).find(inputs[i]);
		for(j=0;j<ilist.length ;j++) { 
			if(checkValidInput.isChecked( ilist[j] )){
				$(ilist[j]).parent().removeClass("has-error");
			}
			else{
				$(ilist[j]).parent().addClass("has-error");
				if(!problem)
					$(ilist[j]).focus();

					if (list.search(listMatch[ilist[j].name])==-1) {
	 				   list=list.concat(listMatch[ilist[j].name]).concat("<br>");
					}
				problem=true;
			}
		}
	}
	if(problem==true){
		var app="<b>You have to fill :</b><br>".fontcolor("red");
		var finalApp=app.concat(list.fontcolor("red")); 
		document.getElementById("errorReport").innerHTML = finalApp;
 		window.scrollTo(0, 0);
	}	
	return !(problem);
}

function getFormInputs(obj,add){ 
	var inputs=['INPUT','TEXTAREA','SELECT'];
	outp={};
	for(i=0;i<inputs.length;i++){
		var ilist=$(obj).find(inputs[i]);
		for(j=0;j<ilist.length;j++){
			if(ilist[j].getAttribute('name')!=null){
				var fn=ilist[j].getAttribute('name');
				var fv=(ilist[j].value);
				if(ilist[j].type=="checkbox")
					fv=ilist[j].checked;
				outp[fn]=fv;
			}
		}
	} 
	outp[add]="";
	return outp;
}

function form_request(obj,data){//data is dict with keys => instruction,changedtext,errordict,successfunc,
	$(obj).find(".text-danger").html("");
	$(obj).find(".text-success").html("");
	$(obj).children("button")[0].disabled=true;
	var prvval=$(obj).children("button")[0].innerHTML;
	$(obj).children("button")[0].innerHTML=data.changedtext;
	$.post("action.php",getFormInputs(obj,data.instruction),
		function(d,status){
			if(status=='success'){
				if(isNum(d)){
					var em="";
					for(ec in data.errordict){
						if(d==ec)
							em=data.errordict[ec];
					}
					if(em!="")
						$(obj).find(".text-danger").html(em);
					else{
						if(obj.getAttribute("data-resetAfterSubmit")!=null){
							if(obj.getAttribute("data-resetAfterSubmit")=='true')
								obj.reset();
						}
						else
							obj.reset();
						data.successfunc(obj,d);
					}
				}
				$(obj).children("button")[0].disabled=false;
				$(obj).children("button")[0].innerHTML=prvval;
			}
		}
	);
}


function readform(obj,add){
	var inputs=['input','textarea','select'];
	outp={};
	var checkboxes={};
	for(i=0;i<inputs.length;i++){
		var ilist=$(obj).find(inputs[i]);
		for(j=0;j<ilist.length;j++){
			if(ilist[j].getAttribute('name')!=null){
				var fn=ilist[j].getAttribute('name');
				var fv=(ilist[j].value);
				if(ilist[j].type=="checkbox"){
					setifunset(outp,fn,[]);
					setifunset(checkboxes,fn,1);
					if(ilist[j].checked)
						outp[fn].push(ilist[j].value);
				}
				else if(ilist[j].type=="radio"){
						setifunset(outp,fn,'');
						if(ilist[j].checked)
							outp[fn]=fv;
				}
				else
					outp[fn]=fv;
			}
		}
	}
	for(var i in checkboxes){
		outp[i]=outp[i].join("-");
	}
	if(add!=null)
		outp[add]=""; 
	return outp;
}
 

