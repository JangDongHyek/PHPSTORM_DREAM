<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");

	$bbs_table = $db_table_prefix.$bbs_id;
	$bbs_body_table = $bbs_table.$db_table_suffix_body;
	$bbs_category_table = $bbs_table.$db_table_suffix_category;
	
	if($act) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		
		switch($mode) {
			case 'edit' : 
				while(list($key,$val)=each($cat_names)) {
					$qry="
						UPDATE $bbs_category_table SET
							cat_name = '$val'
						WHERE cat_num='$key'
					";
					$rs=query($qry,$dbcon);
				}
				break;
			case 'move' :
				if($tar_cat_sel_num && $src_cat_sel_num) {
					$qry="
						UPDATE $bbs_body_table SET
							rg_cat_num = '$tar_cat_sel_num'
						WHERE rg_cat_num='$src_cat_sel_num'
					";
					$rs=query($qry,$dbcon);
				}
				break;
			case 'delete' :
				if($tar_cat_sel_num && $src_cat_sel_num) {
					$qry="
						UPDATE $bbs_body_table SET
							rg_cat_num = '$tar_cat_sel_num'
						WHERE rg_cat_num='$src_cat_sel_num'
					";
					$rs=query($qry,$dbcon);
					
					$qry="
						SELECT cat_order
						FROM $bbs_category_table
						WHERE cat_num='$src_cat_sel_num'
					";
					$rs=query($qry,$dbcon);
					$tmp = mysql_fetch_array($rs);
					
					$qry="
						UPDATE $bbs_category_table SET
							cat_order = cat_order-1
						WHERE cat_order > '$tmp[cat_order]'
					";
					$rs=query($qry,$dbcon);
					
					$qry="
						DELETE FROM $bbs_category_table 
						WHERE cat_num='$src_cat_sel_num'
					";
					$rs=query($qry,$dbcon);
				}
				break;
			case 'reg' :
				if($new_cat_name) {
					$qry="
						SELECT max(cat_order) as cat_order
						FROM $bbs_category_table
					";
					$rs=query($qry,$dbcon);
					$tmp = mysql_fetch_array($rs);
					$cat_order = $tmp[cat_order]+1;
					$qry="
						INSERT INTO `$bbs_category_table`
						VALUES
						('', $cat_order, '$new_cat_name', 0)
					";
					$rs=query($qry,$dbcon);
				}		
				break;
			case 'order' :
				$qry="UPDATE $bbs_category_table SET
										 cat_order = '$up_ord'
							WHERE cat_num='$up_num'";
				$rs=query($qry,$dbcon);
				$qry="UPDATE $bbs_category_table SET
										 cat_order = '$dn_ord'
							WHERE cat_num='$dn_num'";
				$rs=query($qry,$dbcon);
				break;
		}
		rg_href("board_category2.php?bbs_id=$bbs_id");
	}


	$qry="
		SELECT *
		FROM $bbs_category_table
		ORDER BY cat_order
	";
	$rs=query($qry,$dbcon);
	
	unset($cat_list);
	while($R=mysql_fetch_array($rs)) {
		$cat_list[]=$R;
	}

?>
<? include("admin.header.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form action="" method="post" enctype="multipart/form-data" name="cat_edit" id="cat_edit">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="">
<input name="bbs_id" type="hidden" value="<?=$bbs_id?>">
  <tr> 
    <td align="center">
        <table width="100%" cellspacing="0" style="border-collapse:collapse;">
          <tr>
            <td width="30" align="center" bgcolor="silver" class="line1" >선택</td>
            <td width="30" align="center" bgcolor="silver" class="line1" >No</td>
            <td align="center" bgcolor="silver" class="line1" >시간</td>
            <td width="40" height="22" align="center" bgcolor="silver" class="line1" >△▽</td>
          </tr>
          <?
	for($i=0;$i<count($cat_list);$i++) {
		$no = $i + 1;
		$next = $i + 1;
		$prev = $i - 1;
		extract($cat_list[$i]);
		if($i==0) {
			$up_link = "△";
		} else {
			$up_link = "<a href='?bbs_id=$bbs_id&act=ok&mode=order&up_num={$cat_list[$prev][cat_num]}&up_ord={$cat_order}&dn_num={$cat_num}&dn_ord={$cat_list[$prev][cat_order]}' title='순서를 한단계위로 올립니다.'>△</a>";
		}
		if($i==(count($cat_list)-1)) {
			$dn_link = "▽";
		} else {
			$dn_link = "<a href='?bbs_id=$bbs_id&act=ok&mode=order&up_num={$cat_list[$next][cat_num]}&up_ord={$cat_order}&dn_num={$cat_num}&dn_ord={$cat_list[$next][cat_order]}' title='순서를 한단계아래로 내립니다.'>▽</a>";
		}
?>
          <tr>
            <td align="center" class="line1" ><input type="radio" name="src_cat_sel_num" value="<?=$cat_num?>"></td>
            <td align="center" class="line1" >
              <?=$no?>
            </td>
            <td class="line1" > 
              <input name="cat_names[<?=$cat_num?>]" type="text" id="cat_names[<?=$cat_num?>]" value="<?=$cat_name?>" style="width:100%"> </td>
            <td height="22" align="center" class="line1" ><?=$up_link?><?=$dn_link?></td>
          </tr>
          <?
	}
?>
        </table>
				<br>
        <table width="100%" cellspacing="0" style="border-collapse:collapse;">
          <tr> 
            <td height="22" align="center" class="line1" ><input type="submit" value="수 정 사 항 적 용" style="width:100%" onClick="cat_edit.mode.value='edit'"></td>
          </tr>
         
          <tr>
            <td height="22" align="right" class="line1" >
              <input name="submit" type="submit" value=" 삭 제 " onClick="if(!confirm('확실합니까')) return false;cat_edit.mode.value='delete'">
              &nbsp;&nbsp;</td>
          </tr>
          <tr> 
            <td height="22" class="line1" >&nbsp;&nbsp;시간 
              <input name="new_cat_name" type="text" id="new_cat_name">
              (을)를 
              <input type="submit" value=" 추 가 " onClick="cat_edit.mode.value='reg'"></td>
          </tr>
        </table>
      </td>
  </tr>
  </form>
</table>


<br>
<?
	// 카피라이트 뿌려주는 곳
//	include($site_path."include/copyright.inc.php");
?>
</body>
</html>
<script src="../admin/script.js"></script>