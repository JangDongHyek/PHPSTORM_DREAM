<?
//========================== 세션 시작 =========================================
session_start();
global $HTTP_COOKIE_VARS;

$Mall_Admin_ID = $_SESSION["Mall_Admin_ID"]; //관리자아이디
$UnameSess = $_SESSION["UnameSess"];
$MemberLevel = $_SESSION["MemberLevel"];
$MemberName = $_SESSION["MemberName"];
$MemberEmail = $_SESSION["MemberEmail"];
$mart_id = $_SESSION["mart_id"];

//========================== DB 접속 정보 ======================================
$HostName = "localhost";
$DbName = "zzmonte2r";
$Admin = "zzmonte2r";
$AdminPass = "jqql^yl5";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "데이타베이스 연결 실패!";
}
//========================== 마트아이디 정보 ===================================
$mart_id = "zzmonte2r";
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

$admin_title = "관리자모드";
$root_dir = "/home/zzmonte2r/public_html"; //서버 절대 경로
$home_dir = "http://www.letsit.kr/~zzmonte2r"; //서버 절대 경로

//========================== 상품이미지 정보 ===================================
$list_product_img_width = "120";
$list_product_img_height = "120";
$view_product_img_width = "240";
$view_product_img_height = "240";
$big_product_img_width = "500";
$big_product_img_height = "500";

//========================== 테이블 정보 =======================================
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

/*
$Level_A = "guest";
$Level_B = "notregister";
$Level_C = "customer";
$Level_D = "manager";
$Level_E = "admin";

$StrLevel_A = "손님";
$StrLevel_B = "비등록 사용자";
$StrLevel_C = "등록 사용자";
$StrLevel_D = "중간관리자";
$StrLevel_E = "관리자";
*/
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
$point_arr = array('a'=>'적립', 'p'=>'적립', 'u'=>'지불', 'c'=>'환불', 'd'=>'삭감', 'j'=>'회원가입', 'g'=>'상품권', 'b'=>'즐겨찾기추가', 'cs'=>'현금결제');

// 값이 같으면 checked/select 리턴
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
// $username: 사용자 아이디
// 도서관리 관리자인지 체크해서 맞으면 true, 아니면 false 리턴
// Member 테이블의 bookadmin 필드가 true 이면 OK

function CheckBookAdmin($username) {
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MemberTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "데이타베이스 연결 실패!";
		return false;
	}

	$SQL = "select * from $MemberTable where username='$username'";
	$dbresult = mysql_query($SQL, $dbconnTemp);
	if (mysql_result($dbresult, 0, "bookadmin") == "t") {
		mysql_close($dbconnTemp);
		return true;
	} else {
		mysql_close($dbconnTemp);
		return false;
	}
}

// $username: 사용자 아이디
// 도서관리 관리자인지 체크해서 맞으면 true, 아니면 false 리턴
// Member 테이블의 bookadmin 필드가 true 이면 OK

function CheckSiganAdmin($username) {
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MemberTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "데이타베이스 연결 실패!";
		return false;
	}

	$SQL = "select * from $MemberTable where username='$username'";
	$dbresult = mysql_query($SQL, $dbconnTemp);
	if (mysql_result($dbresult, 0, "siganadmin") == "t") {
		mysql_close($dbconnTemp);
		return true;
	} else {
		mysql_close($dbconnTemp);
		return false;
	}
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
function get_password_str($str) {
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

header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"'); 
?>
