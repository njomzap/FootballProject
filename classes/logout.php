<?php

session_start();

$_SESSION = array();

session_destroy();

header("Location: ../nav-bar/login.php");
exit();
