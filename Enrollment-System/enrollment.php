<!DOCTYPE html>
<html>
<head>
    <title>Applicant Requirements Form</title>
	<style>
        body { /* Styles for Applicant Requirements Form */
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h2 {
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
        fieldset {
            border: 2px solid #ddd;
            border-radius: 5px;
        }
        legend {
            background-color: #9e031d;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin: 6px 0 16px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; 
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .note {
            font-style: italic;
            color: #555;
        }
    </style>
</head>
<body>
    <h2>Applicant Requirements Submission Form</h2>
    <form action="submit_application.php" method="post" enctype="multipart/form-data"> <!-- Form for application submission, data sent to 'submit_application.php' via POST, supporting file uploads -->
        <fieldset>
            <legend><b>Personal Information:</b></legend>
            Name: <input type="text" name="name" required><br><br>  
            Email: <input type="email" name="email" required><br><br> 
        </fieldset>
		<br>
        <fieldset>
            <legend><b>Academic Records:</b></legend>
            Compilation of High School Grades (in PDF): <input type="file" name="grades" accept=".pdf" required><br><br> <!-- File input for uploading grades, restricted to PDF format, marked as required -->
        </fieldset>
		<br>
        <fieldset>
            <legend><b>UPCAT Scores:</b></legend> <!-- Numeric input for scores, with defined min and max values, required -->
            Language Proficiency: <input type="number" name="language_score" min="0" max="200" required><br><br>  
            Science: <input type="number" name="science_score" min="0" max="200" required><br><br> 
            Mathematics: <input type="number" name="math_score" min="0" max="200" required><br><br> 
            Reading Comprehension: <input type="number" name="reading_score" min="0" max="200" required><br><br> 
        </fieldset>
		<br>
        <fieldset>
            <legend><b>Program-Specific Requirements:</b></legend>
            Choose Program: 
            <select name="chosen_program" required>  <!-- Dropdown Menu for selecting a program -->
                <option value="">--SELECT--</option>
				<option value="Computer Science">Computer Science</option>
                <option value="Psychology">Psychology</option>
                <option value="Accountancy">Accountancy</option>
				<option value="Biology">Biology</option>
				<option value="Management">Management</option>
				<option value="Mathematics">Mathematics</option>
				<option value="Communication Arts">Communication Arts</option>
				<option value="Economics">Economics</option>
				<option value="Political Science">Political Science</option>
            </select><br><br>
            Program-Specific Requirement (in PDF): <input type="file" name="program_requirement" accept=".pdf" required><br> <!-- File input for uploading program-specific documents, restricted to PDF format, required -->
			Note: <i>This portion is dedicated to the submission of <b>additional requirements shown previously on your Applicant Portal that your chosen course may require,</b> besides what was asked for above.
			If you do <b>NOT</b> know what these requirements are yet or if anything seems unclear, proceed to contact the <b>University</b> directly for further inquiry.<i>
			<br><br>
        </fieldset>
		<br>
        <input type="submit" value="Submit Application" style="font-size: 16px;"> 
    </form>
</body>
</html>