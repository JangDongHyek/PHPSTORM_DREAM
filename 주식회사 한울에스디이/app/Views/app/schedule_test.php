<!-- 작업관리 > 계획공정표 -->
</div>
<div class="schedule">
    <div class="flex ai-c jc-sb">
        <div class="area_filter">
            <input type="search" name="stx" placeholder="검색어 입력" value=""><button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
        </div>
        <div class="btn_wrap">
            <button class="btn btn_small btn_blueline" data-toggle="modal" data-target="#sectionModal">작업구역관리</button>
            <button class="btn btn_small btn_darkblue"><img src="<?=base_url()?>img/common/excel_blue.svg"> 가져오기</button>
            <button class="btn btn_small btn_line"><img src="<?=base_url()?>img/common/excel_green.svg"> 내보내기</button>
        </div>
    </div>
<section class="any_gantt">
    <!--간트 차트-->
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-bundle.min.js"></script>
    <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
  <script src="<?=base_url()?>js/gantt-chart.js"></script>

    <div id="container"></div>

</section>
<style>
    .title_wrap{padding: 14px 40px 0; margin-bottom: 0;}
    .title_wrap h2{margin-bottom: 14px;}
    .page-wrapper .page-content > div{padding: 0;}
    .container-fluid .lnb{margin-bottom: 0;}
    footer{display: none;}
</style>

