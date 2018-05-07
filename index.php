<?php
include_once './imagespath.php';
// Set number of images on page
$imagesOnPage = 9;

?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?></title>
        <link rel="stylesheet" href="/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
        <link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="row">

                <?php
                // Use foreach to make a path for original images from picsum.photos
                foreach ($json as $key => $value) {

                    if ($value['id'] < $imagesOnPage) {
                        ?>
                        <div class="col-sm-4 thumb">
                            <a class="fancyimage" data-fancybox-group="group" href="<?php echo 'https://picsum.photos/' . $value['width'] . '/' . $value['height'] . '?image=' . $value['id']; ?>">
                                <img class="img-responsive" src="<?php echo 'https://picsum.photos/' . $value['width'] . '/' . $value['height'] . '?image=' . $value['id']; ?>" /> </a>
                        </div>
                    <?php } // Close If statement
                }  // Close foreach loop
                ?>
            </div>
        </div>
        <script type="text/javascript"> $(document).ready(function () {
                $("a.fancyimage").fancybox();
            });</script>
    </body>

</html>
