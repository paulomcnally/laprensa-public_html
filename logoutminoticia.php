<?php
require("../classes/app.class.php");
 unset($_SESSION["idusuario"]);
 unset($_SESSION["usuario"]);
 unset($_SESSION["nombre"]);
 unset($_SESSION["apellido"]);
 unset($_SESSION["correo"]);
 session_unset();
 header("Location: /minoticia");
?>
