<?php

?>
<h4>MARKA TELEFONA</h4>
<article>
    <div class="list-brands"></div>
</article>
<h4>MODEL TELEFONA</h4>
<article>
    <div class="list-models"></div>
</article>

<script>
    $(document).ready(function(){
        drawListMarka(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka);
        drawListModel(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
    });
</script>