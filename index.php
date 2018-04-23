<!DOCTYPE html>
<html>
    <head>
        <title>My Demo Gallery</title>
        <link rel="stylesheet" href="/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap-3.3.2/css/bootstrap.css">
        <link rel="stylesheet" href="./main.css">
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
        <link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="row">

                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/1.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/1.jpg' ?>" /> </a>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/2.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/2.jpg' ?>" /> </a>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/3.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/3.jpg' ?>" /> </a>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/4.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/4.jpg' ?>" /> </a>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/5.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/5.jpg' ?>" /> </a>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/6.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/6.jpg' ?>" /> </a>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/7.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/7.jpg' ?>" /> </a>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/8.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/8.jpg' ?>" /> </a>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo './img/9.jpg' ?>">
                        <img class="img-responsive" src="<?php echo './img/9.jpg' ?>" /> </a>
                </div>

            </div>
        </div>
        <script type="text/javascript"> $(document).ready(function () {
           $("a.fancyimage").fancybox();
       });</script>
    </body>

</html>
