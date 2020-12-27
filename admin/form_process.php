<?php
    
require_once "functions.php";

if (isset($_POST['submit'])) {

    $book_name = trim(htmlspecialchars($_POST['book_name']));
    $author_name = trim(htmlspecialchars($_POST['author_name']));
    $book_price = trim(htmlspecialchars($_POST['book_price']));
    $book_desc = trim(htmlspecialchars($_POST['book_desc']));
    $book_status = $_POST['status'];

    // dprint_r($_FILES['book_img']);

    $book_img = $_FILES['book_img']['name'];
    
    if ( empty( $book_name ) ) {
  
        header("Location: index.php?error=empty_name");
  
    } else {
 
        require_once "db.php";

        bs_upload_file('book_img');

        $sql = "INSERT INTO books (book_name, book_img,	author_name, book_price, book_desc, status) VALUES('$book_name', '$book_img', '$author_name', '$book_price', '$book_desc', '$book_status')";

        $inserted = mysqli_query( $conn, $sql );

        if ( ! $inserted ) {
            echo "Failed! Please try again later." . mysqli_errno( $conn );
        
        } else {
            header("Location: index.php?inserted=true");
        }
    }
    
} else {
    header("Location: index.php");
    exit;
}