<?
//========================== ���� ���� =========================================
session_start();
global $HTTP_COOKIE_VARS;

$Mall_Admin_ID = $_SESSION["Mall_Admin_ID"]; //�����ھ��̵�
$UnameSess = $_SESSION["UnameSess"];
$MemberLevel = $_SESSION["MemberLevel"];
$MemberName = $_SESSION["MemberName"];
$MemberEmail = $_SESSION["MemberEmail"];
$mart_id = $_SESSION["mart_id"];

//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "zzmonte2r";
$Admin = "zzmonte2r";
$AdminPass = "jqql^yl5";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}
//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "zzmonte2r";
//========================== ��Ÿ ���� =========================================
switch( $MemberLevel ){
	case "1" : 
		$Level = "��ü������";//member ���̺�
		break;
	case "2" :
		$Level = "���θ�������";//member ���̺�
		break;
	case "3" : 
		$Level = "������";//member ���̺�
		break;
	case "4" :
		$Level = "ȸ����";//member ���̺�
		break;

	case "10" :
		$Level = "�Ϲ�ȸ��";//mart_member_new ���̺�
		break;
}

$admin_title = "�����ڸ��";
$root_dir = "/home/zzmonte2r/public_html"; //���� ���� ���
$home_dir = "http://www.letsit.kr/~zzmonte2r"; //���� ���� ���

//========================== ��ǰ�̹��� ���� ===================================
$list_product_img_width = "120";
$list_product_img_height = "120";
$view_product_img_width = "240";
$view_product_img_height = "240";
$big_product_img_width = "500";
$big_product_img_height = "500";

//========================== ���̺� ���� =======================================
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

$Co_img_UP = "$root_dir/co_img/";	//�̹��� ���ε� ������
$Co_img_DOWN = "/co_img/";			//�̹��� ���ε� ���丮

$UploadRoot = "$root_dir/up/";		//���ε� ���� ������
$DownloadRoot = "/up/";				//�ٿ�ε� �� ������
$DownloadDir = "$home_dir/up/";		//�ٿ�� ���丮

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

$StrLevel_A = "�մ�";
$StrLevel_B = "���� �����";
$StrLevel_C = "��� �����";
$StrLevel_D = "�߰�������";
$StrLevel_E = "������";
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

// ����Ʈ ����
$point_arr = array('a'=>'����', 'p'=>'����', 'u'=>'����', 'c'=>'ȯ��', 'd'=>'�谨', 'j'=>'ȸ������', 'g'=>'��ǰ��', 'b'=>'���ã���߰�', 'cs'=>'���ݰ���');

// ���� ������ checked/select ����
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

// ī�װ� num ���� ī�װ� �׺���̼� ����
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

// ��� �޼��� ���� �ش� �������� �̵��ϴ� �Լ�
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

//=============== ������ �ڸ����� ������...�տ� 0�� �ٿ� ��ȯ�Ѵ�..
function addzero($str, $length){ 
    if(strlen($str) == $length) 
        return $str; 

    for($i = strlen($str) ; $i < $length; $i++) { 
		$zero_str = "0".$zero_str;
    }
	$str = $zero_str.$str;
    return $str; 
}

// �Խ��� ��Ϻ���, �б�, ����, ���Ϲޱ� ���� üũ
// �Խ��Ǹ�, ����� ����, üũ�� ����
// ���� ������ true, ������ false ����
function CheckPermBoard($boardNameTemp, $permSessTemp, $checkFlag) {
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable;
	global $Level_A, $Level_B, $Level_C, $Level_D, $Level_E;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "����Ÿ���̽� ���� ����!";
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
// $permTemp: ����� ���� ��Ʈ�� (guest, admin.....)
// $permTemp �� �´� ������ ���ĺ� ����

function WhichPerm($permTemp) {
	global $Level_A, $Level_B, $Level_C, $Level_D, $Level_E;
	
	if ($permTemp == $Level_A) return "A";
	elseif ($permTemp == $Level_B) return "B";
	elseif ($permTemp == $Level_C) return "C";
	elseif ($permTemp == $Level_D) return "D";
	elseif ($permTemp == $Level_E) return "E";
}

// $menuNameTemp: �޴���, $permSessTemp: ����� ���� ��Ʈ��
// �ش� �޴��� ����� ���� üũ, ������ ������ true ���� ������ false

function CheckPermMenu($menuNameTemp, $permSessTemp) {
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MenuTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "����Ÿ���̽� ���� ����!";
		return false;
	}
	$SQL = "select * from $MenuTable where menuName='$menuNameTemp'";
	$dbresult = mysql_query($SQL, $dbconnTemp);
	$menuPerm = mysql_result($dbresult, 0, "menuperm");
	$userPerm = WhichPerm($permSessTemp);
	mysql_close($dbconnTemp);
	if ($userPerm == "E") return true;		//�������̸� ��� ���
	if (is_integer(strpos($menuPerm, $userPerm)) == false) return false;
	else return true;
}

function Get_Limit_Price($item_no, $mart_id){
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MenuTable, $Union_ItemTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "����Ÿ���̽� ���� ����!";
		return false;
	}
	$SQL = "select * from $Union_ItemTable where item_no='$item_no' and mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconnTemp);
	if(mysql_num_rows($dbresult)>0){
		$z_price = mysql_result($dbresult, 0, "z_price");
		return $z_price;
	}
	else return "��ǰ������ ";
}

function Get_Slide_Price($item_no, $mart_id){
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MenuTable, $Union_ItemTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "����Ÿ���̽� ���� ����!";
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
	else return "��ǰ������ ";
}


// $PermTemp:����, $permSessTemp: ����� ���� ��Ʈ��
// �ش� �޴��� ����� ���� üũ, ������ ������ true ���� ������ false

function CheckPerm($PermTemp, $permSessTemp) {
	$userPerm = WhichPerm($permSessTemp);
	if ($userPerm == "E") return true;		//�������̸� ��� ���
	if (is_integer(strpos($PermTemp, $userPerm)) == false) return false;
	else return true;
}
// $username: ����� ���̵�
// �������� ���������� üũ�ؼ� ������ true, �ƴϸ� false ����
// Member ���̺��� bookadmin �ʵ尡 true �̸� OK

function CheckBookAdmin($username) {
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MemberTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "����Ÿ���̽� ���� ����!";
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

// $username: ����� ���̵�
// �������� ���������� üũ�ؼ� ������ true, �ƴϸ� false ����
// Member ���̺��� bookadmin �ʵ尡 true �̸� OK

function CheckSiganAdmin($username) {
	global $HostName, $DbName, $Admin, $AdminPass, $ConfigTable, $MemberTable;

	$dbconnTemp = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconnTemp == false) {
    	echo "����Ÿ���̽� ���� ����!";
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
		case 0: return "��"; break;
		case 1: return "��"; break;
		case 2: return "ȭ"; break;
		case 3: return "��"; break;
		case 4: return "��"; break;
		case 5: return "��"; break;
		case 6: return "��"; break;
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
		return "����Ư����";
	if($alp =='b')
		return "��õ������";
	if($alp =='c')
		return "�λ걤����";
	if($alp =='d')
		return "����������";
	if($alp =='e')
		return "���ֱ�����";
	if($alp =='f')
		return "�뱸������";
	if($alp =='g')
		return "��걤����";
	if($alp =='h')
		return "��⵵";
	if($alp =='i')
		return "������";
	if($alp =='j')
		return "��û����";
	if($alp =='k')
		return "��û�ϵ�";
	if($alp =='l')
		return "����ϵ�";
	if($alp =='m')
		return "���󳲵�";
	if($alp =='n')
		return "��󳲵�";
	if($alp =='o')
		return "���ϵ�";
	if($alp =='p')
		return "���ֵ�";
}

// ���ڿ��� mysql password�Լ��� �̿��Ͽ� ��ȣȭ �Ѵ�.
function get_password_str($str) {
	global $dbconn;
	// mysql������ ������ ���Ѵ�

	$rs = mysql_query("SHOW VARIABLES like 'version'",$dbconn);
	$tmp=mysql_fetch_array($rs);
	mysql_free_result($rs);
	list($mysql_version)=explode('.',$tmp[1]);
		
	// mysql 4.1 ���� password �Լ��� old_password �ιٲ����.
	if($mysql_version>3) { // 4.0 ���� �̻��̶��
		$rs = mysql_query("SELECT old_password('$str')",$dbconn);
	} else { // 3.xx ���� ���϶��
		$rs = mysql_query("SELECT password('$str')",$dbconn);
	}
		
	$tmp=mysql_fetch_array($rs);
	mysql_free_result($rs);
	return $tmp[0];
}

header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"'); 
?>
