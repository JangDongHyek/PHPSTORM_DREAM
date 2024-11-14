<?php
global $pid;
$pid = "my_campaign";
$sub_id = "my_campaign";
include_once('./_common.php');

$g5['title'] = '체험단 관리';
include_once('./_head.php');
include_once("../jl/JlConfig.php");

$menu_name = "체험단";

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
$like_data = $like_model->get(array(
    "page" => $page,
    "limit" => $limit,
    "source" => "campaign"
));

$request_model->join("campaign","campaign_idx","idx");
$request_model->where("user_idx",$member['mb_no']);
if($category) $request_model->where("category",$category,"AND","campaign");
$request_data = $request_model->get(array(
    "page" => $page,
    "limit" => $limit,
    "source" => "campaign",
    "select" => "campaign_request.status AS request_status",
));

$request_model->join("campaign","campaign_idx","idx");
$request_model->where("user_idx",$member['mb_no']);
$request_model->where("status","선정");
if($category) $request_model->where("category",$category,"AND","campaign");
$ok_data = $request_model->get(array(
    "page" => $page,
    "limit" => $limit,
    "source" => "campaign",
    "select" => "campaign_request.update_date AS ok_date, campaign_request.idx AS request_idx, campaign_request.report_status",
    //"sql" => true
));

$modify_request = false;
foreach ($ok_data['data'] as $index => $d) {
    if($d['report_status'] == "수정요청") $modify_request = true;
}

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
            <h3>체험단 관리</h3>


            <div class="wrapper">
                <div class="tabs cf">
                <ul>
                    <li id="tab1"><a href="javascript:a_tab('1');">찜한 체험단<span class="badge"><?=$like_data['count']?></span></a></li>
                    <li id="tab2"><a href="javascript:a_tab('2');">신청 체험단<span class="badge"><?=$request_data['count']?></span></a></li>
                    <li id="tab3"><a href="javascript:a_tab('3');">체험단 선정<span class="badge"><?=$ok_data['count']?></span></a></li>
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

                                <?if(!$like_data['count']) {?>
                                <div class="text-center empty">
                                    <i class="fa-solid fa-lightbulb-exclamation"></i>
                                    <p>찜 목록이 없습니다.</p>
                                </div>
                                <?}?>
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
                                    switch ($d['request_status']) {
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
                                            break;
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
                            <?if(!$request_data['count']) {?>
                            <div class="text-center empty">
                                <i class="fa-solid fa-lightbulb-exclamation"></i>
                                <p>신청 목록이 없습니다.</p>
                            </div>
                            <?}?>
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
                                            <p><?=explode(" ", $d['ok_date'])[0]?> | 활동 종료 <?=$d['activity_date']?></p>
                                        </div>
                                        <a href="<?php echo G5_BBS_URL ?>/campaign_view.php?idx=<?=$d['idx']?>">
                                            <div class="tit"><?=$d['subject']?></div>
                                            <div class="txt_color"><?=$d['company_name']?></div>
                                        </a>
                                    </div>
                                    <div class="btn_wrap">
                                        <button type="button" class="btn btn_gray btn_large" data-toggle="modal" href="#campaignInfo" onclick="getCampaign('<?=$d['idx']?>')">
                                            활동 안내
                                        </button>
                                        <? if($d['report_status'] == "수정요청") {?>
                                        <button type="button" class="btn btn_red btn_large" data-toggle="modal" href="#campaignSubmit" onclick="getRequest('<?=$d['request_idx']?>')">
                                            수정 요청
                                        </button>
                                        <? }else if($d['report_status'] == "보고완료") {?>
                                        <button type="button" class="btn btn_gray3 btn_large">
                                            활동 완료
                                        </button>
                                        <? }else {?>
                                        <button type="button" class="btn btn_color btn_large" data-toggle="modal" href="#campaignSubmit" onclick="getRequest('<?=$d['request_idx']?>')">
                                            완료 보고
                                        </button>
                                        <? }?>



                                    </div>
                                </div><!--thm-->
                                <?}?>

                                <?if(!$ok_data['count']) {?>
                                <div class="text-center empty">
                                    <i class="fa-solid fa-lightbulb-exclamation"></i>
                                    <p>선정 목록이 없습니다.</p>
                                </div>
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
                    <textarea readonly id="activity_guide">활동안내</textarea>
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
                    <h4 class="modal-title">체험단 완료 보고</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <div class="box box_red" id="comment_box">
                        <textarea id="update_comment" readonly></textarea>
                    </div>
                    <p>활동 링크 <span class="txt_color">* 일반 체험단 필수 (구매평 체험단 제외)</span></p>
                        <input type="text" id="activity_link" placeholder="활동 링크를 작성해주세요">


                        <p>활동 사진 <span class="txt_color">* 구매평 체험단 필수</span></p>
                        <div class="flex">
                            <input type="text" id="fileName" readonly placeholder="작성한 후기 캡처본을 업로드해주세요.">
                            <label type="button" for="fileInput" class="btn btn_gray btn_h40">파일 선택</label>
                            <input type="file" class="hide" id="fileInput"> <!--숨김처리 바람-->
                        </div>

                    <p>추가 설명</p>
                    <textarea placeholder="설명을 작성하세요." id="description"></textarea>

                    <script>
                        document.getElementById('fileInput').addEventListener('change', function() {
                            var fileName = this.files[0].name;
                            document.getElementById('fileName').value = fileName;
                        });
                    </script>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="putRequest()">제출하기</button>
                </div>
            </div><!--//modal-content-->
        </div>

    </div>
    <!-- // 완료보고 모달창 -->

<? $jl->jsLoad();?>
<script>
    const jl = new Jl();
    let request_idx = ""
    async function putRequest() {
        let data = {
            idx : request_idx,
            activity_link : document.getElementById("activity_link").value,
            description : document.getElementById("description").value,
            report_date : "now()",
            report_status : "보고"
        }

        if(document.getElementById("fileInput").files[0]) data.activity_image = document.getElementById("fileInput").files[0];

        try {
            let res = await jl.ajax("update",data,"/api/campaign_request.php");
            alert("보고를 완료했습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }

    async function getRequest(idx) {
        try {
            let filter = {idx : idx}

            let res = await jl.ajax("get",filter,"/api/campaign_request.php");

            request_idx = res.data[0].idx;
            document.getElementById("activity_link").value = res.data[0].activity_link;
            document.getElementById("description").value = res.data[0].description;
            document.getElementById("update_comment").textContent = res.data[0].update_comment;
            if(res.data[0].activity_image) document.getElementById('fileName').value = res.data[0].activity_image.name;
            else document.getElementById('fileName').value = ''

            if(res.data[0].report_status == "수정요청") {
                $("#comment_box").show();
            }else {
                $("#comment_box").hide();
            }
        }catch (e) {
            alert(e.message)
        }
    }

    async function getCampaign(idx) {
        try {
            let filter = {idx : idx}
            let res = await jl.ajax("get",filter,"/api/campaign.php");
            document.getElementById("activity_guide").textContent = res.data[0].activity_guide;
        }catch (e) {
            alert(e.message)
        }
    }
</script>

<script>
    function putText(text) {
        document.getElementById("activity_guide").textContent = text;

    }

    function a_tab(id) {
        location.href = g5_bbs_url + "/my_campaign.php?tab="+id
    }

</script>
<?php
include_once('./_tail.php');
?>