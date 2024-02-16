<?php
session_start();
// error_reporting(0);
require_once('./config.php');
if(isset($_POST['login']))
{
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select = "SELECT *FROM user_data WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $select);

    while($row = mysqli_fetch_array($result))
    {
        $username1 = $row['username'];
        $password1 = $row['password'];
    }
    if($username == $username1 && $password == $password1)
    {
        
        $_SESSION['username'] = $_POST['username'];
        echo '<script>window.location.replace("./home.php");</script>';
    }
    else
    {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>

    <section class="login-section my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>User Login</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="my-2 form-group">
                                        <label for="username">User Name</label>
                                        <input type="text" name="username" class="form-control" id="username">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="my-2 form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                    </div>
                                </div>
                                <div class="col-lg-12 my-3">
                                    <input type="submit" name="login" class="btn btn-primary" id="login" value="Login">
                                </div>
                                </div>
                        </div>
                        <p>NEw User ? <a href="./register.php">Register Here..</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>