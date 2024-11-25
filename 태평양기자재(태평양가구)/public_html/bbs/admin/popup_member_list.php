<?
	$site_path = '../';
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
		case 'mb_type' :
				$sel_nums1 = '';
				$dbqry="
					SELECT bg_blog_num
					FROM `blog_body`
					WHERE bg_num in ($sel_nums)
					GROUP BY bg_blog_num
				";
				$rs=query($dbqry,$dbcon);
				$tmp=mysql_fetch_array($rs);
				$sel_nums1 .= "$tmp[bg_blog_num]";
				for ($i=1;$i<mysql_num_rows($rs);$i++) {
					$tmp=mysql_fetch_array($rs);
					$sel_nums1 .= ",$tmp[bg_blog_num]";					
				}
	
				$dbqry="
					UPDATE bl_member SET
						mb_type = '$mb_type_sel'
					WHERE mb_num in ($sel_nums1)
				";
				$rs=query($dbqry,$dbcon);
				
				go_href("?$p_str&page=$page");
				break;
		case 'bg_tag' :
				$dbqry="
					UPDATE `blog_body` SET
						bg_tag = '$bg_tag_sel'
					WHERE bg_num in ($sel_nums)
				";
				query($dbqry,$dbcon);
				go_href("?$p_str&page=$page");
				break;
		case 'bg_cat' :
				$dbqry="
					UPDATE `blog_body` SET
						bg_cat_num = '$bg_cat_sel'
					WHERE bg_num in ($sel_nums)
				";
				query($dbqry,$dbcon);
				go_href("?$p_str&page=$page");
				break;
		case 'notice' :
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
									$qstr .= " AND `$db_table_member`.`mb_id` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
						case 1 : 
									$qstr .= " AND `$db_table_member`.`mb_writer` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// 필터 조건에 의한 필터링
      case 1 : // 회원구분
				if(!empty($ss[$ss_key[$i]])) {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `$db_table_member`.`mb_type` ";
				}
				break;
    }
	}

  if (empty($ot)) $ot = 10;
  switch ($ot) {
    case 10 : $ostr .= " ORDER BY mb_num DESC";		break;
    case 20 : $ostr .= " ORDER BY UserID,RegDate DESC";						break;
    case 30 : $ostr .= " ORDER BY Origin,RegDate DESC";						break;
    case 40 : $ostr .= " ORDER BY RegDate DESC";									break;
    case 50 : $ostr .= " ORDER BY LastUpdate DESC,RegDate DESC";	break;
  }

	$dbqry="
		SELECT count(*) as row_count 
		FROM `$db_table_member`
		WHERE (1=1) $qstr
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,20,10);
	$p_str='frm_name='.$frm_name.'&frm_id='.$frm_id.'&frm_num='.$frm_num.'&multi='.$multi;
?>	
	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Let's080 ver <?=$C_RGBOARD_VERSION?> - 관리자</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="../admin/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">회 
      원 선 택</font></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="mb_search" method="post" enctype="multipart/form-data" onsubmit='return formcheck1()'>
<input name="act" type="hidden" value="ok">
          <tr> 
            <td align="center">검색: <select name="ss[0]" id="ss[0]">
                <?
	$ssList = array("아이디","닉네임","주민번호");
  for($i=0;$i<count($ssList);$i++) 
    if ($i==$ss[0])
      echo "<option value='$i' selected>$ssList[$i]</option>";
    else
      echo "<option value='$i'>$ssList[$i]</option>";
?>
              </select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="10"> 
              <input type="submit" name="검색" value="검색" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
              <input name="button" type="button" onClick="location.href='?frm_name=<?=$frm_name?>&frm_id=<?=$frm_id?>&frm_num=<?=$frm_num?>&key=<?=$key?>&multi=<?=$multi?>'" value="취소" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
            </td>
            <td align="center"><span style="font-size:10pt;">Total : &nbsp;1&nbsp;(1/1)</span></td>
          </tr>
</form>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="mb_list" method="post" enctype="multipart/form-data" onsubmit='return formcheck2()' action="?<?=$p_str?>">
<input name="act" type="hidden" value="">
<input name="page" type="hidden" value="<?=$page?>">
  <tr>
    <td>
        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr bgcolor="#f7f7f7"> 
<?
if($multi) {
?>
            <td width="1">&nbsp; </td>
<?
	}
?>
            <td width="30" height="24" align="center">NO</td>
            <td align="center">아이디</td>
            <td width="60" align="center">포인트</td>
            <td width="70" align="center">레벨</td>
            <td width="60" align="center">상태</td>
<?
if(!$multi) {
?>
            <td width="60" align="center">선택</td>
<?
	}
?>
          </tr>
          <?
	$dbqry="
		SELECT *
		FROM `$db_table_member`
		WHERE (1=1) $qstr
		$ostr
		LIMIT  $page_info[offset],$page_info[rows] ";
	
	$rs=query($dbqry,$dbcon);
	$no = $page_info[total_rows]-$page_info[offset]+1;
	$rtn_mb_id = array();
	for ($i=0;$i<mysql_num_rows($rs);$i++) {
		$R=mysql_fetch_array($rs);
		$no--;

		if($key)
			$val=$R[$key];
		else
			$val=$R[mb_num];
			
		$rtn_mb_id[$R[mb_num]]=$R[mb_id];
?><label for="mb_num_<?=$R[mb_num]?>">
          <tr onmouseover='this.style.backgroundColor="#DAEDED"' onmouseout='this.style.backgroundColor=""'> 
<?
if($multi) {
?>
            <td width="1" height="22" align="center"> <input name="mb_num[]" type="checkbox" id="mb_num_<?=$R[mb_num]?>" value="<?=$R[mb_num]?>"> 
            </td>
<?
	}
?>
            <td height="24" align="center"> 
              <?=$no?>
            </td>
            <td width="0" align="center"> 
              <?=$R[mb_id]?>
            </td>
            <td align="center"> 
              <?=$R[mb_point]?>
            </td>
            <td align="center"> 
              <?=$R[mb_level]?>
            </td>
            <td align="center">
              <?=$mb_states[$R[mb_state]]?>
            </td>
<?
if(!$multi) {
?>
            <td align="center"><a href="javascript:use('<?=$R[mb_num]?>','<?=$R[mb_id]?>')">선택</a> 
            </td>
<?
	}
?>
          </tr></label>
          <?

	}
?>
        </table>
        <div align="center"> 
<? include("navigation.php"); ?>
<?
if($multi) {
?>
          <input type="button" value=" 선 택 " onclick="use_select()" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;">
<?
	}
?>
        </div>
<!--				
        <p align="center"> 
          <select name="bg_bad_sel" size="1" id="bg_bad_sel">
            <option value="0">메인카테고리에 보이게 하기</option>
            <option value="1">메인카테고리에 안보이게 하기</option>
          </select>
          <input name="submit" type="submit" onclick="document.mb_list.act.value='bg_bad'" value="확인">
          &nbsp; 
          <select name="mb_type_sel" id="mb_type_sel">
            <option value="0">일반회원으로</option>
            <option value="1">좋은글회원으로</option>
            <option value="2">요주의회원으로</option>
          </select>
          <input name="submit" type="submit" onclick="document.mb_list.act.value='mb_type'" value="확인">
          &nbsp; 
          <select name="bg_tag_sel" id="bg_tag_sel">
            <option value="0">일반글</option>
            <option value="1">메인주요글</option>
          </select>
          <input name="submit2" type="submit" onclick="document.mb_list.act.value='bg_tag'" value="확인">
        &nbsp; 
        <select name="bg_cat_sel" id="bg_cat_sel">
<?
	reset($cat_info);
	while (list ($key, $R) = each ($cat_info)) {
		echo "<option value=\"$R[bg_cat_num]\">$R[bg_cat_name]</option>";		
	}
?>
        </select>
        <input name="submit22" type="submit" onclick="document.mb_list.act.value='bg_cat'" value="확인">
        </p> -->
  	</td>
  </tr>
 </form>
</table>
<script language="JavaScript" type="text/JavaScript">
var rtn_mb_id = new Array;
<?
	foreach($rtn_mb_id as $key => $val) {
		echo "rtn_mb_id[$key]=\"$val\"\n";
	}	
?>

	function use(num,id)
	{	
		<? if($frm_num) { ?>
		opener.<?=$frm_name?>.<?=$frm_num?>.value=num;
		<? } ?>
		
		<? if($frm_id) { ?>
		opener.<?=$frm_name?>.<?=$frm_id?>.value=id;
		<? } ?>
		self.close();
	}
	function use_select()
	{	
		var value = list_checkbox_value(mb_list,'mb_num[]');
		var rtn_mb_ids='';
		var f = opener.<?=$frm_name?>
		
		for(i=0;i<mb_list.length;i++) {
			if(mb_list[i].type=="checkbox" && mb_list[i].name=='mb_num[]')
				if(mb_list[i].checked) {
					if(rtn_mb_ids=='')
						rtn_mb_ids = rtn_mb_id[mb_list[i].value]
					else
						rtn_mb_ids = rtn_mb_ids + ','+rtn_mb_id[mb_list[i].value]
				}
		}
		
		<? if($frm_num) { ?>
		if(typeof(f.<?=$frm_num?>) != 'undefined')
			if(f.<?=$frm_num?>.value == '')
				f.<?=$frm_num?>.value=value;
			else
				f.<?=$frm_num?>.value=f.<?=$frm_num?>.value+','+value;
		<? } ?>

		<? if($frm_id) { ?>
		if(typeof(f.<?=$frm_id?>) != 'undefined')
			if(f.<?=$frm_id?>.value == '')
				f.<?=$frm_id?>.value=rtn_mb_ids;
			else
				f.<?=$frm_id?>.value=f.<?=$frm_id?>.value+','+rtn_mb_ids;
		<? } ?>
		self.close();
	}
</script>
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
</body>
</html>
<script src="../admin/script.js"></script>