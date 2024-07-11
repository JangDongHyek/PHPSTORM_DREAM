<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == "delete"){
	$SQL = "delete from item where item_no='$item_no'";
	$dbresult = mysql_query($SQL, $dbconn);
	echo"<script>alert('회원을 삭제했습니다');location.href='./item_list.php?pu=$pu&category_num=$category_num&page=$page';</script>";
}

if($category_num){
$cur_category_name = category_navi($category_num);
}
$category_num_ori = $category_num;
$SQL = "select * from $MartDesignTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$item_zoom_module = $ary[item_zoom_module];
}
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$if_gnt_item = $ary[if_gnt_item];
	$if_customer_price = $ary["if_customer_price"];
}

$SQL = "select * from $ItemTable where item_no='$item_no' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);

	$provider_id = $ary[provider_id];
	$category_num = $ary[category_num];
	$sea_num = $ary[sea_num];
	$sung_num = $ary[sung_num];
	$khan_num = $ary[khan_num];
	$sea_area = $ary[sea_area];
	$sung_area = $ary[sung_area];
	$khan_area = $ary[khan_area];
	$last_num = $ary[last_num];
	$sudong_num = $ary[sudong_num];
	$item_name = $ary[item_name];

	$start_date = $ary[start_date];
	$end_date = $ary[end_date];

	$jumin1 = $ary[jumin1];
	$jumin2 = $ary[jumin2];
	$sex = $ary[sex];
	$co_name = $ary[co_name];
	$co_num = $ary[co_num];



	$tel = $ary[tel];
	$address2 = $ary[address2];
	$zip = $ary[zip];
	$g_margin = $ary[g_margin];
	$bonus = $ary[bonus];
	$use_bonus = $ary[use_bonus];
	$address = $ary[address];
	$img = $ary[img];
	$img_big = $ary[img_big];
	$img_big2 = $ary[img_big2];
	$img_big3 = $ary[img_big3];
	$img_big4 = $ary[img_big4];
	$img_big5 = $ary[img_big5];
	$opt = $ary[opt];
	$doctype = $ary[doctype];
	$item_explain = htmlspecialchars($ary[item_explain], ENT_QUOTES);
	$short_explain = $ary[short_explain];
	$reg_date = $ary[reg_date];
	$item_code = $ary[item_code];
	$item_id = $ary[item_id];
	$item_pw = $ary[item_pw];
	$mobile = $ary[mobile];
	$email = $ary[email];
	$if_strike = $ary[if_strike];
	$if_provide_item = $ary[if_provide_item];
	$provide_price = $ary[provide_price];
	$img_sml = $ary[img_sml];
	$flash_big_width = $ary[flash_big_width];
	$flash_big_height = $ary[flash_big_height];
	$img_high = $ary[img_high];
	$if_cash = $ary[if_cash];
	$fee = $ary[fee];
	$thumbnail = $ary[thumbnail];
	$job = $ary[job];
	$hobby = $ary[hobby];
	$com_bank_name = $ary[com_bank_name];
	$com_bank_account = $ary[com_bank_account];
	$my_bank_name = $ary[my_bank_name];
	$my_bank_account = $ary[my_bank_account];
	$com_bank_master = $ary[com_bank_master];
	$my_bank_master = $ary[my_bank_master];


	$sql="select * from $OptionTable where item_no='$item_no' order by opt_order asc";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt_name.=$rs[opt_name]."/";
		$opt_price.=$rs[opt_price]."/";
		$opt_ea.=$rs[opt_ea]."/";
		$opt_order.=$rs[opt_order]."/";
		$opt_no.=$rs[opt_no]."/";
		$opt_code.=$rs[opt_code]."/";
		$opt_order_j=$rs[opt_order];

	}
	//$opts = explode("=", $opt);
	

	$sql="select * from $OptionTable2 where item_no='$item_no' order by opt_order asc";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt_name2.=$rs[opt_name]."/";
		$opt_price2.=$rs[opt_price]."/";
		$opt_ea2.=$rs[opt_ea]."/";
		$opt_order2.=$rs[opt_order]."/";
		$opt_no2.=$rs[opt_no]."/";
		$opt_code2.=$rs[opt_code]."/";
		$opt_order_j2=$rs[opt_order];
	}

	$sql="select * from $OptionTable3 where item_no='$item_no' order by opt_order asc";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt_name3.=$rs[opt_name]."/";
		$opt_price3.=$rs[opt_price]."/";
		$opt_ea3.=$rs[opt_ea]."/";
		$opt_order3.=$rs[opt_order]."/";
		$opt_no3.=$rs[opt_no]."/";
		$opt_code3.=$rs[opt_code]."/";
		$opt_order_j3=$rs[opt_order];
	}

	$sql="select * from $OptionTable4 where item_no='$item_no' order by opt_order asc";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt_name4.=$rs[opt_name]."/";
		$opt_price4.=$rs[opt_price]."/";
		$opt_ea4.=$rs[opt_ea]."/";
		$opt_order4.=$rs[opt_order]."/";
		$opt_no4.=$rs[opt_no]."/";
		$opt_code4.=$rs[opt_code]."/";
		$opt_order_j4=$rs[opt_order];
	}


	$short_explain = eregi_replace( "<br>", "", $short_explain );
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm){
	if(frm.item_name.value==""){alert("\n성명을 입력하세요.");frm.item_name.focus();return false;}	
	

	if (frm.item_code.value==""){
		alert("회원번호를 입력하세요");
		frm.item_code.focus();
		return false;
	}



	
	
	return true;
}


</script>
<script language="javascript">
<!--
function opensub2(x)
{	 
	var child;
	window.open(x,'x' ,'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,width=800,height=200,left=0,top=0');
}
// -->    
</script>
<script language="javascript">

//*************************** 파일 업로드 창 ******************************************************************

function fileup(formname,imagename){
// formname : form 의 name
// mart_id : 상점 mart_id
// imagename : 업로드되는 이미지 파일이 입력되는 field name, 이 값이 DB에 저장
	
	var url = "../file_upload_2img.php?formname="+formname+"&imagename="+imagename
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

//*************************** 파일 업로드 창 *******************************************************************
</script>
<script>
/*
var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	var f = document.writeform;
	f.editBox.editmode = sMode;
}
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.item_explain.value;
	f.editBox.focus();
	f.editBox.setFocus();
}


function checkform1(){
	var f = document.writeform;
	f.editBox.editmode = "html";
	f.item_explain.value = f.editBox.html;
	return true;
}*/
</script>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</SCRIPT>
<script language="javascript">
//콤마 넣기(정수만 해당) 
function comma(val){ 
	val = get_number(val); 
	if(val.length <= 3) return val; 

	var loop = Math.ceil(val.length / 3); 
	var offset = val.length % 3; 
	if(offset==0) offset = 3; 
	var ret = val.substring(0, offset); 
	for(i=1;i<loop;i++) { 
	ret += "," + val.substring(offset, offset+3); 
	offset += 3; } return ret; 
} 

//문자열에서 숫자만 가져가기 
function get_number(str){ 
	var val = str; 
	var temp = ""; 
	var num = ""; 

	for(i=0; i<val.length; i++){ 
		temp = val.charAt(i); 
		if(temp >= "0" && temp <= "9") num += temp; 
	} 
	return num; 
}
//숫자만 입력하기 
function checkNumber(){
	var objEv = event.srcElement;
	var num ="0123456789,";
	event.returnValue = true;
	 
	for (var i=0;i<objEv.value.length;i++){
		if(-1 == num.indexOf(objEv.value.charAt(i)))
		event.returnValue = false;
	}
	 
	if (!event.returnValue)
	objEv.value="";
}
//마진 계산하기
function cal(){
	var here = document.writeform;
	var pr = eval(here.zip.value);
	var gr = eval(here.g_margin.value);
	var tot = Math.ceil( ( pr * (100+ gr) ) / 100 );
	here.address2.value=tot;
	here.bonus.focus();
}
</script>
<SCRIPT LANGUAGE="JavaScript">
<!--
function toggle1(iobject){
		document.all.auto.style.display = ""
		document.all.passive.style.display = "none"
}	
function toggle2(iobject){
		document.all.auto.style.display = "none"
		document.all.passive.style.display = ""
}
//-->
</SCRIPT>
<script src="../../editor/easyEditor.js"></script>

</head>

<?

if($thumbnail=='y'){
	$toggle="toggle1()";
}else{
	$toggle="toggle2()";
}

?>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" onLoad="<?=$toggle?>">
<table width="900" height="100%"  border="0" cellpadding="0" cellspacing="0" align=center>
	<tr valign="top">
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>현재그룹 : <?=$cur_category_name?></b></td>
				</tr>
			</table>

			<!--내용 START~~-->   	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px"><b>[회원 정보]</b><br><br>
				</td>
			</tr>

      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF"></td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
        		<table border="0" width="95%">
				<form action='item_modify.php?item_no=<?=$item_no?>&flag=update&page=<?=$page?>&searchword=<?=$searchword?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num_ori?>&pu=<?=$pu?>' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="img_sml_updateflag" value='ok'>
				<input type="hidden" name="img_updateflag" value='ok'>
				<input type="hidden" name="img_big_updateflag" value='ok'>
				<input type="hidden" name="img_big2_updateflag" value='ok'>
				<input type="hidden" name="img_big3_updateflag" value='ok'>
				<input type="hidden" name="img_big4_updateflag" value='ok'>
				<input type="hidden" name="img_big5_updateflag" value='ok'>
				<input type="hidden" name="img_high_updateflag" value='ok'>
				<input type="hidden" name="item_no" value="<?=$item_no?>">
				<input type="hidden" name="category_num" value="<?=$category_num_ori?>">
				<input type="hidden" name="prevno" value="<?=$prevno?>">
				<input type="hidden" name="doctype" value="0">
				<!--<input type="hidden" name="item_explain" value="<?=$item_explain?>">-->
				<input type="hidden" name="reg_date" value='<?=$reg_date?>'>
				<input type="hidden" name="img_sml_old" value='<?=$img_sml?>'>
				<input type="hidden" name="img_old" value='<?=$img?>'>
				<input type="hidden" name="img_big_old" value='<?=$img_big?>'>
				<input type="hidden" name="img_big2_old" value='<?=$img_big2?>'>
				<input type="hidden" name="img_big3_old" value='<?=$img_big3?>'>
				<input type="hidden" name="img_big4_old" value='<?=$img_big4?>'>
				<input type="hidden" name="img_big5_old" value='<?=$img_big5?>'>
				<input type="hidden" name="img_high_old" value='<?=$img_high?>'>
				<input type="hidden" name="searchword" value='<?=$searchword?>'>
				<input type="hidden" name="provider_id" value="<?=$Mall_Admin_ID?>">

              			
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
               			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				고유번호
							</td>
                			<td width="35%" bgcolor="#FFFFFF" colspan=4>
								<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="5" maxlength=4 readonly>
								<?if($_SESSION["MemberLevel"] == 10){?>
								<input class="aa" type="text" name="sea_area" value='<?=$sea_area?>' size="6" readonly>
								<?}?>
								<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2 readonly>
								<?if($_SESSION["MemberLevel"] == 10){?>
								<input class="aa" type="text" name="sung_area" value='<?=$sung_area?>' size="6" readonly>
								<?}?>
								<input class="aa" type="text" name="khan_num" value='<?=$khan_num?>' size="3" maxlength=2 readonly>
								<?if($_SESSION["MemberLevel"] == 10){?>
								<input class="aa" type="text" name="khan_area" value='<?=$khan_area?>' size="6" readonly>
								<?}?>
								

								<input class="aa" type="text" name="sudong_num" value='<?=$sudong_num?>' size="5" maxlength=4 readonly>
							</td>

              			</tr>
						<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				성명
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_name" value="<?=$item_name?>" size="14">
							</td>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				회원번호
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_code" value="<?=$item_code?>" size="16"> 
							</td>
              			</tr>
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				아이디
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_id" value="<?=$item_id?>" size="14">
							</td>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				비밀번호
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_pw" size="10" <?if($_SESSION["MemberLevel"] == 10){?> value="<?=$item_pw?>" <?}?>>
							</td>
              			</tr>
		
						<tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								 성별
							</td>
			                <td bgColor="#ffffff">
								<input type=radio name="sex" value="남" <?if($sex=="남"){echo"checked";}?>>남 <input type=radio name="sex" value="여" <?if($sex=="여"){echo"checked";}?>>여
							</td>
			                <td align="center" bgColor="#c8dfec" colspan="2">
								사업자번호
							</td>
			                <td bgColor="#ffffff">
								<input name="co_num" class='input' value="<?=$co_num?>" size="24">
							</td>
			              </tr>						  
              			<tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								전화 
							</td>
			                <td bgColor="#ffffff">
								<input name="tel" class='input' value="<?=$tel?>" size="24">
							</td>
			                <td align="center" bgColor="#c8dfec" colspan="2">
								핸드폰
							</td>
			                <td bgColor="#ffffff">
								<input name="mobile" class='input' value="<?=$mobile?>" size="24">
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								이메일
							</td>
			                <td bgColor="#ffffff">
								<input name="email" class='input' value="<?=$email?>" size="34">
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								직업
							</td>
			                <td bgColor="#ffffff">
								<input name="job" class='input' value="<?=$job?>" size="34">
							</td>
			              </tr>
						  <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								주소
							</td>
			                <td bgColor="#ffffff">
								<input name="address" class='input' value="<?=$address?>" size="28">
								<?$addr = str_replace("부산시 진구","부산시 부산진구",$address);?>
								<font style='cursor:hand;' onclick="window.open('../../market/board_mem/map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[위치확인]</font>	
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								우편번호
							</td>
			                <td bgColor="#ffffff">
								<input name="zip" class='input' value="<?=$zip?>" size="34">
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								주소2
							</td>
			                <td bgColor="#ffffff">
								<input name="address2" class='input' value="<?=$address2?>" size="28">
								<?$addr = str_replace("부산시 진구","부산시 부산진구",$address2);?>
								<font style='cursor:hand;' onclick="window.open('../../market/board_mem/map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[위치확인]</font>	
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								칸카드
							</td>
			                <td bgColor="#ffffff">
								<?
								if($img_big != '' && file_exists("$Co_img_UP$mart_id/$img_big")){
									if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
												echo "
									<img src='../..$Co_img_DOWN$mart_id/$img_big' width='120'>
										";
									}
									if (strstr(strtolower(substr($img_big,-4)),'.swf')){
												echo "
									<embed src='../..$Co_img_DOWN$mart_id/$img_big' width='120'></embed>
										";
									}
								?>
								<input type="checkbox" name="del_big" value="y">삭제
								<?
								}
								?>
								<input type="file" name="img_big" class='input' size="30">
							</td>
			              </tr>
<?
/*
?>
						  <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								칸충전송금계좌
							</td>
			                <td bgColor="#ffffff" colSpan="4">
								<?
								echo ("				
								<select name='com_bank_name' tabIndex='5' selectedindex='0' size='1'>
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
								계좌번호:<input name="com_bank_account" class='input' value="<?=$com_bank_account?>" size="44">
								예금주:<input name="com_bank_master" class='input' value="<?=$com_bank_master?>" size="10">
							</td>
							</tr>
<?*/?>						
							<tr>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								나의거래계좌
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<?
								echo ("				
								<select name='my_bank_name' tabIndex='5' selectedindex='0' size='1'>
								<option value=''
								");
								if($my_bank_name == '') echo " selected";
								echo ("
								>========</option>
								<option value='부산은행'
								");
								if($my_bank_name == '부산은행') echo " selected";
								echo ("
								>부산은행</option>
								<option value='경남은행'
								");
								if($my_bank_name == '경남은행') echo " selected";
								echo ("
								>경남은행</option>
								<option value='광주은행'
								");
								if($my_bank_name == '광주은행') echo " selected";
								echo ("
								>광주은행</option>
								<option value='국민은행'
								");
								if($my_bank_name == '국민은행') echo " selected";
								echo ("
								>국민은행</option>
								<option value='기업은행'
								");
								if($my_bank_name == '기업은행') echo " selected";
								echo ("
								>기업은행</option>
								<option value='농 협'
								");
								if($my_bank_name == '농 협') echo " selected";
								echo ("
								>농 협</option>
								<option value='대구은행'
								");
								if($my_bank_name == '대구은행') echo " selected";
								echo ("
								>대구은행</option>
								<option value='도 이 치'
								");
								if($my_bank_name == '도 이 치') echo " selected";
								echo ("
								>도 이 치</option>
								<option value='산업은행'
								");
								if($my_bank_name == '산업은행') echo " selected";
								echo ("
								>산업은행</option>
								<option value='새마을금고'
								");
								if($my_bank_name == '새마을금고') echo " selected";
								echo ("
								>새마을금고</option>
								<option value='상와은행'
								");
								if($my_bank_name == '상와은행') echo " selected";
								echo ("
								>상와은행</option>
								<option value='서울은행'
								");
								if($my_bank_name == '서울은행') echo " selected";
								echo ("
								>서울은행</option>
								<option value='수 협'
								");
								if($my_bank_name == '수 협') echo " selected";
								echo ("
								>수 협</option>
								<option value='시티은행'
								");
								if($my_bank_name == '시티은행') echo " selected";
								echo ("
								>시티은행</option>
								<option value='신한은행'
								");
								if($my_bank_name == '신한은행') echo " selected";
								echo ("
								>신한은행</option>
								<option value='암로은행'
								");
								if($my_bank_name == '암로은행') echo " selected";
								echo ("
								>암로은행</option>
								<option value='외환은행'
								");
								if($my_bank_name == '외환은행') echo " selected";
								echo ("
								>외환은행</option>
								<option value='우리은행'
								");
								if($my_bank_name == '우리은행') echo " selected";
								echo ("
								>우리은행</option>
								<option value='우 체 국'
								");
								if($my_bank_name == '우 체 국') echo " selected";
								echo ("
								>우 체 국</option>
								<option value='전북은행'
								");
								if($my_bank_name == '전북은행') echo " selected";
								echo ("
								>전북은행</option>
								<option value='제일은행'
								");
								if($my_bank_name == '제일은행') echo " selected";
								echo ("
								>제일은행</option>
								<option value='제주은행'
								");
								if($my_bank_name == '제주은행') echo " selected";
								echo ("
								>제주은행</option>
								<option value='조흥은행'
								");
								if($my_bank_name == '조흥은행') echo " selected";
								echo ("
								>조흥은행</option>
								<option value='하나은행'
								");
								if($my_bank_name == '하나은행') echo " selected";
								echo ("
								>하나은행</option>
								<option value='한미은행'
								");
								if($my_bank_name == '한미은행') echo " selected";
								echo ("
								>한미은행</option>
								<option value='홍콩은행'
								");
								if($my_bank_name == '홍콩은행') echo " selected";
								echo ("
								>홍콩은행</option>
								</select>
								");

								?>
								계좌번호:<input name="my_bank_account" class='input' value="<?=$my_bank_account?>" size="44">	
								예금주:<input name="my_bank_master" class='input' value="<?=$my_bank_master?>" size="10">
								</td>
			              </tr>
						  
						  <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								회원기간
							</td>
			                <td bgColor="#ffffff" colspan=4>
								<input name="start_date" class='input' value="<?=$start_date?>" size="15"> ~ <input name="end_date" class='input' value="<?=$end_date?>" size="15">
							</td>			               
			              </tr>
</table>
<table border="0" width="100%" cellpadding=1 cellspacing=1>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				메 모
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="6">
								<textarea name="short_explain" rows='3' cols='108'><?=$short_explain?></textarea>
                			</td>
              			</tr>
		

              			<tr>
                		
              			<tr>
                			<td width="47%" bgcolor="#C8DFEC" align="center" colspan="3">등록일</td>
                			<td width="53%" bgcolor="#FFFFFF" colspan="3"><?=$reg_date?></td>
              			</tr>
              			
            			</table>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
				<script type="text/javascript">
				<!--
					function delete_mem(pu,item_no, tmp_category_num, mart_id){						
						if (confirm("현재회원을 삭제 하시겠습니까?")){
							location.href='item_edit.php?pu='+pu+'&item_no='+item_no+'&category_num='+tmp_category_num+'&flag=delete';
						}
					}	
	
				//-->
				</script>

<?
if( $back == "ok" ){
?>
        		<input onclick="location.href='item_list_ok.php?back=<?=$back?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>&select_key=<?=$select_key?>&date_expire=<?=$date_expire?>&pu=<?=$pu?>'" class='butt_none' style='width:60' type="button" value="리스트" style='cursor:hand'>
<?
}else{
?>
<input onclick="location.href='item_list.php?prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num_ori?>&page=<?=$page?>&searchword=<?=$searchword?>&pu=<?=$pu?>'" class='butt_none' style='width:60' type="button" value="리스트" style='cursor:hand'>
<?
}
?>
        	</td>
      	</tr>
   <script>
		var ed = new easyEditor("item_explain"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>    	
      	</form>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>	
<?
mysql_close($dbconn);
?>
