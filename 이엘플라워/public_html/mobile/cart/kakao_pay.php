<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
include "../../include/kakao.class.php";
$orderNo="e".date("Ymdhis")."_".rand(10,999);
$id = "$item_no";
$sql = "select item_name,z_price from item where item_no='$item_no'";
$res = mysql_query($sql,$dbconn);
$rows = mysql_fetch_array($res);
$name = $rows[item_name];
$price=$rows[z_price];
$name = strip_tags($name);
$item_name=iconv("euc-kr","utf-8",$rows[item_name]);
//$z_price = $rows[z_price];
######################################옵션시작###################################

if($opt1 || $opt2 || $opt3 || $opt4 || $opt5 || $opt6){


	$tot_price=0;
	$option="";		
	$sql = "select * from $OptionTable where opt_no='$opt1'";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	$opt_price=$rs[opt_price];
	$opt_ea=$rs[opt_ea];
	$opt_name=$rs[opt_name];
	
	$sql = "select * from $OptionTable2 where opt_no='$opt2'";
	$result=mysql_query($sql);
	$rs2=mysql_fetch_array($result);
	$opt_price2=$rs2[opt_price];
	$opt_ea2=$rs2[opt_ea];
	$opt_name2=$rs2[opt_name];
	
	$sql = "select * from $OptionTable3 where opt_no='$opt3'";
	$result=mysql_query($sql);
	$rs3=mysql_fetch_array($result);
	$opt_price3=$rs3[opt_price];
	$opt_ea3=$rs3[opt_ea];
	$opt_name3=$rs3[opt_name];
	
	$sql = "select * from $OptionTable4 where opt_no='$opt4'";
	$result=mysql_query($sql);
	$rs4=mysql_fetch_array($result);
	$opt_ea4=$rs4[opt_ea];
	$opt_price4=$rs4[opt_price];
	$opt_name4=$rs4[opt_name];

	$sql = "select * from $OptionTable5 where opt_no='$opt5'";
	$result=mysql_query($sql);
	$rs5=mysql_fetch_array($result);
	$opt_ea5=$rs5[opt_ea];
	$opt_price5=$rs5[opt_price];
	$opt_name5=$rs5[opt_name];

	$sql = "select * from $OptionTable6 where opt_no='$opt6'";
	$result=mysql_query($sql);
	$rs6=mysql_fetch_array($result);
	$opt_ea6=$rs6[opt_ea];
	$opt_price6=$rs6[opt_price];
	$opt_name6=$rs6[opt_name];


	
	if($opt_name){
		$option = $opt_name;
	}
	if($opt_name2){
		$option .= "/".$opt_name2;
	}
	if($opt_name3){
		$option .= "/".$opt_name3;
	}
	if($opt_name4){
		$option .= "/".$opt_name4;
	}
	if($opt_name5){
		$option .= "/".$opt_name5;
	}
	if($opt_name6){
		$option .= "/".$opt_name6;
	}

}
		
		

$uprice = $z_price + $opt_price + $opt_price2 + $opt_price3 + $opt_price4 + $opt_price5 + $opt_price6;

$count = $quantity;
$tprice = $uprice * $count;


$sql="select * from mart_member_new where username='$_SESSION[UnameSess]'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$member_addr=$row[zip]."<br/>".$row[address]." ".$row[address_d];

$sql="insert into kakaoOrder set 
			orderNo='$orderNo',
			member_id='$_SESSION[UnameSess]',
			member_name='$_SESSION[MemberName]',
			member_addr='$member_addr',
			item_no='$item_no',
			quantity='$quantity',
			price='$price',
			tax_price='0',
			payPrice='$tprice',
			opt1_name='$opt_name',
			opt1_price='$opt_price',
			opt1_ea='$opt_ea',
			opt2_name='$opt_name2',
			opt2_price='$opt_price2',
			opt2_ea='$opt_ea2',
			opt3_name='$opt_name3',
			opt3_price='$opt_price3',
			opt3_ea='$opt_ea3',
			opt4_name='$opt_name4',
			opt4_price='$opt_price4',
			opt4_ea='$opt_ea4',
			opt5_name='$opt_name5',
			opt5_price='$opt_price5',
			opt5_ea='$opt_ea5',
			opt6_name='$opt_name6',
			opt6_price='$opt_price6',
			opt6_ea='$opt_ea6'";
mysql_query($sql);


//카카오페이에 넘겨줄 파라미터 설정
$list=array();
$list['adminKey']='f67d586e5915fd23cb2369e0ce0358a5';//admin key
$list['cid']='C111960088';//상점아이디
$list['order_id']=$orderNo;//주문번호
$list['user_id']=$_SESSION[UnameSess];//회원아이디
$list['item_name']=$item_name;//상품명
$list['quantity']=$quantity;//상품갯수
$list['total_amount']=$tprice;//결제할 금액
$list['free_amount']="0";//배송비?? 
//카카오페이 결제준비
$kakaoPay=new KakaPay("1",$list,"mobile");//카카오페이 멤버변수 설정하기 1 결제준비 2 결제승인 pc:pc버전 mobile: 모바일버전
$kakaoPay->readyKakaoPay();//결제 준비시 때 실행
$result=$kakaoPay->execKakaoPay();//카카오페이 파라미터 넘겨주고 json으로 받아옴

setcookie("kakao_tid", $result->tid, time()+3600);//카카오 결제 아이디 별도로 저장
setcookie("order_id", $orderNo, time()+3600);//주문번호 별도로 저장


echo "<meta http-equiv='refresh' content='0;url=".$result->next_redirect_mobile_url."'>";
/*
echo "<script>";
echo "var win = window.open('','','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=300,height=700,left=100,top=100');";
echo "win.document.write('<iframe width=100%, height=650 src=".$result->next_redirect_mobile_url." frameborder=0 allowfullscreen></iframe>')";
echo "</script>";*/


/*

$params = array(
	'cid'               => "TC0ONETIME",                                    // 가맹점코드 10자
	'partner_order_id'  => $partner_order_id,                   // 주문번호
	'partner_user_id'   => $partner_user_id,                   // 유저 id
	'item_name'         => $item_name,               // 상품명
	'quantity'          => $quantity,                    // 상품 수량
	'total_amount'      => $total_amount,                // 상품 총액
	'tax_free_amount'   => 0,                                     // 상품 비과세 금액
	'vat_amount' => 0,
	'approval_url'      => $approval_url,                           // 결제성공시 콜백url 최대 255자
	'cancel_url'        => $cancel_url,
	'fail_url'          => $fail_url,
);
$headers= Array(
								'Authorization: KakaoAK '.$adminKey,
								'Content-type: application/x-www-form-urlencoded;charset=utf-8'
                );


	$curl = curl_init();

	curl_setopt( $curl, CURLOPT_URL, 'https://kapi.kakao.com/v1/payment/ready');
	curl_setopt( $curl, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt( $curl, CURLOPT_POST, true );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query($params) );



	$gData = curl_exec( $curl );

	curl_close($curl);
	$strArrResult = json_decode($gData);
	print_r($strArrResult);

echo $strArrResult->next_redirect_pc_url;
 echo "<script>";
        echo "var win = window.open('','','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=540,height=700,left=100,top=100');";
        echo "win.document.write('<iframe width=100%, height=650 src=".$strArrResult->next_redirect_pc_url." frameborder=0 allowfullscreen></iframe>')";
        echo "</script>";*/
?>
