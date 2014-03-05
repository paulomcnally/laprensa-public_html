<?php
$banner_superior_728_90 = "<!-- ca-pub-1199834677431615/LA_PRENSA_Secciones_728x90_Superior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Secciones_728x90_Superior');
</script>";
$banner_inferior_728_90 = "<!-- ca-pub-1199834677431615/LA_PRENSA_Secciones_728x90_Inferior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Secciones_728x90_Inferior');
</script>";
$banner_nota_336_280 = "<!-- ca-pub-1199834677431615/LA_PRENSA_Secciones_336x280_Nota_Inferior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Secciones_336x280_Nota_Inferior');
</script>";
$banner_medio_300_250 = "<!-- LA_PRENSA_Secciones_300x250_Medio -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Secciones_300x250_Medio');
</script>";
$banner_derecho_300_250 = "<!-- ca-pub-1199834677431615/LA_PRENSA_Secciones_300x250_Sidebar -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Secciones_300x250_Sidebar');
</script>";
$banner_derecho_160_600 = "<!-- ca-pub-1199834677431615/LA_PRENSA_Secciones_160x600_Sidebar -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Secciones_160x600_Sidebar');
</script>";
$smarty->assign('adserver_header',"<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService('ca-pub-1199834677431615');
GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Secciones_160x600_Sidebar');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Secciones_300x250_Medio');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Secciones_300x250_Sidebar');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Secciones_336x280_Nota_Inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Secciones_728x90_Inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Secciones_728x90_Superior');
</script>
<script type='text/javascript'>
GA_googleFetchAds();
</script>");
$smarty->assign('banner_superior_728_90', $banner_superior_728_90);
$smarty->assign('banner_inferior_728_90', $banner_inferior_728_90);
$smarty->assign('banner_medio_300_250', $banner_medio_300_250);
$smarty->assign('banner_nota_336_280', $banner_nota_336_280);
$smarty->assign('banner_derecho_300_250', $banner_derecho_300_250);
$smarty->assign('banner_derecho_160_600', $banner_derecho_160_600);
?>