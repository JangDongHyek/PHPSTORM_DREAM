<?php
include_once('./_common.php');

$g5['title'] = 'Coporate profile management';
include_once('./_head.php');

loginCheck($member['mb_id'], '기업');

// 프로필작성완료여부 (해시태그작성완료)
$isProfileComp = false;
if(!empty($member['mb_hashtag'])) $isProfileComp = true;
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:40%;}
	.profile_content h3{text-align:center !important;}
    .row .error.on {color: #ff0000; padding: unset;]
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>Update Company Profile</h3>
        <form method="post" autocomplete="off">
            <input type="hidden" id="reg_mb_id" value="<?=$member['mb_id']?>">
            <div id="area_join" class="profile">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li>
                                <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update01.php'"<?php } ?>>1</em>
                            </li>
                            <li class="active">
                                <em>2</em>
                                <span>Company Introduction</span>
                            </li>
                            <li>
                                <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update03.php'"<?php } ?>>3</em>
                            </li>
                            <li>
                                <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update04.php'"<?php } ?>>4</em>
                            </li>
                            <li>
                                <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update05.php'"<?php } ?>>5</em>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <dl class="row">
                            <dt>Company introduction</dt>
                            <dd>
                                <div class="input">
                                    <textarea id="mb_company_introduce" name="mb_company_introduce" placeholder="Write company introduction." required><?=$member['mb_company_introduce']?></textarea>
                                </div>
                            </dd>
                        </dl>

                        <!--<dl class="row">
                            <dt>영문 회사 소개<em>*선택</em></dt>
                            <dd>
                                <div class="input">
                                    <textarea id="mb_company_introduce_eng" name="mb_company_introduce_eng" placeholder="회사소개 내용을 입력해주세요."><?/*=$member['mb_company_introduce_eng']*/?></textarea>
                                </div>
                            </dd>
                        </dl>-->

                        <dl class="row">
                            <dt>Representative</dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" name="mb_ceo" value="<?php echo $member['mb_ceo'] ?>" id="reg_mb_ceo" class="regist-input required" required placeholder="Enter Name of Representative">
                                </div>
                            </dd>
                        </dl>

                        <dl class="row">
                            <dt>Main Phone Number <em>*optional</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" name="mb_company_tel" value="<?php echo $member['mb_company_tel'] ?>" id="reg_mb_company_tel" class="regist-input" placeholder="Enter Phone Number">
                                </div>
                            </dd>
                        </dl>

                        <dl class="row">
                            <dt>Main Fax Number<em>*optional</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" name="mb_company_fax" value="<?php echo $member['mb_company_fax'] ?>" id="reg_mb_company_fax" class="regist-input" placeholder="Enter Fax Number">
                                </div>
                            </dd>
                        </dl>

                        <dl class="row">
                            <dt>Business Registration Number<em>*optional</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" name="mb_company_num" value="<?php echo $member['mb_company_num'] ?>" id="reg_mb_company_num" class="regist-input required" required placeholder="Enter Business Registration Number">
                                </div>
                            </dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>

                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('company_update01', '<?=$company?>');">Go to <em class="pc">Previous step</em></span></a>
                            <!-- input 다작성하면 a class="active" 추가 -->
                            <a href="javascript:void(0);" class="btn_next">NEXT</a>
                            <?php if($company == 'Y' || $isProfileComp) { ?>
                            <a href="javascript:void(0);" class="btn_confirm home">Modify Complete</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<script>
    var true_flag = true;
    $(function() {
        form_check();

        // input 전부 작성 시 active 클래스 추가
        $(":input").on("change keyup", function(e) {
            form_check();
        });
    });

    // 폼체크(필수값)
    function form_check() {
        if($.trim($('#mb_company_introduce').val()).length != 0 && $.trim($('#reg_mb_ceo').val()).length != 0 && true_flag) {
            $('.btn_next').addClass('active');
            $('.btn_next').attr('href', 'javascript:profile_update("company", "profile02", "update03", "", "<?=$company?>");'); // (구분(일반/기업), 현재프로필단계, 저장후이동경로, 파일유무, 미니홈피이동)
            $('.home').addClass('active');
            $('.home').attr('href', 'javascript:profile_update("company", "profile02", "update03", "", "home");');
        } else {
            $('.btn_next').removeClass('active');
            $('.btn_next').attr('href', 'javascript:void(0);');
            $('.home').removeClass('active');
            $('.home').attr('href', 'javascript:void(0);');
        }
    }

    // 사업자등록번호 중복체크
    $("#reg_mb_company_num").keyup(function (){
        // 공백제거
        $(this).val($(this).val().replace(/ /gi, ''));
        var state = $(this).parents(".row").find(".status_ico");
        var err = $(this).parents(".row").find(".error");

        var msg = reg_mb_company_num_check();
        if (msg) {
            state.removeClass("pas").addClass("err");
            err.addClass("on").html(msg);
            true_flag = false;
        } else {
            state.removeClass("err").addClass("pas");
            err.html("");
            true_flag = true;
        }
    });
</script>

<?
include_once('./_tail.php');
?>
