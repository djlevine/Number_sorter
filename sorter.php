<?php
	/*
	 * url format: http://dlevine.us/phptest/numsort/sorter.php?numbers=5,1,2,1,7,3
	 *
	 * Compare each number to all other numbers in the array
	 * Push larger numbers to the end
	 * Push smaller numbers to the ordered array
	 * Push the last number to the ordered array (should be the largest)
	 */
	/*Let's get some stuff straight*/
	$numbers = $_GET['numbers'] = isset($_GET['numbers']) ? $_GET['numbers'] : "";
	$numbers = str_replace(" ", "", $numbers);
	$numbers = explode(",", $numbers);
	$numberslength = count($numbers);
	$ordered = array();
	$counter = 1;
	/*Use this to print out to screen*/
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

	foreach ($numbers as $element) {
	    if (!is_numeric($element)) {
	        array_push($ordered, "Please enter numbers.");
	        $ordered = json_encode($ordered);
			   echo ($ordered); 
			   exit(0); 
	    } 
	}

	/*Here's where the magic happens*/
	while($numberslength > 0){
		if($numberslength == 1){
			array_push($ordered, $numbers[0]);
			unset($numbers[0]);
			$numbers = array_values($numbers);
		} elseif($numbers[0] < $numbers[$counter]){
			if($counter < $numberslength-1){
				$counter += 1;
			} else {
				array_push($ordered, $numbers[0]);
				unset($numbers[0]);
				$numbers = array_values($numbers);
				$counter = 1;
				//showDebugLog($numbers, $ordered); //Print for debugging
			}
		}
		else{
			$moveToEnd = $numbers[0];
			unset($numbers[0]);
			array_push($numbers, $moveToEnd);
			$numbers = array_values($numbers);
		}
	$numberslength = count($numbers);
	}
	/*Send final output to json*/
	$ordered = json_encode($ordered);
	echo ($ordered);
?>

		