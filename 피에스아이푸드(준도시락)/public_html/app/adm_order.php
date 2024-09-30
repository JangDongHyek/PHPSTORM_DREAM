<?php
$pid = "adm_order";
include_once("./app_head.php");
/**
 * 관리자 태블릿 - 주문내역
 */

header('Refresh: 300'); // 5분마다 새로고침
?>
<style>
#hd, #hd_wrapper{background:#583206; color:#fff;}
#container{padding:0;}
#hd #title{color:#fff;}
#info{color:#fff; font-size:1.2em; padding:0px 20px; line-height:65px; text-align:left; position:fixed; left:35px; top:0; z-index:2000;}
#sch .save_btn{border:1px solid rgba(255,255,255,0.6); background:none;}
#order_list .ord_list li{padding:15px 20px;}
#order_list .ord_list li:nth-child(odd){ background:#fff; }
#order_list .menu{margin-bottom:5px;}
#order_list .memo{margin-bottom:0;}
</style>

<div id="sch">
    <form id="fsch" name="fsch" method="get">
    <select class="sch_input" id="cate" name="cate" onchange="orderList()">
        <option value="" <?=$cate == "" ? "selected" : ""?>>전체</option>
        <option value="정기배달" <?=$cate == "정기배달" ? "selected" : ""?>>정기배달</option>
        <option value="행사용" <?=$cate == "행사용" ? "selected" : ""?>>행사용</option>
        <option value="샐러드팩" <?=$cate == "샐러드팩" ? "selected" : ""?>>샐러드팩</option>
    </select>
    <input type="date" id="st_date" name="st_date" class="sch_input" value="<?=empty($st_date) ? date('Y-m-d') : $st_date?>" onchange="orderList();"/>~<input type="date" id="ed_date" name="ed_date" class="sch_input" value="<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" onchange="orderList();"/>
</div>
<div>
</div>
<div id="container">
    <div id="order_list">
        <input type="hidden" id="page" name="page" value="1">
        <!--ajax.adm_order_list.php-->
        <ul class="ord_list"></ul>

        <div id="paging"></div>
    </div>
</div>

<script>
    $(function() {
       orderList();

       // setTimeout(function() {
       //     location.reload();
       // }, 10000);
    });

    // 주문내역
    function orderList(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url: "./ajax.adm_order_list.php",
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