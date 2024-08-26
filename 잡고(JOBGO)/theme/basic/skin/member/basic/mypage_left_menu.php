<?php

$sql = "select *from {$g5['profile_table']} where mb_id = '{$member['mb_id']}' ";
$profile = sql_fetch($sql);

if ($member['mb_division'] == 2 || $is_admin) { //재능인 일때
    $division = 'ta';
}else{
    $division = 'co';
}

//1:1 문의
$sql = "select count(comment_idx) cnt from new_comment co left join new_talent ta on co.wr_cp_idx = ta.ta_idx where {$division}.mb_id = '{$member['mb_id']}' and wr_parent = 0  and wr_table = 'talent' ";
$comment_cnt = sql_fetch($sql)['cnt'];
//총작업수
$sql = "select count(*) cnt from new_payment where seller_id = '{$member['mb_id']}' and status = '완료' ";
$talent_complete_cnt = sql_fetch($sql)['cnt'];
//의뢰인 만족도
$sql = "select IF(avg(rating) is null,'없음',CONCAT (ROUND(avg(rating),1),'점')) as avg from new_payment_review pr left join {$g5['talent_table']} ta on ta.ta_idx = pr.ta_idx where ta.mb_id = '{$member['mb_id']}' ";
$member_avg= sql_fetch($sql)['avg'];
//총 찜한 재능
$sql = " select count(li_idx) cnt from {$g5['like_table']} where mb_id = '{$member['mb_id']}' and li_table = 'talent' ";
$my_like_cnt = sql_fetch($sql);
//총 구매한 재능
$sql = "select count(*) cnt from new_payment where userId = '{$member['mb_id']}' and (charge != 'Y' or charge is null) and (ResultCode = 3001 or ResultCode = 4000)";
$talent_buy_cnt = sql_fetch($sql)['cnt'];
if ($member['mb_division'] == 2){ //재능인 일때?>
    <section id="left_view">
        <!--재능인정보-->
        <section class="mem_info">
            <!--사진-->
            <form id = 'imgfrm'>
                <input type="hidden" name="member_type" value="pro">

                <div class="myimg">
                <a href="#" class="btn_mod" onclick="file_click();" style="bottom: auto!important;"></a>
                <input type="file" name="mb_icon" id="mb_icon" onchange="getImgPrev(this);" accept="image/*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                <!-- 등록 이미지 있을 경우 -->
                <div class="p_box">
                    <div class="img_rd">
                        <?php
                        $mb_dir = substr($member['mb_id'],0,2);
                        $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$member['mb_id'].'.jpg';
                        if (file_exists($icon_file)) {
                            $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$member['mb_id'].'.jpg';
                            echo '<img src="'.$icon_url.'" alt="">';
//                        echo '</div><input style="float: bottom" type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1"> ※체크 후 확인을 누르면 삭제됩니다.';
                        }else{
                            echo '<img src="'.G5_THEME_IMG_URL.'/sub/default.png" alt="">';
                        }
                        ?>
                    </div>
                    <!--<button type="button" class="btn" style="position: absolute;bottom: 80px;border-radius: 100%;left: 80px;width: 30px;height: 30px;display: inline-block;">X</button>-->
                </div>
                    <p class="name"><i class="fal fa-user-tag"></i> <?= $member['mb_nick']?></p>
            </div>
            </form>
            <p class="text-center contact">
<!--                <span><i class="fas fa-star"></i>&nbsp;4.5</span>-->
                <span><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u"><i class="fas fa-user-edit"></i>&nbsp;정보수정</a></span>
                <a href="javascript:logout();""><span>로그아웃</span></a>
            </p>
            <div class="profile">
                <ul>
                    <li>
                        <dl>
                            <dt>총 작업수</dt>
                            <dd><?=$talent_complete_cnt?><span>건</span></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>의뢰인 만족도</dt>
                            <dd><i class="fas fa-star"></i><?=$member_avg?></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>평균응답시간</dt>
                            <dd><?= $pf_time_list[$profile['pf_time']] ?></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <p class="introduce">
                <?= $profile['pf_produce']?>
            </p>
            <p class="edit text-center"><a href="<?=G5_BBS_URL?>/register_expert_form03.php"><i class="fal fa-edit"></i>&nbsp;프로필 수정</a></p>
            <p class="edit text-center"><a href="<?=G5_BBS_URL.'/ajax.controller.php?division=1&mode=division_change'?>" style="margin:10px 0 0 !important"><i class="fal fa-user-circle"></i>&nbsp;일반인으로 변경</a></p>
        </section>
        <section class="my_nav">
            <ul><?php if ($is_private){?>

                    <?php if($member["mb_no"] != "31"){ ?>
                        <li><a href="javascript:chatting_list();">문의채팅 <span class="badge"><?=$no_read_badge?></span> </a></li>
                    <?php } ?>
                    <li><a href="<?=G5_BBS_URL?>/my_item.php">재능 관리</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_campaign.php">캠페인 관리</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_service.php">서비스 관리 <!--<span class="badge">--><?/*= $view_pf_pro_ctg3[0] != "" ? count($view_pf_pro_ctg3) : 0 */?></span></a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_review.php">받은 평가<!--<span class="badge"><?/*=$review_count*/?></span>--></a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_compete.php">공모전 관리 </a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_market.php">마켓 관리 </a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_jobs.php">구인구직 관리 </a></li>
                    <?php //ios심사
                    if ($user_agent != '/ioshappy100'){ ?>
                        <li><a href="<?=G5_BBS_URL?>/my_income.php">수익 관리</a></li>
                    <?php } ?>
                    <li><a href="<?=G5_BBS_URL?>/my_ad_list.php">광고 관리</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_ad_request.php">광고 신청</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_mileage.php">재능 마일리지</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice">고객센터</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_suggest_list.php" class="ico_sug2">추천가입목록</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/my_leave.php">회원 탈퇴</a></li>
                <?php } else /*$is_private*/{?>

                    <?php if($member["mb_no"] != "31"){ ?>
                        <li><a href="javascript:chatting_list();">문의채팅 <span class="badge"><?=$no_read_badge?></span> </a></li>
                    <?php } ?>
                    <li><a href="<?=G5_BBS_URL?>/my_item.php">재능 관리 <i class="fal fa-lightbulb-on"></i></a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_contest.php">공모전 관리 <i class="fal fa-trophy-alt"></i></a></li>
                    <!--<li><a href="<?/*=G5_BBS_URL*/?>/my_inquiry.php">문의글 보기</a></li>-->
                    <li><a href="<?=G5_BBS_URL?>/my_service.php">서비스 관리 <!--<span class="badge">--><?/*= $view_pf_pro_ctg3[0] != "" ? count($view_pf_pro_ctg3) : 0 */?></span></a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_review.php">받은 평가<!--<span class="badge"><?/*=$review_count*/?></span>--></a></li>
                    <li class="hidden-lg hidden-md hidden-sm"><a href="javascript:swal('알림 설정 준비중입니다.')">알림 설정</a></li>
                    <?php //ios심사
                    if ($user_agent != '/ioshappy100'){ ?>
                        <li><a href="<?=G5_BBS_URL?>/my_income.php">수익 관리</a></li>
                    <?php } ?>
                    <li><a href="<?=G5_BBS_URL?>/my_ad_list.php">광고 관리</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_ad_request.php">광고 신청</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_mileage.php">재능 마일리지</a></li>
                    <!--                <li><a href="">나의 재능 등급</a></li>-->
                    <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice">고객센터</a></li>
                    <!--                <li class="hidden-lg hidden-md hidden-sm"><a href="javascript:callApp_share()">친구에게 추천</a></li>-->
                    <li><a href="<?=G5_BBS_URL?>/my_suggest_list.php" class="ico_sug2">추천가입목록</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/my_leave.php">회원 탈퇴</a></li>
                <?php }?>
            </ul>
        </section>
    </section>

<? }else{ //일반인일때?>
    <section id="left_view">
        <!--재능인정보-->
        <section class="mem_info">
            <!--사진-->
            <form id = 'imgfrm'>
                <input type="hidden" name="member_type" value="pro">

                <div class="myimg">
                    <a href="#" class="btn_mod" onclick="file_click();" style="bottom: auto!important;"></a>
                    <input type="file" name="mb_icon" id="mb_icon" onchange="getImgPrev(this);" accept="image/*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                    <!-- 등록 이미지 있을 경우 -->
                    <div class="p_box">
                        <div class="img_rd">
                            <?php
                            $mb_dir = substr($member['mb_id'],0,2);
                            $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$member['mb_id'].'.jpg';
                            if (file_exists($icon_file)) {
                                $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$member['mb_id'].'.jpg?v='.get_session("version");
                                echo '<img src="'.$icon_url.'" alt="">';
//                        echo '</div><input style="float: bottom" type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1"> ※체크 후 확인을 누르면 삭제됩니다.';
                            }else{
                                echo '<img src="'.G5_THEME_IMG_URL.'/sub/default.png" alt="">';
                            }
                            ?>
                        </div>
                        <!--<button type="button" class="btn" style="position: absolute;bottom: 80px;border-radius: 100%;left: 80px;width: 30px;height: 30px;display: inline-block;">X</button>-->
                    </div>
                    <p class="name"><i class="fal fa-user-tag"></i> <?= $member['mb_nick']?></p>
                </div>
            </form>
            <p class="text-center contact">
                <span><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u"><i class="fas fa-user-edit"></i>&nbsp;정보수정</a></span>
                <span><a href="javascript:logout();">로그아웃</a></span>
            </p>
            <div class="profile" id="like_ul">
                <ul>
                    <li>
                        <dl>
                            <dt>총 찜한 재능</dt>
                            <dd><?=$my_like_cnt['cnt']?><span>건</span></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>총 구매한 재능</dt>
                            <dd><?=$talent_buy_cnt?><span>건</span></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>1:1 문의</dt>
                            <dd><?=$comment_cnt?><span>건</span></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <?php
            if (empty($profile['pf_idx']) ){?>
                <p class="edit text-center"><a href="<?=G5_BBS_URL.'/register_expert_form03.php'?>"><i class="fal fa-user-circle"></i>&nbsp;재능인 등록</a></p>
            <?php }else{ ?>
                <p class="edit text-center"><a href="<?=G5_BBS_URL.'/ajax.controller.php?division=2&mode=division_change'?>"><i class="fal fa-user-circle"></i>&nbsp;재능인으로 변경</a></p>
            <?php } ?>
        </section>
        <section class="my_nav">
            <ul><?php if ($is_private){?>
                    <?php if($member["mb_no"] != "31"){ ?>
                        <li><a href="javascript:chatting_list();">잡고채팅 <span class="badge"><?=$no_read_badge?></span> </a></li>
                    <?php } ?>
                    <li><a href="<?=G5_BBS_URL?>/my_item.php" <?php if($pid == 'my_item'){ echo "class='txt_color'"; } ?>>재능 관리</a></li>
                    <li><a href="my_campaign.php" <?php if($pid == 'my_campaign'){ echo "class='txt_color'"; } ?>>캠페인 관리</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_compete.php" <?php if($pid == 'my_compete'){ echo "class='txt_color'"; } ?>>공모전 관리 </a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_market.php" <?php if($pid == 'my_market'){ echo "class='txt_color'"; } ?>>마켓 관리 </a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_jobs.php" <?php if($pid == 'my_jobs'){ echo "class='txt_color'"; } ?>>구인구직 관리 </a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_income.php" <?php if($pid == 'my_income'){ echo "class='txt_color'"; } ?>>잡고 캐쉬</a></li>
                    <li><a href="javascript:swal('잡고 이용안내 준비중입니다.')">잡고 이용안내</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice">고객센터</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/my_leave.php">회원 탈퇴</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_suggest_list.php" class="ico_sug2">추천가입목록</a></li>
                <?php } else /*$is_private*/{?>
                    <?php if($member["mb_no"] != "31"){ ?>
                    <li><a href="javascript:chatting_list();">문의채팅 <span class="badge"><?=$no_read_badge?></span> </a></li>
                    <?php } ?>
                    <li><a href="<?=G5_BBS_URL?>/my_item.php">재능 관리 <i class="fal fa-lightbulb-on"></i></a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_contest.php">공모전 관리 <i class="fal fa-trophy-alt"></i></a></li>
                    <!--<li><a href="<?/*=G5_BBS_URL*/?>/my_inquiry.php">나의 문의 글</a></li>-->
                    <li class="hidden-lg hidden-md hidden-sm"><a href="javascript:swal('알림 설정 준비중입니다.')">알림 설정</a></li>
                    <li><a href="<?=G5_BBS_URL?>/my_income.php">잡고 캐쉬</a></li>
                    <!--<li><a href="">캐쉬 충전</a></li>-->
                    <li><a href="javascript:swal('잡고 이용안내 준비중입니다.')">잡고 이용안내</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice">고객센터</a></li>
                    <!-- <li class="hidden-lg hidden-md hidden-sm"><a href="javascript:callApp_share()">친구에게 추천</a></li> -->
                    <li><a href="<?php echo G5_BBS_URL ?>/my_leave.php">회원 탈퇴</a></li>
                   <!--  <li><a href="#" class="ico_sug">추천하기</a></li> -->
                    <li><a href="<?=G5_BBS_URL?>/my_suggest_list.php" class="ico_sug2">추천가입목록</a></li>
                <?php } ?>
            </ul>
        </section>

    </section>
<?php } ?>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script><!--페이스북로그인-->
<script>
    //이미지 미리보기

    function getImgPrev(input) {
        var regex = /(.*?)\.(jpg|jpeg|png|bmp|jfif|JPG)$/;
        var filesTempArr = [];

        if (!regex.test(input.files[0].name)) {
            swal("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp, jfif, JPG)");
            input.value = "";
            return false;
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var div = document.createElement('div'),
                    div_img = document.createElement('div'),
                    img = document.createElement('img');
                // btn = document.createElement('button');

                var el = $(input),
                    prev_area = el.nextAll("div.p_box"),
                    file_area = el.nextAll("div.wr_files");
                if (prev_area.length > 0) prev_area.remove();
                //if (file_area.length > 0) file_area.remove();

                div.setAttribute("class", "p_box");

                div_img.setAttribute("class", "img_rd");
                img.setAttribute("class", "p_img");
                img.setAttribute("src", e.target.result);
                img.setAttribute("style", "width:110px;height:110px;");

                // btn.setAttribute("type", "button");
                // btn.setAttribute("class", "btn");
                // btn.innerHTML = "X";

                div_img.appendChild(img);
                div.appendChild(div_img);
                // div.appendChild(btn);

                el.after(div);
            }
            reader.readAsDataURL(input.files[0]);

            var files = input.files;
            var files_arr = Array.prototype.slice.call(files);
            filesTempArr.push(files_arr);

            var form = $('#imgfrm')[0];
            var formData = new FormData(form);
            // formData.append("mb_icon", filesTempArr);
            formData.append("mode", "mb_icon_update");

            // 이미지 등록
            $.ajax({
                url : g5_bbs_url + "/ajax.controller.php",
                processData: false,
                contentType: false,
                data: formData,
                type: 'POST',
                success : function(data) {
                    if(data){
                        swal('사진 등록이 완료되었습니다.');
                        $('#del_file').val(data);
                    }else{
                        alert("통신에 실패했습니다.");
                    }
                },
                err : function(err) {
                    alert(err.status);
                }
            });
        }
    }

    function file_click() {

        $('#mb_icon').trigger('click');

    }

    function callApp_share() {
        var arg1 = "잡고 공유하기 ",
        arg2 = "<?=G5_URL?>",
        arg3 = "공유하기";
        console.log(arg1 + arg2 +arg3 )
        <?php if(0 < strpos($_SERVER['HTTP_USER_AGENT'],"IOSJobgo")){?>
        webkit.messageHandlers.shareHandler.postMessage(arg1+arg2);
        <?php }else{?>
        window.Android.doShare(arg1, arg2, arg3);
        <? }?>
    }

    $(function(){
        // FB.init 호출 (FB에서 여러 가지 로그인에 관한 상태를 설정하고 체크할 수 있는 메서드가 들어있음)
        window.fbAsyncInit = function () {
            if ('<?=$member['mb_sns']?>' == 'facebook') {
                FB.init({
                    appId: <?=$app_id?>, // 내 앱 ID를 입력한다.
                    cookie: true,
                    xfbml: true,
                    version: 'v11.0'
                });
                FB.AppEvents.logPageView();
            }
        }
    });

    // 로그아웃 (페이스북 사이트에서 로그인 필요, 잡고 재로그인 시 다시 페이스북 로그인하기 위하여)
    function logout() {
        if('<?=$member['mb_sns']?>' == 'facebook') { // 페이스북 사이트 로그아웃
            FB.getLoginStatus(function(response) {
                // alert(response.status);
                if(response.status === 'connected') {
                    FB.logout(function(response) {
                        if('<?=$android?>') {
                            window.Android.setLogout();
                        }
                        location.href="<?php echo G5_BBS_URL ?>/logout.php";
                    });
                }
            });
        }
        else {
            location.href="<?php echo G5_BBS_URL ?>/logout.php";
        }
        //아이폰은 바로 넘겨줘도 괜찮음
        location.href="<?php echo G5_BBS_URL ?>/logout.php";

    }

    // 채팅
    function chatting_list() {
        if('<?=$mobile?>') { // 모바일 웹 또는 안드로이드 접속 시
            location.href = g5_bbs_url + '/chat_list.php';
        } else {
            location.href = g5_bbs_url + '/message.php';
        }
    }
</script>