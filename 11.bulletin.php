<?php
    error_reporting(0);// 1. 關閉錯誤回報（正式上線時常用，避免使用者看到系統報錯訊息）
    session_start();// 2. 啟動 Session，準備讀取之前登入時存下的資料
    if (!$_SESSION["id"]){// 3. 權限檢查：判斷 Session 中有沒有存放 "id"
        echo "請先登入";// 如果沒登入過，提示請登入，並在 3 秒後跳轉回登入頁面
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else{// 【已登入狀態，開始執行主程式】
        // 4. 顯示歡迎訊息與功能選單 (登出、管理使用者、新增佈告)
        echo "歡迎, ".$_SESSION["id"]."[<a href=12.logout.php>登出</a>] [<a href=18.user.php>管理使用者</a>] [<a href=22.bulletin_add_form.php>新增佈告</a>]<br>";
        $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");// 5. 建立資料庫連線
        $result=mysqli_query($conn, "select * from bulletin");// 6. 執行 SQL 查詢：抓取 'bulletin' 資料表中所有的佈告資料
        echo "<table border=2><tr><td></td><td>佈告編號</td><td>佈告類別</td><td>標題</td><td>佈告內容</td><td>發佈時間</td></tr>";// 7. 印出 HTML 表格標籤與標題列
        while ($row=mysqli_fetch_array($result)){// 8. 使用迴圈逐筆取出佈告資料，並塞進表格欄位中
            echo "<tr><td><a href=26.bulletin_edit_form.php?bid={$row["bid"]}>修改</a>
            // 產生「修改」與「刪除」的連結，並透過網址傳遞該筆資料的編號 (bid)
            <a href=28.bulletin_delete.php?bid={$row["bid"]}>刪除</a></td><td>";
            // 依序填入資料庫的各個欄位值  
            echo $row["bid"];
            echo "</td><td>";
            echo $row["type"];
            echo "</td><td>"; 
            echo $row["title"];
            echo "</td><td>";
            echo $row["content"]; 
            echo "</td><td>";
            echo $row["time"];
            echo "</td></tr>";
        }
        // 9. 迴圈結束後，關閉表格標籤
        echo "</table>";    
    }
 
