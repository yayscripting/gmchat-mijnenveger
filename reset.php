<?php
// Open de sessie
ini_set('session.use_cookies', false);
session_id($_GET['session']);
session_start();

if($_GET['i'] == $_SESSION['win']){
?>
<div class='container' style='text-align: center;'>
		<br/><br/><br/><br/>
		<span style='font-size: 24pt;'>Je hebt gewonnen!</span>
		<br/>
		Een nieuw spel start na 5 seconde.
</div>
<?
}else{
?>
<div class='container' style='text-align: center;'>
		<br/><br/><br/><br/>
		<span style='font-size: 24pt;'>Je hebt verloren!</span>
		<br/>
		Een nieuw spel start na 5 seconde.
</div>
<?
}