<?php
session_start();
require_once("dbconnect.php");
$flag=0;
$flag1=0;
$Resident_ID=$_SESSION['Resident_ID'];
$Request_ID = $_POST['Request_ID'];
$Flat_ID = $_POST['Flat_ID'];
$Required_role = $_POST['Required_role'];
$Request_description = $_POST['Request_description']; 
$Wage = $_POST['Wage'];
if (empty($Flat_ID) or empty($Request_ID) or empty($Required_role) or empty($Request_description)) {
	echo "required field is empty.";
	}
else {
	$query="SELECT O_Resident_ID FROM flat_owner where O_Resident_ID='$Resident_ID'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		$flag=1;
	} else {
		$flag=0;
	}
	if ($flag==1) {
		$query1="SELECT O_Flat_ID,T_Flat_ID FROM (owns left join tenant on owns.O_Flat_ID=tenant.T_Flat_ID) where owns.O_Resident_ID='$Resident_ID'";
		$result1 = $conn->query($query1);
		if ($result1->num_rows > 0) {
			while ($row1 = $result1->fetch_assoc()) {
				if ($row1['O_Flat_ID']=== $Flat_ID && $row1['T_Flat_ID']==NULL) {
					$flag1=1;
					$sql = "INSERT INTO maintainence_request (Request_ID,Resident_ID,Flat_ID,Status,Request_description,Required_role,Wage)
					VALUES ('$Request_ID', '$Resident_ID', '$Flat_ID', 0,'$Request_description', '$Required_role', '$Wage')";
					if ($conn->multi_query($sql) == TRUE) {
					  echo "New request created successfully";
					} else {
					  echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
					break;

				}
			}
			if ($flag1==0) {
				echo "Wrong Flat_ID";
			}


		} else {
			echo "Wrong Flat_ID. Enter again";
		}

	} elseif ($flag==0) {
		$query2="SELECT T_Flat_ID FROM tenant where T_Resident_ID='$Resident_ID'";
		$result2 = $conn->query($query2);
		if ($result2->num_rows > 0) {
			$row2 = $result2->fetch_assoc();
				if ($row2['T_Flat_ID']===$Flat_ID) {
					$sql= "INSERT INTO maintainence_request (Request_ID, Resident_ID,Flat_ID,Status,Request_description,Required_role,Wage)
					VALUES ('$Request_ID', '$Resident_ID', '$Flat_ID', 0,'$Request_description', '$Required_role','$Wage')";
					if ($conn->multi_query($sql) == TRUE) {
					  echo "New request created successfully";
					} else {
					  echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
				} else {
					echo "Wrong Flat_ID. Enter again.";
				}

		}
	}

}
?>