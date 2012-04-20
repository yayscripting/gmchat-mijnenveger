// mijnveger.js
var openedCount = 1;
var bounce = new Array();
var stopprocid = false;
var mainInterval;
var handled = 0;

init = function(){
	mainInterval = setInterval('getVars()', 1000);

	if(iam == playerid){
		$('state_'+playerid).innerHTML = "Je bent aan de beurt";
		$('state_'+((playerid == 1) ? 2 : 1)).innerHTML = "&nbsp;";
	}else{
		$('state_'+playerid).innerHTML = "Wacht op je beurt";
		$('state_'+((playerid == 1) ? 2 : 1)).innerHTML = "&nbsp;";
	}

	for(var x=1; x < 11; x++){

		for(var y=1; y < 11; y++){

			$('field_'+x+'_'+y).addEvent('click', openField);

		}
	}

	$('startscreen').setStyle('display','none');
	$$('.container').setStyle('display','inline');
}

var getVars = function(){
	var sended2 = new Request.JSON({url: 'variables.php?session='+session+'&playerid='+playerid, onComplete: processVars}).send();
}

processVars = function(object){
	if(object.iam == playerid){
		$('state_'+playerid).innerHTML = "Je bent aan de beurt";
		$('state_'+((playerid == 1) ? 2 : 1)).innerHTML = "&nbsp;";
	}else{
		$('state_'+playerid).innerHTML = "Wacht op je beurt";
		$('state_'+((playerid == 1) ? 2 : 1)).innerHTML = "&nbsp;";
	}

	iam = object.iam;

	for(var m = openedCount; m < (object.fields + 1); m++){
		var objId = 'field_'+object.opened[m]['x']+'_'+object.opened[m]['y'];
		$(objId).removeEvent('click', openField);
		$(objId).setStyle('cursor','auto');
		$(objId).removeClass('lastp1');
		$(objId).removeClass('lastp2');

		if(object.opened[m]['m'] != 1){
			$(objId).innerHTML = ((object.opened[m]['c'] != 0) ? object.opened[m]['c'] : '');
			$(objId).addClass('grade_'+object.opened[m]['c']);
	

			$(objId).setStyle('background-color','#F1FF9F');
		}else{
			$(objId).innerHTML = "x";
			$(objId).addClass('grade_p'+object.opened[m]['w']);

			if(object.opened[m]['w'] == 1){
				$(objId).setStyle('background-color','#9FFF9F');
			}else{
				$(objId).setStyle('background-color','#FFA29F');
			}
		}
	}

	if(object.lastfield['f'] != null){
		$('field_'+object.lastfield['f']).addClass('lastp'+object.lastfield['w']);
	}

	$('score_1').innerHTML		= object.score[1];
	$('score_2').innerHTML		= object.score[2];

	// (50 - 2P1 + 2P2)/100*b
	$$('.p1left').setStyle('width',(50 - object.score[2] + object.score[1])/100*90);

	$('minesleft').innerHTML	= object.mines;

	if(object.win == playerid){
		$$('body').load('reset.php?i='+playerid+'&session='+session+'&n1='+playerOne+'&n2'+playerTwo);
	
		setTimeout("openReset();",4000);
		clearTimeout(mainInterval);
	
	}else
	if(object.win != playerid && object.win > 0){
		$$('body').load('reset.php?i='+playerid+'&session='+session+'&n1='+playerOne+'&n2'+playerTwo);

		setTimeout("openFieldAfterL();",4000);
		clearTimeout(mainInterval);
	}
}

openReset = function(){
	var sended3 = new Request.HTML({url: 'reset2.php?i='+playerid+'&session='+session+'&n1='+playerOne+'&n2'+playerTwo, onComplete: reloadJS}).send();
}

openFieldAfterL = function(){
	var sended4 = new Request.HTML({url: 'field.php?session='+session, onComplete: reloadJS}).send();
}

reloadJS = function(Tree, El, HTML, JS){
	$('body').innerHTML = HTML;
	init();
}

window.addEvent('domready', init);


openField = function(){
	if(iam == playerid){
		var openfieldsended = new Request.JSON({url: 'openField.php?session='+session+'&playerid='+playerid, onComplete: processOpenField}).send('field='+this.id.replace(/field_/gi,''));
		this.setStyle('background-color','#F1FF9F');

		iam = (iam == 1) ? 2 : 1;
	}
}

processOpenField = function(object){
	for(var m = openedCount; m < (object.fields + 1); m++){
		var objId = 'field_'+object.opened[m]['x']+'_'+object.opened[m]['y'];
		$(objId).removeEvent('click', openField);
		$(objId).setStyle('cursor','auto');

		if(object.opened[m]['m'] != 1){
			$(objId).innerHTML = object.opened[m]['c'];
			$(objId).addClass('grade_'+object.opened[m]['c']);
	

			$(objId).setStyle('background-color','#F1FF9F');
		}else{
			$(objId).innerHTML = "x";
			$(objId).addClass('grade_'+((object.opened[m]['w'] == playerid) ? 'mself' : 'mother'));

			if(object.opened[m]['w'] == playerid){
				$(objId).setStyle('background-color','#9FFF9F');
			}else{
				$(objId).setStyle('background-color','#FFA29F');
			}
		}
	}
}