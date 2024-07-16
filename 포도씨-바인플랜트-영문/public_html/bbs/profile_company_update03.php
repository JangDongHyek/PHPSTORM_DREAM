<?php
include_once('./_common.php');

$g5['title'] = 'Coporate profile management';
include_once('./_head.php');

loginCheck($member['mb_id'], '기업');

$mb_catalog = sql_fetch(" select * from g5_member_img where mb_id = '{$member['mb_id']}' and img_file = '{$member['mb_catalog']}'; ")['img_source']; // 카달로그 실제 파일명

// 프로필작성완료여부 (해시태그작성완료)
$isProfileComp = false;
if(!empty($member['mb_hashtag'])) $isProfileComp = true;
?>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/mobile/skin/member/app_basic/style.css?v=<?= G5_CSS_VER ?>">
<style>
	.profile_top .list_step > li.active:before{width:60%;}
	.profile_content h3{text-align:center !important;}
    #join_info dl.add .input input {margin:unset !important;}
    .patent {border: unset !important;}
    .box-article #join_info .row .error {
        font-size: 0.85em;
        color: #FF0000;
        padding: 0;
    }
</style>

<div class="mbskin">
	<article class="box-article">
		<h3>Update Company Profile</h3>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div id="area_join" class="profile company">
                <div id="join_info">
                    <div class="profile_top">
                        <ul class="list_step">
                            <li>
                                <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update01.php'"<?php } ?>>1</em>
                            </li>
                            <li>
                                <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update02.php'"<?php } ?>>2</em>
                            </li>
                            <li class="active">
                                <em>3</em>
                                <span>Certification and Materials</span>
                            </li>
                            <li>
                                <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update04.php'"<?php } ?>>4</em>
                            </li>
                            <li>
                                <em <?php if($isProfileComp) { ?>onclick="location.href='./profile_company_update05.php'"<?php } ?>>5</em>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_content">
                        <dl class="row add first">
                            <dt>Held Certifications, Patents<em>*optional</em><button type="button" onclick="add_patent();">+Add</button></dt>
                            <dd>
                                <div class="input">
                                    <ul class="catalog_list patent_list">
                                        <?php if(empty($member['mb_patent'])) { ?>
                                        <li class="patent_1">
                                            <button type="button" class="btn_close" onclick="del_patent(1);"></button>
                                            <input type="text" id="mb_patent_1" name="mb_patent[]" class="regist-input patent" placeholder="Enter Held Certification, Patents">
                                        </li>
                                        <?php } ?>
                                        <?php
                                        if(!empty($member['mb_patent'])) {
                                            $mb_patent = explode('|', $member['mb_patent']);
                                            for($i=0; $i<count($mb_patent); $i++) {
                                        ?>
                                        <li class="patent_<?=$i+1?>">
                                            <button type="button" class="btn_close" onclick="del_patent(<?=$i+1?>);"></button>
                                            <input type="text" id="mb_patent_<?=$i+1?>" name="mb_patent[]" value="<?=$mb_patent[$i]?>" class="regist-input patent" placeholder="Enter held certification, patents.">
                                        </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <!-- 추가 버튼 클릭하면 인풋 생기게  (최대 5개)-->
                                        <!--<input type="text" class="regist-input " placeholder="상세업종을 입력해 주세요.">-->
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt>Catalog<em>*optional</em></dt>
                            <dd>
                                <div class="input">
                                    <ul class="catalog_list catalog_file v2">
                                        <?php
                                        $sql = " select * from g5_member_img where mb_id = '{$member['mb_id']}' and category = '카달로그' order by idx ";
                                        $result = sql_query($sql);

                                        $fileCount = 0;
                                        for($i=0; $file=sql_fetch_array($result); $i++) {
                                            $fileCount++;
                                            $cover = sql_fetch(" select * from g5_member_img where mb_id = '{$member['mb_id']}' and category = '카달로그커버' and p_idx = {$file['idx']} order by idx ");
                                        ?>
                                        <li class="file_<?=$i?>">
                                            <input type="hidden" id="cover_idx_<?=$i?>" value="<?=$cover['idx']?>">
											<div class="area_img upload cover_<?=$i?>" <?php if(empty($cover['img_file'])) { ?>onclick="cover_add(<?=$i?>);"<?php } ?>>
                                                <button type="button" class="btn_img_close" onclick="cover_del(<?=$i?>, 'u');">Delete</button>
                                                <?php if(!empty($cover['img_file'])) { ?>
                                                <img class="img_cover_<?=$i?>" src="<?=G5_DATA_URL?>/file/company/<?=$cover['img_file']?>">
                                                <?php } ?>
											</div>
                                            <input type="file" class="cover_file" name="cover_file" id="cover_<?=$i?>" onchange="setImageFromFile(this, <?=$i?>, '<?=$file['idx']?>');" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
                                            <div class="area_input">
												<em>Catalog <?=$i+1?></em>
												<span>
													<a href="javascript:void(0);" class="filetxt filetxt_<?=$i?>"><?=$file['img_source']?></a>
													<button type="button" class="btn_close" onclick="file_del(<?=$i?>, 'u', '<?=$file['idx']?>');"></button>
												</span>
											</div>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <a class="btn_upload" href="javascript:void(0);" onclick="file_add();"><i></i>UPLOAD</a>
                                    <input type="file" name="file" id="file" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
                                </div>

                            </dd>
                            <!--<dd class="error col-xs-12">프리미엄 회원 기능입니다. 계정을 업그레이드 하세요.</dd>-->
                        </dl>
                        <dl class="row">
                            <dt>Company Introduction Video<em>*optional</em></dt>
                            <dd>
                                <div class="input">
                                    <input type="text" id="mb_video_link" name="mb_video_link" value="<?=$member['mb_video_link']?>" class="regist-input " placeholder="Enter YouTube or Video Link Here">
                                </div>
                            </dd>
                            <!--<dd class="error col-xs-12">프리미엄 회원 기능입니다. 계정을 업그레이드 하세요.</dd>-->
                        </dl>
                        <div class="area_btn">
                            <a href="javascript:void(0);" class="btn_prev"><span onclick="pre_move('company_update02', '<?=$company?>');">Go to <em class="pc">Previous step</em></span></a>
                            <!-- input 작성하면 다음버튼으로 나오게 해주세요 -->
                            <a href="javascript:void(0)" class="btn_next active">NEXT</a>
                            <?php if($company == 'Y' || $isProfileComp) { ?>
                            <a href="javascript:void(0);" class="btn_confirm home active">Modify Complete</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</article>
</div>

<script>
    var filesTempArr = [];
    var count = <?php echo $fileCount == 0 ? 0 : $fileCount; ?>;
    $(function() {
        form_check();

        // input 작성 시 active 클래스 추가
        $(":input").on("change keyup", function(e) {
            form_check();
        });

        // 카달로그 파일 추가
        $("input[name='file']").change(function(index){
            if($("input[name='cover_file']").length >= 4) {
                swal('You can register up to 4.');
                return false;
            }

            if($(this).val() != "")
            {
                var fileValue = $(this).val().split("\\");
                var fileName = fileValue[fileValue.length-1]; // 파일명

                var html = '<li class="file_'+count+'">';
                html += '<div class="area_img upload cover_'+count+'" onclick="cover_add('+count+');">';
                html += '<button type="button" class="btn_img_close" onclick="cover_del('+count+');">삭제</button>';
                html += '</div>';
                html += '<input type="file" class="cover_file" name="cover_file" id="cover_'+count+'" onchange="setImageFromFile(this, '+count+');" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">';
                html += '<div class="area_input">';
                html += '<em>카달로그 '+(count+1)+'</em>';
                html += '<span>';
                html += '<a href="javascript:void(0);" class="filetxt_'+count+'">'+fileName+'</a>';
                html += '<button type="button" class="btn_close" onclick="file_del('+count+');"></button>';
                html += '</span>';
                html += '</div>';
                html += '</li>';
                $('.catalog_file').append(html);

                filesTempArr.push([count, this.files[0], '']);

                var regex = /(.*?)\.(jpg|jpeg|png|PNG|bmp|JPG|gif)$/;
                if (regex.test(this.files[0].name)) { // 이미지면 이미지 미리보기
                    setImageFromFile(this, count);
                }

                count++;
            }
        });
    });

    // 폼체크(내용 입력 시 다음버튼 활성화)
    function form_check() {
        var patent_flag = false; // 특허 입력 확인
        $('.patent_list li input').each(function() {
            if($.trim(this.value).length != 0) {
                patent_flag = true;
            }
        });

        if(patent_flag || $.trim($('#mb_patent').val()).length != 0 || $('#file').val() != "" || $('#mb_video_link').val() != "") {
            //$('.btn_next').text('다음');
            $('.btn_next').attr('href', 'javascript:profile_update("company", "profile03", "update04", "Y", "<?=$company?>");'); // (구분(일반/기업), 현재프로필단계, 저장후이동경로, 파일유무, 미니홈피이동)
        } else {
            //$('.btn_next').text('건너뛰기');
            $('.btn_next').attr('href', 'javascript:pre_move("company_update04", "<?=$company?>")');
        }
        $('.home').attr('href', 'javascript:profile_update("company", "profile03", "update04", "", "home");');
    }

    // 상세업종 추가
    var num = '<?php echo (!empty($member['mb_patent'])) ? count($mb_patent)+1 : 2; ?>';
    function add_patent() {
        if($('.patent').length == 10) {
            swal('You can register up to 10.');
            return false;
        }
        var html = '<li class="patent_'+num+'"><button type="button" class="btn_close" onclick="del_patent('+num+');"></button><input type="text" id="mb_patent_'+num+'" name="mb_patent[]" class="regist-input patent" placeholder="Enter held certification, patents." onkeyup="form_check();"></li>';
        $('.patent_list').append(html);
        num++;
    }

    // 상세업종 삭제
    function del_patent(num) {
        $('.patent_'+num).remove();
    }

    // 카달로그 등록
    function file_add() {
        $("#file").click();
    }

    // 카달로그 삭제 (인덱스, 구분(등록/수정), 파일 DB idx)
    var filesDelIdx = [];
    function file_del(index, mode, file_idx) {
        $('.file_'+index).remove();

        if(mode == 'u') { // 수정 (수정 화면에서 파일 삭제 시 서버에 있는 파일도 삭제하기 위함)
            filesDelIdx.push(['file', file_idx]);
        }
        else {
            if(filesTempArr.length > 0) {
                for (var i=0; i<filesTempArr.length; i++) {
                    if(filesTempArr[i][0] == index) {
                        filesTempArr[i][1] = '';
                    }
                }
            }
        }
    }

    // 카달로그 커버 등록
    function cover_add(index) {
        $('#cover_'+index).click();
    }

    // 카달로그 커버 삭제 (인덱스, 구분(등록/수정))
    function cover_del(index, mode) {
        event.stopPropagation();
        $('.img_cover_'+index).remove();
        $('.cover_'+index).attr('onclick','cover_add('+index+')'); // 클릭이벤트 추가

        if(mode == 'u') { // 수정 (수정 화면에서 파일 삭제 시 서버에 있는 파일도 삭제하기 위함)
            filesDelIdx.push(['cover', $('#cover_idx_'+index).val()]);
        }
        else {
            if(filesTempArr.length > 0) {
                for (var i=0; i<filesTempArr.length; i++) {
                    if(filesTempArr[i][0] == index) {
                        filesTempArr[i][2] = '';
                    }
                }
            }
        }
    }

    // 이미지 미리보기
    var editCover = [];
    function setImageFromFile(input, index, p_idx) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement('img');
                img.setAttribute('class', 'img_cover_'+index);
                img.setAttribute('src', e.target.result);
                $('.cover_'+index).append(img); // div에 img태그 추가
                $('.cover_'+index).attr('onclick',''); // 클릭이벤트 제거
            }
            reader.readAsDataURL(input.files[0]);

            if(filesTempArr.length > 0) {
                for(var i=0; i<filesTempArr.length; i++) {
                    if(filesTempArr[i][0] == index) {
                        filesTempArr[i][2] = input.files[0];
                    }
                }
            }
            else {
                filesTempArr.push([index, '', input.files[0]]);
            }

            if(p_idx != undefined) {
                editCover.push(p_idx);
            }
        }
    }
</script>

<?
include_once('./_tail.php');
?>
