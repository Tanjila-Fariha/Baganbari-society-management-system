<?php

session_start();
include("dbconnect.php");

$Staff_ID = $_SESSION['Staff_ID'];


$sql = "SELECT Request_ID, Resident_ID, Flat_ID, Status, Request_description, Required_role, Wage FROM maintainence_request WHERE a_staff_id = '$Staff_ID' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // Individual requests
    while ($row = $result->fetch_assoc()) {
        
        echo "Request_ID: " . $row["Request_ID"] . " || Request_description: " . $row["Request_description"] . " || Required_role: " . $row["Required_role"] . " || Flat ID: " . $row["Flat_ID"] . " || Wage: " . $row["Wage"] . ".";
        echo "<br><br>";
        echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
        echo "<br><br>";
        
    }
    

} else {
    echo "No accepted maintenance requests available.";
}

$conn->close();
?>