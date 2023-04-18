<?php

session_start();

unset($_SESSION["usuario_email"]);
unset($_SESSION['usuario_id']);
header("Location:index.php");

die();