<?php
    require_once "common.php";
    require_once "header.php";

    require_once "admin/db.php";

    $sql = "SELECT book_name, book_img,	author_name, book_price, book_desc FROM books WHERE status = 1";
  
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);

?>

<div class="container">
    <h1 class="text-primary text-center mb-4 mt-4">Book Store</h1>
   
    <a href="<?php echo ADMIN_URL; ?>" class="btn btn-secondary mb-4">Go to Dashboard</a>

    <div class="row">
      
        <?php if( $rows > 0 ){ while ( $book = mysqli_fetch_assoc( $result ) ) { ?>
        
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="uploads/<?php echo $book['book_img']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $book['book_name']; ?></h5>
                        <p class="card-text"><?php echo $book['book_desc']; ?></p>
                        <p><b>Author: </b> <?php echo $book['author_name']; ?></p>
                        <p><b>Price: $<?php echo $book['book_price']; ?></b></p>
                        <a href="" class="btn btn-info">Buy Now</a>
                    </div>
                </div>
            </div>
       
        <?php } } ?>
        
    </div>

</div>
<?php
    require_once "footer.php";

