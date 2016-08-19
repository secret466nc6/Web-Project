WWW Technologies and Applications 2016
Final Project Food Delivery
NAME : Shun Zhi, Lin
CCU ID: 604410071
Link : http://dmplus.cs.ccu.edu.tw:49308/delivery/index.php
Email：secret466nc6@gmail.com
Project Name : Food Delivery

html files:
	[index.php]: 首頁，提供訂單功能
	[logout.php]: 登出
	[connMysql.php]:MySQL帳號登入，Table創建
	[detail.php]:選擇訂購數量與累積價錢
	[detail_chi.php]:訂單傳入MYSQL
	[detail_delete.php]:取消訂購
	[manage.php]:管理自己發布的訂單
	[manage_detail.php]:查看所有訂單狀況與所有累積價錢
	[manage_detail_chi.php]:處理完成表單，送出後就不會出現在首頁號召
	[manage_detail_delete.php]:刪除此訂單
	[menu.php]:管理或新增Menu
	[menu_cgi.php]:新增Menu使用
	[menu_delte_.php]:刪除Menu使用
	[order.php]:號召訂單功能
	[order_chi.php]:送出訂單
	[register.php]:註冊
	[register_cgi.php]:註冊送出傳入MYSQL
	[sign.php]:登入
	[sign_cgi.php]:判斷是否有重複
css files:
	[styles.css]: 一般 css file.
	[bootstrap.css]: bootstrap css file.
	[signin.css]: 登入註冊畫面 css file.

附加檔案:

	**[WWW_Final_Proj_Delivery.pptx]:附上Powerpoint檔案解說使用方式
	**[Database欄位說明.docx]:附上Database欄位說明之WORD檔案
	
note:

*Tools
html,css,javascript,jquery,ajax,mysql,php
*Framework
bootstrap


主要功能說明:

能夠事先存入要訂購的MENU菜單，然後發起號召訂購，給不同的使用者選擇欲訂購的數量，
最後統計給發起人，再統一撥打電話叫外送。
另外在訂單頁面可以使用Facebook分享訂單，來更快的傳達訂購資訊。