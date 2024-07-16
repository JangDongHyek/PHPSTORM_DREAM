<?
include_once('./_common.php');

if(!$is_member) {
    alert('로그인 후 이용해 주세요.', G5_BBS_URL.'/login.php');
}

$cr = sql_fetch(" select cr.*, mb.mb_no, mb.mb_company_name, mb.mb_company_homepage from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id where idx = {$idx} ");

//해시태그
$hashtag = '';
if(!empty($cr['cr_hashtag'])) {
    $tag = explode(',',$cr['cr_hashtag']);
    for($j=0; $j<count($tag); $j++) {
        $sch_class = '';
        if($sch_tag == $tag[$j] || strpos($tag[$j], $search) !== false) {
            $sch_class = " class='sch_word' ";
        }
        $hashtag .= '<li '.$sch_class.' onclick="tag_search(\''.$tag[$j].'\');">'.$tag[$j].'</li>';
    }
}

// 프로필 업데이트 완료 여부 확인
$profile = sql_fetch(" select count(*) as cnt from g5_bunker_history where mb_id = '{$member['mb_id']}' and contents like '%프로필 업데이트 완료%' ")['cnt'];
if($profile > 0) {
    $flag = true;
} else {
    $flag = false;
}

$g5['title'] = $cr['mb_company_name'];
include_once('./_head.php');
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 50px;}
	#ft{display:none;}
	.btn_write{bottom:10px;}
    a{cursor: pointer;}
</style>

<!-- 프로필 업데이트 모달팝업 -->
<div id="basic_modal">
    <div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">프로필 업데이트</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <div class="area_box">
                            <h3>프로필 업데이트 완료 후<br>지원이 가능합니다.</h3>
                            <a href="<?php echo G5_BBS_URL ?>/profile_update01.php">프로필 업데이트</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //프로필 업데이트 모달팝업 -->

<div id="area_career" class="view">
	<div class="inr v3">
		<div id="help_list" class="career">
			<div class="help_question top">
				<div class="title">
					<!--채용공고를 작성한 기업이 수정-->
                    <?php if($member['mb_id'] == $cr['mb_id']) { ?>
                    <a href="javascript:edit_open('edit_list_q');" class="btn_more"></a>
                    <ul class="edit_list edit_list_q" style="display: none;">
                        <li class="modify"><a href="<?=G5_BBS_URL?>/career_write.php?idx=<?=$cr['idx']?>&w=u">수정</a></li>
                        <li class="modify"><a href="<?=G5_BBS_URL?>/career_write_update.php?idx=<?=$cr['idx']?>&w=e">마감</a></li>
                        <!--<li class="delete"><a href="javascript:career_delete('');">삭제</a></li>-->
                        <li class="delete"><a href="<?=G5_BBS_URL?>/career_write_update.php?idx=<?=$cr['idx']?>&w=d">삭제</a></li>
                    </ul>
                    <?php } ?>
					
					<div class="company_info">
						<em><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$cr['mb_no']?>"><?=$cr['mb_company_name']?></a></em><!-- 회사미니홈피로 이동 -->
                        <?php if(!empty($cr['mb_company_homepage'])) { ?>
						<em class="link"><a onclick="site_link(this, '<?=$cr['mb_company_homepage']?>');" target="_blank"><?=$cr['mb_company_homepage']?></a></em><!-- 회사홈페이지로 이동 -->
						<?php } ?>
						<h3><?=$cr['cr_subject']?></h3>
					</div>
					<ul class="tag">
						<?=$hashtag?>
					</ul>
					<ul class="career_info">
						<li>
							<h4>근무형태</h4>
							<span><?=$cr['cr_work_type']?></span>
						</li>
						<li>
							<h4>직급/직책</h4>
							<span><?=$cr['cr_work_position']?></span>
						</li>
						<li>
							<h4>연봉</h4>
							<span><?=$recruit_salary[$cr['cr_work_salary']]?></span>
						</li>
						<li>
							<h4>근무지</h4>
							<span><?=$cr['cr_work_addr']?></span>
						</li>
					</ul>
				</div>
			</div>
			<ul class="btn_link">
                <?php if($member['mb_category'] == '일반') { // 일반회원만 지원하기 사용 ?>
				<li>
                    <?php
                    $cnt = sql_fetch(" select count(*) as cnt from g5_resume where recruit_idx = '{$idx}' and mb_id = '{$member['mb_id']}' ")['cnt'];
                    if($cnt > 0) { ?>
                    <a href="javascript:;" class="btn_confirm">지원완료</a>
                    <?php
                    } else {
                    ?>
                    <a href="javascript:profileCheck();" class="btn_confirm">지원하기</a>
                    <?php
                    }
                    ?>
                </li>
                <?php } ?>
                <!--채용사이트 없으면 기업 미니홈피로 이동-->
				<li <?=$member['mb_category'] == '일반' ? '' : 'class="full"'; ?>><a onclick="site_link(this, '<?php echo empty(!$cr['cr_site']) ? $cr['cr_site'] : G5_BBS_URL.'/company.php?mb_no='.$cr['mb_no']; ?>');" class="btn_confirm" target="_blank">채용사이트 바로가기</a></li>
			</ul>
			<div class="help_write">
                <div><?=nl2br($cr['cr_contents'])?></div>
			</div>
			<div class="help_write">
				<ul class="box_list">
					<li>
						<em>마감일</em>
						<span><?=$cr['cr_always'] == 'Y' ? '상시채용' : str_replace('-','.',substr($cr['cr_eddate'],0,10))?></span>
					</li>
					<li>
						<em>회사위치</em>
						<span><?=$cr['cr_addr'].' '.$cr['cr_addr2']?></span>
					</li>
				</ul>
                <!-- 지도를 표시할 div -->
				<div class="area_map" style="height: 300px;">
                    <div id="map" style="width: 100%;height: 300px;"></div>
                </div>
			</div>
		</div>
		<div id="area_recommend">
			<div class="list_best">
				<h3>추천채용정보</h3>
				<ul class="career_list">
                    <?php
                    // 1순위 관심 키워드(프로필 업데이트 5 - 추가정보) 기준 / 2순위 비즈니스 분야와 일치하는 업종 기준 -- 대략 10개 정도?
                    // 1순위
                    $array = [];
                    if(!empty($member['mb_keyword'])) {
                        $tag_search = tagSearch('mb_hashtag', $member['mb_keyword']); // 검색컬럼, 검색태그
                        $tag_search2 = tagSearch('mb_hashtag', $member['mb_keyword']); // 검색컬럼, 검색태그
                        //$keyword = str_replace(',','|',$member['mb_keyword']); // 관심키워드

                        $sql = " select cr.*, mb.mb_category, mb.mb_company_name 
                                 from g5_career_recruit as cr 
                                 left join g5_member as mb on mb.mb_id = cr.mb_id 
                                 where ({$tag_search} or {$tag_search2}) and (date_format(now(), '%Y-%m-%d') <= cr.cr_eddate or cr_always = 'Y') and cr_state is null
                                 order by idx desc limit 10 ";
                        $result = sql_query($sql);

                        while($row=sql_fetch_array($result)) {
                            array_push($array, $row['idx']);

                            // 채용공고 D-DAY
                            $date = $row['cr_eddate'];
                            $todate = date("Y-m-d", time());
                            $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
                    ?>
                    <li>
                        <a href="<?=G5_BBS_URL?>/career_view.php?idx=<?=$row['idx']?>">
                            <div class="top">
                                <em class="dday">D - <?=$dday?></em><!-- 남은기간 -->
                                <div class="company_logo"><?php echo getProfileImg($row['mb_id'], $row['mb_category']); ?></div>
                                <span><?=$row['mb_company_name']?></span>
                                <h3><?=$row['cr_subject']?></h3>
                                <span class="salary"><?=$recruit_salary[$row['cr_work_salary']]?></span><!-- 연봉 -->
                            </div>
                        </a>
                    </li>
                    <?php
                        }
                    }

                    $array = implode(',', $array); // 1순위에서 표시된 채용정보를 제외하기 위함
                    // 2순위
                    $search_sector = array_search($business_active_list[$member['mb_active_business']], $company_sectors);
                    if(!empty($search_sector)) { // 활동중인 비즈니스 분야가 있을 때
                        $sql = " select cr.*, mb.mb_company_name 
                                 from g5_career_recruit as cr 
                                 left join g5_member as mb on mb.mb_id = cr.mb_id 
                                 where mb.mb_company_sector = {$search_sector} and (date_format(now(), '%Y-%m-%d') <= cr.cr_eddate or cr_always = 'Y') and cr_state is null 
                                 and cr.idx not in ({$array})
                                 order by idx desc limit 10 ";
                        $result = sql_query($sql);

                        while($row=sql_fetch_array($result)) {
                            // 로고
                            $logo = sql_fetch(" select * from g5_member_img where mb_id = '{$row['mb_id']}' and category = '로고' ")['img_file'];
                            if (empty($logo)) {
                                $img_src = G5_THEME_IMG_URL . '/app/logo.png';
                            } else {
                                $img_src = G5_DATA_URL . '/file/company/' . $logo;
                            }

                            // 채용공고 D-DAY
                            $date = $row['cr_eddate'];
                            $todate = date("Y-m-d", time());
                            $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
                        ?>
                        <li>
                            <a href="<?=G5_BBS_URL?>/career_view.php?idx=<?=$row['idx']?>">
                                <div class="top">
                                    <em class="dday">D - <?=$dday?></em><!-- 남은기간 -->
                                    <div class="company_logo"><img src="<?=$img_src?>"></div>
                                    <span><?=$row['mb_company_name']?></span>
                                    <h3><?=$row['cr_subject']?></h3>
                                    <span class="salary"><?=$recruit_salary[$row['cr_work_salary']]?></span><!-- 연봉 -->
                                </div>
                            </a>
                        </li>
                        <?php
                        }
                    }
                    ?>
				</ul>
			</div>
	</div>
</div>

<form name="fsearch" id="fsearch" method="post" action="<?=G5_BBS_URL?>/career.php">
    <input type="hidden" id="search" name="search" value="">
</form>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=$kakao_javascript_key?>"></script>
<script>
    // 지원하기 (프로필 작성을 완료하지 않으면 알림창)
    function profileCheck() {
        if('<?=$flag?>') {
            location.href = g5_bbs_url + '/career_apply.php?idx=<?=$idx?>';
        } else {
            $('#joinModal').modal('show');
        }
    }

    // 태그 검색
    function tag_search(tag) {
        // 검색폼에 데이터 입력
        $('#search').val(tag);
        $('#fsearch').submit();
    }

    // 채용공고 삭제
    function career_delete() {
        swal({
            text: "채용공고를 삭제하시겠습니까?",
            icon: "warning",
            buttons: {
                defeat: "확인",
                cancel: "취소",
            },
        })
        .then((value) => {
            switch (value) {
                case "defeat":
                    location.href = g5_bbs_url+'/career_write_update.php?idx=<?=$idx?>&w=d';
                case "cancel":
                    return false;
            }
        });
        $('.swal-modal').addClass('half'); // 버튼 스타일 때문에 추가
    }

    // ** 다음 지도 **
    var lat = '<?=$cr['cr_addr_lat']?>';
    var lng = '<?=$cr['cr_addr_lng']?>';
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div
        mapOption = {
            center: new kakao.maps.LatLng(lat, lng), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };

    // 지도를 표시할 div와 지도 옵션으로 지도를 생성
    var map = new kakao.maps.Map(mapContainer, mapOption);

    // 마커 표시
    var markerPosition = new kakao.maps.LatLng(lat, lng);
    var marker = new kakao.maps.Marker({
       position: markerPosition
    });
    marker.setMap(map);
</script>
<script>
	// 수정/삭제
	$(document).click(function(e) {
		if (!$(e.target).hasClass('btn_more')) { // btn_more가 포함된 영역 밖 클릭 시 수정/삭제 영역 숨김
			$('.edit_list').attr('style', 'display: none;');
		}
	});
	var g_class2 = '';
	function edit_open(mode) { // mode : 각 댓글에 적용된 클래스
		if(g_class2 != mode) {
			$('.edit_list').attr('style', 'display: none;');
		}
		g_class2 = mode;

		if($('.'+mode).attr('style').indexOf('block') != -1) {
			$('.'+mode).attr('style', 'display: none;');
		} else {
			$('.'+mode).attr('style', 'display: block;');
		}
	}
</script>

<?
include_once('./_tail.php');
?>