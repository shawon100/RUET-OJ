<?php

session_start();

unset($_SESSION['un']);
unset($_SESSION['url']);

header("Location:login.php");





?>