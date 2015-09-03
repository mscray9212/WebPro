<html>
<link href="css/style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="Form_check.js">
  </script>

  <style type="text/css">
    .mandatory { color: red }
  </style>
<body>

<?php
	$IDname="";
	$fname="";
	$lname="";
	$IDErr="";
	$fNameErr="";
	$lNameErr="";

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
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
   if (empty($_POST["IDname"])) {
     $IDErr = "ID is required";
   } else {
     $IDname = test_input($_POST["IDname"]);
     if (is_numeric($IDname)) {
        $IDname = $IDname;
     }
     else {
       $IDErr = "ID can not have letters."; 
       $IDname="";
     }
   }
   
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
 }

?>
<h2>Form Validation</h2><br>
<form action="index.php"
      method="post"
      id="signup_form"
      onsubmit="return checkCompleteness();">
<span class="error"><?php echo $IDErr;?><br></span>
<span class="mandatory">*</span><label name="IDname" id="ID_label" for="IDname">
ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
 <input id="visitor_ID" name="IDname" type="text" value=""/></p>
 <p>
<span class="error"><?php echo $fNameErr;?><br></span>
<span class="mandatory">*</span><label name="fname" id="fn_label" for="firstname">FirstName:&nbsp;</label>
 <input id="firstname" name="fname" type="text" value=""/></p>
<p>
<span class="error"><?php echo $lNameErr;?><br></span>
<span class="mandatory">*</span><label name="lname" id="ln_label" for="lastname">LastName:&nbsp;</label>
 <input id="lastname" name="lname" type="text" value=""/></p>

     <input type="submit" value="Add"> 
     <br><br>
</form>

<div>
  <?php if(!($IDname=="")&&!($fname=="")&&!($lname=="")){
	 echo "<h2>Form Details</h2>" .
	"ID: " . "<font color=\"#ffffff\">" .	$IDname . "</font><br>" . 
	"FirstName: "	. "<font color=\"#fffffff\">" .	ucfirst($fname) . "</font><br>".
	"LastName: " . "<font color=\"#fffffff\">" . ucfirst($lname) . "</font>";
}
  ?>   
</div>


</body>
</html>