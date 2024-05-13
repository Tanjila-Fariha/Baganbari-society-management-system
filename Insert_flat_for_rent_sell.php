<?php
session_start();
require_once("dbconnect.php");
$Resident_ID=$_SESSION['Resident_ID'];
$Flat_ID = $_POST['Flat_ID'];
$Cost = $_POST['Cost'];
$rent_or_sell = $_POST['rent_or_sell'];
$description = $_POST['Description'];
$flag=0;
if (empty($Resident_ID) or empty($Flat_ID) or empty($Cost) or empty($rent_or_sell) or empty($description)) {
	echo "required field is empty";
} else {
	$query="SELECT O_Flat_ID FROM owns WHERE O_Resident_ID='$Resident_ID'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if ($row['O_Flat_ID']=== $Flat_ID) {
				$flag=1;
				$query1="SELECT Owner_ID FROM flat_owner WHERE O_Resident_ID='$Resident_ID'";
				$result1 = $conn->query($query1);
				$row1 = $result1->fetch_assoc();
				$Owner_ID= $row1['Owner_ID'];
				$sql = "INSERT INTO sellsorrents (S_Owner_ID, S_Flat_ID, O_Resident_ID, Cost, Rent_or_Sell, Description)
				VALUES ('$Owner_ID', '$Flat_ID', '$Resident_ID', '$Cost', '$rent_or_sell', '$description')";
				if ($conn->query($sql) == TRUE) {
				  echo "New record created successfully";
				} else {
				  echo "Error: " . $sql . "<br>" . $conn->error;
				}
				$conn->close();

			}
		}
		if ($flag==0) {
			echo "wrong information, enter again.";
		}
	}
}
?>