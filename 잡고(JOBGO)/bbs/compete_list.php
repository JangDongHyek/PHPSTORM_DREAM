<?php
global $pid;
$pid = "compete_list";
$sub_id = "compete_list";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

//공모전 데이터
$model = new JlModel(array(
    "table" => "compete",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$limit = 10;
$page = $_GET['page'] ? $_GET['page'] : 1;
$model->orderBy("insert_date","DESC");
$data = $model->get(array(
    "page" => $page,
    "limit" => $limit,
));
$total_page = ceil($data['count'] / $limit);

// 공모전 좋아요
if($member['mb_no']) {
    $compete_like = new JlModel(array("table" => "compete_like"));
    $getLike = $compete_like->where("user_idx",$member['mb_no'])->get()['data'];

    $likes = array();
    foreach ($getLike as $index => $d) {
        array_push($likes,$d['compete_idx']);
    }
}

$g5['title'] = '공모전';
include_once('./_head.php');
?>

    <div id="banner" class="black mt0">
        <h6><b class="txt_color3">공모전 서비스 리뉴얼!</b></h6>
        <h6 class="txt_bold2 txt_white">자신있는 공모전에 마음껏 도전해요</h6>
        <h6 class="txt_thin txt_white"><i class="fa-regular fa-award"></i> 공모전 우승시 상금 혜택</h6>
        <button type="button" class="btn btn_black" onclick="location.href='<?php echo G5_URL ?>/new_compete.php'">공모전 안내 <i class="fa-solid fa-right"></i></button>
    </div>

    <div id="goods">
        <!--  공모전  -->
        <div class="in">
            <div class="list">
                <?php
                foreach($data['data'] as $index => $d) {
                    $heart = "off";
                    if(in_array($d['idx'],$likes,true)) $heart = "on";



                    $low_money = 0;
                    $high_money = 0;
                    $peoples = 0;

                    foreach($d['prize'] as $index2 => $p) {
                        $peoples += $p['people'];
                        //if(!$index2) {
                        //    $low_money = $p['money'];
                        //    $high_money = $p['money'];
                        //    $peoples = $p['people'];
                        //    continue;
                        //}
                        //
                        //if($low_money > $p['money']) $low_money = $p['money'];
                        //if($high_money < $p['money']) $high_money = $p['money'];
                        //if($peoples < $p['people']) $peoples = $p['people'];
                    }
                    ?>
                    <div class="thm">
                        <div class="mg">
                            <a href="<?php echo G5_BBS_URL ?>/compete_view.php?idx=<?=$d['idx']?>">
                                <div class="mg_in">
                                    <div class="over">
                                        <?if(count($d['thumb'])) {?>
                                            <img src="<?=$jl->URL.$d['thumb'][0]['src']?>">
                                        <?}else {?>
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                                        <?}?>
                                    </div>
                                </div><!--상품사진-->
                            </a>
                        </div><!--mg-->
                        <div class="info">
                            <div class="heart" name="">
                                <button type="button" class="heart <?=$heart?>" onclick="postLike('<?=$d['idx']?>')"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_<?=$heart?>.png" alt="좋아요off" title="좋아요off"></button>
                            </div>
                            <div id="lecture_writer_list">
                                <div class="mb flex gap5 ai-c">
                                    <!--<p>카테고리</p>-->
                                </div>
                            </div>
                            <a href="<?php echo G5_BBS_URL ?>/compete_view.php?idx=<?=$d['idx']?>">
                                <div class="tit"><?=$d['subject']?></div>
                                <div class="txt_color">최대 <?=$peoples?>인 상품 증정</div>
                                <div class="price"><?=$d['prize'][0]['money'] ? $d['prize'][0]['rank']." : ".$d['prize'][0]['money'] : "상품이없습니다." ?></div>
                            </a>
                        </div>
                    </div><!--thm-->

                <?php } ?>
            </div><!--list-->
        </div><!--in-->

    </div><!--goods-->

    <nav class="pg_wrap">
        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?menu='.$_GET['menu'].'&amp;page='); ?>
    </nav>

<? $jl->jsLoad(); ?>

    <script>
        const jl = new Jl();
        const user_idx = "<?=$member['mb_no']?>";
        async function postLike(idx) {
            try {
                if(!user_idx) return false;
                let obj = {
                    user_idx : user_idx,
                    compete_idx : idx
                }

                let res = await jl.ajax("insert",obj,"/api/compete_like.php");
                window.location.reload();
            }catch (e) {
                alert(e)
            }
        }
    </script>
<?php
include_once('./_tail.php');
?>