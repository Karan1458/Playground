<?php
	error_reporting(E_ALL);
	$fn = "../test.php";
	
	if (isset($_POST['content'])) {
	    $content = $_POST['content'];
	    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
	    fputs($fp,$content);
	    fclose($fp) or die ("Error closing file!");
	}

	echo json_encode(array('status' => 'success'));
	exit;