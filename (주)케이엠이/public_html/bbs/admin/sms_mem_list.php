<script language="JavaScript" type="text/JavaScript">
<!--
function send_mail()
{
	var cnt =	parseInt(document.form1.MemberNumber.value);
	cnt = cnt +1;
	var flag = 0;

	for(i=3; i<cnt+3; i++)
	{	
		//alert(document.forms[0].elements[i].value);	 //---> 찍은 회원의 정보와 일치하는 값인지 아닌지 알아보는 구문
		if(document.forms[0].elements[i].checked == true)
		{
			flag = 1;
		}
	}

	if(flag == 0 && document.form1.mail_option[1].checked == true)
		alert("메일을 발송할 회원을 선택해 주세요.");
	else
	{
		document.form1.target = "_blank"
		document.form1.action = "mailing_list.asp";
		document.form1.submit();
	}
}

function search_check()
{
	var fm = document.form1;

	if(fm.searchRange.value != "all" && fm.searchRange.value != "sex" && fm.searchRange.value != "age" && fm.searchWord.value == "" && fm.searchWord.value == "strWaitDay" && fm.searchWord.value == "strLeaveDay")
	{
		alert("검색어를 입력해 주세요.");
		fm.searchWord.focus();
	}
	else
	{
		fm.schSql.value = "";
		fm.target = "_top";
		fm.action = "/admin/popup_sms_address.asp";
		fm.submit();
	}
}

function all_check()
{
	var cnt =	parseInt(document.form1.MemberNumber.value);
	cnt = cnt +1;

	if(document.form1.yesno.value == "no")
	{
		for(i=3; i<cnt+3; i++)
		{		
			document.forms[0].elements[i].checked = true
		}
		document.form1.yesno.value = "yes"
	}else
	{
		for(i=3; i<cnt+3; i++)
		{		
			document.forms[0].elements[i].checked = false
		}
		document.form1.yesno.value = "no"
	}
}

function delete_check(num,id)
{
	flg_ok = confirm('정말로 삭제하시겠습니까?');

	if(flg_ok == true)
		location.href= "member_delete.asp?idx="+num+"&id="+id;
}

function re_check(num)
{
	flg_ok = confirm('정회원으로 복원하시겠습니까?');

	if(flg_ok == true)
		location.href= "member_re.asp?page=1&idx="+num;
}


function aa()
{
var fm = document.form1;
	alert("fdsa")
		fm.searchWord.value='';
		fm.searchWord.focus();
}

function search_view()
{
	var fm = document.form1;

	if(fm.searchRange.value != "age")
	{
		strDefault.style.display='';
		strAge.style.display='none';
	}
	else if(fm.searchRange.value == "sex")
	{
		strDefault.style.display='none';
		strAge.style.display='none';
	}
	else if(fm.searchRange.value == "age")
	{
		strDefault.style.display='none';
		strAge.style.display='';
	}
	//

	if(fm.searchRange.value == "strName")
	{
		fm.searchWord.value='회원이름을 띄어쓰기없이 입력';
		fm.searchWord.focus();
	}
	if(fm.searchRange.value == "strWifeName")
	{
		fm.searchWord.value='신부이름을 띄어쓰기없이 입력';
		fm.searchWord.focus();
	}
	if(fm.searchRange.value == "intJumin1")
	{
		fm.searchWord.value='주민번호 앞자리를 입력';
		fm.searchWord.focus();
	}
	if(fm.searchRange.value == "strMobile")
	{
		fm.searchWord.value='핸드폰뒷자리를 입력';
		fm.searchWord.focus();
	}
	if(fm.searchRange.value == "strMarryDay")
	{
		fm.searchWord.value='결혼기념일을 띄어쓰기없이 입력';
		fm.searchWord.focus();
	}
	if(fm.searchRange.value == "strHusbandBirth")
	{
		fm.searchWord.value='신랑생일을 띄어쓰기없이 입력';
		fm.searchWord.focus();
	}
	if(fm.searchRange.value == "strWifeBirth")
	{
		fm.searchWord.value='신부생일을 띄어쓰기없이 입력';
		fm.searchWord.focus();
	}
	if(fm.searchRange.value == "strSupportDay")
	{
		fm.searchWord.value='불입일자를띄어쓰기없이 입력';
		fm.searchWord.focus();
	}

}

function modify(num){
	var fm = document.form1;
	fm.action = "member_modify.asp?page=1&idx="+num;
	fm.submit();
}
function viwe(num){
	var fm = document.form1;
	fm.action = "member_view.asp?page=1&idx="+num;
	fm.submit();
}
//-->
</script>
<link href="/css/default.css" rel="stylesheet" type="text/css">
<link href="../css/default.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style6 {
	color: #686465;
	font-weight: bold;
}
-->
</style>

<script language="javascript">
// 그룹 선택시 해당 목록만 재출력
function chgGroup () 
{
	f = document.form1;
	f.mode.value = 'chggroup';
	f.submit();
}


// A-Z 로 검색시
function src_alpha(fchar, lchar) 
{
	f = document.form1;
	f.mode.value = 'srcalpha';
	f.fchar.value = fchar;
	f.lchar.value = lchar;
	f.submit();
}


// 이름 또는 번호로 검색할때
function srcMember()
{
	f = document.form1;
	f.mode.value = 'srcWord';
	f.submit();

}


// 전체 멤버 체크 박스 선택
function chkAllMember()
{
	f = document.form1;
	if(f.chkAll.checked == false) {
		for(i = 0; i< f.MemberNumber.value; i++) {		
			fname = eval("f.user"+i) ;
			if(fname)
				fname.checked=false;
		}
	}
	else {
		for(i = 0; i< f.MemberNumber.value; i++) {
			fname = eval("f.user"+i) ;
			if(fname)
				fname.checked = true;
		}
	}
}

// 그룹 전송 번호 목록 추가
function insertPhone() {
	
	var fullPhone;
	var make_length;
	var form1 = document.form1;
	f = opener.signform;
if(form1.mail_option[0].checked == true){//검색 전체 전송
	var form1 = document.form1;
		form1.action = "sms_search.php";
		form1.submit();
}

if(form1.mail_option[1].checked == true){//선택회원

	for(i=0; i<= form1.MemberNumber.value ; i++) {
		fname = eval("form1.user"+i);
		//alert(fname.checked)
		if(fname.checked) {

			// fullphone에 번호 입력.
			fullPhone = fname.value;
			
			if(f.send_phone.options.length >= 2000) {
				alert('2000개 까지만 그룹 전송이 가능합니다.');
				break;
			} else {
				// 잔여건수 체크. options 항목의 갯수가 잔여건수보다 같거나 클경우 튕겨낸다.
				//if(f.send_phone.options.length >= 2000) {
				//	alert('고객님의 SMS 전송잔여 건수가 부족합니다.\n충전은 My 호스팅에서 충전하실 수 있습니다.');
				//	break;
				//}
				//else {
					f.send_phone.options.length = f.send_phone.options.length + 1;
					make_length = f.send_phone.options.length;

					f.send_phone.options[make_length - 1].text = fullPhone;
					f.send_phone.options[make_length - 1].value = fullPhone;

					f.number_receive_people.value = parseInt(f.number_receive_people.value) + 1;

				//}
			}
		} //end if(fname.checked)
	} //end for
	
	}
}
</script>
<link href="../admin/admin.css" rel="stylesheet" type="text/css">
<?
	$site_path = '../';
	$site_url = '../';
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
			// "아이디","이름","이메일","닉네임","주민번호"
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
									
									$qstr .= " AND `mb_jumin` LIKE '%$kw%'";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// 필터 조건에 의한 필터링
      case 1 : // 회원구분
				if($ss[$ss_key[$i]] != '-1') {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `mb_ext1` ";
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
		WHERE mb_id != 'lets080' $qstr
	";
	//echo $dbqry;
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,15,10);

?>	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="form1" action="?<?=$p_str?>"  method="post">
<input type="hidden" name="MemberNumber" value="1">
<input type="hidden" name="yesno" value="no">
<input type="hidden" name="schSql" value="Select [idx], [strMID], [strPasswd], [strName], [strHanja], [intJumin1], [intJumin2], [strZip1], [strZip2], [strAddress1], [strAddress2], [strOfficeAddress1], [strOfficeAddress2], [strOfficeAddress3], [strOfficeAddress4], [strJuminAddress1], [strBoneAddress1], [strParentAddress1], [strEmail], [strPhone1], [strPhone2], [strPhone3], [strMobile1], [strMobile2], [strMobile3] from Member Order by idx DESC">
<input name="act" type="hidden" value="">
<input name="page" type="hidden" value="<?=$page?>">
  <tr>
    <td>

        <table width="400" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#ffffff" bordercolordark="ffffff">
          <tr bgcolor="#ffffff"> 
            <td width="100%" align="right">Total : &nbsp;&nbsp;
              <?=$page_info[total_rows]?></td>
		  </tr>
		 </table>

        <table width="400" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr bgcolor="#f7f7f7"> 
            <td width="20">&nbsp; </td>
            <td width="30" height="24" align="center">NO</td>
            <td width="80" align="center">아이디</td>
            <td width="80" align="center">이름</td>
            <td  align="center">핸드폰</td>
          </tr>
          <?
	$dbqry="
		SELECT *
		FROM `$db_table_member`
		WHERE mb_id != 'lets080' $qstr
		$ostr
		LIMIT $page_info[offset],$page_info[rows] ";
	
	$rs=query($dbqry,$dbcon);
	$no = $page_info[total_rows]-$page_info[offset]+1;
	for ($i=0;$i<mysql_num_rows($rs);$i++) {
		$R=mysql_fetch_array($rs);
		$no--;


		//$R[mb_mobile] = str_replace("-","",$R[mb_mobile]);
?>
		  <tr onmouseover='this.style.backgroundColor="#DAEDED"' onmouseout='this.style.backgroundColor=""'> 
            <td height="24" align="center"> <input name="user<?=$i?>" type="checkbox" id="user<?=$i?>" value="<?=$R[mb_mobile]?>"> 
            </td>
            <td height="24" align="center"> 
              <?=$no?>
            </td>
            <td align="center"> 
						&nbsp;<span onClick="rg_layer('<?=$site_url?>', '','<?=$R[mb_id]?>', '<?=$R[mb_name]?>', '<?=$R[mb_email]?>', '<?=$R[mb_homepage]?>', '1','<?=$site_url?>admin/images/')" style='cursor:hand;'><?=$R[mb_id]?></span>
            </td>
            <td align="center"> 
              <?=$R[mb_name]?>
            </td>
            <td align="center"> 
              &nbsp;<?=$R[mb_mobile]?>
            </td>
          </tr>
			<script language="javascript">
				document.form1.MemberNumber.value='<?=$i?>'
			</script>

          <?

	}
?>
        </table>

		<div align="center"> 

<? include("navigation.php"); ?>
        </div>
 
		
		
		
		
<table width="100%" cellspacing="0" style="border-collapse:collapse;">
    <tr>
        
    <td> 
      <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="400"> 
		   검&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;색: 
              <select name="ss[0]" id="ss[0]">
                <?
	$ss_list = array("아이디","이름","이메일");
	while(list($key,$value)=each($ss_list))
    if ($key==$ss[0])
      echo "<option value='$key' selected>$value</option>";
    else
      echo "<option value='$key'>$value</option>";
?>
              </select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> <input type="submit" name="검색" value="검색" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
              <input type="button" value="취소" onclick="location.href='?'" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> &nbsp;&nbsp;              
			</td>
          </tr>
        </table>
    </td>
    </tr>
</table>		
		
		
		
		
		
		
		
		<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
				  <td><b>sms 
						리스트 :</b> <input type="radio" name="mail_option" value="all">
						검색된 회원전체 
						<input type="radio" name="mail_option" value="select" checked>
					  선택된 회원만&nbsp;&nbsp;&nbsp; 
					  <input type="button" value=" 저 장 " onClick="insertPhone()" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> &nbsp;&nbsp;     
				  </td>
				</tr> 
        </table>
		<BR>
		<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
				  <td align="center"><input type=button value=" 창 닫 기 " onclick="window.close();">
				  </td>
				</tr> 
        </table>
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
