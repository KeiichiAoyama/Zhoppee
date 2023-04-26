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

   $subtotal = 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
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
          <a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)"><img src="/Task_2/src/View/img/core-img/logo.jpg" alt="" /></a>
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
          <a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)"><img src="/Task_2/src/View/img/core-img/logo.jpg" alt="" /></a>
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
          <a href="/Task_2/src/Controller/Router.php/cart/index" onclick="changeUrl(event)" class="cart-nav"
            ><img src="/Task_2/src/View/img/core-img/cart.png" alt="" /> Cart <span>(<?php echo array_sum($Session->get('amountArr')); ?>)</span></a
          >
        </div>
      </header>
      <!-- Header Area End -->

      <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-lg-8">
              <div class="cart-title mt-50">
                <h2><?php echo $Cookie->get('username'); ?>'s Shopping Cart</h2>
              </div>

              <div class="cart-table clearfix">
                <table class="table table-responsive">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      for($i = 0; $i < count($Session->get('typeArr')); $i++){

                        if(count($Session->get('index')) > 0){
                          if(in_array($i, $Session->get('index'))){
                            continue;
                          }
                        }

                        $field = '';
                        $table = '';
                        $dir = '';
                        switch($Session->getArr('typeArr', $i)){
                          case 1:
                            $field = 'mangaID';
                            $table = 'manga';
                            $dir = 'manga';
                            break;
                          case 2:
                            $field = 'lnovelID';
                            $table = '`light novel`';
                            $dir = 'light-novel';
                            break;
                          case 3:
                            $field = 'merchID';
                            $table = 'merch';
                            $dir = 'merch';
                            break;
                        }

                        $where = array($field, '=', $Session->getArr('prodIDArr', $i));
                        $rows = $db->select('*', $table, $where)->getResult();

                        $total = $rows[0]->price * $Session->getArr('amountArr', $i);
                        $subtotal = $subtotal + $total;

                        echo '<tr id="'.$rows[0]->name.'">
                                <td class="cart_product_img">
                                  <img src="/Task_2/src/View/img/product-img/'.$dir.'/'.$rows[0]->picture_1.'" alt="Product"
                                  />
                                </td>
                                <td class="cart_product_desc">
                                  <h5>'.$rows[0]->name.'</h5>
                                </td>
                                <td class="price">
                                  <span>$'.$total.'</span>
                                </td>
                                <td class="qty">
                                  <div class="qty-btn d-flex">
                                    <p>Qty</p>
                                    <div class="quantity">
                                      <p class="qty-text">'.$Session->getArr('amountArr', $i).'</p>
                                    </div>
                                  </div>
                                </td>
                                <td class="qty">
                                <div class="cart-btn mt-100">
                                  <a class="btn amado-btn w-100" onclick="removeRow('.$i.')">Remove</a>
                                </div>
                                </td>
                              </tr>';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-12 col-lg-4">
              <div class="cart-summary">
                <h5>Cart Total</h5>
                <ul class="summary-table cart-total">
                  <li><span>subtotal:</span> <span>$<?php echo number_format($subtotal, 2); $Session->set('subtotal', $subtotal); ?></span></li>
                  <li><span>service fee:</span> <span>$<?php $fee = 0; if($subtotal != 0){echo number_format(80, 2); $fee = 80;}else{echo number_format(0, 2); $fee = 0;} ?></span></li>
                  <li><span>total:</span> <span>$<?php $ttl = $subtotal + $fee; echo number_format($ttl, 2); $Session->set('total', $ttl); ?></span></li>
                </ul>
                <?php if (count($Session->get('typeArr')) <= 0) { ?>
                  <div class="cart-btn mt-100">
                    <a href="/Task_2/src/Controller/Router.php/shop/manga" onclick="changeUrl(event)" class="btn amado-btn w-100">Shop Now!</a>
                  </div>
                <?php } else { ?>
                  <div class="cart-btn mt-100">
                    <a href="/Task_2/src/Controller/Router.php/checkout/index" onclick="changeUrl(event)" class="btn amado-btn w-100">Checkout</a>
                  </div>
                <?php } ?>
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
                <a href="/Task_2/src/Controller/Router.php/home/index" onclick="changeUrl(event)"
                  ><img src="/Task_2/src/View/img/core-img/logo2.jpg" alt=""
                /></a>
              </div>
              <!-- Copywrite Text -->
              <p class="copywrite">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script>
                All rights reserved | This template is made with
                <i class="fa fa-heart-o" aria-hidden="true"></i> by
                <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->&
                Re-distributed by
                <a href="https://themewagon.com/" target="_blank">Themewagon</a>
              </p>
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
