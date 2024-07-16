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
                                <span>회원소개</span>
                            </li>
                            <li>
                                <em>2</em>
                                <span>경력사항</span>
                            </li>
                            <li>
                                <em>3</em>
                                <span>학력, 전공</span>
                            </li>
                            <li>
                                <em>4</em>
                                <span>보유 기술, 자격증</span>
                            </li>
                            <li class="active">
                                <em>5</em>
                                <span>추가정보</span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <h3>추가정보를 작성해주세요.<em>선택사항</em></h3>
                        <dl class="row">
                            <dt>생년월일 (8자리)</dt>
                            <dd>
                                <div class="input">
                                    <input type="tel" id="mb_birth" name="mb_birth" value="<?=$member['mb_birth']?>" class="regist-input" maxlength="8" onkeyup="only_number(this);">
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>성별</dt>
                            <dd>
                                <div class="input type">
                                    <label class="selector">
                                        <input type="radio" id="mb_sex" name="mb_sex" value="여" <?php echo $member['mb_sex'] == '여' ? 'checked' : ''; ?>>
                                        <span>여성</span>
                                    </label>
                                        <label class="selector">
                                        <input type="radio" id="mb_sex" name="mb_sex" value="남" <?php echo $member['mb_sex'] == '남' ? 'checked' : ''; ?>>
                                        <span>남성</span>
                                    </label>
                                </div>
                            </dd>
                        </dl>

                        <dl class="row">
                            <dt>관심 키워드 설정(최대 10개)</dt>
                            <dd>
                                <div class="input">
                                    <div class="area_tag">
                                        <span class="span_tag" style="top: -3px; position: relative;">#</span>
                                        <input style="display: inline-block;width: calc( 100% - 20px);" type="text" class="input_tag" id="input_tag" placeholder="태그를 입력해 주세요(엔터로 구분)" onkeyup="add_hash(this);lengthChk(this);">
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
                                        <em>※해당 키워드를 바탕으로 추천 채용 및 헬프미 의뢰 발생시 알림 가능합니다.</em>
                                        <em>※콤마(',')와 #은 입력할 수 없습니다.</em>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>프로필 설정</dt>
                            <dd>
                                <ul class="check_list">
                                    <li>
                                        <input type="radio" name="profile" id="check01" value="all" <?php echo $member['profile'] == 'all' ? 'checked' : ''; ?>>
                                        <label for="check01">
                                            <span></span>
                                            <em>전체공개</em>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="profile" id="check02" value="friend" <?php echo $member['profile'] == 'friend' ? 'checked' : ''; ?>>
                                        <label for="check02">
                                            <span></span>
                                            <em>친구공개</em>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" name="profile" id="check03" value="private" <?php echo $member['profile'] == 'private' ? 'checked' : ''; ?>>
                                        <label for="check03">
                                            <span></span>
                                            <em>비공개</em>
                                        </label>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                        <div class="area_alarm">
                            <div class="box">
                                <h4>정보활용 및 마케팅 수신 동의</h4>
                                <span>포도씨에서 제공하는 각종 이벤트 정보 및 회원님의 프로필 및 태그기반 맞춤 정보 서비스(헬프미, 커리어)를 제공받으실 수 있습니다!</span>
                                <div class="input type">
                                    <label class="selector">
                                        <input type="checkbox" id="mb_push" name="mb_push" <?php echo $member['mb_push'] == 'Y' ? 'checked' : ''; ?>>
                                        <span><i></i>동의합니다.</span>
                                    </label>
                                </div>
                            </div>
                            <!--<em>※회원님의 개인정보 및 프로필 내용은 다른 회원에게 공개되지 않습니다.</em>-->
                        </div>

                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('update04');">이전단계<em class="pc">로 이동하기</em></span></a>
                            <a href="javascript:profile_update();" class="btn_next active">프로필 저장하기</a>
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
    function add_hash(data) {
        if(event.keyCode == 13) { // 엔터 누를 시 태그 생성
            event.preventDefault();

            // 빈칸 체크
            if($.trim(data.value).length == 0) {
                swal('태그를 입력해 주세요.');
                return false;
            }
            // 콤마 체크
            if(!isComma(data.value)) {
                swal('콤마는 입력할 수 없습니다.');
                $('#input_tag').val('');
                return false;
            }
            // 태그 체크
            if(!isTag(data.value)) {
                swal('#은 입력할 수 없습니다.');
                $('#input_tag').val('');
                return false;
            }
            // 최대 5개 처리
            if($('.tag_word').length == 10) {
                swal('최대 10개까지 등록할 수 있습니다.');
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

        var keyword = '';
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
