<?php
   require_once (__DIR__ . '/../Lib/database.php');
   require_once (__DIR__ . '/../Lib/session.php');
   require_once (__DIR__ . '/../Lib/cookies.php');
   use App\Tools\DB;
   use App\Tools\Session;
   use App\Tools\Cookie;
 
   $Session = new Session();
   $db = DB::getInstance();
   $Cookie = new Cookie();

   $where = array('username', '=', $Cookie->get('username'));
   $rows = $db->select('*', 'users', $where)->getResult();
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
    <link rel="stylesheet" href="<?= "/Task_2/src/View/css/core-style.css" ?>">
    <link rel="stylesheet" href="<?= "/Task_2/src/View/style.css" ?>">

</head>

<body>
    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)"><img src="/Task_2/src/View/img/core-img/logo.jpg" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo2">
                <a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)"><img src="/Task_2/src/View/img/core-img/logo.jpg" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)">Home</a></li>
                    <li><a href="/Task_2/src/Controller/Router.php/shop/manga" onclick="changeUrl(event)">Shop</a></li>
                </ul>
            </nav>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="/Task_2/src/Controller/Router.php/cart/index" onclick="changeUrl(event)" class="cart-nav"><img src="/Task_2/src/View/img/core-img/cart.png" alt=""> Cart <span>(<?php echo array_sum($Session->get('amountArr')); ?>)</span></a>
            </div>
        </header>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2><?php echo $Cookie->get('username'); ?>'s Checkout</h2>
                            </div>

                            <form action="/Task_2/src/Controller/Router.php/receipt/index" method="post" id="form">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="first_name" name="username" value="<?php echo $rows[0]->username; ?>" placeholder="Username" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="last_name" name="fullname" value="<?php echo $rows[0]->Full_Name; ?>" placeholder="Full Name" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $rows[0]->email; ?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control mb-3" id="street_address" name="address" placeholder="Address" value="<?php echo $rows[0]->address; ?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $rows[0]->city; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="zipCode" name="zip" placeholder="Zip Code" value="<?php echo $rows[0]->zip; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="phone_number" name="phone" min="0" placeholder="Phone No" value="<?php echo $rows[0]->phone; ?>">
                                    </div>

                                    <div class="payment-method">
                                        <!-- Cash on delivery -->
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="cod" value="1" name="payment_method" checked>
                                            <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                        </div>

                                        <!-- Paypal -->
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="paypal" name="" value="2">
                                            <label class="custom-control-label" for="paypal">Card <img class="ml-15" src="img/core-img/paypal.png" alt=""></label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>$<?php echo number_format($Session->get('total'), 2);?></span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span>$<?php echo number_format($Session->get('total'), 2);?></span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="/Task_2/src/Controller/Router.php/receipt/index" class="btn amado-btn w-100" onclick="checkout(event, 'form');">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)"><img src="/Task_2/src/View/img/core-img/logo2.jpg" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

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
    <script>
        const codCheckbox = document.getElementById('cod');
        const paypalCheckbox = document.getElementById('paypal');

        paypalCheckbox.addEventListener('change', () => {
            if (paypalCheckbox.checked) {
                codCheckbox.checked = false;
                codCheckbox.removeAttribute('name');
                paypalCheckbox.setAttribute('name', 'payment_method');
            }
        });

        codCheckbox.addEventListener('change', () => {
            if (codCheckbox.checked) {
                paypalCheckbox.checked = false;
                paypalCheckbox.removeAttribute('name');
                codCheckbox.setAttribute('name', 'payment_method');
            }
        });
    </script>
</body>

</html>