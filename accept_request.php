<?php

session_start();
include("dbconnect.php");
$Staff_ID = $_SESSION['Staff_ID'];

$new=$Staff_ID;
$q_query = "SELECT * FROM service_and_utility_staff WHERE Staff_ID='$Staff_ID'";
$r_result = $conn->query($q_query);
$r_row = $r_result->fetch_assoc();


if ($r_row) {
    $_SESSION['Staff_ID'] = $r_row['Staff_ID'];
    $s_contact = $r_row['Contact_num'];
}


if(isset($_POST['accept_request'])) {
    
    $request_id = $_POST['request_id'];
    $query1 = "SELECT Resident_ID FROM maintainence_request WHERE Request_ID = '$request_id'";
    $result1 = $conn->query($query1);
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $resident_id = $row['Resident_ID'];
    }
    
    $Notification = "Your maintainance request (Request ID: $request_id) has been accepted by the staff";

    $sql1 = "INSERT INTO resident_notification (Resident_ID, Notification)
    
    VALUES ('$resident_id', '$Notification');";
    
    if ($conn->query($sql1) === TRUE) {
        $sql1 = "INSERT INTO resident_notification (Resident_ID, Notification) VALUES ('$resident_id', '$Notification');";
    }
    
    $update_sql = "UPDATE maintainence_request SET Status = 1, a_staff_id = '$Staff_ID',s_contact='$s_contact' WHERE Request_ID = '$request_id'";
    if ($conn->query($update_sql) === TRUE) {
        echo "Maintenance request accepted successfully.";
    } else {
        echo "Error updating maintenance request: " . $conn->error;
    }
}

?>