<?php
class comentariobanTable extends Table {
  function comentariobanTable() {
    $this->Table('comentarioban');
    $this->title = 'Comentarios Baneados';
    $this->order = 'creacion';
    $this->key = 'idcomentario';
    $this->add = false;
    # Filtramos solo por los comentarios de las noticias pertenecientes a la edicion
    $this->filter = 'comentarioban.idnoticia IN (SELECT idnoticia FROM noticia WHERE idedicion = ' . $_SESSION['admin']['edicion']['idedicion'] . ')';
    #
    $this->addColumn('idcomentario','serial',0,1,0,'Id');
    $this->addColumn('idnoticia','int',0,0,'noticia','Noticia',array('readonly'=>true,));
    $this->addColumn('nombre','varchar',50,0,0,'Nombre');
    $this->addColumn('email','varchar',50,0,0,'Email');
    $this->addColumn('web','varchar',300,0,0,'Página Web');
    $this->addColumn('comentario','text',0,0,0,'Texto');
    $this->addColumn('estado','char',1,0,0,'Estado',array('arr_values'=>array('R'=>'en Revisión','B'=>'Bloqueado','A'=>'Aprobado')));
    $this->addColumn('idusuario','int',0,0,'usuario','Usuario',array('readonly'=>true));
    #$this->addColumn('razon','text',0,0,0,'Razón Bloqueo');
    $this->addColumn('ip','auto',0,0,0,'IP');
    $this->addColumn('creacion','auto',0,0,0,'Fecha Creación:');
  }
}

class comentariopeliculabanTable extends Table {
  function comentariopeliculabanTable() {
    $this->Table('comentariopeliculaban');
    $this->title = 'Comentarios Pelicula Baneados';
    $this->order = 'creacion';
    $this->key = 'idcomentariopelicula';
    $this->addColumn('idcomentariopelicula','serial',0,1,0,'Id');
    $this->addColumn('idpelicula','int',0,0,'pelicula','Pelicula',array('readonly'=>true));
    $this->addColumn('nombre','varchar',50,0,0,'Nombre');
    $this->addColumn('email','varchar',50,0,0,'Email');
    $this->addColumn('web','varchar',300,0,0,'Página Web');
    $this->addColumn('comentariopelicula','text',0,0,0,'Texto');
    $this->addColumn('estado','char',1,0,0,'Estado',array('arr_values'=>array('R'=>'en Revisión','B'=>'Bloqueado','A'=>'Aprobado')));
    $this->addColumn('idusuario','int',0,0,'usuario','Usuario',array('readonly'=>true));
    $this->addColumn('ip','auto',0,0,0,'IP');
    $this->addColumn('creacion','auto',0,0,0,'Fecha Creación:');
  }
}
function getNews(){
 global $DSN;
 $DSN = DSNMINOTICIA;
 $lpminoticia = new lpminoticia_newsTable();
 $lpminoticia->order ='created DESC'; 
 $lpminoticia->limit =4; 
# return $lpminoticia->readDataSQL("SELECT news.id, news.title, news.body, upload.upload as img FROM lpminoticia_news news LEFT JOIN adminfiles_fileuploadreference ref  ON news.id =  ref.object_id LEFT JOIN adminfiles_fileupload upload ON ref.upload_id = upload.id WHERE published AND news.tags like 'Elecciones-2012' ORDER BY created DESC LIMIT 4");
return $lpminoticia->readDataSQL(" SELECT DISTINCT news.id, news.title,news.body, news.created, (SELECT upload.upload from adminfiles_fileuploadreference ref JOIN adminfiles_fileupload upload ON ref.upload_id = upload.id WHERE news.id =  ref.object_id LIMIT 1) as img FROM lpminoticia_news news WHERE published AND news.tags like '%Elecciones-2012%' ORDER BY news.created DESC LIMIT 4");

 #return $lpminoticia->readDataFilter("published");
 #return $lpminoticia->readDataFilter("tags like 'Elecciones-2012'");
}

class lpminoticia_newsTable extends Table {
  function lpminoticia_newsTable() {
    $this->Table('lpminoticia_news');
    $this->title = 'Noticias de LP Minoticia';
    $this->order = 'created';
    $this->key = 'id';
    $this->add = false;
    #$this->filter = 'tags like "Elecciones-2012"';
    $this->addColumn('id','serial',0,1,0,'Id');
    $this->addColumn('title','varchar',255,0,0,'Titulo');
    $this->addColumn('tags','varchar',255,0,0,'Etiquetas');
    $this->addColumn('slug','varchar',50,0,0,'Slug');
    $this->addColumn('body','text',0,0,0,'Texto');
    #$this->addColumn('author_id','int',0,0,'usuario','Usuario',array('readonly'=>true));
    $this->addColumn('featured','bool',0,0,0,'Destacado');
    $this->addColumn('published','bool',0,0,0,'Publicado');
    $this->addColumn('frontpage','bool',0,0,0,'En Portada');
  }
}

function writeFile($filename,$strArr,$mode='w') {
  $handle = fopen($filename,$mode);
  if (fwrite($handle, $strArr) === FALSE) {
    error_log(date("[D M d H:i:s Y]") . " Error: No se pudo escribir en el archivo -$filename-\n");
  }
  fclose($handle);
}

function cacheLog($str) {
  writeFile(ROOTDIR . '/logs/cache.log',date("[D M d H:i:s Y] ") . $str . "\n",'a');
}

function array2string($arr,$name) {
  $str = "<?\n# Generado ".date("d-m-Y H:i:s")."\n";
  if ( !empty($arr) )
    foreach($arr as $key => $val) {
      $str .= "\$" . $name . "['".addslashes($key)."'] = ";
      if ( is_array($val) ) {
        $str .= "array(";
        $j = count($val);
        $i = 1;
        foreach($val as $_k => $_v) {
          $str .= "'".addslashes($_k)."' => '".str_replace("\\\"","\"",addslashes($_v))."'" . ($i++ < $j?',':'');
        }
        $str .= ");\n";
      } else
        $str .= "$val;\n";
    }
  $str .= "?>";
  return $str;
}
?>
