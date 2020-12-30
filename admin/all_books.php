<?php
    require_once "db.php";

    if ( isset($_GET['action']) && $_GET['action'] == 'delete' && isset( $_GET['id'] )){

      $id = $_GET['id'];
      $delete_sql = "DELETE FROM books WHERE id={$id}";

      $deleted = mysqli_query($conn, $delete_sql);

      if ( ! $deleted ) {
        echo "Failed! Please try again later." . mysqli_errno( $conn );
    
    } else {
        header("Location: index.php?deleted=true");
    }


    }

    $sql = "SELECT id, book_name, book_img,	author_name, book_price, book_desc, status FROM books";
  
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);


?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Book Name</th>
      <th scope="col">Author Name</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php if( $rows > 0 ){ while ( $book = mysqli_fetch_assoc( $result ) ) { 

      // dprint_r($book);

    ?>

      
        <tr>
          <th scope="row"><img src="../uploads/<?php echo $book['book_img']; ?>" alt="" width="80"></th>
          <td><?php echo $book['book_name']; ?></td>
          <td><?php echo $book['author_name']; ?></td>
          <td><?php echo $book['book_price']; ?></td>
          <td><?php echo $book['book_desc']; ?></td>
          <td><?php echo ($book['status']) ? 'Published': 'Unpublished'; ?></td>
          
          <td> 
            
            <a href="edit.php?action=edit&id=<?php echo $book['id']; ?>" class="action btn btn-info">Edit</a>

            <a href="index.php?action=delete&id=<?php echo $book['id']; ?>" class="action btn btn-danger delete">Delete</a>
       
          </td>
        </tr>

    <?php } } ?>
  
</tbody>
</table>

<script>
  var delete_btns = document.querySelectorAll('.btn.delete');

  delete_btns.forEach(function(delete_btn , i){
    delete_btn.addEventListener("click", function(e){
      
      if( ! confirm("Are you sure?")){
        e.preventDefault();
      }
    })
  });
</script>