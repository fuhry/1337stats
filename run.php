<?php

require('config.php');

putenv('PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin');

$results = array();
foreach ( $cmds as $cmd )
{
	$output = null;
	exec($cmd, $output, $retval);
	$results[$cmd] = trim(implode("\n", $output));
}

if ( !headers_sent() )
	header('Content-type: text/javascript');

echo json_encode($results);
