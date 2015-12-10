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
    <link href="/assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="/assets/css/fileinput.css" rel="stylesheet">
    <link href="/assets/css/admin.css" rel="stylesheet">
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

   <!-- Pocetak -->
 <div class="container-fluid">
	<div class="heder row">
		<div class="datum1 col-lg-2 col-md-3 col-sm-3"><?php echo date ("d M."); ?></div>
    	<div class="col-lg-10 col-md-9 col-sm-9">
        	<div class="heder-cms row">
           		<div class="datum col-sm-6">Dobrodošli</div>
            	<div class="logovani-korisnik col-sm-6">
                	<ul>
                    	<li>Ulogovani ste kao Administrator</li>
                    	<li><a href="/admin-logout"><span class="odloguj-se">Odlogujte se</span></a></li>
                  	</ul>
               	</div>
        	</div>
      	</div>
    </div>
</div>
<!--heder-->
<div class="container-fluid">
	<div class="row">
		<div class="leva-strana col-lg-2 col-md-3 col-sm-3">
            <div class="kontrol-panel">Kontrol panel</div>
            
            <div class="meni">
                <ul>
                    <a href="/admin-pocetna"><li>Početna</li></a>
                    <a href="/admin-proizvodi"><li>Proizvodi</li></a>
                    <a href="/admin-kategorije"><li>Kategorije</li></a>
                    <a href="/admin-modeli"><li>Modeli</li></a>
                    <a href="/admin-slider"><li>Slajder</li></a>
                </ul>
            </div>
            <div class="podrska">Podrška</div>
            <div class="podrska-podaci">
                <ul>
                    <li><span class="ikonica glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>Creative Web</li>
                    <li><span class="ikonica glyphicon glyphicon-phone" aria-hidden="true"></span>0653035456</li>
                    <li><span class="ikonica glyphicon glyphicon-envelope" aria-hidden="true"></span>office@creativeeweb.com</li>
                </ul>
                <div class="prava">
                	Sva prava zadržana. Creative Web ®. Proizvod je zaštićen copyrightom i drugim zakonima o intelektualnoj svojini.
Creative Web zadržava pravo na naziv, umnožavanje i ostalu intelektualnu svojinu vezanu za program. Korisnik ima pravo da koristi program na bilo kojoj hardverskoj platformi i može se koristiti simultano na neograničenom broju računara.
				</div>
                <div class="podrska">Novosti</div>
                <div class="novosti">
                	Creative Web pruža i usluge za vođenje Pay Per Click kampanja. Vođenje kampanja podrazumeva kompletnu uslugu od razvoja strategije, osmišljavanja i izrade multimedijalnih oglasa, optimizaciju kampanje – (dnevno ažuriranje ponuda u skladu sa trendovima na tržištu radi smanjenja troškova i povećanja efekta uloženog budžeta) a po završetku kampanje pružamo Vam analizu o ostvarenim efektima i postignutim rezultatima kao i preporuku za dalji nastup na tržištu. Mreže koje koristimo: Google AdWords, Etarget, Facebook.
				</div>
                <div class="logo2"><a href="https://www.creativeeweb.com/index.php" target="_blank" title="creative web"><img src="/assets/images/common/creativeweb.png" width="150" alt="creative web"></a></div>
            </div>
       	</div>
