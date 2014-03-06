<?php
define ('ADMIN',true);
require( dirname(__FILE__) . '/app.class.php');
require_once("/www/cms/php/image.class.php");

//$tables = array('caricatura','imagen');//foto','autor','autorblog','fotogaleria');
$tables = array('imagen');//foto','autor','autorblog','fotogaleria');
//$tables = array('pais','marcador');//foto','autor','autorblog','fotogaleria');
//$tables = array('edicionsuplemento');//foto','autor','autorblog','fotogaleria');
$imagen = new almImage();
foreach($tables as $table) {
  $table .= 'Table';
  echo $table;
  $data = new $table;
  //$rows = $data->readData();
  $rows = $data->readDataFilter("imagen.idedicion = 101");
  foreach($rows as $row) {
    foreach($data->definition as $column) {
      if ($column['type'] == 'image' && $row[$column['name']] && $column['extra']['sizes']) {
         echo "Archivo: (".$row[$data->key].")".$row[$column['name']]."\n";
         $pos = strpos($row[$column['name']],'_');
         $timemark = substr($row[$column['name']],0,$pos);
         $timemark = getdate($timemark);
         echo "Fecha: $timemark[0] = ".date("Y/m",$timemark[0])."\n";
         $sizes = explode(',',$column['extra']['sizes']);
         $filename = $row[$column['name']];
         if(isset($sizes))  {
           if ($timemark['mon']<10) $timemark['mon'] = "0" . $timemark['mon'];
           // Comprueba que existan los directorios y sino
           // los crea
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
               } else echo "$thumbf -> Done!\n";
             }
         }
      } 
    }
  }
}
?>
