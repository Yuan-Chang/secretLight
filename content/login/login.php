<?php
include "../DBConfig.php";
include "../renderHelper.php";

error_reporting( E_ALL );
ini_set( 'display_errors', '1' );


if ( isset( $_GET['username'] ) && isset( $_GET['password'] ) ){

		$username = $_GET['username'];
		$password = $_GET['password'];

		// Create connection
		$conn = new mysqli( $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME );

		// Check connection
		if ( $conn->connect_error ) {
			echo "Not able to connect DB";
			showLoginContent();
			exit;
		}

		$sql = "select * from Users where username = '$username' && `password` = '$password'";
		
		$result = mysqli_query( $conn, $sql );
		if ( $result ) {
			$count =  mysqli_num_rows( $result );

			if ( $count == 0 ) {
				echo "Account doesn't exist, please try again";
				showLoginContent();
			}
			else {
				$row = mysqli_fetch_assoc( $result );
				$permission = $row['permission'];
				header("Location: ../Management/management.php?permission='$permission'");
			}


		}
		else {
			echo "query error";
			showLoginContent();
		}


	}
	else {
		showLoginContent();
	}

?>
