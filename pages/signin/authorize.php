<?php
// 檢查後台登入權限 
if (empty($_SESSION['admin']))
    header('Location: ./signin.php');
