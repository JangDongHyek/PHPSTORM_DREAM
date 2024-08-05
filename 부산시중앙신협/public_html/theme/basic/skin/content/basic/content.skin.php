<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);

$sql = "select * from g5_board_file where bo_table = 'service_ana' order by bf_datetime desc ";
$result = sql_query($sql);
?>
<!-- 콘텐츠 시작 { -->
<? if($co_id=="info" || $co_id=="info_ex" || $co_id=="trv_service_"|| $co_id=="trv_service"){ ?>

        <?php echo $str; ?>


	<!-- 멤버스안내페이지는 안나오게 -->
<?} elseif ($co_id == "trv_service_ana"){ ?>

<div id="ctt" class="ctt_<?php echo $co_id; ?>">
    <div id="members" class="ananti">

        <section class="bg_section bg_lct01">
            <h3 class="h3_tit elice text-focus-in">아난티<p>&nbsp;</p></h3>
            <div class="scroll-icon-box">
                <div class="mouse">
                    <div class="wheel"></div>
                </div>
                <div class="dots">
                    <span class="unu"></span>
                    <span class="doi"></span>
                    <span class="trei"></span>
                </div>
            </div>
        </section>

        <div class="sections" id="skrollr-body" data-600="z-index:2">
            <section class="tab tab1">
                <div class="backgrounds">
                    <div class="bg bg-1-1" data-0="opacity:0;z-index:0;background:rgba(255, 255, 255, 0)" data-400="opacity:1;z-index:2;background:rgba(255, 255, 255, .3)" data-600="opacity:1;z-index:2;background:rgba(255, 255, 255, 1)"></div>
                </div>
            </section>
        </div>


        <section class="mem01 bg_box">
            <div class="autoW">
                <div class="new_cont_text">
                    <h3>ANANTI COVE</h3>
                    <p class="tum">아난티는 한국에서 가장 좋은 온천 '워터하우스', 다양한 미식과 라이프스타일을 만날 수 있는 '아난티 타운' 그리고 '아난티 펜트하우스'와 '프라이빗 레지던스'가 있는 하나의 마을입니다.</p>
                </div>
                <div class="new_cont_info">
                    <a href="#" target="_blank"><img src="../theme/basic/img/sub/ico_kakao.png" alt="카카오톡"></a>
                    <a href="#" target="_blank"><img src="../theme/basic/img/sub/ico_insta.png" alt="인스타그램"></a>
                    <div class="dlBox">
                        <dl>
                            <dt>예약대상</dt>
                            <dd>VVIP조합원</dd>
                        </dl>
                        <dl>
                            <dt>구성</dt>
                            <dd>아난티 예약 및 이용규정에 따름</dd>
                        </dl>
                        <dl>
                            <dt>문의</dt>
                            <dd>부산시중앙신협 프라이빗센터 (T.051-611-1255 내선번호3)</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg_box">
            <form action="<?=G5_BBS_URL.'/ajax.controller.php'?>" id="del_frm" method="post">
                <input type="hidden" name="mode" value="service_ana_del">
                <div class="imgListBox">
                    <div class="imgList swiper-container">
                        <ul class="swiper-wrapper">
                            <?php for ($i=0; $row = sql_fetch_array($result); $i++) { ?>
                            <li class="swiper-slide">
                                <img src="<?=G5_DATA_URL?>/file/service_ana/<?=$row['bf_file']?>">
                                <input type="checkbox" name="btn_chk[]" value="<?=$row['bf_file']?>">
                            </li>
                             <?php } ?>
                        </ul>
                    </div>

                    <div class="btn_wrap">
                        <a class="btn_add" href = "javascript:modal_click()"><i class="fas fa-plus"></i></a>
                        <a class="btn_del" href = "javascript:img_del()"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </form>
        </section>
        <section class="bg_box btm_nav_box">
            <div class="autoW">
                <div class="link_title" data-aos="fade-down">EVENT <a href="./board.php?bo_table=event">바로가기</a></div>

                <h2 data-aos="fade-down">여행서비스</h2>
                <ul class="btm_nav" data-aos="fade-down" data-aos-delay="100">
                    <li><a href="./content.php?co_id=trv_service">엘시티 프라이빗뷰 레지던스</a></li>
                    <li><a href="./content.php?co_id=trv_service_jeju">제주공감연수원</a></li>
<!--                    <li><a href="./content.php?co_id=trv_service_haun">해운대팔레드시즈</a></li>-->
                    <li class="on"><a href="./content.php?co_id=trv_service_ana">아난티</a></li>
                    <li><a href="./content.php?co_id=trv_service_sono">소노호텔 앤 리조트</a></li>
                </ul>

            </div>
        </section>

    </div>


</div>


<!--삽입 모달-->
<div class="modal fade pop_cancel gisa" id="ananti_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                <h4 class="modal-title" id="myModalLabel">이미지 추가</h4>
            </div>
            <form action="<?=G5_BBS_URL.'/ajax.controller.php'?>" id="imgform" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="mode" value="service_ana_picture">
                <div class="modal-body">
                    <div> <dl>
                            <dd class="gisa_photo">
                                <label for="image">사진 첨부<span class="gisa_on"><i class="fas fa-images"></i></span></label>
                                <input type="file" multiple id="image" placeholder="사진 첨부" name="image[]" style="display: none" onchange="getImgPrev(this)" accept=".jpg,.jpeg,.png">
                            </dd>
                            <dd id="prev_area" class="gisa_photo_in"  name = "placehold_img">
                                <!--                                <img src="--><?//= $mb_icon_url ?><!--">-->
                            </dd>

                        </dl>
                    </div>
                    <button class="btn-block" onclick="$('#imgform').submit()">확인</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!--삽입 모달-->
<script>
    function modal_click() {
        $("#ananti_pop").modal();
    }

    /*************이미지 넣기***************/
    var box_idx = 0; //고유 idx,해당 idx로 photo div를 읽어와 미리보기 사진을 없앰
    //이미지 미리보기
    function getImgPrev(input) {
        var reg_ext = /(.*?)\.(jpg|jpeg|png)$/;
        var leng = $(".btn_del").size();
        var files = input.files;
        var files_arr = Array.prototype.slice.call(files);

        if (leng+input.files.length > 4  ){
            swal('최대 4개까지 등록 가능 합니다.');
            return false
        }

        for (var i = 0; i<input.files.length; i++) {
            // img_idx++;

            var file_name = input.files[i].name.toLowerCase();
            if (!reg_ext.test(file_name)) {
                swal("이미지만 등록이 가능합니다. (jpg, jpeg, png)");
                return false;
            }

            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var html = '<div>';
                    html += '<img src="'+ e.target.result +'">';
                    html += '</div>';

                    $('#prev_area').append(html);


                }

                reader.readAsDataURL(input.files[i]);
            }

        }
        // console.log(filesTempArr)

    }

    function img_del() {

        if ($("input:checkbox[name='btn_chk[]']").is(":checked")==false) {
            alert("하나 이상 선택하여 주십시오.");
            return;
        }

        if (confirm("삭제 시 복구 할 수 없습니다. 그래도 삭제하시겠습니까?")) {
            $("#del_frm").submit();
        }


    }

</script>
<?php }else{ ?>
    <div id="ctt" class="ctt_<?php echo $co_id; ?>">

        <?php echo $str; ?>

    </div>
<?php } ?>
