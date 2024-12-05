<?
include_once('./_common.php');
$name = "cmypage";
$pid = "mypage";
$g5['title'] = '마이페이지';
include_once('./_head.php');
include_once(G5_PATH."/jl/JlConfig.php");
?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>

</style>
    <div id="area_mypage">
		<div class="inr">
            <?php include('./mypage_banner.php'); ?>
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?>

                <order-buy-list member_idx="<?=$member['mb_no']?>"></order-buy-list>

				<!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_menu.php'); ?>
			</div>
		</div>
	</div>

<?
$jl->vueLoad("area_mypage");
$jl->includeDir("/component/order");
$jl->includeDir("/component/slot");
include_once('./_tail.php');
?>

<script>
$( ".star_rating a" ).click(function() {
     $(this).parent().children("a").removeClass("on");
     $(this).addClass("on").prevAll("a").addClass("on");
     var score = $(this).attr('name').split('_');
     $('[name=r_score]').val(score[1]);
     return false;
});

function review_write() {

    var form = $('#reviewfrm')[0];
    var formData = new FormData(form);

    $.ajax({
        url: g5_bbs_url+"/ajax.controller.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success: function(data) {
            if (data == 'success') {
                swal("리뷰 등록이 완료되었습니다.");
                $("#review_modal").hide();
            }else{
                swal("실패하였습니다. 다시시도 해주세요.");
                location.href = location.href
            }

        }
    });

}

$('#reviewModal').on('show.bs.modal', function(event) {
    idx = $(event.relatedTarget).data('idx');
    $('#r_p_idx').val(idx);
});

</script>
