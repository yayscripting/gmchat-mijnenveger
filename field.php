<?php
if(!empty($_GET['session'])){
	// Open de sessie
	ini_set('session.use_cookies', false);
	session_id($_GET['session']);
	session_start();
}
?>

	<div id="display"></div>
	<div class="container" style="display:none;">
		<div class="leftContent">
			<div class="p1">
				<div class="namep1"><? echo $_SESSION['p1name']; ?></div>
				<div class="score" id="score_1">0</div>
				<div class="iam" id="state_1"></div>
			</div>

			<div class="minesleft">
				<div class="p1left"></div>
				<div class="minesleft_counter" id="minesleft">25</div>
			</div>

			<div class="p2">
				<div class="namep2"><? echo $_SESSION['p2name']; ?></div>
				<div class="score" id="score_2">0</div>
				<div class="iam" id="state_2"></div>
			</div>
		</div>
		<div class="playfield">
		<div id="playtable">
		<?php

		// create field (y)
		for($x = 1; $x < 11; $x++){
	
			echo "<div>";

			// create field (y)
				for($y = 1; $y < 11; $y++){

				echo "<div width='20px' id=\"field_".$x."_".$y."\" class='field clickable'>&nbsp;&nbsp;</div>";

			}

			echo "</div>";
		}

		?>
		</div>
		</div>
	</div>
	<div id="startscreen">
		<noscript><b>Je hebt Javascript niet ingeschakeld.</b></noscript>	
		De JavaScript engine is niet geladen, herlaad het scherm of schakel JavaScript in.
	</div>