<?php

    error_reporting(0);
    session_start();
    if (!$_SESSION["id"]) {
        echo "請登入帳號";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else{   // 如果已經登入，則執行以下資料庫更新流程
        // 建立資料庫連線，參數依序為：("主機IP", "帳號", "密碼", "資料庫名稱")
        $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
        // 執行 SQL 更新指令
        // 去 bulletin 資料表，更新 title、content、time、type 的值為表單傳過來的新資料
        if (!mysqli_query($conn, "update bulletin set title='{$_POST['title']}',content='{$_POST['content']}',time='{$_POST['time']}',type={$_POST['type']} where bid='{$_POST['bid']}'")){
            echo "修改錯誤";// 如果執行失敗（例如資料庫斷線或語法錯誤），顯示錯誤訊息
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";// 在 3 秒後自動導向回 11.bulletin.php 佈告列表頁面
        }else{// 如果 SQL 指令執行成功
            echo "修改成功，三秒鐘後回到佈告欄列表";// 顯示成功訊息
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";// 在 3 秒後自動導向回 11.bulletin.php 佈告列表頁面
        }
    }

?>
