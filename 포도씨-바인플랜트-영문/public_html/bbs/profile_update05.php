<?php
include_once('./_common.php');

$g5['title'] = '프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '일반');
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:100%;}
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>프로필 업데이트</h3>
        <form name="fprofile" nonce="fprofile" method="post" autocomplete="off">
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
                            <li>
                                <em>4</em>
                                <span>Possessed Skills, Certifications<span class="option">Optional</span></span>
                            </li>
                            <li class="active">
                                <em>5</em>
                                <span>Additional Information</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <h3>Enter additional information.<em>Optional</em></h3>
                        <dl class="row">
                            <dt>Date of birth (8 digits)</dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" id="mb_birth" name="mb_birth" value="<?=$member['mb_birth']?>" class="regist-input" maxlength="8" onkeyup="only_number(this);">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>Gender</dt>
                            <dd>
                                <div class="input type">
                                    <label class="selector">
                                        <input type="radio" id="mb_sex" name="mb_sex" value="Female" <?php echo $member['mb_sex'] == '여' ? 'checked' : ''; ?>>
                                        <span>Female<span>
                                    </label>
                                        <label class="selector">
                                        <input type="radio" id="mb_sex" name="mb_sex" value="Male" <?php echo $member['mb_sex'] == '남' ? 'checked' : ''; ?>>
                                        <span>Male</span>
                                    </label>
                                </div>
                            </dd>
                        </dl>
					
                        <dl class="row">
                            <dt>Keywords of interest (maximum of 10 entries)</dt>
                            <dd>
                                <div class="input">
                                    <div class="area_tag">
                                        <input type="text" class="input_tag" id="input_tag" placeholder="Enter tag (separate by Enter key)" onkeyup="add_hash(this);lengthChk(this);">
                                        <!-- 단어입력하고 엔터 누르면 태그하나 생성되게해주세욤~~ -->
                                        <ul class="tag_list">
                                            <?php
                                            if(!empty($member['mb_keyword'])) {
                                                $mb_keyword = explode(',', $member['mb_keyword']);
                                                for($i=0; $i < count($mb_keyword); $i++) {
                                            ?>
                                            <li class="tag_<?=$i+1?>"><span class="tag_word"><?=$mb_keyword[$i]?><button type="button" class="btn_close" onclick="del_hash(<?=$i+1?>);"></button></span></li>
                                            <?php } } ?>
                                            <!--<li class=""><span class="tag_word">#취업 <button type="button" class="btn_close"></button></span></li>-->
                                        </ul>
                                        <em>※Employment recommendations and Help Me requests occurring through corresponding keywords can be viewed</em>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>Profile settings</dt>
                            <dd>
                                <ul class="check_list">
                                    <li>
                                        <input type="radio" name="profile" id="check01" value="all" <?php echo $member['profile'] == 'all' ? 'checked' : ''; ?>>
                                        <label for="check01">
                                            <span></span>
                                            <em>public</em>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="profile" id="check02" value="friend" <?php echo $member['profile'] == 'friend' ? 'checked' : ''; ?>>
                                        <label for="check02">
                                            <span></span>
                                            <em>Make friends public</em>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="profile" id="check03" value="private" <?php echo $member['profile'] == 'private' ? 'checked' : ''; ?>>
                                        <label for="check03">
                                            <span></span>
                                            <em>Make friends private</em>
                                        </label>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                        <div class="area_alarm">
                            <div class="box">
                                <h4>Notification Agreement</h4>
                                <span>Do agree to receive notifications based on your profile information (employment, Help Me requests, inquiry etc.)?</span>
                                <div class="input type">
                                    <label class="selector">
                                        <input type="checkbox" id="mb_push" name="mb_push" <?php echo $member['mb_push'] == 'Y' ? 'checked' : ''; ?>>
                                        <span><i></i>I Agree</span>
                                    </label>
                                </div>
                            </div>
                            <!--<em>※회원님의 개인정보 및 프로필 내용은 다른 회원에게 공개되지 않습니다.</em>-->
                        </div>

                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('update04');"><em class="pc">Return to </em>previous step</span></a>
                            <a href="javascript:profile_update();" class="btn_next active">Save Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<script>
    $(function() {
        // 알림동의
        $('#mb_push').on('change', function() {
            if($('#mb_push').prop('checked')) {
                $('#mb_push').val('Y');
            } else {
                $('#mb_push').val('');
            }
        });
    });

    // #해시태그 등록
    var num = '<?php echo (!empty($member['mb_keyword'])) ? count($mb_keyword)+1 : 1; ?>';
    var keyword = "";
    function add_hash(data) {
        if(event.keyCode == 13) { // 엔터 누를 시 태그 생성
            event.preventDefault();

            // 빈칸 체크
            if($.trim(data.value).length == 0) {
                swal('Please enter your tags.');
                return false;
            }
            // 최대 5개 처리
            if($('.tag_word').length == 10) {
                swal('You can register up to 10.');
                return false;
            }
            var tag = '<li class="tag_'+num+'"><span class="tag_word">#'+data.value+'<button type="button" class="btn_close" onclick="del_hash('+num+');"></button></span></li>';
            $('.tag_list').append(tag);
            $('#input_tag').val('');
            num++;
        }
    }

    // #해시태그 삭제
    function del_hash(num) {
        $('.tag_'+num).remove();
    }
    
    // 프로필 업데이트 - 추가정보
    function profile_update() {
        var form = $('form')[0];
        var formData = new FormData(form);
        formData.append("mode", 'profile05');

        $('.tag_list li span').each(function() {
            keyword += $(this).text() + ',';
        });
        keyword = keyword.slice(0, -1);
        formData.append("keyword", keyword);
        
        $.ajax({
            url : g5_bbs_url + "/ajax.profile_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data){
                    location.href = '<?php echo G5_BBS_URL ?>/mypage.php';
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