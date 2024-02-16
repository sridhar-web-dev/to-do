<?php
session_start();
// error_reporting(0);
require_once('./config.php');

$user_id = $_SESSION['username'];
if(empty($user_id))
{
    echo '<script>window.location.replace("./index.php");</script>';
}
$get = "SELECT * FROM user_data WHERE username='$user_id'";
$get_result = mysqli_query($con, $get);
$row_get = mysqli_fetch_array($get_result);

if (isset($_POST['submit'])) {
    $list = $_POST['list'];
    $list_id = rand(10, 10000000);
    $currentDate = date("Y-m-d H:i:s");
    $insert_data = "INSERT INTO lists (username, list, list_id, status, date) VALUES ('$user_id','$list','$list_id','Processing', '$currentDate')";
    $insert_result = mysqli_query($con, $insert_data);
    if ($insert_result) {

        echo '<script>alert("New Task has beed Added successfully");window.location.replace("./home.php");</script>';
    }
}
if (isset($_POST['completed'])) {
    $list_id = $_POST['list_id'];
    $update_status = "UPDATE lists SET status='Completed' WHERE list_id='$list_id' AND username='$user_id'";
    $result = mysqli_query($con, $update_status);
    if ($result) {
        echo '<script>alert("Task Status has beed Update successfully");window.location.replace("./home.php");</script>';
    }
}
if (isset($_POST['quit'])) {
    $list_id = $_POST['list_id'];
    $update_status = "UPDATE lists SET status='Quit' WHERE list_id='$list_id' AND username='$user_id'";
    $result = mysqli_query($con, $update_status);
    if ($result) {
        echo '<script>alert("Task Status has beed Update successfully");window.location.replace("./home.php");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row_get['name']; ?> - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e7e8a56c4e.js" crossorigin="anonymous"></script>
    <style>
        ul, li
        {
            list-style: none !important;
        }
        .card
        {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border: none !important;
        }
        a
        {
            text-decoration: none !important;
        }
    </style>
</head>

<body>

    <section class="login-section my-5">
        <div class="container">
            <div class="text-center">
                <h3>Welcome Back <?php echo $row_get['name']; ?></h3>
                <h3>TO-DO List</h3>
                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_new">Create New</button> -->
            </div>
            <div class="row mt-5">

                <div class="col-lg-2">
                    <dic class="card">
                        <div class="card-body">
                        <ul class="p-0">
                        <li><i class="fas fa-circle me-2 text-primary"></i>Processing</li>
                        <li><i class="fas fa-circle me-2 text-success"></i>Completed</li>
                        <li><i class="fas fa-circle me-2 text-danger"></i>Quit</li>
                    </ul>
                    <hr>
                    <ul class="p-0">
                        <li class="mb-3"><a href="#" type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#create_new"><i class="fas fa-plus me-3"></i>Create New</a></li>
                        <li><a href="logout.php?user_id=<?php echo $_SESSION['username']; ?>" class="text-danger"><i class="fas fa-sign-out-alt me-3"></i>Logout</a></li>
                    </ul>
                        </div>
                    </dic>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <?php
                        require_once('./config.php');
                        $query = "SELECT * FROM lists WHERE username ='$user_id' order by id DESC";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <div class="col-lg-4">
                                <div class="alert 
                        <?php if ($row['status'] == 'Quit') {
                        ?>
                            alert-danger
                            <?php
                            } elseif ($row['status'] == 'Completed') {
                            ?>
                            alert-success
                            <?php
                            } else {
                            ?>
                            alert-primary
                            <?php
                            }
                            ?>
                        " role="alert">
                                    <span class="m-0   <?php if ($row['status'] == 'Quit') {
                                                        ?>
                            text-decoration-line-through
                            <?php
                                                        }

                            ?>"><?php echo $row['list']; ?></span>
                                    <form action="" method="post" class="float-end">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <input type="hidden" name="list_id" value="<?php echo $row['list_id']; ?>">
                                        <?php if ($row['status'] == 'Processing') {
                                        ?>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="submit" class="btn text-success" name="completed"><i class="fas fa-check"></i></button>
                                                <button type="submit" class="btn text-danger" name="quit"><i class="fas fa-times"></i></button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <div class="modal fade" id="create_new" tabindex="-1" aria-labelledby="create_newLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_newLabel">Create List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="my-2 form-group">
                                    <label for="username">TO DO</label>
                                    <input type="text" name="list" class="form-control" id="list">
                                </div>
                            </div>

                            <div class="col-lg-12 my-3">
                                <input type="submit" name="submit" class="btn btn-primary" id="submit" value="Add Task">
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    </div>
</body>

</html>