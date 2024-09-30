<?php
$pid = "order_list";
include_once("./app_head.php");
/**
 * 주문내역
 */
goto_url(APP_URL.'/cal_order_list.php');
?>
<div id="sch">
    <form id="fsch" name="fsch" method="get">
    <select class="sch_input" id="cate" name="cate" onchange="orderList()">
        <option value="" <?=$cate == "" ? "selected" : ""?>>전체</option>
        <option value="정기배달" <?=$cate == "정기배달" ? "selected" : ""?>>정기배달</option>
        <option value="행사용" <?=$cate == "행사용" ? "selected" : ""?>>행사용</option>
        <option value="샐러드팩" <?=$cate == "샐러드팩" ? "selected" : ""?>>샐러드팩</option>
    </select>
    <input type="date" id="st_date" name="st_date" class="sch_input" value="<?=$st_date ?>" onchange="orderList();"/>~<input type="date" id="ed_date" name="ed_date" class="sch_input" value="<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" onchange="orderList();"/>
    <?php /*?><button><i class="far fa-search"></i></button><?php */?>
    </form>
    <?php if($is_ios) { // IOS -- 사파리에서 바로 다운받을 수 있게 하기 위하여 중간 링크 한번 거쳐서 감?>
    <a href="<?=APP_URL?>/excel.php?mb_id=<?=$member['mb_id']?>&cate=정기배달&st_date=<?=$st_date?>&ed_date=<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" class="save_btn"><i class="fas fa-save"></i> 주문내역 엑셀파일다운</a>
    <?php } else { //AOS?>
    <a href="<?=APP_URL?>/excel_download.php?mb_id=<?=$member['mb_id']?>&cate=정기배달&st_date=<?=$st_date?>&ed_date=<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" class="save_btn"><i class="fas fa-save"></i> 주문내역 엑셀파일다운</a>
    <?php } ?>
</div>
<div>
</div>
<div id="container">
    <div id="order_list">
        <input type="hidden" id="page" name="page" value="1">
        <!--ajax.order_list.php-->
        <ul class="ord_list"></ul>

        <div id="paging"></div>
    </div>
</div>

<script>
    $(function() {
       orderList();
    });

    // 주문내역
    function orderList(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url: "./ajax.order_list.php",
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
</script>
<?php
include_once ("./app_tail.php");
?>
