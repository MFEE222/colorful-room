<?php
function ecbo($m)
{
    echo $m . '<br>';
}
// 檔案跟目錄 e.q. /Application/...
ecbo($_SERVER['DOCUMENT_ROOT']);
// 網頁伺服器名稱 e.q. localhost
ecbo($_SERVER['SERVER_NAME']);
// 當前檔案相對路徑
ecbo($_SERVER['PHP_SELF']);
