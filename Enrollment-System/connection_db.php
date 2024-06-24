<?php
    // Define variables for database connection credentials
    $username = 'root'; 
    $password = 'YAOshawjie122002@';
    $dbName = 'portal_college'; 
    $host = 'localhost'; 
    $port = 3307; 

    // Create a connection to the database using the mysqli_connect function
    // This function takes the host, username, password, database name, and port as parameters
    $connectivity = mysqli_connect($host, $username, $password, $dbName, $port);
?>