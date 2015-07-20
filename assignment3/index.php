<html>
<title>Form Page</title>
  <script type="text/javascript" src="Form_check.js">
  </script>
<body>
<p><h3>Go to <a href="calendar.php">Calendar</a></h3></p>
<?php
session_start();
// define variables and set to empty values
$colErr = $styleErr = $famErr = "";
$color = $style = $family = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["color"])) {
     $colErr = "Color is required";
   } else {
     $color = test_input($_POST["color"]);
     $_SESSION['color']=$color;
     if (!preg_match("/^[a-zA-Z ]*$/",$color)) {
       $colErr = "Only colors and hexadecimal values are allowed."; 
     }
   }
   
   if (empty($_POST["style"])) {
     $styleErr = "Style is required";
   } else {
     $style = test_input($_POST["style"]);
     $_SESSION['style']=$style;
     if (!preg_match("/^[a-zA-Z ]*$/",$style)) {
       $styleErr = "Invalid style format."; 
     }
   }
     
   if (empty($_POST["family"])) {
     $famErr = "Family is required";
   } else {
     $family = test_input($_POST["family"]);
     $_SESSION['family']=$family;
     if (!preg_match("/^[a-zA-Z ]*$/",$family)) {
       $famErr = "Invalid font-family"; 
     }
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
     $_SESSION['comment']=$comment;
   }

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>PHP Form Styling</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="./output.php"> 
    <!--  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  -->
     Font color: <input type="text" name="color" value="<?php echo $color;?>">
     <span class="error">* <?php echo $colErr;?></span>
     <br><br>
     Font style: <input type="text" name="style" value="<?php echo $style;?>">
     <span class="error">* <?php echo $styleErr;?></span>
     <br><br>
     Font family: <input type="text" name="family" value="<?php echo $family;?>">
     <span class="error">* <?php echo $famErr;?></span>
     <br><br>
     Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
     <br><br>
     <br><br>
     <input type="submit" name="submit" value="Submit"> 
</form>



</body>
</html>