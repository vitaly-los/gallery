<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
        <link rel="stylesheet" href="pub/css/bootstrap.css">
        <link rel="stylesheet" href="pub/css/main.css">
        <link rel="shortcut icon" href="favicon.png" type="image/icon"> 
        <link rel="icon" href="favicon.png" type="image/icon">
    </head>
    <body>
        <div class="album py-5 bg-light">
            <div class="container">
                <h1 class="h1 text-center">Upload New Image</h1>
            <?php if(isset($_SESSION['error'])){
                    echo Message::outputErrorMessage($_SESSION['error']);
                }  
            ?>
                <form action="/upload" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="authorname">Author Name</label>
                        <input type="text" class="form-control" id="authorname" name="authorname" value="<?php // echo App::get('session')->getFieldValue('authorname') ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php // echo App::get('session')->getFieldValue('description') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Select Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-light" href="/">Back to Gallery</a>
                            <input type="submit" class="btn btn-dark" value="Upload Image" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>