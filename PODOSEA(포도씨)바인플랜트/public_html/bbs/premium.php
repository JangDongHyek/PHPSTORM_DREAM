<?
include_once('./_common.php');
$name = "premium";
$g5['title'] = '프리미엄회원';
include_once('./_head.php');

loginCheck($member['mb_id']. $member['mb_category']);

if($member['mb_category'] != '기업') {
    alert('기업회원만 이용할 수 있습니다.');
}

// 신청 여부 체크
$cnt = sql_fetch(" select count(*) as cnt from g5_premium where mb_id = '{$member['mb_id']}' ")['cnt'];
if($cnt > 0) {
    alert('프리미엄 회원 신청을 완료하였습니다.');
}
?>

<? if($name=="premium") { ?>
    <body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="premium">
<?}?>

    <link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

    <style>
        #container{padding:0 0 50px;}
        .box_cont{margin:0;}
    </style>

<div id="area_charge">
    <div id="area_benefit">
        <h2 class="title">프리미엄 기업회원만의 혜택</h2>
        <div class="inr">
            <ul class="benefit_list">
                <li>
                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_benefit01.png"></div>
                    <div class="area_txt">
                        <h3>고객에게 더 빨리 <Br>다가 가세요</h3>
                        <ul class="list">
                            <li><span>기업 검색시 동일한 조건에서 가장 상위 노출</span></li>
                            <li><span>더 많은 검색 키워드 설정가능, 더 빠르게 자주 노출</span></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_benefit02.png"></div>
                    <div class="area_txt">
                        <h3>더 많은 비즈니스 <Br>기회를 얻으세요!</h3>
                        <ul class="list">
                            <li><span>포도씨가 직접 받은 의뢰는 프리미엄 회원에게 우선 연결</span></li>
                            <li><span>각종 홍보, 광고 이벤트에 우선 배정</span></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_benefit03.png"></div>
                    <div class="area_txt">
                        <h3>회사의 신뢰성을 <Br>확보하세요</h3>
                        <ul class="list">
                            <li><span>게시된 회사 정보를 포도씨 담당자가 <br>직접 방문 or 증빙서류로 확인</span></li>
                            <li><span>프리미엄 회원의 정보를 고객이 신뢰하고 거래 가능!</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div id="premium_form">
        <div class="top">
            <h2 class="title">프리미엄 회원 신청하기</h2>
            <span>아래 정보를 기재후, 신청하시면 포도씨 담당자가 연락드리도록 하겠습니다.</span>
        </div>

        <div id="charge_wrap">
            <ul class="area_filter">
                <li>
                    <input type="checkbox" id="filter01">
                    <label for="filter01">
                        <span></span>
                        <em>기업회원 정보와 동일</em>
                    </label>
                </li>
            </ul>

            <div id="box_charge">
                <form id="fpremium" name="fpremium" method="post" action="./premium_update.php">
                <ul class="form_list">
                    <li>
                        <div class="left">회사(단체)명</div>
                        <div class="right"><input type="text" id="company_name" name="company_name"></div>
                    </li>
                    <li>
                        <div class="left">담당자 성함</div>
                        <div class="right"><input type="text" id="mb_name" name="mb_name"></div>
                    </li>
                    <li>
                        <div class="left">연락처</div>
                        <div class="right"><input type="text" id="mb_hp" name="mb_hp" minlength="10" maxlength="14"></div>
                    </li>
                    <li>
                        <div class="left">이메일</div>
                        <div class="right"><input type="text" id="mb_email" name="mb_email"></div>
                    </li>
                    <li>
                        <div class="left">포도씨 파트너명</div>
                        <div class="right">
                            <input type="text" id="partner" name="partner">
                            <em>※선택사항 추천받은 파트너가 있는 경우, 기재해 주세요</em>
                        </div>
                    </li>
                </ul>
                </form>
                <div class="area_btn">
                    <a href="javascript:premiumRequest();" class="btn_next">신청하기</a>
                </div>
            </div>

        </div>
    </div>

    <div id="premium_bottom">
        <h3>지금 바로 신청 하시고, <span class="bold">프리미엄 회원의 특별한 혜택</span>을 누리세요!!</h3>
        <h3><span class="bold">기간한정 프로모션</span>을 확인하세요! </h3>
        <a href="<?=G5_BBS_URL?>/board.php?bo_table=notice&wr_id=4">프로모션 보기</a>

        <div></div>
    </div>

    <script>
        $(function() {
            // 기업회원 정보와 동일
            $('#filter01').click(function() {
                if($('#filter01').prop('checked')) { // 체크
                    $('#company_name').val('<?=$member['mb_company_name']?>');
                    $('#mb_name').val('<?=$member['mb_name']?>');
                    $('#mb_hp').val('<?=$member['mb_hp']?>');
                    $('#mb_email').val('<?=$member['mb_email']?>');
                } else { // 체크해제
                    $('#fpremium')[0].reset(); // 초기화
                }
            });

            $("#mb_hp").keydown(function (event) {
                var key = event.charCode || event.keyCode || 0;
                $text = $(this);
                if (key !== 8 && key !== 9) {
                    if ($text.val().length === 3) {
                        $text.val($text.val() + '-');
                    }
                    if ($text.val().length === 8) {
                        $text.val($text.val() + '-');
                    }
                }

                return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
            });
        });

        // 프리미엄 신청하기
        var is_post = false;
        function premiumRequest() {
            if(is_post) {
                is_post = false;
            }
            is_post = true;

            var f = $('#fpremium')[0];
            if($.trim(f.company_name.value).length == 0) {
                swal('회사(단체)명을 입력해 주세요.');
                is_post = false;
                return false;
            }
            if($.trim(f.mb_name.value).length == 0) {
                swal('담당자 성함을 입력해 주세요.');
                is_post = false;
                return false;
            }
            if($.trim(f.mb_hp.value).length == 0) {
                swal('연락처를 입력해 주세요.');
                is_post = false;
                return false;
            }
            if($.trim(f.mb_email.value).length == 0) {
                swal('이메일을 입력해 주세요.');
                is_post = false;
                return false;
            }

            $('#fpremium').submit();
        }
    </script>
<?
include_once('./_tail.php');
?>