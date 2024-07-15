<?php
include_once('./_common.php');

$g5['title'] = '프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '일반');

// 학생 또는 취업준비생이면 경력사항은 선택으로 입력 가능하도록
$skip_flag = false;
if($member['mb_active_business'] == 1) { $skip_flag = true; }
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:40%;}
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>프로필 업데이트</h3>
        <form id="fprofile" name="fprofile" method="post" autocomplete="off">
            <input type="hidden" id="mb_free" name="mb_free" value="<?=$member['mb_free']?>">
            <div id="area_join" class="profile">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li>
                                <em>1</em>
                                <span>회원소개</span>
                            </li>
                            <li class="active">
                                <em>2</em>
                                <span>경력사항</span>
                            </li>
                            <li>
                                <em>3</em>
                                <span>학력, 전공 <span class="option">선택사항</span></span>
                            </li>
                            <li>
                                <em>4</em>
                                <span>보유 기술, 자격증 <span class="option">선택사항</span></span>
                            </li>
                            <li>
                                <em>5</em>
                                <span>추가정보</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
						
						<!-- 공개설정 -->
						<div class="box_private">
							<div class="btn_switch">
								<label class="switch-button">
									<input type="checkbox" id="all-chk" name="profile2_open" value="<?=$member['profile2_open'] == 'Y' ? 'Y' : 'N';?>" <?=$member['profile2_open'] == 'Y' ? 'checked' : '';?>>
									<span class="onoff-switch"></span>
								</label>
							</div>
							<h5>경력사항 공개</h5>
						</div>

                        <!-- 클릭했을때 클래스 checked 추가 / 삭제 -->
                        <div class="area_check" id="free_check" onclick="free_check();">
                            <span>프리랜서인 경우 체크해주세요.</span>
                            <i class="icon_check"></i>
                        </div>
                        <!-- 프리랜서 체크 했을때 입력안되게 해주세여~ -->
                        <dl class="row">
                            <dt>회사</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_company" name="mb_company" value="<?=$member['mb_company']?>" class="regist-input no_free" required placeholder="예)포도씨">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>근무부서</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_department" name="mb_department" value="<?=$member['mb_department']?>" class="regist-input no_free" required placeholder="예)개발팀">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>직위</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_position" name="mb_position" value="<?=$member['mb_position']?>" class="regist-input no_free" required placeholder="예)사원">
                                </div>
                            </dd>
                        </dl>
                        <!-- // 프리랜서 체크 했을때 입력안되게 해주세여~ -->
                        <dl class="row">
                            <dt>근무기간</dt>
                            <dd>
                                <div class="input">
                                    <div class="box">
                                        <select id="mb_work_year" name="mb_work_year" onchange="form_check();">
                                            <option value="" selected >년</option>
                                            <?php for($i=1; $i<=50; $i++) { ?>
                                            <option value='<?=$i?>'><?=$i?>년</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="box">
                                        <select id="mb_work_month" name="mb_work_month" onchange="form_check();">
                                            <option value="" selected >개월</option>
                                            <?php for($j=1; $j<=11; $j++) { ?>
                                            <option value='<?=$j?>'><?=$j?>개월</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </dd>
                        </dl>

                        <!-- input 다작성하면 a class="active" 추가 -->
						<a href="javascript:add_data();" class="btn_confirm">추가하기</a>

						<ul class="profile_info">
                            <?php
                            $flag = false; // 저장된 경력사항 정보가 있는지 확인
                            if(!empty($member['mb_career'])) {
                                $flag = true;
                                $mb_career = explode(',',$member['mb_career']);
                                for($k=0; $k<count($mb_career); $k++) {
                            ?>
                            <li class="info_<?=$k+1?>">
                                <div class="info"><?=$mb_career[$k]?></div>
                                <button type="button" class="btn_close" onclick="del_data(<?=$k+1?>);"></button>
                            </li>
                            <?php } } ?>
							<!--<li>
								<div class="info">포도씨 &#183; 개발팀 &#183; 사원 &#183; 3년 4개월 &#183; 개발팀 &#183; 사원 &#183; 3년 4개월</div>
								<button type="button" class="btn_close"></button>
							</li>-->
						</ul>

                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('update01');">이전단계<em class="pc">로 이동하기</em></span></a>
                            <!-- input 다작성하면 a class="active" 추가 -->
                            <?php if($skip_flag) { ?>
                            <a href="<?php echo G5_BBS_URL ?>/profile_update03.php" class="btn_next active">다음</a>
                            <?php } else { ?>
                            <a href="javascript:void(0);" class="btn_next">다음</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<script>
    var all_chk_flag = 'N';
    $(function() {
        form_check();

        // input 전부 작성 시 active 클래스 추가
        $(":input").on("change keyup", function(e) {
            form_check();
        });

        // 프로필 공개여부 설정
        $('#all-chk').click(function() {
            if($('#all-chk').prop('checked')) { // 체크
                $('#all-chk').val('Y');
                all_chk_flag = 'Y';
            } else { // 체크해제
                $('#all-chk').val('N');
                all_chk_flag = 'N';
            }
        });
    });

    // 폼체크(필수값)
    function form_check() {
        if(($('#mb_free').val() == 'Y' && ($('#mb_work_year').val() != '' || $('#mb_work_month').val() != '')) ||
            ($.trim($('#mb_company').val()).length != 0 && $.trim($('#mb_department').val()).length != 0 && $.trim($('#mb_position').val()).length != 0) && ($('#mb_work_year').val() != '' || $('#mb_work_month').val() != '')) {
            $('.btn_confirm').addClass('active');
            $('.btn_confirm').attr('href', 'javascript:add_data();');
        } else {
            $('.btn_confirm').removeClass('active');
            $('.btn_confirm').attr('href', 'javascript:void(0);');
        }

        if($('.profile_info li').length > 0) {
            if('<?=$skip_flag?>') {
                //$('.btn_next').text('다음');
            }
            $('.btn_next').addClass('active');
            $('.btn_next').attr('href', 'javascript:profile_update();');
        } else {
            if('<?=$skip_flag?>') {
                //$('.btn_next').text('건너뛰기');
                if('<?=$flag?>') {
                    $('#all-chk').val('X');
                    $('.btn_next').attr('href', 'javascript:profile_update();');
                } else {
                    $('.btn_next').attr('href', '<?php echo G5_BBS_URL ?>/profile_update03.php');
                }
            } else {
                $('.btn_next').removeClass('active');
                $('.btn_next').attr('href', 'javascript:void(0);');
            }
        }
    }

    // 프리랜서 체크
    function free_check() {
        if($('#free_check').attr('class').indexOf('checked') != -1) { // 체크되어있는 상태면 체크해제
            $('#free_check').removeClass('checked'); // 프리랜서 아님
            //$('.no_free').attr('disabled', false); // 프리랜서 X = 회사/근무부서/직위 입력
            $('#mb_free').val('');
            $('#mb_position').val('');
        } else {
            $('#free_check').addClass('checked'); // 프리랜서
            //$('.no_free').attr('disabled', true); // 프리랜서 O = 회사/근무부서/직위 입력 불가
            //$('.no_free').val('');
            $('#mb_free').val('Y');
            $('#mb_position').val('프리랜서');
        }
    }

    // 경력사항 추가
    var num = '<?php echo (!empty($member['mb_career'])) ? count($mb_career)+1 : 1; ?>';
    function add_data() {
        if($.trim($('#mb_company').val()).length != 0 && $.trim($('#mb_department').val()).length != 0 && $.trim($('#mb_position').val()).length != 0 && ($('#mb_work_year').val() != '' || $('#mb_work_month').val() != '')) {
            var year_month = '';
            if($('#mb_work_year').val() != '' && $('#mb_work_month').val() != '') {
                year_month += $('#mb_work_year').val()+'년 '+$('#mb_work_month').val()+'개월';
            } else if($('#mb_work_year').val() != '' && $('#mb_work_month').val() == '') {
                year_month += $('#mb_work_year').val()+'년';
            } else if($('#mb_work_year').val() == '' && $('#mb_work_month').val() != '') {
                year_month += $('#mb_work_month').val()+'개월';
            }
        }
        else {
            swal('입력하지 않은 데이터가 있습니다.');
            return false;
        }

        var data = '<li class="info_'+num+'"><div class="info">'+$('#mb_company').val()+' &#183; '+$('#mb_department').val()+' &#183; '+$('#mb_position').val()+' &#183; '+year_month+'</div><button type="button" class="btn_close" onclick="del_data('+num+');"></button></li>';
        if($('#mb_free').val() == 'Y') {
            data = '<li class="info_'+num+'"><div class="info">'+$('#mb_company').val()+' &#183; '+$('#mb_department').val()+' &#183; '+$('#mb_position').val()+' &#183; '+year_month+' &#183; 프리랜서</div><button type="button" class="btn_close" onclick="del_data('+num+');"></button></li>';
        }
        $('.profile_info').append(data);
        $("#fprofile")[0].reset(); // 폼초기화
        $('#mb_free').val('');
        $('#free_check').removeClass('checked');
        if(all_chk_flag == 'Y') {
            $('#all-chk').attr('checked', true);
        }
        $('#all-chk').val(all_chk_flag);
        num++;

        form_check();
    }

    // 경력사항 삭제
    function del_data(num) {
        $('.info_'+num).remove();

        form_check();
    }

    // 프로필 업데이트 - 경력사항
    function profile_update() {
        var form = $('form')[0];
        var formData = new FormData(form);
        formData.append("mode", 'profile02');

        var career = '';
        $('.profile_info li div').each(function() {
            career += $.trim($(this).text()) + ',';
        });
        career = career.slice(0, -1);
        formData.append("mb_career", career);
        formData.append("profile2_open",  $('#all-chk').val());

        $.ajax({
            url : g5_bbs_url + "/ajax.profile_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data){
                    location.href = '<?php echo G5_BBS_URL ?>/profile_update03.php';
                }
            },
            err : function(err) {
                swal(err.status);
            }
        });
    }
</script>

<?
include_once('./_tail.php');
?>