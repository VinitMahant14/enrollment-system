<?php
	// Start or resume a session to keep track of user data across requests, then include the database connection file
	// Retrieve the value of 'c_type' from the POST data and store it in the variable $Account_C
	
	session_start(); 
	require('connection_db.php'); 

	$Account_C = $_POST['c_type']; 

	// Check if the value of $Account_C is 'programcoordinator', then execute the statement
		// Check if any rows are returned, set a message indicating the user is already registered
		// Check if the password and confirm password do not match, set an error message for mismatched passwords
		// Otherwise, insert a new program coordinator into the database
			// Output an alert if there's an SQL error
			
	// Check if the value of $Account_C is 'applicant', then execute the statement
		// Check if any rows are returned, set a message indicating the user is already registered
		// Check if the password and confirm password do not match, set an error message for mismatched passwords
		// Otherwise, insert a new applicant into the database 
			// Output an alert if there's an SQL error
			
	// Check if the 's_id' POST variable is set for the applicant, then update the information of the registered applicant 
		// Output an alert if there's an SQL error
	
	// Check if the 't_id' POST variable is set for the program coordinator, then update the information of the registered program coordinator 
		// Output an alert if there's an SQL error
		
	// Check if the 's_id' GET variable is set, then delete the registered applicant
		// Output an alert if there's an SQL error
		
	// Check if the 't_id' GET variable is set, then delete the registered program coordinator
		// Output an alert if there's an SQL error
		
	// Check if the 'st_id' GET variable is set, then delete the registered applicant
		// Output an alert if there's an SQL error
		
	// Check if the 'tt_id' GET variable is set, then delete the registered program coordinator
		// Output an alert if there's an SQL error
		
	// Output an alert if there's an SQL error
	if ($Account_C == 'programcoordinator') { 
		$Name=mysqli_real_escape_string($connectivity,$_POST['name']);
		$Email=mysqli_real_escape_string($connectivity,$_POST['email']);
		$Pass=mysqli_real_escape_string($connectivity,$_POST['password']);
		$Dob=mysqli_real_escape_string($connectivity,$_POST['Date_of_birth']);
		$Account=mysqli_real_escape_string($connectivity,$_POST['c_type']);
		$Gender=mysqli_real_escape_string($connectivity,$_POST['gender']);
		$Address=mysqli_real_escape_string($connectivity,$_POST['address']);
		$Photo=mysqli_real_escape_string($connectivity,$_POST['photo']);
		$Program=mysqli_real_escape_string($connectivity,$_POST['program']);

		$username= $_POST['email']; 
		$Pass=$_POST['password']; 
		$C_Pass=$_POST['confirm_password']; 

		$Checking = "SELECT * FROM programcoordinator WHERE email ='$username'"; // Check if the user is already registered
		$result= mysqli_query($connectivity,$Checking); 
		$row_count= mysqli_num_rows($result);
			if($row_count > 0) 
			{
				$_SESSION['message']=" Dear, ". $Name." You are already registered."; 
				header("Location:index.php"); 
			}

			elseif ($Pass != $C_Pass) 
            {
				$_SESSION['error']="Password do not match"; 
				header('Location:index.php'); 
			}
			else{
				$Database="INSERT INTO programcoordinator(name,email,password,address,Date_of_birth,gender,photo,program)VALUES('$Name','$Email','$Pass','$Address','$Dob','$Gender','$Photo','$Program')";
				if(mysqli_query($connectivity,$Database)) 
				{
					$_SESSION['message']=" Dear, ". $Name." you are registered."; 
					header("Location:programcoordinator.php"); 
				}
				else
				{
					echo '<script type="text/javascript">alert("!! May be SQL query wrong");</script>';
					echo mysqli_error($connectivity); 
				}
			}
	}
	elseif ($Account_C == 'applicant') { 

		$Name=mysqli_real_escape_string($connectivity,$_POST['name']);
		$Email=mysqli_real_escape_string($connectivity,$_POST['email']);
		$Pass=mysqli_real_escape_string($connectivity,$_POST['password']);
		$Dob=mysqli_real_escape_string($connectivity,$_POST['Date_of_birth']);
		$Account=mysqli_real_escape_string($connectivity,$_POST['c_type']);
		$Gender=mysqli_real_escape_string($connectivity,$_POST['gender']);
		$Address=mysqli_real_escape_string($connectivity,$_POST['address']);
		$Photo=mysqli_real_escape_string($connectivity,$_POST['photo']);
		$Course=mysqli_real_escape_string($connectivity,$_POST['course']);
		$Status=mysqli_real_escape_string($connectivity,$_POST['status']);

		$username= $_POST['email']; 
		$Pass=$_POST['password']; 
		$C_Pass=$_POST['confirm_password']; 

		$Checking = "SELECT * FROM applicant WHERE email ='$username'"; 
		$result= mysqli_query($connectivity,$Checking); 
		$row_count= mysqli_num_rows($result); 
			if($row_count > 0) 
			{
				$_SESSION['message']=" Dear, ". $Name." You are already registered.";
				header("Location:index.php"); 
			}
			elseif ($Pass != $C_Pass) { 
				$_SESSION['error']="Password do not match"; 
				header('Location:index.php'); 
			}
			else{ 
				$Database="INSERT INTO applicant(name,email,password,Date_of_birth,gender,photo,address,course, status)VALUES('$Name','$Email','$Pass','$Dob','$Gender','$Photo','$Address','$Course', '$Status')";
				
				if(mysqli_query($connectivity,$Database))
				{ 
					$_SESSION['message']=" Dear, ". $Name." you are registered."; 
					header("Location:applicant.php"); 
				}
				else
				{ 
					echo mysqli_error($connectivity); 
				}
			}
	}
	elseif (isset($_POST['s_id'])) { 

		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$dob=mysqli_real_escape_string($connectivity,$_POST['dob']);
		$gender=$_POST['gender'];
		$photo=$_POST['photo'];
		$address=$_POST['address'];
		$course=$_POST['course'];
		$status=$_POST['status'];
		$applicant_id=$_POST['s_id'];
			
			$sql="UPDATE applicant SET name='$name',email='$email',password='$password',Date_of_birth='$dob',gender='$gender',photo='$photo',address='$address',course='$course',status='$status' WHERE applicant_id=$applicant_id";
				if(mysqli_query($connectivity,$sql)){ 
					header('location:admin.php');
				}
				else{ 
					mysqli_error($connectivity); 
				}
			
	}
	elseif (isset($_POST['t_id'])) { 

		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$address=$_POST['address'];
		$dob=$_POST['dob'];
		$gender=$_POST['gender'];
		$photo=$_POST['photo'];
		$program=$_POST['program'];
		$programcoordinator_id=$_POST['t_id'];
			
			$sql="UPDATE programcoordinator SET name='$name',email='$email',password='$password',address='$address',Date_of_birth='$dob',gender='$gender',photo='$photo',program='$program' WHERE programcoordinator_id=$programcoordinator_id";
				if(mysqli_query($connectivity,$sql)){ 
					header('location:admin.php');
				}
				else{ 
					mysqli_error($connectivity); 
				}
			
	}
	elseif (isset($_GET['s_id'])) {  
		$applicant_id=$_GET['s_id'];
		
		$sql="DELETE FROM applicant WHERE applicant_id=$applicant_id";
			if(mysqli_query($connectivity,$sql)){ 
				header('location:admin.php');
			}
			else{ 
				mysqli_error($connectivity); 
			}
	}
	elseif (isset($_GET['t_id'])) { 
		$programcoordinator_id=$_GET['t_id'];

		$sql="DELETE FROM programcoordinator WHERE programcoordinator_id=$programcoordinator_id";
			if(mysqli_query($connectivity,$sql)){ 
				header('location:admin.php');
			}
			else{ 
				mysqli_error($connectivity); 
			}
	}
	elseif (isset($_GET['st_id'])) { 
		$applicant_id=$_GET['st_id'];
		
		$sql="DELETE FROM applicant WHERE applicant_id=$applicant_id";
			if(mysqli_query($connectivity,$sql)){ 
				header('location:index.php');
				session_destroy();
			}
			else{ 
				mysqli_error($connectivity); 
			}
	}
	elseif (isset($_GET['tt_id'])) { 
		$programcoordinator_id=$_GET['tt_id'];
		
		$sql="DELETE FROM programcoordinator WHERE programcoordinator_id=$programcoordinator_id";
			if(mysqli_query($connectivity,$sql)){ 
				header('location:index.php');
				session_destroy();
			}
			else{ 
				mysqli_error($connectivity); 
			}
	}
	else
	{ 
		echo mysqli_error($connectivity); 
	}
?>