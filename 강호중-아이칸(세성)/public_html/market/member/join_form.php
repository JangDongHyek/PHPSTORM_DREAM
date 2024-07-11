<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
$SQL = "select * from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, "perms");
if($perms == "4") {
	echo ("		
	<script>
		alert('미등록 쇼핑몰입니다.');
		history.go(-1);
	</script>
	");
	exit;
}

include( '../include/getmartinfo.php' );

if($flag==""){
	$SQL = "select * from $Join_Form_SetTable where mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);
		$ary=mysql_fetch_array($dbresult);
		$passport_use = $ary["passport_use"];
		$zip_use = $ary["zip_use"];
		$address_use = $ary["address_use"];
		$tel_use = $ary["tel_use"];
		$tel1_use = $ary["tel1_use"];
		$email_use = $ary["email_use"];
		$chuchon_use = $ary["chuchon_use"];
		$msg_use = $ary["msg_use"];
		$job_use = $ary["job_use"];
		$com_name_use = $ary["com_name_use"];
		$homepage_use = $ary["homepage_use"];
		$hobby_use = $ary["hobby_use"];
		$religion_use = $ary["religion_use"];
		$ext1_field = $ary["ext1_field"];
		$ext1_use = $ary["ext1_use"];
		$ext2_field = $ary["ext2_field"];
		$ext2_use = $ary["ext2_use"];
		$ext3_field = $ary["ext3_field"];
		$ext3_use = $ary["ext3_use"];
		$ext4_field = $ary["ext4_field"];
		$ext4_use = $ary["ext4_use"];
		$sel_field = $ary["sel_field"];
		$opt1_field = $ary["opt1_field"];
		$opt2_field = $ary["opt2_field"];
		$opt3_field = $ary["opt3_field"];
		$opt4_field = $ary["opt4_field"];
		$sel_use = $ary["sel_use"];
	}
	
	if(strstr($icon_module,"icon12")!=false) include('../include/head_template6.inc');
	else include('../include/head_alltemplate.inc');
?>
<SCRIPT language=JavaScript>
	function Svalue(sarray) { return sarray.options[sarray.selectedIndex].value }
	var MSIE, VERSION;
	
	MSIE = navigator.userAgent.indexOf('MSIE') == -1;
	VERSION = navigator.userAgent.substring(8,12);
	
	function Tcheck(target, cmt, astr, lmin, lmax)
	{
		var i
		var t = target.value
	
		if (t.length < lmin || t.length > lmax) {
			if (lmin == lmax) alert(cmt + '는 ' + lmin + ' 자 이어야 합니다.');
				 else alert(cmt + '는 ' + lmin + ' ~ ' + lmax + ' 자 이내의 영문 및 숫자로 입력하세요.');
			target.focus()
			return true
		}
		if (astr.length > 1) {
		        for (i=0; i<t.length; i++)
		                if(astr.indexOf(t.substring(i,i+1))<0) {
					alert(cmt + '에 허용할 수 없는 문자가 입력되었습니다');
					target.focus()
					return true
				}
		}
	        return false
		
	}
		
	function Jumin_chk(it) {
		IDtot = 0;
		IDAdd = "234567892345";
	
		for(i=0; i<12; i++) IDtot = IDtot + parseInt(it.substring(i, i+1)) * parseInt(IDAdd.substring(i, i+1));
		IDtot = 11 - (IDtot%11);
		if (IDtot == 10) IDtot = 0;
		else if (IDtot == 11) IDtot = 1;
	
		if(parseInt(it.substring(12, 13)) != IDtot) return true;
		else return false
	} 
	
	function Eaddcheck(target, cmt)
	{
		var i
		var t = target.value
	
		if (t.length > 1) {
		        for (i=0; i<t.length; i++)
		                if(t.substring(i,i+1) == '@') {
					return false;
				}
		}
	        	alert(cmt + '를 정확히 입력하여 주십시오.');
		target.focus()
		return true	
	}
		
		
	function checkform(f)
	{
		var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
		var Digit = '1234567890'
	
		if (Tcheck(f.username, '희망 ID', Alpha + Digit, 4, 10)) return false;
		if (Tcheck(f.password, '비밀번호', Alpha + Digit, 4, 8)) return false;
		if (Tcheck(f.password1, '비밀번호 확인', Alpha + Digit, 4, 8)) return false;
		if (f.password.value != f.password1.value) {
			alert('비밀번호 확인을 다시 해주세요.')
			f.password.focus()
			return false
		}
		
		if (f.name.value=="") {
		        alert("\n이름을 입력하세요.");
		        f.name.focus();
		        return false;
		}
		<?
		if($passport_use == 0 || $passport_use == ""){
		?>	
	
		if (f.passport1.value==""){
			alert("\n주민등록번호 앞자리를 입력하세요.");
			f.passport1.focus();  
			return false;
		}
		else{
			var len =f.passport1.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){  
			    var ch = f.passport1.value.substring(i,i+1);
			    
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				 
				if (!ret){
						
						alert("숫자만 입력 하세요");
						f.passport1.focus();
						return false;
				} 
				ret = false;
				
			}
		
		}
		
		if (f.passport2.value==""){
			alert("\n주민등록번호 뒷자리를 입력하세요.");
			f.passport2.focus();  
			return false;
		}
		else{
			var len =f.passport2.value.length;
			var ret;
			ret =false;		
			
			for(var i=0;i<len;i++){  
			    var ch = f.passport2.value.substring(i,i+1);
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{
						ret = true
						break;
					}
				}	
				if (!ret){					
						alert("숫자만 입력 하세요");
						f.passport2.focus();
						return false;
				} 
				ret = false;
			}
		
		}
		if (f.passport1.value.length != 6 || f.passport2.value.length != 7){
			alert("유효한 주민번호를 입력 하세요");
			f.passport2.focus();
			return false;
		
		}
		jumin = f.passport1.value + f.passport2.value
		if(Jumin_chk(jumin)) {
		alert("주민등록번호가 틀립니다.");
		return false;
		} 
		<?
		}
		if($zip_use == 0 || $zip_use == ""){
		?>
			
		if (f.zip.value==""){
			alert("\n우편번호를 입력하세요.");
			f.find_button.focus()
			return false;
		}
		<?
		}
		if($address_use == 0 || $address_use == ""){
		?>
		
		if (f.address.value==""){
			alert("\n주소를 입력하세요.");
			f.address.focus();
			return false;
		}
		if (f.address_d.value==""){
			alert("\n상세주소를 입력하세요.");
			f.address_d.focus();
			return false;
		}
		<?
		}
		if($tel_use == 0 || $tel_use == ""){
		?>
		
		if (f.tel.value==""){
			alert("\n연락처를 입력하세요.");
			f.tel.focus()
			return false;
		}
		<?
		}
		if($tel1_use == 0 || $tel1_use == ""){
		?>
		if (f.tel1.value==""){
			alert("\n기타연락처를 입력하세요.");
			f.tel1.focus()
			return false;
		}
		<?
		}
		if($email_use == 0 || $email_use == ""){
		?>
		
		var emailchk;
		emailchk = 0;
	    if (f.email.value ==""){
	        alert("\n이메일을 입력하세요.");
			f.email.focus()
			return false;
		}
		else {	
	        for (var j=0; j < f.email.value.length ; j++ ) 
	        {
	             var ch= f.email.value.substring(j,j+1)
	             if (ch == "@" | ch== "." ) 
	             {
						emailchk = emailchk + 1;
	             }
	        }
	        if (emailchk < 2 ) 
	        {
		       	alert("유효한 전자우편를 입력하세요!");
				f.email.focus(); 
				return (false);
	        }
	    }                                                                                                                                             
		<?
		}
		if($chuchon_use == 0 || $chuchon_use == ""){
		?>
		if (f.partner.value==""){
			alert("\n추천인을 입력하세요.");
			f.partner.focus()
			return false;
		}
		<?
      	}
  		if($msg_use == 0 || $msg_use == ""){
  		?>
        if (f.msg.value==""){
			alert("\n하고싶은말을 입력하세요.");
			f.msg.focus()
			return false;
		}
		<?
      	}
  		if($job_use == 0 || $job_use == ""){
  		?>
        if (f.job.value==""){
			alert("\n직업을 입력하세요.");
			f.job.focus()
			return false;
		}
		<?
      	}
  		if($com_name_use == 0 || $com_name_use == ""){
  		?>
        if (f.com_name.value==""){
			alert("\n직장/학교명을 입력하세요.");
			f.com_name.focus()
			return false;
		}
		<?
      	}
  		if($homepage_use == 0 || $homepage_use == ""){
  		?>
        if (f.homepage.value==""){
			alert("\n홈페이지 주소를 입력하세요.");
			f.homepage.focus()
			return false;
		}
		<?
      	}
  		if($hobby_use == 0 || $hobby_use == ""){
  		?>
        if (f.hobby.value==""){
			alert("\n취미를 입력하세요.");
			f.hobby.focus()
			return false;
		}
		<?
      	}
  		if($religion_use == 0 || $religion_use == ""){
  		?>
        if (f.religion.value==""){
			alert("\n종교를 입력하세요.");
			f.religion.focus()
			return false;
		}
		<?
      	}
  		if(($ext1_use == 0 || $ext1_use == "")&&$ext1_field !=""){
  		?>
		if (f.ext1_content.value==""){
			alert("\n<?=$ext1_field?>를 입력하세요.");
			f.ext1_content.focus()
			return false;
		}
		<?
      	}
  		if(($ext2_use == 0 || $ext2_use == "")&&$ext2_field !=""){
  		?>
		if (f.ext2_content.value==""){
			alert("\n<?=$ext2_field?>를 입력하세요.");
			f.ext2_content.focus()
			return false;
		}
		<?
      	}
  		if(($ext3_use == 0 || $ext3_use == "")&&$ext3_field !=""){
  		?>
		if (f.ext3_content.value==""){
			alert("\n<?=$ext3_field?>를 입력하세요.");
			f.ext3_content.focus()
			return false;
		}
		<?
      	}
  		if(($ext4_use == 0 || $ext4_use == "")&&$ext4_field !=""){
  		?>
		if (f.ext4_content.value==""){
			alert("\n<?=$ext4_field?>를 입력하세요.");
			f.ext4_content.focus()
			return false;
		}
		<?
      	}
  		if(($sel_use == 0 || $sel_use == "")&& $sel_field !=""){
  		?>
        if (f.sel_content.value==""){
			alert("\n<?=$sel_field?>를 선택하세요.");
			f.sel_content.focus()
			return false;
		}
		<?
		}
		?>
	}
	
	
	function idcheck(){
		var username = document.f.username.value;
		var url = "idcheck.php?mart_id=<?=$mart_id?>&form_info=f.username&user_id="+username
		var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
		var Digit = '1234567890'
	
		if (Tcheck(f.username, '희망 ID', Alpha + Digit, 4, 10)) return false;
		else{
			var checkwin
			checkwin = window.open(url, 'child','toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no,width=250,height=150,left=0,top=0');
	    checkwin.focus(); 
		}
	}
	
	function find_zip()
	{
	        	var Sel = window.open ( 'find_zip.php', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
	        	
	}
	
	function check()
	{
	    var str = document.f.passport1.value.length;
	    if(str == 6) {
	       document.f.passport2.focus();
	    }
	
	} 
	
	function check1()
	{
	    var str = document.f.passport2.value.length;
	    if(str == 7) {
	       document.f.email.focus();
	       
		}   	
	}
	</SCRIPT>

	<SCRIPT language=javascript>
	<!--
	function formreset(){
		document.f.reset();
	}
	//-->
</SCRIPT>
<script langauage="Javascript">
<!-- 
  function hidestatus(){ 
  window.status='' 
  return true 
  } 

  if (document.layers) 
  document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT) 

  document.onmouseover=hidestatus 
  document.onmouseout=hidestatus 
//--> 
</script> 

<?
if(strstr($icon_module,"icon7")!=false) include( '../include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/topmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/topmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/topmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/topmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) include( '../include/topmenu_template6.inc' );

if(strstr($icon_module,"icon7")!=false) include( '../include/leftmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/leftmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/leftmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/leftmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/leftmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) {
?>
<!--검색부분-->
<table width="990" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
  <form name=search onsubmit='return frm_search(this)' action='../product/search.php'>
	<input type=hidden name='search_type' value='item'>
	<input type=hidden name='mart_id' value='<?=$mart_id?>'>
	<tr>
    <td width="30" height="30">&nbsp;</td>
    <td width="500" background="../images/template6/image/top/search_bg.gif" class="text_left"><img src="../images/template6/image/nevigation_icon.gif" width="17" height="14" align="absmiddle">
    홈 &gt; 회원가입
    </td>
    <td width="460" align="right" background="../images/template6/image/top/search_bg.gif" class="text_right"><input name="itemname" type="text" class="input_search">
        <a href='javascript:document.search.submit()'><img src="../images/template6/image/top/bu_search.gif" width="56" height="22" border="0" align="absmiddle"></a></td>
  </tr>
  </form>
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
</table>
<!--검색부분끝-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="960">
   <!--타이들이미지 시작-->
   <table width="960" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td background="../images/template6/image/product/title_bg.gif"><img src="../images/template6/image/product/title_1.gif" width="130" height="40"><img src="../images/template6/image/product/title_type.gif" width="180" height="40"></td>
     </tr>
  </table>
  <!--타이들이미지  끝-->
  <table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
<?
	include( '../include/leftmenu_template6.inc' );
}
	?>
	<td width="609" valign="top" bgcolor='#ffffff'>
    	<div align="center"><center>
    	<table border="0" width="571">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%">
        	<?
        	if($ti_join1_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_join1_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_join1_img' WIDTH='89' HEIGHT='27'>
        		";
        	}
        	else{
        		echo "
        	<img src='../images/joinform-title.gif' WIDTH='89' HEIGHT='27'>
        		";
        	}
        	?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<?
        	if($ti_line_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_line_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_line_img' WIDTH='571' HEIGHT='12'>
        		";
        	}
        	else{
        		echo "
        	<img src='../images/line.gif' WIDTH='571' HEIGHT='12'>
        		";
        	}
        	?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" height="20"></td>
      	</tr>
      	
      	<form name=f  method=post onsubmit="return checkform(this)">
				<input type=hidden name='flag' value='adduser' > 
				<input type=hidden name=mart_id value='<?=$mart_id?>'> 
				<input type=hidden name='init_bonus' value='<?=$init_bonus?>'> 
				<input type=hidden name='from_order_sheet_flag' value='<?=$from_order_sheet_flag?>'> 
				<tr>
        	<td width="100%">
        		<div align="center"><center>
        		<table border="0" width="540" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#808080" height="2" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="536" align="left" height="25" colspan="4" bgcolor="#FFFFFF">
            			<p align="left"><font color="#C73430"><strong>
            			<span class="cc">필수 항목</span></strong></font></td>
          		</tr>
          		<tr>
            		<td width="536" background="../images/left_dot.gif" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<p align="left"><span class="bb">아이디</span></td>
            		<td width="459" height="25" align="center" colspan="3">
            			<span class="bb"><p align="left"></span>
            			<input class="bb" name="username" value='<?=$username?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px"> 
            			&nbsp; 
            			<span class="zz"><strong>
            			<input class="bb" onclick="idcheck();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="중복체크">
            			</strong>
            			</span>
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<span class="bb"><p align="left">비밀번호</span></td>
            		<td width="433" height="25">
            			<input class="bb" type='password' name="password" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
            	</tr>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<span class="bb">비밀번호확인</span>
            		</td>
            		<td width="433" height="25">
            			<p align="left">
            			<input class="bb" type='password' name="password1" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<span class="bb"><p align="left">성&nbsp; 명</span></td>
            		<td width="433" height="25">
            			<span class="zz"></span>
            			<input class="bb" name="name" value='<?=$name?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			<span class="zz"></span>
            		</td>
            	</tr>
          		<?
          		if($passport_use == 0 || $passport_use == ""){
          		?>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<span class="bb">주민등록번호</span>
            		</td>
            		<td width="433" height="25">
            			<input class="bb" name="passport1" value='<?=$passport1?>' onkeyup=check(); size="6" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			<strong><span class="zz"> - </span></strong>
            			<input type='password' class="bb" name="passport2" size="7" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($zip_use == 0 || $zip_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="center" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span>
            		</td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<p align="left"><span class="bb">우편번호</span>
            		</td>
            		<td width="433" height="25" colspan="3">
            			<p align="left">
            			<input class="bb" name="zip" value='<?=$zip?>' size="8" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px" readonly>
            			<span class="zz"><strong>
            			<input class="bb" name='find_button' onclick="find_zip();"  style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="찾기">
            			</strong></span>
            		</td>
          		</tr>
          		<?
          		}
          		if($address_use == 0 || $address_use == ""){
          		?>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">주소</span></td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="address" value='<?=$address?>' size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">상세주소</span></td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="address_d" value='<?=$address_d?>' size="39"	style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($tel_use == 0 || $tel_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">연락처</span>
            		</td>
            		<td width="433" height="25">
            			<input class="bb" name="tel" value='<?=$tel?>' size="18"	style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
            	</tr>
          		<?
          		}
          		if($tel1_use == 0 || $tel1_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<span class="bb">핸드폰</span>
            		</td>
            		<td width="433" height="25">
            			<input class="bb" name="tel1" value='<?=$tel1?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($email_use == 0 || $email_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="center" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span>
            		</td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<span class="bb"><p align="left">이메일</span>
            		</td>
            		<td width="433" height="25" colspan="3">
            			<span class="zz"></span>
            			<input class="bb" name="email" value='<?=$email?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			<span class="zz"></span>
									<br>
									<span class="bb"> 
									<font color="#009966"><b class="cc">
									<font color="#CC6633">E-mail 서비스를 받으시겠습니까?</font></b></font> </span>
									<font color="#CC6633"><span class=aa> 
                  <input type=radio value=1 name=if_maillist 
                  <?
                  if($if_maillist == '1'||empty($if_maillist)) echo "checked";
                  ?>
                  >
                  </span></font><span class="bb">예</span><span class=aa> 
                  <input type=radio value=0 name=if_maillist
                  <?
                  if($if_maillist == '0') echo "checked";
                  ?>
                  >
                  </span><span class="bb">아니오 <br>
                  <br>
                  E-mail만 등록하시면 다양한 상품, 이벤트 정보와<br>
                  고객님의 주문 관련 정보를 빠르게 받아보실 수 있어 편리합니다.</span>
                  <br>
                </td>
          		</tr>
          		<?
          		}
          		if($chuchon_use == 0 || $chuchon_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">추천인</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="partner" value='<?=$partner?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($msg_use == 0 || $msg_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">하고싶은말</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<textarea cols="55" name="msg" rows="4" style="width:80%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid"><?=$msg?></textarea>
            		</td>
          		</tr>
          		<?
          		}
          		if($job_use == 0 || $job_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">직업</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="job" value='<?=$job?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($com_name_use == 0 || $com_name_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">직장/학교명</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="com_name" value='<?=$com_name?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($homepage_use == 0 || $homepage_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">홈페이지 주소</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="homepage" value='<?=$homepage?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($hobby_use == 0 || $hobby_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">취미</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="hobby" value='<?=$hobby?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($religion_use == 0 || $religion_use == ""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">종교</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="religion" value='<?=$religion?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($ext1_use == 0 || $ext1_use == "")&&$ext1_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$ext1_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="ext1_content" value='<?=$ext1_content?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($ext2_use == 0 || $ext2_use == "")&&$ext2_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$ext2_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="ext2_content" value='<?=$ext2_content?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($ext3_use == 0 || $ext3_use == "")&&$ext3_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$ext3_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="ext3_content" value='<?=$ext3_content?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($ext4_use == 0 || $ext4_use == "")&&$ext4_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$ext4_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="ext4_content" value='<?=$ext4_content?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($sel_use == 0 || $sel_use == "")&& $sel_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$sel_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<select class="bb" name='sel_content' size="1" style="BACKGROUND-COLOR: rgb(255,255,255); BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; BORDER-TOP: rgb(0,0,0) 1px solid; HEIGHT: 18px">
          				<option value="">====</option>
          				<option value="<?=$opt1_field?>"
          				<?
          				if($sel_content == $opt1_field) echo "selected";
          				?>
          				><?=$opt1_field?></option>
          				<option value="<?=$opt2_field?>"
          				<?
          				if($sel_content == $opt2_field) echo "selected";
          				?>
          				><?=$opt2_field?></option>
          				<option value="<?=$opt3_field?>"
          				<?
          				if($sel_content == $opt3_field) echo "selected";
          				?>
          				><?=$opt3_field?></option>
          				<option value="<?=$opt4_field?>"
          				<?
          				if($sel_content == $opt4_field) echo "selected";
          				?>
          				><?=$opt4_field?></option>
            		</td>
          		</tr>
          		<?
          		}
          		?>
          		<tr>
            		<td width="532" height="5" align="center" colspan="4"><strong><span class="cc"></span></strong></td>
          		</tr>
          		<tr>
            		<td width="532" height="2" align="center" colspan="4" bgcolor="#808080"><strong><span class="cc"></span></strong></td>
          		</tr>
          		<tr>
            		<td width="532" height="25" align="center" colspan="4">
            			<span class="bb"><p align="left">
            			<strong>선택 항목</strong></span></td>
          		</tr>
          		
          		<?
          		if($passport_use == 1){
          		?>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<span class="bb">주민등록번호</span>
            		</td>
            		<td width="433" height="25">
            			<input class="bb" name="passport1" onkeyup=check(); size="6" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			<strong><span class="zz"> - </span></strong>
            			<input class="bb" name="passport2" size="7" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($zip_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="center" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span>
            		</td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<p align="left"><span class="bb">우편번호</span>
            		</td>
            		<td width="433" height="25" colspan="3">
            			<p align="left">
            			<input class="bb" name="zip" size="8" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px" readonly>
            			<span class="zz"><strong>
            			<input class="bb" name='find_button' onclick="find_zip();"  style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="찾기">
            			</strong></span>
            		</td>
          		</tr>
          		<?
          		}
          		if($address_use == 1){
          		?>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">주소</span></td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="address" size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">상세주소</span></td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="address_d" size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($tel_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">연락처</span>
            		</td>
            		<td width="433" height="25">
            			<input class="bb" name="tel" size="18"	style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
            	</tr>
          		<?
          		}
          		if($tel1_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<span class="bb">핸드폰</span>
            		</td>
            		<td width="433" height="25">
            			<input class="bb" name="tel1" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($email_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="center" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span>
            		</td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<span class="bb"><p align="left">이메일</span>
            		</td>
            		<td width="433" height="25" colspan="3">
            			<span class="zz"></span>
            			<input class="bb" name="email" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			<span class="zz"></span>
            			<br>
									<span class="bb"> 
									<font color="#009966"><b class="cc">
									<font color="#CC6633">E-mail 서비스를 받으시겠습니까?</font></b></font> </span>
									<font color="#CC6633"><span class=aa> 
                  <input type=radio value=1 name=if_maillist
                  <?
                  if($if_maillist == '1'||empty($if_maillist)) echo "checked";
                  ?>
                  >
                  </span></font><span class="bb">예</span><span class=aa> 
                  <input type=radio value=0 name=if_maillist
                  <?
                  if($if_maillist == '0') echo "checked";
                  ?>
                  >
                  </span><span class="bb">아니오 <br>
                  <br>
                  E-mail만 등록하시면 다양한 상품, 이벤트 정보와<br>
                  고객님의 주문 관련 정보를 빠르게 받아보실 수 있어 편리합니다.</span>
                  <br>
            		</td>
          		</tr>
          		<?
          		}
          		if($chuchon_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">추천인</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="partner" size="18" value='<?=$partner?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($msg_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">하고싶은말</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<textarea cols="55" name="msg" rows="4" style="width:80%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid"></textarea>
            		</td>
          		</tr>
          		<?
          		}
          		if($job_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">직업</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="job" size="18" value='<?=$job?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($com_name_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">직장/학교명</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="com_name" size="18" value='<?=$com_name?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($homepage_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">홈페이지 주소</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="homepage" size="18" value='<?=$homepage?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($hobby_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">취미</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="hobby" size="18" value='<?=$hobby?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if($religion_use == 1){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb">종교</span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="religion" size="18" value='<?=$religion?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($ext1_use == 1)&&$ext1_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$ext1_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="ext1_content" size="18" value='<?=$ext1_content?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($ext2_use == 1)&&$ext2_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$ext2_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="ext2_content" size="18" value='<?=$ext2_content?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($ext3_use == 1)&&$ext3_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$ext3_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="ext3_content" size="18" value='<?=$ext3_content?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($ext4_use == 1)&&$ext4_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$ext4_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<input class="bb" name="ext4_content" size="18" value='<?=$ext4_content?>' style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<?
          		}
          		if(($sel_use == 1)&& $sel_field !=""){
          		?>
          		<tr>
            		<td width="532" height="1" align="left" colspan="4" bgcolor="#C0C0C0">
            			<span class="bb"></span></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left" bgcolor="#FFFFFF">
            			<span class="bb"><?=$sel_field?></span></td>
            		<td width="433" height="25" colspan="3" bgcolor="#FFFFFF">
            			<select class="bb" name='sel_content' size="1" style="BACKGROUND-COLOR: rgb(255,255,255); BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; BORDER-TOP: rgb(0,0,0) 1px solid; HEIGHT: 18px">
          				<option value="">====</option>
          				<option value="<?=$opt1_field?>"
          				<?
          				if($sel_content == $opt1_field) echo "selected";
          				?>
          				><?=$opt1_field?></option>
          				<option value="<?=$opt2_field?>"
          				<?
          				if($sel_content == $opt2_field) echo "selected";
          				?>
          				><?=$opt2_field?></option>
          				<option value="<?=$opt3_field?>"
          				<?
          				if($sel_content == $opt3_field) echo "selected";
          				?>
          				><?=$opt3_field?></option>
          				<option value="<?=$opt4_field?>"
          				<?
          				if($sel_content == $opt4_field) echo "selected";
          				?>
          				><?=$opt4_field?></option>
            		</td>
          		</tr>
          		<?
          		}
          		?>
          		<tr>
            		<td width="536" height="1" align="left" colspan="4" bgcolor="#FFFFFF" background="../images/left_dot.gif"></td>
          		</tr>
          		<tr>
            		<td width="536" height="30" align="left" colspan="4" bgcolor="#FFFFFF"><span class="bb">선택항목은 
            			이후 필요하실 때에 입력하시면 됩니다.</span></td>
          		</tr>
          		<tr>
            		<td width="536" height="2" align="left" colspan="4" bgcolor="#808080"></td>
          		</tr>
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4"><span class="zz"></span></td>
          		</tr>
          		<tr>
            		<td width="536" height="50" align="left" colspan="4">
            			<span class="bb">
            			이메일을 입력하시면 다양한 쇼핑몰소식과 이벤트 정보를 전해드리며,<br>
            			주문/결제 내용을 편리하게 이메일로 확인하실 수 있습니다.</span></td>
          		</tr>
          		
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4"><span class="zz"><strong>
            			<p align="center">&nbsp; &nbsp; 
            			<input class="bb" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="submit" value="가입신청">
            			</strong></span>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</td>
</tr>
</table>
<?
include( '../include/bottom.inc' );
?>
</body>
</html>
<?
}
elseif ($flag == "adduser") {
	$SQL = "select username from $Mart_Member_NewTable where mart_id='$mart_id' and username = '$username'";
	$dbresult = mysql_query($SQL, $dbconn);
	//echo "sql=$SQL";
	if (mysql_num_rows($dbresult)>0) {
		echo ("
			<script language=javascript>
				alert(\"이미 존재하는 ID입니다.\\n\\n 다른 ID를 입력해주세요.\");
			</script>
			<form name='form' action='join_form.php' method='post'>
				<input type='hidden' name='mart_id' value='$mart_id'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='passport1' value='$passport1'>
				<input type='hidden' name='passport2' value='$passport2'>
				<input type='hidden' name='email' value='$email'>
				<input type='hidden' name='tel' value='$tel'>
				<input type='hidden' name='tel1' value='$tel1'>
				<input type='hidden' name='zip' value='$zip'>
				<input type='hidden' name='address' value='$address'>
				<input type='hidden' name='address_d' value='$address_d'>
				<input type='hidden' name='partner' value='$partner'>
				<input type='hidden' name='msg' value='$msg'>
				<input type='hidden' name='job' value='$job'>
				<input type='hidden' name='com_name' value='$com_name'>
				<input type='hidden' name='homepage' value='$homepage'>
				<input type='hidden' name='hobby' value='$hobby'>
				<input type='hidden' name='religion' value='$religion'>
				<input type='hidden' name='ext1_content' value='$ext1_content'>
				<input type='hidden' name='ext2_content' value='$ext2_content'>
				<input type='hidden' name='ext3_content' value='$ext3_content'>
				<input type='hidden' name='ext4_content' value='$ext4_content'>
				<input type='hidden' name='sel_content' value='$sel_content'>
				<input type='hidden' name='if_maillist' value='$if_maillist'>
				</form>
				<script>
				document.form.submit();
				</script>
		");
		exit;
	}
	if(!empty($passport1) && !empty($passport2) && $mart_id != 'test1'){
		$SQL = "select count(*) from $Mart_Member_NewTable where mart_id='$mart_id' and passport1 = '$passport1' 
		and passport2 = '$passport2'";
		$dbresult = mysql_query($SQL, $dbconn);
		//echo "sql=$SQL";
		if (mysql_result($dbresult,0,0)>0) {
			echo ("
				<script language=javascript>
					alert(\"이미 존재하는 주민번호입니다.\\n\\n이미 가입하셨거나 아니면 관리자에 연락주세요.\");
				</script>
				<form name='form' action='join_form.php' method='post'>
				<input type='hidden' name='mart_id' value='$mart_id'>
				<input type='hidden' name='username' value='$username'>
				<input type='hidden' name='name' value='$name'>
				<input type='hidden' name='passport1' value='$passport1'>
				<input type='hidden' name='passport2' value='$passport2'>
				<input type='hidden' name='email' value='$email'>
				<input type='hidden' name='tel' value='$tel'>
				<input type='hidden' name='tel1' value='$tel1'>
				<input type='hidden' name='zip' value='$zip'>
				<input type='hidden' name='address' value='$address'>
				<input type='hidden' name='address_d' value='$address_d'>
				<input type='hidden' name='partner' value='$partner'>
				<input type='hidden' name='msg' value='$msg'>
				<input type='hidden' name='job' value='$job'>
				<input type='hidden' name='com_name' value='$com_name'>
				<input type='hidden' name='homepage' value='$homepage'>
				<input type='hidden' name='hobby' value='$hobby'>
				<input type='hidden' name='religion' value='$religion'>
				<input type='hidden' name='ext1_content' value='$ext1_content'>
				<input type='hidden' name='ext2_content' value='$ext2_content'>
				<input type='hidden' name='ext3_content' value='$ext3_content'>
				<input type='hidden' name='ext4_content' value='$ext4_content'>
				<input type='hidden' name='sel_content' value='$sel_content'>
				<input type='hidden' name='if_maillist' value='$if_maillist'>
				</form>
				<script>
				document.form.submit();
				</script>
			");
			exit;
		}
	}
	$SQL = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	if(mysql_num_rows($dbresult)>0){
		$member_confirm = mysql_result($dbresult, 0, "member_confirm");
		$bonus_ok = mysql_result($dbresult, 0, "bonus_ok");
	}
	
	if($member_confirm == 0){
		$is_member = 1;
	}
	if($member_confirm == 1){
		$is_member = 0;
	}
	
	//echo "member_confirm=$member_confirm <br>";
	//echo "is_member=$is_member <br>";
	
	$uid = md5(uniqid($hash_secret));
	$date = date("Ymd H:i:s");
	
	$SQL = "insert into $Mart_Member_NewTable " .
	"(uid, mart_id, username, password, name, passport1, passport2, email, tel, tel1, zip, address, address_d, ".
	"date, partner, is_member, msg, job, com_name, homepage, hobby, religion, ext1_content, ext2_content, ext3_content, ".
	"ext4_content,sel_content,if_maillist) ".
	"values ('$uid', '$mart_id', '$username', '$password', '$name', '$passport1', '$passport2','$email', ".
	"'$tel', '$tel1', '$zip', '$address', '$address_d', '$date', '$partner', '$is_member','$msg', '$job', '$com_name', ".
	"'$homepage', '$hobby', '$religion', '$ext1_content', '$ext2_content', '$ext3_content', '$ext4_content', ".
	"'$sel_content','$if_maillist')";

	//echo "sql=$SQL";
	//echo "<br>";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	
	
	if($init_bonus > 0 && $bonus_ok == 't'){ //마일리지 사용할때만 지급
		$write_date = date("Ymd H:i:s");
		
		$content = "회원가입 마일리지"; 
	
		$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, mode) ".
		"values ('$mart_id', '$username', '$write_date', '$init_bonus', '$content', 'j')";
	
		//echo "sql=$SQL";
		//echo "<br>";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total + $init_bonus 
		where username='$username' and mart_id='$mart_id'";
	
		//echo "sql=$SQL";
		//echo "<br>";
		$dbresult = mysql_query($SQL, $dbconn);
	}		
	
	/** //sms보내기
	if($if_join_msg == '1'||$if_join_msg_admin == '1'){
		include "../../admin/sms/class.sms.php";
		$SMS = new SMS;
		$SMS->SMS_Login($sms_user,$sms_passwd);
		if($if_join_msg == '1'){
		
			$callback = "$callback_num1$callback_num2$callback_num3";		
			$join_msg = str_replace('[SHOP_NAME]',$mart_name,$join_msg); 
			$join_msg = str_replace('[MEM_NAME]',$name,$join_msg); 
			$sms_client_num = str_replace('-','',$tel1); 
			/*	
			echo "callback=$callback <br>";
			echo "join_msg=$join_msg <br>";
			echo "sms_client_num=$sms_client_num <br>";
			/
			$SMS->Add($sms_client_num,"$callback","$mart_name","$join_msg","");
		}	
		
		if($if_join_msg_admin == '1'){
		
			$callback = "$callback_num1$callback_num2$callback_num3";		
			$admin_num = "$admin_num1$admin_num2$admin_num3";
			$join_msg_admin = str_replace('[SHOP_NAME]',$mart_name,$join_msg_admin); 
			$join_msg_admin = str_replace('[MEM_NAME]',$name,$join_msg_admin); 
			/*	
			echo "callback=$callback <br>";
			echo "admin_num=$admin_num <br>";
			echo "join_msg_admin=$join_msg_admin <br>";
			/
			$SMS->Add($admin_num,"$callback","$mart_name","$join_msg_admin","");
		}
		
		$result = $SMS->Send();
		if ($result) {
			//echo "SMS 서버에 접속했습니다.<br>";
			$success = $fail = 0;
			foreach($SMS->Result as $result) {
				list($phone,$code)=explode(":",$result);
				if ($code=="Error") {
					//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
					$fail++;
				} else {
					//echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
					$success++;
				}
			}
			//echo $success.'건을 전송했으며'.$fail.'건을 보내지 못했습니다.';
			$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
		}
		else echo "에러: SMS 서버와 통신이 불안정합니다.<br>";
	}**/
	if($if_joinmail == '1'&&!empty($email)){
		
		$filename = "$Co_img_UP$mart_id/self_design_joinmail";
		
		if($if_self_design_joinmail == 1 && file_exists($filename)){
		
			$fp = fopen($filename,"r");
			$self_design_joinmail = fread($fp, filesize ($filename));
			$mailcontent = $self_design_joinmail;
		}
		else{	
			$mailcontent = "
	<html>

	<head>
	<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
	<title>회원가입 확인메일</title>
	<style type='text/css'>
	<!--
	.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
	.bb {  line-height: 13pt; font-size: 9pt; color: #6B6B6B}
	.ff { font-size: 8pt; color: #6B6B6B}
	.cc {  font-size: 9pt; color: #FF9418}
	.dd {  font-size: 9pt; color: #ffffff}
	.ee {  font-size: 9pt; color: #2F7C99}
	input { BORDER: #acacac 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #eeeeee}
	
	A            {font-size: 9pt;line-height: 12pt;text-decoration: none;color: #000000 }
	 A:hover      {text-decoration: none;  }  -->
	</style>
	</head>
	
	<body>
	
	<table border='0' width='670' cellpadding='3'>
	  <tr>
	    <td width='638' bgColor='#FFFFFF'>
	    <table border='5' width='100%' bordercolor='#E0E0E0' cellspacing='0'>
	      <tr>
	        <td width='100%'><table border='0' width='100%' cellspacing='0' cellpadding='0'>
	          <tr>
	            <td width='100%' bgcolor='#6489C4' height='30'><p align='right'>&nbsp; <span class='dd'>회원가입 
	            확인메일&nbsp;&nbsp; </span></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#F1F1F1' height='1'></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#FFFFFF' height='10'></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#FFFFFF' height='20'><p align='center'>&nbsp;<img src='http://211.174.51.11/autocart/market/images/top1.gif'
	            width='380' height='57' alt='top1.gif (3325 bytes)'></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#FFFFFF' height='20'><div align='center'><center><table
	            border='0' width='90%' bgcolor='#EBEBEB' cellspacing='0' cellpadding='0'>
	              <tr>
	                <td width='100%' bgcolor='#DBDBDB'></td>
	              </tr>
	            </table>
	            </center></div></td>
	          </tr>
	          <tr>
	            <td width='100%' bgcolor='#ffffff' height='62'><div align='center'><center><table
	            border='0' width='90%' cellspacing='0' cellpadding='0'>
	              <tr>
	                <td width='100%' height='10'><span class='aa'></span></td>
	              </tr>
	              <tr>
	                <td width='100%'><span class='aa'>안녕하세요!&nbsp; [name]고객님<br>
	                <br>
	                저희 [shopname]쇼핑몰의 한가족이 되셨습니다.^*^<br>
	                <br>
	                앞으로 저희는 [name]님께 안전하고 우수한 서비스를 드리기 위해 
	                최선을 다할 것을 약속드립니다. <br>
	                다시 한번 회원으로 가입해주심을 감사드립니다.<br>
	                <br>
	                언제나 [name]님 곁에서 함께하며 행복을 드리는 [shopname]쇼핑몰이 되기 위해 
	                열심히 뛰겠습니다. <br>
	                계속 지켜봐 주세요.<br>
	                <br>
	                ☞ 회원님 아이디 : </span><span class='ee'><strong>[id]</strong></span><span
	                class='aa'> / ☞ 패스워드 :</span><strong><span class='cc'> </span><span class='ee'>[password]</span></strong></td>
	              </tr>
	              <tr>
	                <td width='100%' height='10'></td>
	              </tr>
	              <tr>
	                <td width='100%' height='10'></td>
	              </tr>
	            </table>
	            </center></div></td>
	          </tr>
	        </table>
	        </td>
	      </tr>
	    </table>
	    </td>
	  </tr>
	</table>
	
	<table border='0' width='678'>
	  <tr>
	    <td width='638' bgColor='#FFFFFF'><table border='5' width='100%' bordercolor='#E0E0E0'
	    cellspacing='0'>
	      <tr>
	        <td width='100%' height='40'><p align='center'><span class='ee'><strong>[shopname]쇼핑몰 
	        고객센터</strong> : 전화) [tel], email : [email] </span></td>
	      </tr>
	    </table>
	    </td>
	  </tr>
	  <tr>
	    <td width='100%'><span class='aa'><br>
	    </span></td>
	  </tr>
	</table>
	</body>
	</html>
			";
		}
		$mailcontent = str_replace('[shopname]',$shopname,$mailcontent); 
		$mailcontent = str_replace('[name]',$name,$mailcontent); 
		$mailcontent = str_replace('[id]',$username,$mailcontent); 
		$mailcontent = str_replace('[password]',$password,$mailcontent); 
		$mailcontent = str_replace('[tel]',$shoptel1,$mailcontent); 
		$mailcontent = str_replace('[email]',$shopemail,$mailcontent); 
	  
		mail($email, "회원가입을 축하합니다.", "$mailcontent", "From: $shopname 입니다.<$shopemail>\nContent-type: text/html");
	}
	
	echo "<meta http-equiv='refresh' content='0; URL=join_ok.php?mart_id=$mart_id&name=$name&from_order_sheet_flag=$from_order_sheet_flag'>";
}
?>
<?
mysql_close($dbconn);
?>