<?php
	// Start the session, then include your database connection
	// Fetch all applicants from the database
		// Add WHERE clause to filter the results by the search term
	session_start();
	require('connection_db.php');
	$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($connectivity, $_GET['search']) : '';
	$query = "SELECT * FROM applicant_info";
	
	if (!empty($searchTerm)) {
		$query .= " WHERE name LIKE '%$searchTerm%'";
	}
	$result = mysqli_query($connectivity, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Applicant Requirements</title>
    <style>
        body { /* Styles for Viewing the Submitted Requirements by the Applicant */
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
    </style>
</head>
<body>
    <h2>Applicant Submissions</h2> <!-- View the Submissions made by an Applicant as a Program Coordinator -->
	<form action="" method="GET"> <!-- Form for performing a search using the GET method. The action is empty, meaning the form submits to the current page. -->
        <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($searchTerm) ?>">
        <button type="submit">Search</button> 
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Program</th>
            <th>Language Score</th>
            <th>Science Score</th>
            <th>Math Score</th>
            <th>Reading Score</th>
            <th>High School Grades</th>
            <th>Program Requirement</th>
			
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?> <!-- Loop through each record in the result set using a PHP while loop. -->
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['chosen_program']) ?></td>
                <td><?= htmlspecialchars($row['language_score']) ?></td>
                <td><?= htmlspecialchars($row['science_score']) ?></td>
                <td><?= htmlspecialchars($row['math_score']) ?></td>
                <td><?= htmlspecialchars($row['reading_score']) ?></td>
                <td><a href="<?= htmlspecialchars($row['grades_path']) ?>" target="_blank">View Grades</a></td> <!-- Link to view the grades, with path escaped for security. -->
                <td><a href="<?= htmlspecialchars($row['program_requirement_path']) ?>" target="_blank">View Document</a></td> <!-- Link to view program-specific documents. -->
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
