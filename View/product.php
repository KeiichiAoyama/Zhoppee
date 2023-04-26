<?php
  require_once (__DIR__ . '/../Lib/database.php');
  require_once (__DIR__ . '/../Lib/session.php');
  use App\Tools\DB;
  use App\Tools\Session;

  $Session = new Session();
  $db = DB::getInstance();

  $title = '';
  $x = 0;

  $post = $_POST['table'];
  $table = '`'.$post.'`';
  $id = $_POST['productID'];
  $field = $_POST['field'];
  $Session->set('dir', str_replace(" ", "-", $post));

  $where = array($field, '=', $id);
  $rows = $db->select('*', $table, $where)->getResult();
  foreach($rows as $row){
    $title = $row->name;
  }

  switch($post){
    case 'manga':
      $x = 1;
      break;
    case 'light novel':
      $x = 2;
      break;
    case 'merch':
      $x = 3;
      break;
  }
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
    <title><?php echo $rows[0]->name; ?></title>

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
            <li><a href="/Task_2/src/Controller/Router.php/shop/<?php echo str_replace("-", "", $Session->get('dir')); ?>" onclick="changeUrl(event)">Shop</a></li>
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

      <!-- Product Details Area Start -->
      <div class="single-product-area section-padding-100 clearfix">
        <div class="container-fluid">
          <div class="row">

          <div class="row">
            <div class="col-12 col-lg-7">
              <div class="single_product_thumb">
                <div
                  id="product_details_slider"
                  class="carousel slide"
                  data-ride="carousel"
                >
                  <ol class="carousel-indicators">
                    <li
                      class="active"
                      data-target="#product_details_slider"
                      data-slide-to="0"
                      style="<?php echo 'background-image: url(/Task_2/src/View/img/product-img/'.urlencode($Session->get('dir')).'/'.$rows[0]->picture_1.');';?>"
                    ></li>
                    <li
                      data-target="#product_details_slider"
                      data-slide-to="1"
                      style="
                        <?php echo 'background-image: url(/Task_2/src/View/img/product-img/'.urlencode($Session->get('dir')).'/'.$rows[0]->picture_2.');';?>
                      "
                    ></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <a
                        class="gallery_img"
                        href="<?php echo '/Task_2/src/View/img/product-img/'.urlencode($Session->get('dir')).'/'.$rows[0]->picture_1;?>"
                      >
                        <img
                          class="d-block w-100"
                          src="<?php echo '/Task_2/src/View/img/product-img/'.urlencode($Session->get('dir')).'/'.$rows[0]->picture_1;?>"
                          alt="First slide"
                        />
                      </a>
                    </div>
                    <div class="carousel-item">
                      <a
                        class="gallery_img"
                        href="<?php echo '/Task_2/src/View/img/product-img/'.urlencode($Session->get('dir')).'/'.$rows[0]->picture_2;?>"
                      >
                        <img
                          class="d-block w-100"
                          src="<?php echo '/Task_2/src/View/img/product-img/'.urlencode($Session->get('dir')).'/'.$rows[0]->picture_2;?>"
                          alt="Second slide"
                        />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-5">
              <div class="single_product_desc">
                <!-- Product Meta Data -->
                <div class="product-meta-data">
                  <div class="line"></div>
                  <p class="product-price">$<?php echo $rows[0]->price; ?></p>
                  <a href="product-details.html">
                    <h6><?php echo $rows[0]->name; ?></h6>
                  </a>
                  <!-- Ratings & Review -->
                  <div
                    class="ratings-review mb-15 d-flex align-items-center justify-content-between"
                  >
                    <div class="ratings">
                      <?php
                      for($i = 1; $i <= $rows[0]->rating; $i++){
                        echo'<i class="fa fa-star" aria-hidden="true"></i>';
                      }
                      ?>
                    </div>
                  </div>
                  <!-- Avaiable -->
                  <p class="avaibility">
                    <?php echo $rows[0]->stock ?> In Stock
                  </p>
                </div>

                <div class="short_overview my-5">
                    <?php
                      switch($x){
                        case 1:
                          echo '<p>Author: '.$rows[0]->author.'</p><p>Available Volume: '.$rows[0]->volume.'</p>';
                          break;
                        case 2:
                          echo '<p>Author: '.$rows[0]->author.'</p><p>Available Volume: '.$rows[0]->volume.'</p>';
                          break;
                        case 3:
                          echo '<p>Type: '.$rows[0]->type.'</p><p>Brand: '.$rows[0]->brand.'</p>';
                          break;
                      }
                    ?>
                </div>

                <!-- Add to Cart Form -->
                  <div class="cart clearfix cart-btn d-flex mb-50">
                    <p>Qty</p>
                    <div class="quantity">
                      <span
                        class="qty-minus"
                        onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) && qty > 1 ) effect.value--;return false;"
                        ><i class="fa fa-caret-down" aria-hidden="true"></i
                      ></span>
                      <input
                        type="number"
                        class="qty-text"
                        id="qty"
                        step="1"
                        min="1"
                        max="300"
                        name="quantity"
                        value="1"
                      />
                      <span
                        class="qty-plus"
                        onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"
                        ><i class="fa fa-caret-up" aria-hidden="true"></i
                      ></span>
                    </div>
                  </div>
                  <button
                    class="btn amado-btn"
                    onclick="addToCart('<?php echo $x;?>', '<?php echo $rows[0]->$field;?>', event)"
                  >
                    Add to cart
                  </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Product Details Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix container-fluid">
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
