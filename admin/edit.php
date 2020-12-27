<?php
/**
 * ---------------------------------------------------------
 * Edit and Delete Books
 * ---------------------------------------------------------
 */
require_once '../common.php';
require_once 'functions.php';
require_once "db.php";
require_once 'admin-header.php';

$id = (isset($_GET['id'])) ? $_GET['id'] : 0;

if( isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])){
    sb_update_data( $conn, $id );
    $sql = "SELECT book_name, book_img,	author_name, book_price, book_desc, status FROM books WHERE id='$id'";
    
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");

}

// dprint_r($result);

$book_name = ( ! empty($result['book_name'])) ? $result['book_name'] : '';
$book_img = ( ! empty($result['book_img'])) ? $result['book_img'] : '';
$author_name = ( ! empty($result['author_name'])) ? $result['author_name'] : '';
$book_price = ( !empty($result['book_price'])) ? $result['book_price'] : '';
$book_desc = ( !empty($result['book_desc'])) ? $result['book_desc'] : '';
$book_status = ( !empty($result['status'])) ? $result['status'] : '';

?>
<div class="row">
    <div class="col-md-3">
        <div class="left-menu">
            <h1 class="dashboard-title">Book Store</h1>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">All Books</a>
                
                <a class="nav-link" id="v-pills-new-book-tab" data-toggle="pill" href="#v-pills-new-book" role="tab" aria-controls="v-pills-new-book" aria-selected="true">Add New Book</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                
                <a class="nav-link" href="<?php echo SITE_URL; ?>" target="_blank">Visit Store</a>
            </div>
        </div>
    </div>  

    <div class="col-md-9">
        <?php require_once "alerts.php"; ?>

        <div class="tab-content" id="v-pills-tabContent">
            <form action="" method="post" enctype="multipart/form-data" class="tab-pane fade show active">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="book_name">Book Name: </label>
                    </div>
                    <input type="text" name="book_name" value="<?php echo $book_name; ?>" class="form-control" placeholder="" id="book_name"> <span class="text-danger"></span>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="book_img">Book Image: </label>
                    </div>
                    <input type="file" name="book_img" class="form-control" placeholder="" id="book_img" onchange="preview_image(event)">
                    
                    <img src="<?php echo ASSET_URL . $book_img; ?>" id="show_book_img" width="300" alt="">
                    
                    <input type="hidden" name="book_img" value="<?php echo $book_img; ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="author_name">Author Name: </label>
                    </div>
                    <input type="text" name="author_name" value="<?php echo $author_name; ?>" class="form-control" placeholder="" id="author_name">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="book_price" class="input-group-text">Price: $</label>
                    </div>
                    <input type="number" name="book_price" value="<?php echo $book_price; ?>" id="book_price" class="form-control" >
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="book_desc" class="input-group-text">Description: </label>
                    </div>
                    <textarea name="book_desc" id="book_desc" class="form-control"><?php echo $book_desc; ?></textarea>
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
                    <input type="submit" name="update" value="Update Book" class="btn btn-primary">
                </div>
            </form>
           
            <div class="tab-pane fade show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <h2 class="text-info mb-5 mt-3">All Books</h2>
                <?php require_once "all_books.php"; ?>
            </div>
               
                <div class="tab-pane fade show" id="v-pills-new-book" role="tabpanel" aria-labelledby="v-pills-new-book-tab">
                    <h2 class="text-info mb-5 mt-3">Add New Book</h2>

                    <?php echo add_new_book_form(); ?>

                </div>
              
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">Profile Content</div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">Message Content</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">Settings Content</div>
            </div>
    </div>
</div>

<script>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('show_book_img');
            output.src = reader.result;
        }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
<?php
    require_once '../footer.php';
?>