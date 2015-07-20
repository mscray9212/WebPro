<link href="rouletteFinal2.css" rel="stylesheet" type="text/css">
<?php
	//Put the string from text area into a variable
	$temp = $_POST['bet'];
	//This splits the array on the spaces and stores that an array
	$first = explode(" ", $temp);
	//Create an empty array for later
	$bets = array();
	//Create winning array for debug output later
	$winning = array();
	
	//This goes through our array and creates an associative array where the keys are the square and the values are the amounts
	foreach($first as $item){
		//Find the ':'
		$location = strpos($item, ':');
		//Use the string before the ':' as the key
		$key = substr($item, 0, $location);
		//Use the string after the ':' as the value
		$value = substr($item, $location + 1);
		//Assign the two to our associative array
		$bets[$key] = $value;
	}
	
	//These arrays store which values are black and which are red
	$bl = array(2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35);
	$red = array(1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36);
	
	//Our random number generator
	$rng = rand(0, 37);
	//These checks the various places the user can bet on the yellow horizontal part of the table
	$even = $rng%2 == 0;
	$_1st12 = ($rng > 0) && ($rng < 13);
	$_2nd12 = ($rng > 12) && ($rng < 25);
	$_3rd12 = ($rng > 24) && ($rng < 37);
	$_1to18 = ($rng > 0) && ($rng < 19);
	$_19to36 = ($rng > 18) && ($rng < 37);
	
	//This will keep how much was bet on each section
	$rngRlt = 0;
	$evenRlt = 0;
	$oddRlt = 0;
	$blRlt = 0;
	$redRlt = 0;
	$_1st12Rlt = 0;
	$_2nd12Rlt = 0;
	$_3rd12Rlt = 0;
	$_1to18Rlt = 0;
	$_19to36Rlt = 0;
	
	//Loop through our associative array
	foreach($bets as $keys => $values){
		if(strval($keys) === '00'){
			$keys = 37;
		}
		if(($rng == 0) || ($rng == 37)){
			if(strval($keys) == strval($rng)){
				$rngRlt += intval($values);
				array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
				break;
			}
			continue;
		}
		if($keys == $rng){
			$rngRlt += intval($values);
			$values = $values*35;
			array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
			continue;
		}
		if($keys === 'black'){
			foreach($bl as $color){
				if($rng == $color){
					$blRlt += intval($values);
					array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
					continue;
				}
			}
		}
		if($keys === 'red'){
			foreach($red as $color){
				if($rng == $color){
					$redRlt += intval($values);
					array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
					continue;
				}
			}
		}
		if(($keys === '1st12') && $_1st12){
			$_1st12Rlt += intval($values);
			array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
			continue;
		}
		if(($keys === '2nd12') && $_2nd12){
			$_2nd12Rlt += intval($values);
			array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
			continue;
		}
		if(($keys === '3rd12') && $_3rd12){
			$_3rd12Rlt += intval($values);
			array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
			continue;
		}
		if(($keys === '1to18') && $_1to18){
			$_1to18Rlt += intval($values);
			array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
			continue;
		}
		if(($keys === '19to36') && $_19to36){
			$_19to36Rlt += intval($values);
			array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
			continue;
		}
		if(($keys === 'even') && $even){
			$evenRlt += intval($values);
			array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
			continue;
		}
		if(($keys === 'odd') && !$even){
			$oddRlt += intval($values);	
			array_push($winning, 'Winning bet of '.$values.' on '.$keys.'!');
			continue;
		}
	}
	
	/*echo '<center><font face=Georgia size=10><u>Random Winning Number:</u> '.$rng.' &nbsp&nbsp Value of Bet: '.$rngRlt.'<br></font></center>';
	echo '<center><font face=Georgia size=10><u>Even</u> &nbsp&nbsp Value of Bet: '.$evenRlt.'<br></font></center>';
	echo '<center><font face=Georgia size=10><u>Odd</u> &nbsp&nbsp Value of Bet: '.$oddRlt.'<br></font></center>';
	echo '<center><font face=Georgia size=10><u>1st12:</u> '.$_1st12.'  &nbsp&nbsp    Value of Bet: '.$_1st12Rlt.'<br></font></center>';
	echo '<center><font face=Georgia size=10><u>2nd12:</u> '.$_2nd12.'  &nbsp&nbsp   Value of Bet: '.$_2nd12Rlt.'<br></font></center>';
	echo '<center><font face=Georgia size=10><u>3rd12:</u> '.$_3rd12.' &nbsp&nbsp    Value of Bet: '.$_3rd12Rlt.'<br></font></center>';
	echo '<center><font face=Georgia size=10><u>1to18:</u> '.$_1to18.'  &nbsp&nbsp   Value of Bet: '.$_1to18Rlt.'<br></font></center>';
	echo '<center><font face=Georgia size=10><u>19to36:</u> '.$_19to36.'  &nbsp&nbsp   Value of Bet: '.$_19to36Rlt.'<br></font></center>';
	echo '<center><font face=Georgia size=10><b><u>black:</u> '.$blRlt. '</b><br></font></center>';
	echo '<center><font color=red size=10><u>red:</u> '.$redRlt.'</font><br></center>';
	*/
	echo '<center><font face=Georgia size=10><br><u>Result of spin:</u><br><br></font></center>';
	
	foreach($winning as $result){
		echo '<center><font face=Georgia size=15>'.$result.'<br><br></font></center>';
	}
	if (empty($winning)){
		echo '<center><font face=Georgia size=15>You Lose! Sorry.<br></font></center>';
		echo '<center><font face=Georgia size=15>Winning Number is Shown Below: <br>'.$rng.'<br><br></font></center>';
	}

?>
<center>
  <table>
  <tr>
    <tr>
      <th rowspan="4"><div id="trapezoid"><br><br><br>
        <br><br><br><br><p id="rzero">0</p><p id="dzero">00</p></div></th>
    </tr>
    <tr>
      <td><div class="circle-container-red">3</div></td>
      <td><div class="circle-container-black">6</div></td>
      <td><div class="circle-container-red">9</div></td>
      <td><div class="circle-container-red">12</div></td>
      <td><div class="circle-container-black">15</div></td>
      <td><div class="circle-container-red">18</div></td>
      <td><div class="circle-container-red">21</div></td>
      <td><div class="circle-container-black">24</div></td>
      <td><div class="circle-container-red">27</div></td>
      <td><div class="circle-container-red">30</div></td>
      <td><div class="circle-container-black">33</div></td>
      <td><div class="circle-container-red">36</div></td>
      <td><div class="2-to-1"><p>2 to 1</p></div></td>
    </tr>
    <tr>
      <td><div class="circle-container-black">2</div></td>
      <td><div class="circle-container-red">5</div></td>
      <td><div class="circle-container-black">8</div></td>
      <td><div class="circle-container-black">11</div></td>
      <td><div class="circle-container-red">14</div></td>
      <td><div class="circle-container-black">17</div></td>
      <td><div class="circle-container-black">20</div></td>
      <td><div class="circle-container-red">23</div></td>
      <td><div class="circle-container-black">26</div></td>
      <td><div class="circle-container-black">29</div></td>
      <td><div class="circle-container-red">32</div></td>
      <td><div class="circle-container-black">35</div></td>
      <td border="0"><div class="2-to-1"><p>2 to 1</p></div></td>
    </tr>
    <tr>
      <td><div class="circle-container-red">1</div></td>
      <td><div class="circle-container-black">4</div></td>
      <td><div class="circle-container-red">7</div></td>
      <td><div class="circle-container-black">10</div></td>
      <td><div class="circle-container-black">13</div></td>
      <td><div class="circle-container-red">16</div></td>
      <td><div class="circle-container-red">19</div></td>
      <td><div class="circle-container-black">22</div></td>
      <td><div class="circle-container-red">25</div></td>
      <td><div class="circle-container-black">28</div></td>
      <td><div class="circle-container-black">31</div></td>
      <td><div class="circle-container-red">34</div></td>
      <td><div class="2-to-1"><p>2 to 1</p></div></td>
    </tr>
    <tfoot class="foot">
    <tr>
      <th colspan="1"></th>
      <td colspan="4">1st 12</td>
      <td colspan="4">2nd 12</td>
      <td colspan="4">3rd 12</td>
    </tr>
    <tr>
      <th colspan="1"></th>
      <td colspan="2">1 to 18</td>
      <td colspan="2">EVEN</td>
      <td colspan="2"><font color="red">RED</font></td>
      <td colspan="2"><font color="black">BLACK</font></td>
      <td colspan="2">ODD</td>
      <td colspan="2">19 to 36</td>
    </tr>
  </tfoot>
  </table>
</center>

