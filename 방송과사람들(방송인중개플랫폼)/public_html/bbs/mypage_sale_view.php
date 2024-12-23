<?
include_once('./_common.php');
$name = "cmypage";
$g5['title'] = '상세내역';
include_once('./_head.php');
include_once(G5_PATH."/jl/JlConfig.php");
?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#ft{display:none;}
</style>

<!-- 상태변경 select 모달-->
<div id="basic_modal">
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="inquiry_idx" name="inquiry_idx">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close""><span></span><span></span></button>
					<h4 class="modal-title" id="appModalLabel">상태변경</h4>
				</div>
				<div class="modal-body">
					<ul id="sort_list">
						<li class="active"><em>진행대기</em></li>
						<li><em>진행중</em></li>
						<li><em>완료</em></li>
						<li><em>취소</em></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 상태변경 select 모달-->
<div id="vueapp">
    <order-sell-view member_idx="<?=$member['mb_no']?>" order_no="<?=$_GET['order_no']?>"></order-sell-view>
</div>


<?
$jl->vueLoad("vueapp");
$jl->includeDir("/component/order");
include_once($jl->ROOT."/component/slot/slot-modal.php");
include_once('./_tail.php');
?>

<script>
$( ".star_rating a" ).click(function() {
     $(this).parent().children("a").removeClass("on");
     $(this).addClass("on").prevAll("a").addClass("on");
     var score = $(this).attr('name').split('_');
     $('#score').val(score[1]);
     return false;
});
</script>
