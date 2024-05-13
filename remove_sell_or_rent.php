<html>
<body>
<table width="100%" height="100%">
<tr>
<td align="center" valign="middle">
<h1>Remove Flats from 'Flat For Sell'</h1>
<form action="http://localhost/CSE370_project/update_remove_sell_or_rent.php" method="post">
Flat_ID: 
<select name="Flat_ID">
	<?php
	session_start();
	require_once("dbconnect.php");
	$Resident_ID=$_SESSION['Resident_ID'];
	$query="SELECT S_Flat_ID FROM sellsorrents WHERE O_Resident_ID='$Resident_ID'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$f=$row["S_Flat_ID"];
			echo "<option value='{$f}'>{$f}</option>";
		}

	}
	?>	
</select>
<input type="submit">
</form>
</td>
</tr>
</table>
</body>
</html>