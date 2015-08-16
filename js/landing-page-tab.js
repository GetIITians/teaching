var landingPageTab = {
	icon     : $('#landingPageTab .closeIcon i'),
	//state = current state of Landing Page Tab {true:open,false:close}
	setState : function(state){
		localStorage.setItem('state',JSON.stringify(state));
	},
	getState : function(){
		return JSON.parse(localStorage.getItem('state'));
	},
	toggleState : function(e){
		$(this).next('.content').toggle(100);
		if(landingPageTab.getState()){
			//closing
			$(this).find('i').animate({'font-size': '2rem'}, 100);
			$(this).find('i').css({'transform': 'rotate(45deg)'});
		}else{
			//opening
			$(this).find('i').animate({'font-size': '3rem'}, 100);
			$(this).find('i').css({'transform': 'rotate(90deg)'});
		}
		landingPageTab.setState(!landingPageTab.getState());
	},
	siteWide : function(){
		console.log('siteWide func was run');
		landingPageTab.icon.parent().next('.content').hide();
		landingPageTab.icon.css({'transform': 'rotate(45deg)','font-size': '2rem'});
	},
	profileTabContent : function(){
		// This function is called @ main.js::287, in the function booktopic
		landingPageTab.icon.parent().next('.content').find('span').html('Step 3&nbsp;:&nbsp;Select a time slot for your free class of 1 Hour');
	}
}


$(function() {

if (landingPageTab.getState() === null)
	landingPageTab.setState(true);

if (!landingPageTab.getState())
	landingPageTab.siteWide();

$(document).on('click','#landingPageTab .closeIcon', landingPageTab.toggleState);

});