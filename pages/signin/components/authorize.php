<?php
// 檢查後台登入權限 
if (empty($_SESSION['back_user']))
    header('location: /pages/signin.php');
