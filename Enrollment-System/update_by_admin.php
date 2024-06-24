<?php
	// Include the database connection settings from another file, then start or resume a session to manage user state accross different pages.
	session_start(); 
	require('connection_db.php'); 

	$Account_C = $_POST['c_type']; // Retrieve the value of 'c_type' from the POST data and store it in the variable $Account_C

	if ($Account_C == 'programcoordinator') { // Check if the value of $Account_C is 'programcoordinator', then execute the statement
		$Name=mysqli_real_escape_string($connectivity,$_POST['name']);
		$Email=mysqli_real_escape_string($connectivity,$_POST['email']);
		$Pass=mysqli_real_escape_string($connectivity,$_POST['password']);
		$Dob=mysqli_real_escape_string($connectivity,$_POST['Date_of_birth']);
		$Account=mysqli_real_escape_string($connectivity,$_POST['c_type']);
		$Sex=mysqli_real_escape_string($connectivity,$_POST['Sex']);
		$Address=mysqli_real_escape_string($connectivity,$_POST['address']);
		$Photo=mysqli_real_escape_string($connectivity,$_POST['photo']);
		$Program=mysqli_real_escape_string($connectivity,$_POST['program']);

		$username= $_POST['email']; 
		$Pass=$_POST['password']; 
		$C_Pass=$_POST['confirm_password']; 

		$Checking = "SELECT * FROM programcoordinator WHERE email ='$username'"; // Check if the user is already registered
		$result= mysqli_query($connectivity,$Checking); 
		$row_count= mysqli_num_rows($result); 
			if($row_count > 0) // Condition to check if any rows are returned, set a message indicating the user is already registered
			{
				$_SESSION['message']=" Dear, admin the Name ". $Name." is already registered."; 
				header("Location:admin.php"); 
			}
			elseif ($Pass != $C_Pass) { // Check if the password and confirm password do not match, then set an error message for mismatched passwords
				$_SESSION['error']="Password do not match"; 
				header('Location:admin.php'); 
			}
			else{ // Insert a new program coordinator into the database
				$Database="INSERT INTO programcoordinator(name,email,password,address,Date_of_birth,gender,program,photo)VALUES('$Name','$Email','$Pass','$Address','$Dob','$Sex','$Program','$Photo')";
				if(mysqli_query($connectivity,$Database))
				{ 
					$_SESSION['message']=" Dear, admin the Name ". $Name." is registered."; 
					header("Location:programcoordinator.php"); 
				}
				else
				{ // Output an alert if there's an SQL error
					echo '<script type="text/javascript">alert("!! May be SQL query wrong");</script>';
					echo mysqli_error($connectivity); 
				}
			}
	}
	elseif ($Account_C == 'applicant') { // Check if the value of $Account_C is 'applicant', then execute the statement

		$Name=mysqli_real_escape_string($connectivity,$_POST['name']);
		$Email=mysqli_real_escape_string($connectivity,$_POST['email']);
		$Pass=mysqli_real_escape_string($connectivity,$_POST['password']);
		$Dob=mysqli_real_escape_string($connectivity,$_POST['Date_of_birth']);
		$Account=mysqli_real_escape_string($connectivity,$_POST['c_type']);
		$Sex=mysqli_real_escape_string($connectivity,$_POST['Sex']);
		$Address=mysqli_real_escape_string($connectivity,$_POST['address']);
		$Photo=mysqli_real_escape_string($connectivity,$_POST['photo']);
		$Course=mysqli_real_escape_string($connectivity,$_POST['course']);
		$Status=mysqli_real_escape_string($connectivity,$_POST['status']);

		$username= $_POST['email']; 
		$Pass=$_POST['password']; 
		$C_Pass=$_POST['confirm_password']; 

		$Checking = "SELECT * FROM applicant WHERE email ='$username'"; // Check if the user is already registered
		$result= mysqli_query($connectivity,$Checking); 
		$row_count= mysqli_num_rows($result); 
			if($row_count > 0)  // Condition to check if any rows are returned, set a message indicating the user is already registered
			{ 
				$_SESSION['message']=" Dear, admin the Name ". $Name." is already registered."; 
				header("Location:admin.php"); 
				exit();
			}
			elseif ($Pass != $C_Pass) { // Check if the password and confirm password do not match, then set an error message for mismatched passwords
				$_SESSION['error']="Password do not match"; 
				header('Location:admin.php'); 
			}
			else{ // Insert a new applicant into the database
				$Database="INSERT INTO applicant(name,email,password,Date_of_birth,Gender,address,course,photo, status)VALUES('$Name','$Email','$Pass','$Dob','$Sex','$Address','$Course','$Photo','$Status')";
			
				if(mysqli_query($connectivity,$Database))
				{ 
					$_SESSION['message']=" Dear, admin the Name ". $Name." is registered."; 
					header("Location:admin.php"); // Redirect to the admin page
					exit();
				}
				else
				{ // Output an alert if there's an SQL error
					echo mysqli_error($connectivity); 
				}
			}
	}