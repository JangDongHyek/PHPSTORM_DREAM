<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<style>
	.btn_del {
		position: absolute;
		background: rgba(0, 0, 0, 0.5);
		width: 18px;
		height: 18px;
		line-height: 18px;
		border: 0;
		border-radius: 50%;
		right: -3px;
		top: -4px;
		color: #fff;
		font-size: 0.8em;
		z-index: 10;
	}

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

	.filetxt {
		text-overflow: ellipsis;
		overflow: hidden;
		white-space: nowrap;
		width: 240px;
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


	.mbskin {
		padding-bottom: 100px;
	}

	.mbskin .title_top {
		margin-top: 100px;
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
					<h3><span class="color">희망하는 배우자 정보</span>를 입력하세요</h3>
					<p>
						상대방에게 <span class="bold">무료</span>로 공개되는 내용입니다. 빠짐없이 꼼꼼하게 입력해주세요<br><br>
						<span class="color02">
							복수선택 가능
						</span>
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
		<span class="point">희망하는 배우자 정보</span>를 입력하세요
	</h2>
	<div class="regi_info">
		<p>상대방에게 <strong class="point">무료</strong>로 공개되는 내용입니다. 빠짐없이 꼼꼼하게 입력해주세요</p>
		<!--	<p>무료로 열람가능합니다. 마음에 드시는 분은 찜목록으로 이동가능 합니다.</p>-->

		<span>복수선택 가능</span>
	</div>
	<form method="post" action="./ajax.controller.php">
		<input type="hidden" name="mode" value="my_profile01">
		<input type="hidden" name="idx" value="<?=$mh["idx"]?>">
		<input type="hidden" name="page" id="page" value="">
		<input type="hidden" name="mb_id" value="<?=$mb_id?>">
		<article class="box-article">
			<div id="join_info01">
				<dl class="sec01">
					<dt>희망하는 직업</dt>
					<dd>
						<?php for ($i=1; $i <= count($mh_job_arr); $i++) {
                            $checked = "";
                            for ($a = 0; $a <count($mh_job); $a++){
                                if ($mh_job[$a] == $mh_job_arr[$i]["code"]) {
                                    $checked = "checked";
                                }
                            }

                            ?>
						<span>
							<input type="checkbox" name="mh_job[]" value="<?=$mh_job_arr[$i]["code"]?>" <?=$checked?> id="sec01_01_0<?=$i?>">
							<label for="sec01_01_0<?=$i?>"><?=$mh_job_arr[$i]["name"]?></label>
						</span>
						<?php } ?>
					</dd>
					<dd class="sec01_01_06" id="sec01_01_09">
						<?php  if (in_array('8', $mh_job)) echo "<input type=\"text\" value = \"".$mh['mh_job_memo']."\" name=\"mh_job_memo\" placeholder=\"희망하는 직업을 입력하세요\">" ?>
					</dd>
				</dl>
				<dl class="sec01">
					<dt>희망하는 키</dt>
					<dd>
						<?php for ($i=1; $i <= count($mh_height_arr); $i++) {
                            $checked = "";
                            for ($a = 0; $a <count($mh_height); $a++){
                                if ($mh_height[$a] == $mh_height_arr[$i]["code"]) {
                                    $checked = "checked";
                                }
                            }

                            ?>
						<span>
							<input type="checkbox" name="mh_height[]" value="<?=$mh_height_arr[$i]["code"]?>" <?=$checked?> id="sec01_02_0<?=$i?>">
							<label for="sec01_02_0<?=$i?>"><?=$mh_height_arr[$i]["name"]?></label>
						</span>
						<?php } ?>


					</dd>
				</dl>
				<dl class="sec01">
					<dt>희망하는 학벌</dt>
					<dd>
						<?php for ($i=1; $i <= count($mh_school_arr); $i++) {
                            $checked = "";
                            for ($a = 0; $a <count($mh_school); $a++){
                                if ($mh_school[$a] == $mh_school_arr[$i]["code"]) {
                                    $checked = "checked";
                                }
                            }

                            ?>
						<span>
							<input type="checkbox" name="mh_school[]" value="<?=$mh_school_arr[$i]["code"]?>" <?=$checked?> id="sec01_03_0<?=$i?>">
							<label for="sec01_03_0<?=$i?>"><?=$mh_school_arr[$i]["name"]?></label>
						</span>
						<?php } ?>

					</dd>
				</dl>
				<dl class="sec01">
					<dt>희망하는 연봉</dt>
					<dd>
						<?php for ($i=1; $i <= count($mh_salary_arr); $i++) {
                            $checked = "";
                            for ($a = 0; $a <count($mh_salary); $a++){
                                if ($mh_salary[$a] == $mh_salary_arr[$i]["code"]) {
                                    $checked = "checked";
                                }
                            }

                            ?>
						<span>
							<input type="checkbox" name="mh_salary[]" value="<?=$mh_salary_arr[$i]["code"]?>" <?=$checked?> id="sec01_04_0<?=$i?>">
							<label for="sec01_04_0<?=$i?>"><?=$mh_salary_arr[$i]["name"]?></label>
						</span>
						<?php } ?>

					</dd>
				</dl>
				<dl class="sec01">
					<dt>희망하는 근무형태</dt>
					<dd>
						<?php for ($i=1; $i <= count($mh_type_arr); $i++) {
                            $checked = "";
                            for ($a = 0; $a <count($mh_type); $a++){
                                if ($mh_type[$a] == $mh_type_arr[$i]["code"]) {
                                    $checked = "checked";
                                }
                            }

                            ?>
						<span>
							<input type="checkbox" name="mh_type[]" value="<?=$mh_type_arr[$i]["code"]?>" <?=$checked?> id="sec01_05_0<?=$i?>">
							<label for="sec01_05_0<?=$i?>"><?=$mh_type_arr[$i]["name"]?></label>
						</span>
						<?php } ?>


					</dd>
				</dl>
				<dl class="sec01">
					<dt>희망하는 스타일</dt>
					<dd>
						<select name="mh_style" id="sec01_06" class="form-control" onchange="style_change(this.value)">
							<option value="">선택하세요</option>
							<?php for ($i = 1; $i <= count($mh_style_arr); $i++) { ?>
							<option <?php if ($mh_style_arr[$i]["code"] == $mh["mh_style"] ) echo "selected" ?> value="<?=$mh_style_arr[$i]["code"]?>"><?=$mh_style_arr[$i]["name"]?></option>
							<?php } ?>
						</select>
					</dd>
					<dd class="sec01_06_06" id="sec01_06_06">
						<?php  if ($mh["mh_style"] == 5 ) echo "<input type=\"text\" value = \"".$mh['mh_style_memo']."\" name=\"mmh_style_memo\" >" ?>
					</dd>
				</dl>
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
				<dl class="sec01">
					<dt>희망하는 상대의 결혼 여부</dt>
					<dd>
						<?php for ($i=1; $i <= count($mh_marry_yn_arr); $i++) {
                            $checked = "";
                            for ($a = 0; $a <count($mh_marry_yn); $a++){
                                if ($mh_marry_yn[$a] == $mh_marry_yn_arr[$i]["code"]) {
                                    $checked = "checked";
                                }
                            }

                            ?>
						<span>
							<input type="checkbox" name="mh_marry_yn[]" value="<?=$mh_marry_yn_arr[$i]["code"]?>" <?=$checked?> id="sec01_07_0<?=$i?>">
							<label for="sec01_07_0<?=$i?>"><?=$mh_marry_yn_arr[$i]["name"]?></label>
						</span>
						<?php } ?>

					</dd>
				</dl>
				<dl class="sec01">
					<dd class="b_rdo cf">
						<div class="st spec">
							<div>
                                <input type="checkbox" name="mh_ten" value="Y" id="limit01" <?php  if ($mh["mh_ten"] == 'Y') echo "checked" ?> checked disabled>
								<em style="position:absolute;"></em>
								
								<div class="bx" style="padding: 0 0 0 35px;">
									<h2 class="tit">
                                        <!-- 기존
                                        나는 열살이상 차이나는 분은 메시지 제한합니다.
                                        -->
                                        <!-- 230404 변경 wc -->
                                        저희 어플은 7살이상 연상이나 연하에게는 메세지 강제제한합니다. <br>
                                        7살이상 차이나는 분이 마음에 드실경우 관리자에게 문의하세요.
									</h2>
								</div>
							</div>
						</div>
					</dd>
				</dl>
				<dl class="sec01">
					<dt>내가 원하는 배우자 희망을 한문장으로 기재해주세요</dt>
					<dd><input type="text" name = "mh_hope_content" value="<?=$mh['mh_hope_content']?>" placeholder="입력하세요"></dd>
				</dl>
			</div>



			<!--저장 부분-->
			<div class="f_arr cf">
				<div class="arr">
					<!--<span><a href="#"><i class="fal fa-angle-left"></i> 이전</a></span>-->
					<span><a href="#" onclick="save('my_profile02.php');">다음 <i class="fal fa-angle-right"></i></a></span>
					<!--첫단계에서는 "다음"만 나오도록--->
				</div>
				<!--        <div class="save"><a href="#" onclick="save('my_profile01.php');">저 장</a></div>-->
			</div>
		</article>
	</form>
</div>


<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<script>
	$('#myModaregister').modal('show');	
	$(function() {
		// history.replaceState(null, null, g5_bbs_url+'/mypage.php'); // 뒤로가기 이벤트 때문에 history 추가
		$("input:radio[name='mb_join_type']:radio[value='<?=$mb['mb_join_type']?>']").prop("checked", true);
	});

    function not_ready(){
        swal('준비중입니다.');
    }

	//희망하는 스타일
	function style_change(val) {

		if (val == 5) {
			$("#sec01_06_06").html("<input type=\"text\" class=\"form-control\" name=\"mh_style_memo\" placeholder=\"희망하는 스타일을 입력해주세요\">");
		} else {
			$("#sec01_06_06").html("");
		}

	}

	$('[name="mh_job[]"]').on('click', function() {
		var val = $(this).val();
		if (val == 8 && $(this).prop("checked") == true) {
			$("#sec01_01_09").html("<input type=\"text\" name=\"mh_job_memo\" placeholder=\"희망하는 직업을 입력하세요\">\n");
		} else if (val == 8 && $(this).prop("checked") == false) {
			$("#sec01_01_09").html("");

		}
	});

	var is_post = false;

	function save(page) {
		if (is_post) {
			return false;
		}
		is_post = true;

		$('#page').val(page);

		if ($('input[name="mh_job[]"]:checked').length == 0) {
			swal('희망하는 직업을 선택하세요.');
			is_post = false;
			return false;
		} else if ($("[name=mh_job_memo]").length > 0 && $("[name=mh_job_memo]").val() == "") {
			swal('희망하는 직업을 직접 기재해주세요.');
			is_post = false;
			return false;
		}


		if ($('input[name="mh_height[]"]:checked').length == 0) {
			swal('희망하는 키를 선택하세요.');
			is_post = false;
			return false;
		}

		if ($('input[name="mh_school[]"]:checked').length == 0) {
			swal('희망하는 학벌을 선택하세요.');
			is_post = false;
			return false;
		}

		if ($('input[name="mh_salary[]"]:checked').length == 0) {
			swal('희망하는 연봉을 선택하세요.');
			is_post = false;
			return false;
		}

		if ($('input[name="mh_type[]"]:checked').length == 0) {
			swal('희망하는 근무형태를 선택하세요.');
			is_post = false;
			return false;
		}

		if ($('[name="mh_style"]').val() == "") {
			swal('희망하는 스타일을 선택하세요.');
			is_post = false;
			return false;
		} else if ($('[name="mh_style"]')[0].value == "5" && $("[name=mh_style_memo]").val() == "") {
			swal('희망하는 스타일을 직접 기재해주세요.');
			is_post = false;
			return false;
		}

		if ($('input[name="mh_marry_yn[]"]:checked').length == 0) {
			swal('희망하는 상대의 결혼여부를 선택하세요.');
			is_post = false;
			return false;
		}

		if ($("[name=mh_hope_content]").val() == ""){
            swal('내가 원하는 배우자 희망을 한문장으로 기재해주세요.');
            $("[name=mh_hope_content]").focus();
            is_post = false;
            return false;
        }

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
	}

</script>
