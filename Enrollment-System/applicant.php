<?php
	// Include the database connection settings from another file, then start or resume a session to manage user state accross different pages.
    // Check if the 'logout' POST variable is set, which indicates a logout request, within that I included a way to destroy the session to logout the user.
	// Redirect the user to index.php after he/she logs out
	// I also added a condition where the user gets verified if he/she is an 'applicant', otherwise if he/she is not, then the user gets redirected to index.php.
	require('connection_db.php'); 
	session_start(); 
	if (isset($_POST['logout'])) {  
		session_destroy();
		header('Location:index.php');
	}
	elseif($_SESSION['login']=="applicant")
	{ 
		$user =$_SESSION['name']; 
	}

	else 
		header('Location:index.php');		
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Applicant Panel</title>
	<style type="text/css">
		body{ /* Styles for the entire body of the webpage */
			background: #f1f1f1; 
		}
		
		.input{
			width: 373px;
			margin-top: 10px;
			height: 35px; 
			padding-left: 15px;
			font-size: 18px;
		}
		
		.flex{ 
			display: inline-flex;
		}
		
		table { 
		    border-collapse: collapse; 
		    width: auto; 
		}
		
		th{ 
			text-align: center;
			background-color: #808080; 
		    color: white;
		}

		td {
		    text-align: left; 
		    padding: 8px; 
		}

		tr:nth-child(even){ 
			background-color: #f2f2f2 
		}
		
		tr:nth-child(odd){ 
			background-color: #f9f9f9 
		}
	</style>
</head>

<body>
	<div style="background-color: #96261e; height: 100px; padding-top: 10px;">
		<div style="padding: 10px; display: inline-flex;">
			<img style = "height: 65px; display: inline-flex;" src="UP-System-UP-Cebu-Logo.png" alt="UP Logo"><b style="font-family: cursive; font-size: 35px; color: #ed854d; width: 800px; margin-left: 20px;"><?php 
			echo "Welcome, ". $user ?></b> <!-- Welcome the user to their portal -->
		</div>
		<form style="display: inline-flex;" action="#" method="POST">
		<input style="margin: 5px;" type="submit" name="logout" value="Logout">
	</form>
	</div>

	<div style="background-color: #d8dedc; height: auto; padding-top: 1px;">

		<?php

			$applicant_id=$_SESSION['applicant_id']; // Retrieve the applicant's ID stored in the session

			$sql = "SELECT * FROM applicant WHERE applicant_id='$applicant_id'"; 
				$result = mysqli_query($connectivity, $sql); 

				if (mysqli_num_rows($result) == 0) {  // Check if the query returned any rows, if not display a message, otherwise continue the process of accessing applicant records.
				   echo "No data found"; 
				}
				else{ 
					// Start a while loop to iterate through each row of the result set from a database query
					// Fetch each row as an associative array and start a table row for each applicant along with their corresponding information.
					while ($row=mysqli_fetch_assoc($result)) { 
					$applicant_id=$row['applicant_id'];
					$name=$row['name'];
					$email=$row['email'];
					$pass=$row['password'];
					$dob=$row['Date_of_birth'];
					$gender=$row['gender'];
					$photo=$row['photo'];
					$address=$row['address'];
					$course=$row['course'];	
					$status=$row['status'];	
				}	
		?>
			<script>
				function password() {
				    var x = document.getElementById('show');
				    if (x.style.display == 'block') {
				        x.style.display = 'none';
				    } 
				    else{
				        x.style.display = 'block';
				    }
				}
			</script>

			<div style="margin-left: 100px;">
			<p>Username:&emsp;<?=$email;?><br>
			<p style="display: inline-flex;">Password:&emsp; 
				<span hidden id="show"> <?=$pass;?></span> &emsp;
				<button style="height: 37px; margin-top: -8px;" type="button" onclick="password()">Show/Hide</button>
			</div><br>
					<table style="margin-left: 10px; margin-right: 10px;" border="1px"> 
						<tr> 
							<th>Applicant ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Date of Birth</th>
							<th>Gender</th>
							<th>Photo</th>
							<th>Address</th>
							<th>Course</th>
							<th>Status</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>
						<tr>
							<td><?=$applicant_id;?></td>
							<td><?=$name;?></td>
							<td><?=$email;?></td>
							<td><?=$dob;?></td>
							<td><?=$gender;?></td>
							<td><img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" style="width: 100px; height: 100px; object-fit: cover;"></td> 
							<td><?=$address;?></td>
							<td><?=$course;?></td>
							<td><?=$status;?></td>
							<td><a href="update2.php?s_id=<?=$applicant_id;?>">UPDATE</a></td> <!-- Provide a link to update the applicant's data. Pass the applicant's ID as a query parameter -->
							<td><a href="insert_db.php?st_id=<?=$applicant_id;?>" onclick="return confirm('Are you sure you want to delete your account?');">DELETE ACCOUNT</a></td> <!-- Provide a link to delete the applicant's data. Display a confirmation dialog before deletion -->
						</tr>
					</table>
					
					<p>&emsp;<b>Note:</b> If the Course/Status Field is still <b>"Pending"</b> or blank, the program you have chosen is still assessing your submitted documents or you still haven't submitted anything yet for your chosen course.</p>
					<hr>
					<a href="enrollment.php" style="display: inline-block; margin: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none;">Proceed to Requirement Submissions</a>
					<!-- Provide a link to proceed to the submit requirements section of the Applicant Panel which redirects to 'enrollment.php'.-->
					<p>&emsp;<b>Attention!</b> If you have already submitted your requirements for your desired course, it will directly be reflected and shown below. Blank, if otherwise.</p>
					<?php
						if (isset($_SESSION['email'])) { // Check if an 'email' session variable is set, indicating the user is possibly logged in
							$email = $_SESSION['email']; 
							
							$sql = "SELECT id, chosen_program, language_score, science_score, math_score, reading_score, grades_path, program_requirement_path FROM applicant_info WHERE email = ?";
							$stmt = mysqli_prepare($connectivity, $sql);
							// Use mysqli_prepare to prepare the SQL statement for execution, which helps prevent SQL injection
							
							if (!$stmt) { // Check if the statement preparation was unsuccessful
								echo "Error preparing statement: " . mysqli_error($connectivity); 
								exit; 
							}

							mysqli_stmt_bind_param($stmt, "s", $email);
							
							mysqli_stmt_execute($stmt);

							mysqli_stmt_bind_result($stmt, $id, $chosenprog, $langscore, $sciscore, $mathscore, $readingscore, $gradespath, $progreqpath);

							?>
							<table style="margin-left: 10px; margin-right: 10px;" border="1px"> 
								<tr> 
									<th>Submission ID</th>
									<th>Program</th>
									<th>Language Score</th>
									<th>Science Score</th>
									<th>Math Score</th>
									<th>Reading Score</th>
									<th>High School Grades</th>
									<th>Program Requirement</th>
								</tr>
							<?php
							while (mysqli_stmt_fetch($stmt)) { // Start a while loop to iterate through each row of the result set from a database query
								echo "<tr>";
								echo "<td>" . htmlspecialchars($id) . "</td>";
								echo "<td>" . htmlspecialchars($chosenprog) . "</td>";
								echo "<td>" . htmlspecialchars($langscore) . "</td>";
								echo "<td>" . htmlspecialchars($sciscore) . "</td>";
								echo "<td>" . htmlspecialchars($mathscore) . "</td>";
								echo "<td>" . htmlspecialchars($readingscore) . "</td>";
								echo "<td><a href='" . htmlspecialchars($gradespath) . "' target='_blank'>View Grades</a></td>";
								echo "<td><a href='" . htmlspecialchars($progreqpath) . "' target='_blank'>View Document</a></td>";
								echo "</tr>";
							}

							mysqli_stmt_close($stmt);
							?>
							</table>
							<?php
						} else {
							echo "Session email not set.";
						}
					?>
					<p>&emsp;<b>Note:</b> If you have made any mistake with your submissions, contact the University immediately to have this revised and corrected asap. <b>DO NOT FILL UP THE "Applicant Requirements Submission Form" AGAIN!</b></p>
					
					<hr>
					&emsp;<b>List of Program-Specific Requirement/s <i>(To be submitted along with Primary Requirements needed by the University for Assessment.)</i></b><br><br>
				 
					<table style="margin-left: 10px; margin-right: 10px;" border="1px">
						<thead>
							<tr> 
								<th>Program</th>
								<th>Program Requirement/s</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// Search functionality
							$search_program = $_GET['search_program'] ?? ''; // Retrieve the 'search_program' from GET request or default to empty string
							$query = "SELECT * FROM programs WHERE program LIKE ?"; // SQL query to select all columns from the 'programs' table where 'program' column matches the search pattern
							if ($stmt = mysqli_prepare($connectivity, $query)) { 
								$like_search_program = '%' . $search_program . '%';
								mysqli_stmt_bind_param($stmt, 's', $like_search_program);
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);
								
								while ($row = mysqli_fetch_assoc($result)) { // Iterate over each row in the result set
									// Output table rows with the program data
									echo "<tr>";
									echo "<td>".$row['program']."</td>";
									echo "<td>".$row['program_requirements']."</td>";
									echo "</tr>";
								}
								mysqli_free_result($result);
							} else { // Handle errors if the SQL statement fails to prepare
								echo "<tr><td colspan='3'>No program requirements found or search query failed.</td></tr>";
							}
							
							?>
						</tbody>
					</table><br><br>
				<?php
			}
		?> 
	</div>
	<footer style="background-color: gray; height: 65px;"> <!-- References to Portal Design-->
		<div style="padding-top: 10px; padding-left: 25px;">&copy; College Admissions Simulator - BETA Version 1.0</div>
		<div style="padding-bottom: 15px; padding-left: 25px;">Developed by Shaw Jie Yao, Referenced from: <button onclick="navigateTo('https://code-projects.org/enrollment-system-in-php-with-source-code/')" title="Enrollment System - Code-Projects">Code-Projects.org</button></div>
	</footer>
	
	<script>
		function navigateTo(url) { // Set the window's location to the specified URL, causing the browser to navigate to it
			window.location.href = url;
		}
	</script>

</body>
</html>