<?php
// Start sessions
ini_set('session.use_cookies', false);
session_id($_GET['session']);
session_start();

// define variables
$result 	= Array();
$restOpened	= Array();

// includes
include("includes/openRestFields.func.php");

if($_GET['playerid'] == $_SESSION['iam']){
	$result['id'] = "field_".$_POST['field'];
	$_SESSION['opened'][] = $_POST['field'];
	$_SESSION['openedw'][] = $_GET['playerid'];
	
	$fieldP = explode("_",$_POST['field']);

	openRestFields($fieldP[0],$fieldP[1]);

	for($i = 0; $i < count($_SESSION['opened']); $i++){

		$fieldP = explode("_",$_SESSION['opened'][$i]);
		$fieldL = $_SESSION['field'][$fieldP[0]][$fieldP[1]];

		$count = count($result['opened']) + 1;

		$result['opened'][$count]['x'] = $fieldP[0];
		$result['opened'][$count]['y'] = $fieldP[1];
		$result['opened'][$count]['m'] = $fieldL['mine'];
		$result['opened'][$count]['c'] = $fieldL['count'];
		$result['opened'][$count]['w'] = $_SESSION['openedw'][$i];
	}

	
	if($_SESSION['field'][$fieldP[0]][$fieldP[1]]['mine'] != 1){
		$_SESSION['iam'] = (($_SESSION['iam'] == 1) ? 2 : 1);
	}else{
		$_SESSION['score'][$_GET['playerid']] ++;
		$_SESSION['mines']--;
	}

	$_SESSION['lastfield']['f'] 	= $_POST['field'];
	$_SESSION['lastfield']['w']	= $_GET['playerid'];
}

echo json_encode($result);