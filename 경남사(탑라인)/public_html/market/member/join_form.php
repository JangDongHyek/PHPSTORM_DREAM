<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
$SQL = "select * from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, "perms");
if($perms == "4") {
	echo ("		
	<script>
		alert('�̵�� ���θ��Դϴ�.');
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
			if (lmin == lmax) alert(cmt + '�� ' + lmin + ' �� �̾�� �մϴ�.');
				 else alert(cmt + '�� ' + lmin + ' ~ ' + lmax + ' �� �̳��� ���� �� ���ڷ� �Է��ϼ���.');
			target.focus()
			return true
		}
		if (astr.length > 1) {
		        for (i=0; i<t.length; i++)
		                if(astr.indexOf(t.substring(i,i+1))<0) {
					alert(cmt + '�� ����� �� ���� ���ڰ� �ԷµǾ����ϴ�');
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
	        	alert(cmt + '�� ��Ȯ�� �Է��Ͽ� �ֽʽÿ�.');
		target.focus()
		return true	
	}
		
		
	function checkform(f)
	{
		var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
		var Digit = '1234567890'
	
		if (Tcheck(f.username, '��� ID', Alpha + Digit, 4, 10)) return false;
		if (Tcheck(f.password, '��й�ȣ', Alpha + Digit, 4, 8)) return false;
		if (Tcheck(f.password1, '��й�ȣ Ȯ��', Alpha + Digit, 4, 8)) return false;
		if (f.password.value != f.password1.value) {
			alert('��й�ȣ Ȯ���� �ٽ� ���ּ���.')
			f.password.focus()
			return false
		}
		
		if (f.name.value=="") {
		        alert("\n�̸��� �Է��ϼ���.");
		        f.name.focus();
		        return false;
		}
		<?
		if($passport_use == 0 || $passport_use == ""){
		?>	
	
		if (f.passport1.value==""){
			alert("\n�ֹε�Ϲ�ȣ ���ڸ��� �Է��ϼ���.");
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
						
						alert("���ڸ� �Է� �ϼ���");
						f.passport1.focus();
						return false;
				} 
				ret = false;
				
			}
		
		}
		
		if (f.passport2.value==""){
			alert("\n�ֹε�Ϲ�ȣ ���ڸ��� �Է��ϼ���.");
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
						alert("���ڸ� �Է� �ϼ���");
						f.passport2.focus();
						return false;
				} 
				ret = false;
			}
		
		}
		if (f.passport1.value.length != 6 || f.passport2.value.length != 7){
			alert("��ȿ�� �ֹι�ȣ�� �Է� �ϼ���");
			f.passport2.focus();
			return false;
		
		}
		jumin = f.passport1.value + f.passport2.value
		if(Jumin_chk(jumin)) {
		alert("�ֹε�Ϲ�ȣ�� Ʋ���ϴ�.");
		return false;
		} 
		<?
		}
		if($zip_use == 0 || $zip_use == ""){
		?>
			
		if (f.zip.value==""){
			alert("\n�����ȣ�� �Է��ϼ���.");
			f.find_button.focus()
			return false;
		}
		<?
		}
		if($address_use == 0 || $address_use == ""){
		?>
		
		if (f.address.value==""){
			alert("\n�ּҸ� �Է��ϼ���.");
			f.address.focus();
			return false;
		}
		if (f.address_d.value==""){
			alert("\n���ּҸ� �Է��ϼ���.");
			f.address_d.focus();
			return false;
		}
		<?
		}
		if($tel_use == 0 || $tel_use == ""){
		?>
		
		if (f.tel.value==""){
			alert("\n����ó�� �Է��ϼ���.");
			f.tel.focus()
			return false;
		}
		<?
		}
		if($tel1_use == 0 || $tel1_use == ""){
		?>
		if (f.tel1.value==""){
			alert("\n��Ÿ����ó�� �Է��ϼ���.");
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
	        alert("\n�̸����� �Է��ϼ���.");
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
		       	alert("��ȿ�� ���ڿ��� �Է��ϼ���!");
				f.email.focus(); 
				return (false);
	        }
	    }                                                                                                                                             
		<?
		}
		if($chuchon_use == 0 || $chuchon_use == ""){
		?>
		if (f.partner.value==""){
			alert("\n��õ���� �Է��ϼ���.");
			f.partner.focus()
			return false;
		}
		<?
      	}
  		if($msg_use == 0 || $msg_use == ""){
  		?>
        if (f.msg.value==""){
			alert("\n�ϰ�������� �Է��ϼ���.");
			f.msg.focus()
			return false;
		}
		<?
      	}
  		if($job_use == 0 || $job_use == ""){
  		?>
        if (f.job.value==""){
			alert("\n������ �Է��ϼ���.");
			f.job.focus()
			return false;
		}
		<?
      	}
  		if($com_name_use == 0 || $com_name_use == ""){
  		?>
        if (f.com_name.value==""){
			alert("\n����/�б����� �Է��ϼ���.");
			f.com_name.focus()
			return false;
		}
		<?
      	}
  		if($homepage_use == 0 || $homepage_use == ""){
  		?>
        if (f.homepage.value==""){
			alert("\nȨ������ �ּҸ� �Է��ϼ���.");
			f.homepage.focus()
			return false;
		}
		<?
      	}
  		if($hobby_use == 0 || $hobby_use == ""){
  		?>
        if (f.hobby.value==""){
			alert("\n��̸� �Է��ϼ���.");
			f.hobby.focus()
			return false;
		}
		<?
      	}
  		if($religion_use == 0 || $religion_use == ""){
  		?>
        if (f.religion.value==""){
			alert("\n������ �Է��ϼ���.");
			f.religion.focus()
			return false;
		}
		<?
      	}
  		if(($ext1_use == 0 || $ext1_use == "")&&$ext1_field !=""){
  		?>
		if (f.ext1_content.value==""){
			alert("\n<?=$ext1_field?>�� �Է��ϼ���.");
			f.ext1_content.focus()
			return false;
		}
		<?
      	}
  		if(($ext2_use == 0 || $ext2_use == "")&&$ext2_field !=""){
  		?>
		if (f.ext2_content.value==""){
			alert("\n<?=$ext2_field?>�� �Է��ϼ���.");
			f.ext2_content.focus()
			return false;
		}
		<?
      	}
  		if(($ext3_use == 0 || $ext3_use == "")&&$ext3_field !=""){
  		?>
		if (f.ext3_content.value==""){
			alert("\n<?=$ext3_field?>�� �Է��ϼ���.");
			f.ext3_content.focus()
			return false;
		}
		<?
      	}
  		if(($ext4_use == 0 || $ext4_use == "")&&$ext4_field !=""){
  		?>
		if (f.ext4_content.value==""){
			alert("\n<?=$ext4_field?>�� �Է��ϼ���.");
			f.ext4_content.focus()
			return false;
		}
		<?
      	}
  		if(($sel_use == 0 || $sel_use == "")&& $sel_field !=""){
  		?>
        if (f.sel_content.value==""){
			alert("\n<?=$sel_field?>�� �����ϼ���.");
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
	
		if (Tcheck(f.username, '��� ID', Alpha + Digit, 4, 10)) return false;
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
<!--�˻��κ�-->
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
    Ȩ &gt; ȸ������
    </td>
    <td width="460" align="right" background="../images/template6/image/top/search_bg.gif" class="text_right"><input name="itemname" type="text" class="input_search">
        <a href='javascript:document.search.submit()'><img src="../images/template6/image/top/bu_search.gif" width="56" height="22" border="0" align="absmiddle"></a></td>
  </tr>
  </form>
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
</table>
<!--�˻��κг�-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="960">
   <!--Ÿ�̵��̹��� ����-->
   <table width="960" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td background="../images/template6/image/product/title_bg.gif"><img src="../images/template6/image/product/title_1.gif" width="130" height="40"><img src="../images/template6/image/product/title_type.gif" width="180" height="40"></td>
     </tr>
  </table>
  <!--Ÿ�̵��̹���  ��-->
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
            			<span class="cc">�ʼ� �׸�</span></strong></font></td>
          		</tr>
          		<tr>
            		<td width="536" background="../images/left_dot.gif" colspan="4"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<p align="left"><span class="bb">���̵�</span></td>
            		<td width="459" height="25" align="center" colspan="3">
            			<span class="bb"><p align="left"></span>
            			<input class="bb" name="username" value='<?=$username?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px"> 
            			&nbsp; 
            			<span class="zz"><strong>
            			<input class="bb" onclick="idcheck();" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="�ߺ�üũ">
            			</strong>
            			</span>
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="center">
            			<span class="bb"><p align="left">��й�ȣ</span></td>
            		<td width="433" height="25">
            			<input class="bb" type='password' name="password" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
            	</tr>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<span class="bb">��й�ȣȮ��</span>
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
            			<span class="bb"><p align="left">��&nbsp; ��</span></td>
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
            			<span class="bb">�ֹε�Ϲ�ȣ</span>
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
            			<p align="left"><span class="bb">�����ȣ</span>
            		</td>
            		<td width="433" height="25" colspan="3">
            			<p align="left">
            			<input class="bb" name="zip" value='<?=$zip?>' size="8" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px" readonly>
            			<span class="zz"><strong>
            			<input class="bb" name='find_button' onclick="find_zip();"  style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="ã��">
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
            			<span class="bb">�ּ�</span></td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="address" value='<?=$address?>' size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">���ּ�</span></td>
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
            			<span class="bb">����ó</span>
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
            			<span class="bb">�ڵ���</span>
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
            			<span class="bb"><p align="left">�̸���</span>
            		</td>
            		<td width="433" height="25" colspan="3">
            			<span class="zz"></span>
            			<input class="bb" name="email" value='<?=$email?>' size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			<span class="zz"></span>
									<br>
									<span class="bb"> 
									<font color="#009966"><b class="cc">
									<font color="#CC6633">E-mail ���񽺸� �����ðڽ��ϱ�?</font></b></font> </span>
									<font color="#CC6633"><span class=aa> 
                  <input type=radio value=1 name=if_maillist 
                  <?
                  if($if_maillist == '1'||empty($if_maillist)) echo "checked";
                  ?>
                  >
                  </span></font><span class="bb">��</span><span class=aa> 
                  <input type=radio value=0 name=if_maillist
                  <?
                  if($if_maillist == '0') echo "checked";
                  ?>
                  >
                  </span><span class="bb">�ƴϿ� <br>
                  <br>
                  E-mail�� ����Ͻø� �پ��� ��ǰ, �̺�Ʈ ������<br>
                  ������ �ֹ� ���� ������ ������ �޾ƺ��� �� �־� ���մϴ�.</span>
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
            			<span class="bb">��õ��</span></td>
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
            			<span class="bb">�ϰ������</span></td>
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
            			<span class="bb">����</span></td>
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
            			<span class="bb">����/�б���</span></td>
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
            			<span class="bb">Ȩ������ �ּ�</span></td>
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
            			<span class="bb">���</span></td>
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
            			<span class="bb">����</span></td>
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
            			<strong>���� �׸�</strong></span></td>
          		</tr>
          		
          		<?
          		if($passport_use == 1){
          		?>
          		<tr>
            		<td width="536" height="1" align="center" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25">
            			<span class="bb">�ֹε�Ϲ�ȣ</span>
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
            			<p align="left"><span class="bb">�����ȣ</span>
            		</td>
            		<td width="433" height="25" colspan="3">
            			<p align="left">
            			<input class="bb" name="zip" size="8" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px" readonly>
            			<span class="zz"><strong>
            			<input class="bb" name='find_button' onclick="find_zip();"  style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="button" value="ã��">
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
            			<span class="bb">�ּ�</span></td>
            		<td width="433" height="25" colspan="3">
            			<input class="bb" name="address" size="39" style="width:70%;BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            		</td>
          		</tr>
          		<tr>
            		<td width="536" height="1" align="left" colspan="4" bgcolor="#C0C0C0"></td>
          		</tr>
          		<tr>
            		<td width="99" height="25" align="left">
            			<span class="bb">���ּ�</span></td>
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
            			<span class="bb">����ó</span>
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
            			<span class="bb">�ڵ���</span>
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
            			<span class="bb"><p align="left">�̸���</span>
            		</td>
            		<td width="433" height="25" colspan="3">
            			<span class="zz"></span>
            			<input class="bb" name="email" size="18" style="BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; HEIGHT: 18px">
            			<span class="zz"></span>
            			<br>
									<span class="bb"> 
									<font color="#009966"><b class="cc">
									<font color="#CC6633">E-mail ���񽺸� �����ðڽ��ϱ�?</font></b></font> </span>
									<font color="#CC6633"><span class=aa> 
                  <input type=radio value=1 name=if_maillist
                  <?
                  if($if_maillist == '1'||empty($if_maillist)) echo "checked";
                  ?>
                  >
                  </span></font><span class="bb">��</span><span class=aa> 
                  <input type=radio value=0 name=if_maillist
                  <?
                  if($if_maillist == '0') echo "checked";
                  ?>
                  >
                  </span><span class="bb">�ƴϿ� <br>
                  <br>
                  E-mail�� ����Ͻø� �پ��� ��ǰ, �̺�Ʈ ������<br>
                  ������ �ֹ� ���� ������ ������ �޾ƺ��� �� �־� ���մϴ�.</span>
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
            			<span class="bb">��õ��</span></td>
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
            			<span class="bb">�ϰ������</span></td>
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
            			<span class="bb">����</span></td>
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
            			<span class="bb">����/�б���</span></td>
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
            			<span class="bb">Ȩ������ �ּ�</span></td>
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
            			<span class="bb">���</span></td>
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
            			<span class="bb">����</span></td>
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
            		<td width="536" height="30" align="left" colspan="4" bgcolor="#FFFFFF"><span class="bb">�����׸��� 
            			���� �ʿ��Ͻ� ���� �Է��Ͻø� �˴ϴ�.</span></td>
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
            			�̸����� �Է��Ͻø� �پ��� ���θ��ҽİ� �̺�Ʈ ������ ���ص帮��,<br>
            			�ֹ�/���� ������ ���ϰ� �̸��Ϸ� Ȯ���Ͻ� �� �ֽ��ϴ�.</span></td>
          		</tr>
          		
          		<tr>
            		<td width="536" bgcolor="#FFFFFF" height="11" colspan="4"><span class="zz"><strong>
            			<p align="center">&nbsp; &nbsp; 
            			<input class="bb" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px" type="submit" value="���Խ�û">
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
				alert(\"�̹� �����ϴ� ID�Դϴ�.\\n\\n �ٸ� ID�� �Է����ּ���.\");
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
					alert(\"�̹� �����ϴ� �ֹι�ȣ�Դϴ�.\\n\\n�̹� �����ϼ̰ų� �ƴϸ� �����ڿ� �����ּ���.\");
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
	if ($dbresult == false) echo "���� ���� ����!";
	
	
	if($init_bonus > 0 && $bonus_ok == 't'){ //���ϸ��� ����Ҷ��� ����
		$write_date = date("Ymd H:i:s");
		
		$content = "ȸ������ ���ϸ���"; 
	
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
	
	/** //sms������
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
			//echo "SMS ������ �����߽��ϴ�.<br>";
			$success = $fail = 0;
			foreach($SMS->Result as $result) {
				list($phone,$code)=explode(":",$result);
				if ($code=="Error") {
					//echo $phone.'�� �߼��ϴµ� ������ �߻��߽��ϴ�.<br>';
					$fail++;
				} else {
					//echo $phone."�� �����߽��ϴ�. (�޽�����ȣ:".$code.")<br>";
					$success++;
				}
			}
			//echo $success.'���� ����������'.$fail.'���� ������ ���߽��ϴ�.';
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
		else echo "����: SMS ������ ����� �Ҿ����մϴ�.<br>";
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
	<title>ȸ������ Ȯ�θ���</title>
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
	            <td width='100%' bgcolor='#6489C4' height='30'><p align='right'>&nbsp; <span class='dd'>ȸ������ 
	            Ȯ�θ���&nbsp;&nbsp; </span></td>
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
	                <td width='100%'><span class='aa'>�ȳ��ϼ���!&nbsp; [name]����<br>
	                <br>
	                ���� [shopname]���θ��� �Ѱ����� �Ǽ̽��ϴ�.^*^<br>
	                <br>
	                ������ ����� [name]�Բ� �����ϰ� ����� ���񽺸� �帮�� ���� 
	                �ּ��� ���� ���� ��ӵ帳�ϴ�. <br>
	                �ٽ� �ѹ� ȸ������ �������ֽ��� ����帳�ϴ�.<br>
	                <br>
	                ������ [name]�� �翡�� �Բ��ϸ� �ູ�� �帮�� [shopname]���θ��� �Ǳ� ���� 
	                ������ �ٰڽ��ϴ�. <br>
	                ��� ���Ѻ� �ּ���.<br>
	                <br>
	                �� ȸ���� ���̵� : </span><span class='ee'><strong>[id]</strong></span><span
	                class='aa'> / �� �н����� :</span><strong><span class='cc'> </span><span class='ee'>[password]</span></strong></td>
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
	        <td width='100%' height='40'><p align='center'><span class='ee'><strong>[shopname]���θ� 
	        ������</strong> : ��ȭ) [tel], email : [email] </span></td>
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
	  
		mail($email, "ȸ�������� �����մϴ�.", "$mailcontent", "From: $shopname �Դϴ�.<$shopemail>\nContent-type: text/html");
	}
	
	echo "<meta http-equiv='refresh' content='0; URL=join_ok.php?mart_id=$mart_id&name=$name&from_order_sheet_flag=$from_order_sheet_flag'>";
}
?>
<?
mysql_close($dbconn);
?>