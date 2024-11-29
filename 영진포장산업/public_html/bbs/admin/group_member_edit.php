<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	$gr_num = $ss[1];
	if($act=='ok') {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		
		if($mode=='edit') {
			$dbqry = "
				SELECT gm_num
				FROM $db_table_group_member
				WHERE gm_mb_num = '$gm_mb_num'
				  AND gm_num <> '$gm_num'
			";
			$rs=query($dbqry,$dbcon);
			
			if(mysql_num_rows($rs)) { // 사용하고 있는 아이디
				$msg = str_replace ("%id%", $gm_mb_id, "$msg_exist_gr_mb_id");
				rg_href('',$msg,'','back');
			}
			
			$dbqry="
				UPDATE `$db_table_group_member` SET
					`gm_mb_num` = '$gm_mb_num',
					`gm_state` = '$gm_state',
					`gm_level` = '$gm_level',
					`gm_ext1` = '$gm_ext1',
					`gm_ext2` = '$gm_ext2',
					`gm_ext3` = '$gm_ext3',
					`gm_ext4` = '$gm_ext4',
					`gm_ext5` = '$gm_ext5'
				WHERE `gm_num` = '$gm_num'
			";
			query($dbqry,$dbcon);
		} else {
			$gm_reg_date=$now;
			$gm_mb_nums=explode(',',$gm_mb_num);
			$gm_mb_ids=explode(',',$gm_mb_id);

			foreach($gm_mb_nums as $key => $gm_mb_num) {
			  $gm_mb_id = $gm_mb_ids[$key];
				
				if(rg_get_group_member_info($gm_gr_num,$gm_mb_num,2)) { // 사용하고 있는 아이디
					continue;
//					$msg = str_replace ("%id%", $gm_mb_id, "$msg_exist_gr_mb_id");
//					rg_href('',$msg,'','back');
				}
/*
			// 그룹 회원수 증가 
			$dbqry="
				UPDATE `$db_table_group_cfg` SET
					`gr_total_member` = `gr_total_member` + 1
				WHERE gr_num='$gm_gr_num'
			";
			query($dbqry,$dbcon);
*/
				$dbqry="
					INSERT INTO `$db_table_group_member`
						( `gm_num` , `gm_mb_num` , `gm_gr_num` ,
							`gm_reg_date` , `gm_state` , `gm_level` ,
							`gm_ext1` , `gm_ext2` , `gm_ext3` ,
							`gm_ext4` , `gm_ext5` 
						)
					VALUES
						( '', '$gm_mb_num', '$gm_gr_num',
							'$gm_reg_date', '$gm_state', '$gm_level',
							'$gm_ext1', '$gm_ext2', '$gm_ext3',
							'$gm_ext4', '$gm_ext5'
						)
				";
				query($dbqry,$dbcon);
			}
			$mb_num = mysql_insert_id();
		}
		
		rg_href("group_member_list.php?$p_str&page=$page");
	}

	$group=rg_get_group_cfg($gr_num,1);

	if($mode=='edit') {
		$group_mb=rg_get_group_member_info($gm_num,'',4);
		$tmp=rg_get_member_info($group_mb[gm_mb_num],1);
		$group_mb[gm_mb_id]=$tmp[mb_id];
		$group = rg_get_group_cfg($group_mb[gm_gr_num],1);
		unset($tmp);
	} else {
		$group_mb[gm_state] = $group[gr_member_state];
		$group_mb[gm_level] = $group[gr_member_level];
		$group = rg_get_group_cfg($ss[1],1);
	}
		
	for($i=1;$i<6;$i++) {
		eval("\$show_ext{$i}_begin = (\$group[gr_ext_types][{$i}]==0)?'<!--':'';");
		eval("\$show_ext{$i}_end = (\$group[gr_ext_types][{$i}]==0)?'-->':'';");
		eval("\$show_ext{$i}_title = \$group[gr_ext_name{$i}];");
		eval("\$show_ext{$i}_input = rg_makeform('gm_ext{$i}',\$group[gr_ext_types][{$i}],\$group[gr_ext_value{$i}],\$group_mb[gm_ext$i]);");
	}

?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<br>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">그룹회원등록</font></td>
  </tr>
</table>
<br>
<form name=mb_form method=post action='' onsubmit='return formcheck()' enctype='multipart/form-data' autocomplete=off>
  <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
    <input type=hidden name=act value='ok'>
    <input type=hidden name=ss[1] value='<?=$ss[1]?>'>
    <input type=hidden name=gm_gr_num value='<?=$group[gr_num]?>'>
    <input type=hidden name=gm_num value='<?=$gm_num?>'>
    <input type=hidden name=mode value='<?=$mode?>'>
    <tr> 
      <td width="100" align="center" bgcolor="#f7f7f7">그룹</td>
      <td><span style="font-size:10pt;">
			<?=$group[gr_id]?>
        </span> </td>
    </tr>
    <tr> 
      <td align="center" bgcolor="#f7f7f7">아이디</td>
      <td>
<?
	if($mode=='edit') {
?>
  <input type="text" name='gm_mb_id' itemname='아이디' required value="<?=$group_mb[gm_mb_id]?>" readonly>
<?
	} else {
?>
  <select name="gm_mb_id_list" id="gm_mb_id_list" size="5" style="width:150px">
  </select>
  <input type="hidden" name='gm_mb_id' itemname='아이디' required value="<?=$group_mb[gm_mb_id]?>" readonly>
	<input name="button" type=button class=button onclick="popup_mb_list('mb_form', './','gm_mb_id','gm_mb_num','','1')" value='회원선택'>
<?
	}
?>
        <input type="hidden" name='gm_mb_num' value="<?=$group_mb[gm_mb_num]?>">
        </td>
    </tr>
    <tr> 
      <td align="center" bgcolor="#f7f7f7">회원상태</td>
      <td>
        <?
echo rg_html_radio($mb_states,'gm_state','','',$group_mb[gm_state])
?>
      </td>
    </tr>
    <tr> 
      <td align="center" bgcolor="#f7f7f7">권한(레벨)</td>
      <td>
        <select name="gm_level">
          <?=rg_html_option($levels,'','',"$group_mb[gm_level]")?>
        </select></td>
    </tr>
    <?=$show_ext1_begin?>
    <tr> 
      <td align="center" bgcolor="#f7f7f7"> 
        <?=$show_ext1_title?>
      </td>
      <td> 
        <?=$show_ext1_input?>
      </td>
    </tr>
    <?=$show_ext1_end?>
    <?=$show_ext2_begin?>
    <tr> 
      <td align="center" bgcolor="#f7f7f7"> 
        <?=$show_ext2_title?>
      </td>
      <td> 
        <?=$show_ext2_input?>
      </td>
    </tr>
    <?=$show_ext2_end?>
    <?=$show_ext3_begin?>
    <tr> 
      <td align="center" bgcolor="#f7f7f7"> 
        <?=$show_ext3_title?>
      </td>
      <td> 
        <?=$show_ext3_input?>
      </td>
    </tr>
    <?=$show_ext3_end?>
    <?=$show_ext4_begin?>
    <tr> 
      <td align="center" bgcolor="#f7f7f7"> 
        <?=$show_ext4_title?>
      </td>
      <td> 
        <?=$show_ext4_input?>
      </td>
    </tr>
    <?=$show_ext4_end?>
    <?=$show_ext5_begin?>
    <tr> 
      <td align="center" bgcolor="#f7f7f7"> 
        <?=$show_ext5_title?>
      </td>
      <td> 
        <?=$show_ext5_input?>
      </td>
    </tr>
    <?=$show_ext5_end?>
<? if($mode=='edit') { ?>
    <tr>
      <td height="24" align="center" bgcolor="#f7f7f7">그룹가입일</td>
      <td> 
        <?=rg_date($R[gm_reg_date])?>
      </td>
    </tr>
<? } ?>
  </table>
  <p> 
  <div align=center> 
    <input name="submit" type=submit class=button value='     확     인     '>
  </div>
  <p></p>
</form>
<script language='Javascript'>
    var f = document.mb_form;
		
		if(typeof(f.mb_id) != 'undefined')
	    f.mb_id.focus();

    // submit 최종 폼체크
    function formcheck() 
    {
        return true;
    }

    // 회원아이디 검사
    function mb_id_check()
    {
        if (f.mb_id.value == "") {
            alert('회원 아이디를 입력하세요.');
            f.mb_id.focus();
            return false;
        }

        window.open('<?=$abs_uri?>mbidcheck.php?mb_id='+f.mb_id.value, 'mbidcheck', 'left=0,top=10000,width=1,height=1');
    }
function chang_mb_id(){
  var chk = document.mb_form.gm_mb_id.value.split(',');
	for(i=0;i<chk.length;i++) {
		if(document.mb_form.gm_mb_id_list.length >= chk.length) {
			if(document.mb_form.gm_mb_id_list.options[i].text != chk[i])
				document.mb_form.gm_mb_id_list.options[i] = new Option(chk[i]);
		} else
			document.mb_form.gm_mb_id_list.options[i] = new Option(chk[i]);
	}
	if(document.mb_form.gm_mb_id_list.length!=chk.length)
		document.mb_form.gm_mb_id_list.length=chk.length;
}
setInterval(chang_mb_id, 500);
</script>

<? include("admin.footer.php"); ?>