<?php
include ('../classes/app.class.php');
$upload = return_bytes(ini_get('upload_max_filesize'));
$post = return_bytes(ini_get('post_max_size'));
$max_size = 0;
if($upload<$post)
  $max_size = $upload;
else $max_size = $post;
echo $max_size;

function return_bytes($val) {
  $val = trim($val);
  $last = strtolower(substr($val, -1));
  switch($last) {
    // The 'G' modifier is available since PHP 5.1.0
    case 'g':
      $val *= 1024;
    case 'm':
      $val *= 1024;
    case 'k':
      $val *= 1024;
  }
  return $val;
}

$smarty->display('index.tpl');
?>
