<?php
$sub_menu = "500200";
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

$g5['title'] = "CCTV 지역관리";
include_once ('./admin.head.php');

$frm_submit = '<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">';
$frm_submit .= '</div>';



?>

<form name="fboardform" id="fboardform" action="./board_form_update_cate.php" onsubmit="return fboardform_submit(this)" method="post" enctype="multipart/form-data">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">

<section id="anc_bo_basic">
    <div class="tbl_frm01 tbl_wrap">
		<?php echo help('지역과 지역 사이는 | 로 구분하세요. (예: 서울|경기도) 첫자로 #은 입력하지 마세요. (예: #서울|#경기도 [X])') ?>
		<input type="text" name="bo_category_list" value="<?php echo get_text($board['bo_category_list']) ?>" id="bo_category_list" class="frm_input" size="70">
		<input type="hidden" name="bo_use_category" value="1" id="bo_use_category">
    </div>
</section>
<?php echo $frm_submit; ?>
</form>

<script>
function fboardform_submit(f)
{
    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
