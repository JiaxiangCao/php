<html>
    <head><title>新增使用者</title></head>
    <body>
<?php        
    error_reporting(0); //關閉錯誤報告
    session_start();#啟用或初始化 Session 機制，用來讀取或紀錄跨網頁的使用者登入狀態
    // 檢查 Session 中是否【沒有】紀錄使用者的帳號 ("id")
    if (!$_SESSION["id"]) {
        echo "請登入帳號";// 如果未登入，在畫面上顯示提示訊息
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";// 透過 HTML meta 標籤，在 3 秒後自動將網頁重導向（跳轉）到 2.login.html 登入頁面
    }
    else{  //如果使用者已經登入（Session 中有 "id"），則執行以下區塊
         // 輸出 HTML 表單，讓已登入的使用者填寫資料
    echo }
            <form action=15.user_add.php method=post>
                帳號：<input type=text name=id><br>
                密碼：<input type=text name=pwd><p></p>
                <input type=submit value=新增> <input type=reset value=清除>
            </form>
        ";
    }
?>
    </body>
</html>
