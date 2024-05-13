<?php

session_start();
include("dbconnect.php");

$Resident_ID = $_SESSION['Resident_ID'];

echo "Accepted Requests";
echo "<br><br>";
echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
echo "<br><br>";
$sql = "SELECT * FROM maintainence_request WHERE Status = 1  ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // Individual requests
    while ($row = $result->fetch_assoc()) {
        if ($row["Resident_ID"] == $Resident_ID) {
            echo "Request_ID: " . $row["Request_ID"] . " || Request_description: " . $row["Request_description"] . " || Required_role: " . $row["Required_role"] . " || Assigned Staff: " . $row["a_staff_id"] ." || Contact number: " . $row["s_contact"] . " || Wage: " . $row["Wage"] . ".";
            // Complete Button
            echo "<form action='complete_request.php' method='post'>";
            echo "<input type='hidden' name='request_id' value='" . $row["Request_ID"] . "'>";
            echo "<input type='submit' name='complete_request' value='Complete'>";
            echo "</form>";
            echo "<br><br>";
            echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
            echo "<br><br>";
        }
    }
    

} else {
    echo "No accepted maintenance requests here.";
}
echo "<br><br>";
echo "=============================================================================================================================================================================================================================================================";
echo "<br><br>";
echo "Pending Requests";
echo "<br><br>";
echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
echo "<br><br>";
$sql2 = "SELECT * FROM maintainence_request WHERE Status = 0  ";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    
    // Individual requests
    while ($row = $result2->fetch_assoc()) {
        if ($row["Resident_ID"] == $Resident_ID) {
            echo "Request_ID: " . $row["Request_ID"] . " || Request_description: " . $row["Request_description"] . " || Required_role: " . $row["Required_role"] .  " || Wage: " . $row["Wage"] . ".";
            echo "<br><br>";
            echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
            echo "<br><br>";
        }
    }
    

} else {
    echo "No pending maintenance requests ";
}

$conn->close();
?>
