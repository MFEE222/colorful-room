待處理
---
## 優化訂單關鍵字 Keyword 搜尋功能
    - 使用空格即可鍵入多組關鍵字

## 優化訂單篩選器 Filter 功能
    - 增加日期區間選擇

## 商品上架頁
    - 檔案拖拉即可放置上傳區

## 會員 Member 和顧客 Customer 資料庫表單整合，並且在會員創建『註冊欄位 registered 』

## 訂單明細 Orders Detail 頁面區塊化，UI 調整

## 側邊功能欄位，使用 Fontawesome 調整 icon

## 優化登入頁面功能 Sign In
    - 增加記住我 Remember Me 功能
    - 增加密碼提示功能

## 總覽頁面，做商品銷量分析圖、客層分析圖... 等報告數據，和管理者資料設定...

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


