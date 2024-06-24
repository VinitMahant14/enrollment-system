<?php
    // Include the database connection settings from another file, then start or resume a session to manage user state accross different pages.
    // Check if the 'logout' POST variable is set, which indicates a logout request, within that I included a way to destroy the session to logout the user.
	// Redirect the user to index.php after he/she logs out
	// I also added a condition where the user gets verified if he/she is an 'admin', otherwise if he/she is not, then the user gets redirected to index.php.
	require('connection_db.php');
    session_start();

    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location:index.php');
    }

    elseif($_SESSION['login']=="admin")
    {
        $user = $_SESSION['user'];

        if(isset($_SESSION['message']))
        {   
            echo '<script type="text/javascript">alert("'.$_SESSION['message'].'");</script>';
            unset($_SESSION["message"]); 
        }
    }
    else
        header('Location:index.php');        
?>

<!DOCTYPE html>
<html>
<head>
	<title>ADMIN Dashboard</title>
	<style type="text/css">
		/* Styles for the entire body of the webpage */
		body{
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
			<img style = "height: 65px; display: inline-flex;" src="UP-System-UP-Cebu-Logo.png" alt="UP Logo">
			<b style="font-family: cursive; font-size: 35px; color: #ed854d; width: 800px; padding-left: 10px;"><?php 
			echo "Welcome, ". $user ?></b> <!-- Welcome the user to their portal -->
		</div>
	
		<form style="display: inline-flex;" action="#" method="POST">
			<input style="margin: 5px;" type="submit" name="logout" value="Logout">
		</form>
	</div>

	<div style="background-color: #d8dedc; height: auto; padding-bottom: 10px;">
		<br>
		<form method="get" action="admin.php"> <!-- Form element with GET method to submit data; data is sent to 'admin.php' -->
			&emsp;<input type="hidden" name="action" value="search_applicant_name"> 
			<label for="search_applicant_name">Search by Name of Applicant:</label>  
			<input type="text" id="search_applicant_name" name="search_applicant_name" placeholder="Enter Name">
			
			<button type="submit">Search</button> 
		</form>
	
		<?php
			// Check if 'action' is set in the GET request and if it equals 'search_applicant_name', and also ensure that the 'search_applicant_name' GET parameter is not empty.
			if (isset($_GET['action']) && $_GET['action'] == 'search_applicant_name' && !empty($_GET['search_applicant_name'])) {
				$search_applicant_name = mysqli_real_escape_string($connectivity, $_GET['search_applicant_name']);
				$sql = "SELECT * FROM applicant WHERE name LIKE '%$search_applicant_name%'";
				
			} else {
				$sql = "SELECT * FROM applicant";
			}
			
			$result = mysqli_query($connectivity, $sql);
			
			// Check if the query returned any rows, if not display a message, otherwise continue the process of accessing applicant records.
			if (mysqli_num_rows($result) == 0) {
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
							<th>Password</th>
							<th>Date of Birth</th>
							<th>Gender</th>
							<th>Photo</th>
							<th>Address</th>
							<th>Course</th>
							<th>Status</th>
							<th>Update</th>
							<th>Delete</th>
							
						</tr>
					
				<?php
					// Start a while loop to iterate through each row of the result set from a database query
					// Fetch each row as an associative array and start a table row for each applicant along with their corresponding information.
					while ($row=mysqli_fetch_assoc($result)) { 
						?>
						<tr>
							<td><?=$row['applicant_id'];?></td>
							<td><?=$row['name'];?></td>
							<td><?=$row['email'];?></td>
							<td><?=$row['password'];?></td>
							<td><?=$row['Date_of_birth'];?></td>
							<td><?=$row['gender'];?></td>
							<td><img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" style="width: 100px; height: 100px; object-fit: cover;"></td> 
							<td><?=$row['address'];?></td>
							<td><?=$row['course'];?></td>
							<td><?=$row['status'];?></td>
							<td><a href="update.php?s_id=<?=$row['applicant_id']?>">UPDATE</a></td> <!-- Provide a link to update the applicant's data. Pass the applicant's ID as a query parameter -->
							<td><a href="insert_db.php?s_id=<?=$row['applicant_id']?>" onclick="return confirm('Are you sure you want to delete this account?');">DELETE</a></td> <!-- Provide a link to delete the applicant's data. Display a confirmation dialog before deletion -->
						</tr>
						<?php
					}
					?>
					</table>
				<?php
				}
			?> 
			<br><a style="margin-left: 20px;" href="update.php?user='applicant'">Add New Applicant</a>
			
			<!-- Link points to 'update.php' and passes a query parameter 'user' with the value 'applicant' -->
			<br><br>
			<b style="margin-left: 20px;">Applicant Submissions</b><br>
			<a href="view_applicants.php" style="display: inline-block; margin: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none;">View Submitted Requirements</a>
			<!-- Provide a link to proceed to the submitted requirements of an Applicant as an ADMIN which redirects to 'view_applicants.php'.-->
			<hr>
			
			<form method="get" action="admin.php"> <!-- Form element with GET method to submit data; data is sent to 'admin.php' -->
				&emsp;<input type="hidden" name="action" value="search_coordinator_name"> 
				<label for="search_coordinator_name">Search by Name of Program Coordinator:</label> 
				<input type="text" id="search_coordinator_name" name="search_coordinator_name" placeholder="Enter Name">
				<button type="submit">Search</button> <!-- Button to submit the form, labeled 'Search' -->
			</form>
			
			<?php
				// Check if 'action' is set in the GET request and if it equals 'search_applicant_name', and also ensure that the 'search_applicant_name' GET parameter is not empty.
				if (isset($_GET['action']) && $_GET['action'] == 'search_coordinator_name' && !empty($_GET['search_coordinator_name'])) {
					$search_coordinator_name = mysqli_real_escape_string($connectivity, $_GET['search_coordinator_name']);
					$sql = "SELECT * FROM programcoordinator WHERE name LIKE '%$search_coordinator_name%'";
			
				} else {
					
					$sql = "SELECT * FROM programcoordinator";
				}
				
				$result = mysqli_query($connectivity, $sql);
				
				// Check if the query returned any rows, if not display a message, otherwise continue the process of accessing program coordinator records.
				if (mysqli_num_rows($result) <= 0) {
					echo "Program coordinator's data not found"; 
				}
				else { 
			?>
					<br>
					<b style="margin-left: 20px;">Program Coordinator Records</b>
					<table style="margin-left: 10px; margin-right: 10px;" border="1px"> 
						<tr> 
							<th>Program Coordinator No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Password</th>
							<th>Date of Birth</th>
							<th>Gender</th>
							<th>Photo</th>
							<th>Address</th>
							<th>Program</th>
							<th>Update</th>
							<th>Delete</th>
							
						</tr>
					
				<?php
					// Start a while loop to iterate through each row of the result set from a database query
					// Fetch each row as an associative array and start a table row for each program coordinator along with their corresponding information.
					while ($row=mysqli_fetch_assoc($result)) { 
						?>
						<tr>
							<td><?=$row['programcoordinator_id'];?></td>
							<td><?=$row['name'];?></td>
							<td><?=$row['email'];?></td>
							<td><?=$row['password'];?></td>
							<td><?=$row['Date_of_birth'];?></td>
							<td><?=$row['gender'];?></td>
							<td><img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" style="width: 100px; height: 100px; object-fit: cover;"></td> <!-- Display the program coordinator's photo and disregards any special characters in the image source path -->
							<td><?=$row['address'];?></td>
							<td><?=$row['program'];?></td>
							<td><a href="update.php?t_id=<?=$row['programcoordinator_id']?>">UPDATE</a></td> <!-- Provide a link to update the program coordinator's data. Pass the program coordinator's ID as a query parameter -->
							<td><a href="insert_db.php?t_id=<?=$row['programcoordinator_id']?>" onclick="return confirm('Are you sure you want to delete this account?');">DELETE</a></td> <!-- Provide a link to delete the program coordinator's data. Display a confirmation dialog before deletion -->
						</tr>
						<?php
					}
					?>
					</table>
					
				<?php
				}
			
			?> 
		<br><a style="margin-left: 20px;" href="update.php?tu='programcoordinator'">Add New Program Coordinator</a><br><br>
		<!-- Link points to 'update.php' and passes a query parameter 'user' with the value 'programcoordinator' -->
		<hr>
		<b style="margin-left: 20px;">Declared Program Coordinator Requirements</b><br>
		<a href="program_reqAD.php" style="display: inline-block; margin: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none;">Proceed to Program Requirements</a>
		<!-- Provide a link to proceed to the program requirements as an ADMIN which redirects to 'program_reqAD.php'.-->
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