<?
/******************************************************************
 �� ���ϼ��� �� 
����ϴ�

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> ���̺��� ���� 
<?=$skin_board_url?>
��Ų URL 
<?=$site_url?>
����Ʈ URL 
<?=$bbs_id?>
�Խ��� ���̵� 
<?=$print_page?>
�׺���̼�(������ �̵�) navigation.php ���� 
<?=$show_write_begin?>
�۾��� 
<?=$show_write_end?>
<?=$a_write?>
�۾��� ��ũ 
<?=$show_chk_begin?>
īƮ��� 
<?=$show_chk_end?>
<?=$show_admin_begin?>
�۰��� 
<?=$show_admin_end?>
<?=$u_board_manager?>
�۰����ּ� 
<?=$u_search?>
�˻��� URL 
<?=$checked_sn?>
�̸�üũ 
<?=$checked_st?>
����üũ 
<?=$checked_sc?>
����üũ 
<?=$ss[kw]?>
�˻��� 
<?=$u_all_list?>
��ü��Ϻ���(�˻����) ******************************************************************/ 
?> <? /*?></form> </TABLE> </TD> </TR></TABLE> <? */?>
<!-- ����¡ �� �˻� ��� -->
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td align="center"><?=$print_page?></td>
	<td><? if($auth[bbs_write] || $bbs_id=="noticee") {
		if($a_write=="<RG--"){
			$a_write="<a>";
		}
	?>
	  <? if($bbs_id=="noticee"&&$_SESSION[ss_mb_level]!=10){?>
	  <? }else{?>
      <span onclick="javascript:prepareForPicker();" class="button large"><?=$a_write?>�۾���</a></span>
	  <? }?>
	<?
	}else{
		if($auth[bbs_write]){
	?>
		<span onclick="javascript:prepareForPicker();" class="button large"><a href="../bbs/mobile_mb_login.php?url=../bbs/mobile_list.php?bbs_id=<?=$bbs_id?>">�۾���</a></span>
	<?
		}
	}
	?></td>
</tr>
</table>

<script type="text/javascript">
var a = "<?echo($mb[mb_num]);?>";
var b = "<?echo ($bbs_id);?>";
function getAndroidVersion() {
    var ua = navigator.userAgent; 
    var match = ua.match(/Android\s([0-9\.]*)/);
    return match ? match[1] : false;
};
function prepareForPicker(){
    if(getAndroidVersion().indexOf("4.4.2") != -1 && b == "pro_sell1"){
        window.jsi.register(a, "");
        return false;
    }
}
</script>