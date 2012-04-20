<?php
// Start sessions
ini_set('session.use_cookies', false);
session_start();
	
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
$_SESSION['lastfield'] 	= null;

// Redirect
header('Location: http://gmchat.blijbol.nl/gc.php?i='.session_id());
?>