var button={
	attrs:function(obj){
		var alla=obj.attributes;
		var attrso={};
		for(var i=0;i<alla.length;i++)
			attrso[alla[i].name]=alla[i].value;
		return attrso;
	},
	tosendattrs:function(obj,allattrs){ 
		var dontneed=["data-restext","data-waittext","data-res","data-wait","data-error","data-params","data-eparams"];
		var sendparams={}; 
		for(var i in allattrs){ 
			if(i.substr(0,5)=="data-" && dontneed.indexOf(i)==-1 ) { 
				sendparams[i.substr(5)]=allattrs[i]; 
					
			} 
		} 
		return sendparams;
	},
	parse:function (d){
		try{
			return JSON.parse(d);
		}catch(e){
			mohit.alert("Unexpected error!");
			return null;
		}
	},
	hasattr:function (allattrs,a){
		return (typeof(allattrs[a])!='undefined');
	},
	objhasattr:function (obj,a){
		return button.hasattr(button.attrs(obj),a);
	},
	sendreq:function(obj){
		var allattrs=this.attrs(obj);
		if(!button.hasattr(allattrs,"data-params"))
			var params=this.tosendattrs(obj,allattrs);
		else{
			eval("var params="+allattrs["data-params"]);
		}
		params['action']=allattrs["data-action"];
		obj.disabled=true;
		var prvvalue=obj.innerHTML;
		obj.innerHTML=(!button.hasattr(allattrs,"data-waittext"))?' ... ':(allattrs["data-waittext"]==''?prvvalue:allattrs["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			obj.disabled=false;
			var respo=button.parse(d);
			obj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					obj.innerHTML=(typeof(allattrs["data-restext"])=='undefined')?prvvalue:allattrs["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
				}
			}
			
		}});
	},
	sendreq_v2:function(obj){ 
		var allattrs=this.attrs(obj);
		if(!button.hasattr(allattrs,"data-params"))
			var params=this.tosendattrs(obj,allattrs);
		else{
			eval("var params="+allattrs["data-params"]);
		}
		if(button.hasattr(allattrs,"data-eparams")){
			eval("var eparams="+allattrs["data-eparams"]);
			params=others.mergeifunset(params,eparams);
		}
		params['action']=allattrs["data-action"];
		obj.disabled=true; 
		var prvvalue=obj.innerHTML;
		obj.innerHTML=(!button.hasattr(allattrs,"data-waittext"))?' ... ':(allattrs["data-waittext"]==''?prvvalue:allattrs["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			obj.disabled=false;
			var respo=button.parse(d);
			obj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					obj.innerHTML=(typeof(allattrs["data-restext"])=='undefined')?prvvalue:allattrs["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
				}
			}
			
		}});
	},
	sendreq_v2_t2:function(obj){
		var allattrs=this.attrs(obj);
		if(!button.hasattr(allattrs,"data-params"))
			var params=this.tosendattrs(obj,allattrs);
		else{
			eval("var params="+allattrs["data-params"]);
		}
		if(button.hasattr(allattrs,"data-eparams")){
			eval("var eparams="+allattrs["data-eparams"]);
			params=others.mergeifunset(params,eparams);
		}
		params['action']=allattrs["data-action"];
		obj.disabled=true;
		var prvvalue=obj.innerHTML;
		obj.innerHTML=(!button.hasattr(allattrs,"data-waittext"))?' ... ':(allattrs["data-waittext"]==''?prvvalue:allattrs["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			obj.disabled=false;
			var respo=button.parse(d.split("\n")[0]);
			obj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					obj.innerHTML=(typeof(allattrs["data-restext"])=='undefined')?prvvalue:allattrs["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
					if(button.hasattr(allattrs,"data-reshtml")){
						var data=d.substring(d.indexOf('\n')+1);
						eval(allattrs["data-reshtml"]);
					}
				}
			}
			
		}});
	},
	sendreq_v2_t3:function(params,call_back_data,call_back_html,adata){  
		$.post(HOST+"actiondisp.php",params,function(d,s){if(s=='success'){ 
			var respo=button.parse(d.split("\n")[0]); 
			if(respo){
				if(respo.ec<0){
					if(typeof(adata)!='undefined'){
						if(button.hasattr(adata,"data-error")){
							var ec=respo.ec;
							eval(allattrs["data-error"]);
						}
						else
							mohit.alert(ecn[respo.ec]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					if(call_back_data!=null)
						call_back_data(respo.data);
					if(call_back_html!=null){
						var data=d.substring(d.indexOf('\n')+1);
						call_back_html(data);
					}
				}
			}
		}});
	},
	sendreq_v2_t4:function(obj,call_back_data,call_back_html,adata){ 
		var allattrs=this.attrs(obj);  
		if(!button.hasattr(allattrs,"data-params")) { 
			var params=this.tosendattrs(obj,allattrs); 
		}
		else{
			eval("var params="+allattrs["data-params"]);
		} 
		if(button.hasattr(allattrs,"data-eparams")){ 
			eval("var eparams="+allattrs["data-eparams"]); 
			params=others.mergeifunset(params,eparams); 
		}
		params['action']=allattrs["data-action"]; 
		button.sendreq_v2_t3(params,call_back_data,call_back_html);
	},
	sendreq1:function (params,call_back,adata){
		$.post("actionv2.php",params,function(d,s){if(s=='success'){
			var respo=button.parse(d);
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(adata,"data-error")) {
						var ec=respo.ec;
						eval(adata["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else if(call_back!=null)
					call_back(respo.data);
			}
			else
				mohit.alert("Unexpected Error");
		}});
	}

};

var form={
	sendreq:function(obj,bobj){
		if(bobj.disabled)
			return;
		var allattrs=button.attrs(obj);
		var allattrsb=button.attrs(bobj);

		var params=getFormInputs(obj,'action');
		params['action']=allattrs["data-action"]; 
		bobj.disabled=true;
		var prvvalue=bobj.innerHTML;
		bobj.innerHTML=(!button.hasattr(allattrsb,"data-waittext"))?' ... ':(allattrsb["data-waittext"]==''?prvvalue:allattrsb["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			bobj.disabled=false;
			var respo=button.parse(d);
			bobj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					bobj.innerHTML=(typeof(allattrsb["data-restext"])=='undefined')?prvvalue:allattrsb["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
				}
			}
			
		}});
	}, 
	sendreq1:function(obj,bobj){ 
		if(bobj.disabled)
			return;
		var allattrs=button.attrs(obj); 
		var allattrsb=button.attrs(bobj); 

		var params=getFormInputs(obj,'action'); 
		if(button.hasattr(allattrs,'data-param')){ 
			eval("var addparam="+allattrs['data-param']); 
			others.mergeifunset(params,addparam);  
		}

		params['action']=allattrs["data-action"]; 
		bobj.disabled=true;
		var prvvalue=bobj.innerHTML; 
		bobj.innerHTML=(!button.hasattr(allattrsb,"data-waittext"))?' ... ':(allattrsb["data-waittext"]==''?prvvalue:allattrsb["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){ 
			bobj.disabled=false; 
			var respo=button.parse(d);
			bobj.innerHTML=prvvalue; 
			if(respo){ 
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					bobj.innerHTML=(typeof(allattrsb["data-restext"])=='undefined')?prvvalue:allattrsb["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
				}
			} 
			
		}});
	},
	req:function(obj){ 
		form.sendreq1(obj, $(obj).find("button[type=submit]")[0]);
		return false;
	},
	valid:{
		is:function (obj){ 
			var errorlist=[];
			var objlist=[];
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
						var errormsg=$(ilist[j]).attr("data-unfilled") || "Please fill it" ||$(ilist[j]).attr("name") ;
						objlist.push(ilist[j]);
						errorlist.push(errormsg);
						if(!problem)
							$(ilist[j]).focus();
						problem=true;
					}
				}
			} 
			return [errorlist,objlist];
		},
		action:function(obj, type){ 
			var temp=form.valid.is(obj); 
			var errors=temp[0]; 
			var objlist=temp[1];
			if(errors.length>0){
				if(type==1){
					for(var i=0; i<errors.length; i++){
						objlist[i].setCustomValidity(errors[i]);
					}
				}
				else{
					for(var i=0;i<errors.length;i++){
						errors[i]=(i+1)+". "+errors[i];
					}
					var dispmsg="You have to fill:<br>"+errors.join("<br>");
					success.push(dispmsg,true);
				}
			} 
			return !(errors.length>0);
		},
		action1:function(obj){ 
			return form.valid.action(obj,1); 
		}
	}
};



var selects={
	arraytooptionlist:function(arr,text){
		var outp="";
		outp+="<option value='' >"+text+"</option>";
		for(var i=0;i<arr.length;i++)
			outp+="<option>"+arr[i]+"</option>";
		return outp;
	},
	arr2opt:function(arr){
		var outp="";
		for(var i=0;i<arr.length;i++){
			outp+="<option value='"+arr[i][0]+"' >"+arr[i][1]+"</option>";
		}
		return outp;
	},
	arr2mselect:function(arr, name){
		var text='<input id="{id}" class="selectall filled-in" type="checkbox" name="{name}" value="{value}" /><label for="{id}">{label}</label><br>';
		var outp=[];
		outp.push(text.replaceall({"{id}":name, "{name}":name, "{label}":" &nbsp;&nbsp;"+"Select All","{value}":0 }));
		for(var i=0;i<arr.length;i++){
			outp.push(text.replaceall({"{id}":name+i, "{name}":name, "{label}":" &nbsp;&nbsp;"+arr[i][1], "{value}":arr[i][0]}));
		} 
		return a.convreadmore(outp);
	}
};


var textarea={
	resize:function(obj){
		var battrs=button.attrs(obj);
		// if(!button.hasattr(battrs,"data-minrows"))
		// 	battrs["data-minrows"]=3;
		// if(!button.hasattr(battrs,"data-maxrows"))
		// 	battrs["data-maxrows"]=10;
		// if(27+20*(obj.rows)<obj.scrollHeight && battrs["data-maxrows"] > obj.rows  ){
		// 	obj.rows++;
		// }
	},
	resizeorg:function(obj){
		var battrs=button.attrs(obj);
		if(!button.hasattr(battrs,"data-minrows"))
			battrs["data-minrows"]=3;
		if(!button.hasattr(battrs,"data-maxrows"))
			battrs["data-maxrows"]=10;
		if(27+20*(obj.rows)<obj.scrollHeight && battrs["data-maxrows"] > obj.rows  ){
			obj.rows++;
		}
	}
};



var validation={
	"isnull":function (st){
		for(var i=0;i<st.length;i++){
			if(!(st[i]==' ' || st[i]=='\n' || st[i]=='\t'))
				return false;
		}
		return true;
	}
};





var others={
	keys:function(arr){
		outp=[];
		for(i in arr){
			outp.push(i);
		}
		return outp;
	},
	timeleft:function(t){
		var seconds=Math.floor(t)%60;
		var minutes=Math.floor(t/60)%60;
		var hours=Math.floor(t/3600)%24;
		var days=Math.floor(t/(3600*24));
		return {days:days,hours:hours,minutes:minutes,seconds:seconds};
	},
	timelefttext:function(tl){
		var outp="";
		var keys=others.keys(tl);
		for(var i=0;i<4;i++){
			if(tl[keys[i]]!=0)
				outp+=tl[keys[i]]+" "+keys[i]+(i==3?"":",");
		}
		outp+="";
		return outp;
	},
	setifunset:function(data,key,val){
		if(typeof(data[key])=='undefined')
			data[key]=val;
	},
	mergeifunset:function(dict1,dict2){
		for(i in dict2){
			if(typeof(dict1[i]=='undefined'))
				dict1[i]=dict2[i];
		}
		return dict1;
	},
	mergeforce:function (dict1,dict2){
		for(i in dict2){
			dict1[i]=dict2[i];
		}
		return dict1;
	}

};


var a={
	openmytab:function(obj){
		temp=obj;
		var divobjs=$(obj).parent().parent().parent().children(".mymenutabs");
		divobjs.children().fadeOut(function(){
			divobjs.children("#"+$(obj).attr("data-mytab")).fadeIn();
		});
		$(obj).parent().parent().children().removeClass("active");
		$(obj).parent().addClass("active");
	},
	openmytab_t2:function(obj){
		temp=obj;
		var divobjs=$(obj).parent().parent().parent().children(".mymenutabs");
		divobjs.children().hide();
		divobjs.children("#"+$(obj).attr("data-mytab")).show();
		$(obj).parent().parent().children().removeClass("active");
		$(obj).parent().addClass("active");
	},
	readmore:function (obj){
		$(obj).next().show();
		$(obj).hide();
	},
	convreadmore:function(divlist,limit){
		if(limit==null)
			limit=5;
		if(divlist.length<=limit)
			return divlist.join("");
		else{
			var outp=divlist.slice(0,limit-1).join("");
			outp+="<a onclick='a.readmore(this);' style='cursor:pointer;'>View more</a>";
			outp+=("<div style='display:none;' >"+divlist.slice(limit-1).join("")+"</div>");
			return outp;
		}
	}
};

var div={
	setblock:function(obj){
		$(obj).attr("data-blocked","true");
	},
	isblock:function(obj){
		return ($(obj).attr("data-blocked")=="true");
	},
	setunblock:function(obj){
		$(obj).attr("data-blocked","false");
	},
	reload:function(obj,call_back_data,adata){
		button.sendreq_v2_t4(obj,call_back_data,function(d){
			$(obj).html(d);
		},adata);
	},
	load:function(obj, isloadold, isappendold, call_back_data, call_back_html, loadingselector) {
		if(div.isblock(obj))
			return -1;
		if( (isloadold==1 && $(obj).attr("data-minl")==0) || (isloadold==0 && $(obj).attr("data-maxl")==0) )
			return -2;
		div.setblock(obj); 
		loading.showimg(loadingselector); 
		if(isappendold==null) 
			isappendold=isloadold;
		$(obj).attr("data-isloadold",isloadold);
		button.sendreq_v2_t4(obj,function(d){ 
			var replacearr=["min", "max", "minl", "maxl"];
			for(var i=0; i<replacearr.length; i++){
				$(obj).attr("data-"+replacearr[i], d[replacearr[i]]);
			}
			if(call_back_data!=null)
				call_back_data(d);
			loading.hideimg(loadingselector);
		},function(d){
			if(isappendold==1)
				$(obj).prepend(d);
			else if(isappendold==0)
				$(obj).append(d);
			else if(isappendold==-1)
				$(obj).html(d);
			div.setunblock(obj);
			if(call_back_html!=null){
				call_back_html(d);
			}
		});
	},
	reload_autoscroll: function(obj, data_maxl, call_back_data, call_back_html, selector) { 
		if(data_maxl==null) 
			data_maxl=$(obj).attr("data-ignoreloadonce"); 
		$(obj).attr({"data-max":0, "data-maxl":data_maxl});
		div.load(obj, 0, -1, call_back_data, call_back_html, selector);
	},
};



String.prototype.bound = function (n) {
	if(this.length<=n)
		return this;
	else
		return this.substr(0,n-2)+".."
};

var page={
	addiframe:function (url){
		var elm=document.createElement("iframe");
		elm.style.display="none";
		elm.setAttribute("src",url);
		document.body.appendChild(elm);
	}
};

function time(ms){
	var tms=new Date().getTime();
	if(ms==null)
		return Math.floor(tms/1000.0);
	else
		return tms;
}

var rating={
	inat:0,
	outat:0,
	selectn:function(obj,n){
		temp=obj;
		var allc=$(obj).children();
		for(var i=0;i<allc.length;i++){
			if(i<n)
				allc[i].style.color='#FFD700';
			else
				allc[i].style.color='#555';
		}
		$(obj).find("input[type=hidden]").val(n);
	},
	goout:function(obj){
		rating.outat=time(1);
		setTimeout(function(){
			if(time(1)-rating.inat>=1000){
//				rating.selectn(obj,$(obj).attr("data-selected"));
			}
		},1000);
	},
	comein:function(obj){
		rating.inat=time(1);
	}
};


setifunset=function(data,key,val){
	if(typeof(data[key])=='undefined')
		data[key]=val;
}

mergeifunset=function(dict1,dict2){
	for(i in dict2){
		setifunset(dict1,i,dict2[i]);
	}
}

String.prototype.myreplace=function(findstr,repstr){
	var regex=new RegExp(findstr,'g');
	return this.replace(regex,repstr);
}

String.prototype.replaceall = function (repdict){
	var inp=this;
	for(var i in repdict){
		inp=inp.myreplace(i,repdict[i]);
	}
	return inp;
};


function htmlspecialchars(str) {
	return str.replaceall({"&":"&amp;", '"':"&quot;", "'":"&#039;", "<":"&lt;", ">":"&gt;"});
}



function smilymsg(inp){
	inp=htmlspecialchars(inp);
	inp=inp.replaceall({"\n":"<br>","\t":"&nbsp;&nbsp;&nbsp;","  ":"&nbsp;&nbsp;"});
	return inp;
}

var success={
	id:0,
	opentime:{},
	hideafter:8000,//milli seconds
	push:function(msg,convert){
		var sid=success.id;
		success.opentime[sid]=time("m");
		if(convert==null){
			msg=smilymsg(msg);
		}
		else if(convert==false){

		}
		var addnew='<div id="alert_'+sid+'" class="success-msg" style="display:none;" ><span onclick="success.closeme($(this).parent());" class="closePopup closeSuccess" >&times;</span>'+msg+'</div>';
		$("#success_alerts").append(addnew);
		alobj=$("#alert_"+sid);
		alobj.fadeIn(function(){
			setTimeout(function(){
				success.cleaner();
			},success.hideafter);
		});
		success.id++;
	},
	closeme:function(alobj){
		alobj.fadeOut(function(){
			alobj.remove();
		});
	},
	cleaner:function(){
		var ot=success.opentime;
		var zombies=[];
		for(var i in ot){
			if(time("m")-ot[i]>success.hideafter){
				success.closeme($("#alert_"+i));
				zombies.push(i);
			}
		}
		for(var i in zombies){
			if($("#alert_"+i).length<1){
				delete success.opentime[i];
			}
		}
	}
};







function mylib(){
	function textareainc(obj){
		var allattrs=button.attrs(obj);
		mergeifunset(allattrs,{'data-maxrows':5});
		if($(obj).outerHeight() < obj.scrollHeight + parseFloat($(obj).css("borderTopWidth")) + parseFloat($(obj).css("borderBottomWidth"))) {
			if($(obj).attr("rows")<allattrs["data-maxrows"])
				$(obj).attr("rows",1+parseInt($(obj).attr("rows")));
		};
	}
	$("textarea.autoinc").on("keyup keydown",function(){
		textareainc(this);
	});
	var valid={
		resetinp:function (){
			$("input").on("kepup keydown ", function(e){
				if(e.keyCode!=9 && e.keyCode!=13 ){
					this.setCustomValidity("");
				}
			});
		}
	};
	var hovercss = {
		onmousein: function(obj, selector, cssprop) {
			selector.css(cssprop);
		},
		onmousein: function(obj, selector, cssprop) {
			selector.css(cssprop);
		},
		hovercss: function (obj, cssv, selector) {
			if(selector == null) {
				selector = $(obj).find(".edit");
			}
		}
	};
	var editform = {

	}
	valid.resetinp();
}

function hasgoodchar(inp){
	var uselesschar=" \t\n";
	for(var i=0;i<inp.length;i++){
		if(uselesschar.indexOf(inp[i])==-1)
			return true;
	}
	return false;
}


var loading = {
	showimg: function(selector) {
		$(selector).css("visibility", "visible");
	},
	hideimg: function(selector) {
		$(selector).css("visibility", "hidden");
	}
};


function setform(fselector, darr) {
	for(var i in darr) {
		fselector.find("[name="+i+"]").val(darr[i]);
	}
}

