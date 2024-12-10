<?php
include_once('./_common.php');
$g5['title'] = '포인트적립내역';
include_once(G5_THEME_PATH.'/head.php');
if($po_datetime1){
	$totime1=strtotime($po_datetime1);
	$where1=" and $totime1<=unix_timestamp(po_datetime)";
}
if($po_datetime2){
	$totime2=strtotime($po_datetime2." 23:59:59");
	$where2=" and unix_timestamp(po_datetime)<=$totime2";
}
$sql="select sum(po_point) as po_point,left(po_datetime,10) as po_datetime,po_mb_point from g5_point 
	  where mb_id='$member[mb_id]' 
	  $where1 
	  $where2
	  group by left(po_datetime,10) order by po_id desc   limit 0,30";
$result=sql_query($sql);
?>
<style>
	
	th{
		background-color:#f1f1f1;
	}
	td{
		padding:10px;
	}
	#point-view-back{
		width:100%;
		height:100%;
		position:fixed;
		z-index:4;
		background-color:rgba(0,0,0,0.5);
		border:1px solid black;
		left:0;
		top:0;
		display:none;

	}
	#point-view{
		position:fixed;
		bottom:0;
		width:100%;
		height:400px;
		overflow-y:scroll;
		z-index:9999;
		z-index:1;
		background-color:#fff;
		padding:10px;
		display:none;
	}
	
	#sch_result{padding:20px;}
	#sch_result .form-call{border-radius:3px; width:110px; background-color:#fafafa; height:30px; line-height:28px; border:1px solid #ddd}
	#sch_result .btn{ margin-left:5px; line-height:28px; border-radius:5px; height:30px; width:54px; font-weight:500; color:#666; float:left; padding:0; font-size:1em;}
</style>
<script type="text/javascript">
	
</script>
<div id="sch_result">
	<form name="form" method="get" action="">
    	<input type="date" name="po_datetime1" value="<?=$po_datetime1?>" class="form-call" placeholder="날짜선택">  ~  <input type="date" name="po_datetime2" value="<?=$po_datetime2?>"  class="form-call" placeholder="날짜선택">
        <button type="submit" class="btn">검색</button></td>
	</form> 
    <div class="tbl">
	<table width="100%" border="0" cellpadding="1" cellspacing="0">
		<thead>
			<tr>
				<th>날짜</th>
				<th>포인트</th>
				<th>누적포인트</th>
			</tr>
		</thead>
		<tbody id="mb-point-list">
		<? while($row=sql_fetch_array($result)){ ?>
		
			
			
			<!--<tr>
				<th>경로</th>
				<td colspan="5"></td>
			</tr>-->
			<tr>
				<!--<th>금액</th>
				<td></td>-->
				<td align="center"><a href="javascript:;" onclick="pointView('<?=$row[po_datetime]?>')"><?php echo $row['po_datetime'] ?></a></td>
				<td align="center"><?=$row['po_point']?></td>
				<td align="center"><?=$row['po_mb_point']?></td>
			</tr>
			
		
		<? }?>
		</tbody>
  </table>
  </div>
</div>
<div id="point-view">
	<div style="float:right" onclick="closeView()">닫기</div>
	<div id="point-list-view"></div>
</div>
<div id="point-view-back" onclick="closeView()">
	
	
</div>

<script type="text/javascript">
	function pointView(date){
		$("#point-view-back").css("display","block");
		$("#point-view").slideDown();
		$("#point-view").css("z-index","9");
		$.ajax({
				url:"./ajax.point.view.php",
				data:{"po_datetime":date},
				dataType:"HTML",
				type:"POST",
				success:function(data){
					$("#point-list-view").html(data);
				}
			});
		
		
	}
	function closeView(){
		$("#point-view-back").css("display","none");
		$("#point-view").slideUp();
		$("#point-view").css("z-index","9");
	}
	var page=1;
	var row=30;
	$(function(){
		//무한 스크롤 페이지
		$(window).scroll(function(){
			if ($(window).scrollTop() == $(document).height() - $(window).height()) {
				page++;
				$.ajax({
					url:"./ajax.point.list.php",
					data:{"page":page,"row":row,"po_datetime1":"<?=$po_datetime1?>","po_datetime2":"<?=$po_datetime2?>"},
					dataType:"HTML",
					type:"POST",
					success:function(data){
						
						if(data==""){
							page-=1;
						}else{
							$("#mb-point-list").append(data);
						}
					}
				});
			}
		});
	});
</script>
<?php
include_once('./_tail.sub.php');
//include_once(G5_THEME_PATH.'/tail.php');
?>