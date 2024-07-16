<?
include_once('./_common.php');
$name = "premium";
$g5['title'] = 'Premium Member';
include_once('./_head.php');

loginCheck($member['mb_id']. $member['mb_category']);

if($member['mb_category'] != '기업') {
    alert('Only corporate members can use it.');
}

// 신청 여부 체크
$cnt = sql_fetch(" select count(*) as cnt from g5_premium where mb_id = '{$member['mb_id']}' ")['cnt'];
if($cnt > 0) {
//    alert('프리미엄 회원 신청을 완료하였습니다.');
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
        <h2 class="title">The benefits exclusive to premium membership.</h2>
        <div class="inr">
            <ul class="benefit_list">
                <li>
                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_benefit01.png"></div>
                    <div class="area_txt">
                        <h3>Reach your customers  <Br>even faster!</h3>
                        <ul class="list">
                            <li><span>Even under the same conditions, your company will be shown at the very top of “Search for Company” results.</span></li>
                            <li><span>Raise the search result value of your company by adding more search keywords.</span></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_benefit02.png"></div>
                    <div class="area_txt">
                        <h3>Gain more business <Br>opportunities!</h3>
                        <ul class="list">
                            <li><span>Priority connection with any RFQs posted through “Podosea Direct RFQ”.</span></li>
                            <li><span>Gain priority placements for various advertisements and events within Podosea.</span></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/img_benefit03.png"></div>
                    <div class="area_txt">
                        <h3>Secure the company's <Br>credibility!</h3>
                        <ul class="list">
                            <li><span>Company information posted online will be verified directly by a Podosea staff member (through visitation or submission of appropriate documents).</span></li>
                            <li><span>Emphasize credibility and integrity to other companies by becoming a “Certified Company”.</span></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div id="premium_form">
        <div class="top">
            <h2 class="title">Submit an application for premium membership</h2>
            <span>When your application is received, a representative from Podosea will contact you.</span>
        </div>

        <div id="charge_wrap">
            <ul class="area_filter">
                <li>
                    <input type="checkbox" id="filter01">
                    <label for="filter01">
                        <span></span>
                        <em>Same as corporate member information</em>
                    </label>
                </li>
            </ul>

            <div id="box_charge">
                <form id="fpremium" name="fpremium" method="post" action="./premium_update.php">
                <ul class="form_list">
                    <li>
                        <div class="left">COMPANY</div>
                        <div class="right"><input type="text" id="company_name" name="company_name"></div>
                    </li>
                    <li>
                        <div class="left">NAME</div>
                        <div class="right"><input type="text" id="mb_name" name="mb_name"></div>
                    </li>
                    <li>
                        <div class="left">PHONE NUMBER</div>
                        <div class="right"><input type="text" id="mb_hp" name="mb_hp" minlength="10" maxlength="14"></div>
                    </li>
                    <li>
                        <div class="left">EMAIL</div>
                        <div class="right"><input type="text" id="mb_email" name="mb_email"></div>
                    </li>
                    <li>
                        <div class="left">PODOSEA PARTNER NAME</div>
                        <div class="right">
                            <input type="text" id="partner" name="partner">
                            <em>If there is a partner who recommended podosea, please list it.</em>
                        </div>
                    </li>
                </ul>
                </form>
                <div class="area_btn">
                    <a href="javascript:premiumRequest();" class="btn_next">SUBMIT</a>
                </div>
            </div>

        </div>
    </div>

    <!--div id="premium_bottom">
        <h3>지금 바로 신청 하시고, <span class="bold">프리미엄 회원의 특별한 혜택</span>을 누리세요!!</h3>
        <h3><span class="bold">기간한정 프로모션</span>을 확인하세요! </h3>
        <a href="<?=G5_BBS_URL?>/board.php?bo_table=notice&wr_id=4">프로모션 보기</a>

        <div></div>
    </div-->

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