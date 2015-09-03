<html>
<body>

<?php
	$fname="";
	$lname="";
	$numb="";
	$fNameErr="";
	$lNameErr="";
	$numbErr="";

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function format_phone($phoneNum) {
	$newNum = preg_replace('/[^0-9]/','',$phoneNum);
	echo $newNum;
	if (strlen($newNum) == 10) {
		$area = substr($newNum,0,3);
		$mid = substr($newNum,3,3);
		$last = substr($newNum,6,4);
		$phoneNum = '('.$area.')'.$mid.'-'.$last;
	}
	elseif (strlen($newNum) != 10) {
		$numbErr = "Phone number should only have 10 digits";
	}
	return $phoneNum;
}

function is_string_numeric($string) 
 { 
   if(preg_match('^[0-9]^',$string)) 
    { 
      return true; 
    } else { 
      return false; 
    } 
 }  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["fname"])) {
     $fNameErr = "First name is required";
   } else {
     $fname = test_input($_POST["fname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
       $fNameErr = "First name should not have any numbers."; 
       $fname="";
     }
   }
   
   if (empty($_POST["lname"])) {
     $lNameErr = "Last name is required";
   } else {
     $lname = test_input($_POST["lname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
       $lNameErr = "Last name should not have any numbers.";
       $lname=""; 
     }
   }
     
   if (empty($_POST["numb"])) {
     $numbErr = "Phone number is required";
   } else {
     $numb = test_input($_POST["numb"]);
     if (is_numeric($numb) && strlen($numb)==10) {
     	$numb = format_phone($_POST["numb"]);
     }
     else {
       $numbErr = "Please enter a 10 digit number (no special characters)."; 
       $numb="";
   }
   }

}

?>

<p><span class="error">* required field.</span></p>
<form name="main" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <!--  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  -->
     First name: <input type="text" name="fname" value="<?php echo $fname;?>">
     <span class="error">* <?php echo $fNameErr;?></span>
     <br><br>
     Last name: <input type="text" name="lname" value="<?php echo $lname;?>">
     <span class="error">* <?php echo $lNameErr;?></span>
     <br><br>
     Phone number: <input type="text" name="numb" value="<?php echo $numb;?>">
     <span class="error">* <?php echo $numbErr;?></span>
     <br><br>

     <input type="submit" value="Submit"> 
     <br><br>
</form>

<div>
	<?php echo "<h2>Form Details</h2>" .
	"Name: " . 	ucfirst($fname) . " " . 
				ucfirst($lname) . "<br><br>".
				"Contact: " . $numb; ?>     
</div>


</body>
</html>