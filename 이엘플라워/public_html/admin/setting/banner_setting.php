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
                    <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">배너관리</span> &gt; <span class="text_gray2_c">쇼핑몰 배너관리</span>  </div></td>
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
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>배너관리</b></td>
			</table>

			<!--내용 START~~--><br>

<form name='f' method='post' onsubmit="return frm_val(this)" action='banner_regist.php' enctype="multipart/form-data">
<input type="hidden" name="flag" value="update" >
<input type='hidden' name='shop_logo' value='<?=$shop_logo?>'>

		<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>

<script type="text/javascript">
<!--
<?	if($user_words=='f'){ ?>
			user_words_perm[0].disable = true;
			user_words_perm[1].disable = true;
<?	 }	?>
//-->
</script>
			
			<!-- 메인 광고 업로드 시작 -->

			<tr>
				<td>
					<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
						<?
							for($i=1;$i<6;$i++){
						?>
						<tr>
							<td>메인 배너광고<?=$i?></td>
							<td>
								<input type="file" name="slideImg<?=$i?>" value=""> <span style="color:red; font-weight:600;">2000 X 550로 올려주세요</span>
								<br>
								<? if($ary[slideImg.$i]){?>
								<img src="../../up/<?=$mart_id?>/<?=$ary[slideImg.$i]?>" width="100">
								<input type="checkbox" name="slideImg<?=$i?>_del" value="y">삭제
								<? }?>
								<input type="hidden" name="old_slideImg<?=$i?>" value="<?=$ary[slideImg.$i]?>">
							</td>
						</tr>
						<tr>
							<td>메인 배너광고 링크주소<?=$i?></td>
							<td>
								<input type="text" name="slideLink<?=$i?>" value="<?=$ary[slideLink.$i]?>" class="input_03" size="100">
							</td>
						</tr>
						<? }?>
					</table>
				</td>
			</tr>
			<!-- 메인 광고 업로드 끝 -->
			<tr>
				<td height="20"></td>
			</tr>
			<!-- 모바일 광고 업로드 시작 -->
			<tr>
				<td>
					<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
						<?
							for($i=1;$i<6;$i++){
						?>
						<tr>
							<td>모바일 배너광고<?=$i?></td>
							<td>
								<input type="file" name="mobileslideImg<?=$i?>" value=""> <span style="color:red; font-weight:600;">1000 X 510로 올려주세요</span>
								<br>
								<? if($ary[mobileslideImg.$i]){?>
								<img src="../../up/<?=$mart_id?>/<?=$ary[mobileslideImg.$i]?>" width="100">
								<input type="checkbox" name="mobileslideImg<?=$i?>_del" value="y">삭제
								<? }?>
								<input type="hidden" name="old_mobileslideImg<?=$i?>" value="<?=$ary[mobileslideImg.$i]?>">
							</td>
						</tr>
						<tr>
							<td>모바일 배너광고 링크주소<?=$i?></td>
							<td>
								<input type="text" name="mobileslideLink<?=$i?>" value="<?=$ary[mobileslideLink.$i]?>" class="input_03" size="100">
							</td>
						</tr>
						<? }?>
					</table>
				</td>
			</tr>
			<!-- 모바일 광고 업로드 끝 -->
			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></td>
			</tr>

			





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
