<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
$wr_7=explode("-",$write[wr_7]);

$ca_name=$write[wr_6];
if($ca_name==""){
	$ca_name="경차/소형차량";
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" />
<script type="text/javascript" src="<?php echo G5_THEME_JS_URL ?>/ko.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<script>
	
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년',
        minDate: 0
    });

    $(function() {
        $("#wr_2,#wr_4").datepicker();
		//렌트분류
		$("#ca_name").change(function(){
			$("#ca_id_txt").html(this.value);
		});
		//픽업장소
		$("#wr_1").change(function(){
			$("#wr_1_txt").html(this.value);
		});
		//대여일시
		$("#wr_2").change(function(){
			if($("#wr_3").val()!=""){
				$("#wr_2_txt").html($(this).val()+" "+$("#wr_3").val()+":00");
			}
		});
		$("#wr_3").change(function(){
			if($("#wr_2").val().length<1){
				alert("대여날짜를 먼저 선택하십시오");
				$("#wr_3 option:eq(0)").prop("selected",true);
				return;
			}
			
			$("#wr_2_txt").html($("#wr_2").val()+" "+this.value+":00");
		});
		//반납일시
		$("#wr_4").change(function(){
			if($("#wr_5").val()!=""){
				$("#wr_4_txt").html($(this).val()+" "+$("#wr_5").val()+":00");
			}
		});
		$("#wr_5").change(function(){
			if($("#wr_4").val().length<1){
				alert("반납날짜를 먼저 선택하십시오");
				$("#wr_5 option:eq(0)").prop("selected",true);
				return;
			}
			const startDate=new Date($("#wr_2_txt").html());
			const lastDate=new Date($("#wr_4").val()+" "+this.value+":00");
			if(lastDate <= startDate){
				alert("반납일시가 대여일시보다 빠르거나\n동일한 시간대에 설정하실 수 없습니다.\n다시 설정을 하여 주십시오");
				$("#wr_5 option:eq(0)").prop("selected",true);
				return;
			}

			$("#wr_4_txt").html($("#wr_4").val()+" "+this.value+":00");
		});
		//차종 
		$("input[name='wr_6']").click(function(){
			
			$("#wr_6_txt").html(this.value);
			$.ajax({
				url:g5_bbs_url+'/ajax.car_model_select.php',
				data:{ca_name:this.value,cat:$("#ca_name").val()},
				type:"GET",
				dataType:"html",
				success:function(data){
					$("#wr_9").html(data);
				}
			});
		});
		$("input[name='wr_6']").eq(0).click();

		$("#wr_9").change(function(){
			$("#wr_9_txt").html(this.value);
		});
		//자차보험 클릭
		$("#wr_10").click(function(){
			if($(this).prop("checked")){
				$("#wr_10_txt").html("자차보험신청");
			}else{
				$("#wr_10_txt").html("");
			}
		});

    });

</script>
<!--
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">-->
<section id="bo_w" class="resBoard">
	<!-- 우편번호 레이아웃 -->
	<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
		<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
	</div>
	<!-- 우편번호 레이아웃 끝 -->
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
       


        <div class="tbl_frm01 tbl_wrap">
            <h4 data-aos="fade-down">예약하기</h4>
            <div class="totalBox" >
                <div class="res_Box" data-aos="fade-down">
					<?php if ($is_category) { ?>
                    <dl>
                        <dt><label for="car_cate">렌트분류<strong class="sound_only">필수</strong></label></dt>
                        <dd>
                            <select name="ca_name" id="ca_name" required class="required" onchange="catChange(this)">
								<option value="">선택하세요</option>
								<?php echo $category_option ?>
							</select>
                        </dd>
                    </dl>
					<?php }?>
                    <dl>
                        <dt><label for="wr_subject">픽업장소</label></dt>
                        <dd id="wr_1-form">
							<?php
								if($_GET['ca_name']!="단기대여 서비스"){
							?>
                            <select name="wr_1" id="wr_1" required class="required">
                                <option value="">선택하세요</option>
                                <option value="서울"<?php echo $write[wr_1]=="서울"?" selected":"";?>>서울</option>
                                <option value="수도권"<?php echo $write[wr_1]=="수도권"?" selected":"";?>>수도권</option>
                            </select>
							<?php }else{?>
							<input type="text" name="wr_1" id="wr_1" class="form-control" value="<?php echo $write[wr_1]?>" style="width:100%" onfocus="sample2_execDaumPostcode2('wr_1')" readonly>
							<?php }?>
                        </dd>
                    </dl>
					<dl id="wr_12_dl" style="display:<?php echo $_GET['ca_name']=="단기대여 서비스"?"":"none"?>">
                        <dt><label for="wr_subject">반납장소</label></dt>
                        <dd>
							<input type="text" name="wr_12" id="wr_12" class="form-control" value="<?php echo $write[wr_1]?>" style="width:100%" onfocus="sample2_execDaumPostcode2('wr_12')" readonly>
                        </dd>
                    </dl>
                    <dl>
                        <dt>대여일시</dt>
                        <dd>
                            <p class="tit"><label for="wr_2" class="sound_only">날짜확인</label></p>
                            <div class='input-group'>
                                <input type='text' name="wr_2" id="wr_2" class="form-control calendar_ver" value="<?php echo $write[wr_2]?>"  required/>
								<select name="wr_3" id="wr_3" class="st2">
									<option value="">시간선택</option>
									<?php
										for($h=1;$h<=24;$h++){
											$hour=$h<10?"0".$h:$h;
									?>
									<option value="<?=$hour?>"<?php echo $hour==$write[wr_3]?" selected":"";?>><?=$hour?>시</option>
									<?php }?>
								</select> <span class="t_txt">부터</span>

                                <!--<span class="input-group-addon">
                                    <span class="glyphicon-calendar"></span>
                                </span>-->
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>반납일시</dt>
                        <dd>
                            <p class="tit"><label for="wr_4" class="sound_only">날짜확인</label></p>
                            <div class='input-group'>
                                <input type='text' name="wr_4" id="wr_4" class="form-control calendar_ver" value="<?=$write[wr_4]?>"/>
								<select name="wr_5" id="wr_5" class="st2">
									<option value="">시간선택</option>
									<?php
										for($h=1;$h<=24;$h++){
											$hour=$h<10?"0".$h:$h;
									?>
									<option value="<?=$hour?>"<?php echo $hour==$write[wr_5]?" selected":"";?>><?=$hour?>시</option>
									<?php }?>
								</select> <span class="t_txt">까지</span>

<!--                                <span class="input-group-addon">
                                    <span class="glyphicon-calendar"></span>
                                </span>-->
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="wr_6">차종</label></dt>
                        <dd id="car-cat">
							<?php
								//단기대여서비스가 아닌 서비스 차량분류
								if($_GET[ca_name]!="단기대여 서비스"&&$write[wr_name]!="단기대여 서비스"){?>
                            <span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct01" value="경차/소형차량"<?php echo $write[wr_6]=="경차/소형차량"||$w==""?" checked":"";?>>
								<label for="car_ct01">경차/소형차량</label>
                            </span>
                            <span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct02" value="중형차량"<?php echo $write[wr_6]=="중형차량"?" checked":"";?>>
								<label for="car_ct02">중형차량</label>
                            </span>
                            <span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct03" value="준대형/대형차량"<?php echo $write[wr_6]=="준대형/대형차량"?" checked":"";?>>
								<label for="car_ct03">준대형/대형차량</label>
                            </span>
                            <span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct04" value="SUV/승합차량"<?php echo $write[wr_6]=="SUV/승합차량"?" checked":"";?>>
								<label for="car_ct04">SUV/승합차량</label>
                            </span>
                            <span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct05" value="수입차량"<?php echo $write[wr_6]=="수입차량"?" checked":"";?>>
								<label for="car_ct05">수입차량</label>
                            </span>
							<?php 
								//단기대여서비스 차량분류
								}else{?>
							<span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct01" value="경차"<?php echo $write[wr_6]=="경차"||$w==""?" checked":"";?>>
								<label for="car_ct01">경차</label>
                            </span>
							<span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct02" value="준중형">
								<label for="car_ct02">준중형</label>
                            </span>
                            <span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct03" value="중형"<?php echo $write[wr_6]=="중형"?" checked":"";?>>
								<label for="car_ct03">중형</label>
                            </span>
                            <span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct04" value="대형"<?php echo $write[wr_6]=="대형"?" checked":"";?>>
								<label for="car_ct04">대형</label>
                            </span>
                            <span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct05" value="SUV"<?php echo $write[wr_6]=="SUV"?" checked":"";?>>
								<label for="car_ct05">SUV</label>
                            </span>
							<span class="radiBox">
                                <input type="radio" name="wr_6" id="car_ct06" value="승합"<?php echo $write[wr_6]=="승합"?" checked":"";?>>
								<label for="car_ct06">승합</label>
                            </span>
							<?php }?>
                        </dd>
                    </dl>
					<dl id="wr_10-form" style="display:<?php echo $_GET['ca_name']!="단기대여 서비스"&&$write[ca_name]!="단기대여 서비스"?"none":"";?>">
                        <dt><label for="wr_10">자차보험</label></dt>
                        <dd>
							<input type="checkbox" name="wr_10" value="자차보험신청"<?php echo $write[wr_10]=="자차보험신청"?" checked":"";?> id="wr_10"><label for="wr_10">자차보험</label>
                        </dd>
                    </dl>
					<dl>
                        <dt><label for="wr_9">모델명</label></dt>
                        <dd>
                            <select name="wr_9" id="wr_9">
								<option value="">모델명을 선택하세요</option>
							</select>
							<?php
								if($is_admin){
							?>
							<a href="javascript:;" onclick="winModel()" class="btn btn-primary btn-small" style="color:white">차량모델관리</a>
							<?php }else{?>
							
							<?php }?>
							<a href="javascript:;" onclick="calculate()" id="cal-btn" class="btn btn-primary btn-small" style="color:white;display:<?php echo $_GET['ca_name']=="단기대여 서비스"?"":"none";?>">계산하기</a>
                        </dd>
                    </dl>
					<input type="hidden" name="wr_11" id="wr_11" value="<?php echo $write[wr_11]?>">
                </div>
                <div class="res_Box" data-aos="fade-up" >
                    <dl>
                        <dt>예약확인</dt>
                        <dd>
                            <p><span>렌트분류</span><span id="ca_id_txt"><?=$_GET[ca_name]?></span></p>
							<p><span>픽업장소</span><span id="wr_1_txt"><?=$write[wr_1]?></span></p>
							
							<p id="wr_12_label" style="display:<?php echo $_GET['ca_name']=="단기대여 서비스"?"":"none";?>"><span>반납장소</span><span id="wr_12_txt"><?=$write[wr_12]?></span></p>
							<p><span>대여일시</span><span id="wr_2_txt"><?php echo $write[wr_2]?$write[wr_2]." ".$write[wr_3].":00":""?></span></p>
							<p><span>반납일시</span><span id="wr_4_txt"><?php echo $write[wr_4]?$write[wr_4]." ".$write[wr_5].":00":""?></span></p>
							<p><span>차종</span><span id="wr_6_txt"><?php echo $w==""?"경차/소형차량":$write[wr_6]?></span></p>
							<p id="wr_10_txt-view"><span>자차보험</span><span id="wr_10_txt"><?php echo $write[wr_10]?></span></p>
							<p><span>모델</span><span id="wr_9_txt"><?php echo $write[wr_9]?></span></p>
							<p id="wr_11_txt-view"><span>대여가격</span><span id="wr_11_txt"><?php echo $write[wr_11]?></span></p>
							
                        </dd>
                    </dl>
                    <dl>
                        <dt>개인정보 <span>*예약한 정보가 맞으시면 개인정보 입력 후 예약을 진행 해주세요.</span></dt>
                        <dd>
                            <p><label for="wr_name">이름</label><input type="text" name="wr_name" id="wr_name" value="<?php echo $name?>"></p>
                            <p><label for="rent_per_name">전화번호</label>
								<span class="textBox">
									<input type="text" id="wr_7_1" name="wr_7[]" value="<?php echo $wr_7[0]?>" required="" class="frm_input frm_tel required" size="4" maxlength="3">&nbsp;-&nbsp;
	                                <input type="text" id="wr_7_2" name="wr_7[]" value="<?php echo $wr_7[1]?>" required="" class="frm_input frm_tel required" size="4" maxlength="4">&nbsp;-&nbsp;
		                            <input type="text" id="wr_7_3" name="wr_7[]" value="<?php echo $wr_7[2]?>" required="" class="frm_input frm_tel required" size="4" maxlength="4">
								</span>
                            </p>
                            <p><label for="rent_per_name">주소</label><input type="text" name="wr_content" id="wr_content" value="<?=$write[wr_content]?>"  onfocus="sample2_execDaumPostcode()"></p>
							<p><label for="rent_per_name">상세주소</label><input type="text" name="wr_8" id="wr_8" value="<?=$write[wr_8]?>" ></p>
							<?php if($w==""){?>
							<div><input type="checkbox" name="agree" id="agree" value="1" required> <label for="agree">개인정보이용약관 동의하시겠습니까?</label></div>
							<?php }?>

							<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
							<script>
								//분류 선택시
								function catChange(t){
									var strHtml='';
									if(t.value!="단기대여 서비스"){
										
										document.getElementById("cal-btn").style.display="none";
										
										strHtml+='<span class="radiBox">'+
										'<input type="radio" name="wr_6" id="car_ct01" value="경차/소형차량"<?php echo $write[wr_6]=="경차/소형차량"||$w==""?" checked":"";?>>'+
										'<label for="car_ct01">경차/소형차량</label>'+
										'</span>'+
										'<span class="radiBox">'+
										'<input type="radio" name="wr_6" id="car_ct02" value="중형차량">'+
										'<label for="car_ct02">중형차량</label>'+
										'</span>'+
										'<span class="radiBox">'+
											'<input type="radio" name="wr_6" id="car_ct03" value="준대형/대형차량">'+
											'<label for="car_ct03">준대형/대형차량</label>'+
										'</span>'+
										'<span class="radiBox">'+
											'<input type="radio" name="wr_6" id="car_ct04" value="SUV/승합차량">'+
											'<label for="car_ct04">SUV/승합차량</label>'+
										'</span>'+
										'<span class="radiBox">'+
											'<input type="radio" name="wr_6" id="car_ct05" value="수입차량">'+
											'<label for="car_ct05">수입차량</label>'+
										'</span>';
										document.getElementById("wr_10-form").style.display="none";
										document.getElementById("wr_10_txt-view").style.display="none";
										document.getElementById("wr_10_txt").innerHTML="";
										document.getElementById("wr_11").checked=false;
										document.getElementById("wr_11_txt-view").style.display="none";
										document.getElementById("wr_11_txt").innerHTML="";
										document.getElementById("wr_1-form").innerHTML='<select name="wr_1" id="wr_1" required class="required">'+
																						'<option value="">선택하세요</option>'+
																						'<option value="서울"<?php echo $write[wr_1]=="서울"?" selected":"";?>>서울</option>'+
																						'<option value="수도권"<?php echo $write[wr_1]=="수도권"?" selected":"";?>>수도권</option>'+
																						'</select>';
										document.getElementById("wr_12_dl").style.display="none";
										document.getElementById("wr_12").value="";
										document.getElementById("wr_12_label").style.display="none";
										document.getElementById("wr_12_txt").innerHTML="";	
										document.getElementById("wr_1_txt").innerHTML="";
										document.getElementById("wr_9_txt").innerHTML="";
										//픽업장소
										$("#wr_1").change(function(){
											$("#wr_1_txt").html(this.value);
										});

									}else{
										
										document.getElementById("cal-btn").style.display="";
										
										strHtml+='<span class="radiBox">'+
													'<input type="radio" name="wr_6" id="car_ct01" value="경차"<?php echo $write[wr_6]=="경차"||$w==""?" checked":"";?>>'+
													'<label for="car_ct01">경차</label>'+
												'</span>'+
												'<span class="radiBox">'+
													'<input type="radio" name="wr_6" id="car_ct02" value="준중형">'+
													'<label for="car_ct02">준중형</label>'+
												'</span>'+
												'<span class="radiBox">'+
													'<input type="radio" name="wr_6" id="car_ct03" value="중형">'+
													'<label for="car_ct03">중형</label>'+
												'</span>'+
												'<span class="radiBox">'+
													'<input type="radio" name="wr_6" id="car_ct04" value="대형">'+
													'<label for="car_ct04">대형</label>'+
												'</span>'+
												'<span class="radiBox">'+
													'<input type="radio" name="wr_6" id="car_ct05" value="SUV">'+
													'<label for="car_ct05">SUV</label>'+
												'</span>'+
												'<span class="radiBox">'+
													'<input type="radio" name="wr_6" id="car_ct06" value="승합">'+
													'<label for="car_ct06">승합</label>'+
												'</span>';
										document.getElementById("wr_10-form").style.display="";
										document.getElementById("wr_10_txt-view").style.display="";
										document.getElementById("wr_11_txt-view").style.display="";
										document.getElementById("wr_1-form").innerHTML='<input type="text" name="wr_1" id="wr_1" class="form-control" value="<?php echo $write[wr_1]?>" style="width:100%" onfocus="sample2_execDaumPostcode2(\'wr_1\')" readonly>';
										document.getElementById("wr_12_dl").style.display="";
										document.getElementById("wr_12_label").style.display="";
										document.getElementById("wr_9_txt").innerHTML="";

									}
									document.getElementById("car-cat").innerHTML=strHtml;
									$("input[name='wr_6']").click(function(){
			
										$("#wr_6_txt").html(this.value);
										$.ajax({
											url:g5_bbs_url+'/ajax.car_model_select.php',
											data:{ca_name:this.value,cat:$("#ca_name").val()},
											type:"GET",
											dataType:"html",
											success:function(data){
												$("#wr_9").html(data);
											}
										});
									});
									
									$("input[name='wr_6']").eq(0).click();
								}
								//차량관리 모델 팝업창 띄우기
								function winModel(){
									var daeyeo="";
									if(document.getElementById("ca_name").value=="단기대여 서비스"){
										daeyeo="2";
									}
									window.open(`${g5_bbs_url}/car_model${daeyeo}.php`,"","fullscreen,scrollbars=yes");
								}
								// 우편번호 찾기 화면을 넣을 element
								var element_layer = document.getElementById('layer');
								function closeDaumPostcode() {
									// iframe을 넣은 element를 안보이게 한다.
									element_layer.style.display = 'none';
								}

								function sample2_execDaumPostcode() {
									new daum.Postcode({
										oncomplete: function(data) {
											// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

											// 각 주소의 노출 규칙에 따라 주소를 조합한다.
											// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
											var addr = ''; // 주소 변수
											var extraAddr = ''; // 참고항목 변수

											//사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
											if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
												addr = data.roadAddress;
											} else { // 사용자가 지번 주소를 선택했을 경우(J)
												addr = data.jibunAddress;
											}

											// 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
											if(data.userSelectedType === 'R'){
												// 법정동명이 있을 경우 추가한다. (법정리는 제외)
												// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
												if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
													extraAddr += data.bname;
												}
												// 건물명이 있고, 공동주택일 경우 추가한다.
												if(data.buildingName !== '' && data.apartment === 'Y'){
													extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
												}
												// 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
												if(extraAddr !== ''){
													extraAddr = ' (' + extraAddr + ')';
												}
												// 조합된 참고항목을 해당 필드에 넣는다.
//												document.getElementById("wr_content").value = extraAddr;
											
											} else {
//												document.getElementById("wr_content").value = '';
											}

											// 우편번호와 주소 정보를 해당 필드에 넣는다.
											//document.getElementById('sample2_postcode').value = data.zonecode;
											document.getElementById("wr_content").value = addr;
											// 커서를 상세주소 필드로 이동한다.
											document.getElementById("wr_8").focus();

											// iframe을 넣은 element를 안보이게 한다.
											// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
											element_layer.style.display = 'none';
										},
										width : '100%',
										height : '100%',
										maxSuggestItems : 5
									}).embed(element_layer);

									// iframe을 넣은 element를 보이게 한다.
									element_layer.style.display = 'block';

									// iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
									initLayerPosition();
								}
								function sample2_execDaumPostcode2(id) {
									new daum.Postcode({
										oncomplete: function(data) {
											// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

											// 각 주소의 노출 규칙에 따라 주소를 조합한다.
											// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
											var addr = ''; // 주소 변수
											var extraAddr = ''; // 참고항목 변수

											//사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
											if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
												addr = data.roadAddress;
											} else { // 사용자가 지번 주소를 선택했을 경우(J)
												addr = data.jibunAddress;
											}

											// 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
											if(data.userSelectedType === 'R'){
												// 법정동명이 있을 경우 추가한다. (법정리는 제외)
												// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
												if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
													extraAddr += data.bname;
												}
												// 건물명이 있고, 공동주택일 경우 추가한다.
												if(data.buildingName !== '' && data.apartment === 'Y'){
													extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
												}
												// 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
												if(extraAddr !== ''){
													extraAddr = ' (' + extraAddr + ')';
												}
												// 조합된 참고항목을 해당 필드에 넣는다.
//												document.getElementById("wr_content").value = extraAddr;
											
											} else {
//												document.getElementById("wr_content").value = '';
											}

											// 우편번호와 주소 정보를 해당 필드에 넣는다.
											//document.getElementById('sample2_postcode').value = data.zonecode;
											document.getElementById(id).value = addr;
											document.getElementById(id+"_txt").innerHTML = addr;
											// iframe을 넣은 element를 안보이게 한다.
											// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
											element_layer.style.display = 'none';
										},
										width : '100%',
										height : '100%',
										maxSuggestItems : 5
									}).embed(element_layer);

									// iframe을 넣은 element를 보이게 한다.
									element_layer.style.display = 'block';

									// iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
									initLayerPosition();
								}
								// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
								// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
								// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
								function initLayerPosition(){
									var width = 300; //우편번호서비스가 들어갈 element의 width
									var height = 400; //우편번호서비스가 들어갈 element의 height
									var borderWidth = 5; //샘플에서 사용하는 border의 두께

									// 위에서 선언한 값들을 실제 element에 넣는다.
									element_layer.style.width = width + 'px';
									element_layer.style.height = height + 'px';
									element_layer.style.border = borderWidth + 'px solid';
									// 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
									element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
									element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
								}

								//계산하기
								function calculate(){
									const _wr_2=document.getElementById("wr_2").value;
									const _wr_3=document.getElementById("wr_3").value;
									const _wr_4=document.getElementById("wr_4").value;
									const _wr_5=document.getElementById("wr_5").value;
									const _wr_10=document.getElementById("wr_10").checked;
									const _wr_9=document.getElementById("wr_9").value;
									if(_wr_2==""||_wr_3==""||_wr_4==""||_wr_5==""){
										alert("대여일시와 반여일시를 입력되지 않았습니다. 다시 입력 하신 후 계산하십시오.");
										return;
									}
									if(_wr_9==""){
										alert("차량 모델명을 선택하십시오");
										return;
									}

									$.ajax({
										url:g5_bbs_url+'/ajax.car_calculate.php',
										data:{wr_2:_wr_2,wr_3:_wr_3,wr_4:_wr_4,wr_5:_wr_5,wr_9:_wr_9,wr_10:_wr_10},
										type:"GET",
										dataType:"html",
										success:function(data){
											document.getElementById("wr_11").value=data;
											document.getElementById("wr_11_txt").innerHTML=number_format(data);
										}
									});
								}
							</script>
                        </dd>
                    </dl>
					<div class="btn_confirm">
						<input type="submit" value="예약하기" id="btn_submit" accesskey="s" class="btn_submit">
						<a href="<?php echo G5_URL ?>/" class="btn_cancel">취소</a>
					</div>

                </div>
            </div>


        </div>



        <!-- NAVER SCRIPT -->
        <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
        <script type="text/javascript">
            var _nasa = {};
            _nasa["cnv"] = wcs.cnv("5", "1");
        </script>
        <!-- NAVER SCRIPT END-->
    </form>

    <script>
        <?php
        if ($write_min || $write_max) {
            ?>
            // 글자수 제한
            var char_min = parseInt( <?php echo $write_min; ?> ); // 최소
            var char_max = parseInt( <?php echo $write_max; ?> ); // 최대
            check_byte("wr_content", "char_count");

            $(function() {
                $("#wr_content").on("keyup", function() {
                    check_byte("wr_content", "char_count");
                });
            });

            <?php } ?>
        function html_auto_br(obj) {
            if (obj.checked) {
                result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
                if (result)
                    obj.value = "html2";
                else
                    obj.value = "html1";
            } else
                obj.value = "";
        }

        function fwrite_submit(f) {
			const startDate=new Date($("#wr_2_txt").html());
			const lastDate= new Date($("#wr_4_txt").html());
			if(lastDate <= startDate){
				alert("반납일시가 대여일시보다 빠르거나\n동일한 시간대에 설정하실 수 없습니다.\n다시 설정을 하여 주십시오");
				$("#wr_5 option:eq(0)").prop("selected",true);
				return false;
			}
            //document.getElementById("btn_submit").disabled = "disabled";

            return true;
        }
    </script>




    <script type="text/javascript">
        $(function() {
           
        });
    </script>

</section>
<!-- } 게시물 작성/수정 끝 -->