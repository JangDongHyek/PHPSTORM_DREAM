<?php
$pid = "class_list";
include_once("./app_head.php");
$g5_write_class_model = new JlModel("g5_write_class_report");

$total = $g5_write_class_model->get()['count'];

$week = $g5_write_class_model->addSql(" and YEARWEEK(wr_2, 1) = YEARWEEK(CURDATE(), 1)")->get()['count'];
?>
    <div id="class" class="list">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./class'"><i class="fa-solid fa-arrow-left"></i> 속회방 메인</button>
        <div class="slogan">
            <h6>속회 예배 현황
            <span>이번주 예배 드린 속 <b><?=$week?></b>개속 / 전체 150개속 중</span>
        </div>
        <div class="grid grid3">
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=1교구'"><i class="fa-solid fa-group-arrows-rotate"></i>1교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=2교구'"><i class="fa-solid fa-group-arrows-rotate"></i>2교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=3교구'"><i class="fa-solid fa-group-arrows-rotate"></i>3교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=4교구'"><i class="fa-solid fa-group-arrows-rotate"></i>4교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=5교구'"><i class="fa-solid fa-group-arrows-rotate"></i>5교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=6교구'"><i class="fa-solid fa-group-arrows-rotate"></i>6교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=7교구'"><i class="fa-solid fa-group-arrows-rotate"></i>7교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=8교구'"><i class="fa-solid fa-group-arrows-rotate"></i>8교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=9교구'"><i class="fa-solid fa-group-arrows-rotate"></i>9교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=10교구'"><i class="fa-solid fa-group-arrows-rotate"></i>10교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=11교구'"><i class="fa-solid fa-group-arrows-rotate"></i>11교구</button>
            <button class="btn" type="button" onclick="location.href='./class_list_view?wr_7=12교구'"><i class="fa-solid fa-group-arrows-rotate"></i>12교구</button>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>