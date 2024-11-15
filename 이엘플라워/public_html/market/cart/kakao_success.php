<?
include "../../connect.php";
include "../../include/kakao.class.php";
$sql="select * from kakaoOrder where orderNo='$_COOKIE[order_id]'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$total_amount=$row[payPrice];


$list=array();
$list['adminKey']='f67d586e5915fd23cb2369e0ce0358a5';//admin key
$list['cid']='C111960088';//상점아이디
$list['tid']=$_SESSION['kakao_tid'];//결제아이디
$list['order_id']=$_SESSION['orderNo'];//주분번호
$list['user_id']=$_SESSION[UnameSess];//회원아이디
$list['total_amount']=$total_amount;//총금액
$list['pg_token']=$pg_token;//pg 토큰값
$kakaoPay=new KakaPay("2",$list,"pc");//카카오페이 멤버변수 설정하기 1 결제준비 2 결제승인
$kakaoPay->successKakaoPay();//결제 승인 파라미터 넘겨주고 json으로 받아옴
$result=$kakaoPay->execKakaoPay();//카카오페이 실행



//db저장
$payment_method_type=$result->payment_method_type;
$card_info=$result->card_info;
$create_at=$result->create_at;
$approved_at=$result->approved_at;
$status="S";

unset($_SESSION['kakao_tid']);
unset($_SESSION['orderNo']);
?>
<script type="text/javascript">
	location.href="./order_ok.html?order_num=<?php echo $list['order_id'];?>";
</script>