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
		/*        width: 240px;*/
	}

	#my_profile .in .form-group .document_list .area_input {
		justify-content: space-between;
		font-size: 0.9em;
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
		margin-bottom: 6px;
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
					<h3><span class="color">서류</span>를 등록하세요</h3>
					<p>
						<span class="bold">관리자</span>에게만 공개되는 내용입니다.<br>
						사실과 다를 경우 법적책임이 있을 수 있습니다.
					<p>
				</div>
				<!--msg_con-->
			</div>
		</div>
	</div>
</div>
<!--basic_modal-->
<!-- 메세지 모달팝업 -->
<div class="mbskin" id="my_profile">
	<?php include_once("./my_profile_head.php") ?>

	<!--작성 폼 시작-->
	<div class="in">


		<h2 class="title_top">
			<span class="point">서류</span>를 등록하세요
		</h2>

		<form id="fprofile1" name="fprofile1" action="./ajax.controller.php" method="post" autocomplete="off">
			<input type="hidden" id="page" name="page">
			<input type="hidden" name="mode" value="my_profile06">
			<input type="hidden" name="mb_id" value="<?=$mb_id?>">
			<input type="hidden" name="mb_no" value="<?=$mb['mb_no']?>">
			<div class="form-group cf">
				<div class="regi_info v2">
					<p style="margin:0 0 5px">
						입력하신 서류는 절대적으로 <strong class="">관리자</strong>에게만 공개됩니다.
					</p>

					<em>서류안내</em>

					<ul style="text-align:left;">
						<li>
							- 서류는 변경이 불가하며 추가로 올리는 것은 가능합니다.
						</li>
						<li>
							- 등본, 최종학력증명서, 사업자등록증, 지역이나 직장의료보험증, 각종 자격증, 급여통장명세서, 급여명세서 등 수입을 증명하는 서류제출 요망
						</li>
					</ul>
				</div>
			</div>
			<!--form-group photo-->
			<div class="form-group">
				<h3 class="title">서류등록<strong class="comm">등록 완료 후 <span class="point">수정 불가</span></strong></h3>
				<div class="addFileBox">
					<a class="btn_upload" href="javascript:void(0);" onclick="file_add();"><i></i>업로드</a>
					<input type="file" multiple id="document" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
					<ul class="document_list">
						<?php
                        // 추가서류
                        $sql = " select * from g5_member_img_add where mb_no = '{$mb['mb_no']}' order by idx ";
                        $result = sql_query($sql);

                        $fileCount = 0;
                        for($i=0; $file=sql_fetch_array($result); $i++) {
                            $fileCount++;
                        ?>
						<li class="document_<?=$i?>">
							<div class="area_input">
								<em>추가서류 <?=$i+1?></em>
								<!--<span>-->
								<a href="javascript:void(0);" class="filetxt filetxt_<?=$i?>"><?=$file['img_source']?></a>
								<!--</span>-->
							</div>
						</li>
						<?php
                        }
                        ?>
					</ul>
				</div>
				<!--
                <div class="regi_info v2">
                    <p>추가 서류 제출 <br> 주민번호 뒷자리는 가리고 제출해 주세요.</p>
                    <em>관리자에게만 공개됩니다.</em>
                    <ul>
                        <li>- 등본</li>
                        <li>- 본인의 수입원을 증명할 수 있는 증명서</li>
                        <li>- 최종학력 증명서, 현재 학생이면 재학증명서</li>
                        <li>- 기타 다른 스펙을 증명할 수 있는 증명서</li>
                        <?php if($member['mb_join_type'] == '장애인') { ?>
                        <li>- 장애등급표</li>
                        <?php } ?>
                    </ul>
                </div>
-->
			</div>
		</form>
	</div>
	<!--in-->

	<!--저장 부분-->
	<div class="f_arr cf">
		<div class="arr">
			<span><a href="#" onclick="save('my_profile05.php');"><i class="fal fa-angle-left"></i> 이전</a></span>
			<!--            <span><a href="#" onclick="save('my_profile05.php');">다음 <i class="fal fa-angle-right"></i></a></span>-->
			<!--첫단계에서는 "다음"만 나오도록--->
		</div>
		<div class="save"><a href="#" onclick="save('my_profile_end.php');">저 장</a></div>
	</div>

</div>
<!--my_profile-->

<script>
	$('#myModaregister').modal('show');
	// ** 추가 서류 등록 **
	//var filesTempArr = new Array();
	var filesArr = new Array();
	var count = <?php echo $fileCount == 0 ? 0 : $fileCount; ?>;
	$(function() {
		// 추가서류 파일 추가
		$("#document").change(function(index) {


			if ($(this).val() != "") {
				for (var i = 0; i < this.files.length; i++) {
					// 추가서류 파일업로드
					var form = $('form')[0];
					var formData = new FormData(form);

					// 최대용량 체크
					var max_size_mb = 10, // 10mb
						max_byte = max_size_mb * 1024 * 1024,
						file_byte = this.files[i].size;

					if (file_byte > max_byte) {
						swal("최대 용량 10mb를 초과합니다.");
						$('#document').val('');
						return false;
					}

					var fileValue = $(this).val().split("\\");
					// var fileName = fileValue[fileValue.length - 1]; // 파일명
					var fileName = this.files[i].name // 파일명

					var html = '<li class="document_' + count + '">';
					html += '<div class="area_input">';
					html += '<em>추가서류 ' + (count + 1) + '</em>';
					html += '<span>';
					html += '<a href="javascript:void(0);" class="filetxt filetxt_' + count + '">' + fileName + '</a>';
					//html += '<input type="hidden" name="fi_name[]" value='+fileName+'>';
					html += '<button type="button" class="btn_close" id="btn_file_del_' + count + '" onclick="file_del(' + count + ');">삭제</button>';
					html += '</span>';
					html += '</div>';
					html += '</li>';
					$('.document_list').append(html);

					formData.append("document", this.files[i]);
					formData.append("add_file_mode", "r");
					$.ajax({
						url: './ajax.add_file_upload.php',
						processData: false,
						contentType: false,
						type: 'post',
						data: formData,
						async: false,
						success: function(data) {
							console.log(data);
							$('#btn_file_del_' + count).attr('onclick', 'file_del("' + count + '", "' + data + '")');
						},
					});

					count++;

				}

				//filesTempArr.push(this.files[0]);


			}
		});
	});

	// 추가서류 등록
	function file_add() {
		$("#document").click();
	}

	// 추가서류 삭제 (인덱스, 구분(등록/수정))
	function file_del(index, idx) {
		$('.document_' + index).remove();
		filesArr[index] = '';

		if (idx != '' && idx != undefined) {
			$.ajax({
				url: './ajax.add_file_upload.php',
				type: 'post',
				data: {
					add_file_mode: 'd',
					file_idx: idx
				},
				success: function(data) {},
			});
		}
	}

	// 저장
	function save(page) {
		$('#page').val(page);



		$('form')[0].submit();
	}

</script>
