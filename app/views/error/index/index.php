<?php mvc_header();?>


  <div class="row">
    <div class="col-lg-3">
      <div class="left-sidebar">
          <?php self::view('home/sidebar'); ?>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="hero-unit center">
          <h1>Page Not Found <small><font face="Tahoma" color="red">Error 404</font></small></h1>
          <br />
          <p>The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from.</p>
          <p><b>Or you could just press this neat little button:</b></p>
          <a href="/" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Take Me Home</a>
        </div> 
    </div>
  </div>


<?php mvc_footer();