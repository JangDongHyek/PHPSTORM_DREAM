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

<?=$show_name_begin?>�̸��Է�<?=$show_name_end?>
<?=$rg_name?>					�̸�

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
<Script language="javascript" src="../js/jquery-1.7.min.js"></script>
<script language="javascript">
	$(document).ready(function(){
		var $radio=$(".bbs_write_form input[type=radio]");
		$radio.click(function(){
			var $val=$radio.index(this)*10;
			$rg_cat_num=parseInt($("#rg_cat_num").attr("value"));
			if($val==0){
				document.getElementById("rg_cat_num2").value="";
				document.getElementById("rg_cat_num3").value="";
				document.getElementById("rg_cat_num4").value="";
			}else if($val==10){
				document.getElementById("rg_cat_num2").value=$rg_cat_num+$val;
				document.getElementById("rg_cat_num3").value="";
				document.getElementById("rg_cat_num4").value="";
			}else if($val==20){
				document.getElementById("rg_cat_num2").value=$rg_cat_num+10;
				document.getElementById("rg_cat_num3").value=$rg_cat_num+$val;
				document.getElementById("rg_cat_num4").value="";
			}else if($val==30){
				document.getElementById("rg_cat_num2").value=$rg_cat_num+10;
				document.getElementById("rg_cat_num3").value=$rg_cat_num+20;
				document.getElementById("rg_cat_num4").value=$rg_cat_num+$val;
			}
		});
	});

	function chk_Form(f){
		if(document.form_write.rg_title.value == ""){
			alert('����ó�� �Է����ּ���.');
			return false;
		}

		if(f.rg_ext2.value == ""){
			alert('�ο����� �������ּ���.');
			return false;
		}

		return true;
	}
</script>
<? 
	$bbs_category_table="rg_".$bbs_id."_category";
	$sql="select * from $bbs_category_table where cat_num='$rg_cat_num'";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	$cat_name=$rs[cat_name];
?>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onSubmit="return chk_Form(this);">
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="rg_cat_num" id="rg_cat_num" value="<?=$rg_cat_num?>">
<input type=hidden name=rg_ext5 value='<?=$rg_ext5?>'>
 <input name=rg_secret type=hidden id="rg_secret" value='1' <?=$checked_secret?>>
 <input type="hidden" name="rg_cat_num2" value="<?=$rg_cat_num2?>" id="rg_cat_num2">
<input type="hidden" name="rg_cat_num3" value="<?=$rg_cat_num3?>" id="rg_cat_num3">
<input type="hidden" name="rg_cat_num4" value="<?=$rg_cat_num4?>" id="rg_cat_num4">
<input type="hidden" name="rg_ext5" value="<?=$rg_ext5?>">
<input type="hidden" name="rg_content" value="1">
		<span class="bbs_write_new">�����ۼ� (*)ǥ�ð� �ִ� �κ��� �ʼ��׸��Դϴ�.</span>
		
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title">* �����ڸ�&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			  <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='�̸�' style=width:80%; class="b_input">
			</span>
		</div>
		
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title">* ����ó&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			   <input name='rg_title' type=text style=width:100%;height:22; class=b_input value='<?=$rg_title?>' maxlength=100>
			</span>
		</div>
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title"> * �ο�&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			  <select name="rg_ext2">
							<option value="">===�ο� ��===</option>
							<option value="2��" <? if($rg_ext2=="2��"){echo "selected";}?>>2��</option>
							<option value="3��" <? if($rg_ext2=="3��"){echo "selected";}?>>3��</option>
							<option value="4��" <? if($rg_ext2=="4��"){echo "selected";}?>>4��</option>
						  </select>
			</span>
		</div>
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title"> Ȧ��&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			  <input type="radio" name="rg_ext1" id="rg_ext1" value="9Ȧ" <? if($rg_ext1=="9Ȧ"){echo "checked";}else if(!$rg_ext1){echo "checked";}?>>9Ȧ
							<? if($rg_cat_num < 104){ ?>
						   <input type="radio" name="rg_ext1"  id="rg_ext1"value="18Ȧ" <? if($rg_ext1=="18Ȧ"){echo "checked";}?>>18Ȧ
						    <? } ?>
						   <input type="radio" name="rg_ext1" id="rg_ext1" value="27Ȧ" <? if($rg_ext1=="27Ȧ"){echo "checked";}?>>27Ȧ
						   <input type="radio" name="rg_ext1" id="rg_ext1" value="36Ȧ" <? if($rg_ext1=="36Ȧ"){echo "checked";}?>>36Ȧ
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
	

		<div class="bbs_write_content">
			<span  class="bbs_write_title" style=cursor:hand></span>
			 <span class="bbs_write_form"> </span>
		 </div>
		 

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
	<span class="bbs_write_new"><INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </span>
</form>

