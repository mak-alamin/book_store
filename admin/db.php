<?php 
    $servername = 'localhost';
    $db_name = 'book_store';
    $username = 'root';
    $password = '';
    
    $conn = mysqli_connect($servername, $username, $password, $db_name);

    // Check connection
    if ( ! $conn ) {
        die("Database connection failed! " . mysqli_connect_error());
    }
?>
