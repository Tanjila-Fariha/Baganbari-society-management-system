<?php

session_start();
include("dbconnect.php");
$Resident_ID = $_SESSION['Resident_ID'];
$request_id = $_POST['request_id'];



if(isset($_POST['complete_request'])) {
    $query = "DELETE FROM maintainence_request WHERE `Request_ID` = '$request_id'";
    if ($conn->query($query) === TRUE) {
        echo "Completed";
    }  
}

