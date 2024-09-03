<?php
global $pid;
$pid = "my_campaign";
$sub_id = "my_campaign";
include_once('./_common.php');

$g5['title'] = '캠페인 관리';
include_once('./_head.php');
include_once("../jl/JlConfig.php");

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

$tab = $_GET['tab'] ? : 1;

$campaign_model = new JlModel(array(
    "table" => "campaign",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$like_model = new JlModel(array(
    "table" => "campaign_like",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

// 캠페인 선장자
$request_model = new JlModel(array(
    "table" => "campaign_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$limit = 8;
$page = $_GET['page'] ? $_GET['page'] : 1;

$like_model->join("campaign","campaign_idx","idx");
$like_model->where("user_idx",$member['mb_no']);
if($category) $like_model->where("category",$category,"AND","campaign");
$like_data = $like_model->get($page,$limit,"campaign");

$request_model->join("campaign","campaign_idx","idx");
$request_model->where("user_idx",$member['mb_no']);
if($category) $request_model->where("category",$category,"AND","campaign");
$request_data = $request_model->get($page,$limit,"campaign");

$request_model->join("campaign","campaign_idx","idx");
$request_model->where("user_idx",$member['mb_no']);
$request_model->where("status","선정");
if($category) $request_model->where("category",$category,"AND","campaign");
$ok_data = $request_model->get($page,$limit,"campaign");

switch ($tab) {
    case 1 :

        break;

    case 2 :

        break;
}

//캠페인 데이터




$total_page = ceil($data['count'] / $limit);

// 캠페인 좋아요
if($member['mb_no']) {

    $getLike = $like_model->where("user_idx",$member['mb_no'])->get()['data'];

    $likes = array();
    foreach ($getLike as $index => $d) {
        array_push($likes,$d['campaign_idx']);
    }
}



?>



    <article id="mypage">


        <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
            <h3>캠페인 관리</h3>

            <div class="wrapper">
                <div class="tabs cf">
                <ul>
                    <li id="tab1"><a href="javascript:a_tab('1');">찜한 캠페인<span class="badge"><?=$like_data['count']?></span></a></li>
                    <li id="tab2"><a href="javascript:a_tab('2');">신청 캠페인<span class="badge"><?=$request_data['count']?></span></a></li>
                    <li id="tab3"><a href="javascript:a_tab('3');">캠페인 선정<span class="badge"><?=$ok_data['count']?></span></a></li>
                </ul>

                <!--찜한 캠페인-->
                <div id="tab-content1" class="tab-content">
                    <div id="my_goods">
                        <!--  캠페인  -->
                        <div class="sort">
                            <ul>
                                <li id="li_all" class="<?=$_GET['menu'] == '' ? 'check' : '' ?>"><a href="?tab=1&menu=">전체</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'sns' ? 'check' : '' ?>"><a href="?tab=1&menu=sns">SNS</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'design' ? 'check' : '' ?>"><a href="?tab=1&menu=design">디자인</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'exp' ? 'check' : '' ?>"><a href="?tab=1&menu=exp">체험단</a></li>
                            </ul>
                        </div>
                        <div class="in">
                            <div class="list">
                                <?php
                                foreach ($like_data['data'] as $index => $d) {
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

                    </div><!--my_goods-->
                </div>

                <!--신청 캠페인-->
                <div id="tab-content2" class="tab-content box-article">
                    <div id="my_goods">
                        <!--  캠페인  -->
                        <div class="sort">
                            <ul>
                                <li id="li_all" class="<?=$_GET['menu'] == '' ? 'check' : '' ?>"><a href="?tab=2&menu=">전체</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'sns' ? 'check' : '' ?>"><a href="?tab=2&menu=sns">SNS</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'design' ? 'check' : '' ?>"><a href="?tab=2&menu=design">디자인</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'exp' ? 'check' : '' ?>"><a href="?tab=2&menu=exp">체험단</a></li>
                            </ul>
                        </div>
                        <div class="in">
                            <div class="list">
                                <?php
                                foreach ($request_data['data'] as $index => $d) {
                                    switch ($d['status']) {
                                        case "선정" :
                                            $class = "btn_line";
                                            $message = "선정";
                                            break;
                                        case "탈락" :
                                            $class = "btn_gray";
                                            $message = "미선정";
                                            break;
                                        case "신청취소?" :
                                            $class = "btn_color2";
                                            $message = "신청취소";
                                            break;
                                        default :
                                            $class = " btn_gray3";
                                            $message = "대기";
                                    }
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
                                            <div id="lecture_writer_list" class="flex jc-sb ai-c">
                                                <p><?=explode(" ",$d['insert_date'])[0]?> 신청</p>
                                                <button type="button" class="btn btn_mini <?=$class?>">
                                                    <?=$message?>
                                                </button>
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

                    </div><!--my_goods-->
                </div>

                <!--캠페인 선정-->
                <div id="tab-content3" class="tab-content">
                    <div id="my_list">
                        <div class="sort">
                            <ul>
                                <li id="li_all" class="<?=$_GET['menu'] == '' ? 'check' : '' ?>"><a href="?tab=3&menu=">전체</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'sns' ? 'check' : '' ?>"><a href="?tab=3&menu=sns">SNS</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'design' ? 'check' : '' ?>"><a href="?tab=3&menu=design">디자인</a></li>
                                <li id="li_all" class="<?=$_GET['menu'] == 'exp' ? 'check' : '' ?>"><a href="?tab=3&menu=exp">체험단</a></li>
                            </ul>
                        </div>
                        <div class="in">
                            <div class="list">
                            <?php
                                foreach ($ok_data['data'] as $index => $d) {
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
                                        <div class="flex ai-c gap5">
                                            <span class="icon icon_color2">
                                                선정
                                            </span>
                                            <p><?=$d['recruitment_date']?> | 활동 종료 <?=$d['activity_date']?></p>
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/campaign_view.php?idx=<?=$d['idx']?>">
                                            <div class="tit"><?=$d['subject']?></div>
                                            <div class="txt_color"><?=$d['company_name']?></div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_gray btn_large" data-toggle="modal" href="#campaignInfo">
                                            활동 안내
                                        </button>
                                        <button type="button" class="btn btn_color btn_large" data-toggle="modal" href="#campaignSubmit">
                                            완료 보고
                                        </button>
                                        <!--<button type="button" class="btn btn_gray3 btn_large">-->
                                        <!--    활동 완료-->
                                        <!--</button>-->
                                    </div>
                                </div><!--thm-->
                                <?}?>

                            </div><!--list-->
                        </div><!--in-->
                    </div>
                </div>

                </div><!--//tabs-->
            </div>
        </section>
    </article>

    <!-- 활동안내 -->
    <div class="modal fade" id="campaignInfo" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">캠페인 활동안내</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <p>활동안내</p>
                    <textarea readonly>활동안내</textarea>
                </div>

            </div><!--//modal-content-->
        </div>

    </div>
    <!-- // 활동안내 모달창 -->
    <!-- 완료보고 -->
    <div class="modal fade" id="campaignSubmit" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">캠페인 완료 보고</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <p>활동 링크</p>
                        <input type="text" id="" placeholder="활동 링크를 작성해주세요">

                    <p>추가 설명</p>
                    <textarea placeholder="설명을 작성하세요."></textarea>

                    <script>
                        document.getElementById('fileInput').addEventListener('change', function() {
                            var fileName = this.files[0].name;
                            document.getElementById('fileName').value = fileName;
                        });
                    </script>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">제출하기</button>
                </div>
            </div><!--//modal-content-->
        </div>

    </div>
    <!-- // 완료보고 모달창 -->
<script>

    function a_tab(id) {
        location.href = g5_bbs_url + "/my_campaign.php?tab="+id
    }

</script>
<?php
include_once('./_tail.php');
?>