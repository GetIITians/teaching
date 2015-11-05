var mohit={
		alerthelp:{
			alertShowButton:null,
			init:function(){
				if(this.alertShowButton!=null){
					this.alertShowButton.setAttribute("data-target","#alertPopupId");
					return;
				}
				var alertShowButton=document.createElement("button");
				alertShowButton.setAttribute("data-toggle","modal");
				alertShowButton.setAttribute("data-target","#alertPopupId");
				alertShowButton.style.display="none";
				document.body.appendChild(alertShowButton);
				this.alertShowButton=alertShowButton;
			},
			isdisplayed:function (){
				var temp=$("#alertPopupId")[0].style.display;
				return (temp!="none" && temp!="" );
			}
		},
		alert:function(text){
			if(this.alerthelp.isdisplayed())
				return;
			this.alerthelp.init();
			this.alerthelp.alertShowButton.click();
			$("#alertText").html(""+text);
		},
		confirmhelp:{
			init:function(){
				mohit.alerthelp.init();
				mohit.alerthelp.alertShowButton.setAttribute("data-target","#confirmPopupId");
			},
			isdisplayed:function (){
				var temp=$("#confirmPopupId")[0].style.display;
				return (temp!="none" && temp!="" );
			}
		},
		confirm:function(text,f,obj){
			if(this.confirmhelp.isdisplayed())
				return;
			this.confirmhelp.init();
			this.alerthelp.alertShowButton.click();
			$("#confirmText").html(""+text);
			$("#confirmconfirm").attr("onclick",f);
		}
	};

var mohit={
	lastclickedinside:0,
	clickoutside:function(obj){
		var delay=50;//ms
		setTimeout(function(){
			if(time("m")-mohit.lastclickedinside>delay*2){
				mohit.closeme(obj);
			}
		},delay);
	},
	clickinside:function(obj){
		mohit.lastclickedinside=time("m");
	},
	popup:function(id,data,narayan){ 
		if(id==null)
			id="";
		if(data==null)
			data={};
		if(narayan==null || undefined)
			narayan=false;
		mergeifunset(data,{"title":null,"body":null});
		//console.log(data);
		for(i in data){ 
			if(data[i]!=null)
				$("#"+id+"Popup"+i).html(data[i]);
		}

		var prvvisib=$('#'+id+"Popupmain").css("visibility");
		var animtime=500;
		$('#'+id+"Popupmain").css("visibility","hidden");
		$('#'+id+"Popup").css("visibility","hidden");
		$('#'+id+"Popup").fadeIn(100,function(){
			var anim=["width","left","top"];
			var oldvals={};
			for(var i=0;i<anim.length;i++){
				oldvals[anim[i]]=$("#"+id+"Popuplayer").css(anim[i]);
			}
			oldvals["height"]="auto";
			var defaultvals={"width":"2%","left":"48%","top":"48%"};
			$("#"+id+"Popuplayer").css(defaultvals);
			$('#'+id+"Popup").css("visibility","visible");
			if(narayan){
				oldvals['width']	=	narayan['width'];
				oldvals['left']		=	narayan['left'];
			}
			$("#"+id+"Popuplayer").animate(oldvals,animtime,function(){
					$('#'+id+"Popupmain").css("visibility",prvvisib);
			});
		});
	},
	alert:function(msg){
		mohit.popup("alert",{"title":"Alert","body":msg});
	},
	closeme:function(obj){
		$(obj).fadeOut();
//		$("#"+$(obj).attr("id")+"body").html("");
	},
	popup_close:function(id){
		mohit.closeme( $("#"+id+"Popup")[0] );
	}
};

$(document).keyup(function(e) {
	if(e.keyCode == 27){
		var allpopup=$('.PopupWrapper');
		for(var i=0;i<allpopup.length;i++){
			mohit.closeme(allpopup[i]);
		}
	}
});
/* By Yogy */
var yogy = {
	confirm:function(obj) { 
		var ch=confirm("Are You Sure to Delete ?");
		if(ch)
			button.sendreq_v2(obj);
	}
}
/* ..... */
