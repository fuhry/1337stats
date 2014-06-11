<?php ob_end_flush(); /* to force headers to send */ ?>
<!DOCTYPE html>
<html>
	<head>
		<title>terminal thing</title>
		<style type="text/css">
		/*<![CDATA[*/
		body {
			color: #00ff00;
			background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAACCAIAAAAW4yFwAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAEElEQVQI12NgYGBg4OfnBwAAYgAuirc3YQAAAABJRU5ErkJggg==);
			text-shadow: 0px 0px 7px rgba(0, 255, 0, 0.7);
		}
		@keyframes blinker {
			0% {
				opacity: 1.0;
			}
			35% {
				opacity: 1.0;
			}
			50% {
				opacity: 0;
			}
			85% {
				opacity: 0;
			}
		}
		pre, h1, h2, h3, h4, h5, h6 {
			font-family: Monaco, DejaVu Sans Mono;
		}
		pre {
			font-size: 9pt;
		}
		.blink {
			animation: blinker 1s infinite;
		}
		
		div.cmdlet {
			border: 1px solid #00ff00;
			margin: 7px 3px;
			padding: 7px 3px;
			display: table;
			float: left;
		}
		h1 {
			margin: 0;
			font-weight: bold;
			font-size: 9pt;
		}
		div.cmdlet h1:before {
			content: "$ ";
		}
		div.cmdlet h1:after {
			content: "\2588";
			/* I hate you THIIIIIIIIIIIS MUUUUUUUUUCH. */
			animation: blinker 1s infinite;
		}
		/*]]>*/
		</style>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
		//<![CDATA[
		$(function()
			{
				var result = <?php require('run.php'); ?>;
				showResult(result);
				setInterval(loadStats, 10000);
			});

		function loadStats()
		{
			$.get('run.php', function(result)
				{
					showResult(result);
				}, 'json');
		}

		function showResult(result)
		{
			for ( var i in result )
			{
				var cmdhash = i.replace(/[^A-Za-z0-9-]/g, '');
				$('#output-' + cmdhash).text(result[i]);
			}
		}
		//]]>
		</script>
	</head>
	<body>
<?php
require('config.php');
foreach ( $cmds as $cmd )
{
	$cmdhash = preg_replace('/[^A-Za-z0-9-]/', '', $cmd);
	echo "<div class=\"cmdlet\">\n";
	echo "<h1>$cmd</h1>\n";
	echo "<pre id=\"output-$cmdhash\">";
	echo "</pre>";
	echo "</div>";
}
?>
	</body>
</html>
