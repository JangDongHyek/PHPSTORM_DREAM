<?
include_once('./_common.php');

$g5['title'] = 'FAQ Write';
include_once('./_head.php');

$msg = 'Post';
if($w == 'u') {
    $faq = sql_fetch(" select * from g5_cs_faq where idx = '{$idx}' ");
    $msg = 'Edit';
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 140px;}
	#ft{display:none;}
</style>

<?php include_once('./category_faq_modal.php'); ?>
<div id="area_community" class="faq">

	<?php include_once('./faq_top.php'); ?>

	<div class="inr v4">

		<div id="help_list" class="write">
            <form id="ffaq" name="ffaq" method="post" autocomplete="off" action="<?=G5_BBS_URL?>/faq_write_update.php">
                <input type="hidden" id="faq_category" name="category" value="<?=$faq['category']?>"> <!--웹은 ui.js에서 수정-->
                <input type="hidden" id="idx" name="idx" value="<?=$idx?>">
                <input type="hidden" id="w" name="w" value="<?=$w?>">
                <div class="mbox_cate">
                    <span data-toggle="modal" data-target="#cateModal"><i></i>Select Category</span>
                </div>
                <div class="w_filter cate">
                    <div class="cate">
                        <h3>Notice</h3>
                        <div class="select_box v2">
                            <div class="box">
                                <input type="checkbox" style="display: block;" name="notice" id="notice" <?=!empty($faq['notice'])?'checked':'';?> value="<?=!empty($faq['notice'])?'Y':'';?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w_filter cate">
                    <div class="cate">
                        <h3>Category</h3>
                        <div class="select_box v2">
                            <div class="box">
                                <div class="select">Select a bulletin board.</div>
                                <ul class="list">
                                    <!--<li>General member FAQ</li>-->
                                    <li class="selected">Podosea member FAQ</li>
                                    <li>Other FAQ</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="help_write">
                    <div class="title">
                        <h3><input type="text" class="subject" id="subject" name="subject" value="<?=$faq['subject']?>" placeholder="Enter title."> </h3>
                    </div>

                    <div class="bottom" id="editor" style="display: none;"></div>
                    <textarea class="noshow" id="contents" name="contents"><?=$faq['contents']?></textarea>
                </div>

                <button type="button" class="btn_confirm fixed" onclick="faq_register();"><?=$msg?></button>
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
                },
            }
        });

        // 카테고리(모바일)
        $('.cate_list li').click(function() {
            click_event('cate_list', $(this), 'active', 'category');

            var add_text = '';
            if($(this)[0]['innerText'] == '전체') { add_text += '<i></i>'; }
            $('.mbox_cate span').html(add_text + $(this)[0]['innerText'])
            $('#cateModal').modal('hide');
        });

        // 수정
        if('<?=$idx?>' != "") {
            // 카테고리
            $('.select_box.v2 .box .select').text("<?=$faq['category']?>");
            $('li:contains("<?=$faq['category']?>")').addClass('selected');

            // 내용
            //$('.note-editable').html('<?//=$faq['contents']?>//');
            $('#editor').summernote('code', $('#contents').val());
        }
    });

    // 클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
    function click_event(object, element, class_name, column) {
        $('.'+object+' li').removeClass(class_name);
        element.addClass(class_name);
        $('#'+column).val(element[0]['innerText']);
    }

    // 등록/수정
    var is_post = false;
    function faq_register() {
        if(is_post) {
            return false;
        }
        is_post = true;

        $('#contents').val(editorCheck()); // 내용

        var f = $('#ffaq')[0];
        if(f.category.value == "") {
            swal('Select a category.');
            is_post = false;
            return false;
        }
        if($.trim(f.subject.value).length == 0) {
            swal('Enter the subject.');
            is_post = false;
            return false;
        }
        if(f.contents.value == "") {
            swal('Enter your details.');
            is_post = false;
            return false;
        }

        // 공지 설정 여부 확인
        if($('input:checkbox[name="notice"]:checked').length > 0) {
            $('#notice').val('Y');
        } else {
            $('#notice').val('');
        }

        $('#ffaq').submit();
    }
</script>

<?
include_once('./_tail.php');
?>
