# hpclabmeeting
hpclabmeeting

Project Name : HPC Lab Meeting Slides Database

html files:

[index.php]: 首頁，顯示所有文章、日期、回覆次數

[connMysql.php]:MySQL帳號登入，Table創建

[create.php]:註冊帳號頁面

[delete.php]:僅限刪除登入帳戶的所發的文章

[edit.php]:僅限編輯登入帳戶所發的文章

[login.php]:登入畫面

[logout.php]:登出功能

[post.php]:發文功能(title、分類、content、檔案上傳)

[post_edit.php]:更新發文上傳資料庫之php程式

[post_upload.php]:首次發文上傳資料庫之php程式

[read.php]:文章頁面、提供下載、留言板
css files:

[styles.css]:css file.

[table-styles.css]: table css file.
other function:

[downloadfile.php]:下載上傳之檔案功能

[search.php]:搜尋文章功能(可搜尋標題、作者、分類)

[setting.php]:自訂分類功能

[setting-delete.php]:分類刪除功能

[setting-update.php]:分類修改功能
note:

此網站能夠同時上傳Paper(pdf)檔案和投影片(ppt)檔案， 在閱讀頁面也可供user下載， 右上方設定按鈕提供自訂分類功能， 將user所自訂的分類放入發文介面中供選擇(可複選)， 之後可以使用標題、分類、作者來搜尋文章。 右上方顯示作者名稱，點擊連結到作者個人所有文章， 作者僅可刪除、編輯自己的文章。

test方法:

1.註冊帳號

2.登入帳號

3.點右上方按鈕設定文章可選擇分類

4.新增文章

5.在文章底下留言

6.刪除或編輯自己的文章

7.註冊新帳號並登入

8.留言或新增文章

9.搜尋文章功能測試

10.點選右上方名稱顯示個人所有文章