WWW Technologies and Applications 2016
HOMEWORK#5
NAME : Shun Zhi, Lin
CCU ID: 604410071
Link : http://dmplus.cs.ccu.edu.tw:49308/hw5/index.php

Project Name : HPC Lab meeting recorder

html files:
	[index.php]: �����A��ܩҦ��峹�B����B�^�Ц���
	[connMysql.php]:MySQL�b���n�J�ATable�Ы�
	**[create.php]:���U�b������
	[delete.php]:�ȭ��R���n�J�b�᪺�ҵo���峹
	**[edit.php]:�ȭ��s��n�J�b��ҵo���峹
	[login.php]:�n�J�e��
	[logout.php]:�n�X�\��
	**[post.php]:�o��\��(title�B�����Bcontent�B�ɮפW��)
	**[post_edit.php]:��s�o��W�Ǹ�Ʈw��php�{��
	**[post_upload.php]:�����o��W�Ǹ�Ʈw��php�{��
	[read.php]:�峹�����B���ѤU���B�d���O
	**[create_cgi.php]: �зs�b��AJAX�{�ҥ�
	[downloadfile.php]:�U���W�Ǥ��ɮץ\��
	[search.php]:�j�M�峹�\��(�i�j�M���D�B�@�̡B����)
	[setting.php]:�ۭq�����\��
	[setting-delete.php]:�����R���\��
	[setting-update.php]:�����ק�\��

css files:
	[styles.css]: hw3's css file.
	[table-styles.css]: table css file.


	
note:
(1)--How to avoid refreshing the page?
�bbody�����O�_�����UF5�A�è�����\��
body onkeydown="if (event.keyCode=='116') {event.keyCode=0;event.returnValue=false;} ">
(2)--Explain how you implement the AJAX.
[edit.php] 38~83�� �ϥ�GoajaxEdit ()�z�LAJAX�ǻ���� -> [post_edit.php]�������
[post.php] 20~71�� �ϥ�GoajaxPost ()�z�LAJAX�ǻ���� -> [post_update.php]�������
[create.php] 1~61��ϥ�GoajaxCreate ()�z�LAJAX�ǻ���� -> [create_chi.php]�������
(3)--List the les where JSON format are used. 
[edit.php] 13~25��NMysql����নJson�榡�è��Xedit article�һݭn��value
[edit.php] 68�� data:{title:title,content:content,check:strChoices,id:id},�s��ǻ����
[post.php] 54�� data:{title:title,content:content,check:strChoices,id:id},�s��ǻ����
[create.php] 38�� data:{name:name,email:email,password:password},�s��ǻ����
(4)--Tips
���U���U��|�u�X�����A�Y�i�������U
�æb�o��峹�[�J�i���s�边�\��C

(5)--�^�Oyoutube�v��:
�i�J��o��峹������A���U�a�y���Ϯ�(Iframe)
��Jyoutube���}�Mheight, width

�ݪ`�N���O���p�ҭn�^�O��youtube��https://www.youtube.com/watch?v=RBBCDwdMdng
���i�ϥΦ�URL
�ݦbyoutube�����I�����->�O�J->�o��U�C�@�q�{���X
<iframe width="560" height="315" src="https://www.youtube.com/embed/RBBCDwdMdng" frameborder="0" allowfullscreen></iframe>
���^���䤤��src�̭������}���ehttps://www.youtube.com/embed/RBBCDwdMdng
�ƻs�öK�W��URL�϶��A�Y�i�����O�J�v���\��C

(6)--��s�u��:
1.�ϥ�addslashes()���קKSQL injeciton
2.main,article,create,edit page all in one page.
3.�峹��s/�^�з|�]��̤W��