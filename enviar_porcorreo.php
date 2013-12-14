<?
require('../classes/app.class.php');
$to = $_REQUEST['to'];
if ($to) {
  $url = 'http://www.laprensa.com.ni/porcorreo.php';
  $fh = fopen($url,"r") or die("No se pudo abrir $url");
  while (!feof ($fh))
    $html .= fgets($fh, 4096);
  fclose ($fh);
  preg_match("/<title>(.*?)<\/title>/", $html, $matches);
  $subject = $matches[1];
  $subject = preg_replace('/ú/','u',$subject);
  $subject = preg_replace('/&uacute;/','u',$subject);
  $message = $html;
  $message = iconv("UTF-8", "ISO-8859-1", $html);
  $headers = 'From: La Prensa <info@laprensa.com.ni>' . "\r\n";
  $headers .= 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
  mail($to, $subject, $message, $headers);
} else {
  $smarty->assign('nada', true);
}
$smarty->display('enviar_porcorreo.tpl');
?>
