<?
include_once('./_common.php');

$g5['title'] = 'Corporate RFQ';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);

// 기업의뢰 정보
$ci = sql_fetch(" select * from g5_company_inquiry where idx = {$idx} ");

$msg = 'Register';
if($w == 'u') {
    if($ci['mb_id'] != $member['mb_id']) { // 본인이 쓴 글이 아닌데 경로타고 들어올 경우 막음
        alert('Not the correct path.');
    }
    $msg = 'Edit';
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
                    <h4 class="modal-title" id="appModalLabel">RFQ Completed</h4>
                </div>
                <div class="modal-body">
                    <div class="txt">
                        <h3>RFQ to Podosea has been successfully received.</h3>
                        <span>
						The details of the RFQ is managed separately. <Br>
						Upon review, we will recommend an appropriate company. <Br>
						Upon the requester approving the recommended company, <Br>
						the RFQ details will be sent.
						</span>
                        <br>
                        <a href="<?=G5_BBS_URL?>/company_list.php">Confirm</a>
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
            <h2 class="title">Create RFQ <?php echo !empty($podosea) ? '<span style="font-size: 14px;color: #3568da;">(RFQ by PODOSEA)</span>' : ''; ?></h2>
            <div id="company_write">
                <ul class="box_list">
                    <li>
                        <em>RFQ Type</em>
                        <ul class="area_filter">
                            <?php $ciTypes = explode("|", $ci['ci_type']); ?>
                            <li>
                                <input type="checkbox" id="ci_type1" <?php echo $w == '' ? 'checked' : '' ?> name="ci_type" value="Service" <?= in_array('Service', $ciTypes) ? 'checked' : ''; ?>>
                                <label for="ci_type1">
                                    <span></span>
                                    <em>Service</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="ci_type2" name="ci_type" value="Parts" <?= in_array('Parts', $ciTypes) ? 'checked' : ''; ?>>
                                <label for="ci_type2">
                                    <span></span>
                                    <em>Parts</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="ci_type3" name="ci_type" value="Ship supplies" <?= in_array('Ship supplies', $ciTypes) ? 'checked' : ''; ?>>
                                <label for="ci_type3">
                                    <span></span>
                                    <em>Ship supplies</em>
                                </label>
                            </li>
                            <li>
                                <input type="checkbox" id="ci_type4" name="ci_type" value="Ohters" <?= in_array('Ohters', $ciTypes) ? 'checked' : ''; ?>>
                                <label for="ci_type4">
                                    <span></span>
                                    <em>Others</em>
                                </label>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <em>RFQ Basic Information</em>
                        <ul class="area_box">
                            <li>
                                <span>Vessel Name</span>
                                <input type="text" id="ci_vessel" name="ci_vessel" value="<?=$ci['ci_vessel']?>">
                            </li>
                            <li>
                                <span>IMO No.</span>
                                <input type="text" id="ci_imo_no" name="ci_imo_no" value="<?=$ci['ci_imo_no']?>">
                            </li>
                        </ul>
                        <ul class="area_box last">
                            <li class="subject">
                                <span>Subject (RFQ Title)<i class="red">*Required</i></span>
                                <input type="text" id="ci_subject" name="ci_subject" value="<?=$ci['ci_subject']?>">
                            </li>
                            <li>
                                <span>Quotation Deadline<i class="red">*Required</i></span>
                                <div class="input">
                                    <input type="text" class="regist-input " id="ci_deadline_date" name="ci_deadline_date" value="<?=$ci['ci_deadline_date']?>" placeholder="yyyy-mm-dd" onchange="deadlinkChk(this.value);">
                                </div>
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
                                    <th>Maker (manufacturer)</th>
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
                        <em>RFQ Content</em>
                        <div class="area_box">
                            <table class="table v2 scroll">
                                <colgroup>
                                    <col style="width:25px"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>*DESCRIPTION</th>
                                    <th>REFERENCE</th>
                                    <th>PART NO.</th>
                                    <th>*QUANTITY</th>
                                    <th>UoM</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="contentLoad">
                                <?php if($w == '') { // 등록 ?>
                                    <tr data-idx="1">
                                        <td>1</td>
                                        <td><input type="text" name="description[]" placeholder="ㅡ" required></td>
                                        <td><input type="text" name="reference[]" placeholder="ㅡ"></td>
                                        <td><input type="text" name="partNo[]" placeholder="ㅡ"></td>
                                        <td><input type="text" name="quantity[]" placeholder="ㅡ" onkeyup="this.value=numberChk(this.value)" required></td>
                                        <td><input type="text" name="uom[]" placeholder="ㅡ"></td>
                                        <td><button type="button" class="ci_table_btn" onclick="delContent(1)">X</button></td>
                                    </tr>
                                <?php } else { // 수정
                                    $contentRlt = sql_query("SELECT * FROM g5_company_inquiry_content WHERE inquiry_idx = '{$idx}' order by idx");
                                    $contentCount = 0;
                                    for($i=1; $content=sql_fetch_array($contentRlt); $i++) {
                                        $contentCount = $i;
                                    ?>
                                    <tr data-idx="<?=$i?>">
                                        <td>
                                            <?=$i?>
                                            <input type="hidden" name="contentIdx[]" value="<?=$content['idx']?>">
                                        </td>
                                        <td><input type="text" name="description[]" placeholder="ㅡ" value="<?=$content['description']?>" required></td>
                                        <td><input type="text" name="reference[]" placeholder="ㅡ" value="<?=$content['reference']?>"></td>
                                        <td><input type="text" name="partNo[]" placeholder="ㅡ" value="<?=$content['part_no']?>"></td>
                                        <td><input type="text" name="quantity[]" placeholder="ㅡ" value="<?=$content['quantity']?>" onkeyup="this.value=numberChk(this.value)" required></td>
                                        <td><input type="text" name="uom[]" placeholder="ㅡ" value="<?=$content['uom']?>"></td>
                                        <td><button type="button" class="ci_table_btn" onclick="delContent(<?=$i?>)">X</button></td>
                                    </tr>
                                <?php } } ?>
                                <!--<tr>
                                  <td colspan="6"><button type="button" class="ci_table_btn" onclick="addContent()">+ Add</button></td>
                                </tr>-->
                                </tbody>
                            </table>
                            <div style="margin: 10px;text-align: center;"><button type="button" class="ci_table_btn" onclick="addContent()">+ Add</button></div>
                        </div>
                        <div class="area_box">
                            <span>Message to Supplier</span>
                            <textarea id="ci_contents" name="ci_contents" placeholder="Please enter a Brief Overview of the project you want to request for quotation"><?=$ci['ci_contents']?></textarea>
                        </div>
                    </li>
                    <li>
                        <em>RFQ Details</em>
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
                                    <span class="w">Add files by dragging here with a mouse.</span>
                                    <span class="m">Please add a file.</span>
                                </div>
                            </div>
                            <em>※Attach inquiry sheet, images and drawings related to project details. (PDF, JPG, DOC, upload maximum of 10mb)</em>
                        </div>
                    </li>
                </ul>
            </div>

            <!--자료 공개 여부-->
            <div class="w_filter">
                <h3>Privacy Setting for Documents</h3>
                <ul class="area_filter">
                    <li>
                        <input type="checkbox" id="open" <?php echo $w == '' ? 'checked' : '' ?> name="ci_open" value="open" <?php echo $ci['ci_open'] == 'open' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
                        <label for="open">
                            <span></span>
                            <em>Reveal All</em>
                        </label>
                    </li>
                    <?php if(empty($podosea)) { // 포도씨에 직접의뢰 한 건은 선택공개 X (임의)?>
                        <li>
                            <input type="checkbox" id="private" name="ci_open" value="private" <?php echo $ci['ci_open'] == 'private' ? 'checked' : ''; ?> onclick="checkOnlyOne(this);">
                            <label for="private">
                                <span></span>
                                <em>Selective Sharing<i>?</i>
                                    <div class="area_info">
                                        <p>When Selective Sharing is checked, [RFQ Details]
                                            is disclosed only to companies that have obtained approval from the requesting company
                                        </p>
                                    </div>
                                </em>
                            </label>
                        </li>
                    <?php } ?>
                    <div class="data_password" <?php echo $ci['ci_open'] == 'open' || empty($ci['ci_open']) ? 'style="display: none;"' : ''; ?>><span>passward</span><input type="text" name="ci_password" id="ci_password" value="<?=$ci['ci_password']?>"></div>
                </ul>

            </div>

            <!--BUDGET-->
            <div class="w_filter">
                <h3>Budget<em>*optional</em></h3>
                <div class="area_box">
                    <select id="ci_budget" name="ci_budget">
                        <option value="">Select Budget</option>
                        <?php for ($i=1; $i<=count($company_budget); $i++) { ?>
                            <option value='<?=$i?>' <?php echo $ci['ci_budget'] == $i ? 'selected' : ''; ?>><?=$company_budget[$i]?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!--Delivery To-->
            <div class="w_filter">
                <h3>Delivery To<br><em>*optional</em></h3>
                <div class="area_box">
                    <input type="text" id="ci_delivery_to" name="ci_delivery_to" value="<?=$ci['ci_delivery_to']?>" placeholder="E.g.) Busan, South Korea">
                </div>
            </div>

            <div class="area_btn v2 two">
                <ul class="btn_list">
                    <li><button type="button" class="btn_cancle" onclick="history.back();">Cancel</button></li>
                    <li><button type="button" class="btn_confirm" onclick="company_write_update();" ><?=$w=='u'?'Modify':'RFQ';?></button></li>
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
                    swal("Please check the extension.\navailable extensions : PDF/JPG/DOC/DOCX");
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
        yearRange: "-100:+2"
    });
    $('#ci_deadline_date').datepicker();
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
                swal("Please check the extension.\navailable extensions : PDF/JPG/DOC/DOCX");
                $(this).css("background-color", "#FFF");
                // files.splice(i);
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

// 의뢰하기
var is_post = false; // 중복 submit 체크
function company_write_update() {
    if(is_post) {
        return false;
    }
    is_post = true;

    if($.trim($('#ci_subject').val()) == 0) {
        swal('Please enter the request title.');
        is_post = false;
        return false;
    }
    if($('#ci_deadline_date').val() == '') {
        swal('Please enter a quote deadline.');
        is_post = false;
        return false;
    }
    if($('#ci_category').val() == '') {
        swal('Please select a category.');
        is_post = false;
        return false;
    }

    var open = $('input:checkbox[name="ci_open"]:checked').val(); // 자료 공개 여부
    if(open == 'private') {
        if($.trim($('#ci_password').val()) == '') {
            swal('Please enter a password.');
            is_post = false;
            return false;
        }
    }

    $('#del_file_idx').val(delFileIdx.slice(0,-1)); // 의뢰 상세 자료 삭제 (파일 삭제)

    // RFQ Type (복수선택)
    const types = [];
    const typeElems = document.querySelectorAll('[name=ci_type]');
    typeElems.forEach((type) => {
       if(type.checked) {
           types.push(type.value);
       }
    });

    const descElems = document.querySelectorAll('[name="description[]"]'); // description 입력체크
    const quantifyElems = document.querySelectorAll('[name="quantity[]"]'); // quantify 입력체크
    if (!checkEmptyInputs(descElems, 'Please enter a DESCRIPTION')) return false;
    if (!checkEmptyInputs(quantifyElems, 'Please enter a QUANTITY')) return false;

    var form = $('#fcompanywrite')[0];
    var formData = new FormData(form);
    formData.append('ciTypes', types.join('|'));
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
                    swal('Request registration completed.')
                        .then(()=>{
                            if($('#podosea').val() == 'Y') {
                                $('#podoCS').modal('show');
                            } else {
                                location.replace(g5_bbs_url+'/company_list.php');
                            }
                        });
                }
                else {
                    swal('Request modification completed.')
                        .then(()=>{
                            location.replace(g5_bbs_url+'/company_view.php?idx=<?=$idx?>');
                        });
                }
            }
            else {
                swal('There are already registered quotes.')
                .then(() => {
                    location.replace(g5_bbs_url+'/company_view.php?idx=<?=$idx?>');
                });
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
        swal('Please select a date again.');
        $('#ci_deadline_date').val('');
        return false;
    }
}

// RFQ Content 추가
let contentNum = '<?=$w?>' == '' ? 2 : <?=$contentCount+1?>;
const addContent = () => {
    const html = `
    <tr data-idx=${contentNum}>
        <td>${contentNum}</td>
        <td><input type="text" name="description[]" placeholder="ㅡ" required></td>
        <td><input type="text" name="reference[]" placeholder="ㅡ"></td>
        <td><input type="text" name="partNo[]" placeholder="ㅡ"></td>
        <td><input type="text" name="quantity[]" placeholder="ㅡ" onkeyup="this.value=numberChk(this.value)" required></td>
        <td><input type="text" name="uom[]" placeholder="ㅡ"></td>
        <td><button type="button" class="ci_table_btn" onclick="delContent(${contentNum})">X</button></td>
    </tr>
    `;

    document.querySelector("#contentLoad").insertAdjacentHTML('beforeend', html);
    contentNum++;
}

// RFQ Content 삭제
const delContent = (num) => {
    document.querySelector(`tr[data-idx="${num}"]`).remove();
}
</script>

<?
include_once('./_tail.php');
?>
