<?
include_once('./_common.php');
$g5['title'] = '재능등록';
include_once('./_head.php');
$name = "item_write";
$idx = $_REQUEST['idx'];
if($idx != "") {
    $filecount = sql_fetch(" select count(*) as count from g5_board_file where wr_id = {$idx} and bo_table = 'main_img'; ")['count'];
    $subfilecount = sql_fetch(" select count(*) as count from g5_board_file where wr_id = {$idx} and bo_table = 'sub_img'; ")['count'];

    $sql = "select * from g5_board_file where wr_id = {$idx} and bo_table = 'main_img' order by bf_no";
    $file_result = sql_query($sql);
    $sql = "select * from g5_board_file where wr_id = {$idx} and bo_table = 'sub_img' order by bf_no";
    $sub_file_result = sql_query($sql);
}else{
    $filecount = 0;
    $subfilecount = 0;

}
?>

<? if($name=="item_write") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="item_write">
<?}?>

<style>
	#ft_menu{display:none;}
</style>


	<div id="item_write">
            <input type="hidden" name="mode" value="item_write03">
            <input type="hidden" name="i_idx" value="<?=$idx?>">
            <input type="hidden" name="click_tab" id="click_tab" value="">

            <?php foreach ($_POST as $key => $value) {
                if (strpos($key, 'i_') === 0) {?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" >
                <?php } ?>
            <?php } ?>

		    <div class="inr v2">
			<h3>재능등록</h3>
			<div class="snb">
				<ul class="list_step">
                    <li id="">
                        <a href="javascript:tab_click(1)">
                            <em>1</em>
                            <span>기본정보</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="javascript:tab_click(2)">
                            <em>2</em>
                            <span>서비스 설명</span>
                        </a>
                    </li>
                    <li id="" class="active">
                        <a href="javascript:tab_click(3)">
                            <em>3</em>
                            <span>이미지 등록</span>
                        </a>
                    </li>
                </ul>
			</div>
			<div class="box_list">				
				<div class="box_content">
					<div class="box_write02">
						<h4 class="b_tit">메인이미지등록 <em><i class="point" name ="point"><?=$filecount?></i>/4</em></h4>
						<div class="cont">	
							<div class="area_box">

								<!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
								<ul class="photo_list" id="file_list">
                                    <?php for ($i = 0; $row = sql_fetch_array($file_result); $i++){ ?>
                                        <li class="file_<?=($i+1)?>">
                                            <div class="area_img">
                                                <img src= "<?= G5_DATA_URL."/file/main_img/".$row['bf_file']?>">
                                                <div class="area_delete" onclick='file_delete(<?=($i+1)?>,"main","<?=$row['bf_idx']?>")'><span class="sound_only">삭제</span></div>
                                            </div>
                                        </li>
                                    <?php } ?>
								</ul>
								<!-- //이미지 미리보기 -->

                                <input type="file" name="file" id="input_file" onchange="file_select(this,'main');" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
								<div id="fileDrag" class="img_wrap" onclick="file_add('')" >
									<div class="area_txt">
										<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_upload.svg"></div>
										<span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
										<span class="m">파일을 추가하세요.</span>
									</div>
								</div>
								<em>※이미지 권장 사이즈: 652 x 488px (4:3 비율)</em>
							</div>
						</div>
					</div>					
				</div>

				<div class="box_content">
					<div class="box_write02">
						<h4 class="b_tit">상세이미지등록 <em><i class="point" name ="subpoint"><?=$subfilecount?></i>/8</em></h4>
						<div class="cont">	
							<div class="area_box">
								<!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
								<ul class="photo_list" id="subfile_list">
                                    <?php for ($i = 0; $row = sql_fetch_array($sub_file_result); $i++){ ?>
                                        <li class="subfile_<?=($i+1)?>">
                                            <div class="area_img">
                                                <img src= "<?= G5_DATA_URL."/file/sub_img/".$row['bf_file']?>">
                                                <div class="area_delete" onclick='file_delete(<?=($i+1)?>,"sub","<?=$row['bf_idx']?>")'><span class="sound_only">삭제</span></div>
                                            </div>
                                        </li>
                                    <?php } ?>
								</ul>
								<!-- //이미지 미리보기 -->
                                <input type="file" name="file" id="subinput_file" onchange="file_select(this,'sub');" multiple accept="image/*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
								<div id="fileDrag" class="sub_img_wrap" onclick="file_add('sub')">

									<div class="area_txt">
										<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_upload.svg"></div>
										<span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
										<span class="m">파일을 추가하세요.</span>
									</div>
								</div>
								<em>※이미지 권장 사이즈: 652 x 488px (4:3 비율)</em>
							</div>
						</div>
					</div>					
				</div>
			</div>
			<div id="area_btn" class="col02">
                <a class="btn_prev" href="javascript:tab_click(2)">이전</a>
				<a class="btn_next" href="javascript:tab_click('complete')">등록완료</a>
			</div>
		</div>
	</div>



<script>
    var fileList = []; // 파일 정보를 담아둘 배열
    var subfileList = []; // 파일 정보를 담아둘 배열
    var update_main_idx = []; //파일 삭제정보
    var update_sub_idx = [];//파일 삭제정보

    var file_count = '<?=$filecount?>' == 0 ? 0 : '<?=$filecount?>';
    var sub_file_count = '<?=$subfilecount?>' == 0 ? 0 : '<?=$subfilecount?>';
    var main_em_cnt = 0; //drop 끝난 후 reader 실행되서 갯수부분 변수추가
    var sub_em_cnt = 0; //drop 끝난 후 reader 실행되서 갯수부분 변수추가

    $(".img_wrap").on("dragenter", function(e){
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
        drop_and_drag(e,'main');
    });

    $(".sub_img_wrap").on("dragenter", function(e){
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
        drop_and_drag(e,'sub');
    });


    function drop_and_drag(e,type) {

        e.preventDefault();

        var text = "";
        var count = 0;
        if(type == "main"){
            max_cnt = 4;
            msg_text = '메인';
            count = file_count;

        }else{
            max_cnt = 8;
            text = 'sub';
            msg_text = '서브';
            count = sub_file_count;

        }
        var files = e.originalEvent.dataTransfer.files;
        if(files != null && files != undefined){
            var tag = "";
            for(var i=0; i<files.length; i++){
                var f = files[i];

                if (count >= max_cnt){
                    swal(msg_text+"이미지는 최대 "+max_cnt+"장까지 등록가능합니다.");
                    return false;
                }

                var fileName = f.name;
                var reg_ext = /(.*?)\.(jpg|JPG|jpeg|JPEG|png|PNG|)$/;
                if (!reg_ext.test(fileName)) {
                    swal("확장자를 확인해 주세요.\n사용 가능 확장자 : PDF/JPG/DOC");
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

                if(type == "main") {
                    fileList.push(f);
                }else{
                    subfileList.push(f);
                }

                // 파일 새창 미리보기
                var reader = new FileReader();
                reader.onload = function(e) {
                    if (type == 'main') {
                        main_em_cnt++;
                        em_cnt = main_em_cnt;
                    } else {
                        sub_em_cnt++;
                        em_cnt = sub_em_cnt;
                    }


                    tag = '<li class="'+text+'file_' + em_cnt + '">' +
                        '<div class="area_img">' +
                        '<img src= "' + e.target.result + '">' +
                        '<div class="area_delete" onclick=\'file_delete(' + em_cnt + ',"'+type+'");\'><span class="sound_only">삭제</span></div>' +
                        '</div>' +
                        // '<em>(' + em_cnt + ' / 4)</em>' +
                        '</li>';

                    $("#"+text+"file_list").append(tag);
                }

                reader.readAsDataURL(f);

                count++;
                if(type == "main"){
                    file_count++;
                }else{
                    sub_file_count++;

                }

                $('[name='+text+'point]').text(count);

            }
            // $(this).append(tag);
            // $('#file_list').append(tag);

        }

        $(this).css("background-color", "#FFF");

    }

    // 파일 삭제
    var delFileIdx = '';
    function file_delete(num,type,idx) {
        // delFileIdx += $('#file_idx_'+num).val() + ',';

        if(type == "main"){
            file_count --;
            console.log(file_count);
            $('[name=point]').text(file_count);
            update_main_idx.push(idx);
            delete fileList[ (num - 1)];
            $('.file_'+num).remove();


        }else{
            sub_file_count --;
            $('[name=subpoint]').text(sub_file_count);
            update_sub_idx.push(idx);
            delete subfileList[ (num - 1)];
            $('.subfile_'+num).remove();


        }


    }

    // 파일 업로드
    function file_add(type) {
        $("#"+type+"input_file").click();
    }

    // 파일 선택
    function file_select(input,type) {
        var text = "";

        if(type == "main"){
            max_cnt = 4;
            msg_text = '메인';
            count = file_count;

        }else{
            max_cnt = 8;
            text = 'sub';
            msg_text = '서브';
            count = sub_file_count;

        }

        if (input.files && input.files[0]) {
            var files = input.files;
            var files_arr = Array.prototype.slice.call(files);

            var tag = "";
            for (var i = 0; i<input.files.length; i++) {
                var f = files_arr[i];

                if (count >= max_cnt){
                    swal(msg_text+"이미지는 최대 "+max_cnt+"장까지 등록가능합니다.");
                    return false;
                }

                var fileName = f.name;
                var reg_ext = /(.*?)\.(jpg|JPG|jpeg|JPEG|png|PNG|)$/;
                if (!reg_ext.test(fileName)) {
                    swal("확장자를 확인해 주세요.\n사용 가능 확장자 : PDF/JPG/DOC");
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

                if(type == "main") {
                    fileList.push(f);
                }else{
                    subfileList.push(f);
                }

                // 파일 새창 미리보기
                var reader = new FileReader();
                reader.onload = function(e) {

                    if (type == 'main') {
                        main_em_cnt++;
                        em_cnt = main_em_cnt;
                    } else {
                        sub_em_cnt++;
                        em_cnt = sub_em_cnt;
                    }


                    tag = '<li class="'+text+'file_' + em_cnt + '">' +
                        '<div class="area_img">' +
                        '<img src= "' + e.target.result + '">' +
                        '<div class="area_delete" onclick=\'file_delete(' + em_cnt + ',"'+type+'");\'><span class="sound_only">삭제</span></div>' +
                        '</div>' +
                        // '<em>(' + em_cnt + ' / 4)</em>' +
                        '</li>';

                    $("#"+text+"file_list").append(tag);
                }

                reader.readAsDataURL(f);

                count++;
                if(type == "main"){
                    file_count++;
                }else{
                    sub_file_count++;

                }
                $('[name='+text+'point]').text(count);

            }
        }
    }

    function fsave_submit3(tab) {

        if (file_count == 0 && tab == "complete") {
            swal("메인 이미지를 1개 이상 올려주세요");
            return false;
        }

        //자꾸 true로 넘어가서 is_submit 변수추가
        if (tab == "complete" ){
            save_form3();
        }else{
            css_block_none($('#click_tab').val());
        }

    }


    var is_post = false; // 중복 submit 체크
    function save_form3() {
        if(is_post) {
            alert("등록중입니다. 잠시만 기다려주세요.");
            // return false;
        }
        is_post = true;

        var form = $('#fsave')[0];
        var formData = new FormData(form);
        if(fileList.length > 0){ // 의뢰 상세 자료 업르도 (파일 업로드)
            fileList.forEach(function(f){
                formData.append("files[]", f);
            });
        }

        if(subfileList.length > 0){ // 의뢰 상세 자료 업르도 (파일 업로드)
            subfileList.forEach(function(f){
                formData.append("subfiles[]", f);
            });
        }

        formData.append("update_sub_idx", update_sub_idx);
        formData.append("update_main_idx", update_main_idx);

        $.ajax({
            url : g5_bbs_url + "/ajax.controller.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            success : function(data) {

                swal("재능등록이 완료되었습니다.").then((value) => {
                        location.href = data;
                });

            },
            err : function(err) {
                swal(err.status);
            }
        });
    }

</script>
