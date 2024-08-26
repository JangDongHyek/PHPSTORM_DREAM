<?
//========================== 세션 시작 =========================================
session_start();
global $HTTP_COOKIE_VARS;

// 회원일때
$Mall_Admin_ID = $_SESSION["Mall_Admin_ID"]; //관리자아이디
$UnameSess = $_SESSION["UnameSess"]; //회원아이디
$MemberLevel = $_SESSION["MemberLevel"];
$MemberName = $_SESSION["MemberName"];
$MemberEmail = $_SESSION["MemberEmail"];
$mart_id = $_SESSION["mart_id"];

// 비회원일때
$NonMemberName = $_SESSION["NonMemberName"];
$NonMemberPassport1 = $_SESSION["NonMemberPassport1"];
$NonMemberPassport2 = $_SESSION["NonMemberPassport2"];
//========================== URL 처리 ==========================================
$url=$REQUEST_URI;
//$url=urlencode($url);

$url = str_replace( "?", "|", $url );
$url = str_replace( "&", "!", $url );

//========================== DB 접속 정보 ======================================
$HostName = "localhost";
$DbName = "yensan";
$Admin = "yensan";
$AdminPass = "fpcm080";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "데이타베이스 연결 실패!";
}
//========================== 마트아이디 정보 ===================================
$mart_id = "yensan";
//========================== 기타 정보 =========================================
switch( $MemberLevel ){
	case "1" : 
		$Level = "전체관리자";//member 테이블
		break;
	case "2" :
		$Level = "쇼핑몰관리자";//member 테이블
		break;
	case "3" : 
		$Level = "입점몰";//member 테이블
		break;
	case "4" :
		$Level = "회원사";//member 테이블
		break;

	case "10" :
		$Level = "일반회원";//mart_member_new 테이블
		break;
}

$admin_title = "관리자";
$root_dir = "/home/yensan/public_html"; //서버 절대 경로
$home_dir = "http://renemall.co.kr"; //서버 절대 경로

//========================== 상품이미지 정보 ===================================
$list_product_img_width = "150";
$list_product_img_height = "150";
$view_product_img_width = "300";
$view_product_img_height = "300";
$big_product_img_width = "500";
$big_product_img_height = "500";

//========================== 테이블 정보 =======================================
$Add_Freight_Name = "add_freight_name";
$ArticleTable = "article";
$BannerTable = "banner";
$BankTable = "bank";
$BonusTable = "bonus";
$CategoryTable = "category";
$CouponTable = "coupon";
$EstimateTable = "estimate";
$EventTable = "event";
$ItemTable = "item";
$Order_ProTable = "order_pro";
$Order_BuyTable = "order_buy";
$Order_BuyTable_Temp = "order_buy_temp";
$MartDesignTable = "martdesign";
$MyDesignTable = "mydesign";
$MartInfoTable = "martinfo";
$Mart_Member_NewTable = "mart_member_new";
$MartMngInfoTable = "martmnginfo";
$MartIntroTable = "martintro";
$MartBgColorTable = "martbgcolor";
$MemberTable = "member";
$PartnerTable = "partner";
$Member_WelcomeTable = "member_welcome";
$NoticeTable = "notice";
$Notice_GntTable = "notice_gnt";
$PollTable = "poll";
$PostCodeTable = "postcode";
$ReceiptTable = "receipt"; 
$MenuTable = "menu";
$MetaTable = "meta"; 
$Mart_CounterTable = "mart_counter";
$TicketTable = "ticket";
$TicketListTable = "ticket_list";
$Soho_CounterTable = "soho_counter";
$Blue_CounterTable = "blue_counter";
$CustomerTable = "cust";
$CustomerTempTable = "cust_temp";

$User_GuideTable = "user_guide";
$Union_ListTable = "union_list";
$Union_QnaTable = "union_qna";
$Union_Order_BuyTable = "union_order_buy";

$New_ItemTable = "new_item";
$Fav_ItemTable = "fav_item";
$Rec_ItemTable = "rec_item";
$Best_ItemTable = "best_item";
$Spe_ItemTable = "spe_item";
$Gift_ItemTable = "gift_item";

$Partner_ConfTable = "partner_conf";
$Partner_BannerTable = "partner_banner";
$Mart_PartnerTable = "mart_partner";
$Partner_PaidTable = "partner_paid";
$Partner_BoardTable = "partner_board";

$Mem_GroupTable = "mem_group";
$Group_MemberTable = "group_member";
$Group_BoardTable = "group_board";
$Group_NoticeTable = "group_notice";
$Group_Board_ConfigTable = "group_board_config";

$New_BoardConfigTable = "new_boardconfig";
$New_BoardTable = "new_board";
$EventboardTable = "event_board";
//$Limit_ItemTable = "limit_item";

$Union_ItemTable = "union_item";
$Union_OrderTable = "union_order";

$Pre_SelectTable = "pre_select";

$CatalogTable = "catalog";
$Catalog_ConfTable = "catalog_conf";

$Design2Table = "design2";
$Design2_Main2Table = "design2_main2";

$Design2_Temp2Table = "design2_temp2";
$Design2_Temp3Table = "design2_temp3";
$Design2_Temp4Table = "design2_temp4";
$Design2_Temp5Table = "design2_temp5";
$Design2_BottomTable = "design2_bottom";
$Title_ImageTable = "title_image";


$QuizTable = "quiz";
$Quiz_ApplyTable = "quiz_apply";

$Master_TipTable = "master_tip";
$Money_CheckTable = "money_check";
$Receipt_RequestTable = "receipt_request";

$ContentTable = "content";

$Domain_forwardTable = "domain_forward";

$CustomizeTable = "customize";

$Item_registTable = "item_regist";
$Join_Form_SetTable = "join_form_set";

$Ero_PartnerTable = "ero_partner";

$GiveNTakeTable = "giventake";
$Z_PriceTable = "z_price";
$Cart_ExplainTable = "cart_explain";
$Gnt_CategoryTable = "gnt_category";
$Gnt_Category_NameTable = "gnt_category_name";
$Gnt_Category_UseTable = "gnt_category_use";
$Gnt_ItemTable = "gnt_item";
$Gnt_MemoTable = "gnt_memo";

$Blue_PartnerTable = "blue_partner";
$Blue_Partner_BannerTable = "blue_partner_banner";
$Blue_Partner_PaidTable = "blue_partner_paid";

$Email_ResTable = "email_res";

$Car_BoardTable= "car_board";

//SMS $Sms_ConfigTable= "sms_config";

$Member_GroupTable = "member_group";

$Fran_ConfTable = "fran_conf";
$Fran_PaidTable = "fran_paid";

$Co_img_UP = "$root_dir/co_img/";	//이미지 업로드 절대경로
$Co_img_DOWN = "/co_img/";			//이미지 업로드 디렉토리

$UploadRoot = "$root_dir/up/";		//업로드 서버 절대경로
$DownloadRoot = "/up/";				//다운로드 웹 절대경로
$DownloadDir = "$home_dir/up/";		//다운도르 디렉토리

$BoardBC = 1;
$PdsBC = 2;
$GrpBoardBC = 3;
$GrpPdsBC = 4;
$BookBoardBC = 5;
$OnStudyBC = 6;

$ImapServer = "localhost";
$ImapPort = "143";

$PageCount = 3;
$NoticePageCount = 10;

$MenuNotice = "notice";
$MenuBoard = "board";
$MenuPds = "pds";
$MenuMemo = "memo";
$MenuCalendar = "cal";
$MenuMail = "mail";
$MenuAdmin = "admin";
$MenuBook = "book";
$MenuOnStudy = "onstudy";
$MenuMyinfo = "myinfo";
$MenuSigan = "sigan";
$MenuGroup = "group";
$MenuCar = "car";
$MenuMaster = "master";

// 포인트 종류
$point_arr = array('a'=>'적립', 'p'=>'적립', 'u'=>'지불', 'c'=>'환불', 'd'=>'삭감', 'j'=>'회원가입', 'g'=>'상품권');

// 값이 같으면 checked 리턴
function choosed_form($form_value, $data_value, $form_type="radio")
{
	$choosed_str;

	switch ($form_type)
	{
		case "radio":
		case "checkbox":	$choosed_str = "checked"; break;
		case "select": $choosed_str = "selected"; break;
		default: $choosed_str=""; break;
	}

	if($form_value == $data_value)
		return $choosed_str;
}

// 카테고리 num 으로 카테고리 네비게이션 만듬
function category_navi($category_num){ 
	$query = "select * from category where category_num = $category_num";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$category_navi = $row[category_name];

	if($row["category_degree"] != "0"){
		$query1 = "select * from category where category_num = '$row[prevno]'";
		$result1 = mysql_query($query1);
		$row1 = mysql_fetch_array($result1);
		$category_navi = $row1[category_name]." > ".$category_navi;

		if($row1["category_degree"] != "0"){
			$query2 = "select * from category where category_num = '$row1[prevno]'";
			$result2 = mysql_query($query2);
			$row2 = mysql_fetch_array($result2);
			$category_navi = $row2[category_name]." > ".$category_navi;
		}
	}
	return "[".$category_navi."]";
}

function Make_select_category($mart_id_tmp, $tmp_category_num = 0){ //카테고리 목록
	global $dbconn;

	$SQL = "select category_num,category_name from category where prevno=0 and mart_id='$mart_id_tmp' order by cat_order desc";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);

	for ($i=0; $i<$numRows; $i++) {
		$category_num = mysql_result($dbresult,$i,0);
		$category_name = mysql_result($dbresult,$i,1);
		
		$SQL2 = "select category_num,category_name from category where prevno='$category_num' and mart_id='$mart_id_tmp' order by cat_order desc";
		$dbresult2 = mysql_query($SQL2, $dbconn);
		$numRows2 = mysql_num_rows($dbresult2);
		
		$select_category .= "<option value='' style='background=#e7e7e7'>---------------</option>
												<option  style='background=#66CCFF' value='$category_num'";
		$select_category .= ">▷$category_name</option>
												<option value='' style='background=#e7e7e7'>---------------</option>";
					
		for($j=0;$j<$numRows2;$j++){
			$category_num1 = mysql_result($dbresult2,$j,0);
			$category_name1 = mysql_result($dbresult2,$j,1);
					
			$select_category .= "<option  style='background=#FF9966' value='$category_num1'";
			$select_category .= ">&nbsp;&nbsp;&nbsp;&nbsp- $category_name1</option>";

			$SQL3 = "select category_num,category_name from category where prevno='$category_num1' and mart_id='$mart_id_tmp' order by cat_order desc";
			$dbresult3 = mysql_query($SQL3, $dbconn);
			$numRows3 = mysql_num_rows($dbresult3);

			for($k=0;$k<$numRows3;$k++){
				$category_num3 = mysql_result($dbresult3,$k,0);
				$category_name3 = mysql_result($dbresult3,$k,1);

				$select_category .= "<option value='$category_num3' ";
				if($tmp_category_num == $category_num3){
					$select_category .= " selected";
				}
				$select_category .= "> &nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp- $category_name3</option>";
			}
		}
	}

	return $select_category;
}

// 경고 메세지 띄우고 해당 페이지로 이동하는 함수
function act_href($url='',$msg='',$target='',$action='',$charset='euc-kr'){
/*		if(func_num_args()>0)
		$a_list = func_get_args();
	} else {
		return false;
	}
*/
	$script="";

	if($msg) {
		$script.="alert('$msg');";
	}
	if($url && !$action) {
		if($target)
			$script.="\n$target.location.replace('$url');\n";
		else
			$script.="\nlocation.replace('$url');\n";
	}
	switch($action) {
		case 'back' : 
				$script.="\nhistory.go(-1);\n";
				break;
		case 'close' : 
				$script.="\nself.close();\n";
				break;
		case '';
				break;
	}
	
	echo "
	<HTML>
	<HEAD>
	<META HTTP-EQUIV=Content-Type CONTENT=text/html; charset=$charset>
	<SCRIPT LANGUAGE=JavaScript>
	<!--
	$script
	//-->
	</SCRIPT>
	</html>
	";
exit;
}

//=============== 정해진 자리보다 작으면...앞에 0을 붙여 반환한다..
function addzero($str, $length){ 
    if(strlen($str) == $length) 
        return $str; 

    for($i = strlen($str) ; $i < $length; $i++) { 
		$zero_str = "0".$zero_str;
    }
	$str = $zero_str.$str;
    return $str; 
}

// 게시판 목록보기, 읽기, 쓰기, 파일받기 권한 체크
// 게시판명, 사용자 레벨, 체크할 사항
// 권한 있으면 true, 없으면 false 리턴
function CheckPermBoard($boardNameTemp, $permSessTemp, $checkFlag) {
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable;
	global $Level_A, $Level_B, $Level_C, $Level_D, $Level_E;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "데이타베이스 연결 실패!";
		return false;
	}
	$SQL = "select * from $ConfigTable where boardName='$boardNameTemp'";
	$dbresult = mysql_query($SQL, $dbconnTemp);
	mysql_data_seek($dbresult, 0);
	$ary = mysql_fetch_array($dbresult);
	$limit_a = $ary["limit_a"];
	$limit_b = $ary["limit_b"];
	$limit_c = $ary["limit_c"];
	$limit_d = $ary["limit_d"];

	if ($permSessTemp == $Level_A) {
		if (strstr($limit_a, $checkFlag) == false) {
			mysql_close($dbconnTemp);
			return false;
		}
	}
	if ($permSessTemp == $Level_B) {
		if (strstr($limit_b, $checkFlag) == false) {
			mysql_close($dbconnTemp);
			return false;
		}
	}
	if ($permSessTemp == $Level_C) {
		if (strstr($limit_c, $checkFlag) == false) {
			mysql_close($dbconnTemp);
			return false;
		}
	}
	if ($permSessTemp == $Level_D) {
		if (strstr($limit_d, $checkFlag) == false) {
			mysql_close($dbconnTemp);
			return false;
		}
	}
	mysql_close($dbconnTemp);
	return true;
}
// $permTemp: 사용자 권한 스트링 (guest, admin.....)
// $permTemp 에 맞는 레벨의 알파벳 리턴

function WhichPerm($permTemp) {
	global $Level_A, $Level_B, $Level_C, $Level_D, $Level_E;
	
	if ($permTemp == $Level_A) return "A";
	elseif ($permTemp == $Level_B) return "B";
	elseif ($permTemp == $Level_C) return "C";
	elseif ($permTemp == $Level_D) return "D";
	elseif ($permTemp == $Level_E) return "E";
}

// $menuNameTemp: 메뉴명, $permSessTemp: 사용자 권한 스트링
// 해당 메뉴의 사용자 권한 체크, 권한이 있으면 true 리턴 없으면 false

function CheckPermMenu($menuNameTemp, $permSessTemp) {
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MenuTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "데이타베이스 연결 실패!";
		return false;
	}
	$SQL = "select * from $MenuTable where menuName='$menuNameTemp'";
	$dbresult = mysql_query($SQL, $dbconnTemp);
	$menuPerm = mysql_result($dbresult, 0, "menuperm");
	$userPerm = WhichPerm($permSessTemp);
	mysql_close($dbconnTemp);
	if ($userPerm == "E") return true;		//관리자이면 기냥 통과
	if (is_integer(strpos($menuPerm, $userPerm)) == false) return false;
	else return true;
}

function Get_Limit_Price($item_no, $mart_id){
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MenuTable, $Union_ItemTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "데이타베이스 연결 실패!";
		return false;
	}
	$SQL = "select * from $Union_ItemTable where item_no='$item_no' and mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconnTemp);
	if(mysql_num_rows($dbresult)>0){
		$z_price = mysql_result($dbresult, 0, "z_price");
		return $z_price;
	}
	else return "상품삭제됨 ";
}

function Get_Slide_Price($item_no, $mart_id){
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MenuTable, $Union_ItemTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "데이타베이스 연결 실패!";
		return false;
	}
	$SQL = "select * from $Union_ItemTable where item_no='$item_no' and mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconnTemp);
	if(mysql_num_rows($dbresult)>0){
		$number1_from = mysql_result($dbresult, 0, "number1_from");
		$number1_to = mysql_result($dbresult, 0, "number1_to");
		$number2_from = mysql_result($dbresult, 0, "number2_from");
		$number2_to = mysql_result($dbresult, 0, "number2_to");
		$number3_from = mysql_result($dbresult, 0, "number3_from");
		$price1 = mysql_result($dbresult, 0, "price1");
		$price2 = mysql_result($dbresult, 0, "price2");
		$price3 = mysql_result($dbresult, 0, "price3");
		$current_num = mysql_result($dbresult, 0, "current_num");
		
		if($current_num >= $number1_from && $current_num <= $number1_to){ 
			$current_price = $price1;
		}
		else if($current_num >= $number2_from && $current_num <= $number2_to){ 
			$current_price = $price2;
		}
		else if($current_num >= $number3_from){ 
			$current_price = $price3;
		}
		else {
			$current_price = $price1;
		}
		
		return $current_price;
	}
	else return "상품삭제됨 ";
}


// $PermTemp:권한, $permSessTemp: 사용자 권한 스트링
// 해당 메뉴의 사용자 권한 체크, 권한이 있으면 true 리턴 없으면 false

function CheckPerm($PermTemp, $permSessTemp) {
	$userPerm = WhichPerm($permSessTemp);
	if ($userPerm == "E") return true;		//관리자이면 기냥 통과
	if (is_integer(strpos($PermTemp, $userPerm)) == false) return false;
	else return true;
}

function YoilToHan($yoil) {
	switch ($yoil) {
		case 0: return "일"; break;
		case 1: return "월"; break;
		case 2: return "화"; break;
		case 3: return "수"; break;
		case 4: return "목"; break;
		case 5: return "금"; break;
		case 6: return "토"; break;
	}
}

function ToMoney($inttype) {
	$inttype = trim($inttype);
	$len = strlen($inttype);
	$moneytype="";
	
	$startpo = $len%3;
	for($i=$startpo; $i<=$len; $i+=3){
		if(($i<3) && ($i>0)){
			$moneytype .= substr($inttype, 0, $i);
			//echo "moneytype1=$moneytype"; 
		}
		else if($i>=3){
			$moneytype .= substr($inttype, $i-3, 3); 
			//echo "moneytype2=$moneytype"; 
		}
		
		if(($i>0)&&($i<$len)){
			if(strstr($inttype,"-")&&($i<3) && ($i>0))
				$moneytype=$moneytype;
			else
				$moneytype=$moneytype.",";
			//echo "moneytype+=moneytype";
		}
		//echo "i=$i";
		//echo "moneytype3=$moneytype";
	} 
	return $moneytype;
}
function toAryform($aryform){
	$aryform=str_replace("{\"", "", $aryform);
	$aryform=str_replace("\"}", "", $aryform);
	$aryform=str_replace("\",\"", " ", $aryform);
	$aryforms= explode(" ", $aryform);
	return $aryforms;
}
function PrintHeader($title) {
	echo "<html><head><title>$title</title></head><body bgcolor=white><center>";
}

function PrintFooter() {
	echo "</center></body></html>";
}

function resdcvt($alp) {
	if($alp =='a')
		return "서울특별시";
	if($alp =='b')
		return "인천광역시";
	if($alp =='c')
		return "부산광역시";
	if($alp =='d')
		return "대전광역시";
	if($alp =='e')
		return "광주광역시";
	if($alp =='f')
		return "대구광역시";
	if($alp =='g')
		return "울산광역시";
	if($alp =='h')
		return "경기도";
	if($alp =='i')
		return "강원도";
	if($alp =='j')
		return "충청남도";
	if($alp =='k')
		return "충청북도";
	if($alp =='l')
		return "전라북도";
	if($alp =='m')
		return "전라남도";
	if($alp =='n')
		return "경상남도";
	if($alp =='o')
		return "경상북도";
	if($alp =='p')
		return "제주도";
}

// 문자열을 mysql password함수를 이용하여 암호화 한다.
function get_password_str2($str) {
	global $dbconn;
	// mysql서버의 버전을 구한다

	$rs = mysql_query("SHOW VARIABLES like 'version'",$dbconn);
	$tmp=mysql_fetch_array($rs);
	mysql_free_result($rs);
	list($mysql_version)=explode('.',$tmp[1]);
		
	// mysql 4.1 부터 password 함수가 old_password 로바뀌었다.
	if($mysql_version>3) { // 4.0 버전 이상이라면
		$rs = mysql_query("SELECT old_password('$str')",$dbconn);
	} else { // 3.xx 버전 이하라면
		$rs = mysql_query("SELECT password('$str')",$dbconn);
	}
		
	$tmp=mysql_fetch_array($rs);
	mysql_free_result($rs);
	return $tmp[0];
}

function waterMarkImage($canvasImage, $watermarkImage /* MUST BE PNG */, $opacity=50, $quality=80, $dstImage = "")
{
	$imageTypes = array(
		1 => 'GIF',
		2 => 'JPG',
		3 => 'PNG',
		4 => 'SWF',
		5 => 'PSD',
		6 => 'BMP',
		7 => 'TIFF(intel byte order)',
		8 => 'TIFF(motorola byte order)',
		9 => 'JPC',
		10 => 'JP2',
		11 => 'JPX',
		12 => 'JB2',
		13 => 'SWC',
		14 => 'IFF',
		15 => 'WBMP',
		16 => 'XBM'
	);

	if($dstImage == "")
		$dstImage = $canvasImage;

	// get canvas Image information (file type)
	$getCanvasImageInfo = @getimagesize($canvasImage);
	// get overlay Image information (file type)
	$getOverlayImageInfo = @getimagesize($watermarkImage);

	// create true color canvas image:
	switch($imageTypes[$getCanvasImageInfo[2]])
	{
		case "GIF":
			$canvas_src = imagecreatefromgif($canvasImage);
			break;
		case "JPG":
			$canvas_src = imagecreatefromjpeg($canvasImage);
			break;
		case "PNG":
			$canvas_src = imagecreatefrompng($canvasImage);
			break;
		default:
			return array("bool"=>false, "error"=>"원본 이미지는 GIF, JPG, PNG 이어야 합니다.");
			break;
	}

	if($imageTypes[$getOverlayImageInfo[2]] != "PNG")
	{
		return array("bool"=>false, "error"=>"워터마크 이미지는 반드시 PNG 이어야 합니다. 현재 :".$imageTypes[$getOverlayImageInfo[2]]);
	}

	// 이미지가 너무 클 경우 서버의 메모리 제한과 비교한다 (거의 비슷하게 일치)
	if(($getCanvasImageInfo[0]*$getCanvasImageInfo[1]*10) > (intval(ini_get("memory_limit"))*1024*1024)) 
	{
		return array("bool"=>false, "error"=>"이미지를 처리하기에 너무 큽니다. 사이즈를 주려주세요.");
	}

	/*echo ($getCanvasImageInfo[0]*$getCanvasImageInfo[1]*10);
	if(($getCanvasImageInfo[0]*$getCanvasImageInfo[1]*10) > (intval(ini_get("memory_limit"))*1024*1024))
		echo ">";
	else
		echo "<";
	echo (intval(ini_get("memory_limit"))*1024*1024);
	exit;*/

	$canvas_w = ImageSX($canvas_src);
	$canvas_h = ImageSY($canvas_src);
	$canvas_img = @imagecreatetruecolor($canvas_w, $canvas_h);
	imagecopy($canvas_img, $canvas_src, 0,0,0,0, $canvas_w, $canvas_h);
	imagedestroy($canvas_src); // no longer needed

	// create true color overlay image:
	$overlay_src = imagecreatefrompng($watermarkImage);
	$overlay_w = ImageSX($overlay_src);
	$overlay_h = ImageSY($overlay_src);
	$overlay_img = imagecreatetruecolor($overlay_w, $overlay_h);
	imagecopy($overlay_img, $overlay_src, 0,0,0,0, $overlay_w, $overlay_h);
	imagedestroy($overlay_src); // no longer needed

	// setup transparent color (pick one):
	$black = imagecolorallocate($overlay_img, 0x00, 0x00, 0x00);
	$white = imagecolorallocate($overlay_img, 0xFF, 0xFF, 0xFF);
	$magenta = imagecolorallocate($overlay_img, 0xFF, 0x00, 0xFF); 
	// and use it here:
	imagecolortransparent($overlay_img, $black);

	// calculate overlay Image position 
	$overlay_x = ($getCanvasImageInfo[0] - $getOverlayImageInfo[0]) / 2;
	$overlay_y = ($getCanvasImageInfo[1] - $getOverlayImageInfo[1]) / 2;

	// copy and merge the overlay image and the canvas image:
	imagecopymerge($canvas_img, $overlay_img, $overlay_x, $overlay_y, 0, 0, $overlay_w, $overlay_h, $opacity);

	// output
	//header("Content-type: image/jpeg");
	switch($imageTypes[$getCanvasImageInfo[2]])
	{
		case "GIF":
			@imagegif($canvas_img, $dstImage);
			break;
		case "JPG":
			@imagejpeg($canvas_img, $dstImage, $quality);
			break;
		case "PNG":
			@imagepng($canvas_img, $dstImage);
			break;
		default:
			return array("bool"=>false, "error"=>"워터마크 처리된 이미지 생성에 실패했습니다.");
			break;
	}
	
	imagedestroy($overlay_img);
	imagedestroy($canvas_img);

	return array("bool"=>true, "error"=>"정상처리");
}

// 배열을 이용하여 <option> 태그를 발생시킨다.
	// $options 는 배열또는 이중배열이다.

	function rg_html_option2($options,$key_field='',$text_field='',$default=NULL,$text_key=false) {
		$_result = '';
		$selected = false;

//		if($text_field=='')$text_field=$key_field;
		if(!is_array($options)) return false;

		reset($options);
		while(list($key,$value)=each($options)) {
		
			if($key_field && $text_field) { // 키필드와 텍스트가 있다면
				$o_key = $value[$key_field];
				$o_text = $value[$text_field];
			} else if ($key_field && !$text_field) { // 키필드만 있다면
				$o_key = $value[$key_field];
				$o_text = $value[$key_field];
			} else if (!$key_field && $text_field) { // 텍스트필드만 있다면
				$o_key = $key;
				$o_text = $value[$text_field];
			} else { // 둘다 없다면
				if($text_key)
					$o_key = $value;
				else
					$o_key = $key;				
				$o_text = $value;
			}
			
			if(($default!=NULL) && (!$selected) && ($o_key==$default)) {
				$_result .= "<option value='$o_key' selected>$o_text</option>\n";
				$selected=true;
			} else {
				$_result .= "<option value='$o_key'>$o_text</option>\n";
			}
		}
		return $_result;
	}
//header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"'); 
?>
