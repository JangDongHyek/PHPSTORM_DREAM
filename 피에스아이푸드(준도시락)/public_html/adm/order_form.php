<?php
$sub_menu = "220100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$ord = sql_fetch(" select ord.*, do.do_category, do.do_warm from g5_order as ord left join g5_dosirak as do on do.idx = ord.dosirak_idx where ord.idx = '{$idx}' ");

if($ord['read_yn'] == 'N' && !$private) { // 상세 조회 시 수정 표시 지움
    sql_query(" update g5_order set read_yn = 'Y' where idx = '{$idx}' ");
}

$g5['title'] .= '주문내역';
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

if($private) { $param = '&st_date2='.$st_date2.'&ed_date2='.$ed_date2; }
?>

<style>
    .mb_tbl {text-align: center;}
    .tr_cls {font-weight: bold;}
</style>

<form name="fdosirak" id="fdosirak" action="./dosirak_form_update.php" onsubmit="return fdosirak_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" id="del_file_idx" name="del_file_idx" value="<?=$idx?>">

<div class="tbl_frm01 tbl_wrap">
    <h1 class="subj">* 주문정보</h1>
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="8%">
        <col width="*">
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="rider">담당기사<?php echo $sound_only ?></label></th>
        <td>
            <select id="rider" name="rider" onchange="riderSelect('<?=$idx?>', this.value, '<?=$ord['mb_id']?>');">
                <option value="">담당기사를 선택하세요.</option>
                <?php
                $rlt = sql_query("select * from g5_member where mb_level = 3");
                while($row = sql_fetch_array($rlt)) {
                ?>
                <option value="<?=$row['mb_id']?>" <?=$ord['rider'] == $row['mb_id'] ? 'selected' : '';?>><?=$row['mb_name']?></option>
                <?php
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="order_no">주문번호<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="order_no" value="<?php echo $ord['order_no'] ?>" id="order_no" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="order_state">주문상태<?php echo $sound_only ?></label></th>
        <td>
            <select id="order_state" name="order_state" onchange="changeState('<?=$idx?>', this.value);">
                <option value="주문접수" <?php echo $ord['order_state'] == '주문접수' ? 'selected' : ''; ?>>주문접수</option>
                <option value="배달중" <?php echo $ord['order_state'] == '배달중' ? 'selected' : ''; ?>>배달중</option>
                <option value="배달완료" <?php echo $ord['order_state'] == '배달완료' ? 'selected' : ''; ?>>배달완료</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="wr_datetime">주문일<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="wr_datetime" value="<?php echo substr($ord['wr_datetime'], 0, 10) ?>" id="wr_datetime" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="wr_datetime2">주문시간<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="wr_datetime2" value="<?php echo substr($ord['wr_datetime'], 11, 5) ?>" id="wr_datetime2" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_id">주문자아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="mb_id" value="<?php echo $ord['mb_id'] ?>" id="mb_id" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="do_category">구분<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="do_category" value="<?php echo $ord['do_category'] ?>" id="do_category" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="do_name">메뉴명<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="do_name" value="<?php echo $ord['do_name'] ?>" id="do_name" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="order_amount">수량<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="order_amount" value="<?php echo number_format($ord['order_amount']) ?>" id="order_amount" class="frm_input" size="30" onkeyup="commaNumber(this);">개
        </td>
    </tr>
    <?php if($ord['do_warm'] == "Y") { ?>
    <!--<tr>
        <th scope="row"><label for="order_warm">발열도시락변경여부<?php /*echo $sound_only */?></label></th>
        <td>
            <input type="text" name="order_warm" value="<?php /*echo $ord['order_warm'] == "Y" ? "변경" : "변경안함" */?>" id="order_warm" class="frm_input" size="30">
        </td>
    </tr>-->
    <?php } ?>
    </tbody>
    </table>
</div>
<div class="tbl_frm01 tbl_wrap">
    <h1 class="subj">* 배송정보</h1>
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="8%">
        <col width="*">
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="order_addr1"><?php echo $ord['order_category'] == '정기배달' || $ord['order_category'] == "샐러드팩" ? '주문배송지' : '행사장소' ?><?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="order_addr1" value="<?php echo empty($ord['order_post']) ? '' : '['.$ord['order_post'].'] ' ?><?=$ord['order_addr1']?>" id="order_addr1" class="frm_input" size="70"><br>
            <input type="text" name="order_addr1" value="<?php echo $ord['order_addr2'] ?>" id="order_addr1" class="frm_input" size="70" style="margin-top: 2px;">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="order_name">받는사람<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="order_name" value="<?php echo $ord['order_name'] ?>" id="order_name" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="order_tel">연락처<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="order_tel" value="<?php echo $ord['order_tel'] ?>" id="order_tel" class="frm_input" size="50">
        </td>
    </tr>
    <?php if($ord['order_category'] == "정기배달" || $ord['order_category'] == "샐러드팩") { ?>
    <tr>
        <th scope="row"><label for="delivery_date">배달시작일<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="delivery_date" value="<?php echo substr($ord['delivery_date'], 0, 10) ?>" id="delivery_date" class="frm_input" size="50">
        </td>
    </tr>
    <?php } else { ?>
    <tr>
        <th scope="row"><label for="event_date">행사날짜<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="event_date" value="<?php echo substr($ord['event_date'], 0, 10) ?>" id="event_date" class="frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="event_time">행사시간<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="event_time" value="<?php echo substr($ord['event_time'], 0, 10) ?>" id="event_time" class="frm_input" size="50">
        </td>
    </tr>
    <?php } ?>
    <tr>
        <th scope="row"><label for="order_memo">메모<?php echo $sound_only ?></label></th>
        <td>
            <?php echo $ord['order_memo'] ?>
            <!--<input type="text" name="order_memo" value="<?php /*echo $ord['order_memo'] */?>" id="order_memo" class="frm_input" size="70">-->
        </td>
    </tr>
    </tbody>
    </table>
</div>
<div class="tbl_frm01 tbl_wrap">
    <h1 class="subj">* 결제정보</h1>
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="8%">
        <col width="*">
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="total_price">결제금액<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="total_price" value="<?php echo number_format($ord['total_price']) ?>" id="total_price" class="frm_input" size="30" onkeyup="commaNumber(this);">원
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="shipping_fee">배송비<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="shipping_fee" value="<?php echo number_format($ord['shipping_fee']) ?>" id="shipping_fee" class="frm_input" size="30" onkeyup="commaNumber(this);">원
        </td>
    </tr>
    </tbody>
    </table>
</div>

<?php
if($ord['order_category'] == '정기배달' || $ord['order_category'] == '샐러드팩') {
$sql_common = " from g5_order as ord left join g5_dosirak as do on do.idx = ord.dosirak_idx left join g5_member as mb on mb.mb_id = ord.mb_id ";
$sql_search = " where 1=1 and ord.order_no = '{$ord['order_no']}' ";
$sql_order = " order by ord.idx desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page2 < 1) $page2 = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page2 - 1) * $rows; // 시작 열을 구함

$sql = " select ord.*, do.do_category, mb.mb_name {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
//if($private) { echo $sql; }
$result = sql_query($sql);
?>
<div class="tbl_head02 tbl_wrap mb_tbl">
    <h1 class="subj" style="text-align: left;">* 주문수정내역</h1>
    <table>
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <thead>
        <tr>
            <th>No.</th>
            <th>메뉴명</th>
            <th>수량</th>
            <th>금액</th>
            <th>담당기사</th>
            <th>주문배송지</th>
            <th>받는사람</th>
            <th>연락처</th>
            <th>배달시작일</th>
            <th>메모</th>
            <th>수정일</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $list_no = $total_count - ($rows*($page2-1));
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $cls = '';
            if($i == 0) { // 현재주문
                $cls = 'tr_cls';
            }

            $rider = get_member($row['rider']);
        ?>
            <tr class="<?php echo $bg; ?> <?=$cls?>">
                <td><?=$list_no?></td>
                <td><?=$row['do_name']?></td>
                <td><?=number_format($row['order_amount'])?>개</td>
                <td><?=number_format($row['total_price'])?>원</td>
                <td><?=$rider['mb_name']?></td>
                <td><?=empty($row['order_post']) ? '' : '['.$row['order_post'].'] ';?><?=$row['order_addr1'].' '.$row['order_addr2']?></td>
                <td><?=$row['order_name']?></td>
                <td><?=$row['order_tel']?></td>
                <td><?=$row['delivery_date']?></td>
                <td><?=$row['order_memo']?></td>
                <td><?=substr($row['up_datetime'], 0, 16)?></td>
            </tr>
            <?php
            $list_no--;
        }
        if ($i == 0)
            echo "<tr><td colspan=\"11\" class=\"empty_table\">자료가 없습니다.</td></tr>";
        ?>
        </tbody>
    </table>
</div>

<?php echo get_paging3(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page2, $total_page, '?'. $qstr . '&w=u&idx='.$idx);?>
<?php } ?>

<div class="btn_confirm01 btn_confirm">
    <a href="./order_list.php?<?php echo $qstr.$param ?>">목록</a>
</div>
</form>

<script>
    $(function() {
        $("input").attr("readonly", true);
    })

    // 주문상태 변경
    function changeState(idx, state) {
        $.ajax({
            url: "./ajax.order_state_change.php",
            type: "post",
            data: {idx: idx, state: state},
            success: function(data) {
                if(data) {
                    alert("주문상태가 변경되었습니다.");
                }
            }
        })
    }

    // 기사배정 (주문idx, 담당기사id, 고객id)
    function riderSelect(idx, rider, customer) {
        $.ajax({
            url: "./ajax.rider_select.php",
            type: "post",
            data: {idx: idx, rider: rider, customer: customer},
            success: function(data) {
                if(data) {
                    alert("기사가 배정되었습니다.");
                }
            }
        })
    }
</script>

<?php
include_once('./admin.tail.php');
?>
