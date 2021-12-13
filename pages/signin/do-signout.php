<?php
include_once('../var.php');
session_start();

unset($_SESSION['status']);

header("Location: $url_page_signin");
die();
