<?php
    error_reporting(0);
    session_start();
    if (!$_SESSION["id"]) {// 檢查 Session 中是否【沒有】紀錄使用者的帳號 ("id")
        echo "please login first";// 如果未登入，顯示英文提示訊息「請先登入」
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";// 在 3 秒後自動重導向（跳轉）到 2.login.html 登入頁面
    }
    // 如果使用者已經登入，則執行以下區塊
    else{
        // 輸出 HTML 表單，讓已登入的使用者填寫佈告資料
        echo "
        <html>
            <head><title>新增佈告</title></head>
            <body>
                <form method=post action=23.bulletin_add.php>
                    標    題：<input type=text name=title><br>
                    內    容：<br><textarea name=content rows=20 cols=20></textarea><br>
                    佈告類型：<input type=radio name=type value=1>系上公告 
                            <input type=radio name=type value=2>獲獎資訊
                            <input type=radio name=type value=3>徵才資訊<br>
                    發布時間：<input type=date name=time><p></p>
                    <input type=submit value=新增佈告> <input type=reset value=清除>
                </form>
            </body>
        </html>
        ";
    }
?>
