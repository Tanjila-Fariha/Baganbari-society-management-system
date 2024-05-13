<?php
session_start();
require_once("dbconnect.php");

if (!isset($_SESSION['Resident_ID']) || !isset($_POST['Month']) || empty($_POST['Month'])) {
    echo "Required field is empty.";
    exit();
}

$Resident_ID = $_SESSION['Resident_ID'];
$Month = $_POST['Month'];

$Year = substr($Month, 0, 4);
$MonthNumber = substr($Month, -2);

$MonthName = date('F', mktime(0, 0, 0, $MonthNumber));

$query1 = "SELECT Tenant_ID,T_Flat_ID,O_Resident_ID FROM tenant WHERE T_Resident_ID = '$Resident_ID'";
$result1 = $conn->query($query1);

if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $O_Resident_ID = $row['O_Resident_ID'];
    $N_Tenant_ID= $row['Tenant_ID'];
    $N_Flat_ID= $row['T_Flat_ID'];
} else {
    echo "No results found for the given Resident_ID";
    exit();
}

$Notification = "$N_Tenant_ID has paid the rent of $N_Flat_ID for $MonthName, $Year";

$sql1 = "INSERT INTO resident_notification (Resident_ID, Notification)
VALUES ('$O_Resident_ID', '$Notification');";

if ($conn->query($sql1) === TRUE) {
    echo "<br>Rent has been paid";
} else {
    echo "Error inserting notification: " . $conn->error;
}

$conn->close();
?>
