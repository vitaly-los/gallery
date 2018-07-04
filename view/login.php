<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="pub/css/bootstrap.css">
    <link rel="stylesheet" href="pub/css/main.css">
    <link rel="shortcut icon" href="favicon.png" type="image/icon"> 
    <link rel="icon" href="favicon.png" type="image/icon">
</head>
<body>
<div class="album py-5 bg-light">
    <div class="container">
        <h1 class="h1 text-center">Login as user</h1>
        <?php   
                if(isset($_SESSION['error'])){
                    echo Message::outputErrorMessage($_SESSION['error']);
                }  
                if(isset($_SESSION['success'])){
                    echo Message::outputSussessMessage($_SESSION['success']);
                } 
        ?>
        <form action="/userLogin" method="post">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" name="login" value="<?php echo $_SESSION['username'] ?? '';?>">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <a class="btn btn-light" href="/">Back to Gallery</a>
                    <input type="submit" class="btn btn-dark" value="Login" name="submit">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>