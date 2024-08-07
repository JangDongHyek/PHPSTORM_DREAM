<?php

include_once('./_common.php');
//$g5['title'] = "퀴즈화면";
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
//echo $_POST['category'];
//echo $_POST['index'];
?>

<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="../css/swiper.min.css">


<style>
/*퀴즈화면*/
#container_title{display:none;}

.quiz_wrap{width:100%; height:100%;}
.quiz{width:100%; height:100%;text-align:center; position:relative; overflow-y:scroll;}
.quiz .title{text-align:center; font-size:3em; padding:5% 0; color:#fff; font-weight:bold; text-shadow:1px 1px 1px rgba(0,0,0,0.3);}
.quiz .title span{padding-right:8px;}
.quiz .start{margin:8%; font-weight:bold; color:#fff; font-size:2em;}

.quiz .start .ques{ background:#333; padding:10px 0; border-radius:30px; width:165px; margin:0 auto; }
.quiz .start .con{padding:30px 0; letter-spacing:-0.8px; font-size:0.88em;}
.quiz .start .ox{width:100%; padding:15px;}
.quiz .start .ox p{float:left; width:calc(50% - 20px); background:#FFF; box-shadow:1px 1px 3px rgba(0,0,0,0.4); padding:15px; margin:10px; border-radius:10px;}
.quiz .start .ox p a{display:block; }
.quiz .start .ox p img{width:100%; height:auto;}
.quiz .ad_img{}
.quiz .ad_img p{ display:inline-block; margin:5px;} 
.quiz .ad_img.a2 p{width:calc(50% - 14px);}
.quiz .ad_img.a1 p{width:calc(60% - 14px);}
.quiz .ad_img img{width:100%; border:2px solid #FFF;}
.quiz.ca01{ background:#c3d600;}
.quiz.ca02{ background:#00b0ec;}
.quiz.ca03{ background:#00a055;}
.quiz.ca04{ background:#6d60a7;}
.clinicpop.ca01 .modal .modal-header{ background:#c3d600;}
.clinicpop.ca02 .modal .modal-header{ background:#00b0ec;}
.clinicpop.ca03 .modal .modal-header{ background:#00a055;}
.clinicpop.ca04 .modal .modal-header{ background:#6d60a7;}


/*정답모달팝업*/
.result .btn-primary{border:none; border-radius:0 !important;}/*play버튼*/
.result .modal-header{color:#fff; font-size:2.2em; font-weight:800; padding:5px; text-align:center; border-radius:5px 5px 0 0}
.result .modal-body{padding:12px 12px 0 12px; text-align:center;}
.result .modal-dialog{margin:10%;}
.result .modal-footer{text-align:right; padding:0 0 5px 0; border:none;}
.result .btn-default{border:none; background:none;}
.result .modal .fa-times-circle{font-size:3em; color:#fff;}
.result .modal.in .modal-dialog{ position:absolute;
  top:0;right:0;bottom:0;left:0;
  display:flex;
  align-items:center;
  justify-content:center;

  display:-webkit-flex;
  -webkit-align-item;center;
  -webkit-justify-content:center; /*팝업세로중앙정렬*/}

.result.ca01 .modal-content{background:#c3d600;}
.result.ca02 .modal-content{background:#00b0ec;}
.result.ca03 .modal-content{background:#00a055;}
.result.ca04 .modal-content{background:#6d60a7;}

.result .modal-content{padding:15px; width:100%;}
.result .modal-backdrop.in{opacity:0.7}
.result .modal-header .info{}
.result .modal-header .face{float:left; padding-right:10px;}
.result .modal-header .face .fa-user-circle{font-size:2.7em;}
.result .modal-header .modal-title{float:left; text-align:left;}
.result .modal-header .modal-title .name{color:#e4004d;}
.result .modal .close{opacity:1}
.result .modal .close .fa-times{color:#fff !important; font-size:2.5em !important;}
.result .modal .clinc_sec .box div{font-size:2.3em; color:#fff; font-weight:bold; line-height:1.8em;}
.result .modal .clinc_sec .box p img{width:80px; height:auto;}
</style>
<script>
		var quiz_content = new Array();
		var quiz_answer = new Array();
		var quiz_href = new Array();
		var quiz_id = new Array();
		var quiz_imgcount = new Array();
		
		
</script>
<!--퀴즈화면 물리치료사-->

<?
$load_quiz="select wr_content, wr_1, wr_id from g5_write_clinic0{$_POST['index']} where ca_name = '{$_POST['category']}' order by rand();";
$result_quiz = sql_query($load_quiz);
$count_quiz = sql_num_rows($result_quiz);
$table_name = 'clinic0' . $_POST['index'];

$first_content;
$first_answer;
$first_href = array();
$first_imgcount;



for ($i = 0; $row_quiz = sql_fetch_array($result_quiz); $i++) {
		
	
	echo '<script>
				console.log('.$row_quiz['wr_id'].');
		</script>';

	$uploaded_file = get_file($table_name, $row_quiz['wr_id']);

		if($i == 0){
	
			$first_content = $row_quiz['wr_content'];
			$first_answer = $row_quiz['wr_1'];
			$first_imgcount = $uploaded_file['count'];
		
		}


	echo '<script>
			quiz_imgcount.push('.$uploaded_file['count'].');
		</script>';	

	if($uploaded_file['count'] > 0){


		for($j=0; $j < $uploaded_file['count']; $j++){
			if($i == 0){
				array_push($first_href, $uploaded_file[$j]['path'].'/' . $uploaded_file[$j]['file']);
			}

			echo '<script>
				quiz_href.push("'.$uploaded_file[$j]['path'].'/' . $uploaded_file[$j]['file'].'");
			</script>';	
	}

	}
	else{
		echo "1";
			echo '<script>
				quiz_href.push("");				
			</script>';
	}
		
	
	echo '<script>
			quiz_content.push("'.$row_quiz['wr_content'].'");
			quiz_answer.push('.$row_quiz['wr_1'].');			
	</script>';

	
}
echo '<script>console.log(quiz_content);</script>';
echo '<script>console.log(quiz_answer);</script>';
echo '<script>console.log(quiz_href);</script>';

if($count_quiz <= 0){
?>
	<script> alert("등록된 문제가 없습니다."); window.history.back();</script>
	<?
	exit;
}



?>
		<div class="quiz_wrap">
		<div class="quiz ca0<?=$_POST['index']?>">
		<h2 class="title"><span onclick = "goback()"><i class="fas fa-arrow-circle-left"></i></span><?=$_POST['category']?></h2>
		<div class="start">
		<p class="ques">Question</p>
		<div id = "quiz_title" class="con"><?=$first_content?></div>

		<!--    첨부이미지가 두개일때 -->
		<!--         첨부이미지가 한개일때 -->
		<?


		switch ($first_imgcount) {
			case 1 :
				$imgBox1 = "block";
				$imgBox2 = "none";
				break;
			case 2 :
				$imgBox1 = "none";
				$imgBox2 = "block";
				break;
			default :
				$imgBox1 = "none";
				$imgBox2 = "none";
		}		
		?>
		
        <div class="ad_img a2" id = "img2" style="display:<?=$imgBox2?>">
        	<p><img  id = "img2_1" src="<?=$first_href[0]?>" /></p>
            <p><img  id = "img2_2" src="<?=$first_href[1]?>" /></p>
        </div>
	
		

        <div class="ad_img a1" id = "img1"  style="display:<?=$imgBox1?>">
        	<p><img  id = "img1_1" src="<?=$first_href[0]?>" /></p>
        </div> 
		

		



		<div id ="quiz_answer"class="ox cf">
                <p class="wow bounceIn animated"  onclick="check_ox(<?=$first_answer?>,1)" data-wow-offset="5" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;"><a href="#"><img src="../img/quiz_o.png" title="옳은 답"></a></p>
                <p class="wow bounceIn animated" onclick="check_ox(<?=$first_answer?>,0)" data-wow-offset="5" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: bounceIn;"><a href="#"><img src="../img/quiz_x.png" title="틀린 답"></a></p>
            </div>
        </div>
    </div>
</div>

<!-- <div class="quiz_wrap">
		<div class="quiz ca01">
		<h2 class="title"><span><i class="fas fa-arrow-circle-left"></i></span> 공중보건학</h2>
		<div class="start">
		<p class="ques">Question</p>
		<div id = "quiz_title" class="con">문제입니다.</div>
		<div id ="quiz_answer"class="ox cf">
                <p class="wow bounceIn animated"  data-wow-offset="5" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;"><a href="#"><img src="../img/quiz_o.png" title="옳은 답"></a></p>
                <p class="wow bounceIn animated"  data-wow-offset="5" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: bounceIn;"><a href="#"><img src="../img/quiz_x.png" title="틀린 답"></a></p>
            </div>
        </div>
    </div>
</div>

 -->

<!-- 정답화면팝업 -->
<div class="result ca0<?=$_POST['index']?>">
    <div class="modal fade" id="myModal" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                        <div class="clinc_sec">
                            <div class="box good" id = "quiz_O_pop"  >
                                <p><img src="../img/good.png" title="정답입니다"/></p>
                                <div>정답입니다!</div>
                            </div><!--box-->
<!--오답화면일때 -->
                            <div class="box good" id = "quiz_X_pop" style="display:none">
                                <p><img src="../img/bad.png" title="오답입니다"/></p>
                                <div>오답입니다!</div>
                            </div>
                        </div><!--clinc_sec-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
              </div>
            </div>
          </div>
    </div><!--modal fade-->
</div><!--result-->
<!-- 정답화면팝업 -->







<!-- Swiper JS -->
<!-- <script src="../js/swiper.min.js"></script> -->

<script>
	var hs = jQuery.noConflict();  //바꾸지 않았을시 충돌이 일어나 모달이 동작하지않음.
	var quiz_index = 1;
	var flag_img = quiz_imgcount[0];
	
function goback(){

		window.location.href = "stage.php";
		
	}


	window.onhashchange = function(event){
		var old_url = event.oldURL;
		var new_url = event.newURL + "#";
		if(old_url == new_url){
			window.location.href = "stage.php";
		}
	}






function check_ox(base_value, click_value){

	if(base_value == click_value){
		if(quiz_content[quiz_index]){


		var text = "<p class=\"wow bounceIn animated\" onclick=\"check_ox(" + quiz_answer[quiz_index] + ",1)\" data-wow-offset=\"5\" data-wow-delay=\"0.2s\" style=\"visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;\"><a href=\"#\"><img src=\"../img/quiz_o.png\" title=\"옳은 답\"></a></p>" +  "<p class=\"wow bounceIn animated\" onclick=\"check_ox(" + quiz_answer[quiz_index] + ",0)\" data-wow-offset=\"5\" data-wow-delay=\"0.4s\" style=\"visibility: visible; animation-delay: 0.4s; animation-name: bounceIn;\"><a href=\"#\"><img src=\"../img/quiz_x.png\" title=\"틀린 답\"></a></p>";

		document.getElementById('quiz_title').innerHTML = quiz_content[quiz_index];
		document.getElementById('quiz_answer').innerHTML = text;

		}
	
		if(quiz_imgcount[quiz_index] == 1){
			hs("#img2").css("display","none");
			hs("#img1").css("display","block");
			hs("#img1_1").attr("src",quiz_href[flag_img++]);
		}
		else if(quiz_imgcount[quiz_index] > 1){

			hs("#img1").css("display","none");
			hs("#img2").css("display","block");
			
			hs("#img2_1").attr("src",quiz_href[flag_img++]);
			hs("#img2_2").attr("src",quiz_href[flag_img++]);

			}
		else
			flag_img++;
		

		hs("#quiz_X_pop").css("display","none");
		hs("#quiz_O_pop").css("display","block");
		hs("#myModal").modal('show');
		quiz_index++;
		

		
	}

	else{
		hs("#quiz_X_pop").css("display","block");
		hs("#quiz_O_pop").css("display","none");
		hs("#myModal").modal('show');
	}

}

</script>
