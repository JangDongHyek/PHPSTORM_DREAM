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

$week_str = array("일","월", "화", "수", "목", "금", "토", );

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

if(empty($now_sheet))
	$now_sheet = 0;


add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

?>
<div id="bo_tbtn">

<a href="?bo_table=carte&mktime=<?=$mktime?>&now_sheet=0">UJ</a>
<a href="?bo_table=carte&mktime=<?=$mktime?>&now_sheet=1">LJ</a>
<a href="?bo_table=carte&mktime=<?=$mktime?>&now_sheet=2">MS,SS</a>
</div>

<div id="bo_list">
	<div class="date_title">
		<a href="<?php echo $pweek_url?>" class="arrow_left">  </a> <?php echo $year?> 년 <?php echo $month?> 월 <?php echo $week?> 주차 <a href="<?php echo $nweek_url?>" class="arrow_right">  </a>
	</div>
	
	<?/*php if(!$is_adm){ ?>
	<div class="scroll-img">
		<img id="scroll_img" src="<?php echo $board_skin_url?>/img/icon_scroll.png">
	</div>
	<?php } */?>

	
<style>
.box{ padding:0 5px 20px 5px;letter-spacing:0; margin-bottom:30px; border-bottom:1px solid #ddd;}
#box_wrap .box:last-child{ border-bottom:0; margin-bottom:0;}
.box .date{ font-size:1.3em;font-weight:bold; color:#222; margin-bottom:10px;}
.box .box_line{ margin-bottom:20px;}
.box .box_in{ padding:15px 20px 18px 20px; border:1px solid #e1e1e1; border-radius:10px; margin-bottom:5px;}
.box .box_in:nth-child(even){ background:#f7f7f7;}
.box .ftime{background:#118ccf; color:#fff; font-size:1.15em; font-weight:bold; padding:10px 20px; line-height:12px; border-radius:30px; margin-bottom:5px;}
.box .ftime span{ font-size:12px; font-weight:normal; display:inline-block; margin-left:5px; opacity:0.8;}
.box .fs{ font-size:1.2em; font-weight:500; color:#333; margin-bottom:10px;}
.box .fs span{ display:inline-block; position:relative;}
.box .fs span:after{ display:block; content:""; width:100%; height:5px; background:rgba(17,140,207,0.4); position:absolute; bottom:2px; left:0;}
.box .fc{ overflow-x:scroll; overflow-y:hidden; padding-bottom:5px;}
.box .fc_no{ text-align:center; color:#999; padding:10px 0;}
.box .fc ul{ max-width:100%; display:flex;}
.box .fc ul:after{ display:block; content:""; clear:both;}
.box .fc li{ float:left; padding-right:20px; margin-left:20px; border-right:1px dotted #e1e1e1;word-break: keep-all;word-wrap:break-word;}
.box .fc li:first-child{ margin-left:0}
.box .fc li:last-child{ border-right:0; padding-right:0;}

</style>
	<?
		for($i=0; $i<count($week_date); $i++){			
					$day = date("w",strtotime($week_date[$i]));
					$sql="select count(*) as cnt from g5_write_carte where wr_6 = {$now_sheet} and wr_3 ='{$week_date[$i]}' ";
					$cnt_menu = sql_fetch($sql);
					if($cnt_menu['cnt'] <=0){
						continue;
					}

	?>
	<!--하루 식단 시작//-->
    <div class="box">
        <div class="date"><?=$week_date[$i]?>(<?=$week_str[$day]?>)</div><!--날짜표시-->

			<?
					
					$sql ="select count(distinct wr_1) as cnt from g5_write_carte where wr_6   = {$now_sheet} and  wr_3 = '{$week_date[$i]}'  ";
					$cnt_wr1 = sql_fetch($sql);
//					$sql ="select count(distinct wr_1) as cnt from g5_write_carte where wr_6   = {$now_sheet} and  wr_3 = '{$week_date[$i]}'  ";
					$sql ="select * from g5_write_carte where wr_6   = {$now_sheet} and  wr_3 = '{$week_date[$i]}' group by wr_1 order by wr_id ";
					$result_wr1 = sql_query($sql);

					
					for ($k=0; $row=sql_fetch_array($result_wr1); $k++){
							
							$sql ="select * from g5_write_carte where wr_6 = {$now_sheet} and wr_3 ='{$week_date[$i]}'  and wr_1 = '{$row['wr_1']}' group by wr_2";
							$result_wr2 = sql_query($sql);
							
							?>			
		
        <div class="ftime"><?=$row['wr_1']?> <span><?=$week_date[$i]?>(<?=$week_str[$day]?>)</span></div><!--아침/점심/저녁 , 날짜표시-->		
        <div class="box_line">      
		<?
						for ($l=0; $row2=sql_fetch_array($result_wr2); $l++){									
		?>
            <div class="box_in">
                <div class="fs"><span><?=$row2['wr_2']?></span></div><!--음식종류-->  			
                <div class="fc"><!--식단-->  
                	<ul>
						<?

							$sql ="select * from g5_write_carte where wr_6 = {$now_sheet} and wr_3 ='{$week_date[$i]}'  and wr_1 = '{$row['wr_1']}' and wr_2 = '{$row2['wr_2']}' ";
							$result_wr3 = sql_query($sql);																			
							$real_cnt = 0;
							for ($m=0; $row3=sql_fetch_array($result_wr3); $m++){
										if($row3['wr_5']==''){
											continue;
										}
							$real_cnt ++;
							$menu = explode("|", $row3['wr_5']);
							?>
							<li>
						<?
							for($n = 0; $n<count($menu); $n++){

					?>
                    	<?=$menu[$n]?><br />
						<?}?>
						</li>
						<?}if($real_cnt<=0){?>
		
							  <div class="fc_no"><!--등록된 식단이 없을경우-->  
								등록된 식단이 없습니다.
							</div><!--.fc-->

						<?}?>
                      <!--   Vegetable Bibimbap(1)<br />
                        青蔬拌饭</li>
                                            	<li>옛날소시지전<br />
                        Pan Fried Egg Coated Sausages(1,3,6,7,15)<br />
                        香肠饼</li>
                                            	<li>근대나물<br />
                        Seasoned Blanched Chard(6)<br />
                        凉拌菜</li>
                                            	<li>포기김치<br />
                        Kimchi<br />
                        泡菜</li>
                                            	<li>미역국<br />
                        Seaweed "Miyeok-Guk" Soup<br />
                        海带汤</li>
                                            	<li>셀프샌드위치바<br />
                        Self-sandwich bar<br />
                        夹心面包</li>
                                            	<li>요거트<br />
                        Yogurt (1)<br />
                        优格吧</li>
                                            	<li>우유<br />
                        milk(2)<br />
                        牛乳</li>
                                            	<li>시리얼<br />
                        Cereal(7)<br />
                        麦片</li> -->
                    </ul>
                </div><!--.fc-->
            </div><!--.box_in-->		
			<?}?>
        </div><!--.box_line-->		
			<?}?>        
    </div><!--.box-->
	<!--//하루 식단 끝-->
	<? } ?>

	<div id="bo_div" class="tbl_head01 tbl_wrap">
	
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

<script src="<?=G5_URL?>/theme/basic2/js/jquery-1.9.1.min.js"></script>
<script src="<?=G5_URL?>/theme/basic2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?=G5_URL?>/theme/basic2/js/bootstrap.min.css"><!--게시판공통-->

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
					<dl><input type="file" placeholder="엑셀파일등록" id="excel_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/></dl>
					<dl id="excel_loading"></dl>
				</div>
				<!-- Footer -->
				<div class="modal-footer">
 					<a href="<?=G5_DATA_URL?>/sample2.xlsx" class="btn btn-info" style="float:left; color: #FFF !important;" target="_blank">엑셀양식다운</a>
<!--					<a href="--><?//=G5_DATA_URL?><!--/sample.xlsx" class="btn btn-info" style="float:left; color: #FFF !important;" target="_blank">엑셀양식다운</a>-->
					<button type="button" onclick="chk_upload_excel()" class="btn btn-primary">등록</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>

	</div>
	<?php if($member['mb_level']=='10'){ ?>
	<div style="text-align:left; padding:5px 0 0 0;">
<!-- 		<a href="#" class="btn_cancel" onclick="window.open('<?php echo $write_href ?>&year=<?php echo $year?>&month=<?php echo $month;?>&day=<?php echo $day;?>', 'meal', 'width=800, height=700, toolbar=no, menubar=no, scrollbars=no, resizable=no');">식단등록</a> -->
<a href="javascript:void(0);" class="btn_cancel" onclick="upload_modal()">식단등록</a>

	</div>
	<?php } ?>
</div>
<div id="result"></div>

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
				$("#result").html(data);
				
				//location.href="./board.php?bo_table=order";
                location.reload();
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