<?php
include_once('./_common.php');
//$g5['title'] = "퀴즈화면";
include_once(G5_BBS_PATH.'/_head.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$table_name = 'clinic0' . $_POST['index'];

$load_quiz = "select wr_content, wr_1, wr_id from g5_write_{$table_name} where ca_name = '{$_POST['category']}' order by rand();";
$result_quiz = sql_query($load_quiz);
$count_quiz = sql_num_rows($result_quiz);


// 퀴즈정보 (질문, 정답, 이미지src, 이미지개수)
$q_question = [];
$q_answer = [];
$q_imgCnt = [];
$q_imgSrc = [];
$q_imgSrc2 = [];

for ($i = 0; $row_quiz = sql_fetch_array($result_quiz); $i++) {
	$uploaded_file = get_file($table_name, $row_quiz['wr_id']);
	$uploaded_file_cnt = $uploaded_file['count'];

	$q_question[$i] = $row_quiz['wr_content'];
	$q_answer[$i] = $row_quiz['wr_1'];
	$q_imgCnt[$i] = $uploaded_file_cnt;
	$q_imgSrc[$i] = "null";
	$q_imgSrc2[$i] = "null";

	// 이미지가 1개이상이면
	if($uploaded_file_cnt > 0){
		for($j = 0; $j < $uploaded_file_cnt; $j++){
			// 이미지 src 생성
			$tmp_img = $uploaded_file[$j]['path'].'/' . $uploaded_file[$j]['file'];
			
			// 1번째, 2번째 이미지 지정
			if ($j == 0) { $q_imgSrc[$i] = $tmp_img; } 
			else { $q_imgSrc2[$i] = $tmp_img; }
		}
	} 
}

// 배열을 문자형태로 변환 (JS 배열에 넣기위해)
$q_question_str = implode("','",  str_replace("\r\n", "<br>", $q_question))."'";
$q_answer_str = implode("','", $q_answer)."'";
$q_imgCnt_str = implode("','", $q_imgCnt)."'";
$q_imgSrc_str = implode("','", $q_imgSrc)."'";
$q_imgSrc2_str = implode("','", $q_imgSrc2)."'";
$q_question_str = "'".$q_question_str;
$q_answer_str = "'".$q_answer_str;
$q_imgCnt_str = "'".$q_imgCnt_str;
$q_imgSrc_str = "'".$q_imgSrc_str;
$q_imgSrc2_str = "'".$q_imgSrc2_str;


if($count_quiz <= 0){
	alert("등록된 문제가 없습니다.", "./stage.php");
	exit;
}

?>

<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="/css/quiz.css">

<!--퀴즈화면 물리치료사-->
<div class="quiz_wrap">

	<div class="quiz ca0<?=$_POST['index']?>">
		<h2 class="title"><span onclick = "goback()"><i class="fas fa-arrow-circle-left"></i></span><?=$_POST['category']?></h2>
		<div class="start">
			<p class="ques">Question</p>
			<div id = "quiz_title" class="con"><?=$q_question[0]?></div>

			<?
			// 첫번째 질문때 이미지가 있으면 
			$imgBox1 = ($q_imgCnt[0] == 1)? "block" : "none";
			$imgBox2 = ($q_imgCnt[0] == 2)? "block" : "none";
			?>
			<!-- 이미지 영역 -->
			<div class="ad_img a2" id="img2" style="display:<?=$imgBox2?>">
				<p><img id="img2_1" src="<? echo ($q_imgSrc[0])? $q_imgSrc[0] : ''; ?>" /></p>
				<p><img id="img2_2" src="<? echo ($q_imgSrc2[0])? $q_imgSrc2[0] : ''; ?>" /></p>
			</div>

			<div class="ad_img a1" id="img1"  style="display:<?=$imgBox1?>">
				<p><img id="img1_1" src="<? echo ($q_imgSrc[0])? $q_imgSrc[0] : ''; ?>" /></p>
			</div> 
			<!-- // 이미지 영역 -->

			
			<div id ="quiz_answer"class="ox cf">
				<p class="wow bounceIn animated btn_result" data-ans="1" data-wow-offset="5" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;">
					<a href="#"><img src="../img/quiz_o.png" title="옳은 답"></a>
				</p>
				<p class="wow bounceIn animated btn_result" data-ans="0" data-wow-offset="5" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: bounceIn;">
					<a href="#"><img src="../img/quiz_x.png" title="틀린 답"></a>
				</p>
			</div>
		</div>
	</div>

</div>

<!-- 정답화면팝업 -->
<div class="result ca0<?=$_POST['index']?>">
	<div class="modal fade" id="myModal" >
		<div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-body">
					<div class="clinc_sec">
						<!--정답화면 -->
						<div class="box good" id="quiz_O_pop">
							<p><img src="../img/good.png" title="정답입니다"/></p>
							<div>정답입니다!</div>
						</div><!--box-->
						<!--오답화면일때 -->
						<div class="box good" id="quiz_X_pop" style="display:none">
							<p><img src="../img/bad.png" title="오답입니다"/></p>
							<div>오답입니다!</div>
						</div>
					</div><!--clinc_sec-->
              </div>
			  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="btnClose"><i class="fas fa-times-circle"></i></button>
				</div>
            </div>
          </div>
    </div><!--modal fade-->
</div><!--result-->
<!-- 정답화면팝업 -->


<script>
var quiz_content = new Array(<?=$q_question_str?>),			// 질문
	quiz_answer = new Array(<?=$q_answer_str?>),			// 정답
	quiz_href = new Array(<?=$q_imgSrc_str?>),				// 이미지 src (1)
	quiz_href2 = new Array(<?=$q_imgSrc2_str?>),			// 이미지 src (2)
	quiz_imgcount = new Array(<?=$q_imgCnt_str?>);			// 이미지개수

var quiz_idx = 0,
	resultFlag = false;										// 정답,오답여부

// 정답, 오답체크
$("p.btn_result").on("click", function() {
	$("#myModal").modal('show');
	if($("#myModal").css("display")=="none"){
		$("#myModal").css("display","block")
	}

	var chkAnswer = parseInt($(this).data("ans")),
		result = parseInt(quiz_answer[quiz_idx]);

	resultFlag = false;

	if (chkAnswer == result) {		// 정답
		$("#quiz_O_pop").show();
		$("#quiz_X_pop").hide();
		resultFlag = true;
		console.log(1);

	} else {						// 오답
		$("#quiz_O_pop").hide();
		$("#quiz_X_pop").show();
		console.log(0);
	}
	
	
});

// 팝업닫기
$("#btnClose").on("click", function(e) {
	var lastCnt = quiz_content.length - 1;
	
	// 마지막문제 체크
	if (quiz_idx == lastCnt && resultFlag) {
		if (confirm("마지막 문제입니다. 처음으로 돌아가시겠습니까?")) {
			goback();
		} 
		return false;
	}

	// 정답 체크 했으면
	if (resultFlag) {
		quiz_idx++;

		var next_content = quiz_content[quiz_idx],
			next_answer = quiz_answer[quiz_idx],
			next_src = quiz_href[quiz_idx],
			next_src2 = quiz_href2[quiz_idx],
			next_imgCnt = quiz_imgcount[quiz_idx];

		$("#img1").hide();
		$("#img2").hide();
		$("#quiz_title").html(next_content);

		switch (parseInt(next_imgCnt)) {
			case 1 :
				//console.log("이미지 1개");
				$("#img1_1").prop("src", next_src);
				$("#img1").show();
				break;

			case 2 :
				//console.log("이미지 2개");
				$("#img2_1").prop("src", next_src);
				$("#img2_2").prop("src", next_src2);
				$("#img2").show();
				break;
		}
	}

});

function goback(){
	window.location.href = "./stage.php";		
}


/*
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

		if(base_value == click_value) {
			if(quiz_content[quiz_index]) {

				var text = "<p class=\"wow bounceIn animated\" onclick=\"check_ox(" + quiz_answer[quiz_index] + ",1)\" data-wow-offset=\"5\" data-wow-delay=\"0.2s\" style=\"visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;\"><a href=\"#\"><img src=\"../img/quiz_o.png\" title=\"옳은 답\"></a></p>" +  "<p class=\"wow bounceIn animated\" onclick=\"check_ox(" + quiz_answer[quiz_index] + ",0)\" data-wow-offset=\"5\" data-wow-delay=\"0.4s\" style=\"visibility: visible; animation-delay: 0.4s; animation-name: bounceIn;\"><a href=\"#\"><img src=\"../img/quiz_x.png\" title=\"틀린 답\"></a></p>";

				document.getElementById('quiz_title').innerHTML = quiz_content[quiz_index];
				document.getElementById('quiz_answer').innerHTML = text;
			}
		
			if(quiz_imgcount[quiz_index] == 1){
				hs("#img2").css("display","none");
				hs("#img1").css("display","block");
				hs("#img1_1").attr("src",quiz_href[flag_img++]);

			} else if(quiz_imgcount[quiz_index] > 1){
				hs("#img1").css("display","none");
				hs("#img2").css("display","block");
				
				hs("#img2_1").attr("src",quiz_href[flag_img++]);
				hs("#img2_2").attr("src",quiz_href[flag_img++]);

			} else {
				flag_img++;
			}

			hs("#quiz_X_pop").css("display","none");
			hs("#quiz_O_pop").css("display","block");
			hs("#myModal").modal('show');
			quiz_index++;

		} else {
			hs("#quiz_X_pop").css("display","block");
			hs("#quiz_O_pop").css("display","none");
			hs("#myModal").modal('show');
		}

	}

*/ 
</script>
