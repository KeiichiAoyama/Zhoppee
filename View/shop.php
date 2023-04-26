<?php
    require_once ('Controller.php');
    require_once (__DIR__ . '/../Lib/session.php');
    use App\Controller\Controller;
    use App\Tools\Session;

    $Controller = new Controller();
    $Session = new Session();

    switch($data['type']){
        case 1:
            $Session->set('dir', 'manga');
            $Session->set('id', 'mangaID');
            break;
        case 2:
            $Session->set('dir', 'light-novel');
            $Session->set('id', 'lnovelID');
            break;
        case 3:
            $Session->set('dir', 'merch');
            $Session->set('id', 'merchID');
            break;
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

    <!-- Favicon  -->
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
            <div class="logo">
                <a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)"><img src="/Task_2/src/View/img/core-img/logo.jpg" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)">Home</a></li>
                    <li class="active"><a href="/Task_2/src/Controller/Router.php/shop/<?php echo $Session->get('dir'); ?>" onclick="changeUrl(event)">Shop</a></li>
                </ul>
            </nav>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="/Task_2/src/Controller/Router.php/cart/index" onclick="changeUrl(event)" class="cart-nav"><img src="/Task_2/src/View/img/core-img/cart.png" alt=""> Cart <span>(<?php echo array_sum($Session->get('amountArr')); ?>)</span></a>            </div>
        </header>
        <!-- Header Area End -->

        <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Catagories</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <li <?php if($data['type'] == 1){echo 'class="active"';} ?>><a href="/Task_2/src/Controller/Router.php/shop/manga" onclick="changeUrl(event)">Manga</a></li>
                        <li <?php if($data['type'] == 2){echo 'class="active"';} ?>><a href="/Task_2/src/Controller/Router.php/shop/lightnovel" onclick="changeUrl(event)">Light Novel</a></li>
                        <li <?php if($data['type'] == 3){echo 'class="active"';} ?>><a href="/Task_2/src/Controller/Router.php/shop/merch" onclick="changeUrl(event)">Merchandise</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                <?php
                    $rows = $Controller->getRowProducts($data['type']);

                    if(is_array($rows) && count($rows) > 0){
                        foreach($rows as $row){
                            $rating = '';
                            for($i = 1; $i <= $row->rating; $i++){
                                $rating .= '<i class="fa fa-star" aria-hidden="true"></i>';
                            }
                            echo '<div class="col-12 col-sm-6 col-md-12 col-xl-6">
                                    <div class="single-product-wrapper">
                                        <!-- Product Image -->
                                        <div class="product-img">
                                            <img src="/Task_2/src/View/img/product-img/'.$Session->get('dir').'/'.$row->picture_1.'" alt="">
                                            <!-- Hover Thumb -->
                                            <img class="hover-img" src="/Task_2/src/View/img/product-img/'.$Session->get('dir').'/'.$row->picture_2.'" alt="">
                                        </div>

                                        <!-- Product Description -->
                                        <div class="product-description d-flex align-items-center justify-content-between">
                                            <!-- Product Meta Data -->
                                            <div class="product-meta-data">
                                                <div class="line"></div>
                                                <p class="product-price">$'.$row->price.'</p>
                                                <a href="#" onclick="submitForm(event,`'.$row->{$Session->get('id')}.'`)">
                                                    <h6>'.$row->name.'</h6>
                                                </a>
                                                <form id="'.$row->{$Session->get('id')}.'" method="post" action="/Task_2/src/Controller/Router.php/product/index">
                                                    <input type="hidden" name="table" value="'.str_replace("-", " ", $Session->get('dir')).'">
                                                    <input type="hidden" name="productID" value="'.$row->{$Session->get('id')}.'">
                                                    <input type="hidden" name="field" value="'.$Session->get('id').'">
                                                </form>
                                            </div>
                                            <!-- Ratings & Cart -->
                                            <div class="ratings-cart text-right">
                                                <div class="ratings">
                                                    '.$rating.'
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> </br>';

                        }
                       
                    }

                ?>
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
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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

</body>

</html>