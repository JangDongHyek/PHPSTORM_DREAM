<?
include_once('./_common.php');

$g5['title'] = 'Corporate RFQ';
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
        alert('This is not the right path.');
    }
    if($ce['ce_state'] == 'Quotation Under Review') {
        alert('This is an Quotation Under Review.');
    }
    if($ce['ce_state'] == 'Transaction Complete') {
        alert('This is a transaction complete estimate.');
    }
    if($ce['ce_state'] == 'Agreement Incomplete') {
        alert('This is an outstanding quote.');
    }
    if($dday < 0) { // 마감일 지났을 경우 막음
        alert('This is a closed quote.');
    }
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<?php include_once('./category_modal.php'); ?>

<style>
	#ft_menu{display:none;}
    .bg_gray{background-color: lightgrey;}
    #company_write .box_list > li {padding: 35px 20px !important;}
</style>

<form id="festimate" name="festimate" method="post" enctype="multipart/form-data">
    <input type="hidden" id="company_inquiry_idx" name="company_inquiry_idx" value="<?=$ci['idx']?>">
    <input type="hidden" id="w" name="w" value="<?=$w?>">
    <input type="hidden" id="ce_idx" name="ce_idx" value="<?=$ce_idx?>"> <!-- 견적 idx -->
    <input type="hidden" id="del_file_idx" name="del_file_idx">
    <div id="area_help" class="company_write">
        <div class="inr v3">
            <h2 class="title">Send Quote</h2>
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
									<li class="period"><span><?=$dday?>days left</span></li><!-- 견적남은기간 -->
								</ul>
							</div>
						</a>
					</li>
				</ul>
			</div>
            <div id="company_write">
                <ul class="box_list">
                    <li class="addinput">
                        <em>Quotations Proposal Price</em>
                        <div class="area_box">
							<div style="display: flex; justify-content: space-between; margin-bottom: 15px">
								<input type="text" class="input_subject" name="totalCost" value="<?=empty($ce['total_cost'])?'':number_format($ce['total_cost'])?>" readonly>
								<select id="ce_unit" name="ce_unit">
									<option value="WON" <?=$ce['ce_unit'] == 'WON' ? 'selected' : ''; ?>>WON</option>
									<option value="USD" <?=$ce['ce_unit'] == 'USD' ? 'selected' : ''; ?>>USD</option>
									<option value="EUR" <?=$ce['ce_unit'] == 'EUR' ? 'selected' : ''; ?>>EUR</option>
									<option value="JYP" <?=$ce['ce_unit'] == 'JYP' ? 'selected' : ''; ?>>JYP</option>
									<option value="CNY" <?=$ce['ce_unit'] == 'CNY' ? 'selected' : ''; ?>>CNY</option>
								</select>
							</div>
                            <table class="table v2 scroll">
                                <colgroup>
                                    <col width="1%">
                                    <col width="*">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="5%">
                                    <col width="12%">
                                    <col width="12%">
                                </colgroup>
                                <thead>
                                  <tr>
                                    <th>NO.</th>
                                    <th>DESCRIPTION</th>
                                    <th>REFERENCE</th>
                                    <th>PART NO.</th>
                                    <th>QUANTITY</th>
                                    <th>UoM</th>
                                    <th>QUANTITY<br/>OFFERED</th>
                                    <th>UoM</th>
                                    <th>UNIT COST</th>
                                    <th>LINE COST</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contentRlt = sql_query("SELECT A.*, B.quantity_offered, B.uom AS eUom, B.unit_cost, B.line_cost 
                                                              FROM g5_company_inquiry_content AS A 
                                                              LEFT JOIN g5_company_estimate_content AS B ON A.idx = B.inquiry_content_idx AND B.mb_id = '{$member['mb_id']}'  
                                                              WHERE A.inquiry_idx = '{$idx}'
                                                              ORDER BY A.idx");
                                for ($i=1; $content = sql_fetch_array($contentRlt); $i++) {
                                ?>
                                <tr data-idx="<?=$i?>">
                                    <td>
                                        <?=$i?>
                                        <input type="hidden" name="contentIdx[]" value="<?=$content['idx']?>">
                                        <input type="hidden" name="lineCost[]" value="<?=$content['line_cost']?>">
                                    </td>
                                    <td><span><?=$content['description']?></span></td>
                                    <td><span><?=$content['reference']?></span></td>
                                    <td><span><?=$content['part_no']?></span></td>
                                    <td><span><?=number_format($content['quantity'])?></span></td>
                                    <td><span><?=$content['uom']?></span></td>
                                    <!--TODO: textarea placeholder 가운데정렬 되는지?-->
                                    <td><textarea name="quantityOffered[]" placeholder="ㅡ" onkeyup="this.value=addCommaNumber(this.value);calcEstimate(<?=$i?>)"><?=empty($content['quantity_offered'])?'':number_format($content['quantity_offered'])?></textarea></td>
                                    <td><textarea name="uom[]" placeholder="ㅡ"></textarea><?=$content['eUom']?></td>
                                    <td><textarea name="unitCost[]" placeholder="ㅡ" onkeyup="this.value=addCommaNumber(this.value);calcEstimate(<?=$i?>)"><?=empty($content['unit_cost'])?'':number_format($content['unit_cost'])?></textarea></td>
                                    <td id="lineCostDisplay<?=$i?>" class="lineCost"><?=empty($content['line_cost'])?'':number_format($content['line_cost'])?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="8"></td>
                                    <td>TOTAL COST</td>
                                    <td id="totalCostDisplay"><?= empty($ce['total_cost'])?'':number_format($ce['total_cost']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="7"></td>
                                    <td> VAT</td>
                                    <td width="120px">
                                        <input type="checkbox" id="vat_type1" name="vat" value="Y" <?=(empty($ce['vat_include_yn']) || $ce['vat_include_yn']) == 'Y'? 'checked' : ''?> onclick="checkOnlyOne(this)">
                                        <label for="vat_type1">
                                            <span></span>
                                            <em>INCLUDED</em>
                                        </label>
                                    </td>
                                    <td width="120px">
                                        <input type="checkbox" id="vat_type2" name="vat" value="N" <?=($ce['vat_include_yn']) == 'N'? 'checked' : ''?> onclick="checkOnlyOne(this)">
                                        <label for="vat_type2">
                                            <span></span>
                                            <em>EXCLUDED</em>
                                        </label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
						</div>
                    </li>
                    <li>
                        <em>Valid To</em>
                        <div class="area_box input">
							<input type="text" class="regist-input" id="ce_valid_date" name="ce_valid_date" placeholder="yyyy-mm-dd" value="<?=$ce['ce_valid_date']?>" onchange="inputDateChk(this.value)">
                        </div>
                    </li>
                    <li>
                        <em>Remark</em>
                        <div class="area_box">
                            <textarea class="estimate" id="ce_contents" name="ce_contents" placeholder="Please enter your message."><?=$ce['ce_contents']?></textarea>
                        </div>
                    </li>
					<li>
                        <em>Attachment</em>
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
                                    <span>Add files by dragging with the mouse.</span>
                                </div>
                            </div>
                            <em>※Please attach detailed estimate sheets, photos and drawings related to the quotation, (PDF, JPG, DOC, DOCX upload limit 10mb)</em>
						</div>
					</li>
                </ul>
            </div>

            <div class="area_btn two">
                <ul class="btn_list">
                    <li><button type="button" class="btn_cancle" onclick="history.back();">Cancel</button></li>
                    <li><button type="button" class="btn_confirm fixed" onclick="company_estimate_update();">Quotations <?=$w=='u'?'Edit':'Proposal';?></button></li>
				</ul>
            </div>
        </div>
    </div>
</form>

<!--datepicker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                    swal("Please check the extension.\n available extensions : PDF/JPG/DOC/DOCX");
                    $(this).css("background-color", "#FFF");
                    return false;
                }

                var fileSize = f.size;
                var maxSize = 10 * 1024 * 1024; // 최대 10MB
                if(fileSize > maxSize) {
                    swal('The file exceeds the maximum capacity of 10 MB.');
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

    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: 'Prev',
        nextText: 'Next',
        changeYear: true, // 년 선택 가능
        changeMonth: true, // 월 선택 가능
        monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        dayNames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        showMonthAfterYear: true,
        yearSuffix: 'year',
        yearRange: "-100:+0"
    });
    $('#ce_valid_date').datepicker();
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
                swal("Please check the extension.\n Available extensions : PDF/JPG/DOC/DOCX");
                $(this).css("background-color", "#FFF");
                return false;
            }

            var fileSize = f.size;
            var maxSize = 10 * 1024 * 1024; // 최대 10MB
            if(fileSize > maxSize) {
                swal('The file exceeds the maximum capacity of 10 MB.');
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
        swal('Please enter the amount to be quoted.');
        is_post = false;
        return false;
    }
    if($.trim($('#ce_contents').val()).length == 0) {
        swal('Please enter your message.');
        is_post = false;
        return false;
    }

    $('#del_file_idx').val(delFileIdx.slice(0,-1)); // 의뢰 상세 자료 삭제 (파일 삭제)

    const quantityOfferedElems = document.querySelectorAll('[name="quantityOffered[]"]'); // quantity offered 입력체크
    const unitCostElems = document.querySelectorAll('[name="unitCost[]"]'); // unit cost 입력체크
    if (!checkEmptyInputs(quantityOfferedElems, 'Please enter a QUANTIFY OFFERED')) return false;
    if (!checkEmptyInputs(unitCostElems, 'Please enter a UNIT COST')) return false;

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
                    swal('Completed sending the quotations.')
                    .then(()=>{
                        if('<?=$ci['target_mb_no']?>' != 0) { // 특정 기업에게 의뢰 후 의뢰 받은 기업이 견적 보낼 시 완료 후 마이페이지로 이동
                            location.replace(g5_bbs_url+'/mypage_company02.php');
                        } else {
                            location.replace(g5_bbs_url+'/company_list.php');
                        }
                    });
                }
                else {
                    swal('The estimate has been revised.')
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

// Quotations Proposal Price 금액체크
const festimate = document.festimate;
const calcEstimate = (num) => {
    const quantity = toNumber(document.querySelector(`tr[data-idx='${num}'] [name='quantityOffered[]']`).value);
    const unitConst = toNumber(document.querySelector(`tr[data-idx='${num}'] [name='unitCost[]']`).value);

    const lineCost = (quantity * unitConst);
    document.querySelector(`#lineCostDisplay${num}`).innerHTML = lineCost.toLocaleString();
    document.querySelector(`tr[data-idx='${num}'] [name='lineCost[]']`).value = lineCost; // form

    const lineCostElements = document.querySelectorAll('.lineCost');
    let addCost = 0;
    lineCostElements.forEach(elem => {
        const value = removeCommaNumber(elem.innerHTML);
        if (!isNaN(value)) addCost += value;
    });
    document.querySelector("#totalCostDisplay").innerHTML = addCost.toLocaleString();
    festimate.totalCost.value = addCost.toLocaleString(); // form
}

// 날짜 체크 (작성일 이전 일자는 선택 불가)
function inputDateChk(date) {
    if(date < '<?=date('Y-m-d')?>') {
        swal('Please select a date again.');
        $('#ce_valid_date').val('');
        return false;
    }
}
</script>

<?
include_once('./_tail.php');
?>
