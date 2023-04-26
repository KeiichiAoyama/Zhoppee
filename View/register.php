<?php
    require_once(__DIR__ . '/../Controller/Controller.php');

    use App\Controller\Controller;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $array = array();
        $array[] = $_POST["username"];
        $array[] = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $array[] = $_POST["fullname"];
        $array[] = $_POST["email"];
        $array[] = $_POST["phone"];
        $array[] = $_POST["address"];
        $array[] = $_POST["city"];
        $array[] = $_POST["zipcode"];
        $array[] = $_POST["cardnumber"];
        $Controller = new Controller();
        
        if (!$Controller->checkUsername($array[0])) {
            if(count($array) == 9){
                if($Controller->registerNewUser($array)){
                    header("Location: /Task_2/src/Controller/Router.php");
                }else {
                    echo "<script>alert('Registration failed');</script>";
                }
            }else{
                echo "<script>alert('Registration failed');</script>";
            }
            exit;
        }else if ($Controller->checkUsername($array[0])) {
            echo "<script>alert('Username is already taken');</script>";
        }else{
            echo "<script>alert('Registration failed');</script>";
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="px-5 ms-xl-4">
                        <!-- Logo -->
                        <div class="logo">
                            <img src="/Task_2/src/View/img/core-img/logo.jpg" alt="" style="height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form style="width: 23rem;" action="http://localhost/Task_2/src/Controller/Router.php/register/index" method="POST">
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign up</h3>
                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example18" class="form-control form-control-lg" name="username" />
                                <label class="form-label" for="form2Example18">Username</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="form2Example28" class="form-control form-control-lg" name="password" />
                                <label class="form-label" for="form2Example28">Password</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example18" class="form-control form-control-lg" name="fullname" />
                                <label class="form-label" for="form2Example18">Full Name</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="email" id="form2Example18" class="form-control form-control-lg" name="email" />
                                <label class="form-label" for="form2Example18">Email</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example18" class="form-control form-control-lg" name="phone" />
                                <label class="form-label" for="form2Example18">Phone</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="textarea" id="form2Example18" class="form-control form-control-lg" name="address" />
                                <label class="form-label" for="form2Example18">Address</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example18" class="form-control form-control-lg" name="city" />
                                <label class="form-label" for="form2Example18">City</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example18" class="form-control form-control-lg" name="zipcode" />
                                <label class="form-label" for="form2Example18">Zip Code</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form2Example18" class="form-control form-control-lg" name="cardnumber" />
                                <label class="form-label" for="form2Example18">Card Number</label>
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="/Task_2/src/View/img/bg-img/cover.jpg"
                    alt="Login image" class="w-100 h-100" style="object-fit: cover; object-position: left; height: 100vh;">
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