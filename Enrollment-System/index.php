<?php
    // Start or resume a session to manage user state accross different pages.
    // Check if the login variable is set, to redirect the user to a page named after the value of $_SESSION['login'] with a .php extension
	// Otherwise, refresh page or check for errors.
	// Also, include a condition to show a temporary alert message, if the user is new to the system.
    session_start();

    if (isset($_SESSION['login'])) {
        header('Location:'.$_SESSION['login'].".php");
    }
 
    elseif (isset($_SESSION['message'])) {
        echo '<script type="text/javascript">alert("'.$_SESSION['message'].'");</script>';
        header('Refresh:0');
        session_destroy();
    }
   
    elseif (isset($_SESSION['error'])) {
        echo '<script type="text/javascript">alert("'.$_SESSION['error'].'");</script>';
        header('Refresh:0');
        session_destroy();
    }
   
    elseif (isset($_SESSION['n_user'])) {
        echo '<script type="text/javascript">alert("'.$_SESSION['n_user'].'");</script>';
        header('Refresh:0');
        session_destroy();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>UP Online Application</title>
	<style type="text/css">
		/* Styles for the entire body of the webpage */
		body{ 
			background: #f1f1f1; 
		}
		
		.input{
			width: 373px;
			margin-top: 10px;
			height: 30px; 
			padding-left: 15px;
			font-size: 18px;
		}
		
		.flex{
			display: inline-flex;
		}
	</style>

</head>

<body>
	<form style="background-color: #96261e; height: 100px; padding-top: 10px; overflow: hidden;" action="login_check.php" method="POST">
    
		<div style="padding: 10px; width: 450px; display: inline-flex;">
			<img style="height: 65px; display: inline-flex;" src="UP-System-UP-Cebu-Logo.png" alt="UP Logo">
			<b style="font-family: cursive; font-size: 29px; color: #ed854d; margin-left: 20px;">UP Admissions Portal</b>
		</div>
		
		<div align="right" style="margin-left: 450px; display: inline; overflow: hidden;">
			<select style="margin: 5px;" name="login_type">
				<option value="">--SELECT--</option>
				<option value="admin">Admin</option>
				<option value="programcoordinator">Program Coordinator</option>
				<option value="applicant">Applicant</option>
			</select>

			<div class="flex">
				<div><input style="width: 180px; margin: 5px;" type="text" name="username" placeholder="username/email" required></div>
				<div><input style="width: 130px; margin: 5px;" type="password" name="password" placeholder="password" required></div>
			</div>
			<input style="margin: 5px;" type="submit" name="login" value="Login">
		</div>
	</form>
	
	<script> //Javascript Functions: Toggle the visibility of a program coordinator and an applicant
		function programcoordinator() {
			var x = document.getElementById('programcoordinator');
			
			if (x.style.display == 'block') {
				x.style.display = 'none';
			} 
			else {
				x.style.display = 'block';
			}
		}

		function applicant() {
			var x = document.getElementById('applicant');

			if (x.style.display == 'block') {
				x.style.display = 'none';
			} 
			else {
				x.style.display = 'block';
			}
		}
	</script>

	<div style="background-color: #d8dedc;">
		<form action="insert_db.php" method="POST">
			<div style="margin: 0 auto; padding: 25px; padding-top: 10px; padding-bottom: 5px; width: 400px;">
				<b style="font-size: 30px; font-style: bold; font-family: all;">Create Account</b><br>	<!-- Create Account Form (starts here) -->	
				<div style="width: 470px;">
					<div class="flex"><input class="input" type="text" name="name" placeholder="Full Name" required></div><br>

					<div class="flex"><input class="input" type="email" name="email" placeholder="Email Address" required></div><br>

					<div class="flex" style="width: 208px;"> <input style="width: 160px;" class="input" type="password" name="password" placeholder="New Password" required></div>

					<div class="flex"><input style="width: 160px;" class="input" type="password" name="confirm_password" placeholder="Confirm Password" required></div><br>

					<div class="flex" style="width: 168px; margin-top: 30px;"> <b>Date of Birth:</b></div>
					<div class="flex"><input style="width: 200px;" class="input" type="Date" name="Date_of_birth" placeholder="DD/MM/YY" required></div><br>

					<div class="flex" style="width: 200px; margin-top: 25px;"> <b>Gender:</b></div>
					<div class="flex" style="margin-top: 5px; margin-left: 35px;">  <!-- Radio buttons to declare the Gender of the User. -->
						<input type="radio" name="gender" value="Male" required>Male 
						<input type="radio" name="gender" value="Female">Female
					</div><br>

					<div class="flex"><input class="input" type="text" name="address" placeholder="Residential Address" required></div><br>

					<div class="flex" style="width: 148px;"> Upload Profile Photo:</div>
					<div class="flex"><input class="input" style="height: 35px; width: 258px; padding-left: 0px;" type="file" name="photo" required></div><br>
					<!-- File input field for uploading a profile photo, styled with specific dimensions and marked as required -->

					<div class="flex" style="width: 165px; margin-top: 30px;"> <b>Select your Position :</b></div>
					<div class="flex">
						<div style=" margin-top: 5px;">
							<select required style="margin: 5px; width: 225px; height: 45px; background-color: #d4e1cc; font-weight: bold;" class="input"" name="c_type"> <!-- Dropdown Menu for Selecting Position of the User -->
							    <option value="">--SELECT--</option>
								<option type="button" onclick="programcoordinator()" value="programcoordinator">Program Coordinator</option>
								<option type="button" onclick="applicant()" value="applicant">Applicant</option>
							</select>
						</div>
					</div>
					
					<div id="programcoordinator" hidden style="margin-left: 430px; padding: 25px; margin-top: -40px; margin-bottom: -15px;">

						<div class="flex"><input class="input" type="text" name="program" placeholder="Your working program"></div><br>
				
					</div>

					<div id="Applicant" hidden style="margin-left: 430px; padding: 25px; margin-top: -40px; margin-bottom: -15px;">

						<div class="flex"><input class="input" type="text" name="course" placeholder="Course name"></div><br>

					</div>
					
					<div class="flex"><input class="input" style="height: 45px; width: 150px; margin-top: 5px; border-radius: 5px; background-color: #4CAF50; font-weight: bold; color: white; margin-bottom: 10px;" type="reset" value="Reset"></div> <!-- Removes all inputted data from the form -->

					<div class="flex"><input class="input" style="width: 170px; height: 45px; margin-top: 5px; margin-left: 73px; border-radius: 5px; background-color: #4CAF50; font-weight: bold; color: white;" type="submit" value="Register"></div> <!-- Confirms the Creation of an Account for the User -->
				</div>
			</div>
		</form>
	</div>

	<footer style="background-color: gray; height: 65px;"> <!-- References to Homepage Design-->
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