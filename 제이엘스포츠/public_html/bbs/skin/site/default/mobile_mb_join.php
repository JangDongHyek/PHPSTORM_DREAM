<? 
   $site_path = "/home/lja/public_html/bbs/"; 
   $site_url = "../bbs/"; 
   require_once($site_path."include/lib.inc.php"); 
    include($site_path."counter/counter.lib.php");
?>

<link href="../style.css" rel="stylesheet" type="text/css">
<script language="javascript">
	function createXMLHttpRequest(){
		if(window.ActiveXObject){
			xmlHttpRequest=new ActiveXObject("Microsoft.XMLHTTP");
		}else if(window.XMLHttpRequest){
			xmlHttpRequest=new XMLHttpRequest();
		}
		return xmlHttpRequest;
	}
	var xmlJoinRequest=createXMLHttpRequest();
	function IdCheck(){
		if(3<=document.getElementById("mb_id").value.length&&document.getElementById("mb_id").value.length<=12){
			var url="<?=$skin_site_url?>mb_id_check.xml.php";
			var param="mb_id="+document.getElementById("mb_id").value;
			xmlJoinRequest.open("post",url,true);
			//서버측 요청하고 응답을 받기 위한 함수(메서드)
			xmlJoinRequest.onreadystatechange=id_check;
			//한글 깨짐 방지하기 위한 것
			xmlJoinRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=euc-kr');
			xmlJoinRequest.send(param);
		}else{
			alert("아이디는 3글자 이상 12글자 이하 입력해 주시길 바랍니다.");
			document.getElementById("mb_id_chk").innerHTML="3글자이상 12글자이하 입력해 주시길 바랍니다.";
			document.getElementById('mb_id_check').focus();
			return;
		}
	}
	function id_check(){
		if(xmlJoinRequest.readyState==4){
			if(xmlJoinRequest.status==200){
				var xml=xmlJoinRequest.responseXML;
				var cnt=xml.documentElement.firstChild.data;
				if(cnt==0){
					document.getElementById("mb_id_chk").innerHTML="<font color=blue>사용이 가능한 아이디입니다.</font>";
					document.getElementById("mb_id_check").value="ok";
				}else{
					document.getElementById("mb_id_chk").innerHTML="<font color=red>사용이 불가능한 아이디입니다.</font>";
					document.getElementById("mb_id").focus();
					document.getElementById("mb_id_check").value="";
				}
			}
		}
	}
</script>

<SCRIPT LANGUAGE="JavaScript">
<!--
function getCookie( name ){
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length )
	{
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
				endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 )
			break;
	}
	return "";
}

//폼의 체크 박스를 체그 하면 새창이 나타나지 않으며, 체크 하지 않았을 경우, 계속 나타납니다. 



if ( getCookie( "Notice1" ) != "done" ) {
//새창으로 열릴 페이지의 경로 및 크기와 위치를 지정해 주세요. 
	//noticeWindow  =  window.open('popup1.htm','notice1','left=0, top=0, width=450,height=655');
	//noticeWindow.opener = self;
} 

if ( getCookie( "Notice1" ) != "done" ) {
//새창으로 열릴 페이지의 경로 및 크기와 위치를 지정해 주세요. 
	//noticeWindow  =  window.open('pop1.htm','notice1','left=460, top=0, width=500,height=425');
	//noticeWindow.opener = self;
} 

// -->
</SCRIPT>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>

<script>
 function resizeHeight(fr) {
  fr = typeof fr == 'string' ? document.getElementById(fr) : fr;
  fr.setExpression('height',newmain.document.body.scrollHeight);  }
</script>

<form action='' method="post" enctype='multipart/form-data' name="mb_form" id="mb_form" onsubmit='return formcheck()' autocomplete="off">
<input type="hidden" name="act" value='ok' />
<input type="hidden" name="url" value='<?=$url?>' />
<input type="hidden" name="mb_id_check" value="" id="mb_id_check" required="required">

<div id="mobile_join_form">
	<!-- 회원가입 타이틀 이미지-->
	<div id="mobile_join_title">
	<?
	if($_SESSION['ss_mb_id']){ //로그인 상태일때
	?>
			<img src="../images/login/join_1-1.gif" width="173" height="39" />
			<?
	}
	else{ //로그아웃 상태일때
	?>
			<img src="../images/login/join_1.gif" width="173" height="39" />
			<?
	}
	?>
	<!-- 회원가입 타이틀 이미지-->
	</div>
	<div id="mobile_join_item">
		<table width="100%" align="center" cellpadding="0" cellspacing="1">
			<tr>
				<td rowspan="2" align="center" bgcolor="#ffffff">아이디</td>
				<td bgcolor="#ffffff" align="left">&nbsp;<?=$show_join_begin?>
			  <input type="text" class="input" name='mb_id' size="15" maxlength="20" minlength="2" itemname='아이디' value='' required="required" id="mb_id"/>
			  <img src="<?=$skin_site_url?>images/btn_check.gif" align="absmiddle" style="cursor:hand;" onClick="IdCheck()" />&nbsp;
			  <?=$show_join_end?>
			  <?=$show_edit_begin?>
			  <?=$mb_id?>
			  <?=$show_edit_end?>			  </td>
			</tr>
			<tr>
				<td width="69%" bgcolor="#ffffff" align="left">
					<span id="mb_id_chk">3글자이상 12글자이하로 입력해주세요</span>
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffffff">비밀번호</td>
			  <td bgcolor="#ffffff" align="left">&nbsp;
					<?=$show_insert_begin?>
			  <input name='mb_password' type="password" class="input" id="mb_password" size="20" maxlength="20" <?=($need_password)?'required':''?> itemname='암호' />
			  <?=$show_insert_end?>
			  <br />
			  &nbsp;&nbsp;<input type="password" class="input" name='mb_passwd' size="20" maxlength="20" <?=($need_password)?'required':''?> itemname='암호' />
			  <br />
			  비밀번호를 다시 입력해주세요.				</td>
			</tr>
			<?=$show_name_begin?>
			<tr>
				<td align="center" bgcolor="#ffffff">이름</td>
				<td bgcolor="#ffffff" align="left">&nbsp;<input type="text" class="input" name='mb_name' size="20" maxlength="20" minlength="2"  <?=($need_name)?'required':''?> itemname='이름' value='<?=$mb_name?>' />
				</td>
			</tr>
			<?=$show_name_end?>
			<tr>
				<td align="center" bgcolor="#ffffff">연락처</td>
				<td bgcolor="#ffffff" align="left">&nbsp;
					<select name="mb_tel[0]" class="input" <?=($need_tel)?'required':''?> itemname='전화번호'>
					  <option value=''>선택
						<?=rg_html_option($mb_tel_list,'','',$mb_tel[0])?>
					  </option>
				  </select>
					-
					<input type="text" class="input" name='mb_tel[1]' size="5" maxlength="4" <?=($need_tel)?'required':''?> itemname='전화번호' value='<?=$mb_tel[1]?>' />
					-
					<input type="text" class="input" name='mb_tel[2]' size="5" maxlength="4" <?=($need_tel)?'required':''?> itemname='전화번호' value='<?=$mb_tel[2]?>' />
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#ffffff">이메일</td>
				<td bgcolor="#ffffff" align="left">&nbsp;
					<input type="text" class="input" name='mb_email' style="width:80%" maxlength="100" email="email" <?=($need_email)?'required':''?> itemname='e-mail' value='<?=$mb_email?>' />
				</td>
			</tr>
			<tr>
				<td bgcolor="#ffffff" colspan="2" align="center">
				<?
				if($_SESSION['ss_mb_id']){ //로그인 상태일때
				?>
						<input name="image" type="image" style="border:0px;" src="<?=$skin_site_url?>images/btn_join2.gif" />
						<?
				}
				else{ //로그아웃 상태일때
				?>
						<input name="image2" type="image" style="border:0px;" src="<?=$skin_site_url?>images/btn_join.gif" />
						<?
				}
				?>
					 
				</td>
				
			</tr>
	  </table>
	</div>
</div>
  <? /*?>
  <tr>
	<td height="10"></td>
  </tr>
  <tr>
	<td height="2" bgcolor="955B25"></td>
  </tr>
  <tr>
	<td><table width="100%" align="center" border="0" cellpadding="3" cellspacing="0">
		<input type="hidden" name="act2" value='ok' />
		<input type="hidden" name="url" value='<?=$url?>' />
		<tr>
		  <td width="100" bgcolor="#F1F1F1"><img src="../img/join_t1.gif" width="102" height="16" /></td>
		  <td valign="top"><?=$show_join_begin?>
			  <input type="text" class="input_01" name='mb_id' size="20" maxlength="20" minlength="2" itemname='아이디' value='' required="required" />
			  <img src="<?=$skin_site_url?>images/btn_check.gif" align="absmiddle" style="cursor:hand;" onClick="popup_id('mb_form', './', 'mb_id', mb_form.mb_id)" />
			  <?=$show_join_end?>
			  <?=$show_edit_begin?>
			  <?=$mb_id?>
			  <?=$show_edit_end?>
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2" bgcolor="#C6C6C6"></td>
		</tr>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t2.gif" width="102" height="16" /></td>
		  <td><?=$show_insert_begin?>
			  <input name='mb_password' type="password" class="input_01" id="mb_password" size="20" maxlength="20" <?=($need_password)?'required':''?> itemname='암호' />
			  <?=$show_insert_end?>
			  <br />
			  <input type="password" class="input_01" name='mb_passwd' size="20" maxlength="20" <?=($need_password)?'required':''?> itemname='암호' />
			비밀번호를 다시 입력해주세요. </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_nick_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t3.gif" width="102" height="16" /></td>
		  <td><input name='mb_nick' type="text" class="input_01" id="mb_nick" value='<?=$mb_nick?>' size="20" maxlength="20" minlength="2" <?=($need_nick)?'required':''?> itemname='닉네임' />
			  <img src="<?=$skin_site_url?>images/btn_check.gif" align="absmiddle" style="cursor:hand;" onClick="popup_nick('mb_form', './', 'mb_nick', mb_form.mb_nick)" /> </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_nick_end?>
		<?=$show_name_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t4.gif" width="102" height="16" /></td>
		  <td><input type="text" class="input_01" name='mb_name' size="20" maxlength="20" minlength="2"  <?=($need_name)?'required':''?> itemname='이름' value='<?=$mb_name?>' />
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_name_end?>
		<?=$show_tel_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t5.gif" width="102" height="16" /></td>
		  <td><select name="mb_tel[0]" <?=($need_tel)?'required':''?> itemname='전화번호'>
			  <option value=''>선택
				<?=rg_html_option($mb_tel_list,'','',$mb_tel[0])?>
			  </option>
			</select>
			-
			<input type="text" class="input_01" name='mb_tel[1]' size="5" maxlength="4" <?=($need_tel)?'required':''?> itemname='전화번호' value='<?=$mb_tel[1]?>' />
			-
			<input type="text" class="input_01" name='mb_tel[2]' size="5" maxlength="4" <?=($need_tel)?'required':''?> itemname='전화번호' value='<?=$mb_tel[2]?>' />
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_tel_end?>
		<?=$show_mobile_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t6.gif" width="102" height="16" /></td>
		  <td><select name="mb_mobile[0]" <?=($need_mobile)?'required':''?> itemname='핸드폰번호'>
			  <option value=''>선택
				<?=rg_html_option($mb_mobile_list,'','',$mb_mobile[0])?>
			  </option>
			</select>
			-
			<input name='mb_mobile[1]' type="text" class="input_01" value='<?=$mb_mobile[1]?>' size="5" maxlength="4" <?=($need_mobile)?'required':''?> itemname='핸드폰번호' />
			-
			<input name='mb_mobile[2]' type="text" class="input_01" value='<?=$mb_mobile[2]?>' size="5" maxlength="4" <?=($need_mobile)?'required':''?> itemname='핸드폰번호' />
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_mobile_end?>
		<?=$show_email_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t7.gif" width="102" height="16" /></td>
		  <td><input type="text" class="input_01" name='mb_email' size="40" maxlength="100" email="email" <?=($need_email)?'required':''?> itemname='e-mail' value='<?=$mb_email?>' /></td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_email_end?>
		<?=$show_homepage_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t8.gif" width="102" height="16" /></td>
		  <td><input type="text" class="input_01" name='mb_homepage' size="40" maxlength="255" <?=($need_homepage)?'required':''?> itemname='홈페이지' value='<?=$mb_homepage?>' />
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_homepage_end?>
		<?=$show_jumin_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t8.gif" width="102" height="16" /></td>
		  <td><input type="text" class="input_01" name='mb_jumin1' size="7" maxlength="6" minlength="6" <?=($need_jumin)?'required':''?> itemname='주민등록번호 앞자리' onkeyup='if (this.value.length &gt;= 6) this.form.mb_jumin2.focus();' />
			-
			<input type="password" class="input_01" name='mb_jumin2' size="8" maxlength="7" minlength="7" <?=($need_jumin)?'required':''?> itemname='주민등록번호 뒷자리' />
  <br />
  <span class="small_txt style1">암호화하여 저장되므로 자료 
	유출시 안심할 수 있습니다.</span></td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_jumin_end?>
		<?=$show_address_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t10.gif" width="102" height="16" /></td>
		  <td><input type="text" class="input_01" name='mb_post' size="8" maxlength="7" readonly="readonly" <?=($need_address)?'required':''?> itemname='우편번호' value='<?=$mb_post?>' />
			  <img src="<?=$skin_site_url?>images/btn_search.gif" align="absmiddle" style="cursor:hand;" onClick="popup_zip('mb_form', './', 'mb_post', '', 'mb_address1', 'mb_address2');" /> </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<tr>
		  <td bgcolor="#F1F1F1">&nbsp;</td>
		  <td><input name='mb_address1' type="text" class="input_01" id="mb_address1" style='width:99%' value='<?=$mb_address1?>' readonly="readonly" <?=($need_address)?'required':''?> />
			  <br />
			  <input name='mb_address2' type="text" class="input_01" id="mb_address2" value='<?=$mb_address2?>' size="35" <?=($need_address)?'required':''?> itemname='상세주소' />
			  <span class="small_txt style1">상세주소 입력</span></td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_address_end?>
		<?=$show_birth_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=($need_birth)?'*':''?>
			생일</span></td>
		  <td><input type="text" class="input_01" name="mb_birth" size="9" maxlength="8" value='<?=$mb_birth?>' <?=($need_birth)?'required':''?> itemname='생일' />
			  <span class="small_txt"><font color="1D8FD1">예) 1972년 9월 1일인 
				경우 19720901</font></span></td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_birth_end?>
		<?=$show_sex_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=($need_sex)?'*':''?>
			성별</span></td>
		  <td><select name='mb_sex' <?=($need_sex)?'required':''?> itemname='성별'>
			  <option value=''>선택하세요
				<?=rg_html_option($mb_sex_list,'','',"$mb_sex")?>
			  </option>
			</select>
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_sex_end?>
		<?=$show_job_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=($need_job)?'*':''?>
			직업</span></td>
		  <td><input name='mb_job' type="text" class="input_01" id="mb_job" value='<?=$mb_job?>' size="21" maxlength="20" <?=($need_job)?'required':''?> itemname='직업' />
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_job_end?>
		<?=$show_hobby_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=($need_hobby)?'*':''?>
			취미</span></td>
		  <td><input name='mb_hobby' type="text" class="input_01" id="mb_hobby" value='<?=$mb_hobby?>' size="21" maxlength="20" <?=($need_hobby)?'required':''?> itemname='취미' />
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_hobby_end?>
		<?=$show_signature_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=($need_signature)?'*':''?>
			서명</span></td>
		  <td><textarea name="mb_signature" class="b_textarea" style="width:100%" rows="5" <?=($need_signature)?'required':''?> itemname='서명'><?=$mb_signature?>
		</textarea></td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_signature_end?>
		<?=$show_greet_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t12.gif" width="102" height="16" /></td>
		  <td><textarea name="mb_greet" style="width:100%" rows="5" class="textarea" id="mb_greet" <?=($need_greet)?'required':''?> itemname='자기소개'><?=$mb_greet?>
		</textarea></td>
		</tr>
		  <tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_greet_end?>


<?=$show_join_begin?>
		<tr>
		  <td bgcolor="#F1F1F1"><img src="../img/join_t20.gif" width="102" height="16" /></td>
		  <td><input name='mb_ext1' type="text" class="input_01" id="mb_ext1" value='<?=$mb_ext1?>' size="21" maxlength="20"></td>
		</tr>
<?=$show_join_end?>



		<?=$show_photo_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">회원 사진</span></td>
		  <td><input name='mb_photo' type="file" class="input_01" id="mb_photo" size="40" />
			  <?=$show_del_photo_begin?>
			  <br />
			  <img src="<?=$skin_site_url?>images/btn_bro.gif" width="64" height="16" />
			  <input name='del_mb_photo' type="checkbox" id="del_mb_photo" value='1' />
			삭제
			<?=$show_del_photo_end?>
			<br />
			<?=$mb_photo_view?>
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_photo_end?>
		<?=$show_icon_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">회원 아이콘</span></td>
		  <td><input type="file" name='mb_icon' size="40" class="input_01" />
			  <br />
			  <span class="small_txt"><font color="1D8FD1">이미지 크기는 16x16으로 
				해주세요.
				<?=$show_del_icon_begin?>
			  </font></span><br />
			  <input type="checkbox" name='del_mb_icon' value='1' />
			삭제<br />
			<?=$mb_icon_view?>
			<?=$show_del_icon_end?>
		  </td>
		</tr>
		<?=$show_icon_end?>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_ext7_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=$show_ext7_title?>
		  </span></td>
		  <td><?=$show_ext7_input?>
		  </td>
		</tr>
		<?=$show_ext7_end?>
		<?=$show_ext8_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=$show_ext8_title?>
		  </span></td>
		  <td><?=$show_ext8_input?>
		  </td>
		</tr>
		<?=$show_ext8_end?>
		<?=$show_ext9_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=$show_ext9_title?>
		  </span></td>
		  <td><?=$show_ext9_input?>
		  </td>
		</tr>
		<?=$show_ext9_end?>
		<?=$show_ext10_begin?>
		<tr>
		  <td bgcolor="#C6C6C6"><span class="subject">
			<?=$show_ext10_title?>
		  </span></td>
		  <td><?=$show_ext10_input?>
		  </td>
		</tr>
		<tr bgcolor="#C6C6C6">
		  <td height="1" colspan="2"></td>
		</tr>
		<?=$show_ext10_end?>
		<tr>
		  <td bgcolor="#F1F1F1">&nbsp;</td>
		  <td><input name="mb_mailing" type="checkbox" id="mb_mailing" value="1"<?=$checked_mb_mailing?> />
			메일수신&nbsp;
			<input name="mb_open_info" type="checkbox" id="mb_open_info" value="1" <?=$checked_mb_open_info?> />
			<span class="style8">정보공개</span></td>
		</tr>
		<tr bgcolor="eeeeee">
		  <td height="1" colspan="2"></td>
		</tr>
	</table></td>
  </tr>
  <tr>
	<td height="2" bgcolor="955B25"></td>
  </tr>
  <tr>
	<td height="70"><div align="center">
		<?
if($_SESSION['ss_mb_id']){ //로그인 상태일때
?>
		<input name="image" type="image" style="border:0px;" src="<?=$skin_site_url?>images/btn_join2.gif" />
		<?
}
else{ //로그아웃 상태일때
?>
		<input name="image2" type="image" style="border:0px;" src="<?=$skin_site_url?>images/btn_join.gif" />
		<?
}
?>
	  &nbsp;&nbsp;<a href="../main/start.htm">
		<?
if($_SESSION['ss_mb_id']){ //로그인 상태일때
?>
		<?
}
else{ //로그아웃 상태일때
?>
		<img src="<?=$skin_site_url?>images/btn_cancel.gif" border="0" style="cursor:hand;" onClick="mb_form.reset();mb_form.mb_id.focus();" /></a>
	  <?
}
?>
	</div></td>
  </tr>
  <? */?>
</form>
