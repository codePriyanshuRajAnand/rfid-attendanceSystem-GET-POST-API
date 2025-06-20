# rfid-attendanceSystem-GET-POST-API

To Use this script you must create a "**_db_conn.php**" file with below parameters:

<?php
$servername = "localhost"; # your DB server uri
$username = "root"; # if your DB user is different please change 
$password = "#######"; your DB user password
$database = "MY_DB"; # DB name
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
	echo "Server not Responding, Please Try Again.";
	exit;
}
?>

In Attendance GET & POST file modify the table name in query from <attendance_table> to your actual table and use the row & columns name as you named it in your DB schema
