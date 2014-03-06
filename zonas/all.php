<?php
  $boton_235x60 = "<!-- LA_PRENSA_Header_235x60_Superior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_All_235x60_Conteo_Mundial_2014');
</script>";
  $smarty->assign('adserver_header_all',"<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService('ca-pub-1199834677431615');
GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_All_235x60_Conteo_Mundial_2014');
</script>
<script type='text/javascript'>
GA_googleFetchAds();
</script>");
  $smarty->assign('boton_235x60',$boton_235x60);
?>
