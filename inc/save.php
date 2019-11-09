<?php
	error_reporting(0);	
	include_once 'classes/SqlLiteDB.php';

	$response = array(
		'status' => 'error'
	);

	if (isset($_POST['title'], $_POST['content'])) {
		$db = new SqlLiteDB();
		
		$ret = $db->exec($sql);

		if(!$ret) {
	   		$response['status'] = 'error';
	      	$response['message'] = $db->lastErrorMsg();
	    } else {
	    	$response['status'] = 'success';
	    } 
   		$db->close();
	} 
	header('Content-Type: application/json');
	echo json_encode($response);
	exit;