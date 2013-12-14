<?php
session_start();
$md5 = md5(microtime() * mktime());
$string = substr($md5,0,5);
$captcha = imagecreate(55,20);
$white = imagecolorallocate($captcha, 255, 255, 255);
$black = imagecolorallocate($captcha, 0, 0, 0);
$line = imagecolorallocate($captcha,233,239,239);
imageline($captcha,0,0,39,29,$line);
imageline($captcha,40,0,64,29,$line);
imagestring($captcha, 5, 5, 2, $string, $black);
$_SESSION['key'] = md5($string);
header("Content-type: image/png");
imagepng($captcha);
?>
