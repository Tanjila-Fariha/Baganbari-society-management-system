<?php
session_start();
require_once("dbconnect.php");
$Resident_ID = $_POST['Resident_ID'];
$password = $_POST['password'];
$type = $_POST['type'];

if (empty($Resident_ID) || empty($password)) {
    echo "Required field is empty.";
} else {
    $query = "SELECT * FROM resident WHERE Resident_ID='$Resident_ID' AND password='$password'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    if ($row) {
        $_SESSION['Resident_ID'] = $row['Resident_ID'];

        if ($type == 'Flat Owner') {

            $flatOwnerQuery = "SELECT * FROM flat_owner WHERE o_resident_id='$Resident_ID'";
            $flatOwnerResult = $conn->query($flatOwnerQuery);
            $flatOwnerRow = $flatOwnerResult->fetch_assoc();

            if ($flatOwnerRow) {
                header('Location: http://localhost/CSE370_project/Flat_Owner.html');
            } else {
                echo "Invalid Flat Owner Credentials";
            }
        } elseif ($type == 'Tenant') {

            $tenantQuery = "SELECT * FROM tenant WHERE t_resident_id='$Resident_ID'";
            $tenantResult = $conn->query($tenantQuery);
            $tenantRow = $tenantResult->fetch_assoc();

            if ($tenantRow) {
                header('Location: http://localhost/CSE370_project/Tenant.html');
            } else {
                echo "Invalid Tenant Credentials";
            }
        } else {
            echo "Invalid User Type";
            session_destroy();
        }
    } else {
        echo "Invalid Login Credentials";
        session_destroy();
    }
}
?>
