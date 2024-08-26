<?
	$site_path = '../';
	if(!isset($ss[2])) $ss[2] = '-1';
	require_once($site_path."include/admin.lib.inc.php");
/*	
	if(!empty($act) && !empty($nums)) $sel_nums=implode(",",$nums);

	switch($act) {
		case 'bg_bad' :
				$dbqry="
					UPDATE `blog_body` SET
						bg_bad = '$bg_bad_sel'
					WHERE bg_num in ($sel_nums)
				";
				query($dbqry,$dbcon);
				go_href("?$p_str&page=$page");
				break;
	}
*/
  $qstr='';
	for($i=0;$i<count($ss_key);$i++) {
    switch ($ss_key[$i]) {
			/***********************************************************************/
			// 검색어로 검색
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
									$qstr .= " AND `mb_nick` LIKE '%$kw%'";
									break;
						case 4 : 
									$jumin = get_password_str($kw);
									$qstr .= " AND `mb_jumin` LIKE '$jumin'";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// 필터 조건에 의한 필터링
      case 1 : // 그룹
				if(!empty($ss[$ss_key[$i]])) {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `gm_gr_num` ";
				}
				break;
      case 2 : // 회원구분
				if($ss[$ss_key[$i]] != '-1') {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `gm_state` ";
				}
				break;
    }
	}

  if (empty($ot)) $ot = 10;
  switch ($ot) {
    case 10 : $ostr .= " ORDER BY gm_num DESC";		break;
    case 20 : $ostr .= " ORDER BY UserID,RegDate DESC";						break;
    case 30 : $ostr .= " ORDER BY Origin,RegDate DESC";						break;
    case 40 : $ostr .= " ORDER BY RegDate DESC";									break;
    case 50 : $ostr .= " ORDER BY LastUpdate DESC,RegDate DESC";	break;
  }

	$dbqry="
		SELECT count(*) as row_count 
		FROM `$db_table_group_member`
			INNER JOIN `$db_table_group_cfg`
			  ON `gm_gr_num` = `gr_num`
			INNER JOIN `$db_table_member`
			  ON `gm_mb_num` = `mb_num`
		WHERE (1=1) $qstr
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,20,10);


	// 그룹정보읽기
	$dbqry="
		SELECT *
		FROM `$db_table_group_cfg`
	";
	$rs=query($dbqry,$dbcon);
	while($R=mysql_fetch_array($rs)) {
		$group_list[$R[gr_num]]=$R;
	}
?>	
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<br>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" bgcolor="#F7F7F7" border="0" cellpadding="0" cellspacing="0"> 
      <p align="center"><span style="font-size:9pt;"><font color="#404040">그룹회원관리</font></span></p></td>
  </tr>
</table>
<br>
<table width="796" align="center" cellspacing="0" style="border-collapse:collapse;">
<form name="gm_list" method="post" enctype="multipart/form-data" onsubmit='return formcheck1()'>
<input name="act" type="hidden" value="ok">
    <tr>
        
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="271"> 그룹선택 : 
              <select name="ss[1]" id="ss_1" onChange="location='?ss[1]='+gm_list.ss_1.value+'&ss[2]='+gm_list.ss_2.value">
                <option value="">전체</option>
                <?
echo rg_html_option($group_list,'','gr_id',$ss[1])
?>
              </select>
              회원상태 : 
              <select name="ss[2]" id="ss_2" onChange="location='?ss[1]='+gm_list.ss_1.value+'&ss[2]='+gm_list.ss_2.value">
                <?
	$ss_list = array('-1'=>'전체',0=>'정상',1=>'승인대기',2=>'보류',3=>'탈퇴');
	while(list($key,$value)=each($ss_list)) {
    if ($key==$ss[2])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
	}
?>
              </select> </td>
            <td width="400" align="center">검색: 
              <select name="ss[0]" id="ss[0]">
<?
	$ss_list = array("아이디","이름","이메일","닉네임","주민번호");
	while(list($key,$value)=each($ss_list))
    if ($key==$ss[0])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
?>
              </select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> <input type="submit" name="검색" value="검색" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
              <input type="button" value="취소" onclick="location.href='?'" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> &nbsp;&nbsp; 
              <input type="button" name="새로고침" value="새로고침" onclick="location.reload()" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"></td>
            <td width="121" align="right"><span style="font-size:10pt;">&nbsp;Total 
              : &nbsp;&nbsp;1 &nbsp;&nbsp;(1/1)</span></td>
          </tr>
        </table>
    </td>
    </tr>
</form>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="mb_list" method="post" enctype="multipart/form-data" onsubmit='return formcheck2()' action="?<?=$p_str?>">
<input name="act" type="hidden" value="">
<input name="page" type="hidden" value="<?=$page?>">
  <tr>
    <td align="center">
        <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr bgcolor="#f7f7f7"> 
            <td width="1">&nbsp; </td>
            <td width="30" height="24" align="center">NO</td>
            <td width="100" align="center">그룹아이디</td>
            <td align="center">아이디</td>
            <td width="70" align="center">레벨</td>
            <td width="60" align="center">상태</td>
            <td width="120" align="center">가입일</td>
            <td width="40" align="center">수정</td>
            <td width="40" align="center">삭제</td>
          </tr>
          <?
	$dbqry="
		SELECT `$db_table_group_member`.*,
					 `$db_table_group_cfg`.`gr_id`,
					 `$db_table_member`.`mb_id`
		FROM `$db_table_group_member`
			INNER JOIN `$db_table_group_cfg`
			  ON `gm_gr_num` = `gr_num`
			INNER JOIN `$db_table_member`
			  ON `gm_mb_num` = `mb_num`
		WHERE (1=1) $qstr
		$ostr
		LIMIT  $page_info[offset],$page_info[rows] ";
	
	$rs=query($dbqry,$dbcon);
	$no = $page_info[total_rows]-$page_info[offset]+1;
	for ($i=0;$i<mysql_num_rows($rs);$i++) {
		$R=mysql_fetch_array($rs);
		$no--;
?>
          <tr onmouseover='this.style.backgroundColor="#DAEDED"' onmouseout='this.style.backgroundColor=""'> 
            <td width="1" height="22" align="center"> <input name="bg_num[]" type="checkbox" id="bg_num[]2" value="<?=$R[bg_num]?>"> 
            </td>
            <td height="24" align="center"> 
              <?=$no?>
            </td>
            <td width="0" align="center">
              <?=$R[gr_id]?>
            </td>
            <td width="0" align="center"> 
              <?=$R[mb_id]?>
            </td>
            <td align="center"> 
              <?=$R[gm_level]?>
            </td>
            <td align="center"> 
              <?=$mb_states[$R[gm_state]]?>
            </td>
            <td align="center"> 
              <?=rg_date($R[gm_reg_date])?>
            </td>
            <td align="center"><a href="group_member_edit.php?<?=$p_str?>&mode=edit&gm_num=<?=$R[gm_num]?>">수정</a></td>
            <td align="center"><a href="group_member_delete.php?<?=$p_str?>&page=<?=$page?>&gm_num=<?=$R[gm_num]?>">삭제</a></td>
          </tr>
          <?

	}
?>
        </table>
        <? include("navigation.php"); ?> 
          <? if($ss[1]) { ?>
        <table width="796" border="0" align="center" cellpadding="0" cellspacing="0"><Tr><td>
				<a href="group_member_edit.php?<?=$p_str?>&page=<?=$page?>"><img src="images/plus_gmb.gif" border="0"></a></td></tr></table>
        <? } else { ?>
        <table width="796" border="0" align="center" cellpadding="0" cellspacing="0"><Tr>
            <td> <font color="#c90000">※. 그룹회원등록을 하시려면 그룹선택을 해주세요</font></td>
          </tr></table>
        <? } ?>
        <!--				
        <p align="center"> 

          <select name="bg_tag_sel" id="bg_tag_sel">
            <option value="0">일반글</option>
            <option value="1">메인주요글</option>
          </select>
          <input name="submit2" type="submit" onclick="document.mb_list.act.value='bg_tag'" value="확인">
        &nbsp; 

        </p> -->
      </td>
  </tr>
 </form>
</table>
<script language="JavaScript" type="text/JavaScript">
	var f = document.mb_form;
	function formcheck2()
	{
		if(!list_checkbox(document.mb_list,'bg_num[]')) {
			alert('하나 이상선택해주세요.');
			return false;
		}
		return true;
	}
</script>
<? include("admin.footer.php"); ?>