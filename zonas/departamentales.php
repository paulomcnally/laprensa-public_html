<?php
$banner_superior_728_90 = "<!-- La_Prensa_Departamentales_728x90_superior -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_728x90_superior');
</script>";

$banner_inferior_728_90 = "<!-- La_Prensa_Departamentales_728x90_inferior -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_728x90_inferior');
</script>";

$banner_nota_336_280 = "<!-- La_Prensa_Departamentales_300x250_nota -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_300x250_nota');
</script>";

$banner_medio_300_250 = "<!-- La_Prensa_Departamentales_300x250_medio -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_300x250_medio');
</script>";

$banner_derecho_300_250 = "<!-- La_Prensa_Departamentales_300x250_lateral -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_300x250_lateral');
</script>";

$banner_derecho_160_600 = "<!-- La_Prensa_Departamentales_160x600_lateral -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_160x600_lateral');
</script>";

$banner_160x600_lateral_1 = "<!-- La_Prensa_Departamentales_160x600_lateral_1 -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_160x600_lateral_1');
</script>";

$banner_160x600_lateral_2 = "<!-- La_Prensa_Departamentales_160x600_lateral2 -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_160x600_lateral2');
</script>";

$boton_260x90 = "<!-- La_Prensa_Departamentales_260x90_superior -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_260x90_superior');
</script>";

$boton_inferior_260_90 = "<!-- La_Prensa_Departamentales_260x90_inferior -->
<script type='text/javascript'>
GA_googleFillSlot('La_Prensa_Departamentales_260x90_inferior');
</script>";

$smarty->assign('adserver_header',"<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService('ca-pub-1199834677431615');
GS_googleEnableAllServices();
</script><script type='text/javascript'>
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_160x600_lateral');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_160x600_lateral_1');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_160x600_lateral2');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_260x90_inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_260x90_superior');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_300x250_lateral');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_300x250_medio');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_300x250_nota');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_728x90_inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'La_Prensa_Departamentales_728x90_superior');
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
$smarty->assign('boton_260x90', $boton_260x90);
$smarty->assign('banner_160x600_lateral_1',$banner_160x600_lateral_1);
$smarty->assign('banner_160x600_lateral_2',$banner_160x600_lateral_2);
$smarty->assign('banner_derecho_300_250', $banner_derecho_300_250);
$smarty->assign('boton_inferior_260_90', $boton_inferior_260_90);
?>
