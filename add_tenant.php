<?php
include 'dbconnect.php';
echo "</br>";
$T_Resident_ID = $_POST['T_Resident_ID'];
$Tenant_ID = $_POST['Tenant_ID'];
$T_Flat_ID=$_POST['T_Flat_ID'];
$password = $_POST['password'];
$Contact_num = $_POST['Contact_num'];
$Name = $_POST['Name'];

if(empty($T_Resident_ID) || empty($Tenant_ID) || empty($T_Flat_ID) || empty($password) || empty($Contact_num) || empty($Name)) {
    echo "All fields must be filled out";
    $conn->close();
    exit();
}

$check_query = "SELECT * FROM resident WHERE Resident_ID = '$T_Resident_ID'";
$check_result = $conn->query($check_query);
if ($check_result->num_rows > 0) {
    echo "A resident with the given Resident_ID already exists";
    $conn->close();
    exit();
}

$check_query_tenant = "SELECT * FROM tenant WHERE Tenant_ID = '$Tenant_ID'";
$check_result_tenant = $conn->query($check_query_tenant);
if ($check_result_tenant->num_rows > 0) {
    echo "A tenant with the given Tenant_ID already exists";
    $conn->close();
    exit();
}

$query = "SELECT O_Owner_ID, O_Resident_ID FROM owns WHERE O_Flat_ID = '$T_Flat_ID'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $T_Owner_ID = $row['O_Owner_ID'];
    $O_Resident_ID = $row['O_Resident_ID'];
} else {
    echo "No records found for the given T_Flat_ID";
    $conn->close();
    exit();
}

echo "<br>";

$sql1 = "INSERT INTO resident (Resident_ID, Password, Name, Contact_num)
VALUES ('$T_Resident_ID', '$password', '$Name', '$Contact_num');";
$sql2 = "INSERT INTO tenant (T_Resident_ID,Tenant_ID,T_Owner_ID,T_Flat_ID,O_Resident_ID)
VALUES ('$T_Resident_ID', '$Tenant_ID', '$T_Owner_ID',  '$T_Flat_ID', '$O_Resident_ID');";

if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>
