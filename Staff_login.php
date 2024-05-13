<?php
session_start();
require_once("dbconnect.php");
$Staff_ID = $_POST['Staff_ID'];
$password = $_POST['password'];

if (empty($Staff_ID) or empty($password)) {
	echo "required field is empty.";
}
else {
	$query="SELECT * FROM service_and_utility_staff where Staff_ID='$Staff_ID' AND password='$password'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	if ($row) {
		$_SESSION['Staff_ID'] = $row['Staff_ID'];
			header('Location: http://localhost/CSE370_project/Staff.html');
		}
	else{
		echo "Invalid Login Credentials";
		session_destroy();
	}
}
?>