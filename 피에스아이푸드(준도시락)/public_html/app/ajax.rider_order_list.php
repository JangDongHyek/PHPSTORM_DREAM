<?php
include_once("../common.php");
/**
 * 주문내역 (기사용) - 리스트 (ajax)
 */

$sql_search = "where 1=1 and rider = '{$member['mb_id']}'";
$sql_orderby = "order by idx desc";

// 도시락 구분 검색
if(!empty($cate)) {
    $sql_search .= "and order_category = '{$cate}' ";
}

// 도시락 주문날짜 검색
if(!empty($st_date) && !empty($ed_date)) {
    $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') >= '{$st_date}' and date_format(wr_datetime, '%Y-%m-%d') <= '{$ed_date}' ";
} else if(!empty($st_date) && empty($ed_date)) {
    $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') >= '{$st_date}' ";
} else if(empty($st_date) && empty(!$ed_date)) {
    $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') <= '{$ed_date}' ";
}

// 페이징
$sql = " select count(*) as cnt from g5_order {$sql_search} {$sql_orderby} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * from g5_order {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} "; // 주문내역
//if($private) { echo $sql; }
$rlt = sql_query($sql);

while($row = sql_fetch_array($rlt)) {
    $do = sql_fetch(" select * from g5_dosirak where idx = '{$row['dosirak_idx']}' ");
    if($row['order_category'] == "정기배달" || $row['order_category'] == "샐러드팩") {
        $mod_cls = ''; // 수정된 주문에 적용할 클래스
        if(empty($row['read_yn'])) { // 수정되기 전 이전 주문 건
            $mod_cls = 'style="text-decoration:line-through;"';
        }

        // 주문일 - 수정된 주문은 수정일 표시
        $order_date = str_replace('-', '.', substr($row['wr_datetime'],0, 10));
        if($row['mod_yn'] == 'Y') {
            $order_date = str_replace('-', '.', substr($row['up_datetime'], 0, 10));
        }
    ?>
    <!--정기배달-->
    <li>
        <div class="title">
            <h2 <?=$mod_cls?>>
			<?=$do['do_category']?> 도시락
            <span>주문날짜 <?=$order_date?></span>
            </h2>
        </div>
        <div class="menu">
            <p><?=$row['do_name']?> <?=number_format($row['order_amount'])?>개</p>
            <?php if($row['order_warm'] == "Y") { ?>
            <p>(+) 발열도시락 <?=$row['order_warm'] == "Y" ? "변경" : "변경안함" ?></p>
            <?php } ?>
        </div>
        <dl class="addr">
            <dt>주문배송지</dt>
            <dd>[<?=$row['order_post']?>] <?=$row['order_addr1'].' '.$row['order_addr2']?></dd>
        </dl>
        <dl class="date">
            <dt>받는사람</dt>
            <dd><?=$row['order_name']?></dd>
        </dl>
        <dl class="date">
            <dt>연락처</dt>
            <dd><?=$row['order_tel']?></dd>
        </dl>
        <dl class="date">
            <dt>배달시작일</dt>
            <dd><?=$row['delivery_date']?></dd>
        </dl>
        <dl class="memo">
            <dt>메모</dt>
            <dd><?=$row['order_memo']?></dd>
        </dl>
        <div class="pay">
            <p>결제금액<strong><?=number_format($row['total_price'])?>원</strong></p>
        </div>
        <div class="ft_btn">
            <a class="btn <?=$row['order_state'] == '배달완료' ? 'end' : 'ing' ?>"><?=$row['order_state']?></a>
            <!--
            주문접수/배송중 class:ing
            배달완료 class:end
            -->
        </div>
    </li>
    <!--//정기배달-->
    <?php
    }
    else { // 행사용/샐러드팩
    ?>
    <!--행사용-->
    <li>
        <div class="title">
            <h2><?=$do['do_category']?> 도시락<span>주문날짜 <?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span></h2>
            
        </div>
        <div class="menu">
            <p><?=$row['do_name']?> <?=number_format($row['order_amount'])?>개</p>
            <?php if($row['order_warm'] == "Y") { ?>
            <p>(+) 발열도시락 <?=$row['order_warm'] == "Y" ? "변경" : "변경안함" ?> <?=$do['do_add_price'] == "Y" ? "개당 1,000원" : "" ?></p>
            <?php } ?>
        </div>
        <dl class="addr">
            <dt>행사장소</dt>
            <dd>[<?=$row['order_post']?>] <?=$row['order_addr1'].' '.$row['order_addr2']?></dd>
        </dl>
        <dl class="date">
            <dt>받는사람</dt>
            <dd><?=$row['order_name']?></dd>
        </dl>
        <dl class="date">
            <dt>연락처</dt>
            <dd><?=$row['order_tel']?></dd>
        </dl>
        <dl class="date">
            <dt>행사날짜</dt>
            <dd><?=$row['event_date']?></dd>
        </dl>
        <dl class="date">
            <dt>행사시간</dt>
            <dd><?=$row['event_time']?></dd>
        </dl>
        <dl class="memo">
            <dt>메모</dt>
            <dd><?=$row['order_memo']?></dd>
        </dl>
        <div class="pay">
            <p>결제금액<strong><?=number_format($row['total_price'])?>원</strong></p>
        </div>
        <div class="ft_btn">
            <a class="btn <?=$row['order_state'] == '배달완료' ? 'end' : 'ing' ?>"><?=$row['order_state']?></a>
            <!--
            주문접수/배송중 class:ing
            배달완료 class:end
            -->
        </div>
    </li>
    <!--//행사용-->
    <?php
    }
?>
<?php
}
if($total_count == 0) {
?>
<div style="text-align: center;">주문내역이 없습니다.</div>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>