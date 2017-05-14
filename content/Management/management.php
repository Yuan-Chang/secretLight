<!DOCTYPE html>
<html>

<body>

<?php

if ( $_GET['permission'] ) {
	$permission = $_GET['permission'];
}
?>

<h1>Management</h1>
<form action="getMembers.php" method="get">
    <input type="text" name="keyword" value="">
    <input type="submit" value="search">
</form>
<br>
<br>




</body>

</html>
