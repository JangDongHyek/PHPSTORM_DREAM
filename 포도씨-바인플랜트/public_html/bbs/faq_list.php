<?
include_once('./_common.php');
$g5['title'] = '자주묻는 질문';
include_once('./_head.php');

if($g == 'm') {
    $title = '일반회원';
} else if($g == 'c') {
    $title = '기업회원';
} else {
    $title = '기타회원';
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 140px;}
    .highlight {color:#275dd7;}
</style>

<div id="area_community" class="faq">
	
	<?php include_once('./faq_top.php'); ?>

    <input type="hidden" id="page" name="page" value="1">
    <input type="hidden" id="g" name="g" value="<?=$g?>"> <!--카테고리구분-->
    <div id="area_faq">
		<div class="inr v3">
			<div class="area_box">
				<ul class="area_history">
					<li><a href="<?=G5_BBS_URL?>/cscenter.php">고객센터</a></li>
					<li class="current"><a href="<?=G5_BBS_URL?>/faq_list.php"><?=$title?> 자주묻는 질문</a></li>
				</ul>
				<h3><?=$title?> 자주묻는 질문</h3>

                <!--ajax.faq_list.php-->
				<ul class="board_list"></ul>

				<!-- 관리자만 보이는 버튼 -->
                <?php if($member['mb_level'] == 10) { ?>
				<a class="btn_fwrite" href="<?=G5_BBS_URL?>/faq_write.php">글쓰기</a>
                <?php } ?>
		
				<div id="paging"></div>
			</div>
		</div>
	</div>
</div>

<script>
    $(function() {
       faqList();
    });

    // 리스트
    function faqList(page) {
        if(page == undefined) { page = 1; }
        $('#page').val(page);

        $.ajax({
            url : g5_bbs_url + "/ajax.faq_list.php",
            data: {category : '일반', page : $('#page').val(), g:  $('#g').val(), search: $('#search').val()},
            type: 'POST',
            cache: false,
            async: false,
            dataType: 'html',
            success : function(data) {
                if(data){
                    $('.board_list').html(data);

                    // 페이징 처리 -- 하단에 페이지 표시
                    ajaxGetPaging();
                }
            },
            error : function(err) {
                swal(err.status);
            }
        });
    }

    // 페이징 처리 -- 페이지 클릭 시 동작 이벤트
    function get_page(page) {
        faqList(page);
    }
</script>
	
<?
include_once('./_tail.php');
?>