<?php
	// ini_set('display_startup_errors',1);
	// ini_set('display_errors',1);
	// error_reporting(-1);

	/*
	 * url format: http://dlevine.us/phptest/numsort/sorter.php?numbers=5,1,2,1,7,3
	 */

	//Get the numbers
	$numbers = $_GET['numbers'] = isset($_GET['numbers']) ? $_GET['numbers'] : "";
	//Make sure there are no spaces
	$numbers = str_replace(" ", ",", $numbers);
	//Explore to array
	$numbers = explode(",", $numbers);
	//How many items are there?
	$numberslength = count($numbers);
	$ordered = array();
	$counter = 1; // count our position

	function showDebugLog($arrayOne, $arrayTwo){
		$numberslength= $GLOBALS['numberslength'];
		$counter = $GLOBALS['counter'];
		if(!isset($arrayOne[$counter])){$counter=0;}
		echo "Input Numbers: <br>";
		print_r($arrayOne);

		//echo "<br><br>$arrayOne[0] compared to $arrayOne[$counter]";

		echo "<br><br>Re-ordered Numbers: <br>";
		print_r($arrayTwo);
		echo "<!--<br><br>Remaining Numbers: " . --$numberslength . "<br>--><hr>";
	}
	//showDebugLog($numbers, $ordered); //Print for debugging

	/*
	* Compare each number to all other numbers in the array
	* Push larger numbers to the end
	* Push smaller numbers to the ordered array
	* Push the last number to the ordered array (should be the largest)
	*/

	//Make sure something is in the array
	while($numberslength > 0){
		//If an array only has one item just push it
		if($numberslength == 1){
			//Push it to ordered
			array_push($ordered, $numbers[0]);
			// Remove it from the input array
			unset($numbers[0]);
			//Evaluate input array (make sure nothing is left)
			$numbers = array_values($numbers);
			//Break
			//If the number is not the last one 
			//evaluate to see if it's the smallest
		} elseif($numbers[0] < $numbers[$counter]){//Is it smaller than the next number
			if($counter < $numberslength-1){//If it is check to see if the next number is the last number
				$counter += 1; //If there's more than 2 numbers remaining keep checking
				//if this number is the smallest in the group push it to the ordered array
			} else {
				array_push($ordered, $numbers[0]); //Push it
				unset($numbers[0]); //Remove from the original array
				$numbers = array_values($numbers); //Re-evaluate the original array
				$counter = 1; //Reset the counter
				//showDebugLog($numbers, $ordered); //Print for debugging
			}
		}
		else{ //If the number is NOT the smallest in the group
			  //move it to the end
			$moveToEnd = $numbers[0]; //Store this number to a variable
			unset($numbers[0]); //Remove it from the original array
			array_push($numbers, $moveToEnd); //Push it to the end
			$numbers = array_values($numbers); //Re-evaluate it
		}
	//$numberslength = count($numbers); //Re-evaluate the length of numbers
	}

	//echo "<br> Final Order: "; print_r($ordered); echo "<br> Encode as json: ";

	$ordered = json_encode($ordered);
	echo ($ordered);
?>

		