<?php
$sub_menu = "300000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');




$g5['title'] = '로또설정';
include_once('./admin.head.php');
if(!$whereCurrentTurn){
	$whereCurrentTurn=$currentTurn;
}
$sql = " select * from g5_lotto_config where turn='$whereCurrentTurn' ";
$row=sql_fetch($sql);
if($row[rank1point]==""){
	$sql = " select * from g5_lotto_config order by idx desc ";
	$row=sql_fetch($sql);

}
$prevYear = date("Y")-1;

$lotto_numArr=explode(",",$row[lotto_num]);
$sql="select * from g5_lotto_config where (left(turn,4)='".date("Y")."' or left(turn,4)='".$prevYear."')and turn !='$currentTurn' order by turn asc";
$result=sql_query($sql);

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
<script type="text/javascript">
//파일첨부 클릭시
$(function(){
	$(".rankImg").click(function(){
		var id=$(this).attr("id");
		$("input[name='"+id+"'").click();
	});

	$("#last-win-number").click(function(){
		var winE="<?=lottoLastWinNumber()?>";
		$.ajax({
				url:"./ajax.lotto.win.php?drwNo="+winE,
				dataType:"json",
				type:"POST",
				success:function(data){
					var json=JSON.stringify(data);
					console.log(json);
					var jsonData=JSON.parse(json);
					var drwtNo1=jsonData.drwtNo1;
					var drwtNo2=jsonData.drwtNo2;
					var drwtNo3=jsonData.drwtNo3;
					var drwtNo4=jsonData.drwtNo4;
					var drwtNo5=jsonData.drwtNo5;
					var drwtNo6=jsonData.drwtNo6;
					var bnusNo=jsonData.bnusNo;
					
					$("input[name='lotto_num[0]']").val(drwtNo1);
					$("input[name='lotto_num[1]']").val(drwtNo2);
					$("input[name='lotto_num[2]']").val(drwtNo3);
					$("input[name='lotto_num[3]']").val(drwtNo4);
					$("input[name='lotto_num[4]']").val(drwtNo5);
					$("input[name='lotto_num[5]']").val(drwtNo6);
					$("input[name='lotto_num[6]']").val(bnusNo);
					

				},
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		}
	);
});
function fileDragEnter(idx,event){
		event.stopPropagation();
		event.preventDefault();
		// 드롭다운 영역 css
		$(this).css('background-color','#E3F2FC');
	}
	function fileDragLeave(idx,event){
	  event.stopPropagation();
		event.preventDefault();
		// 드롭다운 영역 css
		$(this).css('background-color','#E3F2FC');
	}
	function fileDragOver(idx,event){
		event.stopPropagation();
		event.preventDefault();
		// 드롭다운 영역 css
		$(this).css('background-color','#E3F2FC');
	}
	function fileDrop(idx,ev){
		ev.preventDefault();
		// 드롭다운 영역 css
		$(this).css('background-color','#FFFFFF');
		
		
		var files = ev.target.files||ev.dataTransfer.files;
		var reader = new FileReader();
		
		reader.readAsDataURL(files[0]);
		reader.onload = function (e) {
			var strHtml="<img src='"+e.target.result+"' style='width:200px'>";
			$("#rank"+idx+"Img").html(strHtml);
			$("#rank"+idx+"ImgTxt").val(e.target.result);
		}
		
		
		if(files != null){
				if(files.length < 1){
						alert("폴더 업로드 불가");
						return;
				}
				//selectFile(no,cnt,files)
		}else{
				alert("ERROR");
		}
	}
</script>

<form name="form" id="form" action="./lotto.config.update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<table>
	<tbody>
		<tr>
			<td>회차설정</td>
			<td>
				
				<select name="whereCurrentTurn" onchange="location.href='?whereCurrentTurn='+this.value;">
					<option value="2021/52" selected="">2021/52회차</option>
					<? 
					for($i=2;$i<=date("W");$i++){
							$j=$i-1;
//							if($i<10) $i="0".$i;
							if($j<10) $j="0".$j;
					?>
					<option value="<?=date("Y")."/".$j?>"<?php echo date("Y")."/".$j==$whereCurrentTurn?" selected":"";?>><?=date("Y")."/".$j?>회차</option>
					<? }?>
					
					<!--<option value="<?=$currentTurn?>"<?php echo $currentTurn==$whereCurrentTurn?" selected":"";?>><?=$currentTurn?>회차</option>-->
				</select>
				
				

			</td>
		</tr>
	</tbody>
</table>



<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
    <tr>
        <th colspan="3">
					상품 설정하기
        </th>
    </tr>
		<tr>
        <th>등수</th>
				<th>상품명</th>
				<th width="300">상품이미지</th>
    </tr>
    </thead>
    <tbody>
		<?
					for($i=1;$i<=5;$i++){
				?>
    <tr class="<?php echo $bg; ?>">
			<td align="center"><?=$i?>등 상품</td>		
			<td><input type="text" name="rank<?=$i?>point" value="<?=$row[rank.$i.point]?>" class="frm_input"></td>
			<td>
				드래그 드롭으로도 파일첨부가 가능합니다.<br/>
				<input type="file" name="rank<?=$i?>Img" style="display:none" onchange="fileDrop('<?=$i?>',event)">
				<input type="hidden" name="rank<?=$i?>ImgTxt" id="rank<?=$i?>ImgTxt" value="">
				<input type="hidden" name="rank<?=$i?>ImgLatest" value="<?=$row[rank.$i.Img]?>">
				<div id="rank<?=$i?>Img" class="rankImg" ondragenter="fileDragEnter('<?=$i?>',event)" ondragleave="fileDragLeave('<?=$i?>',event)" ondragover="fileDragOver('<?=$i?>',event)" ondrop="fileDrop('<?=$i?>',event)">
					<? if($row[rank.$i.Img]){?>
					<img src="<?=G5_DATA_URL?>/lotto/<?=$row[rank.$i.Img]?>" width=200>
					<? }else{?>
						+
					<? }?>
				</div>
			</td>
    </tr>
    <?php }?>
    </tbody>

    </table>

		<table>
    <caption><?php echo $g5['title']; ?></caption>
    <thead>
    <tr>
        <th colspan="7">
					당첨번호 설정하기 <button type="button" class="btn" id="last-win-number"><?=lottoLastWinNumber()?>회 당첨번호가져오기</button>
        </th>
    </tr>
		<tr>
        <th>No1</th>
				<th>No2</th>
				<th>No3</th>
				<th>No4</th>
				<th>No5</th>
				<th>No6</th>
				<th>Bonus</th>
    </tr>
    </thead>
    <tbody>

    <tr class="<?php echo $bg; ?>">
			<td><input type="text" name="lotto_num[0]" value="<?=$lotto_numArr[0]?>" class="frm_input"></td>		
			<td><input type="text" name="lotto_num[1]" value="<?=$lotto_numArr[1]?>" class="frm_input"></td>
			<td><input type="text" name="lotto_num[2]" value="<?=$lotto_numArr[2]?>" class="frm_input"></td>
			<td><input type="text" name="lotto_num[3]" value="<?=$lotto_numArr[3]?>" class="frm_input"></td>
			<td><input type="text" name="lotto_num[4]" value="<?=$lotto_numArr[4]?>" class="frm_input"></td>
			<td><input type="text" name="lotto_num[5]" value="<?=$lotto_numArr[5]?>" class="frm_input"></td>
			<td><input type="text" name="lotto_num[6]" value="<?=$lotto_numArr[6]?>" class="frm_input"></td>
    </tr>

    </tbody>

    </table>
		<div class="btn_confirm01 btn_confirm">
		<input type="submit" class="btn btn_submit" value="설정하기"/>
		</div>

		<?
			$sql = " select count(*) as cnt from g5_lotto where turn='$whereCurrentTurn' and rank < 6 ";
			$row = sql_fetch($sql);
			$total_count = $row['cnt'];
			$rows = 15;
			$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
			if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
			$from_record = ($page - 1) * $rows; // 시작 열을 구함

			$sql="select * from g5_lotto where turn='$whereCurrentTurn' and rank < 6 order by rank asc limit {$from_record}, {$rows}";
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
				<th>당첨번호</th>
				<th>당첨등수</th>
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
			<td><?=$row[lotto_num]?></td>
			<td><?=$row[rank]?>등</td>
    </tr>
		<? $no--;}?>

    </tbody>

    </table>
		<?php echo get_paging(10, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;whereCurrentTurn='.$whereCurrentTurn.'&amp;page='); ?>

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
