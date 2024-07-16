<?
include_once('./_common.php');

$g5['title'] = 'Help Me';
include_once('./_head.php');

if(!$is_member) {
    alert('please try again after logging in.', G5_BBS_URL.'/login.php');
}

$help = sql_fetch(" select * from g5_helpme where mb_id = '{$member['mb_id']}' and idx = '{$idx}'; ");

if($w == 'u') {
    if($help['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
        alert('not the correct path.');
    }
}

$btn_txt = ($w == "" ? 'Post answer' : 'Modify'); // 등록/수정 버튼 텍스트
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<?php include_once('./category_modal.php'); ?>

<style>
	#ft{display:none;}
</style>
<div id="area_help">
	<div class="inr">
		<div id="top_bn">
			<div class="txt">
				<h2>Help Me</h2>
				<span>Ask us about anything related to shipbuilding and offshore business!</span>
			</div>
			<img src="<?php echo G5_IMG_URL ?>/bn_obj.png">
		</div>
		<div id="help_warp">
			<?php include_once('./left_menu.php'); ?>
            <div id="help_list" class="write">
                <form id="fhelpme" name="fhelpme" method="post" autocomplete="off" action="<?=G5_BBS_URL?>/help_write_update.php">
                    <input type="hidden" id="he_category" name="he_category" value="<?=$help['he_category']?>">
                    <input type="hidden" id="he_hashtag" name="he_hashtag" value="<?=$help['he_hashtag']?>">
                    <input type="hidden" id="idx" name="idx" value="<?=$idx?>">
                    <input type="hidden" id="w" name="w" value="<?=$w?>">
                    <div class="mbox_cate">
                        <span data-toggle="modal" data-target="#cateModal"><i></i>Choose category</span>
                    </div>
                    <div class="w_filter cate">
                        <div class="cate">
                            <h3>Category</h3>
                            <div class="select_box v2">
                                <div class="box">
                                    <div class="select">please select.</div>
                                    <ul class="list">
                                        <li>Sailing, navigation</li>
                                        <li>Marine engineering</li>
                                        <li>Shipbuilding & Repair</li>
                                        <li>Offshore, plant</li>
                                        <li>Fishery</li>
                                        <li>Shipping, Transport</li>
                                        <li>Harbors, logistics</li>
                                        <li>Others</li>
                                        <li>Q&A</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="help_write">
                        <div class="title">
                            <h3><input type="text" id="he_subject" name="he_subject" value="<?=$help['he_subject']?>" class="subject" placeholder="Please enter the subject." required> </h3>
                        </div>

                        <div class="bottom" id="editor" style="display: none;"></div>
                        <textarea id="he_contents" name="he_contents" class="noshow"><?=$help['he_contents']?></textarea>
                    </div>
                    <div class="w_filter hash">
                        <h3>#HASHTAG</h3>
                        <div class="area_tag">
                            <input type="text" class="input_tag" id="input_tag" placeholder="#Please enter tags that match the question (separated by enter, max. 5)" onkeyup="add_hash(this);lengthChk(this);">
                            <ul class="tag_list">
                                <?php
                                if(!empty($help['he_hashtag'])) {
                                    $he_hashtag = explode(',', $help['he_hashtag']);
                                    for($i=0; $i < count($he_hashtag); $i++) {
                                ?>
                                <li class="tag_<?=$i+1?>"><span class="tag_word"><?=$he_hashtag[$i]?><button type="button" class="btn_close" onclick="del_hash(<?=$i+1?>);"></button></span></li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>
                    <!--<div class="w_filter">
                        <h3>공개설정</h3>
                        <ul class="area_filter">
                            <li>
                                <input type="checkbox" id="open" <?php /*echo $w == '' ? 'checked' : '' */?> name="he_open" value="open" <?php /*echo $help['he_open'] == 'open' ? 'checked' : ''; */?> onclick="checkOnlyOne(this);">
                                <label for="open">
                                    <span></span>
                                    <em>전체공개</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="questioner" name="he_open" value="questioner" <?php /*echo $help['he_open'] == 'questioner' ? 'checked' : ''; */?> onclick="checkOnlyOne(this);">
                                <label for="questioner">
                                    <label for="questioner">
                                        <span></span>
                                        <em>질문자만 공개</em>
                                    </label>
                                </label>
                            </li>
                        </ul>
                    </div>-->
                    <div class="w_filter hash">
                        <h3>BUNKER</h3>
                        <div class="area_tag">
                            <input type="number" class="input_tag bunker" id="he_bunker" name="he_bunker" <?php echo $w == 'u' ? 'readonly' : '' ?> value="<?php echo !empty($help['he_bunker']) ? number_format($help['he_bunker']) : ''; ?>" placeholder="Please enter a bunker (bunkers will be credited to the respondent who responded)" onkeyup="only_number(this);bunker_check(this.value, <?=$member['mb_bunker']?>+<?=$member['mb_bunker_bonus']?>);">
                        </div>
                    </div>
                    <button type="button" class="btn_confirm fixed" onclick="helpme_register();"><?=$btn_txt?></button>
                </form>
            </div>
			<?php
            if($member['mb_category'] == '일반') {
                include_once('./myinfo.php');
            } else {
                include_once('./myinfo_company.php');
            }
            ?>
		</div>
	</div>
</div>

<script>
    $(function() {
        // 안드로이드에서 태그 입력 후 이동 또는 다음 선택 시 태그 추가 안되어서 별도로 적용
	    $('#input_tag').on('blur', function() {
	        if(this.value != "" && this.value.length != 0) {
                add_hash(this, 'blur');
            }
        });

		$('.area_filter > li label em i').on('click',function(){
			$(this).toggleClass('active');
			$('.area_filter .area_info').toggleClass('active');
			return false;
		});

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

        // 수정
        if('<?=$idx?>' != "") {
            // 카테고리
            $('.select_box.v2 .box .select').text("<?=$help['he_category']?>");
            $('li:contains("<?=$help['he_category']?>")').addClass('selected');

            // 내용
            $('#editor').summernote('code', $('#he_contents').val());
        }
    });

    // 클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name, 구분값)
    function click_event(object, element, class_name, column, gubun) {
        $('.'+object+' li').removeClass(class_name);
        element.addClass(class_name);
        $('#'+column).val(element[0]['innerText']);

        if(gubun != 'mobile') {
            $('#fsearch').submit();
        }
    }

    // #해시태그 등록
    var num = '<?php echo (!empty($help['he_hashtag'])) ? count($he_hashtag)+1 : 1; ?>';
    var hashtag = "";
    function add_hash(data, blur) {
        if(event.keyCode == 13 || blur != undefined) { // 엔터 누를 시 태그 생성
            event.preventDefault();

            // 빈칸 체크
            if($.trim(data.value).length == 0) {
                swal('Please enter your tags.');
                return false;
            }
            // 콤마 체크
            if(!isComma(data.value)) {
                swal('Commas cannot be entered.');
                $('#input_tag').val('');
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
            $('#input_tag').focus();
            num++;
        }
    }

    // #해시태그 삭제
    function del_hash(num) {
        $('.tag_'+num).remove();
    }

    // BUNKER 체크 (내가 가지고 있는 BUNKER보다 크게 입력 불가)
    function bunker_check(input_bunker, mb_bunker) {
        if(input_bunker > mb_bunker) {
            swal('BUNKER is not enough.');
            $('#he_bunker').val('');
            return false;
        }
    }

    // 질문등록
    var is_post = false;
    function helpme_register() {
        if(is_post) {
            return false;
        }
        is_post = true;

        $('#he_contents').val(editorCheck()); // 내용

        $('.tag_list li span').each(function() {
            hashtag += $(this).text() + ',';
        });
        hashtag = hashtag.slice(0, -1);
        $('#he_hashtag').val(hashtag); // 해시태그

        var f = $('#fhelpme')[0];
        if(f.he_category.value == "") {
            swal('Please choose a category.');
            is_post = false;
            return false;
        }
        if($.trim(f.he_subject.value).length == 0) {
            swal('Please enter the subject.');
            is_post = false;
            is_post = false;

            return false;
        }
        if(f.he_contents.value == "") {
            swal('Please enter your details.');
            is_post = false;
            return false;
        }
        /*if($('.tag_word').length == 0) {
            swal('해시태그를 입력해 주세요.');
            return false;
        }*/
        // 벙커 10단위
        if(f.he_bunker.value % 10  != 0) {
            swal('Please enter the bunker in increments of 10.');
            is_post = false;
            return false;
        }

        $('#fhelpme').submit();

        /*var form = $('#fhelpme')[0];
        var formData = new FormData(form);
        $.ajax({
            url: './help_write_update.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function(data) {
                if(data) {
                    swal('Your question has been registered.')
                    .then(() => {
                        location.href = g5_bbs_url+'/help_list.php';
                    })
                }
            }
        });*/
    }
</script>

<?
include_once(G5_BBS_PATH.'/help_list_search_script.php');
include_once('./_tail.php');
?>