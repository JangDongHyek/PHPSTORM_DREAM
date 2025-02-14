<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if ($member["mb_level"] >= 9){
    goto_url(G5_ADMIN_URL);
}
// ** 업그레이드 안내 페이지로 이동 -- 업그레이드 완료 후 삭제 **
//if(!$private) {
//    goto_url(G5_URL . '/information.php');
//}

// 앱 접속 시 첫 화면 메인페이지로 이동 --

//    goto_url(G5_BBS_URL . '/login.php');
//}

// 프로필 승인 여부 확인 -- 미승인 시 프로필 작성완료 화면으로
//$mb = get_member($_SESSION['ss_mb_id']);
//if($mb['mb_approval'] != 'Y') {
//    goto_url(G5_BBS_URL . '/my_profile_end.php');
//}

include_once(G5_THEME_MOBILE_PATH.'/head.php');

// 팝업레이어 추가
if (defined('_INDEX_')) {
    include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}

// 22.02.04 업체 요청으로 일후일 후 소멸 적용 안함 (수정접수내역-일주일후에 만나 소멸건)
//// 만나 유효기간 확인
//if($is_member && !empty($member['expire_date']) && $member['expire_date'] != '0000-00-00') {
//    if($member['cw_point'] != 0 && ($member['expire_date'] < date('Y-m-d'))) { // 유효기간 일주일 지나면 만나 삭제
//        sql_query(" update g5_member set cw_point = 0, expire_date = '0000-00-00' where mb_id = '{$member['mb_id']}' ");
//        sql_query(" insert into g5_member_point set mb_id = '{$member['mb_id']}', point_category = '차감', point = '{$member['cw_point']}', acc_point = '0', point_content = '만나 유효기간 만료', wr_datetime = '".G5_TIME_YMDHIS."' ");
//    }
//}

$sql_add = '';
if($member['mb_join_type'] == '장애인') { $sql_add .= ' and mb_join_type = "장애인" '; }
else { $sql_add .= ' and mb_join_type != "장애인" '; }

//새로운 만남 23.05.30 mb_approval 승인안된거도 보이고 승인대기중이라 ALERT
//$sql_add .= ' and show_yn = "Y" ';

//23.04.04 같은교회사람 안보이게 빼주는거 wc
if($member['mb_id']){
    $sql = "select * from new_member_interview where mb_id = '{$member['mb_id']}' ";
    $mi = sql_fetch($sql);
    $sql = " select * from new_member_interview where mi_church1 = '{$mi['mi_church1']}'; "; // 내가 비노출 처리한 회원
    $result = sql_query($sql);
    $noshow2 = '';
    for($i=0; $row=sql_fetch_array($result); $i++) {
        $noshow2 .= '\''.$row['mb_id'].'\',';
    }
    $noshow2 = substr($noshow2, 0, -1);
    if(!empty($noshow2)) {
        $sql_add .= ' and mb_id not in ('.$noshow2.') ';
    }
}

//23.04.04 남자면 여자만보이고, 여자면 남자만 보이게 wc
if($member['mb_sex'] == "남"){
    $sql_add .= ' and mb_sex = "여" ';
}else if($member['mb_sex'] == "여"){
    $sql_add .= ' and mb_sex = "남" ';
}

//새로운 만남 23.05.30 mb_approval 승인안된거도 보이고 승인대기중이라 ALERT
//$sql = "select * from g5_member where mb_id != '{$member["mb_id"]}' and secret_member != 'Y' and mb_approval = 'Y' {$sql_add} order by mb_no desc limit 4";
// 23.06.01 새로운만남만 비공개애들도 보여지게..
$sql = "select * from g5_member where mb_id != '{$member["mb_id"]}'  and secret_member != 'Y' {$sql_add} order by mb_no desc limit 4";
$new_result = sql_query($sql);

$sql = "select * from g5_member where mb_id != '{$member["mb_id"]}'  and secret_member != 'Y' and mb_id not like 'test%' and mb_approval = 'Y'  {$sql_add} order by mb_no desc limit 4";
$approval_Y_result = sql_query($sql);

$sql = "select * from g5_member where mb_id != '{$member["mb_id"]}'  and secret_member != 'Y' and mb_id not like 'test%' and mb_approval = 'N'  {$sql_add} order by mb_no desc limit 4";
$approval_N_result = sql_query($sql);


//나를 위한 만남
$new_arr=[];
//먼저 연봉
if ($member["mb_salary"] != "") {
    $sql = "select * from g5_member where mb_id != '{$member["mb_id"]}' and secret_member != 'Y' and mb_approval = 'Y' and mb_sex != '{$member["mb_sex"]}' and mb_sex != '' and (mb_salary = '{$member["mb_salary"]}' or mb_school_sel = '{$member["mb_school_sel"]}') {$sql_add} order by mb_salary desc,mb_school_sel desc limit 6";
    $for_you_result = sql_query($sql);
    for ($i = 0; $row = sql_fetch_array($for_you_result); $i++) {
        $new_arr[] = $row;
    }
}

//취미
if (count($new_arr) < 6 ){
    $sql = "SELECT * from g5_member_hobby WHERE mb_no = '{$member["mb_no"]}' ";
    $hobby = sql_query($sql);

    $hobby_query = "where 1=1 and secret_member != 'Y' and mb_approval = 'Y' and mb_sex != '{$member["mb_sex"]}' and mb_sex != ''  and (";
    for ($a =0; $row = sql_fetch_array($hobby); $a++){
        $or = "or";
        if ($a == 0){
            $or = "";
        }
        $hobby_query .= $or." co_code = ".$row["co_code"]." ";
    }
    $hobby_query .= ")";
    for ($c =0; $c < count($new_arr); $c++){
        $member_query .= " and mem.mb_no != ".$new_arr[$c]["mb_no"];
    }


    $sql = "SELECT * from g5_member_hobby ho left join g5_member mem on ho.mb_no = mem.mb_no  ".$hobby_query.$member_query. " {$sql_add} GROUP by mem.mb_no limit ".(6-count($new_arr));
    $hobby_result = sql_query($sql);

    for ($b = 0;$row = sql_fetch_array($hobby_result);$b++){
        $new_arr[$i+$b] = $row;
    }
    if (count($new_arr) < 6 ){
        $mb_no_sql = "";
        //이미 배열에 있는 멤버가 아니여야함.
        for ($e = 0;$e < count($new_arr) ;$e++){
            $mb_no_sql .= " and mb_no != ".$new_arr[$e]["mb_no"];
        }

        $sql = "select * from g5_member mem
                where secret_member != 'Y' and mb_approval = 'Y' and mb_id != '{$member["mb_id"]}' and mb_sex != '{$member["mb_sex"]}' and mb_sex != ''
                {$member_query} {$mb_no_sql} {$sql_add} order by mb_no desc limit ".(6-count($new_arr));
        $for_you_result = sql_query($sql);
        for ($d = 0; $row = sql_fetch_array($for_you_result); $d++) {
            $new_arr[$i+$b+$d] = $row;
        }
    }


}


?>

<!--
<style>
#member_list .memb .face .mg img {
    -webkit-filter: blur(4.5px) !important;
    -moz-filter: blur(4.5px) !important;
    -o-filter: blur(4.5px) !important;
    -ms-filter: blur(4.5px) !important;
    filter: blur(4.5px) !important;
}
</style>
-->

<!--<script src="https://cdn.multiappcross.kr/sdk/js/multi.min.js"> </script>-->
<?php //print_r("dtdtd");
//exit; ?>

<style type="text/css">
    #divpop {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 0px;
        width: auto;
        height: auto;
        z-index: 1000;
        border: 1px solid #000000;
        visibility: visible;
    }

    #divpop img {
        width: 330px
    }

    #pop_link {
        color: #fff;
        font-size: 11px
    }

    #pop_link a {
        color: #fff;
    }

    #pop_link a:hover {
        color: #FF0000;
    }


    .slick-slide img {
        width: 100%;
    }

    .slide_wrap {
        border-radius: 30px 0;
        overflow: hidden;
        box-shadow: 0px 0px 10px rgb(255 0 234 / 20%);
    }

    .slick-dots {
        bottom: 8px;
    }

    .slick-dots li {
        width: 8px;
        height: 8px;
        margin: 0 4px;
    }

    .slick-dots li button {
        width: 8px;
        height: 8px;
        padding: 0;
    }

    .slick-dots li button:before {
        content: '';
        line-height: inherit;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #fff;
        line-height: 8px;
        border: 1px solid #fe8ea6;
        opacity: 1;
    }

    .slick-dots li.slick-active button:before {
        background: #fe8ea6;
        opacity: 1;
    }
    #ft{
        background: #aaa;
    }




    /*	팝업 스타일*/
    .area_secret {}

    .area_secret ul {
        padding: 10px 0 0;
    }

    .area_secret ul > li {
        position: relative;
        display: block;
        text-align: left;
        margin: 0 0 7px;
    }

    .area_secret ul > li i {
        position: absolute;
        top: 0;
        left: 0;
        display: inline-block;
        font-style: normal;
        width: 20px;
        height: 20px;
        line-height: 22px;
        background: #6390f7;
        font-size: 10px;
        font-weight: bold;
        text-align: center;
        color: #fff;
        border-radius: 50px;
        box-sizing: border-box;
    }

    .area_secret ul > li span {
        display: block;
        padding: 0 0 0 27px;
        font-size: 14px;
        font-weight: 400;
        color: #555;
        line-height: 1.5em;
    }
    .modal-dialog {
        position: absolute;
        width: 100%;
        margin: 10px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) !important;
    }
</style>

<script language=JavaScript>
    $(function() {
        // CrossSdk.init("10000125", "c4f482c101c040d99996ffaca872af4c");
        // setTimeout(function (){
        //     CrossSdk.openModal({
        //         width: 400,
        //         // positionX: 300,
        //         // positionY: 200,
        //         // closeBtn: false,
        //         // modal: false,
        //         // clickRefresh: true,
        //         // clickClose: true
        //     });
        // }, 500);
    });

    //쿠키설정
    function setCookie(name, value, expiredays) {
        var todayDate = new Date();
        todayDate.setDate(todayDate.getDate() + expiredays);
        document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }

    //창닫기(레이어)
    function closeWin() {
        if (document.notice_form.chkbox.checked) {
            setCookie("maindiv", "done", 2);
        }
        document.all['divpop'].style.visibility = "hidden";
    }

</script>

<script LANGUAGE="JavaScript">
    function showLayer() {
        document.all.divpopS.style.visibility = "visible";
    }

    function hideLayer() {
        document.all.divpop.style.visibility = "hidden";
    }

</script>

<!--레이어팝업-->
<!--<div id="divpop" class="layer_popup1">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="top" class="handler"><img src="<?php /*echo G5_THEME_IMG_URL */?>/pop/pop_img.jpg" border="0" usemap="#pop_map"></td>
        </tr>
        <tr>
            <td height="30" bgcolor="#3F3F3F">
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <form name="notice_form" id="notice_form">
                        <tr>
                            <td height="30" align="center">
                                <input type="checkbox" value="checkbox" name="chkbox"/>
                                <span id="pop_link">오늘 하루 열지 않습니다.&nbsp;&nbsp;<a href="javascript:closeWin();">[ X CLOSE ]</a></span>
                            </td>
                        </tr>
                    </form>
                </table>
            </td>
        </tr>
    </table>
</div>
<script language=Javascript>
    cookiedata = document.cookie;
    if (cookiedata.indexOf("maindiv=done") < 0) {
    } else {
        document.all['divpop'].style.visibility = "hidden";
    }
</script>-->




<!--앱업데이트 모달-->
<div id="basic_modal">
    <div class="modal fade" id="appupdateModal" tabindex="-1" role="dialog" aria-labelledby="appupdateModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fas fa-map-marker-exclamation"></i> 업데이트 안내</h4>
                </div>
                <div class="modal-body">
                    <strong class="point">크리스찬 시그널 앱이 업데이트되었습니다.</strong><br>
                    새로운 크리스찬시그널을 만나보세요!
                </div>
                <div class="modal-footer">
                    <a href="https://play.google.com/store/apps/details?id=co.kr.itforone.naimwedding2" target="_blank" class="btn btn-default">
                    	앱 업데이트 바로가기
                    </a>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->




<?php if($mb['mb_profile'] == 'N') { ?>
    <!-- 프로필 작성하기 모달팝업 -->
    <div id="basic_modal">
        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fas fa-map-marker-exclamation"></i> 프로필을 작성해 주세요</h4>
                    </div>
                    <div class="modal-body">
                        프로필을 작성하셔야<br />크리스찬시그널에서 제공하는<br /><strong class="point">모든 컨텐츠 이용</strong>이 가능합니다.
                    </div>
                    <div class="modal-footer">
                        <a href="<?=G5_BBS_URL.'/my_profile01.php'?>" class="btn btn-default">프로필 작성하기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--basic_modal-->
    <!-- 프로필 작성하기 모달팝업 -->
<?php } ?>

<!-- 관심있어요 모달팝업 -->
<div id="basic_modal" class="greet">
    <!-- Modal -->
    <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">인사말씀 올립니다.</h4>
                </div>
                <div class="modal-body">
                    <strong>할렐루야!</strong>
                    지금 우리가 살고 있는 시대는 결혼 적령기도 없어지고 결혼도 하지 아니하는 혼탁한 세상에 살고 있는 시대가 되었습니다.
                    혼자 사는 것이 편하고 결혼의 필요성을 못 느끼다 보니 결혼에 관심이 없기도 하고, 결혼하고 싶으나 배우자를 찾지 못하고 방황하는 경우도 있고, 결혼과 진배없는 삶을 살면서도 결혼만 하지 않는 경우도 있고 여러 가지 이유로
                    결혼을 뒤로 미루고 결정하지 못하게 되는 시대가 되어 버리고 말았습니다.<br /><br />
                    하나님께서는 아담에게 하와를 허락하셨듯, 남자와 여자가 만나 사랑을 나누고 결혼을 하는 것은 하나님의 섭리이며 이치입니다.<br />
                    우리는 사랑의 결실로 하나님께 순종하는 마음으로 결혼을 결정하고 하나님의 섭리에 순종해야 합니다. 현실적으로 가정을 이루고 자녀를 낳는 것이 두렵거나 자신이 없다 해도 결혼은 하나님의 섭리에
                    순종하는 것입니다.<br />
                    예레미야 29장 6절에 '아내를 맞이하여 자녀를 낳으며 너희 아들이 아내를 맞이하여 너희 딸이 남편을 맞아 그들로 자녀를 낳게 하여 너희가 거기에서 번성하고 줄어들지 아니하게 하라'에 이어서 11절에
                    '너희에게 미래와 희망을 주는 것'이라고 약속하고 계십니다.<br /><br />
                    우리는 이 땅에서 예레미야 말씀처럼 사랑의 결실로 가정을 이루고 자녀를 낳아서 이 땅에서 하나님의 섭리에 순종하는 삶을 살아내야 하는 것입니다.<br />
                    그것이 하나님께서 진정으로 기뻐하고 축복 주시는 삶입니다.<br />
                    하나님이 아브라함에게 이삭을 번제로 바치라 했을 때 바로 순종했고 그 결과 아브라함은 엄청난 부와 하늘의 별을 셀 수 없을 만큼의 후손을 허락하셨습니다.<br />
                    또 노아에게 방주를 지으라 했을 때 현실 가능성이 없음에도 노아는 방주를 만들어 순종해서 노아의 가족과 각종 가축들이 살아남는 기적이 있었습니다.<br />
                    하나님의 명령에 순종했을 때 하나님은 수많은 이적과 기적을 이루셨습니다.<br />
                    지금은 우리가 하나님의 섭리에 순종하고 결혼을 결정할 때입니다. <br />
                    이땅에서 하나님의 나라가 확장되며 하나님의 뜻이 이루어지기를 소망하고 소망합니다.<br />
                    <div class="sg">크리스찬 시그널 대표 문소희</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">창닫기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--basic_modal-->
<!-- 관심있어요 모달팝업 -->



<div id="mb_main">
    <div class="slide_wrap">
        <?php
        $sql = "select * from new_adm_banner where ba_use = 1 and ba_place = 'top' and '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time order by ba_number desc";
        $banner = sql_query($sql);
        for($i=0;$row=sql_fetch_array($banner);$i++){



            ?>
            <a class="slide_box" <?php if($row['ba_new_tab']){ ?> onclick="window.open('<?=$row['ba_link']?>')" <?php }else{ ?> onclick="location.href='<?=$row['ba_link']?>'" <?php } ?> <?php if(!$row['ba_link']){ echo 'style="pointer-events: none"'; }?>>
                <img src="<?php echo G5_DATA_URL ?>/banner/<?=$row['image']?>" alt="" >
            </a>

        <?php } ?>
        <!--
        <a class="slide_box">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/slide_img01.jpg" alt="">
        </a>
        <a class="slide_box">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/slide_img02.jpg" alt="">
        </a>

		<a class="slide_box">
			<img src="<?php echo G5_THEME_IMG_URL ?>/app/m_banner01.jpg" alt="">
		</a>
		<a class="slide_box">
			<img src="<?php echo G5_THEME_IMG_URL ?>/app/m_banner02.jpg" alt="">
		</a>
-->
    </div>

    <?php if ($is_member) { ?>
    <?php } else { ?>
        <div class="login_sec">
            <h2 class="tit">서비스 이용을 위해<br>지금 바로 <span class="point">로그인</span>하세요!</h2>
            <ul>
                <li class="login">
                    <a href="<?php echo G5_BBS_URL ?>/login.php">로그인<i class="fas fa-lock-alt"></i></a>
                </li>
                <li class="register">
                    <a href="<?php echo G5_BBS_URL ?>/register.php">회원가입<i class="fas fa-sign-in"></i></a>
                </li>
            </ul>
        </div>
    <?php } ?>

    <div class="section02">
        <div class="tit">
            <h2>승인대기중 회원</h2>
            <a class="more_view" href="./bbs/mem_new.php?mb_approval=N">리스트</a>
        </div>
        <ul class="user_list">
            <?php
            for($i = 0; $row = sql_fetch_array($approval_N_result); $i++){


                $img_name = ($row["mb_sex"] == "남") ? "1" : "2";

                if ($row["mb_8"] == 2){
                    $row["mb_nick"] = "탈퇴한 회원";
                    $row["mb_name"] = "O";
                }

                //23.05.30 승인안된사람보이고 클릭하면 대기중뜨게
                if($row["mb_approval"] != 'Y'){
                    $href = "javascript:swal('승인대기중입니다.')";
                }else{
                    $href = G5_BBS_URL.'/mem_view.php?mb_no='.$row["mb_no"];
                }

                ?>

                <li class="user_box">
                    <a href="<?=$href?>">
                        <div class="top">
                            <div class="thumb">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/app/img_cover0<?=$img_name?>.png" alt="">
                            </div>
                            <div class="profile_info">
                                <h6><?=$row["mb_nick"]?></h6>
                                <p>
                                    <?=substr($row["mb_name"], 0, 3)?>OO
                                    <span class="line"></span>
                                    <?=$row["mb_sex"]?>
                                    <!-- 회원나이-->
                                    <span class="line"></span>
                                    <?php

                                    if($row['mb_birth']){
                                        // 생년월일로 나이 계산
                                        $birthyear_mb = substr($row['mb_birth'],0,4);
                                        $nowyear_mb = date("Y");
                                        $age_mb = $nowyear_mb - $birthyear_mb + 1;
                                    }else{
                                        $age_mb = "-";
                                    }
                                    ?>
                                    <!--
                                    <?=$age_mb?>살
                                    -->
                                </p>
                            </div>
                        </div>
                        <div class="con">
                            <p>
                                <?=$row["mb_introduce"] ?>
                            </p>
                        </div>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </div>

    <div class="section02">
        <div class="tit">
            <h2>승인된 활동회원</h2>
            <a class="more_view" href="./bbs/mem_new.php">리스트</a>
        </div>
        <ul class="user_list">
            <?php
            for($i = 0; $row = sql_fetch_array($approval_Y_result); $i++){


                $img_name = ($row["mb_sex"] == "남") ? "1" : "2";

                if ($row["mb_8"] == 2){
                    $row["mb_nick"] = "탈퇴한 회원";
                    $row["mb_name"] = "O";
                }

                //23.05.30 승인안된사람보이고 클릭하면 대기중뜨게
                if($row["mb_approval"] != 'Y'){
                    $href = "javascript:swal('승인대기중입니다.')";
                }else{
                    $href = G5_BBS_URL.'/mem_view.php?mb_no='.$row["mb_no"];
                }

                ?>

                <li class="user_box">
                    <a href="<?=$href?>">
                        <div class="top">
                            <div class="thumb">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/app/img_cover0<?=$img_name?>.png" alt="">
                            </div>
                            <div class="profile_info">
                                <h6><?=$row["mb_nick"]?></h6>
                                <p>
                                    <?=substr($row["mb_name"], 0, 3)?>OO
                                    <span class="line"></span>
                                    <?=$row["mb_sex"]?>
                                    <!-- 회원나이-->
                                    <span class="line"></span>
                                    <?php

                                    if($row['mb_birth']){
                                        // 생년월일로 나이 계산
                                        $birthyear_mb = substr($row['mb_birth'],0,4);
                                        $nowyear_mb = date("Y");
                                        $age_mb = $nowyear_mb - $birthyear_mb + 1;
                                    }else{
                                        $age_mb = "-";
                                    }
                                    ?>
                                    <!--
                                    <?=$age_mb?>살
                                    -->
                                </p>
                            </div>
                        </div>
                        <div class="con">
                            <p>
                                <?=$row["mb_introduce"] ?>
                            </p>
                        </div>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </div>

    <div class="section02">

        <?php if ($is_member && $member["mb_approval"] == "Y"){?>
            <div class="tit">
                <h2>나를 위한 만남</h2>
            </div>
            <ul class="user_list">
                <?php for ($i=0; $i < count($new_arr); $i++){
                    $img_name = ($new_arr[$i]["mb_sex"] == "남") ? "1" : "2"; ?>
                    <li class="user_box">
                        <a href="<?=G5_BBS_URL.'/mem_view.php?mb_no='.$new_arr[$i]["mb_no"]?>">
                            <div class="top">
                                <div class="thumb">
                                    <img src="<?php echo G5_THEME_IMG_URL ?>/app/img_cover0<?=$img_name?>.png" alt="">
                                </div>
                                <div class="profile_info">
                                    <h6><?=$new_arr[$i]["mb_nick"]?></h6>
                                    <p>
                                        <?=substr($new_arr[$i]["mb_name"], 0, 3)?>OO
                                        <span class="line"></span>
                                        <?=$new_arr[$i]["mb_sex"]?>
                                        <span class="line"></span>
                                        <?php
                                        if($new_arr[$i]['mb_birth']){
                                            // 생년월일로 나이 계산
                                            $birthyear_mb = substr($new_arr[$i]['mb_birth'],0,4);
                                            $nowyear_mb = date("Y");

                                            $age_mb = $nowyear_mb - $birthyear_mb + 1;
                                        }else{
                                            $age_mb = "-";
                                        }
                                        ?>
                                        <!--
                                        <?=$age_mb?>살
                                        -->
                                    </p>
                                </div>
                            </div>
                            <div class="con">
                                <p>
                                    <?=$new_arr[$i]["mb_introduce"] ?>
                                </p>
                            </div>
                        </a>
                    </li>
                <?php }
                if ($i == 0){ ?>
                    <li>추천 회원이 없습니다.</li>

                <?php } ?>

            </ul>
        <?php } ?>
    </div>
    <!--
	<h2 class="title"><strong>결혼은,</strong>하나님의 섭리에 순종하는 것이다.</h2>
    <div class="bg1"><img src="<?php echo G5_THEME_IMG_URL ?>/app/m_bg1.png" /></div>
    <div class="bg2"><img src="<?php echo G5_THEME_IMG_URL ?>/app/m_bg3.png" /></div>
    <div class="bg3"><img src="<?php echo G5_THEME_IMG_URL ?>/app/m_bg2.png" /></div>
    <div class="cont2">
<strong>할렐루야!</strong>
지금 우리가 살고 있는 시대는 결혼 적령기도 없어지고 결혼도 하지 아니하는 혼탁한 세상에 살고 있는 시대가 되었습니다.
혼자 사는 것이 편하고 결혼의 필요성을 못 느끼다 보니 결혼에 관심이 없기도 하고, 결혼하고 싶으나 배우자를 찾지 못하고 방황하는 경우도 있고, 결혼과 진배없는 삶을 살면서도 결혼만 하지 않는 경우도 있고 여러 가지 이유로
결혼을 뒤로 미루고 결정하지 못하게 되는 시대가 되어 버리고 말았습니다.<br /><br />
하나님께서는 아담에게 하와를 허락하셨듯, 남자와 여자가 만나 사랑을 나누고 결혼을 하는 것은 하나님의 섭리이며 이치입니다.<br />
우리는 사랑의 결실로 하나님께 순종하는 마음으로 결혼을 결정하고 하나님의 섭리에 순종해야 합니다. 현실적으로 가정을 이루고 자녀를 낳는 것이 두렵거나 자신이 없다 해도 결혼은 하나님의 섭리에
순종하는 것입니다.<br />
예레미야 29장 6절에 '아내를 맞이하여 자녀를 낳으며 너희 아들이 아내를 맞이하여 너희 딸이 남편을 맞아 그들로 자녀를 낳게 하여 너희가 거기에서 번성하고 줄어들지 아니하게 하라'에 이어서 11절에
'너희에게 미래와 희망을 주는 것'이라고 약속하고 계십니다.<br /><br />
우리는 이 땅에서 예레미야 말씀처럼 사랑의 결실로 가정을 이루고 자녀를 낳아서 이 땅에서 하나님의 섭리에 순종하는 삶을 살아내야 하는 것입니다.<br />
그것이 하나님께서 진정으로 기뻐하고 축복 주시는 삶입니다.<br />
하나님이 아브라함에게 이삭을 번제로 바치라 했을 때 바로 순종했고 그 결과 아브라함은 엄청난 부와 하늘의 별을 셀 수 없을 만큼의 후손을 허락하셨습니다.<br />
또 노아에게 방주를 지으라 했을 때 현실 가능성이 없음에도 노아는 방주를 만들어 순종해서 노아의 가족과 각종 가축들이 살아남는 기적이 있었습니다.<br />
하나님의 명령에 순종했을 때 하나님은 수많은 이적과 기적을 이루셨습니다.<br />
지금은 우리가 하나님의 섭리에 순종하고 결혼을 결정할 때입니다. <br />
이땅에서 하나님의 나라가 확장되며 하나님의 뜻이 이루어지기를 소망하고 소망합니다.<br />
    </div>
    <div class="sign">크리스찬시그널 대표 문소희<span><img src="<?php echo G5_THEME_IMG_URL ?>/app/sign.png" /></span></div>
-->
</div>
<!--#mb_main-->
<div class="section02 st2">
    <div class="container">
        <div class="banner_sec">
            <div class="eventslide_wrap">
                <?php
                $sql = "select * from new_adm_banner where ba_use = 1 and ba_place = 'btm' and '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time order by ba_number desc";
                $banner = sql_query($sql);
                for($i=0;$row=sql_fetch_array($banner);$i++){

                    ?>
                    <a class="event_banner" <?php if($row['ba_new_tab']){ ?> onclick="window.open('<?=$row['ba_link']?>')" <?php }else{ ?> onclick="location.href='<?=$row['ba_link']?>'" <?php } ?> <?php if(!$row['ba_link']){ echo 'style="pointer-events: none"'; }?>>
                        <img src="<?php echo G5_DATA_URL ?>/banner/<?=$row['image']?>" alt="" >
                    </a>

                <?php } ?>
                <!--
                <a class="event_banner" href="<?php echo G5_BBS_URL ?>/attend_check.php">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/app/m_banner03.jpg" alt="">
                </a>
                <a class="event_banner">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/app/event_banner01.png" alt="">
                </a>

                <a class="event_banner">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/app/event_banner02.png" alt="">
                </a>
                -->
            </div>

            <!--            회원가입비 안내버튼-->
            <a data-toggle="modal" class="btn joinInfo" data-target="#userModal">
                회원가입비
                <i class="fas fa-angle-right"></i>
            </a>
            <a data-toggle="modal" class="btn secret_joinInfo" data-target="#secret_userModal">
                시크릿회원가입비
                <i class="fas fa-angle-right"></i>
            </a>
            <ul>
                <li class="blog" onclick="location.href='https://m.blog.naver.com/PostList.naver?blogId=cwsignal'">
                    <a href="https://m.blog.naver.com/PostList.naver?blogId=cwsignal" target="_blank">블로그<i class="fas fa-angle-right"></i></a>
                </li>
                <li class="mbti">
                    <a href="<?php echo G5_BBS_URL ?>/mbti.php">나와 잘맞는 MBTI<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="ft_copy">
    <dl>
        <dt>고객센터</dt>
        <dd>070-4414-2258 (문자가능)<br>010-6523-2258 (문자가능)</dd>
    </dl>
    <dl>
        <dt>통화시간</dt>
        <dd>11:00 ~ 15:00<br>(월요일 휴무)</dd>
    </dl>
    <dl>
        <dt>문자가능시간</dt>
        <dd>09:00 ~ 17:00</dd>
    </dl>
    <dl>
        <dt>점심시간</dt>
        <dd>12:00 ~ 13:00</dd>
    </dl>
</div>

<div id="member_list" style="display:none;">
    <h3>Member Story<span>크리스찬시그널과 인연이 될 회원님들을 소개합니다.</span></h3>
    <div class="memb">
        <?php
        // 최근 가입한 회원 3명 -- 시크릿 회원은 제외
        // 21.06.29 장애인 회원은 장애인 회원만 조회
        $sql_add = '';
        if($member['mb_join_type'] == '장애인') { $sql_add .= ' and mb_join_type = "장애인" '; }
        else { $sql_add .= ' and mb_join_type != "장애인" '; }
        $sql = " select * from {$g5['member_table']} where mb_level = '2' and mb_approval = 'Y' and (secret_member is null or secret_member = '') and show_yn = 'Y'  {$sql_add} order by mb_no desc limit 3 ";
        $result = sql_query($sql);

        $bg = '';
        $default_img = '';
        for($i=0; $mb=sql_fetch_array($result); $i++) {
            // 성별에 따라 폰트 색상 및 디폴트 이미지 변경
            if($mb['mb_sex'] == '여')  $bg = 'fe'; else $bg = 'male';
            if($mb['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';

            // 직업
            $sql = " select co_main_code_value from g5_code where co_code_name = '사회적 역할' and co_code = '{$mb['mb_social_role']}' ";
            $job = sql_fetch($sql)['co_main_code_value'];

            // 프로필 이미지 (첫번째 사진 한장)
            $sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by thumb is null asc, idx limit 1";
            $file = sql_fetch($sql);

            // 생년월일로 나이 계산
            $birthyear = substr($mb['mb_birth'],0,4);
            $nowyear = date("Y");
            $age = $nowyear - $birthyear + 1;
            ?>
            <div class="list cf <?php if($i==1) { echo 'right'; } ?>">
                <?php if($i!=1) { ?>
                    <div class="face">
                        <div class="mg">
                            <?php if(isset($file['img_file'])) { ?>
                                <!-- <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />-->
                                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/img_cover01.png" />
                            <?php } else { ?>
                                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="info">
                    <h2 class="nick"><?=$mb['mb_nick']?></h2><!-- 닉네임 -->
                    <div class="simp_info"><span><?=$mb['mb_live_si']?> <?=$mb['mb_live_gu']?></span>/<span><?=$age?>세</span>/<span><?=$job?></span></div> <!-- 사는곳/나이/직업 -->
                    <div class="con"><?=$mb['mb_introduce']?></div>
                    <!--소개글 2줄정도 추출-->
                </div>
                <?php if($i==1) { ?>
                    <div class="face">
                        <div class="mg">
                            <?php if(isset($file['img_file'])) { ?>
                                <!--<img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" />-->
                                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/img_cover02.png" />
                            <?php } else { ?>
                                <img src="<?php echo G5_THEME_IMG_URL; ?>/app/<?=$default_img?>" />
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
        ?>
    </div>
    <a href="<?php echo G5_BBS_URL ?>/mem_new.php" class="view">더 많은 멤버보기 <i class="fas fa-plus-circle"></i></a>
</div>
<!--member_list-->

<!--
<div id="mb_ban">
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/banner.png" />
</div>

<div style="text-align: center;margin: 10px;">
    <span>국민 856901 00 022192 문소희</span>
</div>
-->

<script>
    /*$(function() {
    // 프로필 미작성 시 모달
<?php if($mb['mb_profile'] == 'N') { ?>
    $('#myModal3').modal('show');
    <?php } ?>
});

$('#myModal3').on('hide.bs.modal', function(e){
    location.href = '<?=G5_BBS_URL.'/my_profile01.php'?>';
   e.stopImmediatePropagation();
});*/

    // 관심있어요
    function member_love(mb_no, mb_nick) {
        $.ajax({
            type: 'POST',
            url: g5_bbs_url + "/ajax.reg_member_love.php",
            data: {
                mb_no: mb_no
            },
            success: function(data) {
                if (data == 'success') {
                    $('#myModal2 .nick').text(mb_nick);
                    $('#myModal2 .modal-body').html('<strong class="nick">' + mb_nick + '</strong> 회원님을 관심회원으로 등록하였습니다.');
                } else {
                    $('#myModal2 .modal-body').text('이미 관심회원으로 등록된 회원입니다.');
                }
                $('#myModal2').modal('show');
            }
        });
    }



    $('.slide_wrap').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true,
    });

    $('.eventslide_wrap').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true,
    });


    function setFcmToken(token, mb_id="", type=""){
        var os = deviceModel();;
        if(mb_id == "") mb_id = "<?=$member[mb_id]?>";
        if(type == "") type = os;
        $.post("<?=G5_URL?>/bbs/ajax_token_update2.php",{"token":token},function(data){

        });
    }

    function deviceModel(){
        let currentOS;
        const mobile = (/iphone|ipad|ipod|android/i.test( navigator.userAgent.toLowerCase() ));
        if (mobile){
            const userAgent = navigator.userAgent.toLowerCase();
            if (userAgent.search("android") > -1) {
                currentOS = "android";
            } else if ((userAgent.search("iphone") > -1) || (userAgent.search("ipod") > -1) || (userAgent.search("ipad") > -1)) {
                currentOS = "ios";
            } else {
                currentOS = "other";
            }
        } else {
            currentOS = "web";
        }

        return currentOS;
    }

</script>


<!--결제 바로할수있게 넣어줌-->
<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<!--<script type="text/javascript" src="<?/*=G5_JS_URL*/?>/Innopay.js"></script>--><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 -->
    <input type="hidden" name="PayMethod" value="CARD">
    <input type="hidden" name="GoodsCnt" value="1">
    <input type="hidden" name="GoodsName" id="GoodsName" value="">
    <input type="hidden" name="Amt" id="Amt" value="">
    <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
    <input type="hidden" name="MID" value="pgcsignalm"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="5xX2sDs2cMv6g/tvLaFRlBHH2iDs9YJMf5p33Zu702qSy4Fj7DTrUSF2Q8X9OPWVWITJW3Sr3GuXWmaWK//cwg=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <!--    --><?php //} ?>
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/payment_result_level.php">
    <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/payment_result_level.php">
    <input type="hidden" name="ResultYN" value="N">

    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
    <input type="hidden" name="BuyerName" value="<?=$member['mb_name']?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ("-","",$member["mb_hp"])?>">
    <input type="hidden" name="BuyerEmail" value="">
    <input type="hidden" name="EncodingType" id="EncodingType" value="utf-8">
    <input type="hidden" name="FORWARD" value="N"><!-- 팝업유무 Y,N -->

    <input type="hidden" name="ediDate" value=""><!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
    <input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
    <input type="hidden" name="MallIP" value="127.0.0.1"/>
    <input type="hidden" name="UserIP" value="127.0.0.1">
    <input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
    <input type="hidden" name="device" value=""><!-- 자동셋팅 -->
</form>

<script>
    // 결제하기
    function payment(chk_val) {
        var chk = chk_val;
        var manna = 0;
        var member_type = '';
        if (chk == 9900){
            manna = 100;
        }else if (chk == 29000){
            manna = 350;
        }else if (chk == 59000){
            manna = 800;
        }else if (chk == 99000){
            manna = 1400;
        }else if (chk == 200000){
            manna = 2000;
            member_type = ' 일반회원권';
        }else if (chk == 149000){
            manna = 2100;
        }else if (chk == 500000){
            manna = 0;
            member_type = ' 시크릿회원권';
        }

        $('#GoodsName').val('크리스찬시그널' + member_type +'_' + manna);
        $('#Amt').val(chk_val);

        <?php if($private || $member["mb_id"] == "test2" || $member["mb_id"] == "test" || $member["mb_id"] == "test3" || $member["mb_id"] == "test11") { ?>
        $('#Amt').val('10');
        // $('#Moid').val($("#Moid").val()+"-"+manna);
        <?php } ?>
        // $('#Amt').val('10');

        goPay(document.payfrm);
    }


</script>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>


<map name="pop_map" id="pop_map">
    <area shape="rect" coords="174,812,305,851" href="https://apps.apple.com/kr/app/%EA%B0%99%EC%9D%80%EB%A7%88%EC%9D%8C-%EA%B0%99%EC%9D%80%EB%AF%BF%EC%9D%8C-%ED%81%AC%EB%A6%AC%EC%8A%A4%EC%B2%9C%EC%8B%9C%EA%B7%B8%EB%84%90/id1545530565" target="_blank" />
    <area shape="rect" coords="29,811,160,850" href="https://play.google.com/store/apps/details?id=co.kr.itforone.naimwedding&amp;hl=ko" target="_blank" />
</map>


<!-- Modal -->
<div id="basic_modal">

    <!--일반회원-->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="secret_userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">회원가입비 안내</h4>
                </div>
                <div class="modal-body">
                    <div class="area_secret">
                        <ul>
                            <li>
                                <i>01</i>
                                <span>회원가입비 200,000 만원 (<?=number_format($manna_arr['join'])?> 만나 지급)</span>
                            </li>
                            <li>
                                <i>02</i>
                                <span>회원가입 <?=number_format($manna_arr['join'])?> 만나 모두 소진전에 회원탈퇴시 만나 사용한 만큼 현금화하여 탈퇴비용 적용됩니다.</span>
                            </li>
                            <li>
                                <i>03</i>
                                <span>사진 <?=number_format($manna_arr['photo'])?>만나, 나의정보 <?=number_format($manna_arr['myprofile'])?>만나, 메세지 <?=number_format($manna_arr['message'])?>만나 차감적용됩니다.</span>
                            </li>
                            <li>
                                <i>04</i>
                                <span>저희어플에서 만남후 성혼시 성혼성사비 별도 1인 150,000 적용됩니다.</span>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="modal-footer">
                    <?php if(!$is_member){  ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="location.href='<?php echo G5_BBS_URL ?>/login.php'">로그인 후 이용</button>
                    <?php }else{ ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="payment(200000)">확인</button>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <!--시크릿회원-->
    <div class="modal fade" id="secret_userModal" tabindex="-1" role="dialog" aria-labelledby="secret_userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">시크릿회원 가입비 안내</h4>
                </div>
                <div class="modal-body">
                    <div class="area_secret">
                        <ul>
                            <li>
                                <i>01</i>
                                <span>시크릿존은 본인 정보가 일반회원이나 시크릿존회원끼리도 정보공유가 되지 않습니다.</span>
                            </li>
                            <li>
                                <i>02</i>
                                <span>시크릿존 회원은 일반회원을 볼 수 있으며, 채팅도 가능합니다. 시크릿존 회원이 일반회원에게 채팅시에 일반회원도 채팅에 응할 수 있습니다.</span>
                            </li>
                            <li>
                                <i>03</i>
                                <span>시크릿존 회원은 1차적으로 일반회원을 요청시 자유롭게 채팅이 가능하며 시크릿 회원의 채팅을 원할경우는 추가비용이 발생합니다.</span>
                            </li>
                            <li>
                                <i>04</i>
                                <span>시크릿존의 비용안내 : 회원가입비 500,000원 적용됩니다.</span>
                            </li>
                            <li>
                                <i>05</i>
                                <span>저희어플에서 만남후 성혼시 성혼성사비 별도 1인 150,000 적용됩니다.</span>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="modal-footer">
                    <?php if(!$is_member){ ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="location.href='<?php echo G5_BBS_URL ?>/login.php'">로그인 후 이용</button>
                    <?php }else{ ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="payment(500000)">확인</button>
                    <?php } ?>


                </div>
            </div>
        </div>
    </div>


</div>

