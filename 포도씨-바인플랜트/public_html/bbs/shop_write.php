<?
include_once('./_common.php');

$g5['title'] = '판매 자료 등록';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);

$title = '등록';
if($w == 'u') {
    $title = '수정';
    $idx = explode('_', base64_decode($code))[1];
    $rr = sql_fetch(" SELECT * FROM g5_reference_room WHERE idx = '{$idx}' ");
}
?>

<link rel="stylesheet" href="<?= G5_URL ?>/css/style.css?v=<?= G5_CSS_VER ?>">
<style>
    html {
        scroll-behavior: auto;
    }
    .fotorama__nav {
        text-align: left;
    }
    .fotorama__arr, .fotorama__fullscreen-icon, .fotorama__video-close, .fotorama__video-play {
        background: none;
    }
</style>

<div id="area_shop" class="write v3">
    <form id="ffrm" name="ffrm" method="post" autocomplete="off" action="<?= G5_BBS_URL ?>/shop_write_update.php">
        <input type="hidden" id="rr_hashtag" name="rr_hashtag" value="<?=$rr['rr_hashtag']?>">
        <input type="hidden" id="idx" name="idx" value="<?=$idx?>">
        <input type="hidden" id="w" name="w" value="<?=$w?>">
        <input type="hidden" id="del_file_idx" name="del_file_idx">
        <div class="inr v3">
            <h2 class="title">판매 자료 <?=$title?></h2>
            <div id="shop_write">
                <ul class="box_list">
                    <li>
                        <div class="cate">
                            <h3>카테고리</h3>
                            <div class="select_box v2">
                                <div class="box">
                                    <select id="rr_category" name="rr_category" style="width: 100%;" onchange="categoryChange(this.value);">
                                        <option value="">카테고리를 선택하세요</option>
                                        <?php foreach($refer_category as $cate)  {?>
                                        <option value="<?=$cate?>" <?=$rr['rr_category'] == $cate ? 'selected' : ''?>><?=$cate?></option>
                                        <?php } ?>
                                        <!--<option value="">카테고리를 선택하세요</option>
                                        <option value="양식/서식" <?/*=$rr['rr_category'] == '양식/서식' ? 'selected' : ''*/?>>양식/서식</option>
                                        <option value="비즈니스(산업)" <?/*=$rr['rr_category'] == '비즈니스(산업)' ? 'selected' : ''*/?>>비즈니스(산업)</option>
                                        <option value="보고서/회의" <?/*=$rr['rr_category'] == '보고서/회의' ? 'selected' : ''*/?>>보고서/회의</option>
                                        <option value="노하우" <?/*=$rr['rr_category'] == '노하우' ? 'selected' : ''*/?>>노하우</option>
                                        <option value="리포트/논문" <?/*=$rr['rr_category'] == '리포트/논문' ? 'selected' : ''*/?>>리포트/논문</option>
                                        <option value="기타" <?/*=$rr['rr_category'] == '기타' ? 'selected' : ''*/?>>기타</option>-->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="cate sub_cate" style="display: none;margin-top: 10px;">
                            <h3>하위카테고리</h3>
                            <div class="select_box v2">
                                <div class="box">
                                    <select id="rr_sub_category" name="rr_sub_category" style="width: 100%;">
                                        <option value="">하위카테고리를 선택하세요</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <em>제목</em>
                        <div class="area_box">
                            <input type="text" class="input_subject" id="rr_subject" name="rr_subject" value="<?= $rr['rr_subject'] ?>">
                        </div>
                    </li>
                    <li>
                        <em>자료업로드</em>
                        <div class="area_box">
                            <!-- 첨부파일 영역-->
                            <ul id="file_list" class="file_list">
                                <?php
                                $filecount = sql_fetch(" select count(*) as count from g5_reference_room_file where reference_idx = {$idx} and mode = 'file' ")['count'];
                                if($filecount > 0) {
                                    $file_sql = " select * from g5_reference_room_file where reference_idx = {$idx} and mode = 'file' order by idx; ";
                                    $file_result = sql_query($file_sql);

                                    for($i=0; $row=sql_fetch_array($file_result); $i++) {
                                        ?>
                                        <li class="file_<?=$i?>">
                                            <span class="fileName"><a href="<?=G5_DATA_URL?>/file/reference/<?=$row['img_file']?>" target="_blank"><?=$row['img_source']?></a></span><button type="button" class="btn_delete" onclick="file_delete(<?=$i?>, 'file');"></button>
                                            <input type="hidden" id="file_idx_<?=$i?>" name="file_idx_<?=$i?>" value="<?=$row['idx']?>">
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div id="fileDrag" class="img_wrap btn_upload fileDrag">
                                <input type="file" name="file[]" id="file" onchange="file_select(this);" accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                                <div class="area_txt" onclick="file_add('file');">
                                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/icon_upload.svg"></div>
                                    <span>마우스로 드래그해서 파일을 추가하세요.</span>
                                </div>
                            </div>
                            <em>※PDF, JPG, DOC, DOCX, PPT, ZIP 업로드 제한 용량 15MB</em>
                        </div>
                    </li>
                    <li>
                        <em>썸네일 이미지 (1개 이상 필수)</em>
                        <div class="area_box">
                            <div id="fileDrag2" class="img_wrap btn_upload fileDrag">
                                <input type="file" name="thumb[]" id="thumb" onchange="file_select(this);" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">

                                <div class="area_txt" onclick="file_add('thumb');">
                                    <div class="area_img"><img src="<?php echo G5_IMG_URL ?>/icon_upload.svg" alt=""></div>
                                    <span>마우스로 드래그해서 파일을 추가하세요.</span>
                                </div>
                            </div>
                            <!-- 첨부파일 영역-->
                            <ul id="thumb_list" class="thumb">
                                <?php
                                $filecount2 = sql_fetch(" select count(*) as count from g5_reference_room_file where reference_idx = {$idx} and mode = 'thumb' ")['count'];
                                if($filecount2 > 0) {
                                    $file_sql2 = " select * from g5_reference_room_file where reference_idx = {$idx} and mode = 'thumb' order by idx; ";
                                    $file_result2 = sql_query($file_sql2);

                                    for($i=0; $row=sql_fetch_array($file_result2); $i++) {
                                    ?>
                                    <li class="thumb_<?=$i?>">
                                        <p><img src="<?=G5_DATA_URL?>/file/reference/<?=$row['img_file']?>" width="100" height="75" alt=""></p>
                                        <button type="button" class="btn_close" onclick="file_delete(<?=$i?>, 'thumb');"></button>
                                        <input type="hidden" id="thumb_idx_<?=$i?>" name="thumb_idx_<?=$i?>" value="<?=$row['idx']?>">
                                    </li>
                                    <?php
                                    }
                                }
                                ?>
                            </ul>
                            <em>※JPG, JPEG, PNG 업로드 제한 용량 10mb</em>
                            <em>※이미지 권장 사이즈 (730 x 430)</em>
                        </div>
                    </li>
                    <li>
                        <em>내용소개</em>
                        <div class="area_box02">
                            <!-- 에디터 넣어주세요 -->
                            <div class="bottom" id="editor" style="display: none;"></div>
                            <textarea id="rr_contents" name="rr_contents" class="noshow"><?= $rr['rr_contents'] ?></textarea>
                        </div>
                    </li>
                    <li>
                        <div class=" w_filter hash">
                            <h3>#해시태그</h3>
                            <div class="area_tag">
                                <span class="span_tag">#</span>
                                <input type="text" class="input_tag" id="input_tag" placeholder="질문에 맞는 태그를 입력해 주세요(엔터로 구분, 최대 3개)" onkeyup="lengthChk(this);add_hash(this, 3);">
                                <ul class="tag_list">
                                    <?php
                                    if(!empty($rr['rr_hashtag'])) {
                                        $rr_hashtag = explode(',', $rr['rr_hashtag']);
                                        for($i=0; $i < count($rr_hashtag); $i++) {
                                            ?>
                                            <li class="tag_<?=$i+1?>"><span class="tag_word"><?=$rr_hashtag[$i]?><button type="button" class="btn_close" onclick="del_hash(<?=$i+1?>);"></button></span></li>
                                        <?php } } ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="w_filter">
                <h3>가격</h3>
                <div class="area_price cdata">
                    <input type="checkbox" id="rr_is_free" name="rr_is_free" <?php echo $rr['rr_is_free'] == 'Y' || !$seller ? 'checked' : ''; ?> value="Y" onclick="priceFreeCheck();">
                    <label for="rr_is_free">
                        <span></span>
                        <em>무료</em>
                    </label>
                    <input type="text" <?=$seller ? '' : 'readonly'?> class="input_price" id="rr_price" name="rr_price" value="<?=!empty($rr['rr_price']) ? number_format($rr['rr_price']) : ''?>" placeholder="가격을 입력하세요" onkeyup="only_number(this);comma_number(this)"><strong>원</strong>
                    <br>※ 최소 판매 금액은 100원 이상 입니다.
                </div>
            </div>
            <?php if($w=='') { ?>
            <div class="w_filter agree">
                <p>※ 자료실에 올린 자료에 대한 저작권 및 보든 법적 책임은 판매자 본인에게 있습니다.</p>
                <p>※ 선정성, 폭력성 등 규정에 위배되는 자료에 대해 언제든지 관리자가 삭제 할 수 있습니다.</p>
                <div class="cdata">
                    <input type="checkbox" id="agree" name="agree">
                    <label for="agree">
                        <span></span>
                        <em>예, 위 안내를 모두 읽었으며 이에 동의합니다.</em>
                    </label>
                </div>
            </div>
            <?php } ?>

            <div class="area_btn">
                <button type="button" class="btn_confirm fixed" onclick="shopUpload()"><?=$w=='u'?'수정':'업로드'?>하기</button>
            </div>
        </div>
    </form>
</div>

<script>
    var num = '<?php echo (!empty($rr['rr_hashtag'])) ? count($rr_hashtag) + 1 : 1; ?>';
    var fileList = []; // 파일 정보를 담아둘 배열
    var fileList2 = []; // 파일 정보를 담아둘 배열
    var file_count = '<?=$filecount?>' == 0 ? 0 : '<?=$filecount?>';
    var file_count2 = '<?=$filecount2?>' == 0 ? 0 : '<?=$filecount2?>';
    $(function() {
        // summernote
        var editor = $('#editor').summernote({
            height: 300, //(mobilecheck())? 150 : 300,
            lang: 'ko-KR',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'undo', 'redo']],
            ],
            callbacks: {
                onImageUpload:function(files){ // 이미지 업로드
                    sendFile(editor, files[0]);
                }
            }
        });

        // 수정
        if($("#idx").val() != "") {
            // 내용소개
            $('#editor').summernote('code', $('#rr_contents').val());
        }

        // 파일 드래그 앤 드롭
        $(".fileDrag").on("dragenter", function(e){
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

            var id = ""; // 썸네일인지 자료인지
            if(this.id == "fileDrag") id = "file"
            else id = "thumb";

            var files = e.originalEvent.dataTransfer.files;
            if(files != null && files != undefined) {
                if(id == "file") {
                    if($("#file_list li").length > 0) {
                        swal("자료는 1개만 등록할 수 있습니다.");
                        $(this).css("background-color", "#FFF");
                        return false;
                    }
                }
                else {
                    if($("#thumb_list li").length > 9) {
                        swal("최대 10개까지 등록할 수 있습니다.");
                        $(this).css("background-color", "#FFF");
                        return false;
                    }
                }

                $.each(files, function(index, file) {
                    var f = file;

                    var fileSize = f.size;
                    var maxSize = 15 * 1024 * 1024; // 최대 15MB
                    if(fileSize > maxSize) {
                        swal('파일이 최대 용량 15MB를 초과합니다.');
                        $(this).css("background-color", "#FFF");
                        return false;
                    }

                    var tag = "";
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var src = e.target.result;
                        var fileName = f.name;
                        var reg_ext = /(.*?)\.(pdf|jpg|doc|docx|ppt|pptx|zip|JPG|)$/;
                        if(id == "file") {
                            if (!reg_ext.test(fileName)) {
                                swal("확장자를 확인해 주세요.\n사용 가능 확장자 : PDF/JPG/DOC/DOCX/PPT/ZIP");
                                $(this).css("background-color", "#FFF");
                                return false;
                            }

                            fileList.push(f);

                            tag += '<li class="file_'+file_count+'">' +
                                '<span class="fileName"><a href="javascript:void(0);">'+fileName+'</a></span><button type="button" class="btn_delete" onclick="file_delete('+file_count+', \'file\');"></button>' +
                                '</li>';
                        }
                        else {
                            reg_ext = /(.*?)\.(jpg|jpeg|png|JPG|JPEG|PNG)$/;
                            if (!reg_ext.test(fileName)) {
                                swal("확장자를 확인해 주세요.\n사용 가능 확장자 : JPG/JPEG/PNG");
                                $(this).css("background-color", "#FFF");
                                return false;
                            }

                            fileList2.push(f);

                            tag += '<li class="thumb_'+file_count2+'">' +
                                '<p><img src="'+src+'" width="100" height="75"></p>' +
                                '<button type="button" class="btn_close" onclick="file_delete('+file_count2+', \'thumb\');"></button>' +
                                '</li>';
                        }

                        if(id == "file") file_count++;
                        else file_count2++;

                        $('#'+id+'_list').append(tag);
                    }

                    reader.readAsDataURL(file);
                });
            }


            $(this).css("background-color", "#FFF");
        });
    });

    // 파일 삭제
    var delFileIdx = '';
    function file_delete(num, id) {
        delFileIdx += $('#'+id+'_idx_'+num).val() + ',';
        $('.'+id+'_'+num).remove();

        if(id == "file" && $("#w").val() == "") fileList.pop();
    }

    // 파일 업로드
    function file_add(id) {
        $("#"+id).click();
    }

    // 파일 선택
    function file_select(input) {
        var id = input.id;
        if (input.files && input.files[0]) {
            var files = input.files;

            if(id == "file") {
                if($("#file_list li").length > 0) {
                    swal("자료는 1개만 등록할 수 있습니다.");
                    $(this).css("background-color", "#FFF");
                    return false;
                }
            }
            else {
                if($("#thumb_list li").length > 9) {
                    swal("최대 10개까지 등록할 수 있습니다.");
                    $(this).css("background-color", "#FFF");
                    return false;
                }
            }

            $.each(files, function(index, file) {
                var f = file;

                var fileSize = f.size;
                var maxSize = 10 * 1024 * 1024; // 최대 10MB
                if(fileSize > maxSize) {
                    swal('파일이 최대 용량 10MB를 초과합니다.');
                    $(this).css("background-color", "#FFF");
                    return false;
                }

                var tag = "";
                var reader = new FileReader();
                reader.onload = function(e) {
                    var src = e.target.result;
                    var fileName = f.name;
                    var reg_ext = /(.*?)\.(pdf|jpg|doc|docx|JPG|)$/;
                    if(id == "file") {
                        if (!reg_ext.test(fileName)) {
                            swal("확장자를 확인해 주세요.\n사용 가능 확장자 : PDF/JPG/DOC/DOCX");
                            $(this).css("background-color", "#FFF");
                            return false;
                        }

                        fileList.push(f);

                        tag += '<li class="file_'+file_count+'">' +
                            '<span class="fileName"><a href="javascript:void(0);">'+fileName+'</a></span><button type="button" class="btn_delete" onclick="file_delete('+file_count+', \'file\');"></button>' +
                            '</li>';
                    }
                    else {
                        reg_ext = /(.*?)\.(jpg|jpeg|png|JPG|JPEG|PNG)$/;
                        if (!reg_ext.test(fileName)) {
                            swal("확장자를 확인해 주세요.\n사용 가능 확장자 : JPG/JPEG/PNG");
                            $(this).css("background-color", "#FFF");
                            return false;
                        }

                        fileList2.push(f);

                        tag += '<li class="thumb_'+file_count2+'">' +
                            '<p><img src="'+src+'" width="100" height="75"></p>' +
                            '<button type="button" class="btn_close" onclick="file_delete('+file_count2+', \'thumb\');"></button>' +
                            '</li>';
                    }

                    if(id == "file") file_count++;
                    else file_count2++;

                    $('#'+id+'_list').append(tag);
                }

                reader.readAsDataURL(file);
            });
        }
    }

    // 파일 새창 미리보기 (등록 시 사용)
    function file_show(src) {
        var win = window.open('','');
        win.document.write('<body style="margin: 0px !important;"><iframe width="100%;" height="100%" style="border: none !important;" src="'+src+'"></body>');
    }

    // 가격 무료 체크
    function priceFreeCheck() {
        if($("#rr_is_free").is(":checked")) {
            $("#rr_price").attr("readonly", true);
            $("#rr_price").val("");
        } else {
            // 체크 해제 시 판매자 아니면 알림창
            if('<?=$seller?>') { // 판매자
                $("#rr_price").attr("readonly", false);
            } else {
                swal("유료 업로드를 위해서는\n판매자 신청 후 승인이 필요합니다.")
                .then(()=>{
                    location.href = g5_bbs_url+"/mypage_seller.php";
                });
            }
        }
    }

    // 업로드
    var is_post = false; // 중복 submit 체크
    function shopUpload() {
        if(is_post) {
            return false;
        }
        is_post = true;

        $('#rr_contents').val(editorCheck()); // 내용소개

        var hashtag = '';
        $('.tag_list li span').each(function() {
            hashtag += $(this).text() + ',';
        });
        hashtag = hashtag.slice(0, -1);
        $('#rr_hashtag').val(hashtag); // 해시태그

        $('#del_file_idx').val(delFileIdx.slice(0,-1)); // 의뢰 상세 자료 삭제 (파일 삭제)

        var f = $("#ffrm")[0];
        if(f.rr_category.value == "") {
            swal("카테고리를 선택해 주세요.");
            is_post = false;
            return false;
        }
        if($.trim(f.rr_subject.value) == "") {
            swal("제목을 입력해 주세요.");
            is_post = false;
            return false;
        }
        if($("#file_list li").length == 0) {
            swal("자료를 등록해 주세요.");
            is_post = false;
            return false;
        }
        if($("#thumb_list li").length == 0) {
            swal("썸네일 이미지를 등록해 주세요.");
            is_post = false;
            return false;
        }
        if($.trim(f.rr_contents.value) == "") {
            swal('내용을 입력해 주세요.');
            is_post = false;
            return false;
        }
        if(!$("#rr_is_free").is(":checked") && (f.rr_price.value == "" || f.rr_price.value == 0)) {
            swal("가격을 입력해 주세요.");
            is_post = false;
            return false;
        }
        if(!$("#rr_is_free").is(":checked") && Number(f.rr_price.value) < 100) {
            swal("최소 판매 금액은 100원 이상입니다.");
            is_post = false;
            return false;
        }
        if(f.w.value == "" && !$("#agree").is(":checked")) {
            swal("안내 사항에 동의해 주세요.");
            is_post = false;
            return false;
        }

        var formData = new FormData(f);
        if(fileList.length > 0) {
            fileList.forEach(function(f){
                formData.append("files[]", f);
            });
        }
        if(fileList2.length > 0) {
            fileList2.forEach(function(f){
                formData.append("thumbs[]", f);
            });
        }

        $.ajax({
            url: g5_bbs_url + "/shop_write_update.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success: function (data) {
                console.log(data);
                if(data) {
                    swal("<?=$title?>이 완료되었습니다.")
                    .then(()=>{
                        location.replace(g5_bbs_url+"/shop.php");
                    });
                }
            }
        });
    }

    // 카테고리 별 하위 카테고리
    function categoryChange(category) {
        return;
        $.ajax({
            url: "./ajax.get_reference_room_category.php",
            type: "post",
            data: {category: category},
            success: function(data) {
                if(data) {
                    $("#rr_sub_category").html(data);
                    $(".sub_cate").show();
                } else {
                    $("#rr_sub_category").html('');
                    $(".sub_cate").hide();
                }
            }
        });
    }
</script>

<?
include_once('./_tail.php');
?>
