<?php
session_start();
session_destroy();
unset($_SESSION['pseudo']);
unset($_SESSION['iduser']);
header("location:login.php");
?>