<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);


$sql="select * from g5_member where mb_recommend='$member[mb_id]'";
$result=sql_query($sql);
$mb_idArr=array();
$mb_nameArr=array();
$no=0;
while($row=sql_fetch_array($result)){
	$mb_idArr[$no]=$row[mb_id];
	$mb_nameArr[$no]=$row[mb_name];
	$no++;
}
?>
<!--상단 탭부분-->
<div id="cha_tab">
    <ul>
        <li><a href="<?=G5_BBS_URL?>/mywallet.php">충전내역</a></li>
        <li class="selected"><a href="<?=G5_BBS_URL?>/myrecommend.php">추천인목록</a></li>
        <li><a href="<?=G5_BBS_URL?>/myrecommend.point.php">포인트내역</a></li>
        <li><a href="<?=G5_BBS_URL?>/mylotto.php">복권당첨내역</a></li>
    </ul>
</div><!--#cha_tab-->

<div class="container">
	<!--<table class="table">
		<tbody>
			<tr>
				<td id="total-count"></td>
			</tr>
		</tbody>
	</table>-->
	<table class="table_m" id="recommend-list">
   
		<thead>
			<tr>
				<th colspan="3" class="my_st">1대 추천인</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>번호</td>
				<td>추천인(아이디)</td>
				<td>이름(아이디)</td>
			</tr>
			<?
				for($i=0;$i<count($mb_idArr);$i++){
			?>
			<tr>
				<td><?=$i+1?></td>
				<td><?=$member[mb_name]?>(<?=$member[mb_id]?>)</td>
				<td><?=$mb_nameArr[$i]?>(<?=$mb_idArr[$i]?>)</td>
			</tr>
			<? }?>
		</tbody>

	</table>
</div>
<script type="text/javascript">
	
	var mb_idArr=<?php echo json_encode($mb_idArr)?>;
	$(function(){
		syncRecommendList();
	});
	var no=2;
	var total=parseInt("<?=$no?>");
	function syncRecommendList(){
		$.ajax({
			url:"./ajax.myrecommend.php",
			data:{"mb_idArr":mb_idArr},
			async: false,
			dataType:"json",
			type:"POST",
			success:function(data){
				console.log(data);
				var strHtml='<thead><tr><th colspan="3" class="my_st">'+no+'대 추천인</th></tr></thead><tbody><tr><td>번호</td><td>추천인(아이디)</td><td>이름(아이디)</td></tr>';
				if(no<15){
					var json=JSON.parse(JSON.stringify(data));
					mb_idArr = new Array();
					for(var i=0;i<json.data.length;i++){
						mb_idArr[i]=json.data[i].mb_id;
						var No=i+1;
						strHtml+='<tr>';
						strHtml+='	<td>'+No+'</td>';
						strHtml+='	<td>'+json.data[i].recommend_name+'('+json.data[i].recommend_id+')</td>';
						strHtml+='	<td>'+json.data[i].mb_name+'('+json.data[i].mb_id+')</td></tr>';
						total+=No;
					}
					strHtml+="</tbody>";
					$("#recommend-list").append(strHtml);
					if(mb_idArr[0]){
						no++;
						syncRecommendList();
					}
					//$("#total-count").html(total+"명");
				}
				
				
			}
		});
	}
</script>