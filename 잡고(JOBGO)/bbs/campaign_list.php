<?php
include_once("../jl/JlConfig.php");
global $pid;
$pid = $_GET['menu'];
$sub_id = "campagin_list";
include_once('./_common.php');

switch ($_GET['menu']) {
    case "sns" :
        $category = "SNS";
        $title = "SNS 포스팅";
        break;
    case "design" :
        $category = "디자인";
        $title = "디자인";
        break;
    case "exp" :
        $category = "체험단";
        $title = "체험단";
        break;
    default :
        $title = "Exception";
        break;
}
$g5['title'] = $title;

//캠페인 데이터
$model = new JlModel(array(
    "table" => "campaign",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));
$model->where("category",$category);

$limit = 10;
$page = $_GET['page'] ? $_GET['page'] : 1;
$data = $model->get($page,$limit);
$total_page = ceil($data['count'] / $limit);

// 캠페인 좋아요
if($member['mb_no']) {
    $campaign_like = new JlModel(array(
        "table" => "campaign_like",
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    ));
    $getLike = $campaign_like->where("user_idx",$member['mb_no'])->get()['data'];

    $likes = array();
    foreach ($getLike as $index => $d) {
        array_push($likes,$d['campaign_idx']);
    }
}

// 캠페인 선장자
$request_model = new JlModel(array(
    "table" => "campaign_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));


include_once('./_head.php');
?>

    <div id="vueContent">
        <div id="banner" class="black mt0">
            <h6><b class="txt_color3">대학생에게 필요한 ○○</b></h6>
            <h6 class="txt_bold2 txt_white">용돈, 알바, 대외활동!</h6>
            <h6 class="txt_thin txt_white">잡고가 함께 해요</h6>
            <button type="button" class="btn btn_black" onclick="location.href='<?php echo G5_URL ?>/new_cpn_service.php'">새로워진 잡고 <i class="fa-solid fa-right"></i></button>
        </div>

        <div id="goods">
            <!--  캠페인  -->
            <div class="in">
                <div class="list">
                    <?php
                    foreach ($data['data'] as $index => $d) {
                        $heart = "off";
                        if(in_array($d['idx'],$likes,true)) $heart = "on";

                        $request_model->where("campaign_idx",$d['idx']);
                        $select = $request_model->where("status","선정")->get()['count'];
                        ?>
                        <div class="thm">
                            <div class="mg">
                                <a href="<?php echo G5_BBS_URL ?>/campaign_view.php?idx=<?=$d['idx']?>">
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
                                        <div class="count">
                                            <b class="txt_color"><?=$select?></b>/<?=$d['recruitment']?>
                                        </div>
                                        <p><?=$d['status']?></p>
                                    </div>
                                </div>
                                <a href="<?php echo G5_BBS_URL ?>/campaign_view.php?idx=<?=$d['idx']?>">
                                    <div class="tit"><?=$d['subject']?></div>
                                    <div class="txt_color"><?=$d['company_name']?></div>
                                </a>
                            </div>
                        </div><!--thm-->

                    <?php } ?>
                </div><!--list-->
            </div><!--in-->

        </div><!--goods-->

        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?menu='.$_GET['menu'].'&amp;page='); ?>

        <!--<nav class="pg_wrap">-->
        <!--    <span class="pg" id="emo_pg"></span>-->
        <!--</nav>-->
    </div>

<? $jl->jsLoad(); ?>

<script>
const jl = new Jl();
const user_idx = "<?=$member['mb_no']?>";
async function postLike(idx) {
    try {
        if(!user_idx) return false;
        let obj = {
            user_idx : user_idx,
            campaign_idx : idx
        }

        let res = await jl.ajax("insert",obj,"/api/campaign_like.php");
        window.location.reload();
    }catch (e) {
        alert(e)
    }
}
</script>

<?php
include_once('./_tail.php');
?>