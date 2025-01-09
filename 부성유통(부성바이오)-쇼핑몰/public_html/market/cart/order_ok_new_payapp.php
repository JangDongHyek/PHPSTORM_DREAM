<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<script>
top.opener.location = "./order_ok_new_payapp.html?order_num=<?=$order_num?>";
window.close();
</script>