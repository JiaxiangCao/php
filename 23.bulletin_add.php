<?php
    error_reporting(0);
    session_start();
    if (!$_SESSION["id"]) {
        echo "please login first";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else{// 如果已經登入，則執行以下資料庫新增流程
        // 建立資料庫連線，參數依序為：("主機IP", "帳號", "密碼", "資料庫名稱")
        $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
        // 建立 SQL 新增字串：
        // 指定寫入 bulletin 資料表中的對應欄位 (title, content, type, time)
        // 其值（values）分別對應接收自表單的：標題、內容、類型、發布時間
        $sql="insert into bulletin(title, content, type, time) 
        values('{$_POST['title']}','{$_POST['content']}', {$_POST['type']},'{$_POST['time']}')";
        if (!mysqli_query($conn, $sql)){// 執行 SQL 新增指令，並檢查執行是否【失敗】（前面有驚嘆號 !）
            echo "新增命令錯誤";// 如果執行失敗（例如資料庫斷線、欄位對錯位置或型態不符），顯示錯誤訊息
        }
        else{// 如果 SQL 指令執行成功
            echo "新增佈告成功，三秒鐘後回到網頁";// 顯示成功訊息
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";// 在 3 秒後自動重導向（跳轉）到 11.bulletin.php 佈告首頁列表
        }
    }
?>
