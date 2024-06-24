<?php
	// Include the database connection settings from another file, then start or resume a session to manage user state accross different pages.
    // Check if the 'logout' POST variable is set, which indicates a logout request, within that I included a way to destroy the session to logout the user.
	// Redirect the user to index.php after he/she logs out
	// I also added a condition where the user gets verified if he/she is an 'programcoordinator', otherwise if he/she is not, then the user gets redirected to index.php.
	require('connection_db.php'); 
	session_start(); 
	if (isset($_POST['logout'])) {  
		session_destroy(); 
		header('Location:index.php');
	}
	elseif($_SESSION['login']=="programcoordinator")
	{ 
		$user =$_SESSION['name']; 
	}

	else 
		header('Location:index.php');		
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Program Coordinator Panel</title>
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

			$programcoordinator_id=$_SESSION['programcoordinator_id']; // Retrieve the programcoordinator's ID stored in the session

			$sql = "SELECT * FROM programcoordinator WHERE programcoordinator_id='$programcoordinator_id'"; 
			$result = mysqli_query($connectivity, $sql); 

				if (mysqli_num_rows($result) == 0) { // Check if the query returned any rows, if not display a message, otherwise continue the process of accessing applicant records.
				   echo "No data found"; 
				}
				else{ 
					// Start a while loop to iterate through each row of the result set from a database query
					// Fetch each row as an associative array and start a table row for each applicant along with their corresponding information.
					while ($row=mysqli_fetch_assoc($result)) { 
			
						$programcoordinator_id=$row['programcoordinator_id'];
						$name=$row['name'];
						$email=$row['email'];
						$pass=$row['password'];
						$address=$row['address'];
						$dob=$row['Date_of_birth'];
						$gender=$row['gender'];
						$photo=$row['photo'];
						$program=$row['program'];	
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
						<th>Program Coordinator ID</th>
						<th>Name</th>
						<th>Email</th>
						
						<th>Address</th>
						<th>Date of Birth</th>
						<th>Gender</th>
						<th>Photo</th>
						<th>Program</th>
						<th>Update</th>
						<th>Delete</th>	
					</tr>
					<tr>
						<td><?=$programcoordinator_id;?></td>
						<td><?=$name;?></td>
						<td><?=$email;?></td>
						
						<td><?=$address;?></td>
						<td><?=$dob;?></td>
						<td><?=$gender;?></td>
						<td><img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" style="width: 100px; height: 100px; object-fit: cover;"></td> 
						<td><?=$program;?></td>
						<td><a href="update2.php?t_id=<?=$programcoordinator_id;?>">UPDATE</a></td> <!-- Provide a link to update the programcoordinator's data. Pass the programcoordinator's ID as a query parameter -->
						<td><a href="insert_db.php?tt_id=<?=$programcoordinator_id;?>" onclick="return confirm('Are you sure you want to delete this account?');">DELETE ACCOUNT</a></td> <!-- Provide a link to delete the programcoordinator's data. Display a confirmation dialog before deletion -->
					</tr>	
				</table>
				
				<p>&emsp;<b>Note:</b> If the Program Field is blank, Contact the <b>"ADMIN"</b> to be assigned a program.</p>
				
				<br>
				<b style="margin-left: 20px;">Applicant Submissions</b><br>
				<a href="view_applicants2.php" style="display: inline-block; margin: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none;">View Submitted Requirements</a>
				<!-- Provide a link to proceed to view the requirements submitted by an applicant within the Program Coordinator Panel which redirects to 'view_applicants2.php'.-->
				<hr>
				
				<form method="get" action="programcoordinator.php"> <!-- Form element with GET method to submit data; data is sent to 'programcoordinator.php' -->
					&emsp;<input type="hidden" name="action" value="search_applicant"> 
					<label for="search_course">Filter by Course:</label> 
					<input type="text" id="search_course" name="search_course" placeholder="e.g. Economics">
					<button type="submit">Search</button> 
				</form>

				<?php
				// Check if a search was made
				if (isset($_GET['action']) && $_GET['action'] == 'search_applicant' && !empty($_GET['search_course'])) {
				// Check if 'action' is set in the GET request and if it equals 'search_applicant', and also ensure that the 'search_course' GET parameter is not empty.
					$search_term = mysqli_real_escape_string($connectivity, $_GET['search_course']);
					$sql = "SELECT * FROM applicant WHERE course LIKE '%$search_term%'";
					
				} else { 
					$sql = "SELECT * FROM applicant";
				}

				$result = mysqli_query($connectivity, $sql); 

				if (mysqli_num_rows($result) == 0) { // Check if the query returned any rows, if not display a message, otherwise continue the process of accessing applicant records.
					echo "Applicant's data not found"; 
				} else { 
				?>
					<br>
					<b style="margin-left: 20px;">Applicant Records</b>
					<table style="margin-left: 10px; margin-right: 10px;" border="1px"> 
						<tr> 
							<th>Applicant No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Date of Birth</th>
							<th>Gender</th>
							<th>Photo</th>
							<th>Address</th>
							<th>Course</th>
							<th>Status</th>
							<th>Declare Status</th>
						</tr>
					<?php
						// Start a while loop to iterate through each row of the result set from a database query
						// Fetch each row as an associative array and start a table row for each applicant along with their corresponding information.
						while ($row = mysqli_fetch_assoc($result)) { 
					?>
						<tr>
							<td><?= htmlspecialchars($row['applicant_id']); ?></td>
							<td><?= htmlspecialchars($row['name']); ?></td>
							<td><?= htmlspecialchars($row['email']); ?></td>
							<td><?= htmlspecialchars($row['Date_of_birth']); ?></td>
							<td><?= htmlspecialchars($row['gender']); ?></td>
							<td><img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" style="width: 100px; height: 100px; object-fit: cover;"></td> <!-- Display the applicant's photo and disregards any special characters in the image source path -->
							<td><?= htmlspecialchars($row['address']); ?></td>
							<td><?= htmlspecialchars($row['course']); ?></td>
							<td><?= htmlspecialchars($row['status']); ?></td>
							<td><a href="update_pc.php?s_id=<?= htmlspecialchars($row['applicant_id']) ?>">DECLARE STATUS</a></td> <!-- Provide a link to declare the applicant's status. Pass the applicant's ID as a query parameter -->
						</tr>
					<?php
						}
					?>
					</table><br><br>
				<?php
				}
				?>
				<b style="margin-left: 20px;">Declare Program Requirements</b><br>
				<hr>
				<a href="program_req.php" style="display: inline-block; margin: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none;">Proceed to Program Requirements</a>
				<!-- Provide a link to proceed to the program requirements section of the Program Coordinator Panel which redirects to 'program_req.php'.-->
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