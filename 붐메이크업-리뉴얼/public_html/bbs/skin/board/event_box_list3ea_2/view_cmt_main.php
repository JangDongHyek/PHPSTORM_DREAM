<style>
.center {text-align:center;}
.m_box_t { color:#ee004a; text-align:center; font-size:12px; font-weight:bold}
#m_box {padding:2px;border:1px solid #ccc;border-radius:5px;-mz-border-radius:5px;background:#fff;}
#m_box ul {list-style-type:none;padding:15px;margin:0;}
#m_box li {list-style-type:none;padding:3px;margin:0;}
#m_box input.m_input_text {width:95%;padding:5px;background:#f5f5f5;border:1px solid #ccc;border-radius:3px;-mz-border-radius:3px;height:32px;}
#m_box input:focus {background:#fff;}
</style>
<?
/******************************************************************
 �� ���ϼ��� �� 
�ڸ�Ʈ���

 �� ��Ų ������ ���� ���� ���� �� 
<?=$cmt_reg_ip?>			�ڸ�Ʈ ������
<?=$cmt_num?>					�ڸ�Ʈ ��ȣ(��������)
<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�
<?=$mb_id?>						ȸ�����̶�� ȸ�����̵�
<?=$cmt_name?>				�ۼ��ڸ�
<?=$cmt_email?>				�ۼ��� �̸���
<?=$mb_homepage?>			ȸ�����̶�� ȸ��Ȩ������
<?=$rg_mb_icon?>			����ڰ� ȸ���̶�� ȸ��������
<?=$mb_open_info?>		ȸ�����̶�� ������������(ȸ������)
<?=$cmt_reg_date?>		�ڸ�Ʈ �����
<?=$cmt_comment?>			�ڸ�Ʈ ����

<?=$a_comment_delete?>	������ũ

<?=$show_comment_delete_begin?>
�ڸ�Ʈ����
<?=$show_comment_delete_end?>

******************************************************************/

?>
<a name='c<?=$cmt_num?>'></a>
<tr bgcolor=#FFFFFF>
	<td class=bbs>
	
    <div id="m_box">
       <ul>
        <li><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$cmt_name?>', '<?=$cmt_email?>', '<?=$mb_homepage?>', '<?=$mb_open_info?>')" style='cursor:hand;'><?=$cmt_mb_icon?><span class="m_box_t"><?=$mb_id?></span><?if($mb_nick_name){?>(<?=$mb_nick_name?>)<? }?></span>&nbsp;�Բ��� ��û�ϼ̽��ϴ�.&nbsp;<?=$show_comment_delete_begin?><?=$a_comment_delete?><img src="<?=$skin_board_url?>images/del.gif" border=0 style="vertical-align:middle"></a><?=$show_comment_delete_end?></li>
        <li><?=$cmt_comment?></li>
       </ul>
    </div>
     
	</td>
</tr>