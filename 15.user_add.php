<?php

error_reporting(0);// 關閉錯誤報告（隱藏所有錯誤與警告訊息，正式上線時常用）
session_start();// 啟用或初始化 Session 機制，用來檢查使用者的登入狀態#// 檢查 Session 中是否【沒有】紀錄使用者的帳號 ("id")
if (!$_SESSION["id"]) { // 檢查 Session 中是否【沒有】紀錄使用者的帳號 ("id")
    echo "請登入帳號"; #/ 如果未登入，顯示提示訊息
    echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>"; #// 在 3 秒後自動重導向（跳轉）到 2.login.html 登入頁面
}
else{    

   //mysqli_connect() 建立資料庫連結
   $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
   //mysqli_query() 從資料庫查詢資料
   //新增資料SQL命令：insert into 表格名稱(欄位1,欄位2) values(欄位1的值,欄位2的值)
   $sql="insert into user(id,pwd) values('{$_POST['id']}', '{$_POST['pwd']}')";
   //echo $sql;
   if (!mysqli_query($conn, $sql)) { #// 執行 SQL 指令，並檢查執行是否【失敗】
     echo "新增命令錯誤"; #// 如果執行失敗
   }
   // 如果 SQL 指令執行成功
   else{
     echo "新增使用者成功，三秒鐘後回到網頁"; // 顯示成功訊息
     echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>"; // 在 3 秒後自動重導向（跳轉）到 18.user.php 使用者列表頁面
   }
}
?>
