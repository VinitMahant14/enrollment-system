<?php
	// Include the database connection settings from another file
	// Access all information on an applicant from the database
	require('connection_db.php'); 

	if (isset($_GET['s_id'])) { 
		$applicant_id = $_GET['s_id'];
		$sql = "SELECT * FROM applicant WHERE applicant_id=$applicant_id"; 
		$result = mysqli_query($connectivity, $sql);
		$row = mysqli_fetch_assoc($result);
?>
<style>
    body { /* Styles for Applicant Information */
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
    }
    .form-container {
        background-color: #fff;
        margin: 2rem auto;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 500px;
    }
    h2 {
        text-align: center;
        color: #333;
		margin-top: 40px;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-group input, .form-group select {
        width: 100%;
        padding: 10px;
        margin-top: 0.3rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
    }
    .form-action {
        text-align: center;
        margin-top: 1.5rem;
    }
    .form-action button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        font-size: 16px;
    }
    .form-action button:hover {
        background-color: #45a049;
    }
</style>
<h2>Applicant Information</h2>
<div class="form-container"> 
    <form action="insert_db.php" method="POST"> <!-- Form element specifying that the data should be posted to 'insert_db.php' when submitted -->
        <input type="hidden" name="s_id" value="<?=$applicant_id?>"> 
        <div class="form-group">
            <label>Name</label>
            <input required type="text" name="name" value="<?=$row['name'];?>" readonly>
        </div>
        <div class="form-group"> 
            <label>Email</label>
            <input required type="email" name="email" value="<?=$row['email'];?>" readonly>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input required type="password" name="password" value="<?=$row['password'];?>" readonly>
        </div>
        <div class="form-group">
            <label>Date of Birth</label>
            <input required type="date" name="dob" value="<?=$row['Date_of_birth'];?>" readonly>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <input required type="text" name="gender" value="<?=$row['gender'];?>" readonly>
        </div>
        <div class="form-group">
            <label>Photo</label>
            <input style="padding-left: 0px;" type="file" name="photo">
        </div>
        <div class="form-group">
            <label>Address</label>
            <input required type="text" name="address" value="<?=$row['address'];?>" readonly>
        </div>
        <div class="form-group">
            <label>Course</label>
            <input required type="text" name="course" value="<?=$row['course'];?>" readonly>
        </div>
        <div class="form-group">
            <label>Status</label>
            <input required type="text" name="status" value="<?=$row['status'];?>">
        </div>
        <div class="form-action">
            <button type="submit" name="submit">Declare Status</button>
        </div>
    </form>
</div>
<?php
}

elseif (isset($_GET['user'])) {
?>
<div class="form-container">
    <h2>Register Applicant</h2>
    <form action="update_by_admin.php" method="POST"> <!-- Form element specifying that the data should be posted to 'update_by_admin.php' when submitted -->
        <input type="hidden" name="c_type" value="applicant"> 
        <div class="form-group">
            <label>Full Name</label>
            <input required type="text" name="name" placeholder="Full Name">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input required type="email" name="email" placeholder="Email Address">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input required type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input required type="password" name="confirm_password" placeholder="Confirm Password">
        </div>
        <div class="form-group">
            <label>Date of Birth</label>
            <input required type="date" name="Date_of_birth">
        </div>
        <div class="form-group">
            <label>Gender</label>
            <input required type="text" name="gender" placeholder="Gender">
        </div>
        <div class="form-group">
            <label>Photo</label>
            <input style="padding-left: 0px;" type="file" name="photo">
        </div>
        <div class="form-group">
            <label>Address</label>
            <input required type="text" name="address" placeholder="Address">
        </div>
        <div class="form-group">
            <label>Course</label>
            <input required type="text" name="course" placeholder="Course">
        </div>
        <div class="form-group">
            <label>Status</label>
            <input required type="text" name="status" placeholder="Status">
        </div>
        <div class="form-action">
            <button type="submit" name="submit">Register</button>
        </div>
    </form>
</div>
<?php
}
?>