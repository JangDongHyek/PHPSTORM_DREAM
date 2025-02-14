<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
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

	.selc {
		display: flex;
		flex-wrap: wrap;
	}

	.selc input[type=checkbox]+label,
	.selc input[type=radio]+label {
		font-size: 0.8em !important;
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

	.mbskin {
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
					<h3><span class="color">학벌/연봉/재산 정보</span>를 입력하세요</h3>
					<p>
						상대방에게 <span class="bold">선택유료</span>로 공개되는 내용입니다.<br>
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
		<span class="point">학벌/연봉/재산 정보</span>를 입력하세요
	</h2>
	<div class="regi_info">
		<p>상대방에게 <strong class="point">선택유료</strong>로 동의하에 공개되는 내용입니다. 빠짐없이 꼼꼼하게 입력해주세요</p>

	</div>
    <form method="post" action="./ajax.controller.php">
        <input type="hidden" name="mode" value="my_profile05">
        <input type="hidden" name="page" id="page" value="">
        <input type="hidden" name="mb_id" value="<?=$mb_id?>">
	    <article class="box-article">
		<div id="my_profile">

			<div class="in">

				<!--form-group-->
				
				<div class="form-group">
					<div class="st">
						<h3 class="title">학력정보</h3>
						<select name="mb_school_sel" id="mb_school_sel" class="form-control" onchange="school_change(this.value)">
							<option value="">최종학력을 선택하세요</option>
							<option value="고졸">고졸</option>
							<option value="대졸">대졸</option>
							<option value="유학">유학</option>
						</select>
						<div class="selc cf">
							<input type="text" name = "mb_school" value="<?=$mb['mb_school']?>" class="form-control" placeholder="최종졸업학교를 입력하세요">
							<input type="text" name = "mb_department" value="<?=$mb['mb_department']?>" class="form-control" placeholder="학과를 입력하세요">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<!-- //본인연봉 -->
					<div class="st">
						<h3 class="title">본인연봉</h3>
						<div class="selc cf">
							<span><input type="radio" id="pay_1" name="mb_salary" value="1000만원이하" class="pay_t" <?php echo $mb['mb_salary'] == '1000만원이하' ? 'checked' : ''; ?>><label for="pay_1">1000만원이하</label></span>
							<span><input type="radio" id="pay_2" name="mb_salary" value="1000~2000만원" class="pay_t" <?php echo $mb['mb_salary'] == '1000~2000만원' ? 'checked' : ''; ?>><label for="pay_2">1000~2000만원</label></span>
							<span><input type="radio" id="pay_3" name="mb_salary" value="2000~3000만원" class="pay_t" <?php echo $mb['mb_salary'] == '2000~3000만원' ? 'checked' : ''; ?>><label for="pay_3">2000~3000만원</label></span>
							<span><input type="radio" id="pay_4" name="mb_salary" value="3000~4000만원" class="pay_t" <?php echo $mb['mb_salary'] == '3000~4000만원' ? 'checked' : ''; ?>><label for="pay_4">3000~4000만원</label></span>
							<span><input type="radio" id="pay_5" name="mb_salary" value="4000~5000만원" class="pay_t" <?php echo $mb['mb_salary'] == '4000~5000만원' ? 'checked' : ''; ?>><label for="pay_5">4000~5000만원</label></span>
							<span><input type="radio" id="pay_6" name="mb_salary" value="5000~6000만원" class="pay_t" <?php echo $mb['mb_salary'] == '5000~6000만원' ? 'checked' : ''; ?>><label for="pay_6">5000~6000만원</label></span>
							<span><input type="radio" id="pay_7" name="mb_salary" value="6000만원이상" class="pay_t" <?php echo $mb['mb_salary'] == '6000만원이상' ? 'checked' : ''; ?>><label for="pay_7">6000만원이상</label></span>
						</div>
						<!--selc-->
					</div>

				</div>
				<div class="form-group">
					<!-- //자차소유 -->
					<div class="st">
						<h3 class="title">자차소유여부</h3>
						<div class="selc cf">
							<span>
								<input type="radio" id="car_y" onclick="mb_mycar_yn(this.value)" name="mb_mycar" class="car_t" value="Y" <?php echo $mb['mb_mycar'] == 'Y' ? 'checked' : ''; ?>>
								<label for="car_y">있음</label>
							</span>
							<span>
								<input type="radio" id="car_n" onclick="mb_mycar_yn(this.value)" name="mb_mycar" class="car_t" value="N" <?php echo $mb['mb_mycar'] == 'N' ? 'checked' : ''; ?>>
								<label for="car_n">없음</label>
							</span>
						</div>
                        <span id="my_car_span">
                        </span>
                        

						<!--selc-->
					</div>

					<!-- // -->
				</div>
				<div class="form-group">
					<div class="st">
						<h3 class="title">자가소유여부</h3>
						<div class="selc cf">
							<span>
								<input type="radio" id="home_y" name="mb_myhome" class="home_t" value="Y" <?php echo $mb['mb_myhome'] == 'Y' ? 'checked' : ''; ?>>
								<label for="home_y">있음</label>
							</span>
							<span>
								<input type="radio" id="home_n" name="mb_myhome" class="home_t" value="N" <?php echo $mb['mb_myhome'] == 'N' ? 'checked' : ''; ?>>
								<label for="home_n">없음</label>
							</span>
						</div>
						<!--selc-->
					</div>
				</div>
				<div class="form-group">
					<div class="st">
						<h3 class="title">재혼일 경우 자녀의 생년월일-성별</h3>
						<div class="selc cf">
							<input type="text" class="form-control" name="mb_children" value="<?=$mb['mb_children']?>" placeholder="자녀의 생년월일-성별,생년월일-성별">
						</div>
					</div>
				</div>

			</div>
		</div>




		<!--저장 부분-->
		<div class="f_arr cf">
			<div class="arr">
				<!--<span><a href="#"><i class="fal fa-angle-left"></i> 이전</a></span>-->
				<span><a href="#" onclick="save('my_profile06.php');">다음 <i class="fal fa-angle-right"></i></a></span>
				<!--첫단계에서는 "다음"만 나오도록--->
			</div>
		</div>
		<!--f_arr-->
	</article>
    </form>
</div>


<script>

    $(function () {
        $("[name=mb_school_sel]").val("<?=$mb['mb_school_sel']?>");
        school_change("<?=$mb['mb_school_sel']?>");
        mb_mycar_yn("<?=$mb['mb_mycar']?>")
        car_change("<?=$mb['mb_mycar_name']?>");
    })

	$('#myModaregister').modal('show');

    function car_change(val) {
        console.log(val);
        if (val == "직접기재"){
            $("#mb_mycar_name_memo").css("display","inline");
        }else{
            $("#mb_mycar_name_memo").css("display","none");
            $("#mb_mycar_name_memo").val("");

        }
    }


   function mb_mycar_yn(val) {

        if (val == "Y"){
            $("#my_car_span").html("" +
                "<select name = 'mb_mycar_name' onchange= 'car_change(this.value)' class=\"form-control\">" +
                    "<option value = '' >차브랜드를 선택해주세요</option>" +

                    <?php for ($c = 1; $c <= count($car_arr); $c++) { ?>
                    '<option <? if ($car_arr[$c] == $mb["mb_mycar_name"]) echo "selected"; ?> value = "<?= $car_arr[$c] ?>"><?= $car_arr[$c]?></option>' +
                    <?php }?>
                "</select>" +
                "<input style = \"display:none\" type=\"text\" class=\"form-control\" name=\"mb_mycar_name_memo\" value = '<?=$mb["mb_mycar_name_memo"]?>' id = 'mb_mycar_name_memo' placeholder=\"차브랜드를 입력해주세요\">");
        }else{
            $("#my_car_span").html("");

        }

   }
    
    function school_change(val) {
        if (val == ""){
            $("[name=mb_school]").css("display","none");
            $("[name=mb_department]").css("display","none");
        }else{
            $("[name=mb_school]").css("display","inline");
            $("[name=mb_department]").css("display","inline");
        }

    }

	// 저장
	function save(page) {
		$('#page').val(page);

        if ($("[name = mb_school_sel]").val() == ""){
            swal('최종학력을 선택하세요');
            return false;
        }
		if ($("[name = mb_school]").val() == ""){
            swal('최종졸업학교를 입력하세요');
            return false;
        }

        if ($("[name = mb_department]").val() == "" &&$("[name = mb_school_sel]").val() == "대졸" ){
            swal('학과를 입력하세요');
            return false;
        }

		if (!$('input:radio[name="mb_salary"]').is(':checked')) {
			swal('본인연봉 정보를 선택하세요.');
			return false;
		}
		if (!$('input:radio[name="mb_mycar"]').is(':checked')) {

			swal('자차소유여부 정보를 선택하세요.');
			return false;
		}else{
            if ($('input:radio[name="mb_mycar"]:checked').val() == "Y" && $("[name = mb_mycar_name]").val() == ""){
                swal('차브랜드를 입력하세요.');
                return false;
            }
        }

		if (!$('input:radio[name="mb_myhome"]').is(':checked')) {
			swal('자가소유여부 정보를 선택하세요.');
			return false;
		}


		$('form')[0].submit();
	}

</script>
