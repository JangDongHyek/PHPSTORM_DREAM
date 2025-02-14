<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

$mb_id = $_SESSION['ss_mb_id'];

?>

<style>
	/*로딩바*/
	#mask {
		position: fixed;
		z-index: 9000;
		background-color: #000000;
		display: none;
		left: 0;
		top: 0;
	}

	#loadingImg {
		position: fixed;
		left: 50%;
		top: 50%;
		display: none;
		z-index: 10000;
		transform: translate(-50%, -50%);
	}

	#loadingImg img {
		width: 50px;
		height: 50px;
	}

	.mbskin {
		padding-bottom: 100px;
	}

	.mbskin .title_top {
		margin-top: 100px;
	}

	.adress_wrap {
		/*		display: flex;*/
	}

	.adress_wrap select {
		box-shadow: none;
		padding: 8px;
		height: 45px;
		border: 1px solid #ececec;
		border-radius: 0;
		margin: 0 0 5px;
	}

</style>



<!-- 메세지 모달팝업 -->
<div id="basic_modal">
	<!-- Modal -->
	<div class="modal fade" id="myModaregister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
					<h4 class="modal-title" id="myModalLabel">프로필작성 안내</h4>
				</div>
				<div class="modal-body msg_con">
					<h3><span class="color">나의 신앙 정보</span>를 입력하세요</h3>
					<p>
						상대방에게 <span class="bold">무료</span>로 공개되는 내용입니다. 빠짐없이 꼼꼼하게 입력해주세요
					<p>
				</div>
				<!--msg_con-->
			</div>
		</div>
	</div>
</div>
<!--basic_modal-->
<!-- 메세지 모달팝업 -->
<div class="mbskin">
	<?php include_once("./my_profile_head.php") ?>

	<h2 class="title_top">
		<span class="point">나의 신앙 정보</span>를 입력하세요
	</h2>
	<div class="regi_info">
		<p>상대방에게 <strong class="point">무료</strong>로 공개되는 내용입니다. 빠짐없이 꼼꼼하게 입력해주세요</p>
		<!--	<p>무료로 열람가능합니다. 마음에 드시는 분은 찜목록으로 이동가능 합니다.</p>-->

		<!--		<span>복수선택 가능</span>-->
	</div>
	<form method="post" action="./ajax.controller.php">
		<input type="hidden" name="page" id="page">
		<input type="hidden" name="mode" value="my_profile02">
		<input type="hidden" name="mb_id" value="<?= $mb_id ?>">
		<input type="hidden" name="idx" value="<?= $mi["idx"] ?>">

		<article class="box-article">
			<div id="join_info01">
				<dl class="sec02">
					<span class="sec02_00">
						<input type="radio" name="mi_chance" id="sec02_01_01" value="1">
						<em></em>
						<label for="sec02_01_01">교회를 다녀본적 없지만 기회가 되면 다닐 생각이 있어요</label>
					</span>
					<span class="sec02_00">
						<input type="radio" name="mi_chance" id="sec02_01_02" value="2">
						<em></em>
						<label for="sec02_01_02">교회를 다녔었는데 지금은 잠깐 쉬고 있어요</label>
					</span>
					<span class="sec02_00">
						<input type="radio" name="mi_chance" id="sec02_01_03" value="3">
						<em></em>
						<label for="sec02_01_03">교회를 다니고 있어요</label>
					</span>
				</dl>
				<dl class="sec02">
					<dt>교회를 다닌 기간</dt>
					<dd>
						<span><input type="radio" name="mi_date" id="sec02_02_01" value="1">
							<label for="sec02_02_01">모태신앙</label></span>
						<span><input type="radio" name="mi_date" id="sec02_02_02" value="2">
							<label for="sec02_02_02">5년 이하</label></span>
						<span><input type="radio" name="mi_date" id="sec02_02_03" value="3">
							<label for="sec02_02_03">5~10년</label></span>
						<span><input type="radio" name="mi_date" id="sec02_02_04" value="4">
							<label for="sec02_02_04">10~15년</label></span>
						<span><input type="radio" name="mi_date" id="sec02_02_05" value="5">
							<label for="sec02_02_05">15~20년</label></span>
						<span><input type="radio" name="mi_date" id="sec02_02_06" value="6">
							<label for="sec02_02_06">25년 이상</label></span>
					</dd>
				</dl>
				<dl class="sec02_02">
					<dt>봉사</dt>
					<dd>
						<select name="mi_angel" id="sec02_03" class="form-control">
							<option value="">선택하세요</option>
							<option value="1">해본적 없지만 기회가 되면 하고싶다.</option>
							<option value="2">한가지를 봉사하고 있다.</option>
							<option value="3">두가지를 봉사하고 있다.</option>
							<option value="4">과거에 했지만 지금 잠깐 쉬고있다.</option>
						</select>
					</dd>
				</dl>
				<dl class="sec02">
					<dt>십일조 여부</dt>
					<dd>
						<span><input type="radio" name="mi_ten" id="sec02_04_01" value="Y">
							<label for="sec02_04_01">하고있다.</label></span>
						<span><input type="radio" name="mi_ten" id="sec02_04_02" value="N">
							<label for="sec02_04_02">하지않는다.</label></span>
					</dd>
				</dl>
				<dl class="sec02">
					<dt>감사헌금 여부</dt>
					<dd>
						<span><input type="radio" name="mi_tk" id="sec02_05_01" value="Y">
							<label for="sec02_05_01">하고있다.</label></span>
						<span><input type="radio" name="mi_tk" id="sec02_05_02" value="N">
							<label for="sec02_05_02">하지않는다.</label></span>
					</dd>
				</dl>
				<dl class="sec02_2">
					<dt>다니는 교회정보 입력
						<span class="sm">
							<input type="radio" name="mi_church_open" id="info_hd" value="0" <?php  if ($mi["mi_church_open"] == '0') echo "checked" ?>>
							<em></em>
							<label for="info_hd">비공개</label>
							<input type="radio" name="mi_church_open" id="info_op" value="1" <?php  if ($mi["mi_church_open"] == '1') echo "checked" ?>><em></em>
							<label for="info_op">공개</label>
						</span>
					</dt>
					<dd>
						<input type="text" name="mi_church1" value="<?=$mi['mi_church1']?>" placeholder="교회이름을 입력해주세요">
						<input type="text" name="mi_church2" value="<?=$mi['mi_church2']?>" placeholder="담임목사님 성함을 입력해주세요">
					</dd>
					<dd class="adress_wrap">
						<div class="part a3">
							<select class="form-control required2" id="si" name="mi_church_place1" onchange="changeCity('si');">
								<option value="">교회위치를 선택하세요</option>
								<option value="서울">서울</option>
								<option value="경기">경기</option>
								<option value="세종">세종</option>
								<option value="인천">인천</option>
								<option value="부산">부산</option>
								<option value="대구">대구</option>
								<option value="대전">대전</option>
								<option value="울산">울산</option>
								<option value="광주">광주</option>
								<option value="충남">충남</option>
								<option value="충북">충북</option>
								<option value="경남">경남</option>
								<option value="경북">경북</option>
								<option value="전남">전남</option>
								<option value="전북">전북</option>
								<option value="강원">강원</option>
								<option value="제주">제주</option>
							</select>
						</div>
						<div class="part a3">
							<select class="form-control" id="cur_gu" name="mi_church_place2" onchange="changeCity('gu');">
								<option value="">선택하세요</option>
							</select>
						</div>
						<div class="part a3">
							<select class="form-control" id="dong" name="mi_church_place3">
								<option value="">선택하세요</option>
							</select>
						</div>
					</dd>
				</dl>
			</div>


			<!--저장 부분-->
			<div class="f_arr cf">
				<div class="arr">
					<!--<span><a href="#"><i class="fal fa-angle-left"></i> 이전</a></span>-->
					<span><a href="#" onclick="save('my_profile04.php');">다음 <i class="fal fa-angle-right"></i></a></span>
					<!--첫단계에서는 "다음"만 나오도록--->
				</div>
				<!--        <div class="save"><a href="#" onclick="save('my_profile02.php');">저 장</a></div>-->
			</div>
		</article>
	</form>
</div>


<!--프로필(인터뷰)-->
<?php /*
<div id="my_profile" class="interview" style="display:none;">
	<!--상단카테고리-->
	<ul class="cate cf">
		<li><a href="javascript:void(0);" onclick="save('my_profile01.php');">기본정보</a></li>
		<li class="active"><a href="javascript:void(0);">인터뷰</a></li>
		<li><a href="javascript:void(0);" onclick="save('my_profile03.php');">취미/관심사</a></li>
	</ul>

	<!--작성 폼 시작-->
	<div class="in">
		<div class="regi_info">
			<p>
				입력하시는 모든 내용은 회원에게 전체공개되는 내용입니다.<br>
				신중하고 정확한 입력부탁드립니다.
			</p>
		</div>
		<form id="fprofile2" name="fprofile2" action="./my_profile02_update.php" method="post" autocomplete="off">
			<input type="hidden" name="mb_id" value="<?=$mb_id?>">
<input type="hidden" id="page" name="page" value="">

<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>교회에서의 봉사활동<strong class="comm"></strong></label>
	<select class="form-control" id="interview1_text1" name="interview1_text1">
		<option value="">선택하세요</option>
		<option value="경험은 없지만 해볼 생각이 있습니다.">경험은 없지만 해볼 생각이 있습니다.</option>
		<option value="지금은 하지 않지만 다시 해볼 생각이 있습니다.">지금은 하지 않지만 다시 해볼 생각이 있습니다.</option>
		<option value="일주일에 한번 다닙니다.">일주일에 한번 다닙니다.</option>
		<option value="봉사활동 한 가지를 하고 있습니다.">봉사활동 한 가지를 하고 있습니다.</option>
		<option value="봉사활동 두 가지를 하고 있습니다.">봉사활동 두 가지를 하고 있습니다.</option>
	</select>
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>연인과 함께 가고 싶은 장소는?<strong class="comm hide">(예:활기찬 분위기의 마로니에 공원)</strong></label>
	<select class="form-control" id="interview2_text1" name="interview2_text1" onchange="change_select(this);">
		<option value="">선택하세요</option>
		<option value="편한 트레이닝복으로 가벼운 산책">편한 트레이닝복으로 가벼운 산책</option>
		<option value="탁 트이고 시원한 바닷가">탁 트이고 시원한 바닷가</option>
		<option value="도시와 조금 멀어진 드라이브">도시와 조금 멀어진 드라이브</option>
		<option value="연인이 좋아하는 레포츠">연인이 좋아하는 레포츠</option>
		<option value="직접기재">직접기재</option>
		<!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
	</select>
	<input type="text" class="form-control required2 direct2 <?=$hide_class2?>" id="interview2_text2" name="interview2_text2" value="<?=$mi['interview2_text2']?>">
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>당신의 삶에 있어서 가장 기억에 남는 순간은?<strong class="comm hide">(예:희망했던 회사에 입사했을 때)</strong></label>
	<select class="form-control" id="interview3_text1" name="interview3_text1" onchange="change_select(this);">
		<option value="">선택하세요</option>
		<option value="모든게 즐거웠던 중고생 시절">모든게 즐거웠던 중고생 시절</option>
		<option value="원하는 대학에 갔을 때">원하는 대학에 갔을 때</option>
		<option value="희망하는 직장에 갔을 때">희망하는 직장에 갔을 때</option>
		<option value="매순간이 소중하고 즐거웠다">매순간이 소중하고 즐거웠다</option>
		<option value="직접기재">직접기재</option>
		<!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
	</select>
	<input type="text" class="form-control required2 direct3 <?=$hide_class3?>" id="interview3_text2" name="interview3_text2" value="<?=$mi['interview3_text2']?>">
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>당신의 매력포인트나 장점은?<strong class="comm hide">(예:큰 키와 잘생긴 얼굴/상대방을 배려하는 마음과 따뜻한 매너)</strong></label>
	<select class="form-control" id="interview4_text1" name="interview4_text1" onchange="change_select(this);">
		<option value="">선택하세요</option>
		<option value="활발하고 명랑한 성격">활발하고 명랑한 성격</option>
		<option value="훤칠하고 뽀대나는 아우라">훤칠하고 뽀대나는 아우라</option>
		<option value="늘 긍정적이고 적극적인 마인드">늘 긍정적이고 적극적인 마인드</option>
		<option value="분위기 잘 맞추고 눈치껏 발휘하는 센스">분위기 잘 맞추고 눈치껏 발휘하는 센스</option>
		<option value="유머러스한 리더쉽">유머러스한 리더쉽</option>
		<option value="직접기재">직접기재</option>
		<!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
	</select>
	<input type="text" class="form-control required2 direct4 <?=$hide_class4?>" id="interview4_text2" name="interview4_text2" value="<?=$mi['interview4_text2']?>">
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>연인이 생긴다면 함께 나누고 싶은 음식은?<strong class="comm hide">(예:분위기 좋은 레스토랑에서 먹는 쉐프의 추천요리)</strong></label>
	<select class="form-control" id="interview5_text1" name="interview5_text1" onchange="change_select(this);">
		<option value="">선택하세요</option>
		<option value="마음편하게 부담없이 한식찌개">마음편하게 부담없이 한식찌개</option>
		<option value="분위기 있는 이태리 카페">분위기 있는 이태리 카페</option>
		<option value="고즈넉하게 즐기는 브런치">고즈넉하게 즐기는 브런치</option>
		<option value="서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살">서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살</option>
		<option value="요리실력도 뽐낼겸 셀프요리 피크닉">요리실력도 뽐낼겸 셀프요리 피크닉</option>
		<option value="직접기재">직접기재</option>
		<!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
	</select>
	<input type="text" class="form-control required2 direct5 <?=$hide_class5?>" id="interview5_text2" name="interview5_text2" value="<?=$mi['interview5_text2']?>">
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>당신의 기도제목이 있다면?<strong class="comm">(예:걱정 없이 한 달간 세계여행을 떠나고 싶어요)</strong></label>
	<input type="text" class="form-control required2" id="interview6_text1" name="interview6_text1" value="<?=$mi['interview6_text1']?>">
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>연인이 생기면 함께 해보고 싶은 것?<strong class="comm">(예:함께 공원 산책을 하며 대화를 나누고 싶어요)</strong></label>
	<input type="text" class="form-control required2" id="interview7_text1" name="interview7_text1" value="<?=$mi['interview7_text1']?>">
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>당신이 공부했던/하고있는 학교와 전공은?<strong class="comm">(예:한국고등학교/서울대 경영학과)</strong><strong class="comm">(상대방에게 공개되지 않습니다)</strong></label>
	<input type="text" class="form-control required2" id="interview8_text1" name="interview8_text1" value="<?=$mi['interview8_text1']?>">
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>당신이 일하고 있는/일했던 일터와 업무분야는?<strong class="comm">(예:부산시청 공무원/스타벅스 우동점 점장)</strong></label>
	<input type="text" class="form-control required2" id="interview9_text1" name="interview9_text1" value="<?=$mi['interview9_text1']?>">
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>하나님께 받은 비전, 혹은 마음에 품고 기도하는 비전은?<strong class="comm">(예:진리와 복음을 전하는 교사가 되길 희망합니다)</strong></label>
	<textarea class="form-control txt required2" rows="4" id="interview10_text1" name="interview10_text1"><?=$mi['interview10_text1']?></textarea>
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>마음속에 품고 있는 말씀과 찬양을 소개한다면?</label>
	<div class="pt">
		<strong>좋아하는 말씀</strong>
		<input type="text" class="form-control required2" id="interview11_text1" name="interview11_text1" value="<?=$mi['interview11_text1']?>" placeholder="좋아하는 말씀">
		<textarea class="form-control txt required2" rows="4" id="interview11_text2" name="interview11_text2" placeholder="이 말씀을 품게 된 계기나 에피소드"><?=$mi['interview11_text2']?></textarea>
	</div>
	<div class="pt">
		<strong>좋아하는 찬양</strong>
		<input type="text" class="form-control required2" id="interview12_text1" name="interview12_text1" value="<?=$mi['interview12_text1']?>" placeholder="좋아하는 찬양">
		<textarea class="form-control txt required2" rows="4" id="interview12_text2" name="interview12_text2" placeholder="이 찬양을 품게 된 계기나 에피소드"><?=$mi['interview12_text2']?></textarea>
	</div>
</div>
<!--form-group-->
<div class="form-group">
	<label for="test01"><span class="ess_icon hide">*</span>앞으로의 계획은?</label>
	<div class="pt">
		<strong>신앙적</strong>
		<textarea class="form-control txt required2" rows="4" id="interview13_text1" name="interview13_text1" placeholder=""><?=$mi['interview13_text1']?></textarea>
	</div>
	<div class="pt">
		<strong>사회적</strong>
		<textarea class="form-control txt required2" rows="4" id="interview14_text1" name="interview14_text1" placeholder=""><?=$mi['interview14_text1']?></textarea>
	</div>
</div>
<!--form-group-->

</form>
</div>
<!--in-->

<!--저장 부분-->
<div class="f_arr cf">
	<div class="arr">
		<span><a href="#" onclick="save('my_profile01.php');"><i class="fal fa-angle-left"></i> 이전</a></span>
		<span><a href="#" onclick="save('my_profile03.php');">다음 <i class="fal fa-angle-right"></i></a></span>
		<!--두번째 단계부터는 "이전" "다음" 모두 나오도록--->
	</div>
	<div class="save"><a href="#" onclick="save('my_profile03.php');">저 장</a></div>
</div>
<!--f_arr-->

</div>
<!--my_profile-->
<!--프로필(인터뷰)-->
*/?>

<script>
	$('#myModaregister').modal('show');	
	// 시/도 변경 -> 구/군 호출, 구/군 변경 -> 동/면 호출
	function changeCity(type, first_yn) {
		$('.sel_gu').show();
		var si = $("#si").val();
		var gu = $("#cur_gu").val();

		var place = "";
		if ("<?=$mi["idx"]?>" != "" && type == "si" && first_yn == "Y") {
			si = '<?=$mi["mi_church_place1"]?>';
			place = '<?=$mi["mi_church_place2"]?>'
		} else if ("<?=$mi["idx"]?>" != "" && type == "gu" && first_yn == "Y") {
			gu = '<?=$mi["mi_church_place2"]?>';
			place = '<?=$mi["mi_church_place3"]?>';
		}

		if (!si) {
			$('.sel_gu').hide();
			return false;
		}

		if (type == 'si') {
			$("#cur_gu").find("option").remove();
		}

		$.ajax({
			type: "GET",
			url: "<?php echo G5_PLUGIN_URL?>/address/address.php",
			dataType: "json",
			data: {
				"si": si,
				"gu": gu
			},
			success: function(datas) {
				var opt_select = "",
					opt = "";
				// var cur_gu = $("#cur_gu").val();


				opt += "<option value=''>지역상세</option>";
				for (var i = 0; i < datas.length; i++) {
					console.log(datas[i]);
					opt_select = (place == datas[i]) ? "selected" : "";
					opt += "<option value='" + datas[i] + "' " + opt_select + ">" + datas[i] + "</option>";
				}

				if (type == "si") {
					$("#cur_gu").html(opt);
				} else {
                    $("#dong").html(opt);

                    if (datas.length > 0 ) {
                        $("#dong").css("display","block");
                    }else{
                        $("#dong").css("display","none");
                    }

				}
			},
			error: function(request, status, error) {
				console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
			},
			complete: function() {}
		});
	}
	$(document).ready(function() {

		// history.replaceState(null, null, g5_bbs_url+'/mypage.php'); // 뒤로가기 이벤트 때문에 history 추가
		$("input:radio[name='mi_chance']:radio[value='<?=$mi['mi_chance']?>']").prop("checked", true);
		$("input:radio[name='mi_date']:radio[value='<?=$mi['mi_date']?>']").prop("checked", true);
		$("[name='mi_angel']").val("<?=$mi['mi_angel']?>");
		$("[name='mi_church_place1']").val("<?=$mi['mi_church_place1']?>");
		$("input:radio[name='mi_ten']:radio[value='<?=$mi['mi_ten']?>']").prop("checked", true);
		$("input:radio[name='mi_tk']:radio[value='<?=$mi['mi_tk']?>']").prop("checked", true);
		$("input:radio[name='mi_chance']:radio[value='<?=$mi['mi_chance']?>']").prop("checked", true);


		changeCity("si", "Y");
		changeCity("gu", "Y");
	});

	// 저장

	var is_post = false;

	function save(page) {
		if (is_post) {
			return false;
		}
		is_post = true;

		$('#page').val(page);


		if ($('input[name="mi_chance"]:checked').length == 0) {
			swal('교회에 다니고 있는지 체크해주세요.');
			is_post = false;
			return false;
		}
		if ($('input[name="mi_date"]:checked').length == 0) {
			swal('교회에 다닌 기간을 체크해주세요.');
			is_post = false;
			return false;
		}
		if ($('[name = mi_angel]').val() == "") {
			swal('봉사 질문에 대한 응답을 선택해주세요.');
			is_post = false;
			return false;
		}

		if ($('input[name = "mi_ten"]:checked').length == 0) {
			swal('십일조 여부를 선택해주세요');
			is_post = false;
			return false;
		}
		if ($('input[name = "mi_tk"]:checked').length == 0) {
			swal('감사헌금 여부를 선택해주세요');
			is_post = false;
			return false;
		}
        if ($('input[name="mi_chance"]:checked').val() == 1) {
            
            /* 23.05.02 교회이름 필수아님
            if ($('[name = mi_church1]').val() == "") {
                swal('교회이름을 입력해주세요.');
                is_post = false;
                return false;
            }
             */
            if ($('[name = mi_church2]').val() == "") {
                swal('담임목사님 성함을 입력해주세요');
                is_post = false;
                return false;
            }



            if ($('[name = mi_church_place1]').val() == "") {
                swal('교회위치를 선택하세요');
                is_post = false;
                return false;
            }

            if ($('[name = mi_church_place2]').val() == "") {
                swal('구를 선택하세요');
                is_post = false;
                return false;
            }
        }


		// if($('[name = mi_church_place3]').val() == "") {
		//     swal('동을 선택해주세요');
		//     is_post = false;
		//     return false;
		// }
		//var formData = $('form')[0];
		//$.ajax({
		//    url : g5_bbs_url + "/ajax.controller.php",
		//    data: formData,
		//    type: 'POST',
		//    success : function(data) {
		//        if(data == "Y") {
		//            location.replace(g5_bbs_url + "/" + page + "?mb_id=<?//=$mb_id?>//");
		//        }else{
		//            swal("저장에 실패했습니다. 다시 시도해주세요").then(function(){
		//                location.href = location.href;
		//            })
		//        }
		//    }
		//});

		$('form')[0].submit();

		// $('#fprofile2').submit();
	}

	// 선택박스 옵션 변경 -- 직접입력 선택 시 텍스트 폼 띄움
	function change_select(data) {
		var id = data.id;
		var value = data.value;
		var index = id.split('_')[0].substr(-1, 1);
		// var text = id.split('_')[0].slice(0,-1) + index + '_text2'; // inverview + index

		if (value == '직접기재') {
			$('.direct' + index).removeClass('hide');
			$('.direct' + index).val('');
		} else {
			$('.direct' + index).addClass('hide');
		}
	}

    $('[name=mi_church_open]').on('click',function(){

        if ($('[name=mi_church_open]:checked').val() == 1  ){
            swal("공개에 체크할 경우 해당 정보가 다른 회원에게 노출됩니다.");
        }else{
            swal("비공개에 체크할 경우 해당 정보가 다른 회원에게 노출 되지않습니다.");

        }
    });




</script>
