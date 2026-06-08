<?php
    error_reporting(0);
    session_start();
    if (!$_SESSION["id"]) {
        echo "please login first";
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else{
        // 1. 建立資料庫連線：("主機IP", "帳號", "密碼", "資料庫名稱")
        $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");
        // 2. 建立 SQL 查詢字串：從 bulletin 資料表中，依據網址傳來的佈告編號（bid）找出該篇公告
        $result=mysqli_query($conn, "select * from bulletin where bid={$_GET["bid"]}");
        // 3. 從查詢結果中擷取出一筆資料，並轉換成關聯陣列存入 $row 變數中
        $row=mysqli_fetch_array($result);
        // 4. 初始化三個變數，用來控制 HTML 單選鈕（radio）的勾選狀態（預設皆為空字串，即不勾選）
        $checked1="";
        $checked2="";
        $checked3="";
        // 5. 根據資料庫中存的佈告類型（type），決定哪一個單選鈕要加上 "checked"（代表預先勾選）
        if ($row['type']==1)
            $checked1="checked";
        if ($row['type']==2)
            $checked2="checked";
        if ($row['type']==3)
            $checked3="checked";
        // 6. 輸出 HTML 修改表單，並將舊資料與勾選狀態自動帶入
        echo "
        <html>
            <head><title>新增佈告</title></head>
            <body>
                <form method=post action=27.bulletin_edit.php>
                    佈告編號：{$row['bid']}<input type=hidden name=bid value={$row['bid']}><br>
                    標    題：<input type=text name=title value={$row['title']}><br>
                    內    容：<br><textarea name=content rows=20 cols=20>{$row['content']}</textarea><br>
                    佈告類型：<input type=radio name=type value=1 {$checked1}>系上公告 
                            <input type=radio name=type value=2 {$checked2}>獲獎資訊
                            <input type=radio name=type value=3 {$checked3}>徵才資訊<br>
                    發布時間：<input type=date name=time value={$row['time']}><p></p>
                    <input type=submit value=修改佈告> <input type=reset value=清除>
                </form>
            </body>
        </html>
        ";
    }
?>
