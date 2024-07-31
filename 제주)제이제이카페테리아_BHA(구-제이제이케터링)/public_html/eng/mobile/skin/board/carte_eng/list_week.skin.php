<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//2018-08-21 배성현 : 야식 추가


function MobileCheck() { 
    global $HTTP_USER_AGENT; 
    $MobileArray  = array("iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","android","sony","phone");

    $checkCount = 0; 
        for($i=0; $i<sizeof($MobileArray); $i++){ 
            if(preg_match("/$MobileArray[$i]/", strtolower($HTTP_USER_AGENT))){ $checkCount++; break; } 
        }
   return ($checkCount >= 1) ? false : true; 
}

$is_pc = MobileCheck();
/*
//오늘 날짜 구하는 함수
function toWeekNum($timestamp) { 
    $w = date('w', mktime(0,0,0, date('n',$timestamp), 1, date('Y',$timestamp))); 
    return ceil(($w + date('j',$timestamp) -1) / 7); 
} 

if($mktime){
	$year = date("Y", $mktime);
	$month = date("m", $mktime);
	$day = date("d", $mktime);
}

//날짜 없을때
if(!$year) $year = date("Y");
if(!$month) $month = date("m");
if(!$day) $day = date("d");

$st = mktime(0, 0, 0, $month, $day, $year);
$week = toWeekNum($st);

$sd_test = mktime(0,0,0,$month,$day-$week,$year); 

$sd1 = date("Y-m-d H:i:s",$sd_test); 
echo $sd1;

$sd = $year."-".$month."-".$day;
echo $sd;
$sunday = date('w', $st);
echo $sunday;
// 일주일
for($i=0; $i<7; $i++){
	$week_date[] = date('Y-m-d', strtotime($sd." -".$sunday."days") + (86400 * $i));
}*/
//print_r($week_date);
	//$week_date = array("2020-10-05","2020-10-06","2020-10-07","2020-10-08","2020-10-09","2020-10-10","2020-10-11");

function toWeekNum($timestamp) { 
    $w = date('w', mktime(0,0,0, date('n',$timestamp), 1, date('Y',$timestamp))); 
    return ceil(($w + date('j',$timestamp) -1) / 7); 
} 

if($mktime){
	$search_date = date("Y-m-d", $mktime);
	$year = date("Y", $mktime);
	$month = date("m", $mktime);
}

//날짜 없을때
if(!$mktime){
	$search_date = date("Y-m-d");
	$year = date("Y");
	$month = date("m");
}

//echo $search_date;

$mk_date = strtotime($search_date);

$today_day = date("w", $mk_date);
$today_week = date("W", $mk_date);
if($today_day !=1)
	$week_st = date("Y-m-d", strtotime('Monday last week', $mk_date));
else
	$week_st = $search_date;

//echo $week_st;

$week = toWeekNum($mk_date);
for($i=0; $i<7; $i++){
	$week_date[] = date('Y-m-d', strtotime($week_st) + (86400 * $i));
}

$date_note_start =substr($week_date[0],0,7);
$date_note_end =substr($week_date[6],0,7);



$week_str = array( "Mon", "Tue", "Wed", "Thu", "Fri", "Sat","Sun");


//메뉴
/*$meal = array("조 식", "중 식", "석 식","야 식");
$menu = array("탕류", "추가", "한식", "일품", "쉐프", "음료", "샐러드", "한식 Or 일품", "한정 일품","한식","샌드위치","김밥");
$rowspan = array(2, 5, 2, 3);*/

//이전주, 다음주


$nex_week = strtotime($week_st) + (86400*8);
$pre_week = strtotime($week_st) - (86400*6);

if($is_adm)
	$bbs_url = G5_ADMIN_URL."/bbs";
else
	$bbs_url = G5_BBS_URL;

if(empty($now_sheet))
	$now_sheet = 0;

$nweek_url = $bbs_url."/board.php?bo_table=".$bo_table."&mktime=".$nex_week."&now_sheet=".$now_sheet;
$pweek_url = $bbs_url."/board.php?bo_table=".$bo_table."&mktime=".$pre_week."&now_sheet=".$now_sheet;

add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);



?>
<div id="bo_tbtn">
<a href="?bo_table=carte_eng&mktime=<?=$mktime?>&now_sheet=1">JKP,JK,SK</a>
<a href="?bo_table=carte_eng&mktime=<?=$mktime?>&now_sheet=0">J1~J5</a>
<a href="?bo_table=carte_eng&mktime=<?=$mktime?>&now_sheet=2">MS,SS</a>
</div>

<div id="bo_list">
	<div class="date_title">
		<a href="<?php echo $pweek_url?>" class="arrow_left">  </a> 
		<?php echo $year?>-<?php echo $month?> Week<?php echo $week?> 
        <a href="<?php echo $nweek_url?>" class="arrow_right">  </a>
	</div>
	
	<?php if(!$is_adm){ ?>
	<div class="scroll-img">
		<img id="scroll_img" src="<?php echo $board_skin_url?>/img/icon_scroll.png">
	</div>
	<?php } ?>
	
	<div id="bo_div" class="tbl_head01 tbl_wrap">
		<table>
			<colgroup>
			   <col style="width:auto" />
			   <col style="width:12%" />
			   <col style="width:12%" />
			   <col style="width:12%" />
			   <col style="width:12%" />
			   <col style="width:12%" />
			   <col style="width:12%" />
			   <col style="width:12%" />
			</colgroup>
			<thead>
				<tr>
					<th colspan="2"></th>
					<?php for($i=0; $i<count($week_date); $i++){ ?>
					<th class="<?php if($i==5) echo "sat"; else if($i==6) echo "sun"; else echo "default";?>"><?php echo $week_date[$i]?> (<?php echo $week_str[$i]?>)</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
					<?


						switch($now_sheet){
							case 2: $divide_gap = 7; break;										
							default : $divide_gap = 5; break;
						}
					
						$week_search ="";
						
						for($i=0; $i<count($week_date); $i++){

							if($i==0)
								$week_search =" and (";
							else 
								$week_search .=" or ";

								$week_search .=" wr_3 = '{$week_date[$i]}' ";
						}
								$week_search .=")";
						
						//echo $week_search;

						$sql="select wr_3 from g5_write_carte where wr_6 = {$now_sheet} {$week_search} group by wr_3 order by wr_id";
						
						$result_realdate = sql_query($sql);
						
						$arr_realdate = array();
						for ($k=0; $row=sql_fetch_array($result_realdate); $k++){
								array_push($arr_realdate, $row['wr_3']);
						}

					//	print_r($week_date);
					//	print_r($arr_realdate);

						$sql="select wr_1 from g5_write_carte where wr_6 = {$now_sheet} {$week_search} group by wr_1 order by wr_id";
					//	echo $sql;
						$result_tmcate = sql_query($sql);
						
						$arr_tmcate = array();
						for ($k=0; $row=sql_fetch_array($result_tmcate); $k++){
								array_push($arr_tmcate, $row['wr_1']);
						}


						$arr_mncate = array();

						for($k=0; $k<count($arr_tmcate); $k++){
								
								$arr_mncate[$arr_tmcate[$k]] = array();

						}
						
						for($k=0; $k<count($arr_tmcate); $k++){

									$sql="select * from g5_write_carte where wr_6 = {$now_sheet} {$week_search} and wr_1 = '{$arr_tmcate[$k]}' group by wr_2 order by wr_id";
									//echo $sql;
									$result_mncate = sql_query($sql);
								
									for ($l=0; $row=sql_fetch_array($result_mncate); $l++){											
											array_push($arr_mncate[$arr_tmcate[$k]], $row['wr_2']);
									}
						}
						
					//print_r($arr_mncate);
//						echo $week_search;					
								
						$sql="select * from g5_write_carte where wr_6 = {$now_sheet} {$week_search} order by wr_3, wr_id" ;	
						$result = sql_query($sql);
						$arr_menu = array();
						
						for($i=0; $i<count($arr_tmcate); $i++){
							$arr_menu[$arr_tmcate[$i]] = array();									
							for($k=0; $k<count($arr_mncate[$arr_tmcate[$i]]); $k++){									
									$arr_menu[$arr_tmcate[$i]][$arr_mncate[$arr_tmcate[$i]][$k]] = array();																
							}
						}
					
						for ($i=0; $row=sql_fetch_array($result); $i++){								
								array_push($arr_menu[$row['wr_1']][$row['wr_2']],$row['wr_5']);
						}

						
//						print_r($arr_menu);

				/*	for($i=0; $i<count($week_date); $i++){

//						echo $week_date[$i];
						$now_sheet = 0;

						if($now_sheet<2 && $i>4)
							break;

						$sql="select wr_1 from g5_write_carte where wr_6 = {$now_sheet} and wr_3 = '{$week_date[$i]}' group by wr_1 order by wr_id";
						$result_tmcate = sql_query($sql);
						
						$arr_tmcate = array();
						for ($k=0; $row=sql_fetch_array($result_tmcate); $k++){
								array_push($arr_tmcate, $row['wr_1']);
						}
					
												
						$arr_mncate = array();

						for($k=0; $k<count($arr_tmcate); $k++){
								
								$arr_mncate[$arr_tmcate[$k]] = array();

						}
						
						for($k=0; $k<count($arr_tmcate); $k++){

									$sql="select * from g5_write_carte where wr_6 = {$now_sheet} and wr_3 = '{$week_date[$i]}' and wr_1 = '{$arr_tmcate[$k]}' group by wr_2 order by wr_id";
									$result_mncate = sql_query($sql);
								
									for ($l=0; $row=sql_fetch_array($result_mncate); $l++){											
											array_push($arr_mncate[$arr_tmcate[$k]], $row['wr_2']);
									}
						}

					}
					*/
			
					

					/*$arr_menu_cnt = array();
					$arr_menu = array();						
					$arr_menu_total_cnt = array();
					for($k=0; $k<count($arr_tmcate); $k++){
									$temp_cntmenu = array();
									$temp_cntarr = array();
									$total_row = 0;
									$arr_menu_cnt[$k] = array();
									$arr_menu[$k] = array();
									$total_cnt = 0;

								for($l=0; $l<count($arr_mncate[$arr_tmcate[$k]]); $l++){									
								
									$sql="select * from g5_write_carte where wr_6={$now_sheet} and wr_3 = '{$week_date[$i]}' and wr_1 = '{$arr_tmcate[$k]}' and wr_2 = '{$arr_mncate[$arr_tmcate[$k]][$l]}' ";
									$result_menues = sql_query($sql);
									$cnt_result = sql_num_rows($result_menues);	
									$arr_menu[$k][$l] = array();
									$arr_menu_cnt[$k][$l] = array();
									array_push($arr_menu_cnt[$k][$l], $cnt_result);
									$total_cnt = $total_cnt + $cnt_result;
									for ($m=0; $row=sql_fetch_array($result_menues); $m++){

										array_push($arr_menu[$k][$l], $row['wr_5']);

								}

							}
								array_push($arr_menu_total_cnt, $total_cnt);
						}*/

?>

	<? for($i=0; $i<count($arr_tmcate); $i++){

			$first_rowspan = 0;
			for($k=0; $k<count($arr_mncate[$arr_tmcate[$i]]); $k++){
				$first_rowspan +=  ceil(count($arr_menu[$arr_tmcate[$i]][$arr_mncate[$arr_tmcate[$i]][$k]])/$divide_gap);
			}
				 $first_rowspan += count($arr_menu[$arr_tmcate[$i]])+1;

				?>
		<tr>
				<tr><th rowspan="<?=$first_rowspan+1?>"><?=$arr_tmcate[$i]?></th><tr>
				<?for($k=0; $k<count($arr_mncate[$arr_tmcate[$i]]); $k++){

								$second_rowspan = ceil(count($arr_menu[$arr_tmcate[$i]][$arr_mncate[$arr_tmcate[$i]][$k]])/$divide_gap);
								$second_rowspan++;
								
				?>
				<tr><th rowspan="<?=$second_rowspan?>"><?=$arr_mncate[$arr_tmcate[$i]][$k]?></th></tr>
				<?for ($l=0; $l<count($arr_menu[$arr_tmcate[$i]][$arr_mncate[$arr_tmcate[$i]][$k]])/$divide_gap; $l++){?>
					<tr>
							<?for($m=0; $m<7; $m++){				
										if(($now_sheet<2 && $m==5) ||	($now_sheet<2 && $m==6)){											
									?>
									<td></td>
									<?}else if($now_sheet<2){?>
								<td><?=str_replace('|','<br>',$arr_menu[$arr_tmcate[$i]][$arr_mncate[$arr_tmcate[$i]][$k]][(ceil(count($arr_menu[$arr_tmcate[$i]][$arr_mncate[$arr_tmcate[$i]][$k]])/$divide_gap))*($m) + $l])?></td>
						<?}else{?>
								<td><?=str_replace('|','<br>',$arr_menu[$arr_tmcate[$i]][$arr_mncate[$arr_tmcate[$i]][$k]][(ceil(count($arr_menu[$arr_tmcate[$i]][$arr_mncate[$arr_tmcate[$i]][$k]])/$divide_gap))*$m + $l])?></td>
									<?}}?>
					</tr>
				<?}?>
				<?}?>
			
			</tr>
			
		<?}?>


			</tbody>
		</table>
		<table>
		<?
			$date_note =substr($week_date[0],0,7);

			if($i>0){
			$sql="select * from g5_write_carte where wr_6 = {$now_sheet} and wr_2='' and wr_3 = '{$date_note}' ";
			$result_notice = sql_query($sql);

			for ($i=0; $row=sql_fetch_array($result_notice); $i++){
		
			if(!empty($row['wr_1'])){
		?>
			<tr><th><?=$row['wr_1']?></th><td><?=$row['wr_5']?></td></tr>
			<?}}}?>
		</table>

<script src="<?=str_replace("/eng","",G5_URL)?>/theme/basic2/js/jquery-1.9.1.min.js"></script>
<script src="<?=str_replace("/eng","",G5_URL)?>/theme/basic2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?=str_replace("/eng","",G5_URL)?>/theme/basic2/js/bootstrap.min.css"><!--게시판공통-->

	<div class="modal fade" id="myModal" style="margin-top:100px">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- header -->
				<div class="modal-header">
					<!-- 닫기(x) 버튼 -->
					<button type="button" class="close" data-dismiss="modal" id="cls_modal">×</button>
					<h4 class="modal-title">식단등록</h4>
				<!-- header title -->
				</div>
				<!-- body -->
				<div class="modal-body">
					<p>엑셀양식에 맞게 입력하셔야 식단이 정상적으로 등록됩니다.</p>
					<dl><input type="file" placeholder="엑셀파일등록" id="excel_file"/></dl>
					<dl id="excel_loading"></dl>
				</div>
				<!-- Footer -->
				<div class="modal-footer">
<!-- 					<a href="<?=G5_DATA_URL?>/sample.xlsx" class="btn btn-info" style="float:left; color: #FFF !important;" target="_blank">엑셀양식다운</a> -->
					<a href="<?=G5_DATA_URL?>/sample.xlsx" class="btn btn-info" style="float:left; color: #FFF !important;" target="_blank">엑셀양식다운</a>
					<button type="button" onclick="chk_upload_excel()" class="btn btn-primary">등록</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>

	</div>
	<?php if($is_adm && $is_pc){ ?>
	<div style="text-align:left; padding:5px 0 0 0;">
<!-- 		<a href="#" class="btn_cancel" onclick="window.open('<?php echo $write_href ?>&year=<?php echo $year?>&month=<?php echo $month;?>&day=<?php echo $day;?>', 'meal', 'width=800, height=700, toolbar=no, menubar=no, scrollbars=no, resizable=no');">식단등록</a> -->
<a href="javascript:void(0);" class="btn_cancel" onclick="upload_modal()">식단등록</a>

	</div>
	<?php } ?>
</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script> -->
<script>
var upload_flag =0;
var interval = 0;
var nowinterval;
$(function() {
    function swing() {
        $('#scroll_img').animate({'top':'120px'},1000).animate({'top':'120px'}, 1000).animate({'top':'125px'},1000, swing).animate({'top':'125px'}, 1000);
    }
    swing();
});

$("#bo_div").scroll(function (){
	img_show();
    swing();
});

function upload_modal(){
	$("#myModal").modal();
}

function chk_upload_excel(){
	var chk_upload = confirm("날짜 중복 시 최종 데이터로 대체 되어 집니다. 진행 하시겠습니까?");
	if(chk_upload == true){
		upload_excel();
	}
	else if(chk_upload == false){
		return;
	}
}

function upload_excel(){
	if(upload_flag == 1){
		alert("업로드 중 입니다.");					
		//$("#myModal").hide();
		return;						
	}		

	var form = $('#excel_form')[0];
	var formData = new FormData(form);
	var excelfile = $("#excel_file")[0].files[0];
	if(excelfile == null){
		alert("등록된 파일이 없습니다.");
		return;
	}
	formData.append("excel_file", excelfile);
	$("#excel_file").val('');
	//$("#myModal").hide();
	upload_flag = 1;

	nowinterval = setInterval(function(){ 
		var str = '.';
		if (interval%3 == 0) str = ".";
		else if (interval%3 == 1) str = "..";
		else str = "...";
		$('#excel_loading').html('업로드 중입니다' + str);
		interval++;
	}, 700);

	setTimeout(function() {
		$.ajax({
			url: "./upload_excel.php",
			processData: false,
			contentType: false,
			data: formData,
			type: 'POST',
			success: function(data){ 	
				console.log(data);
				
				if(data =='exist'){
					alert("이미 등록되어진 데이터가 존재합니다.");
					$('#excel_file').val('');
					upload_flag = 0;
					clearInterval(nowinterval);
					$('#excel_loading').html('');

				}
				else{
					$('#excel_file').val('');
					alert("식단등록이 완료되었습니다");
					upload_flag = 0;
					clearInterval(nowinterval);
					$('#excel_loading').html('');
					$("#cls_modal").click();
				}
				
				//location.href="./board.php?bo_table=order";
			}
		});
	}, 1000);
}

function img_show(){
	var $w = $("#bo_div").scrollLeft();
	if($w>80){
		$("#scroll_img").addClass("scroll-hidden");
		$("#scroll_img").removeClass("scroll-show");
	}
}

</script>