<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
?>
<script>
top.opener.location = "./order_ok_new_payapp.html?order_num=<?=$order_num?>";
window.close();
</script>