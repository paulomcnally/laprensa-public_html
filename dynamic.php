<?php
require ('../classes/app.class.php');
$file = ROOTDIR . '/scripts/videos.txt';
$nvideo = $_POST['videoname'];
chmod(ROOTDIR . '/files/videominoticia/' . $nvideo, 0777);

$filename = ROOTDIR . "/files/videominoticia/" . $nvideo;
$filelog = ROOTDIR . '/scripts/videos.txt';
if(file_exists($filename) && file_exists($filelog) && is_writable($filelog)) {
   $handle = fopen($filelog, 'a');
   fwrite($handle, $filename . "\n");
   fclose($handle);
   } elseif(!file_exists($filelog) || !is_writable($filelog)) {
   error_log("Error File: this does not exist or is not writable");
}

exec(ROOTDIR . '/scripts/sh create_thumbfp.sh');
?>
