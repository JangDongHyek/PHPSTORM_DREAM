<?php
$sub_menu = '400300';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '상품 복사';
include_once(G5_PATH.'/head.sub.php');
?>

<div class="new_win">
    <h1>상품 복사</h1>
    <form name="fitemcopy">

    <div id="sit_copy">
        <label for="new_it_id">상품코드</label>
        <input type="text" name="new_it_id" value="<?php echo time(); ?>" id="new_it_id" class="frm_input" maxlength="20">
    </div>
	<div id="sit_copy">
        <label for="new_it_id">분류선택</label>
        <select name="sca" id="sca2">
		<option value="">전체분류</option>
		<?php
		$sql1 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} order by ca_order, ca_id ";
		$result1 = sql_query($sql1);
		for ($i=0; $row1=sql_fetch_array($result1); $i++) {
			$len = strlen($row1['ca_id']) / 2 - 1;
			$nbsp = '';
			for ($i=0; $i<$len; $i++) $nbsp .= '&nbsp;&nbsp;&nbsp;';
			echo '<option value="'.$row1['ca_id'].'" '.get_selected($sca, $row1['ca_id']).'>'.$nbsp.$row1['ca_name'].'</option>'.PHP_EOL;
		}
		?>
	</select>
    </div>
	

    <div class="win_btn btn_confirm">
        <input type="button" value="복사하기" class="btn_submit" onclick="_copy('itemcopyupdate.php?it_id=<?php echo $it_id; ?>&amp;ca_id=<?php echo $ca_id; ?>');">
        <button type="button" onclick="self.close();">창닫기</button>
    </div>

    </form>
</div>

<script src="<?php echo G5_ADMIN_URL ?>/admin.js"></script>

<script>
// <![CDATA[
function _copy(link)
{
    var new_it_id = document.getElementById('new_it_id').value;
	var sca = document.getElementById('sca2').value;
    var t_it_id = new_it_id.replace(/[A-Za-z0-9\-_]/g, "");
    if(t_it_id.length > 0) {
        alert("상품코드는 영문자, 숫자, -, _ 만 사용할 수 있습니다.");
        return false;
    }
    var token = get_ajax_token();
    if(!token) {
        alert("토큰 정보가 올바르지 않습니다.");
        return false;
    }
    opener.parent.location.href = encodeURI(link+'&sca2='+sca+'&new_it_id='+new_it_id+"&token="+token);
    self.close();
}
// ]]>
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>