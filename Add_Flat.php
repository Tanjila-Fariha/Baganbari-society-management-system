<?php
session_start();
require_once("dbconnect.php");
$Resident_ID=$_SESSION['Resident_ID'];
$Flat_ID = $_POST['Flat_ID'];
$flag=0;
$otp= $_POST['otp'];
if (empty($Flat_ID) or empty($otp)) {
	echo "Required field is empty.";
	$flag=1;
	}
else {
	$query="SELECT O_Flat_ID FROM owns WHERE O_Resident_ID='$Resident_ID'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if ($row['O_Flat_ID']=== $Flat_ID) {
				$flag=1;
				echo "Flat already added on your name";
			}
		}
	}
	if ($flag==0) {
		$query1="SELECT O_Flat_ID FROM owns";
		$result1 = $conn->query($query1);
		if ($result1->num_rows > 0) {
			while ($row1 = $result1->fetch_assoc()) {
				if ($row1['O_Flat_ID']=== $Flat_ID) {
					$flag=1;
					echo "Flat already has an owner";

				}
			}
		}
	}
	if ($flag==0) {
		$query2="SELECT Flat_ID,otp FROM apartment_a1";
		$result2 = $conn->query($query2);
		if ($result2->num_rows > 0) {
			while ($row2 = $result2->fetch_assoc()) {
				if ($row2['Flat_ID']=== $Flat_ID && $row2['otp']===$otp) {
					$flag=1;
					$query3="SELECT Owner_ID FROM flat_owner WHERE O_Resident_ID='$Resident_ID'";
					$result3 = $conn->query($query3);
					$row3 = $result3->fetch_assoc();
					$Owner_ID= $row3['Owner_ID'];
					$sql= "INSERT INTO owns (O_Flat_ID, O_Resident_ID, O_Owner_ID)
					VALUES ('$Flat_ID', '$Resident_ID', '$Owner_ID')";
					if ($conn->query($sql) == TRUE) {
					  echo "New record created successfully";
					} else {
					  echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
				}

			}
		}
	}
	if ($flag===0) {
		echo "wrong Flat_ID or OTP, enter again.";
		header("Refresh: 5; URL= http://localhost/CSE370_project/Add_Flat.html");
		}
	}
?>