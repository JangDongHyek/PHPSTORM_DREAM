<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//2018-08-21 배성현 : 야식 추가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');


if(!$mktime) $mktime = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
if($mktime){
	$year = date("Y", $mktime);
	$month = date("m", $mktime);
	$day = date("d", $mktime);
}

//날짜 없을때
if(!$year) $year = date("Y");
if(!$month) $month = date("m");
if(!$day) $day = date("d");

$week_str = array("일", "월", "화", "수", "목", "금", "토");

if(empty($now_sheet))
	$now_sheet=0;

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//$sql="select wr_1 from g5_write_carte where wr_6 = {$now_sheet} {$week_search} group by wr_1 order by wr_id";



//메뉴
$sql="select wr_1 from g5_write_carte where wr_3 = '{$year}-{$month}-{$day}'  and wr_6 = {$now_sheet} group by wr_1 order by wr_id";
$result_tmcate = sql_query($sql);

$meal = array();

for ($k=0; $row=sql_fetch_array($result_tmcate); $k++){
        array_push($meal, $row['wr_1']);
}

//$menu = array("탕류", "추가", "한식", "일품", "쉐프", "음료", "샐러드", "한식 Or 일품", "한정 일품", "한식", "샌드위치", "김밥");
/*
if(!$sme){
	$time = date("H");
	if($time <= 10 && $time >= 6)	$sme = "조 식";
	else if($time <= 14 && $time >= 11) $sme = "중 식";
	else if($time <= 22 && $time >= 15) $sme = "석 식";
	else if($time <= 24 && $time >= 23) $sme = "야 식";
	else $sme = "중 식";
}
*/



//이전주, 다음주
if(empty($sme)){
		$sme = $meal[0];
}
$nex_day = $mktime + 86400;
$pre_day = $mktime - 86400;

if($is_adm)
	$bbs_url = G5_ADMIN_URL."/bbs";
else
	$bbs_url = G5_BBS_URL;

$nday_url = $bbs_url."/board.php?bo_table=".$bo_table."&is_day=1&mktime=".$nex_day."&now_sheet=".$now_sheet;
$pday_url = $bbs_url."/board.php?bo_table=".$bo_table."&is_day=1&mktime=".$pre_day."&now_sheet=".$now_sheet;

add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<div id="bo_tbtn">
<a href="?bo_table=carte&is_day=1&mktime=<?=$mktime?>&sme=<?=$sme?>&now_sheet=0">UJ</a>
<a href="?bo_table=carte&is_day=1&mktime=<?=$mktime?>&sme=<?=$sme?>&now_sheet=1">LJ</a>
<a href="?bo_table=carte&is_day=1&mktime=<?=$mktime?>&sme=<?=$sme?>&now_sheet=2">MS,SS</a>
<!--<a href="?bo_table=carte&is_day=1&mktime=<?/*=$mktime*/?>&sme=<?/*=$sme*/?>&now_sheet=3">간식</a>-->
</div>
<?
			$today = $year.'-'.$month.'-'.$day;		
			$sql="select * from g5_carte_images where 
                    date= '{$today}' and
                    tmcate='{$sme}' and 
                    sheet='{$now_sheet}' ";

			$result_images  = sql_query($sql);
			$cnt_images = sql_num_rows($result_images);			
		?>
<div class="swiper-container" style="<?if($cnt_images<=0) echo 'display:none';?>">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper" id="swiper_content">
        <!-- Slides -->
		<?
			for ($i=0; $row=sql_fetch_array($result_images); $i++){							
		?>
        <div class="swiper-slide"><img src="<?=G5_DATA_URL.'/file/carte/'.$row['file_path']?>" /></div>
		<?}?>
       <!--  <div class="swiper-slide">Slide 2</div>
        <div class="swiper-slide">Slide 3</div> -->
        ...
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>


</div>

<input type="hidden" name="sme" id="sme" value="<?php echo $sme?>">
<div id="bo_list" style="width:<?php echo $width; ?>">
	<div class="date_title">
		<a href="#" onclick="location.href = '<?php echo $pday_url?>&sme='+document.getElementById('sme').value;" class="arrow_left">  </a> 
		<?php echo $year?> 년 <?php echo $month?> 월 <?php echo $day?> 일 ( <?php echo $week_str[date("w", $mktime)]; ?>요일 )
		<a href="#" onclick="location.href = '<?php echo $nday_url?>&sme='+document.getElementById('sme').value;" class="arrow_right">  </a> 
	</div>
	<div id="menu">
	<?php for($i=0; $i<count($meal); $i++){ ?>
	<input type="button" name="menu[]" value="<?php echo $meal[$i]?>" class="<?php echo $sme==$meal[$i] ? "btn_submit" : "btn_cancel"?>">
	<?php } ?>
	</div>

	<div id="info">
	</div>

    <?php if($_SERVER['REMOTE_ADDR'] == "59.19.201.109" || $_SERVER['REMOTE_ADDR'] == "121.140.204.65"){ ?>
        <!--간식 추가-->
        <div class="tbl_head01 tbl_wrap" style="margin-top:20px;">
            <table>
                <colgroup>
                    <col style="width:12%" />
                    <col style="width:auto" />
                </colgroup>
                <tr>
                    <th>기숙사 간식</th>
                    <td>고구마, 우유</td>
                </tr>
            </table>
        </div>

        <div class="tbl_head01 tbl_wrap" style="margin-top:20px;">
            <table>
                <colgroup>
                    <col style="width:12%" />
                    <col style="width:auto" />
                </colgroup>
                <tr>
                    <th rowspan="3">기숙사 간식</th>
                    <td>고구마</td>
                </tr>
                <tr>
                    <td>우유</td>
                </tr>
            </table>
        </div>
        <!--//간식 추가-->
    <?php }?>

</div>

<script src="<?=G5_URL?>/theme/basic2/js/jquery-1.9.1.min.js"></script>
<script src="<?=G5_URL?>/theme/basic2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?=G5_URL?>/theme/basic2/js/bootstrap.min.css"><!--게시판공통-->




 <form name="fwrite" id="fwrite" action="./upload.image.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data">
 <input type="hidden" name="img_date" id ="img_date" value="<?=$year.'-'.$month.'-'.$day?>"/>
   <input type="hidden" name="nowsheet" id="nowsheet"  value="<?=$now_sheet?>"/>
  <input type="hidden" name="tmcate" id="tmcate"  value="<?=$sme?>"/>
	<input type="hidden" name="url_before" id="url_before"  value="<?=$actual_link?>"/>
	<div class="modal fade" id="myModal" style="margin-top:100px">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- header -->
				<div class="modal-header">
					<!-- 닫기(x) 버튼 -->
					<button type="button" class="close" data-dismiss="modal" id="cls_modal">×</button>
					<h4 class="modal-title">식단 이미지 등록</h4>
				<!-- header title -->
				</div>
				<!-- body -->
				<div class="modal-body">					
					<dl><input type="file" name="bf_file[]" placeholder="이미지파일#1" id="img_file1" accept="image/*"/></dl>
					<dl><input type="file" name="bf_file[]" placeholder="이미지파일#2" id="img_file2" accept="image/*"/></dl>
					<dl><input type="file" name="bf_file[]" placeholder="이미지파일#3" id="img_file3" accept="image/*"/></dl>
					<dl><input type="file" name="bf_file[]" placeholder="이미지파일#4" id="img_file4" accept="image/*"/></dl>
					<dl><input type="file" name="bf_file[]" placeholder="이미지파일#5" id="img_file5" accept="image/*"/></dl>
                    <dl><input type="file" name="bf_file[]" placeholder="이미지파일#6" id="img_file6" accept="image/*"/></dl>
                    <dl><input type="file" name="bf_file[]" placeholder="이미지파일#7" id="img_file7" accept="image/*"/></dl>
                    <dl><input type="file" name="bf_file[]" placeholder="이미지파일#8" id="img_file8" accept="image/*"/></dl>
                    <dl><input type="file" name="bf_file[]" placeholder="이미지파일#9" id="img_file9" accept="image/*"/></dl>
                    <dl><input type="file" name="bf_file[]" placeholder="이미지파일#10" id="img_file10" accept="image/*"/></dl>
				</div>
				<!-- Footer -->
				<div class="modal-footer">
<!-- 					<a href="<?=G5_DATA_URL?>/sample.xlsx" class="btn btn-info" style="float:left; color: #FFF !important;" target="_blank">엑셀양식다운</a> -->
					<button type="submit" class="btn btn-primary">등록</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
	</form>

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<br>
<?if($member['mb_level']=="10"){?>
	<a href="javascript:void(0);" class="btn_cancel" onclick="upload_modal()">식단 이미지 등록</a>
	<a href="javascript:void(0);" class="btn_cancel" onclick="delete_imgs()">식단 이미지 삭제</a>
	<?}?>
<script>
var swiper;
$(document).ready(function (){

	getInfo("<?php echo $mktime?>", "<?php echo $sme?>");
	// swiper = new Swiper('.swiper-container', {
  // // Optional parameters
	//   loop: true,
  //
  // // If we need pagination
	//   pagination: {
	// 	el: '.swiper-pagination',
	//   },
  // // Navigation arrows
	// 	  navigation: {
	// 		nextEl: '.swiper-button-next',
	// 		prevEl: '.swiper-button-prev',
	// 	  },
	// 	})
});

function upload_modal(){
	$("#myModal").modal();
}

function delete_imgs(){

	var date_now = $("#img_date").val();
	var tmcate_now = $("#tmcate").val();
	var sheet_now = $("#nowsheet").val();

	// console.log(date_now+" "+tmcate_now+" "+sheet_now);


	var con_test = confirm("이미지 삭제시 등록된 이미지가 모두 삭제 됩니다.\n이미지를 삭제하시겠습니까?");
	if(con_test == true){	 

		$.ajax({
			url: "./ajax.delete_imgs.php",
			type: "POST",
			data: {
					"date" : date_now,
					"tmcate" : tmcate_now,
					"sheet" : sheet_now
			},
			success: function(data){							
				console.log(data);
				location.reload();
			}
	});			

	}
	else if(con_test == false){	 
	}

}

$("[name='menu[]']").click(function (){

	var $index = $(this).index("[name='menu[]']");
	var sme = $(this).val();
	var mktime = "<?php echo $mktime?>";
	
	for(var i=0; i<$("[name='menu[]']").length; i++){
		if($("[name='menu[]']").eq(i).hasClass('btn_submit')){
			$("[name='menu[]']").eq(i).removeClass('btn_submit');
			$("[name='menu[]']").eq(i).addClass("btn_cancel");
		}
	}

	$("[name='menu[]']").eq($index).removeClass("btn_cancel");
	$("[name='menu[]']").eq($index).addClass("btn_submit");
	$("#sme").val(sme);
	$("#tmcate").val(sme);
	getInfo(mktime, sme);

});

function getInfo(mktime, sme){
	var params = "&mktime="+mktime+"&sme="+encodeURI(sme)+"&now_sheet=<?=$now_sheet?>";

	$.ajax({
		type:"POST",
		url:"<?php echo G5_BBS_URL?>/ajax.carte.php?bo_table=<?php echo $bo_table?>"+params,
		dataType:"html",
		success:function(datas){
			$("#info").html(datas);
		}
	});

	$.ajax({
		type:"POST",
		url:"<?php echo G5_BBS_URL?>/ajax.carte.swiper.php?date=<?php echo $today?>&sme="+sme+"&sheet=<?=$now_sheet?>",
		dataType:"html",
		success:function(datas){
				$("#swiper_content").html(datas);
				// if(swiper!=null){
				// 		swiper.update();
				// }
				// else{
					swiper = new Swiper('.swiper-container', {
					  // Optional parameters
						  loop: true,

					  // If we need pagination
						  pagination: {
							el: '.swiper-pagination',
						  },
					  // Navigation arrows
							  navigation: {
								nextEl: '.swiper-button-next',
								prevEl: '.swiper-button-prev',
							  },
					});
				// }
		}
	});

}
</script>


