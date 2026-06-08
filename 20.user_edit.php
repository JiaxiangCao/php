<?php

    error_reporting(0);// 關閉錯誤報告（隱藏所有錯誤與警告訊息）
    session_start();// 啟用或初始化 Session 機制，用來檢查使用者的登入狀態
    if (!$_SESSION["id"]) {// 檢查 Session 中是否【沒有】紀錄使用者的帳號 ("id")
        echo "請登入帳號";// 如果未登入，顯示提示訊息
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";// 在 3 秒後自動重導向（跳轉）到 2.login.html 登入頁面
    }
    else{  // 如果已經登入，則執行以下資料庫更新（修改）流程
        // 建立資料庫連線，參數依序為：("主機IP", "帳號", "密碼", "資料庫名稱")
        $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
        // 這裡直接執行 SQL 動作：去 user 資料表，把指定 id（表單傳過來的隱藏欄位 $_POST['id']）的密碼更新為新的密碼（$_POST['pwd']）
        if (!mysqli_query($conn, "update user set pwd='{$_POST['pwd']}' where id='{$_POST['id']}'")){
            echo "修改錯誤";// 如果執行失敗（例如資料庫斷線或語法錯誤），顯示錯誤訊息
            echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";// 在 3 秒後自動導向回 18.user.php 使用者列表頁面
        }else{// 如果 SQL 指令執行成功（成功更新密碼）
            echo "修改成功，三秒鐘後回到網頁";// 顯示成功訊息
            echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";// 在 3 秒後自動導向回 18.user.php 使用者列表頁面
        }
    }

?>
