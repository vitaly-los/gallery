<?php
include_once 'imagespath.php';

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
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img1) && !empty($img1)) echo $img1; ?>">
                        <img class="img-responsive" src="<?php if(isset($img1) && !empty($img1)) echo $img1; ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img2) && !empty($img2)) echo $img2; ?>">
                        <img class="img-responsive" src="<?php if(isset($img2) && !empty($img2)) echo $img2; ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img3) && !empty($img3)) echo $img3; ?>">
                        <img class="img-responsive" src="<?php if(isset($img3) && !empty($img3)) echo $img3; ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img4) && !empty($img4)) echo $img4; ?>">
                        <img class="img-responsive" src="<?php if(isset($img4) && !empty($img4)) echo $img4; ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img5) && !empty($img5)) echo $img5; ?>">
                        <img class="img-responsive" src="<?php if(isset($img5) && !empty($img5)) echo $img5; ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img6) && !empty($img6)) echo $img6; ?>">
                        <img class="img-responsive" src="<?php if(isset($img6) && !empty($img6)) echo $img6; ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img7) && !empty($img7)) echo $img7; ?>">
                        <img class="img-responsive" src="<?php if(isset($img7) && !empty($img7)) echo $img7; ?>" /> </a>
                </div>

                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img8) && !empty($img8)) echo $img8; ?>">
                        <img class="img-responsive" src="<?php if(isset($img8) && !empty($img8)) echo $img8; ?>" /> </a>
                </div>
                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php if(isset($img9) && !empty($img9)) echo $img9; ?>">
                        <img class="img-responsive" src="<?php if(isset($img9) && !empty($img9)) echo $img9; ?>" /> </a>
                </div>

            </div>
        </div>
        <script type="text/javascript"> $(document).ready(function () {
           $("a.fancyimage").fancybox();
       });</script>
    </body>

</html>
