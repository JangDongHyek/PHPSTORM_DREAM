<?php
$pid = "rider_order";
include_once("./app_head.php");
/**
 * 기사 - 주문현황 상세내역
 */
if($member['mb_level'] != 3) {
    alert('올바른 경로가 아닙니다.');
}
$row = sql_fetch(" select ord.*, mb.mb_name from g5_order as ord left join g5_member as mb on mb.mb_id = ord.mb_id where idx = '{$idx}' ");
// 주문일 - 수정된 주문은 수정일 표시
$order_date = str_replace('-', '.', substr($row['wr_datetime'],0, 10));
if($row['mod_yn'] == 'Y') {
    $order_date = str_replace('-', '.', substr($row['up_datetime'], 0, 10));
}

$order_post = $row['order_post'] != '' ? '['.$row['order_post'].']' : '';
?>
<style>
#hd, #hd_wrapper{background:#583206; color:#fff;}
#hd #title{color:#fff;}
#info{color:#fff; font-size:1.2em; padding:0px 20px; line-height:65px; text-align:left; position:fixed; left:35px; top:0; z-index:2000;}
#sch .save_btn{border:1px solid rgba(255,255,255,0.6); background:none;}
</style>
<div id="info"><i class="fas fa-biking"></i> <strong><?=$member['mb_id']?></strong>님의 배달내역</div>
<!--<div id="sch">
    <form id="fsch" name="fsch" method="get">
    <select class="sch_input" id="cate" name="cate" onchange="orderList()">
        <option value="" <?/*=$cate == "" ? "selected" : ""*/?>>전체</option>
        <option value="정기배달" <?/*=$cate == "정기배달" ? "selected" : ""*/?>>정기배달</option>
        <option value="행사용" <?/*=$cate == "행사용" ? "selected" : ""*/?>>행사용</option>
        <option value="샐러드팩" <?/*=$cate == "샐러드팩" ? "selected" : ""*/?>>샐러드팩</option>
    </select>
    <input type="date" id="st_date" name="st_date" class="sch_input" value="<?/*=$st_date */?>" onchange="orderList();"/>~<input type="date" id="ed_date" name="ed_date" class="sch_input" value="<?/*=empty($ed_date) ? date('Y-m-d') : $ed_date*/?>" onchange="orderList();"/>
    </form>
</div>-->
<div>
</div>
<div id="container">
    <div id="order_list">
        <input type="hidden" id="page" name="page" value="1">
        <ul class="ord_list">
            <?php if($row['order_category'] == '정기배달' || $row['order_category'] == "샐러드팩") { ?>
            <li>
                <div class="title">
                    <h2 <?=$mod_cls?>>
                        <?=$row['order_category']?> 도시락
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
                    <dd><?=$order_post?> <?=$row['order_addr1'].' '.$row['order_addr2']?></dd>
                </dl>
                <dl class="date">
                    <dt>업체명&현장명</dt>
                    <dd><?=$row['mb_name']?></dd>
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
            <?php } else { ?>
            <li>
                <div class="title">
                    <h2><?=$ord['order_category']?> 도시락<span>주문날짜 <?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span></h2>

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
                    <dt>업체명&현장명</dt>
                    <dd><?=$row['mb_name']?></dd>
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
            <?php } ?>
        </ul>
    </div>
</div>

<!--<script>
    $(function() {
       orderList();
    });

    // 주문내역
    function orderList(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url: "./ajax.rider_order_list.php",
            type: "post",
            dataType: "html",
            data: {page: $('#page').val(), cate: $('#cate').val(), st_date: $('#st_date').val(), ed_date: $('#ed_date').val()},
            success: function(data) {
                if(data) {
                    $('.ord_list').html(data);

                    // 페이징 처리 -- 하단에 페이지 표시
                    ajaxGetPaging();
                }
            }
        });
    }

    // 페이징 처리 -- 페이지 클릭 시 동작 이벤트
    function getPage(page) {
        orderList(page);
    }
</script>-->
<?php
include_once ("./app_tail.php");
?>
