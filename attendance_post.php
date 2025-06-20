<?php

error_reporting(0);

include "_db_conn.php";

function error422($msg){

	$data = [
		'status' => 422,
		'message' => $msg
	];
	header("HTTP/1.0 422 Unprocessable Data");
	echo json_encode($data, JSON_PRETTY_PRINT);
	exit();
}

function post_Attendance($attendanceInput){
	global $conn;
	$rf_id = mysqli_real_escape_string($conn, $attendanceInput['rf_id']);
	if(empty(trim($rf_id))){
		return erro422("Enter RF ID");
	}else{
		$sql = "INSERT INTO attendance (`rfid`) VALUES('$rf_id') ";
		$res = mysqli_query($conn, $sql);

		if($res){

			$data = [
				'status' => 201,
				'message' => " Data Inserted"
			];
			header("HTTP/1.0 201 Data inserted");
			return json_encode($data, JSON_PRETTY_PRINT);

		}else{
			$data = [
			'status' => 500,
			'message' => " Internal Server Error"
			];
			header("HTTP/1.0 500 Internal Server Error");
			return json_encode($data, JSON_PRETTY_PRINT);
		}
	}
}


header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

header("Access-Control-Allow-Methods: POST");

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Allow-Origin");



$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method == "POST") {
	// code...
	$inputData = json_decode(file_get_contents("php://input"), true);
	if(empty($inputData)){
		$storeAttendance = post_Attendance($_POST);
	}else{
		$storeAttendance = post_Attendance($inputData);
	}
	echo $storeAttendance;

}else{
	$data = [
		'status' => 405,
		'message' => $request_method . " method not allowed"
	];
	header("HTTP/1.0 405 Method Not Allowed");
	echo json_encode($data, JSON_PRETTY_PRINT);
}

?>