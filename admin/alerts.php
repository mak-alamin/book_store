<?php

if(isset($_GET['inserted']) && $_GET['inserted'] == "true"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Book added successfully!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}

if(isset($_GET['updated']) && $_GET['updated'] == "true"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Book updated successfully!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}