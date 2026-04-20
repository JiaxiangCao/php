<?php
    #mysqli_connect() 建立資料庫連結
    $conn=mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");// 1. 建立資料庫連線 (參數：伺服器位址, 帳號, 密碼, 資料庫名稱)
    #mysqli_query() 從資料庫查詢資料
    $result=mysqli_query($conn, "select * from user");// 2. 執行 SQL 查詢：從 'user' 資料表中抓取所有使用者的帳密資料
    #mysqli_fetch_array() 從查詢出來的資料一筆一筆抓出來
    $login=FALSE;// 3. 初始化登入狀態，預設為 False (未登入)
    while ($row=mysqli_fetch_array($result)) {// 判斷使用者輸入的 id 與 pwd 是否與資料庫中的某一行資料完全吻合
        if (($_POST["id"]==$row["id"]) && ($_POST["pwd"]==$row["pwd"])) {
            $login=TRUE;// 驗證成功，將登入狀態設為 True
        }
    } 
    // 5. 根據驗證結果執行動作
   if ($login==TRUE) { // 【登入成功】
        session_start();// 啟動 Session 功能
        $_SESSION["id"]=$_POST["id"];// 將使用者的 ID 存入 Session 紀錄登入狀態
        echo "登入成功";// 3秒後自動跳轉到公告頁面 (11.bulletin.php)
        echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
    }
 
    else{
        echo "帳號/密碼 錯誤";// 【登入失敗】
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";// 3秒後自動跳轉回登入頁面 (2.login.html)
    }
?>
