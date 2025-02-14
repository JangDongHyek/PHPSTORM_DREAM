<?php
$profile_href = G5_BBS_URL."/my_profile01.php";
if ($member["mb_approval_request"] == "Y" && $member["mb_approval"] == 'Y'){
    $profile_href = G5_BBS_URL."/mem_view.php?mb_no=".$member["mb_no"];
}
?>

<style>
	.modal-dialog {
		position: absolute;
		width: 90%;
		margin: 10px;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%) !important;
	}
	#basic_modal .modal-content .msg_con{
		padding: 20px 20px 0;
	}
	.modal-body textarea{
		width: 100%;
		border: 1px solid #ccc;
		border-radius: 5px;
		height: 200px;
		padding: 20px;
		line-height: 1.3em;
		font-size: 14px;
		word-break: break-word;
		
	}
	.modal-footer button{
		width: 100%;
		height: 50px;
		line-height: 50px;
		background: #fe8ea6;
		border: none;
		color: #fff;
		font-size: 1.3em;
		letter-spacing: -1px;
	}
</style>
<!-- 메세지 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="profile_com" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">프로필 수정 신청</h4>
                </div>
                <div class="modal-body msg_con">
                    <textarea  width="100%" id="ap_content" placeholder="원하시는 프로필 변경을 입력하시면 관리자가 변경해드립니다."></textarea>
                    <div class="file_wrap">
                    	<p>사진변경과 서류입력 변경 업로드해주세요</p>
                    	<label for="mb_img0" id="mb_img0_label"><i class="fas fa-image"></i></label>
						<input type="file" id="mb_img0" name="" multiple onchange="getImgPrev(this)" accept="image/*">
						<div id="file_div"></div>
                    </div>
                </div>
                <!--msg_con-->
                <div class="modal-footer">
                    <button type="button" id="profile_modal_btn" class="">신청하기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--basic_modal-->
<!-- 메세지 모달팝업 -->

<script>

    var is_post =false
    $('#profile_modal_btn').on('click',function(){
        if(is_post) {
            return false;
        }
        is_post = true;

        var form = $('form')[0];
        var formData = new FormData(form);

        for(var i=0; i<filesTempArr.length; i++) { // 추가서류 등록
            if(filesTempArr[i] != undefined && filesTempArr[i] != "") {
                formData.append("mb_img[]", filesTempArr[i]);
            }
        }

        formData.append("mode", "adm_profile" );
        formData.append("ap_content", $("#ap_content").val() );

        $.ajax({
            url : g5_bbs_url + "/ajax.controller.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            async: false,
            success : function(data) {
                if(data == 1) {
                    swal("프로필 수정신청이 완료되었습니다. 관리자가 확인 후 프로필 변경됩니다.");
                    $("#profile_com").modal("hide");
                    $("#ap_content").val("");
                    $("#file_div").html("");
                    $("#mb_img0").val("");
                }
            },
        });


    })


    //사진
    var filesTempArr = [];

    //이미지 div삭제 시 필요
    var num = 0;
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
            $("#mb_img0").val("");
            return false;
        }


        for (var i = 0; i<input.files.length; i++) {
            var index = input.id.substr(-1, 1);

            filesTempArr.push(files_arr[i]);
            // 미리보기
            if (input.files && input.files[i]) {

                if(input.files.length + $('.photo').length  > 9 ) {
                    swal('최대 8개까지 등록가능합니다.');
                    $("#mb_img").val("");
                    return false;
                }

                var reader = new FileReader();
                reader.onload = function (e) {
                    num++;

                    var src = e.target.result;
                    var html = '';
                    html += '<div class="photo div_box' + num + '">\n' +
                        '<label for="mb_img' + num + '" class="mb_img' + num + '">\n' +
//                        '<span class="ico mb_img2 "><i class="fas fa-camera"></i></span>\n' +
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
                    $(".file_wrap").append(html);
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
</script>