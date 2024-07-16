<?php
include_once('./_common.php');

$g5['title'] = '기업 프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '기업');
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:40%;}
	.profile_content h3{text-align:center !important;}
    .row .error.on {color: #ff0000; padding: unset;]
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>기업 프로필 업데이트</h3>
        <form method="post" autocomplete="off">
            <input type="hidden" id="reg_mb_id" value="<?=$member['mb_id']?>">
            <div id="area_join" class="profile">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li>
                                <em>1</em>
                                <span>회사요약</span>
                            </li>
                            <li class="active">
                                <em>2</em>
                                <span>회사 소개</span>
                            </li>
                            <li>
                                <em>3</em>
                                <span>인증서 및 자료</span>
                            </li>
                            <li>
                                <em>4</em>
                                <span>취급 제품 및 브랜드</span>
                            </li>
                            <li>
                                <em>5</em>
                                <span>해시태그</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <dl class="row">
                            <dt>회사소개</dt>
                            <dd>
                                <div class="input">
                                    <textarea id="mb_company_introduce" name="mb_company_introduce" placeholder="회사소개 내용을 입력해주세요." required><?=$member['mb_company_introduce']?></textarea>
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
                            <dt>회사전화<em>*선택</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" name="mb_company_tel" value="<?php echo $member['mb_company_tel'] ?>" id="reg_mb_company_tel" class="regist-input" placeholder="대표전화를 입력해 주세요.">
                                </div>
                            </dd>
                        </dl>

                        <dl class="row">
                            <dt>회사팩스<em>*선택</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" name="mb_company_fax" value="<?php echo $member['mb_company_fax'] ?>" id="reg_mb_company_fax" class="regist-input" placeholder="대표팩스를 입력해 주세요.">
                                </div>
                            </dd>
                        </dl>

                        <dl class="row">
                            <dt>사업자등록번호</dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" name="mb_company_num" value="<?php echo $member['mb_company_num'] ?>" id="reg_mb_company_num" class="regist-input required" required placeholder="사업자등록번호를 입력해 주세요.">
                                </div>
                            </dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>

                        <dl class="row">
                            <dt>대표명</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" name="mb_ceo" value="<?php echo $member['mb_ceo'] ?>" id="reg_mb_ceo" class="regist-input required" required placeholder="대표명을 입력해 주세요.">
                                </div>
                            </dd>
                        </dl>

                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('company_update01', '<?=$company?>');">이전단계<em class="pc">로 이동하기</em></span></a>
                            <!-- input 다작성하면 a class="active" 추가 -->
                            <a href="javascript:void(0);" class="btn_next">다음</a>
                            <a href="javascript:void(0);" class="btn_confirm home">수정완료</a>
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
        if($.trim($('#mb_company_introduce').val()).length != 0 && $.trim($('#reg_mb_ceo').val()).length != 0 && $.trim($('#reg_mb_company_num').val()).length != 0 && true_flag) {
            $('.btn_next').addClass('active');
            $('.btn_next').attr('href', 'javascript:profile_update("company", "profile02", "update03", "", "<?=$company?>");'); // (구분(일반/기업), 현재프로필단계, 저장후이동경로, 파일유무, 미니홈피이동)
            $('.home').addClass('active');
            var param1 = '<?=$company?>' == 'Y' ? 'home' : 'mypage';
            $('.home').attr('href', 'javascript:profile_update("company", "profile02", "update03", "", "'+param1+'");');
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
