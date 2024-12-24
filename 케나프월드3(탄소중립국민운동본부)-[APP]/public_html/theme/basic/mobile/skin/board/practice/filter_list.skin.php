<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$si_arr = array("서울","경기","인천","부산","대구","대전","울산","광주","충남","충북","경남","경북","전남","전북","강원","제주");

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

<form name="filter" id="filter" action="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>&filter=1" onsubmit="return setFilter(this);" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="search" value="1">
<section>
	<!-- 매물정보를 불러오지 못했을때 -->
		<article class="box-article">
			<div class="box-body">
				<div class="box-contitle">지역</div>
				<div class="box-content clearfix">
					<div class="col-xs-6">
						<select name="si" id="si" class="regist-input">
							<option value="">시</option>
							<?php for($i=0; $i<count($si_arr); $i++){ ?>
							<option value="<?php echo $si_arr[$i]?>" <?php if($si==$si_arr[$i]) echo "selected";?>><?php echo $si_arr[$i]?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-xs-6">
						<select name="gu" id="gu" class="regist-input">
							<option value="">구</option>
						</select>
					</div>
				</div>
			</div>
		</article>
		<article class="box-article">
			<div class="box-body">
				<div class="box-contitle">옵션</div>
				<div class="box-content clearfix">
					<ul class="option">
						<?php 
						$opa = array("홀연습<br/>가능", "금관연습<br/>가능", "현악연습<br/>가능", "드럼연습<br/>가능", "피아노<br/>연습가능", "그랜드피아노<br/>연습가능", "숙식<br/>가능", "주차<br/>가능");
						for($i=0; $i<count($opa); $i++){
							$img_no = ($i+1) < 10 ? "0".($i+1):($i+1) ;
						?>
						<li class="<?php if($fop[$i]) echo "on"; else echo "off";?>" data-for="fop_<?php echo $i;?>" style="margin-top:5px;<?php if($i==5) echo "width:calc(36% + 5px)";?>">
							<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/option_ico<?php echo $img_no;?>_<?php if($fop[$i]) echo "on"; else echo "off"?>.png" /><p><?php echo $opa[$i]; ?></p>
							<input type="hidden" name="fop[]" id="fop_<?php echo $i;?>" value="<?php echo $fop[$i]; ?>">
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</article>
		<article class="box-article">
			<div class="box-body">
				<div class="box-contitle">시설</div>
				<div class="box-content clearfix">
					<ul class="option">
						<?php 
						$opa = array("음향시설<br/>구비","무대홀<br/>있음","스튜디오<br/>있음","24시간<br/>가능","에어컨<br/>설치","난방기<br/>설치","휴게실<br/>있음","흡연실<br/>있음","CCTV<br/>설치","WIFI<br/>무료","화장실<br/>있음");
						for($i=0; $i<count($opa); $i++){
							$img_no = ($i+1) < 10 ? "0".($i+1):($i+1) ;
						?>
						<li class="<?php if($foc[$i]) echo "on"; else echo "off";?>" data-for="foc_<?php echo $i;?>" style="margin-top:5px;">
							<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/fac_ico<?php echo $img_no;?>_<?php if($foc[$i]) echo "on"; else echo "off"?>.png" /><p><?php echo $opa[$i]; ?></p>
							<input type="hidden" name="foc[]" id="foc_<?php echo $i;?>" value="<?php echo $foc[$i]; ?>">
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</article>
		<input type="submit" class="btn btn-primary" value="필터검색" style="width:100%;">
</section>

<div id="search_wrap">
	<div id="s_search">
        <h2 class="r_list"><i class="fa fa-list-ul"></i> <?php echo $board['bo_subject'];?> 리스트
            <span class="grade">
                <select name="orderby" id="orderby" class="form-control">
					<option value="" <?php if($orderby == "" ) echo "selected";?>>최근등록순</option>
					<option value="point" <?php if($orderby == "point") echo "selected";?>>평점순</option>
                </select>
            </span>
        </h2>
    </div><!--s_search-->

    <div class="container">	
        <!--탑배너시작-->
        <div class="s2_topten row">
            <div class="topten_in col-xs-12">
                <div id="topten_list">

					<div id="topten_list" style="padding:10px;">
						<!-- 게시판 페이지 정보 및 버튼 시작 { -->
						<div class="bo_fx">
							<div id="bo_list_total">
								<span>Total <?php echo number_format($total_count) ?>건</span>
								<?php echo $page ?> 페이지
							</div>
						</div>
						<!-- } 게시판 페이지 정보 및 버튼 끝 -->
						<?php
						for ($i=0; $i<count($list); $i++) { 
							$sql = "select * from {$write_table} where wr_id = '{$list[$i]['wr_id']}' and wr_is_comment = 0";
							$row = sql_fetch($sql);
							$row['href'] = G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id'];

							$thumb = "";
							if($row['wr_19']){
								$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 150, 150);
							}

							if($thumb['src']) {
								$img_href = $thumb['src'];
							}else if(!$thumb['src'] && $row['wr_19']){
								$img_href = $board_skin_url."/img/noimg_s.jpg";
							} else {
								$img_href = $board_skin_url."/img/none_s.jpg";
							}
							
							$sql = " select round(avg(wr_1), 1) as wr_1, count(*) as cnt from $write_table where wr_parent = '{$list[$i]['wr_id']}' and wr_is_comment = 1 and wr_comment_reply = ''";
							$com = sql_fetch($sql);
							$com_avg = floor($com['wr_1']) + 0.5;

							if($com['wr_1'] > $com_avg){
								$com_avg = $com_avg;
							}else{
								$com_avg = $com_avg - 0.5;
							}
						?>
						<div class="room">
							<a href="<?php echo $row['href'];?>">
							<span class="thum"><img src="<?php echo $img_href;?>" style="width:100%;"/></span>
							<div class="info">
								<h2 class="title">
									<div class="star" style="display:inline-block">
									<?php 
									for($k=0; $k<5; $k++){ 
										if($k < $com_avg){
											if($com_avg == $k + 0.5)
												echo "<i class=\"fa fa-star-half-o\"></i>";
											else
												echo "<i class=\"fa fa-star\"></i>";
										}else{
											echo "<i class=\"fa fa-star-o\"></i>";
										}
									} 
									?>
									</div>
									<?php echo $row['wr_subject'];?>
								</h2>
								<div class="add"><?php echo $row['wr_2'];?></div>
								<div class="hours"><span class="st">운영시간</span><?php echo $row['wr_17']; ?></div>
								<div class="tel"><span class="st">전화번호</span><?php echo $row['wr_18']; ?> <a href="tel:<?php echo $row['wr_18']; ?>"><i class="fa fa-phone-square"></i></a></div>
							</div><!--info-->
							</a>
						</div><!--room-->
						<?php } ?>
					</div>
					<?php echo $write_pages;  ?>

                </div><!--topten_list-->
            </div>
        </div><!--topten-->
    </div>
</div><!--search_wrap-->
</form>

<script>


$(document).ready(function (){
	getCity("<?php echo $si?>");
	getCity("<?php echo $si?>", "<?php echo $gu?>");

});

function setFilter(f){
	return true;
}

$("#si").change(function (){
	$("#gu").find("option").remove();
	$("#gu").append("<option value=''>구/군(전체)</option>");

	getCity($(this).val(), "")
});

$("#gu").change(function (){
	var si = $("#si").val();

	getCity(si, $(this).val())
});
	
function getCity(si, gu){
	if(!si && !gu){
		return false;
	}

	var opt;
	var opt_select;

	$.ajax({
		type:"GET",
		url:"<?php echo G5_PLUGIN_URL?>/address/address.php",
		dataType: "json",
		data: {
			"si": si,
			"gu": gu
		},
		success:function(datas){
			for(var i=0; i<datas.length; i++){
				if("<?php echo $si?>" == datas[i] || "<?php echo $gu?>" == datas[i] || "<?php echo $dong?>" == datas[i])
					opt_select = "selected";
				else 
					opt_select = "";

				opt = "<option value='"+datas[i]+"' "+opt_select+">"+datas[i]+"</option>";
				if(!gu){
					$("#gu").append(opt);
				}else{
				}
			}
		},
		error:function(request,status,error){
			alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

$(".option li").click(function (){
	var img_src = $(this).find("img").attr("src");
	if($(this).hasClass("on")){
		$(this).removeClass("on");
		$("#"+$(this).data("for")).val("");
		$(this).find("img").attr("src", img_src.replace("on.", "off."));
	}else{
		$(this).addClass("on");
		$("#"+$(this).data("for")).val("1");
		$(this).find("img").attr("src", img_src.replace("off.", "on."));
	}
});
</script>