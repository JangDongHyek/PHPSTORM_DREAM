<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	require_once($site_path."include/schema.inc.php");

	if($mode=='edit') {
		$R=rg_get_bbs_cfg($bbs_num,1);
	}
	
	if($act) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);
		$bbs_table = $db_table_prefix.$bbs_id;
		$bbs_reg_date = $now;
		$bbs_cfg = ',A,A,A,N,N,N,N,N,A,A,A,D,A,A,D,A,,,,0,1,1,0,0,0,1,0,,,,0,1,1,,,,,,';

		$bbs_ext_type1 = (strlen($bbs_ext_type1)==1) ? $bbs_ext_type1:'0';
		$bbs_ext_type2 = (strlen($bbs_ext_type2)==1) ? $bbs_ext_type2:'0';
		$bbs_ext_type3 = (strlen($bbs_ext_type3)==1) ? $bbs_ext_type3:'0';
		$bbs_ext_type4 = (strlen($bbs_ext_type4)==1) ? $bbs_ext_type4:'0';
		$bbs_ext_type5 = (strlen($bbs_ext_type5)==1) ? $bbs_ext_type5:'0';

		$bbs_ext_types = '0';
		$bbs_ext_types .= $bbs_ext_type1;
		$bbs_ext_types .= $bbs_ext_type2;
		$bbs_ext_types .= $bbs_ext_type3;
		$bbs_ext_types .= $bbs_ext_type4;
		$bbs_ext_types .= $bbs_ext_type5;
	
		if($mode=='edit') {
/*
			if($bbs_gr_num != $R[bbs_gr_num]) {
				// 기존그룹 게시판수 감소 
				$dbqry="
					UPDATE `$db_table_group_cfg` SET
						`gr_total_bbs` = `gr_total_bbs` - 1
					WHERE gr_num='$R[bbs_gr_num]'
				";
				query($dbqry,$dbcon);

				// 그룹 게시판수 증가  
				$dbqry="
					UPDATE `$db_table_group_cfg` SET
						`gr_total_bbs` = `gr_total_bbs` + 1
					WHERE gr_num='$bbs_gr_num'
				";
				query($dbqry,$dbcon);
			}			
*/
		 	// 테이블에 게시판 데이타 수정
			$dbqry="
				UPDATE `$db_table_bbs_cfg` SET
					`bbs_gr_num` = '$bbs_gr_num',
					`bbs_name` = '$bbs_name',
					`bbs_header_file` = '$bbs_header_file',
					`bbs_header_tag` = '$bbs_header_tag',
					`bbs_footer_file` = '$bbs_footer_file',
					`bbs_footer_tag` = '$bbs_footer_tag',
					`bbs_charset` = '$bbs_charset',
					`bbs_skin` = '$bbs_skin',
					`bbs_title` = '$bbs_title',
					`bbs_bg_image` = '$bbs_bg_image',
					`bbs_bg_color` = '$bbs_bg_color',
					`bbs_body_tag` = '$bbs_body_tag',
					`bbs_width` = '$bbs_width',
					`bbs_align` = '$bbs_align',
					`bbs_admin_list` = '$bbs_admin_list',
					`bbs_file_count` = '$bbs_file_count',
					`bbs_link_count` = '$bbs_link_count',
					`bbs_file1_ext` = '$bbs_file1_ext',
					`bbs_file2_ext` = '$bbs_file2_ext',
					`bbs_html_text` = '$bbs_html_text',
					`bbs_list_count` = '$bbs_list_count',
					`bbs_act_after` = '$bbs_act_after',
					`bbs_page_count` = '$bbs_page_count',
					`bbs_deny_write_ip` = '$bbs_deny_write_ip',
					`bbs_deny_read_ip` = '$bbs_deny_read_ip',
					`bbs_deny_word` = '$bbs_deny_word',
					`bbs_write_time` = '$bbs_write_time',
					`bbs_file1_size` = '$bbs_file1_size',
					`bbs_file2_size` = '$bbs_file2_size',
					`bbs_title_prefix` = '$bbs_title_prefix',
					`bbs_name_suffix` = '$bbs_name_suffix',
					`bbs_quota_mark` = '$bbs_quota_mark',
					`bbs_forward_prefix` = '$bbs_forward_prefix',
					`bbs_default_content` = '$bbs_default_content',
					`bbs_list_date_disp` = '$bbs_list_date_disp',
					`bbs_view_date_disp` = '$bbs_view_date_disp',
					`bbs_ext_types` = '$bbs_ext_types',
					`bbs_ext_name1` = '$bbs_ext_name1',
					`bbs_ext_value1` = '$bbs_ext_value1',
					`bbs_ext_name2` = '$bbs_ext_name2',
					`bbs_ext_value2` = '$bbs_ext_value2',
					`bbs_ext_name3` = '$bbs_ext_name3',
					`bbs_ext_value3` = '$bbs_ext_value3',
					`bbs_ext_name4` = '$bbs_ext_name4',
					`bbs_ext_value4` = '$bbs_ext_value4',
					`bbs_ext_name5` = '$bbs_ext_name5',
					`bbs_ext_value5` = '$bbs_ext_value5',
					`bbs_new_time` = '$bbs_new_time',
					`bbs_point_write` = '$bbs_point_write',
					`bbs_point_reply` ='$bbs_point_reply',
					`bbs_point_comment` = '$bbs_point_comment'
				WHERE `bbs_num` = '$bbs_num'
			";
			query($dbqry,$dbcon);
		} else {
			if(!$bbs_id) { // 게시판아이디가 비어 있다면
				$msg = '게시판 아이디를 입력해주세요.';
				rg_href('',$msg,'','back');
			}
			// 게시판테이블 생성
			$dbqry = "
					CREATE TABLE `{$bbs_table}{$db_table_suffix_body}`
					$mysql_schema_bbs_body
				";
			query($dbqry,$dbcon);
			// 카테고리테이블 생성
			$dbqry = "
					CREATE TABLE `{$bbs_table}{$db_table_suffix_category}`
					$mysql_schema_bbs_category
				";
			query($dbqry,$dbcon);
			// 코멘트테이블 생성
			$dbqry = "
					CREATE TABLE `{$bbs_table}{$db_table_suffix_comment}`
					$mysql_schema_bbs_comment
				";
			query($dbqry,$dbcon);
			// 데이타 디렉토리 생성
			@mkdir($data_path.$bbs_id,0707);
			@chmod($data_path.$bbs_id,0707);
			// 기본데이타 추가.
			for($i=0;$i<count($mysql_bbs_data);$i++) {
				$dbqry = "
					INSERT INTO `{$bbs_table}{$db_table_suffix_category}`
					VALUES 
				 	$mysql_bbs_data[$i]
				";
				query($dbqry,$dbcon);
			}
/*			
			// 그룹 게시판수 증가  
			$dbqry="
				UPDATE `$db_table_group_cfg` SET
					`gr_total_bbs` = `gr_total_bbs` + 1
				WHERE gr_num='$bbs_gr_num'
			";
			query($dbqry,$dbcon);
*/
			// 테이블에 게시판 데이타 추가
			$dbqry="
				INSERT INTO `$db_table_bbs_cfg`
					( `bbs_num` , `bbs_id` , `bbs_gr_num` , `bbs_name` ,
					  `bbs_header_file` , `bbs_header_tag` , `bbs_footer_file` , 
						`bbs_footer_tag` , `bbs_charset` , `bbs_skin` , 
						`bbs_title` , `bbs_bg_image` , `bbs_bg_color` , 
						`bbs_body_tag` , `bbs_width` , `bbs_align` , 
						`bbs_admin_list` ,  `bbs_cfg` ,
						`bbs_file_count` , `bbs_link_count` ,
						`bbs_file1_ext`, `bbs_file2_ext`,
						`bbs_html_text` ,
						`bbs_list_count` , `bbs_act_after` , `bbs_page_count` ,
						`bbs_deny_write_ip` , `bbs_deny_read_ip` , `bbs_deny_word` ,
						`bbs_write_time` ,
						`bbs_file1_size` , `bbs_file2_size` ,
						`bbs_title_prefix` ,
						`bbs_name_suffix` , `bbs_quota_mark` , `bbs_forward_prefix` ,
						`bbs_default_content` , `bbs_list_date_disp` , `bbs_view_date_disp` ,
						`bbs_reg_date` , `bbs_ext_types` , `bbs_ext_name1` ,
						`bbs_ext_value1` , `bbs_ext_name2` , `bbs_ext_value2` ,
						`bbs_ext_name3` , `bbs_ext_value3` , `bbs_ext_name4` ,
						`bbs_ext_value4` , `bbs_ext_name5` , `bbs_ext_value5` ,
						`bbs_new_time` , `bbs_point_write` , `bbs_point_reply` ,
						`bbs_point_comment` 
					) 
				VALUES 
					(	'', '$bbs_id', '$bbs_gr_num', '$bbs_name', 
						'$bbs_header_file', '$bbs_header_tag', '$bbs_footer_file', 
						'$bbs_footer_tag', '$bbs_charset', '$bbs_skin', 
						'$bbs_title', '$bbs_bg_image', '$bbs_bg_color', 
						'$bbs_body_tag', '$bbs_width', '$bbs_align', 
						'$bbs_admin_list', '$bbs_cfg', 
						'$bbs_file_count', '$bbs_link_count',
						'$bbs_file1_ext', '$bbs_file2_ext',
						'$bbs_html_text', 
						'$bbs_list_count', '$bbs_act_after', '$bbs_page_count', 
						'$bbs_deny_write_ip', '$bbs_deny_read_ip', '$bbs_deny_word',
						'$bbs_write_time', 
						'$bbs_file1_size', '$bbs_file2_size', 
						'$bbs_title_prefix', 
						'$bbs_name_suffix', '$bbs_quota_mark', '$bbs_forward_prefix',
						'$bbs_default_content', '$bbs_list_date_disp', '$bbs_view_date_disp',
						'$bbs_reg_date', '$bbs_ext_types', '$bbs_ext_name1', 
						'$bbs_ext_value1', '$bbs_ext_name2', '$bbs_ext_value2', 
						'$bbs_ext_name3', '$bbs_ext_value3', '$bbs_ext_name4',
						'$bbs_ext_value4', '$bbs_ext_name5', '$bbs_ext_value5',
						'$bbs_new_time', '$bbs_point_write', '$bbs_point_reply',
						'$bbs_point_comment'
				)
			";
			query($dbqry,$dbcon);
			$bbs_num = mysql_insert_id();
		}

		if(count($group_chk)>0){ // 그룹체크 처리 
			unset($updates);
			$bbs_exts=array();
			foreach($group_chk as $field) {
				$field = trim($field);
				if(preg_match ("/^bbs_ext_([1-5])/i", $field, $tmp)) {
					$bbs_exts[$tmp[1]] = ${"bbs_ext_type$tmp[1]"};	// 추가항목 목록
					$updates[] = "`bbs_ext_name{$tmp[1]}` = '".${"bbs_ext_name$tmp[1]"}."'";
					$updates[] = "`bbs_ext_value{$tmp[1]}` = '".${"bbs_ext_value$tmp[1]"}."'";
				} else {
					$updates[] = "`$field` = '${$field}'";
				}
			}

			$dbqry="
				SELECT *
				FROM `$db_table_bbs_cfg`
				WHERE `bbs_gr_num` = '$bbs_gr_num'";
			$rs=query($dbqry,$dbcon);
			while ($R1=mysql_fetch_array($rs)) {
				$updates1 = $updates;
				$bbs_ext_types = $R1[bbs_ext_types];
				if(count($bbs_exts)>0) {
					foreach($bbs_exts as $key => $value) {
						$bbs_ext_types[$key] = $value;
					}
					$updates1[] = "`bbs_ext_types` = '$bbs_ext_types'";
				}
				
				$dbqry="
					UPDATE `$db_table_bbs_cfg` SET
				";
				$dbqry .= implode (',', $updates1);
				$dbqry .= " WHERE `bbs_num` = '$R1[bbs_num]'";
				query($dbqry,$dbcon);
			}
		}

		if(count($all_chk)>0){ // 전체 처리 
			unset($updates);
			$bbs_exts=array();
			foreach($all_chk as $field) {
				$field = trim($field);
				if(preg_match ("/^bbs_ext_([1-5])/i", $field, $tmp)) {
					$bbs_exts[$tmp[1]] = ${"bbs_ext_type$tmp[1]"};	// 추가항목 목록
					$updates[] = "`bbs_ext_name{$tmp[1]}` = '".${"bbs_ext_name$tmp[1]"}."'";
					$updates[] = "`bbs_ext_value{$tmp[1]}` = '".${"bbs_ext_value$tmp[1]"}."'";
				} else {
					$updates[] = "`$field` = '${$field}'";
				}
			}

			$dbqry="
				SELECT *
				FROM `$db_table_bbs_cfg`";
			$rs=query($dbqry,$dbcon);
			while ($R1=mysql_fetch_array($rs)) {
				$updates1 = $updates;
				$bbs_ext_types = $R1[bbs_ext_types];
				if(count($bbs_exts)>0) {
					foreach($bbs_exts as $key => $value) {
						$bbs_ext_types[$key] = $value;
					}
					$updates1[] = "`bbs_ext_types` = '$bbs_ext_types'";
				}
				
				$dbqry="
					UPDATE `$db_table_bbs_cfg` SET
				";
				$dbqry .= implode (',', $updates1);
				$dbqry .= " WHERE `bbs_num` = '$R1[bbs_num]'";
				query($dbqry,$dbcon);
			}
		}
//		rg_href("board_edit.php?$p_str&mode=edit&bbs_num=$bbs_num");
		rg_href("board_list.php?$p_str&page=$page");
	}

	if($mode!='edit') {
		$R[bbs_charset]='euc-kr';
		$R[bbs_width]='100%';
		$R[bbs_align]='center';
		$R[bbs_file_count]=2;
		$R[bbs_link_count]=2;
		$R[bbs_list_count]=20;
		$R[bbs_page_count]=10;
		$R[bbs_write_time]=10;
		$R[bbs_new_time]=86400;
		$R[bbs_file1_size]=2048000;
		$R[bbs_file2_size]=2048000;
		$R[bbs_title_prefix]='[답변]';
		$R[bbs_name_suffix]='님의 글입니다.';
		$R[bbs_quota_mark]='>';
		$R[bbs_act_after]='0';
		$R[bbs_list_date_disp]='%Y-%m-%d';
		$R[bbs_view_date_disp]='%Y-%m-%d %H:%M:%S';
		$R[bbs_html_text] = 'script,xml';
             $R[bbs_deny_word] = '방콕,꼬꼬,선불폰,막폰,URL,싸이,투데이,방문자,추적,버그,boris,현대남,현대여,aphsun.info,목카드,도박,장비,특수렌즈,마킹카드,공장목,표시목,필승,화투,포르노,뽀르노,야동,화상채팅,대박이벤트,영계하고,데이또,재미짱,승률이,테크노,(바)카라,5000만원,입출금,생방송,바@카@라,천만원,키스,대박회원급증,용돈,㈓㈘㈑,강원랜드,야동,정력제,시알리스,비아그라,바카라,바/카/라,바카현이,섹스,폰섹,카지노,㉥┝㉪┝㉣┝,8억,추천id,추/천/인,바☆카☆라,바(카)라,남근확대,무료자료,━★,viagra,비아그라,sialis,시알리스,씨알리스,동거,섹스,viagra,비아그라,sialis,동거,섹스,프릴리지,상륙,아시는분만,신개념,바다이야기,피싱걸,황금성,물뽕,게임장,20원방,100원방,200원방,황 금 성,무료증정,경마,로얄,홍콩,부업,목카드,특수렌즈,도박,토토,href,www,url,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,※,◀,▶';
		$R[bbs_point_write] = '1';
		$R[bbs_point_reply] = '1';
		$R[bbs_point_comment] = '1';
		$R[bbs_file1_ext] = '!php,php3,ph,inc,html,htm,phtml';
		$R[bbs_file2_ext] = '!php,php3,ph,inc,html,htm,phtml';

	}
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<script language="JavaScript" type="text/JavaScript">
	function all_checked(form_name,checkbox_name,chk)
	{
		eval('var f = document.'+form_name);

		for (var i=0; i<f.length; i++) { 
			if (f.elements[i].name == checkbox_name) { 
				f.elements[i].checked = chk;
			}
		}
	}
</script>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="42" align="right">
		<a href="board_edit1.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$bbs_num?>" title="기능설정"><img src="images/ab_lot1.gif" border="0"></a>&nbsp;&nbsp;<a href="../list.php?bbs_id=<?=$R[bbs_id]?>" target="_blank" title="게시판보기"><img src="images/ab_lot2.gif" border="0"></a>&nbsp;&nbsp;<a href="board_list.php?<?="$p_str&page=$page"?>" title="목록보기"><img src="images/ab_lot3.gif" border="0"></a> </td>
</tr></table>
	   <table width="850" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
    <tr>
        <td width="850" height="30" bgcolor="#F7F7F7">
            <p align="center"><span style="font-size:9pt;"><font color="#404040">도움말 구성</font></span></p>
        </td>
    </tr>
</table>
<table width="850" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
    <tr>
       <td width="40" align="center" bgcolor="#EDEDED"><b><font color="#9842E1">선택A</font></b></td>
        <td height="30"bgcolor="f7f7f7">&nbsp;선택A에 체크가 되어 있을경우에는 전체에 적용이 되며 체크박스로 표시됩니다</td>
        <td width="160" height="30" align="center" bgcolor="f7f7f7">&nbsp;<a href="javascript:all_checked('bbs_edit','all_chk[]',true)" title="(A)전체선택"><img src="images/all_choice.gif" border="0"></a>&nbsp;&nbsp;<a href="javascript:all_checked('bbs_edit','all_chk[]',false)" title="(A)선택취소"><img src="images/ch_choice.gif" border="0"></a></td>
    </tr>
    <tr>
        <td width="40" align="center" bgcolor="#EDEDED"><b><font color=#0099CC>선택G</font></b></td>
        
    <td height="30" bgcolor="f7f7f7">&nbsp;선택G에 체크가 되어 있을경우에는 동일그룹에 적용이 되며 체크박스로 
      표시됩니다</td>
        <td width="160" height="30" align="center" bgcolor="f7f7f7">&nbsp;<a href="javascript:all_checked('bbs_edit','group_chk[]',true)" title="(G)전체선택"><img src="images/all_choice.gif" border="0"></a>&nbsp;&nbsp;<a href="javascript:all_checked('bbs_edit','group_chk[]',false)" title="(G)선택취소"><img src="images/ch_choice.gif" border="0"></a></td>
    </tr>
    <tr>
        <td width="40" align="center" bgcolor="#EDEDED"><b><font color=RED>도&nbsp;움</font></b></td>
        
    <td height="30" bgcolor="f7f7f7" colspan="2">&nbsp;도움 문구는 붉은색으로 표시되며 해당 설정의 
      아래에 위치하고 있습니다</td>
    </tr>
</table>
<br>
<table width="850" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="850" height="30" align="center" bgcolor="#F7F7F7"> <font color="#404040">게시판 설정</font></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="bbs_edit" id="bbs_edit">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="<?=$mode?>">
<input name="bbs_num" type="hidden" value="<?=$bbs_num?>">
<input name="page" type="hidden" value="<?=$page?>">
        <table border="1" cellpadding="0" cellspacing="0" width="850" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td width="24" height="24" align="center" bgcolor="#f7f7f7" ><strong><font color="#0000FF">A</font></strong></td>
            <td width="24" align="center" bgcolor="#EDE8F4" ><strong><font color="#0000FF">G</font></strong></td>
            <td align="center" bgcolor="#f7f7f7" >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td align="center" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >그룹&nbsp;:&nbsp;</td>
            <td> &nbsp; <select name="bbs_gr_num" id="bbs_gr_num">
                <?
	$dbqry="
		SELECT gr_num, gr_name
		FROM `$db_table_group_cfg`
   ";
	$rs=query($dbqry,$dbcon); 
	echo rg_sql_html_option($rs,'gr_num','gr_name',$R[bbs_gr_num]);
	mysql_free_result($rs);
?>
              </select> </td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td width="160" align="right" bgcolor="#f7f7f7">게시판아이디&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_id" type="text" id="bbs_id" value="<?=$R[bbs_id]?>" size="50" <?=($mode=='edit')?'readonly':''?> required itemname='게시판아이디'> 
              <font color="#FF0000"> (필수,공백없이 영어,숫자로 입력)</font></td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >게시판이름&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_name" type="text" id="bbs_name" value="<?=$R[bbs_name]?>" size="50" required itemname='게시판이름'> 
              <font color="#FF0000">(필수)</font></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >타이틀&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_title" type="text" id="bbs_title" value="<?=$R[bbs_title]?>" size="50"> 
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_skin"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_skin"></td>
            <td align="right" bgcolor="#f7f7f7" >스킨&nbsp;:&nbsp;</td>
            <td>&nbsp; <select name="bbs_skin" id="bbs_skin">
                <?
$skin_list = rg_get_filelist($skin_path.$skin_board_dir,'d');
echo rg_html_option($skin_list,'','',$R[bbs_skin],true);
?>
              </select> </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_bg_image"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_bg_image"></td>
            <td align="right" bgcolor="#f7f7f7" >배경이미지&nbsp;:&nbsp;</td>
            <td>&nbsp;background=&quot; <input name="bbs_bg_image" type="text" id="bbs_bg_image3" value="<?=$R[bbs_bg_image]?>" size="30"> 
              &quot;</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_bg_color"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_bg_color"></td>
            <td align="right" bgcolor="#f7f7f7" >배경색&nbsp;:&nbsp;</td>
            <td>&nbsp;bgcolor= &quot; <input name="bbs_bg_color" type="text" id="bbs_bg_color4" value="<?=$R[bbs_bg_color]?>" size="8"> 
              &quot; </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_body_tag"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_body_tag"></td>
            <td align="right" bgcolor="#f7f7f7" >BODY태그&nbsp;:&nbsp;</td>
            <td>&nbsp;&lt;body&nbsp; <input name="bbs_body_tag" type="text" id="bbs_body_tag" value="<?=$R[bbs_body_tag]?>" size="40"> 
              &gt;</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_width"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_width"></td>
            <td align="right" bgcolor="#f7f7f7" >테이블 넓이&nbsp;:&nbsp;</td>
            <td>&nbsp;width= &quot; <input name="bbs_width" type="text" id="bbs_width" value="<?=$R[bbs_width]?>" size="5"> 
              &quot;</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_align"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_align"></td>
            <td align="right" bgcolor="#f7f7f7" >정렬방식&nbsp;:&nbsp;</td>
            <td>&nbsp; <select name="bbs_align" id="bbs_align">
                <?
echo rg_html_option($doc_align_list,'','',$R[bbs_align]);
?>
              </select></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_charset"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_charset"></td>
            <td align="right" bgcolor="#f7f7f7" >언어설정&nbsp;:&nbsp;</td>
            <td>&nbsp; <select name="bbs_charset" id="bbs_charset">
                <?
echo rg_html_option($doc_encoding_list,'','',$R[bbs_charset]);
?>
              </select></td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_header_file"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_header_file"></td>
            <td align="right" bgcolor="#f7f7f7" >상단삽입파일&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_header_file" type="text" id="bbs_header_file" value="<?=$R[bbs_header_file]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_header_tag"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_header_tag"></td>
            <td align="right" bgcolor="#f7f7f7" >상단태그&nbsp;:&nbsp;</td>
            <td>&nbsp; <textarea name="bbs_header_tag" cols="50" rows="5" id="bbs_header_tag"><?=$R[bbs_header_tag]?></textarea></td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_footer_file"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_footer_file"></td>
            <td align="right" bgcolor="#f7f7f7" >하단삽입파일&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_footer_file" type="text" id="bbs_footer_file" value="<?=$R[bbs_footer_file]?>" size="50"></td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_footer_tag"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_footer_tag"></td>
            <td align="right" bgcolor="#f7f7f7" >하단태그&nbsp;:&nbsp;</td>
            <td>&nbsp; <textarea name="bbs_footer_tag" cols="50" rows="5" id="bbs_footer_tag"><?=$R[bbs_footer_tag]?></textarea></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_default_content"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_default_content"></td>
            <td align="right" bgcolor="#f7f7f7" >글내용 기본값&nbsp;:&nbsp;</td>
            <td>&nbsp; <textarea name="bbs_default_content" cols="50" rows="5" id="bbs_default_content"><?=$R[bbs_default_content]?></textarea></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_admin_list"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_admin_list"></td>
            <td align="right" bgcolor="#f7f7f7" >운영자아이디목록&nbsp;:&nbsp;<br>
              <br> 
              <input name="button" type=button class=button onclick="popup_mb_list('bbs_edit', './','bbs_admin_list','','mb_id','1')" value='회원선택' style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;">&nbsp;&nbsp;&nbsp; 
            </td>
            <td>&nbsp; <textarea name="bbs_admin_list" cols="50" rows="5" id="bbs_admin_list"><?=$R[bbs_admin_list]?></textarea> 
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_deny_write_ip"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_deny_write_ip"></td>
            <td align="right" bgcolor="#f7f7f7" >쓰기금지IP&nbsp;:&nbsp;</td>
            <td>&nbsp; <textarea name="bbs_deny_write_ip" cols="50" rows="5" id="bbs_deny_write_ip"><?=$R[bbs_deny_write_ip]?></textarea></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_deny_read_ip"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_deny_read_ip"></td>
            <td align="right" bgcolor="#f7f7f7" >접근금지IP&nbsp;:&nbsp;</td>
            <td>&nbsp; <textarea name="bbs_deny_read_ip" cols="50" rows="5" id="bbs_deny_read_ip"><?=$R[bbs_deny_read_ip]?></textarea></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_deny_word"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_deny_word"></td>
            <td align="right" bgcolor="#f7f7f7" >금지단어&nbsp;:&nbsp;</td>
            <td>&nbsp; <textarea name="bbs_deny_word" cols="50" rows="5" id="bbs_deny_word"><?=$R[bbs_deny_word]?></textarea></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_html_text"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_html_text"></td>
            <td align="right" bgcolor="#f7f7f7" >HTML불가 태그&nbsp;:&nbsp;</td>
            <td>&nbsp; <textarea name="bbs_html_text" cols="50" rows="5" id="bbs_html_text"><?=$R[bbs_html_text]?></textarea></td>
          </tr>
          <!--
          <tr> 
            <td height="22" align="center" bgcolor="silver" class="line1" >첨부파일수</td>
            <td class="line1" ><input name="bbs_file_count" type="text" id="bbs_file_count" value="<?=$R[bbs_file_count]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="center" bgcolor="silver" class="line1" >링크사용수</td>
            <td class="line1" ><input name="bbs_link_count" type="text" id="bbs_link_count" value="<?=$R[bbs_link_count]?>"></td>
          </tr>
-->
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_file1_ext"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_file1_ext"></td>
            <td align="right" bgcolor="#f7f7f7" >첫번째 업로드 확장자&nbsp;:&nbsp; </td>
            <td>&nbsp; <input name="bbs_file1_ext" type="text" id="bbs_file1_ext" value="<?=$R[bbs_file1_ext]?>" size="40"> 
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_file2_ext"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_file2_ext"></td>
            <td align="right" bgcolor="#f7f7f7" >두번째 업로드 확장자&nbsp;:&nbsp; </td>
            <td>&nbsp; <input name="bbs_file2_ext" type="text" id="bbs_file2_ext" value="<?=$R[bbs_file2_ext]?>" size="40"> 
            </td>
          </tr>
          <tr> 
            <td height="22" colspan="2" align="center" valign="middle" bgcolor="#f7f7f7" ><b><font color="#FF0000">도움</font></b></td>
            <td align="right" bgcolor="#f7f7f7" ><font color="#404040">업로드 확장자 
              도움말&nbsp;:&nbsp;</font></td>
            <td>&nbsp;<font color=red>업로드 가능한 확장자의 경우에만 ,로 분리합니다. 첫글자가 !로 시작시에는 
              업로드를 할 수 없습니다</font></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_file1_size"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_file1_size"></td>
            <td align="right" bgcolor="#f7f7f7" >첫번째 첨부파일크기&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_file1_size" type="text" id="bbs_file1_size" value="<?=$R[bbs_file1_size]?>" size="30"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_file2_size"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_file2_size"></td>
            <td align="right" bgcolor="#f7f7f7" >두번째 첨부파일크기&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_file2_size" type="text" id="bbs_file2_size" value="<?=$R[bbs_file2_size]?>" size="30"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_list_count"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_list_count"></td>
            <td align="right" bgcolor="#f7f7f7" >페이지당 목록 개수&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_list_count" type="text" id="bbs_list_count" dir="rtl" value="<?=$R[bbs_list_count]?>" size="3"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_page_count"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_page_count"></td>
            <td align="right" bgcolor="#f7f7f7" >페이지 이동메뉴 이동범위&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_page_count" type="text" id="bbs_page_count" dir="rtl" value="<?=$R[bbs_page_count]?>" size="3"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_act_after"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_act_after"></td>
            <td align="right" bgcolor="#f7f7f7" >글쓰기,수정후 이동페이지&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_act_after" type="text" id="bbs_act_after" value="<?=$R[bbs_act_after]?>" size="50">
            </td>
          </tr>
          <tr> 
            <td height="22" colspan="2" align="center" valign="middle" bgcolor="#f7f7f7" ><b><font color="#FF0000">도움</font></b></td>
            <td align="right" bgcolor="#f7f7f7" ><font color=#404040>도움말&nbsp;:&nbsp;</font></td>
            <td>&nbsp;<font color=red>0 : 글목록보기, 1:쓴글보기, 직접입력</font></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_write_time"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_write_time"></td>
            <td align="right" bgcolor="#f7f7f7" >도배기준시간&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_write_time" type="text" id="bbs_write_time" value="<?=$R[bbs_write_time]?>" size="10">
              초단위로 입력</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_new_time"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_new_time"></td>
            <td align="right" bgcolor="#f7f7f7" >new 아이콘시간&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_new_time" type="text" id="bbs_new_time" value="<?=$R[bbs_new_time]?>" size="10">
              초단위로 입력해주세요.(ex:86400 = 1일)</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_title_prefix"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_title_prefix"></td>
            <td align="right" bgcolor="#f7f7f7" >제목접두문자( RE: )&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_title_prefix" type="text" id="bbs_title_prefix" value="<?=$R[bbs_title_prefix]?>" size="30"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_name_suffix"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_name_suffix"></td>
            <td align="right" bgcolor="#f7f7f7" >원글표제인용(님글입니다.)&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_name_suffix" type="text" id="bbs_name_suffix" value="<?=$R[bbs_name_suffix]?>" size="50"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_quota_mark"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_quota_mark"></td>
            <td align="right" bgcolor="#f7f7f7" >원글인용부호( &gt; )&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_quota_mark" type="text" id="bbs_quota_mark" value="<?=$R[bbs_quota_mark]?>" size="5"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_list_date_disp"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_list_date_disp"></td>
            <td align="right" bgcolor="#f7f7f7" >목록일자 표시형식&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_list_date_disp" type="text" id="bbs_list_date_disp" value="<?=$R[bbs_list_date_disp]?>" size="50"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_view_date_disp"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_view_date_disp"></td>
            <td align="right" bgcolor="#f7f7f7" >글보기 일자 표시형식&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_view_date_disp" type="text" id="bbs_view_date_disp" value="<?=$R[bbs_view_date_disp]?>" size="50"></td>
          </tr>
          <!--          
					<tr> 
            <td height="22" align="center" bgcolor="silver" class="line1" >전달메일접두</td>
            <td class="line1" ><input name="bbs_forward_prefix" type="text" id="bbs_forward_prefix" value="<?=$R[bbs_forward_prefix]?>" size="50"></td>
          </tr>
-->
          <tr> 
            <td height="22" colspan="2" align="center" valign="middle" bgcolor="#f7f7f7" ><b><font color="#FF0000">도움</font></b></td>
            <td align="right" bgcolor="#f7f7f7" ><font color=#404040>날자 표시 형식 
              도움말&nbsp;:&nbsp;</font></td>
            <td>&nbsp;<font color=red>%Y : 년도, %m : 월, %d : 일, %H : 시간, %M : 분, 
              %S : 초 (strftime 함수 참고하세요)</font></td>
          </tr>
        </table>
				<br>
        <table border="1" cellpadding="0" cellspacing="0" width="850" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td width="24" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_point_write"></td>
            <td width="24" align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_point_write"></td>
            <td width="160" align="right" bgcolor="#f7f7f7" >글쓰기 포인트&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_point_write" type="text" id="bbs_point_write" dir="rtl" value="<?=$R[bbs_point_write]?>" size="10"></td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_point_reply"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_point_reply"></td>
            <td align="right" bgcolor="#f7f7f7" >응답글 포인트&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_point_reply" type="text" id="bbs_point_reply" dir="rtl" value="<?=$R[bbs_point_reply]?>" size="10"></td>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_point_comment"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_point_comment"></td>
            <td align="right" bgcolor="#f7f7f7" >코멘트 포인트&nbsp;:&nbsp;</td>
            <td>&nbsp; <input name="bbs_point_comment" type="text" id="bbs_point_comment" dir="rtl" value="<?=$R[bbs_point_comment]?>" size="10"></td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_ext_1"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_ext_1"></td>
            <td align="right" bgcolor="#f7f7f7" >추가입력1&nbsp;:&nbsp;</td>
            <td>&nbsp;형&nbsp;태&nbsp;:&nbsp; <select name="bbs_ext_type1" id="bbs_ext_type1">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$R[bbs_ext_types][1]);
?>
              </select> <br> &nbsp;항목명: 
              <input name="bbs_ext_name1" type="text" id="bbs_ext_name1" value="<?=$R[bbs_ext_name1]?>"> 
              <br>
              &nbsp;설정값: 
              <input name="bbs_ext_value1" type="text" id="bbs_ext_value1" value="<?=$R[bbs_ext_value1]?>" size="50"> 
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_ext_2"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_ext_2"></td>
            <td align="right" bgcolor="#f7f7f7" >추가입력2&nbsp;:&nbsp;</td>
            <td>&nbsp;형&nbsp;태&nbsp;:&nbsp; <select name="bbs_ext_type2" id="bbs_ext_type2">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$R[bbs_ext_types][2]);
?>
              </select> <br> &nbsp;항목명: 
              <input name="bbs_ext_name2" type="text" id="bbs_ext_name2" value="<?=$R[bbs_ext_name2]?>"> 
              <br>
              &nbsp;설정값: 
              <input name="bbs_ext_value2" type="text" id="bbs_ext_value2" value="<?=$R[bbs_ext_value2]?>" size="50"> 
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_ext_3"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_ext_3"></td>
            <td align="right" bgcolor="#f7f7f7" >추가입력3&nbsp;:&nbsp;</td>
            <td>&nbsp;형&nbsp;태&nbsp;:&nbsp; <select name="bbs_ext_type3" id="bbs_ext_type3">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$R[bbs_ext_types][3]);
?>
              </select> <br> &nbsp;항목명: 
              <input name="bbs_ext_name3" type="text" id="bbs_ext_name3" value="<?=$R[bbs_ext_name3]?>"> 
              <br>
              &nbsp;설정값: 
              <input name="bbs_ext_value3" type="text" id="bbs_ext_value3" value="<?=$R[bbs_ext_value3]?>" size="50"> 
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_ext_4"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_ext_4"></td>
            <td align="right" bgcolor="#f7f7f7" >추가입력4&nbsp;:&nbsp;</td>
            <td>&nbsp;형&nbsp;태&nbsp;:&nbsp; <select name="bbs_ext_type4" id="bbs_ext_type4">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$R[bbs_ext_types][4]);
?>
              </select> <br> &nbsp;항목명: 
              <input name="bbs_ext_name4" type="text" id="bbs_ext_name4" value="<?=$R[bbs_ext_name4]?>"> 
              <br>
              &nbsp;설정값: 
              <input name="bbs_ext_value4" type="text" id="bbs_ext_value4" value="<?=$R[bbs_ext_value4]?>" size="50"> 
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" ><input name="all_chk[]" type="checkbox" id="all_chk[]" value="bbs_ext_5"></td>
            <td align="center" bgcolor="#EDE8F4" ><input name="group_chk[]" type="checkbox" id="group_chk[]" value="bbs_ext_5"></td>
            <td align="right" bgcolor="#f7f7f7" >추가입력5&nbsp;:&nbsp;</td>
            <td>&nbsp;형&nbsp;태&nbsp;:&nbsp; <select name="bbs_ext_type5" id="bbs_ext_type5">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$R[bbs_ext_types][5]);
?>
              </select> <br> &nbsp;항목명: 
              <input name="bbs_ext_name5" type="text" id="bbs_ext_name5" value="<?=$R[bbs_ext_name5]?>"> 
              <br>
              &nbsp;설정값: 
              <input name="bbs_ext_value5" type="text" id="bbs_ext_value5" value="<?=$R[bbs_ext_value5]?>" size="50"> 
            </td>
          </tr>
          <?=($mode=='edit')?'':'<!--'?>
          <tr> 
            <td colspan="2" align="center" valign="middle" bgcolor="#f7f7f7" ><b><font color="#FF0000">도움</font></b></td>
            <td align="right" bgcolor="#f7f7f7" ><font color="#404040">추가입력값&nbsp;예제&nbsp;:&nbsp;</font></td>
            <td> <table border="0" cellpadding="0" cellspacing="3" width="90%">
                <tr> 
                  <td width="20%" align="right"><font color="#FF0000">라디오버튼 :&nbsp; 
                    </font></td>
                  <td width="30%"><font color="#FF0000">!값1|값2|값3|값4</font></td>
                  <td width="20%" align="right"><font color="#FF0000">&nbsp;텍스트입력 
                    :&nbsp;</font></td>
                  <td width="30%"><font color="#FF0000">required|itemname|value|size</font></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">셀렉트 :&nbsp; </font></td>
                  <td><font color="#FF0000">값1|!값2|값3|값4</font></td>
                  <td align="right"><font color="#FF0000">체크박스 :&nbsp; </font></td>
                  <td><font color="#FF0000">!{}표시이름|값</font></td>
                </tr>
                <tr> 
                  <td align="right"><font color="#FF0000">텍스트영역 :&nbsp;</font></td>
                  <td><font color="#FF0000">required|itemname|cols|rows</font></td>
                  <td><font color="#FF0000">&nbsp;</font></td>
                  <td><font color="#FF0000">&nbsp;</font></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" valign="middle" bgcolor="#f7f7f7" >&nbsp;</td>
            <td align="center" bgcolor="#EDE8F4" >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >게시판 생성일&nbsp;:&nbsp;</td>
            <td> &nbsp; 
              <?=rg_date($R[bbs_reg_date])?>
            </td>
          </tr>
          <?=($mode=='edit')?'':'-->'?>
        </table>
        <br>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="850">
          <tr>
            <td align="center"><input type="submit" name="Submit2" value=" 확     인 " style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
            </td>
          </tr>
        </table>
        <br>
        <table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"> <a href="board_edit1.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$bbs_num?>" title="기능설정"><img src="images/ab_lot1.gif" border="0"></a>&nbsp;&nbsp;<a href="../list.php?bbs_id=<?=$R[bbs_id]?>" target="_blank" title="게시판보기"><img src="images/ab_lot2.gif" border="0"></a>&nbsp;&nbsp;<a href="board_list.php?<?="$p_str&page=$page"?>" title="목록보기"><img src="images/ab_lot3.gif" border="0"></a> 
            </td>
          </tr>
        </table>
        </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>
