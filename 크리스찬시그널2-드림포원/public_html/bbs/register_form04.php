<?php
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

// 로그인중인 경우 회원가입 할 수 없습니다.
if ($is_member) {
    goto_url(G5_URL);
}

// 세션을 지웁니다.
set_session("ss_mb_reg", "");

$g5['title'] = '프로필 등록';
include_once('./_head.php');

?>

<style>
	#ft {
		display: none;
	}

	#my_profile .in {
		padding: 0;
	}

	#my_profile .in label {
		font-weight: 600;
		font-size: 1em;
	}
	.selc{
		display: flex;
		flex-wrap: wrap;
	}
	.selc input[type=checkbox] + label, .selc input[type=radio] + label{
		font-size: 0.85em !important;
	}
	.selc span{
		float: unset;
	}
	#my_profile .in .title .comm{
		font-size: 0.75em;
	}
	#my_profile .st .tit {
		display: inline-block;
		padding: 4px 15px;
		border: 2px solid #fe8ea6;
		color: #fe8ea6;
		border-radius: 30px;
		margin-bottom: 6px;
		font-size: 0.9em;
	}
.b_rdo{
	display: flex;
	flex-wrap: wrap;
}
.b_rdo .st{
	width: calc(50% - 4px);
	position: relative;
/*	margin: 0 2px 4px;*/
}
.b_rdo .st.spec{
	width: 100%;
}
.b_rdo .st > div{
	border: 2px solid #f1f1f1;
    width: 100%;
    box-shadow: 2px 2px 0 rgb(0 0 0 / 2%);
    border-radius: 3px;
    padding: 20px;
}
.b_rdo .st .bx{
	position: relative;
}
.b_rdo .st h2{
	display: inline;
	margin: 3px 0 0;
	text-align: left;
	font-size: 1em;
}
.b_rdo .st .scon{
    font-size: 0.83em;
    font-weight: 500;
    color: #fe8ea6;
    margin-top: 8px;
}
.b_rdo input[type="radio"]{
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
}
.b_rdo .st p{
	position: absolute;
	right: 20px;
	top: 20px;
}
.b_rdo .st p img{
	width: 50px;
	height: auto;
}
	.b_rdo .st{
		margin: 0 2px 4px;
	}

	#my_profile .in .form-control{
		margin: 0 0 5px;
	}
	.mbskin .title_top{
		margin-top: 50px;
	}

</style>

<div class="mbskin">
    <ul class="profilecate cf">
        <li><a href="javascript:void(0);">배우자 정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form02.php');">신앙정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form03.php');">나의정보</a></li>
        <li class="active"><a href="javascript:void(0);" onclick="save('register_form04.php');">사진정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form05.php');">학벌/연봉/재산정보</a></li>
        <li><a href="javascript:void(0);" onclick="save('register_form06.php');">서류정보</a></li>
    </ul>
    
    
	<h2 class="title_top">
		<span class="point">나의 사진</span>를 등록하세요
	</h2>
	<div class="regi_info">
		<p>상대방에게 <strong class="point">필수유료</strong>로 공개되는 내용입니다. 사진은 최대한 이쁘고 멋있게 찍어서 올려주세요. 사진으로 데이트 신청이 있느냐 없느냐가 결정됩니다.</p>
		<!--	<p>유료로 열람가능합니다. 마음에 드시는 분은 찜목록으로 이동가능 합니다.</p>-->

				<span>얼굴이 자세히 나온 <br><strong>정면사진 2장</strong> <strong>전신사진 1장</strong>을 등록해주세요</span>
				<ul>
					<li>- 마스크 사진, 다른사람과 찍은 사진 불가</li>
				</ul>
				
	</div>

	<article class="box-article">
		<div id="my_profile">

			<div class="in">
				<div class="form-group">
					<label for="mb_job">직업</label>
					<input type="text" class="form-control" id="mb_job" name="mb_job" value="<?=$mb['mb_job']?>" placeholder="직업을 입력해 주세요">
				</div>
				<!--form-group-->
				<div class="form-group">
					<label for="mb_height">키(cm)<strong class="comm">(상대방에게 공개되지 않습니다)</strong></label>
					<input type="number" class="form-control" id="mb_height" name="mb_height" value="<?=$mb['mb_height']?>" placeholder="키를 입력해 주세요(숫자만)">
				</div>
				<!--form-group-->
				<div class="form-group">
					<label for="mb_blood_type">혈액형</label>
					<div class="rdo_ico">
						<input type="radio" name="mb_blood_type" id="blood_1" value="A" <?=$blood_checked?>>
						<label for="blood_1">A형</label>
					</div>
					<div class="rdo_ico">
						<input type="radio" name="mb_blood_type" id="blood_2" value="B">
						<label for="blood_2">B형</label>
					</div>
					<div class="rdo_ico">
						<input type="radio" name="mb_blood_type" id="blood_3" value="O">
						<label for="blood_3">O형</label>
					</div>
					<div class="rdo_ico">
						<input type="radio" name="mb_blood_type" id="blood_4" value="AB">
						<label for="blood_4">AB형</label>
					</div>
				</div>
				<!--form-group-->


				<div class="form-group">
					<h3 class="title"><span class="ess_icon hide">*</span>좋아하는 취미를 선택해 주세요<strong class="comm">(최대 5개까지 선택 가능)</strong></h3>
					<div class="selc cf">
						<span><input type="checkbox" id="hobby_1" class="code hobby "><label for="hobby_1" style="font-size:0.7em !important;">공연/전시회 관람</label></span>
						<span><input type="checkbox" id="hobby_2" class="code hobby "><label for="hobby_2">맛집 체험</label></span>
						<span><input type="checkbox" id="hobby_3" class="code hobby "><label for="hobby_3">스포츠 관람</label></span>
						<span><input type="checkbox" id="hobby_4" class="code hobby "><label for="hobby_4">드라이브</label></span>
						<span><input type="checkbox" id="hobby_5" class="code hobby "><label for="hobby_5">독서</label></span>
						<span><input type="checkbox" id="hobby_6" class="code hobby "><label for="hobby_6">요리</label></span>
						<span><input type="checkbox" id="hobby_7" class="code hobby "><label for="hobby_7">악기연주/노래</label></span>
						<span><input type="checkbox" id="hobby_8" class="code hobby "><label for="hobby_8">봉사활동</label></span>
						<span><input type="checkbox" id="hobby_9" class="code hobby "><label for="hobby_9">글쓰기/블로그</label></span>
						<span><input type="checkbox" id="hobby_10" class="code hobby "><label for="hobby_10">그림</label></span>
						<span><input type="checkbox" id="hobby_11" class="code hobby "><label for="hobby_11">웹서핑</label></span>
						<span><input type="checkbox" id="hobby_12" class="code hobby "><label for="hobby_12">게임</label></span>
						<span><input type="checkbox" id="hobby_13" class="code hobby "><label for="hobby_13">댄스</label></span>
						<span><input type="checkbox" id="hobby_14" class="code hobby "><label for="hobby_14">쇼핑</label></span>
						<span><input type="checkbox" id="hobby_15" class="code hobby "><label for="hobby_15">등산</label></span>
						<span><input type="checkbox" id="hobby_16" class="code hobby "><label for="hobby_16">운동</label></span>
						<span><input type="checkbox" id="hobby_17" class="code hobby "><label for="hobby_17">여행</label></span>
						<span><input type="checkbox" id="hobby_18" class="code hobby "><label for="hobby_18">사진촬영</label></span>
						<span><input type="checkbox" id="hobby_19" class="code hobby "><label for="hobby_19">동호회/소모임</label></span>
						<span><input type="checkbox" id="hobby_20" class="code hobby "><label for="hobby_20">반려동물</label></span>
						<span><input type="checkbox" id="hobby_21" class="code hobby "><label for="hobby_21">아이템수집</label></span>
						<span><input type="checkbox" id="hobby_22" class="code hobby "><label for="hobby_22">소품제작</label></span>
						<span><input type="checkbox" id="hobby_23" class="code hobby "><label for="hobby_23">자전거</label></span>
						<span><input type="checkbox" id="hobby_24" class="code hobby "><label for="hobby_24">유튜브</label></span>
					</div>
				</div>
				<!--form-group-->

				<div class="form-group">
					<h3 class="title"><span class="ess_icon hide">*</span>좋아하는 관심사를 선택해 주세요<strong class="comm">(각 분야별 최대 3개까지 선택 가능)</strong></h3>
					<div class="st">
						<div class="tit">영화부문</div>
						<div class="selc cf">
							<span><input type="checkbox" id="movie_43" class="code movie "><label for="movie_43">드라마/로맨스</label></span>
							<span><input type="checkbox" id="movie_44" class="code movie "><label for="movie_44">코미디</label></span>
							<span><input type="checkbox" id="movie_45" class="code movie "><label for="movie_45">액션/SF</label></span>
							<span><input type="checkbox" id="movie_46" class="code movie "><label for="movie_46">애니메이션</label></span>
							<span><input type="checkbox" id="movie_47" class="code movie "><label for="movie_47">심리/스릴러</label></span>
							<span><input type="checkbox" id="movie_48" class="code movie "><label for="movie_48">공포</label></span>
						</div>
						<!--selc-->
					</div>
					<div class="st">
						<div class="tit">음악부문</div>
						<div class="selc cf">
							<span><input type="checkbox" id="music_49" class="code music "><label for="music_49">락</label></span>
							<span><input type="checkbox" id="music_50" class="code music "><label for="music_50">재즈</label></span>
							<span><input type="checkbox" id="music_51" class="code music "><label for="music_51">클래식</label></span>
							<span><input type="checkbox" id="music_52" class="code music "><label for="music_52">발라드/R&amp;B</label></span>
							<span><input type="checkbox" id="music_53" class="code music "><label for="music_53">힙합/랩</label></span>
							<span><input type="checkbox" id="music_54" class="code music "><label for="music_54">CCM</label></span>
						</div>
						<!--selc-->
					</div>
					<div class="st">
						<div class="tit">TV부문</div>
						<div class="selc cf">
							<span><input type="checkbox" id="tv_55" class="code tv "><label for="tv_55">시사/뉴스</label></span>
							<span><input type="checkbox" id="tv_56" class="code tv "><label for="tv_56">다큐멘터리</label></span>
							<span><input type="checkbox" id="tv_57" class="code tv "><label for="tv_57">오락/예능</label></span>
							<span><input type="checkbox" id="tv_58" class="code tv "><label for="tv_58">스포츠</label></span>
							<span><input type="checkbox" id="tv_59" class="code tv "><label for="tv_59">국내드라마</label></span>
							<span><input type="checkbox" id="tv_60" class="code tv "><label for="tv_60">해외드라마</label></span>
						</div>
						<!--selc-->
					</div>

				</div>
				<!--form-group-->
			</div>
		</div>


		<div id="join_info01">
			<dl class="sec01">
				<dd class="b_rdo cf">
					<div class="st">
						<div>
							<input type="radio" name="join_type" id="person_1" value="초혼" checked>
							<em></em>
							<div class="bx">
								<h2 class="tit">나는 초혼입니다.</h2>
							</div>
						</div>
					</div>
					<div class="st">
						<div>
							<input type="radio" name="join_type" id="person_2" value="재혼">
							<em></em>
							<div class="bx">
								<h2 class="tit">나는 재혼입니다.</h2>
							</div>
						</div>
					</div>
					<div class="st spec">
						<div>
							<input type="radio" name="join_type" id="person_2" value="장애인">
							<em></em>
							<div class="bx">
								<h2 class="tit">나는 장애인입니다.</h2>
								<div class="scon">최고의 장애는 마음속에 있는 두려움입니다.<br />마음을 조금 더 열면 좋은 인연이 더 가까이 옵니다.</div>
							</div>
							<p><img src="<?php echo $member_skin_url;?>/img/info_ico03.png" alt="" /></p>
						</div>
					</div>
				</dd>

			</dl>
		</div>


		<div id="my_profile">
			<div class="in">
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
					<label for="test01"><span class="ess_icon hide">*</span>연인이 생기면 함께 해보고 싶은 것?<strong class="comm">(예:함께 공원 산책을 하며 대화를 나누고 싶어요)</strong></label>
					<input type="text" class="form-control required2" id="interview7_text1" name="interview7_text1" value="<?=$mi['interview7_text1']?>">
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
			</div>
		</div>

		<button onclick="location.href='./register_form05.php'" class="btn_submit ft_btn">다음 단계</button>
	</article>
</div>


<?php
include_once('./_tail.php');
?>
