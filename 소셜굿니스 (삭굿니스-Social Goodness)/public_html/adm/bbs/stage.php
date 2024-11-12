<?php
include_once('./_common.php');
//$g5['title'] = "물리치료사";
include_once(G5_BBS_PATH.'/_head.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

//검색을 했을 경우
if(0<count($column)){
	$columnStr="";
	for($i=0;$i<count($column);$i++){
		$columnStr.="list".$column[$i].",";
	}
	$columnStr=substr($columnStr,0,strlen($columnStr)-1);
	$sql="select $columnStr from g5_estimate where mb_id='$member[mb_id]' and cat1='$cat1' and cat2='$cat2'";
	$result=sql_query($sql);
	$row=sql_fetch_array($result);
}

?>

<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="../css/swiper.min.css">


<style>
/*문제풀기 1차 카테고리 시작*/
#container_title{display:none;}
.swiper-container {
width: 100%;
height: 100%;
}
.swiper-slide {
text-align: center;
font-size: 18px;
background: #fff;
/* Center slide text vertically */
display: -webkit-box;
display: -ms-flexbox;
display: -webkit-flex;
display: flex;
-webkit-box-pack: center;
-ms-flex-pack: center;
-webkit-justify-content: center;
justify-content: center;
-webkit-box-align: center;
-ms-flex-align: center;
-webkit-align-items: center;
align-items: center;}
.swiper-button-next, .swiper-container-rtl .swiper-button-prev{ background:none !important; position:inherit; left:inherit; top:inherit;}
.swiper-button-prev, .swiper-container-rtl .swiper-button-next{ background:none !important; position:inherit; left:inherit; top:inherit;}
.swiper-pagination{display:none !important;}
.clinc_wrap{width:100%; height:100%; position:relative;}
.clinic{height:100%; width:100%;/* padding:21% 0 29% 0; */ position:relative;}
.clinic .in{width:100%; position:absolute; top:50%; margin-top:-260px;}
.clinic.bg1{background:#c3d600;}
.clinic.bg2{background:#00b0ec;}
.clinic.bg3{background:#00a055;}
.clinic.bg4{background:#6d60a7;}
.clinic h2{ text-align:center; font-size:1.78em; font-weight:900; color:#fff; text-shadow:1px 1px 1px #999; padding-top:30px;}
.clinic .arr {color:#fff; opacity:0.4;}
.clinic .arr:hover{opacity:1;}
.clinic .img{width:220px; margin:0 auto; padding:45px 0;}
.clinic .img img{width:100%; height:auto;}
.clinic .play{display:block; background:rgba(0,0,0,0.2); padding:8px 0; color:#fff; font-size:2.1em; font-weight:bold;}
.clinic .play:hover{color:#FF0; text-decoration:none;}
.bt_icon{position:fixed; bottom:5px; width:100%; z-index:5; padding:0 10px; text-align:center;}
.bt_icon li{display:inline-block; background:#fff; border-radius:100px; margin:0 3px;}
.bt_icon li a{font-size:1.8em; color:#999; display:block; width:40px; height:40px; padding-top:6px; }
.bt_icon li img{width:27px; height:auto;}

/*문제풀기 1차 카테고리 끝*/



/*모달팝업시작*/
.clinic .btn-primary{border:none; border-radius:0 !important;}/*play버튼*/
.clinicpop .modal-header{color:#fff; font-size:2em; font-weight:800; padding:5px; text-align:center; border-radius:10px 10px 0 0}
.clinicpop .modal-content{border-radius:10px; width:100%;}
.clinicpop .modal-body{padding:12px 12px 0 12px; height:380px; overflow:auto;}
.clinicpop .modal-dialog{margin:10%;}
.clinicpop .modal-footer{text-align:center;padding:0 0 5px 0; border:none;}
.clinicpop .btn-default{border:none;}
.clinicpop .modal .fa-times-circle{font-size:3em;}
.clinicpop .modal.in .modal-dialog{  position:absolute;
  top:0;right:0;bottom:0;left:0;
  display:flex;
  align-items:center;
  justify-content:center;

  display:-webkit-flex;
  -webkit-align-item;center;
  -webkit-justify-content:center; /*팝업세로중앙정렬*/}



.clinicpop.edit .modal-content{ background:none; border:none; box-shadow:none;}
.clinicpop.edit .modal-header{border:none; padding-bottom:30px;}
.clinicpop.edit .modal-backdrop.in{opacity:0.8}
.clinicpop.edit .modal-header .info{}
.clinicpop.edit .modal-header .face{float:left; padding-right:10px;}
.clinicpop.edit .modal-header .face .fa-user-circle{font-size:2.7em;}
.clinicpop.edit .modal-header .modal-title{float:left; text-align:left;}
.clinicpop.edit .modal-header .modal-title .name{color:#e4004d;}
.clinicpop.edit .modal .close{opacity:1}
.clinicpop.edit .modal .close .fa-times{color:#fff !important; font-size:2.5em !important;}
.clinicpop.edit .modal .clinc_sec .box .list li{border:none; background:#fff;}
.clinicpop.edit .modal .clinc_sec .box .list li:first-child{background:#e4004d;}
.clinicpop.edit .modal .clinc_sec .box .list li:first-child a{color:#fff;}
.clinicpop.edit .modal .clinc_sec .box .list li a{color:#e4004d;}



/*카테고리별 모달팝업 색상지정*/
.clinicpop .modal{}
.clinicpop.ca01 .modal .modal-header{ background:#c3d600;}
.clinicpop.ca02 .modal .modal-header{ background:#00b0ec;}
.clinicpop.ca03 .modal .modal-header{ background:#00a055;}
.clinicpop.ca04 .modal .modal-header{ background:#6d60a7;}

.clinicpop.ca01 .modal .clinc_sec .box .list li{border:2px solid #c3d600;}
.clinicpop.ca02 .modal .clinc_sec .box .list li{border:2px solid #00b0ec;}
.clinicpop.ca03 .modal .clinc_sec .box .list li{border:2px solid #00a055;}
.clinicpop.ca04 .modal .clinc_sec .box .list li{border:2px solid #6d60a7;}

.clinicpop.ca01 .modal .fa-times-circle{color:#c3d600;}
.clinicpop.ca02 .modal .fa-times-circle{color:#00b0ec;}
.clinicpop.ca03 .modal .fa-times-circle{color:#00a055;}
.clinicpop.ca04 .modal .fa-times-circle{color:#6d60a7;}


/*문제풀기 2차 카테고리*/
.clinc_sec{width:100%;}
.clinc_sec .box{}
.clinc_sec .box .list {width:100%; padding:0;}
.clinc_sec .box .list li{ background:#fff; border-radius:50px; list-style:none; margin:8px; text-align:center;}
.clinc_sec .box .list li a{display:block; padding:7px 0; color:#333; font-weight:bold; font-size:1.5em;}
.clinc_sec .box .list li a:hover{text-decoration:none;}
.clinc_sec .box h2{display:none;}
/*모달팝업끝*/

.clinicpop.exam .modal-header{color:#fff; font-size:2.2em; font-weight:800; padding:5px; text-align:center; border-radius:5px 5px 0 0}
.clinicpop.exam .modal-body{padding:12px 12px 0 12px; text-align:center;  height: inherit; }
.clinicpop.exam .modal-dialog{margin:10%;}
.clinicpop.exam .modal-footer{text-align:right; padding:0 0 5px 0; border:none;}
.clinicpop.exam .btn-default{border:none; background:none;}
.clinicpop.exam .modal .fa-times-circle{font-size:3em; color:#fff;}
.clinicpop.exam .modal.in .modal-dialog{ position:absolute;top:0;right:0;bottom:0;left:0;display:flex;align-items:center;justify-content:center;display:-webkit-flex;
  -webkit-align-item;center;
  -webkit-justify-content:center; /*팝업세로중앙정렬*/}
.clinicpop.exam.ca01 .modal-content{background:#c3d600;}
.clinicpop.exam.ca02 .modal-content{background:#00b0ec;}
.clinicpop.exam.ca03 .modal-content{background:#00a055;}
.clinicpop.exam.ca04 .modal-content{background:#6d60a7;}

.clinicpop.exam .modal-content{padding:15px; width:100%;}
.clinicpop.exam .modal-backdrop.in{opacity:0.7}
.clinicpop.exam .modal-header .info{}
.clinicpop.exam .modal-header .face{float:left; padding-right:10px;}
.clinicpop.exam .modal-header .face .fa-user-circle{font-size:2.7em;}
.clinicpop.exam .modal-header .modal-title{float:left; text-align:left;}
.clinicpop.exam .modal-header .modal-title .name{color:#e4004d;}
.clinicpop.exam .modal .close{opacity:1}
.clinicpop.exam .modal .close .fa-times{color:#fff !important; font-size:2.5em !important;}
.clinicpop.exam .modal .clinc_sec .box div{font-size:1.8em; color:#fff; font-weight:bold; line-height:1.8em;}
.clinicpop.exam .modal .clinc_sec .box p img{width:80px; height:auto;}


</style>




<!-- 2차 카테고리 Modal팝업(물리치료사) -->


<div class="clinicpop ca01" name = "frm_add">
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">물리치료사</h4>
              </div>
              <div class="modal-body">
                <!--문제풀기 2차 카테고리 시작-->
                        <div class="clinc_sec">
                            <div class="box">
                                <h2>물리치료사</h2>
                                <ul class="list cf">
								<?php
									$sql_ca01 = "SELECT bo_category_list FROM g5_board WHERE bo_table='clinic01'";
									$row = sql_fetch($sql_ca01);									
									$category = explode('|',$row['bo_category_list']);
									for($i=0; $i<count($category); $i++){
								?>
								<li><a href="javascript:void(0)" onclick="submitForm('<?=$category[$i]?>');"><?=$category[$i]?></a></li>
								<?
									}
								?>

                                </ul>
                            </div><!--box-->
                        </div><!--clinc_sec-->
               <!--문제풀기 2차 카테고리 마지막-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
              </div>
            </div>
          </div>
    </div><!--modal fade-->
</div>
<!--clinicpop-->
<!-- 2차 카테고리 Modal팝업(물리치료사) -->


<!-- 2차 카테고리 Modal팝업(방사선사) -->
<div class="clinicpop ca02">
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">방사선사</h4>
              </div>
              <div class="modal-body">
                        <div class="clinc_sec">
                            <div class="box">
                                <h2>방사선사</h2>
                                <ul class="list cf">
                                  	<?php
									$sql_ca02 = "SELECT bo_category_list FROM g5_board WHERE bo_table='clinic02'";
									$row = sql_fetch($sql_ca02);									
									$category = explode('|',$row['bo_category_list']);
									for($i=0; $i<count($category); $i++){
								?>
								<li><a href="javascript:void(0)" onclick="submitForm('<?=$category[$i]?>');"><?=$category[$i]?></a></li>
								<?
									}
								?>
                                </ul>
                            </div>
                        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
              </div>
            </div>
          </div>
    </div>
</div>
<!-- 2차 카테고리 Modal팝업(방사선사) -->




<!-- 2차 카테고리 Modal팝업(임상병리사) -->
<div class="clinicpop ca03">
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">임상병리사</h4>
              </div>
              <div class="modal-body">
                        <div class="clinc_sec">
                            <div class="box">
                                <h2>임상병리사</h2>
                                <ul class="list cf">
                                    	<?php
									$sql_ca03 = "SELECT bo_category_list FROM g5_board WHERE bo_table='clinic03'";
									$row = sql_fetch($sql_ca03);									
									$category = explode('|',$row['bo_category_list']);
									for($i=0; $i<count($category); $i++){
								?>
								<li><a href="javascript:void(0)" onclick="submitForm('<?=$category[$i]?>');"><?=$category[$i]?></a></li>
								<?
									}
								?>
                                </ul>
                            </div>
                        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
              </div>
            </div>
          </div>
    </div>
</div>
<!-- 2차 카테고리 Modal팝업(임상병리사) -->




<!-- 2차 카테고리 Modal팝업(건강운동관리사) -->
<div class="clinicpop ca04">
    <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">건강운동관리사</h4>
              </div>
              <div class="modal-body">
                        <div class="clinc_sec">
                            <div class="box">
                                <h2>건강운동관리사</h2>
                                <ul class="list cf">
                               	<?php
									$sql_ca04 = "SELECT bo_category_list FROM g5_board WHERE bo_table='clinic04'";
									$row = sql_fetch($sql_ca04);									
									$category = explode('|',$row['bo_category_list']);
									for($i=0; $i<count($category); $i++){
								?>
								<li><a href="javascript:void(0)" onclick="submitForm('<?=$category[$i]?>');"><?=$category[$i]?></a></li>
								<?
									}
								?>
                                </ul>
                            </div>
                        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
              </div>
            </div>
          </div>
    </div>
</div>
<!-- 2차 카테고리 Modal팝업(건강운동관리사) -->




<!-- 하단아이콘클릭시 Modal팝업(개인정보) -->
<div class="clinicpop edit">
    <div class="modal fade" id="infomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                <div class="info cf"><span class="face"><i class="fas fa-user-circle"></i></span><h4 class="modal-title" id="myModalLabel"><span class="name">
				<?

				$id = get_session('ss_mb_id', $tmp_mb_id);

				$name_load = "select mb_name from g5_member where mb_id = '{$id}'";
				$row_id = sql_fetch($name_load);									
				echo $row_id['mb_name'];

				?>
				</span>님<br />반갑습니다.</h4></div>
              </div>
              <div class="modal-body">
                        <div class="clinc_sec">
                            <div class="box">
                                <h2>개인정보수정화면</h2>
                                <ul class="list cf">
                                    <li><a href="<?= G5_BBS_URL ?>/register_form.php?w=u">개인정보 수정</a></li>
                                    <li><a href="http://www.meduplus.com">홈페이지 바로가기</a></li>
                                    <li><a href="https://www.youtube.com/channel/UCaQnExM9DrWAmWPtnkyYBLQ">샘플강의 보러가기</a></li>
                                    <li><a href="#">친구에게 공유하기</a></li>
                                    <li><a href="https://pf.kakao.com/_GpAdu/">실시간 카톡상담</a></li>
                                    <li><a href="tel:070-7700-4454">고객센터</a></li>
									<li><a href="<?= G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                                </ul>
                            </div>

                       </div>
              </div>
            </div>
          </div>
    </div>
</div>
<!-- 하단아이콘클릭시 Modal팝업(개인정보) -->




<!--문제풀기 1차 카테고리 시작-->
<div class="clinc_wrap">
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="clinic bg1">
                	<div class="in">
                        <h2><span class="arr swiper-button-prev"><i class="fas fa-arrow-circle-left"></i></span> 물리치료사 <span class="arr swiper-button-next"><i class="fas fa-arrow-circle-right"></i></span></h2>
                        <div class="img animated infinite pulse" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-iteration-count:200;"><img src="../img/cate01.png"></div>
                        <a href="#" class="play btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1"><p onclick = "flg_cate(1)"class="animated infinite pulse" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-iteration-count:200;">Let's Play!</p></a>   
                    </div> <!--in-->       
                </div><!--clinic bg-->
            </div>
            <div class="swiper-slide">
                <div class="clinic bg2">
                	<div class="in">
                        <h2><span class="arr swiper-button-prev"><i class="fas fa-arrow-circle-left"></i></span> 방사선사 <span class="arr swiper-button-next"><i class="fas fa-arrow-circle-right"></i></span></h2>
                        <div class="img animated infinite pulse" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-iteration-count:200;"><img src="../img/cate02.png"></div>
                       <a href="#" class="play btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2"><p onclick = "flg_cate(2)" class="animated infinite pulse" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-iteration-count:200;">Let's Play!</p></a>
                    </div> <!--in-->     
                </div>
            </div>
            <div class="swiper-slide">
                <div class="clinic bg3">
                	<div class="in">
                        <h2><span class="arr swiper-button-prev"><i class="fas fa-arrow-circle-left"></i></span> 임상병리사 <span class="arr swiper-button-next"><i class="fas fa-arrow-circle-right"></i></span></h2>
                        <div class="img animated infinite pulse" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-iteration-count:200;"><img src="../img/cate03.png"></div>
                        <a href="#" class="play btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal3"><p onclick = "flg_cate(3)" class="animated infinite pulse" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-iteration-count:200;">Let's Play!</p></a>
                    </div> <!--in-->     
                </div><!--clinic bg-->
            </div>
            <div class="swiper-slide">
                <div class="clinic bg4">
                	<div class="in">
                        <h2><span class="arr swiper-button-prev"><i class="fas fa-arrow-circle-left"></i></span> 건강운동관리사 <span class="arr swiper-button-next"><i class="fas fa-arrow-circle-right"></i></span></h2>
                        <div class="img animated infinite pulse" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-iteration-count:200;"><img src="../img/cate04.png"></div>
                         <a href="#" class="play btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal4"><p onclick = "flg_cate(4)"class="animated infinite pulse" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-iteration-count:200;">Let's Play!</p></a>
                    </div> <!--in-->     
                </div><!--clinic bg-->
            </div>
        </div>
         <!-- Add Pagination --> 
         <div class="swiper-pagination"></div> 
    </div><!--swiper-container-->
	<ul class="bt_icon">
    	<li><a href="http://www.meduplus.com" title="홈버튼"><i class="fas fa-home"></i></a></li>
        <li><a href="https://pf.kakao.com/_GpAdu/" title="실시간상담"><img src="../img/bt_icon02.png" /></a></li>
        <li><a href="https://www.youtube.com/channel/UCaQnExM9DrWAmWPtnkyYBLQ" title="동영상강의" target="_blank"><img src="../img/bt_icon01.png" /></a></li>
        <li><a href="#" title="공유하기"><i class="fas fa-share-alt"></i></a></li>
        <li><a href="#" data-toggle="modal" data-target="#infomodal" title="개인정보"  ><i class="fas fa-user"></i></a></li>
    </ul><!--bt_icon-->
</div><!--clinc_wrap-->
<!--문제풀기 1차 카테고리 마지막-->

<!-- 문제미등록시 팝업-->
<div id = "class_modify" class="clinicpop exam">
    <div class="modal fade" id="nonquiz_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                    <div class="clinc_sec">
                        <div class="box good">
                            <p><img src="../img/exam.png" title="문제를 등록해 주세요"/></p>
                            <div>문제를 등록해 주세요.</div>
                        </div><!--box-->
                    </div><!--clinc_sec-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
              </div>
            </div>
          </div>
    </div>
</div>
<!-- 문제미등록시 팝업-->



<!-- Swiper JS -->
<script src="../js/swiper.min.js"></script>
<head><meta name="viewport" content="initial-scale=1.0, user-scalable=no"></head>
<!-- 문제풀기 1차 카테고리-->
<script>
	
var flag_view = 1;




function flg_cate(val){
		
	flag_view = val;

}



function submitForm(value){

	
	 $.ajax({
        url: g5_bbs_url+"/ajax.check_quiz.php",
        type: "POST",
		data: {
            "value": value,
            "flag_view": flag_view
        },
        dataType: "text",
        success: function(data) {
		if(data == 1){
	document.write('<form action ="http://meduplus.dreamforone.co.kr/bbs/quiz.php" id="frm" method="post"><input type="hidden" name ="category" value = "'+value+'"><input type="hidden" name ="index" value = "'+flag_view+'"></form>');
	document.getElementById("frm").submit();
	}
	else{	
		switch(flag_view){
		case 1: {$("#class_modify").addClass("ca01"); break;}
		case 2: {$("#class_modify").addClass("ca02"); break;}
		case 3: {$("#class_modify").addClass("ca03"); break;}
		case 4: {$("#class_modify").addClass("ca04"); break;}
		}

		$("#nonquiz_modal").modal('show');
		}

    }
    });

}


	var swiper = new Swiper('.swiper-container', {
	  slidesPerView: 1, //보여지는 갯수
	  spaceBetween: 0, //사이의 간격
	  loop: true, 
	  pagination: {
		el: '.swiper-pagination',
		clickable: true,
	  },
      navigation: { 
         nextEl: '.swiper-button-next', 
         prevEl: '.swiper-button-prev', 
      }, 
	});
</script>
