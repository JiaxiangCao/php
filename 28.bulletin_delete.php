<?php
    error_reporting(0);
    session_start();
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else{   // 如果已經登入，則執行以下資料庫刪除流程
        // 建立資料庫連線，參數依序為：("主機IP", "帳號", "密碼", "資料庫名稱")
        $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
        // 建立 SQL 刪除字串：從 bulletin 資料表中，刪除 佈告編號（bid） 等於網址傳過來（$_GET['bid']）的那筆資料
        // 例如點擊的連結是 delete.php?bid=5，$_GET['bid'] 就會抓到 5 號公告
        $sql="delete from bulletin where bid='{$_GET["bid"]}'";
        #echo $sql; // （此行目前被註解，通常用於開發時檢查 SQL 語法拼得對不對）
        if (!mysqli_query($conn,$sql)){ // 執行 SQL 刪除指令，並檢查執行是否【失敗】（前面有驚嘆號 !）
            echo "佈告刪除錯誤";// 如果執行失敗，顯示錯誤訊息
        }else{// 如果 SQL 指令執行成功
            echo "佈告刪除成功";// 顯示成功訊息
        }// 不論刪除成功或失敗，最後都在 3 秒後自動重導向（跳轉）回 11.bulletin.php 佈告首頁列表
        echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
    }
?>
