<!DOCTYPE html>
<html>
    <head>
        <title>My Demo Gallery</title>
        <link rel="stylesheet" href="/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="/fancybox/jquery.easing-1.3.pack.js"></script>
        <script type="text/javascript" src="/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <link rel="stylesheet" href="/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
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
