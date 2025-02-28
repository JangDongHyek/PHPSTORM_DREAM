<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
$mb_id = "";
//if(!empty($_SESSION['ss_mb_id'])) {
//    $mb_id = $_SESSION['ss_mb_id'];
//} else {
    $mb_id = $_GET['mb_id'];
//    $_SESSION['ss_mb_id'] = $mb_id;
//}

$mb = get_member($mb_id);
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




	#my_profile .in {
		padding: 0;
	}

	#my_profile .in label {
		font-weight: 600;
		font-size: 1em;
	}

	.selc {
		display: flex;
		flex-wrap: wrap;
	}

	.selc input[type=checkbox]+label,
	.selc input[type=radio]+label {
		font-size: 0.85em !important;
	}

	.selc span {
		float: unset;
	}

	#my_profile .in .title .comm {
		font-size: 0.75em;
	}

	#my_profile .st .tit {
		display: inline-block;
		padding: 4px 15px;
		border: 2px solid #fe8ea6;
		color: #fe8ea6;
		border-radius: 30px;
		margin: 6px 0;
		font-size: 0.9em;
	}

	.b_rdo {
		display: flex;
		flex-wrap: wrap;
	}

	.b_rdo .st {
		width: calc(50% - 4px);
		position: relative;
		/*	margin: 0 2px 4px;*/
	}

	.b_rdo .st.spec {
		width: 100%;
	}

	.b_rdo .st>div {
		border: 2px solid #f1f1f1;
		width: 100%;
		box-shadow: 2px 2px 0 rgb(0 0 0 / 2%);
		border-radius: 3px;
		padding: 20px;
	}

	.b_rdo .st .bx {
		position: relative;
	}

	.b_rdo .st h2 {
		display: inline;
		margin: 3px 0 0;
		text-align: left;
		font-size: 1em;
	}

	.b_rdo .st .scon {
		font-size: 0.83em;
		font-weight: 500;
		color: #fe8ea6;
		margin-top: 8px;
	}

	.b_rdo input[type="radio"] {
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0;
		width: 100%;
		height: 100%;
	}

	.b_rdo .st p {
		position: absolute;
		right: 20px;
		top: 20px;
	}

	.b_rdo .st p img {
		width: 50px;
		height: auto;
	}

	.b_rdo .st {
		margin: 0 2px 4px;
	}

	#my_profile .in .form-control {
		margin: 0 0 5px;
	}

	.mbskin .title_top {
		margin-top: 100px;
	}
	.mbskin{
		padding-bottom: 100px;
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
					<h3><span class="color">나의 정보</span>를 입력하세요</h3>
					<p>
						상대방에게 <span class="bold">필수유료</span>로 공개되는 내용입니다.<br>
						빠짐없이 꼼꼼하게 입력해주세요
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
		<span class="point">나의 정보</span>를 입력하세요
	</h2>
	<div class="regi_info">
		<p>상대방에게 <strong class="point">필수유료</strong>로 공개되는 내용입니다. 빠짐없이 꼼꼼하게 입력해주세요</p>
		<!--	<p>유료로 열람가능합니다. 마음에 드시는 분은 찜목록으로 이동가능 합니다.</p>-->

		<!--		<span>복수선택 가능</span>-->
	</div>
    <form method="post" action="./ajax.controller.php">
        <input type="hidden" name="mode" value="my_profile03">
        <input type="hidden" name="page" id="page" value="">
        <input type="hidden" name="mb_id" value="<?=$mb_id?>">
        <input type="hidden" name="hobby_code">
        <article class="box-article">
                   
                   
			<div id="join_info01">
				<dl class="sec01">
					<dd class="b_rdo cf">
						<div class="st">
							<div>
								<input type="radio" name="mb_join_type" id="person_1" value="초혼">
								<em></em>
								<div class="bx">
									<h2 class="tit">나는 초혼입니다.</h2>
								</div>
							</div>
						</div>
						<div class="st">
							<div>
								<input type="radio" name="mb_join_type" id="person_2" value="재혼">
								<em></em>
								<div class="bx">
									<h2 class="tit">나는 재혼입니다.</h2>
								</div>
							</div>
						</div>
						<div class="st spec">
							<div>
								<input type="radio" name="mb_join_type" id="person_3" value="장애인" onclick="not_ready();return(false);">
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
                    <!--<div class="form-group">-->
                    <!--    <label for="mb_old">나이</label>-->
                    <!--    <input type="text" class="form-control" id="mb_old" name="mb_old" value="--><?//=$mb['mb_old']?><!--" placeholder="나이을 입력해 주세요">-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="mb_job">직업</label>
                        <input type="text" class="form-control" id="mb_job" name="mb_job" value="<?=$mb['mb_job']?>" placeholder="직업을 입력해 주세요">
                    </div>
                    <div class="form-group">
						<label for="mb_adress">사는 지역<strong class="comm">(현재 거주지의 시,도와 구를 입력해주세요)</strong></label>
                        <input type="text" class="form-control" id="mb_live_si" name="mb_live_si" value="<?=$mb['mb_live_si']?>" placeholder="예)부산광역시">
                        <input type="text" class="form-control" id="mb_live_gu" name="mb_live_gu" value="<?=$mb['mb_live_gu']?>" placeholder="예)해운대구">
                    </div>
                    <!--form-group-->
                    <div class="form-group">
                        <label for="mb_height">키(cm)<strong class="comm">(상대방에게 공개되지 않습니다)</strong></label>
                        <input type="number" class="form-control" id="mb_height" name="mb_height" value="<?=$mb['mb_height']?>" placeholder="키를 입력해 주세요(숫자만)">
                    </div>
                    <div class="form-group">
                        <label for="mb_weight">몸무게(kg)<strong class="comm">(상대방에게 공개되지 않습니다)</strong></label>
                        <input type="number" class="form-control" id="mb_weight" name="mb_weight" value="<?=$mb['mb_weight']?>" placeholder="몸무게를 입력해 주세요(숫자만)">
                    </div>
                    <!--form-group-->
                    <div class="form-group">
                        <label for="mb_mbti">나의 MBTI는?(영어 대문자만 기입가능)
							<strong class="comm">(나의 MBTI를 아는 분은 적으시고, 모르시는 분은 회원가입 후 안내드리겠습니다)</strong>
                        </label>
                        <input type="text" class="form-control" id="mb_mbti" name="mb_mbti" value="<?=$mb['mb_mbti']?>" maxlength="4" placeholder="MBTI를 입력해주세요">
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
                            <?php
                            $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                            $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                            if(!empty($mb['mb_no'])) {
                                $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                            }
                            $sql .= " where co.co_code_name = '취미' order by co.co_code*1 ";
                            $result = sql_query($sql);
                            for($i=0;$row=sql_fetch_array($result);$i++) {
                                $class_on = "";
                                $checked = "";
                                if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                                    $class_on = "on";
                                    $checked = "checked";
                                }
                                ?>
                                <span><input type="checkbox" <?=$checked?> id="hobby_<?=$row['co_code']?>" class="code hobby <?=$class_on?>"><label for="hobby_<?=$row['co_code']?>" style="font-size:0.7em !important;"><?=$row['co_main_code_value']?></label></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <h3 class="title"><span class="ess_icon hide">*</span>좋아하는 관심사를 선택해 주세요<strong class="comm">(각 분야별 최대 3개까지 선택 가능)</strong></h3>
                        <div class="st">
                            <div class="tit">영화부문</div>
                            <div class="selc cf">
                                <?php
                                $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                                $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                if(!empty($mb['mb_no'])) {
                                    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                                }
                                $sql .= " where co.co_code_name = '영화' order by co.co_code*1 ";
                                $result = sql_query($sql);
                                for($i=0;$row=sql_fetch_array($result);$i++) {
                                    $class_on = "";
                                    $checked = "";
                                    if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                                        $class_on = "on";
                                        $checked = "checked";

                                    }
                                    ?>
                                    <span><input type="checkbox" <?=$checked?> id="movie_<?=$row['co_code']?>" class="code movie <?=$class_on?>"><label for="movie_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></label></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <!--selc-->
                        </div>
                        <div class="st">
                            <div class="tit">음악부문</div>
                            <div class="selc cf">
                                <?php
                                $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                                $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                if(!empty($mb['mb_no'])) {
                                    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                                }
                                $sql .= " where co.co_code_name = '음악' order by co.co_code*1 ";
                                $result = sql_query($sql);
                                for($i=0;$row=sql_fetch_array($result);$i++) {
                                    $class_on = "";
                                    $checked = "";

                                    if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                                        $class_on = "on";
                                        $checked = "checked";
                                    }
                                    ?>
                                    <span><input type="checkbox" <?= $checked?> id="music_<?=$row['co_code']?>" class="code music <?=$class_on?>"><label for="music_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></label></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <!--selc-->
                        </div>
                        <div class="st">
                            <div class="tit">TV부문</div>
                            <div class="selc cf">
                                <?php
                                $sql = " select co.co_code, co.co_main_code_value, mh.mb_no, mh.co_code as hobby_code from g5_code as co ";
                                $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                if(!empty($mb['mb_no'])) {
                                    $sql .= " and mh.mb_no = '{$mb['mb_no']}' ";
                                }
                                $sql .= " where co.co_code_name = 'TV' order by co.co_code*1 ";
                                $result = sql_query($sql);
                                for($i=0;$row=sql_fetch_array($result);$i++) {
                                    $class_on = "";
                                    $checked = "";

                                    if($mb['mb_no'] == $row['mb_no'] && !empty($row['hobby_code'])) {
                                        $class_on = "on";
                                        $checked = "checked";
                                    }
                                    ?>
                                    <span><input type="checkbox" <?=$checked?> id="tv_<?=$row['co_code']?>" class="code tv <?=$class_on?>"><label for="tv_<?=$row['co_code']?>"><?=$row['co_main_code_value']?></label></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <!--selc-->
                        </div>

                    </div>
                    <!--form-group-->
                </div>
            </div>


            <div id="my_profile">
                <div class="in">
                    <div class="form-group">
                        <label for="test01"><span class="ess_icon hide">*</span>연인이 생긴다면 함께 나누고 싶은 음식은?<strong class="comm hide">(예:분위기 좋은 레스토랑에서 먹는 쉐프의 추천요리)</strong></label>
                        <select class="form-control" id="interview5_text1" name="mi_food" onchange="food_change(this.value);">
                            <option value="">선택하세요</option>
                            <option value="1">마음편하게 부담없이 한식찌개</option>
                            <option value="2">분위기 있는 이태리 카페</option>
                            <option value="3">고즈넉하게 즐기는 브런치</option>
                            <option value="4">서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살</option>
                            <option value="5">요리실력도 뽐낼겸 셀프요리 피크닉</option>
                            <option value="6">직접기재</option>
                            <!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                        </select>
                        <span id="food_span">
                            <?php  if ($mi["mi_food"] == 6 ) echo '<input type="text" value="'.$mi["mi_food_memo"].'" class="form-control required2 direct5" name="mi_food_memo">' ?>
                        </span>
                    </div>
                    <!--form-group-->
                    <div class="form-group">
                        <label for="test01"><span class="ess_icon hide">*</span>연인이 생기면 함께 해보고 싶은 것?
<!--                        <strong class="comm">(예:함께 공원 산책을 하며 대화를 나누고 싶어요)</strong>-->
                        </label>
						<select class="form-control" id="interview5_text1" name="mi_want" onchange="want_change(this.value)">
							<option <?php echo $mi['mi_want'] == '1000만원이하' ? 'selected' : ''?> value="">선택하세요</option>
							<option <?php echo $mi['mi_want'] == '마음편하게 부담없이 한식찌개' ? 'selected' : ''?> value="마음편하게 부담없이 한식찌개">마음편하게 부담없이 한식찌개</option>
							<option <?php echo $mi['mi_want'] == '분위기 있는 이태리 카페' ? 'selected' : ''?> value="분위기 있는 이태리 카페">분위기 있는 이태리 카페</option>
							<option <?php echo $mi['mi_want'] == '고즈넉하게 즐기는 브런치' ? 'selected' : ''?> value="고즈넉하게 즐기는 브런치">고즈넉하게 즐기는 브런치</option>
							<option <?php echo $mi['mi_want'] == '서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살' ? 'selected' : ''?> value="서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살">서로의 마음도 확인할겸 쌈을 서로 먹여주는 삼겹살</option>
							<option <?php echo $mi['mi_want'] == '요리실력도 뽐낼겸 셀프요리 피크닉' ? 'selected' : ''?> value="요리실력도 뽐낼겸 셀프요리 피크닉">요리실력도 뽐낼겸 셀프요리 피크닉</option>
							<option <?php echo $mi['mi_want'] == '직접기재' ? 'selected' : ''?> value="직접기재">직접기재</option><!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
						</select>
                        <span id="want_span">
                            <?php  if ($mi["mi_want"] == "직접기재" ) echo '<input type="text" value="'.$mi["mi_want_memo"].'" class="form-control required2 direct5" name="mi_want_memo">' ?>
                        </span>
                    </div>
                    <!--form-group-->
                    <div class="form-group">
                        <label for="test01"><span class="ess_icon hide">*</span>당신의 매력포인트나 장점은?<strong class="comm hide">(예:큰 키와 잘생긴 얼굴/상대방을 배려하는 마음과 따뜻한 매너)</strong></label>
                        <select class="form-control" id="interview4_text1" name="mi_charming" onchange="charming_change(this.value);">
                            <option value="">선택하세요</option>
                            <option value="1">활발하고 명랑한 성격</option>
                            <option value="2">훤칠하고 뽀대나는 아우라</option>
                            <option value="3">늘 긍정적이고 적극적인 마인드</option>
                            <option value="4">분위기 잘 맞추고 눈치껏 발휘하는 센스</option>
                            <option value="5">유머러스한 리더쉽</option>
                            <option value="6">직접기재</option>
                            <!--직접기재 선택시 하단 텍스트박스가 나오면 될 것 같아요-->
                        </select>
                        <span id="charming_span">
                            <?php  if ($mi["mi_charming"] == 6 ) echo '<input type="text" value="'.$mi["mi_charming_memo"].'" class="form-control required2 direct5" name="mi_charming_memo">' ?>
                        </span>
                    </div>
                    <!--form-group-->
                </div>
            </div>



        <!--저장 부분-->
        <div class="f_arr cf">
            <div class="arr">
                <!--<span><a href="#"><i class="fal fa-angle-left"></i> 이전</a></span>-->
                <span><a href="#" onclick="save('my_profile05.php');">다음 <i class="fal fa-angle-right"></i></a></span><!--첫단계에서는 "다음"만 나오도록--->
            </div>
<!--            <div class="save"><a href="#" onclick="save('my_profile03.php');">저 장</a></div>-->
        </div>
        <!--f_arr-->
        </article>
    </form>
</div>

<script>
    function not_ready(){
        swal('준비중입니다.');
    }

	$('#myModaregister').modal('show');	
	$(function() {
		$(function() {
            $("input:radio[name='mb_blood_type']:radio[value='<?=$mb['mb_blood_type']?>']").prop("checked", true);
            $("[name='mi_angel']").val("<?=$mi['mi_angel']?>");
            $("[name='mi_charming']").val("<?=$mi['mi_charming']?>");
            $("[name='mi_food']").val("<?=$mi['mi_food']?>");
            $("input:radio[name='mb_join_type']:radio[value='<?=$mb['mb_join_type']?>']").prop("checked", true);

            // history.replaceState(null, null, g5_bbs_url+'/mypage.php'); // 뒤로가기 이벤트 때문에 history 추가
		});

		// 취미/관심사 선택처리
		$(".code").click(function() {
			if ($('#' + this.id).hasClass("on")) {
				$("#" + this.id).removeClass("on");
			} else {
				$("#" + this.id).addClass("on");
			}

			if ($(".code.hobby.on").length > 5 || $(".code.exercise.on").length > 5) {
				swal('최대 5개까지 선택 가능합니다.');
				$("#" + this.id).removeClass("on");
				return false;
			}

			if ($(".code.movie.on").length > 3 || $(".code.music.on").length > 3 || $(".code.tv.on").length > 3) {
				swal('최대 3개까지 선택 가능합니다.');
				$("#" + this.id).removeClass("on");
				return false;
			}
		});
	});

	//mbti
    var enCheck = RegExp(/[^A-Z]$/);
    $('#mb_mbti').keyup(function(){
        if(enCheck.test($('#mb_mbti').val())){
            $('#mb_mbti').val($('#mb_mbti').val().replace(/[^A-Z]$/,''));
        }
    });

    //희망하는 음식
    function food_change(val) {

        if (val == 6 ){
            $("#food_span").html("<input type=\"text\" class=\"form-control required2 direct5\" name=\"mi_food_memo\">\n");
        }else{
            $("#food_span").html("");
        }

    }
    function charming_change(val) {

        if (val == 6 ){
            $("#charming_span").html("<input type=\"text\" class=\"form-control required2 direct5\" name=\"mi_charming_memo\">\n");
        }else{
            $("#charming_span").html("");
        }

    }
    function want_change(val) {

        if (val == "직접기재" ){
            $("#want_span").html("<input type=\"text\" class=\"form-control required2 direct5\" name=\"mi_want_memo\">\n");
        }else{
            $("#want_span").html("");
        }

    }


    // 저장
	function save(page, save_op) {
		$('#page').val(page);
		$('#save_op').val(save_op);

		// if(!$('input:radio[name="mb_live"]').is(':checked')) {
		//     swal('현재거주 정보를 선택하세요.');
		//     return false;
		// }
        if ($("#mb_old").val() == ""){
            swal('나이를 입력해주세요');
            return false;
        }
        if ($("#mb_job").val() == ""){
            swal('직업을 입력해주세요');
            return false;
        }
        if ($("#mb_live_si").val() == ""){
            swal('사는 지역의 시를 입력해주세요.');
            return false;
        }
        if ($("#mb_live_gu").val() == ""){
            swal('사는 지역의 구를 입력해주세요.');
            return false;
        }
        if ($("#mb_height").val() == ""){
            swal('키를 입력해주세요');
            return false;
        }
        if ($("#mb_weight").val() == ""){
            swal('몸무게를 입력해주세요');
            return false;
        }

        // if ($("#mb_mbti").val() == ""){
        //     swal('mbti를 입력해주세요');
        //     return false;
        // }

		if (!$('input:radio[name="mb_blood_type"]').is(':checked')) {
			swal('혈액형을 선택하세요.');
			return false;
		}

		if($(".code.hobby.on").length == 0) {
		    swal('좋아하는 취미를 선택하세요.');
		    return false;
		}
		// if($(".code.exercise.on").length == 0) {
		//     swal('좋아하는 운동을 선택하세요.');
		//     return false;
		// }
		if($(".code.movie.on").length == 0) {
		    swal('좋아하는 영화를 선택하세요.');
		    return false;
		}
		if($(".code.music.on").length == 0) {
		    swal('좋아하는 음악을 선택하세요.');
		    return false;
		}
		if($(".code.tv.on").length == 0) {
		    swal('좋아하는 TV를 선택하세요.');
		    return false;
		}

		if ($("[name=mi_food]").val() == ""){
            swal('연인이 생긴다면 함께 나누고 싶은 음식을 선택해주세요.');
            return false;
        }

        if ($("[name=mi_want]").val() == ""){
            swal('연인이 생기면 함께 해보고 싶은 것을 선택해주세요.');
            return false;
        }

        if ($("[name=mi_charming]").val() == ""){
            swal('매력포인트나 장점을 선택해주세요.');
            return false;
        }


        var hobby_code = "";
		$('.code').each(function() {
			if ($("#" + this.id).hasClass("on")) {
				hobby_code += this.id + ',';
			}
		});

		$('input[name=hobby_code]').val(hobby_code.slice(0, -1));

		$('form')[0].submit();
	}

</script>
