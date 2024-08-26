<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style_pro.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

?>
<link rel="stylesheet" type="text/css" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css">

<script src="https://fengyuanchen.github.io/cropper/js/cropper.js"></script>

<style>
    textarea { resize: unset; }


</style>

<!-- 취소 및 환불규정 모달팝업/카테고리별로 환불 규정 내용이 달라집니다. 현재는 1차카테고리(디자인) > 2차카테고리(웹툰.캐릭터)를 임의로 선택하고 등록가정임-->
<div id="basic_modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">[<?=$category1_name?>] 취소 및 환불 규정 보기</h4>
                </div>
                <div class="modal-body">
                    <div class="cont ref" style="white-space: pre-wrap;"><?= isset($popup_result['cr_content']) ? $popup_result['cr_content']: "등록안됨";?></div><!--cont-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">확인하였습니다</button>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 취소 및 환불규정 모달팝업 -->



<!-- 썸네일 이미지 등록 -->
<div id="basic_modal" class="">
    <div class="modal fade" id="myModal_thumbnail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="resetPhoto"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">썸네일 이미지 등록</h4>
                </div>
                <div class="modal-body">
                    <?php if (!$mobile){?>
                    <p>마우스 휠로 이미지 사이즈를 조정해주세요.</p>
                    <?php }else{ ?>
                    <p>손가락으로 확대, 축소해주세요</p>
                    <?php } ?>
                    <div class="photo_box">
        
						<div class="photo_them">
							<div class="them_img">
								<img id="image" src="">
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
					<a href="javascript:void(0);" id="complete" class="btn-default">업로드</a>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- /썸네일 이미지 등록 -->


<!-- 메인이미지등록시 tip모달-->
<div id="basic_modal">
    <div class="modal fade" id="myModal_mg1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">메인이미지 등록 TIP</h4>
                </div>
                <div class="modal-body">
                    <div class="cont tip">
                        <div class="point">이미지 권장 사이즈 : 652 x 488px (4:3 비율)</div>
                        <div class="point">사용 제한 이미지</div>
                        <ul class="list">
                            <li>저작권 침해 (무단복제, 도용) 이미지</li>
                            <li>프로필 사진과 동일한 이미지</li>
                            <li>가격, 연락처, 서비스와 관련 없는 홍보성 문구</li>
                            <li>임의로 제작된 인증 마크, 라벨, 할인표기</li>
                            <li>검증 불가 내용 (최초, 유일, 무제한, 1위, 누적의뢰 수/금액 표기 등)</li>
                        </ul>
                    </div><!--cont-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">확인하였습니다</button>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->

<!-- 로딩 모달-->
<div id="basic_modal">
    <div class="modal fade" id="loading_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-body">
					<p class="text_loading">잠시만 기다려주세요.<br>이미지 로딩중입니다.</p>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 로딩모달-->

<!-- 상세이미지등록시 tip모달-->
<div id="basic_modal">
    <div class="modal fade" id="myModal_mg2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">상세이미지 등록 TIP</h4>
                </div>
                <div class="modal-body">
                    <div class="cont tip">
                        <div class="point">이미지 권장 사이즈: 가로 652px 이상, 세로 3000px 이하</div>
                        <div class="point">상세이미지에 제공 가능한 서비스 샘플 이미지를 등록할 수 있습니다.</div>
                        <div class="point">상업적인 이용 및 허가에 대한 부분을 확인하시어 등록해주시길 바랍니다.</div>
                        <div class="point">무단/부정한 이용으로 제3자의 권리를 침해하는 이미지는 등록할 수 없습니다.</div>
                        <div class="point">상세 이미지는 서비스 상세 페이지 하단에 등록하신 순서대로 노출됩니다.</div>
                        <div class="point">이미지를 여러 장 첨부할 경우 각 이미지 사이를 구분하는 여백을 고려하여 등록하시길 바랍니다.</div>
                    </div><!--cont-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">확인하였습니다</button>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 상세이미지등록시 tip모달-->


<!--1차카테고리(디자인) > 2차카테고리(웹툰.캐릭터)를 임의로 선택하고 등록가정시-->

<!-- 재능상품 등록하기(3.서비스상세단계) -->
<div id="pro_step">
    <!--상단카테고리-->
    <ul class="cate cf">
        <li><a href="javascript:void(0);" onclick="move_category('pro_step01.php');"><span class="nm">01</span>기본정보</a></li>
        <li><a href="javascript:void(0);" onclick="move_category('pro_step02.php');"><span class="nm">02</span>가격정보</a></li>
        <li class="active"><a href="javascript:void(0);"><span class="nm">03</span>서비스상세</a></li>
    </ul>

    <?php if ($member['mb_id'] == "test@naver.com"){ ?>
        <!-- <div class="photo_box">
        
            <div class="photo_them">
                <div class="them_img">
                    <img id="image" src="">
                </div>
            </div>
            <a href="javascript:void(0);" id="complete">업로드</a>
        </div> -->
    <?php } ?>
    <!--등록 폼 시작-->
    <div class="in">
        <form id="frmstep3">
            <input type="hidden" id="move_mode" name="move_mode" value=""> <!-- 임시저장 or 다음단계 -->
            <input type="hidden" id="page" name="page" value=""> <!-- 이동할 탭 (01-기본정보/02-가격정보/03-서비스상세) -->
            <input type="hidden" id="tab" name="tab" value="3"> <!-- 이동할 탭 (1-기본정보/2-가격정보/3-서비스상세) -->
            <input type="hidden" id="ta_idx" name="ta_idx" value="<?=$ta_idx?>">
            <input type="hidden" id="ta_ctg_idx" name="ta_ctg_idx" value="<?=$ta['ta_ctg_idx']?>">
            <input type="hidden" id="w" name="w" value="<?=$_REQUEST['w']?>">
            <div class="form-group">
                <label for="test01">서비스 설명</label>
                <div class="txt_bx">
                <textarea name="ta_service_info" id="ta_service_info" class="form-control txt" rows="5" placeholder="전문인 소개(경력 및 이력), 작업 가능 분야, 작업 제공 절차, 서비스 특징에 대해서 의뢰인이 이해하기 쉽도록 정확하게 작성해 주세요.
외부연락처(전화번호 및 카톡ID, 이메일, 외부링크)는 노출하실 수 없습니다."><?=$ta['ta_service_info']?></textarea>
                    <!--<div class="text_limit"><span id="ta_service_info_count">0</span> / 최소 500자</div>-->
                    <!--텍스트입력시 카운트가 올라감-->
                </div>
            </div><!--form-group-->

            <div class="form-group">
                <label for="test01">수정 및 재진행 안내 입력</label>
                <div class="txt_bx">
                <textarea name="ta_update_info" id="ta_update_info" class="form-control txt doc_text" rows="5" placeholder="수정 및 재진행에 대한 범위를 구체적으로 작성바랍니다.
예)텍스트수정/이미지수정/시안수정/컨셉1회 재작업가능 등, 범위설정이 불명확한 경우 의뢰인과 분쟁이 발생할 수 있습니다."><?=$ta['ta_update_info']?></textarea>
                    <div class="text_limit"><span id="ta_update_info_count">0</span> / 최소 500자</div>
                    <!--텍스트입력시 카운트가 올라감-->
                </div>
            </div><!--form-group-->

            <div class="form-group">
                <h2 class="title">취소 및 환불규정</h2>
                <div class="refund_bx">취소 및 환불규정은 판매하시는 서비스의 관련 법령에 따라 일괄 적용됩니다.
                    <div class="view">
                        <span><?=$category1_name?></span><span><i class="fal fa-angle-right"></i></span><!--1단계에서 선택한 1차 카테고리가 추출되도록-->
                        <span><?=$category2_name?></span><span><i class="fal fa-angle-right"></i></span><!--1단계에서 선택한 2차 카테고리가 추출되도록-->
                        <span><?=$category3_name?></span>
                        <a data-toggle="modal" data-target="#myModal" class="view_big">취소 및 환불규정 보기</a>
                        <!--취소환불규정내용은 카테고리별로 다름-->
                    </div>
                </div><!--refund_bx-->
            </div><!--form-group-->

            <div class="form-group">
                <h2 class="title faq">자주하는 질문과 답변<a href="javascript:qna_save();" class="s_save">저장하기</a></h2>
                <div class="s_faq">
                    <ul>
                        <li>
                            <div class="stq">Q.</div>
                            <div class="inf"><input type="text" class="form-control" id="qna_q" name="qna_q" placeholder="자주하는 질문을 입력해주세요"></div>
                        </li>

                        <li>
                            <div class="stq">A.</div>
                            <div class="inf"><input type="text" class="form-control" id="qna_a" name="qna_a" placeholder="자주하는 질문의 답변을 입력해주세요"></div>
                        </li>
                    </ul>
                </div><!--s_faq-->
                <div class="s_faq_list" id="qna_list_div">

                </div><!--s_faq_list-->
            </div><!--form-group-->

            <div class="form-group">
                <h2 class="title">이미지 첨부하기</h2>
                <?php if ($private) {?>
                <div class="img_up">
                    <strong class="tit">썸네일이미지 등록 (1장이상 필수)</strong><a data-toggle="modal" data-target="#myModal_mg1" class="img_tip">TIP!</a>
                    <div class="size">700 x 466px (4:3비율)</div>
                    <ul class="mainType" id="mainType_img_thum">
                        <?php
                        $sql = "select * from {$g5['board_file_table']} where wr_id = '{$ta_idx}' and bo_table = 'thum_talent' ";
                        $result =sql_query($sql);

                        if(sql_num_rows($result) > 0 ) {
                            for ($i = 0; $row = sql_fetch_array($result); $i++) {
                                $main_file = G5_DATA_PATH . '/file/thum_talent/' . $row['bf_file'];
                                if (file_exists($main_file)) {
                                    $html = "<li id ='p_box_" . $row['bf_idx'] . "'><a>";
                                    $html .= "<div class=\"img\"><img src='" . G5_DATA_URL . '/file/thum_talent/' . $row['bf_file'] . "' alt=\"\"></div>";
                                    $html .= "<div onclick=\"thum_del(this)\" id ='thum_del_" . ($row['bf_idx']) . "' class='del thum_btn_del'><img src=\"".G5_THEME_IMG_URL."/main/btn_sfile_del.png\" alt='삭제'></div>";
                                    $html .= "</a></li>";
                                    echo $html;
                                }
                            }
                        }else{
                            //이미지 등록전
                            echo '<li class="addFiles" onclick="thum_file_open()" ></li>';
                        }?>
                    </ul>
                    <input type="file" name="photoBtn" accept="image/jpeg, image/png" id="photoBtn" style="display: none">

                </div><!--img_up-->
                <?php } ?>

                <div class="img_up">
                    <strong class="tit">메인이미지 등록 (1장이상 필수)</strong><a data-toggle="modal" data-target="#myModal_mg1" class="img_tip">TIP!</a>
                    <div class="size">700 x 466px (4:3비율)<strong class="img_limit"><span id="service_detail_count"><?=$img_cnt['cnt']?></span> / 4</strong></div>
                    <ul class="mainType" id="mainType_img">
                        <div id="prev_area">
                            <?php
                            $sql = "select * from {$g5['board_file_table']} where wr_id = '{$ta_idx}' and bo_table = 'talent' ";
                            $result =sql_query($sql);
                            for($i = 0; $row = sql_fetch_array($result); $i++){
                                $main_file = G5_DATA_PATH.'/file/talent/'.$row['bf_file'];
                            if (file_exists($main_file)){
                                $html = "<li id ='p_box_" . $row['bf_idx'] . "'><a href=\"javascript:;\">";
                                $html .= "<div class=\"img\"><img src='" . G5_DATA_URL.'/file/talent/'.$row['bf_file'] . "' alt=\"\"></div>";
                                $html .= "<div onclick=\"btn_image_del(this," . "''" . ")\" id ='btn_del_" . $row['bf_idx'] . "' class='del btn_del'><img src=\"".G5_THEME_IMG_URL."/main/btn_sfile_del.png\" alt='삭제'></div>";
                                $html .= "</a></li>";
                                echo $html;
                              }
                            } ?>
                        </div>
                        <li onclick="file_add('')" class="addFiles" id="li_list_img"><!--이미지 등록 전-->
                        </li>
                    </ul>
                </div><!--img_up-->

                <div class="img_up">
                    <strong class="tit">상세이미지 등록</strong><a data-toggle="modal" data-target="#myModal_mg2" class="img_tip">TIP!</a>
                    <div class="size">가로 700px 이상, 세로 규격 없음<strong class="img_limit"><span id="subservice_detail_count"><?=$sub_img_cnt['cnt']?></span> / 9</strong></div>
                    <ul class="mainType" id="mainType_img">
                        <div id="subprev_area">
                            <?php
                            $sql = "select * from {$g5['board_file_table']} where wr_id = '{$ta_idx}' and bo_table = 'sub_talent' ";
                            $result =sql_query($sql);
                            for($i = 0; $row = sql_fetch_array($result); $i++){
                                $main_file = G5_DATA_PATH.'/file/sub_talent/'.$row['bf_file'];
                                if (file_exists($main_file)){
                                    $html = "<li id ='subp_box_" . $row['bf_idx'] . "'><a href=\"javascript:;\">";
                                    $html .= "<div class=\"img\"><img src='" . G5_DATA_URL.'/file/sub_talent/'.$row['bf_file'] . "' alt=\"\"></div>";
                                    $html .= "<div onclick=\"btn_image_del(this," . "'sub'" . ")\" id ='subbtn_del_" . ($row['bf_idx']) . "' class='del subbtn_del'><img src=\"".G5_THEME_IMG_URL."/main/btn_sfile_del.png\" alt='삭제'></div>";
                                    $html .= "</a></li>";
                                    echo $html;
                                }
                            } ?>
                        </div>
                        <li onclick="file_add('sub')" class="addFiles" id="li_list_img"></li><!--이미지 등록 전-->
                    </ul>
                </div><!--img_up-->

               <?php /*<div class="img_up">
                    <strong class="tit">동영상 첨부</strong>
                    <div class="size">파일 사이즈는 30mb 이하로 등록해 주십시오.</div>
                    <ul class="movieType" id="movieType">
                        <li class="addFiles"><input type="file" name="li_view_mp4" id="li_view_mp4"></li>
                    </ul>
                </div><!--img_up--> */ ?>
            </div><!--form-group-->
        </form>
    </div><!--in-->

    <!--저장 부분-->
    <div class="f_save cf">
        <!--<div class="save"><a href="javascript: form_action('save');">임시저장</a></div>-->
        <div class="save"><a href="javascript:move_category('pro_step02.php')"><i class="fal fa-undo"></i> 이전단계</a></div>
        <div class="arr"><a href="javascript:form_ajax('final_save');">등록완료</a></div>
    </div><!--f_save-->

</div><!--pro_step-->

<script>
    $(document).ready(function () {
        qna_list(<?=$ta_idx?>);
    });

    // textarea 글자 수 체크
    $('.doc_text').keyup(function (e) {
        var content = $("textarea#"+this.id).val();
        $('#'+this.id+'_count').text("" + content.length); // 글자 수 실시간 카운팅

        if (content.length > 500) {
            alert("최대 500자까지 입력 가능합니다.");
            $(this).val(content.substring(0, 500));
            $('#'+this.id+'_count').text("500");
        }
    });

    var box_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    var subbox_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    //이미지 미리보기
    function getImgPrev(input, id) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;
        var leng = $("." + id + "btn_del").size();
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);
        var count = 0;
        var img_idx = 0; //이미지 갯수
        if (id == 'sub'){
            count = 9;
        }else{
            count = 4;
        }
        if (leng + input.files.length > count) {
            swal('최대 '+count+'개까지 등록 가능 합니다.');
            return false
        }


        for (var i = 0; i < input.files.length; i++) {
            // img_idx++;
            var size = input.files[i].size;
            var file_name = input.files[i].name.toLowerCase();
            var limit = 2000000;

            if (!reg_ext.test(file_name)) {
                swal("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
                return false;
            }

            if( size > limit )
            {
                swal( '파일용량은 2mb 를 넘을수 없습니다.' );
                continue;
            }
            img_idx++;
            if (id == '') {
                filesTempArr.push(files_arr[i]);
            } else {
                subfilesTempArr.push(files_arr[i]);
            }

            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (id == '') {
                        box_idx++;
                        idx = box_idx;
                    } else {
                        subbox_idx++;
                        idx = subbox_idx;
                    }

                    var html = "<li id ='" + id + "p_box_" + idx + "'><a href=\"javascript:;\">";
                    html += "<div class=\"img\"><img src='" + e.target.result + "' alt=\"\"></div>"
                    html += "<div onclick=\"btn_image_del(this," + "'" + id + "'" + ")\" id ='" + id + "btn_del_" + (idx) + "' class='del "+id+"btn_del'><img src=\"<?php echo G5_THEME_IMG_URL ?>/main/btn_sfile_del.png\" alt='삭제'></div>";
                    html += "</a></li>"
                    $('#' + id + 'prev_area').append(html);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

        //이미지 현재 개수에 파일 추가 하는 것 만큼 더해주기
        $('#'+id+'service_detail_count').html($('#'+id+'service_detail_count').text()*1+img_idx);
        // console.log(filesTempArr)
    }

    var file_idx = 0;
    var subfile_idx = 0;
    function file_add(id) {
        var leng = $("." + id + "btn_del").size();

        if (id == '') {
            var input_id = "image" + file_idx;
        } else {
            var input_id = id + "image" + subfile_idx;
        }

        upload = $('<input type="file" name="image[]" class="frm_file" id="' + input_id + '" multiple onchange="getImgPrev(this,' + "'" + id + "'" + ')" accept="image/*" >');

        if (leng < 8) {
            // $("#" + id + "file_input").after(upload);
            upload.trigger('click');
            // file_idx++;

        } else {
            alert("최대 8장까지 등록 가능합니다.");
            return false;
        }
    }

    var filesTempArr = [];
    var subfilesTempArr = [];
    var update_main_idx = [];
    var update_sub_idx = [];
    function btn_image_del(f, id) {
        var btn_del = document.getElementById(f.id),
            file_idx = btn_del.id.split('_');
        //splice하면 index꼬여서 delete처리함.
        if (id == '') {
            delete filesTempArr[(file_idx[2] - 1)];
            //이미 있는 파일 삭제
            update_main_idx.push(file_idx[2]);
        } else {
            delete subfilesTempArr[(file_idx[2] - 1)];
            //이미 있는 파일 삭제
            update_sub_idx.push(file_idx[2]);
        }

        //파일 딜리트하면 현재개수에서 -1
        $('#'+id+'service_detail_count').html($('#'+id+'service_detail_count').text()-1);

        $('#' + id + 'p_box_' + file_idx[2]).html('');
        $('#' + id + 'p_box_' + file_idx[2]).css('display', 'none');
    }

    var is_post = false;
    function form_ajax(move_mode) {
        var form = $('#frmstep3')[0];
        var formData = new FormData(form);

        //금지단어 필터링
        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": $("#ta_service_info").val(),
                "content": $("#ta_update_info").val()
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });
        if (subject) {
            swal("서비스 설명에 금지단어('"+subject+"')가 포함되어있습니다");
            return false;
        }
        if (content) {
            swal("수정 및 재진행 안내에 금지단어('"+content+"')가 포함되어있습니다");
            return false;
        }


        if (move_mode == 'final_save') {
            if ($("[id^='btn_del']").length == 0) {
                swal("메인이미지를 1장 이상 등록해주세요.");
                return false;
            }
            <?php if ($private) {?>
            if ($('.thum_btn_del').length == 0 ) {
                swal("썸네일 이미지를 등록해주세요");
                return false;
            }
            <?php } ?>
        }
        /*if($("[id^='subbtn_del']").length  < 3 ){
            swal("상세이미지를 3장 이상 등록해주세요.");
            return false;
        }*/


        // if (is_post) {
        //     swal("재능등록이 진행 중입니다. 잠시만 기다려 주세요.");
        //     return false;
        // }
        // is_post = true;

        //파일 배열로 담기
        for (var i = 0; i < filesTempArr.length; i++) {
            formData.append("bf_file[]", filesTempArr[i]);
        }
        for (var i = 0; i < subfilesTempArr.length; i++) {
            formData.append("subbf_file[]", subfilesTempArr[i]);
        }

        formData.append("mode", "pro_step");
        formData.append("update_sub_idx", update_sub_idx);
        formData.append("update_main_idx", update_main_idx);
        // formData.append("ta_service_info", $('#ta_service_info').val());
        // formData.append("ta_update_info", $('#ta_update_info').val());
        // formData.append("move_mode", $('#move_mode').val());
        formData.append("move_mode", move_mode);

        formData.append("page", $('#page').val());
        // formData.append("ta_idx", $('#ta_idx').val());
        <?php if ($private) {?>
        if (canvas != undefined) {
            canvas.toBlob(function (blob) {
                formData.append("thumbf_file[]", blob);
                only_ajax(formData)
            })
        }else{
            only_ajax(formData)
        }
        <?php }else{ ?>
        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.controller.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            datatype: 'json',
            success: function (data) {
                if (data) {
                    if($('#move_mode').val() == '') { // 등록완료
                        swal("재능 등록이 완료되었습니다.")
                            .then(() => {
                                location.href = g5_bbs_url + '/category_list.php?category=<?=$category1_name?>&category2=<?=$category2_name?>&category3=<?=$category3_name?>';
                            });
                    }
                    else { // 탭이동
                        location.href = g5_bbs_url + '/' + $('#page').val() + '?w=<?=$_REQUEST["w"]?>&ta_idx=<?=$ta_idx?>';
                    }
                } else {
                    is_post = false;
                    alert("통신에 실패했습니다.");
                }
            },
            err: function (err) {
                alert(err.status);
            }
        });
        <?php } ?>


    }

    function only_ajax(formData) {
        $.ajax({
            url: "<?=G5_BBS_URL?>/ajax.controller.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            datatype: 'json',
            success: function (data) {
                if (data) {
                    if($('#move_mode').val() == '') { // 등록완료
                        swal("재능 등록이 완료되었습니다.")
                            .then(() => {
                                location.href = g5_bbs_url + '/category_list.php?category=<?=$category1_name?>&category2=<?=$category2_name?>&category3=<?=$category3_name?>';
                            });
                    }
                    else { // 탭이동
                        location.href = g5_bbs_url + '/' + $('#page').val() + '?w=<?=$_REQUEST["w"]?>&ta_idx=<?=$ta_idx?>';
                    }
                } else {
                    is_post = false;
                    alert("통신에 실패했습니다.");
                }
            },
            err: function (err) {
                alert(err.status);
            }
        });
    }


    function form_action(mode) {
        $('#move_mode').val(mode);
        form_ajax('save');
    }

    function move_category(page) {
        $('#page').val(page); // 탭 이동 시 (01-기본정보, 02-가격정보)
        form_action('next');
        //location.href = '<?//=G5_BBS_URL?>///' + page;
    }

    function qna_save() {
        var qna_q = $('#qna_q').val();
        var qna_a = $('#qna_a').val();
        var ta_idx = $('#ta_idx').val();

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            data: {qna_q: qna_q,qna_a: qna_a,ta_idx:ta_idx, mode : 'qna_save' },
            type: 'POST',
            async: false,
            success: function (data) {
                if (data == 1) {
                    $('#qna_q').val("");
                    $('#qna_a').val("");
                    qna_list(ta_idx);
                }else{
                    swal("qna등록 중 오류가 발생했습니다. 새로고침 후 재시도 해주세요.")
                }
            },
        });

    }
    
    function qna_list(idx) {

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            data: {ta_idx: idx, mode : 'qna_list' },
            type: 'POST',
            async: false,
            datatype: 'html',
            success: function (data) {
                $('#qna_list_div').html(data);
            },
        });

    }

    function qna_del(idx) {
        var ta_idx = $('#ta_idx').val();
        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            data: {qna_idx: idx, mode : 'qna_del' },
            type: 'POST',
            async: false,
            success: function (data) {
                if (data != 1){
                    swal('오류가 발생했습니다. 새로고침 후 다시 시도해주세요.')
                }else{
                    qna_list(ta_idx);
                }
            },
        });

    }

    var canvas;
    var cropper;

    $(function(){
        // 사진 업로드 버튼
        $('#photoBtn').on('change', function(){
            $('.them_img').empty().append('<img id="image" src="">');
            var image = $('#image');
            var imgFile = $('#photoBtn').val();
            var fileForm = /(.*?)\.(jpg|jpeg|png|JPG|JPEG|PNG)$/;
            // 이미지가 확장자 확인 후 노출
            if(imgFile.match(fileForm)) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    image.attr("src", event.target.result);
                    cropper = image.cropper( {
                        dragMode: 'move',
                        viewMode:1,
                        aspectRatio:4/3,
                        // autoCropArea:0.8,
                        //minCropBoxWidth:500,
						 minContainerWidth:300,
						  minContainerHeight: 300,
                        restore: false,
                        guides: false,
                        center: false,
                        highlight: false,
                        cropBoxMovable: false,
                        cropBoxResizable: false,
                        toggleDragModeOnDblclick: false
                    });
                };
                reader.readAsDataURL(event.target.files[0]);
                //모달 닫기 방지. 닫기할 경우 해줘야할 이벤트있어서 x누를때만 닫히게 함.
                $("#myModal_thumbnail").modal({ keyboard: false, backdrop: 'static' });
            } else if (imgFile.match(fileForm) != ""){
                alert("이미지 파일(jpg, png형식의 파일)만 올려주세요");
                $('#photoBtn').val('');
                return;
            }
        });
        //모달 닫기 시
        $('#resetPhoto').on('click', function(){
            console.log("resetPhoto");
            $('.btn_wrap a:last-child').removeClass('bg1');
            $('.them_img img').attr('src','').remove();
            $('#photoBtn').val("");
            $("#myModal_thumbnail").modal("hide");

        });

        // 업로드 버튼
        $('#complete').on('click', function(){
            $("#img_loading").css("display","block");
            $('.them_img').append('<div class="result_box"><img id="result" src=""></div>');
            $("#myModal_thumbnail").modal('hide');
            $("#loading_modal").modal();
        });
    });

    $('#myModal_thumbnail').on('hidden.bs.modal', function () {

        var image = $('#image');
        var result = $('#result');
        if($('input[type="file"]').val() != ""){

            canvas = image.cropper('getCroppedCanvas',{
                //     width:700,
                //     height:466
            });
            //캔버스 인식해서 저장하는거라 해당거를 저장. 그래서 사라지면 안됌
            result.attr('src',canvas.toDataURL("image/jpg"));

            html = "<li><a>";
            html += "<div class=\"img\"><img src='" + canvas.toDataURL("image/jpg") + "' alt=\"\"></div>";
            html += "<div onclick=\"thum_del(this)\" class='del thum_btn_del'><img src=\"<?php echo G5_THEME_IMG_URL ?>/main/btn_sfile_del.png\" alt='삭제'></div>";
            html += "</a></li>";
            $("#mainType_img_thum").html(html);
            // $("#img_loading").css("display","none");
            $("#loading_modal").modal('hide');

            // $("#myModal_thumbnail").modal("hide");
        }
    });

    function thum_file_open() {
        $("#photoBtn").click();
    }
    function thum_del() {

        var html = '<li class="addFiles" onclick="thum_file_open()" ></li>';
        $("#mainType_img_thum").html(html);
        $('#photoBtn').val("");

    }



</script>