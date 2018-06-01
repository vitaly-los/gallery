<?php
$collection = getCollection();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo PAGE_TITLE ?></title>
    <link rel="stylesheet" href="pub/css/bootstrap.css">
    <link rel="stylesheet" href="pub/css/main.css">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
</head>
<body>
<div class="album py-5 bg-light">
    <div class="container">
        <ul class="nav justify-content-end">
            <?php if (isLoggedIn()): ?>
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
        <h1 class="h1 text-center"><?php echo PAGE_TITLE ?></h1>
        <?php if (isLoggedIn()) : ?>
            <a class="btn btn-dark btn-lg active m-md-2" href="/form">Upload New Image</a>
        <?php endif; ?>
        <?php if ($messages = getMessages()): ?>
            <div class="alert alert-success">
                <?php echo $messages ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php if (!empty($images = formatImages($collection))): ?>
                <?php foreach ($images as $image): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <a data-fancybox="gallery"
                               href="<?php echo $image['url'] ?>">
                                <img class="card-img-top" alt="Image" src="<?php echo $image['thumbnail'] ?>">
                            </a>
                            <div class="card-body">
                                <p class="card-text">Author: <?php echo $image['author'] ?>,
                                    Description: <?php echo $image['description'] ?>,
                                    Resolution: <?php echo implode('x', [$image['width'], $image['height']]) ?>
                                    Created at: <?php echo $image['created_at'] ?>
                                </p>
                            </div>
                            <?php if (isLoggedIn()): ?>
                                <button type="button" class="btn btn-danger btn-xs"
                                        onclick="if (confirm('Are you sure?')) {location.href = '/removeImage?path=<?php echo urlencode($image['url']) ?>';}">
                                    Delete
                                </button>
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
                    <?php echo renderPagination($collection) ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
</body>
</html>