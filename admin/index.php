<?php
    require_once "../common.php";
    require_once "functions.php";
    require_once "admin-header.php";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="left-menu">
                <h1 class="dashboard-title">Book Store</h1>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">All Books</a>
                  
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
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
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
</div>
<?php

require_once "admin-footer.php";
