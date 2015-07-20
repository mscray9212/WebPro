<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Assignment 5 | Part B</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<center><p>Click <a href="index.html">here</a> for Part A &nbsp;|&nbsp; Click <a href="partC.php">here</a> for Part C</p></center>

<p>This is Part B: Create a web page that uses JavaScript to print a payroll report for a company
that has a few employees, all earning the same hourly wage: $15 per hour for up
to 40 hours per week. If the employee worked more than 40 hours, the hours in
excess of 40 are paid at one and a half times this rate.
The user enters the (integer) number of hours worked in the week for each
employee in a pop-up box. Use an open-ended loop so that the number of
employees can vary. Have the user enter a negative number such as -1 to indicate
that there are no more employees to enter. (The program should do something
reasonable if the user enters -1 as the first value.)
The program prints, as web page contents, a table containing three columns. The
first column is simply an index that increases from 1 up to the number of 
employees processed. The second column is the number of hours worked,
entered by the user. The third column is the employee's pay for the week. After
the table, please print out a summary line giving the total pay of all the
employees.
The output does not need to be fancy, but correct and readable. The table
columns should have headings identifying them, and the total pay should a
suitable label.
Place the JavaScript code into an external file, referenced by the src attribute of
the tag. </p>

<?php
	session_start();
  $final=false;
  // if button is pressed, retrieve data
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST['name'];
    if($name == "-1")
    {
        if(!(is_array($_SESSION)))
        {
            echo "Please provide at least one employee";
        }
        elseif(is_array($_SESSION))
        {
            $final = true;
            /*
            $name = "";
            $hourly = 0;
            $tmp = 0;
            $_SESSION[$name]['num'] = $hourly;
            $_SESSION[$name]['earn'] = $tmp;
            */
        }
    }
    elseif($name != "-1")
    {
        $hourly =   $_POST['num'];
        // Don't add if the hours are not numbers
        /*if($name == "-1"){
          $final = true;
          $name = "";
          $_SESSION[$name]['num'] = 0;
          $_SESSION[$name]['earn'] = 0;
          return;
        }
        else
        {*/
        // You could return either an error or false here
        // then make an error message if not added
        if(!is_numeric($_POST['num']))
        {
            return;
        }
        // Since you don't have any more than two scenarios,
        // you can just check for one, the other is default
        $tmp    =   ($hourly <= 40)? $hourly * 15 : (($hourly-40)*(27.5)+(40*15));
        // Assign the values here
        // You can store the name as the key, or make this a numbered array
        // And store name in a new key/value pair
        $_SESSION[$name]['num']     =   $hourly;
        $_SESSION[$name]['earn']    =   $tmp;
        //AddEmployee();
    }
}
	/*
  $user=array();
	$hours=array();
  $earned=array();
  $name="";
  $hourly=0;
	$tmp=0;

	// if button is pressed, retrieve data
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = $_POST['name'];
		$hourly = $_POST['num'];
    $_SESSION['name'] = array();
    array_push($_SESSION['name'],$name);
    $_SESSION['num'] = array();
    array_push($_SESSION['num'],$hourly);
    	if($hourly <= 40){
    			$tmp = $hourly * 15;
          $_SESSION['earn'] = array();
          array_push($_SESSION['earn'], $tmp);
          //array_push($earned,$tmp);
			}
			elseif($hourly > 40){
				  $tmp = (($hourly-40)*(27.5)+(40*15));
          $_SESSION['earn'] = array();
          array_push($_SESSION['earn'], $tmp);
          //array_push($earned,$tmp);
			}
    $_SESSION['earn'] = array();
    array_push($_SESSION['earn'], $tmp);
	}*/

?>
<br><br>
<div class="container" align="center">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Insert New</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Insert New Employee</h4>
                <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Employee Name">
                </div>
                <div class="form-group">
                    <input type="number" name="num" class="form-control" id="num" min="0" placeholder="Hours Worked">
                </div>
                <div>
                    <input type="hidden" name="earn" class="form-control" id="earn">
                </div>
                <button type="submit" name ="submit" id="submit" class="pull-right btn btn-primary">Add</button>
                <button type="button" class="pull-right btn btn-default" data-dismiss="modal">Close</button>
                <button type="reset" class="btn btn-default">Reset</button>
                <div class="clearfix"></div>
          </form>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<table style="width:40%" align="center">
  <caption><h2><center>Employee Payroll</center></h2></caption>
  <thead>
    <tr>
    <th width="10%"><center>Index</center></th>
    <th width="10%"><center>Name</center></th>
    <th width="10%"><center>Hours Worked</center></th>
    <th width="10%"><center>Weekly Earnings</center></th>
    </tr>
  </thead>
  <tbody>
    <?php 
        if(is_array($_SESSION)) {
                $i = 1;
                $hrs = 0;
                $mon = 0;
                foreach($_SESSION as $name => $array){
                    /*if($final=true){
                      echo '<tr>
                              <td><center>'.$i.'</center></td>
                              <td><center>'.'</center></td>
                              <td><center>Total Hours: '.array_sum($array['num']).'</center></td>
                              <td><center>Total Paid: $'.array_sum($array['earn']).'</center></td>
                            </tr>';
                    }
                    else{*/
                    echo '
                    <tr>
                        <td><center>'.$i.'</center></td>
                        <td><center>'.$name.'</center></td>
                        <td><center>'.$array['num'].'</center></td>
                        <td><center>$'.$array['earn'].'</center></td>
                    </tr>';
                    $hrs = $hrs + $array['num'];
                    $mon = $mon + $array['earn'];
                    $i++;
                }
                echo "</tbody><tfoot>";
                if($final){
                    echo '
                    <tfoot><tr>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center>Total Hours: '.$hrs.'</center></td>
                        <td><center>Total Paid: $'.$mon.'</center></td>
                    </tr>';
                    }
                echo "</tfoot>";
        }
    ?>

</table>
<!--
<table style="width:50%" align="center" id="tab">
  <caption><h2><center>Employee Payroll</center></h2></caption>
  <thead>
    <tr>
    <th><center>Index</center></th>
    <th><center>Hours Worked</center></th>
    <th><center>Weekly Earnings</center></th>
    </tr>
  </thead>
  <tbody>
    <?php   
        foreach($_SESSION['name'] as $keys=>$values){
          echo "<tr><td><center>".($keys+1)."</center></td>";
          foreach($_SESSION['num'] as $keys=>$values){
            echo "<td><center>".$values."</center></td>";
            foreach($_SESSION['earn'] as $keys=>$values){
              echo "<td><center>".$values."</center></td></tr>";
            }
          }
        }
    ?>
  </tbody>
  <tfoot>

  </tfoot>
</table>
-->
</div>
</body>
</html>