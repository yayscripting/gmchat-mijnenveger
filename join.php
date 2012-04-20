<?php
if(empty($_GET['s']) || empty($_GET['i']) || empty($_GET['n1']) || empty($_GET['n2'])){
	exit();
}

// Open de sessie
ini_set('session.use_cookies', false);
session_id($_GET['i']);
session_start();

// check IP
$securFile = 'gamesecur/'.$_GET['i'].'_'.$_GET['s'].'.json';
if(file_exists($securFile)){
	$json = json_decode(file_get_contents($securFile), true);

	if($json['ip'] != $_SERVER['REMOTE_ADDR']){
		exit("Can't join server via IP-adress <i>".$_SERVER['REMOTE_ADDR']."</i>");
	}
}else{
	$handle = fopen($securFile, 'w');
	$toWrite = array('ip' => $_SERVER['REMOTE_ADDR']);
	fwrite($handle, json_encode($toWrite));
	fclose($handle);	
}

// get variables
$_SESSION['p1name'] = $_GET['n1'];
$_SESSION['p2name'] = $_GET['n2'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>GMChat-Mijnveger 1</title>
	<script type="text/javascript" src="javascript/mootools.js"></script>
	<script type="text/javascript" src="javascript/mootools_more.js"></script>
	<script type="text/javascript">
	var session = '<?php echo $_GET['i']; ?>';
	var iam = <?php echo ($_GET['s'] == 1) ? 'true' : 'false'; ?>;
	var playerid = <?php echo $_GET['s']; ?>;
	var playerOne = "<?php echo $_GET['n1']; ?>";
	var playerTwo = "<?php echo $_GET['n2']; ?>";
	</script>
	<script type="text/javascript" src="javascript/mijnveger100a.js"></script>
	<script type="text/javascript" src="javascript/scroller.js"></script>
	<link rel="stylesheet" type="text/css" href="style/style.css" />

</head>
<body scroll="no" id="body">
	<? include('field.php'); ?>
</body>
</html>