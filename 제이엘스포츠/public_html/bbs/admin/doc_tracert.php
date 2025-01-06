<?
	$site_path = '../';
	$site_url = '../';
	require_once($site_path."include/admin.lib.inc.php");
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<form name="doc_search" method="get">
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">검색:
        <select name="ss[0]" id="ss[0]">
          <?
	$ss_list = array("제목","아이디","이름","이메일","아이피","내용");
	while(list($key,$value)=each($ss_list))
    if ($key==$ss[0])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
?>
        </select>
        <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14">
        <input type="submit" name="검색" value="검색" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;">
        <input type="button" value="취소" onclick="location.href='?'" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;">
&nbsp;&nbsp;
      <input type="button" name="새로고침" value="새로고침" onclick="location.reload()" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"></td>
  </tr>
</table>
</form>
<table>
	<tr>
		<td>
<?
if($kw!='') {
  $where_str='';
  $where_str1='';
	for($i=0;$i<count($ss_key);$i++) {
    switch ($ss_key[$i]) {
			/***********************************************************************/
			// 검색어로 검색
			// 	$ss_list = array("제목","아이디","이름","이메일","아이피","내용");
			case 0 : 
				if(!empty($kw)) {
					switch ($ss[$ss_key[$i]]) {
						case 0 : 
									$where_str .= " AND `rg_title` LIKE '%$kw%'";
									$where_str1 .= " AND 0";
									break;
						case 1 : 
									$where_str .= " AND `mb_id` LIKE '%$kw%'";
									$where_str1 .= " AND `mb_id` LIKE '%$kw%'";
									break;
						case 2 : 
									$where_str .= " AND `rg_name` LIKE binary '%$kw%' ";
									$where_str1 .= " AND `cmt_name` LIKE binary '%$kw%' ";
									break;
						case 3 : 
									$where_str .= " AND `rg_email` LIKE '%$kw%'";
									$where_str1 .= " AND `cmt_email` LIKE '%$kw%'";
									break;
						case 4 : 
									$where_str .= " AND `rg_reg_ip` LIKE '%$kw%'";
									$where_str1 .= " AND `cmt_reg_ip` LIKE '%$kw%'";
									break;
						case 5 : 
									$where_str .= " AND `rg_content` LIKE '%$kw%'";
									$where_str1 .= " AND `cmt_comment` LIKE '%$kw%'";
									$jumin = get_password_str($kw);
									break;
					}
				}
				break; 
			/***********************************************************************/
			// 필터 조건에 의한 필터링
      case 1 : // 회원구분
				if($ss[$ss_key[$i]] != '-1') {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `mb_state` ";
				}
				break;
    }
	}
	
	$dbqry="
		SELECT *
		FROM `$db_table_bbs_cfg`
		ORDER BY bbs_gr_num, bbs_title
	";
	$rs=query($dbqry,$dbcon);
	
	while($R=mysql_fetch_array($rs)) {
		$bbs_table = $db_table_prefix.$R[bbs_id].$db_table_suffix_body;
		$commant_table = $db_table_prefix.$R[bbs_id].$db_table_suffix_comment;

		if($ss[0]=='1') { // 아이디로 검색인경우
			$bbs_table1 ="$bbs_table JOIN $db_table_member";
			$where_str_1 = $where_str." AND {$bbs_table}.rg_mb_num = {$db_table_member}.mb_num";

			$commant_table1 ="$commant_table JOIN $db_table_member";
			$where_str1_1 = $where_str1." AND {$commant_table}.cmt_mb_num = {$db_table_member}.mb_num";
		}
	
		// 글내용
		$dbqry="
			SELECT `$bbs_table`.*
			FROM $bbs_table1
			WHERE (1=1) $where_str_1
			$order_str
			LIMIT 0,100";
		$rs1=query($dbqry,$dbcon);
		while ($data=mysql_fetch_array($rs1)) {
			$u_view = "{$site_url}view.php?bbs_id=$R[bbs_id]&doc_num=";
			$u_edit = "{$site_url}edit.php?bbs_id=$R[bbs_id]&doc_num=";
			$u_delete = "{$site_url}delete.php?bbs_id=$R[bbs_id]&doc_num=";
?>  <tr>
    <td><br><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?=$data[rg_name]?></td>
        <td><?=$data[rg_email]?></td>
        <td>글쓴날자</td>
        <td><a href="<?=$u_edit?><?=$data['rg_doc_num']?>" target="rg_pop">수정</a></td>
        <td><a href="<?=$u_delete?><?=$data['rg_doc_num']?>" target="rg_pop">삭제</a></td>
        <td><a href="<?=$u_delete?><?=$data['rg_doc_num']?>&act=confirm_ok" target="rg_pop" style="font-weight: bold"><font color="#FF0000">바로삭제</font></a></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><a href='<?=$u_view?><?=$data['rg_doc_num']?>' target="rg_pop"><?=rg_get_text($data['rg_title'],1)?></a></td>
        </tr>
      </table>
      <?=rg_cut_string(rg_get_text($data['rg_content'],1),255,'...')?>
			</td>
  </tr>
<?
		}
		
		// 코멘트 뽑기
		$dbqry="
			SELECT `$commant_table`.*
			FROM $commant_table1
			WHERE (1=1) $where_str1_1
			$order_str
			LIMIT 0,100";
		$rs1=query($dbqry,$dbcon);
		while ($data=mysql_fetch_array($rs1)) {
			$u_view = "{$site_url}view.php?bbs_id=$R[bbs_id]&doc_num=";
			$u_comment_delete = "{$site_url}comment.php?bbs_id=$R[bbs_id]&type=delete&cmt_num=";			
?>
	<tr>
    <td><br><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?=$data[cmt_name]?></td>
        <td><?=$data[cmt_email]?></td>
        <td>글쓴날자</td>
        <td>수정</td>
        <td><a href="<?=$u_comment_delete?><?=$data['cmt_num']?>" target="rg_pop">삭제</a></td>
				<td><a href="<?=$u_comment_delete?><?=$data['cmt_num']?>&act=confirm_ok" target="rg_pop"><font color="#FF0000"><b>바로삭제</b></font></a></td>
      </tr>
    </table>
			<a href='<?=$u_view?><?=$data['cmt_doc_num']?>#c<?=$data['cmt_num']?>' target="rg_pop"><?=rg_cut_string(rg_get_text($data['cmt_comment'],1),255,'...')?></a>
			</td>
  </tr>
<?
		}
	}
}
?>
		</td>
	</tr>
</table>
<? include("admin.footer.php"); ?>