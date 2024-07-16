<?php
include_once('./_common.php');

$g5['title'] = '프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '일반');
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:60%;}
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>프로필 업데이트</h3>
        <form id="fprofile" name="fprofile" method="post" autocomplete="off">
            <div id="area_join" class="profile">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li>
                                <em>1</em>
                                <span>Member Introduction</span>
                            </li>
                            <li>
                                <em>2</em>
                                <span>Work history</span>
                            </li>
                            <li class="active">
                                <em>3</em>
                                <span>Education, Major<span class="option">Optional</span></span>
                            </li>
                            <li>
                                <em>4</em>
                                <span>Possessed Skills, Certifications<span class="option">Optional</span></span>
                            </li>
                            <li>
                                <em>5</em>
                                <span>Additional Information</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
						<!-- 공개설정 -->
						<div class="box_private">
							<div class="btn_switch">
								<label class="switch-button">
									<input type="checkbox" id="all-chk" name="profile3_open" value="<?=$member['profile3_open'] == 'Y' ? 'Y' : 'N';?>" <?=$member['profile3_open'] == 'Y' ? 'checked' : '';?>>
									<span class="onoff-switch"></span>
								</label>	
							</div>
							<h5>Make Education, Major public</h5>
						</div>

                        <dl class="row">
                            <dt>School Name</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_school" name="mb_school" class="regist-input" placeholder="E.g.) Podosea high school, Podosea University">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>Major</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_school_major" name="mb_school_major" class="regist-input" placeholder="E.g.) Department of Podosea">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>State</dt>
                            <dd>
                                <div class="input">
                                    <select id="mb_school_state" name="mb_school_state" onchange="form_check();">
                                        <option value="" selected >상태</option>
                                        <option value='재학'>Currently attending</option>
                                        <option value='휴학'>On Leave</option>
                                        <option value='이수'>complete</option>
                                        <option value='졸업'>Graduated</option>
                                    </select>
                                </div>
                            </dd>
                        </dl>

                        <a href="javascript:add_data();" class="btn_confirm">Add more</a>

                        <ul class="profile_info">
                            <?php
                            $flag = false; // 저장된 학력/전공 정보가 있는지 확인
                            if(!empty($member['mb_education'])) {
                                $flag = true;
                                $mb_education = explode(',',$member['mb_education']);
                                for($k=0; $k<count($mb_education); $k++) {
                            ?>
                            <li class="info_<?=$k+1?>">
                                <div class="info"><?=$mb_education[$k]?></div>
                                <button type="button" class="btn_close" onclick="del_data(<?=$k+1?>);"></button>
                            </li>
                            <?php } } ?>
                        </ul>

                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('update02');"><em class="pc">Return to </em>previous step</span></a>
                            <!-- input 작성하면 다음버튼으로 나오게 해주세요 -->
                            <a href="javascript:void(0);" class="btn_next">Next</a>
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

        // input 전부 작성 시 다음 버튼으로 변경
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

    // 폼체크(학력/전공 입력 시 다음버튼 활성화)
    function form_check() {
        if($.trim($('#mb_school').val()).length != 0 && $.trim($('#mb_school_major').val()).length != 0 && $('#mb_school_state').val() != "") {
            $('.btn_confirm').addClass('active');
            $('.btn_confirm').attr('href', 'javascript:add_data();');
        } else {
            $('.btn_confirm').removeClass('active');
            $('.btn_confirm').attr('href', 'javascript:void(0);');
        }

        if($('.profile_info li').length > 0) {
            $('.btn_next').addClass('active');
            $('.btn_next').attr('href', 'javascript:profile_update();');
        } else {
            $('.btn_next').removeClass('active');
            $('.btn_next').attr('href', 'javascript:void(0);');
        }
    }

    // 학력, 전공 추가
    var num = '<?php echo (!empty($member['mb_education'])) ? count($mb_education)+1 : 1; ?>';
    function add_data() {
        if($.trim($('#mb_school').val()).length != 0 && $.trim($('#mb_school_major').val()).length != 0 && $('#mb_school_state').val() != "") {}
        else {
            swal('There is data that has not been entered.');
            return false;
        }

        var data = '<li class="info_'+num+'"><div class="info">'+$('#mb_school').val()+' &#183; '+$('#mb_school_major').val()+' &#183; '+$('#mb_school_state').val()+'</div><button type="button" class="btn_close" onclick="del_data('+num+');"></button></li>';
        $('.profile_info').append(data);
        $("#fprofile")[0].reset(); // 폼초기화
        if(all_chk_flag == 'Y') {
            $('#all-chk').attr('checked', true);
        }
        $('#all-chk').val(all_chk_flag);
        num++;

        form_check();
    }

    // 학력, 전공 삭제
    function del_data(num) {
        $('.info_'+num).remove();

        form_check();
    }

    // 프로필 업데이트 - 학력, 전공
    function profile_update() {
        var form = $('form')[0];
        var formData = new FormData(form);
        formData.append("mode", 'profile03');

        var education = '';
        $('.profile_info li div').each(function() {
            education += $.trim($(this).text()) + ',';
        });
        education = education.slice(0, -1);
        formData.append("mb_education", education);
        formData.append("profile3_open",  $('#all-chk').val());

        $.ajax({
            url : g5_bbs_url + "/ajax.profile_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data){
                    location.href = '<?php echo G5_BBS_URL ?>/profile_update04.php';
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