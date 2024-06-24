<?php
	session_start(); // Start or resume a session to keep track of user data across requests, then include the database connection settings from another file
	
	require('connection_db.php'); 

	$name=$_POST["username"]; 
	$pass=$_POST["password"]; 
	$loginType=$_POST["login_type"]; 
	
	// Check if the login type is "admin", then proceed to check if the credentials match
	// If the login type is admin, further check the username and password
		// Redirect to a page specific to the login type (admin.php)
		// Otherwise, set an error message in the session
	// If the login type is 'applicant'
		// Fetch applicant details based on submitted email and password
			// Check if the query returned no results, indicating invalid credentials
			// Otherwise, when the valid credentials are provided, fetch the result set
				// Iterate through the result set to retrieve applicant details
			// Set session variables with the applicant's details
	// If the login type is 'programcoordinator'
		// Fetch programcoordinator details based on submitted email and password
			// Check if the query returned no results, indicating invalid credentials
			// Otherwise, when the valid credentials are provided, fetch the result set
				// Iterate through the result set to retrieve program coordinator details
			// Set session variables with the program coordinator's details	
	if ($loginType == "admin") { 
		if ($name == "admin" && $pass == "admin123") { 
			$_SESSION['user']=$name; 
			$_SESSION['pass']=$pass; 
			$_SESSION['login']=$loginType; 
			header('Location:'.$loginType.'.php'); 
			exit(); 
		}
		else { 
			$_SESSION['error']="Username or Password is wrong"; 
			header('Location:index.php'); 
			exit(); 
		}
	}
	elseif ($loginType == 'applicant') { 	 

		$data = "SELECT * FROM applicant WHERE email = '$name' and password = '$pass'"; 
		$result = mysqli_query($connectivity, $data); 

		if (mysqli_num_rows($result) == 0) { 
			$_SESSION['n_user']= "User not found"; 
			header('Location:index.php'); 
			exit(); 
		}
		
		else{ 
			while($row = mysqli_fetch_assoc($result)) { 
			    $applicant_id=$row["applicant_id"]; 
			    $Nam=$row["name"]; 
			    $Email=$row["email"]; 
			    $password=$row["password"]; 

		    }  
			
			$_SESSION['login']=$loginType; 
			$_SESSION['name']=$Nam;
			$_SESSION['email']=$Email;
			$_SESSION['pass']=$password;
			$_SESSION['applicant_id']=$applicant_id;
				
			header('Location:applicant.php'); 
			exit();
		}
	}

	elseif ($loginType == 'programcoordinator') { 	 

		$data = "SELECT * FROM programcoordinator WHERE email = '$name' and password = '$pass'"; 
		$result = mysqli_query($connectivity, $data); 

		if (mysqli_num_rows($result) == 0) { 
			$_SESSION['n_user']= "User not found"; 
		    header('Location:index.php'); 
			exit(); 
		}
		
		else{
			while($row = mysqli_fetch_assoc($result)) { 
			    $programcoordinator_id=$row["programcoordinator_id"]; 
			    $Nam=$row["name"]; 
			    $Email=$row["email"]; 
			    $password=$row["password"]; 
			}
		    
			$_SESSION['login']=$loginType;
			$_SESSION['name']=$Nam;
		    $_SESSION['email']=$Email;
			$_SESSION['pass']=$password;
		    $_SESSION['programcoordinator_id']=$programcoordinator_id;
				
			header('Location:programcoordinator.php'); 
		    exit(); 
		}
	}
?>