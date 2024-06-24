<?php
	// Start the session and include the database connection, then include the database connection settings from another file
	session_start(); 
	require('connection_db.php'); 

	// Check if the 'id' GET parameter is set
		// Fetch the applicant's current data
	// Check if the form has been submitted
	if(isset($_GET['id'])){
		$id = mysqli_real_escape_string($connectivity, $_GET['id']);

		
		$query = "SELECT * FROM applicant_info WHERE id = ?";
		$stmt = mysqli_prepare($connectivity, $query);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$applicant = mysqli_fetch_assoc($result);
		mysqli_stmt_close($stmt);

		if(!$applicant){
			die('Applicant not found.');
		}
	} else {
		die('ID not specified.');
	}

	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		// Text Inputs of Submitted Requirements
		$name = mysqli_real_escape_string($connectivity, $_POST['name']);
		$email = mysqli_real_escape_string($connectivity, $_POST['email']);
		$chosen_program = mysqli_real_escape_string($connectivity, $_POST['chosen_program']);
		$language_score = mysqli_real_escape_string($connectivity, $_POST['language_score']);
		$science_score = mysqli_real_escape_string($connectivity, $_POST['science_score']);
		$math_score = mysqli_real_escape_string($connectivity, $_POST['math_score']);
		$reading_score = mysqli_real_escape_string($connectivity, $_POST['reading_score']);

		// Update applicant_info contents within the database
		$updateQuery = "UPDATE applicant_info SET name = ?, email = ?, chosen_program = ?, language_score = ?, science_score = ?, math_score = ?, reading_score = ? WHERE id = ?";
		$stmt = mysqli_prepare($connectivity, $updateQuery);
		mysqli_stmt_bind_param($stmt, "sssssssi", $name, $email, $chosen_program, $language_score, $science_score, $math_score, $reading_score, $id);

		if(mysqli_stmt_execute($stmt)){
			echo "Record updated successfully.";
			
		} else { 
			echo "Error updating record: " . mysqli_error($connectivity);
		}

		mysqli_stmt_close($stmt);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Applicant Information</title>
	<style>
        body { /* Styles for Updating the Information Submitted by an Applicant */
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h2 {
            color: #333;
			text-align: center;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 20px auto;
        }
        input[type="text"], input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; 
        }
        input[type="submit"] {
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #004494;
        }
    </style>
</head>
<body>
    <h2>Update Applicant Submission</h2>
    <form method="POST" action="">  <!-- Form for updating applicant information -->
        Name: <input type="text" name="name" value="<?= htmlspecialchars($applicant['name']) ?>"><br>
        Email: <input type="email" name="email" value="<?= htmlspecialchars($applicant['email']) ?>"><br>
        Chosen Program: <input type="text" name="chosen_program" value="<?= htmlspecialchars($applicant['chosen_program']) ?>"><br>
        Language Score: <input type="text" name="language_score" value="<?= htmlspecialchars($applicant['language_score']) ?>"><br>
        Science Score: <input type="text" name="science_score" value="<?= htmlspecialchars($applicant['science_score']) ?>"><br>
        Math Score: <input type="text" name="math_score" value="<?= htmlspecialchars($applicant['math_score']) ?>"><br>
        Reading Score: <input type="text" name="reading_score" value="<?= htmlspecialchars($applicant['reading_score']) ?>"><br>
		
        <input type="submit" value="Update">
    </form>
</body>
</html>