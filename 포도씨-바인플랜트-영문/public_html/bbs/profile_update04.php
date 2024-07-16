<?php
include_once('./_common.php');

$g5['title'] = '프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '일반');
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:80%;}
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
                            <li>
                                <em>3</em>
                                <span>Education, Major<span class="option">Optional</span></span>
                            </li>
                            <li class="active">
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
									<input type="checkbox" id="all-chk" name="profile4_open" value="<?=$member['profile4_open'] == 'Y' ? 'Y' : 'N';?>" <?=$member['profile4_open'] == 'Y' ? 'checked' : '';?>>
									<span class="onoff-switch"></span>
								</label>	
							</div>
							<h5>Make Possessed Skills, Certifications public</h5>
						</div>

                        <h3>Enter currently held certification(s).<em>Optional</em></h3>
                        <dl class="row">
                            <dt>Certificate Name</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_certificate" name="mb_certificate" class="regist-input" placeholder="E.g.) Podosea Master Level-I">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>Issuing Institute</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_certificate_office" name="mb_certificate_office" class="regist-input" placeholder="E.g.) Podosea">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>Date issued</dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_certificate_date" name="mb_certificate_date" readonly>
									<input type="button" class="calendar">
                                </div>
                            </dd>
                        </dl>

                        <a href="javascript:add_data();" class="btn_confirm">Add more</a>

                        <ul class="profile_info">
                        <?php
                        $flag = false; // 저장된 학력/전공 정보가 있는지 확인
                        if(!empty($member['mb_tech'])) {
                            $flag = true;
                            $mb_tech = explode(',',$member['mb_tech']);
                            for($k=0; $k<count($mb_tech); $k++) {
                            ?>
                            <li class="info_<?=$k+1?>">
                                <div class="info"><?=$mb_tech[$k]?></div>
                                <button type="button" class="btn_close" onclick="del_data(<?=$k+1?>);"></button>
                            </li>
                            <?php } } ?>
                        </ul>

                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('update03');"><em class="pc">Return to </em>previous step</span></a>
                            <!-- input 작성하면 다음버튼으로 나오게 해주세요 -->
                            <a href="<?php echo G5_BBS_URL ?>/profile_update05.php" class="btn_next active">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
<script>
    var all_chk_flag = 'N';
    $(function() {
        // monthpicker 옵션
        var options = {
            pattern: 'yyyy-mm',
            selectedYear: '<?=date('Y')?>',
            startYear: 1980,
            finalYear: '<?=date('Y')?>',
            monthNames: ['Jan.','Feb.','Mar.','Apr.','May.','Jun','Jul','Aug.','Sep.','Oct.','Nov.','Dec.'],
            openOnFocus: true,
        }
        $('.calendar').monthpicker(options);
        // monthpicker 열 때 클래스 추가
        $('.calendar').click(function() {
            if(!$('div').hasClass('month_bg')) { // month_bg라는 클래스가 이미 있으면 추가 X
                $('.ui-datepicker').after('<div class="month_bg"></div>');
            }
        });

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

    // 폼체크(보유기술/자격증 입력 시 다음버튼 활성화)
    function form_check() {
        if($.trim($('#mb_certificate').val()).length != 0 && $.trim($('#mb_certificate_office').val()).length != 0 && $.trim($('#mb_certificate_date').val()).length != 0) {
            $('.btn_confirm').addClass('active');
            $('.btn_confirm').attr('href', 'javascript:add_data();');
        } else {
            $('.btn_confirm').removeClass('active');
            $('.btn_confirm').attr('href', 'javascript:void(0);');
        }

        if($('.profile_info li').length > 0) {
            //$('.btn_next').text('다음');
            $('.btn_next').attr('href', 'javascript:profile_update();');
        } else {
            //$('.btn_next').text('건너뛰기');
            if('<?=$flag?>') {
                $('#all-chk').val('X');
                $('.btn_next').attr('href', 'javascript:profile_update();');
            } else {
                $('.btn_next').attr('href', '<?php echo G5_BBS_URL ?>/profile_update05.php');
            }
        }
    }

    // 학력, 전공 추가
    var num = '<?php echo (!empty($member['mb_tech'])) ? count($mb_tech)+1 : 1; ?>';
    function add_data() {
        if($.trim($('#mb_certificate').val()).length != 0 && $.trim($('#mb_certificate_office').val()).length != 0 && $.trim($('#mb_certificate_date').val()).length != 0) {}
        else {
            swal('There is data that has not been entered.');
            return false;
        }

        var data = '<li class="info_'+num+'"><div class="info">'+$('#mb_certificate').val()+' &#183; '+$('#mb_certificate_office').val()+' &#183; '+$('#mb_certificate_date').val()+'</div><button type="button" class="btn_close" onclick="del_data('+num+');"></button></li>';
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
    
    // 프로필 업데이트 - 보유 기술, 자격증
    function profile_update() {
        var form = $('form')[0];
        var formData = new FormData(form);
        formData.append("mode", 'profile04');

        var tech = '';
        $('.profile_info li div').each(function() {
            tech += $.trim($(this).text()) + ',';
        });
        tech = tech.slice(0, -1);
        formData.append("mb_tech", tech);
        formData.append("profile4_open",  $('#all-chk').val());

        $.ajax({
            url : g5_bbs_url + "/ajax.profile_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data){
                    location.href = '<?php echo G5_BBS_URL ?>/profile_update05.php';
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

