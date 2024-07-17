<?
include_once('./_common.php');
$name = "cmypage";
$pid = "mypage_form";
$g5['title'] = '프로필관리';
include_once('./_head.php');

$mb = get_member($member[mb_id]);

if($mb == null) alert("로그인 해주세요", G5_URL);

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
    @media screen and (max-width:1024px) {
        #area_my{display: none;}
    }
</style>

    <div id="area_mypage" class="profile">
		<div class="inr">		
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?> 
				
				<div class="mypage_cont">
					<div class="box">
						<h3>프로필관리</h3>
						
						<div id="profile_form">

                            <div class="myinfo_wrap" >
                                <form id = 'imgfrm'>
                                    <input type="file" name="mb_icon" id="mb_icon" onchange="getImgPrev(this);" accept="image/*" style="display: none">

                                    <div class="area_photo">
                                        <div class="photo basic" id="img_area" onclick="file_click();">
                                        <?php
                                        $icon_file = G5_DATA_PATH.'/file/member/'.$member['mb_no'].'.jpg';
                                        if (file_exists($icon_file)) {
                                            $icon_url = G5_DATA_URL.'/file/member/'.$member['mb_no'].'.jpg';
                                            echo '<img src="'.$icon_url.'" alt="">';
                                        }else{
                                            echo '<img src="'.G5_IMG_URL .'/img_smile.jpg">';
                                        }
                                        ?>
                                        </div>
                                        <span class="upload"><i class="fa-solid fa-camera-retro"></i></span>
                                    </div>
                                </form>
                            </div>
                                <dl>
                                    <dt>닉네임</dt>
                                    <dd><input type="text" id="mb_nick" placeholder="활동명 or 회사명" value="<?=$member['mb_nick']?>"></dd>
                                </dl>

                                <dl>
                                    <dt>성별</dt>
                                    <dd>
                                        <input type="radio" name="mb_sex" value="M" <?php if($member["mb_sex"] == "M") echo "checked"?>> 남성
                                        <input type="radio" name="mb_sex" value="W" <?php if($member["mb_sex"] == "W") echo "checked"?>> 여성
                                    </dd>
                                </dl>

                            <dl>
                                <dt>생년월일</dt>
                                <dd><input type="text" id="mb_birth" placeholder="생년월일" value="<?=$member['mb_birth']?>"></dd>
                            </dl>

                            <?php $jobs = ["직장인","프리랜서","자영업자","대학생","배우","뮤지션","성우","모델","디자이너",
                                "아트디렉터","방송스탭","PD","작가","강사","쇼호스트","트레이너","크리에이터","뷰티업종","IT","요식업","무직","기타"];?>
                            <dl>
                                <dt>현재직업</dt>
                                <dd>
                                    <?php foreach($jobs as $i) { ?>
                                    <input type="radio" name="mb_job" value="<?=$i?>" <?php if($member["mb_job"] == $i) echo "checked";?>> <?=$i?>
                                    <?}?>
                                </dd>
                            </dl>

                            <?php
                                $interests = ["배우·연기" ,"모델" ,"영상·사진·음향" ,"영상디자인·편집" ,"방송마케팅" ,"행사·MC·이벤트"
                                ,"방송 스태프" ,"시나리오· 작가" ,"뷰티·패션" ,"레슨" ,"심리상담" ,"기타" ,"선택안함" ];
                                $mb_interests = json_decode($member["mb_interest"],true);
                            ?>
                            <dl>
                                <dt>관심분야</dt>
                                <dd>
                                    <?php foreach($interests as $i) { ?>
                                        <input type="checkbox" name="mb_interest" value="<?=$i?>" <?php if(in_array($i,$mb_interests)) echo "checked"; ?>> <?=$i?>
                                    <?}?>
                                </dd>
                            </dl>

<!--                            <dl>-->
<!--                                <dt>응답시간</dt>-->
<!--                                <dd>-->
<!--                                        <select name="pf_time" class="select" id="mb_1" title="응답시간">-->
<!--                                            <option value="1" --><?//if($member['re_time'] == 1) { ?><!--selected--><?//}?><!-- >30분 이내</option>-->
<!--                                            <option value="2" --><?//if($member['re_time'] == 2) { ?><!--selected--><?//}?><!-- >1시간 이내</option>-->
<!--                                            <option value="3" --><?//if($member['re_time'] == 3) { ?><!--selected--><?//}?><!-- >1시간 이상</option>-->
<!--                                        </select>-->
<!--                                </dd>-->
<!--                                <dd class="error col-xs-12"></dd>-->
<!--                            </dl>-->
<!--                            <dl>-->
<!--                                <dt>연락가능시간</dt>-->
<!--                                <dd>-->
<!--                                    <div class="flex">-->
<!--                                        <select name="call_hour_1" class="select" id="call_hour_1" title="시간">-->
<!--                                            <option value="">시간</option>-->
<!--                                            --><?php
//                                            for ($i = 1; $i <= 24; $i++) {
//                                                $selected = ($member['start_time_h'] == $i) ? 'selected' : '';
//                                                echo '<option value="' . sprintf("%02d", $i) . '" ' . $selected . '>' . sprintf("%02d", $i) . '</option>';
//                                            }
//                                            ?>
<!--                                        </select>-->
<!--                                        &nbsp;-->
<!--                                        <select name="call_min_1" class="select" id="call_min_1" title="분">-->
<!--                                            <option value="">분</option>-->
<!--                                            --><?php
//                                            $minutes = ['00', '10', '20', '30', '40', '50'];
//                                            foreach ($minutes as $minute) {
//                                                $selected = ($member['start_time_m'] == $minute) ? 'selected' : '';
//                                                echo '<option value="' . $minute . '" ' . $selected . '>' . $minute . '</option>';
//                                            }
//                                            ?>
<!--                                        </select>-->
<!--                                        &nbsp;&nbsp;-->
<!--                                        <select name="call_hour_2" class="select" id="call_hour_2" title="시간">-->
<!--                                            <option value="">시간</option>-->
<!--                                            --><?php
//                                            for ($i = 1; $i <= 24; $i++) {
//                                                $selected = ($member['end_time_h'] == $i) ? 'selected' : '';
//                                                echo '<option value="' . sprintf("%02d", $i) . '" ' . $selected . '>' . sprintf("%02d", $i) . '</option>';
//                                            }
//                                            ?>
<!--                                        </select>-->
<!--                                        &nbsp;-->
<!--                                        <select name="call_min_2" class="select" id="call_min_2" title="분">-->
<!--                                            <option value="">분</option>-->
<!--                                            --><?php
//                                            foreach ($minutes as $minute) {
//                                                $selected = ($member['end_time_m'] == $minute) ? 'selected' : '';
//                                                echo '<option value="' . $minute . '" ' . $selected . '>' . $minute . '</option>';
//                                            }
//                                            ?>
<!--                                        </select>-->
<!---->
<!--                                </dd>-->
<!--                                <dd class="error col-xs-12"></dd>-->
<!--                            </dl>-->
<!--                            <dl>-->
<!--                                <dt>자기소개 글</dt>-->
<!--                                <dd>-->
<!--                                    <textarea placeholder="소개글을 입력해주세요." maxlength="255" rows="6" spellcheck="false" name="pf_produce" id="pf_produce" style="min-height: 204px;">--><?//=$member['mb_about']?><!--</textarea>-->
<!--                                </dd>-->
<!--                                <dd class="error col-xs-12"></dd>-->
<!--                            </dl>-->


                                <dl>
                                    <dt>포트폴리오</dt>

                                    <? for($i=1; $i<7; $i++ ) { ?>
                                        <dd>
                                            <input type="file" name="file<?=$i?>" id="file<?=$i?>">
                                            <? if($member['file'.$i] != "") { ?>
                                                <label for="file_d<?=$i?>"><input type="checkbox" id="file_d<?=$i?>"> <?=$member['file_name'.$i]?>  삭제하기</label>
                                            <?}?>
                                        </dd>
                                    <?}?>
                                </dl>

                            <div class="btn_confirm">
                                <input type="submit" class="btn_submit ft_btn" id="pay_submit" value="프로필 등록 및 수정" accesskey="s" onclick="save_profile()">
                            </div>

						</div>
						
					</div>

                </div>
				<!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_menu.php'); ?> 	
			</div>				
		</div>

    </div>


    <script>
        function save_profile() {

            let formData = new FormData();

            for(let i=1; i<7; i++){
                let fileInput = document.getElementById("file"+i);
                let file = fileInput.files[0];
                if(file){
                    formData.append("file"+i, file);
                }

                let checkbox = document.getElementById("file_d"+i);
                if (checkbox != null && checkbox.checked) {
                    formData.append("file_d"+i,"t");
                } else {
                    formData.append("file_d"+i,"f");
                }
            }
            // let re_time = $("#mb_1").val();
            // let start_time_h = $("#call_hour_1").val();
            // let end_time_h = $("#call_hour_2").val();
            // let start_time_m = $("#call_min_1").val();
            // let end_time_m = $("#call_min_2").val();
            // let mb_about = $("#pf_produce").val();

            let mb_nick = $("#mb_nick").val();
            var org_mb_nick = "<?=$member[mb_nick]?>";
            if(mb_nick.trim() == "") {
                alert("닉네임은 필수입니다.");
                return false;
            }
            if(mb_nick.trim().length < 2) {
                alert("닉네임은 2글자 이상이어야 합니다.");
                return false;
            }
            let mb_sex = $("input:radio[name='mb_sex']:checked").val() ? $("input:radio[name='mb_sex']:checked").val() : "";
            let mb_birth = $("#mb_birth").val();
            let mb_job = $("input:radio[name='mb_job']:checked").val();
            let mb_interest = [];
            $("input[name='mb_interest']:checked").each(function(e){
                mb_interest.push($(this).val());
            })
            var nick_check = false;
            var error = false;
            // 닉네임중복검사
            $.ajax({
                url : "ajax_nick_check.php",
                method : "post",
                enctype : "multipart/form-data",
                async : false,
                cache : false,
                data : {
                    "_method" : "get",
                    "mb_nick" : mb_nick
                },
                dataType : "json",
                success: function(res){
                    console.log(res);
                    if(!res.success) {
                        alert(res.message);
                        error = true;
                    }
                    else {
                        if(res.data.length > 0) nick_check = true;
                    }
                }
            });

            if(error) return false;

            if(nick_check && org_mb_nick != mb_nick) {
                alert("이미 존재하는 닉네임입니다.");
                return false;
            }

            formData.append("mode","save_profile");
            // formData.append("re_time",re_time);
            // formData.append("start_time_h",start_time_h);
            // formData.append("end_time_h",end_time_h);
            // formData.append("start_time_m",start_time_m);
            // formData.append("end_time_m",end_time_m);
            // formData.append("mb_about",mb_about);
            formData.append("mb_nick",mb_nick);
            formData.append("mb_sex",mb_sex);
            formData.append("mb_birth",mb_birth);
            formData.append("mb_job",mb_job);
            formData.append("mb_interest",JSON.stringify(mb_interest));
            formData.append("mb_profile","true");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "<?=G5_URL?>/bbs/ajax.controller.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // 파일 업로드 성공 시 동작할 코드 작성
                    swal('등록 되었습니다.');
                    console.log("파일 업로드 성공");

                    var response = xhr.responseText;
                    console.log(response);
                } else {
                    // 파일 업로드 실패 시 동작할 코드 작성
                    console.log("파일 업로드 실패");
                }
            };
            xhr.send(formData);
        }



        //이미지 미리보기
        function getImgPrev(input) {
            var regex = /(.*?)\.(jpg|jpeg|png|bmp|jfif|JPG)$/;
            var filesTempArr = [];

            if (!regex.test(input.files[0].name)) {
                swal("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp, jfif, JPG)");
                input.value = "";
                return false;
            }

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img'),
                        div_img = document.getElementById("img_area");
                    // btn = document.createElement('button');

                    var el = $(input);
                    // img.setAttribute("class", "p_img");
                    img.setAttribute("src", e.target.result);
                    // img.setAttribute("style", "width:110px;height:110px;");
                    $("#img_area").html(img);

                }
                reader.readAsDataURL(input.files[0]);

                var files = input.files;
                var files_arr = Array.prototype.slice.call(files);
                filesTempArr.push(files_arr);

                var form = $('#imgfrm')[0];
                var formData = new FormData(form);
                // formData.append("mb_icon", filesTempArr);
                formData.append("mode", "mb_icon_update");

                // 이미지 등록
                $.ajax({
                    url : g5_bbs_url + "/ajax.controller.php",
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: 'POST',
                    success : function(data) {
                        if(data =='success'){
                            swal('사진 등록이 완료되었습니다.');
                            // $('#del_file').val(data);
                        }else{
                            alert(data);
                        }
                    },
                    err : function(err) {
                        alert(err.status);
                    }
                });
            }
        }

    </script>



<?
include_once('./_tail.php');
?>

