<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");
$name = "event_promo";
$pid = "event_promo";
$g5['title'] = '이벤트&프로모션';
include_once('./_head.php');
?>


<section class="event_promo" id="app">

    <event-calendar mb_no="<?=$member['mb_no']?>"></event-calendar>

    <div class="fortune_check">
        <div class="title">
            <h6>오늘의 운세</h6>
        </div>
        <div class="fortune-btn" onclick="location.href='<?php echo G5_BBS_URL ?>/event_fortune'">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/fortune-00-1.jpg" class="hidden-xs">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/fortune-00.jpg" class="visible-xs">
            <div><i class="fa-solid fa-crystal-ball"></i> 오늘 운세 확인하기</div>
        </div>
    </div><!--fortune_check-->

    <?
    $model = new JlModel("g5_write_promo");

    $rows = $model->get(array("page"=>1,"limit" => 3))['data'];
    ?>
    <div class="promo_list">
        <div class="title">
            <h6>진행중인 프로모션</h6>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=promo"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <ul>
            <?
            $file_model = new JlModel("g5_board_file");
            foreach($rows as $row) {
                $file = $file_model->where("bo_table","promo")->where("wr_id",$row['wr_id'])->get()['data'][0];

                if($file) {
                    $src = G5_DATA_URL."/file/promo/".$file['bf_file'];
                }else {
                    $src = G5_THEME_IMG_URL."/app/visual01.jpg";
                }
            ?>
            <li>
                <a href="./board.php?bo_table=promo&wr_id=<?=$row['wr_id']?>"><img src="<?=$src?>"></a>
            </li>
            <?}?>
        </ul>
    </div><!--promo_list-->
</section>

<? $jl->vueLoad("app"); ?>
<? $jl->componentLoad("event"); ?>

<?
include_once('./_tail.php');
?>
