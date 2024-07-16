<?
include_once('./_common.php');

$g5['title'] = '기업의뢰';
include_once('./_head.php');

// 기업의뢰 정보
$ci = sql_fetch(" select * from g5_company_inquiry where idx = {$idx} ");
// 견적 정보
$ce = sql_fetch( " select * from g5_company_estimate where idx = {$ce_idx} ");

$date = $ci['ci_deadline_date']; // 2013-07-14 09:14:00
$todate = date("Y-m-d", time());
$dday = ( strtotime($date) - strtotime($todate) ) / 86400;

if($w == 'u') {
    if($ce['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
        alert('올바른 경로가 아닙니다.');
    }
    if($ce['ce_state'] == '견적검토중') {
        alert('견적검토중 견적입니다.');
    }
    if($ce['ce_state'] == '거래완료') {
        alert('거래완료 견적입니다.');
    }
    if($ce['ce_state'] == '미체결') {
        alert('미체결 견적입니다.');
    }
    if($dday < 0) { // 마감일 지났을 경우 막음
        alert('마감된 의뢰입니다.');
    }
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<?php include_once('./category_modal.php'); ?>

<style>
	#ft_menu{display:none;}
</style>

<form id="festimate" name="festimate" method="post" enctype="multipart/form-data">
    <input type="hidden" id="company_inquiry_idx" name="company_inquiry_idx" value="<?=$ci['idx']?>">
    <input type="hidden" id="w" name="w" value="<?=$w?>">
    <input type="hidden" id="ce_idx" name="ce_idx" value="<?=$ce_idx?>"> <!-- 견적 idx -->
    <input type="hidden" id="del_file_idx" name="del_file_idx">
    <div id="area_help" class="company_write">
        <div class="inr v3">
            <h2 class="title">견적보내기</h2>
			<div id="help_list">
				<ul class="list">						
					<li class="company">
						<a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$ci['idx']?>">
							<div class="title">
								<em><?=$ci['ci_category']?></em><!-- 카테고리 -->
								<h3><?=$ci['ci_subject']?></h3> <!-- 제목 -->
							</div>	
							<div class="cont">
								<ul class="list_text">
									<li><em>Maker</em><span><?=$ci['ci_maker']?></span></li><!-- 제조사 -->
									<li><em>Model</em><span><?=$ci['ci_model']?></span></li><!-- 의뢰국가 -->
									<li class="period"><span><?=$dday?>일 남음</span></li><!-- 견적남은기간 -->
								</ul>						
							</div>								
						</a>
					</li>
				</ul>
			</div>
            <div id="company_write">
                <ul class="box_list">
                    <li class="addinput">
                        <em>견적제안금액</em>
                        <div class="area_box">
							<div class="input_wrap">
								<input type="text" class="input_subject" id="ce_offer_price" value="<?=empty($ce['ce_offer_price']) ? '' : number_format($ce['ce_offer_price'])?>" name="ce_offer_price" placeholder="금액을 입력하세요." onkeyup="comma_number(this);">
								<select id="ce_unit" name="ce_unit">
                                    <option value="원" <?=$ce['ce_unit'] == '원' ? 'selected' : ''; ?>>원</option>
                                    <option value="USD" <?=$ce['ce_unit'] == 'USD' ? 'selected' : ''; ?>>USD</option>
									<option value="EUR" <?=$ce['ce_unit'] == 'EUR' ? 'selected' : ''; ?>>EUR</option>
									<option value="JYP" <?=$ce['ce_unit'] == 'JYP' ? 'selected' : ''; ?>>JYP</option>
									<option value="CNY" <?=$ce['ce_unit'] == 'CNY' ? 'selected' : ''; ?>>CNY</option>
								</select>
							</div>
						</div>
                    </li>                   
                    <li>
                        <em>고객님께 드릴 말씀</em>
                        <div class="area_box">
                            <textarea class="estimate" id="ce_contents" name="ce_contents" placeholder="고객님께 드릴 말씀을 입력해주세요."><?=$ce['ce_contents']?></textarea>
                        </div>
                    </li>
					<li>
                        <em>첨부파일</em>
						<div class="area_box">	
							<!-- 첨부파일 영역-->
                           <ul id="file_list" class="file_list">
                                <?php
                                $filecount = sql_fetch(" select count(*) as count from g5_company_estimate_img where company_estimate_idx = {$ce_idx}; ")['count'];
                                if($filecount > 0) {
                                    $file_sql = " select * from g5_company_estimate_img where company_estimate_idx = {$ce_idx} order by idx; ";
                                    $file_result = sql_query($file_sql);

                                    for($i=0; $row=sql_fetch_array($file_result); $i++) {
                                        ?>
                                        <li class="file_<?=$i?>">
                                            <span class="fileName"><a href="<?=G5_DATA_URL?>/file/company_estimate/<?=$row['img_file']?>" target="_blank"><?=$row['img_source']?></a></span><button type="button" class="btn_delete" onclick="file_delete(<?=$i?>);"></button>
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
                                    <span>마우스로 드래그해서 파일을 추가하세요.</span>
                                </div>
                            </div>
                            <em>※견적 내용과 관련된 상세 Estimate Sheet, 사진 및 도면 자료등을 첨부하세요, (PDF, JPG, DOC, DOCX 업로드 제한 용량 10mb)</em>
						</div>
					</li>
                </ul>
            </div>

            <div class="area_btn two">
                <ul class="btn_list">
                    <li><button type="button" class="btn_cancle" onclick="history.back();">취소하기</button></li>
                    <li><button type="button" class="btn_confirm fixed" onclick="company_estimate_update();">견적 <?=$w=='u'?'수정':'제안';?>하기</button></li>
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
                    var reg_ext = /(.*?)\.(pdf|jpg|doc|docx|JPG|)$/;
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

    // 폼체크
    // var is_post = false;
    // function festimate_check(f) {
    //     if(is_post) {
    //         is_post = false;
    //     }
    //     is_post = true;
    //
    //     if(f.ce_offer_price.value == '') {
    //         swal('견적제안금액을 입력해 주세요.');
    //         is_post = false;
    //         return false;
    //     }
    //
    //     if(f.ce_contents.value == '') {
    //         swal('고객님께 드릴 말씀을 입력해 주세요.');
    //         is_post = false;
    //         return false;
    //     }
    //
    //     return true;
    // }

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
                var reg_ext = /(.*?)\.(pdf|jpg|doc|docx|JPG|)$/;
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
    function company_estimate_update() {
        if(is_post) {
            return false;
        }
        is_post = true;

        if($('#ce_offer_price').val() == '') {
            swal('견적제안금액을 입력해 주세요.');
            is_post = false;
            return false;
        }
        if($.trim($('#ce_contents').val()).length == 0) {
            swal('고객님께 드릴 말씀을 입력해 주세요.');
            is_post = false;
            return false;
        }

        $('#del_file_idx').val(delFileIdx.slice(0,-1)); // 의뢰 상세 자료 삭제 (파일 삭제)

        var form = $('#festimate')[0];
        var formData = new FormData(form);
        if(fileList.length > 0){ // 의뢰 상세 자료 업르도 (파일 업로드)
            fileList.forEach(function(f){
                formData.append("files[]", f);
            });
        }

        $.ajax({
            url : g5_bbs_url + "/ajax.company_estimate_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {
                if(data == 'success') {
                    if($('#w').val() == '') {
                        swal('견적보내기를 완료하였습니다.')
                        .then(()=>{
                            if('<?=$ci['target_mb_no']?>' != 0) { // 특정 기업에게 의뢰 후 의뢰 받은 기업이 견적 보낼 시 완료 후 마이페이지로 이동
                                location.replace(g5_bbs_url+'/mypage_company02.php');
                            } else {
                                location.replace(g5_bbs_url+'/company_list.php');
                            }
                        });
                    }
                    else {
                        swal('견적이 수정되었습니다.')
                        .then(()=>{
                            location.replace(g5_bbs_url+'/mypage_company_detail02.php?idx=<?=$ce_idx?>');
                        });
                    }
                }
            },
            err : function(err) {
                swal(err.status);
            }
        });
    }
</script>

<?
include_once('./_tail.php');
?>