<?php
$pid = "index";
include_once("./app_head.php");

// 카운슬러 목록
$counselor_list = getCounselorList();

// 칼럼 목록
$sql = "SELECT * FROM g5_bbs_basic WHERE del_yn = 'N' AND tbl_name = 'column' ORDER BY idx DESC LIMIT 0, 5";
$column_list = sql_query($sql);
?>
<script>
    // 카카오채널 바로가기
    function openKakaoChat(url) {
        if('<?=!$is_member?>') {
            swal("로그인이 필요합니다.");
        }
        else {
            if (url != "") location.href = url;
            else {
                swal("카카오채널 준비중 입니다.");
            }
        }
    }
</script>

<div id="idx">
    <div class="logo">
        <img src="../img/logo_white.svg" class="logo">
    </div>
    <div class="container">
        <div class="area mypage">
            <?
            if ($is_member) {
                // 회원이미지
                $mb_img = getMemberImg($member['mb_id']);
            ?>
            <div class="photo">
                <? if ($mb_img['cnt'] > 0) { // 사진 존재하면 ?>
                <img src="<?=$mb_img['list'][0]['src']?>">
                <? } ?>
            </div>
            <div class="text">
                <p><?=$member['mb_name']?>님<a href="./mypage.php"><i class="fa-solid fa-pen"></i></a></p>
                <span>
                    현재
                    <? if ($member['mb_switch']=="on") { ?>
                    <strong><i class="fa-solid fa-heart-pulse"></i>롱런진행중</strong>
                    <? } else { ?>
                    <strong style="filter: grayscale(100%);"><i class="fa-light fa-heart"></i>롱런휴면중</strong>
                    <? } ?>
                    이십니다.
                </span>
            </div>
            <? } else { ?>
            <div class="text">
                <p>로그인이 필요합니다.</p>
            </div>
            <? } ?>
        </div>

        <div class="area profile">
            <h2>
                <p>카운슬러 프로필</p>
                <?php
                $counselor_link = G5_URL."/app/counselor.php";
                if(!$is_member) $counselor_link = "javascript:swal('로그인이 필요합니다.');";
                ?>
                <a href="<?=$counselor_link?>" class="more"><i class="fa-regular fa-plus"></i></a>
            </h2>
            <ul>
                <?
                foreach ($counselor_list AS $key=>$row) {
                    $profile_img = ($row['mb_img'] && file_exists(MB_IMG_PATH."/".$row['mb_img']))? MB_IMG_URL."/{$row['mb_img']}" : "";

                    if(!$is_member) {
                        $helper_link = "javascript:swal('로그인이 필요합니다.');";
                    } else {
                        // 1:1상담신청 링크
                        $helper_link = "javascript:swal('상담신청 준비중입니다.');";
                        if ($row['mb_2'] != "") {
                            $helper_link = preg_replace("/\s+/","", $row['mb_2']);
                        }
                    }
                ?>
                <li>
                    <div class="flex">
                        <div class="photo">
                            <?if ($profile_img != "") { // 이미지 존재 ?>
                            <img src="<?=$profile_img?>">
                            <?} else { // 이미지없음?>
                            <div class="noimg"></div>
                            <?}?>
                        </div>
                        <div class="text">
                            <p class="name"><span>Counselor.</span> <strong><?=$row['mb_name']?></strong></p>
                            <p class="num">매칭성공횟수 <strong><?=number_format(getMatchingCnt($row['mb_id']))?></strong></p>
                            <a class="btn grey small" href="<?=$helper_link?>" style="color:#FFF;">1:1상담신청</a>
                        </div>
                    </div>
                </li>
                <? } ?>
            </ul>
        </div>
        <div class="area column">
            <h2><p>롱런칼럼</p><a href="<?php echo G5_URL ?>/app/column.php" class="more"><i class="fa-regular fa-plus"></i></a></h2>
            <ul>
                <?if (count($column_list)==0) { ?>
                <li>등록된 칼럼이 없습니다.</li>
                <?
                } else {
                    while($row = sql_fetch_array($column_list)) {
                ?>
                <li>
                    <a href="./column_view.php?idx=<?=$row['idx']?>">
                        <p class="title"><strong><?=$row['category']?></strong><?=$row['subject']?></p>
                        <p class="date"><?=date("Y-m-d", strtotime($row['regdate']))?></p>
                    </a>
                </li>
                <? }} ?>
                <!--<li>
                    <a>
                        <p class="title"><strong>추천</strong>서울 근교내 분위기 좋은 카페</p>
                        <p class="date">2022-09-13</p>
                    </a>
                </li>
                <li>
                    <a>
                        <p class="title"><strong>칼럼</strong>소개팅 나가기 전 알이야 할 tip</p>
                        <p class="date">2022-09-13</p>
                    </a>
                </li>
                <li>
                    <a>
                        <p class="title"><strong>칼럼</strong>당신이 알아야하는 소개팅 대화법 세가지</p>
                        <p class="date">2022-09-13</p>
                    </a>
                </li>
                <li>
                    <a>
                        <p class="title"><strong>추천</strong>힐링이 필요한 타이밍 : 힐링 데이트 장소</p>
                        <p class="date">2022-09-13</p>
                    </a>
                </li>-->
            </ul>
        </div>
        <div class="area kakao">
            <a class="banner">
                <h3>
                    <p>Long-Run Q&A</p>
                    <div><strong>카카오채널 바로가기</strong><span>롱런 상담을 받아보세요!</span></div>
                </h3>
                <div class="channel">
                    <img src="../img/kakao_channel.png">
                    <p class="box" onclick="openKakaoChat('<?=$config['cf_kakao_pf']?>')">
                        <strong>롱런</strong>
                        <i class="fa-regular fa-plus"></i>
                    </p>
                </div>
            </a>
        </div>
    </div>

</div>

<!--<div class="copy">
    <p><strong>사업장 주소</strong> <span>충청북도 청주시 흥덕구 직지대로 636,1510호(봉명동, 하이젠시티)</span>　</p>
    <p><strong>사업자등록번호</strong> <span>771-18-01862</span>　</p>
    <p><strong>대표자명</strong> <span>김민자</span></p>
    <p><strong>대표번호</strong> <span>010-8407-0741</span>　</p>
    <div>Copyright ⓒ 2022 LONGRUN All right reserved.</div>
</div>-->


<?php
include_once ("./app_tail.php");
?>
