<?php
	// Start or resume a session to manage user state across different pages
	// Database Credentials
	//Inform user of error in connecting to the database
	
	session_start(); 

	$username = 'root'; 
	$password = 'YAOshawjie122002@'; 
	$dbName = 'portal_college'; 
	$host = 'localhost'; 
	$port = 3307; 

	$connectivity = mysqli_connect($host, $username, $password, $dbName, $port);

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	// Check if action is set
	$action = $_REQUEST['action'] ?? ''; 

	// Function definitions using mysqli (CRUD)
	function addProgramRequirement($connectivity, $program, $requirements) {
		$stmt = mysqli_prepare($connectivity, "INSERT INTO programs (program, program_requirements) VALUES (?, ?)");
		mysqli_stmt_bind_param($stmt, 'ss', $program, $requirements);
		mysqli_stmt_execute($stmt);
		return mysqli_stmt_insert_id($stmt);
	}

	function updateProgramRequirement($connectivity, $program_id, $requirements) {
		$stmt = mysqli_prepare($connectivity, "UPDATE programs SET program_requirements = ? WHERE program_id = ?");
		mysqli_stmt_bind_param($stmt, 'si', $requirements, $program_id);
		mysqli_stmt_execute($stmt);
	}

	function getProgramRequirement($connectivity, $program_id) {
		$stmt = mysqli_prepare($connectivity, "SELECT * FROM programs WHERE program_id = ?");
		mysqli_stmt_bind_param($stmt, 'i', $program_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		return mysqli_fetch_assoc($result);
	}

	function deleteProgramRequirement($connectivity, $program_id) {
		$stmt = mysqli_prepare($connectivity, "DELETE FROM programs WHERE program_id = ?");
		mysqli_stmt_bind_param($stmt, 'i', $program_id);
		mysqli_stmt_execute($stmt);
	}

	// Switch case to handle the action (CUD)
	switch ($action) {
		case 'add':
			$program = $_POST['program'] ?? '';
			$requirements = $_POST['requirements'] ?? '';
			$lastId = addProgramRequirement($connectivity, $program, $requirements);
			$_SESSION['message'] = "Program requirement added successfully with Program ID $lastId.";
			break;

		case 'update':
			$program_id = $_POST['program_id'] ?? 0;
			$requirements = $_POST['requirements'] ?? '';
			updateProgramRequirement($connectivity, $program_id, $requirements);
			$_SESSION['message'] = "Program requirement updated successfully.";
			break;

		case 'delete':
			$program_id = $_POST['program_id'] ?? 0;
			deleteProgramRequirement($connectivity, $program_id);
			$_SESSION['message'] = "Program requirement deleted successfully.";
			break;

		default:
			// Redirect to a default page or show a message
			break;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Program Requirements Form</title>
    <script>
        function showForm(formId) {
            // Hide all forms
            document.getElementById('addForm').style.display = 'none';
            document.getElementById('updateForm').style.display = 'none';
            document.getElementById('deleteForm').style.display = 'none';

            // Show the selected form
            if (formId) {
                document.getElementById(formId).style.display = 'block';
            }
        }
    </script>
	<style>
        body { /* Styles for the entire body of the webpage */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 { 
            color: #333;
        }
        form { 
            margin-bottom: 20px;
        }
        input[type="text"] { 
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
		
		input[type="number"] { 
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
		
        button { 
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { 
            background-color: #45a049;
        }
        table { 
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td { 
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th { 
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) { 
            background-color: #f9f9f9;
        }
        tr:hover { 
            background-color: #e2e2e2;
        }
        a { 
            color: #007bff;
            text-decoration: none;
        }
        a:hover { 
            text-decoration: underline;
        }
		
		select, textarea {
			padding: 10px;
			margin-bottom: 10px; 
			border: 1px solid #ccc;
			border-radius: 4px;
			background-color: white;
			font-family: Arial, sans-serif; 
		}

		select:focus, textarea:focus {
			border-color: #4CAF50; 
			outline: none; 
		}

		textarea {
			width: calc(100% - 22px); 
			resize: vertical; 
		}
    </style>
</head>
<body>
	<h1>Program Requirements</h1>
	<form method="get" action="program_reqAD.php"> <!-- Form element with GET method to submit data; data is sent to 'program_reqAD.php' -->
		<input type="hidden" name="action" value="search">
		<input type="text" id="search_program" name="search_program" placeholder="Search by program...">
		<button type="submit">Search</button> 
	</form>
	<br>
	
	<table border="1">
		<thead>
			<tr>
				<th>Program ID</th>
				<th>Program</th>
				<th>Program Requirement/s</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Search functionality, retrieves the 'search_program' from GET request or default to empty string
			// Select all columns from the 'programs' table where 'program' column matches the search pattern
				// Create a search pattern for a SQL LIKE query, then bind the search pattern parameter to the prepared statement
				// Retrieve the result set from the statement execution
				
				// Iterate over each row in the result set
					// Output table rows with the program data
			// Inform user when search query failed
			$search_program = $_GET['search_program'] ?? ''; 
			$query = "SELECT * FROM programs WHERE program LIKE ?"; 
			if ($stmt = mysqli_prepare($connectivity, $query)) { 
				$like_search_program = '%' . $search_program . '%'; 
				mysqli_stmt_bind_param($stmt, 's', $like_search_program); 
				mysqli_stmt_execute($stmt); 
				$result = mysqli_stmt_get_result($stmt); 
				
				while ($row = mysqli_fetch_assoc($result)) { 
					echo "<tr>";
					echo "<td>".$row['program_id']."</td>";
					echo "<td>".$row['program']."</td>";
					echo "<td>".$row['program_requirements']."</td>";
					echo "</tr>";
				}
				mysqli_free_result($result);
			} else { 
				echo "<tr><td colspan='3'>No program requirements found or search query failed.</td></tr>";
			}
			
			?>
		</tbody>
	</table>

	<h2>Program Requirements Management</h2>
	<!-- Dropdown for selecting an action -->
	<label for="actionSelect">Select an Option:</label>
	<select name="action" id="actionSelect" onchange="showForm(this.value)">
		<option value="">--SELECT--</option>
		<option value="addForm">Add</option>
		<option value="updateForm">Update</option>
		<option value="deleteForm">Delete</option>
	</select>
	<br><br>
	<!-- Add Program Requirement Form -->
	<div id="addForm" style="display:none;">
		
		<form method="post" action="program_reqAD.php">
			<input type="hidden" name="action" value="add">
			<label for="program">Program Name:</label>
			<input type="text" id="program" name="program" required placeholder="e.g. Economics"><br><br>
			<label for="requirements">Requirement/s:</label>
			<textarea id="requirements" name="requirements" required rows="4" cols="50" placeholder="e.g. Good Moral Character"></textarea><br><br>
			<button type="submit">Add Requirement</button>
		</form>
	</div>

	<!-- Update Program Requirement Form -->
	<div id="updateForm" style="display:none;">
		
		<form method="post" action="program_reqAD.php">
			<input type="hidden" name="action" value="update">
			<label for="program_id_update">Program ID:</label>
			<input type="number" id="program_id_update" name="program_id" required placeholder="0"><br><br>
			<label for="requirements_update">New Requirement/s:</label>
			<textarea id="requirements_update" name="requirements" required rows="4" cols="50" placeholder="e.g. Good Moral Character"></textarea><br><br>
			<button type="submit">Update Requirement</button>
		</form>
	</div>

	<!-- Delete Program Requirement Form -->
	<div id="deleteForm" style="display:none;">
		
		<form method="post" action="program_reqAD.php">
			<input type="hidden" name="action" value="delete">
			<label for="program_id_delete">Program ID:</label>
			<input type="number" id="program_id_delete" name="program_id" required placeholder="0"><br><br>
			<button type="submit">Delete Requirement</button>
		</form>
	</div>

	<br><br>
	<?php if (isset($_SESSION['message'])): ?>
		<!-- Statement to check if there is a 'message' in the session data -->
		<div><?php echo $_SESSION['message']; ?></div> 
		<?php unset($_SESSION['message']); ?> 
	<?php endif; ?>

	<a href="admin.php">Go Back to ADMIN</a>
	<!-- Provide a link to go back to the ADMIN Pannael through 'admin.php'.-->
</body>
</html>