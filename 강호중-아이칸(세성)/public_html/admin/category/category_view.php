<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($sea_num && $sung_num && $khan_num){
	$add_query = " and sea_num='$sea_num' and sung_num='$sung_num' and khan_num='$khan_num' and category_degree='$category_degree'";
}
elseif($sea_num && $sung_num && !$khan_num){
	$add_query = " and sea_num='$sea_num' and sung_num='$sung_num' and category_degree='$category_degree'";
}
elseif($sea_num && !$sung_num && !$khan_num){
	$add_query = " and sea_num='$sea_num' and category_degree='$category_degree'";
}


$SQL = "select * from $CategoryTable where mart_id='$mart_id' $add_query";
$dbresult = mysql_query($SQL, $dbconn);
$row = mysql_fetch_array( $dbresult );
$row_count = mysql_num_rows( $dbresult );

if($row_count == 0){
	echo"<script>alert('일치하는 회원번호가 없습니다.');history.go(-1);</script>";
}

$category_name = $row[category_name];
$category_date = $row[category_date];
$category_desc = $row[category_desc];
$category_img = $row[category_img];
$if_hide = $row[if_hide];
$category_limit_start = $row[category_limit_start];
$category_limit_end = $row[category_limit_end];
$g_id = $row[g_id];
$g_pw = $row[g_pw];
$com_bank_name = $row[com_bank_name];
$com_bank_account = $row[com_bank_account];
$com_bank_master = $row[com_bank_master];
$sea_num = $row[sea_num];
$sung_num = $row[sung_num];
$khan_num = $row[khan_num];
$sea_area = $row[sea_area];
$sung_area = $row[sung_area];
$khan_area = $row[khan_area];
$category_degree = $row[category_degree];



$gr_name = $row[gr_name];
$gr_address = $row[gr_address];
$gr_zip = $row[gr_zip];
$gr_tel = $row[gr_tel];
$gr_mobile = $row[gr_mobile];
$gr_email = $row[gr_email];
$gr_conum = $row[gr_conum];
$com_bank_name2 = $row[com_bank_name2];
$com_bank_account2 = $row[com_bank_account2];
$com_bank_master2 = $row[com_bank_master2];
$com_bank_name3 = $row[com_bank_name3];
$com_bank_account3 = $row[com_bank_account3];
$com_bank_master3 = $row[com_bank_master3];
$com_bank_name4 = $row[com_bank_name4];
$com_bank_account4 = $row[com_bank_account4];
$com_bank_master4 = $row[com_bank_master4];

$end_date = $row[end_date];

$charge_price = $row[charge_price];
$charge_gigan = $row[charge_gigan];

if(!$charge_price){
	$charge_price = "0";
}
if(!$charge_gigan){
	$charge_gigan = "30";
}





$category_html = htmlspecialchars($row[category_html], ENT_QUOTES);
$category_left = htmlspecialchars($row[category_left], ENT_QUOTES);

$upload = "../../co_img/$mart_id/";
$target = "$upload"."$category_img";
if( $category_img ){
	$cate_target_img = "<img src='$target' border='0' width=100 height=120 align='absmiddle'>";
}else{
	$cate_target_img = "No Image";
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(f){


	var category_left = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
	if(category_left=="")
	{
			alert("내용을 적어주세요!");
			ed.focus();
			return false;
	}

	return true;
}
</script>
<script src="../../editor/easyEditor.js"></script>

</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<?  include '../inc/menu2.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td >&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="310"></td>
        <td valign="top" ><div align="right">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../good/board_frame8.html">HOME</a> &gt; </span><span class="text_gray2_c">그룹 관리 </span> </div></td>
            </tr>
            <tr>
              <td height="28">&nbsp;</td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td >&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<form action='category_modify.php?category_num=<?=$category_num?>' name="up" method="post" onSubmit="return checkform(this)" enctype="multipart/form-data">
<input type="hidden" name="flag" value="update">
<input type="hidden" name="category_img_old" value="<?=$category_img?>">
<input type="hidden" name="prev_category_num" value="<?=$prev_category_num?>">
<input type="hidden" name="categoryimg_updateflag" value="ok">




<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		 <td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>그룹 관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function view_image(input)
	{
		var oImg = document.getElementById("upImage");
		oImg.src = input.value;
		oImg.style.display = "";
	}
//-->
</SCRIPT>


<?
if($_SESSION["MemberLevel"] != 10){
	$readonly = "readonly";
	$selectbox_readonly = "readonly style='background-color:#ababab' onFocus='this.initialSelect = this.selectedIndex;' onChange='this.selectedIndex = this.initialSelect;'";
}
?>


			<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white"  align="center">
      			<tr>
        			<td width="90%" bgcolor="#999999">
        				<table border="0" width="100%" cellspacing="1" cellpadding="3">
          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								회원번호 
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<input class="aa" name="category_limit_start" value='<?=$category_limit_start?>' size="10" <?=$readonly?>> ~ <input class="aa" name="category_limit_end" value='<?=$category_limit_end?>' size="10" <?=$readonly?>>			
							</td>
            				<td width="10%" bgcolor="#C8DFEC"  align="center">
								고유번호
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<?
								if($category_degree==0){
								?>
									<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="5" maxlength=4 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sea_area" value='<?=$sea_area?>' size="6" readonly>
									<?}?>
								<?
								}elseif($category_degree==1){
								?>
									<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="4" maxlength=3 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sea_area" value='<?=$sea_area?>' size="6" readonly>
									<?}?>
									-
									<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sung_area" value='<?=$sung_area?>' size="6" readonly>
									<?}?>
								<?
								}elseif($category_degree==2){
								?>
									<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="4" maxlength=3 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sea_area" value='<?=$sea_area?>' size="6" readonly>
									<?}?>
									-
									<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sung_area" value='<?=$sung_area?>' size="6"  readonly>
									<?}?>
									-
									<input class="aa" type="text" name="khan_num" value='<?=$khan_num?>' size="3" maxlength=2 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="khan_area" value='<?=$khan_area?>' size="6"  readonly>

									<?}?>
								<?
								}
								?>
							</td>
          				</tr>



						<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								그룹장 아이디 
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<b><?=$g_id?></b>
							</td>
            				<td width="10%" bgcolor="#C8DFEC"  align="center">
								그룹장 비밀번호
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<input class="aa" type="text" name="g_pw" value='<?=$g_pw?>' size="10">			
            				</td>
          				</tr>





          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								이름
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
            					<input class="aa" type="text" name="gr_name" value='<?=$gr_name?>' size="20" <?=$readonly?>>		
							</td>

          				</tr>


          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								주소
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
            					<input class="aa" type="text" name="gr_address" value='<?=$gr_address?>' size="50" <?=$readonly?>>
								<?$addr = str_replace("부산시 진구","부산시 부산진구",$gr_address);?>
								<font style='cursor:hand;' onclick="window.open('../../market/board_mem/map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[위치확인]</font>	
							</td>

          				</tr>
          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								전화번호
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left">
							<?
							$gr_tel_ex = explode("-",$gr_tel);
							?>
								  <select name="tel1" class=input_03>
                                    <option value='' <?if($gr_tel_ex[0] == ''){echo"selected";}?>>선택</option>
                                    <option value='02' <?if($gr_tel_ex[0] == '02'){echo"selected";}?>>02</option>
                                    <option value='031' <?if($gr_tel_ex[0] == '031'){echo"selected";}?>>031</option>
                                    <option value='032' <?if($gr_tel_ex[0] == '032'){echo"selected";}?>>032</option>
                                    <option value='033' <?if($gr_tel_ex[0] == '033'){echo"selected";}?>>033</option>
                                    <option value='041' <?if($gr_tel_ex[0] == '041'){echo"selected";}?>>041</option>
                                    <option value='042' <?if($gr_tel_ex[0] == '042'){echo"selected";}?>>042</option>
                                    <option value='043' <?if($gr_tel_ex[0] == '043'){echo"selected";}?>>043</option>
                                    <option value='051' <?if($gr_tel_ex[0] == '051'){echo"selected";}?>>051</option>
                                    <option value='052' <?if($gr_tel_ex[0] == '052'){echo"selected";}?>>052</option>
                                    <option value='053' <?if($gr_tel_ex[0] == '053'){echo"selected";}?>>053</option>
                                    <option value='054' <?if($gr_tel_ex[0] == '054'){echo"selected";}?>>054</option>
                                    <option value='055' <?if($gr_tel_ex[0] == '055'){echo"selected";}?>>055</option>
                                    <option value='061' <?if($gr_tel_ex[0] == '061'){echo"selected";}?>>061</option>
                                    <option value='062' <?if($gr_tel_ex[0] == '062'){echo"selected";}?>>062</option>
                                    <option value='063' <?if($gr_tel_ex[0] == '063'){echo"selected";}?>>063</option>
                                    <option value='064' <?if($gr_tel_ex[0] == '064'){echo"selected";}?>>064</option>
                                    <option value='0502' <?if($gr_tel_ex[0] == '0502'){echo"selected";}?>>0502</option>
                                    <option value='0503' <?if($gr_tel_ex[0] == '0503'){echo"selected";}?>>0503</option>
                                    <option value='0504' <?if($gr_tel_ex[0] == '0504'){echo"selected";}?>>0504</option>
                                    <option value='0505' <?if($gr_tel_ex[0] == '0505'){echo"selected";}?>>0505</option>
                                    <option value='0506' <?if($gr_tel_ex[0] == '0506'){echo"selected";}?>>0506</option>
                                    <option value='0507' <?if($gr_tel_ex[0] == '0507'){echo"selected";}?>>0507</option>
                                    <option value='070' <?if($gr_tel_ex[0] == '070'){echo"selected";}?>>070</option>
                                 </select>
                                   -
                                    <input type=text class=input_03 name='tel2' size=5 maxlength=4 value='<?=$gr_tel_ex[1]?>'>
                                   -
                                    <input type=text class=input_03 name='tel3' size=5 maxlength=4 value='<?=$gr_tel_ex[2]?>'>
								</td>
            				<td width="10%" bgcolor="#C8DFEC"  align="center">
								휴대폰
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left">
							<?
							$gr_mobile_ex = explode("-",$gr_mobile);
							?>
									  <select name="mobile1" class=input_03>
										<option value='' <?if($gr_mobile_ex[0] == ''){echo"selected";}?>>선택</option>
										<option value='010' <?if($gr_mobile_ex[0] == '010'){echo"selected";}?>>010</option>
										<option value='011' <?if($gr_mobile_ex[0] == '011'){echo"selected";}?>>011</option>
										<option value='016' <?if($gr_mobile_ex[0] == '016'){echo"selected";}?>>016</option>
										<option value='017' <?if($gr_mobile_ex[0] == '017'){echo"selected";}?>>017</option>
										<option value='018' <?if($gr_mobile_ex[0] == '018'){echo"selected";}?>>018</option>
										<option value='019' <?if($gr_mobile_ex[0] == '019'){echo"selected";}?>>019</option>
									  </select>
									   -
										<input type=text class=input_03 name='mobile2' size=5 maxlength=4 value='<?=$gr_mobile_ex[1]?>'>
									   -
										<input type=text class=input_03 name='mobile3' size=5 maxlength=4 value='<?=$gr_mobile_ex[2]?>'>
            				</td>
          				</tr>
          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								이메일
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left">
            					<input class="aa" type="text" name="gr_email" value='<?=$gr_email?>' size="50" <?=$readonly?>>	
							</td>
            				<td width="10%" bgcolor="#C8DFEC"  align="center">
								사업자번호
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left">
            					<input class="aa" type="text" name="gr_conum" value='<?=$gr_conum?>' size="15" <?=$readonly?>>					
            				</td>
          				</tr>
   


          				<tr>
            				<td bgcolor="#C8DFEC" align="center">사진첨부</td>
            				<td bgcolor="#FFFFFF" colspan='3'>&nbsp;&nbsp;<?=$cate_target_img?> <input type='file' size='30' maxlength='100' name='categoryimg' class="input_03" onChange="view_image(this);"><img src='' id="upImage" style="display:none;">
							<input type="checkbox" name="del_big" value="y">삭제
							</td>
          				</tr>  

<?
/*
?>

            				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 칸충전송금계좌1
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left" colspan=3>
<?
								echo ("				
								<select name='com_bank_name' tabIndex='5' selectedindex='0' size='1' $selectbox_readonly>
								<option value=''
								");
								if($com_bank_name == '') echo " selected";
								echo ("
								>========</option>
								<option value='부산은행'
								");
								if($com_bank_name == '부산은행') echo " selected";
								echo ("
								>부산은행</option>
								<option value='경남은행'
								");
								if($com_bank_name == '경남은행') echo " selected";
								echo ("
								>경남은행</option>
								<option value='광주은행'
								");
								if($com_bank_name == '광주은행') echo " selected";
								echo ("
								>광주은행</option>
								<option value='국민은행'
								");
								if($com_bank_name == '국민은행') echo " selected";
								echo ("
								>국민은행</option>
								<option value='기업은행'
								");
								if($com_bank_name == '기업은행') echo " selected";
								echo ("
								>기업은행</option>
								<option value='농 협'
								");
								if($com_bank_name == '농 협') echo " selected";
								echo ("
								>농 협</option>
								<option value='대구은행'
								");
								if($com_bank_name == '대구은행') echo " selected";
								echo ("
								>대구은행</option>
								<option value='도 이 치'
								");
								if($com_bank_name == '도 이 치') echo " selected";
								echo ("
								>도 이 치</option>
								<option value='산업은행'
								");
								if($com_bank_name == '산업은행') echo " selected";
								echo ("
								>산업은행</option>
								<option value='새마을금고'
								");
								if($com_bank_name == '새마을금고') echo " selected";
								echo ("
								>새마을금고</option>
								<option value='상와은행'
								");
								if($com_bank_name == '상와은행') echo " selected";
								echo ("
								>상와은행</option>
								<option value='서울은행'
								");
								if($com_bank_name == '서울은행') echo " selected";
								echo ("
								>서울은행</option>
								<option value='수 협'
								");
								if($com_bank_name == '수 협') echo " selected";
								echo ("
								>수 협</option>
								<option value='시티은행'
								");
								if($com_bank_name == '시티은행') echo " selected";
								echo ("
								>시티은행</option>
								<option value='신한은행'
								");
								if($com_bank_name == '신한은행') echo " selected";
								echo ("
								>신한은행</option>
								<option value='암로은행'
								");
								if($com_bank_name == '암로은행') echo " selected";
								echo ("
								>암로은행</option>
								<option value='외환은행'
								");
								if($com_bank_name == '외환은행') echo " selected";
								echo ("
								>외환은행</option>
								<option value='우리은행'
								");
								if($com_bank_name == '우리은행') echo " selected";
								echo ("
								>우리은행</option>
								<option value='우 체 국'
								");
								if($com_bank_name == '우 체 국') echo " selected";
								echo ("
								>우 체 국</option>
								<option value='전북은행'
								");
								if($com_bank_name == '전북은행') echo " selected";
								echo ("
								>전북은행</option>
								<option value='제일은행'
								");
								if($com_bank_name == '제일은행') echo " selected";
								echo ("
								>제일은행</option>
								<option value='제주은행'
								");
								if($com_bank_name == '제주은행') echo " selected";
								echo ("
								>제주은행</option>
								<option value='조흥은행'
								");
								if($com_bank_name == '조흥은행') echo " selected";
								echo ("
								>조흥은행</option>
								<option value='하나은행'
								");
								if($com_bank_name == '하나은행') echo " selected";
								echo ("
								>하나은행</option>
								<option value='한미은행'
								");
								if($com_bank_name == '한미은행') echo " selected";
								echo ("
								>한미은행</option>
								<option value='홍콩은행'
								");
								if($com_bank_name == '홍콩은행') echo " selected";
								echo ("
								>홍콩은행</option>
								</select>
								");

								?>
								계좌번호:<input name="com_bank_account" class='input' value="<?=$com_bank_account?>" size="44" <?=$readonly?>>
								예금주:<input name="com_bank_master" class='input' value="<?=$com_bank_master?>" size="10" <?=$readonly?>>
								</td>
								</tr>

						
	            				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 칸충전송금계좌2
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left" colspan=3>
<?
								echo ("				
								<select name='com_bank_name2' tabIndex='5' selectedindex='0' size='1' $selectbox_readonly>
								<option value=''
								");
								if($com_bank_name2 == '') echo " selected";
								echo ("
								>========</option>
								<option value='부산은행'
								");
								if($com_bank_name2 == '부산은행') echo " selected";
								echo ("
								>부산은행</option>
								<option value='경남은행'
								");
								if($com_bank_name2 == '경남은행') echo " selected";
								echo ("
								>경남은행</option>
								<option value='광주은행'
								");
								if($com_bank_name2 == '광주은행') echo " selected";
								echo ("
								>광주은행</option>
								<option value='국민은행'
								");
								if($com_bank_name2 == '국민은행') echo " selected";
								echo ("
								>국민은행</option>
								<option value='기업은행'
								");
								if($com_bank_name2 == '기업은행') echo " selected";
								echo ("
								>기업은행</option>
								<option value='농 협'
								");
								if($com_bank_name2 == '농 협') echo " selected";
								echo ("
								>농 협</option>
								<option value='대구은행'
								");
								if($com_bank_name2 == '대구은행') echo " selected";
								echo ("
								>대구은행</option>
								<option value='도 이 치'
								");
								if($com_bank_name2 == '도 이 치') echo " selected";
								echo ("
								>도 이 치</option>
								<option value='산업은행'
								");
								if($com_bank_name2 == '산업은행') echo " selected";
								echo ("
								>산업은행</option>
								<option value='새마을금고'
								");
								if($com_bank_name2 == '새마을금고') echo " selected";
								echo ("
								>새마을금고</option>
								<option value='상와은행'
								");
								if($com_bank_name2 == '상와은행') echo " selected";
								echo ("
								>상와은행</option>
								<option value='서울은행'
								");
								if($com_bank_name2 == '서울은행') echo " selected";
								echo ("
								>서울은행</option>
								<option value='수 협'
								");
								if($com_bank_name2 == '수 협') echo " selected";
								echo ("
								>수 협</option>
								<option value='시티은행'
								");
								if($com_bank_name2 == '시티은행') echo " selected";
								echo ("
								>시티은행</option>
								<option value='신한은행'
								");
								if($com_bank_name2 == '신한은행') echo " selected";
								echo ("
								>신한은행</option>
								<option value='암로은행'
								");
								if($com_bank_name2 == '암로은행') echo " selected";
								echo ("
								>암로은행</option>
								<option value='외환은행'
								");
								if($com_bank_name2 == '외환은행') echo " selected";
								echo ("
								>외환은행</option>
								<option value='우리은행'
								");
								if($com_bank_name2 == '우리은행') echo " selected";
								echo ("
								>우리은행</option>
								<option value='우 체 국'
								");
								if($com_bank_name2 == '우 체 국') echo " selected";
								echo ("
								>우 체 국</option>
								<option value='전북은행'
								");
								if($com_bank_name2 == '전북은행') echo " selected";
								echo ("
								>전북은행</option>
								<option value='제일은행'
								");
								if($com_bank_name2 == '제일은행') echo " selected";
								echo ("
								>제일은행</option>
								<option value='제주은행'
								");
								if($com_bank_name2 == '제주은행') echo " selected";
								echo ("
								>제주은행</option>
								<option value='조흥은행'
								");
								if($com_bank_name2 == '조흥은행') echo " selected";
								echo ("
								>조흥은행</option>
								<option value='하나은행'
								");
								if($com_bank_name2 == '하나은행') echo " selected";
								echo ("
								>하나은행</option>
								<option value='한미은행'
								");
								if($com_bank_name2 == '한미은행') echo " selected";
								echo ("
								>한미은행</option>
								<option value='홍콩은행'
								");
								if($com_bank_name2 == '홍콩은행') echo " selected";
								echo ("
								>홍콩은행</option>
								</select>
								");

								?>
								계좌번호:<input name="com_bank_account2" class='input' value="<?=$com_bank_account2?>" size="44" <?=$readonly?>>
								예금주:<input name="com_bank_master2" class='input' value="<?=$com_bank_master2?>" size="10" <?=$readonly?>>
								</td>
								</tr>
					



    				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 칸충전송금계좌3
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left" colspan=3>
<?
								echo ("				
								<select name='com_bank_name3' tabIndex='5' selectedindex='0' size='1' $selectbox_readonly>
								<option value=''
								");
								if($com_bank_name3 == '') echo " selected";
								echo ("
								>========</option>
								<option value='부산은행'
								");
								if($com_bank_name3 == '부산은행') echo " selected";
								echo ("
								>부산은행</option>
								<option value='경남은행'
								");
								if($com_bank_name3 == '경남은행') echo " selected";
								echo ("
								>경남은행</option>
								<option value='광주은행'
								");
								if($com_bank_name3 == '광주은행') echo " selected";
								echo ("
								>광주은행</option>
								<option value='국민은행'
								");
								if($com_bank_name3 == '국민은행') echo " selected";
								echo ("
								>국민은행</option>
								<option value='기업은행'
								");
								if($com_bank_name3 == '기업은행') echo " selected";
								echo ("
								>기업은행</option>
								<option value='농 협'
								");
								if($com_bank_name3 == '농 협') echo " selected";
								echo ("
								>농 협</option>
								<option value='대구은행'
								");
								if($com_bank_name3 == '대구은행') echo " selected";
								echo ("
								>대구은행</option>
								<option value='도 이 치'
								");
								if($com_bank_name3 == '도 이 치') echo " selected";
								echo ("
								>도 이 치</option>
								<option value='산업은행'
								");
								if($com_bank_name3 == '산업은행') echo " selected";
								echo ("
								>산업은행</option>
								<option value='새마을금고'
								");
								if($com_bank_name3 == '새마을금고') echo " selected";
								echo ("
								>새마을금고</option>
								<option value='상와은행'
								");
								if($com_bank_name3 == '상와은행') echo " selected";
								echo ("
								>상와은행</option>
								<option value='서울은행'
								");
								if($com_bank_name3 == '서울은행') echo " selected";
								echo ("
								>서울은행</option>
								<option value='수 협'
								");
								if($com_bank_name3 == '수 협') echo " selected";
								echo ("
								>수 협</option>
								<option value='시티은행'
								");
								if($com_bank_name3 == '시티은행') echo " selected";
								echo ("
								>시티은행</option>
								<option value='신한은행'
								");
								if($com_bank_name3 == '신한은행') echo " selected";
								echo ("
								>신한은행</option>
								<option value='암로은행'
								");
								if($com_bank_name3 == '암로은행') echo " selected";
								echo ("
								>암로은행</option>
								<option value='외환은행'
								");
								if($com_bank_name3 == '외환은행') echo " selected";
								echo ("
								>외환은행</option>
								<option value='우리은행'
								");
								if($com_bank_name3 == '우리은행') echo " selected";
								echo ("
								>우리은행</option>
								<option value='우 체 국'
								");
								if($com_bank_name3 == '우 체 국') echo " selected";
								echo ("
								>우 체 국</option>
								<option value='전북은행'
								");
								if($com_bank_name3 == '전북은행') echo " selected";
								echo ("
								>전북은행</option>
								<option value='제일은행'
								");
								if($com_bank_name3 == '제일은행') echo " selected";
								echo ("
								>제일은행</option>
								<option value='제주은행'
								");
								if($com_bank_name3 == '제주은행') echo " selected";
								echo ("
								>제주은행</option>
								<option value='조흥은행'
								");
								if($com_bank_name3 == '조흥은행') echo " selected";
								echo ("
								>조흥은행</option>
								<option value='하나은행'
								");
								if($com_bank_name3 == '하나은행') echo " selected";
								echo ("
								>하나은행</option>
								<option value='한미은행'
								");
								if($com_bank_name3 == '한미은행') echo " selected";
								echo ("
								>한미은행</option>
								<option value='홍콩은행'
								");
								if($com_bank_name3 == '홍콩은행') echo " selected";
								echo ("
								>홍콩은행</option>
								</select>
								");

								?>
								계좌번호:<input name="com_bank_account3" class='input' value="<?=$com_bank_account3?>" size="44" <?=$readonly?>>
								예금주:<input name="com_bank_master3" class='input' value="<?=$com_bank_master3?>" size="10" <?=$readonly?>>
								</td>
								</tr>
					
<?
*/
?>

    				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								수금계좌
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left" colspan=3>
<?
								echo ("				
								<select name='com_bank_name4' tabIndex='5' selectedindex='0' size='1' $selectbox_readonly>
								<option value=''
								");
								if($com_bank_name4 == '') echo " selected";
								echo ("
								>========</option>
								<option value='부산은행'
								");
								if($com_bank_name4 == '부산은행') echo " selected";
								echo ("
								>부산은행</option>
								<option value='경남은행'
								");
								if($com_bank_name4 == '경남은행') echo " selected";
								echo ("
								>경남은행</option>
								<option value='광주은행'
								");
								if($com_bank_name4 == '광주은행') echo " selected";
								echo ("
								>광주은행</option>
								<option value='국민은행'
								");
								if($com_bank_name4 == '국민은행') echo " selected";
								echo ("
								>국민은행</option>
								<option value='기업은행'
								");
								if($com_bank_name4 == '기업은행') echo " selected";
								echo ("
								>기업은행</option>
								<option value='농 협'
								");
								if($com_bank_name4 == '농 협') echo " selected";
								echo ("
								>농 협</option>
								<option value='대구은행'
								");
								if($com_bank_name4 == '대구은행') echo " selected";
								echo ("
								>대구은행</option>
								<option value='도 이 치'
								");
								if($com_bank_name4 == '도 이 치') echo " selected";
								echo ("
								>도 이 치</option>
								<option value='산업은행'
								");
								if($com_bank_name4 == '산업은행') echo " selected";
								echo ("
								>산업은행</option>
								<option value='새마을금고'
								");
								if($com_bank_name4 == '새마을금고') echo " selected";
								echo ("
								>새마을금고</option>
								<option value='상와은행'
								");
								if($com_bank_name4 == '상와은행') echo " selected";
								echo ("
								>상와은행</option>
								<option value='서울은행'
								");
								if($com_bank_name4 == '서울은행') echo " selected";
								echo ("
								>서울은행</option>
								<option value='수 협'
								");
								if($com_bank_name4 == '수 협') echo " selected";
								echo ("
								>수 협</option>
								<option value='시티은행'
								");
								if($com_bank_name4 == '시티은행') echo " selected";
								echo ("
								>시티은행</option>
								<option value='신한은행'
								");
								if($com_bank_name4 == '신한은행') echo " selected";
								echo ("
								>신한은행</option>
								<option value='암로은행'
								");
								if($com_bank_name4 == '암로은행') echo " selected";
								echo ("
								>암로은행</option>
								<option value='외환은행'
								");
								if($com_bank_name4 == '외환은행') echo " selected";
								echo ("
								>외환은행</option>
								<option value='우리은행'
								");
								if($com_bank_name4 == '우리은행') echo " selected";
								echo ("
								>우리은행</option>
								<option value='우 체 국'
								");
								if($com_bank_name4 == '우 체 국') echo " selected";
								echo ("
								>우 체 국</option>
								<option value='전북은행'
								");
								if($com_bank_name4 == '전북은행') echo " selected";
								echo ("
								>전북은행</option>
								<option value='제일은행'
								");
								if($com_bank_name4 == '제일은행') echo " selected";
								echo ("
								>제일은행</option>
								<option value='제주은행'
								");
								if($com_bank_name4 == '제주은행') echo " selected";
								echo ("
								>제주은행</option>
								<option value='조흥은행'
								");
								if($com_bank_name4 == '조흥은행') echo " selected";
								echo ("
								>조흥은행</option>
								<option value='하나은행'
								");
								if($com_bank_name4 == '하나은행') echo " selected";
								echo ("
								>하나은행</option>
								<option value='한미은행'
								");
								if($com_bank_name4 == '한미은행') echo " selected";
								echo ("
								>한미은행</option>
								<option value='홍콩은행'
								");
								if($com_bank_name4 == '홍콩은행') echo " selected";
								echo ("
								>홍콩은행</option>
								</select>
								");

								?>
								계좌번호:<input name="com_bank_account4" class='input' value="<?=$com_bank_account4?>" size="44" <?=$readonly?>>
								예금주:<input name="com_bank_master4" class='input' value="<?=$com_bank_master4?>" size="10" <?=$readonly?>>
								</td>
								</tr>
						<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 만료기간
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
								<input name='end_date' type=text size=15 class=b_input id="end_date"  value='<?=$end_date?>' title="YYYY-MM-DD" readonly required='required' itemname='만료기간'  onclick="displayCalendarFor('end_date');">일까지
							</td>
						</tr>

						<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 충전금액설정
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
								<input name='charge_price' type=text size=15 class=b_input id="charge_price"  value='<?=$charge_price?>' required='required' itemname='충전금액설정'>원
							</td>
						</tr>

						<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 회원기간설정
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
								<input name='charge_gigan' type=text size=15 class=b_input id="charge_gigan"  value='<?=$charge_gigan?>' required='required' itemname='회원기간설정'>일
							</td>
							</td>
						</tr>

						<!--
          				<tr>
            				<td bgcolor="#C8DFEC" align="center">그룹 이미지</td>
            				<td bgcolor="#FFFFFF" colspan='3'>&nbsp;&nbsp;<?=$cate_target_img?> <input type='file' size='30' maxlength='100' name='categoryimg' class="input_03" onChange="view_image(this);"><img src='' id="upImage" style="display:none;"></td>
          				</tr>          				
          				<tr>
            				<td bgcolor="#C8DFEC" align="center">그룹 레프트 배너</td>
							<td bgcolor="#FFFFFF" colspan='3'>								
								<textarea name="category_left" id="category_left"><?=$category_left?></textarea>	
 <script>
		var ed = new easyEditor("category_left"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>	
							</td>
          				</tr>
          				<tr>
							<td width="20%" bgcolor="#C8DFEC" align="center"><span class="aa">상점출력유무</span></td>
							<td width="80%" bgcolor="#FFFFFF" colspan="3">
							&nbsp;&nbsp;&nbsp;&nbsp; 
							<input class="aa" type="radio" value="0" name="if_hide" <?if($if_hide == '0') echo "checked";?>> 상점에 출력함
							<input class="aa" type="radio" value="1" name="if_hide" <?if($if_hide == '1') echo "checked";?>>상점에 출력하지않음 <br>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							(등록은 되지만, 상점에 출력되지는 않습니다)
						</td>
              		</tr>
					-->
        				</table>
        			</td>
      			</tr>
   		   </table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
      			<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
						<input class="aa" onClick="javascript:history.go(-1);" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="뒤로가기">

					</td>
  				</tr>
  				<tr align="center">
    				<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
  				</tr>
			</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>