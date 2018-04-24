<?php

define('PAGE_TITLE', 'Image Gallery');
$smallImageUrl = 'https://fakeimg.pl/300x200/282828/eae0d0/?retina=1';
$imageUrl = 'https://fakeimg.pl/300x200/282828/eae0d0/?retina=1';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo PAGE_TITLE ?></title>
        <link rel="stylesheet" href="pub/css/bootstrap.css">
        <link rel="stylesheet" href="pub/css/main.css">
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    </head>
    <body>
    <div class="album py-5 bg-light">
        <div class="container">
            <h1 class="h1 text-center">Image Gallery</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <a data-fancybox="gallery" href="<?php echo $imageUrl ?>">
                            <img class="card-img-top" alt="Image" src="<?php echo $smallImageUrl ?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>