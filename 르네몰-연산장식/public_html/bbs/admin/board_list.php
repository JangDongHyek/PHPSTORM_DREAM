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
									$qstr .= " AND `bbs_id` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
						case 1 : 
									$qstr .= " AND `bbs_name` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
						case 2 : 
									$qstr .= " AND `bbs_skin` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// 필터 조건에 의한 필터링
      case 1 : // 회원구분
				if(!empty($ss[$ss_key[$i]])) {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `bbs_gr_num` ";
				}
				break;
    }
	}
/*
  if (empty($ot)) $ot = 10;
  switch ($ot) {
    case 10 : $ostr .= " ORDER BY BBSNum";		break;
    case 20 : $ostr .= " ORDER BY UserID,RegDate DESC";						break;
    case 30 : $ostr .= " ORDER BY Origin,RegDate DESC";						break;
    case 40 : $ostr .= " ORDER BY RegDate DESC";									break;
    case 50 : $ostr .= " ORDER BY LastUpdate DESC,RegDate DESC";	break;
  }
*/
	$ostr .= " ORDER BY bbs_gr_num DESC,bbs_num DESC";

	$dbqry="
		SELECT count(*) as row_count 
		FROM `$db_table_bbs_cfg`
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
    <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040">게시판관리</font></span></p></td>
  </tr>
</table>
<br>
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_search" method="post" enctype="multipart/form-data" onsubmit='return formcheck1()'>
<input name="act" type="hidden" value="ok">
	<tr> 
		  <td width="200"> 그룹선택: 
        <select name="ss[1]" id="ss[1]" onChange="mb_search.submit()">
          <option value="">전체</option>
          <?
echo rg_html_option($group_list,'','gr_id',$ss[1])
?>
        </select> </td>
		  <td align="center">검색: 
        <select name="ss[0]" id="ss[0]">
				<?
$ssList = array("게시판아이디","게시판이름","스킨");
for($i=0;$i<count($ssList);$i++) 
if ($i==$ss[0])
echo "<option value='$i' selected>$ssList[$i]</option>";
else
echo "<option value='$i'>$ssList[$i]</option>";
?>
			</select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> <input type="submit" name="검색" value="검색" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
			<input type="button" value="취소" onclick="location.href='?'" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> &nbsp;&nbsp; 
			<input type="button" name="새로고침" value="새로고침" onclick="location.reload()" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"></td>
		  <td width="141" align="right">&nbsp;Total : &nbsp;&nbsp;1 &nbsp;&nbsp;(1/1)</td>
	</tr>
</form>
</table>
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_list" method="post" enctype="multipart/form-data" onsubmit='return formcheck2()' action="?<?=$p_str?>">
<input name="act" type="hidden" value="">
<input name="page" type="hidden" value="<?=$page?>">
  <tr>
    <td align="center">
        <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr> 
            <td width="1">&nbsp; </td>
            <td width="30" height="24" align="center" bgcolor="#f7f7f7">NO</td>
            <td width="80" align="center" bgcolor="#f7f7f7">그룹아이디</td>
            <td width="80" align="center" bgcolor="#f7f7f7">게시판아이디</td>
            <td align="center" bgcolor="#f7f7f7">이름</td>
            <td width="130" align="center" bgcolor="#f7f7f7">스킨</td>
            <td width="80" align="center" bgcolor="#f7f7f7">개설일</td>
            <td width="35" align="center" bgcolor="#f7f7f7">분류</td>
            <td width="35" align="center" bgcolor="#f7f7f7">보기</td>
            <td width="35" align="center" bgcolor="#f7f7f7">수정</td>
            <td width="55" align="center" bgcolor="#f7f7f7">기능설정</td>
            <td width="35" align="center" bgcolor="#f7f7f7">삭제</td>
          </tr>
          <?
	$dbqry="
		SELECT *
		FROM `$db_table_bbs_cfg`
		WHERE (1=1) $qstr
		$ostr
		LIMIT  $page_info[offset],$page_info[rows] ";
	
	$rs=query($dbqry,$dbcon);
	$no = $page_info[total_rows]-$page_info[offset]+1;
	for ($i=0;$i<mysql_num_rows($rs);$i++) {
		$R=mysql_fetch_array($rs);
		$R[bg_title]=nl2br(htmlspecialchars($R[bg_title]));
		$R[bg_cmt_cnt]=($R[bg_cmt_cnt]>0)?"($R[bg_cmt_cnt])":"";
		$blog_link="http://{$R[mb_id]}.$main_domain/blog/blog_list.php?ss[10]=$R[bg_cat_num]#blog_$R[bg_num]";
		$no--;
		/*
		if(!empty($kw)) {
			switch ($ss[0]) {
				case 0 : 
							$R[bg_title] = str_replace($kw, "<font color=\"#FF9900\"><b>{$kw}</b></font>", $R[bg_title]);
							break;
				case 1 : 
							$R[bg_writer] = str_replace($kw, "<font color=\"#FF9900\"><b>{$kw}</b></font>", $R[bg_writer]);
							break;
			}
		}*/
?>
          <tr onmouseover='this.style.backgroundColor="#DAEDED"' onmouseout='this.style.backgroundColor=""'> 
            <td width="1" align="center"> <input name="bg_num[]" type="checkbox" id="bg_num[]" value="<?=$R[bg_num]?>"> 
            </td>
            <td height="24" align="center"> 
              <?=$no?>
            </td>
            <td width="0" align="center"> 
              <?=$group_list[$R[bbs_gr_num]][gr_id]?>
            </td>
            <td align="center"> 
              <?=$R[bbs_id]?>
            </td>
            <td> 
              <?=$R[bbs_name]?>
            </td>
            <td align="center"> 
              <?=$R[bbs_skin]?>
            </td>
            <td align="center"> 
              <?=rg_date($R[bbs_reg_date],'%Y-%m-%d')?>
            </td>
            <td align="center"><a href="board_category.php?bbs_id=<?=$R[bbs_id]?>" target="category" onclick="open('','category','scrollbars=yes,width=400,height=500')">분류</a></td>
            <td align="center"><a href="../list.php?bbs_id=<?=$R[bbs_id]?>" target="_blank">보기</a></td>
            <td align="center"><a href="board_edit.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$R[bbs_num]?>">수정</a></td>
            <td align="center"><a href="board_edit1.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$R[bbs_num]?>">기능설정</a></td>
            <td align="center"><a href="board_delete.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$R[bbs_num]?>">삭제</a></td>
          </tr>
          <?

	}
?>
        </table>
        <? include("navigation.php"); ?> 
        <table border="0" cellspacing="0" cellpadding="0" width="796">
          <tr>
            <td> <a href="board_edit.php?<?=$p_str?>&page=<?=$page?>" title="게시판등록"><img src="images/plus_bbs.gif" width="90" height="25" border="0"></a></td>
          </tr>
        </table>
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