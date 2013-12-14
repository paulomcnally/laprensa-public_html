<?php
        #$to = str_replace(array("\r\n", "\n", "\r"),',',MAGAZINE_EMAILS);
        $lista="";
        $strHTML = '
          <div style="text-align:left;font-size:11px;font-family:Arial, sans-serif">
          <br />
          <br />
          <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Confirmacion de Suscripcion de MAGAZINE</h1>
          <br />
          El usuario Armando Calero Sequeira ha realizado el pago en linea de la revista Magazine
          <br />
          Fecha de creacion: 2012-06-28 - Periodo en meses: 12
          <br />
          Direccion de correo asociada al usuario *calero.armando@gmail.com*
          <br />
          <br />
          <br />
          <br />
          Por favor Guardar estos correos para que sean de soporte de la suscripcion a MAGAZINE ONLINE
          <br />
          Saludos,<br/>
          info@laprensa.com.ni<br/>
          </div>';
        $subject = 'Magazine - Nueva suscripcion';
        $subject = preg_replace('/ú/','u',$subject);
        $subject = preg_replace('/&uacute;/','u',$subject);
        $headers = 'From: info@laprensa.com.ni' . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
        mail('collado@laprensa.com.ni', $subject, $strHTML, $headers);
        mail('mauricio.urroz@laprensa.com.ni', $subject, $strHTML, $headers);
        mail('valeria.mayorga@laprensa.com.ni', $subject, $strHTML, $headers);
        mail('juan.martinez@laprensa.com.ni', $subject, $strHTML, $headers);
        mail('fabian-medina@laprensa.com.ni', $subject, $strHTML, $headers);
        mail('maribel@guegue.net', $subject, $strHTML, $headers);


?>


