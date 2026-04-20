<html>
    <head><title>使用者管理</title></head>
    <body>
    <?php
        error_reporting(0);// 1. 隱藏所有錯誤訊息，避免將系統資訊暴露給使用者
        session_start();// 2. 啟動 Session 以讀取登入狀態
        // 3. 權限檢查：確認使用者是否已登入
        if (!$_SESSION["id"]) {
            // 若未登入，提示訊息並在 3 秒後跳轉回登入頁面
            echo "請登入帳號";
            echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
        }
        else{   
            // 【管理介面主體】
            // 4. 功能選單：連結到「新增使用者」與「回到佈告欄」
            // 5. 顯示使用者列表表格的表頭
                        echo "<h1>使用者管理</h1>
            [<a href=14.user_add_form.php>新增使用者</a>] [<a href=11.bulletin.php>回佈告欄列表</a>]<br>  
                <table border=1>
                    <tr><td></td><td>帳號</td><td>密碼</td></tr>";
            // 6. 建立資料庫連線
            $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
            // 7. 執行 SQL 查詢：抓取 'user' 資料表中所有的帳號密碼
            $result=mysqli_query($conn, "select * from user");
            // 8. 使用迴圈逐筆讀取使用者資料
            while ($row=mysqli_fetch_array($result)){
                // 9. 動態產生「修改」與「刪除」的連結，並帶入該位使用者的 id 作為參數
                // 10. 顯示使用者的 ID (帳號)
                // 11. 顯示使用者的密碼 (注意：實務上密碼通常會加密，不會直接顯示明文)
                echo "<tr><td><a href=19.user_edit_form.php?id={$row['id']}>修改</a>||<a href=17.user_delete.php?id={$row['id']}>刪除</a></td><td>{$row['id']}</td><td>{$row['pwd']}</td></tr>";
            }
            // 12. 結束表格標籤
            echo "</table>";
        }
    ?> 
    </body>
</html>
