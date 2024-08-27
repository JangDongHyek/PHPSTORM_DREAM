<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

if(!$is_member){
    alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요",G5_URL);
}
?>
<style>

</style>
<!--컴플레인 모딜-->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="swiper-container" id="popupGallery3">
                    <div class="swiper-wrapper" id = "modal_img">
                        <?php
                        // 파일 출력
                        if($re_cnt != 0) {
                            for ($c = 0; $re_file = sql_fetch_array($re_result); $c++) {
                                echo '<img class="swiper-slide" id = "slid'.$c.'" src="'.G5_DATA_URL.'/file/re_car_wash/'.$re_file['bf_file'].'">';
                            }
                        }
                        ?>
                    </div>
                    <div class="popupGalleryPrev" style="position: absolute; top: 0; bottom: 0; left: 0; width: 50%; cursor: pointer; z-index: 2;"></div>
                    <div class="popupGalleryNext" style="position: absolute; top: 0; bottom: 0; right: 0; width: 50%; cursor: pointer; z-index: 2;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--주차구역사진 모딜-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="swiper-container" id="popupGallery">
                    <div class="swiper-wrapper" id = "modal_img">
                        <?php
                        // 파일 출력
                        if($cnt != 0) {
                            $html = "";
                            for ($b = 0; $file = sql_fetch_array($result); $b++) {
                                $html .=  '<div class="swiper-slide"><img class="" id = "slid'.$b.'" src="'.G5_DATA_URL.'/file/car_wash/'.$file['bf_file'].'">';
                                if ($file['ma_id'] == $member['mb_id']){
                                    $html .=  '<button class="imgDelBtn" onclick="manager_image_del(\''.$file['bf_file'].'\')" >삭제</button>';
                                }
								 $html .=  '</div>';
                            }
							
                            echo $html;
                        }
                        ?>
                    </div>
                    <div class="popupGalleryPrev"></div>
                    <div class="popupGalleryNext"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--정면사진 모딜-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="swiper-container">
                  <img src="<?=$file_url?>">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 연락요망 -->
<div id="basic_modal">
<div class="modal fade" id="myContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <input type="hidden" id="complete_idx">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">연락요망</h4>
      </div>
      <div class="modal-body">
          관리자에게 도움을 요청하시겠습니까? 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"  onclick="call_req();">확인</button>
      </div>
    </div>
  </div>
</div>
</div><!--basic_modal-->
<!-- 연락요망 -->


<!-- 답변내용// -->
<div id="reply_modal">
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">관리자 답변</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<?=$view["call_memo"]?>
		  </div>
		</div>
	  </div>
	</div>
</div>
<!-- //답변내용 -->

<!-- 완료횟수 조회 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="myModal_end" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="ing_idx">
        <input type="hidden" name="is_re_car_wash">
        <input type="hidden" name="date_type">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <h4 class="modal-title" id="myModalLabel">작업완료 내역</h4>
                </div>
                <div class="modal-body ordDone">
                    <?php for ($i = 0; $row = sql_fetch_array($complete_result); $i++){ ?>
                        <p><span><?=($i +1)?>회</span><?=date("Y년 m월 d일 H:i",strtotime($row["ch_datetime"]))?></p>
                    <?php } ?>

                    <?php for ($j = 0; $rowj = sql_fetch_array($re_result_array); $j++){ ?>
                        <?php if($j==0){ ?>
                            <br>재작업
                        <?php } ?>
                        <?php if($rowj["complete_datetime"]){ ?>
                            <p><span><?=($rowj['rw_complete_cnt'])?>회</span><?=date("Y년 m월 d일 H:i",strtotime($rowj["complete_datetime"]))?></p>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"data-dismiss="modal" aria-label="Close">확인</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 완료횟수 조회 모달 -->


<!-- 출장세차 예약 상세보기 -->

<div id="my_reser" class="view">
    <div class="view_txt">
		<h2 class="title"><?= $cdt_list[$view['car_date_type']] ?><strong class="size"><?= $cs_list[$view['car_size']] ?></strong><span class="date">신청일 : <?php
                $date = explode(" ",$view['cw_wr_datetime']);
                $day = explode('-',$date[0]);
                echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ". date('H:i',strtotime($date[1])) ?></span>
            <?php if (sql_num_rows($complete_result) > 0){ ?>
                <a href="#" class="dataMore" data-toggle="modal" data-target="#myModal_end">작업완료 내역확인</a>
            <?php } ?>
        </h2>
        <div class="serv">
            <dl class="tx_m cf">
                <dt>상품명</dt>
                <dd><?= $cdt_list[$view['car_date_type']]."(".$cs_list[$view['car_size']].")" ?></dd>
            </dl>
            <dl class="tx_m cf">
                <dt>차량정보</dt>
                <dd><?= $view['car_no'] ?> / <?= $view['car_type'] ?> / <?= $view['car_color'] ?>
                    <?php if (file_exists($file_path)){ ?>
                    <a style="margin-left: 5px" href="javascript:;" id="myButton2"  data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fas fa-camera"></i></a>
                    <?php } ?>
                </dd>
            </dl>
            <dl class="tx_m cf">
                <dt>세차일정</dt>
                <dd>
                    <?php
                    successking_date($view['car_w_date'],$view['car_w_date2']);
                    ?>
                </dd>
            </dl>
            <dl class="tx_m cf">
                <dt>세차장소</dt>
                <dd id="call_dd">
				   <?= $view['car_w_addr1']." ".$view['car_w_addr2'] ?><br /><?=$view['car_place']?>

                    <?php if ($view["call_req"] != "Y"){ ?>
                   <div class="btn_contact"><a data-toggle="modal" data-target="#myContact"><i class="fal fa-address-card"></i> 연락요망</a></div>
                    <?php }else{ ?>
                    <div class="btn_contact"><a style="background: #f1f1f1; color: #1a7cff"><i class="fal fa-address-card"></i> 연락요청완료</a>
					<!-- 답변추가 --><?php if ($view["call_memo"] != ""){ ?><a href="javascript:;" class="reply_ms" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-envelope"></i> 답변</a><?php }?>
					</div>
					

                    <?php } ?>
                </dd>
            </dl>
            <!-- 23.04.17  가리기 내부세차 따로 빼줌 wc -->
            <dl class="tx_m cf" style="display: none">
                <dt>내부세차</dt>
                <dd class="ins"><span><?= $view['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                <!--<dd class="ins"><span><i class="far fa-times-circle"></i> 포함안함</span></dd>-->
            </dl>

            <dl class="tx_m cf">
                <dt>요청사항</dt>
                <dd><?= $view['car_memo']!= "" ? $view['car_memo']: "없음";?></dd>
            </dl>
            <dl class="tx_m cf">
                <dt>고객명/연락처</dt>
                <meta name="format-detection" content="telephone=yes">
                <dd><?= $view['mb_name'] ?> / <?= hyphen_hp_number($view['mb_hp']) ?><span class="call" onclick="window.open('tel:<?=$view['mb_hp']?>', '_system')"><a><i class="fas fa-phone-alt"></i></a></span></dd>
            </dl>
            <dl class="tx_m cf">
                <dt>주차구역사진</dt>
                <?php
                if ($cnt == 0 ){
                    echo '<dd>없음';
                }else{
                    echo '<dd>있음 <a href="javascript:;" id="myButton"  data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fas fa-camera"></i></a><!--아이콘 클릭시 사진띄움-->';
                }
                ?>
                <span class="btn_contact" style="margin-left: 10px"><a><label for = "image"><i class="fal fa-album"></i> 사진추가</label></a></span></dd>
                <form action="./ajax.controller.php" id ='imgfrm' name="imgfrm" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="mode" name="mode" value="manager_parking_image" >
                    <input type="hidden" id="idx" name="idx" value="<?=$_REQUEST['idx']?>" >
                    <input type="file" id="image" name="image" style="display: none" accept="image/*" onchange="getImgPrev(this)" >
                </form>

            </dl>
            <?php if ($re_cnt){ ?>
            <dl class="tx_m cf">
                <dt>컴플레인 사진</dt>
                <?php
                if ($re_cnt == 0 ){
                    echo '<dd>없음</dd>';
                }else{
                    echo '<dd>있음 <a href="javascript:;" id="myButton3"  data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fas fa-camera"></i></a><!--아이콘 클릭시 사진띄움--></dd>';
                }
                ?>
            </dl>
            <dl class="tx_m cf">
                <dt>관리자 지시사항</dt>
                <dd><?= $view['rw_memo']!= "" ? $view['rw_memo']: "없음";?></dd>
            </dl>
            <dl class="tx_m cf">
                <dt>재작업일정</dt>
                <dd><?php
                    $date = $view['rw_date'];
                    //정기세차가 아닐경우
                    if ($date != ""){
                        $yoil = array("일","월","화","수","목","금","토");

                        $day = explode('-',$date);
                        echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ".'('.$yoil[date('w', strtotime($date))].') '.date('H:i',strtotime($view['rw_date2']));

                    }
                    ?></dd>
            </dl>
            <?php } ?>
            <?php if($member['mb_level'] != 3){ ?>
            <!-- 23.04.13 매니저만 못봄 wc -->
            <dl class="tx_m cf">
                <dt>총 금액</dt>
                <dd><span class="price"><?= number_format($view['final_pay'])?></span>원</dd>
            </dl>
            <?php } ?>
        </div><!--serv-->
    </div><!--view_txt-->
    <div class="bt_reser cf"><a href="<?php echo G5_BBS_URL ?>/my_order.php?filter=<?=$view['car_date_type']?>" class="list all">목록</a></div>
</div><!--my_reser-->



<script>

    var popupGallery;
    var popupGallery3;
    $(document).ready(function () {
        $('#myButton').click(function (e) {
            // e.preventDefaulhttps://jsfiddle.net/davidenco/jx2waxan/#t();
            $('#myModal').on('show.bs.modal', function (e) {
                popupGallery = new Swiper('#popupGallery', {
                    mode:'horizontal',
                    loop: false
                });
                $('.popupGalleryNext').click(function () {
                    popupGallery.slideNext();
                });

                $('.popupGalleryPrev').click(function () {
                    popupGallery.slidePrev();
                });
            });

            $('#myModal').on('shown.bs.modal', function (e) {
                popupGallery.update();
            });

            $('#myModal').modal();
        });

        //shown 될때 자꾸 돌아가는 액션 때문에 보기 싫어서 처음 화면으로 돌려줌.
        $('#myModal').on('hidden.bs.modal', function () {
            popupGallery.slideTo( $('#slid0').index(),1000,false );
        })

        //컴플레인사진
        $('#myButton3').click(function (e) {
            // e.preventDefaulhttps://jsfiddle.net/davidenco/jx2waxan/#t();
            $('#myModal3').on('show.bs.modal', function (e) {
                popupGallery3 = new Swiper('#popupGallery3', {
                    mode:'horizontal',
                    loop: false
                });
                $('.popupGalleryNext').click(function () {
                    popupGallery3.slideNext();
                });

                $('.popupGalleryPrev').click(function () {
                    popupGallery3.slidePrev();
                });
            });

            $('#myModal3').on('shown.bs.modal', function (e) {
                popupGallery3.update();
            });

            $('#myModal3').modal();
        });

        //shown 될때 자꾸 돌아가는 액션 때문에 보기 싫어서 처음 화면으로 돌려줌.
        $('#myModal3').on('hidden.bs.modal', function () {
            popupGallery3.slideTo( $('#slid0').index(),1000,false );
        })


        $('#myButton2').click(function (e) {
            $('#myModal2').modal();
        });


    });

    function call_req() {

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "mode": "call_req",
                "idx" : <?=$view['cw_idx']?>
            },
            dataType: "json",
            success: function(data) {
                if (data == 1) {
                    window.location.href = g5_bbs_url + "/my_order_view.php?idx=" + <?= $view['cw_idx'] ?>;
                }else{
                    swal_func("작업에 실패했습니다. 관리자에게 문의하세요.");
                }
            }
        });

    }

    // 주차구역 사진 업로드
    function getImgPrev(input) {
        var regex = /(.*?)\.(jpg|jpeg|png|bmp|jfif|JPG)$/;

        if (!regex.test(input.files[0].name)) {
            swal("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp, jfif, JPG)");
            input.value = "";
            return false;
        }

        var form = $('#imgfrm')[0];
        form.submit();

    }

    function manager_image_del(file) {

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "mode": "manager_image_del",
                "file" : file
            },
            dataType: "json",
            success: function(data) {
                if (data == 1) {

                    swal('삭제가 완료되었습니다.') .then((value) => {
                        window.location.replace(g5_bbs_url + "/my_order_view.php?idx=" + <?= $_REQUEST['idx'] ?>);
                    })
                }else{
                    swal_func("작업에 실패했습니다. 관리자에게 문의하세요.");
                }
            }
        });

    }

</script>
<!-- 출장세차 예약 상세보기 -->
