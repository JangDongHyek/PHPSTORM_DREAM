<?
include_once('./_common.php');
$g5['title'] = '자주묻는 질문';
include_once('./_head.php');

$faq = sql_fetch(" select * from g5_cs_faq where idx = '{$idx}' ");

if($faq['category'] == '일반회원 자주묻는 질문') {
    $g = 'm';
} else if($faq['category'] == '기업회원 자주묻는 질문') {
    $g = 'c';
} else {
    $g = '';
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 140px;}
    .highlight {color:#275dd7;}
</style>

<div id="area_community" class="view faq">
	<div class="inr v3">

		<div id="help_list">
			<div class="help_question top">
				<div class="title">
					<!-- 카테고리 리스트로 이동 -->
					<em class="community_type"><a href="<?=G5_BBS_URL?>/faq_list.php?g=<?=$g?>"><?=$faq['category']?></a></em>
					<h3><?=$faq['subject']?></h3>

                    <?php if($member['mb_level'] == 10) { ?>
                    <a href="javascript:edit_open('edit_list_q');" class="btn_more"></a>
                    <?php } ?>
                    <ul class="edit_list edit_list_q" style="display: none;">
                        <li class="modify"><a href="<?=G5_BBS_URL?>/faq_write.php?idx=<?=$faq['idx']?>&w=u">수정</a></li>
                        <li class="delete"><a href="javascript:faqDel();">삭제</a></li>
                    </ul>
				</div>
				<div class="bottom">
					<div class="cont">
						<?=nl2br(stripslashes($faq['contents']))?>
					</div>
				</div>
			</div>
		</div>
		<div id="area_popular">
			<!-- 관리자만 글쓰기 버튼 보이기 -->
            <?php if($member['mb_level'] == 10) { ?>
			<div class="area_write">
				<a href="<?php echo G5_BBS_URL ?>/faq_write.php"><span>글쓰기</span></a>
			</div>
            <?php } ?>

			<div class="list_best">
				<h3><?=$faq['category']?></h3>
				<!-- 리스트 10개 노출 -->
				<ul>
					<!-- 현재 질문에 li 클래스 .current 추가 -->
					<li><a href="javascript:;"><?=$faq['category']?>입니다.<br>무엇이 궁금하신가요?</a></li>
                    <?php
                    $rlt = sql_query(" select * from g5_cs_faq where 1=1 and category = '{$faq['category']}' order by idx desc limit 10 ");
                    while($row = sql_fetch_array($rlt)) {
                    ?>
                    <li <?php echo $idx==$row['idx'] ? 'class="current"' : '';?>><a href="<?=G5_BBS_URL?>/faq_view.php?idx=<?=$row['idx']?>"><?=$row['subject']?></a></li>
                    <?php
                    }
                    ?>
				</ul>
			</div>
		</div>

		<div class="area_btn"><a class="btn_list" href="faq_list.php?g=<?=$g?>"><span>목록</span></a></div>

		</div>
	</div>
</div>

<form id="ffaq" name="ffaq" action="./faq_write_update.php">
    <input type="hidden" id="category" name="category" value="<?=$faq['category']?>">
    <input type="hidden" id="idx" name="idx" value="<?=$idx?>">
    <input type="hidden" id="w" name="w" value="d">
</form>

<script>
	// 수정/삭제
	$(document).click(function(e) {
		if (!$(e.target).hasClass('btn_more')) { // btn_more가 포함된 영역 밖 클릭 시 수정/삭제 영역 숨김
			$('.edit_list').attr('style', 'display: none;');
		}
	});
	var g_class2 = '';
	function edit_open(mode) { // mode : 각 댓글에 적용된 클래스
		if(g_class2 != mode) {
			$('.edit_list').attr('style', 'display: none;');
		}
		g_class2 = mode;

		if($('.'+mode).attr('style').indexOf('block') != -1) {
			$('.'+mode).attr('style', 'display: none;');
		} else {
			$('.'+mode).attr('style', 'display: block;');
		}
	}

	// 삭제
	function faqDel() {
        $('#ffaq').submit();
        // swal({
        //     text: "삭제하시겠습니까?",
        //     buttons: true,
        //     dangerMode: true,
        // })
        // .then((willDelete) => {
        //     if (willDelete) {
        //         swal("삭제되었습니다.");
        //     } else {
        //     }
        // });
    }
</script>
<?
include_once('./_tail.php');
?>