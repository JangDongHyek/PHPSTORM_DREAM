<?php
$sub_menu = "300000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');




$g5['title'] = '룰렛설정';
include_once('./admin.head.php');

$sql = " select * from g5_roulette_config ";
$row=sql_fetch($sql);
$lotto_numArr=explode(",",$row[lotto_num]);

?>
<style>
.rankImg{
	border:1px dashed #000;
	text-align:center;
	height:100px auto;
	min-height:100px;
	font-weight:bold;
	line-height:80px;
	font-size:100px;
	cursor:pointer;
}
</style>

<form name="form" id="form" action="./roulette.config.update.php" onsubmit="return fmemberlist_submit(this);" method="post">

<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
    <tr>
        <th colspan="3">
					포인트 설정하기
        </th>
    </tr>
		<tr>
        <th>등수</th>
				<th>포인트</th>
    </tr>
    </thead>
    <tbody>
		<?
					for($i=1;$i<=5;$i++){
				?>
    <tr class="<?php echo $bg; ?>">
			<td align="center"><?=$i?>등 포인트</td>		
			<td><input type="text" name="roulette<?=$i?>point" value="<?=$row[roulette.$i.point]?>" class="frm_input"></td>
    </tr>
    <?php }?>
    </tbody>

    </table>

		<table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
    <tr>
        <th colspan="7">
					당첨 설정하기
        </th>
    </tr>
		<tr>
        <th>1등</th>
				<th>2등</th>
				<th>3등</th>
				<th>4등</th>
				<th>5등</th>
				
    </tr>
    </thead>
    <tbody>
			<tr class="<?php echo $bg; ?>">
				<td><input type="text" name="roulette1" value="<?=$row[roulette1]?>" class="frm_input"></td>		
				<td><input type="text" name="roulette2" value="<?=$row[roulette2]?>" class="frm_input"></td>		
				<td><input type="text" name="roulette3" value="<?=$row[roulette3]?>" class="frm_input"></td>		
				<td><input type="text" name="roulette4" value="<?=$row[roulette4]?>" class="frm_input"></td>		
				<td><input type="text" name="roulette5" value="<?=$row[roulette5]?>" class="frm_input"></td>		
			</tr>
    </tbody>

    </table>
		<div class="btn_confirm01 btn_confirm">
		<input type="submit" class="btn btn_submit" value="설정하기"/>
		</div>

		<?
			$sql = " select count(*) as cnt from g5_roulette where  0 < ro_rank and ro_rank < 6  ";
			$row = sql_fetch($sql);
			$total_count = $row['cnt'];
			$rows = 15;
			$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
			if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
			$from_record = ($page - 1) * $rows; // 시작 열을 구함
			$sql="select * from g5_roulette where  0 < ro_rank and ro_rank < 6 order by idx desc limit {$from_record}, {$rows}";
			$result=sql_query($sql);
		?>
		<table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
    <tr>
        <th colspan="5">
					당첨자 목록
        </th>
    </tr>
		<tr>
        <th>번호</th>
				<th>아이디</th>
				<th>이름</th>
				<th>당첨등수</th>
				<th>게임날짜</th>
				
    </tr>
    </thead>
    <tbody>
		<? 
		$no=$total_count-$from_record;
		while($row=sql_fetch_array($result)){
				$sql="select * from g5_member where mb_id='$row[mb_id]'";
				$row2=sql_fetch($sql);
				
		?>
    <tr class="<?php echo $bg; ?>">
			<td><?=$no?></td>		
			<td><?=$row[mb_id]?></td>
			<td><?=$row2[mb_name]?></td>
			<td><?=$row[ro_rank]?>등</td>
			<td><?=date("Y-m-d",$row[regdate])?></td>
			
    </tr>
		<? $no--;}?>

    </tbody>
		
    </table>
		<?php echo get_paging(10, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
</div>



</form>





<script>
var first_id = "",
	hFrame_back = false;

function getRecommList(mb_id) {
	var h = $(window).height(),
		w = $(window).width(),
		pop_h = (h * 0.6) + "px",
		pop_t = ((h * 0.4) / 2) + "px",
		pop_w = $("#mypagePopup").width();
		pop_l = ((w - pop_w) / 2) + "px";
		url = g5_admin_url + "/ajax.member_recomm_list.php?mb_id=" + mb_id;

	$("#mypagePopup iframe").prop("src", url);
	$("#popup_overlay").show();
	$("#mypagePopup").show().css({"height" : pop_h, "top" : pop_t, "left" : pop_l});

	if (first_id != "") {
		// 뒤로가기 버튼생성
		hFrame_back = true;
	} else {
		first_id = mb_id;
		hFrame_back = false;
	}
}

document.getElementById('hFrame').onload = function() {
	if (hFrame_back) {
		$('#hFrame').contents().find('#btn_back').css("display", "block");
	} else {
		$('#hFrame').contents().find('#btn_back').css("display", "none");
	}
};

function fnPrevClose() {
	$("#mypagePopup iframe");
	$("#popup_overlay").hide();
	$("#mypagePopup").hide();
	$("#mypagePopup iframe").prop("src", "");

	first_id = "";
}

function fnFrameBack(mb_id) {
	if (mb_id == first_id) {
		hFrame_back = false;
	}
	document.getElementById("hFrame").contentWindow.history.back();
}

function fmemberlist_submit(f)
{
   
    return true;
}

</script>

<?php
include_once ('./admin.tail.php');
?>
