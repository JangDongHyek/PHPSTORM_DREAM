<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
$sql="select * from g5_write_b_reserv where wr_id='$wr_id'";
$row=sql_fetch($sql);
include_once(G5_PATH.'/head.sub.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="<?php echo G5_THEME_CSS_URL; ?>/bootstrap.min.css" rel="stylesheet" type="text/css"><!--부스스트랩-->
<script src="<?php echo G5_THEME_JS_URL ?>/bootstrap.min.js"></script><!--부트스트랩-->

<form name="fmember" id="fmember" action="./reserv_memo_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="wr_id" value="<?=$row[wr_id]?>">
<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <!--<tr>
        <th scope="row"><label for="wr_21">차종류<?php echo $sound_only ?></label></th>
        <td>
            <select name="wr_21" id="wr_21">
				<option value="">자동차 종류를 선택해 주세요</option>
				<? for($i=0;$i<count($wr_21Arr);$i++){?>
				<option value="<?=$wr_21Arr[$i]?>"<?php echo $wr_21Arr[$i]==$row[wr_21]?" selected":"";?>><?=$wr_21Arr[$i]?></option>
				<? }?>
			</select>
        </td>
    </tr>-->
    <tr>
        <th scope="row"><label for="wr_4">메모<?php echo $sound_only ?></label></th>
        <td>
		<textarea name="wr_memo" class="frm_input" rows="5"><?=$row[wr_memo]?></textarea>
			
        </td>
    </tr>
	

   

    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
</div>
</form>



<?php
?>
