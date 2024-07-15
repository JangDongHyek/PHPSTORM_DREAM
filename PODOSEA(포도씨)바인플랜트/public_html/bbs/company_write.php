<?
include_once('./_common.php');

$g5['title'] = '기업의뢰';
include_once('./_head.php');

if(!$is_member) {
    alert('로그인 후 이용해 주세요.', G5_BBS_URL.'/login.php');
}

// 기업의뢰 정보
$ci = sql_fetch(" select * from g5_company_inquiry where idx = {$idx} ");

$msg = '등록';
if($w == 'u') {
    if($ci['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
        alert('올바른 경로가 아닙니다.');
    }
    $msg = '수정';
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<?php include_once('./category_modal.php'); ?>

<style>
	#ft_menu{display:none;}
</style>

<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="podoCS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.href='<?=G5_BBS_URL?>/company_list.php';"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">의뢰완료</h4>
                </div>
                <div class="modal-body">
					<div class="txt">
						<h3>포도씨로 의뢰 요청이 성공적으로 접수되었습니다.</h3>
						<span>
						의뢰하신 내용은 별도로 관리되오며, <br>
						내용 검토후 적합한 기업회원을 추천드리겠습니다. <br>
						의뢰자께서 추천드린 업체를 승인하시면, <br>
						의뢰 내용이 전달 됩니다.
						</span>
                        <br>
                        <a href="<?=G5_BBS_URL?>/company_list.php">확인</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->

<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade v2" id="cateModal02" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Category</h4>
                </div>
                <div class="modal-body">
					<ul id="sort_list" class="cate_list">
						<li><span>Engine</span></li>
						<li><span>Auxiliary Machinery</span></li>
						<li><span>Valve, Filter/Strainer, Pipe Fittings</span></li>
						<li><span>Propulsion System And Rudder System</span></li>
						<li><span>HVAC, Refrigeration System</span></li>
						<li><span>Electrical Equipment and Automation</span></li>
						<li><span>Communication and Navigation Equipment</span></li>
						<li><span>Deck Machinery & Cargo Hold Hatch Cover</span></li>
						<li><span>Fire Fighting/Life-Saving and Personal Safety/Protection</span></li>
						<li><span>Measuring Meter/Instrument/Special Tool</span></li>
						<li><span>Galley Equipment/Laundry Equipment/Sanitory Unit</span></li>
						<li><span>Ship Chandler</span></li>
						<li><span>New Building & Conversion</span></li>
						<li><span>Maintenance & Repair Services</span></li>
						<li><span>Other Service & Products</span></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->

<form id="fcompanywrite" name="fcompanywrite" method="post" enctype="multipart/form-data">
    <input type="hidden" id="idx" name="idx" value="<?=$idx?>">
    <input type="hidden" id="w" name="w" value="<?=$w?>">
    <input type="hidden" id="del_file_idx" name="del_file_idx">
    <input type="hidden" id="podosea" name="podosea" value="<?=$podosea?>">
    <input type="hidden" id="target_mb_no" name="target_mb_no" value="<?=$target?>">
    <div id="area_help" class="company_write">
        <div class="inr v3">
            <h2 class="title">기업의뢰하기 <?php echo !empty($podosea) ? '<span style="font-size: 14px;color: #3568da;">(포도씨로 의뢰)</span>' : ''; ?></h2>
            <div id="company_write">
                <ul class="box_list">
                    <li>
                        <em>의뢰유형</em>
                        <ul class="area_filter">
                            <li>
                                <input type="checkbox" id="ci_type1" <?php echo $w == '' ? 'checked' : '' ?> name="ci_type" value="서비스" <?php echo $ci['ci_type'] == '서비스' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
                                <label for="ci_type1">
                                    <span></span>
                                    <em>서비스</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="ci_type2" name="ci_type" value="부품" <?php echo $ci['ci_type'] == '부품' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
                                <label for="ci_type2">
                                    <span></span>
                                    <em>부품</em>
                                </label>
                            </li>
                             <li>
                                <input type="checkbox" id="ci_type3" name="ci_type" value="선용품" <?php echo $ci['ci_type'] == '선용품' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
                                <label for="ci_type3">
                                    <span></span>
                                    <em>선용품</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="ci_type4" name="ci_type" value="기타" <?php echo $ci['ci_type'] == '기타' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
                                <label for="ci_type4">
                                    <span></span>
                                    <em>기타</em>
                                </label>
                            </li>
                          </ul>
                    </li>
                    <li>
                        <em>의뢰 기본 정보</em>
                        <ul class="area_box">
                            <li>
                                <span>Vessel name</span>
                                <input type="text" id="ci_vessel" name="ci_vessel" value="<?=$ci['ci_vessel']?>">
                            </li>
                            <li>
                                <span>IMO No.</span>
                                <input type="text" id="ci_imo_no" name="ci_imo_no" value="<?=$ci['ci_imo_no']?>">
                            </li>
                        </ul>
                        <ul class="area_box last">
                            <li class="subject">
                                <span>Subject (의뢰 제목)<i class="red">*필수</i></span>
                                <input type="text" id="ci_subject" name="ci_subject" value="<?=$ci['ci_subject']?>">
                            </li>
                            <li>
                                <span>견적기한<i class="red">*필수</i></span>
                                <input type="date" class="input_date" id="ci_deadline_date" name="ci_deadline_date" value="<?=$ci['ci_deadline_date']?>" onchange="deadlinkChk(this.value);">
                            </li>
                        </ul>
                        <div class="table_wrap">
                            <table class="table v1 scroll">
                                <caption>지원내용</caption>
                                <colgroup>
                                    <col style="width:25%"/>
                                    <col style="width:25%"/>
                                    <col style="width:25%"/>
                                    <col style="width:25%"/>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>*Category</th>
                                        <th>Maker (제조사)</th>
                                        <th>Model</th>
                                        <th>Serial No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="mbox_cate">
                                            <span class="select" data-toggle="modal" data-target="#cateModal02">SELECT</span>
                                        </td>
                                        <input type="hidden" id="ci_category" name="ci_category" value="<?=$ci['ci_category']?>">
                                        <td><input type="text" id="ci_maker" name="ci_maker" value="<?=$ci['ci_maker']?>"></td>
                                        <td><input type="text" id="ci_model" name="ci_model" value="<?=$ci['ci_model']?>"></td>
                                        <td><input type="text" id="ci_serial_no" name="ci_serial_no" value="<?=$ci['ci_serial_no']?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
                    <li>
                        <em>의뢰 내용</em>
                        <div class="area_box">
                            <span>Message to Supplier</span>
                            <textarea id="ci_contents" name="ci_contents" placeholder="의뢰하고자 하는 프로젝트의 내용을 간략하게 입력해 주세요"><?=$ci['ci_contents']?></textarea>
                        </div>
                    </li>
                    <li>
                        <em>의뢰 상세 자료</em>
                        <div class="area_box">
							<ul id="file_list" class="file_list">
                            <?php
                            $filecount = sql_fetch(" select count(*) as count from g5_company_inquiry_img where company_inquiry_idx = {$idx}; ")['count'];
                            if($filecount > 0) {
                                $file_sql = " select * from g5_company_inquiry_img where company_inquiry_idx = {$idx} order by idx; ";
                                $file_result = sql_query($file_sql);

                                for($i=0; $row=sql_fetch_array($file_result); $i++) {
                                ?>
                                <li class="file_<?=$i?>">
                                    <span class="fileName"><a href="<?=G5_DATA_URL?>/file/company_inquiry/<?=$row['img_file']?>" target="_blank"><?=$row['img_source']?></a></span><button type="button" class="btn_delete" onclick="file_delete(<?=$i?>);"></button>
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
                            <em>※의뢰 내용과 관련된 상세 Inquiry Sheet, 사진 및 도면 자료등을 첨부하세요, (PDF, JPG, DOC, DOCX 업로드 제한 용량 10mb)</em>
                        </div>
                    </li>
                </ul>
            </div>

            <!--자료 공개 여부-->
            <div class="w_filter">
                <h3>자료 공개 여부 선택</h3>
                <ul class="area_filter">
                    <li>
                        <input type="checkbox" id="open" <?php echo $w == '' ? 'checked' : '' ?> name="ci_open" value="open" <?php echo $ci['ci_open'] == 'open' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
                        <label for="open">
                            <span></span>
                            <em>전체공개</em>
                        </label>
                    </li>
                    <?php if(empty($podosea)) { // 포도씨에 직접의뢰 한 건은 선택공개 X (임의)?>
                    <li>
                        <input type="checkbox" id="private" name="ci_open" value="private" <?php echo $ci['ci_open'] == 'private' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
                        <label for="private">
                            <span></span>
                            <em>선택공개<i>?</i>
                                <div class="area_info">
                                    <p>선택공개시 상세 자료는 의뢰 회사의 승인을 얻은 업체에게만 공개됩니다.</p>
                                </div>
                            </em>
                        </label>
                    </li>
                    <?php } ?>
					<div class="data_password" <?php echo $ci['ci_open'] == 'open' || empty($ci['ci_open']) ? 'style="display: none;"' : ''; ?>><span>비밀번호</span><input type="text" name="ci_password" id="ci_password" value="<?=$ci['ci_password']?>"></div>
                </ul>

            </div>

            <!--BUDGET-->
            <div class="w_filter">
                <h3>BUDGET<em>*선택</em></h3>
                <div class="area_box">
                    <select id="ci_budget" name="ci_budget">
                        <option value="">예산을 선택하세요.</option>
                        <?php for ($i=1; $i<=count($company_budget); $i++) { ?>
                        <option value='<?=$i?>' <?php echo $ci['ci_budget'] == $i ? 'selected' : ''; ?>><?=$company_budget[$i]?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!--Delivery To-->
            <div class="w_filter">
                <h3>Delivery To<em>*선택</em></h3>
                <div class="area_box">
                    <input type="text" id="ci_delivery_to" name="ci_delivery_to" value="<?=$ci['ci_delivery_to']?>" placeholder="ex)부산">
                </div>
            </div>

            <div class="area_btn v2 two">
                <ul class="btn_list">
                    <li><button type="button" class="btn_cancle" onclick="history.back();">취소하기</button></li>
                    <li><button type="button" class="btn_confirm" onclick="company_write_update();" ><?=$w=='u'?'수정':'의뢰';?>하기</button></li>
                </ul>
            </div>
        </div>
    </div>
</form>

<script>
var fileList = []; // 파일 정보를 담아둘 배열
var file_count = '<?=$filecount?>' == 0 ? 0 : '<?=$filecount?>';
$(function(){
	$('.area_filter > li label em i').on('click',function(){
		$(this).toggleClass('active');
		$('.area_filter .area_info').toggleClass('active');
		return false;
	});

    // Category
    $(".cate_list li").click(function () {
        click_event('cate_list', $(this), 'active', 'ci_category');

        var add_text = '';
        if($(this)[0]['innerText'] == '전체') { add_text += '<i></i>'; }
        $('.mbox_cate span').html(add_text + $(this)[0]['innerText'])
        $('#cateModal02').modal('hide');
    });

    // 수정
    if('<?=$idx?>' != "") {
        // Category
        $('.mbox_cate span').text("<?=$ci['ci_category']?>");
        $('li:contains("<?=$ci['ci_category']?>")').addClass('active');
    }

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
                // tag +=
                //     "<div class='fileList file_"+file_count+"'>" +
                //     "<span class='fileName'>"+fileName+"</span>" +
                //     "<button type='button' class='delete' onclick='file_delete("+file_count+");'>X</button>" +
                //     "</div>";

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

// 클릭 이벤트(이벤트 적용할 영역(class), 선택 데이터, 이벤트 표시(class), formdata name)
function click_event(object, element, class_name, column) {
    $('.' + object + ' li').removeClass(class_name);
    element.addClass(class_name);
    $('#' + column).val(element[0]['innerText']);
}

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
                // files.splice(i);
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

// 의뢰하기
var is_post = false; // 중복 submit 체크
function company_write_update() {
    if(is_post) {
        return false;
    }
    is_post = true;

    if($.trim($('#ci_subject').val()) == 0) {
        swal('의뢰 제목을 입력해 주세요.');
        is_post = false;
        return false;
    }
    if($('#ci_deadline_date').val() == '') {
        swal('견적기한을 입력해 주세요.');
        is_post = false;
        return false;
    }
    if($('#ci_category').val() == '') {
        swal('Category를 선택해 주세요.');
        is_post = false;
        return false;
    }

    var open = $('input:checkbox[name="ci_open"]:checked').val(); // 자료 공개 여부
    if(open == 'private') {
        if($.trim($('#ci_password').val()) == '') {
            swal('비밀번호를 입력하세요.');
            is_post = false;
            return false;
        }
    }

    $('#del_file_idx').val(delFileIdx.slice(0,-1)); // 의뢰 상세 자료 삭제 (파일 삭제)

    var form = $('#fcompanywrite')[0];
    var formData = new FormData(form);
    if(fileList.length > 0){ // 의뢰 상세 자료 업르도 (파일 업로드)
        fileList.forEach(function(f){
            formData.append("files[]", f);
        });
    }

    $.ajax({
        url : g5_bbs_url + "/ajax.company_write_update.php",
        processData: false,
        contentType: false,
        data: formData,
        type: 'POST',
        success : function(data) {
            if(data == 'success') {
                if($('#w').val() == '') {
                    swal('의뢰가 등록되었습니다.')
                    .then(()=>{
                        if($('#podosea').val() == 'Y') {
                            $('#podoCS').modal('show');
                        } else {
                            location.replace(g5_bbs_url+'/company_list.php');
                        }
                    });
                }
                else {
                    swal('의뢰가 수정되었습니다.')
                    .then(()=>{
                        location.replace(g5_bbs_url+'/company_view.php?idx=<?=$idx?>');
                    });
                }
            }
        },
        err : function(err) {
            swal(err.status);
        }
    });
}

$('#podoCS').on('hidden.bs.modal', function () {
    location.replace(g5_bbs_url+'/company_list.php');
});

// 견적기한 체크 (작성일 이전 일자는 선택 불가)
function deadlinkChk(date) {
    if(date < '<?=date('Y-m-d')?>') {
        swal('견적기한을 다시 선택해 주세요.');
        $('#ci_deadline_date').val('');
        return false;
    }
}
</script>

<?
include_once('./_tail.php');
?>