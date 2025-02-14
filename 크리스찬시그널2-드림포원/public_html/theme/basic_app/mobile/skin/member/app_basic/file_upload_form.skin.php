<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);




?>
<style>
    .btn_del {
        position: absolute;
        background: rgba(0, 0, 0, 0.5);
        width: 18px;
        height: 18px;
        line-height: 18px;
        border: 0;
        border-radius: 50%;
        right: -3px;
        top: -4px;
        color: #fff;
        font-size: 0.8em;
        z-index: 10;
    }

    /*로딩바*/
    #mask {
        position: fixed;
        z-index: 9000;
        background-color: #000000;
        display: none;
        left: 0;
        top: 0;
    }

    #loadingImg {
        position: fixed;
        left: 50%;
        top: 50%;
        display: none;
        z-index: 10000;
        transform: translate(-50%, -50%);
    }

    #loadingImg img {
        width: 50px;
        height: 50px;
    }

    .filetxt {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        /*        width: 240px;*/
    }

    #my_profile .in .form-group .document_list .area_input {
        justify-content: space-between;
        font-size: 0.9em;
    }


    #ft {
        display: none;
    }


    #my_profile .in {
        padding: 0;
    }

    #my_profile .in label {
        font-weight: 600;
        font-size: 1em;
    }

    .selc {
        display: flex;
        flex-wrap: wrap;
    }

    .selc input[type=checkbox]+label,
    .selc input[type=radio]+label {
        font-size: 0.85em !important;
    }

    .selc span {
        float: unset;
    }

    #my_profile .in .title .comm {
        font-size: 0.75em;
    }

    #my_profile .st .tit {
        display: inline-block;
        padding: 4px 15px;
        border: 2px solid #fe8ea6;
        color: #fe8ea6;
        border-radius: 30px;
        margin-bottom: 6px;
        font-size: 0.9em;
    }

    .b_rdo {
        display: flex;
        flex-wrap: wrap;
    }

    .b_rdo .st {
        width: calc(50% - 4px);
        position: relative;
        /*	margin: 0 2px 4px;*/
    }

    .b_rdo .st.spec {
        width: 100%;
    }

    .b_rdo .st>div {
        border: 2px solid #f1f1f1;
        width: 100%;
        box-shadow: 2px 2px 0 rgb(0 0 0 / 2%);
        border-radius: 3px;
        padding: 20px;
    }

    .b_rdo .st .bx {
        position: relative;
    }

    .b_rdo .st h2 {
        display: inline;
        margin: 3px 0 0;
        text-align: left;
        font-size: 1em;
    }

    .b_rdo .st .scon {
        font-size: 0.83em;
        font-weight: 500;
        color: #fe8ea6;
        margin-top: 8px;
    }

    .b_rdo input[type="radio"] {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .b_rdo .st p {
        position: absolute;
        right: 20px;
        top: 20px;
    }

    .b_rdo .st p img {
        width: 50px;
        height: auto;
    }

    .b_rdo .st {
        margin: 0 2px 4px;
    }

    #my_profile .in .form-control {
        margin: 0 0 5px;
    }

    .mbskin {
        padding-bottom: 100px;
    }

    .mbskin .title_top {
        margin-top: 100px;
    }

    #my_profile .btn_upload {
        display: inline-block;
        background: #fe8ea6;
        color: #FFF;
        padding: 10px 0;
        width: 120px;
        text-align: center;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        cursor:pointer;
    }


</style>

<!-- 메세지 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModaregister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">프로필작성 안내</h4>
                </div>
                <div class="modal-body msg_con">
                    <h3><span class="color">서류</span>를 등록하세요</h3>
                    <p>
                        <span class="bold">관리자</span>에게만 공개되는 내용입니다.<br>
                        사실과 다를 경우 법적책임이 있을 수 있습니다.
                    <p>
                </div>
                <!--msg_con-->
            </div>
        </div>
    </div>
</div>
<!--basic_modal-->



<div class="mbskin" id="my_profile">
    <?php include_once("./my_profile_head.php") ?>
    <!--작성 폼 시작-->
    <div class="in">


        <h2 class="title_top">
            <span class="point">서류</span>를 등록하세요
        </h2>

    <form name="fwrite" id="fwrite" action="<?php echo G5_BBS_URL.'/file_upload.php' ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="in">
        <input type="hidden" name="mb_no" value="<?php echo $mb['mb_no'] ?>">
        <input type="hidden" id="page" name="page">
        <input type="hidden" name="mb_id" value="<?=$mb['mb_id']?>">


        <div class="form-group cf">
            <div class="regi_info v2">
                <p style="margin:0 0 5px">
                    입력하신 서류는 절대적으로 <strong class="">관리자</strong>에게만 공개됩니다.
                </p>

                <em>서류안내</em>

                <ul style="text-align:left;">
                    <li>
                        - 서류는 변경이 불가하며 추가로 올리는 것은 가능합니다.
                    </li>
                    <li>
                        - 등본, 최종학력증명서, 사업자등록증, 지역이나 직장의료보험증, 각종 자격증, 급여통장명세서, 급여명세서 등 수입을 증명하는 서류제출 요망
                    </li>
                </ul>
            </div>
        </div>

        <!--form-group photo-->
        <div class="in form-group" id="my_profile">
            <h3 class="title">서류등록<strong class="comm">등록 완료 후 <span class="point">수정 불가</span></strong></h3>
            <div class="addFileBox">


                <ul class="document_list">
                <span id="file_div">
                <?php

                // 추가서류
                $sql = " select * from g5_member_img_add where mb_no = {$mb['mb_no']} order by idx ";
                $result = sql_query($sql);
                $img_url_show .= '<div class="photo div_box">';
                while ($row = sql_fetch_array($result)) {
                    $img_url = G5_DATA_URL.'/file/member_add/'.$row['img_file'];
                    $img_url_show = '';
                    $img_url_show .= '<img src='.$img_url.' width="160px" height="160px">';

                    if($row['img_file']){
                        echo $img_url_show;
                    }
                }
                $img_url_show .= '</div>';
                ?>
                </span>
                <br><br><br>

                    <?php
                    for($i=0; $i<1; $i++) {
                        ?>
                    <div class="form-group">
                        <li class="document_<?=$i?>">
                            <div class="area_input">
                                <input type="file" id="bf_file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input imgext" style="display: inline-block;">
                                <?php if ($is_file_content) { ?>
                                    <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['img_file'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input imgext">
                                <?php } ?>
                                <?php if($w == 'u' && $file[$i]['file']) { ?>
                                    <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')'; ?> 파일 삭제</label>
                                <?php } ?>


                                <!--</span>-->
                                <div class="addFileBox">
                                <a class="btn_upload" href="javascript:void(0);" onclick="submit_fwrite();"><i></i>업로드</a>
                                </div>
                                <!--
                                <span onclick="submit_fwrite();" class="btn_upload">업로드</span>
                                -->
                            </div>
                        </li>
                    </div>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </form>
    </div>
    <!--in-->

    <br><br><br><br>
    <!--저장 부분-->
    <div class="f_arr cf">
        <div class="arr">
            <span><a href="#" onclick="location.href='<?php echo G5_BBS_URL.'/mypage.php'; ?>'"><i class="fal fa-angle-left"></i> 이전</a></span>
            <!--            <span><a href="#" onclick="save('my_profile05.php');">다음 <i class="fal fa-angle-right"></i></a></span>-->
            <!--첫단계에서는 "다음"만 나오도록--->
        </div>
        <div class="save"><a href="#" onclick="save('my_profile_end.php');">저 장</a></div>

    </div>
</div>

    <script>
        $('#myModaregister').modal('show');

        function submit_fwrite(){
            if($('#bf_file').val()){
                document.getElementById('fwrite').submit();
            }else{
                swal('파일을 선택해주세요.');
            }
        }

        // 이미지 확장자
        function wrestImgExt(fld)
        {
            if (!wrestTrim(fld)) return;

            var pattern = /\.(gif|jpg|png)$/i; // jpeg 는 제외
            if(!pattern.test(fld.value)){
                if(wrestFld == null){
                    wrestMsg = wrestItemname(fld)+" : 이미지 파일이 아닙니다.\n.gif .jpg .png 파일만 가능합니다.\n";
                    wrestFld = fld;
                    fld.select();
                }
            }
        }

        // 저장
        function save(page) {
            $('#page').val(page);



            $('form')[0].submit();
        }

    </script>








