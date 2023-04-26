<?php
    require_once(__DIR__ . '/../Controller/Controller.php');

    use App\Controller\Controller;

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
        $Controller = new Controller();
        
        if ($Controller->checkUsername($username) && !$Controller->checkPassword($password, $username)) {
            $Controller->setCookieUsername($username);
            echo "<script>alert('Signed in');</script>";
            header("Location: /Task_2/src/Controller/Router.php/home/index");
            exit;
        } else if (!$Controller->checkUsername($username)) {
            echo "<script>alert('Username is incorrect');</script>";
        } else {
            echo "<script>alert('Password is incorrect');</script>";
        }
     }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title><?php echo $data['title']; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="/Task_2/src/View/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= "/Task_2/src/View/style.css" ?>">

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid"    >
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="px-5 ms-xl-4">
                        <!-- Logo -->
                        <div class="logo">
                            <img src="/Task_2/src/View/img/core-img/logo.jpg" alt="" style="height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 pt-xl-0 mt-xl-n5">
                        <form style="width: 23rem;" action="http://localhost/Task_2/src/Controller/Router.php/login/index" method="POST">
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example18" class="form-control form-control-lg" name="username" />
                                <label class="form-label" for="form2Example18">Username</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="form2Example28" class="form-control form-control-lg" name="password" />
                                <label class="form-label" for="form2Example28">Password</label>
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                            </div>
                            <p>Don't have an account? <a href="/Task_2/src/Controller/Router.php/register/index" onclick="changeUrl(event)" class="link-info">Register here</a></p>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <img src="/Task_2/src/View/img/bg-img/cover.jpg"
                        alt="Login image" class="w-200 h-400" style="object-fit: cover; object-position: left; height: 700px;">
                </div>
            </div>
        </div>
    </section>

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="<?= "/Task_2/src/View/js/jquery/jquery-2.2.4.min.js" ?>"></script>
    <!-- Popper js -->
    <script src="<?= "/Task_2/src/View/js/popper.min.js" ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?= "/Task_2/src/View/js/bootstrap.min.js" ?>"></script>
    <!-- Plugins js -->
    <script src="<?= "/Task_2/src/View/js/plugins.js" ?>"></script>
    <!-- Active js -->
    <script src="<?= "/Task_2/src/View/js/active.js" ?>"></script>
    <script src="<?= "/Task_2/src/View/js/script.js" ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>