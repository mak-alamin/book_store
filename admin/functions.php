<?php

/**
 * Update Data
 */
function sb_update_data( $conn, $id )
{
    if(isset($_POST['update'])){

        $book_name = trim(htmlspecialchars($_POST['book_name']));
        $author_name = trim(htmlspecialchars($_POST['author_name']));
        $book_img = trim(htmlspecialchars($_POST['book_img']));
        $book_price = trim(htmlspecialchars($_POST['book_price']));
        $book_desc = trim(htmlspecialchars($_POST['book_desc']));
        $book_status = $_POST['status'];
    
        // dprint_r($_FILES['book_img']);
    
        $book_img = ( ! empty($_FILES['book_img']['name'])) ? ($_FILES['book_img']['name']) : $book_img;
        
        if ( empty( $book_name ) ) {
      
            header("Location: edit.php?error=empty_name&action=edit&id=2");
      
        } else {
    
            if ( ! empty($_FILES['book_img']['name']) ) {
                bs_upload_file('book_img');
            }
            
    
            $sql = "UPDATE `books` 
                    
                    SET `book_name` = '$book_name', `book_img` = '$book_img', `author_name` = '$author_name', `book_price` = '$book_price', `book_desc` = '$book_desc', status = '$book_status'
                    
                    WHERE `books`.`id`='$id'";
    
            $updated = mysqli_query( $conn, $sql );
    
            // dprint_r($updated);

            if ( ! $updated ) {
                echo "Failed! Please try again later." . mysqli_errno( $conn );
            
            } else {
                header("Location: edit.php?action=edit&id=$id&updated=true");
            }
        }
    }
}



/**
 * File Upload
 */
function bs_upload_file( $input_name )
{
     $target_file = '../uploads/' . basename($_FILES[$input_name]['name']);

     $uploaded = move_uploaded_file( $_FILES[$input_name]['tmp_name'], $target_file );
    
     return $uploaded;
}

/**
 * Generate a Form for adding new book
 */
function add_new_book_form()
{
    $err_name = $err_author = $err_price = $err_desc = '';
   
    if ( isset( $_GET['error'] ) && $_GET['error'] == 'empty_name' ) {
        $err_name = "Please provide a name";
    }

    $form = '<form action="form_process.php" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="book_name">Book Name: </label>
            </div>
            <input type="text" name="book_name" class="form-control" placeholder="" id="book_name"> <span class="text-danger"> '. $err_name .'</span>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="book_img">Book Image: </label>
            </div>
            <input type="file" name="book_img" class="form-control" placeholder="" id="book_img">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="author_name">Author Name: </label>
            </div>
            <input type="text" name="author_name" class="form-control" placeholder="" id="author_name">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label for="book_price" class="input-group-text">Price: $</label>
            </div>
            <input type="number" name="book_price" id="book_price" class="form-control" >
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label for="book_desc" class="input-group-text">Description: </label>
            </div>
            <textarea name="book_desc" id="book_desc" class="form-control"></textarea>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label for="book_status" class="input-group-text">Status: </label>
            </div>
            <select name="status" id="book_status">
                <option value="1">Published</option>
                <option value="0">Unpublished</option>
            </select>
        </div>
        
        <div class="input-group">
            <input type="submit" name="submit" value="Add Book" class="btn btn-primary">
        </div>
    </form>';

    return $form;
}


/**
 * Modify die print_r
 */
function dprint_r($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}