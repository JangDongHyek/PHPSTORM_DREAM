<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");

	if($act) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		
		switch($mode) {
			case 'edit' : 
				while(list($key,$val)=each($items)) {
					$qry="
						UPDATE `{$db_table_vote}_item` SET
							vit_item = '$val'
						WHERE vit_num='$key'
						AND vit_vt_num = '$vt_num'
					";
					$rs=query($qry,$dbcon);
				}
				break;
			case 'delete' :
				if($item_sel_num) {
					$qry="
						SELECT vit_order
						FROM `{$db_table_vote}_item`
						WHERE vit_num='$item_sel_num'
						AND vit_vt_num = '$vt_num'
					";
					$rs=query($qry,$dbcon);
					$tmp = mysql_fetch_array($rs);
					
					$qry="
						UPDATE `{$db_table_vote}_item` SET
							vit_order = vit_order-1
						WHERE vit_order > '$tmp[vit_order]'
						AND vit_vt_num = '$vt_num'
					";
					$rs=query($qry,$dbcon);
					
					$qry="
						DELETE FROM `{$db_table_vote}_item` 
						WHERE vit_num='$item_sel_num'
						AND vit_vt_num = '$vt_num'
					";
					$rs=query($qry,$dbcon);
				}
				break;
			case 'reg' :
				if($new_item) {
					$qry="
						SELECT max(vit_order) as vit_order
						FROM `{$db_table_vote}_item`
						WHERE vit_vt_num = '$vt_num'
					";
					$rs=query($qry,$dbcon);
					$tmp = mysql_fetch_array($rs);
					$vit_order = $tmp[vit_order]+1;
					$qry="
						INSERT INTO `{$db_table_vote}_item`
						VALUES
						('','$vt_num',$vit_order,'$new_item', 0)
					";
					$rs=query($qry,$dbcon);
				}		
				break;
			case 'order' :
				$qry="UPDATE `{$db_table_vote}_item` SET
										 vit_order = '$up_ord'
							WHERE vit_num='$up_num'
							AND vit_vt_num = '$vt_num'";
				$rs=query($qry,$dbcon);
				$qry="UPDATE `{$db_table_vote}_item` SET
										 vit_order = '$dn_ord'
							WHERE vit_num='$dn_num'
							AND vit_vt_num = '$vt_num'";
				$rs=query($qry,$dbcon);
				break;
		}
		rg_href("?vt_num=$vt_num");
	}

	$qry="
		SELECT *
		FROM `{$db_table_vote}_item`
		WHERE vit_vt_num = '$vt_num'
		ORDER BY vit_order
	";
	$rs=query($qry,$dbcon);
	
	unset($item_list);
	while($R=mysql_fetch_array($rs)) {
		$item_list[]=$R;
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>RGBOARD 관리자</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../admin/admin.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>
<script language="JavaScript" type="text/JavaScript">
function fonload() {
	parent.Resize_vFrame('if_vote')
}
onload=fonload;
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form action="" method="post" enctype="multipart/form-data" name="item_edit" id="item_edit">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="">
<input name="vt_num" type="hidden" value="<?=$vt_num?>">
  <tr> 
    <td align="center">
        <table border="1" cellpadding="0" cellspacing="0" width="796" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr bgcolor="#f7f7f7"> 
            <td width="30" align="center" >선택</td>
            <td width="30" align="center" >No</td>
            <td align="center" >항목명</td>
            <td width="50" align="center" >득표수</td>
            <td width="40" height="22" align="center" >△▽</td>
          </tr>
          <?
	for($i=0;$i<count($item_list);$i++) {
		$no = $i + 1;
		$next = $i + 1;
		$prev = $i - 1;
		extract($item_list[$i]);
		if($i==0) {
			$up_link = "△";
		} else {
			$up_link = "<a href='?vt_num=$vt_num&act=ok&mode=order&up_num={$item_list[$prev][vit_num]}&up_ord={$vit_order}&dn_num={$vit_num}&dn_ord={$item_list[$prev][vit_order]}' title='순서를 한단계위로 올립니다.'>△</a>";
		}
		if($i==(count($item_list)-1)) {
			$dn_link = "▽";
		} else {
			$dn_link = "<a href='?vt_num=$vt_num&act=ok&mode=order&up_num={$item_list[$next][vit_num]}&up_ord={$vit_order}&dn_num={$vit_num}&dn_ord={$item_list[$next][vit_order]}' title='순서를 한단계아래로 내립니다.'>▽</a>";
		}
?>
          <tr> 
            <td align="center" ><input type="radio" name="item_sel_num" value="<?=$vit_num?>"></td>
            <td align="center" > 
              <?=$vit_order?>
            </td>
            <td ><input name="items[<?=$vit_num?>]" type="text" class="input1" id="items[<?=$vit_num?>]" style="width:100%" value="<?=$vit_item?>"></td>
            <td align="center" ><?=$vit_count?></td>
            <td height="22" align="center" >
              <?=$up_link?>
              <?=$dn_link?>
            </td>
          </tr>
          <?
	}
?>
        </table>
				<table border="1" cellpadding="0" cellspacing="0" width="796" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td height="22" align="center" >&nbsp;&nbsp;항목 
              <input name="new_item" type="text" class="input1" id="new_item" size="45">
              (을)를 
              <input type="button" class="button1" onClick="submit_form('reg')" value=" 추 가 "> 
              &nbsp;&nbsp;선택한 항목을 
              <input name="button" type="button" class="button1" onClick="submit_form('delete')" value=" 삭 제 "> 
              &nbsp;&nbsp; <input name="button" type="button" class="button1" onClick="submit_form('edit')" value="수 정 사 항 적 용"> 
            </td>
          </tr>
        </table>
      </td>
  </tr>
  </form>
</table>
</body>
</html>
<script language="JavaScript" type="text/JavaScript">
function submit_form(type) {
	if(type=='delete') {
		if(!confirm('확실합니까')) 
			return false;
	}
	item_edit.mode.value=type;
	item_edit.submit();
}
</script>

<script src="../admin/script.js"></script>