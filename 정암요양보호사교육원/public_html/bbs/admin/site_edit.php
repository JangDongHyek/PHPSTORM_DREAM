<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
	function html_form_sel($i){
		global $site,$sel_join_form_field;
		$_result = "<select name=\"st_join_form_cfg[$i]\">";
		$_result .= rg_html_option($sel_join_form_field,'','',$site[st_join_form_cfg][$i]);
		$_result .= "</select>";
		return $_result;
	}
	
	if($act) {
		while(list($key,$value)=each($HTTP_POST_VARS))
			if(is_string($value))
				$GLOBALS[$key]=trim($value);

		for($i=0;$i<15;$i++)
			$st_join_form_cfg[$i] = (strlen($st_join_form_cfg[$i])==1) ? 
			                     $st_join_form_cfg[$i]:'';
		ksort($st_join_form_cfg);
		$st_join_form_cfg = implode (',', $st_join_form_cfg);

		for($i=0;$i<11;$i++)
			$st_mb_ext_type[$i] = (strlen($st_mb_ext_type[$i])==1) ? 
			                     $st_mb_ext_type[$i]:'0';
		ksort($st_mb_ext_type);
		$st_mb_ext_types = implode ('', $st_mb_ext_type);
		
	
		$dbqry="
			UPDATE `$db_table_site_cfg` SET
				`st_default_group` = '$st_default_group',
				#----------------추가시작-----------------
				`st_join_agreement` = '$st_join_agreement',								# 약관 사용 체크
				`st_joining_check` = '$st_joining_check',									# 가입확인여부
				`st_join_agreement_url` = '$st_join_agreement_url',						# 약관 iframe url
				`st_privacy_protect_policy_url` = '$st_privacy_protect_policy_url',	# 개인정보 보호정책 url
				`st_name_validate` = '$st_name_validate',									# 실명확인 사용
				#----------------추가끝-----------------
				`st_join_ok_url` = '$st_join_ok_url',
				`st_join_auto_login` = '$st_join_auto_login',
				`st_login_ok_url` = '$st_login_ok_url',
				`st_logout_ok_url` = '$st_logout_ok_url',
				`st_email` = '$st_email',
				`st_site_name` = '$st_site_name',
				`st_join_form_cfg` = '$st_join_form_cfg',
				`st_default_point` = '$st_default_point',
				`st_login_point` = '$st_login_point',
				`st_today_max_point` = '$st_today_max_point',
				`st_default_level` = '$st_default_level',
				`st_default_state` = '$st_default_state',
				`st_join_out_stat` = '$st_join_out_stat',
				`st_connect_time` = '$st_connect_time',
				`st_mb_ext_types` = '$st_mb_ext_types',
				`st_mb_ext_name1` = '$st_mb_ext_name1',
				`st_mb_ext_value1` = '$st_mb_ext_value1',
				`st_mb_ext_name2` = '$st_mb_ext_name2',
				`st_mb_ext_value2` = '$st_mb_ext_value2',
				`st_mb_ext_name3` = '$st_mb_ext_name3',
				`st_mb_ext_value3` = '$st_mb_ext_value3',
				`st_mb_ext_name4` = '$st_mb_ext_name4',
				`st_mb_ext_value4` = '$st_mb_ext_value4',
				`st_mb_ext_name5` = '$st_mb_ext_name5',
				`st_mb_ext_value5` = '$st_mb_ext_value5',
				`st_mb_ext_name6` = '$st_mb_ext_name6',
				`st_mb_ext_value6` = '$st_mb_ext_value6',
				`st_mb_ext_name7` = '$st_mb_ext_name7',
				`st_mb_ext_value7` = '$st_mb_ext_value7',
				`st_mb_ext_name8` = '$st_mb_ext_name8',
				`st_mb_ext_value8` = '$st_mb_ext_value8',
				`st_mb_ext_name9` = '$st_mb_ext_name9',
				`st_mb_ext_value9` = '$st_mb_ext_value9',
				`st_mb_ext_name10` = '$st_mb_ext_name10',
				`st_mb_ext_value10` = '$st_mb_ext_value10'
		";
		query($dbqry,$dbcon);
		rg_href("site_edit.php");
	}
	$i = 0;
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="center"><form action="" method="post" enctype="multipart/form-data" name="site_edit" id="site_edit">
<input name="act" type="hidden" value="ok">
        <br>
        <table border="1" cellpadding="0" cellspacing="0" width="796" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><font class="semo">사이트 
                설정</font></p></td>
          </tr>
        </table>
        <br>
        <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr> 
            <td align="right" bgcolor="#f7f7f7">사이트이름&nbsp;:&nbsp;</td>
            <td ><input name="st_site_name" type="text" id="st_site_name" value="<?=$site[st_site_name]?>" size="50"></td>
          </tr>
          <tr>
            <td align="right" bgcolor="#f7f7f7">기본그룹&nbsp;:&nbsp;</td>
            <td >
              <select name="st_default_group" id="st_default_group">
                <?
echo rg_html_option($group_list,'gr_id','gr_id',$site[st_default_group])
?>
              </select> <font color="#FF0000">상하단, 태그 삽입파일 적용</font></td>
          </tr>
		  <tr> 
            <td align="right" bgcolor="#f7f7f7" >회원가입약관&nbsp;:&nbsp;</td>
            <td > <input name="st_join_agreement" type="checkbox" id="st_join_agreement" value="1" <?=($site[st_join_agreement])?'checked':''?>>
              회원가입약관사용 &nbsp;&nbsp;&nbsp;<input name="st_joining_check" type="checkbox" id="st_joining_check" value="1" <?=($site[st_joining_check])?'checked':''?>>
              회원가입여부확인
          </tr>
		  <tr> 
            <td align="right" bgcolor="#f7f7f7" >&nbsp;약관 iframe URL&nbsp;:&nbsp;</td>
            <td > <input name="st_join_agreement_url" type="text" id="st_join_agreement_url" value="<?=$site[st_join_agreement_url]?>" size="50"></td>
          </tr>
		  <tr> 
            <td align="right" bgcolor="#f7f7f7" >&nbsp;개인정보 보호정책 iframe URL&nbsp;:&nbsp;</td>
            <td > <input name="st_privacy_protect_policy_url" type="text" id="st_privacy_protect_policy_url" value="<?=$site[st_privacy_protect_policy_url]?>" size="50"></td>
          </tr>
		  <tr> 
            <td align="right" bgcolor="#f7f7f7" >회원가입 기타&nbsp;:&nbsp;</td>
            <td><input name="st_name_validate" type="checkbox" id="st_name_validate" value="1" <?=($site[st_name_validate])?'checked':''?>>  
              실명인증사용 
          </tr>
          <tr> 
            <td width="150" align="right" bgcolor="#f7f7f7">회원가입후 이동할 URL&nbsp;:&nbsp;</td>
            <td ><input name="st_join_ok_url" type="text" id="st_join_ok_url" value="<?=$site[st_join_ok_url]?>" size="50"> 
            </td>
          </tr>
          <tr> 
            <td align="right" bgcolor="#f7f7f7" >가입후 자동로그인&nbsp;:&nbsp;</td>
            <td > <input name="st_join_auto_login" type="checkbox" id="st_join_auto_login" value="1" <?=($site[st_join_auto_login])?'checked':''?>>
              자동로그인 </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >로그인후 이동할 URL&nbsp;:&nbsp;</td>
            <td ><input name="st_login_ok_url" type="text" id="st_login_ok_url" value="<?=$site[st_login_ok_url]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >관리이메일&nbsp;:&nbsp;</td>
            <td ><input name="st_email" type="text" id="st_email" value="<?=$site[st_email]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >로그아웃후 이동할 URL&nbsp;:&nbsp;</td>
            <td ><input name="st_logout_ok_url" type="text" id="st_logout_ok_url" value="<?=$site[st_logout_ok_url]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >기본포인트&nbsp;:&nbsp;</td>
            <td ><input name="st_default_point" type="text" id="st_default_point" dir="rtl" value="<?=$site[st_default_point]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >하루에 최고포인트&nbsp;:&nbsp;</td>
            <td ><input name="st_today_max_point" type="text" id="st_today_max_point" dir="rtl" value="<?=$site[st_today_max_point]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >로그인포인트&nbsp;:&nbsp;</td>
            <td ><input name="st_login_point" type="text" id="st_login_point" dir="rtl" value="<?=$site[st_login_point]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >기본레벨&nbsp;:&nbsp;</td>
            <td > <select name="st_default_level">
                <?=rg_html_option($levels,'','',"$site[st_default_level]")?>
              </select></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >초기회원상태&nbsp;:&nbsp;</td>
            <td > 
              <?
echo rg_html_radio($mb_states,'st_default_state','','',$site[st_default_state])
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >탈퇴삭제&nbsp;:&nbsp;</td>
            <td > 
              <?
echo rg_html_radio(array(0=>'즉시삭제',1=>'탈퇴상태로만체크'),'st_join_out_stat','','',$site[st_join_out_stat])
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >접속자 체크시간&nbsp;:&nbsp;</td>
            <td ><input name="st_connect_time" type="text" id="st_connect_time" dir="rtl" value="<?=$site[st_connect_time]?>" size="10">
              <font color="#FF0000">초단위 0 이면 사용하지 않음 (ex:60 = 1분)</font></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목1&nbsp;:&nbsp;</td>
            <td > <select name="st_mb_ext_type[1]" id="st_mb_ext_type[1]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][1]);
?>
              </select> <input name="st_mb_ext_name1" type="text" id="st_mb_ext_name1" value="<?=$site[st_mb_ext_name1]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value1" type="text" id="st_mb_ext_value1" value="<?=$site[st_mb_ext_value1]?>" size="50"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목2&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[2]" id="st_mb_ext_type[2]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][2]);
?>
              </select> <input name="st_mb_ext_name2" type="text" id="st_mb_ext_name2" value="<?=$site[st_mb_ext_name2]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value2" type="text" id="st_mb_ext_value2" value="<?=$site[st_mb_ext_value2]?>" size="50"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목3&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[3]" id="st_mb_ext_type[3]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][3]);
?>
              </select> <input name="st_mb_ext_name3" type="text" id="st_mb_ext_name3" value="<?=$site[st_mb_ext_name3]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value3" type="text" id="st_mb_ext_value3" value="<?=$site[st_mb_ext_value3]?>" size="50"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목4&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[4]" id="st_mb_ext_type[4]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][4]);
?>
              </select> <input name="st_mb_ext_name4" type="text" id="st_mb_ext_name4" value="<?=$site[st_mb_ext_name4]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value4" type="text" id="st_mb_ext_value4" value="<?=$site[st_mb_ext_value4]?>" size="50"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목5&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[5]" id="st_mb_ext_type[5]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][5]);
?>
              </select> <input name="st_mb_ext_name5" type="text" id="st_mb_ext_name5" value="<?=$site[st_mb_ext_name5]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value5" type="text" id="st_mb_ext_value5" value="<?=$site[st_mb_ext_value5]?>" size="50"></td>
          </tr>
		  <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목6&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[6]" id="st_mb_ext_type[6]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][6]);
?>
              </select> <input name="st_mb_ext_name6" type="text" id="st_mb_ext_name6" value="<?=$site[st_mb_ext_name6]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value6" type="text" id="st_mb_ext_value6" value="<?=$site[st_mb_ext_value6]?>" size="50"></td>
          </tr>
		  <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목7&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[7]" id="st_mb_ext_type[7]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][7]);
?>
              </select> <input name="st_mb_ext_name7" type="text" id="st_mb_ext_name7" value="<?=$site[st_mb_ext_name7]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value7" type="text" id="st_mb_ext_value7" value="<?=$site[st_mb_ext_value7]?>" size="50"></td>
          </tr>
		  <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목8&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[8]" id="st_mb_ext_type[8]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][8]);
?>
              </select> <input name="st_mb_ext_name8" type="text" id="st_mb_ext_name8" value="<?=$site[st_mb_ext_name8]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value8" type="text" id="st_mb_ext_value8" value="<?=$site[st_mb_ext_value8]?>" size="50"></td>
          </tr>
		  <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목9&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[9]" id="st_mb_ext_type[9]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][9]);
?>
              </select> <input name="st_mb_ext_name9" type="text" id="st_mb_ext_name9" value="<?=$site[st_mb_ext_name9]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value9" type="text" id="st_mb_ext_value9" value="<?=$site[st_mb_ext_value]?>" size="50"></td>
          </tr>
		  <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목10&nbsp;:&nbsp;</td>
            <td ><select name="st_mb_ext_type[10]" id="st_mb_ext_type[10]">
                <option value="0">사용안함</option>
                <?
echo rg_html_option($ext_types,'','name',$site[st_mb_ext_types][10]);
?>
              </select> <input name="st_mb_ext_name10" type="text" id="st_mb_ext_name10" value="<?=$site[st_mb_ext_name10]?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >추가항목설정값&nbsp;:&nbsp;</td>
            <td ><input name="st_mb_ext_value10" type="text" id="st_mb_ext_value10" value="<?=$site[st_mb_ext_value10]?>" size="50"></td>
          </tr>
		  <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" > 참고 &nbsp;:&nbsp;</td>
            <td >text  : required|itemname|value|size<br>
				  textarea : required|itemname|cols|rows<br>
				  라디오버튼 :   !값1|값2|값3|값4 <br>
				  셀렉트 :   값1|!값2|값3|값4<br>
				  체크박스 :   !{}표시이름|값 </td>
          </tr>
        </table>
        <br>
        <table border="1" cellpadding="0" cellspacing="0" width="796" bordercolordark="white" bordercolorlight="#E1E1E1">
          <tr> 
            <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><font class="semo">회원 
                가입폼 설정</font></p></td>
          </tr>
        </table>
        <br>
        <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr> 
            <td width="15%" height="22" align="right" bgcolor="#f7f7f7" >닉네임&nbsp;:&nbsp;</td>
            <td width="35%" > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td width="15%" align="right" bgcolor="#f7f7f7" >이름&nbsp;:&nbsp;</td>
            <td width="35%" > 
              <?
echo html_form_sel(++$i);
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >이메일&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td align="right" bgcolor="#f7f7f7" >MSN아이디&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >홈페이지주소&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td align="right" bgcolor="#f7f7f7" >전화번호&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >휴대폰번호&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td align="right" bgcolor="#f7f7f7" >주민등록번호&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >생일&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td align="right" bgcolor="#f7f7f7" >주소&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >성별&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td height="22" align="right" bgcolor="#f7f7f7" >직업&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >취미&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td align="right" bgcolor="#f7f7f7" >사진&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >아이콘&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td >&nbsp; </td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td >&nbsp;</td>
            <td align="right" bgcolor="#f7f7f7" >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
          <tr> 
            <td height="22" align="right" bgcolor="#f7f7f7" >서명&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
            <td align="right" bgcolor="#f7f7f7" >소개&nbsp;:&nbsp;</td>
            <td > 
              <?
echo html_form_sel(++$i);
?>
            </td>
          </tr>
          <tr> 
            <td height="22" align="center" bgcolor="#f7f7f7" >&nbsp;</td>
            <td >&nbsp;</td>
            <td align="center" bgcolor="#f7f7f7" >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
        </table>
        <br>
        <input type="submit" name="Submit" value=" 확 인 " style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;">
      </form></td>
  </tr>
</table>
<? include("admin.footer.php"); ?>