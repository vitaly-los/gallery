<?php
define('TITLE', 'My Demo Gallery'); // Add default title to index page

/*
Asign images path to variable.

*/
$img1 = './img/1.jpg';
$img2 = './img/2.jpg';
$img3 = './img/3.jpg';
$img4 = './img/4.jpg';
$img5 = './img/5.jpg';
$img6 = './img/6.jpg';
$img7 = './img/7.jpg';
$img8 = './img/8.jpg';
$img9 = './img/9.jpg';
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

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img1; ?>">
                        <img class="img-responsive" src="<?php echo $img1 ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img2 ?>">
                        <img class="img-responsive" src="<?php echo $img2 ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img3 ?>">
                        <img class="img-responsive" src="<?php echo $img3 ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img4 ?>">
                        <img class="img-responsive" src="<?php echo $img4 ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img5 ?>">
                        <img class="img-responsive" src="<?php echo $img5 ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img6 ?>">
                        <img class="img-responsive" src="<?php echo $img6 ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img7 ?>">
                        <img class="img-responsive" src="<?php echo $img7 ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img8 ?>">
                        <img class="img-responsive" src="<?php echo $img8 ?>" /> </a>
                </div>
                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo $img9 ?>">
                        <img class="img-responsive" src="<?php echo $img9 ?>" /> </a>
                </div>

            </div>
        </div>
        <script type="text/javascript"> $(document).ready(function () {
           $("a.fancyimage").fancybox();
       });</script>
    </body>

</html>
