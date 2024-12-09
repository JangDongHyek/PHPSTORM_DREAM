<?php
$pid = "column_view";
include_once("./app_head.php");

$tbl_name = "column";
$idx = $_GET['idx'];

// 공지사항 상세
$sql = "SELECT * FROM g5_bbs_basic WHERE del_yn = 'N' AND tbl_name = '{$tbl_name}' AND idx = '{$idx}'";
$row = sql_fetch($sql);

if (!$row['idx']) alert("잘못된 접근입니다.");

// 첨부파일 가져오기
$files = getBbsFiles($tbl_name, $idx);

// 조회수++
if ($member['mb_no'] != $row['writer_no']) {
    $hit = $row['hit'] + 1;
    sql_query("UPDATE g5_bbs_basic SET hit = '{$hit}' WHERE idx = '{$idx}'");
}

?>
<div id="column_view" class="board view">
    <div class="area_top">
        <h3><strong><?=$row['category']?></strong><?=$row['subject']?></h3>
        <p class="date"><?=date("Y-m-d", strtotime($row['regdate']))?></p>
    </div>
    <div class="conts">
        <?
        // 첨부이미지 존재하면 출력
        if (count($files) > 0) {
            echo "<div id='bo_v_img'>";
            foreach ($files AS $key=>$val) {
                echo "<div><img src='{$val['source']}' style='max-width: 100%'></div>";
            }
            echo "</div>";
        }
        ?>

        <?=nl2br($row['content'])?>
    </div>
    <?php if ($is_admin) {  ?>
        <!--<div class="ft_btn">
            <p><a href="../app/column_form.php" class="btn line">수정</a></p>
        </div>-->
    <?php }  ?>
</div>


<?php
include_once ("./app_tail.php");
?>