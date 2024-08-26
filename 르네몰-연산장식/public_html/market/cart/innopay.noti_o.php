<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
function json_encode2($data) {
    switch (gettype($data)) {
        case 'boolean':
            return $data?'true':'false';
        case 'integer':
        case 'double':
            return $data;
        case 'string':
            return '"'.strtr($data, array('\\'=>'\\\\','"'=>'\\"')).'"';
        case 'array':
            $rel = false; // relative array?
            $key = array_keys($data);
            foreach ($key as $v) {
                if (!is_int($v)) {
                    $rel = true;
                    break;
                }
            }

            $arr = array();
            foreach ($data as $k=>$v) {
                $arr[] = ($rel?'"'.strtr($k, array('\\'=>'\\\\','"'=>'\\"')).'":':'').json_encode2($v);
            }

            return $rel?'{'.join(',', $arr).'}':'['.join(',', $arr).']';
        default:
            return '""';
    }
}
if($_GET[PayMethod]=="CARD"){
    $paymethod="bycard";
}else{
    $paymethod="byaccount";
}
//	echo iconv("utf-8","euc-kr",$AcquCardName);
if($PayMethod=="EPAY"){
    $AcquCardName = "간편결제";
    $CardQuota="";
}
if($OID==""){
    $OID=$moid;
}
$noti=json_encode2($_REQUEST);
$sql="insert noti(noti) values('$noti')";
mysql_query($sql);

$sql="update $Order_BuyTable_Temp set authnumber='$AuthCode',field3='".iconv("utf-8","euc-kr",$cardIssueName)."',field2='$CardQuota',card_paid='t',field4='$TID' where order_num='$OID'";
mysql_query($sql);
$sql="select * from $Order_BuyTable where order_num='$OID'";
$result=mysql_query($sql,$dbconn);
$row=mysql_fetch_array($result);
if($row[order_num]){
}else{
    //================== 임시주문서 내용을 주문서 테이블로 복사함 ========================
    $ordcopy_sql = "insert into $Order_BuyTable ( select * from $Order_BuyTable_Temp where order_num='$OID' and mart_id='$mart_id')";
    $ordcopy_res = mysql_query($ordcopy_sql, $dbconn);
}
?>

<script type="text/javascript">
    window.onload=function(){
        opener.location.href="./order_ok.html?order_num=<?=$OID?>&paymethod=<?=$paymethod?>";
        self.close();
    }
</script>