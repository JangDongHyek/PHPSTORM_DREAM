<?
	$site_path = '../';
	$site_url = '../';
	if(!isset($ss[1])) $ss[1] = '-1';
	require_once($site_path."include/admin.lib.inc.php");
	
	$qstr='';
	for($i=0;$i<count($ss_key);$i++) {
    switch ($ss_key[$i]) {
			/***********************************************************************/
			// �˻���� �˻�
			// "���̵�","�̸�","�̸���","�г���","�ֹι�ȣ"
			case 0 : 
				if(!empty($kw)) {
					switch ($ss[$ss_key[$i]]) {
						case 0 : 
									$qstr .= " AND `mb_id` LIKE '%$kw%'";
									break;
						case 1 : 
									$qstr .= " AND `mb_name` LIKE '%$kw%'";
									break;
						case 2 : 
									$qstr .= " AND `mb_email` LIKE '%$kw%'";
									break;
						case 3 : 
									
									$qstr .= " AND `mb_jumin` LIKE '%$kw%'";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// ���� ���ǿ� ���� ���͸�
      case 1 : // ȸ������
				if($ss[$ss_key[$i]] != '-1') {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `mb_ext1` ";
				}
				break;
    }
	}

	

	$dbqry="SELECT *
		FROM `$db_table_member`
		WHERE mb_id!='lets080' $qstr
		ORDER BY mb_num DESC";
	//echo $dbqry;
	$rs=query($dbqry,$dbcon);
?>
<table>
<tr>
<td>
�޴��� ��ȣ�� ������Դϴ�
<?
	for ($i=0;$R=mysql_fetch_array($rs);$i++) {
		


		$mb_mobile = str_replace("-","",$R[mb_mobile]);
		

		echo ".";
?>






<SCRIPT LANGUAGE="JavaScript">
<!--
	
var f = opener.signform;


f.send_phone.options.length = f.send_phone.options.length + 1;
make_length = f.send_phone.options.length;

f.send_phone.options[make_length - 1].text = "<?=$mb_mobile?>";
f.send_phone.options[make_length - 1].value = "<?=$mb_mobile?>";

f.number_receive_people.value = parseInt(f.number_receive_people.value) + 1;

	
//-->
</SCRIPT>




<?
		
		$mb_mobile = "";
	}
?>
</td>
</tr>
</table>
<SCRIPT LANGUAGE="JavaScript">
<!--
	window.close();
//-->
</SCRIPT>