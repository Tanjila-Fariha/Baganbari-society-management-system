<?php
include 'dbconnect.php';
$Resident_ID = $_POST['Resident_ID'];
$Name = $_POST['Name'];
$Contact_num = $_POST['Contact_num'];
$password = $_POST['password'];
$Owner_ID = $_POST['Owner_ID'];
$Flat_ID = $_POST['Flat_ID'];
$otp= $_POST['otp'];
$flag=0;
if (empty($Flat_ID) or empty($Owner_ID) or empty($password) or empty($Contact_num) or empty($Name) or empty($Resident_ID) or empty($otp)) {
	echo "required field is empty.";
	}
else {
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
	if ($flag==0) {
		$query3="SELECT Owner_ID FROM flat_owner";
		$result3 = $conn->query($query3);
		if ($result3->num_rows > 0) {
			while ($row3 = $result3->fetch_assoc()) {
				if ($row3['Owner_ID']=== $Owner_ID) {
					$flag=1;
					echo "This Owner_ID Already Exists";
				}
			}
		}

	}
	if ($flag==0) {
		$query="SELECT Flat_ID,otp FROM apartment_a1";
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				if ($row['Flat_ID']=== $Flat_ID && $row['otp']=== $otp) {
					$flag=1;
					$sql = "INSERT INTO resident (Resident_ID, Password, Name, Contact_num)
					VALUES ('$Resident_ID', '$password', '$Name', '$Contact_num');";
					$sql .= "INSERT INTO flat_owner (O_Resident_ID, Owner_ID)
					VALUES ('$Resident_ID', '$Owner_ID');";
					$sql .= "INSERT INTO owns (O_Flat_ID, O_Resident_ID, O_Owner_ID)
					VALUES ('$Flat_ID', '$Resident_ID', '$Owner_ID')";

					if ($conn->multi_query($sql) === TRUE) {
					  echo "Sign-Up successfull. login now";
					  header('Location: http://localhost/CSE370_project/Resident_login.html');
					} else {
					  echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
				}
			}
		}
		if ($flag==0) {
			echo "Sign-Up Unsuccessfull. Wrong Flat_ID or OTP";
		}
	}
}
?>