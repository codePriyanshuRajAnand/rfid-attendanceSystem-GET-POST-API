<?php

include "_db_conn.php";

function getAttendance(){
	global $conn;

	$sql = "SELECT * FROM <attendance_table>";
	$res = mysqli_query($conn, $sql);

	if($res){
		if(mysqli_num_rows($res)>0){

			$attendance_recods = mysqli_fetch_all($res, MYSQLI_ASSOC);
			$data = [
		'status' => 200,
		'message' => "Attendance recods fetched successsfully",
		'recods' => $attendance_recods
	];
	header("HTTP/1.0 200 OK");
	return json_encode($data, JSON_PRETTY_PRINT);

		}else{
			$data = [
		'status' => 404,
		'message' => "No attendance Records found"
	];
	header("HTTP/1.0 404 No attendance Records found");
	return json_encode($data, JSON_PRETTY_PRINT);
		}
	}else{
		$data = [
		'status' => 500,
		'message' => " Internal Server Error"
	];
	header("HTTP/1.0 500 Internal Server Error");
	return json_encode($data, JSON_PRETTY_PRINT);

	}

}

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Allow-Origin");



$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method == "GET") {
	// code...
	$attendance = getAttendance();
	echo $attendance;

}else{
	$data = [
		'status' => 405,
		'message' => $request_method . " method not allowed"
	];
	header("HTTP/1.0 405 Method Not Allowed");
	echo json_encode($data, JSON_PRETTY_PRINT);
}

?>
