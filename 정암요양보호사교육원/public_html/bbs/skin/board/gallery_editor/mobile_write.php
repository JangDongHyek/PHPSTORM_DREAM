<?
/******************************************************************
 �� ���ϼ��� �� 
����ϴ�

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�

<?=$u_action?>				�۾��� URL
<?=$old_password?>		������ ���� ��ȣ
<?=$a_list?>					�۸�� ��ũ

<?=$show_notice_begin?>��������üũ<?=$show_notice_end?>
<?=$checked_notice?>	��������üũ����

<?=$show_secret_begin?>��б�üũ<?=$show_secret_end?>
<?=$checked_secret?>	��б�üũ����

<?=$show_reply_mail_begin?>����۸��Ϸιޱ⿩��<?=$show_reply_mail_end?>
<?=$checked_reply_mail?>	�����üũ����

<?=$show_name_begin?>�ۼ����Է�<?=$show_name_end?>
<?=$rg_name?>					�ۼ���

<?=$show_password_begin?>��ȣ�Է�<?=$show_password_end?>
<?=(!$mode_edit)?'required':''?>	�ۼ�����尡 �ƴ϶�� �ʼ��Է�

<?=$show_email_begin?>�����Է�<?=$show_email_end?>
<?=$rg_email?>				����

<?=$show_home_url_begin?>Ȩ�������Է�<?=$show_home_url_end?>
<?=$rg_home_url?>			Ȩü����

<?=$show_category_begin?>ī�װ�����<?=$show_category_end?>
<?=$category_list_option?>	ī�װ����

<?=$show_html_begin?>	html ���¼���<?=$show_html_end?>
<?=$checked_html_use0?>	�Ϲݱ�üũ
<?=$checked_html_use1?>	htmlüũ
<?=$checked_html_use2?>	html+üũ

<?=$rg_title?>				����
<?=$rg_content?>			����
<?=$show_link_begin?>	��ũ�Է���<?=$show_link_end?>
<?=$rg_link1_url?>		��ũ#1
<?=$rg_link2_url?>		��ũ#2

<?=$show_upload_begin?>���ε���<?=$show_upload_end?>

<?=$show_file1_delete_begin?>���ϻ���<?=$show_file1_delete_end?>
<?=$rg_file1_name?>		���ϸ�
(1~2)

<?=$show_file1_size_begin?>�ִ���ε�뷮<?=$show_file1_size_end?>
<?=$upload_file1_size?>	�ִ���ε�뷮

<?=$show_file1_ext_begin?>���ε�Ȯ����<?=$show_file1_ext_end?>
<?=$upload_file1_ext?>	���ε�Ȯ����
<?=($upload_file1_able)?'����':'�Ұ���'?>	���ε� ���ɿ���

<?=$show_ext1_begin?>�߰��׸�1<?=$show_ext1_end?>
<?=$show_ext1_title?>	�߰��׸��
<?=$show_ext1_input?>	�߰��׸��Է���
(1~5)

******************************************************************/
?>
<script type="text/javascript" src="<?=$skin_board_url?>js/picup.js"></script>
<script type="text/javascript" src="<?=$skin_board_url?>js/__MACOSX/._picup.js"></script>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>

		<span class="bbs_write_new">�����ۼ� (*)ǥ�ð� �ִ� �κ��� �ʼ��׸��Դϴ�.</span>
		<?=$show_secret_begin?>
		<div class="bbs_write">
			<span class="bbs_write_title">������&nbsp;&nbsp;</span>
			<span class="bbs_write_form">
			  <input name=rg_secret type=checkbox id="rg_secret" value='1' <?=$checked_secret?>>��б�
			</span>
		</div>
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title">* �ۼ���&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			  <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='�ۼ���' style=width:80%; class="b_input">
			</span>
		</div>
	<?=$show_password_begin?>
	<div class="bbs_write">
		<span bgColor=#fafafa class="bbs_write_title">* ��й�ȣ&nbsp;&nbsp;</span>
		<span class="bbs_write_form">
		  <input name='rg_password' type=password style=width:80%;  id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='��ȣ' class="b_input">
		</span>
	</div>
	<?=$show_password_end?>
<?/*
	<?=$show_email_begin?>
	<div class="bbs_write">
		<span bgColor=#fafafa class="bbs_write_title">�̸���&nbsp;&nbsp;</span>
		<span class="bbs_write_form">
			<input name='rg_email' type=text style=width:80%; id="rg_email" value='<?=$rg_email?>'  maxlength=100 email itemname='e-mail' class="b_input">
		</span></br>
	</div>				
	<?=$show_email_end?>

	<?=$show_home_url_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title">Ȩ������&nbsp;&nbsp;</span>
		<span class="bbs_write_form">
			<input name='rg_home_url' type=text style=width:80%;  id="rg_home_url"  value='<?=$rg_home_url?>' itemname='Ȩ������' class="b_input">
		</span>
	</div>
	<?=$show_home_url_end?>
*/?>
	<?=$show_category_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title">* �з�&nbsp;&nbsp;</span>
		<span class="bbs_write_form"> 
			<select name=rg_cat_num id="rg_cat_num" required itemname='�з�'>
				<option value=''>�����ϼ���.</option>
				<?=$category_list_option?>
		    </select>
		</span>	</div>		
	<?=$show_category_end?>
	
	<div class="bbs_write">
		<span class="bbs_write_title">* ����&nbsp;&nbsp;</span>
		<span class="bbs_write_form">  
			<input name='rg_title' type=text style=width:80%; id="rg_title"  value='<?=$rg_title?>' required itemname='����' class="b_input">
		</span>
	</div>

		<div class="bbs_write_content">
			<span  class="bbs_write_ctitle" style=cursor:hand>* ����&nbsp;&nbsp;</span>
			 <span class="bbs_write_cform"> <textarea name="rg_content" id="rg_content"  style=width:80%;height:98px class="b_textarea" required itemname='����'><?=$rg_content?></textarea> <img width="1" height="1"></span>
		 </div>
		 <?=$show_link_begin?>
		 <div class="bbs_write">
		<span class="bbs_write_title">��ũ #1&nbsp;&nbsp;</span>
	    <span class="bbs_write_form">  <input name='rg_link1_url' type=text style=width:80%; id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='��ũ #1' class="b_input"></span>
		</div>
		<div class="bbs_write">
		<span class="bbs_write_title">��ũ #2&nbsp;&nbsp;</span>
		<span class="bbs_write_form">
			<input name='rg_link2_url' type=text style=width:80%; id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='��ũ #2' class="b_input">
        </span>
		</div>
<?=$show_link_end?>
<?=$show_ext1_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext1_title?>&nbsp;&nbsp;</span>
		<span class="bbs_write_form"> <?=$show_ext1_input?></span>
	</div>
<?=$show_ext1_end?>
<?=$show_ext2_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext2_title?>&nbsp;&nbsp;</span>
		<span class="bbs_write_form"> <?=$show_ext2_input?></span>
	</div>
<?=$show_ext2_end?>
<?=$show_ext3_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext3_title?> | </span>
		<span class="bbs_write_form"> <?=$show_ext3_input?></span>
	</div>
<?=$show_ext3_end?>
<?=$show_ext4_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext4_title?> | </span>
		<span class="bbs_write_form"> <?=$show_ext4_input?></span>
	</div>
<?=$show_ext4_end?>
<?=$show_ext5_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext5_title?> | </span>
		<span class="bbs_write_form"> <?=$show_ext5_input?></span>
	</div>
<?=$show_ext5_end?>
<?=$show_upload_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title">÷��ȭ�� #1 | </span>
		<span class="bbs_write_form">
			<input name='rg_file1' type=file style=width:80%;height:22; class=b_input id="rg_file1"  itemname='���� #1'> 
			<?=$show_file1_delete_begin?><input name='del_file1' type=checkbox id="del_file1" value='1'>
                ���� ( <?=$rg_file1_name?> ) 
		    <?=$show_file1_delete_end?>
        </span>
	</div>
	<div class="bbs_write">
		<span class="bbs_write_title">÷��ȭ�� #2 | </span>
		<span class="bbs_write_form">
			<input name='rg_file2' type=file style=width:80%;height:22; class=b_input id="rg_file2"  itemname='���� #2'>
          <?=$show_file2_delete_begin?> <input name='del_file2' type=checkbox id="del_file2" value='1'>
		  ���� ( <?=$rg_file2_name?> ) 
		  <?=$show_file2_delete_end?>
	    </span>	
	</div>	
	<?=$show_upload_end?>
	<? /*if(preg_match('/iPhone|iPod|iPad/i',$_SERVER['HTTP_USER_AGENT'])){
	<div class="bbs_write">
		<span class="bbs_write_title">�������� ���| </span>
		<span class="bbs_write_form">
			Picup <a href="http://itunes.apple.com/us/app/picup/id354101378?mt=8
" target="_blank">��ġ</a>
	    </span>	
	</div>
	 }*/?>
	<span class="bbs_write_new"><INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </span>
</form>

