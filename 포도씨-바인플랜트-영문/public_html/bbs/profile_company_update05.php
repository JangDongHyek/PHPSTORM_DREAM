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
	.profile_top .list_step > li.active:before{width:100%;}
	.profile_content h3{text-align:center !important;}
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>Update Company Profile</h3>
        <div id="area_join" class="profile">
            <div id="join_info">
                <div class="profile_top">
                    <ul class="list_step">
                        <li>
                            <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update01.php'"<?php } ?>>1</em>
                        </li>
                        <li>
                            <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update02.php'"<?php } ?>>2</em>
                        </li>
                        <li>
                            <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update03.php'"<?php } ?>>3</em>
                        </li>
                        <li>
                            <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update04.php'"<?php } ?>>4</em>
                        </li>
                        <li class="active">
                            <em>5</em>
                            <span>Hashtag</span>
                        </li>
                    </ul>
                </div>
                <div class="profile_content">
                    <dl class="row">
                        <dt>Hashtag (maximum of 5 entries)</dt>
                        <dd>
                            <div class="input">
                                <div class="area_tag">
                                    <input type="text" class="input_tag" id="input_tag" placeholder="Enter Tags (Separated by Enter Key)" onkeyup="add_hash(this);lengthChk(this);">
                                    <!-- 단어입력하고 엔터 누르면 태그하나 생성되게해주세욤~~ -->
                                    <ul class="tag_list">
                                        <?php
                                        if(!empty($member['mb_hashtag'])) {
                                            $mb_hashtag = explode(',', $member['mb_hashtag']);
                                            for($i=0; $i < count($mb_hashtag); $i++) {
                                        ?>
                                        <li class="tag_<?=$i+1?>"><span class="tag_word"><?=$mb_hashtag[$i]?><button type="button" class="btn_close" onclick="del_hash(<?=$i+1?>);"></button></span></li>
                                        <?php } } ?>
                                        <!--<li class=""><span class="tag_word">#취업 <button type="button" class="btn_close"></button></span></li>-->
                                    </ul>
                                    <em>※Companies searched by attached hashtags will receive priority visibility.</em>
                                    <em>※Please enter Korean or English only.</em>
                                </div>
                            </div>
                        </dd>
                    </dl>
					<!--<dl class="row">
                        <dt>프로필 설정</dt>
                        <dd>
							<ul class="check_list">
								<li>
									<input type="radio" name="profile" id="check01">
									<label for="check01">
										<span></span>
										<em>전체공개</em>
									</label>
								</li>
								<li>
									<input type="radio" name="profile" id="check02">
									<label for="check02">
										<span></span>
										<em>친구공개</em>
									</label>
								</li>
								<li>
									<input type="radio" name="profile" id="check03">
									<label for="check03">
										<span></span>
										<em>비공개</em>
									</label>
								</li>
							</ul>
                        </dd>
                    </dl>-->
                    <div class="area_btn">
                        <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('company_update04', '<?=$company?>');">Go to <em class="pc">Previous step</em></span></a>
                        <!-- input 다작성하면 a class="active" 추가 -->
                        <a href="javascript:void(0);" class="btn_next">Save your profile</a>
                        <?php if($company == 'Y' || $isProfileComp) { ?>
                        <a href="javascript:void(0);" class="btn_confirm home">Modify Complete</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
	</article>
</div>

<script>
    $(function() {
        form_check();

        // input 전부 작성 시 active 클래스 추가
        $(":input").on("change keyup", function(e) {
            form_check();
        });
    });

    // 폼체크(필수값)
    function form_check() {
        if($('.tag_word').length > 0) {
            $('.btn_next').addClass('active');
            $('.btn_next').attr('href', 'javascript:profile_update("<?=$company?>");'); // (구분(일반/기업), 현재프로필단계, 저장후이동경로, 파일유무)
            $('.home').addClass('active');
            $('.home').attr('href', 'javascript:profile_update("home");'); // (구분(일반/기업), 현재프로필단계, 저장후이동경로, 파일유무)
        } else {
            $('.btn_next').removeClass('active');
            $('.btn_next').attr('href', 'javascript:void(0);');
            $('.home').removeClass('active');
            $('.home').attr('href', 'javascript:void(0);');
        }
    }

    // #해시태그 등록
    var num = '<?php echo (!empty($member['mb_hashtag'])) ? count($mb_hashtag)+1 : 1; ?>';
    var hashtag = "";
    function add_hash(data) {
        if(event.keyCode == 13) { // 엔터 누를 시 태그 생성
            event.preventDefault();

            // 빈칸 체크
            if($.trim(data.value).length == 0) {
                swal('Please enter a hashtag.');
                return false;
            }
            // 최대 5개 처리
            if($('.tag_word').length == 5) {
                swal('You can register up to 5.');
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
        form_check();
    }

    // 프로필 업데이트 - 해시태그
    function profile_update(home) {
        var form = $('form')[0];
        var formData = new FormData(form);
        formData.append("mode", 'profile05');

        $('.tag_list li span').each(function() {
            hashtag += $(this).text() + ',';
        });
        hashtag = hashtag.slice(0, -1);
        formData.append("hashtag", hashtag);

        $.ajax({
            url : g5_bbs_url + "/ajax.profile_company_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data){
                    if(home == 'home') { // 기업미니홈피 이동
                        location.href = '<?php echo G5_BBS_URL ?>/company.php?mb_no=<?=$member['mb_no']?>';
                    } else {
                        swal("Profile saved complete.")
                        .then(()=>{
                            location.href = '<?php echo G5_BBS_URL ?>/mypage_company.php';
                        });
                    }
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
