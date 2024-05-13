<?php
include 'dbconnect.php';
echo "</br>";

$Staff_ID = $_POST['Staff_ID'];
$password = $_POST['password'];
$Name = $_POST['Name'];
$Contact_num = $_POST['Contact_num'];
$Role = $_POST['Role'];
echo "<br>";
$flag=0;
if (empty($Staff_ID) or empty($password) or empty($Name) or empty($Contact_num) or empty($Role)) {
	  echo "Required field is empty.";
    $flag=1;
	}
else{
  $query1="SELECT Staff_ID FROM service_and_utility_staff";
	$result1 = $conn->query($query1);
	if ($result1->num_rows > 0) {
		while ($row1 = $result1->fetch_assoc()) {
			if ($row1['Staff_ID']=== $Staff_ID) {
				$flag=1;

				echo "Staff ID already exists";

			}
		}
	}
}

if ($flag==0){
    $sql1 = "INSERT INTO service_and_utility_staff (Staff_ID, Password, Name, Contact_num, Role)
    VALUES ('$Staff_ID', '$password', '$Name', '$Contact_num', '$Role' );";
    if ($conn->query($sql1) === TRUE) {
    echo "New Staff added successfully";
  } 
else {
  echo "Error: " . $conn->error;
  }
}


$conn->close();
?>
