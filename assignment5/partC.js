function checkAnswer()
{
    var form = document.getElementById("guess_num");

    if(document.form.numLeft.length = 0 || !(isNumber(numGuess))) { // number not entered
	     colorize("message","red");
	     return false;
    }

    if(document.getElementById("guess").value == document.getElementById("random").value) { // name entered
	     colorize("message","green");
	     return false;
    }

    // passed all the checks: OK to submit
  
    return true;
}


function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function colorize(elementName, color)
{
    document.getElementById(elementName).style.color = color;
}