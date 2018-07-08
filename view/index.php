<!DOCTYPE html>
<html>
    <head>
        <title>Photo Gallery</title>
        <link rel="stylesheet" href="pub/css/bootstrap.css">
        <link rel="stylesheet" href="pub/css/main.css">
        <link rel="shortcut icon" href="favicon.png" type="image/icon"> 
        <link rel="icon" href="favicon.png" type="image/icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="album py-5 bg-light">
            <div class="container">
                <ul class="nav justify-content-end">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Log out</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Registration</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <h1 class="h1 text-center">Photo Gallery</h1>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a class="btn btn-dark btn-lg active m-md-2" href="/form">Upload New Image</a>
                <?php endif; ?>
                <?php
                if (isset($_SESSION['success'])) {
                    echo Message::outputSuccessMessage($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <?php
                    $image = new Image();
                    if (!empty($images = $image->mainGallery())):
                        ?>
                        <?php foreach ($images as $image): ?>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <a data-fancybox="gallery"
                                       href="<?php echo $image['image_path']; ?>">
                                        <img class="card-img-top" alt="Image" src="<?php echo $image['thumbnail_path']; ?>">
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text">Author: <?php echo $image['author_name'] ?>,
                                            Description: <?php echo $image['description'] ?>,
                                            Owner: <?php echo $image['username'] ?>
                                            Created at: <?php echo $image['created_at'] ?>
                                        </p>
                                    </div>
                                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $image['user_id'])): ?>
                                        <a href="/delete?id=<?php echo $image['image_id']; ?>" "><button type="button" class="btn btn-danger btn-xs">delete</button></a>

                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-danger col-12">
                            There are no images yet :P
                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-flex p-2">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php //@todo pagination     ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </body>
</html>