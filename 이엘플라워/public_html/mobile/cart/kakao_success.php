<?
include "../../connect.php";
include "../../include/kakao.class.php";
$sql="select * from kakaoOrder where orderNo='$_COOKIE[order_id]'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$total_amount=$row[payPrice];


$list=array();
$list['adminKey']='f67d586e5915fd23cb2369e0ce0358a5';//admin key
$list['cid']='C111960088';//�������̵�
$list['tid']=$_SESSION['kakao_tid'];//�������̵�
$list['order_id']=$_SESSION['orderNo'];//�ֺй�ȣ
$list['user_id']=$_SESSION[UnameSess];//ȸ�����̵�
$list['total_amount']=$total_amount;//�ѱݾ�
$list['pg_token']=$pg_token;//pg ��ū��
$kakaoPay=new KakaPay("2",$list,"mobile");//īī������ ������� �����ϱ� 1 �����غ� 2 ��������
$kakaoPay->successKakaoPay();//���� ���� �Ķ���� �Ѱ��ְ� json���� �޾ƿ�
$result=$kakaoPay->execKakaoPay();//īī������ ����


//db����
$payment_method_type=$result->payment_method_type;
$card_info=$result->card_info;
$create_at=$result->create_at;
$approved_at=$result->approved_at;
$status="S";

unset($_SESSION['kakao_tid']);
unset($_SESSION['orderNo']);

?>
<script>

	location.href="./order_ok.html";
</script>