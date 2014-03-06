<?php
  # If we are in the admin side, run this
  $sectionlinks = array();
  $sectionlinks['settings'] = array ('label'=>'Generales','index'=>'','objects'=>'unidad,moneda,producto,dolar,pais,seccion,especial,suplemento,pagina,region,usuario,filtro,anuncio,cargo,autor','hide'=>true);
  if(isset($_SESSION['admin'])) {
    $sectionlinks['print'] = array ('label'=>'Periodico','index'=>'','objects'=>'edicion,noticia,comentario,comentarioban');
    $sectionlinks['suplement'] = array ('label'=>'Suplementos','index'=>'','objects'=>'edicionsuplemento,seccionsuplemento,articulo,comentarioarticulo');
    $sectionlinks['special'] = array ('label'=>'Especiales','index'=>'','objects'=>'nota,comentarionota');
    $sectionlinks['entertainment'] = array ('label'=>'Entretenimiento','index'=>'','objects'=>'cartelera,signo,horoscopo');
    $sectionlinks['media'] = array ('label'=>'Biblioteca de Medios','index'=>'','objects'=>'imagen,comentariocaricatura,galeria,comentariogaleria,media,video,comentariovideo');
    $sectionlinks['various'] = array ('label'=>'Varios','index'=>'','objects'=>'encuesta,disciplina,equipo,jornada,partido,marcador,dolarpais,comportamiento,na_usuario');
  } else {
    $links = &$sectionlinks['settings'];
  }
?>
