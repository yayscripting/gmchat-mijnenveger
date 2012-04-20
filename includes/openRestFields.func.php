<?php
function openRestFields($x,$y){

	if($_SESSION['field'][$x][$y]['count'] == 0 && $_SESSION['field'][$x][$y]['mine'] === '0'){

		// check 1th
		$handler = $_SESSION['field'][$x-1][$y];

		if($handler['mine'] === '0'){
			if(!in_array(($x-1)."_".($y),$_SESSION['opened'])){
				$_SESSION['opened'][] = ($x-1)."_".($y);
				$_SESSION['openedw'][] = $_GET['playerid'];

				if($handler['count'] == 0){
					openRestFields(($x-1),($y));
				}
			}
		}

		// check 2nd
		$handler = $_SESSION['field'][$x+1][$y];

		if($handler['mine'] === '0'){
			if(!in_array(($x+1)."_".($y),$_SESSION['opened'])){
				$_SESSION['opened'][] = ($x+1)."_".($y);
				$_SESSION['openedw'][] = $_GET['playerid'];

				if($handler['count'] == 0){
					openRestFields(($x+1),($y));
				}
			}
		}

		// check 3rd
		$handler = $_SESSION['field'][$x][$y-1];

		if($handler['mine'] === '0'){
			if(!in_array(($x)."_".($y-1),$_SESSION['opened'])){
				$_SESSION['opened'][] = ($x)."_".($y-1);
				$_SESSION['openedw'][] = $_GET['playerid'];

				if($handler['count'] == 0){
					openRestFields(($x),($y-1));
				}
			}
		}

		// check 4th
		$handler = $_SESSION['field'][$x][$y+1];

		if($handler['mine'] === '0'){
			if(!in_array(($x)."_".($y+1),$_SESSION['opened'])){
				$_SESSION['opened'][] = ($x)."_".($y+1);
				$_SESSION['openedw'][] = $_GET['playerid'];

				if($handler['count'] == 0){
					openRestFields(($x),($y+1));
				}
			}
		}

		// check 5th
		$handler = $_SESSION['field'][$x-1][$y-1];

		if($handler['mine'] === '0'){
			if(!in_array(($x-1)."_".($y-1),$_SESSION['opened'])){
				$_SESSION['opened'][] = ($x-1)."_".($y-1);
				$_SESSION['openedw'][] = $_GET['playerid'];

				if($handler['count'] == 0){
					openRestFields(($x-1),($y-1));
				}
			}
		}

		// check 6th
		$handler = $_SESSION['field'][$x+1][$y-1];

		if($handler['mine'] === '0'){
			if(!in_array(($x+1)."_".($y-1),$_SESSION['opened'])){
				$_SESSION['opened'][] = ($x+1)."_".($y-1);
				$_SESSION['openedw'][] = $_GET['playerid'];

				if($handler['count'] == 0){
					openRestFields(($x+1),($y-1));
				}
			}
		}

		// check 7th
		$handler = $_SESSION['field'][$x+1][$y+1];

		if($handler['mine'] === '0'){
			if(!in_array(($x+1)."_".($y+1),$_SESSION['opened'])){
				$_SESSION['opened'][] = ($x+1)."_".($y+1);
				$_SESSION['openedw'][] = $_GET['playerid'];

				if($handler['count'] == 0){
					openRestFields(($x+1),($y+1));
				}
			}
		}

		// check 8th
		$handler = $_SESSION['field'][$x-1][$y+1];

		if($handler['mine'] === '0'){
			if(!in_array(($x-1)."_".($y+1),$_SESSION['opened'])){
				$_SESSION['opened'][] = ($x-1)."_".($y+1);
				$_SESSION['openedw'][] = $_GET['playerid'];

				if($handler['count'] == 0){
					openRestFields(($x-1),($y+1));
				}
			}
		}

	}

}