<?
include_once('./_common.php');

$g5['title'] = '지원하기';
include_once('./_head.php');
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<?php include_once('./category_modal.php'); ?>

<style>
	#ft_menu{display:none;}
</style>

    <form id="fresume" name="fresume" method="post" enctype="multipart/form-data">
    <input type="hidden" name="recruit_idx" value="<?=$idx?>">
    <input type="hidden" name="w" value="">
    <div id="area_help" class="company_write">
        <div class="inr v3">
            <h2 class="title">지원하기</h2>
			
            <div id="company_write" class="career">
                <ul class="box_list">
                    <li class="addinput">
                        <em>제목</em>
                        <div class="area_box">
							<div class="input_wrap">
								<input type="text" class="input_subject" id="re_subject" name="re_subject" value="<?=$row['re_subject']?>" placeholder="제목을 입력하세요.">
							</div>
						</div>
                    </li>                   
                    <li>
                        <em>지원정보</em>
                        <div class="area_box">
							<!-- 회원가입시 등록한 정보 불러오기 -->
                            <ul class="area_box col03">
								<li>
									<span>이름</span>
									<input type="text" id="re_name" name="re_name" value="<?=$w == '' ? $member['mb_name'] : $row['re_name']?>">
								</li>
								<li>
									<span>연락처</span>
									<input type="text" id="re_hp" name="re_hp" value="<?=$w == '' ? $member['mb_hp'] : $row['re_hp']?>" minlength="10" maxlength="13">
								</li>
								<li>
									<span>이메일</span>
									<input type="text" id="re_email" name="re_email" value="<?=$w == '' ? $member['mb_email'] : $row['re_email']?>">
								</li>
							</ul>
                        </div>
                    </li>
					<li>
                        <em>이력서 첨부</em>
						<div class="area_box">	
							<!-- 첨부파일 영역-->
                           <ul id="file_list" class="file_list">
                                <?php
                                $filecount = sql_fetch(" select count(*) as count from g5_resume_file where resume_idx = {$idx}; ")['count'];
                                if($filecount > 0) {
                                    $file_sql = " select * from g5_resume_file where resume_idx = {$idx} order by idx; ";
                                    $file_result = sql_query($file_sql);

                                    for($i=0; $row=sql_fetch_array($file_result); $i++) {
                                    ?>
                                    <li class="file_<?=$i?>">
                                        <span class="fileName"><a href="<?=G5_DATA_URL?>/file/resume/<?=$row['img_file']?>" target="_blank"><?=$row['img_source']?></a></span><button type="button" class="btn_delete" onclick="file_delete(<?=$i?>);"></button>
                                        <input type="hidden" id="file_idx_<?=$i?>" name="file_idx_<?=$i?>" value="<?=$row['idx']?>">
                                    </li>
                                    <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div id="fileDrag" class="img_wrap btn_upload">
                                <input type="file" name="file" id="file" onchange="file_select(this);" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                                <div class="area_txt" onclick="file_add();">
                                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/icon_upload.svg"></div>
                                    <span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
                                    <span class="m">파일을 추가해주세요.</span>
                                </div>
                            </div>
                            <em>※PDF, JPG, DOC, DOCX, 업로드 제한 용량 10mb</em>
						</div>
					</li>
                </ul>
            </div>

            <div class="area_btn one">
                <ul class="btn_list">
                    <li><button type="button" class="btn_confirm fixed" onclick="resume_update();">지원하기</button></li>
				</ul>
            </div>
        </div>
    </div>
    </form>

<script>
    var fileList = []; // 파일 정보를 담아둘 배열
    var file_count = '<?=$filecount?>' == 0 ? 0 : '<?=$filecount?>';
    $(function() {
        // 파일 드래그 앤 드롭
        $("#fileDrag").on("dragenter", function(e){
            e.preventDefault();
            e.stopPropagation();
        }).on("dragover", function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).css("background-color", "#FFD8D8");
        }).on("dragleave", function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).css("background-color", "#FFF");
        }).on("drop", function(e){
            e.preventDefault();

            var files = e.originalEvent.dataTransfer.files;
            if(files != null && files != undefined){
                var tag = "";
                for(var i=0; i<files.length; i++){
                    var f = files[i];

                    var fileName = f.name;
                    var reg_ext = /(.*?)\.(pdf|jpg|doc|docx)$/;
                    if (!reg_ext.test(fileName)) {
                        swal("확장자를 확인해 주세요.\n사용 가능 확장자 : PDF/JPG/DOC/DOCX");
                        $(this).css("background-color", "#FFF");
                        return false;
                    }

                    var fileSize = f.size;
                    var maxSize = 10 * 1024 * 1024; // 최대 10MB
                    if(fileSize > maxSize) {
                        swal('파일이 최대 용량 10MB를 초과합니다.');
                        $(this).css("background-color", "#FFF");
                        return false;
                    }

                    fileList.push(f);

                    tag += '<li class="file_'+file_count+'">' +
                        '<span class="fileName"><a href="javascript:void(0);">'+fileName+'</a></span><button type="button" class="btn_delete" onclick="file_delete('+file_count+');"></button>' +
                        '</li>';

                    // 파일 새창 미리보기
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.file_'+(file_count-1)+' a').attr('onclick', 'file_show(\''+e.target.result+'\')');
                    }
                    reader.readAsDataURL(f);

                    file_count++;
                }
                // $(this).append(tag);
                $('#file_list').append(tag);
            }

            $(this).css("background-color", "#FFF");
        });
    });

    // 파일 삭제
    var delFileIdx = '';
    function file_delete(num) {
        delFileIdx += $('#file_idx_'+num).val() + ',';
        $('.file_'+num).remove();
    }

    // 파일 업로드
    function file_add() {
        $("#file").click();
    }

    // 파일 선택
    function file_select(input) {
        if (input.files && input.files[0]) {
            var files = input.files;
            var files_arr = Array.prototype.slice.call(files);

            var tag = "";
            for (var i = 0; i<input.files.length; i++) {
                var f = files_arr[i];

                var fileName = f.name;
                var reg_ext = /(.*?)\.(pdf|jpg|doc|docx)$/;
                if (!reg_ext.test(fileName)) {
                    swal("확장자를 확인해 주세요.\n사용 가능 확장자 : PDF/JPG/DOC/DOCX");
                    $(this).css("background-color", "#FFF");
                    return false;
                }

                var fileSize = f.size;
                var maxSize = 10 * 1024 * 1024; // 최대 10MB
                if(fileSize > maxSize) {
                    swal('파일이 최대 용량 10MB를 초과합니다.');
                    $(this).css("background-color", "#FFF");
                    return false;
                }

                fileList.push(f);

                tag += '<li class="file_'+file_count+'">' +
                    '<span class="fileName"><a href="javascript:void(0);">'+fileName+'</a></span><button type="button" class="btn_delete" onclick="file_delete('+file_count+');"></button>' +
                    '</li>';


                // 파일 새창 미리보기
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.file_'+(file_count-1)+' a').attr('onclick', 'file_show(\''+e.target.result+'\')');
                }
                reader.readAsDataURL(f);

                file_count++;
            }

            $('#file_list').append(tag);
        }
    }

    // 파일 새창 미리보기 (등록 시 사용)
    function file_show(src) {
        var win = window.open('','');
        win.document.write('<body style="margin: 0px !important;"><iframe width="100%;" height="100%" style="border: none !important;" src="'+src+'"></body>');
    }

    var is_post = false; // 중복 submit 체크
    function resume_update() {
        if(is_post) {
            return false;
        }
        is_post = true;

        if($.trim($('#re_subject').val()) == '') {
            swal('제목을 입력해 주세요.');
            is_post = false;
            return false;
        }
        if($.trim($('#re_name').val()).length == 0) {
            swal('이름을 입력해 주세요.');
            is_post = false;
            return false;
        }
        if($.trim($('#re_hp').val()).length == 0) {
            swal('연락처를 입력해 주세요.');
            is_post = false;
            return false;
        }
        if($.trim($('#re_email').val()).length == 0) {
            swal('이메일을 입력해 주세요.');
            is_post = false;
            return false;
        }
        if($('#file_list li').length == 0) {
            swal('이력서를 첨부해 주세요.');
            is_post = false;
            return false;
        }

        $('#del_file_idx').val(delFileIdx.slice(0,-1)); // 의뢰 상세 자료 삭제 (파일 삭제)

        var form = $('#fresume')[0];
        var formData = new FormData(form);
        if(fileList.length > 0){ // 의뢰 상세 자료 업르도 (파일 업로드)
            fileList.forEach(function(f){
                formData.append("files[]", f);
            });
        }

        $.ajax({
            url : g5_bbs_url + "/ajax.resume_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                console.log(data);
                if(data == 'success') {
                    swal('지원이 완료되었습니다.')
                    .then(()=>{
                        location.replace(g5_bbs_url+'/career_view.php?idx=<?=$idx?>');
                    });
                }
            },
            err : function(err) {
                swal(err.status);
            }
        });
    }

    $("#re_hp").keydown(function (event) {
        var key = event.charCode || event.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 8) {
                $text.val($text.val() + '-');
            }
        }

        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });
</script>

<?
include_once('./_tail.php');
?>