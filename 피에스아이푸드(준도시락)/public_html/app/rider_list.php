<?php
$pid = "rider_order";
include_once("./app_head.php");
/**
 * 기사 - 주문현황 리스트
 */
if($member['mb_level'] != 3) {
    alert('올바른 경로가 아닙니다.');
}

$sql_common = " from g5_order as ord left join g5_member as mb on mb.mb_id = ord.mb_id ";
$sql_search = "where 1=1 and rider = '{$member['mb_id']}' and ord.dosirak_idx != 0 and read_yn is not null ";

// 도시락 구분 검색
if(!empty($cate)) {
    $sql_search .= "and order_category = '{$cate}' ";
}

if(empty($st_date) && empty($ed_date)) {
    $today = date('Y-m-d');
    $sql_search .= " and date_format(delivery_date, '%Y-%m-%d') = '{$today}' and date_format(delivery_date, '%Y-%m-%d') = '{$today}' ";
}

// 도시락 배송시작일 검색
if(!empty($st_date) && !empty($ed_date)) {
    $sql_search .= " and date_format(delivery_date, '%Y-%m-%d') >= '{$st_date}' and date_format(delivery_date, '%Y-%m-%d') <= '{$ed_date}' ";
} else if(!empty($st_date) && empty($ed_date)) {
    $sql_search .= " and date_format(delivery_date, '%Y-%m-%d') >= '{$st_date}' ";
} else if(empty($st_date) && empty(!$ed_date)) {
    $sql_search .= " and date_format(delivery_date, '%Y-%m-%d') <= '{$ed_date}' ";
}

// $sql_orderby = "order by delivery_date desc, ord.wr_datetime desc";
$sql_orderby = "order by do_name asc, order_name asc"; // 주문내역 가나다순 정렬

// 페이징
$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_orderby} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select ord.*, mb.mb_name {$sql_common} {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} "; // 주문내역
//if($private) { echo $sql; }
$rlt = sql_query($sql);
?>

<style>
    #hd, #hd_wrapper{background:#583206; color:#fff;}
    #hd #title{color:#fff;}
    #info{color:#fff; font-size:1.2em; padding:0px 20px; line-height:65px; text-align:left; position:fixed; left:35px; top:0; z-index:2000;}
    #sch .save_btn{border:1px solid rgba(255,255,255,0.6); background:none;}
    /*로딩*/
    #mask { position:fixed; z-index:9000; background-color:#000000; display:none; left:0; top:0; }
</style>

<div id="info"><i class="fas fa-biking"></i> <strong><?=$member['mb_id']?></strong>님의 배달내역</div>
<div id="sch">
    <form id="fsch" name="fsch" method="get">
    <select class="sch_input" id="cate" name="cate" onchange="document.fsch.submit();">
        <option value="" <?=$cate == "" ? "selected" : ""?>>전체</option>
        <option value="정기배달" <?=$cate == "정기배달" ? "selected" : ""?>>정기배달</option>
        <option value="행사용" <?=$cate == "행사용" ? "selected" : ""?>>행사용</option>
        <option value="샐러드팩" <?=$cate == "샐러드팩" ? "selected" : ""?>>샐러드팩</option>
    </select>
    <input type="date" id="st_date" name="st_date" class="sch_input" value="<?=empty($st_date) ? date('Y-m-d') : $st_date?>" onchange="document.fsch.submit();"/>~<input type="date" id="ed_date" name="ed_date" class="sch_input" value="<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" onchange="document.fsch.submit();"/>
    </form>
</div>
<div>
</div>
<div id="container">
    <div id="order_list" class="rd">
        <input type="hidden" id="page" name="page" value="1">
        <!--ajax.rider_list.php-->
        <ul class="ord_list">
            <?php
            while($row = sql_fetch_array($rlt)) {
                $do = sql_fetch(" select * from g5_dosirak where idx = '{$row['dosirak_idx']}' ");
                $mod_cls = ''; // 수정된 주문에 적용할 클래스
                if(empty($row['read_yn'])) { // 수정되기 전 이전 주문 건
                    $mod_cls = 'style="text-decoration:line-through;"';
                }

                // 주문일 - 수정된 주문은 수정일 표시
                $order_date = str_replace('-', '.', substr($row['wr_datetime'],0, 10));
                if($row['mod_yn'] == 'Y') {
                    $order_date = str_replace('-', '.', substr($row['up_datetime'], 0, 10));
                }

                $order_post = $row['order_post'] != '' ? '['.$row['order_post'].']' : '';

                // 도시락명 색상 설정
                if($private) {
                    $doColor = "style='color: #936125'";
                    if(!empty($do['rider_color'])) $doColor = "style='color: ".$do['rider_color']."'";
                }
            ?>
            <li onclick="location.href='<?=APP_URL?>/rider_order.php?idx=<?=$row['idx']?>'">
                <p class="title">
                    <span class="name"><?=$row['mb_name']?></span><strong <?=$doColor?>><?=$row['do_name']?> <?=number_format($row['order_amount'])?>개</strong><!--<span><?/*=$order_date*/?></span>-->
                </p>
                <?php if(!empty($row['order_memo'])) { ?><p class="memo"><strong>메모</strong> <?=$row['order_memo']?></p><?php } ?>
            </li>
            <!--<li onclick="location.href='<?/*=APP_URL*/?>/rider_order.php?idx=<?/*=$row['idx']*/?>'">
                <p class="title"><?/*=$row['do_name']*/?> <?/*=number_format($row['order_amount'])*/?>개</p>
                <p class="addr"><?/*=$order_post*/?> <?/*=$row['order_addr1'].' '.$row['order_addr2']*/?><span class="name"><?/*=$row['mb_name']*/?></span></p>
                <?php /*if(!empty($row['order_memo'])) { */?><p class="memo"><strong>메모</strong> <?/*=$row['order_memo']*/?></p><?php /*} */?>
            </li>-->
            <?php
            }
            if($total_count == 0) {
            ?>
            <div style="text-align: center;">주문내역이 없습니다.</div>
            <?php
            }
            ?>
        </ul>

        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&cate='.$cate.'&st_date='.$st_date.'&ed_date='.$ed_date.'&amp;page='); ?>

        <div id="paging"></div>
    </div>
</div>

<script>
    // 새로고침
    function refresh() {
        showLoading(); // 로딩

        location.reload();
    }

    // 로딩 표시
    function showLoading() {
        var maskHeight = $(document).height();
        var maskWidth = window.document.body.clientWidth;
        var mask = "<div id='mask'></div>";
        $('body').append(mask);
        $('#mask').css({'width': maskWidth, 'height': maskHeight, 'opacity': '0.3'})
        $('#mask').show();
    }

    // var cur_page = 1;
    // $(function() {
    //     orderList(cur_page);
    // });
    //
    // // 주문내역
    // function orderList(page) {
    //     if(page == undefined) { page = 1; }
    //     $('#page').val(page);
    //
    //     $.ajax({
    //         url: "./ajax.rider_list.php",
    //         type: "post",
    //         dataType: "html",
    //         data: {page: $('#page').val(), cate: $('#cate').val(), st_date: $('#st_date').val(), ed_date: $('#ed_date').val()},
    //         success: function(data) {
    //             if(data) {
    //                 $('.ord_list').html(data);
    //
    //                 cur_page = page;
    //                 document.location.hash = '#'+page;
    //
    //                 // 페이징 처리 -- 하단에 페이지 표시
    //                 ajaxGetPaging();
    //             }
    //         }
    //     });
    // }
    //
    // // 페이징 처리 -- 페이지 클릭 시 동작 이벤트
    // function getPage(page) {
    //     orderList(page);
    // }
</script>
<?php
include_once ("./app_tail.php");
?>
