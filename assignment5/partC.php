<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Part C</title>
<script type="text/javascript" src="partC.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div action="getTime()">
	</div>
<center><p>Click <a href="index.html">here</a> for Part A &nbsp;|&nbsp; Click <a href="partB.php">here</a> for Part B</p></center>
<div id="intro">
<p>This is Part C: a simple guessing game for a secret number (1-100) that will respond to each guess with
	a hint to notify the user if they are right or wrong. If they are incorrect, the program will notify if the number is higher or lower
	than their previous guess. A guess limit of 10 tries will also be implemented. Have fun and good luck!
</div>

<?php

session_start();

// if counter is not set, set to zero
if(!isset($_SESSION['numLeft'])) {
    $_SESSION['numLeft'] = 0;
}

// if button is pressed, increment counter
if(isset($_POST['submit'])) {
    --$_SESSION['numLeft'];
}

// if random num is not set, set to random 
if(!isset($_SESSION['rand'])){
    $_SESSION['rand'] = rand(1,100);
} 
  $numMess = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $guess = $_POST['guess'];
      if($guess < 1 || $guess > 100) {
      $numMess = "Please pick a number from (1-100).";

    }else{
      if(($guess != $_SESSION['rand'])&&($_SESSION['numLeft']>0)){
        if(($guess < $_SESSION['rand'])){
        $numMess = "Your guess is too low. You have ".$_SESSION['numLeft']." attempt(s) left!";
        }
        if(($guess > $_SESSION['rand'])){
          $numMess = "Your guess is too high. You have ".$_SESSION['numLeft']." attempt(s) left!";
        }
      }
      elseif(($guess != $_SESSION['rand'])&&($_SESSION['numLeft']<1)){
        $numMess = "You are out of turns. Losing isn't fun, Try Again! ";
        $_SESSION['numLeft'] = 10;
        $_SESSION['rand'] = rand(1,100);
      }
      else{
        $numMess = "That is correct!";
        $_SESSION['numLeft'] = 10;
        $_SESSION['rand'] = rand(1,100);
      }
    }
  }
?>
<center><h2>Let's Play the Guessing Game!</h2></center><br>
<form name="guess_num"
		  action="partC.php" 
		  method="POST" 
		  align="center"
      onsubmit="return checkAnswer();">
      <center></center>
Number: 
<input type="text" name="guess" id="guess" value="" placeholder="Please enter 1 to 100" required>
<input type="hidden" name="num" value="<?php echo $_SESSION['numLeft']; ?>">
<input type="hidden" name="random" id="random" value="<?php echo $_SESSION['rand']; ?>">
<input type="submit" name="submit" value="Guess"><br>
<span class="incorrect" id="message"><?php echo $numMess;?></span>
</form>

</body>
</html>