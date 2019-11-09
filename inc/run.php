<?php
	error_reporting(E_ALL);
	$fn = "../test.php";
	
	$response = array(
		'status' => 'error'
	);

	if (isset($_POST['content'])) {

	    $content = $_POST['content'];
	    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
	    fputs($fp,$content);
	    fclose($fp) or die ("Error closing file!");
	    $response['status'] = 'success';
	} 
	header('Content-Type: application/json');
	echo json_encode($response);
	exit;