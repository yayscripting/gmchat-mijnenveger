<?php
// Open de sessie
ini_set('session.use_cookies', false);
session_id($_GET['session']);
session_start();

// log
function mlog($message){
	$handle = fopen('winlog.txt','a+');
	fwrite($handle,'\n'.$message);
	fclose($handle);
}

// log last
mlog(date("d/m/Y H:i:s").": <b>".$_SESSION['p'.($_GET['i']).'name']."</b> vs. ".$_SESSION['p'.(($_GET['i'] == 1) ? 2 : 1).'name']." (".$_SESSION['score'][$_GET['i']]." - ".$_SESSION['score'][(($_GET['i'] == 1) ? 2 : 1)]);

// start new session
// define variables
$minesPlaced	= array();
$field		= array();

// includes
include('includes/createMijnenField.func.php');

// Define sessions
$_SESSION['field']	= createMijnenField(10, 25);
$_SESSION['score']      = Array(1=>0,2=>0);
$_SESSION['iam']	= 1;
$_SESSION['mines']	= 25;
$_SESSION['opened']	= Array();
$_SESSION['openedw']	= Array();
$_SESSION['win']	= 0;
$_SESSION['lastfield']	= null;

include('field.php');