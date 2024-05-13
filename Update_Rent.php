<html>
<body>
<table width="100%" height="100%">
<tr>
<td align="center" valign="middle">
<h1>Update Flat Rent</h1>
<form action="http://localhost/CSE370_project/submit_updated_rent.php" method="post">
Flat_ID: 
<select name="Flat_ID">
	<?php
	session_start();
	require_once("dbconnect.php");
	$Resident_ID=$_SESSION['Resident_ID'];
	$query="SELECT T_Flat_ID FROM tenant WHERE O_Resident_ID='$Resident_ID'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$f=$row["T_Flat_ID"];
			echo "<option value='{$f}'>{$f}</option>";
		}

	}
	?>	
</select>
Updated rent: <input type="text" name="rent"><br><br>
Applicable from: 
  <input type="month" name="month">
<input type="submit">
</form>
</td>
</tr>
</table>
</body>
</html>