<?php
$banner_superior_728_90 = "<!-- LA_PRENSA_Play_728x90_Superior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_728x90_Superior');
</script>";
$banner_inferior_728_90 = "<!-- LA_PRENSA_Play_728x90_Inferior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_728x90_Inferior');
</script>";
$banner_nota_336_280 = "<!-- LA_PRENSA_Play_336x280_Nota_Inferior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_336x280_Nota_Inferior');
</script>";
$banner_medio_300_250 = "<!-- LA_PRENSA_Play_300x250_Medio -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_300x250_Medio');
</script>";
$banner_derecho_300_250 = "<!-- LA_PRENSA_Play_300x250_Sidebar -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_300x250_Sidebar');
</script>";
$banner_derecho_160_600 = "<!-- LA_PRENSA_Play_160x600_Sidebar -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_160x600_Sidebar');
</script>";
$banner_160x600_lateral_1 = "<!-- LP_Play_160x600_lateral_1 -->
<script type='text/javascript'>
GA_googleFillSlot('LP_Play_160x600_lateral_1');
</script>";
$banner_160x600_lateral_2 = "<!-- LP_Play_160x600_lateral_2 -->
<script type='text/javascript'>
GA_googleFillSlot('LP_Play_160x600_lateral_2');
</script>";
$boton_260x90 = "<!-- LA_PRENSA_Play_260x90_boton -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_260x90_boton');
</script>";
$boton_inferior_260_90 = "<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Play_260x90_boton_inferior');
</script>";

$banner_300x250_mundial_1 = <<<EOT
<!-- Portada_Mundial_300x250_inferior -->
<div id='div-gpt-ad-1402563808229-0' style='width:300px; height:250px; float:left; margin-left:40px;'>
<script type='text/javascript'>
GA_googleFillSlot('Portada_Mundial_300x250_inferior');
</script>
</div>
EOT;
$banner_300x250_mundial_2 = <<<EOT
<!-- Portada_Mundial_300x250_sidebar -->
<div id='div-gpt-ad-1402564044426-0' style='width:300px; height:250px; float:left; margin-left:60px'>
<script type='text/javascript'>
GA_googleFillSlot('Portada_Mundial_300x250_sidebar');
</script>
</div>
EOT;

$banner_250x250_mundial = <<<EOT
<!-- Mundial-Play-250x250 -->
<div id='div-gpt-ad-1402605150966-0' style='width:250px; height:250px;'>
<script type='text/javascript'>
GA_googleFillSlot('Mundial-Play-250x250');
</script>
</div>
EOT;

$smarty->assign('adserver_header',"<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService('ca-pub-1199834677431615');
GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_160x600_Sidebar');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_260x90_boton');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_300x250_Medio');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_300x250_Sidebar');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_336x280_Nota_Inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_728x90_Inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_728x90_Superior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LP_Play_160x600_lateral_1');
GA_googleAddSlot('ca-pub-1199834677431615', 'LP_Play_160x600_lateral_2');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Play_260x90_boton_inferior');

GA_googleAddSlot('ca-pub-1199834677431615', 'Portada_Mundial_300x250_inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'Portada_Mundial_300x250_sidebar');
GA_googleAddSlot('ca-pub-1199834677431615', 'Mundial-Play-250x250');
</script>
<script type='text/javascript'>
GA_googleFetchAds();
</script>
");
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

$smarty->assign('banner_300x250_mundial_1', $banner_300x250_mundial_1);
$smarty->assign('banner_300x250_mundial_2', $banner_300x250_mundial_2);
$smarty->assign('banner_250x250_mundial', $banner_250x250_mundial);
?>
