<?php
include_once("./_common.php");
include_once('./_head.php');
//alert_close('정상적으로 로그인하여 접근하시기 바랍니다.');
//alert('정상적으로 로그인하여 접근하시기 바랍니다.', G5_BBS_URL.'/login.php');

//phpinfo();
/*// 회원데이터 g5_member
$sql = " select * from g5_member where mb_id like 'ns%' ";
$result = sql_query($sql);

$idx = '';
for($i=0; $row=sql_fetch_array($result); $i++) {
    $idx .= $row['mb_no'].',';
}
$idx = substr($idx, 0, -1);

// 회원이력데이터 g5_member_history
$sql= " select * from g5_member_history where mb_no in ({$idx}) ";
echo $sql.'<br>';
/*$result = sql_query($sql);

$history_idx = '';
for($i=0; $row=sql_fetch_array($result); $i++) {
    $history_idx .= $row['idx'].',';
}
$history_idx = substr($history_idx, 0, -1);*/

// 회원레슨일지데이터 g5_lesson_diary
//$sql = "select * from g5_lesson_diary where mb_no in ({$idx}) ";
//echo $sql.'<br>';

// 회원매출데이터 g5_salse
//$sql = " select * from g5_sales where mb_no in ({$idx}) ";
//echo $sql.'<br>';*/

?>
<script>
    $(function() {
        showLoadingBar();
    });

    function showLoadingBar() {
        var maskHeight = $(document).height();
        var maskWidth = window.document.body.clientWidth;
        var mask = "<div id='mask' style='position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;'></div>";
        var loadingImg = '';
        loadingImg += "<div id='loadingImg' style='position:absolute; left:50%; top:40%; display:none; z-index:10000;'>";
        loadingImg += " <img src='../adm/img/loading.gif'/>";
        loadingImg += "</div>";
        $('body').append(mask).append(loadingImg);
        $('#mask').css({'width': maskWidth, 'height': maskHeight, 'opacity': '0.3'});
        $('#mask').show();
        $('#loadingImg').show();
    }

    function hideLoadingBar() {
        $('#mask, #loadingImg').hide();
        $('#mask, #loadingImg').remove();
    }
</script>

