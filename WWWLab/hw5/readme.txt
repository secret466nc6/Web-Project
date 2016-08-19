WWW Technologies and Applications 2016
HOMEWORK#5
NAME : Shun Zhi, Lin
CCU ID: 604410071
Link : http://dmplus.cs.ccu.edu.tw:49308/hw5/index.php

Project Name : HPC Lab meeting recorder

html files:
	[index.php]: 首頁，顯示所有文章、日期、回覆次數
	[connMysql.php]:MySQL帳號登入，Table創建
	**[create.php]:註冊帳號頁面
	[delete.php]:僅限刪除登入帳戶的所發的文章
	**[edit.php]:僅限編輯登入帳戶所發的文章
	[login.php]:登入畫面
	[logout.php]:登出功能
	**[post.php]:發文功能(title、分類、content、檔案上傳)
	**[post_edit.php]:更新發文上傳資料庫之php程式
	**[post_upload.php]:首次發文上傳資料庫之php程式
	[read.php]:文章頁面、提供下載、留言板
	**[create_cgi.php]: 創新帳號AJAX認證用
	[downloadfile.php]:下載上傳之檔案功能
	[search.php]:搜尋文章功能(可搜尋標題、作者、分類)
	[setting.php]:自訂分類功能
	[setting-delete.php]:分類刪除功能
	[setting-update.php]:分類修改功能

css files:
	[styles.css]: hw3's css file.
	[table-styles.css]: table css file.


	
note:
(1)--How to avoid refreshing the page?
在body偵測是否有按下F5，並取消其功能
body onkeydown="if (event.keyCode=='116') {event.keyCode=0;event.returnValue=false;} ">
(2)--Explain how you implement the AJAX.
[edit.php] 38~83行 使用GoajaxEdit ()透過AJAX傳遞資料 -> [post_edit.php]接收資料
[post.php] 20~71行 使用GoajaxPost ()透過AJAX傳遞資料 -> [post_update.php]接收資料
[create.php] 1~61行使用GoajaxCreate ()透過AJAX傳遞資料 -> [create_chi.php]接收資料
(3)--List the les where JSON format are used. 
[edit.php] 13~25行將Mysql資料轉成Json格式並取出edit article所需要的value
[edit.php] 68行 data:{title:title,content:content,check:strChoices,id:id},存放傳遞資料
[post.php] 54行 data:{title:title,content:content,check:strChoices,id:id},存放傳遞資料
[create.php] 38行 data:{name:name,email:email,password:password},存放傳遞資料
(4)--Tips
按下註冊後會彈出視窗，即可直接註冊
並在發表文章加入進階編輯器功能。

(5)--鑲嵌youtube影片:
進入到發表文章頁面後，按下地球的圖案(Iframe)
輸入youtube網址和height, width

需注意的是假如所要鑲嵌的youtube為https://www.youtube.com/watch?v=RBBCDwdMdng
不可使用此URL
需在youtube網站點選分享->嵌入->得到下列一段程式碼
<iframe width="560" height="315" src="https://www.youtube.com/embed/RBBCDwdMdng" frameborder="0" allowfullscreen></iframe>
並擷取其中的src裡面的網址內容https://www.youtube.com/embed/RBBCDwdMdng
複製並貼上至URL區塊，即可完成嵌入影片功能。

(6)--更新優化:
1.使用addslashes()來避免SQL injeciton
2.main,article,create,edit page all in one page.
3.文章更新/回覆會跑到最上面