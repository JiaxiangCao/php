<?php
    error_reporting(0); // 關閉錯誤報告（隱藏所有錯誤與警告訊息）
    session_start(); // 啟用或初始化 Session 機制，用來檢查目前使用者的登入狀態
    if (!$_SESSION["id"]) { // 檢查 Session 中是否【沒有】紀錄使用者的帳號 ("id")
        echo "請登入帳號"; // 如果未登入，顯示提示訊息
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>"; #// 在 3 秒後自動重導向（跳轉）到 2.login.html 登入頁面
    }
    else{   // 如果已經登入，則執行以下資料庫刪除流程
        // 建立資料庫連線，參數依序為：("主機IP", "帳號", "密碼", "資料庫名稱")
        $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
        // 建立 SQL 刪除字串：從 user 資料表中，刪除 id 等於網址傳過來（$_GET['id']）的那筆資料
         // 例如網址是 delete.php?id=admin，$_GET['id'] 就會是 admin
        $sql="delete from user where id='{$_GET["id"]}'";
        echo $sql; #// （此行目前被註解，通常用於開發時檢查 SQL 語法拼得對不對）
        // 執行 SQL 刪除指令，並檢查執行是否【失敗】（前面有驚嘆號 !）
        if (!mysqli_query($conn,$sql)){
            echo "使用者刪除錯誤"; // 如果執行失敗，顯示錯誤訊息
        }else{ // 如果 SQL 指令執行成功
            echo "使用者刪除成功"; // 顯示成功訊息
        } // 不論刪除成功或失敗，最後都在 3 秒後自動重導向（跳轉）回 18.user.php 使用者列表網頁
        echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
    }
?>
