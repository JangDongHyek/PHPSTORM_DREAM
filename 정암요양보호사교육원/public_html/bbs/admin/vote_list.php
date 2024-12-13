<?
	$site_path = '../';
	if(!isset($ss[1])) $ss[1] = '-1';
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
									$qstr .= " AND `vt_question` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
						case 1 : 
									$qstr .= " AND `gr_name` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// 필터 조건에 의한 필터링
      case 1 : // 상태 
				switch ($ss[$ss_key[$i]]) {
					case 0 : // 진행 
								$qstr .= " AND UNIX_TIMESTAMP()  BETWEEN `vt_start` AND vt_end";
								$doc_title = "'$kw' 검색 결과";
								break;
					case 1 : // 종료
								$qstr .= " AND `vt_end` < UNIX_TIMESTAMP()";
								$doc_title = "'$kw' 검색 결과";
								break;
					case 2 : // 미실시
								$qstr .= " AND `vt_start` > UNIX_TIMESTAMP()";
								$doc_title = "'$kw' 검색 결과";
								break;
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
	$ostr=' ORDER BY vt_num DESC ';
	$dbqry="
		SELECT count(*) as row_count 
		FROM `{$db_table_vote}_cfg`
		WHERE (1=1) $qstr
	";
	$rs = query($dbqry,$dbcon,1);
	if(!$rs) {
		rg_href('create_vote_tables.php','투표 테이블이 생성되지 않았습니다.\n생성후 사용하세요.');
	}
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,20,10);

?>	
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<br>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">투표관리</font></td>
  </tr>
</table>
<br>
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_search" method="post" enctype="multipart/form-data" onsubmit='return formcheck1()'>
<input name="act" type="hidden" value="ok">
  <tr> 
    <td width="200"><span style="font-size:10pt;"> 상태 : 
      <select name="ss[1]" id="ss[1]" onChange="location='?ss[1]='+this.value">
        <?
	$ss_list = array('-1'=>'전체',0=>'진행중',1=>'종료',2=>'미실시');
	while(list($key,$value)=each($ss_list)) {
    if ($key==$ss[1])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
	}
?>
      </select>
      </span></td>
    <td align="center"><span style="font-size:10pt;">검색:</span> <select name="ss[0]" id="ss[0]">
        <?
	$ss_list = array("질문");
	while(list($key,$value)=each($ss_list)) {
    if ($key==$ss[0])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
	}
?>
      </select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> 
      <input name="검색" type="submit" class="button1" value="검색"> <input name="button" type="button" class="button1" onclick="location.href='?'" value="취소"> 
      &nbsp;&nbsp; <input name="새로고침" type="button" class="button1" onclick="location.reload()" value="새로고침"></td>
    <td width="141" align="right"><span style="font-size:10pt;">&nbsp;Total : 
      &nbsp;&nbsp;1 &nbsp;&nbsp;(1/1)</span></td>
  </tr>
</form>
</table>
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_list" method="post" enctype="multipart/form-data" onsubmit='return formcheck2()' action="?<?=$p_str?>">
<input name="act" type="hidden" value="">
<input name="page" type="hidden" value="<?=$page?>">
  <tr>
    <td>
        <table border="1" cellpadding="0" cellspacing="0" width="796" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr bgcolor="#f7f7f7"> 
            <td width="1">&nbsp; </td>
            <td width="30" height="24" align="center">NO</td>
            <td align="center">질문</td>
            <td width="70" align="center">시작일</td>
            <td width="70" align="center">종료일</td>
            <td width="130" align="center">등록일</td>
            <td width="40" align="center">보기</td>
            <td width="40" align="center">수정</td>
            <td width="40" align="center">삭제</td>
          </tr>
          <?
	$dbqry="
		SELECT *
		FROM `{$db_table_vote}_cfg`
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
            <td width="1" align="center"> <input name="bg_num[]" type="checkbox" id="vt_num[]" value="<?=$R[vt_num]?>"> 
            </td>
            <td height="24" align="center"> 
              <?=$no?>
            </td>
            <td> 
              <?=$R[vt_question]?>
            </td>
            <td align="center"> 
              <?=rg_date($R[vt_start],'%Y-%m-%d')?>
            </td>
            <td align="center"> 
              <?=rg_date($R[vt_end],'%Y-%m-%d')?>
            </td>
            <td align="center"> 
              <?=rg_date($R[vt_regdate])?>
            </td>
            <td align="center"><a href="../vote_main.php?vt_num=<?=$R[vt_num]?>" target="_blank">보기</a></td>
            <td align="center"><a href="vote_edit.php?<?=$p_str?>&page=<?=$page?>&mode=edit&vt_num=<?=$R[vt_num]?>">수정</a></td>
            <td align="center"><a href="vote_delete.php?<?=$p_str?>&page=<?=$page?>&mode=edit&vt_num=<?=$R[vt_num]?>">삭제</a> 
            </td>
          </tr>
          <?
	}
?>
        </table>
        <div align="center"> 
<? include("navigation.php"); ?>
          <a href="vote_edit.php?<?=$p_str?>&page=<?=$page?>"><img src="images/plus_vote.gif" width="90" height="25" border="0"></a> 
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