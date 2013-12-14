<?php
session_start();
require("../classes/app.class.php");
require_once(ROOTDIR . "/../cms/php/image.class.php");

$uri = $_REQUEST['cmd'];
$pagina = new paginaTable();
$pagina->readEnv();
$secciones = new seccionTable();
$imagen = new almImage();
$imag = new fotominoticiaTable();
/*$ext = substr(strrchr($_FILES['fotominoticia']['name'], '.'), 1);
$imageFormats = array('jpeg', 'gif', 'png','bmp','BMP','jpg','JPG','JPEG');
$permitida = false;*/

/*for($var=0; $var<count($imageFormats);$var++){
  if($imageFormats[$var]===$ext){
     $permitida = true;
     break;
  }  
}*/

$limitImg = 1048576 * 2;

/*
$ojo = new ojociudadanoTable();
$ojo->order="creacion";
$rows = $ojo->readDataFilter("estado = 'A'");
for($i=0;$i<count($rows);$i++) {
    $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
}

$noti = new minoticiaTable;
$nportada = $noti->readDataFilter("minoticia.ubicacion = 'L' OR minoticia.ubicacion = 'M' OR minoticia.ubicacion = 'S'");
$smarty->assign("noticiasportada", $nportada);

$smarty->assign("ojociudadano", $rows);*/
$tpl = "minoticia/enviofoto.tpl";

if(!isset($_SESION['idusuario']) && empty($_SESSION['idusuario'])){
  header("Location: /minoticia/entrar");
}

              if(!empty($_POST)){
                if(empty($_POST["texto"])){
                      $smarty->assign("msg", "No introdujo una descripcion para su fotografia:");
                }elseif($_FILES['fotominoticia']['size']>$limitImg){
                      $smarty->assign("msg", "La foto seleccionada excede el tama&ntilde;o permitido. Por favor seleccione una foto con menor peso ");
                 }else{
                       $imag->readEnv();
                       $imag->request['credito'] = 'Foto enviada por nuestro lector: ' . $_REQUEST['user_sender'] . ' / Lugar: ' . $_REQUEST['lugartomafoto'] . ' Para la seccion: ' . $_REQUEST['seccion'];
                       $imag->request['texto'] = stripslashes($_REQUEST['texto']);
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

                       if($_REQUEST["seccion"] === 'Ojo Ciudadano'){
                         $ojo = new ojociudadanoTable;
                         $ojo->readEnv();
                         $ojo->request['ojociudadano'] = $_REQUEST["titulo"];
                         $ojo->request['texto'] = '<div class="na-media na-image-normal image-8" style="width: 300px"><img src="' . $imagenadjunta . '" width="397" height="200" />' . '<div class="info"><p>&nbsp;</p><p><strong>&nbsp;</strong>Foto enviada por nuestro lector: ' . $_POST['user_sender'] . '</p></div> </div><p>&nbsp;</p><p>&nbsp;</p>' . stripslashes($_REQUEST['texto']) . '<p>&nbsp;</p><p>' . $_REQUEST['lugartomafoto'] . '</p><p><b>Nota enviada por: ' . $_REQUEST['user_sender'] . '</b></p>';
                         $ojo->addRecord();
                       } 
                       $smarty->assign("enviada", true);
                     }
                   }

include("../classes/header-minoticia.inc.php");
$smarty->caching=false;
$smarty->assign("terminoscondiciones", $pagina->readRecord("6"));

$smarty->display($tpl);

$smarty->assign('enportada', true);
$smarty->display('minoticia/ultimasnoticiasuser.inc.tpl');
include("../classes/footer.inc.php");
?>
