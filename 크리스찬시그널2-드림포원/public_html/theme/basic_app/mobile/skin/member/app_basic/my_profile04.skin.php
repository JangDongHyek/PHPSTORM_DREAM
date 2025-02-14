<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
$mb = get_member($_REQUEST["mb_id"]);
?>

<style>
    .btn_del{position:absolute; background:rgba(0,0,0,0.5); width:18px; height:18px; line-height:18px; border:0; border-radius:50%; right:-3px; top:-4px; color:#fff; font-size:0.8em; z-index:10;}
    /*로딩바*/
    #mask { position:fixed; z-index:9000; background-color:#000000; display:none; left:0; top:0; }
    #loadingImg { position:fixed; left:50%; top:50%; display:none; z-index:10000;transform: translate(-50%, -50%); }
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
	.mbskin{
		padding-bottom: 100px;
	}
	.mbskin .title_top{
		margin-top: 50px;
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
					<h3><span class="color">나의 사진</span>를 입력하세요</h3>
					<p>
						상대방에게 <span class="bold">필수유료</span>로 공개되는 내용입니다.<br>
						빠짐없이 꼼꼼하게 입력해주세요<br><br>
						<span class="color02">
							얼굴이 자세히 나온 사진을<br>등록해주세요
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

<div class="mbskin" id="my_profile">
    <!--상단카테고리-->
    <?php include_once("./my_profile_head.php") ?>


    <!--작성 폼 시작-->
    <div class="in">
    
    
	<h2 class="title_top">
		<span class="point">나의 사진</span>를 등록하세요
	</h2>
	<div class="regi_info">
		<p>상대방에게 <strong class="point">필수유료</strong>로 공개되는 내용입니다.</p>
		<!--	<p>유료로 열람가능합니다. 마음에 드시는 분은 찜목록으로 이동가능 합니다.</p>-->

		<span>얼굴이 자세히 나온 사진을 등록해주세요</span>
				
	</div>
       
       
        <form id="fprofile1" name="fprofile1" action="./ajax.controller.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="mode" value="my_profile04">
            <input type="hidden" name="page" id="page" value="">
            <input type="hidden" name="mb_id" value="<?=$mb_id?>">
            <input type="hidden" name="mb_no" value="<?=$mb['mb_no']?>">
            <input type="hidden" name="del_mb_img" value="">

            <div class="form-group cf">
                <h3 class="title">프로필 사진등록<strong class="comm">얼굴이 명확히 보이는<br> <span class="point">정면사진 2장</span>과 <span class="point">전신사진 1장</span> 필수</strong></h3>
                <div class="photo">
                    <label for="mb_img0" class="lb_mb_img0">
                        <span class="ico mb_img0"><i class="fas fa-camera"></i></span>
                        <div id="prev">
                        <input type="file" id="mb_img0" name="" multiple onchange="getImgPrev(this)" accept="image/*">
                        </div>
                    </label>
<!--                    <strong class="main_photo">대표사진</strong>-->
                </div>
                <span id="file_div">
                    <?php for ($i = 0; $file = sql_fetch_array($file_reuslt); $i++){ ?>
                        <div class="photo div_box<?=($i+1)?>">
                            <label for="mb_img2" class="lb_mb_img<?=($i+1)?>">
                                <span class="ico mb_img<?=($i+1)?>"><i class="fas fa-camera"></i></span>
                                <div id="prev_<?=($i+1)?>">
                                    <input type="hidden" id="img_idx_<?=($i+1)?>" name="img_idx_<?=($i+1)?>" value="<?=$file['idx']?>">
                                    <button type="button" class="btn_del" onclick="mbImgDel('u', '<?=($i+1)?>');"><i class="fas fa-times"></i></button>
                                    <span class="img_bd" style="margin-right: 10px;">
                                        <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file['img_file']?>" width="78px" height="80px" />
                                    </span>
                                </div>
                            </label>

                        </div>
                    <?php } ?>
                </span>

                <?php /*
                <div class="photo">
                    <label for="mb_img2" class="lb_mb_img2">
                        <span class="ico mb_img2 <?=$hide2?>"><i class="fas fa-camera"></i></span>
                        <div id="prev_2">
                        <?php if(isset($file2['img_file'])) { ?>
                            <input type="hidden" id="img_idx_2" name="img_idx_2" value="<?=$file2['idx']?>">
                            <button type="button" class="btn_del" onclick="mbImgDel('u', '2');"><i class="fas fa-times"></i></button>
                            <span class="img_bd" style="margin-right: 10px;">
                                <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file2['img_file']?>" width="78px" height="80px" />
                            </span>
                        <?php } ?>
                        </div>
                    </label>
                    <?php if(!isset($file2['img_file'])) { ?>
                        <input type="file" id="mb_img2" name="mb_img[]" onchange="getImgPrev(this)" accept="image/*">
                    <?php } ?>
                </div>
                <div class="photo">
                    <label for="mb_img3" class="lb_mb_img3">
                        <span class="ico mb_img3 <?=$hide3?>"><i class="fas fa-camera"></i></span>
                        <div id="prev_3">
                        <?php if(isset($file3['img_file'])) { ?>
                            <input type="hidden" id="img_idx_3" name="img_idx_3" value="<?=$file3['idx']?>">
                            <button type="button" class="btn_del" onclick="mbImgDel('u', '3');"><i class="fas fa-times"></i></button>
                            <span class="img_bd" style="margin-right: 10px;">
                                <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file3['img_file']?>" width="78px" height="80px" />
                            </span>
                        <?php } ?>
                        </div>
                        <?php if(!isset($file3['img_file'])) { ?>
                        <input type="file" id="mb_img3" name="mb_img[]" onchange="getImgPrev(this)" accept="image/*">
                        <?php } ?>
                    </label>
                </div>
                <div class="photo">
                    <label for="mb_img4" class="lb_mb_img4">
                        <span class="ico mb_img4 <?=$hide4?>"><i class="fas fa-camera"></i></span>
                        <div id="prev_4">
                        <?php if(isset($file4['img_file'])) { ?>
                            <input type="hidden" id="img_idx_4" name="img_idx_4" value="<?=$file4['idx']?>">
                            <button type="button" class="btn_del" onclick="mbImgDel('u', '4');"><i class="fas fa-times"></i></button>
                            <span class="img_bd" style="margin-right: 10px;">
                                <img src="<?php echo G5_DATA_URL; ?>/file/member/<?=$file4['img_file']?>" width="78px" height="80px" />
                            </span>
                        <?php } ?>
                        </div>
                        <?php if(!isset($file4['img_file'])) { ?>
                        <input type="file" id="mb_img4" name="mb_img[]" onchange="getImgPrev(this)" accept="image/*">
                        <?php } ?>
                    </label>
                </div>
 */?>
                <div class="sample"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/sample.png"/></div>
				<div class="regi_info v2">
					<p>사진은 최대한 이쁘고 멋있게 찍어서 올려주세요. 사진으로 데이트 신청이 있느냐 없느냐가 결정됩니다.</p>
					<em>사진 컷 기본 총 3장</em>
					<ul>
						<li>- 얼굴정면 2장</li> 
						<li>- 전신 1장</li>
						<li>- 마스크 사진, 다른사람과 찍은 사진 불가</li>
					</ul>	
					<ul>
					</ul>
				</div>
            </div><!--form-group photo-->
        </form>
    </div><!--in-->

    <!--저장 부분-->
    <div class="f_arr cf">
        <div class="arr">
            <!--<span><a href="#"><i class="fal fa-angle-left"></i> 이전</a></span>-->
            <span><a href="#" onclick="save('my_profile03.php');">다음 <i class="fal fa-angle-right"></i></a></span><!--첫단계에서는 "다음"만 나오도록--->
        </div>
    </div>

</div><!--my_profile-->

<script>
	$('#myModaregister').modal('show');	
    var filesTempArr = [];

    //이미지 div삭제 시 필요
    var num = <?=$num?>;
    //파일 인덱스
    var file_index = 0;

    // 파일업로드 미리보기
    function getImgPrev(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png|bmp|JPG|JPEG|PNG)$/;
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);

        if (!reg_ext.test(input.files[0].name)) {
            swal("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp)");
            return false;
        }

        // 최대용량 체크
        var	max_size_mb = 10, //5mb
            max_byte = max_size_mb * 1024 * 1024,
            file_byte = input.files[0].size;

        if (file_byte > max_byte) {
            swal("최대 용량 (" + max_size_mb + "mb)을 초과합니다.");
            $("#mb_img").val("");
            return false;
        }

        // if(input.files.length > 4 || $('div[class=photo]').length == 4 == 4) {
        //     swal('최대 4개까지 등록가능합니다.');
        //     $("#mb_img").val("");
        //     return false;
        // }
        for (var i = 0; i<input.files.length; i++) {
            var index = input.id.substr(-1, 1);

            filesTempArr.push(files_arr[i]);
            // 미리보기
            if (input.files && input.files[i]) {

                var reader = new FileReader();
                reader.onload = function (e) {
                    num++;

                    var src = e.target.result;
                    var html = '';
                    html += '<div class="photo div_box' + num + '">\n' +
                    '<label for="mb_img' + num + '" class="mb_img' + num + '">\n' +
                    '<span class="ico mb_img2 "><i class="fas fa-camera"></i></span>\n' +
                    '<div id="prev_' + num + '">';

                    html += '<input type="hidden" value="'+file_index+'" id="img_idx_' + num + '" name="img_idx_' + num + '">';
                    html += '<button type="button" class="btn_del" onclick="mbImgDel(\'w\', \'' + num + '\');"><i class="fas fa-times"></i></button>';
                    html += '<span class="img_bd" style="margin-right: 10px;">';
                    html += '<img src="' + src + '" width="100%" height="80px">';
                    html += '</span>';
                    html += '</div>\n' +
                        '</label>\n'+
                        '</div>';
                        '</div>';

                    // $('.' + input.id).addClass('hide');
                    // $("#prev_"+index).html(html);
                    $("#file_div").append(html);
                    file_index++;
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    // 이미지 삭제
    var del_file_idx = '';
    function mbImgDel(mode, file_idx) {
        // if (confirm("이미지를 삭제하시겠습니까?")) {
        // $("#mb_img_prev").html("");
        if (mode == "u") {
            if($('#img_idx_'+file_idx).val() != '') {
                del_file_idx += $('#img_idx_'+file_idx).val() + ',';
            }
            // document.fmember.del_mb_img.value = "1";
        } else if (mode == "w") {
            delete filesTempArr[$('#img_idx_'+file_idx).val()];
            // $("#mb_img").val("");
            // $("#mb_img").replaceWith($("#mb_img").clone(true));
        }
        console.log(file_idx);
        // $('.mb_img'+file_idx).removeClass('hide');
        // $('#prev_'+file_idx).html('');
        $('.div_box'+file_idx).remove();

        // $('.lb_mb_img'+file_idx).append('<input type="file" id="mb_img'+file_idx+'" name="mb_img[]" onchange="getImgPrev(this)" accept="image/*">');
        // }
    }

    var filesArr = new Array();
    var count = <?php echo $fileCount == 0 ? 0 : $fileCount; ?>;
    var is_post = false;
    function save(page) {
        if(is_post) {
            return false;
        }
        is_post = true;

        $('#page').val(page);
        // 프로필 사진 삭제 체크
        $('input[name=del_mb_img]').val(del_file_idx.slice(0,-1));

        // 정면사진 2장 필수
        var file_count = $('input[id^=img_idx]').length;
        if(file_count < 2) {
            swal('프로필 사진(2장)을 등록하세요.');
            is_post = false;
            return false;
        }

        var form = $('form')[0];
        var formData = new FormData(form);

        // 추가서류
        for(var i=0; i<filesTempArr.length; i++) { // 추가서류 등록
            if(filesTempArr[i] != undefined && filesTempArr[i] != "") {
                formData.append("mb_img[]", filesTempArr[i]);
            }
        }

        $.ajax({
            url : g5_bbs_url + "/ajax.controller.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            async: false,
            success : function(data) {
                if(data) {
                    location.replace(g5_bbs_url + "/" + page + "?mb_id=<?=$mb_id?>");
                }
            },
            beforeSend: function() {
                showLoadingBar();
            },
            error: function() {
                hideLoadingBar();
            }
        });

        // $('#fprofile1').submit();
    }

</script>
