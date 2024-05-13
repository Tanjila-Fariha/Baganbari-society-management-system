<?php
session_start();
require_once("dbconnect.php");

$N_Resident_ID = $_SESSION['Resident_ID'];

$query1 = "SELECT notification FROM resident_notification WHERE Resident_ID = '$N_Resident_ID'";
$result1 = $conn->query($query1);

$hasNotifications = false;

if ($result1->num_rows > 0) {
    $hasNotifications = true;
    while($row = $result1->fetch_assoc()) {
        echo "<br>". $row['notification'] . "<br>";
    }
} else {
    echo "<br>" . "No notification for you"; 
    exit();
}

if(isset($_POST['clear_all'])) {
    $delete_query = "DELETE FROM resident_notification WHERE Resident_ID = '$N_Resident_ID'";
    if ($conn->query($delete_query) === TRUE) {
        header('Location: cleared_notifications.html');
        exit();
    } else {
        echo "Error clearing notifications: " . $conn->error;
    }
}

$conn->close();
?>

<?php if ($hasNotifications): ?>
<br>
<form method="post">
    <input type="submit" name="clear_all" value="Clear All Notifications">
</form>
<?php endif; ?>
