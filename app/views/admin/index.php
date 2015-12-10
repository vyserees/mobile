<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Mobilni - Admin Panel</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link href="/assets/css/admin.css" rel="stylesheet" type="text/css">
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
</head>
<body class="pocetna">
<div class="logovanje">
    	<div class="logo"><img src="/assets/images/common/creativeweb.png" width="195" height="39" alt="creative web"></div>
        <?php echo $nema; ?>
		<form action="/admin-login" name="log" method="post" role="form">
                    <p style="color:#fff; text-align:center; margin:0 0 20px 0;">Logovanje za ADMINA</p>
                    <?php if($data!==''){
                    echo '<p class="mojeobavestenje bg-danger">Pogrešno korisničko ime ili lozinka!</p>';
                } ?>
   	  		<div class="form-group">
    			<div class="input-group">
      				<div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
      					<input name="email" type="text" class="form-control" id="exampleInputEmail2" placeholder="Korisničko ime" required>
    			</div>
  			</div>
            <div class="form-group">
    			<div class="input-group">
      				<div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
      					<input name="password" type="password" class="form-control" id="exampleInputEmail2" placeholder="Lozinka" required>
    			</div>
  			</div>
            <input name="potvrdi" type="submit" value="Uloguj se" class="btn btn-primary" >
        </form>
        <div class="prava">
        	©2015–<?php echo date('Y'); ?> Sva prava zadržana. Creative Web ®. Proizvod je zaštićen copyrightom i drugim zakonima o intelektualnoj svojini. Creative Web zadržava pravo na naziv, umnožavanje i ostalu intelektualnu svojinu vezanu za program. Korisnik ima pravo da koristi program na bilo kojoj hardverskoj platformi i može se koristiti simultano na neograničenom broju računara.
      </div>
    </div>
</body>
</html>

