<?php
session_start();
unset($_SESSION['logged']);
unset ($_SESSION['name']);
Header('Location:index.php');
?>