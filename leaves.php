<?php
session_start();
require_once("dbconnect.php");


$L_Resident_ID = $_SESSION['Resident_ID'];

if ($L_Resident_ID === '') {
    echo "Error: T_Resident_ID not found in session.";
    exit;
}

$sql1="SELECT Tenant_ID,O_Resident_ID,T_Flat_ID from tenant where T_Resident_ID='$L_Resident_ID'";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tenant_id = $row['Tenant_ID'];
    $resident_id = $row['O_Resident_ID'];
    $flat_id = $row['T_Flat_ID'];
} else {
    echo "No records found for the given T_Flat_ID";
    $conn->close();
    exit();
}

$Notification = "$tenant_id has left the flat (Flat No: $flat_id)";
$sql2= "INSERT INTO resident_notification (Resident_ID, Notification)
VALUES ('$resident_id', '$Notification');";
if ($conn->query($sql2) === TRUE) {
    $sql2 = "INSERT INTO resident_notification (Resident_ID, Notification) VALUES ('$resident_id', '$Notification');";
}


$sql = "DELETE FROM resident WHERE Resident_ID = '$L_Resident_ID'";

if ($conn->query($sql) === TRUE) {
    echo "<br>Good Bye";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
