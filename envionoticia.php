<?php
session_start();
define("FORMULARIOS", true);
define("TINYMCE", true);
require("../classes/app.class.php");

$u = new usuarioTable;
$noticia = new minoticiaTable;
$imag = new fotominoticiaTable;
$imagen = new almImage();
$videonoticia = new videominoticiaTable;
$pagina = new paginaTable();
$pagina->readEnv();
$nombre = explode('.', $_FILES['fotominoticia']['name']);
$cuantos = count($nombre);
$ext = $nombre[$cuantos - 1];
$imageFormats = array('jpeg', 'gif', 'png','bmp','BMP','jpg','JPG','JPEG');
$limitImg = 1048576 * 4;

$tpl = "minoticia/envionoticia.tpl";
$nportada = $noticia->readDataFilter("minoticia.ubicacion = 'L' OR minoticia.ubicacion = 'M' OR minoticia.ubicacion = 'S'");
$smarty->assign("noticiasportada", $nportada);

if(!isset($_SESSION["idusuario"]) && empty($_SESSION["idusuario"])){
  header("Location: /minoticia/entrar");
}

if(!empty($_POST)){
   if(empty($_POST["minoticia"])){
     $smarty->assign("msg", "No introdujo un Titulo para su noticia");
   }elseif(empty($_POST["texto"])){
     $smarty->assign("msg", "No ha especificado el detalle de la noticia:");
   }elseif(empty($_POST["lugarnoticia"])){
     $smarty->assign("msg", "No ha indicado el lugar donde aconteci&oacute; la noticia");
   }elseif($ext && !in_array($ext, $imageFormats)){
     $smarty->assign("msg", "El formato de la foto seleccionada parece no ser valido. Por favor verifique");
   }elseif($_FILES['archivofoto']['size']>$limitImg){
     $smarty->assign("msg", "La foto supera los 2 Mb. Seleccione una foto con menor peso");  
   }else{
      if($_POST['fotoaux'] != ''){   
        $imag->readEnv();
        $imag->request['texto'] = 'Imagen adjunta para la noticia ' . stripslashes($_REQUEST['minoticia']);
        $imag->request['credito'] = 'Foto enviada por nuestro lector: ' . $_POST['userinfo'] . ' / ' . $_REQUEST['lugartomafoto'] . 'Imagen adjunta para la noticia ' . stripslashes($_REQUEST['minoticia']);
        $imag->addRecord();
        $idimagen = $imag->getVar("SELECT MAX(idfotominoticia) FROM fotominoticia");
        $data = new fotominoticiaTable;
        $rows = $data->readDataFilter("fotominoticia.idfotominoticia = " . $idimagen);
        foreach($rows as $row) {
         foreach($data->definition as $column) {
           if ($column['type'] == 'image' && $row[$column['name']] && $column['extra']['sizes']) {
             $pos = strpos($row[$column['name']],'_');
             $timemark = substr($row[$column['name']],0,$pos);
             $timemark = getdate($timemark);
             $sizes = explode(',',$column['extra']['sizes']);
             $filename = $row[$column['name']];
             if(isset($sizes))  {
               if ($timemark['mon']<10) $timemark['mon'] = "0" . $timemark['mon'];
               if(!is_dir(PIXDIR."/".$timemark['year']))  mkdir(PIXDIR."/".$timemark['year'], PERMIS_DIR);
               if(!is_dir(PIXDIR."/".$timemark['year']."/".$timemark['mon']))  mkdir(PIXDIR."/".$timemark['year']."/".$timemark['mon'], PERMIS_DIR);
                 if($sizes)
                   foreach($sizes as $size) {
                   $pic = null;
                   list($w, $h, $crop) = split("x", trim($size));
                     if($crop&&$h) {
                       $pic = $imagen->crop(ROOTDIR . "/files/" . $data->name . "/" . $filename,$w,$h);
                     } else {
                       $pic = $imagen->resize(ROOTDIR . "/files/" . $data->name . "/" . $filename,$w,$h);
                     }
                    $thumbf = PIXDIR . "/" . $timemark['year'] . "/" . $timemark['mon'] . "/$w" . ($h?"x$h":"") . "_" . $filename;
                      if (imagejpeg($pic, $thumbf, IMG_QUALITY) === FALSE) {
                        echo "ERROR al escribir " . $thumbf."\n";
                       }else error_log("Foto del usuario enviada con exito");
                    }
                 $imagenadjunta = PIXURL . "/" . $timemark['year'] . "/" . $timemark['mon'] . "/397x200_" . $filename;
              }
            }
          }
       }
     }
     $noticia->readEnv();
     $noticia->request['minoticia'] = stripslashes($_REQUEST['minoticia']);
     $noticia->request['idautmn'] = (int)$_REQUEST['idusuario'];
     $palabras = limitar_palabras($_REQUEST["texto"], 500);

     if($_POST['fotoaux'] == ''){
        $noticia->request['texto'] = $palabras . '<p>&nbsp;</p><p><b> Lugar de la noticia</b>: ' . stripslashes($_REQUEST['lugarnoticia'] . '</p>'); 
     }else{
        $noticia->request['texto'] = '<div class="na-media na-image-normal image-8" style="width: 300px"><img src="' . $imagenadjunta . '" width="397" height="200" />' . '<div class="info"><p><strong>&nbsp;</strong>Foto enviada por nuestro lector: ' . $_POST['userinfo'] . '</p></div> </div><p>&nbsp;</p><p>&nbsp;</p>' . $palabras . '<p>&nbsp;</p><p><b> Lugar de la noticia</b>: ' . stripslashes($_REQUEST['lugarnoticia'] . '</p>');
     }
error_log('add record javier');
     $noticia->addRecord();

     if(!empty($_POST["nvideo"])){
         $videonoticia->readEnv();
         $videonoticia->execSql("INSERT INTO videominoticia (archivovideo, texto) VALUES ('" . $_REQUEST['nvideo'] . "','Video adjunto para la noticia: " . stripslashes($_REQUEST['minoticia']) . ' Enviado por: ' . $_POST['userinfo'] . "')");
     }       
      $smarty->assign("enviada", true);
  }
}

include("../classes/header-minoticia.inc.php");

$smarty->assign("internaminoticia", TRUE);
$smarty->assign("terminoscondiciones", $pagina->readRecord(6));
$smarty->caching = 0;
$smarty->display($tpl, $_SESSION['idusuario']);

$smarty->display('minoticia/ultimasnoticiasuser.inc.tpl', $_SESSION['idusuario']);
//$smarty->display('minoticia/right-formularios.tpl');
include ("../classes/footer.inc.php");
?>
