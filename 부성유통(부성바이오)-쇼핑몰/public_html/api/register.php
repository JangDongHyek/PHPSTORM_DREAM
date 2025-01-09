<?
include "../connect.php";
$flag = "add";
$Mall_Admin_ID = "lets080";

$first_no = urldecode($firstno);
$item_code = urldecode($item_code);
$price = urldecode($price);
$item_explain = urldecode($item_explain);
$jaego = urldecode($jaego);
$item_company = urldecode($item_company);
$item_bestbefore = urldecode($item_bestbefore);
$bonus = urldecode($bonus);
$z_price = urldecode($z_price);
$short_explain = urldecode($short_explain);
$item_name = urldecode($item_name);
$item_origin = urldecode($item_origin);
$if_hide = urldecode($if_hide);
$fee = urldecode($fee);
$icon_no = urldecode($icon_no);
$if_cash = urldecode($if_cash);
$jaego_use = urldecode($jaego_use);
$thumbnail = urldecode($thumbnail);
$category_num = urldecode($category_num);
$provider_id = urldecode($provider_id);

//카테고리 현재 위치
$cur_category_name = category_navi($category_num);

$SQL = "select * from $MartDesignTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if (mysql_num_rows($dbresult) > 0) {
	mysql_data_seek($dbresult, 0);
	$ary = mysql_fetch_array($dbresult);
	$item_zoom_module = $ary["item_zoom_module"];
}
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if ($numRows > 0) {
	mysql_data_seek($dbresult, 0);
	$ary = mysql_fetch_array($dbresult);
	$if_gnt_item = $ary["if_gnt_item"];
	$if_customer_price = $ary["if_customer_price"];
}
//포인트 관련
$shop_sql2 = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
$shop_res2 = mysql_query($shop_sql2, $dbconn);
$row2 = mysql_fetch_array($shop_res2);
$bonus_auto_ok = $row2[bonus_auto_ok];
$bonus_auto_percent = $row2[bonus_auto_percent];

//echo $item_explain;
//exit;

$reg_date = date(Y) . "-" . date(m) . "-" . date(d);

//================== 상품을 등록함 =======================================================
if ($flag == "add") {

	if (!file_exists("$Co_img_UP$mart_id")) {
		mkdir("$Co_img_UP$mart_id", 0755);
	}

	if (isset($op1) && $op1 != "") {
		$opt = $op1;
		if (isset($op2) && $op2 != "") {
			$opt = $opt . "=" . $op2;
			if (isset($op3) && $op3 != "") {
				$opt = $opt . "=" . $op3;
			}
		}
	} else
		$opt = "";

	$opt = $op1 . "=" . $op2 . "=" . $op3;

	$SQL = "select max(item_no), count(*) from $ItemTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false)
		echo "쿼리 실행 실패!";
	if (mysql_result($dbresult, 0, 1) > 0)
		$maxItem_no = mysql_result($dbresult, 0, 0);
	else
		$maxItem_no = 0;
	$maxItem_no_1 = $maxItem_no + 1;

	############################# 이미지 용량 및 사이즈 제한 ##############################
	if ($thumbnail == 'n') {
		$img_sml = $zimg_sml;
		$img_sml_name = $zimg_sml_name;

		$img = $zimg;
		$img_name = $zimg_name;

		$img_big = $zimg_big;
		$img_big_name = $zimg_big_name;

		$img_big2 = $zimg_big2;
		$img_big2_name = $zimg_big2_name;

		$img_big3 = $zimg_big3;
		$img_big3_name = $zimg_big3_name;

		$img_big4 = $zimg_big4;
		$img_big4_name = $zimg_big4_name;

		$img_big5 = $zimg_big5;
		$img_big5_name = $zimg_big5_name;

	} else if ($thumbnail == 'y'){

		$img_big = $zimg_big;
		$img_big_name = $zimg_big_name;

		$img_big2 = $zimg_big2;
		$img_big2_name = $zimg_big2_name;

		$img_big3 = $zimg_big3;
		$img_big3_name = $zimg_big3_name;

		$img_big4 = $zimg_big4;
		$img_big4_name = $zimg_big4_name;

		$img_big5 = $zimg_big5;
		$img_big5_name = $zimg_big5_name;
	}
	if (isset($img_sml_name) && ($img_sml_name != "")) {
		$size_sml = filesize($img_sml);
		$size_width_sml = getimagesize($img_sml);

		if ($size_sml > 5120000) {
			echo("
<script language='javascript'>
alert(\"리스트 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
history.go(-1);
exit;
</script>
");
			exit ;
		}
	}
	if (isset($img_name) && ($img_name != "")) {
		$size = filesize($img);
		$size_width = getimagesize($img);

		if ($size > 5120000) {
			echo("
<script language='javascript'>
alert(\"상세 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
history.go(-1);
exit;
</script>
");
			exit ;
		}
	}
	if (isset($img_big_name) && ($img_big_name != "")) {
		$size_big = filesize($img_big);
		$size_width_big = getimagesize($img_big);

		if ($size_big > 5120000) {
			echo("
<script language='javascript'>
alert(\"1번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
history.go(-1);
exit;
</script>
");
			exit ;
		}
	}
	if (isset($img_big2_name) && ($img_big2_name != "")) {
		$size_big2 = filesize($img_big2);
		$size_width_big2 = getimagesize($img_big2);

		if ($size_big2 > 5120000) {
			echo("
<script language='javascript'>
alert(\"2번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
history.go(-1);
exit;
</script>
");
			exit ;
		}
	}
	if (isset($img_big3_name) && ($img_big3_name != "")) {
		$size_big3 = filesize($img_big3);
		$size_width_big3 = getimagesize($img_big3);

		if ($size_big3 > 5120000) {
			echo("
<script language='javascript'>
alert(\"3번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
history.go(-1);
exit;
</script>
");
			exit ;
		}
	}
	if (isset($img_big4_name) && ($img_big4_name != "")) {
		$size_big4 = filesize($img_big4);
		$size_width_big4 = getimagesize($img_big4);

		if ($size_big4 > 5120000) {
			echo("
<script language='javascript'>
alert(\"4번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
history.go(-1);
exit;
</script>
");
			exit ;
		}
	}
	if (isset($img_big5_name) && ($img_big5_name != "")) {
		$size_big5 = filesize($img_big5);
		$size_width_big5 = getimagesize($img_big5);

		if ($size_big5 > 5120000) {
			echo("
<script language='javascript'>
alert(\"5번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
history.go(-1);
exit;
</script>
");
			exit ;
		}
	}
	#######################################################################################

	//================== 업로드 파일을 불러옴 ================================================
	include "../upload.php";
	$upload = "$Co_img_UP" . "$mart_id/";
	//================== 첨부 파일을 업로드함 ================================================
	$now_time = date("YmdHis");
	##################################img_sml###############################################

	if (isset($img_sml_name) && ($img_sml_name != "")) {
		if (!file_exists("$Co_img_UP$mart_id")) {
			mkdir("$Co_img_UP$mart_id", 0755);
		}

		if ($img_sml_name) {

			$img_sml_name = "s1_" . $now_time . ".jpg";

			$file = FileUploadName("", "$upload", $img_sml, $img_sml_name);
			//파일을 업로드 함

			if (!$file) {
				echo("
<script>
window.alert('파일 업로드에 실패했습니다.');
history.go(-1)
</script>
");
				exit ;
			}
		}
	}
	###########################################################################################

	##################################img###############################################

	if (isset($img_name) && ($img_name != "")) {
		if (!file_exists("$Co_img_UP$mart_id")) {
			mkdir("$Co_img_UP$mart_id", 0755);
		}

		if ($img_name) {

			$img_name = "m1_" . $now_time . ".jpg";

			$file = FileUploadName("", "$upload", $img, $img_name);
			//파일을 업로드 함

			if (!$file) {
				echo("
<script>
window.alert('파일 업로드에 실패했습니다.');
history.go(-1)
</script>
");
				exit ;
			}
		}
	}
	###########################################################################################

	##################################img_big###############################################

	if (isset($img_big_name) && ($img_big_name != "")) {
		if (!file_exists("$Co_img_UP$mart_id")) {
			mkdir("$Co_img_UP$mart_id", 0755);
		}

		if ($img_big_name) {

			$img_big_name = "b1_" . $now_time . ".jpg";

			$file = FileUploadName("", "$upload", $img_big, $img_big_name);
			//파일을 업로드 함

			if (!$file) {
				echo("
<script>
window.alert('파일 업로드에 실패했습니다.');
history.go(-1)
</script>
");
				exit ;
			}
		}
	}
	###########################################################################################
	##################################img_big2###############################################

	if (isset($img_big2_name) && ($img_big2_name != "")) {
		if (!file_exists("$Co_img_UP$mart_id")) {
			mkdir("$Co_img_UP$mart_id", 0755);
		}

		if ($img_big2_name) {

			$img_big2_name = "b2_" . $now_time . ".jpg";

			$file = FileUploadName("", "$upload", $img_big2, $img_big2_name);
			//파일을 업로드 함

			if (!$file) {
				echo("
<script>
window.alert('파일 업로드에 실패했습니다.');
history.go(-1)
</script>
");
				exit ;
			}
		}
	}
	###########################################################################################
	##################################img_big3###############################################

	if (isset($img_big3_name) && ($img_big3_name != "")) {
		if (!file_exists("$Co_img_UP$mart_id")) {
			mkdir("$Co_img_UP$mart_id", 0755);
		}

		if ($img_big3_name) {

			$img_big3_name = "b3_" . $now_time . ".jpg";

			$file = FileUploadName("", "$upload", $img_big3, $img_big3_name);
			//파일을 업로드 함

			if (!$file) {
				echo("
<script>
window.alert('파일 업로드에 실패했습니다.');
history.go(-1)
</script>
");
				exit ;
			}
		}
	}
	###########################################################################################
	##################################img_big4###############################################

	if (isset($img_big4_name) && ($img_big4_name != "")) {
		if (!file_exists("$Co_img_UP$mart_id")) {
			mkdir("$Co_img_UP$mart_id", 0755);
		}

		if ($img_big4_name) {

			$img_big4_name = "b4_" . $now_time . ".jpg";

			$file = FileUploadName("", "$upload", $img_big4, $img_big4_name);
			//파일을 업로드 함

			if (!$file) {
				echo("
<script>
window.alert('파일 업로드에 실패했습니다.');
history.go(-1)
</script>
");
				exit ;
			}
		}
	}
	###########################################################################################
	##################################img_big5###############################################

	if (isset($img_big5_name) && ($img_big5_name != "")) {
		if (!file_exists("$Co_img_UP$mart_id")) {
			mkdir("$Co_img_UP$mart_id", 0755);
		}

		if ($img_big5_name) {

			$img_big5_name = "b5_" . $now_time . ".jpg";

			$file = FileUploadName("", "$upload", $img_big5, $img_big5_name);
			//파일을 업로드 함

			if (!$file) {
				echo("
<script>
window.alert('파일 업로드에 실패했습니다.');
history.go(-1)
</script>
");
				exit ;
			}
		}
	}
	###########################################################################################

	if ($img_sml_name != "") {
		$img_sml_new = "item_sml_" . $maxItem_no_1 . "_" . $img_sml_name;
	}
	if ($img_name != "") {
		$img_new = "item_" . $maxItem_no_1 . "_" . $img_name;
	}

	if ($img_big_name != "") {
		$img_big_new = "item_big_" . $maxItem_no_1 . "_" . $img_big_name;
	}
	if ($img_big2_name != "") {
		$img_big2_new = "item_big2_" . $maxItem_no_1 . "_" . $img_big2_name;
	}
	if ($img_big3_name != "") {
		$img_big3_new = "item_big3_" . $maxItem_no_1 . "_" . $img_big3_name;
	}
	if ($img_big4_name != "") {
		$img_big4_new = "item_big4_" . $maxItem_no_1 . "_" . $img_big4_name;
	}
	if ($img_big5_name != "") {
		$img_big5_new = "item_big5_" . $maxItem_no_1 . "_" . $img_big5_name;
	}

	if ($img_sml_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_sml_name"))
			copy("$Co_img_UP$mart_id/$img_sml_name", "$Co_img_UP$mart_id/$img_sml_new");
		//업로드 파일 저장
	}
	if ($img_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_name"))
			copy("$Co_img_UP$mart_id/$img_name", "$Co_img_UP$mart_id/$img_new");
		//업로드 파일 저장
	}

	if ($img_big_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big_name"))
			copy("$Co_img_UP$mart_id/$img_big_name", "$Co_img_UP$mart_id/$img_big_new");
		//업로드 파일 저장
	}
	if ($img_big2_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big2_name"))
			copy("$Co_img_UP$mart_id/$img_big2_name", "$Co_img_UP$mart_id/$img_big2_new");
		//업로드 파일 저장
	}
	if ($img_big3_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big3_name"))
			copy("$Co_img_UP$mart_id/$img_big3_name", "$Co_img_UP$mart_id/$img_big3_new");
		//업로드 파일 저장
	}
	if ($img_big4_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big4_name"))
			copy("$Co_img_UP$mart_id/$img_big4_name", "$Co_img_UP$mart_id/$img_big4_new");
		//업로드 파일 저장
	}
	if ($img_big5_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big5_name"))
			copy("$Co_img_UP$mart_id/$img_big5_name", "$Co_img_UP$mart_id/$img_big5_new");
		//업로드 파일 저장
	}

	//임시화일 삭제
	if ($img_sml_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_sml_name"))
			unlink("$Co_img_UP$mart_id/$img_sml_name");
	}
	if ($img_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_name"))
			unlink("$Co_img_UP$mart_id/$img_name");
	}

	if ($img_big_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big_name"))
			unlink("$Co_img_UP$mart_id/$img_big_name");
	}
	if ($img_big2_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big2_name"))
			unlink("$Co_img_UP$mart_id/$img_big2_name");
	}
	if ($img_big3_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big3_name"))
			unlink("$Co_img_UP$mart_id/$img_big3_name");
	}
	if ($img_big4_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big4_name"))
			unlink("$Co_img_UP$mart_id/$img_big4_name");
	}
	if ($img_big5_name != "") {
		if (file_exists("$Co_img_UP$mart_id/$img_big5_name"))
			unlink("$Co_img_UP$mart_id/$img_big5_name");
	}

	if ($thumbnail == 'y') {//썸네일 사용시

		################################ 이미지 매직 ##################################33
		$rg_file1_path = "$Co_img_UP$mart_id/$img_big_new";
		$rg_file2_path = "$Co_img_UP$mart_id/$img_big2_new";
		$rg_file3_path = "$Co_img_UP$mart_id/$img_big3_new";
		$rg_file4_path = "$Co_img_UP$mart_id/$img_big4_new";
		$rg_file5_path = "$Co_img_UP$mart_id/$img_big5_new";

		/*
		 $FileName : 파일명
		 $ori_path : 원본파일경로
		 $maxItem_no_1 : 가장최근글번호 + 1한값
		 $mart_id : 계정 아이디
		 맨마지막숫자 : 유일성을 두기위해

		 썸네일 경로중 home2를 최신서버로 옮길시 home로 변경
		 */
		function MakeThum1($FileName, $ori_path, $maxItem_no_1, $mart_id, $unique) {
			$ThumFileName130 = $maxItem_no_1 . "_" . $unique . "_" . $FileName . "130.jpg";
			$ThumFileName300 = $maxItem_no_1 . "_" . $unique . "_" . $FileName . "300.jpg";
			$ThumFileName600 = $maxItem_no_1 . "_" . $unique . "_" . $FileName . "600.jpg";

			$FileName = $ori_path;
			$ThumFileName130 = "/home/" . $mart_id . "/public_html/co_img/" . $mart_id . "/" . $ThumFileName130;
			$ThumFileName300 = "/home/" . $mart_id . "/public_html/co_img/" . $mart_id . "/" . $ThumFileName300;
			$ThumFileName600 = "/home/" . $mart_id . "/public_html/co_img/" . $mart_id . "/" . $ThumFileName600;

			exec("convert -geometry 130x $FileName $ThumFileName130");
			exec("convert -geometry 300x $FileName $ThumFileName300");
			exec("convert -geometry 600x $FileName $ThumFileName600");

			if (file_exists("$ori_path")) {
				unlink("$ori_path");
			}

		}

		function MakeThum2($FileName, $ori_path, $maxItem_no_1, $mart_id, $unique) {
			$ThumFileName600 = $maxItem_no_1 . "_" . $unique . "_" . $FileName . "600.jpg";

			$FileName = $ori_path;
			$ThumFileName600 = "/home/" . $mart_id . "/public_html/co_img/" . $mart_id . "/" . $ThumFileName600;

			exec("convert -geometry 600x $FileName $ThumFileName600");

			if (file_exists("$ori_path")) {
				unlink("$ori_path");
			}

		}

		################################ 이미지 매직 ##################################33

		##############썸네일 img_big있을때##########
		if ($img_big_new) {
			MakeThum1($img_big_name, $rg_file1_path, $maxItem_no_1, $mart_id, 1);
			$img_sml_new = $maxItem_no_1 . "_1_" . $img_big_name . "130.jpg";
			$img_new = $maxItem_no_1 . "_1_" . $img_big_name . "300.jpg";
			$img_big_new_th = $maxItem_no_1 . "_1_" . $img_big_name . "600.jpg";
		}
		############## 썸네일 BIG2 #################
		if ($img_big2_new) {
			MakeThum2($img_big2_name, $rg_file2_path, $maxItem_no_1, $mart_id, 2);
			$img_big2_new_th = $maxItem_no_1 . "_2_" . $img_big2_name . "600.jpg";
		}
		############## 썸네일 BIG3 #################
		if ($img_big3_new) {
			MakeThum2($img_big3_name, $rg_file3_path, $maxItem_no_1, $mart_id, 3);
			$img_big3_new_th = $maxItem_no_1 . "_3_" . $img_big3_name . "600.jpg";
		}
		############## 썸네일 BIG4 #################
		if ($img_big4_new) {
			MakeThum2($img_big4_name, $rg_file4_path, $maxItem_no_1, $mart_id, 4);
			$img_big4_new_th = $maxItem_no_1 . "_4_" . $img_big4_name . "600.jpg";
		}
		############## 썸네일 BIG5 #################
		if ($img_big5_new) {
			MakeThum2($img_big5_name, $rg_file5_path, $maxItem_no_1, $mart_id, 5);
			$img_big5_new_th = $maxItem_no_1 . "_5_" . $img_big5_name . "600.jpg";
		}
	} else {
		$img_big_new_th = $img_big_new;
		$img_big2_new_th = $img_big2_new;
		$img_big3_new_th = $img_big3_new;
		$img_big4_new_th = $img_big4_new;
		$img_big5_new_th = $img_big5_new;
	}

	$jaego = str_replace(",", "", $jaego);
	$price = str_replace(",", "", $price);
	$z_price = str_replace(",", "", $z_price);
	$member_price = str_replace(",", "", $member_price);
	$short_explain = str_replace("\n", "
<br>
", $short_explain);
	$item_order = "1";
	//상품 출력 순서

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, thirdno,category_num, item_name, price, z_price, g_margin, member_price, bonus, use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, if_hide, img_high, if_cash, fee, thumbnail,opt2,opt3,opt4,if_opt_jaego,if_opt_jaego2,if_opt_jaego3,if_opt_jaego4,item_origin,item_bestbefore) values ('$mart_id', '$first_no', '$second_no', '$thirdno', '$category_num', '$item_name', '$price', '$z_price', '$g_margin', '$member_price', '$bonus', '$use_bonus','$jaego','$img_new','$img_big_new_th','$img_big2_new_th','$img_big3_new_th','$img_big4_new_th','$img_big5_new_th','$op_name1','$doctype','$item_explain', '$short_explain', '$reg_date','$item_company', 0, '$item_code', '$icon_no','$use_opt1','$use_opt23','$item_order','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new', '$if_cash', '$fee', '$thumbnail','$op_name2','$op_name3','$op_name4','$if_opt_jaego','$if_opt_jaego2','$if_opt_jaego3','$if_opt_jaego4','$item_origin','$item_bestbefore')";

	$dbresult = mysql_query($SQL, $dbconn);
	$sql = "select max(item_no) as item_no from $ItemTable";
	$result = mysql_query($sql);
	$rs = mysql_fetch_array($result);
	$item_no = $rs[item_no];
	$opt_name = explode("/", $opt_name);
	$opt_price = explode("/", $opt_price);
	$opt_ea = explode("/", $opt_ea);
	$opt_order = explode("/", $opt_order);
	$opt_code = explode("/", $opt_code);
	for ($i = 0; $i < sizeof($opt_name) - 1; $i++) {
		$sql = "insert into $OptionTable(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name[$i]','$opt_price[$i]','$opt_ea[$i]','$opt_order[$i]','$opt_code[$i]')";
		$result = mysql_query($sql);
	}

	$opt_name2 = explode("/", $opt_name2);
	$opt_price2 = explode("/", $opt_price2);
	$opt_ea2 = explode("/", $opt_ea2);
	$opt_order2 = explode("/", $opt_order2);
	$opt_code2 = explode("/", $opt_code2);
	for ($i = 0; $i < sizeof($opt_name2) - 1; $i++) {
		$sql = "insert into $OptionTable2(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name2[$i]','$opt_price2[$i]','$opt_ea2[$i]','$opt_order2[$i]','$opt_code2[$i]')";
		$result = mysql_query($sql);
	}

	$opt_name3 = explode("/", $opt_name3);
	$opt_price3 = explode("/", $opt_price3);
	$opt_ea3 = explode("/", $opt_ea3);
	$opt_order3 = explode("/", $opt_order3);
	for ($i = 0; $i < sizeof($opt_name3) - 1; $i++) {
		$sql = "insert into $OptionTable3(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name3[$i]','$opt_price3[$i]','$opt_ea3[$i]','$opt_order3[$i]','$opt_code3[$i]')";
		$result = mysql_query($sql);
	}

	$opt_name4 = explode("/", $opt_name4);
	$opt_price4 = explode("/", $opt_price4);
	$opt_ea4 = explode("/", $opt_ea4);
	$opt_order4 = explode("/", $opt_order4);
	$opt_code4 = explode("/", $opt_code4);
	for ($i = 0; $i < sizeof($opt_name4) - 1; $i++) {
		$sql = "insert into $OptionTable4(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name4[$i]','$opt_price4[$i]','$opt_ea4[$i]','$opt_order4[$i]','$opt_code4[$i]')";
		$result = mysql_query($sql);
	}
}
//========================================================================================

mysql_close($dbconn);
?>
