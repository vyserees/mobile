
<h3>MOBILE.DEV</h3>
<article>
    <p>Etiam sed sapien ex. Quisque sed ipsum tortor. Proin urna metus, scelerisque sit amet fringilla non, vehicula tempor est. Aenean porta nulla ac diam malesuada, rutrum porttitor nulla hendrerit. Maecenas iaculis id dolor non lacinia. Etiam maximus luctus condimentum. Suspendisse potenti. Etiam rhoncus venenatis eros nec egestas. Suspendisse in dolor viverra, egestas nibh vitae, facilisis nulla. Vestibulum lacinia tempor neque a tempor. Maecenas quam enim, laoreet in nibh vel, pretium ultrices odio</p>
</article>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<div style="overflow:hidden;height:300px;">
    <div id="gmap_canvas" style="height:300px;"></div>
    <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
</div>
<script type="text/javascript"> function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(44.8132855,20.47214400000007),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(44.8132855, 20.47214400000007)});infowindow = new google.maps.InfoWindow({content:"<b>Mobile</b><br/>Takovska 2<br/> Beograd" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});}google.maps.event.addDomListener(window, 'load', init_map);</script>
