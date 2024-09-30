<?php
$pid = "cal_order_view";
include_once("./app_head.php");
/**
 * 22.05.20
 * 행사용 도시락 주문내역 (new)
 */
?>
<div id="sch">
    <form id="fsch" name="fsch" method="get">
        <select class="sch_input" id="cate" name="cate">
            <option value="행사용" <?=$cate == "행사용" ? "selected" : ""?>>행사용</option>
        </select>
        <input type="date" id="st_date" name="st_date" class="sch_input" value="<?=$st_date ?>" onchange="orderList();"/>~<input type="date" id="ed_date" name="ed_date" class="sch_input" value="<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" onchange="orderList();"/>
    </form>
</div>
<div>
</div>
<div id="container">
    <div id="order_list">
        <!--ajax.cal_order_list.php-->
        <ul class="ord_list"></ul>
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
            url: "./ajax.cal_order_list.php",
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
