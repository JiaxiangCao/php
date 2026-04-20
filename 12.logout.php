<?php
    // 1. 啟動 Session
    // 即使是要登出，也要先啟動才能存取並清除現有的 Session 資料
    session_start();
    // 2. 移除特定的 Session 變數
    // 這裡將存放在伺服器端的 "id" 標記刪除，代表使用者不再是登入狀態
    unset($_SESSION["id"]);
    // 3. 顯示提示訊息給使用者
    echo "登出成功....";
    // 4. 自動跳轉頁面
    // 在 3 秒後自動將瀏覽器導向至登入頁面 (2.login.html)
    echo "<meta http-equiv=REFRESH content='3; url=2.login.html'>";
?>
