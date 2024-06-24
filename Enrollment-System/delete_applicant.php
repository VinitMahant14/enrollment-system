<?php
	// Start or resume a session, then include the database connection file
	// Check if 'id' is provided in the URL as a GET parameter
		// Delete a record from 'applicant_info' table where the 'id' matches
		// Execution of query and checking if it was successful
	// Redirect to the 'view_applicants.php' page to show all applicants and the deletion status
	session_start(); 
	require('connection_db.php'); 

	if (isset($_GET['id'])) { 
		$id = $_GET['id']; 
		$query = "DELETE FROM applicant_info WHERE id = $id";  

		if (mysqli_query($connectivity, $query)) { 
			$_SESSION['message'] = "Record deleted successfully."; 
		} else { 
			$_SESSION['message'] = "Error deleting record: " . mysqli_error($connectivity);
		}
	} else { 
		$_SESSION['message'] = "No ID provided.";
	}

	header('Location: view_applicants.php'); 
	exit; 
?>
