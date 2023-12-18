<?php
require 'DateTime.php';
require 'BlogManager.php';

$id = $_GET['id'];

$post = BlogManager::get($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Clean Blog - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./assets/css/styles.css" rel="stylesheet" />
</head>
<body>
<?php include 'mainMenu.php' ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-7">
                <div class="post-heading">
                    <h1><?=$post['title']?></h1>
                    <span class="meta">
                        Posted by
                        <a href="#!"><?=$post['author']?></a>
                        on <?= DateHelper::toDate($post['date'], 'F d, Y')?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-7">
                <img src="./assets/upload/posts/<?=$post['imgUrl']?>" class="w-100 h-25 my-5" >
                <p><?= $post['content'] ?></p>
            </div>
        </div>
    </div>
</article>
<?php include 'footer.php' ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
