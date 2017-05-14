<?php
include "../DBConfig.php";
include "../renderHelper.php";
?>


<!DOCTYPE html>
<html>

<body>

<?php

error_reporting( E_ALL );
ini_set( 'display_errors', '1' );


if ( isset( $_GET['username'] ) && isset( $_GET['password'] ) ) {

	$username = $_GET['username'];
	$password = $_GET['password'];

	// Create connection
	$conn = new mysqli( $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );

	// Check connection
	if ( $conn->connect_error ) {
		echo "Not able to connect DB";
		showSignUpContent();
		exit;
	}

	$sql = "select * from Users where username = '$username'";

	$result = mysqli_query( $conn, $sql );
	if ( $result ) {
		$count =  mysqli_num_rows( $result );

		if ( $count == 0 ) {

			$sql = "insert into Users (username,`password`) values ('$username','$password')";
			
			$result = mysqli_query( $conn, $sql );
			if ( $result ) {
				showManagePage( 0 );
			}
			else {
				echo "insert query error";
				showSignUpContent();
			}
		}
		else {

			echo "Account already exist, please use other username";
			showSignUpContent();
		}


	}
	else {
		echo "select query error";
		showSignUpContent();
	}


}
else {
	showSignUpContent();
}

?>




</body>

</html>
