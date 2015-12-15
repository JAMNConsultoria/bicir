var __please = 'Por favor, preencha o campo';

function checkSelect(fld) {
	for(var i = 0; i < fld.options.length; i++) {
		if(fld.options[i].selected == true && fld.options[i].value != "") {
			return true;
		}
	}
	return false;
}

function checkRadioCheckbox(fld) {
	for(var i = 0; i < fld.length; i++) {
		if(fld[i].checked == true) {
			return true;
		}
	}
	return false;
}

function checkInputText(fld) {
	if(fld.value == '') {
		fld.focus();
		return false;
	}
	else
		return true;
}




function alertSelect(message) {
	alert('Por favor, selecione a questão\n'+ message);
}

function alertRadio(message) {
	alert('Por favor, selecione a questão\n'+ message);
}

function alertCheckBox(message) {
	alert('Por favor, selecione uma das opções da questão\n'+ message);
}

function alertInputText(message) {
	alert('Por favor, preencha o campo \n'+ message);
}


function validationForm(form, arrFld) {

	for(var i = 0; i < arrFld.length; i++) {

		if(document.getElementById(arrFld[i]) == undefined) {
			continue;
		}
			
		if(document.getElementById(arrFld[i]).type == 'text' || document.getElementById(arrFld[i]).type == 'password') {
			if(!checkInputText(document.getElementById(arrFld[i]))) {
				alert('Por favor, preencha o campo '+ document.getElementById(arrFld[i]).title);
				return false;
			}
			if(document.getElementById(arrFld[i]).name.indexOf("email") != -1) {
				var filter=/^.+@.+\..{2,3}$/
				if(!filter.test(document.getElementById(arrFld[i]).value)) {
					alert("E-mail incorreto");
					return false;
				}
			}
		}
		else if(document.getElementById(arrFld[i]).type == 'textarea') {
			if(!checkInputText(document.getElementById(arrFld[i]))) {
				alert('Por favor, preencha o campo '+ document.getElementById(arrFld[i]).title);
				return false;
			}
		}
		else if(document.getElementById(arrFld[i]).type == 'radio' || document.getElementById(arrFld[i]).type == 'checkbox') {
			if(!checkRadioCheckbox(form[arrFld[i]])) {
				alert('Por favor, selecione uma das opções do campo '+ document.getElementById(arrFld[i]).title);
				return false;
			}
		}
		else if(document.getElementById(arrFld[i]).type.indexOf('select') != -1 ) {
			if(!checkSelect(document.getElementById(arrFld[i]))) {
				alert('Por favor, selecione uma das opções do campo '+ document.getElementById(arrFld[i]).title);
				return false;
			}
		}
	}
	return true;
}


function onlyNumber(e) {
	var t = allEve(e).key;
	if ((t >= 48 && t <= 57) || t == 8 || t == 13) {
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
	if ((t >= 48 && t <= 57) || t == 44 || t == 8 || t == 13) {
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