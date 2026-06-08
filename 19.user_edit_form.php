<html>
    <head><title>修改使用者</title></head>
    <body>
    <?php
    error_reporting(0);// 關閉錯誤報告
    session_start();// 啟用或初始化 Session 機制，用來檢查使用者的登入狀態
    if (!$_SESSION["id"]) {// 檢查 Session 中是否【沒有】紀錄使用者的帳號 ("id")
        echo "請登入帳號";// 如果未登入，顯示提示訊息
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";// 在 3 秒後自動重導向（跳轉）到 2.login.html 登入頁面
    }
    else{   // 如果已經登入，則執行以下「讀取舊資料並帶入表單」的流程
        // 1. 建立資料庫連線：("主機IP", "帳號", "密碼", "資料庫名稱")
        $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
        // 2. 建立 SQL 查詢字串：從 user 資料表中，找出 id 等於網址傳過來（$_GET['id']）的那筆使用者資料
        $result=mysqli_query($conn, "select * from user where id='{$_GET['id']}'");
        // 3. 從查詢結果中擷取出一筆資料，並轉換成關聯陣列（鍵值對）存入 $row 變數中
        $row=mysqli_fetch_array($result);
        // 4. 輸出 HTML 修改表單，並將舊資料自動填入對應的欄位中
        echo "
        <form method=post action=20.user_edit.php>
            <input type=hidden name=id value={$row['id']}>
            帳號：{$row['id']}<br> 
            密碼：<input type=text name=pwd value={$row['pwd']}><p></p>
            <input type=submit value=修改>
        </form>
        ";
    }
    ?>
    </body>
</html>
