<?php
    require_once (__DIR__ . '/../Lib/database.php');
    require_once (__DIR__ . '/../Lib/session.php');

    use App\Tools\DB;
    use App\Tools\Session;

    $Session = new Session();
    $db = DB::getInstance();

    $arr = array();
    for($i = 1; $i <= 9; $i++){
        $x = mt_rand(1,10);
        $str = '';
        $table = '';
        $field = '';
        if($i % 2 == 0){
            if($x == 10){
                $str = "mg0".strval($x);
            }else{
                $str = "mg00".strval($x);
            }
            $table = "manga";
            $field = "mangaID";
        }else{
            if($x == 10){
                $str = "ln0".strval($x);
            }else{
                $str = "ln00".strval($x);
            }
            $table = "`light novel`";
            $field = "lnovelID";
        }
        $where = array($field, '=', $str);
        $result = $db->select('*', $table, $where)->getResult();
        if($result){
            $arr[] = $result[0];
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
                    <li class="active"><a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)">Home</a></li>
                    <li><a href="/Task_2/src/Controller/Router.php/shop/manga" onclick="changeUrl(event)">Shop</a></li>
                </ul>
            </nav>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="/Task_2/src/Controller/Router.php/cart/index" onclick="changeUrl(event)" class="cart-nav"><img src="/Task_2/src/View/img/core-img/cart.png" alt=""> Cart <span>(<?php echo array_sum($Session->get('amountArr')); ?>)</span></a>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix">
                <?php
                    $x = 1;
                    foreach($arr as $row){
                        $dir = '';
                        $id = '';
                        $table = '';
                        if($x % 2 == 0){
                            $dir = 'manga';
                            $table = 'manga';
                            $id = 'mangaID';
                        }else{
                            $dir = 'light-novel';
                            $id = 'lnovelID';
                            $table = 'light novel';
                        }   
                        echo '<div class="single-products-catagory clearfix">
                                <a href="#" onclick="submitForm(event, `'.$row->$id.'`);">
                                    <img src="/Task_2/src/View/img/product-img/'.$dir.'/'.$row->picture_2.'" alt="">
                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <div class="line"></div>
                                        <p>$'.$row->price.'</p>
                                        <h4>'.$row->name.'</h4>
                                        <p>'.$id.'</p>
                                        <p>'.$x.'</p>
                                    </div>
                                </a>
                                <form id="'.$row->$id.'" method="post" action="/Task_2/src/Controller/Router.php/product/index">
                                    <input type="hidden" name="table" value="'.$table.'">
                                    <input type="hidden" name="productID" value="'.$row->$id.'">
                                    <input type="hidden" name="field" value="'.$id.'">
                                </form>
                            </div>';
                        $x++;
                    }
                ?>
            </div>
        </div>
        <!-- Product Catagories Area End -->
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
</body>

</html>