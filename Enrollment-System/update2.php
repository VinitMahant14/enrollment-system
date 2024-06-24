<?php
	// Include the database connection settings from another file
	// Access all information on an applicant from the database
	// Access all information on a program coordinator from the database
	require('connection_db.php'); 
	
	if (isset($_GET['s_id'])) { 
		$applicant_id=$_GET['s_id'];
		$sql="SELECT * FROM applicant WHERE applicant_id=$applicant_id"; 
		$result=mysqli_query($connectivity,$sql);
		$row=mysqli_fetch_assoc($result);
		?>
		<style type="text/css">
			body { /* Styles for Applicant Information */
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
				background-color: #4CAF50;
				color: white;
				padding: 10px 20px;
				border: none;
				border-radius: 4px;
				cursor: pointer;
				font-size: 16px;
			}
			input[type="submit"]:hover {
				background-color: #45a049;
			}
		</style>
		<h2>Applicant Information</h2> 
		<form action="insert_db.php" method="POST"> <!-- Form element to display all the information on an applicant -->
			<input type="hidden" name="s_id" value=<?=$applicant_id?>><br>
			Name:<input required type="text" name="name" value="<?=$row['name'];?>"><br>
			Email:<input required type="email" name="email" value="<?=$row['email'];?>"><br>
			Password:<input required type="text" name="password" value="<?=$row['password'];?>"><br>
			Date of Birth: <input required type="date" name="dob" value=<?=$row['Date_of_birth'];?>><br><br>
			Gender:<input required type="text" name="gender" value=<?=$row['gender'];?>><br/>
			Photo: <input style="padding-left: 0px;" type="file" name="photo" value=<?=$row['photo'];?>><br><br>
			Address:<input required type="text" name="address" value="<?=$row['address'];?>"><br/>
			Course:<input required type="text" name="course" value="<?=$row['course'];?>" readonly><br>
			Status:<input required type="text" name="status" value="<?=$row['status'];?>" readonly><br>
			<input style="width: auto; margin-top: 10px;" type="submit" name="submit" value="Update">
			
			<p><b>Courses Available are as follows:</b></p> <!-- Informs the user of the available courses. -->
				<ul>
					<li style="text-decoration: none; color: black;">Computer Science</a></li>
					<li style="text-decoration: none; color: black;">Psychology</a></li>
					<li style="text-decoration: none; color: black;">Accountancy</a></li>
					<li style="text-decoration: none; color: black;">Biology</a></li>
					<li style="text-decoration: none; color: black;">Management</a></li>
					<li style="text-decoration: none; color: black;">Mathematics</a></li>
					<li style="text-decoration: none; color: black;">Communication Arts</a></li>
					<li style="text-decoration: none; color: black;">Economics</a></li>
					<li style="text-decoration: none; color: black;">Political Science</a></li>
				</ul>	
		</form>
	<?php
	}

	elseif (isset($_GET['t_id'])) {
		$programcoordinator_id=$_GET['t_id'];
		$sql="SELECT * FROM programcoordinator WHERE programcoordinator_id=$programcoordinator_id";
		$result=mysqli_query($connectivity,$sql);
		$row=mysqli_fetch_assoc($result);
		?>
		<style type="text/css">
			body { /* Styles for Program Coordinator Information */
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
				box-sizing: border-box; /* Ensures padding doesn't affect overall width */
			}
			input[type="submit"] {
				background-color: #4CAF50;
				color: white;
				padding: 10px 20px;
				border: none;
				border-radius: 4px;
				cursor: pointer;
				font-size: 16px;
			}
			input[type="submit"]:hover {
				background-color: #45a049;
			}
		</style>
		<h2>Program Coordinator Information</h2> 
		<form action="insert_db.php" method="POST"> <!-- Form element to display all the information on a program coordinator -->
			<input type="hidden" name="t_id" value=<?=$programcoordinator_id?>><br>
			Name:<input required type="text" name="name" value="<?=$row['name'];?>"><br>
			Email:<input required type="email" name="email" value="<?=$row['email'];?>"><br>
			Password:<input required type="text" name="password" value="<?=$row['password'];?>"><br>
			Address:<input required type="text" name="address" value="<?=$row['address'];?>"><br>
			Date of Birth: <input required type="date" name="dob" value=<?=$row['Date_of_birth'];?>><br><br>
			Gender:<input required type="text" name="gender" value=<?=$row['gender'];?>><br/>
			Photo: <input style="padding-left: 0px;" type="file" name="photo" value=<?=$row['photo'];?>><br><br>
			Program:<input required type="text" name="program" value="<?=$row['program'];?>" readonly><br>
			<input style="width: auto; margin-top: 10px;" type="submit" name="submit" value="Update">
		</form>
	<?php
	}
?>