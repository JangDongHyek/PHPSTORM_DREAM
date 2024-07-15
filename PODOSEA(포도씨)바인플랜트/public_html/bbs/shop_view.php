<?
include_once('./_common.php');

$g5['title'] = '자료실';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);

if(empty($code)) alert("올바른 경로가 아닙니다.", G5_BBS_URL.'/shop.php');

$idx = explode('_', base64_decode($code))[1];
$row = sql_fetch(" SELECT a.*, b.* FROM g5_reference_room AS a INNER JOIN g5_member AS b ON a.mb_id = b.mb_id WHERE a.idx = '{$idx}' ");
$mb = get_member($row['mb_id']);
// print_r($row);

//해시태그
$hashtag = '';
if(!empty($row['rr_hashtag'])) {
    $tag = explode(',',$row['rr_hashtag']);
    for($j=0; $j<count($tag); $j++) {
        $hashtag .= '<li>'.$tag[$j].'</li>';
    }
}

$row_cls = '';
$mode = 'add';
// 찜 목록에 있음
$cnt = sql_fetch(" SELECT COUNT(*) AS cnt from g5_like_reference WHERE reference_idx = '{$idx}' AND mb_id = '{$member['mb_id']}' ")['cnt'];
if($cnt > 0) {
    $row_cls = 'on';
    $mode = 'del';
}

// 파일 정보
$file_info = sql_fetch(" SELECT * FROM g5_reference_room_file WHERE mode = 'file' AND reference_idx = '{$idx}' ORDER BY idx LIMIT 1 ");
$f_format = explode('.', $file_info['img_file'])[1];
$f_size = formatBytes($file_info['img_filesize']);
$f_file = $file_info['img_file'];
$f_filename = $file_info['img_source'];

// 리뷰 정보
$review_cnt = sql_fetch(" SELECT COUNT(*) AS cnt FROM g5_reference_room_review WHERE reference_idx = '{$idx}' ")['cnt']; // 리뷰 수
$review_avg = sql_fetch("SELECT AVG(score) AS avg FROM g5_reference_room_review WHERE reference_idx = '{$idx}'")['avg']; // 리뷰 평점
if(empty($review_avg)) $review_avg = '0.0';

// 자료 결제 정보
$download_flag = false;
$cnt = sql_fetch(" select count(*) as cnt from g5_bunker_history where mb_id = '{$member['mb_id']}' and rel_idx = '{$idx}' and rel_table = 'g5_reference_room' ")['cnt'];
if($cnt > 0) $download_flag = true;

// idx
$code = base64_encode("refer".rand(0,100).'_'.$idx);

// ==========
// 카카오 공유하기 데이터
// ----------
// 1. 프로필 이미지 경로
$img = sql_fetch("select * from g5_member_img where mb_id = '{$row['mb_id']}'")['img_file'];
if(empty($img)) { // 기본이미지
    if($mb['mb_level'] == 2) $profile_path = G5_IMG_URL.'/img_smile.svg';
    else $profile_path = G5_IMG_URL.'/img_nlogo.jpg';
} else {
    if($mb['mb_level'] == 2) $profile_path = G5_DATA_URL.'/file/member/'.$img;
    else $profile_path = G5_DATA_URL.'/file/company/'.$img;
}

// 2. 자료실 썸네일 경로
$thumb = sql_fetch("SELECT * FROM g5_reference_room_file WHERE mode = 'thumb' AND reference_idx = '{$idx}' ORDER BY idx limit 1");
$thumb_path = G5_DATA_URL.'/file/reference/'.$thumb['img_file'];

// 3. 공류 자료 경로
$share_path = G5_BBS_URL.'/shop_view.php?code='.$code;
// ==========

// 이노페이 결제 moid
$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS)).'-'.$member['mb_no'].'-'.$idx;

// 본인 자료인지
$is_self = false;
if($member['mb_id'] == $row['mb_id']) $is_self = true;
?>

<!--이미지롤링-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<!--//이미지롤링-->

<?php
// 프로필 모달
include_once('./profile_modal.php');
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<style>
    html{ scroll-behavior: auto;}
    .fotorama__nav{text-align: left;}
    .fotorama__arr, .fotorama__fullscreen-icon, .fotorama__video-close, .fotorama__video-play{background: none;}
    .fotorama__stage,
    .fotorama__stage__shaft{max-height: 400px!important;}

    .btn_report {
        display: block;
        border: 1px solid #aaa;
        margin: 10px auto 0;
        padding: 5px 10px 3px;
        width: 80px;
        line-height: 1.2em;
        font-size: 13px;
        color: #333;
        border-radius: 5px;
    }

    a {
        cursor: pointer;
    }

    .fotorama img {top: 0px !important;}
</style>
<div id="area_shop">

    <div class="area_view">
        <div class="inr v3">
            <div class="area_products">
                <div class="img">
                    <div class="fotorama" data-nav="thumbs">
                        <?php
                        $file_rlt = sql_query("SELECT * FROM g5_reference_room_file WHERE mode = 'thumb' AND reference_idx = '{$idx}' ORDER BY idx ");
                        for($i=0; $file=sql_fetch_array($file_rlt); $i++) {
                        ?>
                        <img src="<?=G5_DATA_URL?>/file/reference/<?=$file['img_file']?>" width="100" height="75">
                        <!--<a href="javascript:;"><img src="<?/*=G5_DATA_URL*/?>/file/reference/<?/*=$file['img_file']*/?>" width="100" height="75"></a>-->
                        <?php
                        }
                        ?>
                        <!--<a href="1.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="2.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="3.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="4.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="5.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="6.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="7.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="8.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="9.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>
                        <a href="10.jpg"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg" width="100" height="75"></a>-->
                    </div>
                </div>
                <div class="text">
                    <!--수정/삭제-->
                    <?php if($row['mb_id'] == $member['mb_id'] || $is_admin) { ?>
                    <div class="dropdown">
                        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn_more"></button>
                        <ul class="dropdown-menu edit_list edit_list_q" role="menu" aria-labelledby="dLabel">
                            <li class="modify"><a href="<?=G5_BBS_URL?>/shop_write.php?code=<?=$code?>&w=u">수정</a></li>
                            <li class="delete"><a onclick="referenceDelete(<?=$row['idx']?>, 'del')">삭제</a></li>
                        </ul>
                    </div>
                    <?php } ?>
                    <p class="cate"><?=$row['rr_category']?><?/*=!empty($row['rr_sub_category']) ? ' > '.$row['rr_sub_category']:''*/?></p>
                    <h4 class="title"><?=$row['rr_subject']?></h4>
                    <div class="price"><?php if($row['rr_is_free']=='N') { ?><strong><?=number_format($row['rr_price'])?></strong>원<?php } else { ?>무료<?php } ?></div>
                    <dl>
                        <dt>파일 포맷</dt>
                        <dd><?=$f_format?></dd>
                        <dt>파일 용량</dt>
                        <dd><?=$f_size?></dd>
                        <dt>종합 별점</dt>
                        <dd><i class="fas fa-star"></i> <?=sprintf("%0.1f", $review_avg)?></dd>
                    </dl>
                    <ul class="tag"><?=$hashtag?></ul>
                    <div class="btn_wrap">
                        <?php if($row['rr_is_free']=='Y' || $member['mb_id'] == $row['mb_id']) { ?>
                        <a onclick="paymentChk('<?=$row['idx']?>', '<?=$f_file?>', '<?=$f_filename?>', '<?=$is_self?>');" class="btn_down"><i class="fal fa-arrow-to-bottom"></i> 파일 다운로드</a>
                        <?php } else { ?>
                        <!--<a data-toggle="modal" data-target="#payModal">결제테스트</a>-->
                        <a onclick="fileDownloadPayment('<?=$row['rr_price']?>', '<?=$row['idx']?>', '<?=$f_file?>', '<?=$f_filename?>')" class="btn_down"><i class="fal fa-arrow-to-bottom"></i> 파일 다운로드</a>
                        <?php } ?>
                        <button class="btn_ico <?=$row_cls?>" onclick="likeReference(<?=$idx?>, '<?=$mode?>');location.reload()"><i class="fal fa-heart"></i></button>
                        <button class="btn_ico" onclick="shareReference(<?=$row['idx']?>)"><i class="fal fa-share-alt"></i></button>
                    </div>
                </div>
                <input type="text" id="share_path" value="<?=G5_BBS_URL?>/shop_view.php?code=<?=$code?>" style="opacity: 0;position: absolute;">
            </div>
        </div>

        <div class="inr v3">
            <!-- Nav tabs -->
            <ul class="nav-tabs">
                <li class="active" rel="tab1"><a href="javascript:;">내용소개</a></li>
                <li rel="tab2"><a href="javascript:;">평가리뷰 (<?=$review_cnt?>)</a></li>
                <li rel="tab3"><a href="javascript:;">판매자정보<span> (1:1채팅)</span></a></li>
                <li rel="tab4"><a href="javascript:;">취소·환불</a></li>
            </ul>
            <!--<ul class="nav-tabs">
                <li class="active"><a href="#view">내용소개</a></li>
                <li><a href="#review">평가리뷰 (0)</a></li>
                <li><a href="#qna">판매자정보<span> (1:1채팅)</span></a></li>
                <li><a href="#info">취소·환불</a></li>
            </ul>-->

            <div id="tab1" class="tab-content">
                <h4>내용소개</h4>
                <span class="scroll"><?=nl2br($row['rr_contents'])?></span>
            </div>

            <div id="tab2" class="tab-content review">
                    <h4>평가 리뷰</h4>
                    <div>
                        <div class="total">
                            <p><strong><i class="fas fa-star"></i> <?=sprintf("%0.1f", $review_avg)?></strong> <span><?=$review_cnt?>개의 평가</span></p>
                            <div class="gray">실제 구매자들이 남긴 평가 리뷰입니다.</div>
                        </div>

                        <div class="top_filter">
                            <div class="box_left">
                                <ul class="sort_list">
                                    <li class="selected"><span>최신순</span></li>
                                    <li><span>별점 높은순</span></li>
                                    <li><span>별점 낮은순</span></li>
                                </ul>
                            </div>
                        </div>

                        <ul class="list reviewList">
                        </ul>
                    </div>
                </div>

            <div id="tab3" class="tab-content">
                <h4>판매자정보</h4>

                <div id="area_my">
                    <div class="myinfo">
                        <?php if($row['mb_grade'] == 'Premium') { ?>
                        <div class="lv_label lv<?=array_search($row['mb_grade'], $member_grade)?>">
                            <div class="txt">
                                <h3>프리<br>미엄</h3>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="top_box first_box">
                            <div class="box_wrap" onclick="userToggle('user_list_main');">
                                <div class="myinfo_wrap">
                                    <div class="area_photo toggle">
                                        <?php echo getProfileImg($row['mb_id'], $row['mb_category']); ?>
                                    </div>
                                </div>
                                <!--<div class="location"><span><?php /*=$row['mb_si']*/?></span></div>-->
                                <div class="id">
                                    <i class="lv<?=array_search($row['mb_grade'], $member_grade)?>"><?=$row['mb_grade']?></i><span class="toggle"><?=getNickOrId($row['mb_id'])?></span>
                                </div>
                                <?php if($row['mb_level'] == 2) { // 일반 ?>
                                <div class="area_intro">
                                    <?php if(!empty($row['mb_introduce'])) { ?>
                                        <p><?=$row['mb_introduce']?></p>
                                    <?php } else { ?>
                                        <div class="nodata"><p>작성된 소개글이 없습니다.</p></div>
                                    <?php } ?>
                                </div>
                                <div class="area_nm">
                                    <em>나의 포도씨 항해 거리</em> <span class="blue"><?=number_format($row['mb_grade_point'])?>NM</span>
                                </div>
                                <?php } else { // 기업 ?>
                                <div class="area_star">
                                    <span>기업평점 <i><?=companyScore($row['mb_id'], 'Y')?>점</i></span>
                                    <div class="img_star v<?=companyScore($row['mb_id'])?>">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if($row['mb_id'] != $member['mb_id']) { ?>
                                <!-- 토글메뉴 -->
                                <ul class="user_list_main user_list sm">
                                    <?php if($row['mb_category'] == '일반') { // 작성자일반회원?>
                                    <li onclick="profileOpen('<?=$row['mb_category']?>', '<?=$row['mb_id']?>')">프로필보기</li>
                                    <?php } ?>
                                    <?php if(!$self && $row['mb_category'] == '일반' && $member['mb_level'] == 2) { // 내가쓴글아님 && 작성자일반회원 && 내가일반회원?>
                                    <li onclick="likeFriend('<?=$row['mb_id']?>', '<?=$mode?>');"><?=$txt?></li> <!--친구등록/삭제-->
                                    <?php } ?>
                                    <?php if($row['mb_category'] == '기업') { // 작성자기업회원?>
                                    <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$row['mb_no']?>">기업홈피로 이동</a></li>
                                    <li>의뢰건수 <em class="blue"><?=inquiryCount($row['mb_id'])?></em>건</li>
                                    <li>거래건수 <em class="blue"><?=completeCount($row['mb_id'])?></em>건</li>
                                    <?php } ?>
                                    <?php if(!$self && $row['mb_category'] == '일반') { // 내가쓴글아님 && 작성자일반회원?>
                                    <li onclick="chatting('<?=$row['mb_id']?>');">채팅하기</li>
                                    <?php } ?>
                                    <?php if(!$self) { // 내가쓴글아님?>
                                    <li onclick="reportOpen('<?=$row['mb_id']?>', 'g5_reference_room', '<?=$row['idx']?>')">신고하기</li>
                                    <?php if($member['mb_id'] == 'test01') { ?>
                                    <li onclick="userBlock('<?=$row['mb_id']?>', 'g5_reference_room', '<?=$row['idx']?>', 'reference')">차단하기</li>
                                    <?php } ?>
                                    <?php } ?>
                                </ul>
                                <!-- //토글메뉴 -->
                                <!--<div>
                                    <span class="btn_report" onclick="reportOpen('<?php /*=$row['mb_id']*/?>', 'g5_reference_room', '<?php /*=$row['idx']*/?>')" style="cursor: pointer;">신고하기</span>
                                </div>-->
                                <?php } ?>
                            </div>
                        </div>
                        <div class="top_box second_box">
                            <?php if($row['mb_level'] == 2) { // 일반 ?>
                            <div class="area_box">
                                <h3>경력사항</h3>
                                <?php if(!empty($row['mb_career'])) { ?>
                                <ul class="myinfo_list">
                                    <?php
                                    $mb_career = explode(',',$row['mb_career']);
                                    for($k=0; $k<count($mb_career); $k++) {
                                        ?>
                                        <li><?=$mb_career[$k]?></li>
                                    <?php } ?>
                                </ul>
                                <?php } else { ?>
                                <div class="nodata"><p>등록된 경력사항이 없습니다.</p></div>
                                <?php } ?>
                            </div>
                            <div class="area_box">
                                <h3>학력 및 전공</h3>
                                <?php if(!empty($row['mb_education'])) { ?>
                                <ul class="myinfo_list">
                                    <?php
                                    $mb_education = explode(',',$row['mb_education']);
                                    for($k=0; $k<count($mb_education); $k++) {
                                        ?>
                                        <li><?=$mb_education[$k]?></li>
                                    <?php } ?>
                                </ul>
                                <?php } else { ?>
                                <div class="nodata"><p>등록된 학력 및 전공이 없습니다.</p></div>
                                <?php } ?>
                            </div>
                            <div class="area_box">
                                <h3>보유기술 및 자격증</h3>
                                <?php if(!empty($row['mb_tech'])) { ?>
                                <ul class="myinfo_list">
                                    <?php
                                    $mb_tech = explode(',',$row['mb_tech']);
                                    for($k=0; $k<count($mb_tech); $k++) {
                                        ?>
                                        <li><?=$mb_tech[$k]?></li>
                                    <?php } ?>
                                </ul>
                                <?php } else { ?>
                                <div class="nodata"><p>등록된 보유기술 및 자격증이 없습니다.</p></div>
                                <?php }?>
                            </div>
                            <?php } else { // 기업 ?>
                            <div class="area_box">
                                <!--회사소개-->
                                <dl>
                                    <dt>회사소개</dt> <dd><?=$row['mb_company_name']?></dd>
                                </dl>
                                <!--회사전화-->
                                <dl>
                                    <dt>회사전화</dt> <dd><?=$row['mb_company_tel']?></dd>
                                </dl>
                                <!--사업자등록번호-->
                                <dl>
                                    <dt>사업자등록번호</dt> <dd><?=$row['mb_company_num']?></dd>
                                </dl>
                                <!--대표명-->
                                <dl>
                                    <dt>대표명</dt> <dd><?=$row['mb_ceo']?></dd>
                                </dl>
                            </div>
                            <?php } ?>
                            <div class="area_btn">
                                <?php if($member['mb_id'] != $row['mb_id']) { ?>
                                <div class="area_write">
                                <a href="javascript:chatting('<?=$row['mb_id']?>');"><i class="fal fa-comments-alt"></i> 판매자와 1:1채팅하기</a>
                                </div>
                                <?php } ?>
                                <?php if(!empty($row['mb_company_homepage'])) { ?>
                                <a class="btn_company" onclick="site_link(this, '<?=$row['mb_company_homepage']?>')" target="_blank" ><i class="fal fa-link"></i> 기업홈페이지</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab4" class="tab-content">
                <h4>취소 및 환불 규정</h4>
                <ul>
                    <li class="empty">
                        Podosea 자료실의 유료 정보 구매의 경우, 상품의 특성상 다운로드 이후에는 취소가 불가합니다.<br>
                        또한, 상품의 특성상 서비스 제공 완료 이후에는 환불이 어려우며, 환불과 관련된 사항은 판매회원과 상호 협의 부탁드립니다.
                    </li>
                </ul>
            </div>
        </div>
</div>
</div>

<form name="freview">
    <input type="hidden" id="orderby" name="orderby">
    <input type="hidden" id="page" name="page">
</form>

<!-- pay Modal -->
<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="area">
                    <h5>BUNKER</h5>
                    <dl>
                        <dt>보유</dt>
                        <dd><p class="frm_input"><input type="text" id="my_bunker" name="my_bunker" value="<?=number_format($member['mb_bunker']+$member['mb_bunker_bonus'])?>">&nbsp;벙커</p></dd>
                    </dl>
                    <dl>
                        <dt>사용</dt>
                        <dd>
                            <p class="frm_input"><input type="text" id="use_bunker" name="use_bunker" value="" placeholder="0" onkeyup="comma_number(this);calcBunker()">&nbsp;벙커<a class="btn_del" onclick="calcClear()"><i class="fal fa-times"></i></a></p>
                            <div class="pt5">
                                <a class="btn_all" onclick="allUse()" style="cursor: pointer;">전액사용</a>
                                <div class="cdata">
                                    <input type="checkbox" id="allUse" name="allUse" onclick="alwaysUse()" <?=$member['always_use'] == 'Y' ? 'checked' : ''?>><label for="allUse"><span></span><em>항상 보유 벙커 전액 사용</em></label>
                                </div>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="area">
                    <h5>결제상세</h5>
                    <dl>
                        <dt>자료금액</dt>
                        <dd><span id="rr_price"><?=number_format($row['rr_price'])?></span>원</dd>
                    </dl>
                    <dl>
                        <dt>벙커사용</dt>
                        <dd><span id="pay_bunker">0</span>벙커</dd>
                    </dl>
                    <dl class="total">
                        <dt>결제금액</dt>
                        <dd><span id="pay_price">0</span>원</dd>
                    </dl>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn_submit" onclick="referPayment()">결제하기</a>
            </div>
        </div>
    </div>
</div>

<!-- SNS Modal -->
<div class="modal fade" id="snsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                <h4 class="modal-title" id="myModalLabel">공유하기</h4>
            </div>
            <div class="modal-body">
                <a class="share1" onclick="shareLink()"><i class="fas fa-link"></i></a>
                <a class="share2"><img src="<?php echo G5_IMG_URL ?>/sns_icon01.png" alt="카카오톡" </a>
                <!--<a><img src="<?php /*echo G5_IMG_URL */?>/sns_icon02.png" alt="페이스북"></a>
                <a><img src="<?php /*echo G5_IMG_URL */?>/sns_icon03.png" alt="밴드"></a>-->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://pg.innopay.co.kr/ipay/js/innopay-2.0.js" charset="utf-8"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 -->
    <input type="hidden" name="PayMethod" value="CARD">
    <input type="hidden" name="MID" value="<?=$MID?>"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="<?=$MerchantKey?>"> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <input type="hidden" name="GoodsName" id="GoodsName" value="자료실결제">
    <input type="hidden" name="Amt" id="Amt" value="<?=$price?>">
    <input type="hidden" name="BuyerName" value="<?=$member['mb_name']?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ("-","",$member["mb_hp"])?>">
    <input type="hidden" name="BuyerEmail" value="<?=!empty($member['mb_email']) ? $member['mb_email'] : 'test@test.com'?>">
    <input type="hidden" name="ResultYN" value="N">
    <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/shop_pay_result.php">
    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
</form>

<!-- kakao sdk 호출 -->
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script>
    $(function() {
        if($("#allUse").is(":checked")) alwaysUse();

        // 총 결제금액
        calcPrice();

        // 탭
        $(".tab-content").hide();
        $(".tab-content:first").show();

        $("ul.nav-tabs li").click(function () {
            if($(this).find('a').length > 0){
                $("ul.nav-tabs li").removeClass("active");
                $(this).addClass("active");
                $(".tab-content").hide();
                var activeTab = $(this).attr("rel");
                $("#" + activeTab).show();

                if(activeTab == "tab2") reviewList(1);
            }
        });

        // 정렬
        $(".sort_list li").click(function () {
            click_event('sort_list', $(this), 'selected', 'orderby');
        });
    });

    $(document).click(function(e) {
        // 다른 아이디(닉네임)의 소메뉴 클릭 시 이전 소메뉴 숨김
        $('.user_list').each(function() {
            if($(this).attr('style').indexOf('block') != -1) {
                if($(this)[0]['classList'][0] != user_cls) {
                    $('.user_list').hide();
                }
            }
        });
        if (!$(e.target).hasClass('toggle')) { // toggle 포함된 영역 밖 클릭 시 소메뉴 영역 숨김
            $('.user_list').hide();
        }
    });

    // 사용자 소메뉴 토글
    var user_cls = '';
    function userToggle(cls) {
        if(user_cls != cls) {
            $('.user_list').hide();
        }
        user_cls = cls;

        if($('.'+cls).attr('style').indexOf('block') != -1) $('.'+cls).hide();
        else $('.'+cls).show();
    }

    // 검색-클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
    function click_event(object, element, class_name, column) {
        $('.' + object + ' li').removeClass(class_name);
        element.addClass(class_name);
        $('#' + column).val(element[0]['innerText']);

        reviewList(); // 리스트
    }

    // 리뷰 리스트
    function reviewList(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.reference_review_list.php",
            data: {orderby: $("#orderby").val(), page: $('#page').val(), idx: <?=$idx?>},
            type: 'POST',
            cache: false,
            async: false,
            success : function(data) {
                if(data){
                    $('.reviewList').html(data);

                    // 페이징 처리 -- 하단에 페이지 표시
                    ajaxGetPaging();
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 페이징 처리 -- 페이지 클릭 시 동작 이벤트
    function get_page(page) {
        reviewList(page);
    }

    // 파일 다운로드 전 결제
    function fileDownloadPayment(price, idx, server_file, real_file) {
        var payFlag = paymentChk(idx, server_file, real_file); // 자료 결제 여부 확인
        if(!payFlag) $("#payModal").modal("show");
    }

    // 자료 결제 여부 확인
    function paymentChk(idx, server_file, real_file, is_self) {
        var payFlag = true;

        if(is_self) {
            $(".btn_wrap a").attr("onclick", "fileDownload('reference', '" + server_file + "', '" + real_file + "')");
            $(".btn_wrap a").click();
        }
        else {
            $.ajax({
                url: "./ajax.reference_action.php",
                type: "post",
                data: {idx: idx, mode: "view"},
                async: false,
                success: function (data) {
                    if (data == 'payment_complete') {
                        $(".btn_wrap a").attr("onclick", "fileDownload('reference', '" + server_file + "', '" + real_file + "')");
                        $(".btn_wrap a").click();
                    } else {
                        payFlag = false;
                    }
                },
            });
        }

        return payFlag;
    }

    // 삭제
    function referenceDelete(idx, mode) {
        if(mode == "del") {
            swal({
                text: "자료를 삭제하시겠습니까?",
                icon: "warning",
                buttons: {
                    defeat: "확인",
                    cancel: "취소",
                },
            })
            .then((value) => {
                switch (value) {
                    case "defeat":
                        $.ajax({
                           url: "./ajax.reference_action.php",
                           type: "post",
                           data: {idx: idx, mode: mode},
                           success: function(data) {
                               if(data) {
                                   swal("삭제되었습니다.")
                                   .then(()=>{
                                       location.replace(g5_bbs_url+'/shop.php');
                                   });
                               }
                           },
                        });
                    case "cancel":
                        return false;
                }
            });
            $('.swal-modal').addClass('half'); // 버튼 스타일 때문에 추가
        }
    }

    /**
     * ===========================
     * 자료실 공유하기
     * ---------------------------
     */
    // 공유하기 선택 모달
    function shareReference(idx) {
        $(".share2").attr("onclick", "shareKakao('"+idx+"')");
        $("#snsModal").modal("show");
    }

    // 링크 공유하기 (복사)
    function shareLink() {
        $('#share_path').select();
        document.execCommand("Copy");
        swal('링크가 복사되었습니다.')
        .then(() =>{
            $('#snsModal').modal('hide');
        });
    }

    // 카카오 공유하기
    // SDK를 초기화 합니다. 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('<?=$kakao_javascript_key_new?>');
    // SDK 초기화 여부를 판단합니다.
    console.log(Kakao.isInitialized());
    function shareKakao() {
        showLoadingBar();
        setTimeout(function() {
            Kakao.Link.sendDefault({
                objectType: 'feed',
                content: {
                    title: '<?=$row['rr_subject']?>', // 타이틀
                    imageUrl:'<?=$thumb_path?>', // 썸네일 이미지 경로
                    imageWidth: 1200,
                    imageHeight: 630,
                    link: {
                        mobileWebUrl: '<?=$share_path?>', // 클릭 후 이동 경로
                        webUrl: '<?=$share_path?>', // 클릭 후 이동 경로
                    },
                },
                itemContent: {
                    profileText: '<?=$row['mb_id']?>',
                    profileImageUrl: '<?=$profile_path?>',
                },
                buttons: [
                    {
                        title: '자료 확인하기',
                        link: {
                            mobileWebUrl: '<?=$share_path?>', // 클릭 후 이동 경로
                            webUrl: '<?=$share_path?>', // 클릭 후 이동 경로
                        },
                    },
                ],
            });

            hideLoadingBar();
        }, 300);
    }

    /**
     * ===========================
     * 자료실 결제하기
     * ---------------------------
     */
    // 전액사용
    function allUse() {
        var my_bunker = $("#my_bunker").val(); // 보유벙커
        $("#use_bunker").val(my_bunker); // 사용벙커
        $("#pay_bunker").text(my_bunker); // 벙커사용

        calcBunker();
    }

    // 항상 보유 벙커 전액 사용
    function alwaysUse() {
        var my_bunker = removeComma($("#my_bunker").val()); // 보유벙커
        var rr_price = removeComma($("#rr_price").text()); // 자료금액

        // 항상 보유 벙커 전액 사용
        if($("#allUse").is(":checked")) {
            // 보유벙커가 자료금액보다 크면
            if (my_bunker > rr_price) my_bunker = number_format(rr_price.toString());
            $("#use_bunker").val(my_bunker); // 사용벙커
            $("#pay_bunker").text(my_bunker); // 벙커사용
        }

        calcPrice();
    }

    // 사용벙커 입력 시
    function calcBunker() {
        var my_bunker = removeComma($("#my_bunker").val()); // 보유벙커
        var use_bunker = removeComma($("#use_bunker").val()); // 사용벙커
        var rr_price = removeComma($("#rr_price").text()); // 자료금액
        console.log('보유: ', my_bunker);
        console.log('사용: ', use_bunker);

        // 사용벙커가 보유벙커보다 크면
        if(use_bunker > my_bunker) {
            swal("벙커가 부족합니다.");
            calcClear();
        }
        // 사용벙커가 자료금액보다 크면
        else if(use_bunker > rr_price) {
            use_bunker = number_format(rr_price.toString());
        }

        $("#use_bunker").val(use_bunker); // 사용벙커
        $("#pay_bunker").text(use_bunker); // 벙커사용

        calcPrice();
    }

    // 총 결제금액 계산
    function calcPrice() {
        var price = removeComma($("#rr_price").text());
        var bunker = removeComma($("#pay_bunker").text());
        // console.log('자료금액: ', price);
        // console.log('벙커사용: ', bunker);
        $("#pay_price").text(number_format((price - bunker).toString()));
    }

    // 계산 초기화
    function calcClear() {
        $("#use_bunker").val("");
        $("#pay_bunker").text(0);
        calcPrice();
    }

    // 결제하기
    function referPayment() {
        var pay_price = removeComma($("#pay_price").text());
        var use_bunker = removeComma($("#use_bunker").val());
        var allUse = $("#allUse").is(":checked") ? 'Y' : 'N';

        if(pay_price > 0) {
            // PG결제
            $('#Amt').val(pay_price);

            var moid = $("#Moid").val()+"-"+use_bunker+"-"+allUse;
            $("#Moid").val(moid);

            // 결제요청 함수
            var frm = document.payfrm;
            innopay.goPay({
                //// 필수 파라미터
                PayMethod: frm.PayMethod.value,     // 결제수단 (CARD,BANK,VBANK,CARS,CSMS,DSMS,EPAY,EBANK)
                MID: frm.MID.value,                 // 가맹점 MID
                MerchantKey:frm.MerchantKey.value,	// 가맹점 라이센스키
                GoodsName:frm.GoodsName.value,		// 상품명
                Amt:frm.Amt.value,					// 결제금액(과세)
                BuyerName:frm.BuyerName.value,		// 고객명
                BuyerTel:frm.BuyerTel.value,		// 고객전화번호
                BuyerEmail:frm.BuyerEmail.value,	// 고객이메일
                ResultYN:frm.ResultYN.value,		// 결제결과창 출력유뮤
                Moid:frm.Moid.value,		        // 가맹점에서 생성한 주문번호 셋팅
                //// 선택 파라미터
                ReturnURL:frm.ReturnURL.value,		// 결제결과 전송 URL(없는 경우 아래 innopay_result 함수에 결제결과가 전송됨)
                mallUserID : frm.mallUserID.value,	// 가맹점 고객ID
                EncodingType : 'utf-8',				// 가맹점 서버 인코딩 타입 (utf-8, euc-kr)
            });
        }
        else { // 결제금액이 0원이면 벙커로 전부 결제
            $.ajax({
                url: "./ajax.reference_action.php",
                type: "post",
                data: {price: use_bunker, idx: '<?=$idx?>', mode: "payment", all_use: allUse},
                success: function(data) {
                    if(data == 'success') {
                        $(".btn_wrap a").attr("onclick", "fileDownload('reference', '<?=$f_file?>', '<?=$f_filename?>')");
                        swal("자료가 결제되었습니다.\n다운로드를 시작합니다.")
                        .then(()=>{
                            $(".btn_wrap a").click();
                            $("#payModal").modal("hide");
                        });
                    }
                },
            });
        }
    }
</script>

<?
include_once('./fchatting.php');
include_once(G5_BBS_PATH.'/ajax_get_page.php');
include_once('./_tail.php');
?>

