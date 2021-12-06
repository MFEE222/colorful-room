<?php
session_start();

// 檢查登入狀態
if (empty($_SESSION['admin']))
    header('Location: ./signin.php');
