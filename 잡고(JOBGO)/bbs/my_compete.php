<?php
global $pid;
$pid = "my_compete";
$sub_id = "my_compete";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

$menu_name = "공모전";

$compete_model = new JlModel(array(
    "table" => "compete",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$like_model = new JlModel(array(
    "table" => "compete_like",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

// 캠페인 선장자
$request_model = new JlModel(array(
    "table" => "compete_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

$limit = 8;
$page = $_GET['page'] ? $_GET['page'] : 1;

// 찜 데이터
$like_model->join("compete","compete_idx","idx");
$like_model->where("user_idx",$member['mb_no']);
$like_data = $like_model->get(array(
    "page" => $page,
    "limit" => $limit,
    "source" => "compete"
));

//신청데이터
$request_model->join("compete","compete_idx","idx");
$request_model->where("user_idx",$member['mb_no']);
$request_data = $request_model->get(array(
    "page" => $page,
    "limit" => $limit,
    "source" => "compete",
    "select" => "compete_request.idx AS request_idx, compete_request.insert_date AS request_insert_date",
));

$request_model->join("compete","compete_idx","idx");
$request_model->where("user_idx",$member['mb_no']);
$request_model->where("status","","AND NOT");
$request_model->where("status","탈락","AND NOT");
$ok_data = $request_model->get(array(
    "page" => $page,
    "limit" => $limit,
    "source" => "compete",
    "select" => "compete_request.update_date AS request_update_date, compete_request.idx AS request_idx, compete_request.status AS request_status, compete_request.insert_date AS request_insert_date",
    "sql" => true
));

// 캠페인 좋아요
if($member['mb_no']) {

    $getLike = $like_model->where("user_idx",$member['mb_no'])->get()['data'];

    $likes = array();
    foreach ($getLike as $index => $d) {
        array_push($likes,$d['compete_idx']);
    }
}


$g5['title'] = '공모전 관리';
include_once('./_head.php');

?>


    <article id="mypage">


        <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
            <h3>공모전 관리</h3>

            <div class="wrapper">
                <div class="tabs cf">
                    <ul>
                        <li id="tab1"><a href="javascript:a_tab('1');">찜한 공모전<span class="badge"><?=$like_data['count']?></span></a></li>
                        <li id="tab2"><a href="javascript:a_tab('2');">접수 공모전<span class="badge"><?=$request_data['count']?></span></a></li>
                        <li id="tab3"><a href="javascript:a_tab('3');">공모전 선정<span class="badge"><?=$ok_data['count']?></span></a></li>
                    </ul>

                    <!--찜한 공모전-->
                    <div id="tab-content1" class="tab-content">
                        <div id="my_goods">
                            <div class="in">
                                <div class="list">
                                    <?php
                                    foreach ($like_data['data'] as $index => $d) {
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
                                                    <button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>
                                                </div>
                                                <a href="<?php echo G5_BBS_URL ?>/compete_view.php?idx=<?=$d['idx']?>">
                                                    <div class="tit"><?=$d['subject']?></div>
                                                    <div class="txt_color">접수기한 | <?=explode(" ",$d['end_date'])[0]?></div>
                                                </a>
                                            </div>
                                        </div><!--thm-->
                                    <?php } ?>
                                    <?if(!$like_data['count']){?>
                                    <div class="text-center empty">
                                        <i class="fa-solid fa-lightbulb-exclamation"></i>
                                        <p>목록이 없습니다.</p>
                                    </div>
                                    <?}?>
                                </div><!--list-->
                            </div><!--in-->
                        </div><!--my_goods-->
                    </div>

                    <!--접수 공모전-->
                    <div id="tab-content2" class="tab-content box-article">
                        <div id="my_goods">
                            <div class="in">
                                <div class="list">
                                    <?php
                                    foreach ($request_data['data'] as $index => $d) {
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
                                                <div id="lecture_writer_list">
                                                    <p><?=explode(" ",$d['request_insert_date'])[0]?> 접수</p>
                                                </div>
                                                <a>
                                                    <div class="tit"><?=$d['subject']?></div>
                                                    <div class="flex jc-sb ai-c">
                                                        <button type="button" class="btn btn_mini w100 btn_color2" onclick="getRequest('<?=$d['request_idx']?>')">
                                                            접수 내용
                                                        </button>
                                                        <button type="button" class="btn btn_mini w100 btn_line" onclick="deleteRequest('<?=$d['request_idx']?>')">
                                                            접수 취소
                                                        </button>
                                                    </div>
                                                </a>
                                            </div>
                                        </div><!--thm-->

                                    <?php } ?>

                                    <?if(!$request_data['count']){?>
                                    <div class="text-center empty">
                                        <i class="fa-solid fa-lightbulb-exclamation"></i>
                                        <p>목록이 없습니다.</p>
                                    </div>
                                    <?}?>
                                </div><!--list-->
                            </div><!--in-->

                        </div><!--my_goods-->
                    </div>

                    <!--공모전 선정-->
                    <div id="tab-content3" class="tab-content">
                        <div id="my_list">
                            <div class="in">
                                <div class="list">
                                    <?php
                                    foreach ($ok_data['data'] as $index => $d) {
                                        $compete = $compete_model->where("idx",$d['idx'])->get()['data'][0];
                                        foreach($compete['prize'] as $index2 => $pp) {
                                            if($pp['rank'] == $d['request_status']) $prize = $pp;
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
                                            <div class="flex ai-c gap5">
                                                <p>접수 <?=explode(" ",$d['request_insert_date'])[0]?> | 발표 <?=explode(" ",$d['request_update_date'])[0]?></p>
                                            </div>
                                            <a href="<?php echo G5_BBS_URL ?>/compete_view.php?idx=<?=$d['idx']?>">
                                                <div class="tit"><?=$d['subject']?></div>
                                                <div class="txt_color">선정 상품 <?=$prize['money']?></div>
                                            </a>
                                        </div>
                                        <div class="btn_wrap">
                                            <button type="button" class="btn btn_gray btn_large" onclick="getRequest('<?=$d['request_idx']?>')">
                                                나의 작품
                                            </button>
                                            <button type="button" class="btn btn_color btn_large">
                                                <?=$d['request_status']?> 선정
                                            </button>
                                        </div>
                                    </div><!--thm-->
                                    <?}?>

                                    <?if(!$ok_data['count']){?>
                                    <div class="text-center empty">
                                        <i class="fa-solid fa-lightbulb-exclamation"></i>
                                        <p>목록이 없습니다.</p>
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

    <script>

        function a_tab(id) {
            location.href = g5_bbs_url + "/my_compete.php?tab="+id
        }

    </script>

    <!-- 접수 내용 -->
    <div class="modal fade" id="competeSubmit" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">접수 내용</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <p>제출 파일</p>
                    <div class="file-input-container" id="file_container">
                        <!--<input type="text" id="fileName" placeholder="파일을 선택해주세요" readonly>-->
                        <input type="file" id="fileInput" accept="*/*">
                    </div>

                    <p>추가 설명</p>
                    <textarea placeholder="설명을 작성하세요." readonly id="description"></textarea>

                </div>

            </div><!--//modal-content-->
        </div>

    </div>
    <!-- // 접수 내용 모달창 -->
<? $jl->jsLoad();?>
    <script>
        const jl = new Jl();
        let request_idx = ""

        const file_container = document.getElementById('file_container');

        async function deleteRequest(idx) {
            if(!confirm("정말 접수를 삭제하시겠습니까?")) return false;

            let data = {
                idx : idx
            }

            try {
                let res = await jl.ajax("delete",data,"/api/compete_request.php");
                alert("삭제를 완료했습니다.");
                window.location.reload();
            }catch (e) {
                alert(e.message)
            }
        }

        async function getRequest(idx) {
            try {
                let filter = {idx : idx}

                let res = await jl.ajax("get",filter,"/api/compete_request.php");

                request_idx = res.data[0].idx;
                document.getElementById("description").value = res.data[0].description;
                file_container.innerText = "";

                res.data[0].compete_file.forEach(function(item) {
                    var inputElement = document.createElement('input');
                    inputElement.type = 'text';
                    inputElement.value = item.name;
                    file_container.appendChild(inputElement);
                });
                //document.getElementById("fileName").value = res.data[0].compete_file[0].name;

                $("#competeSubmit").modal('show');
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
<?php

include_once('./_tail.php');
?>