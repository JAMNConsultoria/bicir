
function changeBGcolor(n, isReadOnly) {
	if(isReadOnly)
		document.getElementsByName(n)[0].style.backgroundColor = "#c0c0c0";		
	else
		document.getElementsByName(n)[0].style.backgroundColor = "#FFFFFF";		
}

function disableField(fld, isDisable) {

	if(fld.length != undefined) {	
		var f = document.getElementById(fld[0].name);
		if(fld[0].type == "radio") {
			for(var i = 0; i < fld.length; i++) {
				if(isDisable)
					fld[i].checked = false;
				fld[i].disabled = isDisable;
			}
		}
		else {
			if(isDisable)
				fld[0].selected = true;
			fld.disabled = isDisable;
		}
	}
	else {	
		if(isDisable)
			fld.value = "";
		fld.disabled = isDisable;
		changeBGcolor(fld.name, isDisable);
	}
}

function hideAndClean(fldName) {
	HideLayer(fldName);
	document.bloco[fldName].value='';
}

function anchorPerg(a) {
	location.href = '#'+ a;
}

function onlyNumber(e) {
	if ((e.keyCode >47 && e.keyCode < 59) || e.keyCode == 45) 
		e.returnValue = true;
	else
		e.returnValue = false;
}


function onlyNumberAndBar(e) {
	var t = allEve(e).key;
	if ((t >47 && t < 59) || t == 47 || t == 8 || t == 13 || t == 45) {
		e.returnValue = true;
	}
	else {
		if(document.all)
			e.returnValue = false;
		else
			e.preventDefault();
	}
}


function onlyNumberAndComma(e) {
	var t = allEve(e).key;
	if ((t >47 && t < 59) || t == 44 || t == 8 || t == 13) {
		e.returnValue = true;
	}
	else {
		if(document.all)
			e.returnValue = false;
		else
			e.preventDefault();
	}
}


function allEve(e) {
	var ev = (window.event)? window.event: e;
	if(!ev || !ev.type) 
		return false;
	var ME = ev;
	
	if(ME.type.indexOf('key')!= -1) {
	
		if(document.all || ME.type.indexOf('keypress')!= -1) {
		
			ME.key = (ev.keyCode)? ev.keyCode: ((ev.charCode)? ev.charCode: ev.which);
		}
		else ME.key= ev.charCode;
		if(ME.key) 
		ME.letter = String.fromCharCode(ME.key);
	}
	return ME;
}


function showFieldHidden(fld, arrDiv) {

	if(fld == undefined || fld.value == "")
		return;

	if(fld.type == 'radio' || fld.type == 'checkbox')
		if(!fld.checked)
			return;
	else if(fld.type == 'text')
		if(!fld.value != "")
			return;

	for(var i = 0; i < arrDiv.length; i++)
		ShowLayer(arrDiv[i]);
}

function hiddenFieldShow(fld, arrDiv) {

	if(fld == "undefined")
		return;

	if(fld.type == 'radio' || fld.type == 'checkbox')
		if(!fld.checked)
			return;
	else if(fld.type == 'text')
		if(!fld.value != "")
			return;

	for(var i = 0; i < arrDiv.length; i++)
		HideLayer(arrDiv[i]);
}


function whenClose(form) {

	if(!submitted) {
		if(confirm('Deseja salvar o bloco antes de sair?')) {
			checkForm(form);
		}
		else {
			return false;
		}
	}
}



function hideSelects(action) { 
	if (navigator.appName.indexOf("MSIE")) {
		for (var S = 0; S < document.forms.length; S++) {
			for (var R = 0; R < document.forms[S].length; R++) {
				if (document.forms[S].elements[R].options) {
					document.forms[S].elements[R].style.visibility = action;
				}
			}
		} 
	}
}


function getOnlyNumber(v) {
	if(isNaN(Number(v)))
		return 0;
	else
		return Number(v);
}