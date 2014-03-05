<?php
$banner_inferior_728_90 = "<!-- LA_PRENSA_Suplemento_728x90_inferior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Suplemento_728x90_inferior');
</script>";

$banner_superior_728_90 = "<!-- LA_PRENSA_Suplemento_728x90_superior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Suplemento_728x90_superior');
</script>";

$banner_torre_160_600 = "<!-- LA_PRENSA_Suplemento_160x600_derecha -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Suplemento_160x600_derecha');
</script>";

$banner_medio_300_250 = "<!-- LA_PRENSA_Suplemento_300x250_medio -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Suplemento_300x250_medio');
</script>";

$banner_300_250_articulo = "<!-- LA_PRENSA_Suplemento_300x250_medio -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Suplemento_300x250_articulo');
</script>";

$banner_lateral_300_250 = "<!-- LA_PRENSA_Suplemento_300x250_sidebar -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Suplemento_300x250_sidebar');
</script>";

$smarty->assign('adserver_header',"<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService('ca-pub-1199834677431615');
GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Suplemento_160x600_derecha');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Suplemento_300x250_medio');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Suplemento_728x90_inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Suplemento_728x90_superior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Suplemento_300x250_sidebar');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Suplemento_300x250_articulo');
</script>
<script type='text/javascript'>
GA_googleFetchAds();
</script>");

$smarty->assign('banner_torre_160_600', $banner_torre_160_600);
$smarty->assign('banner_medio_300_250', $banner_medio_300_250);
$smarty->assign('banner_inferior_728_90', $banner_inferior_728_90);
$smarty->assign('banner_superior_728_90', $banner_superior_728_90);
$smarty->assign('banner_lateral_300_250', $banner_lateral_300_250);
$smarty->assign('banner_300_250_articulo', $banner_300_250_articulo);
