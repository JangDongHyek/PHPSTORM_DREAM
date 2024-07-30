<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<!--주차구역사진 모딜-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="swiper-container" id="popupGallery">
                    <div class="swiper-wrapper">
                        <?php
                        // 파일 출력
                        if($cnt != 0) {
                            for ($b = 0; $file = sql_fetch_array($result); $b++) {
                                echo '<img class="swiper-slide" id = "slid'.$b.'" src="'.G5_DATA_URL.'/file/car_wash/'.$file['bf_file'].'">';;
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

<!-- 출장세차 예약 상세보기 -->

<div id="my_reser" class="view">
    <div class="view_txt">
		<h2 class="title"><?= $cdt_list[$view['car_date_type']] ?><strong class="size"><?= $cs_list[$view['car_size']] ?></strong><span class="date">작업완료일 : <?php
                $date = explode(" ",$view['complete_datetime']);
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
                <dd><?= $view['car_no'] ?> / <?= $view['car_type'] ?> / <?= $view['car_color'] ?></dd>
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
                <dd><?= $view['car_w_addr1']." ".$view['car_w_addr2'] ?><br /><?=$view['car_place']?></dd>
            </dl>
            <?php if ($view['car_date_type'] < 3){ ?>
            <!-- 23.04.17 내부세차 다 가림 -->
            <dl class="tx_m cf" style="display: none">
                <dt>내부세차</dt>
                <dd class="ins"><span><?= $view['car_in_yn'] == 'Y' ? "<i class=\"far fa-check-circle\"></i> 포함" : "<i class=\"far fa-times-circle\"></i> 포함안함"; ?></span></dd>
                <!--<dd class="ins"><span><i class="far fa-times-circle"></i> 포함안함</span></dd>-->
            </dl>
            <?php } ?>
            <dl class="tx_m cf">
                <dt>요청사항</dt>
                <dd><?= $view['car_memo']!= "" ? $view['car_memo']: "없음";?></dd>
            </dl>
            <dl class="tx_m cf">
                <dt>고객명/연락처</dt>
                <dd><?= $view['mb_name'] ?> / <?= hyphen_hp_number($view['mb_hp']) ?></dd>
            </dl>
            <dl class="tx_m cf">
                <dt>주차구역사진</dt>
                <?php
                if ($cnt == 0 ){
                    echo '<dd>없음</dd>';
                }else{
                    echo '<dd>있음 <a href="javascript:;" id="myButton"  data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fas fa-camera"></i></a><!--아이콘 클릭시 사진띄움--></dd>';
                }
                ?>
            </dl>
            <?php if($member['mb_level'] != 3){ ?>
            <!-- 23.04.13 매니저만 못봄 wc -->
            <dl class="tx_m cf">
                <dt>총 금액</dt>
                <dd><span class="price"><?= number_format($view['final_pay'])?></span>원</dd>
            </dl>
            <?php } ?>
        </div><!--serv-->
    </div><!--view_txt-->
    <div class="bt_reser cf"><a href="<?php echo G5_BBS_URL ?>/my_order_end.php?filter=<?=$view['car_date_type']?>" class="list all">목록</a></div>
    <!--"예약취소 하시겠습니까?" 한번 더 물어봄-->
</div><!--my_reser-->



<!-- 출장세차 예약 상세보기 -->
<script>
    var popupGallery;
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

    });
</script>