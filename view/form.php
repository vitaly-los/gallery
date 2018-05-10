<?php
// Set title for page
$title = 'Upload file';
// Set variable to avoid Warning message
$author = '';
$description = '';
// Set empty array for errors
$errors = [];

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check data from users
    if (empty($_POST['author']))
        $errors[] = 'Please enter a author name.'; # for empty fields collect error's message in array
    elseif (stringLengh($_POST['author'], 40) == false)
        $errors[] = 'Please use between 1 and 40 characters for author name.'; # check for number of characters
    else
        $author = test_input($_POST['author']); # else asign for variable encoded string

    if (empty($_POST['description']))
        $errors[] = 'Please enter a description.';
    elseif (strlen($_POST['description'], 250) == false)
        $errors[] = 'Please use between 1 and 250 characters for description.';
    else
        $description = test_input($_POST['description']);


    if(empty($errors)){
        # No errors, process the data submitted from HTML form
    }
    else{
         echo '<div class="alert alert-danger">The following error(s) occurred:<br>';
        foreach ($errors as $error) {
            echo $error . '<br /> ';
        }
        echo '</div>';
    }
}
?>
<div class="container">
<form action="" method="POST" enctype="multipart/form-data">
    <fieldset class="form-group">
        <legend>Upload File</legend>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author">
        </div>
        <div  class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="files">Choose File To Upload</label>
            <input type="file" class="form-control-file" id="files" name="files">
        </div>
        <input type="submit" name="submit" value="Upload">
    </fieldset>
</form>
</div>
