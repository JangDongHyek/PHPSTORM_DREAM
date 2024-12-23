<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$ary = mysql_fetch_array($dbresult);
	$shopname = $ary["shopname"];
	$name = $ary["name"];
	$passport = $ary["passport"];
	$tel1 = $ary["tel1"];
	$tel2 = $ary["tel2"];
	$email = $ary["email"];
	$place = $ary["place"];
}

$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0){
	$ary = mysql_fetch_array($dbresult);
	$shop_logo = $ary[logo];
	$shopuser = $ary[shopuser];
	$bonus_ok = $ary[bonus_ok];
	$bonus_auto_ok = $ary[bonus_auto_ok];
	$bonus_auto_percent = $ary[bonus_auto_percent];
	$init_bonus = $ary[init_bonus];
	$bookmark_bonus_ok = $ary[bookmark_bonus_ok];
	$init_bookmark_bonus = $ary[init_bookmark_bonus];
	$by_cash_bonus_ok = $ary[by_cash_bonus_ok];
	$init_by_cash_bonus = $ary[init_by_cash_bonus];
	$welcome = $ary[welcome];
	$copyright = htmlspecialchars($ary[copyright], ENT_QUOTES);
	$card_yes = $ary[card_yes];
	$card_url = $ary[card_url];
	$freight_date = $ary[freight_date];
	$freight_limit = $ary[freight_limit];
	$freight_cost = $ary[freight_cost];
	$union_freight_limit = $ary[union_freight_limit];
	$union_freight_cost = $ary[union_freight_cost];
	$pur_limit = $ary[pur_limit];
	$card_limit = $ary[card_limit];
	$event_width = $ary[event_width];
	$event_height = $ary[event_height];
	$width = $ary[width];
	$titlecolor = $ary[titlecolor];
	$titletxtcolor = $ary[titletxtcolor];
	$listcolor = $ary[listcolor];
	$listtxtcolor = $ary[listtxtcolor];
	$color = $ary[color];
	$user_words = $ary[user_words];
	$user_words_perm = $ary[user_words_perm];
	$if_union = $ary[if_union];
	$intro = $ary[intro];
	$if_notice = $ary[if_notice];
	$if_chuchon = $ary[if_chuchon];
	$if_event = $ary[if_event];
	$if_coupon = $ary[if_coupon];
	$if_receipt = $ary[if_receipt];
	$if_community = $ary[if_community];
	$page_title = $ary[page_title];
	$member_confirm = $ary[member_confirm];
	$if_poll = $ary[if_poll];
	$if_quiz = $ary[if_quiz];
	$account_yes = $ary[account_yes];
	$bonus_limit = $ary[bonus_limit];
	//$if_gnt_item = $ary[if_gnt_item];
	$if_mem_use_pass = $ary[if_mem_use_pass];
	$if_nomem_use_pass = $ary[if_nomem_use_pass];
	$if_use_bottom_img = $ary[if_use_bottom_img];
	$if_member_price = $ary[if_member_price];
	$member_price_percent = $ary[member_price_percent];
	$if_customer_price = $ary[if_customer_price];
	$xpay_id = $ary[xpay_id];
	$xpay_key = $ary[xpay_key];

	

	if( $shop_logo ){
		$upload = "../../up/$mart_id/";
		$target = "$upload"."$shop_logo";
		//==================== 이미지 사이즈를 구함 ==========================================
		$img_size = @GetImageSize("$target"); 
		$img_width = $img_size[0]; //이미지의 넓이를 알 수 있음 
		$img_height = $img_size[1]; //이미지의 높이를 알 수 있음
	}
}
?>
<?
include "../admin_head.php";
?>

<script>
function frm_val(f){
	if(f.name.value==""){
		alert("성명을 입력하세요");
		f.name.focus();
		return false;
	}
	if(f.shopname.value==""){
		alert("쇼핑몰이름을 입력하세요");
		f.shopname.focus();
		return false;
	}
	if(f.email.value==""){
		alert("이메일주소를 입력하세요");
		f.email.focus();
		return false;
	}
	/*
	if(f.tel1.value==""){
		alert("전화번호를 입력하세요");
		f.tel1.focus();
		return false;
	}
	*/
	if(f.place.value==""){
		alert("주소를 입력하세요");
		f.place.focus();
		return false;
	}
	/*if(f.if_member_price.checked){
		if(f.member_price_percent.value==""){
			alert("퍼센트를 입력하세요");
			f.member_price_percent.focus();
			return false;
		}	
	}*/
	if(f.pur_limit.value==""){
		alert("최소 구매액을 입력하세요");
		f.pur_limit.focus();
		return false;
	}
	if(f.card_limit.value==""){
		alert("최소 카드결제액을 입력하세요");
		f.card_limit.focus();
		return false;
	}
	if(f.init_bonus.value==""){
		alert("회원가입시 포인트를 입력하세요");
		f.init_bonus.focus();
		return false;
	}

	// #####################################################################
	// ###  홈페이지주소,포트번호,이미지업로드,경로,용량,업로드절대경로  ###
	// ###  저장되는 이미지를 위한 부분									 ###
	// #####################################################################
	/*var base = document.f;
	if (base.copyright_txt.UploadLocalImg("<?=$urlx?>", <?=$port?>, "<?=$upload_php?>", "<?=$upload?>", 0, "<?=$homeup_url?>") < 0){
		alert(base.copyright_txt.UploadImgError);
		return false;
	}
	base.copyright.value = base.copyright_txt.Body;*/
	//=======================================================================

	return true;
	
}
function find_zip(){
			var Sel = window.open ( 'find_zip_etrans.php', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
}	
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
</script>
<script language="JavaScript">
<!--

/*function exp(f) {
	if (f.if_member_price.checked) {
		member_price_table.style.display="block";
	}
	else {
		member_price_table.style.display="none";
	}
}*/
//-->
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu1.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/main_title.gif" width="310" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="10"></td>
                  </tr>
                  <tr>
                    <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">기본설정</span> &gt; <span class="text_gray2_c">쇼핑몰 기본설정</span>  </div></td>
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
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500">
			<!--왼쪽부분시작-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
  </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>쇼핑몰기본정보</b></td>
			</table>

			<!--내용 START~~--><br>

<form name='f' method='post' onsubmit="return frm_val(this)" action='regist.php' enctype="multipart/form-data">
<input type="hidden" name="flag" value="update" >
<input type='hidden' name='shop_logo' value='<?=$shop_logo?>'>

		<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="25%">성명</td>
						<td width="25%">
							<input name="name" size="30" value='<?echo $name?>' class="input_03"></td>
						<td width="25%">쇼핑몰이름</td>
						<td width="25%">
							<input name="shopname" size="30" value='<?echo $shopname?>' class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">쇼핑몰 로고</td>
						<td colspan='3'>
						<input type='file' size='30' maxlength='100' name='shoplogo' class="input_03"> (관리자 상단 로고. 200 X 60)<br>
<?
if( $shop_logo ){
	if( $img_width > 500 ){
?>
						<미리보기><br><img src='<?=$target?>' width='500'>
<?
	}else{
?>
						<미리보기><br><img src='<?=$target?>'>
<?
	}
}else{
}
?>
					</td>
					</tr>
					<tr>
						<td width="25%">페이지 타이틀</td>
						<td colspan='3'>
						<input name="page_title" size="70" value='<?=$page_title?>' class="input_03">
					</td>
					</tr>
					<tr>
						<td width="25%">이메일</td>
						<td width="25%">
							<input name="email" size="30" value='<?echo $email?>' class="input_03"></td>
						<td width="25%">사업자등록번호</td>
						<td width="25%">
							<input name="passport" size="30" value='<?echo $passport?>' class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">전화번호</td>
						<td width="25%">
							<input name="tel1" size="30" value='<?echo $tel1?>' class="input_03"></td>
						<td width="25%">팩스번호</td>
						<td width="25%">
							<input name="tel2" size="30" value='<?echo $tel2?>' class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">주소</td>
						<td width="75%" colspan='3'>
							<input name="place" size="70" value='<?echo $place?>' class="input_03"></td>
				  </td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="0" valign="top">
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="25%">택배비 적용</td>
						<td width="75%">
							<input name="freight_limit" size="20" value='<?echo $freight_limit?>' class="input_03"> 
							원미만&nbsp; 택배비 
							<input name="freight_cost" size="20" value='<?echo $freight_cost?>' class="input_03"> 
							원</td>
					</tr>
					<!-- <tr>
						<td width="25%">공동구매 택배비 적용</td>
						<td width="75%">
							<input name="union_freight_limit" size="20" value='<?echo $union_freight_limit?>' class="input_03"> 
							원미만&nbsp; 택배비 
							<input name="union_freight_cost" size="20" value='<?echo $union_freight_cost?>' class="input_03"> 
							원</td>
					</tr> -->
					<!-- <tr>
						<td width="25%">회원가 사용여부</td>
						<td width="75%">
						<input type='checkbox' name='if_member_price' onclick="exp(this.form)" value='1'
						<?
						if($if_member_price == '1') echo " checked";
						?>
						>회원가 사용 
						
						<div id='member_price_table' style='display:none'>
						<table width='80%' border='0'>
						  <tr>
							<td>
							<span>전체상품을 비회원가의 <input name='member_price_percent' size='3' value='<?echo $member_price_percent?>' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid'> %로 책정합니다. 
							</td>
						  </tr>
						</table>
						</div>
						</td>
					</tr> -->
					<tr>
						<td width="25%">소비자가 사용여부</td>
						<td width="75%">
						<input type='checkbox' name='if_customer_price' value='1'
						<?
						if($if_customer_price == '1') echo " checked";
						?>
						>소비자가 사용 
						</td>
					</tr>
					<tr>
						<td>결제수단</td>
						<td><span class="bb">
							<input type='checkbox' checked disabled>무통장입금
							<input name='account_yes' type='checkbox' value='t'
							<?
							if($account_yes == 't') echo " checked";
							?>
							>계좌이체
							<input name='card_yes' type='checkbox' value='t'
							<?
							if($card_yes == 't') echo " checked";
							?>
							>신용카드
							
						</td>
					</tr>
					<tr>
						<td>회원정책</td>
						<td><span class="bb">
							<select name="shopuser" size="1" style="height: 18px; border: 1px solid black">
							<option value="0"<?if($shopuser=='0') echo " selected"?>>회원과 비회원제를 함께 운영</option>
							<option value="1"<?if($shopuser=='1') echo " selected"?>>회원과 비회원제를 함께 운영(성인몰)</option>
							<option value="2"<?if($shopuser=='2') echo " selected"?>>회원만 구매가능</option>
							<option value="3"<?if($shopuser=='3') echo " selected"?>>회원만 상점출입가능(B2B)</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>회원가입 처리방식</td>
						<td>
							<input name="member_confirm" type="radio" value="0"<?if($member_confirm==0) echo " checked"?>>신청 즉시 가입
							&nbsp; 
							<input name="member_confirm" type="radio" value="1"<?if($member_confirm==1) echo " checked"?>>관리자 승인후 가입
						</td>
					</tr>
					<tr>
						<td>최소 구매액</td>
						<td>
							<input name="pur_limit" size="20" value='<?echo $pur_limit?>' class="input_03"> 
							원 (예: 10,000원미만은 주문접수가 안됩니다)
						</td>
					</tr>
					<tr>
						<td>최소 카드결제액</td>
						<td>
							<input name="card_limit" size="20" value='<?echo $card_limit?>' class="input_03"> 
							원 (예: 10,000원미만은 카드결제가 안됩니다)
						</td>
					</tr>
					<tr>
						<td>포인트 이용여부</td>
						<td>
							<input name="bonus_ok" type="radio" value="t"<?if($bonus_ok=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="bonus_ok" type="radio" value="f"<?if($bonus_ok=='f') echo " checked"?>>No
						</td>
					</tr>
					<tr>
						<td>포인트 자동계산</td>
						<td>
							<input name="bonus_auto_ok" type="radio" value="t"<?if($bonus_auto_ok=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="bonus_auto_ok" type="radio" value="f"<?if($bonus_auto_ok=='f') echo " checked"?>>No

							&nbsp;&nbsp;<input type=text name=bonus_auto_percent value="<?=$bonus_auto_percent?>" size=5 maxlength=4 onkeyup="checkNumber()">%적용 (정수만 입력가능합니다)
						</td>
					</tr>					<tr>
						<td>최소 포인트 결제액</td>
						<td>
							<input name="bonus_limit" size="20" value='<?echo $bonus_limit?>' class="input_03"> 
							원 (예: 포인트가 10,000원 이상일 경우에만 현금처럼 사용가능합니다.)</td>
					</tr>
					<tr>
						<td width="25%">회원가입시 포인트</td>
						<td width="75%">
							<input name="init_bonus" size="20" value='<?echo $init_bonus?>' class="input_03"> 
						</td>
					</tr>
					<tr>
						<td width="25%">즐겨찾기 추가시 포인트 사용</td>
						<td width="75%">
							<input name="bookmark_bonus_ok" type="radio" value="t"<?if($bookmark_bonus_ok=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="bookmark_bonus_ok" type="radio" value="f"<?if($bookmark_bonus_ok=='f') echo " checked"?>>No
							&nbsp;
							<input name="init_bookmark_bonus" size="20" value='<?echo $init_bookmark_bonus?>' class="input_03"> 
						</td>
					</tr>
					<tr>
						<td width="25%">현금결제시 추가 포인트 사용</td>
						<td width="75%">
							<input name="by_cash_bonus_ok" type="radio" value="t"<?if($by_cash_bonus_ok=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="by_cash_bonus_ok" type="radio" value="f"<?if($by_cash_bonus_ok=='f') echo " checked"?>>No
							&nbsp;
							<input name="init_by_cash_bonus" size="20" value='<?echo $init_by_cash_bonus?>' class="input_03"> 
						</td>
					</tr>
					<tr>
						<td>상품후기기능</td>
						<td>
							<input name="user_words" type="radio" value="t"<?if($user_words=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="user_words" type="radio" value="f"<?if($user_words=='f') echo " checked"?>>No
						</td>
					</tr>
					<tr>
						<td>후기쓰기권한</td>
						<td>
							<input name="user_words_perm" type="radio" value="o"<?if($user_words_perm=='o') echo " checked";?>>구입한 회원
							&nbsp; 
							<input name="user_words_perm" type="radio" value="m"<?if($user_words_perm=='m') echo " checked";?>>모든회원
							<input name="user_words_perm" type="radio" value="a"<?if($user_words_perm=='a') echo " checked";?>>회원 비회원 모두가능
						</td>
					</tr>
				</table>
			</td>
			</tr>
			<tr>
			  <td width="100%" bgcolor="#6084D5" height="1"></td>
			</tr>
<script type="text/javascript">
<!--
<?	if($user_words=='f'){ ?>
			user_words_perm[0].disable = true;
			user_words_perm[1].disable = true;
<?	 }	?>
//-->
</script>
			<tr>
			  <td width="100%" bgcolor="#FFFFFF">
			  
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				 <tr>
					<td width="100%" colspan="2">주문서작성시 주민등록번호 항목 
					선택</td>
				 </tr>
				 <tr>
					<td width="22%"></td>
					<td width="78%"></td>
				 </tr>
				 <tr>
					<td width="22%">회원</td>
					<td width="78%">
					<select tabIndex="5" size="1" name="if_mem_use_pass">
					  <option value="1"
					  <?
					  if($if_mem_use_pass == '1') echo " selected";
					  ?>
					  >주민번호 항목 사용</option>
					  <option value="0"
					  <?
					  if($if_mem_use_pass == '0') echo " selected";
					  ?>
					  >주민번호 항목 사용하지 않음</option>
					</select></td>
				 </tr>
				 <tr>
					<td>비회원</td>
					<td>
						<select tabIndex="5" size="1" name="if_nomem_use_pass">
						<option value="1"
						<?
						if($if_nomem_use_pass == '1') echo " selected";
						?>
						>주민번호 항목 사용</option>
						<option value="0"
						<?
						if($if_nomem_use_pass == '0') echo " selected";
						?>
						>주민번호 항목 사용하지 않음</option>
						</select>
					</td>
				 </tr>
			  </table>
			  </td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="0" valign="top">
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="25%" valign="top">입금계좌</td>
						<td width="75%">
							<select name="Bankcodename" tabIndex="5" selectedindex="0" size="1" disabled='ok'>
							<option value="">은행선택</option>
						</select>&nbsp; 
							<input size="17" class="input_03" value="계좌번호입력" disabled='ok'>&nbsp; 
							<input size="14" class="input_03" value="예금주입력" disabled='ok'><br>
							
							<?
						$SQL = "select * from $BankTable where mart_id='$mart_id' order by account_no";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						for ($i=0; $i<$numRows; $i++) {
							mysql_data_seek($dbresult,$i);
							$ary = mysql_fetch_array($dbresult);
							$account_no = $ary["account_no"];
							$bank_name = $ary["bank_name"];
							$bank_number = $ary["bank_number"];
							$owner_name = $ary["owner_name"];
							
							echo ("				
						<select name='bank_name[]' tabIndex='5' selectedindex='0' size='1'>
							<option value=''
								");
								if($bank_name == '') echo " selected";
								echo ("
							>========</option>
							<option value='부산은행'
								");
								if($bank_name == '부산은행') echo " selected";
								echo ("
							>부산은행</option>
						<option value='경남은행'
							");
								if($bank_name == '경남은행') echo " selected";
								echo ("
							>경남은행</option>
						 <option value='광주은행'
							");
								if($bank_name == '광주은행') echo " selected";
								echo ("
							>광주은행</option>
						  <option value='국민은행'
							");
								if($bank_name == '국민은행') echo " selected";
								echo ("
							>국민은행</option>
						  <option value='기업은행'
							");
								if($bank_name == '기업은행') echo " selected";
								echo ("
							>기업은행</option>
						  <option value='농 협'
							");
								if($bank_name == '농 협') echo " selected";
								echo ("
							>농 협</option>
						  <option value='대구은행'
							");
								if($bank_name == '대구은행') echo " selected";
								echo ("
							>대구은행</option>
						  <option value='도 이 치'
							");
								if($bank_name == '도 이 치') echo " selected";
								echo ("
							>도 이 치</option>
						  <option value='산업은행'
							");
								if($bank_name == '산업은행') echo " selected";
								echo ("
							>산업은행</option>
						  <option value='새마을금고'
							");
								if($bank_name == '새마을금고') echo " selected";
                                                                echo ("
                                                        >새마을금고</option>
                                                  <option value='상와은행'
                                                        ");
								if($bank_name == '상와은행') echo " selected";
								echo ("
							>상와은행</option>
						  <option value='서울은행'
							");
								if($bank_name == '서울은행') echo " selected";
								echo ("
							>서울은행</option>
						  <option value='수 협'
							");
								if($bank_name == '수 협') echo " selected";
								echo ("
							>수 협</option>
						  <option value='시티은행'
							");
								if($bank_name == '시티은행') echo " selected";
								echo ("
							>시티은행</option>
						  <option value='신한은행'
							");
								if($bank_name == '신한은행') echo " selected";
								echo ("
							>신한은행</option>
						  <option value='암로은행'
							");
								if($bank_name == '암로은행') echo " selected";
								echo ("
							>암로은행</option>
						  <option value='외환은행'
							");
								if($bank_name == '외환은행') echo " selected";
								echo ("
							>외환은행</option>
						  <option value='우리은행'
							");
								if($bank_name == '우리은행') echo " selected";
								echo ("
							>우리은행</option>
						  <option value='우 체 국'
							");
								if($bank_name == '우 체 국') echo " selected";
								echo ("
							>우 체 국</option>
						  <option value='전북은행'
							");
								if($bank_name == '전북은행') echo " selected";
								echo ("
							>전북은행</option>
						  <option value='제일은행'
							");
								if($bank_name == '제일은행') echo " selected";
								echo ("
							>제일은행</option>
						  <option value='제주은행'
							");
								if($bank_name == '제주은행') echo " selected";
								echo ("
							>제주은행</option>
						  <option value='조흥은행'
							");
								if($bank_name == '조흥은행') echo " selected";
								echo ("
							>조흥은행</option>
						  <option value='하나은행'
							");
								if($bank_name == '하나은행') echo " selected";
								echo ("
							>하나은행</option>
						  <option value='한미은행'
							");
								if($bank_name == '한미은행') echo " selected";
								echo ("
							>한미은행</option>
						  <option value='홍콩은행'
							");
								if($bank_name == '홍콩은행') echo " selected";
								echo ("
							>홍콩은행</option>
							</select><span>&nbsp; 
							<input name='bank_number[]' size='17' class='input_03' value='$bank_number'>&nbsp; 
							<input name='owner_name[]' size='14' class='input_03' value='$owner_name'><br>
								");
						}
						?>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></td>
			</tr>


<?if($_SESSION["UnameSess"] == "lets080" || $_SESSION["Mall_Admin_ID"] == "lets080"){?>		
<tr>
			  <td width="100%" bgcolor="#FFFFFF">
			  
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				 <tr>
					<td width="22%">LG U+ 상점아이디</td>
					<td width="78%">
						<input type=text name="xpay_id" value="<?=$xpay_id?>">
					</td>
				 </tr>
				 <tr>
					<td>LG U+ MertKey</td>
					<td>
						<input type=text name="xpay_key" value="<?=$xpay_key?>" size=40>
					</td>
				 </tr>
			  </table>
			  </td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></td>
			</tr>
<?}?>



			<!-- <tr>
			<td width="100%" bgcolor="#FFFFFF" height="2" valign="top">
				 <table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="25%">공동구매 이용여부</td>
						<td width="25%">
							<input name="if_union" type="radio" value="t"<?if($if_union=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_union" type="radio" value="f"<?if($if_union=='f') echo " checked"?>>No</td>
						<td width="25%">공지사항 이용여부</td>
						<td width="25%">
							<input name="if_notice" type="radio" value="t"<?if($if_notice=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_notice" type="radio" value="f"<?if($if_notice=='f') echo " checked"?>>No</td>
					</tr>
					<tr>
						<td width="25%">선물추천 이용여부</td>
						<td width="25%">
							<input name="if_chuchon" type="radio" value="t"<?if($if_chuchon=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_chuchon" type="radio" value="f"<?if($if_chuchon=='f') echo " checked"?>>No</td>
						<td width="25%">쿠폰발행 이용여부</td>
						<td width="25%">
							<input name="if_coupon" type="radio" value="t"<?if($if_coupon=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_coupon" type="radio" value="f"<?if($if_coupon=='f') echo " checked"?>>No</td>
					</tr>
					<tr>
						<td width="25%">영수증출력 이용여부</td>
						<td width="25%">
							<input name="if_receipt" type="radio" value="t"<?if($if_receipt=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_receipt" type="radio" value="f"<?if($if_receipt=='f') echo " checked"?>>No</td>
						<td width="25%">이벤트 이용여부</td>
						<td width="25%">
							<input name="if_event" type="radio" value="t"<?if($if_event=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_event" type="radio" value="f"<?if($if_event=='f') echo " checked"?>>No</td>
					</tr>
					<tr>
						<td width="25%">상품후기기능 이용여부</td>
						<td width="25%">
							<input name="user_words" type="radio" value="t"<?if($user_words=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="user_words" type="radio" value="f"<?if($user_words=='f') echo " checked"?>>No</td>
						<td width="25%">커뮤니티 이용여부</td>
						<td width="25%">
							<input name="if_community" type="radio" value="t"<?if($if_community=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_community" type="radio" value="f"<?if($if_community=='f') echo " checked"?>>No</td>
					</tr>
					<tr>
						<td width="25%">설문조사기능 이용여부</td>
						<td width="25%">
							<input name="if_poll" type="radio" value="t"<?if($if_poll=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_poll" type="radio" value="f"<?if($if_poll =='f') echo " checked"?>>No</td>
						<td width="25%">퀴즈 이용여부</td>
						<td width="25%">
							<input name="if_quiz" type="radio" value="t"<?if($if_quiz=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_quiz" type="radio" value="f"<?if($if_quiz=='f') echo " checked"?>>No</td>
					</tr>
					</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1"></td>
			</tr> -->

			<!-- <tr>
		    <td width="100%" bgcolor="#FFFFFF">
		  
		  	<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			 
			 <tr>
				<td vAlign="top" width="25%">페이지하단 카피라이트</td>
				<td width="75%">
					<object id="copyright_txt" codebase="<?=$edit_url?>GsWebEdit.cab#version=1,0,0,62" height="350" width="100%" classid="CLSID:8B844CB2-4E1B-4707-B3D5-31C00D717398">
						<param name="AhrefAutoTargetUse" value="true">
						<param name="AhrefAutoTarget" value="__blank">
						<param name="CurMoveFirst" value="true">
						<param name="Metacontent" value="<?=$url?>">
						<param name="CharSet" value="ks_c_5601-1987">
						<param name="BorderColor" value="#FFFFFF">
						<param name="InsertHtml" value="<?=$copyright?>">
						<param name="FontSize" VALUE="">
						<param name="LimitAttachFileSize" value="0">
						<param name="LimitAttachFileTotalSize" value="0">
						<param name="LimitAttachFileCount" value="0">
						<param name="CSSUrl" value="<?=$style_url?>style.css">
						<param name="TableBorder" value="1">
						<param name="TableCellSpacing" value="2">
						<param name="TableCellPadding" value="1">
						<param name="ShowProgressBar" value="true">
						<param name="ToolBarStyleUrl" value="<?=$style_url?>style.txt">
						<param name="UseBR" value="true">
						<param name="UseStyle" value="true">
						<param name="ToolBarImagePath" value="">
						<param name="ToolBarHotImagePath" value="">
						<param name="ToolBarDisableImagePath" value="">
						<param name="TabPosition" value="bottom">
					</object>
					<textarea style='display:none' name="copyright"></textarea>
				</td>
			 </tr>
		  </table>
		  </td>
		</tr> -->

		<tr>
		<td width="100%" bgcolor="#6084D5" height="1"></td>
		</tr>

		<tr>
		  <td width="100%" bgcolor="#FFFFFF" height="10">
			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			 <tr>
				<td width="100%"></td>
			 </tr>
			 <tr>
				<td align="center" height="35">
					<input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="완료">&nbsp; <input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="재입력">
				</td>
			 </tr>
		  </table>
		  </td>
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
<script>
//exp(document.f);
</script>
<?
if( $dbresult ){
	mysql_free_result( $dbresult );
}
mysql_close($dbconn);
?>
