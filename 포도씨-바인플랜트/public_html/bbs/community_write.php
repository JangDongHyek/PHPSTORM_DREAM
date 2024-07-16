<?
include_once('./_common.php');

$g5['title'] = '커뮤니티 글쓰기';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);

// 커뮤니티 글 정보
$comm = sql_fetch(" select * from g5_community where mb_id = '{$member['mb_id']}' and idx = '{$idx}'; ");

if($w == 'u') {
    if($comm['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
        alert('올바른 경로가 아닙니다.');
    }
}

$btn_txt = ($w == "" ? '등록' : '수정'); // 등록/수정 버튼 텍스트
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 140px;}
	#ft{display:none;}
</style>

<?php include_once('./category_community_modal.php'); ?>
<div id="area_community" class="write">
	<div id="sub_bn">
		<div class="txt">
			<h1><img src="<?php echo G5_IMG_URL ?>/community_txt.png"></h1>
			<span>포도씨 회원님들과 소통해보세요.</span>
		</div>
		<div class="img"><img src="<?php echo G5_IMG_URL ?>/community_obj.png"></div>
	</div>

	<div class="inr v4">

		<div id="help_list" class="write">
            <form id="fcommunity" name="fcommunity" method="post" autocomplete="off" action="<?=G5_BBS_URL?>/community_write_update.php">
                <input type="hidden" id="co_category" name="co_category" value="<?=$comm['co_category']?>">
                <input type="hidden" id="co_hashtag" name="co_hashtag" value="<?=$comm['co_hashtag']?>">
                <input type="hidden" id="idx" name="idx" value="<?=$idx?>">
                <input type="hidden" id="w" name="w" value="<?=$w?>">
                <div class="mbox_cate">
                    <span data-toggle="modal" data-target="#cateModal"><i></i>카테고리 선택</span>
                </div>
                <div class="w_filter cate">
                    <div class="cate">
                        <h3>카테고리</h3>
                        <div class="select_box v2">
                            <div class="box">
                                <div class="select">게시판을 선택해주세요.</div>
                                <ul class="list">
                                    <li class="selected">꿀팁</li>
                                    <li>일상 이런저런</li>
                                    <li>회사/현장 이야기</li>
                                    <li>해양뉴스</li>
                                    <li>긴급구인</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w_filter em_job noshow">
                <p>※ 아래 항목들은 모두 반드시 작성해주셔야 합니다. 누락  혹은 사실이 아닌 내용을 작성하셨을 경우, 삭제  될 수있으니 꼭 확인하시고 작성해주시기 바랍니다!</p>
                <p class="bold">1) 업체명,  2) 담당자 성명,  3) 연락처,  4) 업무내용/직종,  5) 모집인원,  6) 근무지역,  7) 조건(경력, 학력 등)</p>
                </div>

                <div class="help_write">
                    <div class="title">
                        <h3><input type="text" class="subject" id="co_subject" name="co_subject" value="<?=$comm['co_subject']?>" placeholder="제목을 입력해 주세요."> </h3>
                    </div>

                    <div class="bottom" id="editor" style="display: none;"></div>
                    <textarea id="co_contents" name="co_contents" class="noshow"><?=$comm['co_contents']?></textarea>
                </div>
                <!--<div class="w_filter hash">
                    <h3>#해시태그</h3>
                    <div class="area_tag">
                        <input type="text" class="input_tag" id="input_tag" placeholder="#질문에 맞는 태그를 입력해 주세요(최대 5개)" onkeyup="add_hash(this);">
                        <ul class="tag_list">
                            <?php
/*                            if(!empty($comm['co_hashtag'])) {
                                $comm_hashtag = explode(',', $comm['co_hashtag']);
                                for($i=0; $i < count($comm_hashtag); $i++) {
                            */?>
                            <li class="tag_<?/*=$i+1*/?>"><span class="tag_word"><?/*=$comm_hashtag[$i]*/?><button type="button" class="btn_close" onclick="del_hash(<?/*=$i+1*/?>);"></button></span></li>
                            <?php /*} } */?>
                        </ul>
                    </div>
                </div>-->
                <div class="w_filter">
                    <h3>공개설정</h3>
                    <ul class="area_filter">
                        <!--<li>
                            <input type="checkbox" id="open" <?php /*echo $w == '' ? 'checked' : '' */?> name="co_open" value="open" <?php /*echo $comm['co_open'] == 'open' ? 'checked' : ''; */?> onclick="checkOnlyOne(this);">
                            <label for="open">
                                <span></span>
                                <em>전체공개</em>
                            </label>
                        </li>-->
                        <li>
                            <input type="checkbox" id="private" name="co_open" value="private" <?php echo $comm['co_open'] == 'private' ? 'checked' : ''; ?>>
                            <label for="private">
                                <span></span>
                                <em>익명으로 등록하기</em>
                            </label>
                        </li>
                    </ul>
                </div>
                <button type="button" class="btn_confirm fixed" onclick="community_register();"><?=$btn_txt?>하기</button>
            </form>
		</div>
	</div>

</div>

<script>
    $(function() {
        // summernote
        var editor = $('#editor').summernote({
            height: 300, //(mobilecheck())? 150 : 300,
            lang: 'ko-KR',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'undo', 'redo']],
            ],
            callbacks: {
                onImageUpload:function(files){ // 이미지 업로드
                    sendFile(editor, files[0]);
                }
            }
        });

        // 카테고리(웹)
        $('.select_box.v2').click(function() {
            console.log(11);
        });

        // 카테고리(모바일)
        $('.cate_list li').click(function() {
            click_event('cate_list', $(this), 'active', 'co_category');

            var add_text = '';
            if($(this)[0]['innerText'] == '전체') { add_text += '<i></i>'; }
            $('.mbox_cate span').html(add_text + $(this)[0]['innerText'])
            $('#cateModal').modal('hide');

            // 커뮤니티 긴급구인 선택 시 작성 가이드라인 표시
            $('.em_job').addClass('noshow');
            if($(this)[0]['innerText'] == '긴급구인') {
                $('.em_job').removeClass('noshow');
            }
        });

        // 수정
        if('<?=$idx?>' != "") {
            // 카테고리
            $('.select_box.v2 .box .select').text("<?=$comm['co_category']?>");
            $('li:contains("<?=$comm['co_category']?>")').addClass('selected');

            // 내용
            $('#editor').summernote('code', $('#co_contents').val());
        }
    });

    // 클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
    function click_event(object, element, class_name, column) {
        $('.'+object+' li').removeClass(class_name);
        element.addClass(class_name);
        $('#'+column).val(element[0]['innerText']);
    }

    // #해시태그 등록
    var num = '<?php echo (!empty($comm['co_hashtag'])) ? count($comm_hashtag)+1 : 1; ?>';
    var hashtag = "";
    function add_hash(data) {
        if(event.keyCode == 13) { // 엔터 누를 시 태그 생성
            event.preventDefault();

            // 빈칸 체크
            if($.trim(data.value).length == 0) {
                swal('태그를 입력해 주세요.');
                return false;
            }
            // 최대 5개 처리
            if($('.tag_word').length == 5) {
                swal('최대 5개까지 등록할 수 있습니다.');
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

    // 커뮤니티등록
    function community_register() {
        $('#co_contents').val(editorCheck()); // 내용

        $('.tag_list li span').each(function() {
            hashtag += $(this).text() + ',';
        });
        hashtag = hashtag.slice(0, -1);
        $('#co_hashtag').val(hashtag); // 해시태그

        var f = $('#fcommunity')[0];
        if(f.co_category.value == "") {
            swal('카테고리를 선택해 주세요.');
            return false;
        }
        if($.trim(f.co_subject.value).length == 0) {
            swal('제목을 입력해 주세요.');
            return false;
        }
        if(f.co_contents.value == "") {
            swal('내용을 입력해 주세요.');
            return false;
        }
        // if($('.tag_word').length == 0) {
        //     swal('해시태그를 입력해 주세요.');
        //     return false;
        // }

        $('#fcommunity').submit();
    }
</script>

<?
include_once('./_tail.php');
?>