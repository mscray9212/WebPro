var grid = [[0, 0, 0, 0, 0, 0],
			[0, "first", "second", "third", "fourth", 0],
			[0, "fifth", "sixth", "seventh", "eigth", 0],
			[0, "ninth", "tenth", "eleventh", "twelfth", 0],
			[0, "thirteenth", "fourteenth", "fifteenth", "zero", 0],
			[0, 0, 0, 0, 0, 0]];
			
var tempGrid = [[0, 0, 0, 0, 0, 0],
			[0, "first", "second", "third", "fourth", 0],
			[0, "fifth", "sixth", "seventh", "eigth", 0],
			[0, "ninth", "tenth", "eleventh", "twelfth", 0],
			[0, "thirteenth", "fourteenth", "fifteenth", "zero", 0],
			[0, 0, 0, 0, 0, 0]];
			
var shuffledBoard = [];
var prevChoice;
var moves = 0;
var start = 0;
var count = 0;
var initial = 0;
var delay=1000;

$(document).ready(function(){
	var background = $("div input[type='radio']:checked").val();
	$("input[name=image]").click(function(){
    	$(".handle").removeClass(background);
    	$(".handle").addClass($(this).val());
    	background = $("div input[type='radio']:checked").val();
    	if(background == 'bowser'){
    		$(".row1 > div").removeClass("a ac ad");
    		$(".row2 > div").removeClass("b bc bd");
    		$(".row3 > div").removeClass("c cc cd");
    		$(".row4 > div").removeClass("d dc dd");
    		$(".row1 > div").addClass("ab");
    		$(".row2 > div").addClass("bb");
    		$(".row3 > div").addClass("cb");
    		$(".row4 > div").addClass("db");
    		
    	} else if(background == 'zombie'){
    		$(".row1 > div").removeClass("ab ac ad");
    		$(".row2 > div").removeClass("bb bc bd");
    		$(".row3 > div").removeClass("cb cc cd");
    		$(".row4 > div").removeClass("db dc dd");
    		$(".row1 > div").addClass("a");
    		$(".row2 > div").addClass("b");
    		$(".row3 > div").addClass("c");
    		$(".row4 > div").addClass("d");
    	} else if(background == 'huh'){
    		$(".row1 > div").removeClass("a ab ad");
    		$(".row2 > div").removeClass("b ab bd");
    		$(".row3 > div").removeClass("c ab cd");
    		$(".row4 > div").removeClass("d ab dd");
    		$(".row1 > div").addClass("ac");
    		$(".row2 > div").addClass("bc");
    		$(".row3 > div").addClass("cc");
    		$(".row4 > div").addClass("dc");
    	} else if(background == 'element'){
    		$(".row1 > div").removeClass("a ab ac");
    		$(".row2 > div").removeClass("b ab ac");
    		$(".row3 > div").removeClass("c ab ac");
    		$(".row4 > div").removeClass("d ab ac");
    		$(".row1 > div").addClass("ad");
    		$(".row2 > div").addClass("bd");
    		$(".row3 > div").addClass("cd");
    		$(".row4 > div").addClass("dd");
    	}
	});

$(document).on('mouseenter', '.handle', function() {
		if(unchangedCheck(this.id)){
			$(this).addClass("handle_hover");
		};
	});
	
	$(document).on("mouseout", ".handle", function() {
		$(this).removeClass("handle_hover");
	});
	
 	$(document).on('click', '.handle', function() {
 		var check = this.id;
 		var a = "#" + this.id;
		var solcounter = 0;
 		if(checkMove(check)){
 			shuffledBoard.push(check);
	 		div1 = $(a);
	 		div2 = $('#zero');
	 		tdiv1 = div1.clone();
	 		tdiv2 = div2.clone();
	 		div1.replaceWith(tdiv2);
	 		div1.removeClass()
	 		div2.replaceWith(tdiv1);
	 		counter();

			for(var i = 1; i < 5; i++){
				for(var j = 1; j < 5; j++){
					if(tempGrid[i][j] == grid[i][j]){
					solcounter++;
						if(solcounter == 16){
							//added a delay so user can see the finished image before win notification becomes visible.
							setTimeout(function(){
							document.getElementById('image1').style.visibility='visible';
							}, delay);
						}
					}
				}
			}
	 		if(start == 0 && initial == 0) {
	 			start++;
	 			initial++;
	 			clock();
	 		}
	 	}
 	});
});

function checkMove(check) {
	for(var i = 0; i < 6; i++){
		for(var j = 0; j < 6; j++){
			if(tempGrid[i][j] == check){
				if(tempGrid[i-1][j] == "zero"){
					tempGrid[i][j] = "zero";
					tempGrid[i-1][j] = check;
					return true;
				}else if(tempGrid[i][j-1] == "zero"){
					tempGrid[i][j] = "zero";
					tempGrid[i][j-1] = check;
					return true;
 				}else if(tempGrid[i+1][j] == "zero"){
 					tempGrid[i][j] = "zero";
 					tempGrid[i+1][j] = check;
 					return true;
 				}else if(tempGrid[i][j+1] == "zero"){
 					tempGrid[i][j] = "zero";
 					tempGrid[i][j+1] = check;
 					return true;
 				}
			}
		}
	}
	return false;
}

function unchangedCheck(check) {
	for(var i = 1; i < 5; i++){
		for(var j = 1; j < 5; j++){
			if(tempGrid[i][j] == check){
				if(tempGrid[i-1][j] == "zero"){
					return true;
				}else if(tempGrid[i][j-1] == "zero"){
					return true;
 				}else if(tempGrid[i+1][j] == "zero"){
 					return true;
 				}else if(tempGrid[i][j+1] == "zero"){
 					return true;
 				}
			}
		}
	}
	return false;
}

function shuffle(diff) {
	//reset clock and number of moves
	start = count = moves = 0;
	//how many times we want to shuffle the tiles
	var loops = diff;
	document.getElementById('image1').style.visibility='hidden';
	//var loops = 20;
	//loop for that many times
	while(loops > 0){
		//nested loop to cycle through our grid array
		for(var i = 0; i < 6; i++){
			for(var j = 0; j < 6; j++){
				//this will hold our possible moves for our blank square
				var choices = [];
				//this will hold our associative array keys
				var tem = [];
				//checks to see when we have found our blank square
				if(tempGrid[i][j] == "zero"){
					//checks to makes sure we are looking at our border padding of 0's
					//each if statement check the possible neighbors of zero and stores them
					//in an associative array. The keys of the associative array will be used
					//later to figure out what piece to switch
					if(tempGrid[i-1][j] !== 0 && tempGrid[i-1][j] != prevChoice){
						choices[0] = tempGrid[i-1][j];
						tem.push(0);
					}
					if(tempGrid[i][j-1] !== 0 && tempGrid[i][j-1] != prevChoice){
						choices[1] = tempGrid[i][j-1];
						tem.push(1);
	 				}
	 				if(tempGrid[i+1][j] !== 0 && tempGrid[i+1][j] != prevChoice){
	 					choices[2] = tempGrid[i+1][j];
	 					tem.push(2);
	 				}
	 				if(tempGrid[i][j+1] !== 0 &&tempGrid[i][j+1] != prevChoice){
	 					choices[3] = tempGrid[i][j+1];
	 					tem.push(3);
	 				}
	 				//picking a random key to switch with zero
	 				var rand = tem[Math.floor(Math.random() * tem.length)];
	 				//div1 one will be the selected tile
	 				div1 = choices[rand];
	 				prevChoice = div1;
	 				shuffledBoard.push(div1);
	 				//div2 will be our zero tile
			 		div2 = "zero";
			 		//the newDivs are jQuery objects that will be used to clone and switch later
			 		newDiv1 = $('#' + div1);
			 		newDiv2 = $('#' + div2);
			 		//This places our zero array element at it's new location, replacing the tile it switches with
			 		tempGrid[i][j] = div1;
			 		//we need to check our keys to figure out which array element to switch with zero
			 		if(rand == 0){
			 			tempGrid[i-1][j] = div2;
			 		}else if(rand == 1){
			 			tempGrid[i][j-1] = div2;
			 		}else if(rand == 2){
			 			tempGrid[i+1][j] = div2;
			 		}else if(rand == 3){
			 			tempGrid[i][j+1] = div2;
			 		}
			 		//now we clone the two divs and swap them with each other
			 		tdiv1 = newDiv1.clone();
			 		tdiv2 = newDiv2.clone();
			 		newDiv1.replaceWith(tdiv2);
			 		newDiv1.removeClass();
			 		newDiv2.replaceWith(tdiv1);
			 		loops -= 1; // decrease out loop counter
			 		i = 7; //break out of outer loop
			 		j = 7; //break out of inner loop
				}
			}
		}
	}
}


function solve(){
	/*
	for(var i = shuffledBoard.length - 1; i >= 0; i--){
		alert("i: " + i);
		setTimeout(function(){
			var tempDiv1 = $("#" + shuffledBoard[i]);
			var tempDiv2 = $("#zero");
			var tdiv1 = tempDiv1.clone();
			var tdiv2 = tempDiv2.clone();
			tempDiv1.replaceWith(tdiv2);
			tempDiv1.removeClass();
			tempDiv2.replaceWith(tdiv1);
		}, 1000, i);
		
				
	}*/
	var counter = 0;
	var i = shuffledBoard.length - 1;
	
	var k = setInterval(function(){
		var tempDiv1 = $("#" + shuffledBoard[i]);
		var tempDiv2 = $("#zero");
		var tdiv1 = tempDiv1.clone();
		var tdiv2 = tempDiv2.clone();
		tempDiv1.replaceWith(tdiv2);
		tempDiv1.removeClass();
		tempDiv2.replaceWith(tdiv1);
		i -= 1;
		counter += 1;
		if(counter == shuffledBoard.length){
			clearInterval(k);
		}
	}, 1000);
	
		
}

function counter() {
	moves += 1;
	move = document.getElementById('moves');
	if(moves > 0 && moves < 20) {
		move.style.color = 'lime';
	}
	else if(moves >= 20 && moves <= 60) {
		move.style.color = 'orange';
	}
	else if(moves > 60) {
		move.style.color = 'red';
	}
	document.getElementById("moves").innerHTML = moves;
}

function clock() {
	timer = document.getElementById('clock');

	check = setInterval(function () {
		count += 1;
		if(count > 0 && count <= 50) {
			timer.style.color = 'lime';
		}
		if(count > 50 && count <= 180) {
			timer.style.color = 'orange';
		}
		if(count > 180) {
			timer.style.color = 'red';
		}
		document.getElementById("clock").innerHTML = count;
	}, 1000);
}

function getDiff() {
	var diff = document.getElementById("shuffle");
	var difficulty = diff.options[diff.selectedIndex].value;
	shuffle(difficulty);
}

function refresh() {
	location.reload();
}
/*
function getDiff() {
	var diff = document.getElementsByName('diff');
	for(var i = 0, length = diff.length; i < length; i++) {
		if(diff[i].checked) {
			difficulty = diff[i].value;
			break;
		}
	}
}
*/
