<?php

session_start();
include("dbconnect.php");

$Staff_ID = $_SESSION['Staff_ID'];


$q_query = "SELECT * FROM service_and_utility_staff WHERE Staff_ID='$Staff_ID'";
$r_result = $conn->query($q_query);
$r_row = $r_result->fetch_assoc();


if ($r_row) {
    $_SESSION['Staff_ID'] = $r_row['Staff_ID'];
    $s_role = $r_row['Role'];
}

echo "Staff_ID: $Staff_ID, Staff_role: $s_role <br><br>";



$sql = "SELECT Request_ID, Resident_ID, Flat_ID, Status, Request_description, Required_role,Wage FROM maintainence_request WHERE Status = 0";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $flag = 0;
    // Individual requests
    while ($row = $result->fetch_assoc()) {
        if ($row["Required_role"] == $s_role) {
            echo "Request_ID: " . $row["Request_ID"] . " || Request_description: " . $row["Request_description"] . " || Wage: " . $row["Wage"] . " || Required_role: " . $row["Required_role"] .  ".";
            // Accept Button
            echo "<form action='accept_request.php' method='post'>";
            echo "<input type='hidden' name='request_id' value='" . $row["Request_ID"] . "'>";
            echo "<input type='submit' name='accept_request' value='Accept'>";
            echo "</form>";
            echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
            echo "<br><br>";
            $flag = 1;
        }
    }
    
    if ($flag == 0) {
        echo "No matching maintenance requests found for you.";
    }
} else {
    echo "No maintenance requests available.";
}

$conn->close();
?>
