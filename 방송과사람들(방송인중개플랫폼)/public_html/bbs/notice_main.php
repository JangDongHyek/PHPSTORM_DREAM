<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$name = "notice_main";
$pid = "notice_main";
$g5['title'] = '고객센터';
include_once('./_head.php');
?>


<section class="notice_main">
    <?
    $model = new JlModel("g5_write_notice");

    $rows = $model->get(array("page"=>1,"limit" => 3))['data'];
    ?>
    <div class="notice_list">
        <div class="title">
            <h6>공지사항</h6>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <ul>
            <? foreach($rows as $row) {?>
            <li>
                <a href="./board.php?bo_table=notice&wr_id=<?=$row['wr_id']?>"><p><?=$row['wr_subject']?></p></a>
                <span><?=explode(' ',$row['wr_datetime'])[0]?></span>
            </li>
            <?}?>
        </ul>
    </div><!--notice_list-->

    <?
    $model = new JlModel("g5_write_faq");

    $rows = $model->get(array("page"=>1,"limit" => 3))['data'];
    ?>
    <div class="faq_list">
        <div class="title">
            <h6>자주 찾는 질문</h6>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=faq"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <ul>
            <? foreach($rows as $row) {?>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=faq"><p><?=$row['wr_subject']?></p></a>
            </li>
            <?}?>
        </ul>
    </div><!--faq_list-->
    <div class="qna_list">
        <div class="title">
            <h6>그 밖에 문의 사항이 있으신가요?</h6>
            <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <button class="qna-btn" onclick="location.href='<?php echo G5_BBS_URL ?>/write.php?bo_table=qna'"> 1:1 문의</button>
    </div><!--qna_list-->
</section>

<?
include_once('./_tail.php');
?>
