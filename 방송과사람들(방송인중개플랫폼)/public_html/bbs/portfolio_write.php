<?
include_once('./_common.php');
$g5['title'] = '포트폴리오등록';
include_once('./_head.php');
$name = "item_write";

//재능정보
$idx = $_REQUEST['idx'];
$sql = "select * from new_item left join new_category c on i.i_ctg = c.c_idx where i_idx = '{$idx}' ";
$view = sql_fetch($sql);

$main_ctg = ctg_list(0);

//$view_ctg = ctg_info($view["i_ctg"]);

if(!$is_member){
    alert("회원이시라면 로그인 후 이용해주세요.",G5_BBS_URL.'/login.php?url='.G5_BBS_URL."/item_write01.php" );
}

$c_name = ctg_info($view['c_p_idx'])["c_name"];
$c_name2 = $view["c_name"];
?>

<? if($name=="item_write") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="item_write">
<?}?>

<style>
	#ft_menu{display:none;}
</style>
<form id="fsave" name="fsave" action="./ajax.controller.php" method="post" onsubmit="return fsave_submit()">

    <span id="tab1" style="display: block">
        <div id="item_write">
                <input type="hidden" name="click_tab" id="click_tab" value="">
                <input type="hidden" name="now_tab" id="now_tab" value="1">

                <div class="inr v2" id="inr">
                <h3>포트폴리오등록</h3>

                <div class="box_list">
                    <div class="box_write">
                        <h4>제목</h4>
                        <div class="cont">
                            <input name="i_title" id="i_title" value="<?=$view['i_title']?>" type="text" placeholder="제목을 입력해 주세요.">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>1차 카테고리</h4>
                        <div class="cont">
                            <!--<select id="category_select" onchange="area_filter(this.value);">
                                <option value=""><?/*= ( $c_name != '') ? $c_name : "카테고리를 선택해주세요." */?></option>
                                <?php /*for ($i = 0; $i < count($main_ctg); $i++){ */?>
                                    <option value="<?php /*echo $main_ctg[$i]['c_idx'] */?>"
                                        <?php /*if ($view["c_p_idx"] == $main_ctg[$i]["c_idx"]) echo "selected"; */?>>
                                        <?/*= $main_ctg[$i]['c_name'] */?>
                                    </option>
                                <?php /*} */?>
                            </select>-->
                            <div class="select_box v1">
                                <div class="box">

                                    <div class="select">
                                        <?= ( $c_name != '') ? $c_name : "카테고리를 선택해주세요." ?>
                                    </div>
                                    <ul class="list date" id="ctg_ul" >
                                        <?php for ($i = 0; $i < count($main_ctg); $i++){ ?>
                                            <li class="<? if ($view["c_p_idx"] == $main_ctg[$i]["c_idx"] ) echo "selected"; ?>"
                                                onclick="area_filter('<?php echo $main_ctg[$i]["c_idx"] ?>'); ctg_list2(this.value);"
                                                value="<?php echo $main_ctg[$i]['c_idx'] ?>"><?=$main_ctg[$i]['c_name']?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>2차 카테고리</h4>
                        <!--
                        <div class="cont" id="ctg_ul2">
                            <div class="select_box v1">
                                <div class="box">
                                    <div class="select">
                                        <?= ($c_name2 != '') ?$c_name2 : "카테고리를 선택해주세요." ?>
                                    </div>
                                    <input type="hidden" id="i_ctg" name="i_ctg">
                                    <ul class="list2 date" id="ctg_ul2">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="cont" id="ctg_ul2">
                        </div>
                    </div>
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
                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">동영상 등록 <em><i class="point" name ="subpoint"><?=$subfilecount?></i>/8</em>
                            <!--<p><input type="checkbox"><label>링크 등록</label></p>--></h4>
                        <div class="cont">
                            <div class="area_box">
                                <div class="video_active box_dashed">
                                    <ul>
                                        <li>
                                            <p>동영상 제목.mp4</p>
                                            <a class="del"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                        </li>
                                        <li>
                                            <p>동영상 제목.mp4</p>
                                            <a class="del"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                        </li>
                                    </ul>
                                    <button class="btn_add"><i class="fa-light fa-folder-arrow-up"></i> 동영상 업로드</button>
                                </div>
                                <div class="link_active box_dashed">
                                    <dl>
                                        <dt>동영상 링크 01.</dt>
                                        <dd><input type="text" placeholder="등록하고자하는 동영상 링크를 입력해주세요"></dd>
                                        <a class="del"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                    </dl>
                                    <dl>
                                        <dt>동영상 링크 02.</dt>
                                        <dd><input type="text" placeholder="등록하고자하는 동영상 링크를 입력해주세요"></dd>
                                        <a class="del"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                    </dl>
                                    <button class="btn_add"><i class="fa-light fa-plus"></i> 링크 추가</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="box_write02">
						<h4>포트폴리오 설명</h4>
						<div class="cont">
							<!-- 에디터 넣어주세요~! -->
							<textarea name = "i_content" placeholder="프로젝트 목적, 주요기능과 메뉴 등을 상세히 입력해주세요"><?=$view['i_content']?></textarea>
						</div>
					</div>
                    <div class="box_write02">
						<h4>약관 동의</h4>
						<div class="cont">
							<div class="box_gray">
								<p><input type="checkbox" id="agree" name="agree"><label for="agree">아래 내용에 모두 동의 합니다.</label></p>
							</div>
                            도용하지 않은 순수 본인의 창작물 임을 확인합니다.
                            신고 접수 시 해당 포트폴리오가 방송과사람들에 의해 임의 삭제 처리될 수 있음에 동의합니다.
						</div>
					</div>
                </div>
                <div id="area_btn"><a class="btn_next" href="javascript:tab_click('2')">등록완료</a></div>
            </div>
        </div>
    </span>
    <span id="tab2" style="display: none">
        <?php include_once('./item_write02.php'); ?>
    </span>
    <span id="tab3" style="display: none">
    <?php include_once('./item_write03.php');?>
    </span>
</form>
<script>
        //패키지 가격설정
        // Function to handle checkbox toggle
        function togglePackage() {
            var packageCheckbox = document.getElementById('package');
            var packageBox = document.querySelector('.box_write.package');
            var priceInput = document.getElementById('i_price');

            // Check if the package checkbox is checked
            if (packageCheckbox.checked) {
                // If checked, show the package box and disable price input
                packageBox.style.display = 'block';
                priceInput.disabled = true;
            } else {
                // If unchecked, hide the package box and enable price input
                packageBox.style.display = 'none';
                priceInput.disabled = false;
            }
        }

        // Attach togglePackage function to checkbox change event
        document.getElementById('package').addEventListener('change', togglePackage);

        // Optional: Ensure initial state reflects checkbox state on page load
        togglePackage();
    </script>

<script>
    $(document).ready(function () {
        <?php if ($ctg_key != ""){ ?>
        area_filter('<?=$view['i_ctg']?>');
        <?php } ?>
    });

    //탭 클릭시 저장 후 이동
    function tab_click(click_tab){

        var tab = $('#now_tab').val();
        if (click_tab != "complete") {
            $('#click_tab').val(click_tab);
        }

        if (tab == 1){
            fsave_submit1();
        }else if (tab == 2){
            fsave_submit2();
        }else if (tab == 3 ||click_tab == 'complete'){
            fsave_submit3(click_tab);
        }



    }

    function css_block_none(tab) {
        $("[id^='tab']").css("display","none");
        $("#tab"+tab).css("display","block");
        console.log('css'+tab);
        if (tab !='complete') {
            $('#now_tab').val(tab);
        }

    }

    function fsave_submit1() {
        var ctg_value = "";
        var submit_is = true;

        $.each($('#ctg_ul li'), function(index, item){
            var selected = $(this).attr('class');
            if (selected == "selected"){
                ctg_value = $(this).attr("value");
            }
        });
        if (ctg_value == ""){
            swal("카테고리를 선택해주세요.");
            submit_is = false;
        }

        //i로 시작하는 input value 빈값찾기
        $.each($("#inr [name^='i_']"), function(index, item){
            if ($(this).val() == "" && $(this).attr('name') != 'i_ctg'){
               swal($(this).attr('placeholder'));
               submit_is = false;
            };
        });

        if (submit_is) {
            css_block_none($('#click_tab').val());
        }
    }
    

    //카테고리별 옵션선택
    function area_filter(ctg) {

        //idx 있을 경우 카테고리 변경 시 카테고리 같을 경우에 옵션 선택 값 넣어줌
        var chk_val = "";
        if (ctg == "<?=$view['i_ctg']?>" ){
            chk_val = "<?=$view['i_option_arr']?>";
        }

        $('#i_ctg').val(ctg);

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "ctg": ctg,
                "mode": "area_filter",
                "chk_val": chk_val,
            },
            dataType: "html",
            success: function(data) {



                if (data != "") {
                    $('#area_filter').html(data);
                }
            }
        });
    }

    //2차카테고리
    function ctg_list2(ctg) {

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "c_p_idx": ctg,
                "mode": "ctg_list2",
            },
            dataType: "html",
            success: function(data) {

                if (data != "") {
                    $('#ctg_ul2').html(data);
                }

            }
        });
    }

</script>



<?php include_once('./_tail.php'); ?>