function checkCompleteness()
{
    var form = document.getElementById("signup_form");

    length1 = form.IDname.value.length;
    length2 = form.fname.value.length;
    length3 = form.lname.value.length;
    userID = "ID_label";
    fname = "fn_label";
    lname = "ln_label";
    ID = "IDname";
    fn = "fname";
    ln = "lname";


    // restore black color to any elements previously flagged
    colorize("ID_label","black");
    colorize("fn_label","black");
    colorize("ln_label","black");

    validity(length1, length2, length3);

    isEmpty(userID, ID);
    isEmpty(fname, fn);
    isEmpyt(lname, ln);
    

    /*if( (form.IDname.value.length == 0 && form.fname.value.length > 0) 
    && form.lname.value.length > 0) { // ID not entered
	alert("You must enter an ID");
	colorize("ID_label","red");
	return false;
    }*/

    // passed all the checks: OK to submit
    
    return true;
}

function validity(form1, form2, form3) {
    startString="You must enter: ";
    var1string="";
    var2string="";
    var3string="";
    if(form1 == 0){    // ID not entered
        colorize("ID_label","red");
        var1string="ID, ";
        startString += var1string;
    }
    if(form2 == 0){    // First name not entered
        colorize("fn_label","red");
        var2string="First name, ";
        startString += var2string;
    }
    if(form3 == 0){ // Last name not entered
        colorize("ln_label","red");
        var3string="Last name";
        startString += var3string;
    }
    if(startString == "You must enter: "){
        return true;
    }
    else {
        return alert(startString);
    }
}

function colorize(elementName, color)
{
    document.getElementById(elementName).style.color = color;
}

function IsEmpty(form, label){
  if(document.forms['form'].question.value == "")
  {
    colorize(label,"red");
    return false;
  }
    return true;
}
