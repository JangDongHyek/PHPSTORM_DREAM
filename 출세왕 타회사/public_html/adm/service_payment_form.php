<?php
$sub_menu = "260100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$g5['title'] .= '서비스관리';
include_once('./admin.head.php');


$sql = "select * from new_complete_history where cw_idx = '{$_REQUEST["idx"]}' and update_yn = 'N' order by ch_idx desc ";
$complete_result = sql_query($sql);

$sql = "select * from new_car_wash where cw_idx = '{$_REQUEST["idx"]}' ";
$cw =sql_fetch($sql);

$sql = "select * from g5_autoPay where userId = '{$cw["mb_id"]}' ";
$ap = sql_fetch($sql);

//$sql = "select * from new_autopay_history where BillKey = '{$ap["BillKey"]}' ";
$sql = "select * from new_autopay_history where new_car_wash_idx = '{$_GET['idx']}' ";
$result = sql_query($sql);

//총누적결제금액
$sql = "select sum(amt) sum from new_autopay_history where BillKey = '{$ap['BillKey']}' ";
$total_price = sql_fetch($sql)["sum"];
//예상금액
//$sql = "select count(*) cnt from new_complete_history where cw_idx = '{$_REQUEST["idx"]}' and update_yn = 'N' order by ch_idx desc ";
//$complete_cnt = sql_fetch($sql)["cnt"];

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

    <div class="tbl_head02 tbl_wrap mb_tbl">
        
        <h2 style="margin-top: 15px">결제내역(총 결제금액: <?=number_format($total_price)?>)</h2>

        <table style="text-align: center">

            <thead>
            <tr>
                <th>no.</th>
                <th>결제일자</th>
                <th>결제금액</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {

                ?>
                <tr>
                    <td><?= $i+1; ?>회</td>
                    <td><?=date("Y-m-d H시 i분",strtotime($row["regdate"]))?></td>
                    <td><?=number_format($row["amt"])?></td>
                </tr>


                <?php
            }
            if ($i == 0)
                echo "<tr><td colspan=\"9\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
        <h2 style="margin-top: 15px">완료내역</h2>
        <table style="text-align: center">

            <thead>
            <tr>
                <th>완료회차</th>
                <th>완료일자</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($complete_result); $i++) {

                ?>
                <tr>
                    <td><?= $row["total_cnt"] ?>회</td>
                    <td><?=date("Y-m-d H시 i분",strtotime($row["ch_datetime"]))?></td>
                </tr>


                <?php
            }
            if ($i == 0)
                echo "<tr><td colspan=\"9\" class=\"empty_table\">자료가 없습니다.</td></tr>";
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <a href="./service_payment_list.php?<?php echo $qstr ?>">목록</a>
    </div>
</form>

<script>




</script>

<?php
include_once('./admin.tail.php');
?>
