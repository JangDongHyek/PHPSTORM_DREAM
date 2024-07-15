<?php
include_once('./_common.php');

$g5['title'] = '기업 프로필 업데이트';
include_once('./_head.php');

loginCheck($member['mb_id'], '기업');
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:100%;}
	.profile_content h3{text-align:center !important;}
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>기업 프로필 업데이트</h3>
        <div id="area_join" class="profile">
            <div id="join_info">
                <div class="profile_top">
                    <ul class="list_step">
                        <li>
                            <em>1</em>
                            <span>회사요약</span>
                        </li>
                        <li>
                            <em>2</em>
                            <span>회사 소개</span>
                        </li>
                        <li>
                            <em>3</em>
                            <span>인증, 카달로그, 소개영상</span>
                        </li>
                        <li>
                            <em>4</em>
                            <span>취급 제품 및 브랜드</span>
                        </li>
                        <li class="active">
                            <em>5</em>
                            <span>해시태그</span>
                        </li>
                    </ul>
                </div>
                <div class="profile_content">
                    <dl class="row">
                        <dt>해시태그</dt>
                        <dd>
                            <div class="input">
                                <div class="area_tag">
                                    <span class="span_tag" style="top: -3px; position: relative;">#</span>
                                    <input style="display: inline-block;width: calc( 100% - 20px);" type="text" class="input_tag" id="input_tag" placeholder="태그를 입력해 주세요 (엔터로 구분됩니다)" onkeyup="add_hash(this);lengthChk(this);">
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
                                    <em>※해시태그를 입력하시면, 해당 단어로 기업 검색시 우선 노출됩니다.</em>
                                    <em>※콤마(,)와 #은 입력할 수 없습니다.</em>
                                    <em>※Basic회원은 최대 5개, Premium회원은 최대 10개까지 등록할 수 있습니다.</em>
                                    <!--<em>※한글 또는 영문만 입력해 주세요.</em>-->
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
                        <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('company_update04', '<?=$company?>');">이전단계<em class="pc">로 이동하기</em></span></a>
                        <!-- input 다작성하면 a class="active" 추가 -->
                        <a href="javascript:void(0);" class="btn_next">프로필 저장하기</a>
                        <a href="javascript:void(0);" class="btn_confirm home">수정완료</a>
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
            var param1 = '<?=$company?>' == 'Y' ? 'home' : 'mypage';
            $('.home').attr('href', 'javascript:profile_update("'+param1+'");'); // (구분(일반/기업), 현재프로필단계, 저장후이동경로, 파일유무)
        } else {
            $('.btn_next').removeClass('active');
            $('.btn_next').attr('href', 'javascript:void(0);');
            $('.home').removeClass('active');
            $('.home').attr('href', 'javascript:void(0);');
        }
    }

    // #해시태그 등록
    var num = '<?php echo (!empty($member['mb_hashtag'])) ? count($mb_hashtag)+1 : 1; ?>';
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
            // 최대 5개 처리, 프리미엄 회원은 10개
            var max = 5;
            if('<?=$member['mb_grade']?>' == 'Premium') { max = 10; }
            if($('.tag_word').length == max) {
                swal('Basic 회원은 최대 5개\n Premium 회원은 최대 10개까지\n등록할 수 있습니다.');
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

        var hashtag = '';
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
                        swal("프로필이 저장되었습니다.")
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
