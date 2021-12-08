- index.php 左側分頁選單按鈕不會因應頁面變換而變換底色
    > 查找 js 事件處理器？
    > .active .bg....
- index.php breadcrumb 不會因應頁面變換而變化
    > 查找 js 事件處理器？
- 查詢 PHP Debugger

- 如何指定絕對路徑跟目錄 ?  
- require_once 重複呼叫出問題？

- header: 可以接受實際路徑
    > 為什麼 header 不能用相對路徑導向上層資料夾？
    > header 後面的代碼也會跑
    > 絕對路徑寫法一定可以 http://localhost/colorful-room/....
    > 單獨頁面可以跳轉，include 就不行


問題集
---
## include 和 require 差別？
    > 都是將檔案內容拷貝，require 發生錯誤時產生致命錯誤，不會往下執行，include 則相反。    

## 絕對路徑？
    > `/` 直接斜線呼叫即可，在 XAMPP 環境 `/` 表示 `htdocs` 資料夾。

## header() 時常出錯問題？
    > 整理 2 點結果：header 前方不能有任何輸出（網頁標籤（包含空白行）、echo ?）；header 有時會執行後方程式碼，需加上 die() or exit()

## 


進行中
---
- sign out 按鈕
- product
    - 上下架：建表、寫內碼
    - 查詢顯示
    - header(上傳檔案)

- member
    - 搜尋功能

- order
    - 拉資料庫資料


