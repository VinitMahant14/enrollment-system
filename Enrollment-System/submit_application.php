<?php
	// Start the session, include database connection file
	session_start();
	require('connection_db.php');

	// Check if the form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Text Inputs of Submitted Requirements
		$name = mysqli_real_escape_string($connectivity, $_POST['name']);
		$email = mysqli_real_escape_string($connectivity, $_POST['email']);
		$language_score = mysqli_real_escape_string($connectivity, $_POST['language_score']);
		$science_score = mysqli_real_escape_string($connectivity, $_POST['science_score']);
		$math_score = mysqli_real_escape_string($connectivity, $_POST['math_score']);
		$reading_score = mysqli_real_escape_string($connectivity, $_POST['reading_score']);
		$chosen_program = mysqli_real_escape_string($connectivity, $_POST['chosen_program']);

		// File upload paths
		$gradesPath = 'uploads/' . basename($_FILES['grades']['name']);
		$programRequirementPath = 'uploads/' . basename($_FILES['program_requirement']['name']);

		// Attempt to upload the files
		$uploadOk = 1;
		
		// Check if file is a PDF
		
		// Check if $uploadOk is set to 0 by an error
		// Otherwise, proceed with uploadiung the files through 'move_uploaded_file'
			// Insert applicant_info contents into the database
				// Inform user that records have been added
				// Otherwise, inform user of failed execution
			// Otherwise, inform user of failed upload
		// Inform user that the request method was invalid
		if ($_FILES['grades']['type'] != 'application/pdf' || $_FILES['program_requirement']['type'] != 'application/pdf') {
			echo "Sorry, only PDF files are allowed.";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "Sorry, your files were not uploaded.";
		
		} else {
			if (move_uploaded_file($_FILES['grades']['tmp_name'], $gradesPath) && move_uploaded_file($_FILES['program_requirement']['tmp_name'], $programRequirementPath)) {
				echo "The files have been uploaded.";
				
				$sql = "INSERT INTO applicant_info (name, email, language_score, science_score, math_score, reading_score, chosen_program, grades_path, program_requirement_path)
				VALUES ('$name', '$email', '$language_score', '$science_score', '$math_score', '$reading_score', '$chosen_program', '$gradesPath', '$programRequirementPath')";

				if(mysqli_query($connectivity, $sql)){ 
					echo "Records added successfully.";
				} else{ 
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($connectivity);
				}

			} else { 
				echo "Sorry, there was an error uploading your files.";
			}
		}
	} else { 
		echo "Invalid request method.";
	}
?>
