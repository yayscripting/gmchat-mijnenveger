<?php
// uique selection for mines
function selrand($min, $max){
	global $minesPlaced;

		$x = rand($min,$max);
		$y = rand($min,$max);

		if(! in_array($x."-".$y, $minesPlaced) ){

			// place in mine array
			$minesPlaced[] = $x."-".$y;

			return array($x, $y);

		}else{

			// search again
			return selrand($min, $max);
		}
}

// count mines
function countmines($x, $y){
	global $field;
	
	// set count to zero
	$count = 0;

	// count everything
	if($field[$x-1][$y] == 1){
		$count++;
	}

	if($field[$x+1][$y] == 1){
		$count++;
	}

	if($field[$x][$y-1] == 1){
		$count++;
	}

	if($field[$x][$y+1] == 1){
		$count++;
	}

	if($field[$x-1][$y-1] == 1){
		$count++;
	}

	if($field[$x-1][$y+1] == 1){
		$count++;
	}

	if($field[$x+1][$y+1] == 1){
		$count++;
	}

	if($field[$x+1][$y-1] == 1){
		$count++;
	}

	return $count;
}

// field creation
function createMijnenField($format, $mines){
	global $minesPlaced, $field;
	
	// variables
	$userMines	= 0;

	// create mine field
	for($m = 0; $m < $mines; $m++){
		
		$xy = selrand(1,$format);

		// place in minefield
		$field[$xy[0]][$xy[1]] = 1;

	}

	// create rest of field (x)
	for($fx = 1; $fx < ($format + 1); $fx++){

		// create rest of field (y)
		for($fy = 1; $fy < ($format + 1); $fy++){

			// when there is no mine
			if($field[$fx][$fy] != 1){
				
				// add normal state
				$mainField[$fx][$fy]['mine']  = '0';
				$mainField[$fx][$fy]['count'] = countmines($fx, $fy);

			}else{

				// add mine
				$mainField[$fx][$fy]['mine']  = '1';
				$mainField[$fx][$fy]['count'] = null;
			}			

		}
	}

	return $mainField;
}
