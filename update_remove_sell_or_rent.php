<?php
session_start();
require_once("dbconnect.php");
$Resident_ID=$_SESSION['Resident_ID'];
$Flat_ID = $_POST['Flat_ID'];
if (isset($Resident_ID) && isset($Flat_ID)) {
	$sql = "DELETE FROM sellsorrents WHERE S_Flat_ID='$Flat_ID'";
	if ($conn->query($sql) == TRUE) {
	  echo "Removed successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();

	}
?>