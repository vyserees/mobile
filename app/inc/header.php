<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo APP_NAME ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,300italic,400italic,600italic,700,700italic,800,800italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>
    <link href="/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="/assets/css/owl.theme.css" rel="stylesheet">
    <link href="/assets/css/owl.transitions.css" rel="stylesheet">
    <link href="/assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    
    <!--Jquery library-->
    <script src="/assets/js/jquery-1.11.2.min.js"></script>
    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
      <header>
          <div class="header">
              <div class="container page-layout">
                  <div class="row">
                      <div class="col-lg-9">
                          <p>Mobile.dev</p>
                      </div>
                      <div class="col-lg-3" style="text-align: right;">
                          <?php if(isset($_SESSION['USER_ID'])&&$_SESSION['USER_ROLE']==='U'){?>
                          <a href="/logout">Odlogujte se</a>
                          <?php }else{?>
                          <a href="/login">Ulogujte se</a>
                          <a href="/registracija">Registrujte se</a>
                          <?php }?>
                      </div>
                  </div>
              </div>
          </div>
      
   
    <div class="container page-layout">
        <div class="row">
            <div class="col-lg-4">
                <div class="hed-logo">
                    <img src="/assets/images/common/creativeweb.png" alt="Logo sajta" class="img-responsive"/>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hed-middle">
                    <h1>A</h1>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="hed-cart">
                    <div class="hed-cart-layer row">
                        <div class="col-lg-4">
                            <div class="cart-img-prods"><span id="cart-prods"></span></div>
                            <img src="/assets/images/common/cart.png" alt="Slika korpe" />
                        </div>
                        <div class="hed-cart-text col-lg-8" style="padding:5px 15px 5px 0;">
                         
                        <p class="cart-value-layer"><span id="cart-value"></span></p>
                        </div>  
                    </div>

                    <div class="hed-cart-submenu" hidden="">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <?php (new Home)->view('menu/index'); ?>
            </div>
        </div>
    </div>
</header>
      <div class="container page-layout">