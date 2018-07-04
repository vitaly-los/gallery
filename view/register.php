<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/pub/css/bootstrap.css">
    <link rel="stylesheet" href="/pub/css/main.css">
    <link rel="shortcut icon" href="favicon.png" type="image/icon"> 
    <link rel="icon" href="favicon.png" type="image/icon">
</head>
<body>
<div class="album py-5 bg-light">
    <div class="container">
        <h1 class="h1 text-center">Create an account</h1>
                
                <?php if(isset($_SESSION['error'])){
                    echo Message::outputErrorMessage($_SESSION['error']);
                }  ?>


        <form action="userRegister" method="post">
            <div class="form-group">
                <label for="login">Enter Login</label>
                <input type="text" class="form-control" id="login" name="login" value="">
            </div>
            <div class="form-group">
                <label for="pass">Enter Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <div class="form-group">
                <label for="repass">Re-enter password</label>
                <input type="password" class="form-control" id="repass" name="repass">
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <a class="btn btn-light" href="/">Back to Gallery</a>
                    <input type="submit" class="btn btn-dark" value="Register" name="submit">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>