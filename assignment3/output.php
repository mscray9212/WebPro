<html>
	<title>Output</title>
<body>
<p><h3>Go to <a href="./">Form</a></h3></p>

<?php
session_start();
$color=$_REQUEST['color'];
$style=$_REQUEST['style'];
$family=$_REQUEST['family'];
$comment=$_REQUEST['comment'];

echo "<h2>Comment section attributes:</h2> ";
echo "Font color: "; echo $color; echo "<br>"; 
echo "Font style: "; echo $style; echo "<br>"; 
echo "Font family: "; echo $family; echo "<br>";
echo "<br>";
?>

<div style="color: <?php echo $color; ?>">
	<div style="font-style: <?php echo $style; ?>">
		<font face=" <?php echo $family; ?>">
			<?php echo $comment;?>
		</font>
	</div>
</div>


</body>
</html>