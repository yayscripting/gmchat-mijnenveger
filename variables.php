<?php
// Start sessions
ini_set('session.use_cookies', false);
session_id($_GET['session']);
session_start();

// define variables
$result = Array();

// define results
$result['iam']    	= $_SESSION['iam'];
$result['score'] 	= $_SESSION['score'];
$result['mines']  	= $_SESSION['mines'];
$result['fields'] 	= count($_SESSION['opened']);
$result['lastfield']	= $_SESSION['lastfield'];

// get opened fields
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

if(($_SESSION['score'][1] + $_SESSION['mines']) <  $_SESSION['score'][2]){
	$result['win']   = 2;
	$_SESSION['win'] = 2;
}else
if(($_SESSION['score'][2] + $_SESSION['mines']) <  $_SESSION['score'][1]){
	$result['win']   = 1;
	$_SESSION['win'] = 1;
}


echo json_encode($result);