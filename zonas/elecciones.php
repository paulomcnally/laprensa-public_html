<?php
$banner_superior_728_90 = "
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Especial_Elecciones_728x90');
</script>";
$banner_inferior_728_90 = "<!-- LA_PRENSA_Ambito_728x90_Inferior -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Especial_Elecciones_728x90_inferior');
</script>";
$banner_160x600_lateral_1 = "<!-- LP_Ambito_160x600_lateral_1 -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Especial_Elecciones_160x600');
</script>";
$banner_160x600_lateral_2 = "<!-- LP_Ambito_160x600_lateral_2 -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Especial_Elecciones_160x600_2');
</script>";
$boton_260x90 = "<!-- LA_PRENSA_Ambito_260x90_boton -->
<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Especial_Elecciones_260x90');
</script>";

$boton_inferior_260_90 = "<script type='text/javascript'>
GA_googleFillSlot('LA_PRENSA_Especial_Elecciones_260x90_inferior');
</script>";


$smarty->assign('adserver_header',"<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService('ca-pub-1199834677431615');
GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Especial_Elecciones_160x600');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Especial_Elecciones_160x600_2');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Especial_Elecciones_260x90');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Especial_Elecciones_260x90_inferior');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Especial_Elecciones_728x90');
GA_googleAddSlot('ca-pub-1199834677431615', 'LA_PRENSA_Especial_Elecciones_728x90_inferior');
</script>
<script type='text/javascript'>
GA_googleFetchAds();
</script>");
$smarty->assign('banner_superior_728_90', $banner_superior_728_90);
$smarty->assign('banner_inferior_728_90', $banner_inferior_728_90);
$smarty->assign('boton_260x90', $boton_260x90);
$smarty->assign('banner_160x600_lateral_1',$banner_160x600_lateral_1);
$smarty->assign('banner_160x600_lateral_2',$banner_160x600_lateral_2);
$smarty->assign('boton_inferior_260_90', $boton_inferior_260_90);
?>
