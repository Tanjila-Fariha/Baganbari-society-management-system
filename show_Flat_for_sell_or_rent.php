<?php
require_once("dbconnect.php");
$sql = "SELECT apartment_a3.Building_name, apartment_a2.Building_no, apartment_a2.Road_no, apartment_a1.Flat_no, apartment_a1.Floor_no, Cost, Rent_or_Sell, Description FROM (((apartment_a2 INNER JOIN apartment_a3 ON apartment_a2.Building_no=apartment_a3.Building_no) INNER JOIN apartment_a1 ON apartment_a1.Building_no=apartment_a2.Building_no) INNER JOIN sellsorrents ON sellsorrents.S_Flat_ID=apartment_a1.Flat_ID)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<br> Building_name: " . $row["Building_name"]. ",  Building_no.: " . $row["Building_no"]. ", Road_no.: " . $row["Road_no"]. ", Flat_no.: " . $row["Flat_no"]. ", Floor no.: " . $row["Floor_no"]. ", Cost: " . $row["Cost"]. ", Rent or Sell: " . $row["Rent_or_Sell"]. ", Description: " . $row["Description"]. ".<br><br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>