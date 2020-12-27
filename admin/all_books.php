<?php
    require_once "db.php";

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

            <a href="edit.php?action=delete&id=<?php echo $book['id']; ?>" class="action btn btn-danger">Delete</a>
       
          </td>
        </tr>

    <?php } } ?>
  
</tbody>
</table>